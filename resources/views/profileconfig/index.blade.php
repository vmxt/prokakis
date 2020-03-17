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
                  Profile Preferences
                </div>



    @if(isset($rs))

    <form action="{{ route('PutPreferenceSave') }}" method="POST">
    @csrf

    <div class="form-body">

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

    <div class="form-group">
        <span class="help-block"><b><?php echo $selectedUser->name.', '.$selectedUser->email; ?></b></span>
     </div>

    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <div class="form-group">
           <input name="subscription_start_date" data-date-format="yyyy-mm-dd" class="form-control form-control-inline input-medium date-picker" size="16" type="text"
           value="<?php if($rs->subscription_startdate){ echo $rs->subscription_startdate; } ?>">
           <span class="help-block"> Subscription Start Date (Year-Month-Date)</span>
        </div>

        <div class="form-group">
           <input name="subscription_end_date" data-date-format="yyyy-mm-dd" class="form-control form-control-inline input-medium date-picker" size="16" type="text"
           value="<?php if($rs->subscription_enddate){ echo $rs->subscription_enddate; } ?>">
           <span class="help-block"> Subscription End Date (Year-Month-Date) </span>
        </div>

        <div class="form-group">
            <div class="mt-checkbox-list">
                <label class="mt-checkbox">
                <input type="checkbox" <?php if($rs->is_wl == 1){ echo 'checked'; } ?> value="1" name="is_wl"> White Label Account?
                <span></span>
                </label>
            </div>
        </div>

        <div class="form-group">
            <input name="num_searches" type="text" class="form-control  form-control-inline input-medium"
            value="<?php if(isset($rs->num_searches)){ echo $rs->num_searches; } ?>">
            <span class="help-block"> Number of searches  </span>
        </div>

        <div class="form-group">
            <input name="num_dashboard" type="text" class="form-control  form-control-inline input-medium"
            value="<?php if(isset($rs->num_dashboard)){ echo $rs->num_dashboard; }else { echo '1'; } ?>">
            <span class="help-block"> Number of Dashboard  </span>
        </div>

        <div class="form-group">
            <div class="mt-checkbox-list">

                <label class="mt-checkbox">
                <input type="checkbox" value="1" <?php if($rs->show_mentions == 1){ echo 'checked'; } ?> name="show_mentions"> Show Mentions?
                <span></span>
                </label>

                <label class="mt-checkbox">
                <input type="checkbox" value="1" <?php if($rs->show_topics == 1){ echo 'checked'; } ?> name="show_topics"> Show Topics?
                <span></span>
                </label>

                <label class="mt-checkbox">
                <input type="checkbox" value="1" <?php if($rs->show_ialerts == 1){ echo 'checked'; } ?> name="show_ialerts"> Show iAlerts?
                <span></span>
                </label>

                <label class="mt-checkbox">
                <input type="checkbox" value="1" <?php if($rs->show_reports == 1){ echo 'checked'; } ?> name="show_reports"> Show Reports?
                <span></span>
                </label>

                <label class="mt-checkbox">
                <input type="checkbox" value="1" <?php if($rs->show_influencers == 1){ echo 'checked'; } ?> name="show_influencers"> Show Influencers?
                <span></span>
                </label>

            </div>
        </div>

        <div class="row">
            <button type="submit" class="btn green">Submit</button>
            <a href="{{ route('GetListAccounts') }}" class="btn default">Cancel</a>
        </div>


    </div>

    </form>
    @else
    <br />
    <p><b>No Result Found</b></p>


    @endif




            </div>
        </div>

    </div>
</div>


@endsection
