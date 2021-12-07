@extends('layouts.admin')
@section('title', 'Staff Dashboard')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Staff Dashboard') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">




        <div class="col-md-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Pending Assignment Requests</h4>
                </div>
                <div class="card-body">

                        
                  <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.general.view.all', 'pending')}}">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    General Notary Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('general_notary_assignments')->where('status', 0)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.realstate.view.all', 'pending')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real State Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('real_state_closings')->where('status', 0)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.taxclosing.view.all', 'pending')}}">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Tax Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('tax_closing_assignments')->where('status', 0)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.processserver.view.all', 'pending')}}">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Process Server Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('process_server_assignments')->where('status', 0)->count()
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
                    <h4 class="m-0 font-weight-bold text-primary">Assigned Assignment Requests</h4>
                </div>
                <div class="card-body">

                        
                  <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.general.view.all', 'assigned')}}">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    General Notary Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('general_notary_assignments')->where('status', 2)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.realstate.view.all', 'assigned')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real State Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('real_state_closings')->where('status', 2)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.taxclosing.view.all', 'assigned')}}">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Tax Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('tax_closing_assignments')->where('status', 2)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.processserver.view.all', 'assigned')}}">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Process Server Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('process_server_assignments')->where('status', 2)->count()
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
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.general.view.all', 'scheduled')}}">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    General Notary Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('general_notary_assignments')->where('status', 3)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.realstate.view.all', 'scheduled')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real State Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('real_state_closings')->where('status', 3)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.taxclosing.view.all', 'scheduled')}}">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Tax Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('tax_closing_assignments')->where('status', 3)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.processserver.view.all', 'scheduled')}}">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Process Server Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('process_server_assignments')->where('status', 3)->count()
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
                    <h4 class="m-0 font-weight-bold text-primary">Completed Assignment Requests</h4>
                </div>
                <div class="card-body">

                        
                  <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.general.view.all', 'completed')}}">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    General Notary Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('general_notary_assignments')->where('status', 4)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.realstate.view.all', 'completed')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real State Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('real_state_closings')->where('status', 4)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.taxclosing.view.all', 'completed')}}">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Tax Closing Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('tax_closing_assignments')->where('status', 4)->count()
                                        }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="{{route('staffs.assignment.processserver.view.all', 'completed')}}">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Process Server Request 
                                    &nbsp;&nbsp;&nbsp;&nbsp;<span class="badge badge-light">
                                        {{
                                            DB::table('process_server_assignments')->where('status', 4)->count()
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







    </div>


@endsection
