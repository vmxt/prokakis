@extends('layouts.app')

@section('content')

    <style>
        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 10px;
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
    <br/>

    <script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script>

    <script>
        tinymce.init({
            selector: '#composeArea',
            branding: false,
            height: 100
        });
    </script>

    <div class="container">


        <div class="row justify-content-center">

            <div class="col-md-3">
                <div class="portlet light" style="overflow: hidden;">
                    <div class="card" style="width: 100%; margin-top: 15px;">
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
                                        else?> <span class="badge badge-warning"> 0</span>
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
                <div class="portlet light ">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart font-dark hide"></i>
                            <span class="caption-subject font-green-steel uppercase bold">From: </span>
                            <span class="caption-helper">
                            <?php $s = App\User::find($res->sender_id);
                                echo '<b>' . $s->firstname . '</b>';
                                ?> &nbsp;
                            <span class="caption-subject font-green-steel uppercase bold">To: </span>
                            <span class="caption-helper">
                           <?php $r = App\User::find($res->receiver_id);
                                echo $r->firstname;
                                ?> </span>
                        </div>
                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <?php echo date("F j, Y g:i A", strtotime($res->created_at)); ?>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $res->message; ?>
                        <hr>
                        <?php if(count((array)$replies) - 1 > 0)
                        {
                        $i = 0;
                        foreach($replies as $rep){
                        ?>



                        <div class="mt-comments">
                            <div class="mt-comment">
                                <div class="mt-comment-body">
                                    <div class="mt-comment-info">
                                        <span class="mt-comment-author">

                                        </span>
                                        <span class="mt-comment-date"> <span class="caption-subject font-green-steel uppercase bold m-grid-col-right">From: </span>
                                                <?php
                                            $align = "";

                                            if ($rep->replyer_id != $user_id) {
                                                $s = App\User::find($rep->replyer_id);
                                                echo '<b>' . $s->firstname . '</b>';
                                                $align = "left";
                                            } else {
                                                echo '<b> You </b>';
                                                $align = "right";
                                            }
                                            ?>&nbsp;&nbsp;&nbsp;<?php echo date("F j, Y g:i A", strtotime($rep->created_at)); ?></span>
                                    </div>
                                    <div class="mt-comment-text" style="text-align: justify; color: black">
                                         <span style="text-align: right"><?php echo $rep->message; ?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php
                        $i++;
                        if ($i % 1 == 0) {
                            echo '<hr>';
                        }
                        }
                        }
                        ?>

                    </div>
                </div>

                <div class="portlet light">
                    <form id="company_social_form" method="POST" action="{{ route('mailStoreReply') }}">
                        {{ csrf_field() }}

                        <div id="container">
                            <input type="hidden" name="mail_id" value="<?php echo $mailId; ?>">
                            <div class="form-group">
                                <textarea name="composeArea" id="composeArea"> </textarea>
                            </div>
                            <hr>
                            <div class="row" style="margin-left: 10px;">
                                <input type="submit" name="sendMessage" class="btn btn-primary" value="Reply">
                                <a href="{{ route('mailCompose') }}" class="btn default">Cancel</a>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('public/js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

@endsection
