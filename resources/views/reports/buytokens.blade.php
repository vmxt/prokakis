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
                        <div class="col-6">
                            <div class="table-container">
                                <div class="table-content">
                                    <div class="box table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Free</th>
                                                    <th>Premium</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><strong> Access to Prokakis online marketplace </strong></td>
                                                    <td><img class='img_icon'  src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Online Support</strong></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Unlimited Creation of Opportunities</strong> </td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Unlimited Creation of Opportunities with Company Info </strong></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.svg') }}" width="20" height="20"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Unlimited Viewing of Public Profiles in Explore Page</strong></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.svg') }}" width="20" height="20"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Unlimited Access to Business News</strong></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.svg') }}" width="20" height="20"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Personalized Company Profile Page</strong></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.svg') }}" width="20" height="20"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Automated Ongoing Monitoring System</strong></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.svg') }}" width="20" height="20"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>*Data Repository for Awards and Licenses</strong></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.svg') }}" width="20" height="20"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>*Exclusive Invite to Prokakis Networking Events</strong></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-cross.svg') }}" width="20" height="20"></td>
                                                    <td><img class='img_icon' src="{{ asset('public/img-resources/icon-tick.svg') }}" width="24" height="24"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 omega">
                            <div id="box-monthly" data-plan="monthly" class="box plans">
                                <a class="btn-selection" data-frequency="year" data-coupon=""  >
                                    <div class="content">
                                        <span class="title">Top Up 1</span>
                                        <span class="price"><strong>2 TOKEN</strong><small></small></span>
                                        <span class="title"><b>$120</b></span>
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="1">
                                           <button type="submit" class="btn-subscribe" >Subscribe now</button>
                                        </form>
                                    </div>
                                </a>
                            </div>
                            <div id="box-monthly" data-plan="monthly" class="box plans">
                                <a class="-selection" data-frequency="month" data-coupon="" >
                                    <div class="content">
                                         <span class="title">Top Up 2</span>
                                        <span class="price"><strong>12 TOKEN</strong><small></small></span>
                                        <span class="title"><b>$720</b></span>
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="2">
                                           <button type="submit" class="btn-subscribe" >Subscribe now</button>
                                        </form>
                                    </div>
                                </a>
                            </div>
                            <div id="box-monthly" data-plan="monthly" class="box plans">
                                <a class="-selection" data-frequency="month" data-coupon="" >
                                    <div class="content">
                                        <span class="title">Top Up 3</span>
                                        <span class="price"><strong>20 TOKEN</strong><small></small></span>
                                        <span class="title"><b>$1200</b></span>
                                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="top_up" value="3">
                                           <button type="submit" class="btn-subscribe" >Subscribe now</button>
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
                    <div class="col-4 col-foot">
                        <div class="content">
                            <img  class="advantages-img"  src="{{ asset('public/img-resources/document.png') }}" width="96" alt="document" title="document">
                            <h3><strong>Document</strong></h3>
                            <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                    <div class="col-4 col-foot">
                        <div class="content">
                            <img  class="advantages-img"  src="{{ asset('public/img-resources/dollars.png') }}" width="96" alt="dollars" title="dollars">
                            
                            <h3><strong>Dollar</strong></h3>
                            <p>Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Cras ultricies ligula sed magna dictum porta. Donec sollicitudin molestie malesuada..</p>
                        </div>
                    </div>
                    <div class="col-4 col-foot">
                        <div class="content">
                            <img class="advantages-img"    src="{{ asset('public/img-resources/tax.png') }}" width="96" alt="Tax" title="Tax">
                            
                            <h3><strong>Tax</strong></h3>
                            <p>Donec sollicitudin molestie malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Donec rutrum congue leo eget malesuada. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
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