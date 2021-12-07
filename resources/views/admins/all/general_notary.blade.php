@extends('layouts.admin')
@section('title', 'All general notary assignments')
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __(ucfirst(request()->segment(1)).' Dashboard >  '.ucfirst(request()->segment(4)).' general notary assignments') }}</h5>
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
              <th>Assignment <br/> Date & Time</th>
              <th>Client Name</th>
              <th>Client Email</th>
              <th>Assignment Phone</th>
              <th>City</th>
              <th>State</th>
              <th>Status</th>
              <th>Options</th>
            </tr>

            @foreach($datas as $data)

              <tr>
                <td>{{$data->assignment_title}}</td>
                <td>
                  {{ date('M d, Y', strtotime($data->date_of_assignment)) }} @ {{ date('h:i:sa', strtotime($data->time_of_assignment)) }}
                </td>                
                <td>{{App\User::find($data->client_id)->name}}</td>
                <td>{{App\User::find($data->client_id)->email}}</td>
                <td>{{$data->telephone_number}}</td>
                <td>{{$data->city}}</td>
                <td>{{$data->state}}</td>
                <td>
                  <?php
                    $abc = new App\Http\Controllers\AdminController;
                    echo ucfirst($abc->getStatusByNumber($data->status));
                  ?>
                </td>
                    <?php 
                     if(DB::table('invoices')->where('assignment_hash', $data->hash)->exists()){

                      $btn_color = "green";

                     }else{
                      $btn_color = "orange";
                     }
                    ?>
                <td>
                  <a href="{{route('admins.assignment.general.view.hash', [$data->hash, strtolower($abc->getStatusByNumber($data->status))])}}" class="btn btn-link">View</a> |

                  <a href="#" class="btn btn-link" style="color: {{$btn_color}};" data-toggle="modal" data-target="#invoice_{{$data->hash}}">Invoice</a> | 

 
                  <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('admins.assignment.general.view.all', request()->segment(4))}}?do=delete&for={{$data->hash}}" style="color: red;">Delete</a>
                </td>
              </tr>






            <!-- Modal -->
            <div class="modal fade" id="invoice_{{$data->hash}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Invoice to:</b> {{App\User::find($data->client_id)->name}}<br/>  <b>For:</b> {{$data->assignment_title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" action="{{route('admins.assignment.general.view.all',[request()->segment(4),'assignment' => $data->hash])}}">
                    @csrf
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Invoice amount: </label>
                        <input type="text" name="invoice_amount" class="form-control" placeholder="Your invoice amount here..." value="<?php

                          if(DB::table('invoices')->where('assignment_hash', $data->hash)->exists()){
                            echo DB::table('invoices')->where('assignment_hash', $data->hash)->value('invoice_amount');
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

                          if(DB::table('invoices')->where('assignment_hash', $data->hash)->whereDay('due_date', $i)->exists()){
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

                          if(DB::table('invoices')->where('assignment_hash', $data->hash)->whereMonth('due_date', $i)->exists()){
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

                          if(DB::table('invoices')->where('assignment_hash', $data->hash)->whereYear('due_date', $i)->exists()){
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
                          <option value="0" <?php if(DB::table('invoices')->where('assignment_hash', $data->hash)->value('status')==0){echo "selected";} ?>>Pending</option>
                          <option value="1" <?php if(DB::table('invoices')->where('assignment_hash', $data->hash)->value('status')==1){echo "selected";} ?>>Paid</option>
                          <option value="2" <?php if(DB::table('invoices')->where('assignment_hash', $data->hash)->value('status')==2){echo "selected";} ?>>Cancelled</option>
                        </select>
                      </div>

                      <input type="hidden" name="ci" value="{{$data->client_id}}">

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
