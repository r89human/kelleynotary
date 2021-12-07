@extends('layouts.admin')
@section('title', 'Contractor Dashboard')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Contractor Dashboard') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">



    @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 3]])->exists())

        <div class="col-md-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Pending Assignment Requests</h4>
                </div>
                <div class="card-body">

                        
                  <div class="row">
                    <div class="col-md-4 mb-4">
                        <a href="{{route('contractors.assignment.general.view.all', 'assigned')}}">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    General Notary Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('general_notary_assignments')->where([['status', 2], ['assigned_to', Auth::id()]])->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="{{route('contractors.assignment.realstate.view.all', 'assigned')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real State Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('real_state_closings')->where([['status', 2], ['assigned_to', Auth::id()]])->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="{{route('contractors.assignment.taxclosing.view.all', 'assigned')}}">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Tax Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('tax_closing_assignments')->where([['status', 2], ['assigned_to', Auth::id()]])->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                  </div>


            </div>

        </div>

    </div>










        <div class="col-md-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Scheduled Assignment Requests</h4>
                </div>
                <div class="card-body">

                        
                  <div class="row">
                    <div class="col-md-4 mb-4">
                        <a href="{{route('contractors.assignment.general.view.all', 'scheduled')}}">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    General Notary Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('general_notary_assignments')->where([['status', 3], ['assigned_to', Auth::id()]])->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="{{route('contractors.assignment.realstate.view.all', 'scheduled')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real State Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('real_state_closings')->where([['status', 3], ['assigned_to', Auth::id()]])->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="{{route('contractors.assignment.taxclosing.view.all', 'scheduled')}}">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Tax Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('tax_closing_assignments')->where([['status', 3], ['assigned_to', Auth::id()]])->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                  </div>


            </div>

        </div>

    </div>

@endif




    @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 4]])->exists())

        <div class="col-md-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Assignment Requests</h4>
                </div>
                <div class="card-body">

                        
                  <div class="row">






                    <div class="col-md-6 mb-4">
                        <a href="{{route('contractors.assignment.processserver.view.all', 'assigned')}}">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Pending Process Server Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('process_server_assignments')->where([['status', 2], ['assigned_to', Auth::id()]])->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>

                        <div class="col-md-6 mb-4">
                        <a href="{{route('contractors.assignment.processserver.view.all', 'scheduled')}}">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    Upcoming Scheduled Process Server Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('process_server_assignments')->where([['status', 3], ['assigned_to', Auth::id()]])->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>





                  </div>


            </div>

        </div>

    </div>




@endif


</div>




@endsection
