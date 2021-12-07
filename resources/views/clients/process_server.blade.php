@extends('layouts.admin')
@section('title', 'Create process server assignment')
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Client Dashboard >  Process server ') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            

            <div class="card bg-light mb-3">
              <div class="card-header">Add new Process server</div>
              <div class="card-body">
               

              <form method="post" action="{{route('client.assignment.process_server.create')}}" enctype="multipart/form-data">
                @csrf
                  <div class="form-group">
                    <label for="assignment_title">Assignement Title</label>
                    <input type="text" class="form-control" id="assignment_title" name="assignment_title" required>
                  </div>

                  <div class="input-group">
                      <label>Deadline</label>
                      <input type="text" class="form-control datepicker" name="date_of_assignment" required>
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                  
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="selectClosingType">Rush</label>
                        <select class="form-control" id="selectClosingType" name="select_rush">
                          <option value="yes">Yes</option>
                          <option value="no">No</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="numberofdefendants">Number of Defendants</label>
                        <input type="text" class="form-control" id="numberofdefendants" name="number_of_defendants" required>
                      </div>
                    </div>

                  </div>


                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="defendant1">Defendant 1 Name</label>
                        <input type="text" class="form-control" id="defendant1" name="defendant_1" required>
                      </div>
                    </div>  

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="defendant2">Defendant 2 Name</label>
                        <input type="text" class="form-control" id="defendant2" name="defendant_2">
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
                        <input type="text" class="form-control" id="telephonenumber2" name="telephone_number2" required>
                      </div>
                    </div>
                  </div>

                  
                 <div class="form-group">
                    <label for="physicalDescription">Physical Description</label>
                    <textarea class="form-control" id="physicalDescription" rows="6" name="physical_description" required></textarea>
                  </div>



                  <div class="form-group">
                    <label for="served_location">Location to be served</label>
                    <input type="text" class="form-control" id="served_location" name="served_location" required>
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
