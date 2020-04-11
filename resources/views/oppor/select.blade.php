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
                                        <div class="col col-sm-4" style="padding: 0px;">
                                            <a id="building" href="javascript:;"
                                               class="btn green-sharp btn-outline  btn-block sbold uppercase"
                                               type="submit" style="height: 100px; "> <span class="wrapword"
                                                        style="font-size: 25px; ">BUILDING CAPABILITY</span> </a>
                                            <center><span style="margin-top: 5px;">Partnership or Investments</span>
                                            </center>
                                        </div>
                                        <div id="selling" class="col col-sm-4" style="padding: 0px;">
                                            <a href="javascript:;"
                                               class="btn green-sharp btn-outline  btn-block sbold uppercase"
                                               type="submit" style="height: 100px; line-height: 3.5;"> <span
                                                        style="font-size: 25px;">SELL / OFFER</span> </a>
                                            <center>Product Service or Business</center>
                                        </div>
                                        <div class="col col-sm-4" style="padding: 0px;">
                                            <a id="buying" href="javascript:;"
                                               class="btn green-sharp btn-outline  btn-block sbold uppercase"
                                               type="submit" style="height: 100px; line-height: 3.5;"> <span
                                                        style="font-size: 25px;">BUY</span> </a>
                                            <center>Product Services or Business</center>
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

    <script src="{{ asset('public/jq1110/jquery.min.js') }}"></script>

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

@endsection







