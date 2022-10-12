@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('public/css/opporIndex.css')}}">

     <link href='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css' rel="stylesheet" type="text/css" />
    <link href='https://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css' rel="stylesheet" type="text/css" />
    
    
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

    <style>
.ui.grid{
                margin-left:0 !important;
            }
.card{
        border:1px solid silver;
        border-radius:5px;
    }  
    .card-body{
        padding:20px;
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
            width: 25%;
            background-color: orangered;
        }
@media (max-width: 425px){
    .col-md-12{
        padding-right: 0px !important;
        padding-left: 0px !important;
    }
}


     .fit {
   width:1% !important;
   white-space: nowrap !important;
 }

th {
  color: black !important;
}

.center {
  height: 150px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: #000;
}
.wave {
  width: 5px;
  height: 100px;
  background: linear-gradient(45deg, #7cda24, #fff);
  margin: 10px;
  animation: wave 1s linear infinite;
  border-radius: 20px;
}
.wave:nth-child(2) {
  animation-delay: 0.1s;
}
.wave:nth-child(3) {
  animation-delay: 0.2s;
}
.wave:nth-child(4) {
  animation-delay: 0.3s;
}
.wave:nth-child(5) {
  animation-delay: 0.4s;
}
.wave:nth-child(6) {
  animation-delay: 0.5s;
}
.wave:nth-child(7) {
  animation-delay: 0.6s;
}
.wave:nth-child(8) {
  animation-delay: 0.7s;
}
.wave:nth-child(9) {
  animation-delay: 0.8s;
}
.wave:nth-child(10) {
  animation-delay: 0.9s;
}

@keyframes wave {
  0% {
    transform: scale(0);
  }
  50% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}

.odd-row{
                background-color:white !important;
            }
            .even-row{
                background-color:whitesmoke !important;
            }
            .paginate_button.active{
                background:black !important;
                color:white !important;
            }
            
    .text-align-right{
        text-align:right !important;
    }
    
    .text-align-center{
        text-align:center !important;
    }
    .mb-2{
        margin-bottom:15px;
    }
    
    .menu_a{
        padding:5px;
    }

    </style>

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="">{{ $contact_name }}</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>View Aged {{  ucfirst($type) }}</span>
            </li>
        </ul>
        
        <div class="row justify-content-center">
            <div class="col-md-12">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-bulb "></i>
                                <span class="caption-subject  sbold uppercase">View Aged {{  ucfirst($type) }}</span>
                            </div>

                        </div>
                        <div  class="card mb-2" >
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <h2>Contact: <a>{{ $contact_name }}</a></h2>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            
                        
                        <div class="portlet-body">
                            
                            <div id="container" class="card mb-2" >
                                <div class="card-body">

                                
                                <table id="system_data" class="ui celled table stripe" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>DATE</th>
                                        <th>NUMBER</th>
                                        <th>DUE DATE</th>
                                        <th></th>
                                        <th class="text-align-right">TOTAL</th>
                                        <th class="text-align-right">PAID</th>
                                        <th class="text-align-right">CREDITED</th>
                                        <th class="text-align-right">DUE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        echo $table_data;
                                    ?>
                                    
                                    </tbody>
                                </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                </div>
                </div>

        </div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            
    
        });

       


    </script>
@endsection
