@extends('layouts.app')

@section('content')
<link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">
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

.card{
            margin: 0 auto;
        }

@media (max-width: 360px){
    .card {
        margin-left: -20px;
    }
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
            <span>Deactivate Profile</span>
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
                                <div class="spinnerCimg">Loading...</div>
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
                
               <form id="deactivate_form" method="POST" action="{{ route('deactivateAccount') }}">
                {{ csrf_field() }}          
                <div class="card">
                    
                    <div class="card-header"><b>ACCOUNT DEACTIVATION</b></div>
                       <div class="card-body center">

                            <div class="alert alert-warning" role="alert"> Once you deactivate there is no turning back. </div>
                        
                        <div class="form-group">
                            <label for="account_name">Name</label>
                            <input type="text" class="form-control" readonly="true" name="account_name" id="account_name" value="<?php if(isset($bill->account_name)){ echo $bill->account_name; } ?>">
                         </div>
                        
                        <div class="form-group">
                            <label for="account_email">Email Address</label>
                            <input type="text" class="form-control" id="account_email" readonly="true" name="account_email" value="<?php if(isset($bill->account_email)){ echo $bill->account_email; } ?>">
                        </div>
                           
                        <div class="form-group"> <center>
                            <input onclick="return confirm('Are you sure to deactivate your account?')" type="submit" class="btn btn-danger" value="Deactivate my account" />
                                                </center>   
                        </div>
                        

                       </div>
                </div>
                <br />
               
                </form>
            </div>
        </div>

    </div>


<script src="{{ asset('public/jq1111/jquery.min.js') }}"></script>
<script src="{{ asset('public/img-cropper/js/cropbox.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

  
@endsection







