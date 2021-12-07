@extends('layouts.auth')




@section('main-content')


<link href="{{asset('/css/select2.min.css')}}" rel="stylesheet" />







<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ __('Register') }}</h1>
                                </div>

                                @if ($errors->any())
                                    <div class="alert alert-danger border-left-danger" role="alert">
                                        <ul class="pl-4 my-2">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('register') }}" class="user">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">






                                            <label>Select your state</label>
                                            <select id="state" class="form-control" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                                                <option value="">Select State</option>

                                                @foreach(DB::table('states')->get() as $state)
                                                    <option <?php if(request()->state == $state->state_code){echo "selected";}?> value="/register/?state={{$state->state_code}}">{{$state->state}}</option>
                                                @endforeach
                                            </select>



                                 
                                            @if(DB::table('states')->where('state_code', request()->state)->exists())
                                            <br/>
                                            <br/>
                                            <label>Select your city</label>

                                            <select id="city" class="form-control" onChange="window.document.location.href=this.options[this.selectedIndex].value;">
                                                <option value="">Select City</option>

                                                @foreach(DB::table('cities')->where('state_code', request()->state)->get() as $city)
                                                    <option <?php if(request()->city == $city->city){echo "selected";}?> value="/register/?state={{$city->state_code}}&city={{$city->city}}">{{$city->city}}</option>
                                                @endforeach
                                            </select>

                                            <br/>
                                            <br/>
                                            @endif


                


                                @if(DB::table('states')->where('state_code', request()->state)->exists() && DB::table('cities')->where('city', request()->city)->exists())



                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label for="userRole">Enter your ZIP</label>

                                                <input type="text" class="form-control" name="zip" placeholder="{{ __('Enter zip code') }}" value="{{ old('zip') }}" required autofocus>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label for="userRole">Select user role</label>
                                                <select class="form-control" id="userRole" name="userRole" required>
                                                  <option value="client">Client</option>
                                                  <option value="staff">Staff</option>
                                                  <option value="mobilerotary">Mobile Rotary</option>
                                                  <option value="processserver">Process Server</option>
                                                </select>
                                              </div>

                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userRole">Enter your first name</label>

                                                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                            </div>

                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="userRole">Enter your last name</label>

                                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                            </div>

                                        </div>
                                    </div>
                                    


                                    <div class="form-group">
                                        <label for="userRole">Enter your valid email address</label>

                                        <input type="email" class="form-control" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="userRole">Enter your password (min 6 digit)</label>

                                        <input type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="userRole">Enter your password (min 6 digit)</label>

                                        <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                                    </div>








                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Register') }}
                                            </button>
                                        </div>

                                    @endif
                                </form>

                                <hr>

                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">
                                        {{ __('Already have an account? Login!') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
