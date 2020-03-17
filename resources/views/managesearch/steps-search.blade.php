@extends('layouts.main')

@section('content')

<div class="container">

    <div class="row justify-content-center">

     @if (session('status'))
        <div class="alert alert-success">
          {{ session('status') }}
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif


                <div class="tabbable tabbable-tabdrop">

                    <form role="form" class="form-horizontal" id="newSearchForm" action="{{ route('PutSearchForm') }}" method="POST">
                    @csrf
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab11" data-toggle="tab">Step1 - Type</a>
                                            </li>
                                            <li>
                                                <a href="#tab12" data-toggle="tab">Step2 - Keyword</a>
                                            </li>
                                            <li>
                                                <a href="#tab13" data-toggle="tab">Step3 - Filters (Optional)</a>
                                            </li>
                                        </ul>

                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab11">

                                            STEP 1: CHOOSE TYPE OF SEARCH

                                                <div class="portlet-body form">

                                                        <div class="form-body">

                                                            <div class="form-group form-md-line-input">

                                                                <div class="col-md-10">
                                                                    <div class="md-radio-list">

                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radioKS" value="keyword_search" name="searchTypeOptions" class="md-radiobtn">
                                                                            <label for="radioKS">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> <b> Keyword Search </b> <br />
Monitor the Web and Social Media for a precise topic using logical expressions and search operators. Perform a market research in a minute! </label>
                                                                        </div>

                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radioBR" value="brand_reputation" name="searchTypeOptions" class="md-radiobtn">
                                                                            <label for="radioBR">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> <b>Brand Reputation </b> <br />
Monitor and explore the reputation of a brand - yours as well as your competitors. </label>
                                                                        </div>

                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radioPR" value="personal_reputation" name="searchTypeOptions" class="md-radiobtn">
                                                                            <label for="radioPR">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> <b> Personal Reputation </b> <br />
Monitor and explore the reputation of a person - designed for elections monitoring and constant personal PR. </label>
                                                                        </div>

                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radioLBR" value="local_business_reputation" name="searchTypeOptions" class="md-radiobtn">
                                                                            <label for="radioLBR">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> <b> Local Business Reputation </b> <br />
Designed for hotels, restaurants, medical clinics, dealers and every business that gets reviewed online. </label>
                                                                        </div>

                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radioTAM" value="twitter_account_metrics" name="searchTypeOptions" class="md-radiobtn">
                                                                            <label for="radioTAM">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> <b> Twitter Account Metrics </b> <br />
Follow the messages from and to given twitter account. Explore the number of followers and other influence metrics. Useful for campaign measurement. </label>
                                                                        </div>

                                                                        <div class="md-radio">
                                                                            <input type="radio" id="radioFPM" value="facebook_page_monitoring" name="searchTypeOptions" class="md-radiobtn">
                                                                            <label for="radioFPM">
                                                                                <span></span>
                                                                                <span class="check"></span>
                                                                                <span class="box"></span> <b> Facebook Page Monitoring </b> <br />
