@extends('layouts.app')

@section('content')
    <link href="{{asset('public/assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}"
          rel="stylesheet" type="text/css"/>

    <style>
        html, body {
            width: 100%;
            height: 100%;
            margin: 0px;
            padding: 0px;
            overflow-x: hidden;
        }

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

        #edit_icon {
            cursor: pointer;
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

    <ul class="page-breadcrumb breadcrumb">
        <li>
            <a href="{{ url('/home') }}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Messages
        </li>

    </ul>
    <div class="container" style="margin-top: 10px;">

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


            <div class="col col-md-9">
                <div class="portlet light ">
                    <div class="caption font-dark">
                        <i class="note-icon-menu-check font-dark"></i>
                        <span class="caption-subject bold uppercase"> Inbox Messages</span>
                    </div>
                    <hr>
                    <div class="portlet-body">
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
                        <div id="sample_1_2_wrapper" class="dataTables_wrapper">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="dataTables_length" id="sample_1_2_length"><label>Show <select
                                                    name="sample_1_2_length" aria-controls="sample_1_2"
                                                    class="form-control input-sm input-xsmall input-inline">
                                                <option value="5">5</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                                <option value="-1">All</option>
                                            </select></label></div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div id="sample_1_2_filter" class="dataTables_filter"><label>Search:<input
                                                    type="search" class="form-control input-sm input-small input-inline"
                                                    placeholder="" aria-controls="sample_1_2"></label></div>
                                </div>
                            </div>
                            <div class="table-scrollable">
                                <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable"
                                       id="sample_1_2" role="grid" aria-describedby="sample_1_2_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="sample_1_2" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label=" Username : activate to sort column descending"
                                            style="width: 161px;"> Subject
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1_2" rowspan="1"
                                            colspan="1" aria-label=" Email : activate to sort column ascending"
                                            style="width: 243px;"> Sender
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1_2" rowspan="1"
                                            colspan="1" aria-label=" Email : activate to sort column ascending"
                                            style="width: 243px;"> Remarks
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1_2" rowspan="1"
                                            colspan="1" aria-label=" Joined : activate to sort column ascending"
                                            style="width: 123px;">Date
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1_2" rowspan="1"
                                            colspan="1" aria-label=" Actions : activate to sort column ascending"
                                            style="width: 126px;"> Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($consMap as $data){ ?>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <a href=""> <?php
                                                if ($data->is_open == NULL and $data->is_type <> 'chat') {
                                                    echo '<b>' . $data->subject . '</b>';
                                                } else {
                                                    echo $data->subject;
                                                }
                                                ?>
                                            </a>
                                        </td>
                                        <td>
                                            @if($data->is_type == 'chat')
                                                {{ App\CompanyProfile::find($data->sender_id)->company_email }}
                                            @else
                                                <a href=""> <?php
                                                    $res = App\User::find($data->sender_id);
                                                    echo $res->email;
                                                    ?> 
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <?php echo $data->remarks; ?>
                                        </td>

                                        <td>
                                            <?php echo $data->created_at; ?>
                                        </td>

                                        <td>
                                            @if($data->is_type == 'chat')
                                                <a href="{{ url('/opportunity/chatbox') }}" class="btn btn-success">View</a>
                                            @else
                                                <a href="{{ url('/mailbox/setReply/'.$data->id) }}" class="btn btn-success">View</a>
                                            @endif
                                        </td>

                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-5 col-sm-5">
                                    <div class="dataTables_info" id="sample_1_2_info" role="status" aria-live="polite">
                                        Showing 1 to 5 of 25 records
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    <div class="dataTables_paginate paging_bootstrap_full_number"
                                         id="sample_1_2_paginate">
                                        <ul class="pagination" style="visibility: visible;">
                                            <li class="prev disabled"><a href="#" title="First"><i
                                                            class="fa fa-angle-double-left"></i></a></li>
                                            <li class="prev disabled"><a href="#" title="Prev"><i
                                                            class="fa fa-angle-left"></i></a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li><a href="#">4</a></li>
                                            <li><a href="#">5</a></li>
                                            <li class="next"><a href="#" title="Next"><i class="fa fa-angle-right"></i></a>
                                            </li>
                                            <li class="next"><a href="#" title="Last"><i
                                                            class="fa fa-angle-double-right"></i></a></li>
                                        </ul>
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
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{asset('public/assets/pages/scripts/table-datatables-managed.min.js')}}"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{asset('public/assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/datatables/datatables.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
            type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $('#clickmewow').click(function () {
                $('#radio1003').attr('checked', 'checked');
            });
        })

    </script>
    <!-- Google Code for Universal Analytics -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-37564768-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- End -->

    <!-- Google Tag Manager -->
    <noscript>
        <iframe src="//www.googletagmanager.com/ns.html?id=GTM-W276BJ"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                '//www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-W276BJ');</script>
    <!-- End -->

    <!-- END PAGE LEVEL PLUGINS -->
@endsection