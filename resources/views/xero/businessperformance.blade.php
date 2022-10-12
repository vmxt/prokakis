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
    
     .loading {
      position: fixed;
      z-index: 999;
      height: 2em;
      width: 2em;
      overflow: show;
      margin: auto;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
    }
    
    /* Transparent Overlay */
    .loading:before {
      content: '';
      display: block;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
        background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));
    
      background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
    }
    
    /* :not(:required) hides these rules from IE9 and below */
    .loading:not(:required) {
      /* hide "loading..." text */
      font: 0/0 a;
      color: transparent;
      text-shadow: none;
      background-color: transparent;
      border: 0;
    }
    
    .loading:not(:required):after {
      content: '';
      display: block;
      font-size: 10px;
      width: 1em;
      height: 1em;
      margin-top: -0.5em;
      -webkit-animation: spinner 150ms infinite linear;
      -moz-animation: spinner 150ms infinite linear;
      -ms-animation: spinner 150ms infinite linear;
      -o-animation: spinner 150ms infinite linear;
      animation: spinner 150ms infinite linear;
      border-radius: 0.5em;
      -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
    box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
    }
    
    /* Animation */
    
    @-webkit-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @-moz-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @-o-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    
    .amount_css{
        text-align:right !important;
    }
    
    .text-center{
        text-align:center !important;
    }
    
    .mb-2{
        margin-bottom:15px;
    }
    
    
    .procedure_img{
        width:50%;margin-left:20px;
        border:1px solid silver;
    }
    .procedure_img:hover{
        cursor: pointer;
     }
     #hidden_fullscreen {
        z-index:9999999999999;
        display:none;
        background-color:rgb(0,0,0, 0.7);
        position:fixed;
        height:100%;
        width:100%;
        left: 0px;
        top: 0px;    
        text-align: center;
        justify-content: center;
    }
    .close_fullscreen {
        position: absolute;
        right: 5px;
        top: 5px;
        background: red;
        color: white;
        cursor: pointer;
        width: 35px;
        height: 35px;
        text-align: center;
        line-height: 30px;
        border-radius:50px;
        font-weight:bold;
    }
    
    .nav-tabs > li.active {
        border-bottom:3px solid black !important;
    }
    .nav-tabs > li.active a {
        color:#7cda24 !important;   
        font-weight:bold;
    }
    #org_txt:hover {
        text-decoration: underline #4183c4
    }
    .bank_acc_id{
                        margin-top:3px !important;
                        margin-bottom:6px !important;
                        font-size:12px;
                    }
                    .bank_title{
                        margin-bottom:1px !important;
                    }
                    .bank_header{
                        border-bottom:1px solid silver;
                    }
                    .canvasjs-chart-credit{
                        color:none !important;
                    }
