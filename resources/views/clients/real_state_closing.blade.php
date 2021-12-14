@extends('layouts.admin')
@section('title', 'Create real state closing assignment')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Client Dashboard >  Real state closing assignment') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            

            <div class="card bg-light mb-3">
              <div class="card-header">Add new real state closing assignment</div>
              <div class="card-body">
               

              <form method="post" action="{{route('client.assignment.real_state_closing.create')}}" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label for="assignment_title">Assignement Title</label>
                    <input type="text" class="form-control" id="assignment_title" name="assignment_title" required>
                  </div>
                
                  <div class="row">
                    <div class="col-md-6">
                      <div class="input-group">
                          <label>Date of assignment</label>
                          <input type="text" class="form-control datepicker" name="date_of_assignment" required>
                          <div class="input-group-addon">
                              <span class="glyphicon glyphicon-th"></span>
                          </div>
                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="timeofassignment">Time of assignment</label>
                        <input type="text" class="form-control" id="timeofassignment" name="time_of_assignment">
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="selectClosingType">Select Closing type</label>
                        <select class="form-control" id="selectClosingType" name="select_closing_type">
                          <option value="buyers_closing">Buyers closing</option>
                          <option value="sellers_closing">Sellers closing</option>
                          <option value="commercial_closing">Commercial closing</option>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="howmanysigners">How many signers</label>
                        <input type="number" class="form-control" id="howmanysigners" name="number_of_signers" required>
                      </div>
                    </div>


                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="faxBacks">Fax backs</label>
                        <select class="form-control" id="faxBacks" name="fax_backs">
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                        </select>
                      </div>
                    </div>


                  </div>








                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="firstsigner">First signer name</label>
                        <input type="text" class="form-control" id="firstsigner" name="first_signers_name" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="secondsigner">Second signer name</label>
                        <input type="text" class="form-control" id="secondsigner" name="second_signers_name">
                      </div>
                    </div>
                  </div>



                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="telephonenumber">Telephone number 1</label>
                        <input type="text" class="form-control" id="telephonenumber" name="telephone_number" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="telephonenumber2">Telephone number 2</label>
                        <input type="text" class="form-control" id="telephonenumber2" name="telephone_number_2">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="telephonenumber">Company Name</label>
                        <input type="text" class="form-control" id="companyname" name="company_name" required>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="telephonenumber2">Fax Number</label>
                        <input type="text" class="form-control" id="faxnumber" name="fax_number">
                      </div>
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                  </div>

                  <div class="row">

                    <div class="col-md-7">
                      <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" required>
                      </div>
                    </div>


                  </div>


                   <div class="form-group">
                      <label for="specialinstructions">Special Instructions</label>
                      <textarea class="form-control" id="specialinstructions" rows="6" name="special_instructions"></textarea>
                    </div>


                  <label>Upload document</label>
                  <div class="custom-file mb-3">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" name="file">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>




              </div>
            </div>

        </div>
    </div>



@endsection
