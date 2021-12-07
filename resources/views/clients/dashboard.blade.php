@extends('layouts.admin')
@section('title', 'Client Dashboard')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Client Dashboard') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">



        <div class="col-md-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Create new assignment</h6>
                </div>
                <div class="card-body">

                        
                  <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="/client/new-assignment/general-notary">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    General Notary Request
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="/client/new-assignment/real-state-closing">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real State Closing Request
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="/client/new-assignment/tax-closing">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                    Tax Closing Request
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="/client/new-assignment/process-server">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    Process Server Request
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
                    <h6 class="m-0 font-weight-bold text-primary">View Submitted Assignments</h6>
                </div>
                <div class="card-body">

                        
                  <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="/client/view-assignment/general-notary">
                            <div class="card bg-primary text-white shadow">
                                <div class="card-body">
                                    All General Notary Requests
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="/client/view-assignment/real-state-closing">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    All Real State Closing Requests
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="/client/view-assignment/tax-closing">
                            <div class="card bg-info text-white shadow">
                                <div class="card-body">
                                   All Tax Closing Requests
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mb-4">
                        <a href="/client/view-assignment/process-server">
                            <div class="card bg-secondary text-white shadow">
                                <div class="card-body">
                                    All Process Server Requests
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
