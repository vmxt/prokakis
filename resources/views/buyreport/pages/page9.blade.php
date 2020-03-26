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