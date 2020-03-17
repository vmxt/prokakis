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
               

                    @if(isset($topic_data))
                      @foreach ($topic_data as $d) 

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

                                    <div class="widget-thumb widget-bg-color-black text-uppercase">

                                     <a target="_blank" href="https://twitter.com/{{ $d->screen_name }}/status/{{ $d->t_id }}">    <h4 > {{ $d->description }} </h4>

                                         <h5> {{ $d->t_text }} </h5>  </a>

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

               


                        </tbody>
                    </table>

            </div>
        </div>

    </div>
</div>

@endsection
