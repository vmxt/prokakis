<div class="card">
  <div class="card-body p-1">
    <div class="row p-1">
        &#160;
    </div>
    <div class="row p-0 ">
      <div class="bg-orange">
        <p class="h4 text-header">{!! !empty($reportTemplates['HEADER_TXT_PG7']) ? strtoupper($reportTemplates['HEADER_TXT_PG7']) : 'Variable [HEADER_TXT_PG7] does not exist' !!} </p>
      </div>
    </div>
    <div>
      <p class="text-justify">
        <small class="">
          {!! !empty($reportTemplates['SUBHEADER_TXT_PG7']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG7']) : 'Variable [SUBHEADER_TXT_PG7] does not exist' !!}
        </small>
      </p>
    </div>
    <div class="p-0">
      <small class="h6 "> {!! !empty($reportTemplates['TITLE1_TXT_PG7']) ? ucfirst($reportTemplates['TITLE1_TXT_PG7']) : 'Variable [TITLE1_TXT_PG7] does not exist' !!} </small>
      <p class="text-justify">
        <small class="">
        {!! !empty($reportTemplates['SUBTITLE1_TXT_PG7']) ? ucfirst($reportTemplates['SUBTITLE1_TXT_PG7']) : 'Variable [SUBTITLE1_TXT_PG7] does not exist' !!}
        </small>
      </p>
    </div>
    <div class="p-0">
      <small class="h6 ">5.1.1 {{ strtoupper($reportTemplates['TITLE2_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {{ ucfirst($reportTemplates['SUBTITLE2_TXT_PG7']) }}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>

            @if(sizeof($MONTH_RATIO) > 0)
              @foreach($MONTH_RATIO as $data )
              <th>{{ $data }}</th>
              @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Receivable Turnover:</td>

            @if(sizeof($MONTH_RATIO) > 0)
              @foreach($MONTH_RATIO as $data )
              <td>{{ $RT[$data] }}</td>
              @endforeach
            @endif

          </tr>
          <tr>
            <td>Average Collection Period:</td>

            @if(sizeof($MONTH_RATIO) > 0)
              @foreach($MONTH_RATIO as $data )
              <td>{{ $ACP[$data] }}</td>
              @endforeach
            @endif
        

          </tr>
        </tbody>
      </table>
    </div>
    <div class="p-1">
        <div class="p-1">
          &#160;
        </div>
      <p>Consultants’ Analysis : Financial Statement Information obtained from June 2017</p>
      <small class="h6 ">5.1.2 {{ strtoupper($reportTemplates['TITLE3_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {{ ucfirst($reportTemplates['SUBTITLE3_TXT_PG7']) }}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            

            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Inventory Turnover:</td>

            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $IT[$data] }}</td>
            @endforeach
            @endif
       
          </tr>
          <tr>
            <td>Days in Inventory:</td>
         
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $DII[$data] }}</td>
            @endforeach
            @endif

          </tr>
        </tbody>
      </table>
 
    </div>
    <div class="p-1">
      <small class="h6 ">5.1.3 {{ strtoupper($reportTemplates['TITLE4_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {{ ucfirst($reportTemplates['SUBTITLE4_TXT_PG7']) }}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
           
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Payable Turnover:</td>
            
            
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $PT[$data] }}</td>
            @endforeach
            @endif


          </tr>
          <tr>
            <td>Average Payment Period:</td>
           
             
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $APP[$data] }}</td>
            @endforeach
            @endif

          </tr>
        </tbody>
      </table>
  
    </div>
    <div class="bg-orange">
    </div>
    <div class="p-1">
      <small class="h6 ">5.2 {{ strtoupper($reportTemplates['TITLE5_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE5_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class="row p-1">
        &#160;
    </div>
    <div class="p-1">
      <small class="h6 ">5.2.1 {{ strtoupper($reportTemplates['TITLE6_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE6_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>

            @if(sizeof($MONTH_RATIO) > 0)
              @foreach($MONTH_RATIO as $data )
              <th>{{ $data }}</th>
              @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Net Working Capital:</td>
        
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $NWP[$data] }}</td>
            @endforeach
            @endif

          </tr>
        </tbody>
      </table>
    
    </div>
    <div class="p-1">
      <small class="h6 ">5.2.2 {{ strtoupper($reportTemplates['TITLE7_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE7_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
           
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
           @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Current Ratio:</td>

            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $CR[$data] }}</td>
            @endforeach
            @endif
            
          </tr>
        </tbody>
      </table>

    </div>
    <div class="p-1">
      <small class="h6 ">5.2.3 {{ strtoupper($reportTemplates['TITLE8_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE8_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
           @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Quick Ratio:</td>
           
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $QR[$data] }}</td>
            @endforeach
            @endif
           
          </tr>
        </tbody>
      </table>
  
    </div>
    <div class="row p-2">
        &#160;
    </div>
    <div class="p-1">
      <small class="h6 ">5.3 {{ strtoupper($reportTemplates['TITLE9_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE9_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class="p-1">
      <small class="h6 ">5.3.1 {{ strtoupper($reportTemplates['TITLE10_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE10_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>

            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
           @endif
           
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Debt to Equity:</td>
            
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $DTE[$data] }}</td>
            @endforeach
            @endif
            
          </tr>
        </tbody>
      </table>
   
    </div>
    <div class="p-1">
      <small class="h6 ">5.3.2 {{ strtoupper($reportTemplates['TITLE11_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE11_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
           
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Debt to Asset:</td>
       
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $DTA[$data] }}</td>
            @endforeach
            @endif
            
            
          </tr>
        </tbody>
      </table>

    </div>
    <div class="p-1">
      <small class="h6 ">5.3.3 {{ strtoupper($reportTemplates['TITLE12_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE12_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
          
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Interest Coverage:</td>
          
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $IC[$data] }}</td>
            @endforeach
            @endif

          </tr>
        </tbody>
      </table>
  
    </div>
    <div class="p-1">
      <small class="h6 ">5.4 {{ strtoupper($reportTemplates['TITLE13_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE13_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class="p-1">
      <small class="h6 ">5.4.1 {{ strtoupper($reportTemplates['TITLE14_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE14_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Gross Profit Margin:</td>
        
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $GPM[$data] }}</td>
            @endforeach
            @endif

          </tr>
        </tbody>
      </table>
    
    </div>
    <div class="p-1">
      <small class="h6 ">5.4.2 {{ strtoupper($reportTemplates['TITLE15_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE15_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Operating Profit Margin:</td>
           
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $OPM[$data] }}</td>
            @endforeach
            @endif

          </tr>
        </tbody>
      </table>
     
    </div>
    <div class="p-1">
      <small class="h6 ">5.4.3 {{ strtoupper($reportTemplates['TITLE16_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE16_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
          
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Net Profit Margin:</td>

            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $NPM[$data] }}</td>
            @endforeach
            @endif
        
          </tr>
        </tbody>
      </table>
  
    </div>

    <div class="p-1">
      <small class="h6 ">5.4.4 {{ strtoupper($reportTemplates['TITLE17_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE17_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
           
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Ratio of Investment:</td>
            
            
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $ROI[$data] }}</td>
            @endforeach
            @endif

          </tr>
        </tbody>
      </table>
     
    </div>
    <div class="p-1">
      <small class="h6 ">5.4.5 {{ strtoupper($reportTemplates['TITLE18_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="">
        {!! ucfirst($reportTemplates['SUBTITLE18_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <th>{{ $data }}</th>
            @endforeach
            @endif

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Return of Equity:</td>
           
            @if(sizeof($MONTH_RATIO) > 0)
            @foreach($MONTH_RATIO as $data )
            <td>{{ $ROE[$data] }}</td>
            @endforeach
            @endif

          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
</div>
</div>