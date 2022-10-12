@extends('layouts.app')
<?php

?>
  <link href="{{ asset('public/mini-upload/assets/css/style.css') }}" rel="stylesheet">
<style>
    html, body {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
    }

#upload a, #upload1 a, #upload2 a, #upload3 a{
    background:black !important;
}

.link_btn a{
    background:none !important;
}
.forDesktop{
            display: none;
        }

        .forMobile{
            display: block;
        }

        .card-body ul li i{
            color: red;
        }

        .card-body ul li{
            font-size: 14px;
            display: flex;
        }

        .profCompleteness{
            margin-left: -20em ;
            display: inline-grid ;
            margin-top: 85px !important;
        }

        .busineNews {
            line-height: 25px;
        }

        .read_more {
            margin-left: 15px;
        }

        .card-title h1{
            font-size: 4em;
            font-weight: 500;
        }

        li.active {
            background-color: black !important;
        }

        li.active a {
            color: #EFF3F8 !important;
            font-weight: 700 !important;
        }

        .actionImg input#btnCrop{
            width: 30%;
            margin-right: 25px;
        }

        .actionImg input.btn-info{
            width: 20%;
            font-size: 30px;
            height: 35px;
            line-height: 0px !important;
        }

        .actionImg p{
            font-size: 12px;
            color: red;
            font-weight: 600;
            font-style: italic;
            margin-top: -3px;
        }

        .table-outer{
            width: 100%;
            height: 100%;
            /*white-space: nowrap;*/
            position: relative;
            overflow-x: scroll;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .table-inner {
            width: 100%;
            background-color: #eee;
            float: none;
            height: 90%;
            margin: 0 0.25%;
            display: inline-block;
            zoom: 1;
        }
</style>


@section('content')


<?php 
                                        $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());
                                        $validateAccount = App\SpentTokens::validateAccountActivation($company_id_result);
                                    ?>
                                    
    <link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">

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




        .pie {
            background-color: #f0a22e99;
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
            background-color: #F0A22E;
            border-color: #F0A22E;
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
            background-color: #F0A22E;
            border-color: #F0A22E;
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

        .h-effect:hover {
          -moz-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
          -webkit-box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1) !important;
          /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
          box-shadow: 0 10px 16px 0 rgba(0, 0, 0, 1) !important;
          cursor: default !important;
        }
   /*     .widget-thumb-icon:hover {
            cursor: pointer;
           background-color: #31708f !important;

        }*/
        .panel-body ul:hover {
          -moz-box-shadow: 0 0 1px 1px #31708f !important;
          -webkit-box-shadow: 0 0 1px 1px #31708f !important;
          /*box-shadow: 0 0 3px 2px rgba(0, 0, 0, 0.1);*/
          box-shadow: 0 0 5px 0 #31708f !important;
          cursor: default !important;
        }

        .h-effect a{
            text-decoration: none;
        }

        .page-header .page-header-top .top-menu .navbar-nav>li.dropdown>.dropdown-menu{
            z-index: 5;
        }

        .intro-tour-overlay {
            display: none;
            background: #666;
            opacity: 0.5;
            z-index: 1000;
            min-height: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }


    .hr-sect {
        display: flex;
        flex-basis: 100%;
        align-items: center;
        color: black;
        margin: 8px 0px;
        font-size: 20px;
    }
    .hr-sect::before,
    .hr-sect::after {
        content: "";
        flex-grow: 1;
        background: rgba(0, 0, 0, 0.35);
        height: 1px;
        font-size: 2px;
        line-height: 0px;
        margin: 0px 8px;
    }

    .hr-sect strong{
        color: #1a4275;
    }

    .card-flex{
        display: flex;
    }

    .viewBtn{
        position: absolute;
        right: 2%;
    }

    .viewBtn a{
        font-size: 1vw !important;
        margin-top: -5px;
    }
    .embed-container { padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }

    .profile-img a {
        bottom: 15px;
        box-shadow: none;
        display: block;
        left: 15px;
        padding: 1px;
        position: absolute;
        height: 160px;
        width: 160px;
        background: rgba(0, 0, 0, 0.3) none repeat scroll 0 0;
        z-index: 0;
        bottom: -70px;
        
    }

    .profile-img img {
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.07);
        height: 158px;
        padding: 5px;
        width: 158px;
    }

    @media (min-width: 320px) and (max-width: 480px) {
        .profile-img img{
            margin-left: 35px;
        }
        .ctr{
            padding-top: 90;
        }
        .overlay {
            min-width: 736px;
            max-height: 414px;
            background: none;

        }

    } 
    @media(max-width: 992px){
        .disp-sm{
            flex: inherit !important;
            max-width: inherit !important;
        }
        .disp-lg{
            display: none;
        }

        .content-card{
            max-width: inherit !important;
        }
    }
    @media(min-width: 992px){
        .disp-sm{
            display: none;
        }
    }

    /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */
