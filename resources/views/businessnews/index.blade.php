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

    

.btn-x3 {

    font-size: 15px;

    border-radius: 5px;

    width: 40%;

    background-color: orangered;

    }



.btn-x4 {

    font-size: 15px;

    border-radius: 5px;

    width: 10%;

    background-color: orangered;

    }

</style>

<br />

 

<script src="{{ asset('public/tinymce/js/tinymce/tinymce.min.js') }}"></script> 



<script>

          tinymce.init({

            selector: '#businessnewsArea, #opportunitiesArea',

            branding: false,

             height: 400

          });

</script>



<div class="container">

    <ul class="page-breadcrumb breadcrumb" style="margin-top: 10px;">

        <li>

            <a href="{{ url('/home') }}">Home</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <span>Business News</span>

        </li>

    </ul>

    <div class="row justify-content-center">



  

         <div class="col-md-12">





           <div class="card">



             <form id="company_social_form" method="POST" action="{{ route('businessnewsStore') }}">

                       {{ csrf_field() }}

              

            </div>

              @if (session('status'))

                                <div class="alert alert-success">

                                    {{ session('status') }}

                                </div>

              @endif

              @if (session('message'))

                        <div class="alert alert-danger">

                            {{ session('message') }}

                        </div>

              @endif



              <div id="container">

              

                <br />

              

              <?php 

              $id = Auth::id();

            

              $company_id = App\CompanyProfile::getCompanyId($id);



              $data = App\BusinessOpportunitiesNews::where('user_id',$id)->where('company_id', $company_id)->first();



              ?>



                 <div class="form-group">

                  <label for="businessTitle">Business News Title:</label>

                   

                  <input type="text" class="form-control" id="businessTitle"  name="businessTitle"

                  value="<?php if (isset($data->business_title)) {

                      echo $data->business_title;

                  } ?>">

                 </div>  

                

                <div class="form-group">

                <label for="email">Business News Content:</label>

                <textarea name="businessnewsArea" id="businessnewsArea"><?php if(isset($data->content_business)){ echo $data->content_business; } ?></textarea>

                </div>  

                

            

                <div class="row justify-content-center">

                    <a href="{{ route('home') }}" class="btn btn-info">Cancel</a> &nbsp;

                    <input type="submit" class="btn btn-primary" name="btnSubmit" value="Save"> &nbsp;



                    <input type="submit" class="btn btn-danger" name="btnSubmit" style="float:right;"  value="Delete"> &nbsp;

                        

                </div>





              </div>  



              </form>     







             </div>  



         </div>           



    </div>  

  </div>  



   

<script src="{{ asset('public/js/app.js') }}"></script> 

<link rel="stylesheet" type="text/css" href="{{ asset('public/grid/jquery.dataTables.min.css') }}">

<script type="text/javascript" charset="utf8" src="{{ asset('public/grid/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('public/sweet-alert/sweetalert.min.js') }}"></script>



@endsection