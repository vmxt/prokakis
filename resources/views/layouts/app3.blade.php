<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
   <link href="{{ asset('public/css/app.css') }}" rel="stylesheet"> 
   
   
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
    <script>
  $( function() {
    var availableTags = [
      "Manufacturer",
      "Non_Profit",
      "Retailer",
      "Warehouse_Logistics",
      "Consultant",
      "Contractor",
      "Distributor",
      "Holding_Company_Investments",
      "Import_Export",
      "Service_Provider",
      "Institution"
    ];
    $( "#keywordSearch" ).autocomplete({
      source: availableTags
    });
    
    
     var availableCountry = [
      "USA",
      "Singapore",
      "Japan",
      "Philippines",
      "Malaysia",
      "China",
      "France",
      "Germany",
      "Saudi Arabia",
      "England",
      "Taiwan"
    ];
    $( "#keywordCountry" ).autocomplete({
      source: availableCountry
    });
    
  } );
  </script>
   
</head>
<body>
    <style>
    .btn-x4 {
    font-size: 15px;
    border-radius: 5px;
    width: 15%;
    background-color: orangered;
    }

    .active{
        background-color: orangered;  
        padding: 5px; 
        border-radius: 7px;
    }

    .navbar-brand{
        font-size: 0.98rem;
    }

    .navbar{
        padding: 0.2rem;   
       }


</style>


<?php 
$activeDashboard     = '';
$activeProfile       = '';
$activeOpportunity   = '';
$activeReport        = '';
$activeMail          = '';
$activeSettings      = '';
$activeConsultant    = '';


if(route('home') == Request::url()
|| route('businessnewsIndex') == Request::url()) {  
    $activeDashboard = 'active';
}
if(route('viewingProfile') == Request::url() 
|| route('indexContacts') == Request::url()
|| route('indexBilling') == Request::url() 
|| route('indexPaymentHistory') == Request::url() 
|| route('indexSocialAccounts') == Request::url() 
|| route('deactivateAccountPage') == Request::url()
|| route('editProfile') == Request::url()
) {  
    $activeProfile = 'active';
}
if(route('opportunityIndex') == Request::url() 
|| route('opportunityExploreIndex') == Request::url() 
) {  
    $activeOpportunity = 'active';
}
if(route('reportIndex') == Request::url()) {  
    $activeReport = 'active';
}
if(route('mailCompose') == Request::url()) {  
    $activeMail = 'active';
}
if(route('sysIndex') == Request::url()
|| route('assignConsultants') == Request::url() ) {  
    $activeSettings = 'active';
}
if(route('indexConsultantFAreport') == Request::url()) {  
    $activeConsultant = 'active';
}


