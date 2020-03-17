@extends('layouts.mainDatatable')


@section('breadcrumbs')
<div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{ route('home') }}">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Mentions</span>
                            </li>
                        </ul>

                    </div>
@endsection

@section('content')

<div class="portlet-title">
    <div class="caption">
        <span class="caption-subject bold uppercase font-dark">    @if(isset($searchTypesSelected)) {{ $searchTypesSelected }}  @endif</span>
       <br /> <span class="caption-helper">  @if(isset($sm)) {{ $sm }}  @endif </span> 
       <!-- <div
  class="fb-like"
  data-share="true"
  data-width="450"
  data-show-faces="true">
</div> -->
        <form action="{{ route('ToSearchKeyword') }}" method="GET" id="searchKeywordsList">
        @csrf

        <input type="hidden" name="selected_sm" value="@if(isset($sm)) {{ $sm }}  @endif">
        <select name="search_keyword_selections" id="search_keyword_selections"  class="form-control" style="float:right; width:30%">
        <option value="">--Select a search keys--</option>
            @if(isset($rs_search_keywords))

                @foreach ($rs_search_keywords as $k)

                @if(isset($searchTypesSelected) && $searchTypesSelected == $k )
                <option selected value="{{ $k }}"> {{ $k }} </option>
                @else   
                <option value="{{ $k }}"> {{ $k }} </option>
                @endif   

                @endforeach
                
            @endif    

        </select>
        </form>

    </div>
    
    

    <hr />
 </div>

<div class="container">

  
    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card">

                
                <div class="card-body">
                <table width="50%" id="result_summary" cellpadding="5" cellspacing="2">


                <tr>
                    <td> <b> Total Records: </b> </td>
                    <td>  
                    <b> 
                    @if(isset($dataResult['total'])) <span style="color:green">{{ $dataResult['total'] }}</span>  @endif
                    </b>
                    </td>
                    </tr> 
                   
                    <tr>
                    <td> <b> Sentiment (negative / positive / neutral):</b> </td>
                    <td> 
                    <b> 
                    @if(isset($dataResult['neg'])) <span style="color:green">{{ $dataResult['neg'] }}</span>%  @endif / @if(isset($dataResult['pos'])) <span style="color:green">{{ $dataResult['pos'] }}</span>%  @endif / @if(isset($dataResult['neu'])) <span style="color:green">{{ $dataResult['neu'] }}</span>%  @endif 
                    </b>
                    </td>
                    </tr>

                       
                    <tr>
                    <td> <b> Reach (est) </b> </td>
                    <td>  
               
                    </td>
                    </tr>

                    
                    <tr>
                    <td colspan="2">  <hr /> 
                    </td>
                    </tr>

                    <tr>
                    <td> <b> Trend:  </b> </td>
                    <td> 
                    <b>
                    </b> 
                    </td>
                    </tr>
                   
                    <tr>
                    <td> <b> Gender (male / female):  </b> </td>
                    <td> 
                    <b> 
                    @if(isset($dataResult['totalMale'])) <span style="color:green">{{ $dataResult['totalMale'] }}</span>%  @endif /
                    @if(isset($dataResult['totalFemale'])) <span style="color:green">{{ $dataResult['totalFemale'] }}</span>%  @endif
                    </b> 
                    </td>
                    </tr>
                    

                </table>
                </div>

