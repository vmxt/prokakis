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

        <div class="container" style="margin-top: 20px;">

        <div class="col col-md-4">

            <div class="portlet light">

            <div class="card" style="padding: 10px;">

                <div class="card-header" style="text-align: center;"><b>Top Up 1</b></div>



                <div id="container">

                    <div class="row justify-content-center">

                        <img class="center" src="{{ asset('public/img-resources/123.png') }}">

                    </div>

                    <div class="row justify-content-center" style="font-weight: bold;">

                       <center> 2 Tokens</center>

                    </div>

                    <div class="row justify-content-center" style="color:#1a4275;  font-weight: bold; margin-bottom: 20px;">

                        <center>$ 120 </center>

                    </div>



                    <div class="row justify-content-center">

                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">

                            {{ csrf_field() }}

                            <input type="hidden" name="top_up" value="1">

                            <input type="submit" class="btn btn-x3" style="background-color:#1a4275; color:white;" value="Buy">

                        </form>

                    </div>



                </div>

            </div>

            </div>

        </div>



        <div class="col col-md-4">

            <div class="portlet light">

            <div class="card" style="padding: 10px;">

                <div class="card-header" style="text-align: center;"><b>Top Up 2</b></div>



                <div id="container">



                    <div class="row justify-content-center">

                        <img align="center" class="center" src="{{ asset('public/img-resources/2.png') }}">

                    </div>



                    <div class="row justify-content-center" style="font-weight: bold;">

                        <center>12 Tokens</center>

                    </div>



                    <div class="row justify-content-center" style="color:#1a4275;  font-weight: bold;">

                        <center>$ 720</center>

                    </div>

                    <br/>

                    <div class="row justify-content-center">

                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">

                            {{ csrf_field() }}

                            <input type="hidden" name="top_up" value="2">

                            <input type="submit" class="btn btn-x3" style="background-color:#1a4275; color:white;" value="Buy">

                        </form>

                    </div>





                </div>

            </div>

            </div>

        </div>



        <div class="col col-md-4">

            <div class="portlet light">

            <div class="card" style="padding: 10px;">

                <div class="card-header" style="text-align: center;"><b>Top Up 3</b></div>



                <div id="container">

                    <div class="row justify-content-center">

                        <img class="center" src="{{ asset('public/img-resources/3.png') }}">

                    </div>



                    <div class="row justify-content-center" style="font-weight: bold;">

                        <center>20 Tokens</center>

                    </div>



                    <div class="row justify-content-center" style="color:#1a4275;  font-weight: bold;">

                        <center>$ 1200</center>

                    </div>

                    <br/>

                    <div class="row justify-content-center">

                        <form id="top1_form" method="POST" action="{{ route('reportsTopUpTokens') }}">

                            {{ csrf_field() }}

                            <input type="hidden" name="top_up" value="3">

                            <input type="submit" class="btn btn-x3" style="background-color:#1a4275; color:white;" value="Buy">

                        </form>

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