<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Ebosreputation Charts and Graphs</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Ebosreputation Charts and Graphs" name="description" />
        <meta content="" name="author" />

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="{{ asset('public/assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
        <link href="{{ asset('public/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="{{ asset('public/assets/layouts/layout2/css/layout.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/layouts/layout2/css/themes/blue.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
        <link href="{{ asset('public/assets/layouts/layout2/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">

                @include('layouts.header')

                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
      </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
     <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->


     <!-- BEGIN CONTAINER -->
     <div class="page-container">

            <!-- SIDEBAR STARTS -->
            @include('layouts.sidebar')
            <!-- END SIDEBAR -->

            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">

                   <div class="loader"></div>

                    <!-- BEGIN PAGE HEADER-->

                   <!-- <h1 class="page-title"> Admin Dashboard 2
                        <small>statistics, charts, recent events and reports</small>
                    </h1>-->


                    @yield('breadcrumbs')

                    <!-- END PAGE HEADER-->

                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                            <div class="portlet light ">


                                <div class="portlet-body">


                                      @yield('content')


                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->

        </div>
        <!-- END CONTAINER -->

   <!-- BEGIN FOOTER -->
   @include('layouts.footer')
   <!-- END FOOTER -->
            <!-- END QUICK NAV -->
            <!--[if lt IE 9]>
<script src="{{ asset('public/assets/global/plugins/respond.min.js') }}"></script>
<script src="{{ asset('public/assets/global/plugins/excanvas.min.js') }}"></script>
<script src="{{ asset('public/assets/global/plugins/ie8.fix.min.js') }}"></script>
<![endif]-->
            <!-- BEGIN CORE PLUGINS -->

          <!--  <script src="{{ asset('public/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
          -->

            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <!--<script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
          -->
            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>-->

             <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->

             <script src="https://code.highcharts.com/highcharts.js"></script>
             <script src="https://code.highcharts.com/modules/exporting.js"></script>
             <script src="https://code.highcharts.com/modules/export-data.js"></script>

             <script src="https://code.highcharts.com/modules/accessibility.js"></script>

           <!--  <script src="{{ asset('public/assets/global/scripts/app.min.js') }}" type="text/javascript"></script> -->


             <!--<script src = "https://code.highcharts.com/highcharts.js"></script> -->

             <!-- <script src="https://code.highcharts.com/maps/highmaps.js"></script>
              <script src="https://code.highcharts.com/maps/modules/data.js"></script>
              <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
              <script src="https://code.highcharts.com/maps/modules/offline-exporting.js"></script>
              <script src="https://code.highcharts.com/mapdata/custom/world.js"></script> -->


            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <!--<script src="{{ asset('public/assets/pages/scripts/charts-amcharts.min.js') }}" type="text/javascript"></script> -->
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->

            <!-- <script src="{{ asset('public/assets/layouts/layout2/scripts/layout.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/layouts/layout2/scripts/demo.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('public/assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script> -->

            <!-- END THEME LAYOUT SCRIPTS -->
            <script>

                $(document).ready(function()
                {

                    $.getJSON('https://reputation.prokakis.com/analysis-dailyvolume/{{ $SELECTED_KW }}', function(dataA) {

                       var title = {
                          text: 'Daily Volume '
                       };
                       var subtitle = {
                          text: 'Ebosreputation Sentiment Analysis'
                       };
                       var xAxis = {
                          categories: dataA.dateCategory
                       };
                       var yAxis = {
                          title: {
                             text: 'Score'
                          },
                          plotLines: [{
                             value: 0,
                             width: 1,
                             color: '#808080'
                          }]
                       };
                       var tooltip = {
                          valueSuffix: ''
                       }
                       var legend = {
                          layout: 'vertical',
                          align: 'right',
                          verticalAlign: 'middle',
                          borderWidth: 0
                       };
                       var series =  [
                           {
                             name: 'Neutral',
                             data: dataA.neu,
                          },
                          {
                             name: 'Negative',
                             data:  dataA.neg
                          },
                          {
                             name: 'Positive',
                             data: dataA.pos
                          },
                          {
                             name: 'Total',
                             data: dataA.total
                          }
                       ];

                       var exporting = {
                        enabled: false // hide button
                      }

                       var json = {};
                       json.title = title;
                       json.subtitle = subtitle;
                       json.xAxis = xAxis;
                       json.yAxis = yAxis;
                       json.tooltip = tooltip;
                       json.legend = legend;
                       json.series = series;
                       json.exporting = exporting;

                       $('#hc_sample').highcharts(json);



                    // Build the chart
                    Highcharts.chart('container_pie', {
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Sentiment Analysis'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        exporting : {
                            enabled: false // hide button
                          },
                        series: [{
                            name: 'Sentiments',
                            colorByPoint: true,
                            data: [{
                                name: 'Neutral',
                                y: dataA.totalNeu,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'Negative',
                                y: dataA.totalNeg
                            },
                             {
                                name: 'Positive',
                                y: dataA.totalPos
                            }]
                        }]
                    });


                     // Build the chart
                     Highcharts.chart('container_gender', {
                        chart: {
                            plotBackgroundColor: false,
                            plotBorderWidth: false,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Gender Analysis'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        exporting : {
                            enabled: false // hide button
                          },
                        series: [{
                            name: 'Genders',
                            colorByPoint: true,
                            data: [{
                                name: 'Female',
                                y: dataA.genderFemale,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'Male',
                                y: dataA.genderMale
                            }
                            ]
                        }]
                    });

                     // Build the chart
                     Highcharts.chart('container_languages', {
                        chart: {
                            plotBackgroundColor: false,
                            plotBorderWidth: false,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                            text: 'Languages Analysis'
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        accessibility: {
                            point: {
                                valueSuffix: '%'
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        exporting : {
                            enabled: false // hide button
                          },
                        series: [{
                            name: 'Language',
                            colorByPoint: true,
                            data: dataA.languagesAnalysis
                        }]
                    });



            });

/*                      Highcharts.data({
    googleSpreadsheetKey: '1WBx3mRqiomXk_ks1a5sEAtJGvYukguhAkcCuRDrY1L0',

    // Custom handler when the spreadsheet is parsed
    parsed: function (columns) {

        // Read the columns into the data array
        var data = [];
        Highcharts.each(columns[0], function (code, i) {
            data.push({
                code: code.toUpperCase(),
                value: parseFloat(columns[2][i]),
                name: columns[1][i]
            });
        });

        // Initiate the chart
        Highcharts.mapChart('location_sample', {
            chart: {
                map: 'custom/world',
                borderWidth: 1
            },

            colors: ['rgba(19,64,117,0.05)', 'rgba(19,64,117,0.2)', 'rgba(19,64,117,0.4)',
                'rgba(19,64,117,0.5)', 'rgba(19,64,117,0.6)', 'rgba(19,64,117,0.8)', 'rgba(19,64,117,1)'],

            title: {
                text: 'Population density by country (/km²)'
            },

            mapNavigation: {
                enabled: true
            },

            legend: {
                title: {
                    text: 'Individuals per km²',
                    style: {
                        color: ( // theme
                            Highcharts.defaultOptions &&
                            Highcharts.defaultOptions.legend &&
                            Highcharts.defaultOptions.legend.title &&
                            Highcharts.defaultOptions.legend.title.style &&
                            Highcharts.defaultOptions.legend.title.style.color
                        ) || 'black'
                    }
                },
                align: 'left',
                verticalAlign: 'bottom',
                floating: true,
                layout: 'vertical',
                valueDecimals: 0,
                backgroundColor: ( // theme
                    Highcharts.defaultOptions &&
                    Highcharts.defaultOptions.legend &&
                    Highcharts.defaultOptions.legend.backgroundColor
                ) || 'rgba(255, 255, 255, 0.85)',
                symbolRadius: 0,
                symbolHeight: 14
            },

            colorAxis: {
                dataClasses: [{
                    to: 3
                }, {
                    from: 3,
                    to: 10
                }, {
                    from: 10,
                    to: 30
                }, {
                    from: 30,
                    to: 100
                }, {
                    from: 100,
                    to: 300
                }, {
                    from: 300,
                    to: 1000
                }, {
                    from: 1000
                }]
            },

            series: [{
                data: data,
                joinBy: ['iso-a3', 'code'],
                animation: true,
                name: 'Population density',
                states: {
                    hover: {
                        color: '#a4edba'
                    }
                },
                tooltip: {
                    valueSuffix: '/km²'
                },
                shadow: false
            }]
        });
    },
    error: function () {
        document.getElementById('location_sample').innerHTML = '<div class="loading">' +
            '<i class="icon-frown icon-large"></i> ' +
            'Error loading data from Google Spreadsheets' +
            '</div>';
    }
});
*/


                })
            </script>
    </body>

</html>
