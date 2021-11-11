
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

<div class="card">

  <div class="card-body p-0">

    <div class="row p-0">

      <div class="bg-orange">

        <p class="h2 text-header">{!! !empty($reportTemplates['HEADER_TXT_PG8']) ? strtoupper($reportTemplates['HEADER_TXT_PG8']) : 'Variable [HEADER_TXT_PG8] does not exist' !!}</p>

      </div>

    </div>

    <div>

      <p class="text-justify">

        <small class="text-muted">

         {!! !empty($reportTemplates['SUBHEADER_TXT_PG7']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG7']) : 'Variable [SUBHEADER_TXT_PG7] does not exist' !!}

        </small>

      </p>

    </div>


@if(sizeof($tr_peps) == 0)

<p>World-Checks Analysis: There is no indication that the company or the members of the company is in breach of
FATF regulation as at {{ $tr_inserted_date }}.</p>  

@endif
	
@if(sizeof($tr_peps) > 0)
     
      <p>World-Checks Analysis: There is indication that the company or the members of the company is in breach of
FATF regulation as at {{ $tr_inserted_date }}.</p>  

  @foreach( $tr_peps as $data )
  <div class="row p-1">
  <table class="table table-sm table-bordered">
    <thead>
      <tr>
        <th width="30%">Attribute</th>
        <th width="70%">Result</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">First Name: </th>
        <td colspan="2">{{ strtoupper( isset($data['FIRST_NAME'])?$data['FIRST_NAME']:'N/A' ) }}</td>
      </tr>
      <tr>
        <th scope="row">Last Name: </th>
        <td colspan="2">{{ strtoupper( isset($data['LAST_NAME'])?$data['LAST_NAME']:'N/A' ) }}</td>
      </tr>
      <tr>
        <th scope="row">Companies: </th>
        <td colspan="2">{{ strtoupper( isset($data['COMPANIES'])?$data['COMPANIES']:'N/A' ) }}</td>
      </tr>
      <tr>
        <th scope="row"> Aliases: </th>
        <td colspan="2">{{ strtoupper( isset($data['ALIASES'])?$data['ALIASES']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Category: </th>
        <td colspan="2">{{ strtoupper(isset($data['CATEGORY'])?$data['CATEGORY']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Title:</th>
        <td colspan="2"><a href="#">{{ strtoupper(isset($data['TITLE'])?$data['TITLE']:'N/A') }}</a></td>
      </tr>
      <tr>
        <th scope="row">Gender</th>
        <td colspan="2"><a href="#">{{ strtoupper( isset($data['GENDER'])?$data['GENDER']:'N/A' ) }}</a></td>
      </tr>
      <tr>
        <th scope="row">Position:</th>
        <td colspan="2">{{ strtoupper(isset($data['POSITION'])?$data['POSITION']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">DOB: </th>
        <td colspan="2">{{ strtoupper(isset($data['DOB'])?$data['DOB']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Locations: </th>
        <td colspan="2">{{ strtoupper(isset($data['LOCATIONS'])?$data['LOCATIONS']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Passport: </th>
        <td colspan="2">{{ strtoupper(isset($data['PASSPORTS'])?$data['PASSPORTS']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Citizenship: </th>
        <td colspan="2">{{ strtoupper(isset($data['CITIZENSHIP'])?$data['CITIZENSHIP']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Place of birth: </th>
        <td colspan="2">{{ strtoupper(isset($data['PLACE_OF_BIRTH'])?$data['PLACE_OF_BIRTH']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Companies: </th>
        <td colspan="2">{{ strtoupper(isset($data['COMPANIES'])?$data['COMPANIES']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Country Location: </th>
        <td colspan="2">{{ strtoupper(isset($data['LOCATIONS'])?$data['LOCATIONS']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Key Words: </th>
        <td colspan="2">{{ strtoupper(isset($data['KEYWORDS'])?$data['KEYWORDS']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">Further Information: </th>
        <td colspan="2">{{ strtoupper(isset($data['FURTHER_INFORMATION'])?$data['FURTHER_INFORMATION']:'N/A') }}</td>
      </tr>
      <tr>
        <th scope="row">External Sources: </th>
        <td colspan="2">{{ substr(strtoupper(isset($data['EXTERNAL_SOURCES'])?$data['EXTERNAL_SOURCES']:'N/A'), 0, 1000) }}</td>
      </tr>
    </tbody>
  </table>
</div>
  @endforeach
 @endif
    



  </div>

</div>