</style>
<?php 
    $header_array = array();
    
    $current_bank = array();
    $current_assets = array();
    $current_liabilities = array();
    
    $final_assets = array();
    
    $current_fixed_asset = array();
    $net_assets =  array();
    
    foreach ($data as $value)
    {
        if (count($value[0]["Rows"]) > 0)
        {
            foreach ($value[0]["Rows"] as $main_value)
            {
                if ($main_value["RowType"] == "Header")
                {
                    $cc = 0;
                    foreach ($main_value["Cells"] as $cells)
                    {
                        if ($cc > 0)
                        {
                            array_push($header_array, $cells["Value"]);
                        }
                        $cc++;
                    }
                }
                                
                                
                if ($main_value["RowType"] == "Section")
                {
                    $row_title = "";
                                    
                    foreach ($main_value["Rows"] as $main_row)
                    {
                        $row_title = $main_value["Title"];
                        
                        if ($main_row["RowType"] == "SummaryRow"){
                            $cell_array = array();
                                                    
                            $cc = 0;
                            $array_count = 0;
                                                        
                            $income_title  = "";
                            foreach ($main_row["Cells"] as $main_cells)
                            {
                                $value = $main_cells["Value"];
                                if ($cc > 0)
                                {
                                    if ($main_cells["Value"] != "")
                                    {
                                        $value = $main_cells["Value"];
                                    }
                                    else{
                                        $value = 0;
                                    }
                                    
                                    $header_split = explode(" ", $header_array[$array_count]);
                                    
                                    if($row_title == "Bank"){
                                        array_push($current_bank, array("label" => $header_split[1] . " " . $header_split[2], "y" => $value));
                                    }  
                                    
                                    if($row_title == "Current Assets"){
                                        array_push($current_assets, array("label" => $header_split[1] . " " . $header_split[2], "y" => $value));
                                    }  
                                    
                                    if($row_title == "Current Liabilities"){
                                        array_push($current_liabilities, array("label" => $header_split[1] . " " . $header_split[2], "y" => $value));
                                    }
                                    
                                    if($income_title == "Total Fixed Assets"){
                                        array_push($current_fixed_asset, array("label" => $header_split[1] . " " . $header_split[2], "y" => $value));
                                    }
                                    
                                    $array_count++;
                                }
                                else{
                                    $income_title = $main_cells["Value"];
                                }
                                $cc++;
                            }
                        }
                        
                        if ($main_row["RowType"] == "Row"){
                            $cc = 0;
                            $title = "";
                            
                            $array_count = 0;
                            
                            foreach ($main_row["Cells"] as $main_cells)
                            {   
                                $value = $main_cells["Value"];
                                if ($cc > 0)
                                {
                                    if($title == "Net Assets"){
                                        $header_split = explode(" ", $header_array[$array_count]);
                                        array_push($net_assets, array("label" => $header_split[1] . " " . $header_split[2], "y" => $value));
                                    }
                                    
                                    $array_count++;
                                }
                                else{
                                    $title = $value;
                                }
                                    
                                $cc++;
                            }
                        }
                    }
                }
                
            }
                            
        }

    }
    
    $ratio = array();
    $chart1_value_no = 0;
    
    for($x = 0; $x <= count($current_assets) - 1; $x++){
        
        $ratio_value = 0;
        $currass = isset($current_assets[$x]["y"]) ? $current_assets[$x]["y"] : 0;
        $curlia = isset($current_liabilities[$x]["y"]) ? $current_liabilities[$x]["y"] : 0;
        
        $curbank = isset($current_bank[$x]["y"]) ? $current_bank[$x]["y"] : 0;
        
        if($currass > 0 && $curlia > 0){
            $ratio_value = $currass / $curlia;
            $chart1_value_no++;
        }
        
        $sum = $currass + $curbank;
        array_push($final_assets, array("label" => $current_assets[$x]["label"], "y" => $sum));
        
        array_push($ratio, array("label" => $current_assets[$x]["label"], "y" => $ratio_value));
    }
    
    $chart2ratio = array();
    $chart2_value_no = 0;
    
    for($x = 0; $x <= count($net_assets) - 1; $x++){
        
        $ratio_value = 0;
        
        $netass = isset($net_assets[$x]["y"]) ? $net_assets[$x]["y"] : 0;
        $fixass = isset($current_fixed_asset[$x]["y"]) ? $current_fixed_asset[$x]["y"] : 0;
        
        if($netass > 0 && $fixass > 0){
            $ratio_value = $fixass / $netass;
            $chart2_value_no++;
        }
        
        array_push($chart2ratio, array("label" => $net_assets[$x]["label"], "y" => $ratio_value));
    }
    
    
