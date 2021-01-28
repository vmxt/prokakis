@extends('layouts.app')

@section('content')
    <link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">
    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
            overflow: visible;
        }

        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 15px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 300px;
        }

        .containerCimg {

        }

        .actionCimg {
            width: 300px;
            height: 30px;
            margin: 5px 0;
            float: left;
        }

        .croppedCimg > img {
            margin-right: 10px;
        }
    </style>

    <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>

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
                <span>Password Update</span>
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


                                      <div class="card">

                                        <div class="card-header"><b>Password Update</b></div>
                                        <br />

                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                           <form method="POST" action="{{ route('getPasswordData') }}">
                                               {{ csrf_field() }}

                                            <div class="form-group">
                                                <label for="company_email">Current password</label>
                                                <input type="password" class="form-control" name="current_passw"
                                                       id="current_passw" onclick="clearMe1();" value="prokakispasswordchange12345qwrehksjdfykjsdfbsdkfjsdkfjhsdfhskdjhfkjsdfsdhjhgjhgjghjghj">
                                            </div>

                                            <div class="form-group">
                                                <label for="company_phone">New password</label>
                                                <input type="password" class="form-control" id="new_passw"
                                                       name="new_passw" onclick="clearMe2();" value="prokakispasswordchange123lfhsdhfsdiuyfsdbfsdkfsdgfsdpfusdfhksdhfkjsdhfjksdfhsdjkhf">
                                            </div>

                                            <div class="form-group">
                                                <label for="company_mobile">Re-enter new password</label>
                                                <input type="password" class="form-control" id="reenter_passw"
                                                       name="reenter_passw" onclick="clearMe3();" value="prokakispasswordchange1sdhfkjsdhfkjshdkfjhsdkfhsdkfhksdhfkjsdhfkjsdhfksdhfkjhk">
                                            </div>


                                            <div class="form-group">
                                                <input type="submit" class="btn btn-info" value="Submit">
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
        </div>

        <script src="{{ asset('public/js/app.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
        <script type="text/javascript" charset="utf8"
                src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#system_data').DataTable();
                $('#system_data2').DataTable();

            });

            function clearMe1(){
               document.getElementById('current_passw').value = "";
            }
            function clearMe2(){
                document.getElementById('new_passw').value = "";
             }
             function clearMe3(){
                document.getElementById('reenter_passw').value = "";
             }




        </script>

@endsection
