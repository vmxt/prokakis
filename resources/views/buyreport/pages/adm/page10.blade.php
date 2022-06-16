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

            <td>{{ $twitter_negative }}</td>

            <td>{{ $twitter_neutral }}</td>

            <td>{{ $twitter_positive }}</td>
          </tr>

          
          <tr>

              <td>Google Search:</td>
  
              <td>{{ $web_negative }}</td>

              <td>{{ $web_neutral }}</td>
  
              <td>{{ $web_positive }}</td>
  
            </tr>

            <tr>

              <td>Youtube:</td>
  
              <td>{{ $youtube_negative }}</td>

              <td>{{ $youtube_neutral }}</td>
  
              <td>{{ $youtube_positive }}</td>
  
            </tr>



        </tbody>

      </table>

    

    </div>
   

    <div class=" p-3">
      <p class="text-center text-header h3">{{ $data['COMP_NAME'] }}</p>
      <p class="text-right h6"><small>2019 Feb 12 - 2019 Mar 15</small></p>
    </div>

    <div id="social_card">
      <h4> Twitter Likely Match </h4> <br />
      @if(!empty($response['res_search']['tw_data']))
       <?php $x = 0; ?>
    
          @foreach($response['res_search']['tw_data'] as $social_val)
          <?php $x++; ?>
              <div class=" card">
                <div class="card-body">
                  <table class="table social-table" >
                    <tbody>
                      <tr>
                        <td class='social-table1'>
        
                          <img src="{{ $social_val['profile_image_url'] }}" width="150px" alt="twitter_image">
        
                          <p ><small class="h5">{{ $social_val['name'] }}</small></p>
        
                          <p ><small class="h5">{{ $social_val['t_created_at'] }}</small></p>
        
                          <p class="content1-link h6"><a href="#"><small class="h5">{{ $social_val['url'] }}</small></a> </p>
        
                        </td>
        
                        <td class='social-table2'>
        
                            <a class="h5" href="{{ $social_val['t_expanded_url'] }}">{{ $social_val['t_expanded_url'] }}</a>
        
                            <p class="m-4 h6" >{{ $social_val['t_text'] }} </p>
        
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
      
              <?php if($x==4){ break; } ?>
        
          @endforeach

      @else
          <center><h5 color="red"><i> No result for Twitter </i> </h5></center>
      @endif
    </div>


    <div id="social_card">
      <h4> Youtube Likely Match </h4> <br />
      @if(!empty($response['res_search']['yt_data']))
       <?php $x = 0; ?>
       
       @foreach( $response['res_search']['yt_data'] as $social_val )
          <?php $x++; ?>
            <div class=" card">
              
              <div class="card-body">
      
                <table class="table social-table" >
      
                  <tbody>
      
                    <tr >
      
                      <td class='social-table1'>
      
                        <p >{{ $social_val['title'] }}</p>
      
                        <p ><small class="h5">{{ $social_val['description'] }}</small></p>
      
                        <p class="content1-link h6"><a href="{{ $social_val['video_link'] }}"><small class="h5">{{ $social_val['video_link'] }}</small></a> </p>
      
                      </td>
      
                    </tr>
      
                  </tbody>
      
                </table>
      
              </div>
      
            </div>
    
            <?php if($x==4){ break; } ?>
    
        @endforeach

      @else 
      <center><h5 color="red"> <i>No result for Youtube</i> </h5></center>
      @endif
    </div>

    <div id="social_card">
      <h4> Google Search Likely Match </h4> <br />
    
      @if(!empty($response['res_search']['g_data']))
       <?php $x = 0; ?>
       
       @foreach( $response['res_search']['g_data'] as $social_val )
          <?php $x++; ?>
            <div class=" card">
              
              <div class="card-body">
      
                <table class="table social-table" >
      
                  <tbody>
      
                    <tr >
      
                      <td class='social-table1'>
      
                        <p >{{ $social_val['title'] }}</p>
      
                        <p ><small class="h5">{{ $social_val['snippet'] }}</small></p>
      
                        <p class="content1-link h6"><a href="{{ $social_val['link'] }}"><small class="h5">{{ $social_val['link'] }}</small></a> </p>
      
                      </td>
      
                    </tr>
      
                  </tbody>
      
                </table>
      
              </div>
      
            </div>
    
            <?php if($x==4){ break; } ?>
    
        @endforeach

      @else 
      <center><h5 color="red"><i> No result for Google Search </i></h5></center>
      @endif
    </div>
    
    












