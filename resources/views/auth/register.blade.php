@extends('layouts.register')



<style>

    html,body,.login

    {

        width: 100%;

        height: 100%;

        margin: 0px;

        padding: 0px;

        overflow-x: hidden;

    }

.div-captcha {
    text-align: center
}

.img_captcha img{
    width: 100% !important;
}

</style>



<link href="{{asset('public/assets/pages/css/login.min.css')}}" rel="stylesheet" type="text/css" />







@section('content')

    <div class="login">



    <div class="logo"  style="margin-top: 0px; margin-bottom: 0px;">

        <a href="https://intellinz.com">

            <img src="{{asset('public/img-resources/ProKakisNewLogo.png')}}" alt="Intellinz" id="logo" width="200px"> </a>

    </div>

    <!-- END LOGO -->

    <!-- BEGIN LOGIN -->

    <div class="content" style="margin-top: 0px;">

        @if(session()->has('message'))

            <div class="alert alert-success">

                {{ session()->get('message') }}

            </div>

    @endif

        <!-- BEGIN REGISTRATION FORM -->

        <form class="register-form" action="{{ route('register') }}" method="POST" style="display: block;">

            {{ csrf_field() }}

            <h1 style="color:#34893e; font-weight: bold; font-size:30px;"><center>Create Account</center></h1>

            <input type="hidden" name="user_type" value="1">

            

           <!-- <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">

                <label>REGISTER ACCOUNT TYPE AS: </label>

                <select name="user_type" multiple="" class="form-control" style="height:90px">

                    <option value="1">Company</option>

                    <option value="2">Assistant Consultant</option>

                    <option value="3">Master Consultant</option>

                    <option value="4">Ebos Staff</option>

                    

                </select>

                @if ($errors->has('user_type'))

                <span class="help-block">

                    <strong>{{ $errors->first('user_type') }}</strong>

                </span>

                @endif

            </div> -->



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

            <p class="hint">COMPANY INFORMATION</p>

            <div class="form-group">

                <label class="control-label visible-ie8 visible-ie9">COMPANY INFORMATION</label>

                <input id="company_name"  class="form-control placeholder-no-fix" type="text" placeholder="Company Name" name="company_name" required autofocus>

            </div>

            <div class="form-group">

                <label class="control-label visible-ie8 visible-ie9"></label>

                <input id="company_website"  class="form-control placeholder-no-fix" type="text"  placeholder="Company Website" name="company_website" required autofocus>

            </div>


            <p class="hint">HOW DID YOU HEARD ABOUT INTELLINZ?</p>

            <div class="form-group">

                <select id="reason_heard"  class="form-control" type="text" name="reason_heard" required>
                    <option selected>Choose One..</option>
                    <option value="Search Engine">Search Engine (Google, Yahoo, etc.)</option>
                    <option value="Social Media">Social Media (Facebook, Instagram etc.)</option>
                    <option value="Newsletter">Newsletter/Email Marketing</option>
                    <option value="Friends">Friends , Co-workers or Family</option>
                    <option value="Event Sites">Event Sites (Meetup, Eventbrite etc.)</option>
                    <option value="Other">Other...</option>
                </select>

            </div>            

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
            <div class="form-group margin-top-20 margin-bottom-20 div-captcha">
                <label>Enter the security code</label>
                      <p class="img_captcha"><?= captcha_img() ?></p>
                      <p><input type="text" name="captcha"></p>
            </div>


            <div class="form-actions">

                <a href="{{ url('login') }}" id="register-back-btn" class="btn" style="background-color:#34893e; color:white;" >Back</a>

                <button type="submit" id="registerbtn" class="btn uppercase pull-right" style="background-color:#34893e; color:white;"> Create </button>

            </div>

        </form>

        <!-- END REGISTRATION FORM -->

    </div>

    <!--[if lt IE 9]>

    <script src="../assets/global/plugins/respond.min.js"></script>

    <script src="../assets/global/plugins/excanvas.min.js"></script>

    <script src="../assets/global/plugins/ie8.fix.min.js"></script>

    <![endif]-->

    <!-- BEGIN CORE PLUGINS -->

    <script async="" src="//www.googletagmanager.com/gtm.js?id=GTM-W276BJ"></script><script async="" src="https://www.google-analytics.com/analytics.js"></script><script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>

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

    <script>

        $(document).ready(function()

        {

            $('#clickmewow').click(function()

            {

                $('#radio1003').attr('checked', 'checked');

            });



            $('#register-back-btn').click(function()

            {

                 window.history.back();

            });



            $('#tnc').click(function(event)

            {

                event.preventDefault();

                console.log('Test');

                $('#registerbtn').prop("disabled", false);

              

            });



        })

    </script>

    <!-- Google Code for Universal Analytics -->

    <script>

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-37564768-1', 'auto');

        ga('send', 'pageview');

    </script>

    <!-- End -->



    <!-- Google Tag Manager -->

    <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-W276BJ"

                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=

            '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

        })(window,document,'script','dataLayer','GTM-W276BJ');</script>

    <!-- End -->





    </div>

@endsection