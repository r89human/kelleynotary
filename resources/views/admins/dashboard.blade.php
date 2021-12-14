@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Admin Dashboard') }}
        <small class="float-right">

            <!--<select class="form-control">
              <option>May - 2021</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>-->

        </small>
    </h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <hr/>
        <h3 class="text-center">Graph Data For - <?= date('M') ?></h3>
    <hr/>

    <center>
            
        <?php 

            # General Notary
            $gn_pending = (Helper::get_specifi_table_data('general_notary_assignments', [[ 'status', 0 ]])->count());

            $gn_assigned = (Helper::get_specifi_table_data('general_notary_assignments', [[ 'status', 2 ]])->count());

            $gn_scheduled = (Helper::get_specifi_table_data('general_notary_assignments', [[ 'status', 3 ]])->count());

            $gn_completed = (Helper::get_specifi_table_data('general_notary_assignments', [[ 'status', 4 ]])->count());

            # Real Estate CLosing  
            $rec_pending = (Helper::get_specifi_table_data('real_state_closings', [[ 'status', 0 ]])->count());

            $rec_assigned = (Helper::get_specifi_table_data('real_state_closings', [[ 'status', 2 ]])->count());

            $rec_scheduled = (Helper::get_specifi_table_data('real_state_closings', [[ 'status', 3 ]])->count());

            $rec_completed = (Helper::get_specifi_table_data('real_state_closings', [[ 'status', 4 ]])->count());


            # Tax Closing  
            $tax_c_pending = (Helper::get_specifi_table_data('tax_closing_assignments', [[ 'status', 0 ]])->count());

            $tax_c_assigned = (Helper::get_specifi_table_data('tax_closing_assignments', [[ 'status', 2 ]])->count());

            $tax_c_scheduled = (Helper::get_specifi_table_data('tax_closing_assignments', [[ 'status', 3 ]])->count());

            $tax_c_completed = (Helper::get_specifi_table_data('tax_closing_assignments', [[ 'status', 4 ]])->count());




            # Process server   
            $pro_ser_pending = (Helper::get_specifi_table_data('process_server_assignments', [[ 'status', 0 ]])->count());

            $pro_ser_assigned = (Helper::get_specifi_table_data('process_server_assignments', [[ 'status', 2 ]])->count());

            $pro_ser_scheduled = (Helper::get_specifi_table_data('process_server_assignments', [[ 'status', 3 ]])->count());

            $pro_ser_completed = (Helper::get_specifi_table_data('process_server_assignments', [[ 'status', 4 ]])->count());


            
            $total_pending   = $gn_pending +$rec_pending +$tax_c_pending +$pro_ser_pending;
            $total_assigned  = $gn_assigned+$rec_assigned+$tax_c_assigned+$pro_ser_assigned;
            $total_scheduled = $gn_scheduled+ $rec_scheduled+ $tax_c_scheduled+ $pro_ser_scheduled;
            $total_completed = $gn_completed+ $rec_completed+ $tax_c_completed+ $pro_ser_completed;


            //$final_list_count = $total_pending.", ".$total_assigned.", ".$total_scheduled.", ".$total_completed;



   
?>


    </center>

    <div class="row mb-4">

        <div class="col-md-6">
            <canvas id="oilChart" width="600" height="400"></canvas>

        </div>


        <div class="col-md-6">
            <canvas id="monthlyIncome" width="600" height="400"></canvas>

        </div>


    </div>



