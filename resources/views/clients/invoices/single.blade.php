@extends('layouts.admin')
@section('title', 'Single Invoice')
@section('css')

<style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>

@endsection
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __('Client Dashboard >  Invoice > Invoice Name') }}</h5>
    <hr/>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            



<div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://kelleysmobilenotary.com/wp-content/uploads/2019/02/logo-new01.png" style="width:100%; max-width:200px;padding-bottom:10px;padding-left:10px;background: #182738;">
                            </td>
                            
                            <td>
                                Invoice #: inv_{{$invoice->id}}<br>
                                Created: {{ date('M d, Y', strtotime($invoice->created_at))}}<br>
                                Due: {{ date('M d, Y', strtotime($invoice->due_date))}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Kelleys Mobile Notary<br>
                                info@kelleysmobilenotary.com<br>
                                877-237-7865
                            </td>
                            
                            <td>
                                {{App\User::find($invoice->invoice_to)->name}} {{App\User::find($invoice->invoice_to)->last_name}}<br>
                                {{App\User::find($invoice->invoice_to)->email}}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            

            
            <?php $getAssignmentData = new App\Http\Controllers\ClientController;?>

            <tr>
              <td><b>Completed By:</b> 

                @if($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'assigned_to'))
                  {{ App\User::find($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'assigned_to'))->name}}  {{ App\User::find($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'assigned_to'))->last_name}}  
                @else
                  N\A
                @endif
              </td>
              <td><b>Completed Date:</b>   

                {{ date('M d, Y', strtotime($getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'completed_date_time')))}}

                <br/>
                <b>Status: </b>
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
            </tr>
            <tr class="heading">
                <td>
                    Assignment Name
                </td>
                
                <td>
                    Price
                </td>
            </tr>
            
            <tr class="item">
                <td>
                    {{$getAssignmentData->getInvoiceData($invoice->assignment_type, $invoice->assignment_hash, 'assignment_title')}}                
                </td>
                
                <td>
                    ${{$invoice->invoice_amount}}
                </td>
            </tr>
            

            
            <tr class="total">
                <td></td>
                
                <td>
                   Total: ${{$invoice->invoice_amount}}
                </td>
            </tr>
        </table>
    </div>




        </div>
    </div>



@endsection
