
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

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
    
      
            <?php
            if(count((array) $dataR) > 0){
            $out = "";  
            
            foreach($dataR as $data)
            {    
              $out = $out .  ' <table class="table table-bordered table-striped table-condensed flip-content" >
                       <tr>
                       <th colspan="2">'.$data->FIRST_NAME. '  '.$data->LAST_NAME.' </th>
                       </tr> <thead></thead>
              <tbody>';
             
             
              $company_out = (isset($data->COMPANIES))? $data->COMPANIES : '';
            
              $inserted_prokakis = '';
              if ($data->CREATED_AT != NULL) {
                    // Creating timestamp from given date
                    $timestamp = strtotime($data->CREATED_AT);
                            
                    // Creating new date format from that timestamp
                    $inserted_prokakis = date("F j, Y", $timestamp);
                   
              }

              $updated_prokakis = '';
              if ($data->UPDATED != NULL) {
                     $timestamp = strtotime($data->UPDATED);
                            
                     // Creating new date format from that timestamp
                     $updated_prokakis = date("F j, Y", $timestamp);
              }      
    

            $out = $out . '<tr>
                    <td> INSERTED TO PROKAKIS  </td>
                    <td> '.$inserted_prokakis.' </td>
                    </tr>';
            
            $out = $out . '<tr>
                    <td> UPDATED   </td>
                    <td> '.$updated_prokakis.' </td>
                    </tr>'; 

            $out = $out . '<tr>
                    <td class="social-table1"> First Name   </td>
                    <td class="social-table2"> '.$data->FIRST_NAME.' </td>
                    </tr>';

            $out = $out . '<tr>
                   <td class="social-table1"> Last Name   </td>
                   <td class="social-table2"> '.$data->LAST_NAME.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td class="social-table1"> Companies   </td>
                   <td class="social-table2"> '.$company_out.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td class="social-table1"> Aliases   </td>
                   <td class="social-table2"> '.$data->ALIASES.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td class="social-table1"> Category  </td>
                   <td class="social-table2"> '.$data->CATEGORY.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td class="social-table1"> Title   </td>
                   <td class="social-table2"> '.$data->TITLE.' </td>
                   </tr>';
            
           $out = $out . '<tr>
                   <td class="social-table1"> Gender   </td>
                   <td class="social-table2"> '.$data->E_I.' </td>
                   </tr>';
                          
            $out = $out . '<tr>
                   <td class="social-table1""> Position  </td>
                   <td class="social-table2"> '.$data->POSITION.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td class="social-table1"> DOB   </td>
                   <td class="social-table2"> '.$data->DOB.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td class="social-table1"> Locations   </td>
                   <td class="social-table2"> '.$data->LOCATIONS.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td class="social-table1"> Passport   </td>
                   <td class="social-table2"> '.$data->PASSPORTS.' </td>
                   </tr>';
                   
            $out = $out . '<tr>
                   <td class="social-table1"> Citizenship   </td>
                   <td class="social-table2"> '.$data->CITIZENSHIP.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td class="social-table1"> Place of birth   </td>
                   <td class="social-table2"> '.$data->PLACE_OF_BIRTH.' </td>
                   </tr>';
            
            $out = $out . '<tr>
                   <td class="social-table1"> Companies   </td>
                   <td class="social-table2"> '.$data->COMPANIES.' </td>
                   </tr>';
            
            $out = $out . '<tr>
                   <td class="social-table1"> Country Location   </td>
                   <td class="social-table2"> '.$data->LOCATIONS.' </td>
                   </tr>';
            
            $out = $out . '<tr>
                   <td class="social-table1"> Key Words   </td>
                   <td class="social-table2"> '.$data->KEYWORDS.' </td>
                   </tr>';       
            
            $out = $out . '<tr>
                   <td class="social-table1"> Further Information   </td>
                   <td class="social-table2"> '.$data->FURTHER_INFORMATION.' </td>
                   </tr>';
            
            $out = $out . '<tr>
                   <td class="social-table1"> External sources   </td>
                   <td class="social-table2"> '.$data->EXTERNAL_SOURCES.' </td>
                   </tr>';
              

             $out = $out .  '</tbody>
           </table><div class="page-break"></div>';
               
       
              }  

              echo $out;
          
            } 
            ?>
           
    
      
       </div>    
   </div>
</div>
       



@endsection