

@extends('layouts.login')

<style>

    .page-wrapper {
      background-image: url("{{ asset('public/banner/login-footer.png') }}");
 
      background-position: bottom;
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
        background-image: url("{{ asset('public/banner/mobile-login-hero.webp') }}");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        width: 100%;
        padding: 60px;
        border:5px solid #34893e;

        -moz-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
        -webkit-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
          /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
        box-shadow: 0 -3px 16px 0 rgba(0, 0, 0, 1) !important;
        margin: 0 auto;
        overflow: hidden;
    }

    .login .content {
        float: right;
        margin-right: auto !important;
        top: 35px;
        left: 20px;
    }

    #logo_link{
        display: block;
        overflow: hidden;
        position: absolute;   
        background: transparent;
        /*border: red 1px solid;*/
        /*background-color: red;*/
        /*text-indent: -9999px;*/
        z-index: 1;
        width: 175px;
        height: 56px;
        top: 206px;
        left: 40px;
    }



    @media (max-width: 320px) {
        .container{
            height: 540px;
        }
        .login2{
            width: 265px !important;
        }

        .login .content {
            width: 225px !important;
            float: right;
            top: 85px;
            left: 45px;
            padding: 15px 10px 30px !important;
            margin-top: 125px !important;
        }

        .login .content h3 {
            display: none;
        }

        .login .content .form-actions{
            padding: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .login .content .form-control  {
            height: 37px !important;
        }

        .form-group {
            margin-bottom: 8px !important;
        }

        .login .content .forget-password {
            font-size: 12px !important;
            float: left !important;
            margin-top: -10px !important;
        }

        .login .content .create-account{
            margin: 0 -40px -30px !important;
        }
    }

    @media  (min-width: 320px) {
        .container{
            height: 540px;
        }
        .login2{
            width: 265px !important;
        }

        .login .content {
            width: 225px !important;
            float: right;
            top: 85px;
            left: 45px;
            padding: 15px 10px 30px !important;
            margin-top: 125px !important;
        }

        .login .content h3 {
            display: none;
        }

        .login .content .form-actions{
            padding: 0 !important;
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .login .content .form-control  {
            height: 37px !important;
        }

        .form-group {
            margin-bottom: 8px !important;
        }

        .login .content .forget-password {
            font-size: 12px !important;
            float: left !important;
            margin-top: -10px !important;
        }

        .login .content .create-account{
            margin: 0 -40px -30px !important;
        }
    }

@media (min-width: 520px){
    .login2 {
        width: 400px !important;
    }

    .login .content {
        width: 295px !important;
        float: right;
        top: 85px;
        left: 15px;
        padding: 18px 13px 30px !important;
        margin-top: 129px !important;
    }

    .login .content .forget-password {
        font-size: 14px !important;
        display: contents !important;
    }

    #logo_link{
        width: 188px !important;
        height: 56px !important;
        top: 206px !important;
        margin-left: 62px !important;
    }

}

@media (min-width: 768px){
    .login2{
        background-image: url("{{ asset('public/banner/login-hero.webp') }}");
        width: 736px !important;
        height: 420px;
        top: 60px;
    }

    .login .content {
        margin-top: 0px !important;
        width: 300px !important;
        top: 65px;
        left: 30px;
    }

    #logo_link{
        width: 207px !important;
        height: 60px !important;
        top: 45px !important;
        margin-left: 395px !important;
    }

    .form-group {
        margin-bottom: 13px !important;
    }

    .login .content .form-control {
        height: 45px !important;
    }

}

@media (min-width: 1200px){
    .login2{
        width: 930px !important;
        height: 430px;
        top: 35px;
    }

    #logo_link{
        width: 265px !important;
        height: 72px !important;
        top: 10px !important;
        margin-left: 510px !important;
    }

    .login .content {
        margin-top: 0px !important;
        width: 350px !important;
        top: 50px;
        left: 2px;
    }
}

</style>



<link href="{{asset('public/assets/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />





@section('content')


    <div class=" login login2">
   <a id="logo_link" title="Intellinz" href="https://intellinz.com/"></a>

<!-- BEGIN LOGIN -->

        <div class="content h-effect">

    <!-- BEGIN LOGIN FORM -->

    <form class="login-form" action="{{ route('login') }}" method="post">

        {{ csrf_field() }}

        <h1 class="form-title" style="color:#34893e; font-size:14px; margin-top:-10px; margin-bottom:5px;" >Sign In</h1>

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

@if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif

        <div class="form-actions">

            <button type="submit" class="btn green uppercase" style="background-color:#34893e; color:white;" >Login</button>

           

            <label class="rememberme check mt-checkbox mt-checkbox-outline">

                <input type="checkbox" name="remember" value="1" id="remember" {{ old('remember') ? 'checked' : '' }} />

                {{ __('Remember Me') }}

               

                <span></span>

            </label>

            <div class="form-group">

                    <a href="{{ url('password/reset') }}" id="forget-password" class="forget-password" style="color:#34893e;"> Forgot Password?</a> 

            </div> 

           

        </div>

        

      

        <div class="create-account">

            

            <p>

                <a href="{{ url('register') }}" id="register-btn" class="uppercase" >Create an account</a>

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

<script async src="public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>

<script async src="public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<script async src="public/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>

<script async src="public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<script async src="public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>

<script async src="public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script async src="public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

<script async src="public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script async src="public/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->

<script async src="public/assets/global/scripts/app.min.js" type="text/javascript"></script>

<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<script async src="public/assets/pages/scripts/login.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->

<!-- END THEME LAYOUT SCRIPTS -->



@endsection

