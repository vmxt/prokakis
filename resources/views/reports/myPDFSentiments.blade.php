@extends('layouts.chartsGraphsReport')


@section('content')

                 <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-10">

                                    <div class="portlet light ">
                                        <div class="portlet-title">
                                            <div class="caption">
                                               {{ $SELECTED_KW }}

                                            </div>
                                        </div>

                                            <div class="portlet-body">

                                                <div id="hc_sample" class="chart" style="height: 400px;"> </div>

                                            </div>

                                    </div>

                                </div>
                            </div>
                </div>

@endsection
