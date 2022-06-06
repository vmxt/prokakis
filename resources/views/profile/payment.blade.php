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

        .card-header {
            margin-bottom: 15px !important;
        }

        @media (max-width: 426px){
            .page-wrapper {
                width: 120% !important;
            }

            .page-container {
                background-color: #FFFFFF;
            }
        }

 .cardborder-radius{
        border-radius: 20px !important;
        border: 1px solid #a5a5a5; ;
    }
    
     .cardborder-radius:hover{
        box-shadow:  0 8px 16px 0 rgb(187 187 187) !important;
    }
    
     .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}

    </style>
<link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">
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


                                      <div class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">

                                        <h4 class="card-title"><b>PURCHASED HISTORY INFORMATION</b></h4>

                                        <div align="right">
                                            <a  href="{{ url('/profile/printPreviewTokenPurchased').'/'.$company_id_result }}" target="_blank"><button class="btn btn-primary lg">Print Preview</button></a>
                                            <a  href="{{ url('/profile/paymentHistoryPdf').'/'.$company_id_result.'/buyToken' }}" target="_blank"><button class="btn btn-primary lg">Download PDF</button></a>
                                        </div><br />

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
                                                <td><?php echo 'Credit Purchased: '. $data->num_tokens; ?></td>
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
                                
                                     <div class="card cardborder-radius" style="border:1px solid silver;background:white;margin-bottom:10px">
                <div class="card-body" style="padding:20px">

                                        <h4 class="card-title"><b>CREDIT SPENT HISTORY INFORMATION</b></h4>

                                        <div align="right">
                                            <a  href="{{ url('/profile/printPreviewTokenSpent').'/'.$company_id_result }}" target="_blank"><button class="btn btn-primary lg">Print Preview</button></a>
                                            <a  href="{{ url('/profile/paymentHistoryPdf').'/'.$company_id_result.'/spentToken' }}" target="_blank"><button class="btn btn-primary lg">Download PDF</button></a>

                                        </div><br />

                                        <table id="system_data2" class="display" style="max-width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Request Id</th>
                                                <th>Number of Credit</th>
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
                                                <td colspan="4">You have no credit spending record.</td>
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
