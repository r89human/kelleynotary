@extends('layouts.admin')
@section('title', 'Invoices')
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __('Client Dashboard >  Invoices') }}</h5>
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
              <th>Assignment Date</th>
              <th>Completed Date</th>
              <th>Amount</th>
              <th>Status</th>
              <th>Options</th>
            </tr>

            <?php $getAssignmentData = new App\Http\Controllers\ClientController;?>
            @foreach($invoices as $invoice)

              <tr>
                <td>{{$getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'assignment_title')}}</td>
                <td>
                  {{ date('M d, Y', strtotime($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'date_of_assignment')))}}
                </td>
                <td>
                  {{ date('M d, Y', strtotime($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'completed_date_time')))}}
                </td>
                <td>${{$invoice->invoice_amount}}</td>

                <td>

                    @if($invoice->status == 0)
                        <span class="text-danger">
                            {{$getAssignmentData->getInvoiceStatus($invoice->status)}}
                        </span>
                    @elseif($invoice->status == 1)
                        <span class="text-success">
                            {{$getAssignmentData->getInvoiceStatus($invoice->status)}}
                        </span>
                    @else
                        <span class="text-warning">
                            {{$getAssignmentData->getInvoiceStatus($invoice->status)}}
                        </span>
                    @endif
                </td>

                <td>
                  <a href="{{route('client.invoices.single', $invoice->invoice_hash)}}" class="btn btn-link">View</a>
                </td>
              </tr>

            @endforeach
          </table>

        </div>
    </div>



@endsection
