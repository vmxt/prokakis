@extends('layouts.app')



@section('content')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="{{ asset('public/js/jaaulde-cookies.js') }}"></script>

   <style>
  .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
        html, body {

            width: 100%;

            height: 100%;

            margin: 0px;

            padding: 0px;

            overflow-x: hidden;

        }



        .row > .col-sm-3 {

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





        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 10%;

            background-color: orangered;

        }



        .demo-default{

            border: none;

        }

        #relevant_describing_partner-selectized{
            max-width: 100% !important;
            width: auto !important;
        }

        /* carousel */
        /* Global */



/* Page Header */
.page-header {
    background: #f9f9f9;
    margin: -30px -40px 40px;
    padding: 20px 40px;
    border-top: 4px solid #ccc;
    color: #999;
    text-transform: uppercase;
    }
    .page-header h3 {
        line-height: 0.88rem;
        color: #000;
        }



/* Boxes
------------------------------------------------ */
.thumbnail a {
    text-decoration: none !important;
    pointer-events: none;
    cursor: default;
    color: #454545;
}

/* List style */
ul.thumbnails { 
  list-style: none; 
  margin: 0;
  padding: 0;
  }

.caption-box h4 {
    font-size: 0.94rem;
    color: #444;
    }
    .caption-box p {
        font-size: 0.75rem;
        color: #999;
        }
        .btn.btn-mini {
            font-size: 0.63rem;
            }



/* Control box 
------------------------------------------------ */
.control-box {
    width: 100%;
    }
    .carousel-control{
        background: #666 !important;
        border: 0px;
        border-radius: 0px;
        display: inline-block;
        font-size: 34px;
        font-weight: 200;
        line-height: 18px;
        opacity: 0.5;
        padding: 4px 10px;
        margin: 30px -20px 0;
        height: 30px;
        width: 30px;
        }



/* Mobile only
------------------------------------------------ */
@media (max-width: 767px) {
    .page-header { text-align: center; } 
}
@media (max-width: 479px) {
    .caption-box { word-break: break-all; }
    ul.thumbnails li { margin-bottom: 30px; }
}


