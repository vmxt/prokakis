@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/bootstrap-tour/bootstrap-tour.min.css') }}">


    <style>
        .niceDisplay {
            font-family: 'PT Sans Narrow', sans-serif;
            background-color: white;
            padding: 30px;
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .btn-xl {
            padding: 10px 20px;
            font-size: 20px;
            border-radius: 5px;
            width: 100%;
            background-color: gray;
        }

        .wrapword {
            white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
            white-space: -pre-wrap;      /* Opera 4-6 */
            white-space: -o-pre-wrap;    /* Opera 7 */
            white-space: pre-wrap;       /* css-3 */
            word-wrap: break-word;       /* Internet Explorer 5.5+ */
            white-space: -webkit-pre-wrap; /* Newer versions of Chrome/Safari*/
            word-break: break-word;
            white-space: normal;
        }

        @media (min-width: 321px) and (max-width: 767px) {
               .wrapword{
                 line-height: 3.5;
               }

        }

        @media (min-width: 992px) {
               .wrapword{
                 line-height: 3.5;
               }
        }
        .intro-tour-overlay {
            display: none;
            background: #666;
            opacity: 0.5;
            z-index: 1000;
            min-height: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
        }
    </style>

    <div class="container">
        <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">
            <li>
                <a href="{{ url('/home') }}">Home</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="#">Opportunity</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                Create Opportunity
            </li>

        </ul>

        <div class="row justify-content-center">

            <div class="col-md-12" style="min-height:800px">
                <div class="portlet light">
                    <div class="portlet-body">
                        <div class="card">
                            <div class="card-body center">
                                <div class="btn-group btn-group btn-group-justified" style="height: 100px;">
                                    <div class="row">
                                        <center><h2>I want to</h2></center>
                                        <div class="col col-sm-4" style="padding: 0px;" id='sect_building'>
                                            <a id="building" href="javascript:;"
                                               class="btn green-sharp btn-outline  btn-block sbold uppercase"
                                               type="submit" style="height: 100px; "> <span class="wrapword"
                                                        style="font-size: 25px;">INVEST</span> </a>
                                            <center><span style="margin-top: 5px;">Partnerships or Investments</span>
                                            </center>
                                        </div>
                                        <div  class="col col-sm-4" style="padding: 0px;" id='sect_selling'>
                                            <a id="selling" href="javascript:;"
                                               class="btn green-sharp btn-outline  btn-block sbold uppercase"
                                               type="submit" style="height: 100px; line-height: 3.5;"> <span
                                                        style="font-size: 25px;">SELL</span> </a>
                                            <center>Product/Service or Business</center>
                                        </div>
                                        <div class="col col-sm-4" style="padding: 0px;" id='sect_buying'>
                                            <a id="buying" href="javascript:;"
                                               class="btn green-sharp btn-outline  btn-block sbold uppercase"
                                               type="submit" style="height: 100px; line-height: 3.5;"> <span
                                                        style="font-size: 25px;">BUY</span> </a>
                                            <center>Product/Service or Business</center>
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
    <div class='intro-tour-overlay'></div>
    <script src="{{ asset('public/jq1110/jquery.min.js') }}"></script>

    <script src="{{ asset('public/bootstrap-tour/bootstrap-tour.min.js') }}"></script>


    <script>
        $(document).ready(function () {

            $("#building").click(function () {
                $(location).attr("href", "{{ route('opportunityNewBuild') }}");
            });

            $("#selling").click(function () {
                $(location).attr("href", "{{ route('opportunitySellOffer') }}");
            });

            $("#buying").click(function () {
                $(location).attr("href", "{{ route('opportunityBuy') }}");
            });

        });

    </script>
<script>
// Instance the tour
var tour = new Tour({
  steps: [
  
  {
    element: "#sect_building",
    title: "Building Opportunity",
    content: "Create a new opportunity under builing category",
    placement: "top"
  },
  {
    element: "#sect_selling",
    title: "Sell/Offer Opporturnity",
    content: "Create a new opportunity under sell or offer Category",
    placement: "top"
  },
 {
    element: "#sect_buying",
    title: "Buying Category",
    content: "Create a new opportunity under buy Category",
     placement: "top"
  },



],

  container: "body",
  smartPlacement: false,
  keyboard: true,
  // storage: window.localStorage,
  storage: false,
  debug: false,
  backdrop: true,
  backdropContainer: 'body',
  backdropPadding: 0,
  redirect: false,
  orphan: false,
  duration: false,
  delay: false,
  basePath: "",
  placement: 'auto',
    autoscroll: true,
  afterGetState: function (key, value) {},
  afterSetState: function (key, value) {},
  afterRemoveState: function (key, value) {},
  onStart: function (tour) {},
  onEnd: function (tour) {
     $('.intro-tour-overlay').hide();
      $('html').css('overflow','unset')
     $('.menu-dropdown').removeClass('open');
     updateTour('end');
  },
  onShow: function (tour) {},
  onShown: function (tour) {},
  onHide: function (tour) {},
  onHidden: function (tour) {},
  onNext: function (tour) {},
  onPrev: function (tour) {},
  onPause: function (tour, duration) {},
  onResume: function (tour, duration) {},
  onRedirectError: function (tour) {}

});

// Initialize the tour
tour.init();

// Start the tour
if( $('#is_tour').val() == 1 ){
    $('html').css('overflow','visible');
     $('.intro-tour-overlay').show();
    tour.start();
}

        $(document).ready(function () {
            $(".close").click(function () {
                $(".jumbotron").remove();
            });
        });

    </script>
@endsection







