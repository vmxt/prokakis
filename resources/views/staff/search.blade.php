@extends('layouts.app')

@section('content')
<link href="{{ asset('public/multiselectJS/select2.css') }}" rel="stylesheet">

{{-- <script src="{{ asset('public/jq-autocomplete/jquery-1.11.2.min.js') }}"></script> --}}
{{-- <script src="{{ asset('public/jq-autocomplete/jquery.easy-autocomplete.min.js') }}"></script> --}}
{{-- <link href="{{ asset('public/jq-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" type="text/css"/> --}}
{{-- <link href="{{ asset('public/jq-autocomplete/easy-autocomplete.themes.min.css') }}" rel="stylesheet" type="text/css"/> --}}
<script src="{{ asset('public/multiselectJS/select2.js') }}"></script> 
<!--<script src="{{ asset('public/js/app.js') }}"></script>-->

    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">
    
    <style>


        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .btn-x3 {
            font-size: 15px;
            border-radius: 5px;
            width: 25%;
            background-color: orangered;
        }

     /* Outer */
.popup {
    width:100%;
    height:100%;
    display:none;
    position:fixed;
    top:0px;
    left:0px;
    background:rgba(0,0,0,0.75);
    z-index: 10;
}       

        /* Inner */
.popup-inner {
    max-width:900px;
    width:90%;
    padding:40px;
    position:absolute;
    top:50%;
    left:50%;
    -webkit-transform:translate(-50%, -50%);
    transform:translate(-50%, -50%);
    box-shadow:0px 2px 6px rgba(0,0,0,1);
    border-radius:3px;
    background:#fff;
    z-index: 10;
}

/* Close Button */
.popup-close {
    width:30px;
    height:30px;
    padding-top:4px;
    display:inline-block;
    position:absolute;
    top:25px;
    left:0px;
    transition:ease 0.25s all;
    -webkit-transform:translate(50%, -50%);
    transform:translate(50%, -50%);
    border-radius:1000px;
    background:rgba(0,0,0,0.8);
    font-family:Arial, Sans-Serif;
    font-size:20px;
    text-align:center;
    line-height:100%;
    color:#fff;
}

.popup-close:hover {
    -webkit-transform:translate(50%, -50%) rotate(180deg);
    transform:translate(50%, -50%) rotate(180deg);
    background:rgba(0,0,0,1);
    text-decoration:none;
}

.container, .container-fluid {
    margin-right: auto;
    /* margin-left: auto; */
}

table{
    table-layout: fixed;
  }    
td{
      overflow: wrap;
      word-wrap:break-word;
  
  }   

  .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('public/spinner/lg.rotating-balls-spinner.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
    }
  
