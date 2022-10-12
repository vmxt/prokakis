@extends('layouts.app')

<style>

    html, body {

        width: 100%;

        height: 100%;

        margin: 0px;

        padding: 0px;

        overflow-x: hidden;

        overflow: visible;

    }

    .progress-bar{
        background-color:#7cda24 !important;
    }

</style>



@section('content')

    <link href="{{ asset('public/mini-upload/assets/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('public/img-cropper/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/css/profileedit.css')}}">

    <link rel="stylesheet" href="{{ asset('public/js-tabs/jquery-ui.css') }}" rel="stylesheet">


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

                <span>View Profile</span>

            </li>

        </ul>

        <div class="row ">

            <!-- START IMAGE UPLOAD -->

            <div class="col-md-4">

                <div class="card">



                                        <div class="card-header">



                                                <div class="containerCimg">

                                                    <div id="croppedCimg" class="croppedCimg" align="center"> </div>



                                                    <div class="imageBoxCimg">

                                                        <div class="thumbBoxCimg"></div>

                                                        <div class="spinnerCimg" style="display: none">Loading...</div>

                                                    </div>





                                                </div>



                                                <div style="margin-bottom:10px;"></div>



                                            </div>

                                            <div class="card-body">

                                                Profile Completeness

                                                <div class="progress">



                                                    <div class="progress-bar" role="progressbar" style="width: <?php echo $completenessProfile; ?>%;" aria-valuenow="<?php echo $completenessProfile; ?>" aria-valuemin="0"

                                                         aria-valuemax="100"><?php echo $completenessProfile; ?>%</div>

                                                </div>



                                            </div>



                </div>





            </div>

            <!-- END IMAGE UPLOAD -->



            <!-- START METRONIC TAB -->

            <div class=" col-md-8">

                <div class="portlet light ">

                    <div class="portlet-title tabbable-line">

                        <div class="caption">

                            <i class="icon-share font-dark"></i>

                            <span class="caption-subject font-dark bold uppercase">View Master Consultant Profile</span>

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

                <!-- START FORM TAG-->





                        <div class="portlet-body">

                            <input type="hidden" name="consultantID" value="<?php if( isset($company_data->consultant_id) ){ echo $company_data->consultant_id; }else{ echo '0'; } ?>">



                            <div class="tab-content">

                                <div class="tab-pane active" id="portlet_tab1">

                                    <!-- START OVERVIEW TAB -->

                                    <div id="tabs-1">

                                        <div class="card-header"><b>Overview</b></div>

                                        <div class="card-body center">

                                            <div class="alert bg-intellinz-light-green text-company" role="alert">



                                                <b>PRO TIP: Companies with filled in general company information have a

                                                greater chance to matched with relevant business for their business

                                                objectives</b>.

                                            </div>



                                            <div class="form-group">

                                                <label for="company_name">Name</label>

                                                <input type="text" class="form-control" id="name"

                                                       name="name"

                                                       value="<?php if (isset($company_data->name)) {

                                                           echo $company_data->name;

                                                       } ?>" readonly>



                                            </div>



                                            <div class="form-group">

                                                <label for="identity_passport_number">Identity Number/Passport Number</label>

                                                <input type="text" class="form-control" name="identity_passport_number"

                                                       id="identity_passport_number"

                                                       value="<?php if (isset($company_data->identity_passport_number)) {

                                                           echo $company_data->identity_passport_number;

                                                       } ?>" readonly>

                                            </div>



                                            <div class="form-group">

                                                <label for="dob">Date of Birth </label>

                                                <input type="text" class="form-control" id="dob"

                                                       name="dob"

                                                       value="<?php if (isset($company_data->dob)) {

                                                           echo $company_data->dob;

                                                       } ?>" readonly>

                                            </div>



                                            <div class="form-group">

                                                    <label for="email_address">Email Address </label>

                                                    <input type="text" class="form-control" id="email_address"

                                                           name="email_address"

                                                           value="<?php if (isset($company_data->email_address)) {

                                                               echo $company_data->email_address;

                                                           } ?>" readonly>

                                            </div>



                                            <div class="form-group">

                                                    <label for="phone_number">Phone Number </label>

                                                    <input type="text" class="form-control" id="phone_number"

                                                           name="phone_number"

                                                           value="<?php if (isset($company_data->phone_number)) {

                                                               echo $company_data->phone_number;

                                                           } ?>" readonly>

                                            </div>



                                            <div class="form-group">

                                                    <label for="phone_type">Phone Type </label><br />

                                                    <?php

                                                    $phone_type_selected_office = '';

                                                    $phone_type_selected_mobile = '';



                                                    if(isset($company_data->phone_type) && $company_data->phone_type == 'office_line') {

                                                        $phone_type_selected_office = 'checked';

                                                        $phone_type_selected_mobile = '';

                                                    } else {

                                                        $phone_type_selected_office = '';

                                                        $phone_type_selected_mobile = 'checked';

                                                    }

                                                    ?>

                                                    <input type="radio" readonly <?php echo $phone_type_selected_office ?> name="phone_type" value="office_line"> Office Line <br>

                                                    <input type="radio" readonly <?php echo $phone_type_selected_mobile ?> name="phone_type" value="mobile_line"> Mobile Line <br>

                                            </div>





                                            <div class="form-group">

                                                <label for="company_website">Bank </label><br />

                                                <select class="form-control" name="bank_id" id="bank_id">

                                                    <option value="" id=""></option>

                                                    <?php foreach($bank_list as $key => $value)

                                                    {

                                                    if (isset($company_data->bank_id) && $key == $company_data->bank_id) {

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

                                                    <?php

                                                    $bank_type_savings = '';

                                                    $bank_type_current = '';



                                                    if(isset($company_data->bank_type) && $company_data->bank_type == 'savings') {

                                                        $bank_type_savings = 'checked';

                                                        $bank_type_current = '';

                                                    } else {

                                                        $bank_type_savings = '';

                                                        $bank_type_current = 'checked';

                                                    }

                                                    ?>



                                                <input type="radio" <?php echo $bank_type_savings; ?> name="bank_type" value="savings"> Savings<br>

                                                <input type="radio" <?php echo $bank_type_current; ?> name="bank_type" value="current"> Current<br>

                                            </div>



                                            <div class="form-group">

                                                <label for="account_number">Account Number </label>

                                                <input type="text" class="form-control" id="account_number" name="account_number"

                                                       value="<?php if (isset($company_data->account_number)) {

                                                           echo $company_data->account_number;

                                                       } ?>" readonly>

                                            </div>



                                            <div class="form-group">

                                                <label for="payment_method">Payment Method </label><br />

                                                <select name="payment_method" id="payment_method">

                                                        <?php foreach($payment_method as $key => $value)

                                                        {

                                                        if (isset($company_data->payment_method) && $key == $company_data->payment_method) {

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

                     </form>

                                            <div class="form-group">

                                                    <label for="awards"><b>Certifications</b></label> <br/>



                                                    <div id="upload3">





                                                            <?php



                                                            if(count((array)$profileCertifications) > 0) { ?>

                                                            <p>Saved Certificates</p>

                                                            <ol>

                                                                <?php



                                                                foreach($profileCertifications as $aw) {  ?>

                                                                <li style="padding:5px;"

                                                                    id="certificatesSaved<?php echo $aw[0]; ?>">

                                                                    <span><b><?php echo $aw[2]; ?></b></span>

                                                                    <span style="float:right"><?php echo $aw[3]; ?> - <a

                                                                                target="_blank"

                                                                                href="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>">Download</a> - <a

                                                                                href="#"

                                                                                onclick="processRemoveFile('<?php echo $aw[0]; ?>', 'certificatesSaved', '<?php echo $aw[2]; ?>');">Delete</a></span>

                                                                </li>

                                                                <?php } ?>

                                                            </ol>

                                                            <?php } ?>





                                                    </div>

                                                </div>







                                        </div>



                                    </div>



                        </div>

                        <!-- SAVE AND CANCEL BUTTON-->

                                    <!-- END FORM TAG-->

                </div>

            </div>

            <!--END METRONIC TAB -->





            <!-- END IMAGE UPLOAD -->





        </div>



    </div>





    </div>



    </div>

    </div>





    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->



    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->

    <script src="{{ asset('public/js-tabs/jquery-1.12.4.js') }}"></script>

    <script src="{{ asset('public/js-tabs/jquery-ui.js') }}"></script>



    <!-- JavaScript Includes -->

    <script src="{{ asset('public/mini-upload/assets/js/jquery.knob.js') }}"></script>



    <!-- jQuery File Upload Dependencies -->

    <script src="{{ asset('public/mini-upload/assets/js/jquery.ui.widget.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/jquery.iframe-transport.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/jquery.fileupload.js') }}"></script>





    <!-- Our main JS file -->

    <script src="{{ asset('public/mini-upload/assets/js/script.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script1.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script2.js') }}"></script>

    <script src="{{ asset('public/mini-upload/assets/js/script3.js') }}"></script>

    <script src="{{ asset('public/img-cropper/js/cropbox.js') }}"></script>



    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>



    <script type="text/javascript">

        window.onload = function () {

            var options =

                {

                    imageBox: '.imageBoxCimg',

                    thumbBox: '.thumbBoxCimg',

                    spinner: '.spinnerCimg',

                    <?php if($profileAvatar != null){  ?>

                    imgSrc: "{{ asset('public/images/') }}/<?php echo $profileAvatar; ?>"

                    <?php } else { ?>

                    imgSrc: "{{ asset('public/images/robot.jpg') }}"

                    <?php } ?>



                }

            var cropper = new cropbox(options);

            document.querySelector('#file').addEventListener('change', function () {

                var reader = new FileReader();

                reader.onload = function (e) {

                    options.imgSrc = e.target.result;

                    cropper = new cropbox(options);

                }

                reader.readAsDataURL(this.files[0]);

                this.files = [];

            })

            document.querySelector('#btnCrop').addEventListener('click', function () {

                var img = cropper.getDataURL();

                document.querySelector('.croppedCimg').innerHTML += '<img src="' + img + '">';



                var croppng = cropper.getBlob();



                uploadFile(croppng);



            })

            document.querySelector('#btnZoomIn').addEventListener('click', function () {

                cropper.zoomIn();

            })

            document.querySelector('#btnZoomOut').addEventListener('click', function () {

                cropper.zoomOut();

            });



            $(".popup").hide();



        };



        function uploadFile(cropf) {

            file = cropf;

            if (file != undefined) {

                formData = new FormData();

                formData.append("cropimage", file);



                $.ajax({

                    url: "{{ route('uploadProfileImg') }}",

                    type: "POST",

                    data: formData,

                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                    processData: false,

                    contentType: false,



                    success: function (data) {

                        //alert('success updating profile image.');

                        swal("Good job!", "Success updating profile image!", "success");



                        var elements = document.getElementsByClassName('imageBoxCimg');

                        while (elements.length > 0) {

                            elements[0].parentNode.removeChild(elements[0]);

                        }



                        var elements = document.getElementsByClassName('actionCimg');

                        while (elements.length > 0) {

                            elements[0].parentNode.removeChild(elements[0]);

                        }

                    }



                });



            } else {

                alert('Input something!');

            }

        }



        $('#saveButtonCompanyProfile').click(function () {

            $('#company_profile_form').submit();

        });



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

                        //form.submit(); // <--- submit form programmatically



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



        $(function () {

            $("#dob").datepicker();

        });



    </script>



@endsection

