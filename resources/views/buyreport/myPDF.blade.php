<?php

##### - COMPANY OVERVIEW 
$data["COMP_NAME"] = isset($company_data->registered_company_name) ? $company_data->registered_company_name : '-----';
$data["COMP_BRAND_MSG"] = isset($brand_slogan[0]) ? substr($brand_slogan[0],0,60) : '-----';
$data["COMP_SLOGAN_MSG"] = isset($brand_slogan[0]) ? substr($brand_slogan[1],0,70) : '-----';
$data["COMP_REGISTRATION_NUMBER"] = isset($company_data->unique_entity_number) ? $company_data->unique_entity_number : '-----';
$data["COMP_YEAR_FOUNDED"] = isset($company_data->year_founded) ? $company_data->year_founded : '-----';
$data["COMP_BUSSINESS_TYPE"] = isset($company_data->business_type) ? $company_data->business_type : '-----';
$data["COMP_INDUSTRY_TYPE"] = isset($company_data->industry) ? $company_data->industry : '-----';
$data["COMP_DESCRIPTION"] = isset($company_data->description) ? $company_data->description : '-----';
$data["COMP_ADDRESS"] = isset($company_data->registered_address) ? $company_data->registered_address : '-----';
$data["COMP_OFFICE_PHONE"] = isset($company_data->office_phone) ? $company_data->office_phone : '-----';
$data["COMP_MOBILE_PHONE"] = isset($company_data->mobile_phone) ? $company_data->mobile_phone : '-----';
$data["COMP_EMAIL"] = isset($company_data->company_email) ? $company_data->company_email : '-----';
$data["COMP_WEBSITE"] = isset($company_data->company_website) ? $company_data->company_website : '-----';

$data["COMP_AWARDS"] = "N.A.";
$data["COMP_CERTIFICATES"] = "Certificate of Real Licence";
$data["COMP_STRENGTHS"] = "N.A.";


?>


@extends('layouts.appPdf', ['footer_content'=>$reportTemplates["FOOTER_TXT"] ])
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h1 id="appe"></h1>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page1')
      </div>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page2')
      </div>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page3')
      </div>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page4')
      </div>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page5')
      </div>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page6')
      </div>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page7')
      </div>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page8')
      </div>
      <div class="page-break">
          {{-- @include('buyreport.footer.disclaimer') --}}
        @include('buyreport.pages.page9')
      </div>
    </div>
  </div>
</div>

{{-- <script type="text/javascript">
    $.get("http://localhost/reputation/api/v1/mentions-tosearch?_token=oRywBjfcKuGp0wjIczjPoI2IK6qxOEqkkbfKnAXz&selected_sm=+Twitter++&search_keyword_selections=Donald+Trump", function(data, status){
       // $("#appe").html(data);
       $.each( data.rs_twit, function( key, value ) {
        
        // $.each( value, function( key, value ) {
      // console.log(value);

        // });
      //   var data = multiDimensionalUnique(value);
      // console.log(data);

        // console.log(data[3])
// console.log(value.profile_image_url);
   $( "#social_card" ).append( 

    "<div class='card'> " +
      "<div class='card-body'>" +
        "<table class='table social-table' >"+
          "<tbody>" +
            "<tr >" +
              "<td class='social-table1'>"+
                "<img src=' "+value.profile_image_url+" ' width='150px'>"+
                  "<p class='content1-days'><small class='h6'>"+value.name+"</small></p>"+
                  "<p class='content1-days'><small class='h6'>"+value.t_created_at+"</small></p>"+
                  "<p class='content1-link h6'><a href='#'><small class='h6'>"+value.url+"</small></a> </p>"+
              "</td>"+
            "<td class='social-table2'>"+
                "<a  href='#'>"+value.t_expanded_url+"</a>"+
              "<p >"+value.t_text+"  </p>"+
            "</td>"+
          "</tr>"+
        "</tbody>"+
     " </table>"+
   " </div>"+
    "</div>" 

    );

      });

    });

</script> --}}

@endsection