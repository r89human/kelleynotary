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
            <tr class="thead-light">
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Role</th>
              <th>Members Status</th>
              <th>Actions</th>

            </tr>

            @foreach($members as $member)

              <tr>
                <td>{{$member->name}}</td>
                <td>{{$member->last_name}}</td>
                <td>{{$member->email}}</td>
                <td>N\A</td>
                <td>
                  <?php
                    $abc = new App\Http\Controllers\StaffController;
                    echo ucfirst($abc->getMemberRole($member->role_id));
                  ?>
                </td>
                <td>

                  {{
                    ucfirst($abc->getMemberStatus($member->status)) 
                  }}

                </td>
                <td>

                  @if(request()->segment(3) == 'mobilerotary' || request()->segment(3) == 'processserver')

                    <form method="post" action="{{route('staffs.user.rating.submit', $member->id)}}">
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

                  @endif

                  @if(request()->segment(3) == 'client')
                      <a href="{{route('staffs.show.member.invoices', ['client', $member->id])}}" class="btn btn-link">Invoices</a>
                  @endif
                </td>
              </tr>

            @endforeach
          </table>

        </div>
    </div>



@endsection