</style>

    <div class="container" >
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Thomson Reuters</span>
            </li>
        </ul>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="portlet light">
                    <div class="portlet-body light">

                        <div class="loader"></div>

                @if ($errors->any())

                <div class="alert alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

                    <div class="card">
                        <div class="form-group">
                            <label> Search Type: </label>    
                            <input type="checkbox" id="SearchCategory" name="SearchCategory" data-toggle="switchbutton" checked data-onlabel="Person" data-offlabel="Company" data-onstyle="success" data-offstyle="info">
                        </div>
                           
                        <div id="front"> 
                            <form id="thomson_search" method="POST" action="{{ route('thomsonSearchFound') }}">
                            {{ csrf_field() }}

                         
                                <div class="form-group">
                                    <label> First Name </label>
                                    <input id="first_name" name="first_name" minlength="3" class="form-control placeholder-no-fix form-body" type="text" placeholder="Write First Name" autofocus>
               
                                </div>
                                
                                <div class="form-group">
                                        <label> Last Name </label>
                                        <input id="last_name" name="last_name" minlength="3"  class="form-control placeholder-no-fix" type="text" placeholder="Write Last Name"  autofocus>
                                </div>
                                
                                <div class="form-group">
                                        <label> Gender <code>required *</code></label>
                                        <select name="gender" multiple="" class="form-control" style="height:90px">
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                                <option value="E">Others - as a company, corp, group </option>
                                        </select>
                            
                                </div>

                                   
                                <div class="form-group">
                                    <label> Other Names (Alias) </label>
                                    <input style="text-transform:capitalize;" minlength="3" id="alias" name="alias" class="form-control" type="text" placeholder="Alias">
                                </div>

                                   
                                <div class="form-group">
                                    <label> DOB </label>
                                    <input style="text-transform:capitalize;" id="dob" name="dob" class="form-control" type="text" placeholder="Date of Birth">
                                    <span class="form-text text-muted">Custom date format:<code>yyyy-mm-dd</code></span>
                                </div>
 <?php
                                            $locations = array();
                                            foreach ($country_list as $d) {
                                                $arr = $d->COUNTRIES;
                                                // echo $arr.'<br />';
                                                $ar = explode(",", $arr);
                                                if (count((array) $ar) > 0) {
                                                    foreach ($ar as $b) {
                                                        $c = trim($b);
                                                        if ($c != '-') {
                                                            $locations[] = $c;
                                                        }
                                                    }
                                                }
                                            }
                                            $country_arr = array_unique($locations);
                                            sort($country_arr);
                                            $citizenship = array();
                                            foreach ($citenzenship_list as $d) {
                                                $arr = $d->CITIZENSHIP;
                                                // echo $arr.'<br />';
                                                $ar = explode(";", $arr);
                                                if (count((array) $ar) > 0) {
                                                    foreach ($ar as $b) {
                                                        $c = trim($b);
                                                        if ($c != '-') {
                                                            $citizenship[] = $c;
                                                        }
                                                    }
                                                }
                                            }
                                            $citizenship_arr = array_unique($citizenship);
                                            sort($citizenship_arr);

