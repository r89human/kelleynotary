<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Laravel SB Admin 2">
    <meta name="author" content="Alejandro RH">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Kelleys  Notary </title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}" defer></script>


    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    @yield('css')

</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
            <!--<div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>-->
            <div class="sidebar-brand-text mx-3">Notary </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="/dashboard">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>




        <hr class="sidebar-divider">
    




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 5]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#adminMembers" aria-expanded="true" aria-controls="adminMembers">
              <i class="fas fa-fw fa-cog"></i>
              <span>Members</span>
            </a>
            <div id="adminMembers" class="collapse <?php if(request()->segment(2)== 'members'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'members' && request()->segment(3)== 'client'){echo 'active';}?>" 

                    href="{{route('admins.show.members', 'client')}}">     Clients 
                </a>

                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'members' && request()->segment(3)== 'staff'){echo 'active';}?>" 

                    href="{{route('admins.show.members', 'staff')}}">     Staffs 
                </a>


                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'members' && request()->segment(3)== 'mobilerotary'){echo 'active';}?>" 

                    href="{{route('admins.show.members', 'mobilerotary')}}">      Mobile Notaries 
                </a>


                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'members' && request()->segment(3)== 'processserver'){echo 'active';}?>" 

                    href="{{route('admins.show.members', 'processserver')}}">      Process Servers
                </a>


                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'members' && request()->segment(3)== 'admin'){echo 'active';}?>" 

                    href="{{route('admins.show.members', 'admin')}}">      Admins
                </a>



                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'member' && request()->segment(3)== 'new-member'){echo 'active';}?>" 

                    href="{{route('admins.new.memeber.view')}}">      Create new user
                </a>


              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 5]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#generalNAss" aria-expanded="true" aria-controls="generalNAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>General N. Assignments</span>
            </a>
            <div id="generalNAss" class="collapse <?php if(request()->segment(3)== 'general-notary'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'pending' || request()->segment(5)== 'pending') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('admins.assignment.general.view.all', 'pending')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('admins.assignment.general.view.all', 'assigned')}}">     Assigned 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('admins.assignment.general.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('admins.assignment.general.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 5]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#realStAss" aria-expanded="true" aria-controls="realStAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Real S. Assignments</span>
            </a>
            <div id="realStAss" class="collapse <?php if(request()->segment(3)== 'real-state-closing'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'pending' || request()->segment(5)== 'pending') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('admins.assignment.realstate.view.all', 'pending')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('admins.assignment.realstate.view.all', 'assigned')}}">     Assigned 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('admins.assignment.realstate.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('admins.assignment.realstate.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif





        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 5]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#TaxCloAss" aria-expanded="true" aria-controls="TaxCloAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Tax C. Assignments</span>
            </a>
            <div id="TaxCloAss" class="collapse <?php if(request()->segment(3)== 'tax-closing'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'pending' || request()->segment(5)=="pending") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('admins.assignment.taxclosing.view.all', 'pending')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)=="assigned") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('admins.assignment.taxclosing.view.all', 'assigned')}}">     Assigned 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)=="scheduled") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('admins.assignment.taxclosing.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)=="completed") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('admins.assignment.taxclosing.view.all', 'completed')}}">     Completed 
                </a>


              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 5]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#ProcessSAss" aria-expanded="true" aria-controls="ProcessSAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Process S. Assignments</span>
            </a>
            <div id="ProcessSAss" class="collapse <?php if(request()->segment(3)== 'process-server'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'pending' || request()->segment(5)== 'pending') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('admins.assignment.processserver.view.all', 'pending')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('admins.assignment.processserver.view.all', 'assigned')}}">     Assigned 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('admins.assignment.processserver.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('admins.assignment.processserver.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif



<!-- Staff Menu -->

        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 2]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#adminMembers" aria-expanded="true" aria-controls="adminMembers">
              <i class="fas fa-fw fa-cog"></i>
              <span>Members</span>
            </a>
            <div id="adminMembers" class="collapse <?php if(request()->segment(2)== 'members'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">



                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'members' && request()->segment(3)== 'mobilerotary'){echo 'active';}?>" 

                    href="{{route('staffs.show.members', 'mobilerotary')}}">      Mobile Notaries 
                </a>


                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'members' && request()->segment(3)== 'processserver'){echo 'active';}?>" 

                    href="{{route('staffs.show.members', 'processserver')}}">      Process Servers
                </a>



                <a class="collapse-item 
                    <?php if(request()->segment(2)== 'member' && request()->segment(3)== 'new-member'){echo 'active';}?>" 

                    href="{{route('staffs.new.memeber.view')}}">      Create new user
                </a>


              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 2]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#generalNAss" aria-expanded="true" aria-controls="generalNAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>General N. Assignments</span>
            </a>
            <div id="generalNAss" class="collapse <?php if(request()->segment(3)== 'general-notary'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'pending' || request()->segment(5)== 'pending') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.general.view.all', 'pending')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.general.view.all', 'assigned')}}">     Assigned 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.general.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.general.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 2]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#realStAss" aria-expanded="true" aria-controls="realStAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Real S. Assignments</span>
            </a>
            <div id="realStAss" class="collapse <?php if(request()->segment(3)== 'real-state-closing'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'pending' || request()->segment(5)== 'pending') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.realstate.view.all', 'pending')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.realstate.view.all', 'assigned')}}">     Assigned 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.realstate.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.realstate.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif





        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 2]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#TaxCloAss" aria-expanded="true" aria-controls="TaxCloAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Tax C. Assignments</span>
            </a>
            <div id="TaxCloAss" class="collapse <?php if(request()->segment(3)== 'tax-closing'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'pending' || request()->segment(5)=="pending") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.taxclosing.view.all', 'pending')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)=="assigned") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.taxclosing.view.all', 'assigned')}}">     Assigned 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)=="scheduled") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.taxclosing.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)=="completed") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.taxclosing.view.all', 'completed')}}">     Completed 
                </a>


              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 2]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#ProcessSAss" aria-expanded="true" aria-controls="ProcessSAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Process S. Assignments</span>
            </a>
            <div id="ProcessSAss" class="collapse <?php if(request()->segment(3)== 'process-server'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'pending' || request()->segment(5)== 'pending') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.processserver.view.all', 'pending')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.processserver.view.all', 'assigned')}}">     Assigned 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.processserver.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('staffs.assignment.processserver.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif







<!-- Staff menu end -->




<!--contractor menu-->




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 3]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="{{route('contractors.notary.zip.view')}}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Your Notary Area</span>
            </a>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 3]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#generalNAss" aria-expanded="true" aria-controls="generalNAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>General N. Assignments</span>
            </a>
            <div id="generalNAss" class="collapse <?php if(request()->segment(3)== 'general-notary'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.general.view.all', 'assigned')}}">     Pending 
                </a>

                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.general.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'general-notary'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.general.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 3]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#realStAss" aria-expanded="true" aria-controls="realStAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Real S. Assignments</span>
            </a>
            <div id="realStAss" class="collapse <?php if(request()->segment(3)== 'real-state-closing'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.realstate.view.all', 'assigned')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.realstate.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.realstate.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif





        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 3]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#TaxCloAss" aria-expanded="true" aria-controls="TaxCloAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Tax C. Assignments</span>
            </a>
            <div id="TaxCloAss" class="collapse <?php if(request()->segment(3)== 'tax-closing'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)=="assigned") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.taxclosing.view.all', 'assigned')}}">     Pending 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)=="scheduled") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.taxclosing.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)=="completed") && request()->segment(3)== 'tax-closing'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.taxclosing.view.all', 'completed')}}">     Completed 
                </a>


              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 4]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#ProcessSAss" aria-expanded="true" aria-controls="ProcessSAss">
              <i class="fas fa-fw fa-cog"></i>
              <span>Process S. Assignments</span>
            </a>
            <div id="ProcessSAss" class="collapse <?php if(request()->segment(3)== 'process-server'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
   
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'assigned' || request()->segment(5)== 'assigned') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.processserver.view.all', 'assigned')}}">     Pending 
                </a>

                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'scheduled' || request()->segment(5)== 'scheduled') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.processserver.view.all', 'scheduled')}}">     Scheduled 
                </a>
                <a class="collapse-item 
                    <?php if((request()->segment(4)== 'completed' || request()->segment(5)== 'completed') && request()->segment(3)== 'process-server'){echo 'active';}?>" 

                    href="{{route('contractors.assignment.processserver.view.all', 'completed')}}">     Completed 
                </a>

              </div>
            </div>
          </li>
        @endif





