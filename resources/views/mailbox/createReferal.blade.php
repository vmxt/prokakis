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
             
                      
                        <div class="panel">
                            <div class="panel-heading">
                                <span class="caption-subject font-blue-steel bold uppercase"> <i class="fa fa-tv"></i> recent activities</span>
                            </div>
                            <div class="panel-body">
                                <?php
                                $log = App\AuditLog::where('user_id', Auth::id())->where('model','mailbox-referal')->orderBy('id', 'desc')->take(100)->get();
                                if (count((array)$log) > 0) {
                                foreach ($log as $l) {
                                $date = date("F j, Y, g:i a", strtotime($l->updated_at));
                                $s = explode(":", $l->details);
                                $activity = $l->action . ' to: ' .$s[1];
                                ?>
                                <ul class="feeds list-group" style="border-style:none; margin-bottom: 5px;">
                                    <li class="list-group-item">
                                        <a href="javascript:;">
                                            <div class="col1">
                                                <div class="cont">
                                                    <div class="cont-col1">
                                                        <div class="label label-sm label-info">
                                                            <i class="fa fa-bell-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="cont-col2">
                                                        <div class="desc"> <?php echo $activity?></div>
                                                        <div class="date"> <span style="font-size: 9px"><?php  echo $date; ?></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </a>
                                    </li>
        
                                </ul>
                                <?php }
                                }?>
                            </div>
        
        
                        </div>
                   
              
            </div>

            <div class="col-md-8">
                <div class="portlet light">
                    <div class="card">
                        <b>Compose New Message</b><hr>
                        <form id="company_social_form" method="POST" action="{{ route('sendReferals') }}">
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
                                        <input type="text" class="form-control" placeholder="" value="Intellinz, share to a friend" name="subject_mail" id="subject_mail" style="padding: 0px;">
                                        <label for="subject_mail">Subject:</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Content:</label>
                                        <textarea name="composeArea" id="composeArea"><?php echo $message; ?></textarea>
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