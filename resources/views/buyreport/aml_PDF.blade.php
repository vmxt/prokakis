<?php

##### - COMPANY OVERVIEW 

$data["COMP_NAME"] = isset($company_data->registered_company_name) ? $company_data->registered_company_name : '-----';
$data["COMP_BRAND_MSG"] = isset($brand_slogan[0]) ? substr($brand_slogan[0],0,60) : '-----';
$data["COMP_SLOGAN_MSG"] = isset($brand_slogan[0]) ? substr($brand_slogan[1],0,70) : '-----';

$data["COMP_REGISTRATION_NUMBER"] = isset($company_data->unique_entity_number) ? $company_data->unique_entity_number : '-----';

/*$data["COMP_YEAR_FOUNDED"] = isset($company_data->year_founded) ? $company_data->year_founded : '-----';
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
$data["COMP_STRENGTHS"] = "N.A.";*/


?>

@extends('layouts.appPdf', ['footer_content'=>$reportTemplates["FOOTER_TXT"] ])
@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="page-break">
        @include('buyreport.pages.aml.page1')
      </div>
     
      <div class="page-break">
        @include('buyreport.pages.aml.page8')
      </div>
   
    </div>
  </div>
</div>

@endsection