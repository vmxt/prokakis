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
                                <span>Search Results</span>
                            </li>
                        </ul>

                    </div>
@endsection

@section('content')

<div class="portlet-title">
    <div class="caption">
        <span class="caption-subject bold uppercase font-dark"> {{ $kw }} </span>
        <span class="caption-helper"> <?php ?></span>
    </div>
    <hr />
 </div>

<div class="container">

  
    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card">

                
                <div class="card-body">
                <table boder="1"  width="50%" id="result_summary" cellspacing="5">
                     <tr>
                    <td> <b> Total Records </b> </td>
                    <td>  <b>
                    <span style="color:green">{{ $senti_rs['total_records'] }}</span>
                    </b>
                    </td>
                    </tr>    

                    <tr>
                    <td> <b> Sentiments </b> </td>
                    <td>  <b>
                    negative: <span style="color:green">{{ $senti_rs['senti_negative'] }}</span>%,
                    positive: <span style="color:green">{{ $senti_rs['senti_positive'] }}</span>% and   
                    neutral:  <span style="color:green">{{ $senti_rs['senti_neutral'] }}</span>%  
                    </b>
                    </td>
                    </tr>

                    <tr>
                    <td colspan="2">  <hr />
                    </td>
                    </tr>

                    <tr>
                    <td> <b> Youtube </b> </td>
                    <td> 
                    <b> 
                     likes: <span style="color:green">{{ $senti_rs['total_likes_youtube'] }}</span>% and
                     dislikes: <span style="color:green">{{ $senti_rs['total_dislikes_youtube'] }}</span>%  
                    </b>
                    </td>
                    </tr>

                    
                    <tr>
                    <td colspan="2">  <hr />
                    </td>
                    </tr>
                   
                    <tr>
                    <td> <b> Gender:  </b> </td>
                    <td> 
                    <b> male: <span style="color:green">{{ $senti_rs['total_male'] }}</span>% 
                     female: <span style="color:green">{{ $senti_rs['total_female'] }}</span>% 
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
                    
                        @if(isset($gog_data))
                            @foreach ($gog_data as $d)

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


                    @if(isset($tw_data))
                      @foreach ($tw_data as $d) 

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

                        @if(isset($yt_data))
                            @foreach ($yt_data as $d)

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
