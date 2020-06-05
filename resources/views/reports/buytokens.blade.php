@extends('layouts.app')



@section('content')



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



    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/buytokens.css') }}">



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

                <div class="container container--mobile-mg-x-none">
                    <div class="row">
                        <div class="col-12">
                                <div class="image-compare">
                                    <div class="img-left">
                                        <img class="compare-img"    src="{{ asset('public/img-resources/one-time.png') }}" width="96" alt="Tax" title="Tax">
                                    </div>
                                    <div class="img-right ">
                                         <hr class="top-line">
                                        <img class="compare-img"    src="{{ asset('public/img-resources/monthly.png') }}" width="96" alt="Tax" title="Tax">
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



    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">

    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>



@endsection