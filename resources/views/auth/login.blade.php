

@extends('layouts.login')

<style>

    .page-wrapper {
      background-image: url("{{ asset('public/banner/login-footer.png') }}");
 
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }

    html,body,.login

    {

        width: 100%;

        height: 100%;

        margin: 0px;

        padding: 0px;

        overflow-x: hidden;

    }

    .h-effect {
          -moz-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
          -webkit-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
          /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
          box-shadow: 0 -3px 16px 0 rgba(0, 0, 0, 1) !important;
    }

    input:focus{
            -moz-box-shadow: 0 0px 10px 0  #31708f  !important;
          -webkit-box-shadow: 0 0px 10px 0  #31708f  !important;
          /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
          box-shadow: 0 0px 10px 0  #31708f  !important;
    }

    .page-wrapper .page-wrapper-middle{
        background:transparent !important;
    }

    .login2{
            background-image: url("{{ asset('public/banner/login-hero.png') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            width: 100%;
            padding: 60px;
            border:5px solid #021a40;

            -moz-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
            -webkit-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
              /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
            box-shadow: 0 -3px 16px 0 rgba(0, 0, 0, 1) !important;

    }

    .login .content {
        float: right;
        margin-right: auto !important;
        top: 35px;
        left: 20px;
    }

    @media (min-width: 1200px)  {
        .login2{
            bottom: 35px;
            top: 0px;
        }

    }

    @media (min-width: 1440px)  {
        .login .content{
            margin-right: 45px !important;
        }

    }

    @media (min-width: 1024px)  {
        .login .content{
            top: 50px;
            width: 370px !important;
        }   
        .content .h-effect{

        }

    }

    @media (max-width: 1023px)  {
        .login2 {
            max-width: 100%;
            max-height: 100%;
            display: flex;
            padding: 0px !important;
            overflow: hidden;
        }

        .content .h-effect {
            left: 75px;
            top: 34px;
        }

        .login .content {
            width: 320px !important;
        }

        .content .h-effect{
            left: 75px;
            top: 25px;
        }

    }

    @media (max-width: 1023px){
        .page-container{
            height: 500px !important;
        }

        .content {
            height: 330px !important;
            top: 95px !important;
            left: 185px !important;
        }

        .login .content {
            margin: 40px auto 10px !important;
            padding: 0px 15px 0px !important;
        }

        .form-group {
            margin-bottom: 6px !important;
        }
    }
</style>



<link href="{{asset('public/assets/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />





@section('content')

    <div class=" login login2">



<!-- BEGIN LOGIN -->

        <div class="content h-effect">

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


</div>

        </div>

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



@endsection

