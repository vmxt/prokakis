@extends('layouts.app')

@section('content')
<style>
    .card{
        border:1px solid silver;
        border-radius:5px;
    }  
    .card-body{
        padding:20px;
    }  
    .cur_symbol{
        font-size:15px !important;
    }
     .loading {
      position: fixed;
      z-index: 999;
      height: 2em;
      width: 2em;
      overflow: show;
      margin: auto;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
    }
    
    /* Transparent Overlay */
    .loading:before {
      content: '';
      display: block;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
        background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));
    
      background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
    }
    
    /* :not(:required) hides these rules from IE9 and below */
    .loading:not(:required) {
      /* hide "loading..." text */
      font: 0/0 a;
      color: transparent;
      text-shadow: none;
      background-color: transparent;
      border: 0;
    }
    
    .loading:not(:required):after {
      content: '';
      display: block;
      font-size: 10px;
      width: 1em;
      height: 1em;
      margin-top: -0.5em;
      -webkit-animation: spinner 150ms infinite linear;
      -moz-animation: spinner 150ms infinite linear;
      -ms-animation: spinner 150ms infinite linear;
      -o-animation: spinner 150ms infinite linear;
      animation: spinner 150ms infinite linear;
      border-radius: 0.5em;
      -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
    box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
    }
    
    /* Animation */
    
    @-webkit-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @-moz-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @-o-keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @keyframes spinner {
      0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    
    .amount_css{
        text-align:right !important;
    }
    
    .text-center{
        text-align:center !important;
    }
    
    .mb-2{
        margin-bottom:15px;
    }
    
    
    .procedure_img{
        width:50%;margin-left:20px;
        border:1px solid silver;
    }
    .procedure_img:hover{
        cursor: pointer;
     }
     #hidden_fullscreen {
        z-index:9999999999999;
        display:none;
        background-color:rgb(0,0,0, 0.7);
        position:fixed;
        height:100%;
        width:100%;
        left: 0px;
        top: 0px;    
        text-align: center;
        justify-content: center;
    }
    .close_fullscreen {
        position: absolute;
        right: 5px;
        top: 5px;
        background: red;
        color: white;
        cursor: pointer;
        width: 35px;
        height: 35px;
        text-align: center;
        line-height: 30px;
        border-radius:50px;
        font-weight:bold;
    }
    
    .nav-tabs > li.active {
        border-bottom:3px solid black !important;
    }
    .nav-tabs > li.active a {
        color:#7cda24 !important;   
        font-weight:bold;
    }
    #org_txt:hover {
        text-decoration: underline #4183c4
    }
</style>

    <link href='https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.css' rel="stylesheet" type="text/css" />
    <link href='https://cdn.datatables.net/1.12.1/css/dataTables.semanticui.min.css' rel="stylesheet" type="text/css" />
    
    
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/dataTables.semanticui.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.8.8/semantic.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<?php session_start(); ?>

<div class="loading text-company" style="display:none;">Loading&#8230;</div>
<!-- Modal -->
<div class="modal fade" style="z-index:9999999999998;" id="procedure_modal" tabindex="-1" role="dialog" aria-labelledby="procedure_modal_label" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:80%">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="procedure_modal_label">How to Connect to your Xero Account <i class="text-dark">(Click the image to enlarge)</i></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 1: </b> Go to <a class="" target="_blank" href="https://developer.xero.com/">https://developer.xero.com/</a></p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 2: </b> Click login.</p>
                <img class="img-fluid procedure_img"  src="{{ asset('public/assets/xero_images/login1.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 3: </b> Skip this step if you are already logged in. If not, enter your xero account.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/login.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 4: </b> Connect your organisation by clicking the button (Connect your Xero organisation). It will redirected you to a page which you need to allowed the API to have access to your organisation. Click the allow access to proceed.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step1.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 5: </b> After that, go to "My Apps" menu and click New app.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step2.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 6: </b> Provide App Name (App Name should based on your company/organisation name) and select Web App as integration type.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step3.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 7: </b> In the "Company or Application URL", copy and enter this link<br>
                
                <b>{{ env('APP_URL') }} <button name="{{ env('APP_URL') }}" class="copy_btn btn btn-xs btn-primary">COPY</button></b> 
                <br><br>
                and in "Redirect URL", copy and enter this link
                <br>
                <b>{{ env('APP_URL') }}company/goXeroAnalytics <button name="{{ env('APP_URL') }}company/goXeroAnalytics" class=" copy_btn btn btn-xs btn-primary">COPY</button></b>.</p>
                
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step4.png') }}" />
                
                <p>and click "Create App"</p>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 8: </b> Under My Apps menu, go to Configuration.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step5.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 9: </b> Generate a secret id clicking "Generate a secret" <i>(Note: Please copy immediately the generated secret key and save it as it disappear once the page is loaded again).</i>.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step6.png') }}" />
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12 mb-2">
                <p><b>Step 10: </b> You will now have a client id and secret id that is needed to connect your Xero account to Intellinz App.</i>.</p>
                <img class="img-fluid procedure_img" src="{{ asset('public/assets/xero_images/step7.png') }}" />
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="hidden_fullscreen">
    <img id="fullscreen_img" class="img-fluid" style="width:90%;height:90%;margin-top:1%" />
<div class="close_fullscreen">X</div>
</div>

<script>
     $('.procedure_img').click( function(e) {
        $("#fullscreen_img").attr("src", $(this).attr("src"));
          e.preventDefault();
          $("#hidden_fullscreen").show();
          $("#hidden_fullscreen").css("display","flex")
      });
      $('.close_fullscreen').click(function(){
          $("#hidden_fullscreen").hide();
      });
      $(".copy_btn").click(function(){
          var val = $(this).attr("name");
          navigator.clipboard.writeText(val);

          alert("Copied the text: " + val);
      });
</script>
<div class="modal" id="main_details_modal" style="z-index:2147483646 !important" data-backdrop="static">
	<div class="modal-dialog" style="margin:50px auto !important; width:70% !important">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title main_details_label"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body">
            <table class="table" id="main_details_table"></table>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
          <!--<a href="#" class="btn btn-primary">Save changes</a>-->
        </div>
      </div>
    </div>
</div>