?>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="background-color:coral; margin-bottom:0px;">
            <div class="container">
                <div class="navbar-header" style="color:white;">
                  
                    <!-- Branding Image -->
                    @guest
                    <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
                        {{ config('app.name', 'Intellinz') }}
                    </a>
                    @else
                    
                    <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
                        {{ config('app.name', 'Intellinz') }}
                    </a>
                    
                    <a class="navbar-brand <?php echo $activeDashboard; ?>" href="{{ url('/home') }}" style="color:white;">
                            Dashboard
                            </a>
        
                            <a class="navbar-brand <?php echo $activeProfile; ?>" href="{{ url('/profile/view') }}" style="color:white;">
                            Profile
                            </a>
        
                            <a class="navbar-brand <?php echo $activeOpportunity; ?>" href="{{ url('/opportunity') }}" style="color:white;">
                                Opportunities
                            </a>
        
                            <a class="navbar-brand <?php echo $activeReport; ?>" href="{{ url('/reports') }}" style="color:white;">
                                Report
                            </a>
        
                            <a class="navbar-brand <?php echo $activeMail; ?>" href="{{ route('mailCompose') }}" style="color:white;">
                               Mailbox
                            </a>
                       
                       
                            <a class="navbar-brand <?php echo $activeConsultant; ?>" href="{{ url('/consultants') }}" style="color:white;">
                                Consultant
                            </a>
        
                            <a class="navbar-brand <?php echo $activeSettings; ?>" href="{{ url('/sysconfig') }}" style="color:white;">
                                Settings
                            </a>
        
                            <a style="float:right; color:white" class="navbar-brand" href="{{ url('/logout') }}" style="color:white;">
                                Logout
                            </a>
                    @endguest


                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                           <li class="nav-item">
                            <!-- <a href="#">
                                    {{ Auth::user()->firtsname }} <span class="caret"></span>
                                </a> -->
                             
                            <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                            </form>
                             
                            </li>  
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

            @guest
            <!-- bread crumbs empty if there is no session -->
            @else
                <!-- 2nd LAYER MENU  -->
                 <?php if(Request::is('profile/*') || Request::is('sysconfig/*')){ ?>
                    
                    <nav class="navbar navbar-default navbar-static-top" style="background-color: #363636;">
                 
                        
                      <?php if(Route::getFacadeRoot()->current()->uri() == 'sysconfig'){  ?>  
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/sysconfig') }}" style="color:white;">
                          Settings and Configurations
                            </a>
                        </div>
                      <?php }  ?>
                        
                      <?php if(Route::getFacadeRoot()->current()->uri() == 'home'){  ?>  
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/home') }}" style="color:white;">
                           Dashboard
                            </a>
                        </div>
                      <?php }  ?>  
                        
                      
                       <?php if(Route::currentRouteName() == 'editProfile' || 
                               Route::currentRouteName() == 'indexContacts' ||
                               Route::currentRouteName() == 'indexBilling' ||
                               Route::currentRouteName() == 'indexPaymentHistory' ||
                               Route::currentRouteName() == 'indexSocialAccounts'){
                        ?>  
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/profile/view') }}" style="color:white;">
                           Profile Setting | <b><?php if(Session::get('brandName') != null){ echo Session::get('brandName'); } ?></b> | <span style="color:yellowgreen">[click to preview profile]</span>
                            </a>  </div>
                      <?php }  ?>  
                        
                       <?php if( Route::currentRouteName() == 'viewingProfile') {  ?>  
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/profile/edit') }}" style="color:white;">
                           Profile Setting | <b><?php if(Session::get('brandName') != null){ echo Session::get('brandName'); } ?></b> | <span style="color:yellowgreen">[click to edit profile]</span>
                            </a> 
                        </div>
                      <?php }  ?> 
                        
                    </nav>
                    <?php }  ?>
                    
                
                   <?php if(Route::currentRouteName() == 'opportunityIndex' || Request::is('opportunity/*')){ ?>
                       <nav class="navbar navbar-default navbar-static-top" style="background-color: white; padding: 15px;border-radius: 10px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); margin-bottom: 10px;">
                       <div class="container">
                            <a href="{{ url('/opportunity') }}" class="navbar-brand" style="color:black;">MY OPPORTUNITIES</a> 
                            <a href="{{ url('/opportunity/explore') }}" class="navbar-brand" style="color:black;">EXPLORE</a>
                             
                            <a href="{{ url('/opportunity/select') }}" class="btn btn-primary btn-x4" style="color: white">Add An Opportunity</a>
                         </div> 
                       </nav>  
                    <?php }  ?>
                
            
                    <!-- 3RD LAYER MENU  -->
                    <?php /*if(Route::getFacadeRoot()->current()->uri() == 'profile/view' || 
                            Route::getFacadeRoot()->current()->uri() == 'profile/edit' || 
                            Route::getFacadeRoot()->current()->uri() == 'profile/contacts' ||
                            Route::currentRouteName() == 'indexBilling' ||
                            Route::currentRouteName() == 'indexPaymentHistory' ||
                            Route::currentRouteName() == 'indexSocialAccounts'){ */
                         if(Request::is('profile/*')){  
                        ?>  
                     <nav class="navbar navbar-default navbar-static-top" style="background-color: white; padding: 1px;border-radius: 3px;box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); margin-bottom: 10px;">
                         <div class="container">
                            <a href="{{ url('/profile/contacts') }}" class="navbar-brand" style="color:black;">Contacts</a> | 
                            <a href="{{ url('/profile/billing') }}" class="navbar-brand" style="color:black;">Billing</a> | 
                            <a href="{{ url('/profile/paymentHistory') }}" class="navbar-brand" style="color:black;">Payment History</a> | 
                            <a href="{{ url('/profile/socialAccounts') }}" class="navbar-brand" style="color:black;">Social Media Accounts</a> 
                         </div> 
                      </nav>   
                    </div>
                    <?php }  ?> 
                    <!-- 3RD LAYER MENU  --> 
    
                      
            @endguest
      

            @yield('content')
    </div>

  
</body>
</html>
