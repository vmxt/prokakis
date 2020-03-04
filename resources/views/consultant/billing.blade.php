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

        /* Outer */
        .popup {
            width: 100%;
            height: 100%;
            display: none;
            position: fixed;
            top: 0px;
            left: 0px;
            background: rgba(0, 0, 0, 0.75);
        }

        /* Inner */
        .popup-inner {
            max-width: 700px;
            width: 90%;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
            border-radius: 3px;
            background: #fff;
        }

        /* Close Button */
        .popup-close {
            width: 30px;
            height: 30px;
            padding-top: 4px;
            display: inline-block;
            position: absolute;
            top: 0px;
            right: 0px;
            transition: ease 0.25s all;
            -webkit-transform: translate(50%, -50%);
            transform: translate(50%, -50%);
            border-radius: 1000px;
            background: rgba(0, 0, 0, 0.8);
            font-family: Arial, Sans-Serif;
            font-size: 20px;
            text-align: center;
            line-height: 100%;
            color: #fff;
        }

        .popup-close:hover {
            -webkit-transform: translate(50%, -50%) rotate(180deg);
            transform: translate(50%, -50%) rotate(180deg);
            background: rgba(0, 0, 0, 1);
            text-decoration: none;
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
                <span>Consultant Billing</span>
            </li>
        </ul>
        <div class="row justify-content-center">

            <div class="page-content-inner">
                <div class="mt-content-body">
                    <div class="col-md-8">
                        <div class="portlet light ">
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

                            <form id="consultant_billing_form" method="POST" action="{{ route('createBillingSC') }}">
                                {{ csrf_field() }}
                                <div class="card">
                                    <input type="hidden" name="billingId" value="<?php if(isset($bill->id)){ echo $bill->id; }else{ echo '0'; } ?>">

                                    <div class="card-header"><b>CONSULTANT BILLING ACCOUNT INFORMATION</b></div>
                                    <br>
                                    <div class="card-body center">

                                        <div class="form-group">
                                            <label for="account_name">Name</label>
                                            <input type="text" class="form-control" name="account_name"
                                                   id="account_name" value="<?php if (isset($bill->account_name)) {
                                                echo $bill->account_name;
                                            } ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="account_email">Email Address</label>
                                            <input type="text" class="form-control" id="account_email" 
                                                   name="account_email" value="<?php if (isset($bill->account_email)) {
                                                echo $bill->account_email;
                                            } ?>">
                                        </div>

                                       <!-- <div class="form-group">
                                            <input id="changeButtonCompanyContacts" data-popup-open="popup-1"
                                                   type="button"
                                                   class="btn btn-danger" value="Change"/>
                                        </div> -->


                                    </div>
                                </div>
                                <hr>
                                <div class="card">

                                    <div class="card-header"><b>ENTER PAYMENT METHOD INFORMATION</b></div>
                                    <br>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="card-body center">

                                        <div class="form-group">
                                            <label for="card_holder_name">Card holder Name</label>
                                            <input type="text" class="form-control" name="card_holder_name"
                                                   id="card_holder_name"
                                                   value="<?php if (isset($bill->card_holder_name)) {
                                                       echo $bill->card_holder_name;
                                                   } ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="card_number">Card Number</label>
                                            <input type="text" class="form-control" id="card_number" name="card_number"
                                                   value="<?php if (isset($bill->card_number)) {
                                                       echo $bill->card_number;
                                                   } ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="security_code">Security Code(CVV)</label>
                                            <input type="text" class="form-control" id="security_code"
                                                   name="security_code"
                                                   value="<?php if (isset($bill->security_code)) {
                                                       echo $bill->security_code;
                                                   } ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="card_expiry_date">Card Expiry Date</label>
                                            <input type="text" class="form-control" id="card_expiry_date"
                                                   name="card_expiry_date"
                                                   value="<?php if (isset($bill->card_expiry_date)) {
                                                       echo $bill->card_expiry_date;
                                                   } ?>">
                                        </div>


                                        <div class="form-group">
                                            <input id="saveButtonCompanyContacts" 
                                                   type="submit"
                                                   class="btn btn-danger" value="Save"/>
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


    <div class="popup" data-popup="popup-1">
        <div class="popup-inner">

            <div class="form-group">

                <label for="account_name_x">Name</label>
                <input type="text" class="form-control" name="account_name_x" id="account_name_x"
                       value="<?php if (isset($bill->account_name)) {
                           echo $bill->account_name;
                       } ?>">
            </div>

            <div class="form-group">
                <label for="account_email_x">Email Address</label>
                <input type="text" class="form-control" id="account_email_x" name="account_email_x"
                       value="<?php if (isset($bill->account_email)) {
                           echo $bill->account_email;
                       } ?>">
            </div>

            <p>
                <button align="right" id="ajxUpdate" type="button" class="btn blue">Update</button>
            </p>

            <!--<p><a data-popup-close="popup-1" href="#">Close</a></p>-->
            <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
        </div>
    </div>


    <script src="{{ asset('public/jq1111/jquery.min.js') }}"></script>
    <script src="{{ asset('public/img-cropper/js/cropbox.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <script type="text/javascript">

        function processUpdate() {
            swal({
                title: "Are you sure you want to update company billing information?",
                text: "Updating",
                icon: "warning",
                buttons: [
                    'No, cancel it!',
                    'Yes, I am sure!'
                ],
                dangerMode: true,
            }).then(function (isConfirm) {
                if (isConfirm) {
                    swal({
                        title: 'Success',
                        text: 'Request change for billing information has been submitted.',
                        icon: 'success'
                    }).then(function () {

                        $("#company_billing_form").submit();

                    });
                } else {
                    swal("Cancelled", "", "error");
                    return false;
                }
            });

        };

        $("#ajxUpdate").click(function () {
            var name_x = $("#account_name_x").val();
            var email_x = $("#account_email_x").val();

            formData = new FormData();
            formData.append("account_name", name_x);
            formData.append("account_email", email_x);

            $.ajax({
                url: "{{ route('updateBillingSC') }}",
                type: "POST",
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                processData: false,
                contentType: false,

                success: function (data) {
                    $(".popup").hide(250);
                    document.location = "{{ route('billingSC') }}"
                }
            });

        });

        //----- OPEN
        $('[data-popup-open]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

            e.preventDefault();
        });

        //----- CLOSE
        $('[data-popup-close]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

            e.preventDefault();
        });

    </script>

@endsection







