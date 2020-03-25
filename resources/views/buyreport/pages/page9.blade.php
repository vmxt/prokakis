<div class="card">
  <div class="card-body p-0">
    <div class="row p-0">
      <div class="bg-orange">
        <p class="h2 text-header">7.    {!! !empty($reportTemplates['HEADER_TXT_PG8']) ? strtoupper($reportTemplates['HEADER_TXT_PG8']) : 'Variable [HEADER_TXT_PG8] does not exist' !!}</p>
      </div>
    </div>
    <div>
      <p class="text-justify">
        <small class="text-muted">
         {!! !empty($reportTemplates['SUBHEADER_TXT_PG9']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG9']) : 'Variable [SUBHEADER_TXT_PG9] does not exist' !!}
        </small>
      </p>
    </div>
  

    <div class=" p-3">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>&#160;</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>EBOS Reputation:</td>
            <td>N.A.</td>
            <td>N.A.</td>
          </tr>
        </tbody>
      </table>
      <p>{{ ucfirst($reportTemplates['SUBCONTENT_PG9']) }}</p>
    </div>


    <div class=" p-3">
      <p>The resource of this report item is not Mentions Export for March 15, 2019 reachable</p>
    </div>

    <div class=" p-3">
      <p class="text-center h4">{{$data['COMP_NAME']}}</p>
      <p class="text-right h6"><small>2019 Feb 12 - 2019 Mar 15</small></p>
    </div>

  {{--   <div class=" p-3 ">
      <div class=" socialblock">
        <div class="social-block1"> 
          <div class="social-content1">
            <div class="p-3"> 
              <img src="{{ asset('public/img-resources/ProKakisNewLogo.png') }}" width="80px"></div>
            <div class="p-3">
              <p class="content1-days ">3 days </p>
              <p class="content1-link "><a href="#">sample.org</a> </p>
            </div>
            
          </div>
          <div class="social-content2">
            <div class="p-3"> 
                <a href="#">https://twitter.com/theGIIN/status/1105465317738856449</a>
            </div>
            <div class="p-3">
              <p>Former Blue Streak Breaks 4-Minute Mile, Saratoga Hospital Revisiting 2015               Expansion     Plan, Soil Cleanup, Road Closure
                to
                Continue Through June on Excelsior Ave. Spring Forward - Set Your Clocks Ahead 1 Hour on March 10th. https://t.co/
                OvSHgIolxA htt
 </p>

            </div>
            
          </div>
        </div>
      </div>
    </div> --}}

    {{-- <div class=" p-3">
      <div class="social-table">
        <table style="width:70%"> 
            <tr> 
                <th>Firstname</th> 
                <th>Lastname</th>  
                <th>Age</th> 
            </tr> 
            <tr> 
                <td>Harsh</td> 
                <td>Agarwal</td> 
                <td>15</td> 
            </tr> 
            <tr> 
                <td>Manas</td> 
                <td>Chhabra</td> 
                <td>27</td> 
            </tr> 
            <tr> 
                <td>Ramesh</td> 
                <td>Chandra</td> 
                <td>28</td> 
            </tr> 
        </table> 
      </div>
    </div> --}}

<div id="social_card">


@foreach( $response_twitter->rs_twit as $social_val )
    <div class=" card">
      <div class="card-body">
        <table class="table social-table" >
          <tbody>
            <tr >
              <td class='social-table1'>
                <img src="{{ $social_val->profile_image_url }}" width="150px" alt="twitter_image">
                <p ><small class="h6">{{ $social_val->name }}</small></p>
                <p ><small class="h6">{{ $social_val->t_created_at }}</small></p>
                <p class="content1-link h6"><a href="#"><small class="h6">{{ $social_val->url }}</small></a> </p>
              </td>
              <td class='social-table2'>
                  <a class="h6" href="{{ $social_val->t_expanded_url }}">{{ $social_val->t_expanded_url }}</a>
                  <p class="m-4 h6" >{{ $social_val->t_text }} </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
@endforeach
</div>


  </div>
</div>