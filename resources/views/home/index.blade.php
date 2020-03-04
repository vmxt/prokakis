@extends('layouts.app')

<style>
    html, body {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }


</style>

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <style>
        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            font-weight: bold;
            font-size: 15px;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            color: orangered;
        }

        .btn-x3 {
            font-size: 15px;
            border-radius: 5px;
            width: 25%;
            background-color: orangered;
            margin-top: 10px;
        }

        .close {
            line-height: 12px;
            width: 18px;
            font-size: 8pt;
            font-family: tahoma;
            margin-top: 20px;
            margin-right: 20px;
            position: absolute;
            top: 0;
            right: 0;
        }


        * {
            margin: 0;
            padding: 0;
        }

        .pie {
            background-color: #ecc0b7;
            width: 200px;
            height: 200px;
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            position: relative;
        }

        .clip1 {
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            height: 200px;
            clip: rect(0px, 200px, 200px, 100px);
        }

        .slice1 {
            position: absolute;
            width: 200px;
            height: 200px;
            clip: rect(0px, 100px, 200px, 0px);
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            background-color: #f7e5e1;
            border-color: #f7e5e1;
            -moz-transform: rotate(0);
            -webkit-transform: rotate(0);
            -o-transform: rotate(0);
            transform: rotate(0);
        }

        .clip2 {
            position: absolute;
            top: 0;
            left: 0;
            width: 100px;
            height: 100px;
            clip: rect(0, 100px, 200px, 0px);
        }

        .slice2 {
            position: absolute;
            width: 200px;
            height: 200px;
            clip: rect(0px, 200px, 200px, 100px);
            -moz-border-radius: 100px;
            -webkit-border-radius: 100px;
            border-radius: 100px;
            background-color: #f7e5e1;
            border-color: #f7e5e1;
            -moz-transform: rotate(0);
            -webkit-transform: rotate(0);
            -o-transform: rotate(0);
            transform: rotate(0);
        }

        .status {
            position: absolute;
            height: 30px;
            width: 200px;
            line-height: 60px;
            text-align: center;
            top: 50%;
            margin-top: -35px;
            font-size: 50px;
        }

        .panel-body {
            overflow-x: scroll;
            max-height: 400px;
        }
        .panel-body::-webkit-scrollbar { width: 0 !important }
    </style>

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Dashboard</span>
            </li>
        </ul>

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

        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- graph card -->
                <div class="page-content-inner">
                    <div class="mt-content-body">
                        <div class="portlet light ">
                            <div class="card">
                                <div class="note note-success">
                                    <h4 class="block">ENHANCE YOUR COMPANY PROFILE COMPLETION SCORE</h4>
                                </div>
                                <div class="row">
                                    <div class="col col-md-4">
                                        <div class="pie">
                                            <div class="clip1">
                                                <div class="slice1"></div>
                                            </div>
                                            <div class="clip2">
                                                <div class="slice2"></div>
                                            </div>
                                            <div class="status"></div>
                                        </div>
                                    </div>
                                    <div class="col col-lg-8" style="margin-top: 5px;">
                                        <div class="alert alert-info"
                                             style="width: 100%; overflow: hidden; margin-left: 0px !important;"><p>
                                                <strong>Prokakis members</strong> are three times more likely
                                                to engage with you if your company profile is over 30% complete.
                                                Be sure to include accurate information.
                                            </p>
                                        </div>
                                        <a href="{{ route('editProfile') }}" class="btn red-mint"
                                           style="margin-top: 15px;">Enhance
                                            Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- widgets -->

                <div class="row widget-row">
                    <div class="col-md-6">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">PENDING PROFILE REQUEST</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-clock-o"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden"></span>
                                    <span class="widget-thumb-body-stat" style="margin-top: 20px;">
                                            <span class="counter"
                                                  data-count=" <?php if (!empty($pendingRequestReport)) {
                                                      echo $pendingRequestReport;
                                                  } ?>"></span>

                                        </span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                    <div class="col-md-6">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">AWAITING RESPONSE</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-reply-all"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden"></span>
                                    <span class="widget-thumb-body-stat" style="margin-top: 20px;">
                                            <span class="counter" data-count=" <?php
                                            if (!empty($awaitingresponsetogenreport)) {
                                                if ($awaitingresponsetogenreport == 0) {
                                                    echo "0";
                                                } else echo $awaitingresponsetogenreport;
                                            }?>"></span>

                                        </span>

                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>


                <div class="row widget-row">
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20">
                            <h4 class="widget-thumb-heading">ONGOING MONITORING</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-eye" aria-hidden="true"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> <br>
                                    <span class="widget-thumb-body-stat">
                                            <span class="counter" data-count=" <?php if (!empty($ongoingMonitoring)) {
                                                echo $ongoingMonitoring;
                                            } ?>"></span>

                                        </span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">GENERATED REPORT</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue icon-layers"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> <br>
                                    <span class="widget-thumb-body-stat"> <span class="counter"
                                                                                data-count="<?php if (!empty($generatedreport)) {
                                                                                    echo $generatedreport;
                                                                                } ?>"></span></span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>

                    <div class="col-md-4">
                        <!-- BEGIN WIDGET THUMB -->
                        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                            <h4 class="widget-thumb-heading">COMPLETED REPORT</h4>
                            <div class="widget-thumb-wrap">
                                <i class="widget-thumb-icon bg-blue fa fa-newspaper-o"></i>
                                <div class="widget-thumb-body">
                                    <span class="widget-thumb-subtitle hidden">USD</span> <br>
                                    <span class="widget-thumb-body-stat">
                                            <span class="counter" data-count=" <?php if (!empty($process_report)) {
                                                echo $process_report;
                                            } ?>"></span>

                                        </span>
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET THUMB -->
                    </div>
                </div>
            </div>


            <div class="col-md-4" style="min-height:800px;">
                <!-- sidebar token credit -->
                <div class="page-content-inner">
                    <div class="mt-content-body">
                        <div class="portlet light ">
                            <div class="card" style="overflow: hidden;">
                                <div class="card-header" style="margin-bottom: 25px;">
                                    <center><span class="bold uppercase font-blue">Token Credit</span>
                                        <hr>
                                    </center>
                                </div>
                                <div class="card-body center" style="text-align: center;">
                                    <b class="font-red-mint" style="font-size: 20px;"> <?php

                                        $user_id = Auth::id();
                                        $company_id_result = App\CompanyProfile::getCompanyId($user_id);

                                        if (App\SpentTokens::validateLeftBehindToken($company_id_result) == false) {
                                            echo "0";
                                        } else {
                                            $consumedTokens = App\SpentTokens::validateLeftBehindToken($company_id_result);
                                            echo $consumedTokens;
                                        }
                                        ?>  </b> <br/>
                                    Token Left <br/>
                                    <div class="col-sm-12">
                                        <a href="{{ route('reportsBuyTokens') }}" class="btn red-mint fa fa-bitcoin"
                                           style="width: 100%;"> Top Up</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Log activity sidebar -->

                <div class="panel">
                    <div class="panel-heading">
                        <span class="caption-subject font-blue-steel bold uppercase"> <i class="fa fa-tv"></i> recent activities</span>
                    </div>
                    <div class="panel-body">
                        <?php
                        $log = App\AuditLog::where('user_id', Auth::id())->orderBy('id', 'desc')->take(100)->get();
                        if (count((array)$log) - 1 > 0) {
                        foreach ($log as $l) {
                        $date = date("F j, Y, g:i a", strtotime($l->created_at));
                        $activity = $l->action . ' ' . $l->model;
                        ?>
                        <ul class="feeds list-group" style="border-style:none; margin-bottom: 5px;">
                            <li class="list-group-item">
                                <a href="javascript:;">
                                    <div class="col1">
                                        <div class="cont">
                                            <div class="cont-col1">
                                                <div class="label label-sm label-info">
                                                    <i class="fa fa-bell-o"></i>
                                                </div>
                                            </div>
                                            <div class="cont-col2">
                                                <div class="desc"> <?php echo $activity?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col2">
                                        <div class="date"> <span style="font-size: 9px"><?php  echo $date; ?></span></div>
                                    </div>
                                </a>
                            </li>

                        </ul>
                        <?php }
                        }?>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/jq1110/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $(".close").click(function () {
                $(".jumbotron").remove();
            });

            progressBarUpdate(<?php echo $completenessProfile; ?>, 100);

        });


        function rotate(element, degree) {
            element.css({
                '-webkit-transform': 'rotate(' + degree + 'deg)',
                '-moz-transform': 'rotate(' + degree + 'deg)',
                '-ms-transform': 'rotate(' + degree + 'deg)',
                '-o-transform': 'rotate(' + degree + 'deg)',
                'transform': 'rotate(' + degree + 'deg)',
                'zoom': 1
            });
        }

        function progressBarUpdate(x, outOf) {
            var firstHalfAngle = 180;
            var secondHalfAngle = 0;

            // caluclate the angle
            var drawAngle = x / outOf * 360;

            // calculate the angle to be displayed if each half
            if (drawAngle <= 180) {
                firstHalfAngle = drawAngle;
            } else {
                secondHalfAngle = drawAngle - 180;
            }

            // set the transition
            rotate($(".slice1"), firstHalfAngle);
            rotate($(".slice2"), secondHalfAngle);

            // set the values on the text
            $(".status").html(x + "%");
        }


    </script>

    <script>
        $('.counter').each(function () {
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({countNum: $this.text()}).animate({
                    countNum: countTo
                },

                {

                    duration: 8000,
                    easing: 'linear',
                    step: function () {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function () {
                        $this.text(this.countNum);
                        //alert('finished');
                    }

                });


        });
    </script>
@endsection
