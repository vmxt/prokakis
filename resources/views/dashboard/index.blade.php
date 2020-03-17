@extends('layouts.chartsGraphs')

@section('breadcrumbs')
<div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{ route('home') }}">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Dashboard</span>
                            </li>
                        </ul>

                    </div>
@endsection


@section('content')

<style>

.highcharts-figure, .highcharts-data-table table {
    min-width: 320px; 
    max-width: 660px;
    margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
    padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
    padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}
.highcharts-data-table tr:hover {
    background: #f1f7ff;
}

#location_sample {
    height: 500px; 
    min-width: 310px; 
    max-width: 800px; 
    margin: 0 auto; 
}
.loading {
    margin-top: 10em;
    text-align: center;
    color: gray;
}

</style>



<div class="container">

    <div class="row justify-content-center">

                 <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-10">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> {{ $SELECTED_KW }} </span>

                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="fullscreen"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="hc_sample" class="chart" style="height: 400px;"> </div>
                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>


                         <!--   <div class="row">
                                                            <div class="col-md-10">
                                                                <div class="portlet light ">
                                                                    <div class="portlet-title">
                                                                        <div class="caption">
                                                                            <i class="icon-bar-chart font-green-haze"></i>
                                                                            <span class="caption-subject bold uppercase font-green-haze">Map </span>

                                                                        </div>
                                                                        <div class="tools">
                                                                            <a href="javascript:;" class="collapse"> </a>
                                                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                                            <a href="javascript:;" class="reload"> </a>
                                                                            <a href="javascript:;" class="fullscreen"> </a>
                                                                            <a href="javascript:;" class="remove"> </a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="portlet-body">
                                                                        <div id="location_sample" class="chart" style="height: 400px;">
                                                                          <div class="loading">
                                                                                <i class="icon-spinner icon-spin icon-large"></i>
                                                                                Loading data from Google Spreadsheets...
                                                                            </div>
                                                                         </div>
                                                                    </div>
                                                                </div>
                                                       
                                                            </div>
                            </div> -->



                            <div class="row">
                                <div class="col-md-10">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> {{ $SELECTED_KW }} </span>

                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="fullscreen"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            
                                        <figure class="highcharts-figure">
                                            <div id="container_pie"></div>
                                        </figure>
                                            

                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-10">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> {{ $SELECTED_KW }} </span>

                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="fullscreen"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            
                                        <figure class="highcharts-figure">
                                            <div id="container_gender"></div>
                                        </figure>
                                            

                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>


                            
                            <div class="row">
                                <div class="col-md-10">
                                    <!-- BEGIN CHART PORTLET-->
                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-bar-chart font-green-haze"></i>
                                                <span class="caption-subject bold uppercase font-green-haze"> {{ $SELECTED_KW }} </span>

                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="fullscreen"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            
                                        <figure class="highcharts-figure">
                                            <div id="container_languages"></div>
                                        </figure>
                                            

                                        </div>
                                    </div>
                                    <!-- END CHART PORTLET-->
                                </div>
                            </div>

                            


                          </div>
    </div>
</div>
@endsection
