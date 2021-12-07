@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                                <form method="POST" action="{{ route('register') }}" class="user">
                                    @csrf

                    <div class="row">


                        <div class="col-lg-6">
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


                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="last_name" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                                    </div>


                                      <div class="form-group">
                                        <label for="userRole">Select user role</label>
                                        <select class="form-control" id="userRole" name="userRole">
                                          <option value="" selected disabled>Select Role</option>
                                          <option value="client">Client</option>
                                          <option value="mobilerotary">Mobile Notary</option>
                                          <option value="processserver">Process Server</option>
                                          <option value="staff">Staff</option>
                                          
                                        </select>
                                      </div>


                                    
        

                            </div>
                        </div>


                        <div class="col-lg-6">
                            

                            <div class="card-body mt-5">


                                <!--<form method="POST" action="{{ route('profile.business_update') }}" autocomplete="off">-->



                                    <div class="pl-lg-4">


                                        <div class="row" id="company_name">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="company_name">Company Name</label>
                                                    <input type="text" class="form-control" name="company_name" placeholder="Company name..." >
                                                
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6" id="contact_first_name">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="contact_first_name">Contact First Name<span class="small text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="contact_first_name" placeholder="Contact first name" required>
                                                
                                                </div>
                                            </div>
                                            <div class="col-lg-6" id="contact_last_name">
                                                <div class="form-group focused">
                                                    <label class="form-control-label" for="contact_last_name">Contact Last name</label>
                                                    <input type="text" class="form-control" name="contact_last_name" placeholder="Contact last name">
                                                
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12" id="contact_email_address">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="email">Contact Email address<span class="small text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Contact email address" name="contact_email_address">
                                                
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-12" id="cheque_payable_to">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="cheque_payable_to">Check Payable To</label>
                                                    <input type="text" class="form-control" name="cheque_payable_to" placeholder="Check payable to">
                                                
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id="contact_telephone_number">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="contact_telephone_number">Contact Phone Number<span class="small text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Contact phone or telephone number" name="contact_telephone_number">
                                                
                                                </div>
                                            </div>
                                            <div class="col-lg-12" id="contact_fax_number">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="contact_fax_number">Contact Fax number</label>
                                                    <input type="text" class="form-control" placeholder="Contact fax number" name="contact_fax_number">
                                                
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group" id="contact_mailing_address">
                                                    <label class="form-control-label" for="contact_mailing_address">Mailing Address <span class="small text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="contact_mailing_address" placeholder="Business mailing address..." >
                                                
                                                </div>

                                                 <button type="submit" class="btn btn-primary btn-user btn-block hide-reg">
                                                    {{ __('Register') }}
                                                </button>

                                                <div class="text-center hide-reg">
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
                                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
