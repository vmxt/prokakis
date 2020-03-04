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
                                                <b> Please enter your details so that we can contact you once the report is ready. </b>
                                            </p>
                                        </div>
			
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

                        {!! Form::text('company_UEN', '', ['class' => 'form-control']) !!}

                      </div>



                      <div class="form-group">

                        {!! Form::label('company_name', 'Company Name') !!}

                        {!! Form::text('company_name', '', ['class' => 'form-control']) !!}

                      </div>

                       

                      <div class="form-group">

                        {!! Form::label('person_incharge', 'Company Person In Charge ') !!}

                        {!! Form::text('person_incharge', '', ['class' => 'form-control']) !!}

                      </div>

                       

                       <div class="form-group">

                        {!! Form::label('email_address', 'Email') !!}

                        {!! Form::text('email_address', '', ['class' => 'form-control', 'placeholder'=>'Ex. example@gmail.com']) !!}

                      </div>

                       

                       <div class="form-group">

                        {!! Form::label('mobile_number', 'Mobile Number') !!}

                        {!! Form::text('mobile_number', '', ['class' => 'form-control']) !!}

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















