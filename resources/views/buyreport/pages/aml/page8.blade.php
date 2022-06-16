
<style>

  table{
    table-layout: fixed;
  }       
  
  td.social-table1
  {
      max-width: 20%;
      overflow: wrap;
      word-wrap:break-word;
  
  }
  
  td.social-table2
  {
      max-width: 80%;
      overflow: wrap;
      word-wrap:break-word;
  
  }
    
  </style>

<div class="card" style="margin-top:10px">

  <div class="card-body p-0">

    <div class="row p-0">

      <div class="bg-orange">

        <p class="h2 text-header text-center"><b>{!! !empty($reportTemplates['HEADER_TXT_PG8']) ? strtoupper($reportTemplates['HEADER_TXT_PG8']) : 'Variable [HEADER_TXT_PG8] does not exist' !!}</b></p>

      </div>

    </div>

    <div>

      <p class="text-justify">

        <small class="">

         {!! !empty($reportTemplates['SUBHEADER_TXT_PG7']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG7']) : 'Variable [SUBHEADER_TXT_PG7] does not exist' !!}

        </small>

      </p>

    </div>


@if(sizeof($tr_peps) == 0)

<p class="text-justify"><b>World-Checks Analysis:</b> There is no indication that the company or the members of the company is in breach of
FATF regulation as at {{ $tr_inserted_date }}.</p>  

@endif
  
@if(sizeof($tr_peps) > 0)
     
      <p class="text-justify"><b>World-Checks Analysis:</b> There is indication that the company or the members of the company is in breach of
FATF regulation as at {{ $tr_inserted_date }}.</p>  
  <?php $i=0; ?>
  @foreach( $tr_peps as $data )

  <div class="row p-1">
  <table class="table table-sm table-bordered">
    <thead>
      <tr>
        <th width="30%">ATTRIBUTE</th>
        <th colspan="2" width="70%">RESULT</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td scope="row">First Name: </th>
        <td colspan="2">{{ strtoupper( isset($keyArrPersons[$i]['fname']) ? $keyArrPersons[$i]['fname'] : 'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Last Name: </th>
        <td colspan="2">{{ strtoupper( isset($keyArrPersons[$i]['lname']) ? $keyArrPersons[$i]['lname'] : 'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Companies: </th>
        <td colspan="2">{{ strtoupper( isset($data['Likely_Match'][0]['COMPANIES'])?$data['Likely_Match'][0]['COMPANIES']:'N/A' ) }}</td>
      </tr>
      <tr>
        <td scope="row"> Aliases: </th>
        <td colspan="2">{{ strtoupper( isset($data['Likely_Match'][0]['ALIASES'])?$data['Likely_Match'][0]['ALIASES']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Category: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['CATEGORY'])?$data['Likely_Match'][0]['CATEGORY']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Title:</th>
        <td colspan="2"><a href="#">{{ strtoupper(isset($data['Likely_Match'][0]['TITLE'])?$data['Likely_Match'][0]['TITLE']:'N/A') }}</a></td>
      </tr>
      <tr>
        <td scope="row">Gender</th>
        <td colspan="2"><a href="#">{{ strtoupper( isset($data['Likely_Match'][0]['GENDER'])?$data['Likely_Match'][0]['GENDER']:'N/A' ) }}</a></td>
      </tr>
      <tr>
        <td scope="row">Position:</th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['POSITION'])?$data['Likely_Match'][0]['POSITION']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">DOB: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['DOB'])?$data['Likely_Match'][0]['DOB']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Locations: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['LOCATIONS'])?$data['Likely_Match'][0]['LOCATIONS']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Passport: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['PASSPORTS'])?$data['Likely_Match'][0]['PASSPORTS']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Citizenship: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['CITIZENSHIP'])?$data['Likely_Match'][0]['CITIZENSHIP']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Place of birth: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['PLACE_OF_BIRTH'])?$data['Likely_Match'][0]['PLACE_OF_BIRTH']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Companies: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['COMPANIES'])?$data['Likely_Match'][0]['COMPANIES']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Country Location: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['LOCATIONS'])?$data['Likely_Match'][0]['LOCATIONS']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Key Words: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['KEYWORDS'])?$data['Likely_Match'][0]['KEYWORDS']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">Further Information: </th>
        <td colspan="2">{{ strtoupper(isset($data['Likely_Match'][0]['FURTHER_INFORMATION'])?$data['Likely_Match'][0]['FURTHER_INFORMATION']:'N/A') }}</td>
      </tr>
      <tr>
        <td scope="row">External Sources: </th>
        <td colspan="2">{{ substr(strtoupper(isset($data['Likely_Match'][0]['EXTERNAL_SOURCES'])?$data['Likely_Match'][0]['EXTERNAL_SOURCES']:'N/A'), 0, 1000) }}</td>
      </tr>
    </tbody>
  </table>
</div>
  <?php $i++; ?>
  @endforeach
 @endif
    



  </div>

</div>