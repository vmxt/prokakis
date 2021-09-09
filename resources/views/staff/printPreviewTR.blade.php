
@extends('layouts.appTR')
@section('content')

<style>

table{
  table-layout: fixed;
}       

td.social-table1
{
    max-width: 30%;
    overflow: wrap;
    word-wrap:break-word;

}

td.social-table2
{
    max-width: 70%;
    overflow: wrap;
    word-wrap:break-word;

}
  
.page-break  { display: block; }

#home tr:nth-child(even) {background-color: #f2f2f2;}

#profile tr:hover {background-color: #ddd;}

table thead th {text-align:center}

#home th:nth-child(4) {display:none}

#home td:nth-child(4) {display:none}

.jumbotron {
  padding: 20px;

}

table td{
  word-break: break-all;
}
.match-result{
  background-color:  #1A4275;
  padding: 20px;
}

.name-header{
    width: 40%;
  word-break: break-all;
}

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          @if(count((array) $data) > 0)
          <div class="row">
            <div class="jumbotron match-result">
              <h3 class="text-center text-white">
                Intellinz Match Result
              </h3>
            </div>
          </div>



      <div class="row">
        <div class="jumbotron name-header">
          <h4>
            {{ $data['FIRST_NAME']. '  '.$data['LAST_NAME']}}
          </h4>
        </div>
      </div>

      <div class="tab-content">
        <div class="tab-pane active" id="home">
          <table class="table">
{{--             <thead>
              <tr>
                <th>Item ID</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>2-DAY SHIPPING</th>
              </tr>
            </thead> --}}
            <tbody>
              <tr>
                <th width="30%">INSERTED TO INTELLINZ</th>
                <td   width="70%">{{ $inserted_prokakis }}</td>
              </tr>

              <tr>
                <th width="30%">UPDATED</th>
                <td   width="70%">{{ $updated_prokakis }}</td>
              </tr>

              <tr>
                <th width="30%">First Name</th>
                <td   width="70%">{{ $data['FIRST_NAME'] }}</td>
              </tr>

              <tr>
                <th width="30%">Last Name</th>
                <td   width="70%">{{ $data['LAST_NAME'] }}</td>
              </tr>

              <tr>
                <th width="30%">Companies</th>
                <td   width="70%">{{ $company_out }}</td>
              </tr>

              <tr>
                <th width="30%">Aliases</th>
                <td   width="70%">{{ $data['ALIASES'] }}</td>
              </tr>

              <tr>
                <th width="30%">CATEGORY</th>
                <td   width="70%">{{ $data['CATEGORY'] }}</td>
              </tr>

              <tr>
                <th width="30%">TITLE</th>
                <td   width="70%">{{ $data['TITLE'] }}</td>
              </tr>

              <tr>
                <th width="30%">Gender</th>
                <td   width="70%">{{ $data['E_I'] }}</td>
              </tr>

              <tr>
                <th width="30%">POSITION</th>
                <td   width="70%">{{ $data['POSITION'] }}</td>
              </tr>

              <tr>
                <th width="30%">DATE OF BIRTH</th>
                <td   width="70%">{{ $data['DOB'] }}</td>
              </tr>

              <tr>
                <th width="30%">LOCATIONS</th>
                <td   width="70%">{{ $data['LOCATIONS'] }}</td>
              </tr>

              <tr>
                <th width="30%">PASSPORTS</th>
                <td   width="70%">{{ $data['PASSPORTS'] }}</td>
              </tr>

              <tr>
                <th width="30%">CITIZENSHIP</th>
                <td   width="70%">{{ $data['CITIZENSHIP'] }}</td>
              </tr>

              <tr>
                <th width="30%">PLACE OF BIRTH</th>
                <td   width="70%">{{ $data['PLACE_OF_BIRTH'] }}</td>
              </tr>

              <tr>
                <th width="30%">COMPANIES</th>
                <td   width="70%">{{ $data['COMPANIES'] }}</td>
              </tr>

               <tr>
                <th width="30%">COUNTRY LOCATIONS</th>
                <td   width="70%">{{ $data['LOCATIONS'] }}</td>
              </tr>             

               <tr>
                <th width="30%">KEY WORDS</th>
                <td   width="70%">{{ $data['KEYWORDS'] }}</td>
              </tr>   

               <tr>
                <th width="30%">FURTHER INFORMATION</th>
                <td   width="70%">{{ $data['FURTHER_INFORMATION'] }}</td>
              </tr>  

               <tr>
                <th width="30%">EXTERNAL SOURCES</th>
                <td   width="70%">{{ $data['EXTERNAL_SOURCES'] }}</td>
              </tr>  


            </tbody>
          </table>
        </div>
      </div>


          @endif
           

           
    
      
       </div>    
   </div>
</div>
       



@endsection
