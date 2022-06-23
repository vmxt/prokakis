

@extends('layouts.login')

<style>

    /*.page-wrapper {
      background-image: url("{{ asset('public/banner/login-footer.png') }}");
        background-size: 100% 50%;
      background-position: bottom;
      background-repeat: no-repeat;
      position: relative;
    }*/

    .text-white{
    color:white !important;
}

.btn{
    border:1px solid black !important;
}

    html,body,.login

    {
        background: linear-gradient(90deg, white 46%, #dff7d9 51%);
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
    }

    .page-wrapper .page-wrapper-middle{
        background:transparent !important;
    }

    .login2{
        background-image: url("{{ asset('public/assets/global/img/login_bg.jpeg') }}");
        background-repeat: no-repeat;
        background-size: 100% auto;
        position: relative;
        width: 100%;
        margin: 0 auto;
        border-radius:20px;
        box-shadow: 2px 7px 12px 2px rgba(0, 0, 0, 0.5); 
        border:3px solid darkgreen !important;
        
    }
    
    .logo_img{
        top:160;
        left:50%;
        position:absolute;
        transform: translate(-50%);
    }
    
    .login_body{
        height:100%;
        width:100%;
        padding: 60px;
        overflow: hidden;
        
        background: linear-gradient(185deg,
        transparent  0%, 
        transparent  30%, 
        darkgreen   30.2%, 
        darkgreen   31%, 
        #7cda24 31.2%, 
        #7cda24 82%);
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
             top: 35px;
        }

        .login .content {
            width: 225px !important;
            float: right;
            top: 85px;
            left: 45px;
            padding: 15px 10px 30px !important;
            margin-top: 95px !important;
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
            width: 365px !important;
            top: 35px;
        }

        .login .content {
            width: 325px !important;
            float: right;
            top: 85px;
            left: 45px;
            padding: 15px 10px 30px !important;
            margin-top: 95px !important;
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



@media (min-width: 768px){
    .login2{
        background-image: url("{{ asset('public/assets/global/img/login_bg.jpeg') }}");
        width: 736px !important;
        height: 420px;
        top: 60px;
        background-position: -100px 0px;
        background-repeat: no-repeat;
        background-size: cover;
    }
    
    .login_body{
        background: linear-gradient(85deg,
        transparent  0%, 
        transparent  45%, 
        darkgreen   45.2%, 
        darkgreen   46%, 
        #7cda24 46.2%, 
        #7cda24 72%);
        
    }
    
    .logo_img{
        top:20 !important;
        left:60% !important;
        position:absolute;
        transform: none !important
    }

    .login .content {
        margin-top: 0px !important;
        width: 300px !important;
        top: 65px;
        left: 50px;
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
        top: 60px;
    }
}
.text-company{
 color:#7cda24 !important;   
}
.btn-primary{
    background-color:black !important;
    color:white !important;
}

.mt-checkbox, .mt-radio{
    padding-left:20px !important;
}

.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: black;
  color: white;
  text-align: center;
}
</style>



<link href="{{asset('public/assets/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />





@section('content')


    <div class=" login login2">
        <div class="login_body">
   <img style="height:80px" class="img-fluid logo_img" src="{{  env('APP_URL') . 'uploads/intellinz_white_crop.png' }}" />

<!-- BEGIN LOGIN -->

        <div class="content">

    <!-- BEGIN LOGIN FORM -->

    <form class="login-form" action="{{ route('login') }}" method="post">

        {{ csrf_field() }}

        <h1 class="form-title" style=" font-size:18px; margin-top:-8px; margin-bottom:7px;text-align:center" ><b class="uppercase text-company">Sign In</b></h1>

        <div class="alert alert-danger display-hide">

            <button class="close" data-close="alert"></button>

            <span> Enter your email and password. </span>

        </div>

        <div class="form-group">

            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->

            <label class="control-label visible-ie8 visible-ie9">Email</label>

            <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-solid placeholder-no-fix" type="email" autocomplete="off" placeholder="EMAIL" name="email" value="{{ old('email') }}" required autofocus/>

            @if ($errors->has('email'))

                <span class="invalid-feedback" role="alert">

                    <strong>{{ $errors->first('email') }}</strong>

                </span>

            @endif

        </div>

        <div class="form-group">

            <label class="control-label visible-ie8 visible-ie9">Password</label>

            <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="PASSWORD" name="password" />

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

        <div class="form-actions" style="margin-bottom:16px">
            <label class="rememberme check mt-checkbox mt-checkbox-outline ml-2" style="font-weight:bold">

                <input type="checkbox" name="remember" value="1" id="remember" {{ old('remember') ? 'checked' : '' }} />
                
                {{ __('Remember Me') }}

               

                <span></span>

            </label>
            
            <button type="submit" class="btn btn-primary uppercase pull-right" style="background-color:#34893e; color:white;" ><i class="fa fa-sign-in text-company"></i> LOGIN</button>

            <div class="form-group">

                    <a href="{{ url('password/reset') }}" id="forget-password" class="forget-password" style="color:#34893e;"><b class="text-company">Forgot Password?</b></a> 

            </div> 

           

        </div>

        

      

        <div class="create-account bg-dark ">

            

            <p>

                <a href="{{ url('register') }}" id="register-btn" class="uppercase text-white" ><i class="fa fa-user-plus  text-company"></i> Create an account</a>

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

  <div class="footer">
  <p class="uppercase">Copyright <b class="text-company">&copy;</b> <script>document.write(new Date().getFullYear())</script> <b class="text-company">Intellinz</b></p>
</div>

@endsection

