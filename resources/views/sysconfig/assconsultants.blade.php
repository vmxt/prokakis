@extends('layouts.app')

@section('content')

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

           .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: #7cda24 !important;
  background:black !important;
}

    </style>
    

<link rel="stylesheet" href="https://unpkg.com/purecss@2.1.0/build/pure-min.css" integrity="sha384-yHIFVG6ClnONEA5yB5DJXfW2/KC173DIQrYoZMEtBvGzmf0PKiGyNEqe9N6BNDBH" crossorigin="anonymous">
    
    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
        <li>
            <a href="{{ url('/home') }}">Intellinz</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Settings</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            Mapping Consultants
        </li>

    </ul>
    <div class="container">
        @if (session('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share "></i>
                            <span class="caption-subject bold uppercase   " style="text-align: center">Mapping and Grouping of <center>Consultants</center></span>
                        </div>
                    </div>
                    <div class="row">
                        <div id="container">
                            <form id="company_social_form" method="POST" action="{{ route('storeConsultants') }}">
                                {{ csrf_field() }}

                                <input type="hidden" name="mapping_id" value="<?php if (isset($dataC->id)) {
                                    echo $dataC->id;
                                } else {
                                    echo '0';
                                } ?>">
                                <div class="form-group">
                                    <label for="consultantMain">Main Consultant</label>

                                    <select id="consultantMain" name="consultantMain" class="form-control">

                                        <option value="0"></option>
                                        <?php foreach($masterCon as $data) { ?>

                                        <?php if(isset($dataC->consultant_main) && $dataC->consultant_main == $data->id ){ ?>

                                        <option selected
                                                value="<?php echo $data->id; ?>"><?php echo $data->firstname . ' ' . $data->lastname; ?></option>

                                        <?php } else { ?>

                                        <option value="<?php echo $data->id; ?>"><?php echo $data->firstname . ' ' . $data->lastname; ?></option>

                                        <?php }
                                        } ?>

                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="consultantA">Select Consultant A</label>

                                    <select id="consultantA" name="consultantA" class="form-control">

                                        <option value="0"></option>

                                        <?php foreach($subCon as $data) { ?>

                                        <?php if(isset($dataC->consultant_sub1) && $dataC->consultant_sub1 == $data->id ){ ?>

                                        <option selected
                                                value="<?php echo $data->id; ?>"><?php echo $data->firstname . ' ' . $data->lastname; ?></option>

                                        <?php } else { ?>

                                        <option value="<?php echo $data->id; ?>"><?php echo $data->firstname . ' ' . $data->lastname; ?></option>

                                        <?php }
                                        } ?>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="consultantB">Select Consultant B</label>

                                    <select id="consultantB" name="consultantB" class="form-control">
                                        <option value="0"></option>
                                        <?php foreach($subCon as $data) { ?>

                                        <?php if(isset($dataC->consultant_sub2) && $dataC->consultant_sub2 == $data->id ){ ?>

                                        <option selected
                                                value="<?php echo $data->id; ?>"><?php echo $data->firstname . ' ' . $data->lastname; ?></option>

                                        <?php } else { ?>

                                        <option value="<?php echo $data->id; ?>"><?php echo $data->firstname . ' ' . $data->lastname; ?></option>

                                        <?php }
                                        } ?>

                                    </select>

                                </div>

                                <div class="form-group">
                                    <label for="country">Select Country</label>

                                    <select id="country" name="country" class="form-control">
                                        <option value="0"></option>
                                        <?php foreach($countries as $c){  ?>

                                        <?php if(isset($dataC->country_id) && $dataC->country_id == $c->country_code ) {  ?>
                                        <option selected
                                                value="<?php echo $c->country_code; ?>"><?php echo $c->country_name; ?></option>

                                        <?php } else { ?>
                                        <option value="<?php echo $c->country_code; ?>"><?php echo $c->country_name; ?></option>

                                        <?php }
                                        }  ?>

                                    </select>
                                </div>


                                <div class="form-group">
                                    <input type="submit" name="" class="btn blue" value="Save">
                                    <input type="submit" name="" class="btn default" value="Cancel">

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- BEGIN BORDERED TABLE PORTLET-->
                <div class="portlet light portlet-fit ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-map "></i>
                            <span class="caption-subject  sbold uppercase">Consultants groups and disignated countries</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable table-scrollable-borderless">
                            <table class="table table-hover table-light">
                                <thead>
                                <tr class="uppercase">
                                    <th style="width:20%;">Main Consultant</th>
                                    <th style="width:20%;">Consultant A</th>
                                    <th style="width:20%;">Consultant B</th>
                                    <th style="width:20%;">Country</th>
                                    <th style="width:20%;">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($consMap as $data){ ?>
                                <tr>
                                    <td> <?php echo $data->MainConsultant . ' (' . $data->MainConsultantLastname . ')'; ?> </td>
                                    <td> <?php echo $data->Sub1Consultant . ' (' . $data->Sub1ConsultantLastname . ')'; ?> </td>
                                    <td> <?php echo $data->Sub2Consultant . ' (' . $data->Sub2ConsultantLastname . ')'; ?> </td>
                                    <td> <?php echo $data->country_name; ?> </td>

                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <form method="POST" action="{{ route('editConsultants') }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="edit_consul"
                                                               value="<?php echo $data->MappingId; ?>">
                                                        <!--<input type="submit" data-icon="fa fa-edit"  id="butEdit" value="Edit" class="btn btn-primary  btn-sm  fa fa-edit"/>-->
                                                        <button type="submit"  id="butEdit" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> EDIT</button>
                                                        
                                                    </form>
                                                </td>

                                                <td>
                                                    <form method="POST" action="{{ route('delConsultants') }}">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="del_consul"
                                                               value="<?php echo $data->MappingId; ?>">
                                                        <!--<input type="submit" id="butDelete" value="Delete" class="btn btn-outline btn-circle btn-sm red"
                                                               />-->
                                                        <button name="del_consul" onclick="return confirm('Are you sure to delete <?php echo $data->MainConsultant . '/' . $data->Sub1Consultant . '/' . $data->Sub2Consultant; ?> ?')" type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-trash"></i> DELETE</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>

                                </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END BORDERED TABLE PORTLET-->
            </div>

        </div>



    </div>


    <script src="{{ asset('public/js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
    <script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

@endsection