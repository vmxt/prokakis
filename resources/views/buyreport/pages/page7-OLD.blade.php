<div class="card">
  <div class="card-body p-0">
    <div class="row p-0 ">
      <div class="bg-orange">
        <p class="h2 text-header">{!! !empty($reportTemplates['HEADER_TXT_PG7']) ? strtoupper($reportTemplates['HEADER_TXT_PG7']) : 'Variable [HEADER_TXT_PG7] does not exist' !!} </p>
      </div>
    </div>
    <div>
      <p class="text-justify">
        <small class="text-muted">
          {!! !empty($reportTemplates['SUBHEADER_TXT_PG7']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG7']) : 'Variable [SUBHEADER_TXT_PG7] does not exist' !!}
        </small>
      </p>
    </div>
    <div class="p-0">
      <small class="h6 text-muted"> {!! !empty($reportTemplates['TITLE1_TXT_PG7']) ? ucfirst($reportTemplates['TITLE1_TXT_PG7']) : 'Variable [TITLE1_TXT_PG7] does not exist' !!} </small>
      <p class="text-justify">
        <small class="text-muted">
        {!! !empty($reportTemplates['SUBTITLE1_TXT_PG7']) ? ucfirst($reportTemplates['SUBTITLE1_TXT_PG7']) : 'Variable [SUBTITLE1_TXT_PG7] does not exist' !!}
        </small>
      </p>
    </div>
    <div class="p-0">
      <small class="h6 text-muted">5.1.1 {{ strtoupper($reportTemplates['TITLE2_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {{ ucfirst($reportTemplates['SUBTITLE2_TXT_PG7']) }}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Receivable Turnover:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
          <tr>
            <td>Average Collection Period:</td>
            <td>N.A.</td>
            <td>7.30</td>
          </tr>
        </tbody>
      </table>
      <p>Consultants’ Analysis : Financial Statement Information obtained from June 2017</p>
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.1.2 {{ strtoupper($reportTemplates['TITLE3_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {{ ucfirst($reportTemplates['SUBTITLE3_TXT_PG7']) }}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Inventory Turnover:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
          <tr>
            <td>Days in Inventory:</td>
            <td>N.A.</td>
            <td>7.30</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.1.3 {{ strtoupper($reportTemplates['TITLE4_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {{ ucfirst($reportTemplates['SUBTITLE4_TXT_PG7']) }}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Payable Turnover:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
          <tr>
            <td>Average Payment Period:</td>
            <td>N.A.</td>
            <td>7.30</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="bg-orange">
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.2 {{ strtoupper($reportTemplates['TITLE5_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE5_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.2.1 {{ strtoupper($reportTemplates['TITLE6_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE6_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Net Working Capital:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.2.2 {{ strtoupper($reportTemplates['TITLE7_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE7_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Current Ratio:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.2.3 {{ strtoupper($reportTemplates['TITLE8_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE8_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Quick Ratio:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.3 {{ strtoupper($reportTemplates['TITLE9_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE9_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.3.1 {{ strtoupper($reportTemplates['TITLE10_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE10_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Debt to Equity:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.3.2 {{ strtoupper($reportTemplates['TITLE11_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE11_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Debt to Asset:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.3.3 {{ strtoupper($reportTemplates['TITLE12_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE12_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Interest Coverage:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.4 {{ strtoupper($reportTemplates['TITLE13_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE13_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.4.1 {{ strtoupper($reportTemplates['TITLE14_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE14_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Gross Profit Margin:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.4.2 {{ strtoupper($reportTemplates['TITLE15_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE15_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Gross Profit Margin:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.4.3 {{ strtoupper($reportTemplates['TITLE16_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE16_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Net Profit Margin:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>

    <div class="p-1">
      <small class="h6 text-muted">5.4.4 {{ strtoupper($reportTemplates['TITLE17_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE17_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Ratio of Investment:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
    <div class="p-1">
      <small class="h6 text-muted">5.4.5 {{ strtoupper($reportTemplates['TITLE18_TXT_PG7']) }}</small>
      <p class="text-justify">
        <small class="text-muted">
        {!! ucfirst($reportTemplates['SUBTITLE18_TXT_PG7']) !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Ratio</th>
            <th>Result</th>
            <th>Result</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Return of Equity:</td>
            <td>N.A.</td>
            <td>50</td>
          </tr>
        </tbody>
      </table>
      @include('buyreport.cosultantAnalysis')
    </div>
</div>
</div>