@extends('layouts.app')



@section('content')

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>



        .btn-x3 {

            font-size: 15px;

            border-radius: 5px;

            width: 100%;

            background-color: orangered;

        }



        #edit_icon {

            cursor: pointer;

        }

    </style>
      <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
      
    <div class="row justify-content-center">

        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <a href="#">Company Search</a>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                Request to own company
            </li>

        </ul>



        <div class="card">

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

        </div>



        <div class="portlet light portlet-fit portlet-datatable">

            <div class="portlet-title">

                <div class="caption">

                    <i class="icon-settings "></i>

                    <span class="caption-subject sbold uppercase">Request to own the company: <strong> {{ $provCompanyName }} </strong></span>

                </div>

                <div class="actions">

                </div>

            </div>
         

            <div class="portlet-body">
            
            <form method="POST" action="{{ route('getDocumentRequest') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            
                    <div class="form-group">
                            <label for="fullName">Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" value="{{ $fullName }}">          
                    </div>
                    
                    <div class="form-group">
                        <label for="contactNumber">Contact Number</label>
                        <input type="text" class="form-control" id="contactNumber" name="contactNumber" value="{{ $contactNumber }}">          
                    </div>

                    <div class="form-group">
                        <label for="emailAdd">Email</label>
                        <input type="text" class="form-control" id="emailAdd" name="emailAdd" value="{{ $emailAdd }}">          
                    </div>
                
                    <br />

                    <div class="alert bg-dark text-white" style="width: 100%; overflow: hidden; margin-left: 0px !important;">
                        <p> 
                            <input type="checkbox" id="agreement" name="agreement"> 
                            &nbsp;&nbsp; I hereby declare ownership of the following company <strong class="text-company">{{ $provCompanyName }}</strong> and wish to transfer all data and information of the company to my account.
                            I declare that the information provided for the ownership of the account is accurate and correct to the best of my knowledge. 
                            By submitting the information below, I agree to abide by the terms & conditions of ProKakis privacy policy and; 
                            I consent to allow the ProKakis to contact me and request for any additional information required for verification. <br />
                        </p>
                    </div>

                    <div class="table-container">   
                            <input type="hidden" name="reqType" id="reqType" value="{{ $reqType }}">
                            <input type="hidden" name="subject_company_id" id="subject_company_id" value="{{ $provId }}">
    
                            <div class="form-group">
                            <label for="businessProfile">Upload Business Profile</label>
                            <input type="file" name="businessProfile">          
                            </div>

                            <div class="form-group">
                            <label for="passportProfile">Upload Passport</label>
                            <input type="file" name="passportProfile">          
                            </div>

                            <div class="form-group">
                            <center> <input type="submit" class="btn btn-primary" value="Submit Request"></center>
                            </div>
                    </div>
                    
            </form> 
            </div>
       
        </div>

    </div>











    {{-- <script src="{{ asset('public/js/app.js') }}"></script> --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}"> --}}

    {{-- <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script> --}}

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>




    <script>

        $(document).ready(function () {

            $('#system_data').DataTable({
            responsive: true,
            columnDefs: [ 
                { targets:"_all", orderable: false },
                { targets:[0,1,2,3,4,5,6,7], className: "desktop" },
                { targets:[0], className: "tablet, mobile" }
            ]
            });
        });





    </script>



@endsection