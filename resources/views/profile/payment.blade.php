@extends('layouts.app')

@section('content')
    <link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            overflow: visible;
        }

        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 15px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
        }

        .containerCimg {

        }

        .actionCimg {
            width: 300px;
            height: 30px;
            margin: 5px 0;
            float: left;
        }

        .croppedCimg > img {
            margin-right: 10px;
        }
    </style>

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Profile</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Payment History</span>
            </li>
        </ul>
        <div class="row justify-content-center">
            <div class="page-content-inner">
                <div class="mt-content-body">
                    <div class="col-md-4 justify-content-center">
                        <div class="portlet light">
                            <div class="card">
                                <div class="card-header">

                                    <div class="containerCimg">
                                        <div id="croppedCimg" class="croppedCimg" align="center">
                                        </div>

                                        <div class="imageBoxCimg">
                                            <div class="thumbBoxCimg"><img
                                                        src="{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>">
                                            </div>

                                        </div>
                                        <div class="niceDisplay">
                                            <?php if (isset($brand_slogan[0])) {
                                                echo $brand_slogan[0];
                                            } ?>
                                        </div>
                                    </div>

                                    <div><br/></div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="page-content-inner">
                <div class="mt-content-body">
                    <div class="page-content-inner">
                        <div class="mt-content-body">
                            <div class="col col-md-8">
                                <div class="portlet light">
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


                                      <div class="card">

                                        <div class="card-header"><b>PURCHASED HISTORY INFORMATION</b></div>

                                        <div align="right"><a href="{{ url('/profile/printPreviewTokenPurchased').'/'.$company_id_result }}" target="_blank">Print Preview</a></div><br />

                                        <table id="system_data" class="display" style="max-width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Payment</th>
                                                <th>Amount</th>
                                                <th>Date Created</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(count((array)$rs_buy) > 0){
                                            foreach($rs_buy as $data){ ?>
                                            <tr>
                                                <td><?php echo $data->id; ?></td>
                                                <td><?php echo 'Token Purchased: '. $data->num_tokens; ?></td>
                                                <td><?php echo $data->amount; ?> </td>
                                                <td><?php echo $data->created_at; ?> </td>

                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <tr>
                                                <td colspan="4">You have no purchased record.</td>
                                            </tr>
                                            <?php

                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Payment</th>
                                                <th>Details</th>
                                                <th>Date Created</th>
                                            </tr>
                                            </tfoot>
                                        </table>

                                    </div>
                                </div>
                                <div class="portlet light">
                                    <div class="card">

                                        <div class="card-header"><b>TOKEN SPENT HISTORY INFORMATION</b></div>

                                        <div align="right"><a href="{{ url('/profile/printPreviewTokenSpent').'/'.$company_id_result }}" target="_blank">Print Preview</a></div><br />

                                        <table id="system_data2" class="display" style="max-width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Request Id</th>
                                                <th>Number of Tokens</th>
                                                <th>Date Created</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(count((array)$rs_spent) > 0){
                                            foreach($rs_spent as $data){ ?>
                                            <tr>
                                                <td><?php echo $data->id; ?></td>
                                                <td><?php echo $data->request_id; ?></td>
                                                <td><?php echo $data->num_tokens; ?> </td>
                                                <td><?php echo $data->created_at; ?> </td>

                                            </tr>
                                            <?php }
                                            } else { ?>
                                            <tr>
                                                <td colspan="4">You have no token spending record.</td>
                                            </tr>
                                            <?php

                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Id</th>
                                                <th>Payment</th>
                                                <th>Details</th>
                                                <th>Date Created</th>
                                            </tr>
                                            </tfoot>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('public/js/app.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
        <script type="text/javascript" charset="utf8"
                src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#system_data').DataTable();
                $('#system_data2').DataTable();

            });




        </script>

@endsection
