@extends('layouts.registration')



@section('content')

  

        <!-- BEGIN REGISTRATION FORM -->
        @if($errors->any())
        <div class="alert alert-danger" style="width: 100%; overflow: hidden; margin-left: 0px !important;">
            {{ implode('', $errors->all(':message')) }}
        </div>    
        @endif

        <form class="register-form" action="{{ route('register') }}" method="POST" style="display: block;">

            {{ csrf_field() }}

            <h3 class="font-green"> Add User </h3>

            <input type="hidden" name="user_type" value="8">

            <input type="hidden" name="m_id" value="<?php echo $userIdDecode; ?>">


            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }} ">

                <label class="control-label visible-ie8 visible-ie9">First Name</label>

                <input id="firstname"  class="form-control placeholder-no-fix" type="text" placeholder="First Name" name="firstname" value="{{ old('firstname') }}" required autofocus>

                @if ($errors->has('firstname'))

                    <span class="help-block">

                                                                <strong>{{ $errors->first('firstname') }}</strong>

                                                            </span>

                @endif

            </div>

            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }} ">

                <label class="control-label visible-ie8 visible-ie9">Last Name</label>

                <input id="lastname"  class="form-control placeholder-no-fix" type="text" placeholder="Last Name" name="lastname" value="{{ old('lastname') }}" required autofocus>

                @if ($errors->has('lastname'))

                    <span class="help-block">

                                                            <strong>{{ $errors->first('lastname') }}</strong>

                                                        </span>

                @endif

            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }} ">

                <label class="control-label visible-ie8 visible-ie9">Phone Number</label>

                <input id="phone"  class="form-control placeholder-no-fix" type="text" placeholder="Phone Number" name="phone" value="{{ old('phone') }}" required autofocus>

                @if ($errors->has('phone'))

                    <span class="help-block">

                                                            <strong>{{ $errors->first('phone') }}</strong>

                                                        </span>

                @endif

            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

                <label class="control-label visible-ie8 visible-ie9">Email</label>

                <input id="email"  class="form-control placeholder-no-fix" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required>

                @if ($errors->has('email'))

                    <span class="help-block">

                                                         <strong>{{ $errors->first('email') }}</strong>

                                                     </span>

                @endif

            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                <label class="control-label visible-ie8 visible-ie9">Password</label>

                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="password" placeholder="Password" name="password" required>

                @if ($errors->has('password'))

                    <span class="help-block">

                                                         <strong>{{ $errors->first('password') }}</strong>

                                                     </span>

                @endif

            </div>

            <div class="form-group">

                <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>

                <input id="password-confirm" class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="password_confirmation" required>

            </div>
        <!--
            <p class="hint">COMPANY INFORMATION</p>

            <div class="form-group">

                <label class="control-label visible-ie8 visible-ie9">COMPANY INFORMATION</label>

                <input id="company_name" disabled value="FOR COMPANY ACCOUNT ONLY"  class="form-control placeholder-no-fix" type="text" placeholder="Company Name" name="company_name" required autofocus>

            </div>

            <div class="form-group">

                <label class="control-label visible-ie8 visible-ie9"></label>

                <input id="company_website" disabled value="FOR COMPANY ACCOUNT ONLY"  class="form-control placeholder-no-fix" type="text"  placeholder="Company Website" name="company_website" required autofocus>

            </div>
        -->

        <input type="hidden" name="company_name" value="NOT APPLICABLE">
        <input type="hidden" name="company_website" value="NOT APPLICABLE">
        


            <div class="form-group margin-top-20 margin-bottom-20">

                <label class="mt-checkbox mt-checkbox-outline">

                    <input type="checkbox" name="tnc" id="tnc">  I have read and agreed to Intellinz

                    <a href="javascript:;">Terms of Use </a> &amp;

                    <a href="javascript:;">Privacy Policy </a>

                    <span></span>



                </label>

                @if ($errors->has('tnc'))

                        <span class="help-block">

                                <strong style="color:#e73d4a">{{ $errors->first('tnc') }}</strong>

                            </span>

                         @endif

 

            </div>

            <div class="form-actions">

                <a href="{{ url('login') }}" id="register-back-btn" class="btn green btn-outline">Login?</a>

                <button type="submit" id="registerbtn" class="btn btn-success uppercase pull-right"> Create </button>

            </div>

        </form>

        <!-- END REGISTRATION FORM -->

  

@endsection