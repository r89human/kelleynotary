@extends('layouts.admin')
@section('title', $data->assignment_title)
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __('Client Dashboard >  Real State Assignment > ') }} {{ __($data->assignment_title) }}</h5>
    <hr/>

    <div class="card mb-4">
    	<div class="card-body" style="padding-bottom:0px;">
    		<h1 class="h3 mb-4 text-gray-800">{{ __($data->assignment_title) }}
          @if(request()->segment(5) == 'scheduled' && $data->schedule_date != null) 
            <span class="float-right badge badge-secondary">Schedule Time: {{$data->schedule_time}}</span>
            <span class="float-right badge badge-primary" style="margin-right: 10px;">Schedule Date: {{date('d M, Y', strtotime($data->schedule_date))}}</span>
          @endif
        </h1>
    	</div>
    </div>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">


      <div class="col-md-12">
        
          <table class="table table-bordered">
            <tr class="thead-light">
              <th>Assignment Title</th>
              <th>Assignment <br/> Date & Time</th>
              <th>Client Name</th>
              <th>Client Email</th>
              <th>Closing Type</th>
              <th>Fax Backs</th>
              <th>City</th>
              <th>State</th>
              <th>Zip</th>
              <th>Status</th>
            </tr>


              <tr>
                <td>{{$data->assignment_title}}</td>
                <td>
                  {{ date('M d, Y', strtotime($data->date_of_assignment)) }} @ {{ date('h:i:sa', strtotime($data->time_of_assignment)) }}
                </td>                
                
                <td>{{App\User::find($data->client_id)->name}}</td>
                <td>{{App\User::find($data->client_id)->email}}</td>
                <td>{{$data->select_closing_type}}</td>
                <td>{{$data->fax_backs}}</td>
                <td>{{$data->city}}</td>
                <td>{{$data->state}}</td>
                <td>{{$data->zip}}</td>
                <td>
                  <?php
                    $abc = new App\Http\Controllers\StaffController;
                    echo $abc->getStatus($data->status);
                  ?>
                </td>
              </tr>

          </table>

        
      </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-8 col-md-8 mb-4">
            

          <table class="table table-bordered">
            <tr class="thead-light">
          		<th>Number of Signers</th>
          		<th>First Signer</th>
              <th>Second Signer</th>
              <th>Telephone Number 1</th>
          		<th>Telephone Number 2</th>
          		<th>Download File</th>
          	</tr>

          	<tr>
          		<td>{{$data->number_of_signers}}</td>
          		<td>{{$data->first_signers_name}}</td>
              <td>{{$data->second_signers_name}}</td>
              <td>{{$data->telephone_number}}</td>
          		<td>{{$data->telephone_number_2}}</td>
          		<td><a href="#">Download File</a></td>
          	</tr>

          	<tr>
          		<td colspan="6">
          			<b>Special Instructions (If any): </b> {!! $data->special_instructions !!}
          		</td>
          	</tr>
          </table>





          <div class="row">
            <div class="col-md-12">



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

                <form action="{{route('contractors.assignment.message.sent', [request()->segment(3), request()->segment(4), request()->segment(3)])}}" method="post">

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






            </div>

          </div>

        </div>







        <div class="col-md-4">



          @if(request()->segment(5)=='scheduled' || request()->segment(5)=='assigned')
          <div class="card">
            <div class="card-header">
              <h3>Confirm schedule time </h3>
            </div>

            <div class="card-body">
              
              <form name="scheduleFix" action="{{route('contractors.schedule.store', [request()->segment(3),request()->segment(4), request()->segment(5)])}}" method="post">
                @csrf
                <div class="input-group">
                    <label>Date of assignment</label>
                    <input type="text" class="form-control datepicker" name="schedule_date" value="{{$data->schedule_date}}" required>
                    <div class="input-group-addon">
                        <span class="glyphicon glyphicon-th"></span>
                    </div>
                </div>


                <div class="form-group">
                  <label for="timeofassignment">Time of assignment</label>
                  <input type="text" class="form-control" id="timeofassignment" name="schedule_time" placeholder="e.g 01:00 PM or 13:00" required value="{{$data->schedule_time}}">
                </div>

                <br/>

                <input type="submit" name="schedulefix" value="<?php if(request()->segment(5) == 'scheduled'){echo 'Update Schedule';}else{echo 'Confirm Schedule';}?>" class="btn btn-info btn-md btn-block">
              </form>
            </div>
          </div>


          <hr/>

          @endif


          @if(request()->segment(5) == 'completed')

          <div class="card">
            <div class="card-header">
              <h2 class="text-center text-primary">Assignment Completed </h2>
              <center>
                <p><b>Data & Time: </b>{{$data->completed_date_time}}</p>
                
                <p>
                  <?php 
                    if($data->assignment_complete_status == 1){
                      echo "<b>Status :</b> Successfully Completed";
                    }else{
                      echo "<b>Status :</b> Assignment Cancelled";
                    }
                  ?>
                </p>

                <p>
                  <b>Completed Note: </b> {{$data->assignment_complete_comment}}
                </p>

              </center>
            </div>
          </div>
          <hr/>
          @endif



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
              
          @if(request()->segment(5) != 'completed')


            <form action="{{ route('contractors.assignment.message.fileupload', [request()->segment(3), request()->segment(4), request()->segment(5)]) }}" name="assign_staff" method="post" enctype="multipart/form-data">

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
          @endif

            </div>

          </div>

          <hr/>

          <div class="card">
            <div class="card-header">
              Assign to
            </div>
            <div class="card-body">


              @if(DB::table('assignments_assign_to')->where('assignment_hash', request()->segment(4))->exists())

                <ul class="list-group list-group-flush">
                  @foreach(DB::table('assignments_assign_to')->where('assignment_hash', request()->segment(4))->get() as $list)
                  <li class="list-group-item">{{App\User::find($list->assign_to)->name.' '.App\User::find($list->assign_to)->last_name}}  

                  </li>
                  @endforeach
                </ul>

              @endif



            </div>
          </div>




          @if(request()->segment(5) == 'scheduled')
          <hr/>

          <div class="card">
            <div class="card-header">
              <h3>Mark assignment as done </h3>
            </div>

            <div class="card-body">
              
              <form name="scheduleFix" action="{{route('contractors.assignment.complete', [request()->segment(3),request()->segment(4), request()->segment(5)])}}" method="post">
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
          @endif


        </div>





    </div>



@endsection
