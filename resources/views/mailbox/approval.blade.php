@extends('layouts.app')

@section('content')

<style>


.niceDisplay{
        font-family: 'PT Sans Narrow', sans-serif;
        background-color: white;
        padding: 30px;
        border-radius: 3px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}  

.niceDisplay2{
        font-family: 'PT Sans Narrow', sans-serif;
        background-color: #FFE4C4;
        padding: 10px;
        border-radius: 3px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
}  

    
.btn-x3 {
    font-size: 15px;
    border-radius: 5px;
    width: 40%;
    background-color: orangered;
    }


</style>
<br />
<div class="container">
    <div class="row justify-content-center">

      <div class="col-md-8">
        <div class="row">
             <div class="card" style="width: 100%;">
            
             <div class="card-header"><b>  Report Request Action For Consultant </b></div>
            
              <div id="container">

                   @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                          @endif
                          
                <table style="width: 100%">
                  <tr>
                    <td> 
                      <center>
                 <form id="request_approval_form" method="POST" action="{{ route('requestApproveExecute') }}">
                       {{ csrf_field() }}     
                   <input type="hidden" name="repRequestId" value="<?php if(isset($result->id)){ echo $result->id; } ?>">  

                   <br />

                     <div class="form-group">
                             <input type="submit" name="butApprove" class="btn btn-success"  value="Approve">
                    </div>   
                   
                 </form>  
                      </center>
                     </td>
                     <td>
                      <center>
                  <form id="request_reject_form" method="POST" action="{{ route('requestRejectExecute') }}">
                       {{ csrf_field() }}     
                  <input type="hidden" name="repRequestId" value="<?php if(isset($result->id)){ echo $result->id; } ?>">  
     
                  <br />

                     <div class="form-group">
                          <input type="submit" name="butCancel" class="btn btn-alert"  value="Reject">
                     </div>   

                  </form>
                    </center>
                   </td>
                   </tr> 
                   </table>    
            
              </div>

             </div>
          </div>
        </div>

         <div class="col-md-8">
         <div class="row"> 
          <table style="width:100%" cellspacing="2" cellpadding="2">
             <tr>
               <td>   <div class="card">
            
             <div class="card-header"><b>Requestor</b></div>
            
              <div id="container">

               <table style="width:100%">

               <tr>
               <td> 
               <div class="form-group">
                         <label for="company_description">Company UEN</label>
                         <div class="niceDisplay2">
                          <?php echo $result->company_UEN; ?>
                          </div>   
              </div>
              </td> 
              <td>
                <div class="form-group">
                         <label for="company_description">Company Name</label>
                         <div class="niceDisplay2">
                          <?php echo $result->company_name; ?>
                          </div>   
              </div>
              </td>
              </tr>
               
             
               <tr>
               <td> 
              <div class="form-group">
                         <label for="company_description">Person Incharge</label>
                         <div class="niceDisplay2">
                          <?php echo $result->person_incharge; ?>
                          </div>   
              </div>
              </td>
              <td>
              <div class="form-group">
                         <label for="company_description">Email Address</label>
                         <div class="niceDisplay2">
                          <?php echo $result->email_address; ?>
                          </div>   
              </div>
              </td>
              </tr>
              
               <tr>
               <td colspan="2"> 
               <div class="form-group">
                         <label for="company_description">Mobile Number</label>
                         <div class="niceDisplay2">
                          <?php echo $result->mobile_number; ?>
                          </div>   
               </div>
               </td>
               </tr>  
                
             </table>

              </div>  
            </div>  
            </td>
            </tr>

            <tr><td> &nbsp; </td></tr>

            <tr>
               <td>  <div class="card">
            
             <div class="card-header"><b>Provider</b></div>
            
              <div id="container">
                         <div class="form-group">
                         <label for="company_description">To view full information open system profile</label>
                         <div class="niceDisplay2">
                          
                          <form id="provider_profile_form" method="POST" action="{{ route('viewingProfileUser') }}" target="_blank">
                           {{ csrf_field() }}  
                           <input type="hidden" name="userId" value="<?php if(isset($company_data2->user_id)){ echo $company_data2->user_id; } ?>"> 
                           <input type="submit" class="btn btn-primary btn-x3" value="-- Open Profile --" /> 
                          </form>

                          </div>   
                         </div>  

                         <div class="form-group">
                         <label for="company_description">Description</label>
                         <div class="niceDisplay">
                           <?php if(isset($company_data2->description)){ echo $company_data2->description; } ?> <br />
                          </div>   
                         </div> 
                        
                         <div class="form-group">
                            <label for="company_unique_entity">Company Unique Entity Number (UEN)</label>
                           <div class="niceDisplay">
                            <?php if(isset($company_data2->unique_entity_number)){ echo $company_data2->unique_entity_number; } ?>    
                            </div>
                         </div>
                        
                        <div class="form-group">
                            <label for="company_name">Registered Company Name</label>
                              <div class="niceDisplay">
                               <?php if(isset($company_data2->registered_company_name)){ echo $company_data2->registered_company_name; } ?>  
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="company_year_founded">Year Founded</label>
                            
                            <div class="niceDisplay">
                               <?php if(isset($company_data2->year_founded)){ echo $company_data2->year_founded; } ?>  
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="company_address">Registered Address </label>
                            <div class="niceDisplay"><?php if(isset($company_data2->registered_address)){ echo $company_data2->registered_address; } ?></div>
                         </div>
                        
                        <div class="form-group">
                            <label for="company_number_employeee">Number of Employees</label>
                             <div class="niceDisplay"><?php if(isset($company_data2->number_of_employees)){ echo $company_data2->number_of_employees; } ?></div>
                         </div>
                        
                        <div class="form-group ">
                            <label for="company_estmated_sales offset-md-5">Estimated Sales</label> 
                            
                             <div class="niceDisplay"><?php if(isset($company_data2->estimatedsales_currency)){ echo $company_data2->estimatedsales_currency; } ?></div>
                             <div class="niceDisplay"><?php if(isset($company_data2->estimatedsales_value)){ echo $company_data2->estimatedsales_value; } ?></div>
                         </div>
                        
                         <div class="form-group">
                            <label for="company_primary_country">Primary Country</label>
                             <div class="niceDisplay"><?php if(isset($company_data2->primary_country)){ echo $company_data2->primary_country; } ?></div>
                         </div>
                        
                        <div class="form-group">
                            <label for="company_ownership">Ownership Status</label>
                             <div class="niceDisplay"><?php if(isset($company_data2->ownership_status)){ echo $company_data2->ownership_status; } ?></div>
                         </div>
                        
                        <hr />
                        
                        <div class="form-group">
                            <label for="company_ownership">Business Type</label>
                            <div class="niceDisplay"><?php if(isset($company_data2->business_type)){ echo $company_data2->business_type; } ?></div>
                         </div>
                        
                          <div class="form-group">
                            <label for="company_ownership">Industry</label>
                            <div class="niceDisplay"><?php if(isset($company_data2->industry)){ echo $company_data2->industry; } ?></div>
                         
                         </div>
                          <div class="form-group">
                                <label for="company_financial_year">For financial year/month</label>
                                 <div class="niceDisplay"><?php if(isset($company_data2->financial_year)){ echo $company_data2->financial_year; } ?> / <?php if(isset($company_data2->financial_month)){ echo $company_data2->financial_month; } ?></div>
                            </div>
                            
                            <div class="form-group">
                            <label for="company_years_establishment">Years of establishment </label>
                            <div class="niceDisplay"><?php if(isset($company_data2->years_establishment)){ echo $company_data2->years_establishment; } ?></div>
                            </div>
                            
                            <div class="form-group">
                            <label for="company_annual_tax">Annual return & tax filled </label>
                            <div class="niceDisplay"><?php if(isset($company_data2->annual_tax_return)){ echo $company_data2->annual_tax_return; } ?></div>
                            </div>
                            
                            <div class="form-group">
                            <label for="company_gross_profit">Gross Profit</label>
                            <div class="niceDisplay"><?php if(isset($company_data2->gross_profit)){ echo $company_data2->gross_profit; } ?></div>
                            </div>
                            
                            <div class="form-group">
                            <label for="company_gross_profit">Net Profit</label>
                            <div class="niceDisplay"><?php if(isset($company_data2->net_profit)){ echo $company_data2->net_profit; } ?></div>
                            </div>
                            
                            <div class="form-group ">
                            <label for="company_financial_currency">Currency</label> <br />
                            <div class="niceDisplay"><?php if(isset($company_data2->currency)){ echo $company_data2->currency; } ?></div>
                            </div>
                            
                            <div class="form-group ">
                            <label for="company_financial_numstaff">No. of staff</label> <br />
                            <div class="niceDisplay"><?php if(isset($company_data2->no_of_staff)){ echo $company_data2->no_of_staff; } ?></div>
                            </div>
                            
                         
                          </div>
              </div>  </td>
             </tr> 
          </table>

          </div> 

         </div>  

          </div> 

    </div>  
  </div>  

   
<script src="{{ asset('public/js/app.js') }}"></script> 
<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">
<script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>

@endsection