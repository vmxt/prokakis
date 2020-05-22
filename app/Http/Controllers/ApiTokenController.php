<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\AccessTokenUser;
use App\AccessToken;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use App\OppIndustry;

class ApiTokenController extends Controller 
{
    //to set some endpoint available for public
    public function __construct()
    {
	    //$this->middleware('auth');
    } 
    
    //check token status
    public function validateAccessToken(Request $request)
    {
        if($request['accessToken']){
           $accessToken = $request['accessToken'];
           $accToken = AccessToken::where('token', $accessToken)->first();
           $res = null;
           if($accToken != null){
                if(AccessToken::checkExpiredToken($accToken->end_date) == '1'){ //active
                    $res = array('status'=> 'ACTIVE');
                } else {
                    $res = array('status'=> 'EXPIRED');
                }

                header('Content-Type: application/json');
                echo json_encode($res); 
           } 
        }

    }

    //get token result
    public function validateTransactionUrl(Request $request)
    {
        if($request['url']){
           $url = $request['url'];
           $res = AccessTokenUser::validateTransactionUrl($url);
        
           header('Content-Type: application/json');
           echo json_encode($res);
        }


    }

    //intro_describe_business, ideal_partner_base, industry
    public function getOpportunities(Request $request)
    {
        if($request['accessToken']){

            $accessToken = $request['accessToken'];
            $accToken = AccessToken::where('token', $accessToken)->first();
            $res = null;

            if($accToken != null){

                 if(AccessToken::checkExpiredToken($accToken->end_date) == '1'){ //active
                  
                     $obc = OpportunityBuildingCapability::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     ->limit(3)->get();
                     
                     $ob =  OpportunityBuy::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     ->limit(3)->get();
                     
                     $oso = OpportunitySellOffer::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     ->limit(3)->get();
                     
                     $r = rand(1, 3);
                     $v = null; 
                     $ret = array();
               
                     if($r == 1){
                       $v = $obc; 
                     } elseif($r == 2){
                       $v = $ob; 
                     } elseif($r == 3){
                       $v = $oso; 
                     }
                    
                     $result = array('result'=>'success');

                     foreach($v as $d){
                     $ind =  OppIndustry::find($d->industry);
                     $imgSrc = 'https://app.prokakis.com/public/images/industry/'.$ind->image;
                     $ret[] = array('business description'=>$d->intro_describe_business, 'country'=>$d->ideal_partner_base, 'industry category'=>$ind->text, 'industry image'=>$imgSrc);
                     }
                     $result['data'] = $ret; 
                     header('Content-Type: application/json');
                     echo json_encode($result); 


                 } else {
                     $res = array('result'=>'error', 'message'=> 'token expired');
                     header('Content-Type: application/json');
                     echo json_encode($res); 
                 }
 
                
            } else {
                $res = array('result'=>'error', 'message'=> 'invalid token');
                header('Content-Type: application/json');
                echo json_encode($res); 

            }

         }else{
            $res = array('result'=>'error', 'message'=> 'token required');
            header('Content-Type: application/json');
            echo json_encode($res); 
         }
        
    
    }


    public function validateTokenTest(Request $request)
    {
        
        $publickey = '07a932dd17adc59b49561f33980ec5254688a41f133b8a26e76c611073ade89b';
        $secretkey = '5254688a41f133b8a26e76c611073ade89b';
        $saltDate = date('YmdHis');
     
        $genCode = hash_hmac('haval256,5', $publickey, $secretkey.$saltDate);
        echo $genCode . '<br />';

        $public_key = base64_encode($publickey);
        $gen_Code = base64_encode($genCode);
        $salt_Date = base64_encode($saltDate);


        $url = $public_key.'|'.$gen_Code.'|'.$salt_Date;
        echo $url . '<br />';
        echo strlen($url); 
        echo '<br />';

        
        $res = AccessTokenUser::validateTransactionUrl($url);
        var_dump($res);
        //--

    }


}