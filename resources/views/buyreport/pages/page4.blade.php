<div class="card">
    <div class="card-body p-1">
        <div class="row p-1">
            &#160;
        </div>
        <div class="row p-0">
            <div class="bg-orange">
                <p class="h4 text-header"> {!! !empty($reportTemplates['HEADER_TXT_PG4']) ? strtoupper($reportTemplates['HEADER_TXT_PG4']) : 'COMPANY OVERVIEW' !!}</p>
            </div>
        </div>
        <div>
            <p class="text-justify">
                <p class="">
                 {!! !empty($reportTemplates['HEADER_TXT_PG4']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG4']) : 'Variable [HEADER_TXT_PG4] does not exist' !!}
                </p>
            </p>
        </div>
        <div class="row p-5">
            <table class="table table-sm table-bordered">
              <tbody>
                <tr>
                  <td scope="row">Company</th>
                  <td colspan="2">{{ strtoupper($data['COMP_NAME']) }}</td>
                </tr>
                <tr>
                  <td scope="row">Registration Number:</th>
                  <td colspan="2">{{ strtoupper($data['COMP_REGISTRATION_NUMBER']) }}</td>
                </tr>
                <tr>
                  <td scope="row">Business Type</th>
                  <td colspan="2">{{ strtoupper($data['COMP_BUSSINESS_TYPE']) }}</td>
                </tr>
                <tr>
                  <td scope="row">Address</th>
                  <td colspan="2">{{ strtoupper($data['COMP_ADDRESS']) }}</td>
                </tr>
                <tr>
                  <td scope="row">Industry Type: </th>
                  <td colspan="2">{{ strtoupper($data['COMP_INDUSTRY_TYPE']) }}</td>
                </tr>
                <tr>
                  <td scope="row">E-Mail:</th>
                  <td colspan="2"><a href="#">{{ strtoupper($data['COMP_EMAIL']) }}</a></td>
                </tr>
                <tr>
                  <td scope="row">Website</th>
                  <td colspan="2"><a href="#">{{ strtoupper($data['COMP_WEBSITE']) }}</a></td>
                </tr>
                <tr>
                  <td scope="row">Office Phone:</th>
                  <td colspan="2">{{ strtoupper($data['COMP_OFFICE_PHONE']) }}</td>
                </tr>
                <tr>
                  <td scope="row">Mobile Phone: </th>
                  <td colspan="2">{{ strtoupper($data['COMP_MOBILE_PHONE']) }}</td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="row p-5">
            <div class="col-md-12">
                &#160;
            </div>
        </div>
        
    </div>
</div>