?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<div class="row">
    <?php if($chart1_value_no > 0){ ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-header bank_header">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <h4 class="bank_title"><a>CURRENT RATIO</a></h4>
                        </div>
                        <div class="col-md-6 mb-2">
                            <select id="chart1_cb" class="form-control">
                                <option value="ratio">RATIO</option>
                                <option value="values">ASSET vs LIABILITIES</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div id="chart1" style="height:200px; width:100%"></div>
                    <script>
                        var chart1 = new CanvasJS.Chart("chart1", {
                                animationEnabled: true,
                                title:{
                                    text: "RATIO"
                                },
                                axisY: {
                                },
                                axisX:{
                                    reversed:true
                                },
                                legend: {
                                    cursor:"pointer",
                                },
                                toolTip: {
                                    shared: true,
                                },
                                data: [
                                {
                                    showInLegend: true,
                                    name: "RATIO",
                                    legendText: "RATIO",
                                    type: "column",
                                    markerSize: 5,
                                    color:"skyblue",
                                    yValueFormatString: "#,##0.#",
                                    dataPoints: <?php echo json_encode($ratio, JSON_NUMERIC_CHECK); ?>
                                },
                                {
                                    showInLegend: false,
                                    name: "CURRENT ASSETS",
                                    legendText: "CURRENT ASSETS",
                                    type: "spline",
                                    markerSize: 5,
                                    color:"green",
                                    yValueFormatString: "#,##0.##",
                                    visible: false,
                                    dataPoints: <?php echo json_encode($final_assets, JSON_NUMERIC_CHECK); ?>
                                },
                                {
                                    showInLegend: false,
                                    name: "CURRENT LIABILITIES",
                                    legendText: "CURRENT LIABILITIES",
                                    type: "spline",
                                    markerSize: 5,
                                    color:"red",
                                    yValueFormatString: "#,##0.##",
                                    visible: false,
                                    dataPoints: <?php echo json_encode($current_liabilities, JSON_NUMERIC_CHECK); ?>
                                }
                                ],
                            });
                            chart1.render();
                            
                            $("#chart1_cb").change(function(){
                                if( $("#chart1_cb option:selected").val() == "ratio"){
                                    chart1.options.data[0].visible = true;
                                    chart1.options.data[1].visible = false;
                                    chart1.options.data[2].visible = false;
                                    
                                    chart1.options.data[0].showInLegend = true;
                                    chart1.options.data[1].showInLegend = false;
                                    chart1.options.data[2].showInLegend = false;
                                }
                                else{
                                    chart1.options.data[0].visible = false;
                                    chart1.options.data[1].visible = true;
                                    chart1.options.data[2].visible = true;
                                    
                                    chart1.options.data[0].showInLegend = false;
                                    chart1.options.data[1].showInLegend = true;
                                    chart1.options.data[2].showInLegend = true;
                                }
                                chart1.options.title.text = $("#chart1_cb option:selected").text();
                                chart1.render();
                            });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <?php if($chart2_value_no > 0){ ?>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-header bank_header">
                    <div class="row">
                        <div class="col-md-7 mb-2">
                            <h4 class="bank_title"><a>Fixed assets to net worth ratio</a></h4>
                        </div>
                        <div class="col-md-5 mb-2">
                            <select id="chart2_cb" class="form-control">
                                <option value="ratio">RATIO</option>
                                <option value="values">NET WORTH vs FIXED ASSETS</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body">
                    <div id="chart2" style="height:200px; width:100%"></div>
                    <script>
                        var chart2 = new CanvasJS.Chart("chart2", {
                                animationEnabled: true,
                                title:{
                                    text: "RATIO"
                                },
                                axisY: {
                                },
                                axisX:{
                                    reversed:true
                                },
                                legend: {
                                    cursor:"pointer",
                                },
                                toolTip: {
                                    shared: true,
                                },
                                data: [
                                {
                                    showInLegend: true,
                                    name: "RATIO",
                                    legendText: "RATIO",
                                    type: "column",
                                    markerSize: 5,
                                    color:"skyblue",
                                    yValueFormatString: "#,##0.#",
                                    dataPoints: <?php echo json_encode($chart2ratio, JSON_NUMERIC_CHECK); ?>
                                },
                                {
                                    showInLegend: false,
                                    name: "NET WORTH",
                                    legendText: "NET WORTH",
                                    type: "spline",
                                    markerSize: 5,
                                    color:"green",
                                    yValueFormatString: "#,##0.##",
                                    visible: false,
                                    dataPoints: <?php echo json_encode($net_assets, JSON_NUMERIC_CHECK); ?>
                                },
                                {
                                    showInLegend: false,
                                    name: "FIXED ASSETS",
                                    legendText: "FIXED ASSETS",
                                    type: "spline",
                                    markerSize: 5,
                                    color:"red",
                                    yValueFormatString: "#,##0.##",
                                    visible: false,
                                    dataPoints: <?php echo json_encode($current_fixed_asset, JSON_NUMERIC_CHECK); ?>
                                }
                                ],
                            });
                            chart2.render();
                            
                            $("#chart2_cb").change(function(){
                                if( $("#chart2_cb option:selected").val() == "ratio"){
                                    chart2.options.data[0].visible = true;
                                    chart2.options.data[1].visible = false;
                                    chart2.options.data[2].visible = false;
                                    
                                    chart2.options.data[0].showInLegend = true;
                                    chart2.options.data[1].showInLegend = false;
                                    chart2.options.data[2].showInLegend = false;
                                }
                                else{
                                    chart2.options.data[0].visible = false;
                                    chart2.options.data[1].visible = true;
                                    chart2.options.data[2].visible = true;
                                    
                                    chart2.options.data[0].showInLegend = false;
                                    chart2.options.data[1].showInLegend = true;
                                    chart2.options.data[2].showInLegend = true;
                                }
                                chart2.options.title.text = $("#chart2_cb option:selected").text();
                                chart2.render();
                            });
                    </script>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>


@endsection