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

        .row > .col-sm-6, .col-sm-4, .col-sm-3 {
            padding: 0px;
        }

        .col-sm-12 {
            padding: 0px;
        }

        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .btn-x1 {
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 5px;
            width: 100%;
            background-color: gray;
        }

        .btn-x2 {
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 5px;
            width: 100%;
        }

        .btn-x22 {
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 5px;
            width: 100%;
        }

        .btn-x222 {
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 5px;
            width: 100%;
        }


        .btn-x3 {
            font-size: 15px;
            border-radius: 5px;
            width: 10%;
            background-color: orangered;
        }


    </style>

    <link href="{{ asset('public/selectJS/examples/css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('public/selectJS/examples/css/stylesheet.css') }}" rel="stylesheet">
    <link href="{{ asset('public/selectJS/dist/css/selectize.default.css') }}" rel="stylesheet">


    <script src="{{ asset('public/selectJS/examples/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/selectJS/examples/js/jqueryui.js') }}"></script>
    <script src="{{ asset('public/selectJS/dist/js/standalone/selectize.js') }}"></script>
    <script src="{{ asset('public/selectJS/examples/js/index.js') }}"></script>

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Opportunity</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Add Opportunity</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Sell
            </li>

        </ul>
        <div class="row justify-content-center">
            <div class="col-md-12" style="min-height:800px">

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

                <form id="opportunity_build_form" method="POST" action="{{ route('opportunityStoreSellOffer') }}">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header"><center>  <b>ADD A GOAL</b></center></div>
                        <div class="card-body center">

                            <center>Describe your business goal</center>
                            <input type="hidden" name="id" value="<?php if (isset($data->id)) {
                                echo $data->id;
                            } ?>">

                            <div class="portlet light" style="margin-top: 10px;">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="business_goal"><b>What do you sell or offer?</b></label>
                                        <input type="hidden" name="what_sell_offer" id="what_sell_offer"
                                               value="<?php if (isset($data->what_sell_offer) && $data->what_sell_offer == 'product') {
                                                   echo $data->what_sell_offer;
                                               } ?>">
                                        <?php
                                        $wso = array();
                                        if (isset($data->what_sell_offer)) {
                                            $wso = explode(", ", $data->what_sell_offer);
                                        }

                                        ?>
                                        <div class="row">
                                            <div class="col col-sm-4">
                                                <button type="button" onclick="whatSellOffer(this);" id="Product"
                                                        class="btn btn-success <?php if (in_array('Product', $wso)) {
                                                            echo 'btn-x222';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">PRODUCT
                                                </button>
                                            </div>
                                            <div class="col col-sm-4">
                                                <button type="button" onclick="whatSellOffer(this);" id="Service"
                                                        class="btn btn-success <?php if (in_array('Service', $wso)) {
                                                            echo 'btn-x222';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">SERVICE
                                                </button>
                                            </div>
                                            <div class="col col-sm-4">
                                                <button type="button" onclick="whatSellOffer(this);" id="Business"
                                                        class="btn btn-success <?php if (in_array('Business', $wso)) {
                                                            echo 'btn-x222';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">BUSINESS
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="audience_target"><b>What audience are you targeting with this
                                                opportunity?</b> <i>(Optional)</i></label>
                                        <input
                                            <?php if (isset($data->audience_target) && $data->audience_target == 'Consumers(B2C)') {
                                                echo 'checked="checked"';
                                            }  ?> type="radio" value="Consumers(B2C)" name="audience_target"
                                            id="audience_target"> Consumers(B2C) <br/>
                                        <input
                                            <?php if (isset($data->audience_target) && $data->audience_target == 'Business(B2B)') {
                                                echo 'checked="checked"';
                                            }  ?> type="radio" value="Business(B2B)" name="audience_target"
                                            id="audience_target"> Business(B2B) <br/>
                                    </div>
                                </div>
                            </div>

                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="intro_describe_business"><b>Introduce yourself and describe your
                                                business goal.</b> </label> <br/>
                                        <textarea rows="5" cols="20" class="form-control" name="intro_describe_business"
                                                  id="intro_describe_business"><?php if (isset($data->intro_describe_business)) {
                                                echo $data->intro_describe_business;
                                            } ?></textarea>
                                        <i>Describe your product or services. What do you want to achieve? Who are your
                                            ideal business partners?</i>
                                    </div>
                                </div>
                            </div>

                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="why_partner_goal"><b>Why would another company want to partner with
                                                to
                                                achieve this goal?</b> <i>(Optional)</i></label> <br/>
                                        <textarea rows="5" cols="20" class="form-control" name="why_partner_goal"
                                                  id="why_partner_goal"><?php if (isset($data->why_partner_goal)) {
                                                echo $data->why_partner_goal;
                                            } ?></textarea>
                                        <i>What makes you stand out? What's your competitive advantage?</i>
                                    </div>
                                </div>
                            </div>

                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="timeframe_goal"><b>What's the timeframe for this goal</b>
                                            <i>(Optional)</i></label> <br/>
                                        <input type="hidden" name="timeframe_goal" id="timeframe_goal"
                                               value="<?php if (isset($data->timeframe_goal) && $data->timeframe_goal == 'SHORT-TERM') {
                                                   echo 'SHORT-TERM';
                                               } else {
                                                   echo 'LONG-TERM';
                                               }  ?>">
                                        <div class="row">
                                            <div class="col col-sm-6">
                                                <button type="button" onclick="timeFrame(this);"
                                                        id="timeframe_goal_short"
                                                        class="btn btn-success <?php if (isset($data->timeframe_goal) && $data->timeframe_goal == 'SHORT-TERM') {
                                                            echo 'btn-x22';
                                                        } else {
                                                            echo 'btn-x1';
                                                        }  ?>">SHORT-TERM
                                                </button>
                                            </div>
                                            <div class="col col-sm-6">
                                                <button type="button" onclick="timeFrame(this);"
                                                        id="timeframe_goal_long"
                                                        class="btn btn-success <?php if (isset($data->timeframe_goal) && $data->timeframe_goal == 'LONG-TERM') {
                                                            echo 'btn-x22';
                                                        } else {
                                                            echo 'btn-x1';
                                                        }  ?>">LONG-TERM
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="approx_large"><b>Approximately how large is this Opportunity</b> <i>(Optional)</i></label>
                                        <select class="form-control" id="approx_large" name="approx_large">
                                            <option value="" id="">Please select one of the following</option>
                                            <?php foreach($approx_large_list as $key => $value){
                                            if (isset($data->approx_large) && $key == $data->approx_large) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            ?>
                                            <option
                                                <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>
                                            <?php }  ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>

                    <div class="card">
                        <div class="card-header"><center><b>ADD PARAMETERS</b></center></div>
                        <div class="card-body center">

                          <center> Tell us what kind of partner you are looking for? </center>
                            <div class="portlet light" style="margin-top: 10px;">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="ideal_partner_base"><b>Do you have a preference where the ideal
                                                partner
                                                is based</b></label>
                                        <select class="form-control" id="ideal_partner_base"
                                                name="ideal_partner_base" multiple="true">
                                            <option value="" id="">Please select the following</option>
                                            <?php 
                                            foreach($country_list as $c){
                                                if (isset($data->ideal_partner_base) && $c->country_name == $data->ideal_partner_base) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                }
                                            ?>
                                            <option
                                                <?php echo $selected; ?> value="<?php echo $c->country_name  ?>"><?php echo $c->country_name; ?>
                                            </option>
                                            <?php }  ?>

                                        </select>

                                    </div>
                                </div>
                            </div>


                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="ideal_partner_business"><b>Is an ideal partner any of below
                                                types?</b></label> <br/>
                                        <input type="hidden" name="ideal_partner_business" id="ideal_partner_business"
                                               value="<?php if (isset($data->ideal_partner_business)) {
                                                   echo $data->ideal_partner_business;
                                               } ?>">

                                        <?php
                                        $ipb = array();
                                        if (isset($data->ideal_partner_business)) {
                                            $ipb = explode(", ", $data->ideal_partner_business);
                                        }

                                        ?>
                                        <div class="row">
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Consultant"
                                                        class="btn btn-success <?php if (in_array('Consultant', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Consultant
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Contractor"
                                                        class="btn btn-success <?php if (in_array('Contractor', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Contractor
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Distributor"
                                                        class="btn btn-success <?php if (in_array('Distributor', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Distributor
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);"
                                                        id="Holding_Company_Investments"
                                                        class="btn btn-success <?php if (in_array('Holding_Company_Investments', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Holding Company/Investments
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Import_Export"
                                                        class="btn btn-success <?php if (in_array('Import_Export', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Import/Export
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Manufacturer"
                                                        class="btn btn-success <?php if (in_array("Manufacturer", $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Manufacturer
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Non_Profit"
                                                        class="btn btn-success <?php if (in_array('Non_Profit', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Non-Profit
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Retailer"
                                                        class="btn btn-success <?php if (in_array('Retailer', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Retailer
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Service_Provider"
                                                        class="btn btn-success <?php if (in_array('Service_Provider', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Service Provider
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Warehouse_Logistics"
                                                        class="btn btn-success <?php if (in_array('Warehouse_Logistics', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Warehouse and Logistics
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Wholesaler"
                                                        class="btn btn-success <?php if (in_array('Wholesaler', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Wholesaler
                                                </button>
                                            </div>
                                            <div class="col col-sm-3">
                                                <button type="button" onclick="removeBG(this);" id="Institution"
                                                        class="btn btn-success <?php if (in_array('Institution', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Institution
                                                </button>
                                            </div>
                                            <div class="col col-sm-12" style="padding: 0px;">
                                                <button type="button" onclick="removeBG(this);" id="Any_business_type"
                                                        class="btn btn-success <?php if (in_array('Any_business_type', $ipb)) {
                                                            echo 'btn-x2';
                                                        } else {
                                                            echo 'btn-x1';
                                                        } ?>">Any business type
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="ideal_partner_base"><b>Please provide any relevant industry, product
                                                or
                                                sector keywords describing an ideal partner.</b></label> <br/>

                                        <div class="input-group mb-3">
                                            <!-- <div class="input-group-prepend">
                                               <span class="input-group-text">@</span>
                                             </div>-->
                                            <div class="input-group-append">
                                                <span class="input-group-text">Enter Keywords</span>
                                            </div>
                                            <input type="text" placeholder="Type and click add keyword"
                                                   class="form-control input-tags demo-default"
                                                   id="relevant_describing_partner" name="relevant_describing_partner"
                                                   value="<?php if (isset($data->relevant_describing_partner)) {
                                                       echo $data->relevant_describing_partner;
                                                   } ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions left">
                                <input type="button" class="btn default" value="Cancel"
                                       id="cancelButtonCompanyProfile"/>
                                <input id="saveButtonBuilding" type="submit"
                                       class="btn green" value="Save"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--<script src="{{ asset('public/jq1110/jquery.min.js') }}"></script>-->

    <script>

        function IPB() {
            var str = '';

            $('button').each(function (index, value) {
                console.log('button' + index + ':' + $(this).attr('id'));

                if ($("#" + $(this).attr('id')).hasClass("btn-x2") == true) {
                    str = str + $(this).attr('id') + ", ";
                }


            });
            $("#ideal_partner_business").val(str);

        }

        function removeBG(vic) {

            if ($("#" + vic.id).hasClass("btn-x1") == true) {
                $("#" + vic.id).removeClass("btn-x1");
                $("#" + vic.id).addClass("btn-x2");
            } else {
                $("#" + vic.id).removeClass("btn-x2");
                $("#" + vic.id).addClass("btn-x1");
            }
            IPB();
        }


        function timeFrame() {

            if ($("#timeframe_goal_short").hasClass("btn-x1") == true) {
                $("#timeframe_goal_short").removeClass("btn-x1");
                $("#timeframe_goal_short").addClass("btn-x22");
                $("#timeframe_goal_long").removeClass("btn-x22");
                $("#timeframe_goal_long").addClass("btn-x1");
                $("#timeframe_goal").val("SHORT-TERM");
            } else {

                $("#timeframe_goal_long").removeClass("btn-x1");
                $("#timeframe_goal_long").addClass("btn-x22");
                $("#timeframe_goal_short").removeClass("btn-x22");
                $("#timeframe_goal_short").addClass("btn-x1");
                $("#timeframe_goal").val("LONG-TERM");
            }

        }

        function WSO() {
            var str = '';

            $('button').each(function (index, value) {
                console.log('button' + index + ':' + $(this).attr('id'));

                if ($("#" + $(this).attr('id')).hasClass("btn-x222") == true) {
                    str = str + $(this).attr('id') + ", ";
                }


            });
            $("#what_sell_offer").val(str);

        }


        function whatSellOffer(vic) {
            console.log('button : ' + vic.id);

            if ($("#" + vic.id).hasClass("btn-x1") == true) {
                $("#" + vic.id).removeClass("btn-x1");
                $("#" + vic.id).addClass("btn-x222");
            } else {
                $("#" + vic.id).removeClass("btn-x222");
                $("#" + vic.id).addClass("btn-x1");
            }

            WSO();
        }

        $('#relevant_describing_partner').selectize({
            plugins: ['remove_button'],
            persist: false,
            create: true,
            render: {
                item: function (data, escape) {
                    return '<div>"' + escape(data.text) + '"</div>';
                }
            },
            onDelete: function (values) {
                return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
            }
        });


        function cancelBut() {
            $("#opportunity_build_form").reset();
        }

    </script>

@endsection







