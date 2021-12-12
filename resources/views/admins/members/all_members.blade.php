@extends('layouts.admin')
@section('title', 'Members')
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __(ucfirst(request()->segment(1)).' Dashboard >  '.ucfirst(request()->segment(3))) }}</h5>
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
           <thead>
            <tr class="thead-light">
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Members Status</th>
              <th>Actions</th>

              @if(request()->segment(3) == 'mobilerotary' || request()->segment(3) == 'processserver')

                <th>Action</th>

              @endif


            </tr>
            </thead>
            <tbody>

            @foreach($members as $member)

              <tr>
                <td>{{$member->name}}</td>
                <td>{{$member->last_name}}</td>
                <td>{{$member->email}}</td>
                <td>N\A</td>
                <td>
                  <?php
                    $abc = new App\Http\Controllers\AdminController;
                    if($abc->getMemberRole($member->role_id) == 'mobilerotary'){
                        echo 'Mobile Notary';
                    }else{
                        echo ucfirst($abc->getMemberRole($member->role_id));
                    }
                  ?>
                </td>
                <td>

                  {{
                    ucfirst($abc->getMemberStatus($member->status)) 
                  }}

                </td>
                <td>
                    @if($member->status == 0)
                     <a onclick="return confirm('Are you sure you want to active this user account status?');" href="/admin/members/{{request()->segment(3)}}?uid={{$member->id}}&do=1" class="btn btn-link" style="color:green">Active now</a>
                    @elseif($member->status == 1)
                     <a onclick="return confirm('Are you sure you want to inactive this user account status?');" href="/admin/members/{{request()->segment(3)}}?uid={{$member->id}}&do=0" class="btn btn-link" style="color:red">Inactive now</a>
                    @endif

                    @if(request()->segment(3) == 'client')
                        <a href="{{ route('admin.assignment.details.by.cllientid', $member->id) }}">View Profile</a>

                        <a href="{{route('admins.show.member.invoices', ['client', $member->id])}}" class="btn btn-link">Invoices</a>

                    @endif


                    @if(request()->segment(3) != 'client')


                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#viewProfile{{$member->id}}">
                          View Profile
                        </button>




                        <!-- Modal -->
                        <div class="modal fade" id="viewProfile{{$member->id}}" tabindex="-1" role="dialog" aria-labelledby="viewProfile{{$member->id}}Label" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="viewProfile{{$member->id}}Label">{{ $member->name }} {{ $member->last_name }} details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                
   
                                @if(request()->segment(3) == 'client')

                                  <table class="table table-striped table-bordered">
                                      <tr>
                                        <th scope="col">Name of Company</th>
                                        <td>{{ $member->company_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">First Name</th>
                                        <td>{{ $member->contact_first_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Last Name</th>
                                        <td>{{ $member->contact_last_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Email address</th>
                                        <td>{{ $member->contact_email_address }}</td>
                                      </tr>

                                      <tr>
                                        <th scope="col">Login Email address</th>
                                        <td>{{ $member->email }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Telephone Number</th>
                                        <td>{{ $member->contact_telephone_number }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Fax Number</th>
                                        <td>{{ $member->contact_fax_number }}</td>
                                      </tr>

                                      <tr>

                                        <th scope="col">Mailing Address</th>
                                        <td>{{ $member->contact_mailing_address }}</td>

                                      </tr>

                                  </table>
                              @elseif(request()->segment(3) == 'staff')

                                  <table class="table table-striped table-bordered">

                                      <tr>
                                        <th scope="col">First Name</th>
                                        <td>{{ $member->contact_first_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Last Name</th>
                                        <td>{{ $member->contact_last_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Email address</th>
                                        <td>{{ $member->contact_email_address }}</td>
                                      </tr>

                                      <tr>
                                        <th scope="col">Login Email address</th>
                                        <td>{{ $member->email }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Direct Telephone Number</th>
                                        <td>{{ $member->contact_telephone_number }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Fax Number</th>
                                        <td>{{ $member->contact_fax_number }}</td>
                                      </tr>

                                  </table>

                              @elseif(request()->segment(3) == 'mobilerotary')
                                  <table class="table table-striped table-bordered">

                                      <tr>
                                        <th scope="col">Check Payable To</th>
                                        <td>{{ $member->cheque_payable_to }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Name of Company</th>
                                        <td>{{ $member->company_name }}</td>
                                      </tr>

                                      <tr>
                                        <th scope="col">First Name</th>
                                        <td>{{ $member->contact_first_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Last Name</th>
                                        <td>{{ $member->contact_last_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Email address</th>
                                        <td>{{ $member->contact_email_address }}</td>
                                      </tr>

                                      <tr>
                                        <th scope="col">Login Email address</th>
                                        <td>{{ $member->email }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Telephone Number</th>
                                        <td>{{ $member->contact_telephone_number }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Fax Number</th>
                                        <td>{{ $member->contact_fax_number }}</td>
                                      </tr>

                                      <tr>

                                        <th scope="col">Mailing Address</th>
                                        <td>{{ $member->contact_mailing_address }}</td>

                                      </tr>
                                  </table>


                                  <div class="card">
                                    <div class="card-header">Existing Zip covered area  list</div>
                                    <div class="card-body">
                                      <?php
                                        $zipareas = \App\Contractor_zip::where('user_id', $member->id)->orderBy('id','desc')->get();
                                      ?>

                                      @if($zipareas->count() == 0)
                                        <div class="text-center"><b>No ZIP covered area SET by Contractor yet. </b></div>
                                      @else
                                      <table class="table table-bordered">
                                        <tr>
                                          <th>State</th>
                                          <th>City</th>
                                          <th>Zip</th>
                                        </tr>

                                        @foreach($zipareas as $zip)

                                          <tr>
                                            <td>{{$zip->state}}</td>
                                            <td>{{$zip->city}}</td>
                                            <td>{{$zip->zip}}</td>
                                          </tr>

                                        @endforeach
                                      </table>
                                      @endif
                                    </div>
                                  </div>  

                              @elseif(request()->segment(3) == 'processserver')
                                  <table class="table table-striped table-bordered">

                                      <tr>
                                        <th scope="col">Check Payable To</th>
                                        <td>{{ $member->cheque_payable_to }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Name of Company</th>
                                        <td>{{ $member->company_name }}</td>
                                      </tr>

                                      <tr>
                                        <th scope="col">First Name</th>
                                        <td>{{ $member->contact_first_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Last Name</th>
                                        <td>{{ $member->contact_last_name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Email address</th>
                                        <td>{{ $member->contact_email_address }}</td>
                                      </tr>

                                      <tr>
                                        <th scope="col">Login Email address</th>
                                        <td>{{ $member->email }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Telephone Number</th>
                                        <td>{{ $member->contact_telephone_number }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Fax Number</th>
                                        <td>{{ $member->contact_fax_number }}</td>
                                      </tr>

                                      <tr>

                                        <th scope="col">Mailing Address</th>
                                        <td>{{ $member->contact_mailing_address }}</td>

                                      </tr>
                                  </table>


                                  <div class="card">
                                    <div class="card-header">Existing Zip covered area  list</div>
                                    <div class="card-body">
                                      <?php
                                        $zipareas = \App\Contractor_zip::where('user_id', $member->id)->orderBy('id','desc')->get();
                                      ?>

                                      @if($zipareas->count() == 0)
                                        <div class="text-center"><b>No ZIP covered area SET by Contractor yet. </b></div>
                                      @else
                                      <table class="table table-bordered">
                                        <tr>
                                          <th>State</th>
                                          <th>City</th>
                                          <th>Zip</th>
                                        </tr>

                                        @foreach($zipareas as $zip)

                                          <tr>
                                            <td>{{$zip->state}}</td>
                                            <td>{{$zip->city}}</td>
                                            <td>{{$zip->zip}}</td>
                                          </tr>

                                        @endforeach
                                      </table>
                                      @endif
                                    </div>
                                  </div>  
                              @elseif(request()->segment(3) == 'admin')

                                  <table class="table table-striped table-bordered">

                                      <tr>
                                        <th scope="col">First Name</th>
                                        <td>{{ $member->name }}</td>
                                      </tr>
                                      <tr>
                                        <th scope="col">Last Name</th>
                                        <td>{{ $member->last_name }}</td>
                                      </tr>
 
                                      <tr>
                                        <th scope="col">Email address</th>
                                        <td>{{ $member->email }}</td>
                                      </tr>
                                      <tr>

                                        <th scope="col">Joined Date</th>
                                        <td>{{ $member->created_at }}</td>
                                      </tr>


                                  </table>

                                @endif

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                    @endif




                </td>


                  
                @if(request()->segment(3) == 'mobilerotary' || request()->segment(3) == 'processserver')
                  <td>

                    <form method="post" action="{{route('admins.user.rating.submit', $member->id)}}">
                      @csrf
                      <div class="form-group">
                        <select class="form-control" name="user_rating">
                          <option value="0">Rating Select</option>
                          <option value="worst" <?php if($member->rating == 'worst'){echo "selected";}?>>Worst</option>
                          <option value="bad" <?php if($member->rating == 'bad'){echo "selected";}?>>Bad</option>
                          <option value="average" <?php if($member->rating == 'average'){echo "selected";}?>>Average</option>
                          <option value="good" <?php if($member->rating == 'good'){echo "selected";}?>>Good</option>
                          <option value="better" <?php if($member->rating == 'better'){echo "selected";}?>>Better</option>
                          <option value="best" <?php if($member->rating == 'best'){echo "selected";}?>>Best</option>
                        </select>
                      </div>

                      <input type="hidden" name="third" value="{{request()->segment(3)}}">

                      <input type="submit" name="submit" value="Submit rating" class="btn btn-md btn-primary btn-block">
                    </form>
                  </td>

                @endif

              </tr>
              </tbody>

            @endforeach
          </table>

        </div>
    </div>



@endsection