/* Footer 
------------------------------------------------ */
footer.info { text-align: center; color: #888; margin: 30px 0; }
footer.info a { color: #fff; }
footer.info p { color: #ccc; margin: 10px 0; }



/* ADD-ON
------------------------------------------------ */


::selection { background: #ff5e99; color: #FFFFFF; text-shadow: 0; }
::-moz-selection { background: #ff5e99; color: #FFFFFF; }

a, a:focus, a:active, a:hover, object, embed {
 outline: none; 
}

:-moz-any-link:focus { 
    outline: none;
     }
input::-moz-focus-inner { 
    border: 0; 
}

.portlet2.light2 {
    padding: 12px 50px 15px;
    background-color: #fff;
}

.industry_select:hover{
      background-color: #bce8f1;
      color: white;
      box-shadow: 0 8px 16px 0 #1b9dec;
}

.industry_select:active{
      background-color: #bce8f1;
      color: white;
      box-shadow: 0 8px 16px 0 #1b9dec;
}

.industry_active{
      background-color: #bce8f1;
      color: white;
      box-shadow: 0 8px 16px 0 #1b9dec
}

.tag-required{
    border: 2px dashed red;
}

    </style>



    <link href="{{ asset('public/selectJS/examples/css/normalize.css') }}" rel="stylesheet">

    <link href="{{ asset('public/selectJS/examples/css/stylesheet.css') }}" rel="stylesheet">

    <link href="{{ asset('public/selectJS/dist/css/selectize.default.css') }}" rel="stylesheet">

    <link href="{{ asset('public/multiselectJS/select2.css') }}" rel="stylesheet">





    <script src="{{ asset('public/selectJS/examples/js/jquery.min.js') }}"></script>

    <script src="{{ asset('public/selectJS/examples/js/jqueryui.js') }}"></script>

    <script src="{{ asset('public/selectJS/dist/js/standalone/selectize.js') }}"></script>

    <script src="{{ asset('public/selectJS/examples/js/index.js') }}"></script>

    <script src="{{ asset('public/multiselectJS/select2.js') }}"></script> 



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

                                        <label for="business_goal"><b>Title for this Opportunity </b><span style="color: red; font-weight: bolder;"> *</span></label>

                                        <input required="required" type="text" class="form-control" name="opp_title" id="opp_title" value="<?php if(isset($data->opp_title)){ echo $data->opp_title; } ?>" />

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

                                                            <input type="checkbox" name="checkboxes1[]" value="Product" id="checkbox1_1" class="md-check categoryCheck" <?php echo $wsf_product; ?> >

                                                            <label for="checkbox1_1">

                                                                <span class="inc"></span>

                                                                <span class="check"></span>

                                                                <span class="box"></span> Product </label>

                                                        </div>

                                                        <div class="md-checkbox">

                                                            <input type="checkbox" name="checkboxes1[]" value="Service" id="checkbox1_2" class="md-check categoryCheck" <?php echo $wsf_service; ?>>

                                                            <label for="checkbox1_2">

                                                                <span class="inc"></span>

                                                                <span class="check"></span>

                                                                <span class="box"></span> Service </label>

                                                        </div>

                                                        <div class="md-checkbox">

                                                            <input type="checkbox" name="checkboxes1[]" value="Business" id="checkbox1_3" class="md-check categoryCheck" <?php echo $wsf_business; ?>>

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

                                                    <input type="radio" id="radioKS" value="Less than 1 year" name="timeFrame" class="md-radiobtn" <?php if(isset($data->timeframe_goal) && $data->timeframe_goal == 'Less than 1 year'){ echo 'checked';  }else{echo 'checked';} ?>>

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

                                        <label for="ideal_partner_base"><b>(Indicate the location of your ideal partners)</b> Type and click to add Countries </label>

                                        <select class="form-control" id="ideal_partner_base"

                                                name="ideal_partner_base[]" multiple="multiple">

                                            <option value="" id="">Please select the following</option>

                                            <?php

                                            if(isset($data->ideal_partner_base)){

                                                $listPartnerBase = explode(",",$data->ideal_partner_base);

                                            }

                                            foreach($country_list as $c){

                                                if (isset($data->ideal_partner_base) && in_array( $c->country_name , $listPartnerBase) ) {

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

                                                    <input type="checkbox" name="checkboxes2[]" value="Consultant" id="checkbox2_1" class="md-check partnersCheck" <?php echo $Consultant; ?>>

                                                    <label for="checkbox2_1">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Consultant </label>

                                                </div>

                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Constructor" id="checkbox2_2" class="md-check partnersCheck" <?php echo $Constructor; ?>>

                                                    <label for="checkbox2_2">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Constructor </label>

                                                </div>

                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Distributor" id="checkbox2_3" class="md-check partnersCheck" <?php echo $Distributor; ?>>

                                                    <label for="checkbox2_3">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Distributor </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Holding_Company_Investments" id="checkbox2_4" class="md-check partnersCheck" <?php echo $Holding_Company_Investments; ?>>

                                                    <label for="checkbox2_4">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Holding Company/Investments </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Import_Export" id="checkbox2_5" class="md-check partnersCheck" <?php echo $Import_Export; ?>>

                                                    <label for="checkbox2_5">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Import / Export </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Manufacturer" id="checkbox2_6" class="md-check partnersCheck" <?php echo $Manufacturer; ?>>

                                                    <label for="checkbox2_6">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Manufacturer </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Non_Profit" id="checkbox2_7" class="md-check partnersCheck" <?php echo $Non_Profit; ?>>

                                                    <label for="checkbox2_7">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Non-Profit </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Retailer" id="checkbox2_8" class="md-check partnersCheck" <?php echo $Retailer; ?>>

                                                    <label for="checkbox2_8">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Retailer </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Service_Provider" id="checkbox2_9" class="md-check partnersCheck" <?php echo $Service_Provider; ?>>

                                                    <label for="checkbox2_9">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Service Provider </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Warehouse_and_Logisitcs" id="checkbox2_10" class="md-check partnersCheck" <?php echo $Warehouse_and_Logisitcs; ?>>

                                                    <label for="checkbox2_10">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Warehouse and Logisitcs </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Wholesaler" id="checkbox2_11" class="md-check partnersCheck" <?php echo $Wholesaler; ?>>

                                                    <label for="checkbox2_11">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Wholesaler </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Institution" id="checkbox2_12" class="md-check partnersCheck" <?php echo $Institution; ?>>

                                                    <label for="checkbox2_12">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Institution </label>

                                                </div>



                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes2[]" value="Any_business_type" id="checkbox2_13" class="md-check partnersCheck" <?php echo $Any_business_type; ?>>

                                                    <label for="checkbox2_13">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span> Any business type </label>

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

                            <div class="portlet light">

                                <div class="portlet-body">

                                    <div class="form-group">

                                        <label for="ideal_partner_base"><b>Please choose what do you want to display as the opportunity card avatar.</b></label> <br/>

                                        <div class="input-group">

                                            <div class="row">
                                                <?php 
                                                    if(isset($data->id)){
                                                        $dataId = $data->id;
                                                    }else{
                                                        $dataId = 1;
                                                    }

                                                    if(isset( $data->avatar_status )){
                                                        $dataAvatar = $data->avatar_status;
                                                    }else{
                                                        $dataAvatar = 1;
                                                    }
                                                ?>
                                                <div class="col-sm-12">
                                                    <input type="hidden" name="avatar_status" id="avatar_status" value="{{  $dataAvatar }}" />
                                                    <input type="checkbox" 
                                                          onchange="oppImageAvatar(this, '{{ $dataId }}' )"
                                                          id="opp_image_avatar"
                                                          checked 
                                                          data-toggle="toggle" 
                                                          data-on="Profile Image" 
                                                          data-off="Industry Image" 
                                                          data-width="200" 
                                                          data-onstyle="success" 
                                                          data-offstyle="info" 
                                                          data-style="slow">
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="portlet2 light2">

                                <div class="portlet-body">
                                        <label for="opp_industry"><b>Please select what kind of Industry</b><span style="color: red; font-weight: bolder;"> *</span> </label>
                                        <div class='row'>
                                            <div class='col-sm-12'>
                                                <div id="myCarousel" class="row carousel slide" data-interval="false">
                                                    <div class="carousel-inner">
                                                        <input type="hidden" id="opp_industry" name="opp_industry" value="0">
                                                    <?php 
                                                        $groupSize = 4;
                                                        $initCarousel = '';
                                                        $setActive = 0;
                                                        if( isset($data->industry) ){
                                                            $setActive = floor( $data->industry / $groupSize );
                                                        }
                                                        $numItems = $industry_list->count();
                                                        $i = 0;
                                                        $ii = 0;
                                                     ?>
                                                        @foreach($industry_list as $ind)
                                                            <?php
                                                            if($setActive == $ii){
                                                                $initCarousel = 'active';
                                                            } ?>
                                                            @if($i == '0')
                                                            <div class="item {{ $initCarousel }}">
                                                                <ul class="thumbnails">
                                                            @endif

                                                            <li class="col-sm-3">      
                                                            <?php $industry_active = ''; ?>
                                                            @if(isset($data->industry))
                                                                @if($data->industry == $ind->id)
                                                                <?php $industry_active = 'industry_active'; ?>
                                                                @endif
                                                            @endif      
                                                                <div class="thumbnail {{ $industry_active }} industry_select{{ $ind->id }} " onclick="assignIndustry('{{ $ind->id }}')">
                                                                    <a><img src="{{  asset('public/images/industry/') }}/{{ $ind->image }}" alt=""><h4>{{ $ind->text }}</h4></a>
                                                                </div>
                                                            </li>

                                            <?php 
                                                            $i++;
                                                         
                                                            $initCarousel = '';
                                            ?>
                                                            @if($i == 4 || $numItems === $i )
                                                                </ul>
                                                            </div>
                                                            <?php 
                                                            $i = 0; 
                                                            $ii++;?>
                                                            @endif
                                                        @endforeach
                                                    </div>

                                                </div>
                                                    <!-- Control box -->
                                                    <div class="control-box">                            
                                                      <a data-slide="prev" href="#myCarousel" class="carousel-control left">&#60;</a>
                                                      <a data-slide="next" href="#myCarousel" class="carousel-control right">&#62;</a>
                                                    </div><!-- /.control-box --> 
                                            </div>
                                    </div>

                                </div>

                            </div>
                            <?php 

                            $user_id = Auth::id();

                            $company_id_result = App\CompanyProfile::getCompanyId($user_id);

                            

                            if( App\SpentTokens::validateLeftBehindToken($company_id_result) != false ){

                                

                                $bWCI = '';

                                $bKP = '';

                                $dataID = '0';



                                if(isset($data->view_type)){



                                  if($data->view_type == 1 ){

                                   $bWCI = '';

                                   $bKP = 'disabled';

                                  } else {

                                   $bWCI = 'disabled';

                                   $bKP = '';

                                  }



                                $dataID = $data->id;   

                                  

                                }   

                               ?>



                               <div class="portlet light">

                                <div class="portlet-body">

                                    <div class="form-group">



                               <button type="button" id="butPrivate" <?php echo $bKP; ?> class="btn btn-success" onclick="privacyOption2('buy', 'keep_private', '<?php echo $dataID; ?>')" style="color: black;"><span class="fa fa-lock"></span> Publish Anonymously </button>  

                               <button type="button" id="butCompany" <?php echo $bWCI; ?> class="btn btn-info" onclick="privacyOption2('buy', 'company_info', '<?php echo $dataID; ?>');" style="color: black"><span class="fa fa-credit-card" /></span><b>Publish with company info</b></button>

                               <?php
                               if(isset($data->view_type)){
                                    $dataViewType = $data->view_type;
                               }else{
                                    $dataViewType = 1;
                               }
                               ?>
                               <input type="hidden" name="viewtype_value" id="viewtype_value" value="{{ $dataViewType }}">

                               <br />



                                <div class="alert alert-info" style="width: 100%; overflow: hidden; margin-left: 0px !important;"><p>

                                <strong>Publish Anonymously -</strong>  For those who want discretion when finding a strategic partner. 

                                This option will be published in the Explore Page without Company Name and Profile. 

                                Partner who wish to find out more information about your company will have to connect with you by clicking "Interested". 

                                You will receive a notification of the company who wish to link up with you. 

                                </p>

                                </div>



                                <div class="alert alert-success" style="width: 100%; overflow: hidden; margin-left: 0px !important;"><p>

                                    <strong>Publish with Company Info -</strong>  For those who want to sell their products/services or want to get more exposure 

                                    when finding a strategic partner. This option will be published in the Explore Page with your company name and profile 

                                    to the users and extend your digital presence. By building digital presence in ProKakis, you are building a branding as a legitimate 

                                    company that is open for Business Connection.

                                        </p>

                                </div>





                            </div>

                        </div>

                    </div>



                            <?php  

                        } ?>

             

                     <hr>



                            <div class="form-actions" align="right">

                                <a style="margin-right:20px;" href="{{ url('/opportunity') }}" class="btn red">Cancel</a>



                                <input id="saveButtonBuilding" type="submit"

                                class="btn btn-success" value="Submit Opportunity"/>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>



    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>



    <script>

        var avatarFlagStatus = $('#avatar_status').val();
          if(avatarFlagStatus == 1)
             $('#opp_image_avatar').prop('checked', false).change()
          else
             $('#opp_image_avatar').prop('checked', true).change()

        var viewTypeStatus = $('#viewtype_value').val();
        if(viewTypeStatus == 1){
            $("#butPrivate").attr("disabled", true);
            $("#butCompany").attr("disabled", false);
        }else if(viewTypeStatus == 2){
            $("#butPrivate").attr("disabled", false);
            $("#butCompany").attr("disabled", true);
        }else{
            $("#butPrivate").attr("disabled", false);
            $("#butCompany").attr("disabled", false);   
        }

        function assignIndustry(id){
            $('#myCarousel').removeClass('tag-required');
            $('#opp_industry').val(id);
            $('.thumbnail').removeClass('industry_active');
            $('.industry_select'+id).addClass('industry_active');
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


      function oppImageAvatar(val, id){


        var referStatus = 1;
        if($(val).prop('checked')) referStatus = 2;
        //1 = industry
        //2 = profile
        $('#avatar_status').val(referStatus);
        formData = new FormData();
        formData.append("avatarStatus", referStatus);
        formData.append("opporId", id);
        formData.append("opporType", 'buy');
       
        $.ajax({

            url: "{{ route('updateOppImageAvatar') }}",

            type: "POST",

            data: formData,

            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            processData: false,

            contentType: false,

            cache: false,

            success: function (data) {

                console.log(data);

            }

        });

    }

        function privacyOption2(str, ptype, idx)

        {

            if(ptype == 'keep_private'){

              

                swal({

                    title: "Are you sure?",

                    text: "You are about to set the privacy option of this opportunity to Publish Anonymously!",

                    icon: "warning",

                    buttons: [

                      'No, cancel it!',

                      'Yes, I am sure!'

                    ],

                    dangerMode: true,

    

                  }).then(function(isConfirm) {

    

                    if (isConfirm) {

                      swal({

                        title: 'Publish Anonymously',

                        text: 'Done on setting privacy option!',

                        icon: 'success'

                      }).then(function() {

                        

                        $("#viewtype_value").val('1');

                        $("#butCompany").attr("disabled", false);

                        $("#butPrivate").attr("disabled", true);

    

                      });

                    } else {

                      swal("Cancelled", "Privacy option to the opportunity was cancelled :)", "error");

                    }

                  });

                

            }else{

               

              

                swal({

                    title: "Are you sure?",

                    text: "You are about to set the privacy option of this opportunity with company information!",

                    icon: "warning",

                    buttons: [

                      'No, cancel it!',

                      'Yes, I am sure!'

                    ],

                    dangerMode: true,

    

                  }).then(function(isConfirm) {

    

                    if (isConfirm) {

                      swal({

                        title: 'With Company Information',

                        text: 'Done on setting privacy option!',

                        icon: 'success'

                      }).then(function() {

                        

                        $("#viewtype_value").val('2');

                        $("#butCompany").attr("disabled", true);

                        $("#butPrivate").attr("disabled", false);

    

                      });

                    } else {

                      swal("Cancelled", "Privacy option to the opportunity was cancelled :)", "error");

                    }

                  });

           

            }



        }



  $(document).ready(function() {

        $('#ideal_partner_base').select2();

    });


//start autostore

        $("#opp_title").change(function() { 
            cookies.set('buy_opp_title',  $("#opp_title").val() );
        }); 

        var categoryCheck = [];
        $(".categoryCheck").click(function() { 
            categoryCheck.push($(this).attr('id'));
            cookies.set('buy_categoryCheck',  categoryCheck );
        });

        $("input[name='audienceTarget']").click(function( ) { 
            cookies.set('buy_audienceTarget',  $(this).attr('id')  );
        }); 

        $("#intro_describe_business").change(function() { 
            cookies.set('buy_intro_describe_business',  $("#intro_describe_business").val() );
        }); 

        $("#why_partner_goal").change(function() { 
            cookies.set('buy_why_partner_goal',  $("#why_partner_goal").val() );
        }); 

        $("input[name='timeFrame']").click(function( ) { 
            cookies.set('buy_timeFrame',  $(this).attr('id')  );
        }); 

        $("#approx_large").change(function() { 
            cookies.set('buy_approx_large',  $("#approx_large").val() );
        }); 

        $("#ideal_partner_base").change(function() { 
            cookies.set('buy_ideal_partner_base',  $("#ideal_partner_base").val() );
        });

        var partnersCheck = [];
        $(".partnersCheck").click(function() { 
            partnersCheck.push($(this).attr('id'));
            cookies.set('buy_partnersCheck',  partnersCheck );
        });

    //end autostore


//start asign autostore
if (cookies.test()) {
   $('#opp_title').val(  cookies.get("buy_opp_title") );

    if(cookies.get("buy_categoryCheck") != null){
        $.each( cookies.get("buy_categoryCheck") , function( key, value ) {
            $("#"+value).attr('checked', 'checked');
        });
   }

   if(cookies.get("buy_audienceTarget") != null){
        $('#'+cookies.get("buy_audienceTarget") ).attr("checked", "checked");
   }

   $('#intro_describe_business').val(  cookies.get("buy_intro_describe_business") );

   $('#why_partner_goal').val(  cookies.get("buy_why_partner_goal") );

    if(cookies.get("buy_timeFrame") != null){
        $('#'+cookies.get("buy_timeFrame") ).attr("checked", "checked");
   }

    $('#approx_large').val(  cookies.get("buy_approx_large") );

   if(cookies.get("buy_ideal_partner_base") != null){
        $.each( cookies.get("buy_ideal_partner_base") , function( key, value ) {
            $("#ideal_partner_base option[value='" + value + "']").attr('selected', 'selected');
        });
   }

    if(cookies.get("buy_partnersCheck") != null){
        $.each( cookies.get("buy_partnersCheck") , function( key, value ) {
            $("#"+value).attr('checked', 'checked');
        });
   }
}
//end


       $('#myCarousel').carousel({
        pause: true,
          interval: false
        })

$('#opportunity_build_form').submit(function() {
    if( $('#opp_industry').val() == 0 ){
        $('#myCarousel').addClass('tag-required');
        return false
    }

});

    </script>



@endsection

