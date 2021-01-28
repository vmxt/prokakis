<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

use Config;
use App\CompanyProfile;
use App\Buytoken;
use Session;

class BuytokenController extends Controller
{
   
    public function buyTokensSuccess(Request $request){
      
      if(isset($_GET["token"]) && isset($_GET["PayerID"]))
      {  
      
        $token = $_GET["token"];
    
        $result = BuytokenController::executeGetExpressCheckoutDetails($token);
      
            if($result['ACK'] == 'Success') {

                    $tokenID=$result['TOKEN'];

                    $payerID=$result['PAYERID'];

                    BuytokenController::executeDoExpressCheckoutPayment($tokenID, $payerID, Session::get('TokenAmount'));
      
                        $company_id = CompanyProfile::getCompanyId(Session::get('TokenBuyerId'));

                        Buytoken::create([
                            'company_id'=>$company_id, 
                            'num_tokens'=>Session::get('TokenCount'), 
                            'amount'=>Session::get('TokenAmount'), 
                            'created_at'=>date('Y-m-d'), 
                            'paypal_id'=>$payerID, 
                            'paypal_token'=>$tokenID,
                        ]);
                        
                        return redirect('/reports/buyTokens')->with('status', 'You have successfuly purchased '.Session::get('TokenCount').' tokens.');

            }  
       }    
        
    }

    public function buyTokensCancel(Request $request){

      Log::info('Cancelled Buying of Tokens'); 

       return redirect('/reports/buyTokens')->with('message', 'You have cancelled the top up process.');

    }


    public static function executeGetExpressCheckoutDetails($token)
    {    
         $request_params = array

                    (

                    'USER' => Config::get('constants.options.PAYPAL_API_USERNAME'), 

                    'PWD' => Config::get('constants.options.PAYPAL_API_PASSWORD'), 

                    'SIGNATURE' => Config::get('constants.options.PAYPAL_API_SIGNATURE'), 

                    'METHOD' => 'GetExpressCheckoutDetails', 

                    'VERSION' => 93, 

                    'TOKEN' => $token, 

                    );



                    $nvp_string = '';

                    foreach($request_params as $var=>$val)
                    {

                        $nvp_string .= '&'.$var.'='.urlencode($val);    

                    }           



                        $curl = curl_init();

                        curl_setopt($curl, CURLOPT_VERBOSE, 1);

                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

                        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

                        curl_setopt($curl, CURLOPT_URL, Config::get('constants.options.PAYPAL_API_ENDPOINT'));

                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

                        $result = curl_exec($curl);     

                        curl_close($curl); 

                        $rs = array();

                        parse_str($result, $rs);

                        return $rs;

    }

    public static function executeDoExpressCheckoutPayment($token, $payerID, $amount)
    {
        $request_params = array

                    (

                    'USER' => Config::get('constants.options.PAYPAL_API_USERNAME'), 

                    'PWD' => Config::get('constants.options.PAYPAL_API_PASSWORD'), 

                    'SIGNATURE' => Config::get('constants.options.PAYPAL_API_SIGNATURE'), 

                    'METHOD' => 'DoExpressCheckoutPayment', 

                    'VERSION' => 93, 

                    'TOKEN' => $token, 

                    'PAYERID' => $payerID, 

                    'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE', 

                    'PAYMENTREQUEST_0_AMT' => $amount, 

                    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD', 

                    );
               
                 $nvp_string = '';

                foreach($request_params as $var=>$val)
                {
                    $nvp_string .= '&'.$var.'='.urlencode($val);    

                }           

                $curl = curl_init();

                curl_setopt($curl, CURLOPT_VERBOSE, 1);

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

                curl_setopt($curl, CURLOPT_TIMEOUT, 30);

                curl_setopt($curl, CURLOPT_URL, Config::get('constants.options.PAYPAL_API_ENDPOINT'));

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

                curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

                $result = curl_exec($curl);     

                curl_close($curl); 

    }




   
}
