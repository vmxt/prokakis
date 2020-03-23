<div class="card">
  <div class="card-body p-0">
    <div class="row p-0">
      <div class="bg-orange">
        <p class="h2 text-header">  {!! !empty($reportTemplates['HEADER_TXT_PG6']) ? strtoupper($reportTemplates['HEADER_TXT_PG6']) : 'Variable [HEADER_TXT_PG6] does not exist' !!}</p>
      </div>
    </div>
    <div>
      <p class="text-justify">
        <small class="text-muted">
        {!! !empty($reportTemplates['SUBHEADER_TXT_PG6']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG6']) : 'Variable [SUBHEADER_TXT_PG6] does not exist' !!}
        </small>
      </p>
    </div>
    <div class=" p-0">
      <table class="table table-sm table-bordered" >
        <thead>
          <tr>
            <th>Currency</th>
            <th>Singapore Dollars</th>
            <th>Singapore Dollars</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Year of Establishment:</td>
            <td>1 - 5 years</td>
            <td>1 - 5 years</td>
          </tr>
          <tr>
            <td>No of Staffs:</td>
            <td>4 - 10 persons</td>
            <td>Gross Profit</td>
          </tr>
          <tr>
            <td>Gross Profit or Gross Loss</td>
            <td>Gross Profit</td>
            <td>Gross Profit</td>
          </tr>
          <tr>
            <td>Net Profit or Gross Loss</td>
            <td>Net Loss</td>
            <td>Net Profit</td>
          </tr>
          <tr>
            <td>Annual Return Filling Rating</td>
            <td>Yes but late</td>
            <td>Yes on time</td>
          </tr>
          <tr>
            <td>Solvent or insolvent</td>
            <td>Solvent</td>
            <td>Solvent</td>
          </tr>
          <tr>
            <td>Paid Up Capital</td>
            <td>Above $5,000</td>
            <td>Above $5,000</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="row p-1">
      <p class="h5">Award(s):</p>
    </div>
    <div class="row p-0">
        @foreach($profileCertifications as $aw)
              <img class='img-fluid' src="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" style='width:100%;' border="1" alt="Null" />
          @endforeach
    </div>

@if( !empty($data['COMP_STRENGTHS']) )
    <div class="row p-1">
      <p class="h5">Strength(s):</p>
    </div>
    <div class="row p-0">
        <div>{{ $data['COMP_STRENGTHS'] }}</div>
    </div>
@endif


  </div>
</div>