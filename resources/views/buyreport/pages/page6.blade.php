
<div class="card">
  <div class="card-body p-1">
    <div class="row p-1">
        &#160;
    </div>
    <div class="row p-0">
      <div class="bg-orange">
        <p class="h4 text-header">  {!! !empty($reportTemplates['HEADER_TXT_PG6']) ? strtoupper($reportTemplates['HEADER_TXT_PG6']) : 'COMPANY INFORMATION' !!}</p>
      </div>
    </div>
    <div>
      <p class="text-justify">
        <p class="">
        {!! !empty($reportTemplates['SUBHEADER_TXT_PG6']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG6']) : 'Variable [SUBHEADER_TXT_PG6] does not exist' !!}
        </p>
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


@if(!empty($profileCertifications))

    <div class="row p-1">
      <p class="h5">Award(s):</p>
    </div>
        @foreach($profileCertifications as $aw)
            <div class="card p-1" style="border:1px solid black">
                  <img class='img-fluid' src="{{ asset('public/uploads/') }}/<?php echo $aw[1]; ?>" style='width:100%; padding-top: 80px;max-height:100% !important' border="1" alt="Null" />
            </div>
         @endforeach

@endif


@if( !empty($data['COMP_STRENGTHS']) )
 <!--<div class="page-break">
    <div class="row p-2">
      <p class="h5"><b>Strength(s):</b></p>
    </div>
    <div class="row p-3">
        <div>{{ $data['COMP_STRENGTHS'] }}</div>
    </div>
    </div>-->
@endif

</div>