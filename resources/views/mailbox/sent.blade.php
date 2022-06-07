@extends('layouts.app')

@section('content')

    <style>


        .niceDisplay{
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

        #edit_icon{
            cursor: pointer;
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
        
          .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}

.active{
    background: #dff7d9 !important;
    color:black !important;
    border: 1px solid #ddd !important;
}

.active .badge{ 
    color:white !important;
}

    </style>
    
     <link rel='stylesheet prefetch' href='https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css' />

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">

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
            Sent Messages
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
                                    <a href="{{ route('mailCompose') }}" class="list-group-item ">
                                        <i class="fa fa-inbox"></i> <b>INBOX</b>
                                        <?php
                                        $user_id = Auth::id();
                                        $inboxCount = App\Mailbox::getNumberEmailWithNoti($user_id);
                                        if($inboxCount > 0){
                                        ?>
                                        <span class="badge badge-danger"> <?php echo $inboxCount; ?> </span>
                                        <?php }
                                        else  { ?>  <span class="badge badge-danger"> 0</span> <?php } ?>
                                    </a>
                                    <a href="{{ route('sentMail') }}" class="list-group-item active">
                                        <i class="fa fa-paper-plane"></i> <b>SENT</b> </a>
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
                        <div class="alert bg-dark text-white ">
                            <span class="caption-subject bold uppercase"><i class="fa fa-paper-plane">&nbsp;</i>Sent Messages</span>
                        </div>
                    </div>
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
                        
                                <table class="table pure-table pure-table-horizontal pure-table-striped"
                                       id="sample_1_2" role="grid" aria-describedby="sample_1_2_info">
                                    <thead>
                                    <tr role="row">
                                        <th > Subject
                                        </th>
                                        <th> Sent to
                                        </th>
                                        <th> Remarks
                                        </th>
                                        <th >Date
                                        </th>
                                        <th > Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($consMap as $data){ ?>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <a href=""> <?php echo $data->subject ?> </a>
                                        </td>
                                        <td><a href=""> <?php
                                                $res = App\User::find($data->sender_id);
                                                echo $res->email;
                                                ?> </a>
                                        </td>
                                        <td>
                                            <?php echo $data->remarks; ?>
                                        </td>

                                        <td>
                                            <?php echo $data->created_at; ?>
                                        </td>

                                        <td>
                                            <a href="{{ url('/mailbox/setReply/'.$data->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye">&nbsp;</i>View</a>
                                        </td>

                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="{{ asset('public/js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>
     <script>
        $(document).ready(function () {
            $('#sample_1_2').DataTable({
                "ordering": false
            });
        })

    </script>
@endsection