<div class="container container-grid">
    <?php 
    $company_id_result = App\CompanyProfile::getCompanyId(Auth::id());
                if(isset($_SESSION['oauth2state']) && $_SESSION['oauth2state'] != "" && $_SESSION['oauth2state'] != null){
                    if( isset($_GET['code']) && !empty($_GET['state']) && $_GET['state'] == $_SESSION['oauth2state'] ){
                        try {
                            unset($_SESSION["oauth2state"]);
                            $xero_data = App\XeroConnection::where('company_id', "=", $company_id_result)->where('status', "=", "0")->where('if_process', "=", "0")
                            ->orderBy("created_at","desc")->first();
                            
                            if ($xero_data != null) {
                                
                                $provider = new \League\OAuth2\Client\Provider\GenericProvider([
                                    'clientId'                => $xero_data->client_id,
                                    'clientSecret'            => $xero_data->secret_id,
                                    'redirectUri'             => env("APP_URL").'company/goXeroAnalytics',
                                    'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
                                    'urlAccessToken'          => 'https://identity.xero.com/connect/token',
                                    'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
                                ]);
                                
            					$xero_data->if_process = 1;
            					$xero_data->save();
            					
            					$accessToken = $provider->getAccessToken('authorization_code', [
                                    'code' => $_GET['code']
                                ]);
                                
                                $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( (string)$accessToken->getToken() );
                                $identityInstance = new XeroAPI\XeroPHP\Api\IdentityApi(
                                    new GuzzleHttp\Client(),
                                    $config
                                );
                            
                                $result = $identityInstance->getConnections();
                                
                                $token_ok = App\XeroTokenInfo::create([
                        			'connection_id' => $xero_data->id,
                        			'token' => $accessToken->getToken(),
                                    'expires' => $accessToken->getExpires(),
                                    'tenant_id' => "",
                                    'refresh_token' => $accessToken->getRefreshToken(),
                                    'id_token' => $accessToken->getValues()["id_token"]
                        	    ]);
                        	    
                        	    if($token_ok){
                        	        $s = 1;
                        	        for($x = 0; $x <= count($result) - 1; $x++){
                        	            $tenant_ok = App\XeroTenantId::create([
                        	                'tenant_id' => $result[$x]->getTenantId(),
                        	                'token_id' => $token_ok->id,
                        	                'status' => $s
                        	            ]);
                        	            $s = 0;
                        	        }
                        	        
                        	        $xero_data->status = 1;
            					    $xero_data->save();
                        	    }
        					}
                        }
                        catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                          echo "Xero Connection failed!";
                          exit();
                        }
                    }
                }
            ?>
    
    <?php $xero_info = \App\Http\Controllers\XeroController::checkIfConnected(); ?>
            <?php $if_xero_edit = isset($_GET["editxero"]) ? $_GET["editxero"] : ""; ?>
            
            <div class="card" style=";">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class=" note-success" style="margin-bottom:0px !important">
                            <h4 class="xero_logo"><img src="https://edge.xero.com/images/1.0.0/logo/xero-logo.svg" class="img-fluid" style="width:60px" /><strong>&nbsp;&nbsp;XERO INTEGRATION</strong></h4>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <?php if($xero_info != null && $if_xero_edit != true){  ?>
                        <!--<button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#update_xxxx" id="update_xero_btn"><i class="fa fa-edit"></i> UPDATE XERO CLIENT AND SECRET ID</button>-->
                        <form method="post" action="{{ route('tryDisconnectXero') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <button class="pull-right" type="submit" style="border:none !important" id="disconnect_xero_btn">
                            <svg height="43" viewBox="0 0 222 43" width="222" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><path id="a" d="m60.1160001 26v-10.688h3.184c3.008 0 5.28 1.616 5.28 5.312 0 3.68-2.272 5.376-5.28 5.376zm1.344-9.536v8.384h1.84c1.952 0 3.872-1.024 3.872-4.224 0-3.216-1.92-4.16-3.872-4.16zm10.928-.896c0 .544-.4.96-.944.96s-.944-.416-.944-.96.4-.96.944-.96.944.416.944.96zm-1.6 2.432h1.312v8h-1.312zm3.328 5.984 1.2-.336c.128.912.944 1.536 1.968 1.536 1.04 0 1.744-.416 1.744-1.264 0-2.112-4.56-.56-4.56-3.712 0-1.504 1.2-2.4 2.8-2.4 1.744 0 2.736.768 2.896 2.224l-1.232.176c-.08-.848-.608-1.392-1.664-1.392-.976 0-1.568.48-1.568 1.296 0 2.096 4.56.464 4.56 3.712 0 1.52-1.28 2.368-2.976 2.368-1.664 0-2.928-.8-3.168-2.208zm7.744-1.984c0-2.624 1.408-4.192 3.568-4.192 1.632 0 2.768.992 2.928 2.448l-1.2.224c-.08-.88-.688-1.632-1.728-1.632-1.488 0-2.24 1.28-2.24 3.152s.752 3.152 2.24 3.152c1.04 0 1.648-.736 1.728-1.664l1.2.224c-.224 1.552-1.296 2.48-2.928 2.48-2.16 0-3.568-1.552-3.568-4.192zm15.184 0c0 2.688-1.456 4.192-3.584 4.192s-3.584-1.504-3.584-4.192 1.456-4.192 3.584-4.192 3.584 1.504 3.584 4.192zm-1.328 0c0-2.064-.784-3.168-2.256-3.168s-2.256 1.104-2.256 3.168.784 3.168 2.256 3.168 2.256-1.104 2.256-3.168zm4.5439999-4 .16 1.552c.448-1.104 1.424-1.744 2.688-1.744 1.456 0 2.464.96 2.464 2.576v5.616h-1.312v-5.344c0-1.024-.496-1.696-1.568-1.696-1.136 0-2.096.656-2.096 2.4v4.64h-1.3119999v-8zm9.024 0 .16 1.552c.448-1.104 1.424-1.744 2.688-1.744 1.456 0 2.464.96 2.464 2.576v5.616h-1.312v-5.344c0-1.024-.496-1.696-1.568-1.696-1.136 0-2.096.656-2.096 2.4v4.64h-1.312v-8zm11.04 7.152c.96 0 1.648-.448 1.888-1.456l1.136.32c-.368 1.552-1.6 2.176-3.024 2.176-2.192 0-3.568-1.456-3.568-4.16 0-2.608 1.408-4.224 3.568-4.224 2 0 3.104 1.456 3.104 3.36 0 .464-.08.864-.16 1.072h-5.248c.064 1.792.864 2.912 2.304 2.912zm-2.272-3.872h4.064c.016-.144.016-.304.016-.416 0-1.12-.64-2.048-1.84-2.048-1.28 0-2.064.912-2.24 2.464zm7.104.72c0-2.624 1.408-4.192 3.568-4.192 1.632 0 2.768.992 2.928 2.448l-1.2.224c-.08-.88-.688-1.632-1.728-1.632-1.488 0-2.24 1.28-2.24 3.152s.752 3.152 2.24 3.152c1.04 0 1.648-.736 1.728-1.664l1.2.224c-.224 1.552-1.296 2.48-2.928 2.48-2.16 0-3.568-1.552-3.568-4.192zm12.544 2.672.24 1.04c-.464.288-1.088.48-1.648.48-1.488 0-2.384-.72-2.384-2.208v-4.976h-1.152v-1.008h1.152v-1.696l1.312-.208v1.904h2.4v1.008h-2.4v4.848c0 .88.48 1.232 1.168 1.232.528 0 .864-.128 1.312-.416zm6.416-5.664h-1.168v-1.008h1.168v-.912c0-1.744 1.168-2.832 2.704-2.832.576 0 1.04.144 1.472.368l-.304 1.104c-.352-.272-.64-.384-1.136-.384-.928 0-1.424.656-1.424 1.776v.88h2.048v1.008h-2.048v6.992h-1.312zm9.168-1.152-.08 1.376c-.144-.032-.416-.048-.64-.048-1.264 0-2.192 1.024-2.192 2.768v4.048h-1.312v-8h1.04l.176 2.048c.32-1.424 1.52-2.464 3.008-2.192zm8.208 4.144c0 2.688-1.456 4.192-3.584 4.192s-3.584-1.504-3.584-4.192 1.456-4.192 3.584-4.192 3.584 1.504 3.584 4.192zm-1.328 0c0-2.064-.784-3.168-2.256-3.168s-2.256 1.104-2.256 3.168.784 3.168 2.256 3.168 2.256-1.104 2.256-3.168zm9.472-2.512c.448-1.04 1.328-1.68 2.48-1.68 1.44 0 2.464.864 2.464 2.496v5.696h-1.312v-5.36c0-1.024-.432-1.68-1.552-1.68-.992 0-1.904.672-1.904 2.384v4.656h-1.312v-5.36c0-1.024-.448-1.68-1.552-1.68-1.008 0-1.904.688-1.904 2.4v4.64h-1.312v-8h.976l.16 1.552c.384-1.12 1.344-1.744 2.48-1.744s1.984.624 2.288 1.68zm17.952 6.512-2.88-4.384h-.032l-2.896 4.384h-1.472l3.664-5.488-3.424-5.2h1.536l2.64 4.128h.032l2.656-4.128h1.488l-3.44 5.168 3.68 5.52zm6.192-.848c.96 0 1.648-.448 1.888-1.456l1.136.32c-.368 1.552-1.6 2.176-3.024 2.176-2.192 0-3.568-1.456-3.568-4.16 0-2.608 1.408-4.224 3.568-4.224 2 0 3.104 1.456 3.104 3.36 0 .464-.08.864-.16 1.072h-5.248c.064 1.792.864 2.912 2.304 2.912zm-2.272-3.872h4.064c.016-.144.016-.304.016-.416 0-1.12-.64-2.048-1.84-2.048-1.28 0-2.064.912-2.24 2.464zm11.824-3.424-.08 1.376c-.144-.032-.416-.048-.64-.048-1.264 0-2.192 1.024-2.192 2.768v4.048h-1.312v-8h1.04l.176 2.048c.32-1.424 1.52-2.464 3.008-2.192zm8.208 4.144c0 2.688-1.456 4.192-3.584 4.192s-3.584-1.504-3.584-4.192 1.456-4.192 3.584-4.192 3.584 1.504 3.584 4.192zm-1.328 0c0-2.064-.784-3.168-2.256-3.168s-2.256 1.104-2.256 3.168.784 3.168 2.256 3.168 2.256-1.104 2.256-3.168z"/></defs><g fill="none"><rect fill="#f4f4f4" height="43" rx="4" width="222"/><g transform="translate(9 5)"><path d="m16.4995319 0c-9.11353873 0-16.4995319 7.38765603-16.4995319 16.5 0 9.1115118 7.38599317 16.5 16.4995319 16.5 9.110834 0 16.5004681-7.3884882 16.5004681-16.5 0-9.11234397-7.3896341-16.5-16.5004681-16.5" fill="#13b5ea"/><path d="m16.8210417 13.1529405c-.5917606-.3667099-1.2823572-.5604607-1.9972182-.5604607-.7887004 0-1.5396445.2313595-2.1716716.669108-.9878365.6847018-1.5775054 1.8030753-1.5775054 2.9919777 0 .2984232.037861.5947061.1124324.8804911.3796556 1.4476786 1.6564696 2.5426103 3.1772881 2.7245384.1470512.0171227.2943115.0258878.4375975.0258878.3046657 0 .601069-.0378125.9057347-.1150682.396076-.0928496.7734306-.2491956 1.1219188-.4645536.329244-.2079178.6324455-.4880972.9513352-.8788603l.0209177-.0210976c.1061571-.1291332.1555228-.2951617.1353372-.4553807-.0180937-.1434021-.0884817-.2672355-.1980902-.3484661-.1039608-.0780711-.2277933-.1210816-.3485928-.1210816-.1177665 0-.2907555.0415836-.4472196.2403285l-.0122369.0158996c-.0516666.0671656-.1051112.1365735-.1666091.2054717-.2107455.230748-.452972.4208297-.719463.5648434-.3815381.1982353-.7937206.3002577-1.2242061.3033153-1.3523268-.0144727-2.180457-.8917023-2.5040532-1.7064547-.0508299-.1466635-.0871221-.2805871-.1104453-.4047262-.0004183-.0126381-.0013596-.0257859-.0021963-.0387298l5.2357952-.0009173c.3636535-.0075421.6683192-.1369811.8577286-.3643657.1714203-.2058794.2358467-.4751533.181147-.7590019-.2228777-1.0285815-.7961262-1.8525067-1.6577247-2.3826971zm-4.5758429 2.4481301c.2985996-1.1411018 1.350758-1.9376104 2.5596942-1.9376104 1.2152115 0 2.2624542.7944702 2.5623089 1.9376104zm13.6366416-.3005635c-.5269159 0-.9556233.4167528-.9556233.9289033 0 .5123543.4287074.9291071.9556233.9291071.52587 0 .9537408-.4167528.9537408-.9291071 0-.5121505-.4278708-.9289033-.9537408-.9289033zm-3.4273588-2.1263671c0-.2910849-.2441091-.5278462-.5434408-.5278462l-.1530127-.0021403c-.4644766 0-.9036429.1387138-1.2735718.4017705-.0708063-.2130138-.2779957-.362735-.511646-.362735-.3011097 0-.5384206.2300346-.5403032.5238713l.001778 6.0813915c.0019872.28976.2439.5254001.5394665.5254001.2973446 0 .5393619-.2357421.5393619-.5256039v-3.7400741c0-1.2117327.1070984-1.7182775 1.1844626-1.8481242.0893184-.0103959.1852259-.0110074.2095949-.0110074.3171118-.0112113.5473106-.2276904.5473106-.5149023zm-14.20832125 3.0552704 2.79407655-2.7315709c.1021828-.0977418.1585559-.2291173.1585559-.3698695 0-.2905753-.2436907-.5270308-.5431271-.5270308-.1449594 0-.2816563.0559543-.3847803.1573652l-2.7942858 2.7178117-2.80537212-2.7229077c-.10228736-.0981494-.2378338-.1522692-.3818519-.1522692-.29797208 0-.54030318.2364555-.54030318.5270308 0 .141058.05783733.2748796.16284399.3766981l2.79606375 2.7226019-2.79188022 2.7259653c-.10772595.1001879-.16702752.2347229-.16702752.3786346 0 .2904734.2423311.526929.54030318.526929.14182174 0 .27736819-.0538141.38206108-.1520654l2.80244365-2.7287172 2.79031139 2.7159771c.1069938.1071185.2459917.1661304.391474.1661304.2994364 0 .5431271-.2369651.5431271-.5282539 0-.1391214-.0562685-.2709046-.1583467-.3713982zm17.63568005-3.646715c-2.0639456 0-3.7431109 1.6359257-3.7431109 3.646715 0 2.0102796 1.6791653 3.6457977 3.7431109 3.6457977 2.0628997 0 3.7412283-1.6355181 3.7412283-3.6457977 0-2.0107893-1.6783286-3.646715-3.7412283-3.646715zm0 6.2017596c-1.4469792 0-2.6241206-1.1461978-2.6241206-2.5550446 0-1.4104776 1.1771414-2.5580004 2.6241206-2.5580004 1.4454104 0 2.6212967 1.1475228 2.6212967 2.5580004 0 1.4088468-1.1758863 2.5550446-2.6212967 2.5550446z" fill="#fff"/></g><use fill="#000" xlink:href="#a"/><use fill="#0d84ab" xlink:href="#a"/></g></svg>
                            </button>
                        </form>
                        <button class="btn btn-primary pull-right" type="button"  id="update_xero_btn"><i class="fa fa-edit"></i> UPDATE XERO</button>
                        
                        <?php } ?>
                        <?php if($if_xero_edit == true){  ?>
                                <button class="btn btn-danger xero_editcancel_btn pull-right" type="button"  id=""><i class="fa fa-edit"></i> CANCEL</button>
                            <?php } ?>
                    </div>
                </div>
        
        <style>
            .form-check-label{
                font-size:13px !important;
            }
            
            .check_lbl, .under_label{
                 font-size:11px !important;
            }
            .link_label{
                font-size:12px !important;
            }
            .ui.grid{
                margin-left:0 !important;
            }
            .odd-row{
                background-color:white !important;
            }
            .even-row{
                background-color:whitesmoke !important;
            }
            .paginate_button.active{
                background:black !important;
                color:white !important;
            }
            
        </style>
        <div class="card-body">
            
            <?php if($xero_info == null || $if_xero_edit == true){  ?>
            <form method="post" action="{{ route('saveConnection') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            
                <p><i class="text-danger">Your account is not connected to XERO. Please input your xero client id and secret id below. If you dont have that, please follow the procedure provided by clicking the button below: </i>
                <button type="button" class="btn btn-info " data-toggle="modal" data-target="#procedure_modal" style="margin-top:5px">OPen XERO Connection Procedure</button></p>
                <br>
                <?php
                    $scopes_q = App\XeroScopes::where("connection_id", "=", isset($xero_info->id) ? $xero_info->id : "")->first();
                    $scopes = explode(" ", $scopes_q["scope"]);
                ?>
                <div class="form-group">
                    <div class="card">
                        <div class="card-body" id="scope_div">
                            <h4>XERO SCOPES <i class="text-dark">(Please select XERO features you want to add in Intellinz App)</i></h4>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <div class="card-body" >
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="openid" name="openid[]" id="openid" checked disabled>
                                              <label class="form-check-label" for="openid">
                                                openid
                                              </label>
                                            </div>
                                            <label class="check_lbl">your application intends to use the user’s identity</label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 mb-2">
                                     <div class="card">
                                        <div class="card-body" >
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="profile" name="profile[]" id="profile" checked disabled>
                                              <label class="form-check-label" for="profile">
                                                profile
                                              </label>
                                            </div>
                                            <label class="check_lbl">first name, last name, full name and xero user id</label>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <div class="card-body" >
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="email" name="email[]" id="email" checked >
                                              <label class="form-check-label" for="email">
                                                email
                                              </label>
                                            </div>
                                            <label class="check_lbl">email address</label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <div class="card-body" >
                                            <div class="form-check">
                                            <div class="form-check">
                                              <label class="form-check-label" for="accountingtransactionsno">
                                                <input class="form-check-input" type="radio" name="accountingtransactionschoice[]" value="" id="accountingtransactionsno" <?php if(!in_array('accounting.transactions', $scopes) && !in_array('accounting.transactions.read', $scopes)){ echo "checked"; } ?>>
                                                No Accounting Access
                                              </label>
                                            </div>
                                            
                                              <label class="form-check-label" for="accountingtransactions">
                                                  <input class="form-check-input" type="radio" name="accountingtransactionschoice[]" value="accounting.transactions" id="accountingtransactions" <?php if(in_array('accounting.transactions', $scopes)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                accounting.transactions <br><i class="text-dark under_label">(View and manage your business transactions)</i>
                                              </label>
                                            </div>
                                            <div class="form-check mb-2">
                                              <label class="form-check-label" for="accountingtransactionsread">
                                                <input class="form-check-input" type="radio" name="accountingtransactionschoice[]" value="accounting.transactions.read" id="accountingtransactionsread" <?php if(in_array('accounting.transactions.read', $scopes)){ echo "checked"; } ?>>
                                                accounting.transactions.read <br><i class="text-dark under_label">(View your business transactions)</i>
                                              </label>
                                            </div>
                                            
                                            <?php 
                                                $companyaccessq = App\XeroFeaturesAccess::where("scope_id", "=", isset($scopes_q["id"]) ? $scopes_q["id"] : "")->first();
                                                $companyaccess = explode(",", $companyaccessq["access"]);
                                            ?>
                                            
                                            <div class="card" id="accountingtransactionaccess_div">
                                                <div class="card-body" >
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingtransactionaccess[]" value="invoices" id="invoices" <?php if(in_array('invoices', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="invoices">
                                                        Invoices
                                                      </label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingtransactionaccess[]" value="quotes" id="quotes" <?php if(in_array('quotes', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="quotes">
                                                        Quotes
                                                      </label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingtransactionaccess[]" value="purchaseorder" id="purchaseorder" <?php if(in_array('purchaseorder', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="purchaseorder">
                                                        Purchase Order
                                                      </label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingtransactionaccess[]" value="manualjournal" id="manualjournal" <?php if(in_array('manualjournal', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="manualjournal">
                                                        Manual journal
                                                      </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <script>
                                                <?php 
                                                    if(!in_array('accounting.transactions', $scopes) && !in_array('accounting.transactions.read', $scopes) && $if_xero_edit == true){ ?> 
                                                    $("#accountingtransactionaccess_div").hide();
                                                    $('input[name="accountingtransactionaccess[]"]').removeAttr("checked"); <?php }
                                                ?>
                                                <?php 
                                                    if(!in_array('accounting.reports.read', $scopes)){ ?> 
                                                    $("#accountingreportsread_div").hide(); 
                                                    $('input[name="accountingreportsreadaccess[]"]').removeAttr("checked"); <?php }
                                                ?>
                                                <?php 
                                                    if(!in_array('accounting.contacts', $scopes) && !in_array('accounting.contacts.read', $scopes)){ ?> 
                                                    $("#accountingcontactsaccess_div").hide(); 
                                                    $('input[name="accountingcontactsaccess[]"]').removeAttr("checked"); <?php }
                                                ?>
                                                $('input[name="accountingtransactionschoice[]"]').click(function(){
                                                    var val = $(this).val();
                                                    if(val == ""){
                                                        $("#accountingtransactionaccess_div").hide();
                                                        $('input[name="accountingtransactionaccess[]"]').removeAttr("checked");
                                                    }
                                                    else{
                                                        $("#accountingtransactionaccess_div").show();
                                                        $('input[name="accountingtransactionaccess[]"]').prop("checked",true);
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <div class="card-body" >
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" value="accounting.reports.read" name="accountingreportsread[]" id="accountingreportsread" <?php if(in_array('accounting.reports.read', $scopes)){ echo "checked"; }else{ echo "checked"; } ?>>
                                              <label class="form-check-label" for="accountingreportsread">
                                                accounting.reports.read
                                              </label>
                                            </div>
                                            <label class="check_lbl mb-2">View your reports</label>
                                           
                                            <div class="card" id="accountingreportsread_div">
                                                <div class="card-body" >
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingreportsreadaccess[]" value="profitandloss" id="profitandloss" <?php if(in_array('profitandloss', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="profitandloss">
                                                        Profit and Loss
                                                      </label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingreportsreadaccess[]" value="trialbalance" id="trialbalance" <?php if(in_array('trialbalance', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="trialbalance">
                                                        Trial Balance
                                                      </label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingreportsreadaccess[]" value="balancesheet" id="balancesheet" <?php if(in_array('balancesheet', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="balancesheet">
                                                        Balance Sheet
                                                      </label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <script>
                                                
                                                $('input[name="accountingreportsread[]"]').click(function(){
                                                    
                                                    if( !$(this).is(":checked") ){
                                                        $("#accountingreportsread_div").hide();
                                                        $('input[name="accountingreportsreadaccess[]"]').removeAttr("checked");
                                                    }
                                                    else{
                                                        $("#accountingreportsread_div").show();
                                                        $('input[name="accountingreportsreadaccess[]"]').prop("checked",true);
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-md-4 mb-2">
                                    <div class="card">
                                        <div class="card-body" >
                                            <div class="form-check">
                                            <div class="form-check">
                                              <label class="form-check-label" for="accountingcontactsno">
                                                <input class="form-check-input" type="radio" name="accountingcontactschoice[]" value="" id="accountingcontactsno" <?php if(!in_array('accounting.contacts', $scopes) && !in_array('accounting.contacts.read', $scopes)){ echo "checked"; } ?>>
                                                No Contact Access
                                              </label>
                                            </div>
                                            
                                              <label class="form-check-label" for="accountingcontacts">
                                                  <input class="form-check-input" type="radio" name="accountingcontactschoice[]" value="accounting.contacts" id="accountingcontacts" <?php if(in_array('accounting.contacts', $scopes)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                accounting.contacts <br><i class="text-dark under_label">(View and manage your contacts)</i>
                                              </label>
                                            </div>
                                            <div class="form-check mb-2">
                                              <label class="form-check-label" for="accountingcontactsread">
                                                <input class="form-check-input" type="radio" name="accountingcontactschoice[]" value="accounting.contacts.read" id="accountingcontactsread" <?php if(in_array('accounting.contacts.read', $scopes)){ echo "checked"; } ?>>
                                                accounting.contacts.read <br><i class="text-dark under_label">(View your contacts)</i>
                                              </label>
                                            </div>
                                            
                                            
                                            <div class="card" id="accountingcontactsaccess_div">
                                                <div class="card-body" >
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingcontactsaccess[]" value="contacts" id="contacts" <?php if(in_array('contacts', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="contacts">
                                                        Contacts
                                                      </label>
                                                    </div>
                                                    <div class="form-check">
                                                      <input class="form-check-input" type="checkbox" name="accountingcontactsaccess[]" value="contactgroups" id="contactgroups" <?php if(in_array('contactgroups', $companyaccess)){ echo "checked"; }else{ echo "checked"; } ?>>
                                                      <label class="form-check-label" for="contactgroups">
                                                        Contact Groups
                                                      </label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <script>
                                                $('input[name="accountingcontactschoice[]"]').click(function(){
                                                    var val = $(this).val();
                                                    if(val == ""){
                                                        $("#accountingcontactsaccess_div").hide();
                                                        $('input[name="accountingcontactsaccess[]"]').removeAttr("checked");
                                                    }
                                                    else{
                                                        $("#accountingcontactsaccess_div").show();
                                                        $('input[name="accountingcontactsaccess[]"]').prop("checked",true);
                                                    }
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="company_name">CLIENT ID:</label>
                    <input <?php echo isset($xero_info->client_id) ? "type='password'" : "type='text'"; ?>  onfocus="this.type='password'" value="<?php echo isset($xero_info->client_id) ? $xero_info->client_id : ''; ?>" required class="form-control" autocomplete="new-password" placeholder="Client ID" id="client_id_txt" name="client_id_txt" />
                </div>
                <div class="form-group">
                    <label for="company_name">SECRET ID:</label>
                    <input <?php echo isset($xero_info->secret_id) ? "type='password'" : "type='text'"; ?>  onfocus="this.type='password'" value="<?php echo isset($xero_info->secret_id) ? $xero_info->secret_id : ''; ?>" required class="form-control" autocomplete="new-password" placeholder="Secret ID" id="secret_id_txt" name="secret_id_txt" />
                </div>
                <div class="form-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check">
                                <?php 
                                    $xeroagreement = App\XeroAgreement::where("status", "=", "1")->first();
                                ?>
                                
                                <input class="form-check-input" type="checkbox" required name="xeroiagree[]" value="<?php echo $xeroagreement->id; ?>" id="xeroiagree">
                                <label class="form-check-label"  id="forxeroiagree" for="xeroiagree">
                                    I have read and agree to the <a data-toggle="modal" data-target="#agreement_modal">Terms and Conditions of Xero Integration in Intellinz.</a>
                                </label>
                               
                                </div>
                        </div>
                    </div>
                    
                </div>
                <!-- agreement modal -->
                <div class="modal fade" id="agreement_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:90%">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <?php 
                            echo $xeroagreement->agreement;
                        ?>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <!--<button type="submit" class="btn btn-primary" id="xero_save_btn" name="xero_save_btn"><i class="fa fa-save"></i> SAVE</button>-->
                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" class="" id="xero_save_btn" style="border:none !important" name="xero_save_btn" ><svg height="43" viewBox="0 0 190 43" width="190" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><linearGradient id="a" x1="50%" x2="50%" y1="122.437977%" y2="7.040451%"><stop offset="0" stop-color="#0b789b"/><stop offset="1" stop-color="#0d84ab"/></linearGradient><path id="b" d="m61.7060001 20.656c0-3.568 2-5.536 4.592-5.536 1.904 0 3.12.848 3.76 2.48l-1.152.656c-.368-1.296-1.328-1.984-2.608-1.984-1.984 0-3.152 1.664-3.152 4.384s1.168 4.384 3.152 4.384c1.28 0 2.24-.704 2.608-1.984l1.152.64c-.64 1.648-1.856 2.496-3.76 2.496-2.592 0-4.592-1.968-4.592-5.536zm17.04 1.344c0 2.688-1.456 4.192-3.584 4.192s-3.584-1.504-3.584-4.192 1.456-4.192 3.584-4.192 3.584 1.504 3.584 4.192zm-1.328 0c0-2.064-.784-3.168-2.256-3.168s-2.256 1.104-2.256 3.168.784 3.168 2.256 3.168 2.256-1.104 2.256-3.168zm4.544-4 .16 1.552c.448-1.104 1.424-1.744 2.688-1.744 1.456 0 2.464.96 2.464 2.576v5.616h-1.312v-5.344c0-1.024-.496-1.696-1.568-1.696-1.136 0-2.096.656-2.096 2.4v4.64h-1.312v-8zm9.024 0 .16 1.552c.448-1.104 1.424-1.744 2.688-1.744 1.456 0 2.464.96 2.464 2.576v5.616h-1.312v-5.344c0-1.024-.496-1.696-1.568-1.696-1.136 0-2.096.656-2.096 2.4v4.64h-1.312v-8zm11.0399999 7.152c.96 0 1.648-.448 1.888-1.456l1.136.32c-.368 1.552-1.6 2.176-3.024 2.176-2.1919999 0-3.5679999-1.456-3.5679999-4.16 0-2.608 1.408-4.224 3.5679999-4.224 2 0 3.104 1.456 3.104 3.36 0 .464-.08.864-.16 1.072h-5.2479999c.064 1.792.8639999 2.912 2.3039999 2.912zm-2.2719999-3.872h4.0639999c.016-.144.016-.304.016-.416 0-1.12-.64-2.048-1.84-2.048-1.28 0-2.0639999.912-2.2399999 2.464zm7.1039999.72c0-2.624 1.408-4.192 3.568-4.192 1.632 0 2.768.992 2.928 2.448l-1.2.224c-.08-.88-.688-1.632-1.728-1.632-1.488 0-2.24 1.28-2.24 3.152s.752 3.152 2.24 3.152c1.04 0 1.648-.736 1.728-1.664l1.2.224c-.224 1.552-1.296 2.48-2.928 2.48-2.16 0-3.568-1.552-3.568-4.192zm12.544 2.672.24 1.04c-.464.288-1.088.48-1.648.48-1.488 0-2.384-.72-2.384-2.208v-4.976h-1.152v-1.008h1.152v-1.696l1.312-.208v1.904h2.4v1.008h-2.4v4.848c0 .88.48 1.232 1.168 1.232.528 0 .864-.128 1.312-.416zm10.128 0 .24 1.04c-.464.288-1.088.48-1.648.48-1.488 0-2.384-.72-2.384-2.208v-4.976h-1.152v-1.008h1.152v-1.696l1.312-.208v1.904h2.4v1.008h-2.4v4.848c0 .88.48 1.232 1.168 1.232.528 0 .864-.128 1.312-.416zm8.768-2.672c0 2.688-1.456 4.192-3.584 4.192s-3.584-1.504-3.584-4.192 1.456-4.192 3.584-4.192 3.584 1.504 3.584 4.192zm-1.328 0c0-2.064-.784-3.168-2.256-3.168s-2.256 1.104-2.256 3.168.784 3.168 2.256 3.168 2.256-1.104 2.256-3.168zm13.84 4-2.88-4.384h-.032l-2.896 4.384h-1.472l3.664-5.488-3.424-5.2h1.536l2.64 4.128h.032l2.656-4.128h1.488l-3.44 5.168 3.68 5.52zm6.192-.848c.96 0 1.648-.448 1.888-1.456l1.136.32c-.368 1.552-1.6 2.176-3.024 2.176-2.192 0-3.568-1.456-3.568-4.16 0-2.608 1.408-4.224 3.568-4.224 2 0 3.104 1.456 3.104 3.36 0 .464-.08.864-.16 1.072h-5.248c.064 1.792.864 2.912 2.304 2.912zm-2.272-3.872h4.064c.016-.144.016-.304.016-.416 0-1.12-.64-2.048-1.84-2.048-1.28 0-2.064.912-2.24 2.464zm11.824-3.424-.08 1.376c-.144-.032-.416-.048-.64-.048-1.264 0-2.192 1.024-2.192 2.768v4.048h-1.312v-8h1.04l.176 2.048c.32-1.424 1.52-2.464 3.008-2.192zm8.208 4.144c0 2.688-1.456 4.192-3.584 4.192s-3.584-1.504-3.584-4.192 1.456-4.192 3.584-4.192 3.584 1.504 3.584 4.192zm-1.328 0c0-2.064-.784-3.168-2.256-3.168s-2.256 1.104-2.256 3.168.784 3.168 2.256 3.168 2.256-1.104 2.256-3.168z"/></defs><g fill="none"><rect fill="url(#a)" height="43" rx="4" width="190"/><use fill="#000" xlink:href="#b"/><use fill="#fff" xlink:href="#b"/><g transform="translate(9 5)"><path d="m16.4995319 0c-9.11353873 0-16.4995319 7.38765603-16.4995319 16.5 0 9.1115118 7.38599317 16.5 16.4995319 16.5 9.110834 0 16.5004681-7.3884882 16.5004681-16.5 0-9.11234397-7.3896341-16.5-16.5004681-16.5" fill="#fff"/><path d="m16.8210417 13.1529405c-.5917606-.3667099-1.2823572-.5604607-1.9972182-.5604607-.7887004 0-1.5396445.2313595-2.1716716.669108-.9878365.6847018-1.5775054 1.8030753-1.5775054 2.9919777 0 .2984232.037861.5947061.1124324.8804911.3796556 1.4476786 1.6564696 2.5426103 3.1772881 2.7245384.1470512.0171227.2943115.0258878.4375975.0258878.3046657 0 .601069-.0378125.9057347-.1150682.396076-.0928496.7734306-.2491956 1.1219188-.4645536.329244-.2079178.6324455-.4880972.9513352-.8788603l.0209177-.0210976c.1061571-.1291332.1555228-.2951617.1353372-.4553807-.0180937-.1434021-.0884817-.2672355-.1980902-.3484661-.1039608-.0780711-.2277933-.1210816-.3485928-.1210816-.1177665 0-.2907555.0415836-.4472196.2403285l-.0122369.0158996c-.0516666.0671656-.1051112.1365735-.1666091.2054717-.2107455.230748-.452972.4208297-.719463.5648434-.3815381.1982353-.7937206.3002577-1.2242061.3033153-1.3523268-.0144727-2.180457-.8917023-2.5040532-1.7064547-.0508299-.1466635-.0871221-.2805871-.1104453-.4047262-.0004183-.0126381-.0013596-.0257859-.0021963-.0387298l5.2357952-.0009173c.3636535-.0075421.6683192-.1369811.8577286-.3643657.1714203-.2058794.2358467-.4751533.181147-.7590019-.2228777-1.0285815-.7961262-1.8525067-1.6577247-2.3826971zm-4.5758429 2.4481301c.2985996-1.1411018 1.350758-1.9376104 2.5596942-1.9376104 1.2152115 0 2.2624542.7944702 2.5623089 1.9376104zm13.6366416-.3005635c-.5269159 0-.9556233.4167528-.9556233.9289033 0 .5123543.4287074.9291071.9556233.9291071.52587 0 .9537408-.4167528.9537408-.9291071 0-.5121505-.4278708-.9289033-.9537408-.9289033zm-3.4273588-2.1263671c0-.2910849-.2441091-.5278462-.5434408-.5278462l-.1530127-.0021403c-.4644766 0-.9036429.1387138-1.2735718.4017705-.0708063-.2130138-.2779957-.362735-.511646-.362735-.3011097 0-.5384206.2300346-.5403032.5238713l.001778 6.0813915c.0019872.28976.2439.5254001.5394665.5254001.2973446 0 .5393619-.2357421.5393619-.5256039v-3.7400741c0-1.2117327.1070984-1.7182775 1.1844626-1.8481242.0893184-.0103959.1852259-.0110074.2095949-.0110074.3171118-.0112113.5473106-.2276904.5473106-.5149023zm-14.20832125 3.0552704 2.79407655-2.7315709c.1021828-.0977418.1585559-.2291173.1585559-.3698695 0-.2905753-.2436907-.5270308-.5431271-.5270308-.1449594 0-.2816563.0559543-.3847803.1573652l-2.7942858 2.7178117-2.80537212-2.7229077c-.10228736-.0981494-.2378338-.1522692-.3818519-.1522692-.29797208 0-.54030318.2364555-.54030318.5270308 0 .141058.05783733.2748796.16284399.3766981l2.79606375 2.7226019-2.79188022 2.7259653c-.10772595.1001879-.16702752.2347229-.16702752.3786346 0 .2904734.2423311.526929.54030318.526929.14182174 0 .27736819-.0538141.38206108-.1520654l2.80244365-2.7287172 2.79031139 2.7159771c.1069938.1071185.2459917.1661304.391474.1661304.2994364 0 .5431271-.2369651.5431271-.5282539 0-.1391214-.0562685-.2709046-.1583467-.3713982zm17.63568005-3.646715c-2.0639456 0-3.7431109 1.6359257-3.7431109 3.646715 0 2.0102796 1.6791653 3.6457977 3.7431109 3.6457977 2.0628997 0 3.7412283-1.6355181 3.7412283-3.6457977 0-2.0107893-1.6783286-3.646715-3.7412283-3.646715zm0 6.2017596c-1.4469792 0-2.6241206-1.1461978-2.6241206-2.5550446 0-1.4104776 1.1771414-2.5580004 2.6241206-2.5580004 1.4454104 0 2.6212967 1.1475228 2.6212967 2.5580004 0 1.4088468-1.1758863 2.5550446-2.6212967 2.5550446z" fill="#13b5ea"/></g></g></svg></button>
                        </div>
                        <div class="col-md-9">
                            <?php if($if_xero_edit == true){  ?>
                                <button class="btn btn-danger xero_editcancel_btn pull-right" type="button"  id=""><i class="fa fa-edit"></i> CANCEL</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </form>
            <?php } if($xero_info != null && $if_xero_edit != true){  
                
                $token_info = App\XeroTokenInfo::where("connection_id","=",$xero_info->id)->where("status","=","1")->first();
                if ($token_info != null) {
                    if(time() > $token_info->expires){
                        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
                          'clientId'                => $xero_info->client_id,
                          'clientSecret'            => $xero_info->secret_id,
                          'redirectUri'             => env("APP_URL").'company/goXeroAnalytics',
                          'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
                          'urlAccessToken'          => 'https://identity.xero.com/connect/token',
                          'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
                        ]);
                    
                        $newAccessToken = $provider->getAccessToken('refresh_token', [
                          'refresh_token' => $token_info->refresh_token
                        ]);
                        
                        $token_info->token = $newAccessToken->getToken();
                        $token_info->expires = $newAccessToken->getExpires();
                        $token_info->refresh_token = $newAccessToken->getRefreshToken();
                        $token_info->id_token = $newAccessToken->getValues()["id_token"];
                        $token_info->save();
                        
                        /*$token_ok = App\XeroTokenInfo::create([
                    	    'connection_id' => $xero_info->id,
                    		'token' => $newAccessToken->getToken(),
                            'expires' => $newAccessToken->getExpires(),
                            'tenant_id' => $token_info->tenant_id,
                            'refresh_token' => $newAccessToken->getRefreshToken(),
                            'id_token' => $newAccessToken->getValues()["id_token"]
                    	]);*/
                    	
                    	/*if($token_ok){
                    	    $token_info->status = 0;
                    	    $token_info->save();
                    	    
                    	    
                    	}*/
                    }
                     
                    try{
                    $token_info = App\XeroTokenInfo::where("connection_id","=",$xero_info->id)->where("status","=","1")->first();
                    
                    $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( (string)$token_info->token );
                    $apiInstance = new XeroAPI\XeroPHP\Api\AccountingApi(
                        new GuzzleHttp\Client(),
                        $config
                    );
                    
                    $tenant_info = App\XeroTenantId::where("token_id", "=", $token_info->id)->where("status", "=", "1")->first();
                    $xeroTenantId = (string)$tenant_info->tenant_id;
                    
                    $apiResponse = $apiInstance->getOrganisations($xeroTenantId);
                    $org_name = $apiResponse->getOrganisations()[0]->getName();
                    $org_id = $apiResponse->getOrganisations()[0]->getOrganisationID();
                    
                    } catch (Exception $e) {
                          echo 'Exception when calling AccountingApi->getOrganisations: ', $e->getMessage(), PHP_EOL;
                    }
                }
                
                $user_currencies = \App\Http\Controllers\XeroController::getXeroCurrencies();
            ?>
            
            <div class="modal" id="switch_org_modal" style="" data-backdrop="static">
            	<div class="modal-dialog" style="margin:50px auto !important; width:50% !important">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h4>SWITCH ORGANISATION</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div> 
                    <div class="modal-body">
                        <table class="table">
                        <?php
                            $switch_tenant_info = App\XeroTenantId::where("token_id", "=", $token_info->id)->where("status", "=", "0")->get();
                            foreach($switch_tenant_info as $info){ ?>
                                <tr>
                                    <td>
                                        <?php
                                            try{
                                                $switch_response = $apiInstance->getOrganisations($info->tenant_id);
                                                $name = $switch_response->getOrganisations()[0]->getName();
                                                echo $name;
                                            }
                                            catch (Exception $e) {
                                                header("Location: goXeroAnalytics?editxero=true");
                                                exit;
                                            }
                                        ?>
                                    </td>
                                    <td class="fit"><button name="{{ $info->id }}" class="btn btn-primary switch_org_btn"><i class="fa fa-check"></i> SELECT</button></td>
                                </tr>   
                        <?php   }
                        ?>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="modal" id="org_details_modal" style="" data-backdrop="static">
            	<div class="modal-dialog" style="margin:50px auto !important; width:70% !important">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title ">{{ strtoupper($org_name) }}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div> 
                    <div class="modal-body">
                        <table class="table">
                            <tr>
                                <td><b>Legal Name</b></td>
                                <td>{{ $apiResponse->getOrganisations()[0]->getLegalName() }}</td>
                            </tr>
                            <tr>
                                <td><b>Organisation Type</b></td>
                                <td>{{ $apiResponse->getOrganisations()[0]->getOrganisationType() }}</td>
                            </tr>
                            <tr>
                                <td><b>Registration Number</b></td>
                                <td>{{ $apiResponse->getOrganisations()[0]->getRegistrationNumber() }}</td>
                            </tr>
                            <tr>
                                <td><b>Base Currency</b></td>
                                <td>{{ $apiResponse->getOrganisations()[0]->getBaseCurrency() }}</td>
                            </tr>
                            <tr>
                                <td><b>Line of Business</b></td>
                                <td>{{ $apiResponse->getOrganisations()[0]->getLineOfBusiness() }}</td>
                            </tr>
                            <tr>
                                <td><b>Addresses</b></td>
                                <td>
                                <table class="table">
                                <?php 
                                    foreach($apiResponse->getOrganisations()[0]->getAddresses() as $address){
                                        $address_arr = json_decode($address,true);
                                    ?>
                                        
                                        <tr>
                                    <?php if($address_arr["AddressType"] == "STREET"){ ?>
                                            
                                                <td>Street: </td>
                                                
                                            
                                    <?php } ?>
                                    <?php    if($address_arr["AddressType"] == "POBOX"){ ?>
                                            
                                                <td>P.O. Box: </td>
                                            
                                    <?php } ?>
                                    <td>{{ $address_arr["AddressLine1"] . ", " . $address_arr["City"] . ", " . $address_arr["Region"] . ", " . $address_arr["Country"] . ", " . $address_arr["PostalCode"]}}</td>
                                    </tr>
                                    
                                    <?php }
                                ?>
                                </table>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                    <div class="modal-footer">
                      <a href="#" data-dismiss="modal" class="btn">Close</a>
                    </div>
                  </div>
                </div>
            </div>
                
                <div class="row mb-2 ">
                    <div class="col-md-12">
                        <label>STATUS: <span class="badge badge-pill "style="background:green !important">Connected</span></label>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" id="xxcv" value="{{ $org_id }}" />
                         <h4 style="margin-top:5px !important"><b>Organization Name:  </b> <a data-toggle="modal" data-target="#org_details_modal" id="org_txt">{{ strtoupper($org_name) }}</a><br><button data-toggle="modal" data-target="#switch_org_modal" style="margin-top:7px" class="btn btn-sm btn-primary"><i class="fa fa-toggle-on"></i> SWITCH ORGNISATION</button></h4>
                    </div>
                </div>
                
                <?php
                    $scopes_q = App\XeroScopes::where("connection_id", "=", isset($xero_info->id) ? $xero_info->id : "")->first();
                    $scopes = explode(" ", $scopes_q["scope"]);
                ?>
                
                <?php 
                    $companyaccessq = App\XeroFeaturesAccess::where("scope_id", "=", isset($scopes_q["id"]) ? $scopes_q["id"] : "")->first();
                    $companyaccess = explode(",", $companyaccessq["access"]);
                ?>
                
                <!-- Modal Manual Journal Details -->
                <div class="modal fade" id="manual_journal_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:80%">
                    <div class="modal-content" >
                      <div class="modal-header">
                        <h4>Manual Journal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>Narration: <b id="manual_journal_details_modal_narration"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p>Date: <b id="manual_journal_details_modal_date"></b></p>
                            </div>
                        </div>
                        <style>
                            .td_hide{
                                display:none;
                            }
                            .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus, .nav-tabs>li>a{
                                border:none !important;
                            }
                            .table th{
                                color:black !important;  
                            }
                            
                        </style>
                        <table class="table" id="manual_journal_details_table">
                           <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Account</th>
                                    <th class="text-center">Tax Rate</th>
                                    <th class="text-center td_hide" >Tax Amount</th>
                                    <th class="amount_css">Debit {{ $user_currencies }}</th>
                                    <th class="amount_css">Credit {{ $user_currencies }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody> 
                        </table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Modal Invoices Details -->
                <div class="modal fade" id="invoices_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:80%">
                    <div class="modal-content" >
                      <div class="modal-header">
                        <h4>Invoice</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>To: <b id="invoice_details_modal_to"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p>Date: <b id="invoice_details_modal_date"></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>Due Date: <b id="invoice_details_modal_duedate"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p>Invoice #: <b id="invoice_details_modal_no"></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>Reference: <b id="invoice_details_modal_reference"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a class="btn btn-primary pdf_btn" id="invoice_pdf_btn"><i class="fa fa-download"></i> Download PDF</a>
                            </div>
                        </div>
                        
                        <table class="table" id="invoices_details_table">
                           <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th class="text-center">Qty.</th>
                                    <th class="amount_css" >Unit Price</th>
                                    <th>Account</th>
                                    <th class="text-center">Tax Rate</th>
                                    <th class="amount_css">Amount {{ $user_currencies }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody> 
                        </table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Modal Quotes Details  -->
                <div class="modal fade" id="quotes_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:80%">
                    <div class="modal-content" >
                      <div class="modal-header">
                        <h4>Quote</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>To: <b id="quotes_details_modal_contact"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p>Date: <b id="quotes_details_modal_date"></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>Due Date: <b id="quotes_details_modal_expiry"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p>Quote #: <b id="quotes_details_modal_no"></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>Reference: <b id="quotes_details_modal_reference"></b></p>
                            </div>
                        </div>
                        
                        <div class="row" id="title_div">
                            <div class="col-md-6 mb-2">
                                <p>Title: <b id="quotes_details_modal_title"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p>Summary: <b id="quotes_details_modal_summary"></b></p>
                            </div>
                        </div>
                        
                        <div class="row" id="title_div">
                            <div class="col-md-6 mb-2">
                                <a class="btn btn-primary pdf_btn" id="quotes_pdf_btn"><i class="fa fa-download"></i> Download PDF</a>
                            </div>
                        </div>
                        
                        <table class="table" id="quotes_details_table">
                           <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th class="text-center">Qty.</th>
                                    <th class="amount_css" >Unit Price</th>
                                    <th>Account</th>
                                    <th class="text-center">Tax Rate</th>
                                    <th class="amount_css">Amount {{ $user_currencies }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody> 
                        </table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                
                <!-- Modal Purchase Order Details  -->
                <div class="modal fade" id="po_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:80%">
                    <div class="modal-content" >
                      <div class="modal-header">
                        <h4>Purchase Order</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>Contact: <b id="po_details_modal_contact"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p>Date: <b id="po_details_modal_date"></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>Delivery Date: <b id="po_details_modal_deldate"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p>Order #: <b id="po_details_modal_no"></b></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p>Reference: <b id="po_details_modal_reference"></b></p>
                            </div>
                            <div class="col-md-6 mb-2">
                                <a class="btn btn-primary pdf_btn" id="po_pdf_btn"><i class="fa fa-download"></i> Download PDF</a>
                            </div>
                        </div>
                        
                        
                        <table class="table" id="po_details_table">
                           <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th class="text-center">Qty.</th>
                                    <th class="amount_css" >Unit Price</th>
                                    <th>Account</th>
                                    <th class="text-center">Tax Rate</th>
                                    <th class="amount_css">Amount {{ $user_currencies }}</th>
                                </tr>
                            </thead>
                            <tbody></tbody> 
                        </table>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Trial Balance Details  -->
                <div class="modal fade" id="trial_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:80%">
                    <div class="modal-content" >
                      <div class="modal-header">
                        <h4>Trial Balance</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="hidden" id="trial_balance_id" />
                      </div>
                      <div class="modal-body">
                        
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label>Title:</label>
                                <input type="text" placeholder="........" id="trial_balance_title_txt"  class="form-control" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Description:</label>
                                <input type="text" placeholder="........" id="trial_balance_description_txt"  class="form-control" />
                            </div>
                        </div>
                        
                        <table class="table" id="trial_table">
                           
                        </table>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="trial_balance_save_btn" ><i class="fa fa-save"></i> SAVE</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Balance Sheet Details  -->
                <div class="modal fade" id="balance_sheet_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:80%">
                    <div class="modal-content" >
                      <div class="modal-header">
                        <h4>Balance Sheet</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="hidden" id="balance_sheet_id" />
                      </div>
                      <div class="modal-body">
                        <div class="row hide" >
                            <div class="col-md-6 mb-2">
                                <label>Title:</label>
                                <input type="text" placeholder="........" id="balance_sheet_title_txt"  class="form-control" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Description:</label>
                                <input type="text" placeholder="........" id="balance_sheet_description_txt"  class="form-control" />
                            </div>
                        </div>
                        <a class="btn btn-primary mb-2 balancesheet_editor_btn"><i class="fa fa-edit"></i> Go to Editor</a>
                        <table class="table" id="balance_sheet_table">
                           
                        </table>
                        <a  class="btn btn-primary mb-2 balancesheet_editor_btn"><i class="fa fa-edit"></i> Go to Editor</a>
                      </div>
                      <div class="modal-footer">
                            <button type="button" class="btn btn-primary hide" id="balance_sheet_save_btn" ><i class="fa fa-save"></i> SAVE</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- Profit and Loss Details  -->
                <div class="modal fade" id="profit_loss_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document" style="width:80%">
                    <div class="modal-content" >
                      <div class="modal-header">
                        <h4>Profit and Loss</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <input type="hidden" id="profit_loss_id" />
                      </div>
                      <div class="modal-body">
                        <div class="row hide">
                            <div class="col-md-6 mb-2">
                                <label>Title:</label>
                                <input type="text" placeholder="........" id="profit_loss_title_txt"  class="form-control" />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label>Description:</label>
                                <input type="text" placeholder="........" id="profit_loss_description_txt"  class="form-control" />
                            </div>
                        </div>
                        
                        <a class="btn btn-primary mb-2 profitloss_editor_btn"><i class="fa fa-edit"></i> Go to Editor</a>
                        <table class="table" id="profit_loss_table"></table>
                         <a class="btn btn-primary mb-2 profitloss_editor_btn"><i class="fa fa-edit"></i> Go to Editor</a>
                         
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary hide" id="profit_loss_save_btn" ><i class="fa fa-save"></i> SAVE</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                <style>
                    .bank_acc_id{
                        margin-top:3px !important;
                        margin-bottom:6px !important;
                        font-size:12px;
                    }
                    .bank_title{
                        margin-bottom:1px !important;
                    }
                    .bank_header{
                        border-bottom:1px solid silver;
                    }
                    .canvasjs-chart-credit{
                        color:none !important;
                    }
                </style>
                <ul class="nav nav-tabs">
                    <li id="dashboard_li" class="active">
                        <a href="#dashboard_tab" data-toggle="tab"> DASHBOARD </a>
                    </li>
                    <li id="business_li" class="">
                        <a href="#business_tab" data-toggle="tab"> BUSINESS </a>
                    </li>
                    <li id="accounting_li" class="">
                        <a href="#accounting_tab" data-toggle="tab"> ACCOUNTING </a>
                    </li>
                    <li id="contact_li" class="">
                        <a href="#contact_tab" data-toggle="tab"> CONTACT </a>
                    </li>
                </ul>
                <div class="tab-content" style="padding-top:10px">
                <div class="tab-pane active" id="dashboard_tab">
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="modal fade" id="dashboard_details_modal" tabindex="-1" role="dialog"  aria-hidden="true">
                              <div class="modal-dialog" role="document" style="width:60%">
                                <div class="modal-content" >
                                  <div class="modal-header">
                                    <h4></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <table class="table table-hover table-striped" style="width:100%" id="dashboard_details_table"></table>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <?php 
                                $test_minus = strtotime("-8 month", strtotime(date("Y-m-d")));
                                $newdate = date("Y-m-d",$test_minus);
                            ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-2">
                                        <div class="card-body">
                                            
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <a target="_blank" href="{{ url('/company/businessPerformance/'.date("Y-m-d").'/11') }}" class="btn btn-info pull-right"><i style="color:black !important" class="text-dark fa fa-bar-chart"></i> BUSINESS PERFORMANCE</a>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 mb-2">
                                                    <label>From:</label>
                                                    <input type="date" id="dashboard_from_txt" value="<?php echo $newdate; ?>" class="form-control" />
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>To:</label>
                                                    <input type="date" id="dashboard_to_txt" value="<?php echo date("Y-m-d"); ?>" class="form-control" />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Payments Only?</label>
                                                    <select class="form-control" id="dashboard_if_payment_cb">
                                                        <option value="false">No</option>
                                                        <option value="true">Yes</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-1 mb-2">
                                                    <label style="color:white">:</label>
                                                    <button id="dashboard_load_btn" class="btn btn-sm btn-primary"><i class="fa fa-spinner"></i> LOAD</button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div id="left_column" class="col-md-6">
                                                    <div class="card h-100" id="card_pie" style="height:100% !important">
                                                        <div class="card-body" >
                                                            <div id="piechartContainer" style="width:100%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="box_column" class="col-md-6">
                                                    <div id="dashboard_div" class="row">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                
                                    function loadListProfitLossDashboard(from,to, type){
                                        $(".loading").show();
                                        
                                        $.ajax({
                                            url: "<?php echo env("APP_URL"); ?>company/loadProfitLossDashboard/"+from+"/"+to + "/" + type,
                                            type: "GET",
                                            success: function (data) {
                                                var split = data.split("<split>");
                                                
                                                $("#dashboard_div").html(split[0]);
                                                $("#left_column").css("height", $("#box_column").height());
                                                $("#piechartContainer").css("height", $("#card_pie").height() - 30);
                                                
                                                var piechart = new CanvasJS.Chart("piechartContainer", {
                                                	//exportEnabled: true,
                                                	animationEnabled: true,
                                                	title:{
                                                		text: ""
                                                	},
                                                	legend:{
                                                		cursor: "pointer",
                                                		//itemclick: explodePie  toolTipContent: "{y} (#percent%)",
                                                	},
                                                	data: [{
                                                		type: "pie",
                                                		showInLegend: true,
                                                		toolTipContent: "{name}: <strong>{y} (#percent%)</strong>",
                                                		indexLabel: "{name} - {y} (#percent%)",
                                                		dataPoints: [
                                                			{ y: Number(split[1]), name: "Gross Profit",color:"#90e0ef", exploded:true },
                                                			{ y: Number(split[2]), name: "Net Profit", color:"#00b4d8" }
                                                		]
                                                	}]
                                                });
                                                piechart.render();
                                                
                                                $(".loading").hide();
                                            },
                                            error:function (data) {
                                                alert("Contact Error");
                                                $(".loading").hide();
                                            }
                                        });
                                    }
                                    loadListProfitLossDashboard("{{ $newdate }}", "{{ date('Y-m-d') }}", "false");
                                    
                                    $("#dashboard_load_btn").click(function(){
                                        var from = $("#dashboard_from_txt").val();
                                        var to = $("#dashboard_to_txt").val();
                                        var type = $("#dashboard_if_payment_cb option:selected").val();
                                        
                                        loadListProfitLossDashboard(from, to, type);
                                    });
                                    
                                    $("body").on("click", ".dashboard_details_a", function(){
                                        var val = JSON.parse($(this).attr("name"));
                                        
                                        var data = "";
                                        $.each(val, function (index, value) {
                                            data += '<tr>';
                                            data += '<td>'+ index +'</td>';
                                            data += '<td class="amount_css"><b>'+ value +'</b></td>';
                                            data += '</tr>';
                                        });
                                        
                                        $("#dashboard_details_table").html(data);
                                        $("#dashboard_details_modal").modal("show");
                                        //console.log($(this).attr("name"));
                                    });
                                </script>
                            </div>
                            
                            <?php 
                                $date = date("Y-m-d");
                                $periods = 6;
                                $timeframe = "MONTH";
                                $trackingOptionID1 = "";
                                $trackingOptionID2 = "";
                                $standardLayout = true;
                                $paymentsOnly = false;
                
                                $table_data = "";
                
                                $title = "";
                                $description = "";
                                $bsid = "";
                                
                                $header_array = array();
                                $main_count = 0;
                                $last_date = "";
                                
                                try
                                {
                                    $result = $apiInstance->getReportBalanceSheet($xeroTenantId, $date, $periods, $timeframe, $trackingOptionID1, $trackingOptionID2, $standardLayout, $paymentsOnly);
                                    $arr = json_decode($result, true);
                
                                    foreach ($arr as $value)
                                    {
                                        if (count($value[0]["Rows"]) > 0)
                                        {
                                            foreach ($value[0]["Rows"] as $main_value)
                                            {
                                                if ($main_value["RowType"] == "Header")
                                                {
                                                    $cc = 0;
                                                    foreach ($main_value["Cells"] as $cells)
                                                    {
                                                        if ($cc > 0)
                                                        {
                                                            array_push($header_array, $cells["Value"]);
                                                        }
                                                        
                                                        if($cc == count($main_value["Cells"]) - 1){
                                                            $last_date = $cells["Value"];
                                                        }
                                                        $cc++;
                                                    }
                                                }
                
                                                if ($main_value["RowType"] == "Section")
                                                {
                                                    if( (isset($main_value["Title"]) ? $main_value["Title"] : "") == "Bank" ){
                
                                                        foreach ($main_value["Rows"] as $main_row)
                                                        {
                                                            if ($main_row["RowType"] == "Row")
                                                            {
                                                                $cc = 0;
                                                                $acc_no = "";
                                                                $bank_acc_id = "";
                                                                $bank_title = "";
                                                                
                                                                $array_count = 0;
                                                                $stat_balance = 0;
                                                                $dataPoints = array();
                                                                
                                                                $main_count++;
                                                                
                                                                foreach ($main_row["Cells"] as $main_cells)
                                                                {
                                                                    $align_right = "";
                                                                    $value = $main_cells["Value"];
                                                                    if ($cc > 0)
                                                                    {
                                                                        $align_right = "amount_css";
                                                                        if ($main_cells["Value"] != "")
                                                                        {
                                                                            $value = $main_cells["Value"];
                                                                        }
                                                                        else{
                                                                            $value = 0;
                                                                        }
                                                                        
                                                                        if($cc == 1){
                                                                            $stat_balance = $value;
                                                                        }
                                                                        
                                                                        $label = explode(" ",$header_array[$array_count]);
                                                                        array_push($dataPoints, array("label" => $label[1] . " " . $label[2], "y" => $value));
                                                                        $array_count++;
                                                                    }
                                                                    else
                                                                    {
                                                                        if (isset($main_cells["Attributes"]))
                                                                        {
                                                                            foreach ($main_cells["Attributes"] as $value)
                                                                            {
                                                                                $bank_acc_id = $value["Value"];
                                                                                foreach(\App\Http\Controllers\XeroController::getBankAccountDetails($bank_acc_id) as $acc_det){
                                                                                    $acc_no = $acc_det[0]["BankAccountNumber"];
                                                                                }
                                                                            }
                                                                        }
                                                                        
                                                                        $bank_title = $main_cells["Value"];
                                                                    }
                                                                    $cc++;
                                                                } ?>
                                                                
                                                                <div class="card mb-2">
                                                                    <div class="card-body">
                                                                        <div class="card-header bank_header">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <h4 class="bank_title">{{ $bank_title }}</h4>
                                                                                    <h5 class="bank_acc_id">{{ $acc_no }}</h5>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="dropdown pull-right">
                                                                                      <button class="btn btn-primary dropdown-toggle btn-sm" type="button" data-toggle="dropdown">OPTIONS
                                                                                      <span class="caret"></span></button>
                                                                                      <ul class="dropdown-menu">
                                                                                        <li><a target="_blank" href="{{ url('/xero/BankTransactions/'.$bank_acc_id) }}"><b>Account Transactions</b></a></li>
                                                                                      </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-md-4 mb-2">
                                                                                    
                                                                                </div>
                                                                                <div class="col-md-8 mb-2">
                                                                                    <h3 class="pull-right">Statement Balance: <b style="color:green">{{ number_format($stat_balance,2) }} </b></h3>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                               <div class="col-md-3 mb-2">
                                                                                    <label>Interval:</label>
                                                                                    <select id="bank_interval_{{ $bank_acc_id }}" class="form-control bank_interval_cb">
                                                                                        <option value="MONTH">MONTH</option>
                                                                                        <!--<option value="QUARTER">QUARTER</option>-->
                                                                                        <option value="YEAR">YEAR</option>
                                                                                    </select>
                                                                                </div>
                                                                                <div>
                                                                                <div class="col-md-3 mb-2">
                                                                                    <?php 
                                                                                        $converted_date = date("Y-m",strtotime($last_date));
                                                                                        
                                                                                        $test_minus = strtotime("-3 month", strtotime("2022-06-30"));
                                                                                        
                                                                                        $newdate = date("M-d-Y",$test_minus);
                                                                                        
                                                                                        
                                                                                    ?>
                                                                                    <label>From:</label>
                                                                                    <input  type="month" id="from_date_{{ $bank_acc_id }}" value="{{ $converted_date }}" class="form-control bank_from_date" />
                                                                                </div>
                                                                                <div class="col-md-3 mb-2">
                                                                                    <label>To:</label>
                                                                                    <input  type="month" id="to_date_{{ $bank_acc_id }}"  value="{{ date('Y-m') }}" class="form-control bank_to_date" />
                                                                                </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-md-1 mb-2">
                                                                                    <label style="color:white">:</label>
                                                                                    <button id="bank_load_{{ $bank_acc_id }}" name="{{ $bank_acc_id }}" class="btn btn-sm btn-primary bank_load_btn"><i class="fa fa-spinner"></i> LOAD</button>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div style="height: 370px; width: 100%;" id="chartContainer{{ $bank_acc_id }}">
                                                                                        <script>
                                                                                            var datap_{{ $main_count }} = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
                                                                                            var chart_{{ $main_count }};
                                                                                            
                                                                                            function setColor(chart){
                                                                                                	for(var i = 0; i < chart.options.data.length; i++) {
                                                                                                  	dataSeries = chart.options.data[i];
                                                                                                  	for(var j = 0; j < dataSeries.dataPoints.length; j++){
                                                                                                    	if(dataSeries.dataPoints[j].y <= 0){
                                                                                                      	    dataSeries.dataPoints[j].color = 'red';
                                                                                                    	}
                                                                                                    	else{
                                                                                                    	    dataSeries.dataPoints[j].color = 'green';
                                                                                                    	    
                                                                                                    	}
                                                                                                    }
                                                                                                  }
                                                                                                }
                                                                                            
                                                                                            function loadChart{{ $main_count }}(){
                                                                                                chart_{{ $main_count }} = new CanvasJS.Chart("chartContainer{{ $bank_acc_id }}", {
                                                                                                	animationEnabled: true,
                                                                                                	title:{
                                                                                                		text: "STATEMENT BALANCE ({{ $bank_title }})"
                                                                                                	},
                                                                                                	axisY: {
                                                                                                	    minimum:-5,
                                                                                                	},
                                                                                                	axisX:{
                                                                                                	    
                                                                                                       //interval: 1,
                                                                                                       //intervalType: "day",
                                                                                                       reversed:true
                                                                                                     },
                                                                                                	data: [{
                                                                                                		type: "splineArea",
                                                                                                		markerSize: 10,
                                                                                                		markerBorderColor: "white",
                                                                                                		markerBorderThickness: 2,
                                                                                                		color:"skyblue",
                                                                                                		//xValueFormatString: "MMM DD,YYYY",
                                                                                                		yValueFormatString: "#,##0.##",
                                                                                                		//xValueType: "dateTime",
                                                                                                		dataPoints: datap_{{ $main_count }}
                                                                                                	}]
                                                                                                });
                                                                                                
                                                                                                setColor(chart_{{ $main_count }});
                                                                                                 
                                                                                                chart_{{ $main_count }}.render();
                                                                                                 
                                                                                            }
                                                                                            loadChart{{ $main_count }}();
                                                                                            
                                                                                            $("#bank_load_{{ $bank_acc_id }}").click(function(){
                                                                                                var from_date = $("#from_date_{{ $bank_acc_id }}").val();
                                                                                                var to_date = $("#to_date_{{ $bank_acc_id }}").val();
                                                                                                var bank_interval = $("#bank_interval_{{ $bank_acc_id }} option:selected").val();
                                                                                                var xx = $(this).attr("name");
                                                                                                
                                                                                                if(from_date == "" || to_date == ""){
                                                                                                    alert("Please provide from date and to date!");
                                                                                                }
                                                                                                else{
                                                                                                    formData = new FormData();
                                                                                                    formData.append("from_date", from_date);
                                                                                                    formData.append("to_date", to_date);
                                                                                                    formData.append("interval", bank_interval);
                                                                                                    formData.append("xx", xx);
                                                                                                    $(".loading").show();
                                                                                                    $.ajax({
                                                                                                        url: "{{ route('loadStatementBalanceFromBalanceSheet') }}",
                                                                                                        type: "POST",
                                                                                                        data: formData,
                                                                                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                                                                                        processData: false,
                                                                                                        contentType: false,
                                                                                                        dataType: "json",
                                                                                                        success: function (return_data) {
                                                                                                            
                                                                                                            chart_{{ $main_count }}.options.data[0].dataPoints = [];
                                                                                                            
                                                                                                            var dps = return_data;
                                                                                                            var newdata = [];
                                                                                                            for (var i = 0; i < dps.length; i++) {
                                                                                                        		chart_{{ $main_count }}.options.data[0].dataPoints[i] = {label:dps[i][0], y:Number(dps[i][1])};
                                                                                                        		//console.log(dps[i][0] + " --- " + dps[i][1]);
                                                                                                        	}
                                                                                                        	
                                                                                                        	setColor(chart_{{ $main_count }});
                                                                                                        	chart_{{ $main_count }}.render();
                                                                                                            $(".loading").hide();
                                                                                                            
                                                                                                            
                                                                                                        },
                                                                                                         error: function(jqXHR, textStatus, errorThrown) {
                                                                                                          console.log(textStatus, errorThrown);
                                                                                                          $(".loading").hide();
                                                                                                        }
                                                                                                    });
                                                                                                }
                                                                                            });
                                                                                            
                                                                                            $("#bank_interval_{{ $bank_acc_id }}").change(function(){
                                                                                                var type = $("#bank_interval_{{ $bank_acc_id }} option:selected").val();
                                                                                                
                                                                                                if(type == "MONTH" || type == "QUARTER"){
                                                                                                    $("#from_date_{{ $bank_acc_id }}").attr({type:"month", max:"{{ date('Y-m') }}"});
                                                                                                    $("#to_date_{{ $bank_acc_id }}").attr({type:"month", max:"{{ date('Y-m') }}"});
                                                                                                    
                                                                                                    $("#to_date_{{ $bank_acc_id }}, #from_date_{{ $bank_acc_id }}").removeAttr(' min value step');
                                                                                                }
                                                                                                
                                                                                                if(type == "YEAR"){
                                                                                                    
                                                                                                    $("#from_date_{{ $bank_acc_id }}").attr({ type:"number", min:"1950" , max:"2099", min:"1950", step:"1", value:"{{ (date('Y') - 1) }}" } );
                                                                                                    $("#to_date_{{ $bank_acc_id }}").attr({ type:"number", min:"1950" , max:"2099", min:"1950", step:"1", value:"{{ date('Y') }}" } );
                                                                                                }
                                                                                            });
                                                                                        </script>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php }
                                                        }
                                                    }
                                                }
                                            }
                
                                        }
                
                                    }
                                }
                                catch(Exception $e)
                                {
                                     echo 'Exception when calling AccountingApi->getReportBalanceSheet: ', $e->getMessage(), PHP_EOL;
                                }
                            ?>
                            
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="card-header bank_header">
                                        <h4 class="inouttitle">BALANCE SHEET</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!--<div class="col-md-4 mb-2">
                                                <label>Type:</label>
                                                <select class="form-control" id="balancesheet_data_type_cb">
                                                    <option value="LEVA">Assets vs Liabilities and Equity</option>
                                                    <option value="assets">Assets</option>
                                                    <option value="liabilities">Liabilities</option>
                                                    <option value="equity">Equity</option>
                                                </select>
                                            </div>-->
                                            <div class="col-md-4 mb-2">
                                                <label>Month & Year:</label>
                                                <input type="month" id="balancesheet_date_txt" value="<?php echo date('Y-m'); ?>" class="form-control" />
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <label>Comparison period(s), Compare with:</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="number" min="1" max="11" id="balancesheet_period_no_txt" value="5" class="form-control" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="balancesheet_period_type_cb">
                                                            <option value="MONTH">MONTH</option>
                                                            <option value="QUARTER">QUARTER</option>
                                                            <option value="YEAR">YEAR</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-1 mb-2">
                                                <label style="color:white">:</label>
                                                <button id="balancesheet_load_btn" class="btn btn-sm btn-primary"><i class="fa fa-spinner"></i> LOAD</button>
                                            </div>
                                        </div>
                                        <div id="balancesheetchart" style="height: 350px; width: 100%;"></div>
                                         <script>
                                          
                                          var balancesheetchart;
                                            
                                            balancesheetchart = new CanvasJS.Chart("balancesheetchart", {
                                            	animationEnabled: true,
                                            	title:{
                                            		text: "BALANCE SHEET"
                                            	},	
                                            	
                                            	axisY:{
                                                      //maximum:60000
                                                    },
                                                    axisY2:{
                                                  title: "",
                                                  tickThickness: 0,
                                                  lineThickness: 0,
                                                  labelFormatter: function(){
                                                     return " ";
                                                  }  
                                                },
                                                  toolTip: {
                                            		shared: true,
                                            	},
                                            	axisX:{
                                                    reversed:true
                                                },
                                            	legend: {
                                            		cursor:"pointer",
                                            	},
                                                data: []
                                            });
                                            
                                            function loadBalanceSheetGraph(date, period, timeframe){
                                            
                                                $(".loading").show();
                                                $.ajax({
                                                    url: "<?php echo env("APP_URL"); ?>company/loadBalanceSheetGraph/"+ date + "/" + period + "/" + timeframe,
                                                    type: "GET",
                                                    dataType: "json",
                                                    success: function (return_data) {
                                                        balancesheetchart.options.data = [];
                                                        
                                                        var profitlosschart_data = [];
                                                        
                                                        //var sortedData = $(return_data).reverse();
                                                        $.each(return_data, function(key, value){
                                                            
                                                            var chartdata = {};
                                                            
                                                            $.each(value, function(key1, value1){
                                                                
                                                                chartdata["name"] = key1;
                                                                chartdata["legendText"] = key1;
                                                                chartdata["showInLegend"] = true;
                                                                
                                                                
                                                                if(key1 == "Total Assets"){
                                                                    chartdata["color"] = "green";
                                                                    chartdata["axisYType"] = "secondary";
                                                                    chartdata["type"] = "stackedColumn";
                                                                }
                                                                
                                                                if(key1 == "Total Liabilities"){
                                                                    chartdata["color"] = "red";
                                                                    //chartdata["axisYType"] = "secondary";
                                                                    chartdata["type"] = "stackedColumn";
                                                                }
                                                                
                                                                if(key1 == "Total Equity"){
                                                                    chartdata["color"] = "orange";
                                                                    //chartdata["axisYType"] = "secondary";
                                                                    chartdata["type"] = "stackedColumn";
                                                                }
                                                                
                                                                var datapoints = [];
                                                                var datapoints_dummy = [];
                                                                
                                                                for(var x = 0; x <= value1.length - 1; x++){
                                                                    datapoints.push({ x: (x + 10) , y:Number(value1[x][1]), label:value1[x][0] });
                                                                }
                                                                
                                                                chartdata["dataPoints"] = datapoints;
                                                                
                                                            });
                                                            //console.log(chartdata);
                                                            profitlosschart_data.push(chartdata);
                                                        });
                                                        
                                                        //balancesheetchart.options.title.text = $("#chartprofit_loss_select_type_cb option:selected").text();
                                                        balancesheetchart.options.data = profitlosschart_data;
                                                        balancesheetchart.render();
                                                        
                                                        balancesheetchart.axisY2[0].set("minimum", balancesheetchart.axisY[0].get("minimum"), false);
                                                        balancesheetchart.axisY2[0].set("maximum", balancesheetchart.axisY[0].get("maximum"));
                                                        
                                                        $(".loading").hide();
                                                    },
                                                    error: function(jqXHR, textStatus, errorThrown) {
                                                        console.log(textStatus, errorThrown);
                                                        $(".loading").hide();
                                                    }
                                                });
                                              }
                                              
                                              loadBalanceSheetGraph($("#balancesheet_date_txt").val(), $("#balancesheet_period_no_txt").val(), $("#balancesheet_period_type_cb option:selected").val());
                                                
                                            $("#balancesheet_load_btn").click(function(){
                                              var date = $("#balancesheet_date_txt").val();
                                              var period = $("#balancesheet_period_no_txt").val();
                                              var timeframe = $("#balancesheet_period_type_cb option:selected").val();
                                              
                                              if(period > 12)
                                              {
                                                alert("Period Must be Between 1 - 11");    
                                              }
                                              else{
                                                loadBalanceSheetGraph(date, period, timeframe);
                                              }
                                          });
                                        </script>
                                              
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="card-header bank_header">
                                        <h4 class="inouttitle">TOTAL CASH RECEIVED AND SPENT</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="cashinoutchart" style="height: 300px; width: 100%;"></div>
                                         <script>
                                            
                                        <?php
                                            $cashin = "";
                                            $cashout = "";
                                            
                                            $phpDate = date("Y-m-d h:i:sa");
                                            
                                            for($x = 6; $x >= 1; $x--){
                                                $phpTimestamp = strtotime($phpDate);
                                                $javaScriptTimestamp = $phpTimestamp * 1000;
                                            
                                                $future_timestamp = strtotime("-1 month", $phpTimestamp);
                                                
                                                $fromDate = date('Y-m-01', $future_timestamp);
                                                $toDate = date('Y-m-t', $future_timestamp);
                                                
                                                try {
                                                  $result = $apiInstance->getReportBankSummary($xeroTenantId, $fromDate, $toDate);
                                                  
                                                  $arr = json_decode($result,true);
                                                  foreach($arr["Reports"] as $values){ 
                                                    if(count($values["Rows"]) > 0){
                                                        foreach ($values["Rows"] as $main_value) {
                                                            
                                                            if($main_value["RowType"] == "Header"){
                                                                    
                                                            }
                                                                
                                                            if($main_value["RowType"] == "Section"){
                                                                foreach ($main_value["Rows"] as $main_row) {
                                                                    
                                                                    if($main_row["RowType"] == "SummaryRow"){
                                                                        $count = 1;
                                                                        $acc_no = "";
                                                                        $bank_acc_id = ""; 
                                                                        foreach ($main_row["Cells"] as $cells) {
                                                                            if($count == 3){
                                                                                $cashin .= '{ label: "'.date('M-Y', $future_timestamp).'", y: '.$cells["Value"].' },';
                                                                            }
                                                                            
                                                                            if($count == 4){
                                                                                $cashout .= '{ label: "'.date('M-Y', $future_timestamp).'", y: '.$cells["Value"].' },';
                                                                            }
                                                                            
                                                                            $count++;
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                            
                                                        }
                                                    }
                                                  } 
                                                }
                                                catch (Exception $e) {
                                                  echo 'Exception when calling AccountingApi->getReportBankSummary: ', $e->getMessage(), PHP_EOL;
                                                }
                                                
                                                $phpDate = date("Y-m-d h:i:sa", $future_timestamp);
                                            }
                                            
                                        ?>
                                          var cashinpoints = [ <?php echo $cashin; ?> ];
                                          var cashoutpoints = [ <?php echo $cashout; ?> ];
                                        
                                            var cashindata =  {
                                                type: "column",
                                                color: "green",  
                                                name: "CASH RECEIVED",
                                                legendText: "CASH RECEIVED",
                                                showInLegend: true, 
                                                dataPoints: cashinpoints
                                            };
                                            
                                            var cashoutdata =  {
                                                type: "column",
                                                color: "red",
                                                name: "CASH SPENT",
                                                legendText: "CASH SPENT",
                                                showInLegend: true, 
                                                dataPoints: cashoutpoints
                                            };
                                            
                                            var chart = new CanvasJS.Chart("cashinoutchart", {
                                            	animationEnabled: true,
                                            	title:{
                                            		text: "TOTAL CASH RECEIVED AND SPENT"
                                            	},	
                                            	
                                            	axisX:{
                                                   reversed:  true
                                                 },
                                            	toolTip: {
                                            		shared: true,
                                            		reversed:  true
                                            	},
                                            	legend: {
                                            		cursor:"pointer",
                                            		itemclick: toggleDataSeries
                                            	},
                                            	data: [cashoutdata, cashindata ]
                                            });
                                            chart.render();
                                            
                                            function toggleDataSeries(e) {
                                            	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                            		e.dataSeries.visible = false;
                                            	}
                                            	else {
                                            		e.dataSeries.visible = true;
                                            	}
                                            	chart.render();
                                            }
                                            
                                        </script>
                                              
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="card-header bank_header">
                                        <h4 class="inouttitle">PROFIT AND LOSS</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 mb-2">
                                                <label>Type:</label>
                                                <select class="form-control" id="chartprofit_loss_select_type_cb">
                                                    <option value="GPNP">Gross Profit vs Net Profit</option>
                                                    <option value="TICS">Trading Income vs Cost of Sales</option>
                                                    <option value="TIOE">Trading Income vs Operating Expenses</option>
                                                    <option value="SR">Sales Report</option>
                                                </select>
                                            </div>
                                            <!--<div class="col-md-2 mb-2">
                                                <label>From:</label>
                                                <input type="date" id="chartprofit_loss_fromdate_txt" value="<?php echo date('Y-m-01'); ?>" class="form-control" />
                                            </div>-->
                                            <div class="col-md-4 mb-2">
                                                <label>Month & Year:</label>
                                                <input type="month" id="chartprofit_loss_todate_txt" value="<?php echo date('Y-m'); ?>" class="form-control" />
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label>Comparison period(s), Compare with:</label>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="number" min="1" max="11" id="chartprofit_loss_period_no_txt" value="5" class="form-control" />
                                                    </div>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="chartprofit_loss_period_type_cb">
                                                            <option value="MONTH">MONTH</option>
                                                            <option value="QUARTER">QUARTER</option>
                                                            <option value="YEAR">YEAR</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-1 mb-2">
                                                <label style="color:white">:</label>
                                                <button id="chartprofit_loss_load_btn" class="btn btn-sm btn-primary"><i class="fa fa-spinner"></i> LOAD</button>
                                            </div>
                                        </div>
                                        <div id="profitlosschart" style="height: 300px; width: 100%;"></div>
                                         <script>
                                          
                                          var profitlosschart;
                                            
                                            profitlosschart = new CanvasJS.Chart("profitlosschart", {
                                            	animationEnabled: true,
                                            	title:{
                                            		text: "PROFIT AND LOSS"
                                            	},	
                                            	
                                            	axisX:{
                                                   reversed:  true
                                                 },
                                            	toolTip: {
                                            		shared: true,
                                            	},
                                            	legend: {
                                            		cursor:"pointer",
                                            	},
                                            	data: []
                                            });
                                          
                                          function loadProfitLoss(from_date, to_date, period, timeframe, selecttype){
                                            
                                            $(".loading").show();
                                            $.ajax({
                                                url: "<?php echo env("APP_URL"); ?>company/loadProfitAndLossGraph/"+from_date + "/" + to_date + "/" +period + "/" + timeframe + "/" + selecttype,
                                                type: "GET",
                                                dataType: "json",
                                                success: function (return_data) {
                                                    profitlosschart.options.data = [];
                                                    
                                                    var profitlosschart_data = [];
                                                    
                                                    $.each(return_data, function(key, value){
                                                        
                                                        var chartdata = {};
                                                        
                                                        $.each(value, function(key1, value1){
                                                            chartdata["type"] = "column";
                                                            chartdata["name"] = key1;
                                                            chartdata["legendText"] = key1;
                                                            chartdata["showInLegend"] = true;
                                                            if(key1 == "Gross Profit" || key1 == "Total Cost of Sales" || key1 == "Total Operating Expenses"){
                                                                chartdata["color"] = "black";
                                                            }
                                                            if(key1 == "Net Profit" || key1 == "Total Income"){
                                                                chartdata["color"] = "green";
                                                            }
                                                            
                                                            var datapoints = [];
                                                            
                                                            for(var x = 0; x <= value1.length - 1; x++){
                                                                datapoints.push({ label:value1[x][0], y:Number(value1[x][1]) });
                                                            }
                                                            
                                                            chartdata["dataPoints"] = datapoints;
                                                        });
                                                        //console.log(chartdata);
                                                        profitlosschart_data.push(chartdata);
                                                    });
                                                    
                                                    profitlosschart.options.title.text = $("#chartprofit_loss_select_type_cb option:selected").text();
                                                    profitlosschart.options.data = profitlosschart_data;
                                                    profitlosschart.render();
                                                    $(".loading").hide();
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                    console.log(textStatus, errorThrown);
                                                    $(".loading").hide();
                                                }
                                            });
                                          }
                                          
                                          <?php 
                                            $now = date("Y-m");
                                            $from = date("Y-m-01");
                                          ?>
                                          loadProfitLoss("{{ $from }}", "{{ $now }}", $("#chartprofit_loss_period_no_txt").val(), $("#chartprofit_loss_period_type_cb option:selected").val(), $("#chartprofit_loss_select_type_cb option:selected").val());
                                          
                                          $("#chartprofit_loss_load_btn").click(function(){
                                              var from = "{{ $from }}"; //$("#chartprofit_loss_fromdate_txt").val();
                                              var to = $("#chartprofit_loss_todate_txt").val();
                                              var period = $("#chartprofit_loss_period_no_txt").val();
                                              var timeframe = $("#chartprofit_loss_period_type_cb option:selected").val();
                                              var type = $("#chartprofit_loss_select_type_cb option:selected").val();
                                              
                                              if(period > 12)
                                              {
                                                alert("Period Must be Between 1 - 11");    
                                              }
                                              else{
                                                loadProfitLoss(from, to, period, timeframe, type);
                                              }
                                          });
                                        </script>
                                              
                                    </div>
                                </div>
                            </div>
                            
                            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header bank_header">
                                        <h4 class="inouttitle">EXECUTIVE SUMMARY</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-5 mb-2">
                                                <label>Type:</label>
                                                <select class="form-control" multiple="multiple" id="exsummary_select_type_cb">
                                                    <optgroup label="Cash">
                                                        <option value="Cash received">Cash received</option>
                                                        <option value="Cash spent">Cash spent</option>
                                                        <option value="Cash surplus (deficit)">Cash surplus (deficit)</option>
                                                        <option value="Closing bank balance">Closing bank balance</option>
                                                    </optgroup>
                                                    <optgroup label="Profitability">
                                                        <option selected value="Income">Income</option>
                                                        <option  value="Direct costs">Direct costs</option>
                                                        <option  value="Gross profit (loss)">Gross profit (loss)</option>
                                                        <option value="Other income">Other income</option>
                                                        <option selected value="Expenses">Expenses</option>
                                                        <option value="Profit (loss)">Profit (loss)</option>
                                                    </optgroup>
                                                    <optgroup label="Balance Sheet">
                                                        <option value="Debtors">Debtors</option>
                                                        <option value="Creditors">Creditors</option>
                                                        <option value="Net assets">Net assets</option>
                                                    </optgroup>
                                                    <optgroup label="Sales">
                                                        <option value="Number of invoices issued">Number of invoices issued</option>
                                                        <option value="Average value of invoices">Average value of invoices</option>
                                                    </optgroup>
                                                    <optgroup label="Performance">
                                                        <option value="Gross profit margin">Gross profit margin (%)</option>
                                                        <option value="Net profit margin">Net profit margin (%)</option>
                                                        <option value="Return on investment (p.a.)">Return on investment (p.a.) (%)</option>
                                                    </optgroup>
                                                    <optgroup label="Position">
                                                        <option value="Average debtors days">Average debtors days</option>
                                                        <option value="Average creditors days">Average creditors days</option>
                                                        <option value="Short term cash forecast">Short term cash forecast</option>
                                                        <option value="Current assets to liabilities">Current assets to liabilities</option>
                                                        <option value="Term assets to liabilities">Term assets to liabilities</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <?php 
                                                    $now = date("Y-m-d h:i:sa");
                                                    $phpTimestamp = strtotime($now);
                                                    $future_timestamp = strtotime("-4 month", $phpTimestamp);
                                                    
                                                    $from = date("Y-m", $future_timestamp);
                                                  ?>
                                                <label>From:</label>
                                                <input type="month" id="exesummary_fromdate_txt" value="<?php echo $from; ?>" class="form-control" />
                                            </div>
                                            <div class="col-md-3 mb-2">
                                                <label>To:</label>
                                                <input type="month" id="exesummary_todate_txt" value="<?php echo date("Y-m"); ?>" class="form-control" />
                                            </div>
                                            <div id="per_div" style="display:none" class="col-md-3 mb-2">
                                                <label>Income Percentage Deduction (For Average Deptors Days only):</label>
                                                <input type="number" id="exesummary_percentage_txt" value="0" class="form-control" />
                                            </div>
                                            <div class="col-md-1 mb-2">
                                                <label style="color:white">:</label>
                                                <button id="exesummary_load_btn" class="btn btn-sm btn-primary"><i class="fa fa-spinner"></i> LOAD</button>
                                            </div>
                                        </div>
                                        <div id="exesummarychart" style="height: 400px; width: 100%;"></div>
                                         
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            $('#exsummary_select_type_cb').select2();
                                            
                                            var exesummarychart;
                                            
                                            exesummarychart = new CanvasJS.Chart("exesummarychart", {
                                            	animationEnabled: true,
                                            	title:{
                                            		text: "EXECUTIVE SUMMARY"
                                            	},	
                                            	
                                            	axisX:{
                                                   reversed:  true
                                                 },
                                            	toolTip: {
                                            		shared: true,
                                            	},
                                            	legend: {
                                            		cursor:"pointer",
                                            	},
                                            	data: []
                                            });
                                          
                                          function loadExecutivesummary(from_date, to_date, selecttype, percentage){
                                            
                                            $(".loading").show();
                                            $.ajax({
                                                url: "<?php echo env("APP_URL"); ?>company/loadExecutiveSummary/"+from_date + "/" + to_date + "/" + selecttype + "/" + percentage,
                                                type: "GET",
                                                dataType: "json",
                                                success: function (return_data) {
                                                    exesummarychart.options.data = [];
                                                    
                                                    var exesummarychart_data = [];
                                                    
                                                    $.each(return_data, function(key, value){
                                                        
                                                        var chartdata = {};
                                                        
                                                        $.each(value, function(key1, value1){
                                                            chartdata["type"] = "spline";
                                                            chartdata["name"] = key1;
                                                            chartdata["legendText"] = key1;
                                                            chartdata["markerSize"] = 10;
                                                            chartdata["markerBorderColor"] = "white";
                                                            chartdata["markerBorderThickness"] = 2;
                                                            if(key1 == "Gross profit margin" || key1 == "Net profit margin" || key1 == "Return on investment (p.a.)"){
                                                                chartdata["yValueFormatString"] = "0'%'";
                                                            }
                                                            else{
                                                                chartdata["yValueFormatString"] = "#,##0.##";
                                                            }
                                                            //yValueFormatString: "#,##0.##",
                                                            chartdata["showInLegend"] = true;
                                                            /*if(key1 == "Gross Profit" || key1 == "Total Cost of Sales" || key1 == "Total Operating Expenses"){
                                                                chartdata["color"] = "black";
                                                            }
                                                            if(key1 == "Net Profit" || key1 == "Total Income"){
                                                                chartdata["color"] = "green";
                                                            }*/
                                                            
                                                            var datapoints = [];
                                                            
                                                            for(var x = 0; x <= value1.length - 1; x++){
                                                                datapoints.push({ label:value1[x][0], y:parseFloat(value1[x][1]) });
                                                            }
                                                            
                                                            chartdata["dataPoints"] = datapoints;
                                                        });
                                                        //console.log(chartdata);
                                                        exesummarychart_data.push(chartdata);
                                                    });
                                                    
                                                    //exesummarychart.options.title.text = $("#exsummary_select_type_cb option:selected").text();
                                                    exesummarychart.options.data = exesummarychart_data;
                                                    exesummarychart.render();
                                                    $(".loading").hide();
                                                },
                                                error: function(jqXHR, textStatus, errorThrown) {
                                                    console.log(textStatus, errorThrown);
                                                    $(".loading").hide();
                                                }
                                            });
                                            
                                            
                                          }
                                          
                                          loadExecutivesummary("{{ $from }}", "{{ date('Y-m-d') }}", $("#exsummary_select_type_cb").val(), $("#exesummary_percentage_txt").val());
                                          
                                           $("#exesummary_load_btn").click(function(){
                                              var from = $("#exesummary_fromdate_txt").val();
                                              var to = $("#exesummary_todate_txt").val();
                                              var type = $("#exsummary_select_type_cb").val();
                                              var percent = $("#exesummary_percentage_txt").val();
                                              
                                              loadExecutivesummary(from, to, type, percent);
                                          });
                                          
                                          $('#exsummary_select_type_cb').on('select2:select', function (e) {
                                                var data = e.params.data.text;
                                                if(data == "Average debtors days"){
                                                    $("#per_div").show();
                                                }
                                            });
                                            
                                            $('#exsummary_select_type_cb').on('select2:unselecting', function (e) {
                                                
                                                if(e.params.args.data.text == "Average debtors days"){
                                                    $("#per_div").hide();
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                            
                            <!--<div class="card">
                                <div class="card-body">
                                    <div class="card-header bank_header">
                                        <h4 class="inouttitle">Accounts Receivable vs Accounts Payable</h4>
                                    </div>
                                    <div class="card-body">
                                        
                                    </div>
                                </div>
                            </div>-->
                            
                        </div>
                    </div>
                                            
                </div>
                    <div class="tab-pane " id="business_tab">
                        
                        <?php if(in_array('invoices', $companyaccess)){  ?>
                        
                        <div class="card mb-2">
                            <div class="card-body">
                                
                                <!--<div class="card">
                                    <div class="card-body"> -->
                                        <div class="card-header bank_header">
                                            <h4 class="inouttitle">INVOICES</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 mb-2">
                                                    <label>Interval:</label>
                                                    <select id="invoice_interval_cb" class="form-control bank_interval_cb">
                                                        <option value="MONTH">MONTH</option>
                                                        <option value="YEAR">YEAR</option>
                                                    </select>
                                                </div>
                                                <div>
                                                <div class="col-md-3 mb-2">
                                                <?php 
                                                    $now_date = date("Y-m-t");
                                                    $test_minus = strtotime("-9 month", strtotime($now_date));
                                                    $newdate = date("Y-m",$test_minus);
                                                                                        
                                                ?>
                                                    <label>From:</label>
                                                    <input  type="month" id="invoice_from_date_txt" value="{{ $newdate }}" class="form-control bank_from_date" />
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>To:</label>
                                                    <input  type="month" id="invoice_to_date_txt"  value="{{ date('Y-m') }}" class="form-control bank_to_date" />
                                                </div>
                                                </div>
                                                                                
                                                <div class="col-md-1 mb-2">
                                                    <label style="color:white">:</label>
                                                    <button id="invoice_load_btn" name="" class="btn btn-sm btn-primary "><i class="fa fa-spinner"></i> LOAD</button>
                                                </div>
                                            </div>
                                            <div id="invoicechart" style="height: 320px; width: 100%;"></div>
                                            <script>
                                          
                                              var invoicechart;
                                                
                                                invoicechart = new CanvasJS.Chart("invoicechart", {
                                                	animationEnabled: true,
                                                	title:{
                                                		text: "INVOICE"
                                                	},	
                                                	
                                                	axisY:{
                                                          //maximum:60000
                                                        },
                                                        axisY2:{
                                                      title: "",
                                                      tickThickness: 0,
                                                      lineThickness: 0,
                                                      labelFormatter: function(){
                                                         return " ";
                                                      }  
                                                    },
                                                      toolTip: {
                                                		shared: true,
                                                	},
                                                	axisX:{
                                                        reversed:true
                                                    },
                                                	legend: {
                                                		cursor:"pointer",
                                                	},
                                                    data: []
                                                });
                                                
                                                function getInvoicesGraph(from, to, timeframe){
                                                
                                                    $(".loading").show();
                                                    $.ajax({
                                                        url: "<?php echo env("APP_URL"); ?>company/getInvoicesGraph/"+ from + "/" + to + "/" + timeframe,
                                                        type: "GET",
                                                        dataType: "json",
                                                        success: function (return_data) {
                                                            invoicechart.options.data = [];
                                                            
                                                            var profitlosschart_data = [];
                                                            
                                                            $.each(return_data, function(key, value){
                                                                
                                                                var chartdata = {};
                                                                
                                                                $.each(value, function(key1, value1){
                                                                    
                                                                    chartdata["name"] = key1;
                                                                    chartdata["legendText"] = key1;
                                                                    chartdata["showInLegend"] = true;
                                                                    
                                                                    
                                                                    if(key1 == "PAID"){
                                                                        chartdata["color"] = "green";
                                                                        chartdata["type"] = "spline";
                                                                    }
                                                                    
                                                                    if(key1 == "DRAFT"){
                                                                        chartdata["color"] = "blue";
                                                                        chartdata["type"] = "stackedColumn";
                                                                    }
                                                                    
                                                                    if(key1 == "AUTHORISE"){
                                                                        chartdata["color"] = "skyblue";
                                                                        chartdata["type"] = "stackedColumn";
                                                                    }
                                                                    
                                                                    var datapoints = [];
                                                                    var datapoints_dummy = [];
                                                                    
                                                                    for(var x = 0; x <= value1.length - 1; x++){
                                                                        datapoints.push({ x: (x + 10) , y:Number(value1[x][1]), label:value1[x][0] });
                                                                    }
                                                                    
                                                                    chartdata["dataPoints"] = datapoints;
                                                                    
                                                                });
                                                                //console.log(chartdata);
                                                                profitlosschart_data.push(chartdata);
                                                            });
                                                            
                                                            invoicechart.options.title.text = "TOTAL INVOICES AMOUNT PER " + timeframe;
                                                            invoicechart.options.data = profitlosschart_data;
                                                            invoicechart.render();
                                                            
                                                            $(".loading").hide();
                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown) {
                                                            console.log(textStatus, errorThrown);
                                                            $(".loading").hide();
                                                        }
                                                    });
                                                  }
                                                  
                                                $("#invoice_load_btn").click(function(){
                                                  var from = $("#invoice_from_date_txt").val();
                                                  var to = $("#invoice_to_date_txt").val();
                                                  var timeframe = $("#invoice_interval_cb option:selected").val();
                                                  
                                                  getInvoicesGraph(from, to, timeframe);
                                              });
                                            </script>
                                        </div>
                                <!--    </div>
                                </div> -->
                                
                                
                                <h4><i class="fa fa-file"></i> <b id="invoices_div_title">Invoices</b></h4>
                                <div class="xero_content">
                                <div class="row">
                                    <div class="col-md-5 mb-2">
                                        <select class="form-control" id="invoices_type_cb">
                                            <option value="ACCREC">ACCOUNTS RECEIVABLE</option>
                                            <option value="ACCPAY">ACCOUNTS PAYABLE</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <select class="form-control" id="invoices_status_cb">
                                            <option value="DRAFT">Draft</option>
                                            <option value="SUBMITTED">Awaiting Approval</option>
                                            
                                            <option value="AUTHORISED">Awaiting Payment</option>
                                            <option value="PAID">Paid</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <button id="invoices_status_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                    </div>
                                </div>
                                <table class="ui celled table stripe xero_table" id="invoices_table">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Ref</th>
                                            <th>To</th>
                                            <th>Date</th>
                                            <th>Due Date</th>
                                            <th class="amount_css">Due</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(in_array('quotes', $companyaccess)){  ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <h4><i class="fa fa-file"></i> <b id="quotes_div_title">Quotes</b></h4>
                                <div class="xero_content">
                                <div class="row">
                                    <div class="col-md-10 mb-2">
                                        <select class="form-control" id="quotes_status_cb">
                                            <option value="DRAFT">Draft</option>
                                            <option value="SENT">Sent</option>
                                            <option value="DECLINED">Declined</option>
                                            <option value="ACCEPTED">Accepted</option>
                                            <option value="INVOICED">Invoiced</option>
                                            <option value="DELETED">Deleted</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <button id="quotes_status_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                    </div>
                                </div>
                                <table class="ui celled table stripe xero_table" id="quotes_table">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Ref</th>
                                            <th>Customer</th>
                                            <th>Date</th>
                                            <th>Expiry</th>
                                            <th class="amount_css">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(in_array('purchaseorder', $companyaccess)){  ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <h4><i class="fa fa-file"></i> <b id="po_div_title">Purchase Order</b></h4>
                                <div class="xero_content">
                                <div class="row">
                                    <div class="col-md-10 mb-2">
                                        <select class="form-control" id="po_status_cb">
                                            <option value="DRAFT">Draft</option>
                                            <option value="SUBMITTED">Awaiting Approval</option>
                                            
                                            <option value="AUTHORISED">Approved</option>
                                            <option value="BILLED">Billed</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <button id="po_status_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                    </div>
                                </div>
                                <table class="ui celled table stripe xero_table" id="po_table">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Reference</th>
                                            <th>Supplier</th>
                                            <th>Date Raised</th>
                                            <th>Delivery Date</th>
                                            <th class="amount_css">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="card mb-2">
                            <div class="card-body">
                                <h4><i class="fa fa-file"></i> <b id="po_div_title">Product and Services</b></h4>
                                <div class="xero_content">
                                <table class="ui celled table stripe xero_table" id="item_table">
                                    <thead>
                                        <tr>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th class="amount_css">Cost Price</th>
                                            <th class="amount_css">Sale Price</th>
                                            <th >Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="accounting_tab">
                        <?php if(in_array('manualjournal', $companyaccess)){  ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                
                                <div class="card-header bank_header">
                                            <h4 class="inouttitle">MANUAL JOURNAL</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3 mb-2">
                                                    <label>Interval:</label>
                                                    <select id="manualj_interval_cb" class="form-control bank_interval_cb">
                                                        <option value="MONTH">MONTH</option>
                                                        <option value="YEAR">YEAR</option>
                                                    </select>
                                                </div>
                                                <div>
                                                <div class="col-md-3 mb-2">
                                                <?php 
                                                    $now_date = date("Y-m-t");
                                                    $test_minus = strtotime("-9 month", strtotime($now_date));
                                                    $newdate = date("Y-m",$test_minus);
                                                                                        
                                                ?>
                                                    <label>From:</label>
                                                    <input  type="month" id="manualj_from_date_txt" value="{{ $newdate }}" class="form-control bank_from_date" />
                                                </div>
                                                <div class="col-md-3 mb-2">
                                                    <label>To:</label>
                                                    <input  type="month" id="manualj_to_date_txt"  value="{{ date('Y-m') }}" class="form-control bank_to_date" />
                                                </div>
                                                </div>
                                                                                
                                                <div class="col-md-1 mb-2">
                                                    <label style="color:white">:</label>
                                                    <button id="manualj_load_btn" name="" class="btn btn-sm btn-primary "><i class="fa fa-spinner"></i> LOAD</button>
                                                </div>
                                            </div>
                                            <div id="manualjchart" style="height: 320px; width: 100%;"></div>
                                            <script>
                                                var manualjchart;
                                                
                                                manualjchart = new CanvasJS.Chart("manualjchart", {
                                                	animationEnabled: true,
                                                	title:{
                                                		text: "MANUAL JOURNAL"
                                                	},	
                                                	
                                                	axisY:{
                                                          //maximum:60000
                                                        },
                                                        axisY2:{
                                                      title: "",
                                                      tickThickness: 0,
                                                      lineThickness: 0,
                                                      labelFormatter: function(){
                                                         return " ";
                                                      }  
                                                    },
                                                      toolTip: {
                                                		shared: true,
                                                	},
                                                	axisX:{
                                                        reversed:true
                                                    },
                                                	legend: {
                                                		cursor:"pointer",
                                                	},
                                                    data: []
                                                });
                                                
                                                function getManualJournalGraph(from, to, timeframe){
                                                
                                                    $(".loading").show();
                                                    $.ajax({
                                                        url: "<?php echo env("APP_URL"); ?>company/getManualJournalGraph/"+ from + "/" + to + "/" + timeframe,
                                                        type: "GET",
                                                        dataType: "json",
                                                        success: function (return_data) {
                                                            invoicechart.options.data = [];
                                                            
                                                            var profitlosschart_data = [];
                                                            
                                                            $.each(return_data, function(key, value){
                                                                
                                                                var chartdata = {};
                                                                
                                                                $.each(value, function(key1, value1){
                                                                    
                                                                    chartdata["name"] = key1;
                                                                    chartdata["legendText"] = key1;
                                                                    chartdata["showInLegend"] = true;
                                                                    
                                                                    
                                                                    if(key1 == "POSTED"){
                                                                        chartdata["color"] = "green";
                                                                        chartdata["type"] = "spline";
                                                                    }
                                                                    
                                                                    if(key1 == "DRAFT"){
                                                                        chartdata["color"] = "blue";
                                                                        chartdata["type"] = "column";
                                                                    }
                                                                    
                                                                    if(key1 == "AUTHORISE"){
                                                                        chartdata["color"] = "skyblue";
                                                                        chartdata["type"] = "column";
                                                                    }
                                                                    
                                                                    var datapoints = [];
                                                                    var datapoints_dummy = [];
                                                                    
                                                                    for(var x = 0; x <= value1.length - 1; x++){
                                                                        datapoints.push({ x: (x + 10) , y:Number(value1[x][1]), label:value1[x][0] });
                                                                    }
                                                                    
                                                                    chartdata["dataPoints"] = datapoints;
                                                                    
                                                                });
                                                                //console.log(chartdata);
                                                                profitlosschart_data.push(chartdata);
                                                            });
                                                            
                                                            manualjchart.options.title.text = "TOTAL MANUAL JOURNAL COUNT PER " + timeframe;
                                                            manualjchart.options.data = profitlosschart_data;
                                                            manualjchart.render();
                                                            
                                                            $(".loading").hide();
                                                        },
                                                        error: function(jqXHR, textStatus, errorThrown) {
                                                            console.log(textStatus, errorThrown);
                                                            $(".loading").hide();
                                                        }
                                                    });
                                                  }
                                                  
                                                $("#manualj_load_btn").click(function(){
                                                  var from = $("#manualj_from_date_txt").val();
                                                  var to = $("#manualj_to_date_txt").val();
                                                  var timeframe = $("#manualj_interval_cb option:selected").val();
                                                  
                                                  getManualJournalGraph(from, to, timeframe);
                                              });
                                            </script>
                                        </div>
                                
                                <h4><i class="fa fa-book"></i> <b id="manual_journal_div_title">Manual Journal - POSTED</b></h4>
                                <div class="xero_content">
                                <div class="row">
                                    <div class="col-md-10 mb-2">
                                        <select class="form-control" id="manual_journal_status_cb">
                                            <option value="POSTED">POSTED</option>
                                            <option value="DRAFT">DRAFT</option>
                                            <option value="VOIDED">VOIDED</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <button id="manual_journal_status_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                    </div>
                                </div>
                                <table class="ui celled table stripe xero_table" id="manual_journal_table">
                                    <thead>
                                        <tr>
                                            <th>Narration</th>
                                            <th>Date</th>
                                            <th class="amount_css">Debit {{ $user_currencies }}</th>
                                            <th class="amount_css">Credit {{ $user_currencies }}</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(in_array('trialbalance', $companyaccess)){  ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <h4><i class="fa fa-book"></i> <b id="trial_title">Trial Balance</b></h4>
                                <div class="xero_content">
                                    <div class="row">
                                        <div class="col-md-5 mb-2">
                                            <label>Date:</label>
                                            <input type="date" id="trial_date_txt" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
                                        </div>
                                        <div class="col-md-5 mb-2">
                                            <label>Payments Only?</label>
                                            <select class="form-control" id="trial_if_payment_cb">
                                                <option value="true">Yes</option>
                                                <option value="false">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 mb-2">
                                            <label style="color:white">:</label>
                                            <button id="trial_balance_load_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="mb-2"><i class="fa fa-list"></i> List of Intellinz Saved Trial Balance</label>
                                            <table class="ui celled table stripe xero_table" id="list_trial_balance_table">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Date</th>
                                                        <th>Payment Only?</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if(in_array('balancesheet', $companyaccess)){ ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <h4><i class="fa fa-book"></i> <b id="balance_sheet_div_title">Balance Sheet</b></h4>
                                <div class="xero_content">
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label>Date (End of last financial year):</label>
                                        <input type="date" id="balance_sheet_date_txt" value="<?php echo date('Y-m-d'); ?>" class="form-control" />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Comparison period(s), Compare with:</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="number" id="balance_sheet_period_no_txt" value="0" class="form-control" />
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" id="balance_sheet_period_type_cb">
                                                    <option value="MONTH">MONTH</option>
                                                    <option value="YEAR">YEAR</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <label style="color:white">fsda:</label>
                                        <button id="balance_sheet_load_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                    </div>
                                </div>
                                <div class="card mb-2">
                                <div class="card-body">
                                    <label class="mb-2"><i class="fa fa-list"></i> List of Intellinz Saved Balance Sheet</label>
                                <table class="ui celled table stripe xero_table" id="list_balance_sheet_table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Period</th>
                                            <th>Timeframe</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <?php if(in_array('profitandloss', $companyaccess)){ ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <h4><i class="fa fa-book"></i> <b id="profit_loss_div_title">Profit and Loss</b></h4>
                                <div class="xero_content">
                                <div class="row">
                                    <div class="col-md-4 mb-2">
                                        <label>From:</label>
                                        <input type="date" id="profit_loss_fromdate_txt" value="<?php echo date('Y-m-01'); ?>" class="form-control" />
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>To:</label>
                                        <input type="date" id="profit_loss_todate_txt" value="<?php echo date('Y-m-t'); ?>" class="form-control" />
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label>Comparison period(s), Compare with:</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="number" min="1" max="12" id="profit_loss_period_no_txt" value="0" class="form-control" />
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form-control" id="profit_loss_period_type_cb">
                                                    <option value="MONTH">MONTH</option>
                                                    <option value="QUARTER">QUARTER</option>
                                                    <option value="YEAR">YEAR</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <button id="profit_loss_load_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <label class="mb-2"><i class="fa fa-list"></i> List of Intellinz Saved Profit and Loss</label>
                                        <table class="ui celled table stripe xero_table" id="list_profit_loss_table">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Period</th>
                                                    <th>Timeframe</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="tab-pane " id="contact_tab">
                        <?php if(in_array('contacts', $companyaccess)){ ?>
                        <div class="card">
                            <div class="card-body">
                                <h4><i class="fa fa-phone"></i> <b id="contact_div_title">Contacts - ALL</b></h4>
                                <div class="xero_content">
                                <div class="row">
                                    <div class="col-md-10 mb-2">
                                        <select class="form-control" id="contact_status_cb">
                                            <option value="all">All</option>
                                            <option value="customers">Customers</option>
                                            <option value="suppliers">Suppliers</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <button id="contact_status_btn" class="btn btn-success"><i class="fa fa-spinner"></i> LOAD</button>
                                    </div>
                                </div>
                                <table class="ui celled table stripe xero_table" id="contact_table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <!--<th>Email</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>-->
                                            <th>They Owe</th>
                                            <th>You Owe</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                
                
            <?php } ?>
        </div>
    </div>
</div>
<br>
            
<script>
    $(document).ready(function(){
        $(".switch_org_btn").click(function(){
            if(confirm("Are you sure?") == true){
                var id = $(this).attr("name");
                
                formData = new FormData();
                formData.append("id", id);
                $(".loading").show();
                $.ajax({
                    url: "{{ route('changeOrganisation') }}",
                    type: "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.error == true){
                            alert("Failed to save");
                        }
                        else{
                            alert("Success");
                            window.location.reload();
                        }
                        $(".loading").hide();
                    },
                     error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                      $(".loading").hide();
                    }
                });
            }
        });
        
        <?php 
            if($if_xero_edit == true){ ?> 
                $('html, body').animate({
                  scrollTop: $(".xero_logo").offset().top
                });
            <?php } ?>
        
        $(".xero_editcancel_btn").click(function(){
            window.location.href = "<?php echo env('APP_URL'); ?>company/goXeroAnalytics";
        });
        
        $("#update_xero_btn").click(function(){
            window.location.href = "<?php echo env('APP_URL'); ?>company/goXeroAnalytics?editxero=true";
            
        });
        
        var invoices_table;
        var quotes_table;
        var po_table;
        var item_table;
        var manual_journal_table;
        var contact_table;
        
        function load_table(){
            invoices_table = $("#invoices_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
            quotes_table = $("#quotes_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
            po_table = $("#po_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
            item_table = $("#item_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
            manual_journal_table = $("#manual_journal_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
            contact_table = $("#contact_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
        }
        
        function loadManualJournal(){
            $(".loading").show();
            var status = $("#manual_journal_status_cb option:selected").val();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getManualJournal/" + status,
                type: "GET",
                success: function (data) {
                    $("#manual_journal_div_title").text("Manual Journal - " + $("#manual_journal_status_cb option:selected").text());
                    
                    $("#manual_journal_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#manual_journal_table' ) ) {
                        
                        manual_journal_table = $("#manual_journal_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#manual_journal_table').DataTable().clear().destroy();
                        $("#manual_journal_table tbody").html(data);
                        manual_journal_table = $("#manual_journal_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Manual Journal Error");
                    $(".loading").hide();
                }
            });
        }
        
        function loadInvoices(){
            $(".loading").show();
            var status = $("#invoices_status_cb option:selected").val();
            var type = $("#invoices_type_cb option:selected").val();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getInvoices/" + status+"/"+type,
                type: "GET",
                success: function (data) {
                    $("#invoices_div_title").text("Invoices - "+$("#invoices_type_cb option:selected").text()+" (" + $("#invoices_status_cb option:selected").text() + ")");
                    
                    $("#invoices_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#invoices_table' ) ) {
                        
                        invoices_table = $("#invoices_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#invoices_table').DataTable().clear().destroy();
                        $("#invoices_table tbody").html(data);
                        invoices_table = $("#invoices_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Invoices Error");
                    $(".loading").hide();
                }
            });
        }
        
        function loadQuotes(){
            $(".loading").show();
            var status = $("#quotes_status_cb option:selected").val();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getQuotes/" + status,
                type: "GET",
                success: function (data) {
                    $("#quotes_div_title").text("Quotes - " + $("#quotes_status_cb option:selected").text());
                    
                    $("#quotes_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#quotes_table' ) ) {
                        
                        quotes_table = $("#quotes_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#quotes_table').DataTable().clear().destroy();
                        $("#quotes_table tbody").html(data);
                        quotes_table = $("#quotes_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Quotes Error");
                    $(".loading").hide();
                }
            });
        }
        
        function loadPurchaseOrder(){
            $(".loading").show();
            var status = $("#po_status_cb option:selected").val();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getPurchaseOrders/" + status,
                type: "GET",
                success: function (data) {
                    $("#po_div_title").text("Purchase Order - " + $("#po_status_cb option:selected").text());
                    
                    $("#po_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#po_table' ) ) {
                        
                        po_table = $("#po_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#po_table').DataTable().clear().destroy();
                        $("#po_table tbody").html(data);
                        po_table = $("#po_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Purchase Order Error");
                    $(".loading").hide();
                }
            });
        }
        
        function loadItems(){
            $(".loading").show();
            //var status = $("#po_status_cb option:selected").val();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getItems",
                type: "GET",
                success: function (data) {
                    //$("#item_div_title").text("Product - " + $("#po_status_cb option:selected").text());
                    
                    $("#item_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#item_table' ) ) {
                        
                        item_table = $("#item_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#item_table').DataTable().clear().destroy();
                        $("#item_table tbody").html(data);
                        item_table = $("#item_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Purchase Order Error");
                    $(".loading").hide();
                }
            });
        }
        
        function loadContacts(){
            $(".loading").show();
            var status = $("#contact_status_cb option:selected").val();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getContactList/" + status,
                type: "GET",
                success: function (data) {
                    $("#contact_title").text("Contact - " + $("#contact_status_cb option:selected").text());
                    $("#contact_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#contact_table' ) ) {
                        
                        contact_table = $("#contact_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#contact_table').DataTable().clear().destroy();
                        $("#contact_table tbody").html(data);
                        contact_table = $("#contact_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Contact Error");
                    $(".loading").hide();
                }
            });
        }
        
        function loadListTrialBalance(){
            $(".loading").show();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/loadListTrialBalance/",
                type: "GET",
                success: function (data) {
                    
                    $("#list_trial_balance_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#list_trial_balance_table' ) ) {
                        
                        $("#list_trial_balance_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#list_trial_balance_table').DataTable().clear().destroy();
                        $("#list_trial_balance_table tbody").html(data);
                        $("#list_trial_balance_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Contact Error");
                    $(".loading").hide();
                }
            });
        }
        
        function loadListBalanceSheet(){
            $(".loading").show();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/loadListBalanceSheet/",
                type: "GET",
                success: function (data) {
                    
                    $("#list_balance_sheet_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#list_balance_sheet_table' ) ) {
                        
                        $("#list_balance_sheet_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#list_balance_sheet_table').DataTable().clear().destroy();
                        $("#list_balance_sheet_table tbody").html(data);
                        $("#list_balance_sheet_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Contact Error");
                    $(".loading").hide();
                }
            });
        }
        
        function loadListProfitLoss(){
            $(".loading").show();
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/loadListProfitLoss/",
                type: "GET",
                success: function (data) {
                    
                    $("#list_profit_loss_table tbody").html(data);
                    
                    if ( ! $.fn.DataTable.isDataTable( '#list_profit_loss_table' ) ) {
                        
                        $("#list_profit_loss_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    else{
                        $('#list_profit_loss_table').DataTable().clear().destroy();
                        $("#list_profit_loss_table tbody").html(data);
                        $("#list_profit_loss_table").DataTable({ "stripeClasses": [ 'odd-row', 'even-row' ], "orderClasses": false });
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Contact Error");
                    $(".loading").hide();
                }
            });
        }
        
        
        $("#business_li").click(function(){
            $("#invoices_status_cb option:first").attr('selected','selected');
            loadInvoices();
            
            $("#quotes_status_cb option:first").attr('selected','selected');
            loadQuotes();
            
            $("#po_status_cb option:first").attr('selected','selected');
            loadPurchaseOrder();
            
            loadItems();
            
            getInvoicesGraph($("#invoice_from_date_txt").val(), $("#invoice_to_date_txt").val(), $("#invoice_interval_cb option:selected").val());
            
        });
        
        
        $("#quotes_status_btn").click(function(){
           loadQuotes();
        });
        
        $("#po_status_btn").click(function(){
           loadPurchaseOrder(); 
        });
        
        $("#invoices_status_btn").click(function(){
           loadInvoices(); 
        });
        
        $("#contact_status_btn").click(function(){
           loadContacts(); 
        });
        
        
        $("#accounting_li").click(function(){
            $("#manual_journal_status_cb option:first").attr('selected','selected');
           loadManualJournal(); 
           loadListBalanceSheet();
           loadListProfitLoss();
           loadListTrialBalance();
           
           getManualJournalGraph($("#manualj_from_date_txt").val(), $("#manualj_to_date_txt").val(), $("#manualj_interval_cb option:selected").val());
        });
        
        $("#contact_li").click(function(){
            $("#contact_status_cb option:first").attr('selected','selected');
            loadContacts(); 
            
        });
        
        $("#manual_journal_status_btn").click(function(){
           loadManualJournal(); 
        });
        
        //load_table();
        
        $("body").on("click", ".narration_a", function(){
            var id = $(this).attr("name");
            var that = this;
            
            $(".loading").show();
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getManualJournalDetails/" + id,
                type: "GET",
                success: function (data) {
                    var splits = data.split("<split>");
                    
                    $("#manual_journal_details_table tbody").html(splits[1]);
                    $("#manual_journal_details_modal").modal("show");
                    
                    $("#manual_journal_details_modal_narration").text( $(that).closest("tr").find("td:eq(0)").text() );
                    $("#manual_journal_details_modal_date").text( $(that).closest("tr").find("td:eq(1)").text() );
                    
                    if(parseFloat(splits[0]) > 0){
                        $(".td_hide").css("display","block");
                    }
                    else{
                        $(".td_hide").css("display","none");
                    }
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Manual Journal Details Error");
                    $(".loading").hide();
                }
            });
        });
        
        /*$(".pdf_btn").click(function(){
            var splits = $(this).attr("name").split("<split>"); 
            
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/downloadAsPDF/" + splits[0] + "/" + splits[1],
                type: "GET",
                success: function (data) {
                    console.log(data);
                }
            });
        });*/
        
        $("body").on("click", ".invoices_a", function(){
            var id = $(this).attr("name");
            var that = this;
            
            $("#invoice_pdf_btn").attr("href", "<?php echo env("APP_URL"); ?>company/downloadAsPDF/" + id + "/invoice");
            
            $(".loading").show();
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getInvoicesDetails/" + id,
                type: "GET",
                success: function (data) {
                    var splits = data.split("<split>");
                    
                    $("#invoices_details_table tbody").html(splits[5]);
                    $("#invoices_details_modal").modal("show");
                    
                    $("#invoice_details_modal_to").text( splits[0] );
                    $("#invoice_details_modal_date").text( splits[1] );
                    $("#invoice_details_modal_duedate").text( splits[2] );
                    $("#invoice_details_modal_no").text( splits[3] );
                    $("#invoice_details_modal_reference").text( splits[4] );
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Invoices Details Error");
                    $(".loading").hide();
                }
            });
        });
        
        $("body").on("click", ".quotes_a", function(){
            var id = $(this).attr("name");
            var that = this;
            
            $("#quotes_pdf_btn").attr("href", "<?php echo env("APP_URL"); ?>company/downloadAsPDF/" + id + "/quotes");
            
            $(".loading").show();
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getQuotesDetails/" + id,
                type: "GET",
                success: function (data) {
                    var splits = data.split("<split>");
                    
                    $("#quotes_details_table tbody").html(splits[7]);
                    $("#quotes_details_modal").modal("show");
                    
                    $("#quotes_details_modal_contact").text( splits[0] );
                    $("#quotes_details_modal_date").text( splits[1] );
                    $("#quotes_details_modal_expiry").text( splits[2] );
                    $("#quotes_details_modal_no").text( splits[3] );
                    $("#quotes_details_modal_reference").text( splits[4] );
                    $("#quotes_details_modal_title").text( splits[5] );
                    $("#quotes_details_modal_summary").text( splits[6] );
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Quote Details Error");
                    $(".loading").hide();
                }
            });
        });
        
        $("body").on("click", ".po_a", function(){
            var id = $(this).attr("name");
            var that = this;
            
            $("#po_pdf_btn").attr("href", "<?php echo env("APP_URL"); ?>company/downloadAsPDF/" + id + "/po");
            
            $(".loading").show();
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getPurchaseOrderDetails/" + id,
                type: "GET",
                success: function (data) {
                    var splits = data.split("<split>");
                    
                    $("#po_details_table tbody").html(splits[5]);
                    $("#po_details_modal").modal("show");
                    
                    $("#po_details_modal_contact").text( splits[0] );
                    $("#po_details_modal_date").text( splits[1] );
                    $("#po_details_modal_deldate").text( splits[2] );
                    $("#po_details_modal_no").text( splits[3] );
                    $("#po_details_modal_reference").text( splits[4] );
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Purchase Order Details Error");
                    $(".loading").hide();
                }
            });
        });
        
        $("body").on("click", ".trial_balance_view_btn, #trial_balance_load_btn", function(){
        //$("#trial_balance_load_btn").click(function(){
            var trial_date = $("#trial_date_txt").val();
            var if_payment = $("#trial_if_payment_cb option:selected").val();
            
            var that = this;
            
            $(".loading").show();
            var xx = "not";
            if( $(this).hasClass("trial_balance_view_btn")){
                xx = btoa($(this).attr("name"));
            }
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/loadTrialBalance/" + trial_date + "/" + if_payment + "/" + xx, 
                type: "GET",
                success: function (data) {
                    var splits = data.split("<split>");
                    
                    $("#trial_table").html(splits[0]);
                    $("#trial_balance_title_txt").val(splits[1]);
                    $("#trial_balance_description_txt").val(splits[2]);
                    $("#trial_balance_id").val(splits[3]);
                    $("#trial_modal").modal("show");
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Purchase Order Details Error");
                    $(".loading").hide();
                }
            });
        });
        
        //$("#balance_sheet_load_btn").click(function(){
        $("body").on("click", ".balance_sheet_view_btn, #balance_sheet_load_btn", function(){
            
            var balance_sheet_date = $("#balance_sheet_date_txt").val();
            var balance_sheet_period_no = $("#balance_sheet_period_no_txt").val();
            var balance_sheet_period_type = $("#balance_sheet_period_type_cb option:selected").val();
            
            if(balance_sheet_period_no > 11){
                alert("Maximum period is 11");
            }
            else{
                var that = this;
                
                $(".loading").show();
                var xx = "not";
                
                var url = "<?php echo env("APP_URL"); ?>company/loadBalanceSheet/"+balance_sheet_date+"/"+balance_sheet_period_no+"/"+balance_sheet_period_type + "/"+xx;
                
                if( $(this).hasClass("balance_sheet_view_btn")){
                    xx = btoa($(this).attr("name"));
                    window.open("<?php echo env("APP_URL"); ?>company/loadBalanceSheetEditor/edit/edit/edit/"+xx, '_blank');
                    $(".loading").hide();
                }
                else{
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: function (data) {
                            var splits = data.split("<split>");
                            
                            $("#balance_sheet_table").html(splits[0]);
                            $("#balance_sheet_title_txt").val(splits[1]);
                            $("#balance_sheet_description_txt").val(splits[2]);
                            $("#balance_sheet_id").val(splits[3]);
                            $("#balance_sheet_modal").modal("show");
                            
                            $(".balancesheet_editor_btn").attr("href", "<?php echo env("APP_URL"); ?>company/loadBalanceSheetEditor/"+balance_sheet_date+"/"+balance_sheet_period_no+"/"+balance_sheet_period_type + "/na");
                            
                            $(".loading").hide();
                        },
                        error:function (data) {
                            alert("Balance Sheet Details Error");
                            $(".loading").hide();
                        }
                    });
                }
            }
        });
        
        $("body").on("click", ".profit_loss_view_btn, #profit_loss_load_btn", function(){
        //$("#profit_loss_load_btn").click(function(){
            var from = $("#profit_loss_fromdate_txt").val();
            var to = $("#profit_loss_todate_txt").val();
            var period = $("#profit_loss_period_no_txt").val();
            var timeframe = $("#profit_loss_period_type_cb option:selected").val();
            
            var that = this;
            
            $(".loading").show();
            var xx = "not";
            if( $(this).hasClass("profit_loss_view_btn")){
                xx = btoa($(this).attr("name"));
                window.open("<?php echo env("APP_URL"); ?>company/loadProfitLossEditor/edit/edit/edit/edit/" + xx, '_blank');
                $(".loading").hide();
            }
            else{
                $.ajax({
                    url: "<?php echo env("APP_URL"); ?>company/loadProfitAndLoss/"+from+"/"+to+"/"+period + "/" + timeframe + "/" + xx,
                    type: "GET",
                    success: function (data) {
                        var splits = data.split("<split>");
                        
                        $("#profit_loss_id").val(splits[3]);
                        $("#profit_loss_title_txt").val(splits[1]);
                        $("#profit_loss_description_txt").val(splits[2]);
                        $("#profit_loss_table").html(splits[0]);
                        $("#profit_loss_modal").modal("show");
                        
                        $(".profitloss_editor_btn").attr("href", "<?php echo env("APP_URL"); ?>company/loadProfitLossEditor/"+from+"/"+to+"/"+period + "/" + timeframe + "/na");
                        
                        $(".loading").hide();
                    },
                    error:function (data) {
                        alert("Profit and Loss Details Error");
                        $(".loading").hide();
                    }
                });
            }
        });
        
        $("#balance_sheet_save_btn").click(function(){
            var balance_sheet_date = $("#balance_sheet_date_txt").val();
            var balance_sheet_period_no = $("#balance_sheet_period_no_txt").val();
            var balance_sheet_period_type = $("#balance_sheet_period_type_cb option:selected").val();
            var title = $("#balance_sheet_title_txt").val();
            var description = $("#balance_sheet_description_txt").val();
            
            if(title == "" || description == ""){
                alert("Please provide title and description for this Balance Sheet");
            }
            else{
                formData = new FormData();
                formData.append("date", balance_sheet_date);
                formData.append("period", balance_sheet_period_no);
                formData.append("ptype", balance_sheet_period_type);
                formData.append("title", title);
                formData.append("description", description);
                formData.append("id", $("#balance_sheet_id").val());
                $(".loading").show();
                $.ajax({
                    url: "{{ route('saveBalanceSheet') }}",
                    type: "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.error == true){
                            alert("Failed to save");
                        }
                        else{
                            alert("Success");
                            loadListBalanceSheet();
                            $("#balance_sheet_modal").modal("hide");
                        }
                        $(".loading").hide();
                    },
                     error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                    }
                });
            }
        });
        
        
        $("#profit_loss_save_btn").click(function(){
            var from = $("#profit_loss_fromdate_txt").val();
            var to = $("#profit_loss_todate_txt").val();
            var period = $("#profit_loss_period_no_txt").val();
            var timeframe = $("#profit_loss_period_type_cb option:selected").val();
            var title = $("#profit_loss_title_txt").val();
            var description = $("#profit_loss_description_txt").val();
            
            if(title == "" || description == ""){
                alert("Please provide title and description for this Balance Sheet");
            }
            else{
                formData = new FormData();
                formData.append("from", from);
                formData.append("to", to);
                formData.append("period", period);
                formData.append("timeframe", timeframe);
                formData.append("title", title);
                formData.append("description", description);
                formData.append("id", $("#profit_loss_id").val());
                $(".loading").show();
                $.ajax({
                    url: "{{ route('saveProfitLoss') }}",
                    type: "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.error == true){
                            alert("Failed to save");
                        }
                        else{
                            alert("Success");
                            loadListProfitLoss();
                            $("#profit_loss_modal").modal("hide");
                        }
                        $(".loading").hide();
                    },
                     error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                    }
                });
            }
        });
        
        $("#trial_balance_save_btn").click(function(){
            var date = $("#trial_date_txt").val();
            var payment = $("#trial_if_payment_cb option:selected").val();
            var title = $("#trial_balance_title_txt").val();
            var description = $("#trial_balance_description_txt").val();
            
            if(title == "" || description == ""){
                alert("Please provide title and description for this Trial Balance");
            }
            else{
                formData = new FormData();
                formData.append("date", date);
                formData.append("payment", payment);
                formData.append("title", title);
                formData.append("description", description);
                formData.append("id", $("#trial_balance_id").val());
                $(".loading").show();
                $.ajax({
                    url: "{{ route('saveTrialBalance') }}",
                    type: "POST",
                    data: formData,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.error == true){
                            alert("Failed to save");
                        }
                        else{
                            alert("Success");
                            loadListTrialBalance();
                            $("#trial_modal").modal("hide");
                        }
                        $(".loading").hide();
                    },
                     error: function(jqXHR, textStatus, errorThrown) {
                      console.log(textStatus, errorThrown);
                    }
                });
            }
        });
        
        $("body").on("click", ".account_det_a", function(){
            var id = $(this).attr("name");
            $(".loading").show();
            $.ajax({
                url: "<?php echo env("APP_URL"); ?>company/getAccountDetailsTable/"+id,
                type: "GET",
                success: function (data) {
                    $("#main_details_table").html(data);
                    $("#main_details_modal").modal("show");
                    
                    $(".loading").hide();
                },
                error:function (data) {
                    alert("Profit and Loss Details Error");
                    $(".loading").hide();
                }
            });
            
        });
    });
</script>
</div>

@endsection