@extends('layouts.app')

@section('content')
<script src="{{ asset('public/jq-autocomplete/jquery-1.11.2.min.js') }}"></script>
<script src="{{ asset('public/jq-autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" type="text/css"/>
<link href="{{ asset('public/jq-autocomplete/easy-autocomplete.themes.min.css') }}" rel="stylesheet" type="text/css"/>

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
  
</style>

    <div class="container" style="width:1500px;">
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
                        <form id="thomson_search" method="POST" action="{{ route('thomsonSearchFound') }}">
                            {{ csrf_field() }}

                                <div class="form-group">
                                    <label> First Name </label>
                                    <input id="first_name" name="first_name"  class="form-control placeholder-no-fix form-body" type="text" placeholder="Write First Name" autofocus>
               
                                </div>
                                
                                <div class="form-group">
                                        <label> Last Name </label>
                                        <input id="last_name" name="last_name"  class="form-control placeholder-no-fix" type="text" placeholder="Write Last Name"  autofocus>
                                </div>
                                
                                <div class="form-group">
                                        <label> Gender </label>
                                        <select name="gender" multiple="" class="form-control" style="height:90px">
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                                <option value="E">Others - as a company, corp, group </option>
                                        </select>
                            
                                </div>

                                
                                <div class="form-group">
                                    <label> Country </label>
                                    <input style="text-transform:capitalize;" id="country_location" name="country_location" class="form-control" type="text" placeholder="Write Country Location">
                                </div>

                                

                                <div class="form-group">
                                    <label> Nationality </label>
                                    <input style="text-transform:capitalize;" id="nationality" name="nationality" class="form-control placeholder-no-fix" type="text" placeholder="Write Nationality" autofocus>
                                </div>

                                <div class="form-group">
                                    <label> Passport </label>
                                    <input id="passport" name="passport" class="form-control placeholder-no-fix" type="text" placeholder="Write Passport" autofocus>
                                </div>

                                <div class="form-group">
                                    <label> Further Information </label>
                                    <input id="company_name" name="company_name" class="form-control placeholder-no-fix" type="text" placeholder="Write Company Name" autofocus>
               
                                </div>

                                <div class="actions">
                                    <input type="submit" class="btn btn-primary" value="Search">
                                </div>
                           
                        </form>
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
                     
                            <div class="table-scrollable">

                                <table  class="table table-bordered table-striped table-condensed flip-content">
                                    <thead class="flip-content">
                                    <tr>
                                        <th width="2%"> 
                                            <div class="md-checkbox">
                                            <input type="checkbox" name="checkboxesAll" value="all" id="checkboxesAll" class="md-check" >
                                            <label for="checkboxesAll">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span>
                                            </label>
                                            </div> 
                                       </th>
                                        <th width="5%">Action</th>
                                        <th width="8%">First Name</th>
                                        <th width="8%">Last Name</th>
                                        <th width="5%">Aliases</th>
                                        <th width="5%">Category</th> 
                                        <th width="5%">Position</th> 
                                        <th width="8%">Place of birth</th> 
                                        <th width="8%">Country</th>
                                        <th width="8%">Locations</th>
                                        <th width="15%">Further Information</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php if(isset($rs) && $rs != null){
                                           foreach($rs as $d){
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
                                            <td><?php echo (isset($d->FIRST_NAME))? $d->FIRST_NAME : ''; ?></td>
                                            <td><?php echo (isset($d->LAST_NAME))? $d->LAST_NAME : ''; ?></td>
                                            <td width="5%"><?php echo (isset($d->ALIASES))? $d->ALIASES : ''; ?></td>
                                            <td width="5%"><?php echo (isset($d->CATEGORY))? $d->CATEGORY : ''; ?></td> 
                                            <td width="5%"><?php echo (isset($d->POSITION))? $d->POSITION : ''; ?></td> 
                                            <td width="5%"><?php echo (isset($d->PLACE_OF_BIRTH))? $d->PLACE_OF_BIRTH : ''; ?></td> 
                                            <td width="5%"><?php echo (isset($d->PASSPORT_COUNTRY))? $d->PASSPORT_COUNTRY : ''; ?></td>
                                            <td width="5%"><?php echo (isset($d->LOCATIONS))? $d->LOCATIONS : ''; ?></td>
                                            <td><?php echo (isset($d->FURTHER_INFORMATION))? $d->FURTHER_INFORMATION : ''; ?></td>
                                           
                                    </tr>
                                   
                                   <?php 
                                            }
                                    } 
                                    
                                    if(isset($rs2) && $rs2 != null){
                                        foreach($rs2 as $d){
                                 ?>    
                                 <tr>
                                    <td>
                                        <span class="card" style="float:left;">
                                            <div class="md-checkbox">

                                                <input type="checkbox" name="checkboxes1[]" value="<?php echo $d->UID; ?>" id="checkbox_<?php echo $d->UID; ?>"  class="md-check" >

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
                                         <td><?php echo (isset($d->FIRST_NAME))? $d->FIRST_NAME : ''; ?></td>
                                         <td><?php echo (isset($d->LAST_NAME))? $d->LAST_NAME : ''; ?></td>
                                         <td width="5%"><?php echo (isset($d->ALIASES))? $d->ALIASES : ''; ?></td>
                                         <td width="5%"><?php echo (isset($d->CATEGORY))? $d->CATEGORY : ''; ?></td> 
                                         <td width="5%"><?php echo (isset($d->POSITION))? $d->POSITION : ''; ?></td> 
                                         <td width="5%"><?php echo (isset($d->PLACE_OF_BIRTH))? $d->PLACE_OF_BIRTH : ''; ?></td> 
                                         <td width="5%"><?php echo (isset($d->PASSPORT_COUNTRY))? $d->PASSPORT_COUNTRY : ''; ?></td>
                                         <td width="5%"><?php echo (isset($d->LOCATIONS))? $d->LOCATIONS : ''; ?></td>
                                         <td><?php echo (isset($d->FURTHER_INFORMATION))? $d->FURTHER_INFORMATION : ''; ?></td>
                                        
                                 </tr>
                                
                                <?php 
                                        }
                                } 
                                
                                if(isset($rs3) && $rs3 != null){
                                    foreach($rs3 as $d){
                                ?>    
                                <tr>
                                    <td>
                                        <span class="card" style="float:left;">
                                            <div class="md-checkbox">

                                                <input type="checkbox" name="checkboxes1[]" value="<?php echo $d->UID; ?>" id="checkbox_<?php echo $d->UID; ?>"  class="md-check" >

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
                                     <td><?php echo (isset($d->FIRST_NAME))? $d->FIRST_NAME : ''; ?></td>
                                            <td><?php echo (isset($d->LAST_NAME))? $d->LAST_NAME : ''; ?></td>
                                            <td width="5%"><?php echo (isset($d->ALIASES))? $d->ALIASES : ''; ?></td>
                                            <td width="5%"><?php echo (isset($d->CATEGORY))? $d->CATEGORY : ''; ?></td> 
                                            <td width="5%"><?php echo (isset($d->POSITION))? $d->POSITION : ''; ?></td> 
                                            <td width="5%"><?php echo (isset($d->PLACE_OF_BIRTH))? $d->PLACE_OF_BIRTH : ''; ?></td> 
                                            <td width="5%"><?php echo (isset($d->PASSPORT_COUNTRY))? $d->PASSPORT_COUNTRY : ''; ?></td>
                                            <td width="5%"><?php echo (isset($d->LOCATIONS))? $d->LOCATIONS : ''; ?></td>
                                            <td><?php echo (isset($d->FURTHER_INFORMATION))? $d->FURTHER_INFORMATION : ''; ?></td>
                                    
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
                <div class="popup-inner" style="overflow: scroll; height:850px; width:900px;">
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

            var options = {
                url: "{{ route('getCountryLocation') }}",
                getValue: "LOCATIONS",
                list: {
                    maxNumberOfElements: 5,
                    match: {
                        enabled: true
                    },
                    sort: {
                        enabled: true
                    },
                    onClickEvent: function() {
                        console.log('click');

                    },
                    showAnimation: {
                        type: "fade", //normal|slide|fade
                        time: 400,
                        callback: function() {}
                    },
            
                    hideAnimation: {
                        type: "slide", //normal|slide|fade
                        time: 400,
                        callback: function() {}
                    }	

                }
            };
            $("#country_location").easyAutocomplete(options); 
            
            
            var optionsNationality = {
                url: "{{ route('getNationality') }}",
                getValue: "CITIZENSHIP",
                list: {
                    maxNumberOfElements: 5,
                    match: {
                        enabled: true
                    },
                    sort: {
                        enabled: true
                    },
                    onClickEvent: function() {
                        console.log('click');

                    },
                    showAnimation: {
                        type: "fade", //normal|slide|fade
                        time: 400,
                        callback: function() {}
                    },
            
                    hideAnimation: {
                        type: "slide", //normal|slide|fade
                        time: 400,
                        callback: function() {}
                    }	
                }
            };
            $("#nationality").easyAutocomplete(optionsNationality); 
            

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

      

    </script>

@endsection







