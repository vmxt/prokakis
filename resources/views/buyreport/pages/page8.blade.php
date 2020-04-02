<div class="card">

  <div class="card-body p-0">

    <div class="row p-0">

      <div class="bg-orange">

        <p class="h2 text-header">6.  {!! !empty($reportTemplates['HEADER_TXT_PG8']) ? strtoupper($reportTemplates['HEADER_TXT_PG8']) : 'Variable [HEADER_TXT_PG8] does not exist' !!}</p>

      </div>

    </div>

    <div>

      <p class="text-justify">

        <small class="text-muted">

         {!! !empty($reportTemplates['SUBHEADER_TXT_PG7']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG7']) : 'Variable [SUBHEADER_TXT_PG7] does not exist' !!}

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

            <td>Refinitiv (Thomson Reuters):</td>

            <td>N.A.</td>

            <td>50</td>

          </tr>

        </tbody>

      </table>
	
    </div>
	
      @if(sizeof($tr_peps) == 0){
      <p>World-Check�s Analysis: There is no indication that the company or the members of the company is in breach of
FATF regulation as at {{ $tr_inserted_date }}.</p>

      @else

      <p>World-Check�s Analysis: There is indication that the company or the members of the company is in breach of
FATF regulation as at {{ $tr_inserted_date }}.</p>  


  @foreach( $tr_peps as $data )
  <div class="row p-5">
  <table class="table table-sm table-bordered">
    <tbody>
      <tr>
        <th scope="row">First Name: </th>
        <td colspan="2">{{ strtoupper($data->FIRST_NAME) }}</td>
      </tr>
      <tr>
        <th scope="row">Last Name: </th>
        <td colspan="2">{{ strtoupper($data->LAST_NAME) }}</td>
      </tr>
      <tr>
        <th scope="row">Companies: </th>
        <td colspan="2">{{ strtoupper($data->COMPANIES) }}</td>
      </tr>
      <tr>
        <th scope="row"> Aliases: </th>
        <td colspan="2">{{ strtoupper($data->ALIASES) }}</td>
      </tr>
      <tr>
        <th scope="row">Category: </th>
        <td colspan="2">{{ strtoupper($data->CATEGORY) }}</td>
      </tr>
      <tr>
        <th scope="row">Title:</th>
        <td colspan="2"><a href="#">{{ strtoupper($data->TITLE) }}</a></td>
      </tr>
      <tr>
        <th scope="row">Gender</th>
        <td colspan="2"><a href="#">{{ strtoupper($data->GENDER) }}</a></td>
      </tr>
      <tr>
        <th scope="row">Position:</th>
        <td colspan="2">{{ strtoupper($data->POSITION) }}</td>
      </tr>
      <tr>
        <th scope="row">DOB: </th>
        <td colspan="2">{{ strtoupper($data->DOB) }}</td>
      </tr>
      <tr>
        <th scope="row">Locations: </th>
        <td colspan="2">{{ strtoupper($data->LOCATIONS) }}</td>
      </tr>
      <tr>
        <th scope="row">Passport: </th>
        <td colspan="2">{{ strtoupper($data->PASSPORTS) }}</td>
      </tr>
      <tr>
        <th scope="row">Citizenship: </th>
        <td colspan="2">{{ strtoupper($data->CITIZENSHIP) }}</td>
      </tr>
      <tr>
        <th scope="row">Place of birth: </th>
        <td colspan="2">{{ strtoupper($data->PLACE_OF_BIRTH) }}</td>
      </tr>
      <tr>
        <th scope="row">Companies: </th>
        <td colspan="2">{{ strtoupper($data->COMPANIES) }}</td>
      </tr>
      <tr>
        <th scope="row">Country Location: </th>
        <td colspan="2">{{ strtoupper($data->LOCATIONS) }}</td>
      </tr>
      <tr>
        <th scope="row">Key Words: </th>
        <td colspan="2">{{ strtoupper($data->KEYWORDS) }}</td>
      </tr>
      <tr>
        <th scope="row">Further Information: </th>
        <td colspan="2">{{ strtoupper($data->FURTHER_INFORMATION) }}</td>
      </tr>

      <tr>
        <th scope="row">External Sources: </th>
        <td colspan="2">{{ strtoupper($data->EXTERNAL_SOURCES) }}</td>
      </tr>
    </tbody>
  </table>
</div>
  @endforeach
 @endif
    



  </div>

</div>