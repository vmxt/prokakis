<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
   <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
    <style>
        body {
          font-family: 'Open Sans', 'sans-serif' !important;
          background-color: white !important;
        }
        .bg-orange{
            background-color: white;
        }
        
        .color-orange{
            color: #eb9834;
        }
        
        hr.page2-hr{
            border: .3px solid #eb9834 ;
            position: fixed;
            top: 80px;
            left: 80px;
            right: 0px;
            bottom: 0px;
        }
        
        .text-muted{
            line-height: normal !important;
        }
        
        /*.footer{
            position: fixed;
            bottom: -10px;
            left: 0px;
            right: 0px;
            background-color: lightblue;
            height: 50px;
        }*/
        
        .page-break {
            page-break-after: always;
        }
        
        table{
            /*  border: 1px solid gray;*/
            font-size: 12px;
        }
        
        table tr {
            padding: 1px;
        }
        
        .social-table{
            left: 0;
        }
        
        .text-header{
            font-weight:bold;
        }
        
        @page {
            margin: 0cm 0cm;
            margin-bottom: 2cm;
            line-height: 1.6 !important;
             margin-top: 50px;
        }
        
        body {
            margin-top: 1.8cm;
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-bottom: 3cm;
            padding: 1em;
        }
        
        footer {
            position: fixed;
            bottom: -105px;
            left: 0cm;
            right: 0cm;
            height: 4cm;
            /*margin-right: 1%;*/
            /*margin-left: 1%;*/
            text-align: left;
        
        }
        
        footer p{
            font-size: 11px !important; 
        }
        
        header {
            position: fixed;
            top: .5cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
             bottom: 10cm;
            margin-right: 10%;
            margin-left: 10%;
            margin-bottom: 12%;
             text-align: right;
             /*padding-bottom: 120px;*/
            /** Extra personal styles **/
        
        }
        
        .pagenum:before {
            content: counter(page);
        }
        
        .pageNum-div{
            position: absolute;
            bottom: 2px;
            right: 10%;
            color: white;
            font-size:12px !important;
        }
        
        footer .footer-text{
                margin-right: 10%;
            margin-left: 10%;
        }
        
        .foot-content{
            position: relative;
            top: 10px;
            font-size: 13px;
            text-align: justify;
            text-justify: inter-word;
        }
        
        .socialblock{
            padding: 150px;
            position: relative;
            border: 1px solid #786a69;
        }
        
        .social-block1{
            position: absolute;
            top: 0;
            left: 3.5em;
            display: flex;
        }
        .social-content1{
            position: relative;
            width:  300px;
            display: flex;
        }
        .content1-days{
            position: relative;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            top: 0cm;
            height: 0cm;
        }
        
        .social-content2{
            position: relative;
            /*border: 1px solid #786a69;*/
            /*background-color: blue;*/
            /* padding: 150px 18% ;
            top: 0;
            left: 0;*/
            /*padding-bottom: 278px;*/
            width:   600px;
        }
        
        .social-card{
            width: 90%;
            left: 2em;
        }
        /*.social-card .card-body .p-0 img{
        top: 335px !important;
        }*/
        .social-img-holder{
            bottom:  6em !important;
            right: 4em;
            position: relative;
        }
        .card-body table.social-table tbody{
            border: 2px solid #786a69;
        }
        .card-body table.social-table tbody td{
            padding: 40px;
            border: 2px solid #786a69 !important;
        }
        .social-table1{
            width: 15px;
        }
        .social-table2 a{
            font-size: 13px !important;
        }
        
        /*VERSION 2 DESIGN ADDITIONAL UPDATE*/
        .header_logo{
            float: left;
        }
        
        #watermark {
            position:fixed;
            bottom:5px;
            right:5px;
            opacity:0.5;
            z-index:99;
            color:white;
        }
        
        .heading1{
            font-size: 36px;
            font-weight: bolder;
            text-transform:uppercase;
            color:#7cda24 !important;
        }
        
        .report-line{
            border: 5px solid black;
            border-radius: 5px;
            width: 90%;
            background:black;
        }
        
        .gray-box{
            padding: 40px;
            background-color: #ECECEC;
            margin: 0 auto;
        }
        
        
        
        .section-title{
            background-color: #8DA1BB;
        }
        
        
         .card-body, .card, .row *, .page-break, #app, .container-fluid {
            background-color: white !important;
        }
        
        
        #app *, .card *, .page-break *{
            background-color: white !important;
        }
        
        footer{
            background-color: black !important;  
            color: #7cda24 !important;
        }
        
        .card-body img{
            width: 60%;
            height: auto;
        }
        
           .fit {
               width:1% !important;
               white-space: nowrap !important;
             }
            
            th {
              color: #7cda24 !important;
              background:black !important;
            }

        /*.card{
            margin-bottom:  50px !important;
        }*/
    </style>
</head>

<body style="background-color: white;">
    <style>
    .btn-x4 {
    font-size: 15px;
    border-radius: 5px;
    width: 15%;
    background-color: orangered;
    }

</style>
        @include('buyreport.header.trackNumber' )

          @include('buyreport.footer.disclaimer', ['footer_content'=>$footer_content ] )

    <div id="app" >
       

            @yield('content')
    </div>

 
  
</body>
</html>