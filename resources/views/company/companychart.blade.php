@extends('layouts.app')



@section('content')

<style>
    .card{
        border:1px solid silver;
        border-radius:5px;
    }  
    .card-body{
        padding:20px;
    }  
    
    .pieLabel{
        font-weight:bold !important;
        font-size:12px !important;
    }
    
    #flotTip {
        padding: 6px 15px;
        background-color: black;
        z-index: 100;
        color: white;
    }
    
    #company_primary_country_chartLegend td {display: inline-block;}
    
    .legendColorBox > div{
        padding:0px !important;
    }
    
    .legendColorBox > div > div{
        border-width:8px !important;
    }
    
    .mb-2{
        margin-bottom:10px;
    }
</style>

<script src="{{asset('public/assets/global/plugins/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/flot/jquery.flot.pie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/flot/jquery.flot.resize.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/assets/global/plugins/flot/jquery.flot.categories.min.js')}}" type="text/javascript"></script>
<script src="https://envato.stammtec.de/themeforest/melon/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="http://thgreasi.github.io/growraf/javascripts/jquery.flot.growraf.js"></script>


<div class="container">
<ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/dashboard') }}">Dashboard</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>Company Dashboard</span>
            </li>
        </ul>

<div class="card">
    <div class="card-body">
        <div class="alert bg-dark text-white ">
            <i class="fa fa-bar-chart"></i><b> COMPANY CHART REPORTS</b>
        </div>
        <div class="row">
            <div class="col-md-10 mb-2">
                <select class="form-control" id="type_cb">
                    <option <?php if( $_GET["type"] == "primary_country" ){ echo "selected"; } ?> value="primary_country">COMPANY'S PRIMARY COUNTRY</option>
                    <option <?php if( $_GET["type"] == "business_type" ){ echo "selected"; } ?> value="business_type">COMPANY'S BUSINESS TYPE</option>
                    <option <?php if( $_GET["type"] == "currency" ){ echo "selected"; } ?> value="currency">COMPANY'S CURRENCY</option>
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary" id="load_btn" style="width:100%"><i class="fa fa-spinner" aria-hidden="true"></i> LOAD</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mb-2">
                <div class="card">
                    <div class="card-body">
                        <div id="placeholdersss" style="width:100%;height:500px" class="demo-placeholder"></div>
                    </div>
                </div>
            </div>
            <div  class="col-md-7 mb-2">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text-dark " style="margin-top:0px"><i class="fa fa-list"></i> <b>LEGEND</b></h5>
                                <div id="company_primary_country_chartLegend">
                                    
                                </div>
                                <h5 class="bg-danger text-dark" style="padding:5px;border-radius:5px; margin:3px !important"><b class="text-dark">
                                    
                                    <?php 
                                    
                                    $data_null_count = App\CompanyProfile::
                    		        select($_GET["type"])
                    		        ->whereNull($_GET["type"])
                                    ->count();
                                    echo $data_null_count;
                                    ?>
                                    
                                </b> Companies who dont have this data!</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div id="company_primary_country_bar_chart" style="width:100%;height:200px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>