<hr/>



    <div class="row mt-4 mb-4">
        <div class="col-md-3">
            
            <a href="{{ route('admins.assignment.all_by_type', 'pending') }}" class="btn btn-lg btn-block btn-primary" style="border-radius: 0px;padding:20px 10px;"><i class="float-left fa fa-folder"></i>Pending <span class="badge badge-light float-right"><?= $total_pending; ?></span></a>


        </div>
        <div class="col-md-3">
            
            <a href="{{ route('admins.assignment.all_by_type', 'assigned') }}" class="btn btn-lg btn-block btn-info" style="border-radius: 0px;padding:20px 10px;"><i class="float-left fa fa-calendar-times"></i>Assigned <span class="badge badge-light float-right"><?= $total_assigned; ?></span></a>


        </div>


        <div class="col-md-3">
            
            <a href="{{ route('admins.assignment.all_by_type', 'scheduled') }}" class="btn btn-lg btn-block btn-secondary" style="border-radius: 0px;padding:20px 10px;"><i class="float-left fa fa-border-all"></i>  Scheduled  <span class="badge badge-light float-right"><?= $total_scheduled; ?></span></a>


        </div>
        <div class="col-md-3">
            
            <a href="{{ route('admins.assignment.all_by_type', 'completed') }}" class="btn btn-lg btn-block btn-success" style="border-radius: 0px;padding:20px 10px;"><i class="float-left fa fa-calendar-day"></i>  Completed <span class="badge badge-light float-right"><?= $total_completed; ?></span></a>


        </div>
    </div>


<hr/>

    <div class="row mt-2">

        <div class="col-md-2">
            

            
            <a href="{{ route('admins.show.member.allinvoices', 'paid') }}" class="btn btn-lg btn-block btn-success" style="border-radius: 0px; padding:20px 10px;"><i class="float-left fa fa-folder"></i>Earnings <span class="badge badge-light float-right"><?= DB::table('invoices')->where('status', 1)->count(); ?></span></a>


            
            <a href="{{ route('admins.show.member.allinvoices', 'pending') }}" class="btn btn-lg btn-block btn-warning" style="border-radius: 0px; padding:20px 10px;"><i class="float-left fa fa-calendar-times"></i>Pending <span class="badge badge-light float-right"><?= DB::table('invoices')->where('status', 0)->count(); ?></span></a>







        </div>
        <div class="col-md-10">



            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-info">Last 5 Invoices </h4>
                </div>
                <div class="card-body">

                        

                <table class="table table-bordered">
                    <tbody><tr class="thead-light">
                      <th>Assignment Title</th>
                      <th>Client</th>
                      <th>Assignment Date</th>
                      <th>Completed Date</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Options</th>
                    </tr>
                    <?php $getAssignmentData = new App\Http\Controllers\ClientController;?>

                    @foreach(DB::table('invoices')->orderBy('id','DESC')->limit(5)->get() as $invoice)    
                    <tr>
                        <td>{{$getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'assignment_title')}}</td>
                        <td>
                            <a href="{{ route('admins.show.member.invoices', ['client', $invoice->invoice_to]) }}">
                            @if(App\User::find($invoice->invoice_to)){{ App\User::find($invoice->invoice_to)->name}} @endif
                            </a>
                        </td>
                        <td>
                          {{ date('M d, Y', strtotime($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'date_of_assignment')))}}
                        </td>
                        <td>
                          {{ date('M d, Y', strtotime($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'completed_date_time')))}}
                        </td>
                        <td>${{$invoice->invoice_amount}}</td>

                        <td>{{$getAssignmentData->getInvoiceStatus($invoice->status)}}</td>

                        <td>
                          <a href="{{ route('admins.show.member.singleinvoices', $invoice->id) }}" class="btn btn-link">View</a>
                        </td>
                    </tr>
                    @endforeach



                      </tbody>
                  </table>







                </div>



        </div>


    </div>




    <div class="row">

        <div class="col-md-12">

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary">Pending Assignment Requests</h4>
                </div>
                <div class="card-body">

                        
                  <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="{{route('admins.assignment.general.view.all', 'pending')}}">
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
                        <a href="{{route('admins.assignment.realstate.view.all', 'pending')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real Estate Closing Request 
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
                        <a href="{{route('admins.assignment.taxclosing.view.all', 'pending')}}">
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
                        <a href="{{route('admins.assignment.processserver.view.all', 'pending')}}">
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
                        <a href="{{route('admins.assignment.general.view.all', 'assigned')}}">
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
                        <a href="{{route('admins.assignment.realstate.view.all', 'assigned')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real Estate Closing Request 
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
                        <a href="{{route('admins.assignment.taxclosing.view.all', 'assigned')}}">
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
                        <a href="{{route('admins.assignment.processserver.view.all', 'assigned')}}">
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
                        <a href="{{route('admins.assignment.general.view.all', 'scheduled')}}">
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
                        <a href="{{route('admins.assignment.realstate.view.all', 'scheduled')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real Estate Closing Request 
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
                        <a href="{{route('admins.assignment.taxclosing.view.all', 'scheduled')}}">
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
                        <a href="{{route('admins.assignment.processserver.view.all', 'scheduled')}}">
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
                        <a href="{{route('admins.assignment.general.view.all', 'completed')}}">
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
                        <a href="{{route('admins.assignment.realstate.view.all', 'completed')}}">
                            <div class="card bg-success text-white shadow">
                                <div class="card-body">
                                    Real Estate Closing Request 
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
                        <a href="{{route('admins.assignment.taxclosing.view.all', 'completed')}}">
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
                        <a href="{{route('admins.assignment.processserver.view.all', 'completed')}}">
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