<!--contractor menu  end-->







        <!--Client Menu-->


        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 1]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#clitnAssignments" aria-expanded="true" aria-controls="clitnAssignments">
              <i class="fas fa-fw fa-cog"></i>
              <span>Create assignments</span>
            </a>
            <div id="clitnAssignments" class="collapse <?php if(request()->segment(2)== 'new-assignment'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php if(request()->segment(2)== 'new-assignment' && request()->segment(3)== 'general-notary'){echo 'active';}?>" href="{{route('client.assignment.general.view')}}">General Notary </a>
                <a class="collapse-item <?php if(request()->segment(2)== 'new-assignment' && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" href="{{route('client.assignment.realstate.view')}}">Real State Closing </a>
                <a class="collapse-item <?php if(request()->segment(2)== 'new-assignment' && request()->segment(3)== 'tax-closing'){echo 'active';}?>" href="{{route('client.assignment.taxclosing.view')}}">Tax Closing </a>
                <a class="collapse-item <?php if(request()->segment(2)== 'new-assignment' && request()->segment(3)== 'process-server'){echo 'active';}?>" href="{{route('client.assignment.processserver.view')}}">Process Server </a>
              </div>
            </div>
          </li>
        @endif



        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 1]])->exists() )
          <li class="nav-item">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#viewClitnAssignments" aria-expanded="true" aria-controls="viewClitnAssignments">
              <i class="fas fa-fw fa-cog"></i>
              <span>View assignments</span>
            </a>
            <div id="viewClitnAssignments" class="collapse <?php if(request()->segment(2)== 'view-assignment'){echo 'show';}?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item <?php if(request()->segment(2)== 'view-assignment' && request()->segment(3)== 'general-notary'){echo 'active';}?>" href="{{route('client.assignment.general.view.all')}}">View General Notary </a>
                <a class="collapse-item <?php if(request()->segment(2)== 'view-assignment' && request()->segment(3)== 'real-state-closing'){echo 'active';}?>" href="{{route('client.assignment.realstate.view.all')}}">View Real State Closing </a>
                <a class="collapse-item <?php if(request()->segment(2)== 'view-assignment' && request()->segment(3)== 'tax-closing'){echo 'active';}?>" href="{{route('client.assignment.taxclosing.view.all')}}">View Tax Closing </a>
                <a class="collapse-item <?php if(request()->segment(2)== 'view-assignment' && request()->segment(3)== 'process-server'){echo 'active';}?>" href="{{route('client.assignment.processserver.view.all')}}">View Process Server </a>
              </div>
            </div>
          </li>
        @endif




        @if(DB::table('roles_connect')->where([['user_id', Auth::id()], ['role_id', 1]])->exists() )
          <li class="nav-item <?php if(request()->segment(2)== 'invoices' ){echo 'active';}?>">
            <a class="nav-link" href="{{route('client.invoices.all')}}" >
              <i class="fas fa-fw fa-cog"></i>
              <span>Invoices</span>
            </a>
          </li>
        @endif



        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Settings') }}
        </div>

        <!-- Nav Item - Profile -->
        <li class="nav-item {{ Nav::isRoute('profile') }}">
            <a class="nav-link" href="{{ route('profile') }}">
                <i class="fas fa-fw fa-user"></i>
                <span>{{ __('Profile') }}</span>
            </a>
        </li>




        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->
               <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>-->

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <!--<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!- Counter - Alerts ->
                            <span class="badge badge-danger badge-counter">3+</span>
                        </a>-->
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                       <!-- <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!- Counter - Messages --
                            <span class="badge badge-danger badge-counter">7</span>
                        </a>-->
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div class="font-weight-bold">
                                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                                    <div class="small text-gray-500">Jae Chun · 1d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                                    <div class="status-indicator bg-warning"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                                    <div class="status-indicator bg-success"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            <figure class="img-profile rounded-circle avatar font-weight-bold" data-initial="{{ Auth::user()->name[0] }}"></figure>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Profile') }}
                            </a>
                            <a class="dropdown-item" href="/dashboard">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Dashboard') }}
                            </a>
                            <!--<a class="dropdown-item" href="javascript:void(0)">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Activity Log') }}
                            </a>-->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                @if(request()->status == 'success' || request()->status == 'sucess')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Congratulations!</strong> {{ucfirst(str_replace("_"," ",request()->for))}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                @endif



                @if(request()->status == 'failed')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Oops!</strong> {{ucfirst(str_replace("_"," ",request()->for))}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                @endif


                @yield('main-content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                <a class="btn btn-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>


    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>


<!-- Scripts -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @yield('js')

</body>
</html>