<script>
    $(document).ready(function(){
        $("#load_btn").click(function(){
            window.location = "<?php echo env("APP_URL"); ?>company/companychart?type=" + $("#type_cb option:selected").val();
        });
        
        var data = [];
        var data2 = new Array();
		
		<?php
		
		    if($_GET["type"] == "primary_country"){
		
    		    $primary_country_data = App\CompanyProfile::join("apps_countries", "company_profiles.primary_country", "=", "apps_countries.country_code")
    		        ->select('primary_country','country_name', DB::raw('count(*) as total'))
    		        ->whereNotNull('primary_country')
                    ->groupBy('primary_country')
                    ->orderBy("total", "desc")
                    ->get();
		    }
		    
		    if($_GET["type"] == "business_type"){
		
    		    $primary_country_data = App\CompanyProfile::select('business_type', DB::raw('count(*) as total'))
    		        ->whereNotNull('business_type')
                    ->groupBy('business_type')
                    ->orderBy("total", "desc")
                    ->get();
		    }
		    
		    if($_GET["type"] == "currency"){
		
    		    $primary_country_data = App\CompanyProfile::select('currency', DB::raw('count(*) as total'))
    		        ->whereNotNull('currency')
                    ->groupBy('currency')
                    ->orderBy("total", "desc")
                    ->get();
		    }
		    
		    ?>
		    
		    
		  <?php 
		    
		    if($_GET["type"] == "primary_country"){
                $count = 0;
                foreach($primary_country_data as $cdata){ ?>
                
                    data[{{ $count }}] = {
        				label: "{{ $cdata->primary_country }}",
        				data: {{ $cdata->total }}
        			};
        			
        			data2.push([
        				"{{ $cdata->primary_country }}",
        				{{ $cdata->total }}
        			]);
                    
            <?php
                    $count++;
                    
                }
		    }
		?>
		
		<?php 
		    
		    if($_GET["type"] == "business_type"){
                $count = 0;
                foreach($primary_country_data as $cdata){ ?>
                
                    data[{{ $count }}] = {
        				label: "{{ $cdata->business_type }}",
        				data: {{ $cdata->total }}
        			};
        			
        			data2.push([
        				"{{ $cdata->business_type }}",
        				{{ $cdata->total }}
        			]);
                    
            <?php
                    $count++;
                    
                }
		    }
		?>
		
		<?php 
		    
		    if($_GET["type"] == "currency"){
                $count = 0;
                foreach($primary_country_data as $cdata){ ?>
                
                    data[{{ $count }}] = {
        				label: "{{ $cdata->currency }}",
        				data: {{ $cdata->total }}
        			};
        			
        			data2.push([
        				"{{ $cdata->currency }}",
        				{{ $cdata->total }}
        			]);
                    
            <?php
                    $count++;
                    
                }
		    }
		?>
		
		$.plot('#placeholdersss', data, {
		    series: {
                pie: {
                    show: true,
                    radius: 0.8,
                    label: {
                        show: true,
                    }
                },
                grow: { active: true, duration: 2000  }
            },
            legend: {
                show: true,
                container: $("#company_primary_country_chartLegend"),
                noColumns: 0,
            },
            grid: { hoverable: true },
            tooltip: true,
            tooltipOpts: {
                cssClass: "flotTip",
                /*content: function(label,x,y){
                    return "<b class='text-company'>" + label + "</b> - " + y + " ( "+x+"% )"
                },*/
                content: "<b class='text-company'>%s</b> - ( %p.0% )",
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            },
        });
        
        <?php foreach($primary_country_data as $cdata){ ?>
            
            $("#company_primary_country_chartLegend .legendLabel").each(function(){
                
               <?php  if($_GET["type"] == "primary_country"){ ?>
                    if( $(this).text() == "{{ $cdata->primary_country }}" ){
                        $(this).html("<h6 class='sbold bg-dark text-white' style='margin-left:8px;margin-right:8px;margin-bottom:0px !important;margin-top:3px !important;padding:5px;border-radius:5px'> <b class='text-company'>({{ $cdata->total }}) </b> {{ $cdata->primary_country }} - {{ $cdata->country_name }}<h6>");
                    }
                <?php } ?>
                
                <?php if($_GET["type"] == "business_type"){ ?>
                    if( $(this).text() == "{{ $cdata->business_type }}" ){
                        $(this).html("<h6 class='sbold bg-dark text-white' style='margin-left:8px;margin-right:8px;margin-bottom:0px !important;margin-top:3px !important;padding:5px;border-radius:5px'> <b class='text-company'>({{ $cdata->total }}) </b> {{ $cdata->business_type }}<h6>");
                    }
                <?php } ?>
                
                <?php if($_GET["type"] == "currency"){ ?>
                    if( $(this).text() == "{{ $cdata->currency }}" ){
                        $(this).html("<h6 class='sbold bg-dark text-white' style='margin-left:8px;margin-right:8px;margin-bottom:0px !important;margin-top:3px !important;padding:5px;border-radius:5px'> <b class='text-company'>({{ $cdata->total }}) </b> {{ $cdata->currency }}<h6>");
                    }
                <?php } ?>
                
            });
        <?php } ?>
        
        var company_primary_country_chartLegend_height = $("#company_primary_country_chartLegend").closest(".card").height();
        $("#company_primary_country_bar_chart").height(((500 - parseInt(company_primary_country_chartLegend_height)) - 10));
        
        var $placeholder = $("#company_primary_country_bar_chart");
        
        var plot = $.plot("#company_primary_country_bar_chart", [ data2 ], {
			series: {
				bars: {
					show: true,
					barWidth: 0.5,
					align: "center",
					lineWidth: 0,
                    fillColor: "#7cda24 "
				},
				grow: { active: true, duration: 1000  }
			},
			xaxis: {
				mode: "categories",
				showTicks: true,
				gridLines: false
			},
			grid: { hoverable: true },
            tooltip: true,
            tooltipOpts: {
                cssClass: "flotTip",
                content: function(label,x,y){
                    return "<b class='text-company'>" + x + "</b> ( "+y+" )"
                },
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            },
		});
		
		$placeholder.on('growFinished', function (){
    		$.each(plot.getData()[0].data, function(i, el){

                //var o = plot.pointOffset({x: el[0], y: el[1]});
                var o = plot.pointOffset({x: i, y: el[1]});
    
                $('<div class="data-point-label"><b>(' + el[1] + ')</b></div>').css( {
                    position: 'absolute',
                    left: o.left - 7,
                    top: o.top - 30,
                    display: 'none',
                    color:'#000',
                    fontSize:'10pt'
                }).appendTo(plot.getPlaceholder()).slideToggle();
            });
		});

        function labelFormatter(label, series) {
    		return "<div style='font-size:10pt; text-align:center; padding:2px; color:white;'><b>" + label + "<br/>" + Math.round(series.percent) + "%</b></div>";
    	}
        
        function legendFormatter(label, series) {
    		return "<div style='font-size:10pt; text-align:center; padding:2px; color:black;'><b>" + label + "" + series.data[0][1] + " (" + Math.round(series.percent) + "% )</b></div>";
    	}
    	
    });
</script>

@endsection