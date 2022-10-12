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
    
    #company_primary_country_chartLegend td, #build_chartLegend td {display: inline-block;}
    
    .legendLabel{
        padding:5px;
        background:black;
        border-radius:3px;
        color:white;
        margin-right:13px;
        margin-bottom:8px;
    }
    
    .legendColorBox > div{
        padding:0px !important;
    }
    
    .legendColorBox > div > div{
        border-width:8px !important;
    }
    
    .mb-2{
        margin-bottom:10px;
    }
    
    .equal {
      display: flex;
      display: -webkit-flex;
      flex-wrap: wrap;
    }
    
    .flot-x-axis .flot-tick-label
{
     /*white-space: nowrap;*/
     transform: translate(-9px, 0) rotate(-60deg);
     text-indent: -100%;
     transform-origin: top right;
     margin-left:-50px ;
     text-align: right !important;
     color:black !important;
     font-weight:bold;
     border-radius:5px;
     height:20px;
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
                <span>OPPORTUNITY Dashboard</span>
            </li>
        </ul>

<div class="card mb-2">
    <div class="card-body">
        <div class="alert bg-dark text-white ">
            <i class="fa fa-bar-chart"></i><b> OPPORTUNITY CHART REPORTS</b>
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

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8 mb-2">
                <select class="form-control" id="opp_type_cb">
                    <option value="opp_building_capability">BUILD</option>
                    <option value="opp_buy">BUY</option>
                    <option value="opp_sell_offer">SELL</option>
                    
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <button class="btn btn-success" id="opp_type_load_btn" style="width:100%"><i class="fa fa-spinner" aria-hidden="true"></i> SELECT OPPORTUNITY TYPE</button>
            </div>
        </div>
        <div class="alert bg-dark text-white ">
            <i class="fa fa-bar-chart"></i><b id="chart_label_title"> BUILD OPPORTUNITY CHART REPORTS</b>
        </div>
        <div class="row">
            <div class="col-md-10 mb-2">
                <select class="form-control" id="build_type_cb">
                    <option value="ideal_partner_business">IDEAL PARTNER</option>
                    <option value="ideal_partner_base">IDEAL PARTNER COUNTRY</option>
                    <option value="audience_target">AUDIENCE TARGET</option>
                    <option value="timeframe_goal">TIMEFRAME GOAL</option>
                    
                    <option value="business_goal">BUSINESS GOAL</option>
                    
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <button class="btn btn-primary" id="build_load_btn" style="width:100%"><i class="fa fa-spinner" aria-hidden="true"></i> LOAD</button>
            </div>
        </div>
        <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <div id="build_bar_chart" style="width:100%;height:300px;margin-bottom:100px"></div>
                            </div>
                        </div>
                    </div>
                </div>
        <div class="row">
            <div class="col-md-6 mb-2 ">
                <div class="card">
                    <div class="card-body">
                        <div id="placeholdersss_build" style="width:100%;height:300px;" class="demo-placeholder"></div>
                    </div>
                </div>
            </div>
            <div  class="col-md-6 mb-2 ">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <div class="card ">
                            <div class="card-body" style="width:100%;height:340px;overflow-y:scroll">
                                <h5 class="text-dark " style="margin-top:0px"><i class="fa fa-list"></i> <b>LEGEND</b></h5>
                                <div id="build_chartLegend" >
                                    
                                </div>
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
		
    		    $build_count = App\OpportunityBuildingCapability::where('is_verify', '1')
				->where('status', 1)
				->count();
				
				$sell_count = App\OpportunitySellOffer::where('is_verify', '1')
				->where('status', 1)
				->count();
				
				$buy_count = App\OpportunityBuy::where('is_verify', '1')
				->where('status', 1)
				->count();
		    
		    ?>
		    
		    data[0] = {
        	    label: "INVEST",
        		data: {{ $build_count }}
        	};
        	data[1] = {
        	    label: "SELL",
        		data: {{ $sell_count }}
        	};
        	data[2] = {
        	    label: "BUY",
        		data: {{ $buy_count }}
        	};
        	
        	/*data2.push(data:[
        	    "INVEST",
        		{{ $build_count }}
        	]);
        	
        	data2.push([
        	    "SELL",
        		{{ $sell_count }}
        	]);
        	
        	data2.push([
        	    "BUY",
        		{{ $buy_count }}
        	]);*/
        	
        	var data2 = [{data: [[0,{{$build_count}}]], color: "rgb(237,194,64)"}, 
            {data: [[1,{{$sell_count}}]], color: "rgb(175,216,248)"},
            {data: [[2,{{$buy_count}}]], color: "rgb(203,75,75)"}];
		    
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
        
        
        var company_primary_country_chartLegend_height = $("#company_primary_country_chartLegend").closest(".card").height();
        $("#company_primary_country_bar_chart").height(((500 - parseInt(company_primary_country_chartLegend_height)) - 10));
        
        var $placeholder = $("#company_primary_country_bar_chart");
        
        var main_tick = [[0,"BUILD"],[1,"SELL"],[2,"BUY"]];
        
        var plot = $.plot("#company_primary_country_bar_chart", data2 , {
			series: {
				bars: {
					show: true,
					barWidth: 0.5,
					align: "center",
					lineWidth: 5,
					fill: 0.7,
					lineColor: "black"
				},
				grow: { active: true, duration: 1000  }
			},
			xaxis: {
				mode: "categories",
				showTicks: true,
				gridLines: false,
				ticks: main_tick,
				autoscaleMargin:0.01
			},
			grid: { hoverable: true,  },
            tooltip: true,
            tooltipOpts: {
                cssClass: "flotTip",
                content: function(label,x,y){
                    return "<b class='text-company'>" + main_tick[x][1] + "</b> ( "+y+" )"
                },
                shifts: {
                    x: 20,
                    y: 0
                },
                defaultTheme: false
            },
		});
		

        function labelFormatter(label, series) {
    		return "<div style='font-size:10pt; text-align:center; padding:2px; color:white;'><b>" + label + "<br/>" + Math.round(series.percent) + "%</b></div>";
    	}
        
        function legendFormatter(label, series) {
    		return "<div style='font-size:10pt; text-align:center; padding:2px; color:black;'><b>" + label + "" + series.data[0][1] + " (" + Math.round(series.percent) + "% )</b></div>";
    	}
    	
    	
    	var if_done_chart = 0;
                                            var financial_chart;
                                            
                                            var mydata = "";
                                            
                                            $("#build_load_btn").click(function(){
                                                load_graph_data();
                                            });
                                            
                                            $("#opp_type_load_btn").click(function(){
                                                var type = $("#opp_type_cb option:selected").val();
                                                
                                                var option = '';
                                                if(type=="opp_building_capability"){
                                                    $("#chart_label_title").text(" BUILD OPPORTUNITY CHART REPORTS");
                                                    options = '<option value="ideal_partner_business">IDEAL PARTNER</option><option value="ideal_partner_base">IDEAL PARTNER COUNTRY</option><option value="audience_target">AUDIENCE TARGET</option><option value="timeframe_goal">TIMEFRAME GOAL</option><option value="business_goal">BUSINESS GOAL</option>';
                                                }else{
                                                    if(type=="opp_sell_offer"){
                                                        $("#chart_label_title").text(" SELL OPPORTUNITY CHART REPORTS");
                                                    }
                                                    
                                                    if(type=="opp_buy"){
                                                        $("#chart_label_title").text(" BUY OPPORTUNITY CHART REPORTS");
                                                    }
                                                    
                                                    options = '<option value="ideal_partner_business">IDEAL PARTNER</option><option value="ideal_partner_base">IDEAL PARTNER COUNTRY</option><option value="audience_target">AUDIENCE TARGET</option><option value="timeframe_goal">TIMEFRAME GOAL</option><option value="what_sell_offer">CATEGORY</option>';
                                                }
                                                
                                                $("#build_type_cb").html(options);
                                                
                                                load_graph_data();
                                            });
                                            
    	function load_graph_data(){
                                                
                                                
                                                  $.ajax({
                                                      url: "{{ route('getFinancialEntriesDataBuy') }}",
                                                      data:{ table_name:$("#build_type_cb option:selected").val(), db_name:$("#opp_type_cb option:selected").val() },
                                                      type: "GET",
                                                      success: function (s_data) {
                                                          var data_split = s_data.split("<split>");
                                                         
                                                            var f_data = JSON.stringify(data_split[0]);
                                                            
                                                            var arr2 = JSON.parse(data_split[1]);
                                                            var f_data2 = new Array();
                                                            $.each(arr2, function(key,val){
                                                               
                                                            	f_data2[key] = val;
                                                            });
                                                            
                                                            var main_tick2 = eval(data_split[2]);
                                                          
                                                          var $placeholder_build_bar_chart = $("#build_bar_chart");
        
                                                            var plot_build_bar_chart = $.plot("#build_bar_chart",  eval(data_split[0]) , {
                                                    			series: {
                                                    				bars: {
                                                    					show: true,
                                                    					barWidth: 0.5,
                                                    					align: "center",
                                                    					lineWidth: 5,
                                                                        fill:0.7
                                                    				},
                                                    				grow: { active: true, duration: 1000  }
                                                    			},
                                                    			xaxis: {
                                                    				mode: "categories",
                                                    				showTicks: true,
                                                    				gridLines: false,
                                                    				ticks: main_tick2,
                                                    				autoscaleMargin:0.01
                                                    			},
                                                    			grid: { hoverable: true, lineWidth: 1,},
                                                                tooltip: true,
                                                                tooltipOpts: {
                                                                    cssClass: "flotTip",
                                                                    content: function(label,x,y){
                                                                        return "<b class='text-company'>" + main_tick2[x][1] + "</b> ( "+y+" )"
                                                                    },
                                                                    defaultTheme: false
                                                                },
                                                    		});
                                                    		
                                                    		$placeholder_build_bar_chart.on('growFinished', function (){
                                                    		     $("#build_bar_chart").find(".data-point-label").remove();
                                                    		     
                                                        		$.each(plot_build_bar_chart.getData()[0].data, function(i, el){
                                                    
                                                                    //var o = plot.pointOffset({x: el[0], y: el[1]});
                                                                    var o = plot_build_bar_chart.pointOffset({x: i, y: el[1]});
                                                        
                                                                    $('<div class="data-point-label"><b>(' + el[1] + ')</b></div>').css( {
                                                                        position: 'absolute',
                                                                        left: o.left - 7,
                                                                        top: o.top - 30,
                                                                        display: 'none',
                                                                        color:'#000',
                                                                        fontSize:'10pt'
                                                                    }).appendTo(plot_build_bar_chart.getPlaceholder()).slideToggle();
                                                                });
                                                    		});
                                                    		
                                                    		
                                                    		//start pie chart
                                                    		
                                                    		$.plot('#placeholdersss_build',f_data2, {
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
                                                                    container: $("#build_chartLegend"),
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
                                                      },
                                                      error: function(){
                                                        alert("server error");
                                                      }
                                                  });
                                            }
                                            
                                load_graph_data();
    	
    });
    
    
</script>

@endsection