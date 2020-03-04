@extends('layouts.printPreview')


@section('content')
    <center>
    <div class="col-md-6" style="margin-top:25px;">  
    
        <table id="system_data" class="table table-bordered table-striped table-condensed flip-content" >
            <thead>
            <tr>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(count($data) > 0){
             $out = "";

             $out = $out . '<tr>
                    <td> INSERTED TO PROKAKIS  </td>
                    <td> '.$inserted_prokakis.' </td>
                    </tr>';
            
            $out = $out . '<tr>
                    <td> UPDATED   </td>
                    <td> '.$updated_prokakis.' </td>
                    </tr>';

            $out = $out . '<tr>
                    <td> First Name   </td>
                    <td> '.$data->FIRST_NAME.' </td>
                    </tr>';

            $out = $out . '<tr>
                   <td> Last Name   </td>
                   <td> '.$data->LAST_NAME.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td> Companies   </td>
                   <td> '.$company_out.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td> Aliases   </td>
                   <td> '.$data->ALIASES.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td> Category  </td>
                   <td> '.$data->CATEGORY.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td> Title   </td>
                   <td> '.$data->TITLE.' </td>
                   </tr>';
            
           $out = $out . '<tr>
                   <td> Gender   </td>
                   <td> '.$data->E_I.' </td>
                   </tr>';
                          
            $out = $out . '<tr>
                   <td> Position  </td>
                   <td> '.$data->POSITION.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td> DOB   </td>
                   <td> '.$data->DOB.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td> Locations   </td>
                   <td> '.$data->LOCATIONS.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td> Passport   </td>
                   <td> '.$data->PASSPORTS.' </td>
                   </tr>';
                   
            $out = $out . '<tr>
                   <td> Citizenship   </td>
                   <td> '.$data->CITIZENSHIP.' </td>
                   </tr>';
            $out = $out . '<tr>
                   <td> Place of birth   </td>
                   <td> '.$data->PLACE_OF_BIRTH.' </td>
                   </tr>';
            
            $out = $out . '<tr>
                   <td> Companies   </td>
                   <td> '.$data->COMPANIES.' </td>
                   </tr>';
            
            $out = $out . '<tr>
                   <td> Country Location   </td>
                   <td> '.$data->LOCATIONS.' </td>
                   </tr>';
            
            $out = $out . '<tr>
                   <td> Key Words   </td>
                   <td> '.$data->KEYWORDS.' </td>
                   </tr>';       
            
            $out = $out . '<tr>
                   <td> Further Information   </td>
                   <td> '.$data->FURTHER_INFORMATION.' </td>
                   </tr>';
            
            $out = $out . '<tr>
                   <td> External sources   </td>
                   <td> '.$data->EXTERNAL_SOURCES.' </td>
                   </tr>';
                   
            echo $out;        
         
            } 
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Attribute</th>
                <th>Value</th>
            </tr>
            </tfoot>
        </table>
    </div> 
</center>

    <script type="text/javascript">

         $(document).ready(function() {
            window.print();
          });
  
    </script>    

@endsection

