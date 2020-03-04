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
                <a href="{{ url('/opportunity') }}">Opportunity</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ url('/opportunity/select') }}">Add Opportunity</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Buy
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

                <form id="opportunity_build_form" method="POST" action="{{ route('opportunityStoreBuy') }}">
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
                                        <label for="business_goal"><b>Title for this Opportunity </b></label>
                                        <input type="text" class="form-control" name="opp_title" id="opp_title" value="<?php if(isset($data->opp_title)){ echo $data->opp_title; } ?>" />

                                    </div>
                                </div>
                            </div>

                            <div class="portlet light" style="margin-top: 10px;">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="business_goal"><b>Choose a Category</b></label>
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
                                      
                                            
                                            <?php 
                                            $wsf_product = '';
                                            $wsf_service = '';
                                            $wsf_business = '';
                                            if (isset($data->what_sell_offer) && $data->what_sell_offer != null) {
    
                                                $wsf = explode(",",$data->what_sell_offer);
    
                                                if(in_array("Product", $wsf)){
                                                    $wsf_product = "checked"; 
                                                }
    
                                                if(in_array("Service", $wsf)){
                                                    $wsf_service = "checked"; 
                                                }
    
                                                if(in_array("Business", $wsf)){
                                                    $wsf_business = "checked"; 
                                                }
    
                                             }
                                            ?>
    
                                                    <div class="md-checkbox-list">
    
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" name="checkboxes1[]" value="Product" id="checkbox1_1" class="md-check" <?php echo $wsf_product; ?> >
                                                            <label for="checkbox1_1">
                                                                <span class="inc"></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> Product </label>
                                                        </div>
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" name="checkboxes1[]" value="Service" id="checkbox1_2" class="md-check" <?php echo $wsf_service; ?>>
                                                            <label for="checkbox1_2">
                                                                <span class="inc"></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> Service </label>
                                                        </div>
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" name="checkboxes1[]" value="Business" id="checkbox1_3" class="md-check" <?php echo $wsf_business; ?>>
                                                            <label for="checkbox1_3">
                                                                <span class="inc"></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span> Business </label>
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
                                     

                                            <div class="md-radio-list">

                                                <div class="md-radio">
                                                    <input type="radio" id="consumer" value="Consumers(B2C)" name="audienceTarget" class="md-radiobtn" <?php if(isset($data->audience_target) && $data->audience_target == 'Consumers(B2C)'){ echo 'checked';  } ?>>
                                                    <label for="consumer">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> <b> Consumers(B2C) </b> <br />
 </label>
                                                </div>

                                                <div class="md-radio">
                                                    <input type="radio" id="business" value="Business(B2B)" name="audienceTarget" class="md-radiobtn" <?php if(isset($data->audience_target) && $data->audience_target == 'Business(B2B)'){ echo 'checked';  } ?>>
                                                    <label for="business">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> <b>Business(B2B)</b> <br />
 </label>
                                                </div>

                                      

                                            </div>

                                    </div>
                                </div>
                            </div>

                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="intro_describe_business"><b>Brief Introduction of your company</b> </label> <br/>

                                        <span>Describe your product or services. What do you want to achieve? Who are your
                                            ideal business partners?</span>
                                        <textarea rows="5" cols="20" class="form-control" name="intro_describe_business"
                                                  id="intro_describe_business"><?php if (isset($data->intro_describe_business)) {
                                                echo $data->intro_describe_business;
                                            } ?></textarea>

                                            <div class="alert alert-info">
                                                <span>Characters left:</spa><span style="color:red;" id="countIntro">500</span>
                                            </div>


                                   
                                    </div>
                                </div>
                            </div>

                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="why_partner_goal"><b>Describe your Requirement </b> <i>(Optional)</i></label> <br/>

                                        <span>What makes you stand out? What is your competitive advantage?</span>
                                        <textarea rows="5" cols="20" class="form-control" name="why_partner_goal"
                                                  id="why_partner_goal"><?php if (isset($data->why_partner_goal)) {
                                                echo $data->why_partner_goal;
                                            } ?></textarea>

                                            <div class="alert alert-info">
                                                <span>Characters left:</spa><span style="color:red;" id="countReq">500</span>
                                            </div>
                                     
                                    </div>
                                </div>
                            </div>

                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="timeframe_goal"><b>Timeframe</b>

                                            
                                            <div class="md-radio-list">

                                                <div class="md-radio">
                                                    <input type="radio" id="radioKS" value="Less than 1 year" name="timeFrame" class="md-radiobtn" <?php if(isset($data->timeframe_goal) && $data->timeframe_goal == 'Less than 1 year'){ echo 'checked';  } ?>>
                                                    <label for="radioKS">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> <b> Less than 1 year </b> <br />
 </label>
                                                </div>

                                                <div class="md-radio">
                                                    <input type="radio" id="radioBR" value="1 year to 3 years" name="timeFrame" class="md-radiobtn" <?php if(isset($data->timeframe_goal) && $data->timeframe_goal == '1 year to 3 years'){ echo 'checked';  } ?>>
                                                    <label for="radioBR">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> <b>1 year to 3 years</b> <br />
 </label>
                                                </div>

                                                <div class="md-radio">
                                                    <input type="radio" id="radioPR" value="More than 3 years" name="timeFrame" class="md-radiobtn" <?php if(isset($data->timeframe_goal) && $data->timeframe_goal == 'More than 3 years'){ echo 'checked';  } ?>>
                                                    <label for="radioPR">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> <b> More than 3 years </b> <br />
 </label>
                                                </div>

                                            </div>

                                    </div>
                                </div>
                            </div>


                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="approx_large"><b>What is the value of this Opportunity? </b> <i>(Optional)</i></label>
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
                                        <label for="ideal_partner_base"><b>(Indicate the location of your ideal partners)</b></label>
                                        <select class="form-control" id="ideal_partner_base"
                                                name="ideal_partner_base" multiple="true">
                                            <option value="" id="">Please select the following</option>
                                            <?php foreach($country_list as $c){
                                            if (isset($data->ideal_partner_base) && $c->country_name == $data->ideal_partner_base) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            ?>
                                            <option
                                                <?php echo $selected; ?> value="<?php echo $c->country_name; ?>"><?php echo $c->country_name; ?></option>
                                            <?php }  ?>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label for="ideal_partner_business"><b>Choose the ideal partner/s (You can choose more than 1 option)</b></label> <br/>
                                        
                                        <?php
                                        $ipb = array();
                                        $Consultant = '';
                                        $Constructor = '';
                                        $Distributor = '';
                                        $Holding_Company_Investments = '';
                                        $Import_Export = '';
                                        $Manufacturer = '';
                                        $Non_Profit = '';
                                        $Retailer = '';
                                        $Service_Provider = '';
                                        $Warehouse_and_Logisitcs = '';
                                        $Wholesaler = '';
                                        $Institution = '';
                                        $Any_business_type = '';

                                        if (isset($data->ideal_partner_business) && $data->ideal_partner_business != null ) {
                                            
                                            $ipb = explode(",", $data->ideal_partner_business);

                                            if(in_array("Consultant", $ipb)){
                                                $Consultant = "checked"; 
                                            }
                                            if(in_array("Constructor", $ipb)){
                                                $Constructor = "checked"; 
                                            }
                                            if(in_array("Distributor", $ipb)){
                                                $Distributor = "checked"; 
                                            }
                                            if(in_array("Distributor", $ipb)){
                                                $Distributor = "checked"; 
                                            }

                                            if(in_array("Holding_Company_Investments", $ipb)){
                                                $Holding_Company_Investments = "checked"; 
                                            }
                                            
                                            if(in_array("Import_Export", $ipb)){
                                                $Import_Export = "checked"; 
                                            }

                                            if(in_array("Manufacturer", $ipb)){
                                                $Manufacturer = "checked"; 
                                            }
                                            
                                            if(in_array("Non_Profit", $ipb)){
                                                $Non_Profit = "checked"; 
                                            }
                                            
                                            if(in_array("Retailer", $ipb)){
                                                $Retailer = "checked"; 
                                            }
                                            if(in_array("Service_Provider", $ipb)){
                                                $Service_Provider = "checked"; 
                                            }

                                            if(in_array("Warehouse_and_Logisitcs", $ipb)){
                                                $Warehouse_and_Logisitcs = "checked"; 
                                            }
                                            if(in_array("Wholesaler", $ipb)){
                                                $Wholesaler = "checked"; 
                                            }
                                            if(in_array("Institution", $ipb)){
                                                $Institution = "checked"; 
                                            }
                                            if(in_array("Any_business_type", $ipb)){
                                                $Any_business_type = "checked"; 
                                            }
                                        
                                        }

                                        ?>
                                        
                                        <div class="row">
                                          
                                            <div class="md-checkbox-list" style="padding-left:20px;">

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Consultant" id="checkbox2_1" class="md-check" <?php echo $Consultant; ?>>
                                                    <label for="checkbox2_1">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Consultant </label>
                                                </div>
                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Constructor" id="checkbox2_2" class="md-check" <?php echo $Constructor; ?>>
                                                    <label for="checkbox2_2">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Constructor </label>
                                                </div>
                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Distributor" id="checkbox2_3" class="md-check" <?php echo $Distributor; ?>>
                                                    <label for="checkbox2_3">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Distributor </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Holding_Company_Investments" id="checkbox2_4" class="md-check" <?php echo $Holding_Company_Investments; ?>>
                                                    <label for="checkbox2_4">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Holding Company/Investments </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Import_Export" id="checkbox2_5" class="md-check" <?php echo $Import_Export; ?>>
                                                    <label for="checkbox2_5">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Import / Export </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Manufacturer" id="checkbox2_6" class="md-check" <?php echo $Manufacturer; ?>>
                                                    <label for="checkbox2_6">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Manufacturer </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Non_Profit" id="checkbox2_7" class="md-check" <?php echo $Non_Profit; ?>>
                                                    <label for="checkbox2_7">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Non-Profit </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Retailer" id="checkbox2_8" class="md-check" <?php echo $Retailer; ?>>
                                                    <label for="checkbox2_8">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Retailer </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Service_Provider" id="checkbox2_9" class="md-check" <?php echo $Service_Provider; ?>>
                                                    <label for="checkbox2_9">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Service Provider </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Warehouse_and_Logisitcs" id="checkbox2_10" class="md-check" <?php echo $Warehouse_and_Logisitcs; ?>>
                                                    <label for="checkbox2_10">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Warehouse and Logisitcs </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Wholesaler" id="checkbox2_11" class="md-check" <?php echo $Wholesaler; ?>>
                                                    <label for="checkbox2_11">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Wholesaler </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Institution" id="checkbox2_12" class="md-check" <?php echo $Institution; ?>>
                                                    <label for="checkbox2_12">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Institution </label>
                                                </div>

                                                <div class="md-checkbox">
                                                    <input type="checkbox" name="checkboxes2[]" value="Any_business_type" id="checkbox2_13" class="md-check" <?php echo $Any_business_type; ?>>
                                                    <label for="checkbox2_13">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> Other Business Type </label>
                                                </div>

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
                                            <input type="text" placeholder="Type and click to add keyword"
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
                                <a href="{{ url('/opportunity') }}" class="btn default">Cancel</a>

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

        var maxLength = 500;

        $('#intro_describe_business').keyup(function() {
          var length = $(this).val().length;
          var length = maxLength-length;
          $(this).parent().find('#countIntro').text(length +"/"+maxLength);
        });

        $('#why_partner_goal').keyup(function() {
          var length = $(this).val().length;
          var length = maxLength-length;
          $(this).parent().find('#countReq').text(length +"/"+maxLength);
        });


    </script>

@endsection