.modal-load {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modal-load {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal-load {
    display: block;
}

.label{
        font-size:15px;
        margin:4px;
        line-height:3;
        font-weight:500 !important;
        padding:10px;
    }
    
    .txt_input{
        border-left:4px solid #7cda24 !important;
    }
    
    .form-group{
        margin-bottom:15px !important;
    }
    </style>
    

    <div class="container">
        <div class="bootstrap row justify-content-center">

            <div class="row content">
    <div class="col-sm-6 sidenav" id="one_div" style="overflow:scroll !important;height:74vh; ">
      <div class="portlet light ">

                    <div class="portlet-title">



                        <div class="caption">

                            <i class="icon-share font-dark"></i>

                            <span class="caption-subject font-dark bold uppercase">Account Profile</span>
                        </div>



                        <!-- START NAV TABS -->

                        <ul class="nav nav-tabs">

                            <li id="com_overview_section" class="active">

                                <a href="#portlet_tab1" data-toggle="tab"> Company Overview </a>

                            </li>

                            <li id="com_key_section" >

                                <a href="#portlet_tab2" data-toggle="tab"> Key Management </a>

                            </li>

                            <li id="com_info_section" >

                                <a href="#portlet_tab3" data-toggle="tab"> Company Information </a>

                            </li>

                            <li id="com_strength_section">

                                <a href="#portlet_tab4" data-toggle="tab"> Strength </a>

                            </li>

                            <li id="com_financial_section">

                                <a href="#portlet_tab5" data-toggle="tab"> Financial Status </a>

                            </li>

                        </ul>

                        <!-- END NAV TABS -->

                    </div>





                <!-- START FORM TAG-->

                    <form action="{{ route('storeProfile') }}" enctype="multipart/form-data" id="company_profile_form"

                          method="POST">
                        {{ csrf_field() }}



                        <div class="portlet-body">

                            <div class="tab-content">

                                <div class="tab-pane active" id="portlet_tab1">

                                    <!-- START OVERVIEW TAB -->

                                    <div id="tabs-1">

                                        <div class="card-header" style="margin-bottom:10px"><b>Company Overview</b></div>

                                        <div class="card-body center">

                                            <div  class="alert bg-dark text-white" role="alert">



                                                <b class="text-company">PRO TIP:</b> Companies with filled in general company information have a

                                                greater chance to matched with relevant business for their business

                                                objectives.

                                            </div>



                                            <div class="form-group">

                                                <label for="company_name">Company Name</label>

                                                <textarea type="text" class="form-control txt_input" id="company_name"

                                                       name="company_name"><?php if (isset($company_data->registered_company_name)) {

                                                           echo $company_data->registered_company_name;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="company_unique_entity">Company Registration Number

                                                    (UEN)</label>

                                                <textarea type="text" class="form-control txt_input " name="company_unique_entity"

                                                       id="company_unique_entity"><?php if (isset($company_data->unique_entity_number)) {

                                                           echo $company_data->unique_entity_number;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="company_year_founded">Year Founded</label>



                                                <select class="form-control" id="company_year_founded"

                                                        name="company_year_founded">

                                                    <?php

                                                    foreach($year_founded as $key => $value){



                                                    if(isset($company_data->year_founded) && $key == $company_data->year_founded) { ?>

                                                    <option selected

                                                            value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                    <?php  } else { ?>

                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                    <?php }

                                                    }

                                                    ?>

                                                </select>



                                            <!-- <input type="text" class="form-control" id="company_year_founded" name="company_year_founded" value="<?php //if(isset($company_data->year_founded)){ echo $company_data->year_founded; } ?>">-->

                                            </div>



                                            <div class="form-group">

                                                <label for="company_ownership">Business Type</label>

                                                <select class="form-control" id="company_business_type"

                                                        name="company_business_type">

                                                    <option value="" id="">Please select the following</option>

                                                    <?php foreach($business_type as $key => $value)

                                                    {

                                                    if (isset($company_data->business_type) && $key == $company_data->business_type) {

                                                        $selected = 'selected';

                                                    } else {

                                                        $selected = '';

                                                    }

                                                    ?>

                                                    <option

                                                        <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                    <?php

                                                    }  ?>

                                                </select>

                                            </div>



                                            <div class="form-group">

                                                <label for="company_ownership">Industry Type</label>

                                                <select class="form-control" id="company_industry"

                                                        name="company_industry">

                                                    <option value="" id="">Please select the following</option>

                                                    <?php foreach($business_industry as $key => $value)

                                                    {

                                                    if (isset($company_data->industry) && $key == $company_data->industry) {

                                                        $selected = 'selected';

                                                    } else {

                                                        $selected = '';

                                                    }

                                                    ?>

                                                    <option

                                                        <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                    <?php

                                                    }  ?>



                                                </select>

                                            </div>





                                            <div class="form-group">

                                                <label for="description">Description</label>

                                                <textarea onclick="return false;" rows="5" cols="20"  maxlength="500" class="form-control txt_input" name="description"

                                                          id="description"><?php if (isset($company_data->description)) {

                                                        echo $company_data->description;

                                                    } ?></textarea>

                                                <div class="alert bg-dark text-white">
                                                  <span>Characters left:&nbsp;</spa><span style="color:red;" id="count">500</span>
                                                </div>
                                            </div>





                                            <div class="form-group">

                                                <label for="company_address">Office Address </label>

                                                <textarea type="text" class="form-control txt_input" id="company_address"

                                                       name="company_address"><?php if (isset($company_data->registered_address)) {

                                                           echo $company_data->registered_address;

                                                       } ?></textarea>

                                            </div>



                                        <!-- <div class="form-group">

                                     <label for="company_number_employeee">Numbered of Employees</label>

                                     <select  class="form-control" id="company_number_employeee" name="company_number_employeee">

                                         <?php
                                        if( !empty($num_of_employee) ){
                                            foreach($num_of_employee as $key => $value){


                                            if(isset($company_data->number_of_employees) && $key == $company_data->number_of_employees) { ?>

                                                    <option selected value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                <?php  } else { ?>

                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                                <?php }

                                            }
                                        }
                                        ?>

                                                </select>

                                        </div>  -->



                                        <!--  <div class="form-group ">

                                     <label for="company_estmated_sales offset-md-5">Estimated Sales</label> <br />



                                      <select  class="form-control" id="company_estmated_sales_currency" name="company_estmated_sales_currency">

                                         <option value="">Currency</option>

                                         <?php

                                        foreach($currency as $key => $value)

                                        {

                                        if (isset($company_data->estimatedsales_currency) && $key == $company_data->estimatedsales_currency) {

                                            $selected = 'selected';

                                        } else {

                                            $selected = '';

                                        }

                                        ?>

                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                         <?php

                                        }  ?>



                                                </select>

                                           <br />

                                           <select  class="form-control" id="company_estmated_sales_value" name="company_estmated_sales_value">

                                              <option value="">Please select the following</option>

<?php

                                        foreach($estimated_sales as $key => $value)

                                        {

                                        if (isset($company_data->estimatedsales_value) && $key == $company_data->estimatedsales_value) {

                                            $selected = 'selected';

                                        } else {

                                            $selected = '';

                                        }

                                        ?>

                                                <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>

                                         <?php

                                        }

                                        ?>



                                                </select>



                                        </div> -->



                                            <div class="form-group">

                                                <label for="office_phone">Office Phone </label>

                                                <textarea type="text" class="form-control txt_input" id="office_phone"

                                                       name="office_phone"><?php if (isset($company_data->office_phone)) {

                                                           echo $company_data->office_phone;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="mobile_phone">Mobile Phone </label>

                                                <textarea type="text" class="form-control txt_input" id="mobile_phone"

                                                       name="mobile_phone"><?php if (isset($company_data->mobile_phone)) {

                                                           echo $company_data->mobile_phone;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="company_email">Email </label>

                                                <textarea type="text" class="form-control txt_input" id="company_email"

                                                       name="company_email"><?php if (isset($company_data->company_email)) {

                                                           echo $company_data->company_email;

                                                       } ?></textarea>

                                            </div>

					    <div class="form-group">

                                                <label for="incorporation_date">Incorporation Date </label>

                                                <input type="date" class="form-control"  id="mask_incorporation_date"

                                                       name="incorporation_date"

                                                       value="<?php if (isset($company_data->incorporation_date)) {

                                                           echo $company_data->incorporation_date;

                                                       } ?>">
                                                <span class="form-text text-muted">Custom date format:<code>mm/dd-yyyy</code></span>
                                            </div>



                                            <div class="form-group">

                                                <label for="company_website">Website </label>

                                                <textarea type="text" class="form-control txt_input" id="company_website"

                                                       name="company_website" ><?php if (isset($company_data->company_website)) {

                                                           echo $company_data->company_website;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="facebook">Facebook </label>

                                                <textarea type="text" class="form-control txt_input" id="facebook" name="facebook"
                                                ><?php if (isset($company_data->facebook)) {

                                                           echo $company_data->facebook;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="twitter">Twitter </label>

                                                <textarea type="text" class="form-control txt_input" id="twitter" name="twitter"><?php if (isset($company_data->twitter)) {

                                                           echo $company_data->twitter;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="linkedin">Linkedin </label>

                                                <textarea type="text" class="form-control txt_input" id="linkedin" name="linkedin"><?php if (isset($company_data->linkedin)) {

                                                           echo $company_data->linkedin;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="googleplus">Google Plus </label>

                                                <textarea type="text" class="form-control txt_input" id="googleplus"

                                                       name="googleplus"><?php if (isset($company_data->googleplus)) {

                                                           echo $company_data->googleplus;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="otherlink">Other Link </label>

                                                <textarea type="text" class="form-control txt_input" id="otherlink" name="otherlink"><?php if (isset($company_data->otherlink)) {

                                                           echo $company_data->otherlink;

                                                       } ?></textarea>

                                            </div>



                                            <div class="form-group">

                                                <label for="company_primary_country">Primary Country</label>

                                                <select class="form-control  " id="company_primary_country"

                                                        name="company_primary_country">

                                                    <option value="" id="">Please select the following</option>

                                                    <?php foreach($countries as $data)

                                                    {

                                                    if (isset($company_data->primary_country) && $data->country_code == $company_data->primary_country) {

                                                        $selected = 'selected';

                                                    } else {

                                                        $selected = '';

                                                    }

                                                    ?>

                                                    <option

                                                        <?php echo $selected; ?> value="<?php echo $data->country_code; ?>"><?php echo $data->country_name; ?></option>

                                                    <?php

                                                    }  ?>



                                                </select>

                                            </div>





                                            <hr/>





                                        </div>



                                    </div>

                                    <!-- END OVERVIEW TAB -->

                                </div>

                                <!-- START KEY PERSONNEL TAB -->

                                <div class="tab-pane" id="portlet_tab2">

                                    <p>

                                        <input type="button" style="float:right;margin-bottom:5px" class="btn blue" data-toggle="modal" data-target="#key_personel_modal" onclick="clearKM()"

                                               data-popup-open="popup-1" value="Add Key Personnel"/>

                                    </p>



                                    <div class="form-group">

                                        <div id="keyPersonnels">

                                            <?php



                                            $out = '';

                                            $kp = 0;

                                            if (count((array) $keyPersons) > 0) {

                                                foreach ($keyPersons as $data) {

                                                    $kp++;

                                                    $out = $out . '<table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%; padding-top: 5px;">

                                                  <tr>

                                                  <th width="40%"> ' . $kp . ' </th>

                                                  <th> <input data-popup-open="popup-1" onclick="editKM(' . $data->id . ');" type="button" class="btn btn-primary" value="edit"> <input type="button" onclick="delKM(' . $data->id . ',' . $kp . ');" class="btn btn-danger" value="delete"> </th>

                                                  </tr>

                                              ';



                                                    $out = $out . '<tr>

                                                      <td> First Name   </td>

                                                      <td> ' . $data->first_name . ' </td>

                                                     </tr>';



                                                    $out = $out . '<tr>

                                                     <td> Last Name   </td>

                                                     <td> ' . $data->last_name . ' </td>

                                                    </tr>';



                                                    $out = $out . '<tr>

                                                    <td> Identification / Passport   </td>

                                                    <td> ' . $data->idn_passport . ' </td>

                                                   </tr>';



                                                    $out = $out . '<tr>

                                                   <td> Nationality   </td>

                                                   <td> ' . $data->nationality . ' </td>

                                                   </tr>';



                                                    $out = $out . '<tr>

                                                   <td> Gender   </td>

                                                   <td> ' . $data->gender . ' </td>

                                                   </tr>';



                                                    $out = $out . '<tr>

                                                   <td> Date of Birth   </td>

                                                   <td> ' . $data->date_of_birth . ' </td>

                                                   </tr>';



                                                    $out = $out . '<tr>

                                                   <td> Majority Shareholder   </td>

                                                   <td> ' . $data->shareholder . ' </td>

                                                   </tr>';



                                                    $out = $out . '<tr>

                                                   <td> Directorship   </td>

                                                   <td> ' . $data->is_directorship . ' </td>

                                                   </tr>';



                                                    $out = $out . '<tr>

                                                   <td> Position   </td>

                                                   <td> ' . $data->position . ' </td>

                                                     </tr>';

                                                    $out = $out . '</table>';

                                                }



                                                echo $out;

                                            }

                                            ?>



                                        </div>

                                    </div>

                                </div>

                                <!-- END KEY PERSONNEL TAB -->

                                <!-- START Financial Information TAB -->

                                <div class="tab-pane" id="portlet_tab3">

                                    <h3 class="card-title"><b>Financial Information</b></h3>

                                    <div class="card-body center">



                                        <div class="form-group ">

                                            <label for="company_financial_currency">Primary Currency</label>

                                            <select class="form-control " id="company_financial_currency"

                                                    name="company_financial_currency">

                                                <option value="">Currency</option>

                                                <?php foreach($currency as $data){

                                                if (isset($company_data->currency) && $data->code == $company_data->currency) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $data->code ?>"><?php echo $data->code . ' - ' . $data->currency; ?></option>

                                                <?php }  ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_years_establishment">Years of Establishment </label>

                                            <select class="form-control" id="company_years_establishment"

                                                    name="company_years_establishment">

                                                <option value="" id="">Year</option>

                                                <?php foreach($years_establishment as $key => $value)

                                                {

                                                if (isset($company_data->years_establishment) && $key == $company_data->years_establishment) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group ">

                                            <label for="company_financial_numstaff">No. of Staff</label> <br/>

                                            <select class="form-control" id="company_financial_numstaff"

                                                    name="company_financial_numstaff">

                                                <option value="">No of staff</option>

                                                <?php foreach($no_of_staff as $key => $value){

                                                if (isset($company_data->no_of_staff) && $key == $company_data->no_of_staff) {

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



                                        <div class="form-group">

                                            <label for="company_gross_profit">Gross Profit / (Loss)</label>

                                            <select class="form-control" id="company_gross_profit"

                                                    name="company_gross_profit">

                                                <option value="" id=""></option>

                                                <?php foreach($gross_profit_loss as $key => $value)

                                                {

                                                if (isset($company_data->gross_profit) && $key == $company_data->gross_profit) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>



                                        </div>



                                        <div class="form-group">

                                            <label for="company_gross_profit">Net Profit / (Loss)</label>

                                            <select class="form-control " id="company_net_profit"

                                                    name="company_net_profit">

                                                <option value="" id=""></option>

                                                <?php foreach($net_profit_loss as $key => $value)

                                                {

                                                if (isset($company_data->net_profit) && $key == $company_data->net_profit) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_annual_tax">Annual Return Filling Rating </label>

                                            <select class="form-control" id="company_annual_tax_return"

                                                    name="company_annual_tax_return">

                                                <option value="" id=""></option>

                                                <?php foreach($filling_rate as $key => $value)

                                                {

                                                if (isset($company_data->annual_tax_return) && $key == $company_data->annual_tax_return) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_annual_tax">Corporate Tax Filling Rating </label>

                                            <select class="form-control" id="company_corporate_tax"

                                                    name="company_corporate_tax">

                                                <option value="" id=""></option>

                                                <?php foreach($filling_rate as $key => $value)

                                                {

                                                if (isset($company_data->corporate_tax) && $key == $company_data->corporate_tax) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_annual_tax">Asset more than Liability </label>

                                            <select class="form-control" id="company_asset_more_liability"

                                                    name="company_asset_more_liability">

                                                <option value="" id=""></option>

                                                <?php foreach($asset_more_liability as $key => $value)

                                                {

                                                if (isset($company_data->asset_more_liability) && $key == $company_data->asset_more_liability) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>



                                        <div class="form-group">

                                            <label for="company_paid_capital">Paid up capital</label>

                                            <select class="form-control" id="company_paid_up_capital"

                                                    name="company_paid_up_capital">

                                                <option value="" id=""></option>

                                                <?php foreach($paid_up_capital as $key => $value)

                                                {

                                                if (isset($company_data->paid_up_capital) && $key == $company_data->paid_up_capital) {

                                                    $selected = 'selected';

                                                } else {

                                                    $selected = '';

                                                }

                                                ?>

                                                <option

                                                    <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>

                                        </div>




                                        <div class="form-group">
                                            <div class="col-12">
                                            <?php 
                                            if(isset($company_data->financial_year_end)){
                                                if(strpos($company_data->financial_year_end, "/") !== false){
                                                    $date = explode('/', $company_data->financial_year_end); 
                                                    $new_date = $date[2]."-".$date[0]."-".$date[1];
                                                }else{
                                                    $date = explode('-', $company_data->financial_year_end); 
                                                    $new_date = $company_data->financial_year_end;
                                                }
                                            }
                                            ?>
                       @if(isset($new_date))
                                            <input type="hidden" id="default_financial_year_end" 
                                             value="{{ $new_date }}" >
                       @endif   

                                            <label for="financial_year_end">Financial Year End</label>
                                            </div>  
                                        </div>
                                        <div class="form-group example">
                                            <div class="col-12">
                                            <input type="date" class="form-control" id="financial_year_end"
                                                   name="financial_year_end"
                                                   value="<?php if (isset($company_data->financial_year_end)) {
                                                       echo $company_data->financial_year_end;
                                                   } ?>">
                                            </div>  
                                        </div>





                                        <div class="form-group">

                                            <input

                                                <?php if (isset($company_data->solvent_value) && $company_data->solvent_value == 'insolvent') {

                                                    echo 'checked="checked"';

                                                }  ?> type="radio" value="insolvent" name="company_vent_value"

                                                id="company_vent_value"> Insolvent

                                            <input

                                                <?php if (isset($company_data->solvent_value) && $company_data->solvent_value == 'solvent') {

                                                    echo 'checked="checked"';

                                                }  ?> type="radio" value="solvent" name="company_vent_value"

                                                id="company_vent_value"> Solvent

                                        </div>



                                    </div>

                                </div>



                            </form>

                                <!-- END Financial Information TAB -->

                                <!-- START UPLOAD DOCUMENT TAB -->

                                <div class="tab-pane" id="portlet_tab4">

                                    <div class="card-header"><b>Upload Documents</b></div>



                                    <div class="form-group">

                                        <div id="upload">
                                           
                                            

                                            <form method="post" action="{{ route('uploadAwards') }}" enctype="multipart/form-data">



                                                {{ csrf_field() }}

                                                <div id="drop">

                                                    <?php  
                                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false) { 
                                                    ?>

                                                    <a>UPLOAD AWARDS</a>

                                                    <input type="file" name="awardsFiles" id="up1"/>

                                                    <?php } ?>    
                                                </div>



                                                <ul>

                                                    <!-- The file uploads will be shown here -->



                                                </ul>



                                                <?php if(count((array) $profileAwards) > 0) { ?>

                                                <h4><b>Saved Awards</b></h4>

                                                <ol>

                                                    <?php foreach($profileAwards as $aw) {  ?>

                                                    <li style="padding:5px;" id="awardsSaved<?php echo $aw[0]; ?>">

                                                        <span><b><?php echo $aw[2]; ?></b></span>





                                                        <span class="link_btn" style="float:right">

                                                                    <a style="background:none !important;" target="_blank" href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a>

                                                                    -

                                                                    <a style="background:none !important;" href="#" onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'awardsSaved', '<?php echo $aw[2]; ?>');">Delete</a>

                                                        </span>

                                                        <br />

                                                        <br />

                                                        <span style="float:right">

                                                        Expiry Date: <input type="date" disabled id="expiryDate<?php echo $aw[0]; ?>" value="<?php echo $aw[4]; ?>"  />

                                                        <input class="btn btn-primary" type="button" value="update" onclick="updateExpirydate('<?php echo $aw[0]; ?>');">

                                                        <input class="btn btn-primary" type="button" value="edit" onclick="editExpirydate('<?php echo $aw[0]; ?>');">



                                                        </span>



                                                    </li>

                                                    <hr />

                                                    <?php } ?>

                                                </ol>

                                                <?php } ?>



                                            </form>

                                        </div>

                                    </div>



                                    <div class="form-group">

                                        <label for="invoices"><b>Invoices</b></label> <br/>

                                        <div id="upload1">

                                            <form method="post" action="{{ route('uploadPurchaseInvoices') }}"  enctype="multipart/form-data">

                                                {{ csrf_field() }}

                                                <div id="drop1">

                                                    <?php  
                                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false) { 
                                                    ?>

                                                    <a>UPLOAD PURCHASE INVOICES</a>

                                                    <input type="file" name="purchaseInvoiceFiles" id="up2"/>

                                                    <?php } ?>

                                                </div>



                                                <ul>

                                                    <!-- The file uploads will be shown here -->

                                                </ul>



                                                <?php if(count((array)$profilePurchaseInvoice) > 0) { ?>

                                                <p>Saved Purchase Invoice</p>

                                                <ol>

                                                    <?php foreach($profilePurchaseInvoice as $aw) {  ?>

                                                    <li style="padding:5px;"

                                                        id="purchaseInvoiceSaved<?php echo $aw[0]; ?>">

                                                        <span><b><?php echo $aw[2]; ?></b></span>

                                                        <span class="link_btn" style="float:right"> <a style="background:none !important;"

                                                                    target="_blank"

                                                                    href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a> - <a style="background:none !important;"

                                                                    href="#"

                                                                    onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'purchaseInvoiceSaved', '<?php echo $aw[2]; ?>');">Delete</a></span>

                                                    </li>

                                                    <?php } ?>

                                                </ol>

                                                <?php } ?>



                                            </form>

                                        </div>



                                        <div id="upload2">

                                            <form method="post" action="{{ route('uploadSalesInvoies') }}"

                                                  enctype="multipart/form-data">

                                                {{ csrf_field() }}

                                                <div id="drop2">

                                                    <?php  
                                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false) { 
                                                    ?>

                                                    <a>UPLOAD SALES INVOICES</a>

                                                    <input type="file" name="salesInvoiceFiles" id="up3"/>

                                                    <?php } ?>

                                                </div>



                                                <ul>

                                                    <!-- The file uploads will be shown here -->



                                                </ul>

                                                <?php if(count((array)$profileSalesInvoice) > 0) { ?>

                                                <p>Saved Sales Invoice</p>

                                                <ol>

                                                    <?php foreach($profileSalesInvoice as $aw) {  ?>

                                                    <li style="padding:5px;"

                                                        id="salesInvoiceSaved<?php echo $aw[0]; ?>">

                                                        <span><b><?php echo $aw[2]; ?></b></span>

                                                        <span class="link_btn" style="float:right"> <a style="background:none !important;"

                                                                    target="_blank"

                                                                    href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a> - <a style="background:none !important;"

                                                                    href="#"

                                                                    onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'salesInvoiceSaved', '<?php echo $aw[2]; ?>');">Delete</a></span>

                                                    </li>

                                                    <?php } ?>

                                                </ol>

                                                <?php } ?>

                                            </form>

                                        </div>

                                    </div>





                                    <div class="form-group">

                                        <label for="awards"><b>Certifications</b></label> <br/>



                                        <div id="upload3">

                                            <form method="post" action="{{ route('uploadCertifications') }}"

                                                  enctype="multipart/form-data">

                                                {{ csrf_field() }}

                                                <div id="drop3">

                                                    <?php  
                                                    if(App\SpentTokens::validateAccountActivation($company_id_result) != false) { 
                                                    ?>

                                                    <a>UPLOAD CERTIFICATES</a>

                                                    <input type="file" name="certificationFiles" id="up4"/>

                                                    <?php } ?>

                                                </div>



                                                <ul>

                                                    <!-- The file uploads will be shown here -->



                                                </ul>



                                                <?php if(count((array)$profileCertifications) > 0) { ?>

                                                <p>Saved Certificates</p>

                                                <ol>

                                                    <?php foreach($profileCertifications as $aw) {  ?>

                                                    <li style="padding:5px;"

                                                        id="certificatesSaved<?php echo $aw[0]; ?>">

                                                        <span><b><?php echo $aw[2]; ?></b></span>

                                                        <span class="link_btn" style="float:right">

                                                                    <a style="background:none !important;" target="_blank" href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a>

                                                                    -

                                                                    <a style="background:none !important;" href="#" onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'certificatesSaved', '<?php echo $aw[2]; ?>');">Delete</a>

                                                        </span>



                                                        <br />

                                                        <br />

                                                        <span style="float:right">

                                                        Expiry Date: <input  type="date" disabled id="expiryDate<?php echo $aw[0]; ?>" value="<?php echo $aw[4]; ?>"  />

                                                        <input class="btn btn-primary" type="button" value="update" onclick="updateExpirydate('<?php echo $aw[0]; ?>');">

                                                        <input class="btn btn-primary" type="button" value="edit" onclick="editExpirydate('<?php echo $aw[0]; ?>');">



                                                        </span>





                                                    </li>

                                                    <?php } ?>

                                                </ol>

                                                <?php } ?>



                                            </form>

                                        </div>

                                    </div>

                                </div>

                                <!-- END UPLOAD DOCUMENT TAB -->

                                <!-- START FINANCIAL ENTRIES TAB -->
                                
                                <?php 
                                $csvLink = asset('public/assets/templates/IntellinzFinancialStatusTemplate.csv');
                                ?>

                                <div class="tab-pane" id="portlet_tab5">

                                    <div class="card-header"><b>Financial Entries</b>
                    <div style="color:red">To avoid delays, please don't use comma in your numerical entries. </div>
                     <a style="float:right" target="_blank" href="{{ $csvLink }}">Download CSV Template</a> <br />
                   </div>

                                    <div class="">
                                        <div class=''>


                                        <table class="table table-bordered table-striped table-condensed flip-content"

                                               style="width: 100%; padding-top: 5px;" border="1" cellpadding="2"

                                               cellspacing="2">

                                            <tr>

                                                <td width="20%" class='sticky-row'> Month / Year</td>

                                                <?php

                                                //$entry1 = App\FinancialAnalysis::where('entry', 1)->where('user_id', $user_id)->first();

                                                //$entry2 = App\FinancialAnalysis::where('entry', 2)->where('user_id', $user_id)->first();

                                                //$entry3 = App\FinancialAnalysis::where('entry', 3)->where('user_id', $user_id)->first();

                                                //$entry4 = App\FinancialAnalysis::where('entry', 4)->where('user_id', $user_id)->first();

                        $entry1 = App\FinancialAnalysis::where('entry', 1)->where('company_id',  $company_id_result)->where('user_id', $user_id)->first();

                                                $entry2 = App\FinancialAnalysis::where('entry', 2)->where('company_id',  $company_id_result)->where('user_id', $user_id)->first();

                                                $entry3 = App\FinancialAnalysis::where('entry', 3)->where('company_id',  $company_id_result)->where('user_id', $user_id)->first();

                                                $entry4 = App\FinancialAnalysis::where('entry', 4)->where('company_id',  $company_id_result)->where('user_id', $user_id)->first();




                                                ?>

                                                <td>

                                                    <select class="form-control" id="fa_month1" name="fa_month1">

                                                        <option value="0"></option>

                                                        <?php foreach($param_months as $key => $value)

                                                        {



                                                        if (isset($entry1->month_param) && $key == $entry1->month_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                    <select class="form-control" id="fa_year1" name="fa_year1">

                                                        <option value="0"></option>

                                                        <?php foreach($param_years as $data)

                                                        {

                                                        if (isset($entry1->year_param) && $data == $entry1->year_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $data ?>"><?php echo $data; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                </td>

                                                <td>

                                                    <select class="form-control" id="fa_month2" name="fa_month2">

                                                        <option value="0"></option>

                                                        <?php foreach($param_months as $key => $value)

                                                        {

                                                        if (isset($entry2->month_param) && $key == $entry2->month_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?>  value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                    <select class="form-control" id="fa_year2" name="fa_year2">

                                                        <option value="0"></option>

                                                        <?php foreach($param_years as $data)

                                                        {

                                                        if (isset($entry2->year_param) && $data == $entry2->year_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $data ?>"><?php echo $data; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>



                                                </td>

                                                <td>

                                                    <select class="form-control" id="fa_month3" name="fa_month3">

                                                        <option value="0"></option>

                                                        <?php foreach($param_months as $key => $value)

                                                        {

                                                        if (isset($entry3->month_param) && $key == $entry3->month_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                    <select class="form-control" id="fa_year3" name="fa_year3">

                                                        <option value="0"></option>

                                                        <?php foreach($param_years as $data)

                                                        {

                                                        if (isset($entry3->year_param) && $data == $entry3->year_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }

                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $data ?>"><?php echo $data; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>



                                                </td>

                                                <td>

                                                    <select class="form-control" id="fa_month4" name="fa_month4">

                                                        <option value="0"></option>

                                                        <?php foreach($param_months as $key => $value)

                                                        {

                                                        if (isset($entry4->month_param) && $key == $entry4->month_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $key ?>"><?php echo $value; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                    <select class="form-control" id="fa_year4" name="fa_year4">

                                                        <option value="0"></option>

                                                        <?php foreach($param_years as $data)

                                                        {

                                                        if (isset($entry4->year_param) && $data == $entry4->year_param) {

                                                            $selected = 'selected';

                                                        } else {

                                                            $selected = '';

                                                        }



                                                        ?>

                                                        <option

                                                            <?php echo $selected; ?> value="<?php echo $data ?>"><?php echo $data; ?></option>

                                                        <?php

                                                        }

                                                        ?>

                                                    </select>

                                                </td>



                                            </tr>



                                            <tr>

                                                <td class='sticky-row' >Income</td>

                                                <td><input type="number" class="form-control txt_input" id="income1" name="income1"

                                                           value="<?php if (isset($entry1->income)) {

                                                               echo $entry1->income;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="income2" name="income2"

                                                           value="<?php if (isset($entry2->income)) {

                                                               echo $entry2->income;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="income3" name="income3"

                                                           value="<?php if (isset($entry3->income)) {

                                                               echo $entry3->income;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="income4" name="income4"

                                                           value="<?php if (isset($entry4->income)) {

                                                               echo $entry4->income;

                                                           } ?>"></td>

                                            </tr>



                                            <tr>

                                                <td class='sticky-row'>Purchase</td>

                                                <td><input type="number" class="form-control txt_input" id="purchase1"

                                                           name="purchase1"

                                                           value="<?php if (isset($entry1->purchase)) {

                                                               echo $entry1->purchase;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="purchase2"

                                                           name="purchase2"

                                                           value="<?php if (isset($entry2->purchase)) {

                                                               echo $entry2->purchase;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="purchase3"

                                                           name="purchase3"

                                                           value="<?php if (isset($entry3->purchase)) {

                                                               echo $entry3->purchase;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="purchase4"

                                                           name="purchase4"

                                                           value="<?php if (isset($entry4->purchase)) {

                                                               echo $entry4->purchase;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Cost of Goods Sold / Cost of Sales</td>

                                                <td><input type="number" class="form-control txt_input" id="cost_good_sold1"

                                                           name="cost_good_sold1"

                                                           value="<?php if (isset($entry1->cost_goodsold_costsales)) {

                                                               echo $entry1->cost_goodsold_costsales;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="cost_good_sold2"

                                                           name="cost_good_sold2"

                                                           value="<?php if (isset($entry2->cost_goodsold_costsales)) {

                                                               echo $entry2->cost_goodsold_costsales;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="cost_good_sold3"

                                                           name="cost_good_sold3"

                                                           value="<?php if (isset($entry3->cost_goodsold_costsales)) {

                                                               echo $entry3->cost_goodsold_costsales;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="cost_good_sold4"

                                                           name="cost_good_sold4"

                                                           value="<?php if (isset($entry4->cost_goodsold_costsales)) {

                                                               echo $entry4->cost_goodsold_costsales;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Gross Profit</td>

                                                <td><input type="number" class="form-control txt_input" id="gross_profit1"

                                                           name="gross_profit1"

                                                           value="<?php if (isset($entry1->gross_profit)) {

                                                               echo $entry1->gross_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="gross_profit2"

                                                           name="gross_profit2"

                                                           value="<?php if (isset($entry2->gross_profit)) {

                                                               echo $entry2->gross_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="gross_profit3"

                                                           name="gross_profit3"

                                                           value="<?php if (isset($entry3->gross_profit)) {

                                                               echo $entry3->gross_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="gross_profit4"

                                                           name="gross_profit4"

                                                           value="<?php if (isset($entry4->gross_profit)) {

                                                               echo $entry4->gross_profit;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td valign="top" class='sticky-row'>Directors’ Fees & Remuneration</td>

                                                <td><input type="number" class="form-control txt_input" id="directors_fee_renum1"

                                                           name="directors_fee_renum1"

                                                           value="<?php if (isset($entry1->directors_fee_renum)) {

                                                               echo $entry1->directors_fee_renum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="directors_fee_renum2"

                                                           name="directors_fee_renum2"

                                                           value="<?php if (isset($entry2->directors_fee_renum)) {

                                                               echo $entry2->directors_fee_renum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="directors_fee_renum3"

                                                           name="directors_fee_renum3"

                                                           value="<?php if (isset($entry3->directors_fee_renum)) {

                                                               echo $entry3->directors_fee_renum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="directors_fee_renum4"

                                                           name="directors_fee_renum4"

                                                           value="<?php if (isset($entry4->directors_fee_renum)) {

                                                               echo $entry4->directors_fee_renum;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Total Remuneration excluding Directors’ Fees and Remuneration</td>

                                                <td><input type="number" class="form-control txt_input" id="total_renum_exdirector1"

                                                           name="total_renum_exdirector1"

                                                           value="<?php if (isset($entry1->totalrenum_exdirector_feerenum)) {

                                                               echo $entry1->totalrenum_exdirector_feerenum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="total_renum_exdirector2"

                                                           name="total_renum_exdirector2"

                                                           value="<?php if (isset($entry2->totalrenum_exdirector_feerenum)) {

                                                               echo $entry2->totalrenum_exdirector_feerenum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="total_renum_exdirector3"

                                                           name="total_renum_exdirector3"

                                                           value="<?php if (isset($entry3->totalrenum_exdirector_feerenum)) {

                                                               echo $entry3->totalrenum_exdirector_feerenum;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="total_renum_exdirector4"

                                                           name="total_renum_exdirector4"

                                                           value="<?php if (isset($entry4->totalrenum_exdirector_feerenum)) {

                                                               echo $entry4->totalrenum_exdirector_feerenum;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Medical Expenses</td>

                                                <td><input type="number" class="form-control txt_input" id="medical_expense1"

                                                           name="medical_expense1"

                                                           value="<?php if (isset($entry1->medical_expenses)) {

                                                               echo $entry1->medical_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="medical_expense2"

                                                           name="medical_expense2"

                                                           value="<?php if (isset($entry2->medical_expenses)) {

                                                               echo $entry2->medical_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="medical_expense3"

                                                           name="medical_expense3"

                                                           value="<?php if (isset($entry3->medical_expenses)) {

                                                               echo $entry3->medical_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="medical_expense4"

                                                           name="medical_expense4"

                                                           value="<?php if (isset($entry4->medical_expenses)) {

                                                               echo $entry4->medical_expenses;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Transport/Travelling Expenses</td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="transport_travelling_expenses1"

                                                           name="transport_travelling_expenses1"

                                                           value="<?php if (isset($entry1->transport_traveling_expenses)) {

                                                               echo $entry1->transport_traveling_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="transport_travelling_expenses2"

                                                           name="transport_travelling_expenses2"

                                                           value="<?php if (isset($entry2->transport_traveling_expenses)) {

                                                               echo $entry2->transport_traveling_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="transport_travelling_expenses3"

                                                           name="transport_travelling_expenses3"

                                                           value="<?php if (isset($entry3->transport_traveling_expenses)) {

                                                               echo $entry3->transport_traveling_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="transport_travelling_expenses4"

                                                           name="transport_travelling_expenses4"

                                                           value="<?php if (isset($entry4->transport_traveling_expenses)) {

                                                               echo $entry4->transport_traveling_expenses;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Entertainment Expenses</td>

                                                <td><input type="number" class="form-control txt_input" id="entertainment_expense1"

                                                           name="entertainment_expense1"

                                                           value="<?php if (isset($entry1->entertainment_expenses)) {

                                                               echo $entry1->entertainment_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="entertainment_expense2"

                                                           name="entertainment_expense2"

                                                           value="<?php if (isset($entry2->entertainment_expenses)) {

                                                               echo $entry2->entertainment_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="entertainment_expense3"

                                                           name="entertainment_expense3"

                                                           value="<?php if (isset($entry3->entertainment_expenses)) {

                                                               echo $entry3->entertainment_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="entertainment_expense4"

                                                           name="entertainment_expense4"

                                                           value="<?php if (isset($entry4->entertainment_expenses)) {

                                                               echo $entry4->entertainment_expenses;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Debt Interest/Finance Expense</td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="debt_interest_finance_expenses1"

                                                           name="debt_interest_finance_expenses1"

                                                           value="<?php if (isset($entry1->debt_interest_finance_expenses)) {

                                                               echo $entry1->debt_interest_finance_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="debt_interest_finance_expenses2"

                                                           name="debt_interest_finance_expenses2"

                                                           value="<?php if (isset($entry2->debt_interest_finance_expenses)) {

                                                               echo $entry2->debt_interest_finance_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="debt_interest_finance_expenses3"

                                                           name="debt_interest_finance_expenses3"

                                                           value="<?php if (isset($entry3->debt_interest_finance_expenses)) {

                                                               echo $entry3->debt_interest_finance_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="debt_interest_finance_expenses4"

                                                           name="debt_interest_finance_expenses4"

                                                           value="<?php if (isset($entry4->debt_interest_finance_expenses)) {

                                                               echo $entry4->debt_interest_finance_expenses;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Net Profit</td>

                                                <td><input type="number" class="form-control txt_input" id="net_profit1"

                                                           name="net_profit1"

                                                           value="<?php if (isset($entry1->net_profit)) {

                                                               echo $entry1->net_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="net_profit2"

                                                           name="net_profit2"

                                                           value="<?php if (isset($entry2->net_profit)) {

                                                               echo $entry2->net_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="net_profit3"

                                                           name="net_profit3"

                                                           value="<?php if (isset($entry3->net_profit)) {

                                                               echo $entry3->net_profit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="net_profit4"

                                                           name="net_profit4"

                                                           value="<?php if (isset($entry4->net_profit)) {

                                                               echo $entry4->net_profit;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Net Profit Before Interest and Tax (EBIT)</td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="net_profit_before_interest_tax1"

                                                           name="net_profit_before_interest_tax1"

                                                           value="<?php if (isset($entry1->net_profit_before_interest_tax_ebit)) {

                                                               echo $entry1->net_profit_before_interest_tax_ebit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="net_profit_before_interest_tax2"

                                                           name="net_profit_before_interest_tax2"

                                                           value="<?php if (isset($entry2->net_profit_before_interest_tax_ebit)) {

                                                               echo $entry2->net_profit_before_interest_tax_ebit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="net_profit_before_interest_tax3"

                                                           name="net_profit_before_interest_tax3"

                                                           value="<?php if (isset($entry3->net_profit_before_interest_tax_ebit)) {

                                                               echo $entry3->net_profit_before_interest_tax_ebit;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="net_profit_before_interest_tax4"

                                                           name="net_profit_before_interest_tax4"

                                                           value="<?php if (isset($entry4->net_profit_before_interest_tax_ebit)) {

                                                               echo $entry4->net_profit_before_interest_tax_ebit;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Inventories (Closing Stock)</td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="inventories_closing_stock1"

                                                           name="inventories_closing_stock1"

                                                           value="<?php if (isset($entry1->inventories_closing_stock)) {

                                                               echo $entry1->inventories_closing_stock;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="inventories_closing_stock2"

                                                           name="inventories_closing_stock2"

                                                           value="<?php if (isset($entry2->inventories_closing_stock)) {

                                                               echo $entry2->inventories_closing_stock;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="inventories_closing_stock3"

                                                           name="inventories_closing_stock3"

                                                           value="<?php if (isset($entry3->inventories_closing_stock)) {

                                                               echo $entry3->inventories_closing_stock;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="inventories_closing_stock4"

                                                           name="inventories_closing_stock4"

                                                           value="<?php if (isset($entry4->inventories_closing_stock)) {

                                                               echo $entry4->inventories_closing_stock;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Trade Receivable</td>

                                                <td><input type="number" class="form-control txt_input" id="trade_receivable1"

                                                           name="trade_receivable1"

                                                           value="<?php if (isset($entry1->trade_receivable)) {

                                                               echo $entry1->trade_receivable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="trade_receivable2"

                                                           name="trade_receivable2"

                                                           value="<?php if (isset($entry2->trade_receivable)) {

                                                               echo $entry2->trade_receivable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="trade_receivable3"

                                                           name="trade_receivable3"

                                                           value="<?php if (isset($entry3->trade_receivable)) {

                                                               echo $entry3->trade_receivable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="trade_receivable4"

                                                           name="trade_receivable4"

                                                           value="<?php if (isset($entry4->trade_receivable)) {

                                                               echo $entry4->trade_receivable;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Trade Payable</td>

                                                <td><input type="number" class="form-control txt_input" id="trade_payable1"

                                                           name="trade_payable1"

                                                           value="<?php if (isset($entry1->trade_payable)) {

                                                               echo $entry1->trade_payable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="trade_payable2"

                                                           name="trade_payable2"

                                                           value="<?php if (isset($entry2->trade_payable)) {

                                                               echo $entry2->trade_payable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="trade_payable3"

                                                           name="trade_payable3"

                                                           value="<?php if (isset($entry3->trade_payable)) {

                                                               echo $entry3->trade_payable;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="trade_payable4"

                                                           name="trade_payable4"

                                                           value="<?php if (isset($entry4->trade_payable)) {

                                                               echo $entry4->trade_payable;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Non-Current Assets</td>

                                                <td><input type="number" class="form-control txt_input" id="non_current_assets1"

                                                           name="non_current_assets1"

                                                           value="<?php if (isset($entry1->non_current_assets)) {

                                                               echo $entry1->non_current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="non_current_assets2"

                                                           name="non_current_assets2"

                                                           value="<?php if (isset($entry2->non_current_assets)) {

                                                               echo $entry2->non_current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="non_current_assets3"

                                                           name="non_current_assets3"

                                                           value="<?php if (isset($entry3->non_current_assets)) {

                                                               echo $entry3->non_current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="non_current_assets4"

                                                           name="non_current_assets4"

                                                           value="<?php if (isset($entry4->non_current_assets)) {

                                                               echo $entry4->non_current_assets;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Current Assets</td>

                                                <td><input type="number" class="form-control txt_input" id="current_assets1"

                                                           name="current_assets1"

                                                           value="<?php if (isset($entry1->current_assets)) {

                                                               echo $entry1->current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="current_assets2"

                                                           name="current_assets2"

                                                           value="<?php if (isset($entry2->current_assets)) {

                                                               echo $entry2->current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="current_assets3"

                                                           name="current_assets3"

                                                           value="<?php if (isset($entry3->current_assets)) {

                                                               echo $entry3->current_assets;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="current_assets4"

                                                           name="current_assets4"

                                                           value="<?php if (isset($entry4->current_assets)) {

                                                               echo $entry4->current_assets;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Current Liabilities</td>

                                                <td><input type="number" class="form-control txt_input" id="current_liabilities1"

                                                           name="current_liabilities1"

                                                           value="<?php if (isset($entry1->current_liabilities)) {

                                                               echo $entry1->current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="current_liabilities2"

                                                           name="current_liabilities2"

                                                           value="<?php if (isset($entry2->current_liabilities)) {

                                                               echo $entry2->current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="current_liabilities3"

                                                           name="current_liabilities3"

                                                           value="<?php if (isset($entry3->current_liabilities)) {

                                                               echo $entry3->current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="current_liabilities4"

                                                           name="current_liabilities4"

                                                           value="<?php if (isset($entry4->current_liabilities)) {

                                                               echo $entry4->current_liabilities;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Non-current Liabilities</td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="non_current_liabilities1" name="non_current_liabilities1"

                                                           value="<?php if (isset($entry1->non_current_liabilities)) {

                                                               echo $entry1->non_current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="non_current_liabilities2" name="non_current_liabilities2"

                                                           value="<?php if (isset($entry2->non_current_liabilities)) {

                                                               echo $entry2->non_current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="non_current_liabilities3" name="non_current_liabilities3"

                                                           value="<?php if (isset($entry3->non_current_liabilities)) {

                                                               echo $entry3->non_current_liabilities;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input"

                                                           id="non_current_liabilities4" name="non_current_liabilities4"

                                                           value="<?php if (isset($entry4->non_current_liabilities)) {

                                                               echo $entry4->non_current_liabilities;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Share Capital</td>

                                                <td><input type="number" class="form-control txt_input" id="share_capita1"

                                                           name="share_capita1"

                                                           value="<?php if (isset($entry1->share_capital)) {

                                                               echo $entry1->share_capital;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="share_capita2"

                                                           name="share_capita2"

                                                           value="<?php if (isset($entry2->share_capital)) {

                                                               echo $entry2->share_capital;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="share_capita3"

                                                           name="share_capita3"

                                                           value="<?php if (isset($entry3->share_capital)) {

                                                               echo $entry3->share_capital;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="share_capita4"

                                                           name="share_capita4"

                                                           value="<?php if (isset($entry4->share_capital)) {

                                                               echo $entry4->share_capital;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Retained Earning</td>

                                                <td><input type="number" class="form-control txt_input" id="retained_earning1"

                                                           name="retained_earning1"

                                                           value="<?php if (isset($entry1->retained_earning)) {

                                                               echo $entry1->retained_earning;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="retained_earning2"

                                                           name="retained_earning2"

                                                           value="<?php if (isset($entry2->retained_earning)) {

                                                               echo $entry2->retained_earning;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="retained_earning3"

                                                           name="retained_earning3"

                                                           value="<?php if (isset($entry3->retained_earning)) {

                                                               echo $entry3->retained_earning;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="retained_earning4"

                                                           name="retained_earning4"

                                                           value="<?php if (isset($entry4->retained_earning)) {

                                                               echo $entry4->retained_earning;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Translation Reserves</td>

                                                <td><input type="number" class="form-control txt_input" id="translation_reserves1"

                                                           name="translation_reserves1"

                                                           value="<?php if (isset($entry1->translation_reserves)) {

                                                               echo $entry1->translation_reserves;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="translation_reserves2"

                                                           name="translation_reserves2"

                                                           value="<?php if (isset($entry2->translation_reserves)) {

                                                               echo $entry2->translation_reserves;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="translation_reserves3"

                                                           name="translation_reserves3"

                                                           value="<?php if (isset($entry3->translation_reserves)) {

                                                               echo $entry3->translation_reserves;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="translation_reserves4"

                                                           name="translation_reserves4"

                                                           value="<?php if (isset($entry4->translation_reserves)) {

                                                               echo $entry4->translation_reserves;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Total Debt</td>

                                                <td><input type="number" class="form-control txt_input" id="total_debt1"

                                                           name="total_debt1"

                                                           value="<?php if (isset($entry1->total_debt)) {

                                                               echo $entry1->total_debt;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="total_debt2"

                                                           name="total_debt2"

                                                           value="<?php if (isset($entry2->total_debt)) {

                                                               echo $entry2->total_debt;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="total_debt3"

                                                           name="total_debt3"

                                                           value="<?php if (isset($entry3->total_debt)) {

                                                               echo $entry3->total_debt;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="total_debt4"

                                                           name="total_debt4"

                                                           value="<?php if (isset($entry4->total_debt)) {

                                                               echo $entry4->total_debt;

                                                           } ?>"></td>

                                            </tr>

                                            <tr>

                                                <td class='sticky-row'>Prepaid Expenses</td>

                                                <td><input type="number" class="form-control txt_input" id="prepaid_expenses1"

                                                           name="prepaid_expenses1"

                                                           value="<?php if (isset($entry1->prepaid_expenses)) {

                                                               echo $entry1->prepaid_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="prepaid_expenses2"

                                                           name="prepaid_expenses2"

                                                           value="<?php if (isset($entry2->prepaid_expenses)) {

                                                               echo $entry2->prepaid_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="prepaid_expenses3"

                                                           name="prepaid_expenses3"

                                                           value="<?php if (isset($entry3->prepaid_expenses)) {

                                                               echo $entry3->prepaid_expenses;

                                                           } ?>"></td>

                                                <td><input type="number" class="form-control txt_input" id="prepaid_expenses4"

                                                           name="prepaid_expenses4"

                                                           value="<?php if (isset($entry4->prepaid_expenses)) {

                                                               echo $entry4->prepaid_expenses;

                                                           } ?>"></td>

                                            </tr>
                                            
                                            <tr>

                                             <td colspan="5">
                                                 <div class="alert bg-dark text-white">
                                                     <p><b class="text-company">TIP:</b>
                                                     
                                                        When inputing MONTH in the file, make sure that the month word is exactly the same in the following below:<br>
                                                        <br>
                                                        <ul class="text-company sbold" style="margin-20px">
                                                            <li>Jan.</li>
                                                            <li>Feb.</li>
                                                            <li>Mar.</li>
                                                            <li>Apr.</li>
                                                            <li>May</li>
                                                            <li>Jun.</li>
                                                            <li>Jul.</li>
                                                            <li>Aug.</li>
                                                            <li>Sep.</li>
                                                            <li>Oct.</li>
                                                            <li>Nov.</li>
                                                            <li>Dec.</li>
                                                        </ul>
                                                     
                                                     </p>
                                                 </div>
                                                <div class="alert" style="width: 100%; overflow: hidden; margin-left: 0px !important;"><p>
                                                    <strong>Upload CSV</strong>
                                                <input type="file" name="uploadCSV" id="uploadCSV" class="btn btn-primary" style="float:right">
                                                 
                                                </p>
                                                </div>
                                             
                                            </td>   
                                            </tr>  

                                        </table>

                                    </div>

                                    </div>

                                </div>

                                <!-- END FINANCIAL ENTRIES TAB -->

                            </div>

                        </div>

                        <!-- SAVE AND CANCEL BUTTON-->

                        <div class="form-group">

                            <input type="button" class="btn btn-secondary" value="Cancel"

                                   id="cancelButtonCompanyProfile"/>

                            <button id="saveButtonCompanyProfile" type="submit" class="btn btn-primary" ><i class="fa fa-save"></i> SAVE</button>

                        </div>



                    </form>

                    <!-- END FORM TAG-->

                </div>
    </div>

    <div class="col-sm-6" id="two_div">
        <div class="row"  >
            <div class="col-md-12">
                <div class="alert bg-dark text-white">
                    <b class="text-company">TIP: </b>   
                    Below words are the words that has been extracted from the uploaded PDF file. You can drag those words into the left
                    input that have <b class="text-company">green left border</b>.
                </div>
            </div>
        </div>
      <div class="row"  >
                <div class="col-md-12" style="overflow-wrap: break-word;overflow:scroll !important;height:60vh; ">
            <?php
                $colors = array("info","warning","primary","danger","default","success");
                $text = '<span draggable="true" class="label label-success">';
                
                $count = 1;
                
                
                foreach($response['ParsedResults'] as $pareValue) {
                    $val_exploded = explode("\r",$pareValue['ParsedText']);
                    
                    foreach($val_exploded as $val) {
                        if($count == 6){
                            $count = 0;
                        }
                        $text .= '</span><span draggable="true" class="label label-'.$colors[$count].'">'.preg_replace('/[^a-zA-Z0-9_ -]/s',' ',str_replace(array("\n","\r"),"",$val));
                        $count++;
                        
                    }
                }
                
                 $text .= '</span>';
                 echo $text;
            ?></div>
            </div>
    </div>
  </div>

        </div>
    </div>
    
    <!-- START MODAL FOR ADDING KEY PERSONNEL -->

   <div class="modal fade" id="key_personel_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel" >Key Management Personnel</h4>
      </div>
      <div class="modal-body">

            <br/>



            <div class="form-group">

                <label for="derictorship">Directorship</label>

                <br>

                <input type="radio" name="is_directorship" id="is_directorship_km" value="Yes"> Yes <br/>

                <input type="radio" name="is_directorship" name="is_directorship_km" value="No"> No

            </div>

            <input type="hidden" name="km_id" id="km_id" value="<?php if (isset($km_id)) {

                echo $km_id;

            } else {

                echo '0';

            } ?>">



            <input type="hidden" name="user_id_km" id="user_id_km" value="<?php if (isset($user_id)) {

                echo $user_id;

            } else {

                echo '0';

            } ?>">



            <div class="form-group">
                <label>First Name: </label>
                <input class="form-control" type="text" id="first_name_km" placeholder="First Name"/></h4>

            </div>



            <div class="form-group">
                <label>Last Name: </label>
                <input class="form-control" type="text" id="last_name_km" placeholder="Last Name"/></h4>

            </div>



            <div class="form-group">
                <label>Identification / Passport: </label>
                <input class="form-control" type="text" id="idn_passport_km"

                       placeholder="Identification / Passport"/></h4>

            </div>



            <div class="form-group">
                <label>Nationality</label>
                <input class="form-control" type="text" id="nationality_km" placeholder="Nationality"/></h4>

            </div>


         
            <div class="form-group">
                <div class="col-12">
                <input type="hidden" id="default_datepicker_dob"  >
                <label for="datepicker_dob">Date Of Birth</label>
                </div>  
            </div>
            <div class="form-group example">
                <div class="col-12">
                <input type="text" class="form-control" id="datepicker_dob"
                       name="datepicker_dob" >
                </div>  
            </div>


            <div class="form-group">
                <label>Majority Shareholder</label>
                <input class="form-control" type="text" onblur="addPercent()" id="shareholder_km"

                       placeholder="Majority Shareholder"/></h4>

            </div>



            <div class="form-group">
                <label>Position</label>
                <input class="form-control" type="text" id="position_km" placeholder="Position"/></h4>

            </div>



            <div class="form-group">

                <label for="gender_km">Gender</label>

                <br>

                <input type="radio" name="gender" id="gender_km" value="Male"> Male <br/>

                <input type="radio" name="gender" id="gender_km" value="Female"> Female



            </div>



            <div class="form-group">
              <div class="modal-footer">
                <button type="button" class="btn btn-raised btn-secondary" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-raised btn-primary" id="ajxUpdateKM">Save</button>
              </div>
            </div>

            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->

            {{-- <a class="popup-close" data-popup-close="popup-1" href="#">x</a> --}}

        </div>

    </div>
    </div>
    </div>
    
     <!-- JavaScript Includes -->

     <script src="{{ asset('public/mini-upload/assets/js/jquery.knob.js') }}"></script>



    <!-- jQuery File Upload Dependencies -->

     <script src="{{ asset('public/mini-upload/assets/js/jquery.ui.widget.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/jquery.iframe-transport.js') }}"></script>



    <script src="{{ asset('public/mini-upload/assets/js/jquery.fileupload.js') }}"></script>



    <!-- Our own JS file -->

    <script src="{{ asset('public/mini-upload/assets/js/script.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script1.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script2.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script3.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
<script>

function updateExpirydate(strExpiry)

        {

         var dateValue =  $("#expiryDate"+strExpiry).val();



          formData = new FormData();

          formData.append("file_id", strExpiry);

          formData.append("date_value", dateValue);



            $.ajax({

                url: "{{ route('updateFileExpiry') }}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,



                success: function (data) {

                    $("#expiryDate"+strExpiry).prop("disabled", true);

                    swal("Good job!", "Success updating expiray date!", "success");

                }

            });



        }


        function editExpirydate(strExpiry)

        {

            $("#expiryDate"+strExpiry).prop("disabled", false);

            $("#expiryDate"+strExpiry).datepicker({ dateFormat: 'yy-mm-dd' });

        }

function processRemoveFile(cId, divIdx, fname) {



            swal({

                title: "Are you sure to delete this file '" + fname + "'?",

                text: "You will not be able to recover this file!",

                icon: "warning",

                buttons: [

                    'No, cancel it!',

                    'Yes, I am sure!'

                ],

                dangerMode: true,

            }).then(function (isConfirm) {

                if (isConfirm) {

                    swal({

                        title: 'Succesful',

                        text: 'Files has been removed',

                        icon: 'success'

                    }).then(function () {
                        
                        formData = new FormData();

                        formData.append("fileupload_id", cId);

                        $.ajax({

                            url: "{{ route('delUploadedFile') }}",

                            type: "POST",

                            data: formData,

                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                            processData: false,

                            contentType: false,



                            success: function (data) {

                                $('#' + divIdx + cId).remove();

                            }
                        });
                    });

                } else {

                    swal("Cancelled", "", "error");

                }

            })



        }

function clearKM() {

            $("#first_name_km").val('');

            $("#last_name_km").val('');

            $("#idn_passport_km").val('');

            $("#nationality_km").val('');

            $("#default_datepicker_dob").val('');

            $("#shareholder_km").val('');

            $("#position_km").val('');

            $("input[name=gender]").val([]);

            $("input[name=is_directorship]").val([]);

            $("#km_id").val(0);

            dropDateKM();

        }
        
    function dropDateKM(){
                var default_datepicker_dob = $("#default_datepicker_dob").val();
                $("#datepicker_dob").dateDropdowns({
                    defaultDate: default_datepicker_dob,
                    required: true
                });
        }
        
        function editKM(tor) {

            $("#km_id").val(tor);



            formData = new FormData();

            formData.append("km_id", tor);



            $.ajax({

                url: "{{ route('editKM') }}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,



                success: function (data) {

                    $("#user_id_km").val(data.user_id);

                    $("#first_name_km").val(data.first_name);

                    $("#last_name_km").val(data.last_name);

                    $("#idn_passport_km").val(data.idn_passport);

                    $("#nationality_km").val(data.nationality);

                    $("#default_datepicker_dob").val( data.date_of_birth) ;

                    $("#shareholder_km").val(data.shareholder);

                    $("#position_km").val(data.position);

                    $("input[name=gender]").val([data.gender]);

                    $("input[name=is_directorship]").val([data.is_directorship]);

                    dropDateKM();

                }

            });



        }
        
        function delKM(tor, idx) {

            var txt;

            var r = confirm("Are you sure to delete personnel number " + idx + "  ?");

            if (r == true) {



                formData = new FormData();

                formData.append("km_id", tor);



                $.ajax({

                    url: "{{ route('deleteKM') }}",

                    type: "POST",

                    data: formData,

                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                    processData: false,

                    contentType: false,



                    success: function (data) {
                        alert("Success");
                        window.location.reload();
                    }

                });





            } else {

                txt = "You pressed Cancel!";

            }



        }
        
        $("#ajxUpdateKM").click(function () {



            var userId = $("#user_id_km").val();

            var fname = $("#first_name_km").val();

            var lname = $("#last_name_km").val();

            var idnpassport = $("#idn_passport_km").val();

            var nationality = $("#nationality_km").val();

            var gender = $('input[name=gender]:checked').val();

            var dob = $("#datepicker_dob").val();

            var shareholder = $("#shareholder_km").val();

            var isDirectorship = $('input[name=is_directorship]:checked').val();

            var position = $("#position_km").val();

            var kmid = $("#km_id").val();

            formData = new FormData();

            formData.append("km_id", kmid);

            formData.append("user_id", userId);

            formData.append("first_name", fname);

            formData.append("last_name", lname);

            formData.append("idn_passport", idnpassport);

            formData.append("nationality", nationality);

            formData.append("gender", gender);

            formData.append("date_of_birth", dob);

            formData.append("shareholder", shareholder);

            formData.append("is_directorship", isDirectorship);

            formData.append("position", position);


            $.ajax({

                url: "{{route('saveKM')}}",

                type: "POST",

                data: formData,

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                processData: false,

                contentType: false,



                success: function (data) {

                    $(".popup").hide(250);

                    $("#keyPersonnels").html(data);

                }

            });



        });

    $(document).ready(function(){
        $('#saveButtonCompanyProfile').click(function () {

            $('#company_profile_form').submit();

        });
        
        var maxLength = 500;
        $('#description').keyup(function() {
          var length = $(this).val().length;
          var length = maxLength-length;
          $(this).parent().find('#count').text(length +"/"+maxLength);
        });
        
        var input = document.getElementsByClassName("txt_input");
            
            for (var i = 0 ; i < input.length; i++) {
                input[i].addEventListener('drop', function (event) {
                    event.preventDefault();
                    var textData = event.dataTransfer.getData('text'); // get the dragged value
                    var oldval = event.target.value; // get the old value in the input
                    var newval = oldval + textData; // add it with the value which is dragged upon
                    event.target.value = newval; // change the value with the new value
                });  
            }
            
        var label = document.getElementsByClassName("label");
        for (var i = 0 ; i < label.length; i++) {
            label[i].addEventListener('dragstart', function (e) {
                e.dataTransfer.setData('text', e.target.innerHTML);
            });
        }
        
        var limit = 300; //height limit
        $('.txt_input').on('input paste drop', function() {
            this.style.height = "";
            this.style.height = Math.min(this.scrollHeight, limit) + "px";
            this.focus();
        });
    });
</script>

<div class="modal-load"><!-- Place at bottom of page --></div>
<?php

?>

@endsection
