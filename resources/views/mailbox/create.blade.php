@extends('layouts.app')

@section('content')



    <script src="{{ asset('public/jq-autocomplete/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('public/jq-autocomplete/jquery.easy-autocomplete.min.js') }}"></script>
    <link href="{{ asset('public/jq-autocomplete/easy-autocomplete.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/jq-autocomplete/easy-autocomplete.themes.min.css') }}" rel="stylesheet"
          type="text/css"/>



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
            width: 40%;
            background-color: orangered;
        }

        .btn-x4 {
            font-size: 15px;
            border-radius: 5px;
            width: 10%;
            background-color: orangered;
        }
    </style>
    <script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: '#composeArea',
            branding: false,
            height: 400
        });
    </script>
    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Mailbox</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Compose Message
        </li>

    </ul>

    <div class="container" style="margin-top: 10px;">
        <div class="row justify-content-center">

            <div class="col-md-3">
                <div class="portlet light" style="overflow: hidden;">
                    <div class="card" style="width: 100%; margin-top: 15px;">
                        <b>Box Mail</b>
                        <hr>
                        <form id="company_social_form" method="POST" action="{{ route('mailCreateCompose') }}"
                              style="padding: 0px; width: 100%;">
                            {{ csrf_field() }}
                            <div class="col col-md-12">
                                <a class="btn btn-large blue" href="{{route('mailCreateCompose')}}"
                                   style="width: 100%;"> Compose</a>
                            </div>
                            <div class="col col-md-12" style="margin-top: 15px;">
                                <div class="list-group">
                                    <a href="{{ route('mailCompose') }}" class="list-group-item">
                                        <i class="icon-envelope-open"></i> Inbox
                                        <?php
                                        $user_id = Auth::id();
                                        $inboxCount = App\Mailbox::getNumberEmailWithNoti($user_id);
                                        if($inboxCount > 0){
                                        ?>
                                        <span class="badge badge-warning"> <?php echo $inboxCount; ?> </span>
                                        <?php }
                                        else?>  <span class="badge badge-warning"> 0</span>
                                    </a>
                                    <a href="{{ route('sentMail') }}" class="list-group-item">
                                        <i class="icon-paper-plane"></i> Sent </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="portlet light">
                    <div class="card">
                        <b>Compose New Message</b><hr>
                        <form id="company_social_form" method="POST" action="{{ route('mailStoreCompose') }}">
                            {{ csrf_field() }}
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

                            <div id="container">
                                <form action="#">
                                    {{ csrf_field() }}
                                    <div class="form-group form-md-line-input">
                                        <label for="receiver">Email address:</label>
                                        <input type="text" class="form-control" placeholder="" name="receiver_mail" id="receiver" style="padding: 0px;">
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" placeholder="" name="subject_mail" id="subject_mail" style="padding: 0px;">
                                        <label for="subject_mail">Subject:</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Content:</label>
                                        <textarea name="composeArea" id="composeArea"> </textarea>
                                    </div>


                                    <div class="row justify-content-center" style="margin-left: 5px;">
                                        <input type="submit" name="sendMessage" class="btn btn green fa fa-check" value="Send"> &nbsp;
                                        <a href="{{ route('mailCompose') }}" class="btn default">Cancel</a>
                                    </div>

                                </form>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
       var optionsEmails = {
            url: "{{route('getEmailList')}}",
            getValue: "email",
            list: {
                match: {
                    enabled: true
                }
            }
        };
        $("#receiver").easyAutocomplete(optionsEmails);

        //----- OPEN
        $('[data-popup-open]').on('click', function (e) {
            let targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);

            e.preventDefault();
        });

        //----- CLOSE
        $('[data-popup-close]').on('click', function (e) {
            let targeted_popup_class = jQuery(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);

            e.preventDefault();
        });
    </script>



    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>




    <script src="{{ asset('public/js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

@endsection