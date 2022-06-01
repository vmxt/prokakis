@extends('layouts.app')

@section('content')
<link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">

<style>
    html,body
    {
        width: 100%;
        height: 100%;
        margin: 0px;
        padding: 0px;
        overflow-x: hidden;
        overflow: visible;
    }
    
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

        .card{
            margin: 0 auto;
        }

@media (max-width: 360px){
    .card {
        margin-left: -40px;
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
            <span>Contacts</span>
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


                                <form id="company_contact_form" method="POST" action="{{ route('createContacts') }}">
                                    {{ csrf_field() }}
                                    <div class="card">

                                        <div class="card-header"><b>COMPANY CONTACT INFORMATION</b></div>
                                        <br>

                                        <div class="card-body center">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <div class="form-group">
                                                <label for="company_email">Company Email Address</label>
                                                <input type="text" class="form-control" name="company_email"
                                                       id="company_email"
                                                       value="<?php if (isset($company_data->email_address)) {
                                                           echo $company_data->email_address;
                                                       } ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="company_phone">Company Office Phone Number</label>
                                                <input type="text" class="form-control" id="company_phone"
                                                       name="company_phone"
                                                       value="<?php if (isset($company_data->office_number)) {
                                                           echo $company_data->office_number;
                                                       } ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="company_mobile">Company Office Mobile Number</label>
                                                <input type="text" class="form-control" id="company_mobile"
                                                       name="company_mobile"
                                                       value="<?php if (isset($company_data->mobile_number)) {
                                                           echo $company_data->mobile_number;
                                                       } ?>">
                                            </div>

                                            <div class="form-group">
                                                <button id="saveButtonCompanyContacts" onclick="return processUpdate();"
                                                       type="button" class="btn btn-primary" ><i class="fa fa-save"></i> SAVE</button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('public/jq1111/jquery.min.js') }}"></script>

<script src="{{ asset('public/img-cropper/js/cropbox.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

<script type="text/javascript">
  
   function processUpdate(){
      swal({
      title: "Are you sure you want to update company contact information? ",
      text: "Updating Company Contact Information",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
        swal({
          title: 'Success',
          text: 'Request change for contact information has been submitted.',
          icon: 'success'
        }).then(function() {
      
            $("#company_contact_form").submit();
              
        });
      } else {
        swal("Cancelled", "", "error");
        return false;  
      }
    }); 
      
  };
  
</script>

@endsection







