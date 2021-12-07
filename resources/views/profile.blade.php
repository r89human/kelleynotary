@extends('layouts.admin')
@section('title', 'Profile Settings')
@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-4">
                <div class="card-profile-image mt-4">
                    <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ Auth::user()->name[0] }}"></figure>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{  Auth::user()->fullName }}</h5>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>

       {{--  <div class="col-lg-12 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Business Profile</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('profile.business_update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Business Information information</h6>

                        <div class="pl-lg-4">


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="company_name">Company Name</label>
                                        <input type="text" id="company_name" class="form-control" name="company_name" placeholder="Company name..." value="{{ old('company_name', Auth::user()->company_name) }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="contact_first_name">Contact First Name<span class="small text-danger">*</span></label>
                                        <input type="text" id="contact_first_name" class="form-control" name="contact_first_name" placeholder="Contact first name" value="{{ old('contact_first_name', Auth::user()->contact_first_name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="contact_last_name">Contact Last name</label>
                                        <input type="text" id="contact_last_name" class="form-control" name="contact_last_name" placeholder="Contact last name" value="{{ old('contact_last_name', Auth::user()->contact_last_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Contact Email address<span class="small text-danger">*</span></label>
                                        <input type="text" id="contact_email_address" class="form-control" placeholder="Contact email address" name="contact_email_address" value="{{ old('contact_email_address', Auth::user()->contact_email_address) }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="cheque_payable_to">Check Payable To</label>
                                        <input type="text" id="cheque_payable_to" class="form-control" name="cheque_payable_to" placeholder="Check payable to" value="{{ old('cheque_payable_to', Auth::user()->cheque_payable_to) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="contact_telephone_number">Contact Phone Number<span class="small text-danger">*</span></label>
                                        <input type="text" id="contact_telephone_number" class="form-control" placeholder="Contact phone or telephone number" name="contact_telephone_number" value="{{ old('contact_telephone_number', Auth::user()->contact_telephone_number) }}">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="contact_fax_number">Contact Fax number</label>
                                        <input type="text" id="contact_fax_number" class="form-control" placeholder="Contact fax number" name="contact_fax_number" value="{{ old('contact_fax_number', Auth::user()->contact_fax_number) }}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="contact_mailing_address">Mailing Address <span class="small text-danger">*</span></label>
                                        <input type="text" id="contact_mailing_address" class="form-control" name="contact_mailing_address" placeholder="Business mailing address..." value="{{ old('contact_mailing_address', Auth::user()->contact_mailing_address) }}">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Update Business Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div> --}}



        <!--end of business details-->
        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">User information</h6>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Name<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" value="{{ old('name', Auth::user()->name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Last name</label>
                                        <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last name" value="{{ old('last_name', Auth::user()->last_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email address<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Current password</label>
                                        <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">New password</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirm password</label>
                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection
