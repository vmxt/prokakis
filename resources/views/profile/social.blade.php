@extends('layouts.app')

@section('content')

<link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">

  <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
       <!-- <link href="{{ asset('public/bootstrap-social/assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> -->
       <!-- <link href="{{ asset('public/bootstrap-social/assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">-->
       <!-- <link href="{{ asset('public/bootstrap-social/assets/css/style.css') }}" rel="stylesheet"> -->
        

<style>
    
        .niceDisplay{
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 15px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width:300px;
        }  
        .containerCimg
        {
      
        }
        .actionCimg
        {
            width: 300px;
            height: 30px;
            margin: 5px 0;
            float: left;
        }
        .croppedCimg>img
        {
            margin-right: 10px;
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
}

/* Inner */
.popup-inner {
	max-width:700px;
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
}

/* Close Button */
.popup-close {
	width:30px;
	height:30px;
	padding-top:4px;
	display:inline-block;
	position:absolute;
	top:0px;
	right:0px;
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
            <span>Social Media Accounts</span>
        </li>
    </ul>
  
    <div class="row justify-content-center">

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                   
                       <div class="containerCimg">
                            <div id="croppedCimg" class="croppedCimg" align="center">
                            </div>
                           
                            <div class="imageBoxCimg">
                                <div class="thumbBoxCimg"><img src="{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>"></div>
                             
                            </div>
                          <div class="niceDisplay">
                            <?php if(isset($brand_slogan[0])){ echo $brand_slogan[0]; } ?>
                          </div>
                        </div>

                    <div> <br /> </div>
                    
                </div>

            </div>
        </div>
        <div class="col-md-8">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption font-green">
                        <span class="caption-subject bold uppercase">COMPANY INFORMATION</span>
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
                
               <form id="company_social_form" method="POST" action="{{ route('createSocialAccounts') }}">
                     {{ csrf_field() }}          
                <div class="card">
                    

                       <div class="card-body center">
                           <div class="form-group form-md-line-input form-md-floating-label has-info">
                               <label for="language_spoken">Language Spoken in Company</label>
                               <select class="form-control edited" id="language_spoken" multiple="true">
                                   <?php

                                   $arr_LS =  explode(",", $rs->language_spoken);

                                   foreach($language_spoken as $key => $value)
                                   {
                                   if( isset($arr_LS) && in_array($key, $arr_LS) ){ $selected = 'selected'; } else { $selected = ''; }
                                   ?>
                                   <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                   <?php
                                   }  ?>
                               </select>

                           </div>

                           <div class="form-group form-md-line-input form-md-floating-label">
                               <input type="text" class="form-control" id="company_homepage" value="<?php if(isset($rs->company_homepage)){ echo $rs->company_homepage; } ?>">
                               <label for="company_homepage">Company Homepage</label>
                               <span class="help-block">Some help goes here...</span>
                           </div>


                           <div class="form-group form-md-line-input form-md-floating-label">
                               <label for="account_email">Custom Profile Link on Intellinz</label>
                               <input type="text" class="form-control" id="profile_link" name="profile_link" value="{{ url('/company/') }}/<?php if(isset($brand_slogan[0])){ echo $brand_slogan[0]; } ?> ">
                               <span class="help-block">Some help goes here...</span>
                           </div>

                           <div class="form-group form-md-line-input form-md-floating-label">
                               <label for="faccount_email">Social Accounts</label>
                               <div class="input-icon">
                                   <input type="text" class="form-control" id="linkedin" placeholder="Linkedin" name="linkedin" value="<?php if(isset($rs->linkedin)){ echo $rs->linkedin; } ?>">
                                   <span class="help-block">enter linkedin account</span>
                                   <i class="fa fa-twitter"></i>
                               </div>
                               <div class="input-icon">
                                   <input type="text" class="form-control" id=facebook placeholder="facebook" name="facebook" value="<?php if(isset($rs->facebook)){ echo $rs->facebook; } ?>">
                                   <span class="help-block">enter facebook account</span>
                                   <i class="fa fa-twitter"></i>
                               </div>
                               <div class="input-icon">
                                   <input type="text" class="form-control" id="linkedin" placeholder=twitter name="twitter" value="<?php if(isset($rs->twitter)){ echo $rs->twitter; } ?>">
                                   <span class="help-block">enter twitter account</span>
                                   <i class="fa fa-twitter"></i>
                               </div>
                               <div class="input-icon">
                                   <input type="text" class="form-control" id="google" placeholder="google" name="google" value="<?php if(isset($rs->google)){ echo $rs->google; } ?>">
                                   <span class="help-block">enter google account</span>
                                   <i class="fa fa-twitter"></i>
                               </div>

                                   <div class="input-icon">
                                       <input type="text" class="form-control" id="otherLink" placeholder="other link" name="otherLink" value="<?php if(isset($rs->otherLink)){ echo $rs->otherLink; } ?>">
                                       <span class="help-block">enter other link</span>
                                       <i class="fa fa-twitter"></i>
                                   </div>

                               <div class="form-actions noborder" style="margin-top: 15px;">
                                   <button id="btnSave" type="button" class="btn blue">Submit</button>
                                   <button id="btncancel" type="button" class="btn default">Cancel</button>
                               </div>
                           </div>
                        

                       </div>
                </div>
               
                </form>

        </div>
    </div>


<script src="{{ asset('public/jq1111/jquery.min.js') }}"></script>
<script src="{{ asset('public/img-cropper/js/cropbox.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

<script type="text/javascript">
  $("#btnSave").click(function(){
     $("#company_social_form").submit(); 
  });
</script>

@endsection







