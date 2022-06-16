<div class="card">
    <div class="card-body p-1">
        <div class="row p-1">
            &#160;
        </div>
        <div class="row p-0">
            <div class="bg-orange">
                <p class="h4 text-header">{!! !empty($reportTemplates['HEADER_TXT_PG5']) ? strtoupper($reportTemplates['HEADER_TXT_PG5']) : 'KEY MANAGEMENT' !!} </p>
            </div>
        </div>
        <div>
            <p class="text-justify">
                <p class="">
                  {!! !empty($reportTemplates['SUBHEADER_TXT_PG5']) ? ucfirst($reportTemplates['SUBHEADER_TXT_PG5']) : 'Variable [SUBHEADER_TXT_PG5] does not exist' !!}
                </p>
            </p>
        </div>
        <div class=" p-0">
          @foreach($keyPersons as $keyp)
            <table class="table table-sm table-bordered " >
              <tbody>
                <tr>
                  <td scope="row">Name</th>
                  <td colspan="2">{{ $keyp->last_name }}, {{ $keyp->first_name }}</td>
                </tr>
                <tr>
                  <td scope="row">Identity Number:</th>
                  <td colspan="2">{{ $keyp->idn_passport }}</td>
                </tr>
                <tr>
                  <td scope="row">Shareholder %:</th>
                  <td colspan="2">Limited Liability Company</td>
                </tr>
                <tr>
                  <td scope="row">Directorship:</th>
                  <td colspan="2">{{ $keyp->is_directorship }}</td>
                </tr>
                <tr>
                  <td scope="row">Position </th>
                  <td colspan="2">{{ $keyp->position }}</td>
                </tr>
              </tbody>
            </table>
          <br>
        @endforeach
        </div>
    </div>
</div>
