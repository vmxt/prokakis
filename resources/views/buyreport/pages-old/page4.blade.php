<div class="card">
    <div class="card-body p-0">
        <div class="row p-0">
            <div class="bg-orange">
                <p class="h2 text-header"> {!! !empty($reportTemplates['HEADER_TXT_PG4']) ? strtoupper($reportTemplates['HEADER_TXT_PG4']) : 'Variable [HEADER_TXT_PG4] does not exist' !!}</p>
            </div>
        </div>
        <div>
            <p class="text-justify">
                <small class="text-muted">
                 {!! !empty($reportTemplates['HEADER_TXT_PG4']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG4']) : 'Variable [HEADER_TXT_PG4] does not exist' !!}
                </small>
            </p>
        </div>
        <div class="row p-5">
            <table class="table table-sm table-bordered">
              <tbody>
                <tr>
                  <th scope="row">Company</th>
                  <td colspan="2">{{ strtoupper($data['COMP_NAME']) }}</td>
                </tr>
                <tr>
                  <th scope="row">Registration Number:</th>
                  <td colspan="2">{{ strtoupper($data['COMP_REGISTRATION_NUMBER']) }}</td>
                </tr>
                <tr>
                  <th scope="row">Business Type</th>
                  <td colspan="2">{{ strtoupper($data['COMP_BUSSINESS_TYPE']) }}</td>
                </tr>
                <tr>
                  <th scope="row">Address</th>
                  <td colspan="2">{{ strtoupper($data['COMP_ADDRESS']) }}</td>
                </tr>
                <tr>
                  <th scope="row">Industry Type: </th>
                  <td colspan="2">{{ strtoupper($data['COMP_INDUSTRY_TYPE']) }}</td>
                </tr>
                <tr>
                  <th scope="row">E-Mail:</th>
                  <td colspan="2"><a href="#">{{ strtoupper($data['COMP_EMAIL']) }}</a></td>
                </tr>
                <tr>
                  <th scope="row">Website</th>
                  <td colspan="2"><a href="#">{{ strtoupper($data['COMP_WEBSITE']) }}</a></td>
                </tr>
                <tr>
                  <th scope="row">Office Phone:</th>
                  <td colspan="2">{{ strtoupper($data['COMP_OFFICE_PHONE']) }}</td>
                </tr>
                <tr>
                  <th scope="row">Mobile Phone: </th>
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