Follow the message from and to facebook pages. Explore the number of likes, comments and other influence metrics. Useful for campaign measurement. </label>
                                                                   </div>


                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>


                                                </div>


                                            </div>
                                            <div class="tab-pane" id="tab12">
                                            STEP 2: ADVANCED KEYWORDS

                                             <div id="keywordsearch">
                                                <br />
                                                <label>Search expression</label>
                                                <textarea class="form-control" rows="3" style="width:80%" name="search_keyword"></textarea>
                                                <br />

                                                <div class="form-body">

                                                           <div class="col-lg-12">

                                                            <div class="col-lg-2 col-md-4 col-xs-12">
                                                                <div class="mt-element-ribbon bg-grey-steel">
                                                                    <div class="ribbon ribbon-color-default">Phrase search:</div>
                                                                    <p class="ribbon-content">"Boris Johnson" </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-4 col-xs-12">
                                                                <div class="mt-element-ribbon bg-grey-steel">
                                                                <div class="ribbon ribbon-color-primary">Any of the words:</div>
                                                                <p class="ribbon-content">iPhone OR iPad </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-4 col-xs-12">
                                                                <div class="mt-element-ribbon bg-grey-steel">
                                                                <div class="ribbon ribbon-color-info">Personal Reputation:</div>
                                                                <p class="ribbon-content">  "Boris Johnson" OR "Mayor of London" </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-4 col-xs-12">
                                                                <div class="mt-element-ribbon bg-grey-steel">
                                                                <div class="ribbon ribbon-color-success"> Word proximity:</div>
                                                                <p class="ribbon-content"> "apple iphone"~10 </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-2 col-md-4 col-xs-12">
                                                                    <div class="mt-element-ribbon bg-grey-steel">
                                                                    <div class="ribbon ribbon-color-warning">  Word sets: </div>
                                                                    <p class="ribbon-content"> (iphone OR ipad) AND (promotion OR discount OR sale)  </p>
                                                                    </div>
                                                                </div>

                                                            </div>



                                                    </div>

                                             </div>

                                             <div id="brandreputation">
                                                 <br />
                                                             <div class="form-group col-lg-5">
                                                                 <label class="control-label">Exact name of the brand, product or trade mark:</label>
                                                                 <input type="text" id="brandreputation_input" class="form-control">
                                                                 <span class="help-block"> Enter the exact name of brand, person, product or trade mark </span>
                                                             </div>

                                             </div>

                                             <div id="personalreputation">
                                             <br />
                                                             <div class="form-group col-lg-5">
                                                                 <label class="control-label">Exact name of the person:</label>
                                                                 <input type="text" id="brandreputation_input" class="form-control">
                                                                 <span class="help-block"> Exact name of the person: </span>
                                                             </div>

                                             </div>

                                             <div id="localbusinessreputation">
                                             <br />
                                                             <div class="form-group col-lg-5">
                                                                 <label class="control-label">Name of the business opening:</label>
                                                                 <input type="text" id="brandreputation_input" class="form-control">
                                                                 <span class="help-block">Enter the name of the opening: </span>
                                                             </div>

                                             </div>

                                             <div id="twitteraccountmetrics">
                                             <br />
                                                             <div class="form-group col-lg-5">
                                                                 <label class="control-label">Twitter account to monitor:</label>
                                                                 <input type="text" id="brandreputation_input" class="form-control">
                                                                 <span class="help-block">Enter the Twitter account name to monitor. </span>
                                                             </div>

                                             </div>

                                             <div id="facebookpagemonitoring">
                                             <br />
                                                             <div class="form-group col-lg-5">
                                                                 <label class="control-label">Facebook page to monitor:</label>
                                                                 <input type="text" id="brandreputation_input" class="form-control">
                                                                 <span class="help-block">Enter the name of the Facebook page to monitor or its URL. </span>
                                                             </div>

                                             </div>

                                             <div class="col-lg-10">
                                                    <button type="button" class="btn default" id="btnBackSearchType">Back</button>
                                                    <button type="button" class="btn blue" id="btnNextFilter">Next</button>


                                             </div>

                                            </div>

                                            <div class="tab-pane" id="tab13">
                                            STEP 3: ADD FILTERS (OPTIONAL)

                                                <div id="searchFilters">
                                                    <div class="col-md-9">
                                                        <div class="md-checkbox-list">

                                                            <div class="md-checkbox">
                                                                <input type="checkbox" name="checkboxes1[]" value="1" id="checkbox1_1" class="md-check" checked>
                                                                <label for="checkbox1_1">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Twitter </label>
                                                            </div>
                                                            <div class="md-checkbox">
                                                                <input type="checkbox" name="checkboxes1[]" value="2" id="checkbox1_2" class="md-check" checked>
                                                                <label for="checkbox1_2">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Facebook </label>
                                                            </div>
                                                            <div class="md-checkbox">
                                                                <input type="checkbox" name="checkboxes1[]" value="3" id="checkbox1_211" class="md-check" checked>
                                                                <label for="checkbox1_211">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Images </label>
                                                            </div>

                                                            <div class="md-checkbox">
                                                                <input type="checkbox" name="checkboxes1[]" value="3" id="checkbox1_211" class="md-check" checked>
                                                                <label for="checkbox1_211">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> Videos </label>
                                                            </div>

                                                            <div class="md-checkbox">
                                                                <input type="checkbox" name="checkboxes1[]" value="3" id="checkbox1_211" class="md-check" checked>
                                                                <label for="checkbox1_211">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> New and Blogs </label>
                                                            </div>

                                                            <div class="md-checkbox">
                                                                <input type="checkbox" name="checkboxes1[]" value="3" id="checkbox1_211" class="md-check" checked>
                                                                <label for="checkbox1_211">
                                                                    <span class="inc"></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span> The Web </label>
                                                            </div>

                                                        </div>
                                                    </div>

                                               </div>

                                               <div id="searchFilters_limitlang">

                                               <div class="form-group col-lg-5">
                                                   <br />
                                                    <label>Limit to languages:</label>
                                                    <select class="form-control col-lg-10">
                                                        <option>Any Language</option>
                                                        <option>Option 2</option>
                                                        <option>Option 3</option>
                                                        <option>Option 4</option>
                                                        <option>Option 5</option>
                                                    </select>
                                                </div>
                                               </div>

                                               <div class="col-lg-10">
                                                   <br />
                                                   <div class="clearfix">
                                                    <button type="button" class="btn default" id="btnBackStep2">Back</button>
                                                   <!-- <button type="button" class="btn blue" id="btnFormSubmit">Search </button> -->

                                                    <button id="btnFormSubmit type="button" data-loading-text="Loading..." class="btn blue mt-ladda-btn ladda-button mt-progress-demo" data-style="slide-right">
                                                    <span class="ladda-label">Search Now!</span>
                                                <span class="ladda-spinner"></span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 115px;"></div></button>
                                                </div>
                                                </div>

                                            </div>


                                        </div>


                        </div>

                        </form>
    </div>
</div>

@endsection
