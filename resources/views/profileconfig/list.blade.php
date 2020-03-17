@extends('layouts.mainDatatable')


@section('breadcrumbs')
<div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="icon-home"></i>
                                <a href="{{ route('home') }}">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Configuration</span>
                            </li>
                        </ul>

                    </div>
@endsection

@section('content')

<div class="portlet-title">
    <div class="caption">
    Only for Administrator 
    </div>
  
    <hr />
 </div>

<div class="container">

  
    <div class="row justify-content-center">

        <div class="col-md-10">

            <div class="card">

                <div class="card-body">
                 <b> List Profiles </b>
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

    @if ($errors->any())
       <div class="alert alert-danger">
         <ul>
         @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
         @endforeach
         </ul>
       </div>
    @endif


    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1" cellspacing="0" width="70%">
                    <thead>
                            <tr>
                            <th> <span style="float:left">Name</th>
                            <th> <span style="float:left">Email</th>
                            <th> <span style="float:left">Actions</th>
                            </tr>
                    </thead>

                      <tbody>
                      @if(isset($rs))
                        @foreach ($rs as $d)

                        <tr>
                          
                           <td>{{ $d->name }}</td>
                           <td>{{ $d->email }}</td>
                           <td><a class="btn" href="<?php echo url('/preferencesFound/'.$d->id); ?>" > Select </a></td>

                        </tr>

                        @endforeach
                       @endif    

                      </tbody>

    </table>
  
              

                    

     

        </div>

    </div>
</div>


@endsection