<?php 






?>

@endsection


<?php 



    $pendingInvoices = DB::table('invoices')
                      ->select('logged_month','status',DB::raw('SUM(invoice_amount) as invoice_amount') )
                      ->where([['status', '!=', 2], ['logged_month', 'May']])
                      ->groupBy('logged_month', 'status')
                      ->get();





    $final_data = [];
    foreach($pendingInvoices as $totalAmt):
        $paid_amount = 0;
        $pending_amount = 0;


        $final_data[$totalAmt->logged_month]['month'] = $totalAmt->logged_month; 

        if($totalAmt->status == 1){
            $paid_amount += $totalAmt->invoice_amount;
            $final_data[$totalAmt->logged_month]['paid'] = $paid_amount; 

        }
        if($totalAmt->status == 0){
            $pending_amount += $totalAmt->invoice_amount;
            $final_data[$totalAmt->logged_month]['pending'] = $pending_amount;


        }
    endforeach; 

        
    $final_earning_graph_data = '';
    $final_only_earing = '';
    $final_only_pending_earning = '';
    foreach($final_data as $single_data):

        $set_month = $single_data['month'];
        $set_paid = isset($single_data['paid'])?$single_data['paid']:'0';
        $set_pending = isset($single_data['pending'])?$single_data['pending']:'0';

        $final_earning_graph_data = $set_paid.", ".$set_pending.",";
        $final_only_earing = $set_paid;
        $final_only_pending_earning = $set_pending;


    endforeach;

?>



@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
   



    <script>



        var oilCanvas = document.getElementById("oilChart");

        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 16;

        var oilData = {
            labels: [
                "<?= $total_pending;   ?> Pending",
                "<?= $total_assigned;  ?> Assigned",
                "<?= $total_scheduled; ?> Scheduled",
                "<?= $total_completed; ?> Completed",
            ],
            datasets: [
                {
                    data: [<?= $total_pending;   ?>, <?= $total_assigned;  ?>, <?= $total_scheduled; ?>, <?= $total_completed; ?>],
                    backgroundColor: [
                        "#FF6384",
                        "#ffcd56",
                        "#ff9f41",
                        "#4ac0c0",
                    ]
                }]
        };

        var pieChart = new Chart(oilCanvas, {
          type: 'bar',
          data: oilData,
          options: {
                      legend: { display: false },
                      title: {
                        display: true,
                        text: 'Assignments'
                      }
                    }
        });


    </script>





    <script>


        var monthlyIncome = document.getElementById("monthlyIncome");

        Chart.defaults.global.defaultFontFamily = "Lato";
        Chart.defaults.global.defaultFontSize = 18;

        var monthlyIncomeData = {
            labels: [
                "$<?= $final_only_earing; ?> Earned",
                "$<?= $final_only_pending_earning; ?> Outstanding",
            ],
            datasets: [
                {
                    data: [ <?= $final_earning_graph_data; ?> ],
                    backgroundColor: [
                        "#FF6384",
                        "#ffcd56",
                    ]
                }]
        };

        var pieChart = new Chart(monthlyIncome, {
          type: 'bar',
          data: monthlyIncomeData,
          options: {
                      legend: { display: false },
                      title: {
                        display: true,
                        text: 'Monnthly Income'
                      }
                    }
        });


    </script>







@endsection




