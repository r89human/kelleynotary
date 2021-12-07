@extends('layouts.admin')
@section('title', $data->assignment_title)
@section('css')
  <link href="{{asset('/css/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __('Staff Dashboard >  General Assignment > ') }} {{ __($data->assignment_title) }}</h5>
    <hr/>

    <div class="card mb-4">
    	<div class="card-body" style="padding-bottom:0px;">
    		<h1 class="h3 mb-4 text-gray-800">{{ __($data->assignment_title) }}  
          @if(request()->segment(5) == 'scheduled') <small class="float-right">Schedule Time: 12-July-2020</small>@endif
        </h1>
    	</div>
    </div>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row mb-4">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-8 col-md-8">
            

          <table class="table table-bordered">
            <tr class="thead-light">
              <th>Assignment <br/> Date & Time</th>
              <th>Client Name</th>
              <th>Client Email</th>
              <th>City</th>
              <th>State</th>
              <th>Zip</th>
              <th>Status</th>
            </tr>


              <tr>
                <td>
                  {{ date('M d, Y', strtotime($data->date_of_assignment)) }} @ {{ date('h:i:sa', strtotime($data->time_of_assignment)) }}
                </td>
                <td>{{App\User::find($data->client_id)->name}}</td>
                <td>{{App\User::find($data->client_id)->email}}</td>
                <td>{{$data->city}}</td>
                <td>{{$data->state}}</td>
                <td>{{$data->zip}}</td>
                <td>
                  <?php
                    $abc = new App\Http\Controllers\StaffController;
                    echo ucfirst($abc->getStatusByNumber($data->status));
                  ?>
                </td>
              </tr>

              <tr>
              	<td colspan="8">
                	<b>Address: </b>{{$data->address}}
              	</td>
              </tr>

          </table>


          <table class="table table-bordered">
            <tr class="thead-light">
          		<th>Number of Signers</th>
          		<th>First Signer</th>
          		<th>Second Signer</th>
          		<th>Download File</th>
          	</tr>

          	<tr>
          		<td>{{$data->number_of_signers}}</td>
          		<td>
                {{$data->first_signers_name}}
                <br/> <b>Phone: </b> {{$data->telephone_number}}
              </td>
          		<td>
                {{$data->second_signers_name}}
                <br/> <b>Phone: </b> {{$data->telephone_number2}}
              </td>
          		<td><a href="#">Download File</a></td>
          	</tr>

          	<tr>
          		<td colspan="4">
          			<b>Special Instructions (If any): </b> {!! $data->special_instructions !!}
          		</td>
          	</tr>
          </table>



          <div class="row">



            <!--message area-->

        <div class="col-md-12">
              
          <div class="card">
            <div class="card-header">
              <b>Assign to Conractor</b>
            </div>
            <div class="card-body">

                @if(request()->segment(5) == 'pending')

              <div class="row">

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>Filter by State</label>
                      <select id="state" class="form-control" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                          <option value="">State select</option>

                          @foreach(DB::table('states')->get() as $state)
                              <option <?php if(request()->state == $state->state_code){echo "selected";}?> 
                              value="{{request()->fullUrlWithQuery(['state' => $state->state_code])}}">{{$state->state}}</option>
                          @endforeach
                      </select>
                    </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Filter by City</label>
                    <select id="city" class="form-control" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                        <option value="">City Select</option>
                        @foreach(DB::table('cities')->where('state_code', request()->state)->get() as $city)
                            <option <?php if(request()->city == $city->city){echo "selected";}?> value="{{request()->fullUrlWithQuery(['city' => $city->city])}}">{{$city->city}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>


                  <div class="col-md-3">
                <form method="get" action="{{ url()->full()}}">

                    <div class="form-group">
                        <label for="zip">Input ZIP</label>                      
                        <input style="height: 30px;" type="text" class="form-control" name="zip" placeholder="{{ __('Enter zip code') }}" value="{{ request('zip') }}" required name="zip">
                    </div>
                  </div>

                  <div class="col-md-2">
                      <div class="form-group">
                          <label for="zip">Search by Zip</label>  
                          <button type="submit" class="btn btn-sm btn-primary">Zip search</button>                    
                          
                      </div>
                </form>

                  </div>



                <div class="col-md-1">
                  <div class="form-group">
                    <label for="zip">Reset</label>    
                  <a href="{{url()->current()}}" class="btn btn-sm btn-warning">Reset</a>
                  </div>
                </div>
                
              </div>

              @endif

              @if(DB::table('assignments_assign_to')->where('assignment_hash', request()->segment(4))->exists())

                <ul class="list-group list-group-flush">
                  @foreach(DB::table('assignments_assign_to')->where('assignment_hash', request()->segment(4))->get() as $list)
                  <li class="list-group-item">{{App\User::find($list->assign_to)->name.' '.App\User::find($list->assign_to)->last_name}}  

                  </li>
                  @endforeach
                </ul>

              @endif


              @if(request()->segment(5) !='completed' && !DB::table('assignments_assign_to')->where('assignment_hash', request()->segment(4))->exists())


              <form action="{{ route('staffs.assignment.assign', [request()->segment(3), request()->segment(4)]) }}" name="assign_staff" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                  <div class="col-md-8">
                    
                    <div class="form-group">
                      <select class="form-control" id="assignment_staff_selection" name="assign_to">
                        <option value="0">Select contractor from this dropdown</option>
                        @foreach($contractors as $contractor)
                          <option value="{{$contractor->id}}">{{$contractor->name.' '.$contractor->last_name}} - 
                            {{ $contractor->state }} - {{ $contractor->city }} - {{ $contractor->zip }} - {{ ucfirst($contractor->rating) }}
                          </option>
                        @endforeach
                      </select>
                    </div>

                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <input type="number" required class="form-control" name="paid_to_contractor" placeholder="Paid amount to contractor">
                    </div>
                  </div>
                </div>


                <div class="form-group">
                  <label for="assignmentStaffInstruction">Speacial Instruction for contractor</label>
                  <textarea class="form-control" id="assignmentStaffInstruction" name="special_instruction" rows="3"></textarea>
                </div>

                <hr/>

                <button type="submit" class="btn btn-primary btn-block">Assign contractor</button>
                <hr/>

              </form>
              @endif

            </div>
          </div>


            </div>
          </div>


        </div>






        <div class="col-md-4">




          <div class="card">
            <div class="card-header">
              Files
            </div>
            <div class="card-body">


              @foreach($files as $file)

                <div style="border: 1px solid #ccc;padding:10px;" class="mb-2">
                  <label>{{$file->message}}</label><br/>


                  
                    <!--Storage::download(storage_path().'/app/public/'.$file->file)-->

                  
                  <a href="#">Download File</a>
                </div>

              @endforeach

            </div>


            <div class="card-footer">
              


            <form action="{{ route('staffs.assignment.message.fileupload', [request()->segment(3), request()->segment(4), request()->segment(5)]) }}" name="assign_staff" method="post" enctype="multipart/form-data">

              @csrf
              <div class="form-group">
                <label for="fileTitle">File Title</label>
                <input type="text" class="form-control" id="fileTitle" aria-describedby="fileTitle" placeholder="Enter file name or title..." name="message" required>
              </div>

              <label>Upload file</label>
              <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" id="fileuploads" name="file" required>
                <label class="custom-file-label" for="fileuploads">Choose file...</label>
              </div>

              <input type="submit" name="submit" value="Upload" class="btn btn-sm btn-block btn-info">
            </form>

            </div>

          </div>

          <hr/>





              <div class="card">
                <div class="card-header">
                  Messages
                </div>
                <div class="card-body">
                  
                  <div style="height: 200px; overflow: scroll;">
                    @foreach($messages as $msg)
                      <p style="padding: 10px; border: 1px solid #ccc;"><b>{{ $msg->name }}: </b> {{$msg->message}} </p>
                    @endforeach
                  </div>
                 
                </div>
              
              @if(request()->segment(5) != 'completed')

                <form action="{{route('staffs.assignment.message.sent', [request()->segment(3), request()->segment(4), request()->segment(3)])}}" method="post">

                  <div class="card-footer">
                    <div class="row">
                      @csrf
                        <div class="col-md-9"><textarea class="form-control" rows="3" name="message"  required></textarea></div>
                        <div class="col-md-3"><input type="submit" name="submit" value="Send" class="btn btn-sm btn-block btn-success"></div>
                    </div>
                  </div>

                </form>
              @endif

              </div>





          <hr/>

          <div class="card">
            <div class="card-header">
              <h3>Mark assignment as done </h3>
            </div>

            <div class="card-body">
              
              <form name="scheduleFix" action="{{route('staff.assignment.complete', [request()->segment(3),request()->segment(4), request()->segment(5)])}}" method="post">
                @csrf
                

                <div class="form-group">
                  <label for="completeStatus">Select status</label>
                  <select class="form-control" id="completeStatus" name="assignment_complete_status">
                    <option value="1">Successfully completed</option>
                    <option value="2">Assignment Cancelled</option>
                  </select>
                </div>

               <div class="form-group">
                <label for="assignment_complete_comment">Your comment</label>
                <textarea class="form-control" id="assignment_complete_comment" name="assignment_complete_comment" rows="3"></textarea>
              </div>

                <br/>


                <input type="hidden" name="back" value="/{{request()->segment(1).'/'.request()->segment(2).'/'.request()->segment(3).'/'.request()->segment(4).'//completed?status=success&for=assignment_mark_as_completed'}}">
                <input type="submit" name="schedulefix" value="Complete Assignment" class="btn btn-success btn-md btn-block">
              </form>
            </div>
          </div>


          <hr/>






        </div>




    </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
<script>
$("#state").select2( {
    placeholder: "Select State",
    allowClear: true
    } );
$("#city").select2( {
    placeholder: "Select City",
    allowClear: true
    } );


jQuery(function($) {
    $('#state').on('change', function() {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    });
    $('#city').on('change', function() {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    });
});



</script>


@endsection
