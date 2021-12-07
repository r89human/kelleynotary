@extends('layouts.admin')
@section('title', 'All process server assignments')
@section('main-content')

    <!-- Page Heading -->
    <h5 class="mb-4 text-gray-800">{{ __('Client Dashboard >  All process server assignments') }}</h5>
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
              <th>Assignment date</th>
              <th>Client Name</th>
              <th>Client Email</th>
              <th>Rush</th>
              <th>Number of Defendants</th>
              <th>Status</th>
              <th>Options</th>
            </tr>

            @foreach($datas as $data)

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

                <td>
                  <a href="{{route('client.assignment.process_server.view.hash', $data->hash)}}" class="btn btn-link">View</a> | &nbsp;
                  <a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('client.assignment.processserver.view.all')}}?do=delete&for={{$data->hash}}" style="color: red;">Delete</a>
                </td>
              </tr>

            @endforeach
          </table>

        </div>
    </div>



@endsection
