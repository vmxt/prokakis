

@extends('layouts.login')

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



<link href="{{asset('public/assets/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />





@section('content')

    <div class=" login">

<!-- BEGIN LOGO -->

        <div class="logo">

    <a href="https://prokakis.com/">

        <img src="{{asset('public/img-resources/ProKakisNewLogo.png')}}" alt="Prokakis" id="logo" width="300px" > </a>

</div>

<!-- END LOGO -->

<!-- BEGIN LOGIN -->

        <div class="content">

    <!-- BEGIN LOGIN FORM -->

    <form class="login-form" action="{{ route('login') }}" method="post">

        {{ csrf_field() }}

        <h3 class="form-title" style="color:#1a4275;" >Sign In</h3>

        <div class="alert alert-danger display-hide">

            <button class="close" data-close="alert"></button>

            <span> Enter your email and password. </span>

        </div>

        <div class="form-group">

            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

            <label class="control-label visible-ie8 visible-ie9">Email</label>

            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="Email" name="email" value="{{ old('email') }}" required autofocus/>

            @if ($errors->has('email'))

                <span class="invalid-feedback" role="alert">

                    <strong>{{ $errors->first('email') }}</strong>

                </span>

            @endif

        </div>

        <div class="form-group">

            <label class="control-label visible-ie8 visible-ie9">Password</label>

            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" />

            @if ($errors->has('password'))

                <span class="invalid-feedback" role="alert">

                <strong>{{ $errors->first('password') }}</strong>

                </span>

            @endif

        </div>

        <div class="form-actions">

            <button type="submit" class="btn green uppercase" style="background-color:#1a4275; color:white;" >Login</button>

           

            <label class="rememberme check mt-checkbox mt-checkbox-outline">

                <input type="checkbox" name="remember" value="1" id="remember" {{ old('remember') ? 'checked' : '' }} />

                {{ __('Remember Me') }}

               

                <span></span>

            </label>

            <div class="form-group">

                    <a href="{{ url('password/reset') }}" id="forget-password" class="forget-password"> Forgot Password?</a> 

            </div> 

           

        </div>

        

      

        <div class="create-account">

            

            <p>

                <a href="{{ url('register') }}" id="register-btn" class="uppercase ">Create an account</a>

            </p>

        </div>

    </form>

    <!-- END LOGIN FORM -->

    <!-- BEGIN FORGOT PASSWORD FORM -->

    <form class="forget-form" action="index.html" method="post"> <br />

        <h3 class="font-green"> Forget Password ?</h3>

        <p> Enter your e-mail address below to reset your password. </p>

        <div class="form-group">

            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>

        <div class="form-actions">

            <button type="button" id="back-btn" class="btn green btn-outline">Back</button>

            <button type="submit" class="btn btn-success uppercase pull-right  {{ __('Sign In') }}">Submit</button>

        </div>

    </form>

    <!-- END FORGOT PASSWORD FORM -->

<!--[if lt IE 9]>

<script src="../assets/global/plugins/respond.min.js"></script>

<script src="../assets/global/plugins/excanvas.min.js"></script>

<script src="../assets/global/plugins/ie8.fix.min.js"></script>

<![endif]-->

<!-- BEGIN CORE PLUGINS -->

<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->

<script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>

<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script src="../assets/pages/scripts/login.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->

<!-- END THEME LAYOUT SCRIPTS -->



</div>

        </div>

@endsection

