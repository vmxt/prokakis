 @extends('layouts.app')



@section('content')



<style>

    .niceDisplay{

        font-family: 'PT Sans Narrow', sans-serif;

        background-color: white;

        padding: 10px;

        border-radius: 3px; 

        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);

    }  

    .btn-x3 {

    font-size: 15px;

    border-radius: 5px;

    width: 25%;

    background-color: orangered;

    }

</style>

 



<div class="container">



    <div class="row justify-content-center">

        

        <div class="col-md-12" style="min-height:800px">

         

            <div class="portlet light ">

                <div class="portlet-title">



            <div class="card">

                   <div class="card-header"><b>Request Report</b> </div> <br />
            
            
			 

			<div class="alert alert-info" style="width: 100%; overflow: hidden; margin-left: 0px !important;"> <p>
                                                <b>This request report requires a 12 token, please enter your details so that we can contact you once the report is ready. </b> <br />
                                                We preload your company data to the following text fields, if you wish to request in behalf of other company please do update
                                                the data in the textfields.
                                            </p>
            </div>

            <?php
            $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());
            $token = App\SpentTokens::validateLeftBehindToken($company_id_result);
            echo $token."==";
                if($token != false){
                    echo '<div class="alert alert-info" style="width: 100%; overflow: hidden; margin-left: 0px !important;"> You have <b> '.$token.' </b>token left. </div>';
                } else{
                    echo '<div class="alert alert-danger" style="width: 100%; overflow: hidden; margin-left: 0px !important;"> You have <b> 0 </b>token left. </div>';
                }
            ?>
			
                    <div class="card-body center">

                          

                          

                          @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul>

                                    @foreach ($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                           @endif

                        

                       {!! Form::model($requestReport, ['action' => 'OpportunityController@storeRequestReport']) !!} 

                       

                       <input type="hidden" name="fk_opportunity_id" value="<?php echo $oppId; ?>" />

                       <input type="hidden" name="opportunity_type" value="<?php echo $oppType; ?>" />

                       <input type="hidden" name="company_id" value="<?php echo $company_id; ?>" />

                       

                       <div class="form-group">

                        {!! Form::label('make', 'Company UEN') !!}
             <input type="text" name="company_UEN" class="form-control" value="<?php echo $company_rs->unique_entity_number; ?>">
                      </div>



                      <div class="form-group">

                        {!! Form::label('company_name', 'Company Name') !!}

            <input type="text" name="company_name" class="form-control" value="<?php echo $company_rs->registered_company_name; ?>">
           
                      </div>

                       

                      <div class="form-group">

                        {!! Form::label('person_incharge', 'Company Person In Charge ') !!}

                        {!! Form::text('person_incharge', '', ['class' => 'form-control']) !!}

                      </div>

                       

                       <div class="form-group">

                        {!! Form::label('email_address', 'Email') !!}

            <input type="text" name="email_address" class="form-control" value="<?php echo $company_rs->company_email; ?>">
                

                      </div>

                       

                       <div class="form-group">

                        {!! Form::label('mobile_number', 'Mobile Number') !!}

            <input type="text" name="mobile_number" class="form-control" value="<?php echo $company_rs->mobile_phone; ?>">
      

                      </div>



                       <button class="btn" style="background-color: #1a4275; color:white" type="submit">Send Request</button>



                       {!! Form::close() !!}

                       

                    </div>    

            </div>

          </div>

        </div>

             

        </div>

                



        </div>



</div>







@endsection















