@extends('layouts.admin')
@section('title', $data->assignment_title)
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __('Client Dashboard >  Process Server Assignment > ') }} {{ __($data->assignment_title) }}</h5>
    <hr/>

    <div class="card mb-4">
    	<div class="card-body" style="padding-bottom:0px;">
    		<h1 class="h3 mb-4 text-gray-800">{{ __($data->assignment_title) }}</h1>
    	</div>
    </div>

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
              <th>Assignment date</th>
              <th>Client Name</th>
              <th>Client Email</th>
              <th>Rush</th>
              <th>Number of Defendants</th>
              <th>Status</th>
            </tr>


              <tr>
                <td>{{$data->assignment_title}}</td>
                <td>
                  {{ date('M d, Y', strtotime($data->date_of_assignment)) }}
                </td>                
                
                <td>{{App\User::find($data->client_id)->name}}</td>
                <td>{{App\User::find($data->client_id)->email}}</td>
                <td>{{$data->select_rush}}</td>
                <td>{{$data->number_of_defendants}}</td>
                <td>
                  <?php
                    $abc = new App\Http\Controllers\ClientController;
                    echo $abc->getStatus($data->status);
                  ?>
                </td>
              </tr>

              <tr>
                <td colspan="7">
                  <b>Served Location : </b> {{$data->served_location}}
                </td>
              </tr>

          </table>

      </div>
      <div class="col-md-8">

          <table class="table table-bordered">
            <tr class="thead-light">
              <th>Defendant 1</th>
          		<th>Defendant 2</th>
          		<th>Download File</th>
          	</tr>

          	<tr>
              <td>
                {{$data->defendant_1}}
                <br/> <b> Phone: </b>{{ $data->telephone_number }} 
              </td>
              <td>
                {{$data->defendant_2}}
                <br/> <b> Phone: </b>{{ $data->telephone_number2 }} 
              </td>
              <td><a href="#">Download File</a></td>
          	</tr>

            <tr>
              <td colspan="3"></td>
            </tr>

          	<tr>
          		<td colspan="3">
          			<h4>Physical Description: </h4> <br/> {!! $data->physical_description !!}
          		</td>
            </tr>
            <tr>
              <td colspan="3"></td>
            </tr>
            <tr>
              <td colspan="3">
                <h4>Special Instruction (If any):</h4> <br/> {!! $data->special_instructions !!}
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

                <form action="{{route('client.assignment.message.sent', [request()->segment(3), request()->segment(4)])}}" method="post">

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

          @if(request()->segment(5) != 'completed')

            <div class="card-footer">
              
              <form action="{{ route('client.assignment.message.fileupload', [request()->segment(3), request()->segment(4)]) }}" name="assign_staff" method="post" enctype="multipart/form-data">

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
          @endif

          </div>
        </div>

    </div>


@endsection
