@extends('layouts.app')



@section('content')


    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/buytokens.css') }}">

    <style>

        html, body {

            width: 100%;

            height: 100%;

            margin: 0px;

            padding: 0px;

            overflow-x: hidden;

        }

        .center {

            display: block;

            margin-left: auto;

            margin-right: auto;

            width: 50%;

            height: 150px;

        }



        .btn-x3 {

            font-size: 16px;

            border-radius: 5px;

            width: 100%;

            background-color: orangered;

        }



        #edit_icon {

            cursor: pointer;

        }

.token-card-title{
    background-image: url("{{ asset('public/img-resources/card-bg.png') }}");

}

    </style>



    @if (session('status'))

        <div class="alert alert-success">

            {{ session('status') }}

        </div>

    @endif

    @if (session('message'))

        <div class="alert alert-danger">

            {{ session('message') }}

        </div>

    @endif



    @if ($errors->any())

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif



    <div class="row justify-content-center">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>

                <a href="{{ url('/home') }}">Home</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                <a href="#">Reports</a>

                <i class="fa fa-circle"></i>

            </li>

            <li>

                Buy Tokens

            </li>

        </ul>

    </div>

   

    <div class=" payment  flaticon">
        <div class="wrapper">
            <div class="pricing-tables">
                <div class="container container--mobile-mg-x-none">
                    <div class="row">
                        <div class="col-12 comTable">
                                <div class="toggle-section">
                                    <div class="col-6 toggle-monthly">MONTHLY</div>
                                    <div class="col-6 toggle-yearly">YEARLY</div>
                                </div>
                        </div>
                        <div class="col-12 comTable">
                                <p> GO YEARLY AND GET 1 MONTH <STRONG> FREE </STRONG> </p>
                        </div>
                    </div>
                </div>

                <div class="container ">
                    <div class="row">
                        <div class="col-12 token-card-container card-monthly">
                            <div class="col-6 token-card">
                                <div class="token-card-title">
                                    <span class="fa-stack"
                                            aria-hidden="true"
                                            title="3 Credits for $18"
                                            data-toggle="popover" 
                                            data-trigger="focus click hover"
                                            data-content="Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi."
                                            data-placement="left">
                                        <i class="fa fa-info-circle fa-3x info-icon " ></i>
                                    </span>
                                    <div class="col-12 card-title-content">
                                        <h2>ONE-TIME</h2>
                                        <p>3 Credits</p>
                                        <h4>$18 One Pay</h4>
                                    </div>
                                    <div class="col-12 card-buyNow">
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="1">
                                           <button type="submit" class="btn-subscribe" >Buy Now</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12 token-card-desc margin-top">
                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Access to Prokakis Online Marketplace</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Online support</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Unlimited creation of opportunities</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>one-time viewing to prokakis profiles in explore page</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>one-time access to prokakis private chat function</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>limited company profile page</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>* data repository for awards and licenses</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>*Exclusive invite to prokakis networking events</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-6 token-card">
                                <div class="token-card-title">
                                    <span class="fa-stack"
                                            aria-hidden="true"
                                            title="3 Credits for $18"
                                            data-toggle="popover" 
                                            data-trigger="focus click hover"
                                            data-content="Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi."
                                            data-placement="left">
                                        <i class="fa fa-info-circle fa-3x info-icon " ></i>
                                    </span>
                                    <div class="col-12 card-title-content">
                                        <h2>MONTHLY</h2>
                                        <p>Best Value</p>
                                        <h4>$36/Month</h4>
                                    </div>
                                    <div class="col-12 card-buyNow">
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="2">
                                           <button type="submit" class="btn-subscribe" >Buy Now</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12 token-card-desc margin-top">
                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Access to Prokakis online marketplace</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Online Support</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited creation of opportunities</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited creation of opportunities with company info</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited viewing of public profiles in explore page</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited access to prokakis private chat function</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited access to business news </p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>personalized company profile page</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Automated ongoing monitoring system</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>*Data repositiry for awards and licences</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>*exclusive invite to prokakis networking events</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 token-card-container card-yearly el-invisible">
                            <div class="col-6 token-card">
                                <div class="token-card-title">
                                    <span class="fa-stack"
                                            aria-hidden="true"
                                            title="3 Credits for $18"
                                            data-toggle="popover" 
                                            data-trigger="focus click hover"
                                            data-content="Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi."
                                            data-placement="left">
                                        <i class="fa fa-info-circle fa-3x info-icon " ></i>
                                    </span>
                                    <div class="col-12 card-title-content">
                                        <h2>ONE-TIME</h2>
                                        <p>3 Credits</p>
                                        <h4>$18 One Pay</h4>
                                    </div>
                                    <div class="col-12 card-buyNow">
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="1">
                                           <button type="submit" class="btn-subscribe" >Buy Now</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12 token-card-desc margin-top">
                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Access to Prokakis Online Marketplace</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Online support</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Unlimited creation of opportunities</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>one-time viewing to prokakis profiles in explore page</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>one-time access to prokakis private chat function</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>limited company profile page</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>* data repository for awards and licenses</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>*Exclusive invite to prokakis networking events</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-6 token-card">
                                <div class="token-card-title">
                                    <span class="fa-stack"
                                            aria-hidden="true"
                                            title="3 Credits for $18"
                                            data-toggle="popover" 
                                            data-trigger="focus click hover"
                                            data-content="Sed porttitor lectus nibh. Donec sollicitudin molestie malesuada. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi."
                                            data-placement="left">
                                        <i class="fa fa-info-circle fa-3x info-icon " ></i>
                                    </span>
                                    <div class="col-12 card-title-content">
                                        <h2>YEARLY</h2>
                                        <p>Get 1 Month Free</p>
                                        <h4>$396/Year</h4>
                                    </div>
                                    <div class="col-12 card-buyNow">
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="2">
                                           <button type="submit" class="btn-subscribe" >Buy Now</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-12 token-card-desc margin-top">
                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Access to Prokakis online marketplace</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Online Support</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited creation of opportunities</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited creation of opportunities with company info</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited viewing of public profiles in explore page</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited access to prokakis private chat function</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>unlimited access to business news </p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>personalized company profile page</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>Automated ongoing monitoring system</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>*Data repositiry for awards and licences</p>
                                        </div>
                                    </div>

                                    <div class="token-card-text">
                                        <div class='check-icon'>
                                            <img class='img_icon' src="{{ asset('public/img-resources/check-mark.png') }}" width="20" height="20" />
                                        </div>
                                        <div class='check-desc'>
                                            <p>*exclusive invite to prokakis networking events</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="advantages-block">
                <div class="container">
                    <div style="position: relative;">
                        <div class='arrow_right-top'>
                             <img class="arrow_right" src="{{ asset('public/img-resources/arrow-up.png') }}" width="150" height="100">
                         </div>
                        <div class='arrow_right-down'>
                             <img class="arrow_right" src="{{ asset('public/img-resources/arrow-down.png') }}" width="150" height="100">
                         </div>
                        <div class="col-4 col-foot">
                            <div class="content">
                                <img  class="advantages-img"  src="{{ asset('public/img-resources/free.png') }}" width="96" alt="document" title="document">
                                <h3 class='advance-title1'><strong>FREE</strong></h3>
                                <p class='margin-left'>With a Free account, you can post unlimited opportunities on PorKakis marketplace to connect with the right partner</p>
                            </div>
                        </div>
                        <div class="col-4 col-foot">
                            <div class="content">
                                <img  class="advantages-img"  src="{{ asset('public/img-resources/premium.png') }}" width="96" alt="dollars" title="dollars">
                                
                                <h3 class='advance-title2'><strong>PREMIUM</strong></h3>
                                <p class="margin-right">Upgrade your FREE Account to PREMIUM with 1 Token for 6 months to access unlimited features in ProKakis</p>
                            </div>
                        </div>
                        <div class="col-4 col-foot">
                            <div class="content">
                                <img class="advantages-img"    src="{{ asset('public/img-resources/report-new.png') }}" width="96" alt="Tax" title="Tax">
                                
                                <h3 class='advance-title3'><strong>REPORT</strong></h3>
                                <p class="margin-center">Add on 12 Tokens yo your account to purchase KYB Business Intelligence Report from Companies.</p>
                            </div>
                        </div>
                        <div class="col-12 advFooterText2">
                            <div class="content advFooterText" style="text-align: center;">
                                <p>Upgrading to Premium Account will deduct 1 Token from your account, Purchase of KYB Business Intelligence Report will deduct 12 Tokens from your account.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script>
         $(document).ready(function () {
            $('.toggle-monthly').click(function(){
                $('.card-monthly').removeClass("el-invisible");
                $('.card-yearly').addClass("el-invisible");
            });

            $('.toggle-yearly').click(function(){
                $('.card-yearly').removeClass("el-invisible");
                $('.card-monthly').addClass("el-invisible");
            });

        });
    </script>



    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>



@endsection