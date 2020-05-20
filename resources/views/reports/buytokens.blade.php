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
                        <div class="col-6 comTable">
                            <div class="table-container">
                                <div class="table-content">
                                    <div class="box table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="rowHead">FREE</th>
                                                    <th class="col_1"></th>
                                                    <th class="rowHead">PREMIUM</th>
                                                    <th class="col_1"></th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class='row_title'><strong> Access to Prokakis online marketplace </strong></td>
                                                    <td class='rowStatus'><img class='img_icon'  src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg">&nbsp;</td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>Online Support</strong></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>Unlimited Creation of Opportunities</strong> </td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>Unlimited Creation of Opportunities with Company Info </strong></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>Unlimited Viewing of Public Profiles in Explore Page</strong></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>Unlimited Access to Business News</strong></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>Personalized Company Profile Page</strong></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>Automated Ongoing Monitoring System</strong></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>*Data Repository for Awards and Licenses</strong></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class='row_title'><strong>*Exclusive Invite to Prokakis Networking Events</strong></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.png') }}" width="30" height="30"></td>
                                                    <td class="col_1 col_1bg"></td>
                                                    <td class='rowStatus'><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.png') }}" width="30" height="30"></td>
                                                    <td class="col_2 col_1bg">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td ></td>
                                                    <td class='rowStatus rowFooter'></td>
                                                    <td class="col_1 "></td>
                                                    <td class='rowStatus rowFooter'></td>
                                                    <td class="col_2 ">&nbsp;</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 topupBtn">
                            <div id="box-monthly" data-plan="monthly" class="box plans">
                                <a class="btn-selection" data-frequency="year" data-coupon=""  >
                                    <div class="content">
                                        <span class="title">Top Up 1</span>
                                        <span class="price"><small>2 TOKEN</small><small></small></span>
                                        <span class="title"><b>$120</b></span>
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="1">
                                           <button type="submit" class="btn-subscribe" >Buy Now</button>
                                        </form>
                                    </div>
                                </a>
                            </div>
                            <div id="box-monthly" data-plan="monthly" class="box plans">
                                <a class="-selection" data-frequency="month" data-coupon="" >
                                    <div class="content">
                                         <img  class="best-img"  src="{{ asset('public/banner/best.png') }}" width="96" alt="document" title="document">
                                        <span class="title">Top Up 2</span>
                                        <span class="price"><small>12 TOKEN</small><small></small></span>
                                        <span class="title"><b>$720</b></span>
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="2">
                                           <button type="submit" class="btn-subscribe" >Buy Now</button>
                                        </form>
                                    </div>
                                </a>
                            </div>
                            <div id="box-monthly" data-plan="monthly" class="box plans">
                                <a class="-selection" data-frequency="month" data-coupon="" >
                                    <div class="content">
                                        <span class="title">Top Up 3</span>
                                        <span class="price"><small>20 TOKEN</small><small></small></span>
                                        <span ><b>$1200</b></span>
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="3">
                                           <button type="submit" class="btn-subscribe" >Buy Now</button>
                                        </form>
                                    </div>
                                </a>
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
                                <h3><strong>FREE</strong></h3>
                                <p>With a Free account, you can post unlimited opportunities on PorKakis marketplace to connect with the right partner</p>
                            </div>
                        </div>
                        <div class="col-4 col-foot">
                            <div class="content">
                                <img  class="advantages-img"  src="{{ asset('public/img-resources/premium.png') }}" width="96" alt="dollars" title="dollars">
                                
                                <h3><strong>PREMIUM</strong></h3>
                                <p>Upgrade your FREE Account to PREMIUM with 1 Token for 6 months to access unlimited features in ProKakis</p>
                            </div>
                        </div>
                        <div class="col-4 col-foot">
                            <div class="content">
                                <img class="advantages-img"    src="{{ asset('public/img-resources/report-new.png') }}" width="96" alt="Tax" title="Tax">
                                
                                <h3><strong>REPORT</strong></h3>
                                <p>Add on 12 Tokens yo your account to purchase KYB Business Intelligence Report from Companies.</p>
                            </div>
                        </div>
                        <div class="col-12 col-foot">
                            <div class="content" style="text-align: center;">
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