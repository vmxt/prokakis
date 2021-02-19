
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
<?php 
  $user_details = App\User::find(Auth::id());
  $userFullName = $user_details->firstname. " ". $user_details->lastname;
  $userEmail = $user_details->email;
  $ThomsonAuditTrail = App\ThomsonAuditTrail::where('requestor_id',Auth::id())->orderBy('id','desc')->skip(1)->first() ;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
          @if(count((array) $dataR) > 0)
          <div class="row">
            <div class="jumbotron match-result">
              <h3 class="text-center text-white">
                Prokakis Case Report
              </h3>
            </div>
          </div>

      <div class="tab-content">
        <div class="tab-pane active" >
          <table class="table">
            <tbody>
              <tr>
                <th width="20%">Name</th>
                <td   width="70%">{{ $userFullName }}</td>
              </tr>
              
              <tr>
                <th width="20%">Email</th>
                <td   width="70%">{{ $userEmail }}</td>
              </tr>

              <tr>
                <th width="20%">Last Searched</th>
                <td   width="70%">{{ date('d M Y H:i:s' ,strtotime($ThomsonAuditTrail->updated_at)) }}</td>
              </tr>

              <tr>
                <th width="20%">Case Created</th>
                <td   width="70%">{{ date('d M Y H:i:s' , time() ) }}</td>
              </tr>

            </tbody>
          </table>

          <h4><strong>Key Finding</strong></h4>
          <table class="table">
            <tbody>
              <tr>
                <th width="20%">Total Matches</th>
                <td   width="70%">{{ count((array) $dataR) }}</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
      <div class="page-break">
          <div class="row">
            <div class="jumbotron name-header">
              <h5>Thomson Result Matches:</h5>
            </div>

            <div class="tab-content">
              <div class="tab-pane active" id="home">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Fullname</th>
                      <th>Category</th>
                      <th>Company</th>
                      <th>Countries</th>
                      <th>Citizenship</th>
                      <th>Last Udpate</th>
                      <th>Match %</th>
                    </tr>
                  </thead>
                  <tbody>


            @foreach($dataR as $data)
<?php       
                          $company_out = (isset($data['COMPANIES']))? $data['COMPANIES'] : '';
                          $inserted_prokakis = '';
                          if (isset($data['CREATED_AT']) and $data['CREATED_AT'] != NULL) {
                                // Creating timestamp from given date
                                $timestamp = strtotime($data['CREATED_AT']);
                                // Creating new date format from that timestamp
                                $inserted_prokakis = date("F j, Y", $timestamp);
                          }
                          $updated_prokakis = '';
                          if ($data['UPDATED'] != NULL) {
                                 $timestamp = strtotime($data['UPDATED']);
                                 // Creating new date format from that timestamp
                                 $updated_prokakis = date("F j, Y", $timestamp);
                          }  
      $pecentage = "";
      $r_id = explode(",", $ids);
      foreach($r_id as $t){
        $tt = explode("||", $t);
        if($data['UID'] == $tt[0]){
          $pecentage = $tt[1];
        }
      }
?>



                    <tr>
                      <td >{{  $data['FIRST_NAME']. '  '.$data['LAST_NAME']}}</td>
       
                      <td>{{ $data['CATEGORY'] }}</td>

                      <td>{{ $data['COMPANIES'] }}</td>
          
                      <td>{{ $data['COUNTRIES'] }}</td>
       
                      <td>{{ $data['CITIZENSHIP'] }}</td>

                      <td>{{ $updated_prokakis }}</td>
         
                      <td>{{ $updated_prokakis }}</td>
       
                      <td>{{ $pecentage }}%</td>
                    </tr>



            @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
          @endif
           

           
    
      
       </div>    
   </div>
</div>
       



@endsection