<br />



    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" cellspacing="0" width="70%">
                    <thead>
                                            <tr>
                                                <th>  
                                                </th>

                                                <th> 
                                                </th>
                                                
                                            </tr>
                    </thead>

                    <tbody>

                    @if(isset($dataResult['rs_google']))
                            @foreach ($dataResult['rs_google'] as $d)

                            <tr>
                            <td>
                               
                            </td>
                           
                            <td>
                            <div class="portlet box yellow margin-right-70">
                                <div class="portlet-title">
                                    <div class="caption">
                                    <i class="fa fa-google"></i>Google </div>
                                    <div class="tools"> </div>
                                </div>

                                 <div class="portlet-body">

                                <div class="widget-thumb widget-bg-color-white text-uppercase">

                                    <h4 class="widget-thumb-heading"> {{ $d->title }} </h4>
                                    <div class="widget-thumb-wrap">

                                    <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle"> {{!! $d->html_snippet !!}} </span>
                                   
                                    </div>

                                    <img src="{{ $d->pagemap_cse_thumbnail_src }}" alt="item image" width="48" height="48" title=""> 
    
                                        <div class="widget-thumb-body" style="width:30%">
                                            <span class="widget-thumb-subtitle"><a target="_blank" href="{{ $d->link }}"> {{ $d->link }}</a> </span>
                                        </div>

                                    </div>
                                  </div>
                                </div>
                             </div>

                            </td>
                        </tr>
                     @endforeach
                    @endif  

                    @if(isset($dataResult['rs_twit']))
                      @foreach ($dataResult['rs_twit'] as $d) 

                      <tr>
                        <td>
                       
                        </td>
                    
                        <td>

                            <div class="portlet box green margin-right-70">
                                <div class="portlet-title">
                                    
                                    <div class="caption">
                                    <i class="fa fa-twitter"></i>Twitter
                                    </div>

                                
                                </div>

                                <div class="portlet-body">

                                    <div class="widget-thumb widget-bg-color-white text-uppercase">

                                        <h4 class="widget-thumb-heading"> {{ $d->t_text }} </h4>

                                        <div class="widget-thumb-wrap">
                                        @include('managesearch.stars') 

                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"> {{ $d->t_created_at }} </span>
                                            </div>

                                        <img src="{{ $d->profile_image_url }}" alt="profile" width="48" height="48" title="">

                                            <div class="widget-thumb-body">
                                                <span class="widget-thumb-subtitle"> {{ $d->name }} </span>
                                                <span><i class="icon fa-rss"></i> {{ $d->friends_count }} / {{ $d->followers_count }} </span>

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </td>
                        </tr>
                            @endforeach
                        @endif


                        @if(isset($dataResult['rs_youtube']))
                      @foreach ($dataResult['rs_youtube'] as $d) 

                      <tr>
                            <td>
                               
                            </td>
                           
                            <td>
                            <div class="portlet box red margin-right-70">
                                <div class="portlet-title">
                                    <div class="caption">
                                    <i class="fa fa-youtube"></i>Youtube </div>
                                    <div class="tools"> </div>
                                </div>

                                 <div class="portlet-body">

                                <div class="widget-thumb widget-bg-color-white text-uppercase">

                                    <h4 class="widget-thumb-heading"> {{ $d->title }} </h4>
                                    <div class="widget-thumb-wrap">

                                    <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle"> {{ $d->description }} </span>
                                            <span class="widget-thumb-subtitle"> {{ $d->published_at }} </span>
                                 
                                    </div>

                                        <div class="col-sm-3"><iframe id="iframe" style="width:100%;height:25%" src="//www.youtube.com/embed/{{ $d->video_id }}"
data-autoplay-src="//www.youtube.com/embed/{{ $d->video_id }}?autoplay=1" allowfullscreen="allowfullscreen"></iframe></div>   
    

                                        <div class="widget-thumb-body">
                                            <span class="widget-thumb-subtitle">Views: {{ $d->views }} </span>
                                            <span class="widget-thumb-subtitle">Likes: {{ $d->likes }} </span>
                                            <span class="widget-thumb-subtitle">Dislikes: {{ $d->dislikes }} </span>
                                            <span class="widget-thumb-subtitle"><a target="_blank" href="{{ $d->video_link }}"> {{ $d->video_link }}</a> </span>
                                            
                                        </div>

                                    </div>
                                  </div>
                                </div>
                             </div>

                            </td>
                        </tr>
                      
                            @endforeach
                        @endif
                    
                    

                    </tbody>
    </table>

            </div>
        </div>

    </div>
</div>

@endsection
