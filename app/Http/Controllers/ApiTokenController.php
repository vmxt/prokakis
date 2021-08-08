<?php



namespace App\Http\Controllers;





use Illuminate\Http\Request;

use App\AccessTokenUser;

use App\AccessToken;

use App\OpportunityBuildingCapability;

use App\OpportunityBuy;

use App\OpportunitySellOffer;

use App\OppIndustry;

use Illuminate\Support\Facades\DB;
use Config;
use App\UploadImages;
use App\Countries;



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

                     $imgSrc = 'https://app-prokakis.com/public/images/industry/'.$ind->image;

                     $ret[] = array('business_description'=>$d->intro_describe_business, 
                     'country'=>$d->ideal_partner_base, 
                     'industry_category'=>$ind->text, 
                     'industry_image'=>$imgSrc,
                     'title'=>$d->opp_title);

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


    public function getOpportunitiesFree(Request $request)
    {
         
                     $obc = OpportunityBuildingCapability::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     ->orderBy('id', 'desc')
                     ->limit(5)
                     ->get();
                     
                     $ob =  OpportunityBuy::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     ->orderBy('id', 'desc')
                     ->limit(5)
                     ->get();
                     
                     $oso = OpportunitySellOffer::where('status', 1)
                     ->where('intro_describe_business', '!=', null)
                     ->where('ideal_partner_base', '!=', null)
                     ->orderBy('id', 'desc')
                     ->limit(5)
                     ->get();
                     
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
		     $cc = [];
		     $c_country = "";		
		     if(strlen($d->ideal_partner_base) > 0){
			$cc = explode(",",$d->ideal_partner_base);
			if(isset($cc[0]))
			{
			$c_country = $c_country . $cc[0];  	
			}
			if(isset($cc[1])){
			$c_country = $c_country . ','.$cc[1];
			}
			if(isset($cc[2])){
			$c_country = $c_country . ','.$cc[2];
			}
	
		     }	

            if($d->is_anywhere == 1){
                $c_country = "Anywhere";
            }

             $keyword = explode(",", $d->relevant_describing_partner);
             $hashKey ="";
             if( $d->relevant_describing_partner ){
                 foreach ($keyword as $val ) {
                    if($val!="")
                     $hashKey .= '#'.str_replace(' ','_',$val)." ";
                 }
             }
		     $ttitle = substr($d->opp_title, 0, 33).'..';	
                     $ind =  OppIndustry::find($d->industry);
                     $imgSrc = 'https://app-prokakis.com/public/images/industry/'.$ind->image;
                     $ret[] = array('business_description'=>$d->intro_describe_business, 
                     'country'=>$c_country, 
                     'keyword'=>$hashKey ,
                     'keyword_raw'=>$d->relevant_describing_partner ,
                     'industry_category'=>$ind->text, 
                      'est_revenue'=>$d->est_revenue, 
                       'oppo_id'=>$d->id, 
                      'est_profit'=>$d->est_profit, 
                      'inventory_value'=>$d->inventory_value, 
                      'asking_price'=>$d->approx_large, 
                     'industry_image'=>$imgSrc,
                     'title'=> strtoupper($d->opp_title) );
                     }

                     $result['data'] = $ret; 
                     header('Content-Type: application/json');
                     echo json_encode($result); 
    
    }

 public function getTopAdvisers(Request $request)
    {
     $result = DB::select('
      SELECT DISTINCT company_id, 
      (SELECT COUNT(*) FROM `request_report` t WHERE t.company_id = b.company_id) AS totalRecords, 
      cp.company_name, cp.primary_country, u.id AS user_id, u.firstname, u.lastname, u.email
      FROM `request_report` b
      JOIN `company_profiles` cp ON b.company_id = cp.id
      JOIN `users` u ON u.id = cp.user_id
      ORDER BY totalRecords DESC
      LIMIT 0, 3'); 
      $ret = null;
    
      foreach($result as $d){
        $url = "https://app-prokakis.com/public/images/".UploadImages::getFileNames($d->user_id, $d->company_id, Config::get('constants.options.profile'), 1);
        $c = Countries::where('country_code', $d->primary_country)->first();
        $country = ($c != null)? $c->country_name : '';
        $ret[] = array('img'=>$url,
                'company'   => $d->company_name,
                'firstname' =>$d->firstname,
                'lastname'  =>$d->lastname,
                'country'   =>$country,
                ); 
      }

      header('Content-Type: application/json');
      echo json_encode($ret); 
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