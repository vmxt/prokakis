
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

        <tbody>
            <tr>
            <td>Currency</td>
            <td>{{ $company_data->currency }}</td>
          </tr>
          <tr>
            <td>Year of Establishment:</td>
            <td>{{ $company_data->years_establishment }}</td>
          </tr>
          <tr>
            <td>No of Staffs:</td>
            <td>{{ $company_data->no_of_staff }}</td>
          </tr>
          <tr>
            <td>Gross Profit or Gross Loss</td>
            <td>{{ $company_data->gross_profit }}</td>
          </tr>
          <tr>
            <td>Net Profit or Gross Loss</td>
            <td>{{ $company_data->net_profit }}</td>
          </tr>
          <tr>
            <td>Annual Return Filling Rating</td>
            <td>{{ $company_data->annual_tax_return }}</td>
          </tr>
          <tr>
            <td>Solvent or insolvent</td>
            <td>{{ $company_data->solvent_value }}</td>
          </tr>
          <tr>
            <td>Paid Up Capital</td>
            <td>{{ $company_data->paid_up_capital }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
    <div class="row p-1">
      <p class="h5">Award(s):</p>
    </div>

@if(!empty($profileCertifications))
        @foreach($profileCertifications as $aw)
            <div class="card p-2">
                  <img class='img-fluid' src="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" style='width:100%; padding-top: 100px;' border="1" alt="Null" />
            </div>
         @endforeach
@endif

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