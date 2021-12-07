@extends('layouts.admin')
@section('title', 'Client Profile Details & Assignments')
@section('main-content')


<?php $member = App\User::find(request()->segment(3));?>
    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __(ucfirst(request()->segment(1)).' Dashboard >  '.$member->name.' > Profile & Assignments') }}</h5>
    <hr/>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

    	<div class="col-md-12 col-xl-12 mb-4">
        <h3>{{ $member->name }} Profile Details 

        




                        <button type="button" class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#viewProfile{{$member->id}}">
                          Update Profile
                        </button>

                    </h3>


                        <!-- Modal -->
                        <div class="modal fade" id="viewProfile{{$member->id}}" tabindex="-1" role="dialog" aria-labelledby="viewProfile{{$member->id}}Label" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="viewProfile{{$member->id}}Label">{{ $member->name }} {{ $member->last_name }} details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <form method="post" action="{{ route('admin.clientinfo.update', $member->id) }}">
                              	@csrf
                              <div class="modal-body">
                                
   

                                  <table class="table table-striped table-bordered">
                                      <tr>
                                        <th scope="col">Name of Company</th>
                                        <td><input type="text" name="company_name" value="{{ $member->company_name }}"/ class="form-control"></td>
                                      </tr>
                                      <tr>
                                        <th scope="col">First Name</th>
                                        <td><input type="text" name="contact_first_name" value="{{ $member->contact_first_name }}"/ class="form-control"></td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Last Name</th>
                                        <td><input type="text" name="contact_last_name" value="{{ $member->contact_last_name }}"/ class="form-control"></td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Email address</th>
                                        <td><input type="text" name="contact_email_address" value="{{ $member->contact_email_address }}"/ class="form-control"></td>
                                      </tr>

                                      <tr>
                                        <th scope="col">Login Email address</th>
                                        <td><input type="text" name="email" value="{{ $member->email }}"/ class="form-control"></td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Telephone Number</th>
                                        <td><input type="text" name="contact_telephone_number" value="{{ $member->contact_telephone_number }}"/ class="form-control"></td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Fax Number</th>
                                        <td><input type="text" name="contact_fax_number" value="{{ $member->contact_fax_number }}"/ class="form-control"></td>
                                      </tr>

                                      <tr>

                                        <th scope="col">Mailing Address</th>
                                        <td><input type="text" name="contact_mailing_address" value="{{ $member->contact_mailing_address }}"/ class="form-control"></td>

                                      </tr>

                                  </table>
                         

                              </div>
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                          		</form>
                            </div>
                          </div>
                        </div>





        </h3>

	          <table class="table table-striped table-bordered">
	              <tr>
	                <th scope="col">Name of Company</th>
	                <td>{{ $member->company_name }}</td>
	              </tr>
	              <tr>
	                <th scope="col">First Name</th>
	                <td>{{ $member->contact_first_name }}</td>
	              </tr>
	              <tr>
	                <th scope="col">Last Name</th>
	                <td>{{ $member->contact_last_name }}</td>
	              </tr>
	              <tr>
	                <th scope="col">Email address</th>
	                <td>{{ $member->contact_email_address }}</td>
	              </tr>

	              <tr>
	                <th scope="col">Login Email address</th>
	                <td>{{ $member->email }}</td>
	              </tr>
	              <tr>

	                <th scope="col">Telephone Number</th>
	                <td>{{ $member->contact_telephone_number }}</td>
	              </tr>
	              <tr>

	                <th scope="col">Fax Number</th>
	                <td>{{ $member->contact_fax_number }}</td>
	              </tr>

	              <tr>

	                <th scope="col">Mailing Address</th>
	                <td>{{ $member->contact_mailing_address }}</td>

	              </tr>

	          </table>




    	</div>


		<hr/>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            
        <h3>{{ $member->name }} Assignments</h3>
          <table class="table table-bordered">
            <tr class="thead-light">
              <th>Assignment Title</th>
              <th>Assignment <br/> Date & Time</th>
              <th>Client Name</th>
              <th>Assignment Phone</th>
              <th>City</th>
              <th>State</th>
              <th>Zip</th>
              <th>Assignment Type</th>

              <th>Status</th>
              <th>Options</th>
            </tr>

            @foreach($general_notary_assignment as $data)

              <tr>
                <td>{{$data->assignment_title}}</td>
                <td>
                  {{ date('M d, Y', strtotime($data->date_of_assignment)) }} @ {{ date('h:i:sa', strtotime($data->time_of_assignment)) }}
                </td>                
                <td>{{App\User::find($data->client_id)->name}}</td>
                <td>{{$data->telephone_number}}</td>
                <td>{{$data->city}}</td>
                <td>{{$data->state}}</td>
                <td>{{$data->zip}}</td>
                <td><span class="badge badge-secondary"> {{ucwords(str_replace("_"," ",$data->assignment_type))}}</span></td>

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

                  <a href="#" class="btn btn-link" style="color: {{$btn_color}};" data-toggle="modal" data-target="#invoice_{{$data->hash}}">Invoice</a> 


 

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
                  <form method="post" action="{{route('admins.assignment.general.view.all',[request()->segment(3),'assignment' => $data->hash])}}">
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


                </td>
              </tr>










            @endforeach




            <!-- real state closing assignments start --> 


            @foreach($real_state_closing as $dataREC)

              <tr>
                <td>{{$dataREC->assignment_title}}</td>
                <td>
                  {{ date('M d, Y', strtotime($dataREC->date_of_assignment)) }} @ {{ date('h:i:sa', strtotime($dataREC->time_of_assignment)) }}
                </td>                
                <td>{{App\User::find($dataREC->client_id)->name}}</td>
                <td>{{$dataREC->telephone_number}}</td>
                <td>{{$dataREC->city}}</td>
                <td>{{$dataREC->state}}</td>
                <td>{{$dataREC->zip}}</td>
                <td><span class="badge badge-success"> {{ucwords(str_replace("_"," ",$dataREC->assignment_type))}}</span></td>

                <td>
                  <?php
                    $abc = new App\Http\Controllers\AdminController;
                    echo ucfirst($abc->getStatusByNumber($dataREC->status));
                  ?>
                </td>
                    <?php 
                     if(DB::table('invoices')->where('assignment_hash', $dataREC->hash)->exists()){

                      $btn_color = "green";

                     }else{
                      $btn_color = "orange";
                     }
                    ?>
                <td>
                  <a href="{{route('admins.assignment.general.view.hash', [$dataREC->hash, strtolower($abc->getStatusByNumber($dataREC->status))])}}" class="btn btn-link">View</a> |

                  <a href="#" class="btn btn-link" style="color: {{$btn_color}};" data-toggle="modal" data-target="#invoice_{{$dataREC->hash}}">Invoice</a> 


 

            <!-- Modal -->
            <div class="modal fade" id="invoice_{{$dataREC->hash}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Invoice to:</b> {{App\User::find($dataREC->client_id)->name}}<br/>  <b>For:</b> {{$dataREC->assignment_title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" action="{{route('admins.assignment.general.view.all',[request()->segment(3),'assignment' => $dataREC->hash])}}">
                    @csrf
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Invoice amount: </label>
                        <input type="text" name="invoice_amount" class="form-control" placeholder="Your invoice amount here..." value="<?php

                          if(DB::table('invoices')->where('assignment_hash', $dataREC->hash)->exists()){
                            echo DB::table('invoices')->where('assignment_hash', $dataREC->hash)->value('invoice_amount');
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

                          if(DB::table('invoices')->where('assignment_hash', $dataREC->hash)->whereDay('due_date', $i)->exists()){
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

                          if(DB::table('invoices')->where('assignment_hash', $dataREC->hash)->whereMonth('due_date', $i)->exists()){
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

                          if(DB::table('invoices')->where('assignment_hash', $dataREC->hash)->whereYear('due_date', $i)->exists()){
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
                          <option value="0" <?php if(DB::table('invoices')->where('assignment_hash', $dataREC->hash)->value('status')==0){echo "selected";} ?>>Pending</option>
                          <option value="1" <?php if(DB::table('invoices')->where('assignment_hash', $dataREC->hash)->value('status')==1){echo "selected";} ?>>Paid</option>
                          <option value="2" <?php if(DB::table('invoices')->where('assignment_hash', $dataREC->hash)->value('status')==2){echo "selected";} ?>>Cancelled</option>
                        </select>
                      </div>

                      <input type="hidden" name="ci" value="{{$dataREC->client_id}}">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>


                </td>
              </tr>










            @endforeach



            <!-- real state closing assignments end -->




            <!-- tax_closing_assignment assignments start --> 


            @foreach($tax_closing_assignment as $dataTCA)

              <tr>
                <td>{{$dataTCA->assignment_title}}</td>
                <td>
                  {{ date('M d, Y', strtotime($dataTCA->date_of_assignment)) }} @ {{ date('h:i:sa', strtotime($dataTCA->time_of_assignment)) }}
                </td>                
                <td>{{App\User::find($dataTCA->client_id)->name}}</td>
                <td>{{$dataTCA->telephone_number}}</td>
                <td>{{$dataTCA->city}}</td>
                <td>{{$dataTCA->state}}</td>
                <td>{{$dataTCA->zip}}</td>
                <td><span class="badge badge-info"> {{ucwords(str_replace("_"," ",$dataTCA->assignment_type))}}</span></td>

                <td>
                  <?php
                    $abc = new App\Http\Controllers\AdminController;
                    echo ucfirst($abc->getStatusByNumber($dataTCA->status));
                  ?>
                </td>
                    <?php 
                     if(DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->exists()){

                      $btn_color = "green";

                     }else{
                      $btn_color = "orange";
                     }
                    ?>
                <td>
                  <a href="{{route('admins.assignment.general.view.hash', [$dataTCA->hash, strtolower($abc->getStatusByNumber($dataTCA->status))])}}" class="btn btn-link">View</a> |

                  <a href="#" class="btn btn-link" style="color: {{$btn_color}};" data-toggle="modal" data-target="#invoice_{{$dataTCA->hash}}">Invoice</a> 


 

            <!-- Modal -->
            <div class="modal fade" id="invoice_{{$dataTCA->hash}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Invoice to:</b> {{App\User::find($dataTCA->client_id)->name}}<br/>  <b>For:</b> {{$dataTCA->assignment_title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" action="{{route('admins.assignment.general.view.all',[request()->segment(3),'assignment' => $dataTCA->hash])}}">
                    @csrf
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Invoice amount: </label>
                        <input type="text" name="invoice_amount" class="form-control" placeholder="Your invoice amount here..." value="<?php

                          if(DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->exists()){
                            echo DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->value('invoice_amount');
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

                          if(DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->whereDay('due_date', $i)->exists()){
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

                          if(DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->whereMonth('due_date', $i)->exists()){
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

                          if(DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->whereYear('due_date', $i)->exists()){
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
                          <option value="0" <?php if(DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->value('status')==0){echo "selected";} ?>>Pending</option>
                          <option value="1" <?php if(DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->value('status')==1){echo "selected";} ?>>Paid</option>
                          <option value="2" <?php if(DB::table('invoices')->where('assignment_hash', $dataTCA->hash)->value('status')==2){echo "selected";} ?>>Cancelled</option>
                        </select>
                      </div>

                      <input type="hidden" name="ci" value="{{$dataTCA->client_id}}">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>


                </td>
              </tr>










            @endforeach



            <!--tax_closing_assignment assignments end -->





            <!-- process_server_assignment assignments start --> 


            @foreach($process_server_assignment as $dataPRS)

              <tr>
                <td>{{$dataPRS->assignment_title}}</td>
                <td>
                  {{ date('M d, Y', strtotime($dataPRS->date_of_assignment)) }} @ {{ date('h:i:sa', strtotime($dataPRS->time_of_assignment)) }}
                </td>                
                <td>{{App\User::find($dataPRS->client_id)->name}}</td>
                <td>{{$dataPRS->telephone_number}}</td>
                <td>N\A</td>
                <td>N\A</td>
                <td>N\A</td>
                <td><span class="badge badge-primary"> {{ucwords(str_replace("_"," ",$dataPRS->assignment_type))}}</span></td>
                <td>
                  <?php
                    $abc = new App\Http\Controllers\AdminController;
                    echo ucfirst($abc->getStatusByNumber($dataPRS->status));
                  ?>
                </td>
                    <?php 
                     if(DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->exists()){

                      $btn_color = "green";

                     }else{
                      $btn_color = "orange";
                     }
                    ?>
                <td>
                  <a href="{{route('admins.assignment.general.view.hash', [$dataPRS->hash, strtolower($abc->getStatusByNumber($dataPRS->status))])}}" class="btn btn-link">View</a> |

                  <a href="#" class="btn btn-link" style="color: {{$btn_color}};" data-toggle="modal" data-target="#invoice_{{$dataPRS->hash}}">Invoice</a> 


 

            <!-- Modal -->
            <div class="modal fade" id="invoice_{{$dataPRS->hash}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Invoice to:</b> {{App\User::find($dataPRS->client_id)->name}}<br/>  <b>For:</b> {{$dataPRS->assignment_title}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" action="{{route('admins.assignment.general.view.all',[request()->segment(3),'assignment' => $dataPRS->hash])}}">
                    @csrf
                    <div class="modal-body">

                      <div class="form-group">
                        <label>Invoice amount: </label>
                        <input type="text" name="invoice_amount" class="form-control" placeholder="Your invoice amount here..." value="<?php

                          if(DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->exists()){
                            echo DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->value('invoice_amount');
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

                          if(DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->whereDay('due_date', $i)->exists()){
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

                          if(DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->whereMonth('due_date', $i)->exists()){
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

                          if(DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->whereYear('due_date', $i)->exists()){
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
                          <option value="0" <?php if(DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->value('status')==0){echo "selected";} ?>>Pending</option>
                          <option value="1" <?php if(DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->value('status')==1){echo "selected";} ?>>Paid</option>
                          <option value="2" <?php if(DB::table('invoices')->where('assignment_hash', $dataPRS->hash)->value('status')==2){echo "selected";} ?>>Cancelled</option>
                        </select>
                      </div>

                      <input type="hidden" name="ci" value="{{$dataPRS->client_id}}">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>


                </td>
              </tr>










            @endforeach



            <!--process_server_assignment assignments end -->


          </table>

        </div>
    </div>















@endsection