?>
                                <div class="form-group">
                                    <label> Country <code>required *</code></label>
                                    <!-- <input style="text-transform:capitalize;" id="country_location" name="country_location" class="form-control" type="text" placeholder="Write Country Location"> -->
                                    <select style="text-transform:capitalize;" class="form-control placeholder-no-fix" id="country_location"  dataName="country_location" placeholder="Write Country Location" name="country_location">
                                            <option value="" id="">Please select the following</option>
                                            @foreach($country_arr as $countries)
                                            <option
                                                 value="<?php echo $countries  ?>"><?php echo $countries; ?>
                                            </option>
                                            @endforeach
                                    </select>
                                </div>

                                

                                <div class="form-group">
                                    <label> Nationality </label>
                                  <!--   <input style="text-transform:capitalize;" id="nationality" name="nationality" class="form-control placeholder-no-fix" type="text" placeholder="Write Nationality" autofocus> -->

                                    <select style="text-transform:capitalize;" class="form-control placeholder-no-fix" id="nationality"  dataName="nationality" placeholder="Write Nationality" name="nationality">
                                            <option value="" id="">Please select the following</option>
                                            @foreach($citizenship_arr as $citizenship)
                                            <option
                                                 value="<?php echo $citizenship  ?>"><?php echo $citizenship; ?>
                                            </option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label> Write Passport / IC No. </label>
                                    <input id="passport" name="passport" class="form-control placeholder-no-fix" type="text" placeholder="Write Passport / IC No." autofocus>
                                </div>
 

                                <div class="actions">
                                    <input type="submit" class="btn btn-primary" id="searchFormSubmit" value="Search">
                                </div>
                           
                            </form>
                        </div>

                        <div id="back">
                            <form id="thomson_search" method="POST" action="{{ route('searchFoundCompany') }}">
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label> Company Name </label>
                                    <input id="company_name" name="company_name" class="form-control placeholder-no-fix" type="text" placeholder="Write Company Name" autofocus>
               
                                </div>

                                <div class="form-group">
                                    <label> Country <code>required *</code></label>
                                    <select style="text-transform:capitalize;" class="form-control placeholder-no-fix" id="country_location2"  dataName="country_location" placeholder="Write Country Location" name="country_location">
                                            <option value="" id="">Please select the following</option>
                                            @foreach($country_arr as $countries)
                                            <option
                                                 value="<?php echo $countries  ?>"><?php echo $countries; ?>
                                            </option>
                                            @endforeach
                                    </select>
                                </div>

                                <div class="actions">
                                    <input type="submit" class="btn btn-primary" id="searchFormSubmit" value="Search">
                                </div>
                    
                            </form>
                        </div> 

                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-9">

                    <div class="portlet light scrollable">
                        <div class="portlet-title">

                            <div class="caption">
                                <i class="icon-bulb font-red"></i>
                                <span class="caption-subject font-blue bold uppercase"><b><?php if(isset($sumRec)){ echo $sumRec . " of records found."; } ?></b> </span>
                            </div>
                          
                              
                        </div>

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

                        <?php 
                        if(isset($search)){
                         echo '<div class="note note-success"><h4>Search Keys</h4>'.$search.'</div>';
                        }
                        ?>

                        <div class="portlet-body">

                           
                            <button type="button" name="forPrintingProcess" id="forPrintingProcess" style="float:right;" class="btn yellow mt-ladda-btn ladda-button btn-circle btn-outline" data-style="slide-right" data-spinner-color="#333">
                                <span class="ladda-label">
                                    <i class="icon-login"></i> Items for PDF Download and Printing? </span>
                                <span class="ladda-spinner"></span>
                            </button>
                     
                            <button data-popup-open="popup-3" type="button" id="processSelectedItems" style="float:left;" class="btn red mt-ladda-btn ladda-button btn-circle btn-outline" data-style="slide-right" data-spinner-color="#333">
                                <span class="ladda-label">
                                    <i class="icon-login"></i>  Process Selected Items for Request Report? </span>
                                <span class="ladda-spinner"></span>
                            </button>
                            <br>
                            <br>
                            <div class="table-scrollable">

                                <table  class="table table-bordered table-striped table-condensed flip-content">
                                    <thead class="flip-content">
                                    <tr>
                                        <th width="5%"> 
                                            <div class="md-checkbox">
                                            <input type="checkbox" name="checkboxesAll" value="all" id="checkboxesAll" class="md-check" >
                                            <label for="checkboxesAll">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span>
                                            </label>
                                            </div> 
                                       </th>
                                        <th >Action</th>
                                        <th>Match %</th>
                                        <th >First Name</th>
                                        <th >Last Name</th>
                                        <!-- <th width="5%">Aliases</th> -->
                                        <th >Category</th> 
                                        <th >Position</th> 
                                        <!-- <th width="8%">Place of birth</th>  -->
                                        <th >Country</th>
                                        <!-- <th width="8%">Locations</th> -->
                                        <!-- <th width="15%">Further Information</th> -->
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php if(isset($rs) && $rs != null){
                                           foreach($rs as $d){
                                             similar_text(strtolower($input['first_name']), strtolower($d->FIRST_NAME), $fname_percent); 
                                             similar_text(strtolower($input['last_name']), strtolower($d->LAST_NAME), $lname_percent); 
                                             similar_text(strtolower($input['gender']), strtolower($d->E_I), $gender_percent); 
                                             similar_text(strtolower($input['alias']), strtolower($d->ALIASES), $alias_percent); 
                                             similar_text(strtolower($input['dob']), strtolower($d->DOB), $dob_percent); 
                                             similar_text(strtolower($input['country_location']), strtolower($d->COUNTRIES), $countries_percent); 
                                             similar_text(strtolower($input['nationality']), strtolower($d->CITIZENSHIP), $citizenship_percent); 
                                             similar_text(strtolower($input['passport']), strtolower($d->PASSPORTS), $passport_percent); 
                                             $total_percent = $fname_percent + $lname_percent + $gender_percent + $alias_percent + $dob_percent + $countries_percent + $citizenship_percent + $passport_percent;
                                             $total_percent = $total_percent / 8;

                                    ?>    
                                    <tr>

                                        <td>
                                            <span class="card" style="float:left;">
                                                <div class="md-checkbox">

                                                    <input type="checkbox" name="checkboxes1[]" value="<?php echo $d->UID; ?>" id="checkbox_<?php echo $d->UID; ?>" class="md-check" >

                                                    <label for="checkbox_<?php echo $d->UID; ?>">

                                                        <span class="inc"></span>

                                                        <span class="check"></span>

                                                        <span class="box"></span>
                                                    </label>

                                                </div>
                                            </span>
                                        </td>
                                            <td>
                                                <span class="card" style="float:left;">
                                                    <input data-popup-open="popup-2" onclick="openTR(<?php echo $d->UID; ?>);" type="button" class="btn btn-danger" value="view" />
                                                </span>
                                            </td>
                                            <td><?=number_format($total_percent,2)?> %</td>
                                            <td><?php echo (isset($d->FIRST_NAME))? $d->FIRST_NAME : ''; ?></td>
                                            <td><?php echo (isset($d->LAST_NAME))? $d->LAST_NAME : ''; ?></td>
                                            <!-- <td width="5%"><?php //echo (isset($d->ALIASES))? $d->ALIASES : ''; ?></td> -->
                                            <td width="5%"><?php echo (isset($d->CATEGORY))? $d->CATEGORY : ''; ?></td> 
                                            <td width="5%"><?php echo (isset($d->POSITION))? $d->POSITION : ''; ?></td> 
                                        <!--     <td width="5%"><?php //echo (isset($d->PLACE_OF_BIRTH))? $d->PLACE_OF_BIRTH : ''; ?></td>  -->
                                            <td width="5%"><?php echo (isset($d->COUNTRIES))? $d->COUNTRIES : ''; ?></td>
                                            <!-- <td width="5%"><?php //echo (isset($d->LOCATIONS))? $d->LOCATIONS : ''; ?></td>
                                            <td><?php //echo (isset($d->FURTHER_INFORMATION))? $d->FURTHER_INFORMATION : ''; ?></td> -->
                                           
                                    </tr>
                                   
                                   <?php 
                                            }
                                    } 
                                    
                                   ?>
                               
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                </div>

        </div>

     
     <div class="popup" data-popup="popup-2">
                <div class="popup-inner" style="overflow: scroll;height: -webkit-fill-available;">
                    <div id="tr_result"></div>
                    <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
                </div>
     </div>    

     <div class="popup" data-popup="popup-3">
        <div class="popup-inner" style="overflow: scroll; height:500px; width:900px;">
            <div class="note note-success">
                You may now <b>SELECT</b> which request to tie up the selected Thomson Reuters items.
            </div>      
        <div>
         <input type="hidden" id="selectedItems" name="selectedItems" value="">   

         <table  class="table table-bordered table-striped table-condensed flip-content">
            <thead class="flip-content">
            <tr>
                <th width="2%">Action</th>
                <th width="2%">Request ID</th>
                <th width="5%">Company as Provider</th>
                <th width="5%">Company as Requester</th>
                <th width="5%">Person Incharge</th>
                <th width="5%">Requested At</th> 
            </tr>

            </thead>
            <tbody> 
             <?php 
                if(isset($rr)){
                   foreach($rr as $d){
                ?>
                <tr>
                    <td width="2%">
                        <button class="btn btn-primary" onclick="assignTR('<?php echo $d->id; ?>')"> SELECT </button>
                    </td>
                    <td width="2%"><?php echo $d->id; ?></td>
                    <td width="5%"><?php 
                      $prov =  App\CompanyProfile::find($d->source_company_id);    
                      echo $prov->company_name; 
                    ?></td>
                    <td width="5%"><?php 
                        $req =  App\CompanyProfile::find($d->company_id);  
                        echo $req->company_name; 
                    ?></td>
                    <td width="5%"><?php echo $d->person_incharge; ?></td>
                    <td width="5%"><?php echo $d->created_at; ?></td> 
                </tr>
                <?php

                $tr = App\TR_reportgeneration::where('request_id', $d->id)->get();

                if($tr != null)
                {
                    foreach($tr as $t){
                      $trd = App\ThomsonReuters::searchAllThree($t->uid);
                    ?>
                    <tr>
                        <td colspan="6">
                            <div style="padding:10px;" class="alert-info" id="trs_<?php echo $t->id; ?>"> <?php echo $t->uid.', <b>'.$trd->FIRST_NAME.' '.$trd->LAST_NAME.'</b>, '.$trd->COUNTRIES; ?><button style="float:right;" onclick="delTR('<?php echo $t->id; ?>')">Delete</button></div>
                        </td>
                    </tr> 
                       
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="6"> &nbsp; </td>
                    </tr> 
                    <?php
                }
                ?>

               <?php 
                    }
                } else { 
               ?> 
                    <tr>
                        <td colspan="6"> No Active Report Request Found.</td>
                    </tr>    
               <?php } ?>
            </tbody>
        </table>     

       </div>     
        <a class="popup-close" data-popup-close="popup-3" href="#">x</a>
        </div>
    </div> 

    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

     <script>
        $(document).ready(function() {  
        $("#back").fadeOut("slow");
        $('#dob').mask('0000-00-00');
        $('#country_location').select2();
        $('#country_location2').select2();
        $('#nationality').select2();
        });    
            // var options = {
            //     url: "{{ route('getCountryLocation') }}",
            //     getValue: "LOCATIONS",
            //     list: {
            //         maxNumberOfElements: 5,
            //         match: {
            //             enabled: true
            //         },
            //         sort: {
            //             enabled: true
            //         },
            //         onClickEvent: function() {
            //             console.log('click');

            //         },
            //         showAnimation: {
            //             type: "fade", //normal|slide|fade
            //             time: 400,
            //             callback: function() {}
            //         },
            
            //         hideAnimation: {
            //             type: "slide", //normal|slide|fade
            //             time: 400,
            //             callback: function() {}
            //         }    

            //     }
            // };
            // $("#country_location").easyAutocomplete(options); 
            
            
            // var optionsNationality = {
            //     url: "{{ route('getNationality') }}",
            //     getValue: "CITIZENSHIP",
            //     list: {
            //         maxNumberOfElements: 5,
            //         match: {
            //             enabled: true
            //         },
            //         sort: {
            //             enabled: true
            //         },
            //         onClickEvent: function() {
            //             console.log('click');

            //         },
            //         showAnimation: {
            //             type: "fade", //normal|slide|fade
            //             time: 400,
            //             callback: function() {}
            //         },
            
            //         hideAnimation: {
            //             type: "slide", //normal|slide|fade
            //             time: 400,
            //             callback: function() {}
            //         }    
            //     }
            // };
            // $("#nationality").easyAutocomplete(optionsNationality); 
            

                $(".easy-autocomplete-container").on("show.eac", function(e) {
                    var inputId = this.id.replace('eac-container-','')
                var isFocused  = $("#"+inputId).is(":focus")
                if (!isFocused ) {
                    e.stopImmediatePropagation()
                }
                });
            
                $(".easy-autocomplete-container").each(function() {
                $._data(this, 'events')["show"].reverse()
                })
    
                //----- OPEN
                $('[data-popup-open]').on('click', function(e) {
                    var targeted_popup_class = jQuery(this).attr('data-popup-open');
                    $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
                    e.preventDefault();
                });

                //----- CLOSE
                $('[data-popup-close]').on('click', function(e) {
                    var targeted_popup_class = jQuery(this).attr('data-popup-close');
                    $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
                    e.preventDefault();
                });

                $("#processSelectedItems").on('click', function(e){
                   
                    var favorite = [];
                    $.each($("input[name='checkboxes1[]']:checked"), function(){            
                        favorite.push($(this).val());
                    });
                    //alert("My favourite sports are: " + favorite.join(", "));
                    var result = favorite.join(", ");
                    $("#selectedItems").val(result);
                });

                $("#forPrintingProcess").on('click', function(e){
                   
                    var forPrint = [];
                    $.each($("input[name='checkboxes1[]']:checked"), function(){            
                        forPrint.push($(this).val());
                    });
                    //alert("My favourite for printing are: " + forPrint.join(", "));
                    var result = forPrint.join(",");
                    if(result != ''){
                    window.open(encodeURI("{{ url('/thomson-pdfprint/') }}"+"/"+result), '_blank'); 
                    } else {
                        alert('Please select at-least one Thomson Reuters search results item.')
                        return false
                    } 

                });

                $('#checkboxesAll').click(function(event) {   
                    if(this.checked) {
                        // Iterate each checkbox
                        $(':checkbox').each(function() {
                            this.checked = true;                        
                        });
                    } else {
                        $(':checkbox').each(function() {
                            this.checked = false;                       
                        });
                    }
                }); 
                

                function openTR(tor){
                    $(".loader").fadeIn("slow");
                    formData= new FormData();
                    formData.append("tr_id", tor);
                    
                    $.ajax({
                    url: "{{ route('searchThomsonReuters') }}",
                    type: "POST",
                    data: formData,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    processData: false,
                    contentType: false,
                
                    success: function(data){
                        $("#tr_result").html(data);
                        $(".loader").fadeOut("slow");
                    }
                    }); 
                }

                function delTR(tor){

                    swal({
                        title: "Are you sure?",
                        text: "You are about to delete a tie up of Thmosom Reuters data from a report request.",
                        icon: "warning",
                        buttons: [
                          'No, cancel it!',
                          'Yes, I am sure!'
                        ],
    
                        dangerMode: true,
                      }).then(function(isConfirm) {
    
                        if (isConfirm) {
                        swal({
                            title: 'Thomson Reuters data',
                            text:  'Done on removing data for report generation',
                            icon:  'success'
                        }).then(function() {
    
                                formData= new FormData();
                                formData.append("trId", tor);
                                
                                $.ajax({
                                url: "{{ route('trDeleting') }}",
                                type: "POST",
                                data: formData,
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                processData: false,
                                contentType: false,
                            
                                success: function(data){
                                    //$(".popup").hide(250);
                                    //var divTR = "trs_"+tor;
                                    //$(divTR).hide(250);
                                    document.getElementById("trs_"+tor).style.display = "none";
                                }

                                }); 
                            
                        });

                    } 

                  });

                }


                function assignTR(tor){


                    swal({
                        title: "Are you sure?",
                        text: "You are about to tie up the selected Thmosom Reuters to a report request.",
                        icon: "warning",
                        buttons: [
                          'No, cancel it!',
                          'Yes, I am sure!'
                        ],
    
                        dangerMode: true,
                      }).then(function(isConfirm) {
    
                        if (isConfirm) {
                        swal({
                            title: 'Thomson Reuters search data',
                            text:  'Done on setting data for report generation',
                            icon:  'success'
                        }).then(function() {

                                var items_selected = $("#selectedItems").val();
                                if(items_selected == ''){
                                    //alert("Please select Thomson Reuters search result item.");
                                    swal("Please select Thomson Reuters search results item.", "System notice you have not selected anytime seearch results item.")
                                    return false;
                                }

                                
                                formData= new FormData();
                                formData.append("reqId", tor);
                                formData.append("uId", items_selected);
                                
                                $.ajax({
                                url: "{{ route('trTagging') }}",
                                type: "POST",
                                data: formData,
                                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                                processData: false,
                                contentType: false,
                            
                                success: function(data){
                                    $(".popup").hide(250);
                                    document.location = "{{ route('thomsonSearch') }}"
                                }

                                }); 
                            
                        });

                    } 

                  });
                }


                  $(window).load(function() {
                    $(".loader").fadeOut("slow");
                  });

                  $("#thomson_search").submit(function(){
                    $(".loader").fadeIn("slow");
                  });

       
              $('#SearchCategory').change(function() {
               
                if(this.checked) {
                
                    $("#back").fadeOut("slow");
                    $("#front").fadeIn("slow");
                    
                }else {
                    $("#back").fadeIn("slow");
                    $("#front").fadeOut("slow");
                }
                
              });

           

    </script>

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/css/bootstrap-switch-button.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap-switch-button@1.1.0/dist/bootstrap-switch-button.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

@endsection







