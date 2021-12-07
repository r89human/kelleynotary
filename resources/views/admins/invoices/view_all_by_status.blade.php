@extends('layouts.admin')
@section('title', 'Invoices')
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __('Admin Dashboard >  All Invoices >') }} {{ ucfirst(request()->segment(4)) }}</h5>
    <hr/>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            

          <table class="table table-bordered">
            <tr class="thead-light">
              <th>Assignment Title</th>
              <th>Client</th>
              <th>Assignment Date</th>
              <th>Completed Date</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Options</th>
            </tr>

            <?php $getAssignmentData = new App\Http\Controllers\ClientController;?>
            @foreach($invoices as $invoice)

              <tr>
                <td>{{$getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'assignment_title')}}</td>
                <td>
                            <a href="{{ route('admins.show.member.invoices', ['client', $invoice->invoice_to]) }}">{{App\User::find($invoice->invoice_to)->name}}</a>
                </td>
                <td>
                  {{ date('M d, Y', strtotime($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'date_of_assignment')))}}
                </td>
                <td>
                  {{ date('M d, Y', strtotime($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'completed_date_time')))}}
                </td>
                <td>${{$invoice->invoice_amount}}</td>

                <td>{{$getAssignmentData->getInvoiceStatus($invoice->status)}}</td>

                <td>
                  <a href="#" class="btn btn-link" data-toggle="modal" data-target="#invoice_{{$invoice->assignment_hash}}">Change</a>
                                            <a href="{{ route('admins.show.member.singleinvoices', $invoice->id) }}" class="btn btn-link">View</a>

                </td>
              </tr>











            <!-- Modal -->
            <div class="modal fade" id="invoice_{{$invoice->assignment_hash}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Invoice to:</b> {{App\User::find($invoice->invoice_to)->name}}<br/>  <b>For:</b> {{$getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'assignment_title')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" action="{{route('admins.show.member.invoices',['client', request()->segment(4),  'assignment' => $invoice->assignment_hash])}}">
                    @csrf
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Invoice amount: </label>
                        <input type="text" name="invoice_amount" class="form-control" placeholder="Your invoice amount here..." value="<?php

                          if(DB::table('invoices')->where('assignment_hash', $invoice->assignment_hash)->exists()){
                            echo DB::table('invoices')->where('assignment_hash', $invoice->assignment_hash)->value('invoice_amount');
                          }

                        ?>" required>
                      </div>



                      <div class="row">
                        <div class="col-md-4">
                          
                          <div class="form-group">
                            <label>Invoice due day: </label>
                            <select name="due_day" class="form-control">
                              <?php

                                for($i = 1; $i <=31; $i++):
                              ?>


                                <option value="{{$i}}" <?php

                          if(DB::table('invoices')->where('assignment_hash', $invoice->assignment_hash)->whereDay('due_date', $i)->exists()){
                            echo "selected";
                          }

                        ?> >{{$i}}</option>

                              <?php endfor;?>
                            </select>
                          </div>

                        </div>

                        <div class="col-md-4">
                          
                          <div class="form-group">
                            <label>Invoice due month: </label>
                            <select name="due_month" class="form-control">
                              <?php

                                for($i = 1; $i <= 12; $i++):
                              ?>


                                <option value="{{$i}}" <?php

                          if(DB::table('invoices')->where('assignment_hash', $invoice->assignment_hash)->whereMonth('due_date', $i)->exists()){
                            echo "selected";
                          }

                        ?> >{{$i}}</option>

                              <?php endfor;?>
                            </select>
                          </div>

                        </div>
                        <div class="col-md-4">

                          
                          <div class="form-group">
                            <label>Invoice due year: </label>
                            <select name="due_year" class="form-control">
                              <?php

                                for($i = date('Y'); $i <= date('Y')+5; $i++):
                              ?>


                                <option value="{{$i}}" <?php

                          if(DB::table('invoices')->where('assignment_hash', $invoice->assignment_hash)->whereYear('due_date', $i)->exists()){
                            echo "selected";
                          }

                        ?> >{{$i}}</option>

                              <?php endfor;?>
                            </select>
                          </div>

                        </div>


                      </div>

                      <div class="form-group">
                        <label>Select status</label>
                        <select name="invoice_status" class="form-control">
                          <option value="0" <?php if(DB::table('invoices')->where('assignment_hash', $invoice->assignment_hash)->value('status')==0){echo "selected";} ?>>Pending</option>
                          <option value="1" <?php if(DB::table('invoices')->where('assignment_hash', $invoice->assignment_hash)->value('status')==1){echo "selected";} ?>>Paid</option>
                          <option value="2" <?php if(DB::table('invoices')->where('assignment_hash', $invoice->assignment_hash)->value('status')==2){echo "selected";} ?>>Cancelled</option>
                        </select>
                      </div>

                      <input type="hidden" name="ci" value="{{request()->segment(4)}}">
                      <input type="hidden" name="at" value="{{$invoice->assignment_type}}">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>






            @endforeach
          </table>

        </div>
    </div>



@endsection
