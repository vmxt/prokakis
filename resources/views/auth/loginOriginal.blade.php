@extends('layouts.app')

<style>
    html,body,.login
    {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }

</style>

<link href="{{asset('public/assets/pages/css/login-3.min.css')}}" rel="stylesheet" type="text/css" />

@section('content')
    <div class="login">
        <!-- BEGIN LOGO -->
        <div class="logo">
            <img src="public/images/smallLogo2.png" class="css-class" alt="Prokakis Logo">
        </div>
        <!-- END LOGO -->
        <div class="content">
        <!-- BEGIN LOGIN FORM -->
            <form class="login-form" action="{{ route('login') }}" method="POST" novalidate="novalidate">
            {{ csrf_field() }}
            <h3 class="form-title">Login to your account</h3>
            <div class="alert alert-danger display-hide" style="display: none;">
                <button class="close" data-close="alert"></button>
                <span> Enter any email and password. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="on" placeholder="Username" name="email"  value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group has-error">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" autocomplete="off" placeholder="Password" name="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
            </div>
            <div class="form-actions">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" id="remember"  {{ old('remember') ? 'checked' : '' }}> Remember me
                    {{ __('Remember Me') }}
                    <span></span>
                </label>
                <button type="submit" class="btn green pull-right"> {{ __('Sign In') }} </button>
            </div>
            <div class="forget-password">
                <h4>Forgot your password ?</h4>
                <p> no worries, click
                    <a href="javascript:;" id="forget-password"> here </a> to reset your password. </p>
            </div>
            <div class="create-account">
                <p> Don't have an account yet ?&nbsp;
                    <a href="javascript:;" id="register-btn"> Create an account </a>
                </p>
            </div>
        </form>
        <!-- END LOGIN FORM -->

        <!-- BEGIN FORGOT PASSWORD FORM -->

        <!-- END FORGOT PASSWORD FORM -->

        <!-- BEGIN REGISTRATION FORM -->
        <!-- END REGISTRATION FORM -->
    </div>
    </div>


@endsection
