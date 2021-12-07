@extends('layouts.admin')
@section('title', 'Your covered area')
@section('css')
  <link href="{{asset('/css/select2.min.css')}}" rel="stylesheet" />
@endsection
@section('main-content')

    <!-- Page Heading -->
    <h5 class=" mb-4 text-gray-800">{{ __(ucfirst(request()->segment(1)).' Dashboard >  Manage your notary area') }}</h5>
    <hr/>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">

        <div class="col-md-6 mb-4">
            
            <div class="card">
              <div class="card-header">
                Add new Notary cover area
              </div>

              <div class="card-body">
                <form method="POST" action="{{route('contractors.notary.zip.store')}}">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">

                  <div class="form-group">

                    <label>Select your state</label>
                    <select id="state" class="form-control" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                        <option value="">Select State</option>

                        @foreach(DB::table('states')->get() as $state)
                            <option <?php if(request()->state == $state->state_code){echo "selected";}?> value="/contact/notary-area/?state={{$state->state_code}}">{{$state->state}}</option>
                        @endforeach
                    </select>

                  </div>

                  @if(DB::table('states')->where('state_code', request()->state)->exists())
                    <div class="form-group">
                      <label>Select your city</label>
                      <select id="city" class="form-control" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                          <option value="">Select City</option>
                          @foreach(DB::table('cities')->where('state_code', request()->state)->get() as $city)
                              <option <?php if(request()->city == $city->city){echo "selected";}?> value="/contact/notary-area/?state={{$city->state_code}}&city={{$city->city}}">{{$city->city}}</option>
                          @endforeach
                      </select>
                    </div>
                  @endif




                  @if(DB::table('states')->where('state_code', request()->state)->exists() && DB::table('cities')->where('city', request()->city)->exists())
    
                    <div class="form-group">
                        <label for="zip">Enter your ZIP</label>

                        <input type="text" class="form-control" name="zip" placeholder="{{ __('Enter zip code') }}" value="{{ old('zip') }}" required autofocus name="zip">
                    </div>

                    <input type="hidden" name="state" value="<?= request()->state;?>">
                    <input type="hidden" name="city" value="<?= request()->city;?>">

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            {{ __('Add area') }}
                        </button>
                    </div>

                  @endif
  

                </form>
              </div>
            </div>

        </div>
        <div class="col-md-6 mb-4">
          
          <div class="card">
            <div class="card-header">Existing Zip covered area  list</div>
            <div class="card-body">
              <table class="table table-bordered">
                <tr>
                  <th>State</th>
                  <th>City</th>
                  <th>Zip</th>
                  <th>Action</th>
                </tr>

                @foreach($zipareas as $zip)

                  <tr>
                    <td>{{$zip->state}}</td>
                    <td>{{$zip->city}}</td>
                    <td>{{$zip->zip}}</td>
                    <td><a onclick="return confirm('Are you sure you want to delete this item?');" href="{{route('contractors.notary.zip.view')}}?do=delete&for={{$zip->id}}">Delete</a></td>
                  </tr>

                @endforeach
              </table>
            </div>
          </div>  

        </div>
    </div>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('/js/select2.min.js')}}"></script>
<script>
$("#state").select2( {
    placeholder: "Select State",
    allowClear: true
    } );
$("#city").select2( {
    placeholder: "Select City",
    allowClear: true
    } );


jQuery(function($) {
    $('select').on('change', function() {
        var url = $(this).val();
        if (url) {
            window.location = url;
        }
        return false;
    });
});



</script>



@endsection
