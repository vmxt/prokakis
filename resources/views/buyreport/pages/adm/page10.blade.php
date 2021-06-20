<div class="card">

  <div class="card-body p-0">
   



    <div class=" p-3">

      <table class="table table-sm table-bordered" >

        <thead>

          <tr>

            <th>&#160;</th>

            <th>Negative</th>

            <th>Neutral</th>

            <th>Positive</th>
            

          </tr>

        </thead>

        <tbody>

          <tr>

            <td>Twitter:</td>

            <td>{{ $response_twitter['Likely_Match']['neg'] }}</td>

            <td>{{ $response_twitter['Likely_Match']['neu'] }}</td>

            <td>{{ $response_twitter['Likely_Match']['pos'] }}</td>
          </tr>

          
          <tr>

              <td>Google Search:</td>
  
              <td>{{ $response_theweb['Likely_Match']['neg'] }}</td>

              <td>{{ $response_theweb['Likely_Match']['neu']}}</td>
  
              <td>{{ $response_theweb['Likely_Match']['pos'] }}</td>
  
            </tr>

            <tr>

              <td>Youtube:</td>
  
              <td>{{ $response_youtube['Likely_Match']['neg'] }}</td>

              <td>{{ $response_youtube['Likely_Match']['neu'] }}</td>
  
              <td>{{ $response_youtube['Likely_Match']['pos'] }}</td>
  
            </tr>



        </tbody>

      </table>

    

    </div>
   

    <div class=" p-3">
      <p class="text-center h4">{{ $data['COMP_NAME'] }}</p>
      <p class="text-right h6"><small>2019 Feb 12 - 2019 Mar 15</small></p>
    </div>

    <div id="social_card">
      <h3> Twitter Likely Match </h3> <br />
      @if(!empty($response_twitter['Likely_Match']['rs_twit']))
       <?php $x = 0; ?>
    
          @foreach($response_twitter['Likely_Match']['rs_twit'] as $social_val)
          <?php $x++; ?>
              <div class=" card">
                <div class="card-body">
                  <table class="table social-table" >
                    <tbody>
                      <tr>
                        <td class='social-table1'>
        
                          <img src="{{ $social_val['profile_image_url'] }}" width="150px" alt="twitter_image">
        
                          <p ><small class="h6">{{ $social_val['name'] }}</small></p>
        
                          <p ><small class="h6">{{ $social_val['t_created_at'] }}</small></p>
        
                          <p class="content1-link h6"><a href="#"><small class="h6">{{ $social_val['url'] }}</small></a> </p>
        
                        </td>
        
                        <td class='social-table2'>
        
                            <a class="h6" href="{{ $social_val['t_expanded_url'] }}">{{ $social_val['t_expanded_url'] }}</a>
        
                            <p class="m-4 h6" >{{ $social_val['t_text'] }} </p>
        
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
      
              <?php if($x==50){ break; } ?>
        
          @endforeach

      @else
          <center><h5 color="red"><i> No result for Twitter </i> </h5></center>
      @endif
    </div>


    <div id="social_card">
      <h3> Youtube Likely Match </h3> <br />
    
      @if(!empty($response_youtube['Likely_Match']['rs_youtube']))
       <?php $x = 0; ?>
       
       @foreach( $response_youtube['Likely_Match']['rs_youtube'] as $social_val )
          <?php $x++; ?>
            <div class=" card">
              
              <div class="card-body">
      
                <table class="table social-table" >
      
                  <tbody>
      
                    <tr >
      
                      <td class='social-table1'>
      
                        <p >{{ $social_val['title'] }}</p>
      
                        <p ><small class="h6">{{ $social_val['description'] }}</small></p>
      
                        <p class="content1-link h6"><a href="{{ $social_val['video_link'] }}"><small class="h6">{{ $social_val['video_link'] }}</small></a> </p>
      
                      </td>
      
                    </tr>
      
                  </tbody>
      
                </table>
      
              </div>
      
            </div>
    
            <?php if($x==50){ break; } ?>
    
        @endforeach

      @else 
      <center><h5 color="red"> <i>No result for Youtube</i> </h5></center>
      @endif
    </div>

    <div id="social_card">
      <h3> Google Search Likely Match </h3> <br />
    
      @if(!empty($response_theweb['Likely_Match']['rs_google']))
       <?php $x = 0; ?>
       
       @foreach( $response_theweb['Likely_Match']['rs_google'] as $social_val )
          <?php $x++; ?>
            <div class=" card">
              
              <div class="card-body">
      
                <table class="table social-table" >
      
                  <tbody>
      
                    <tr >
      
                      <td class='social-table1'>
      
                        <p >{{ $social_val['title'] }}</p>
      
                        <p ><small class="h6">{{ $social_val['snippet'] }}</small></p>
      
                        <p class="content1-link h6"><a href="{{ $social_val['link'] }}"><small class="h6">{{ $social_val['link'] }}</small></a> </p>
      
                      </td>
      
                    </tr>
      
                  </tbody>
      
                </table>
      
              </div>
      
            </div>
    
            <?php if($x==50){ break; } ?>
    
        @endforeach

      @else 
      <center><h5 color="red"><i> No result for Google Search </i></h5></center>
      @endif
    </div>
    
    













