<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

use Config;
use App\CompanyProfile;
use App\Buytoken;
use Session;
use App\Subscribers;

class BuytokenController extends Controller
{
   
    public function buyTokensSuccess(Request $request){
      
      if(isset($_GET["token"]))
      {  
      
        $token = $_GET["token"];
       // $payerID = $_GET["PayerID"];

        $result = BuytokenController::executeGetExpressCheckoutDetails($token); //receipt
        //var_dump($result); exit;
      
            if($result['ACK'] == 'Success') {


                    $tokenID=$result['TOKEN'];
                    $payerID=$result['PAYERID'];
                    $buyerEmail=$result['EMAIL'];

      
                    $company_id = CompanyProfile::getCompanyId(Session::get('TokenBuyerId'));

                       if(Session::get('TopUp') == 1){
                       
                        BuytokenController::executeDoExpressCheckoutPayment($tokenID, $payerID, Session::get('TokenAmount'), "One time pay");
      
                        Buytoken::create([
                            'company_id'=>$company_id, 
                            'num_tokens'=>Session::get('TokenCount'), 
                            'amount'=>Session::get('TokenAmount'), 
                            'created_at'=>date('Y-m-d'), 
                            'paypal_id'=>$payerID, 
                            'paypal_token'=>$tokenID,
                        ]);
                        
                        return redirect('/reports/buyTokens')->with('status', 'You have successfuly purchased '.Session::get('TokenCount').' tokens.');


                       } else if(Session::get('TopUp') == 2) {

                       $doEx = BuytokenController::executeDoExpressCheckoutPayment($tokenID, $payerID, 36.0, "Prokakis Monthly Subscription");
       
                        //recurring
                        $tokenID=$result['TOKEN'];
                        $recurrStartDate = date('Y-m-d', strtotime(' + 1 months')); 

                        if($doEx['ACK'] == 'Success') 
                        {

                          $okRecur = BuytokenController::executeCreateRecurringProfile($tokenID, $payerID, 
                          'Prokakis Monthly Subscription',$recurrStartDate, 36.0, 'Month', $result['EMAIL'], $result);

                          if($okRecur['ACK'] == 'Success') 
                          { 

                            Subscribers::create([
                              'company_id'  =>  $company_id, 
                              'payer_email' =>  $buyerEmail,
                              'start_date'  =>  $recurrStartDate, 
                              //'end_date'  =>  , 
                              'subs_type'   => 'monthly', 
                              'profileId'   => $okRecur['PROFILEID'], 
                              'created_at'  => date('Y-m-d'), 
                              'status'      => 1,
                            ]);


                            return redirect('/reports/buyTokens')->with('status', 'You have successfuly enrolled the monthly subscription');
                       
                          } else {

                              Subscribers::create([
                                'company_id'  =>  $company_id, 
                                'payer_email' =>  $buyerEmail,
                                'start_date'  =>  date('Y-m-d'), 
                                'end_date'  =>  $recurrStartDate, 
                                'subs_type'   => 'monthly', 
                               // 'profileId'=> $okRecur['PROFILEID'], 
                                'created_at'  => date('Y-m-d'), 
                                'status'      => 1,
                              ]);
                              return redirect('/reports/buyTokens')->with('message', 'You have successfuly paid the first month, but there is an error encountered upon creating your monthly recurring payment');
  
                          }      
                        } 
                        
                       
                      }  else if(Session::get('TopUp') == 3) {

                       $okDo = BuytokenController::executeDoExpressCheckoutPayment($tokenID, $payerID, 396.0, "Prokakis Yearly Subscription");
       
                         //recurring
                         $tokenID=$result['TOKEN'];
                         //$payerID=$result['PayerID'];
                         $recurrStartDate = date('Y-m-d', strtotime(' + 12 months')); 

                         if($okDo['ACK'] == 'Success') 
                         {
 
                         $okRecur = BuytokenController::executeCreateRecurringProfile($tokenID, $payerID, 
                           'Prokakis Yearly Subscription',$recurrStartDate, 396.0, 'Year', $result['EMAIL'], $result);
                           
                           if($okRecur['ACK'] == 'Success') {
                             
                              Subscribers::create([
                                'company_id'  =>  $company_id, 
                                'payer_email' =>  $buyerEmail,
                                'start_date'  =>  date('Y-m-d'), 
                               // 'end_date'    =>  $recurrStartDate, 
                                'subs_type'   => 'yearly', 
                                'paypal_token'=> $okRecur['PROFILEID'],
                                'created_at'  => date('Y-m-d'), 
                                'status'      => 1,
                              ]);
    
                           return redirect('/reports/buyTokens')->with('status', 'You have successfuly enrolled the yearly subscription');

                           }else {

                            Subscribers::create([
                              'company_id'  =>  $company_id, 
                              'payer_email' =>  $buyerEmail,
                              'start_date'  =>  date('Y-m-d'), 
                              'end_date'    =>  $recurrStartDate, 
                              'subs_type'   => 'yearly', 
                             // 'paypal_token'=> $okRecur['PROFILEID'],
                              'created_at'  => date('Y-m-d'), 
                              'status'      => 1,
                            ]);

                            return redirect('/reports/buyTokens')->with('message', 'You have successfuly paid the first year, but there is an error encountered upon creating your yearly recurring payment');
                            
                          }

                        }


                      } else if(Session::get('TopUp') == 4) {

                        BuytokenController::executeDoExpressCheckoutPayment($tokenID, $payerID, Session::get('TokenAmount'), "1 Report with 120 credits");
      
                        Buytoken::create([
                            'company_id'=>$company_id, 
                            'num_tokens'=>Session::get('TokenCount'), 
                            'amount'=>Session::get('TokenAmount'), 
                            'created_at'=>date('Y-m-d'), 
                            'paypal_id'=>$payerID, 
                            'paypal_token'=>$tokenID,
                        ]);
                        
                        return redirect('/reports/buyTokens')->with('status', 'You have successfuly purchased '.Session::get('TokenCount').' credits.');

                      } else if(Session::get('TopUp') == 5) {

                        BuytokenController::executeDoExpressCheckoutPayment($tokenID, $payerID, Session::get('TokenAmount'), "5 Reports with 590 credits");
      
                        Buytoken::create([
                            'company_id'=>$company_id, 
                            'num_tokens'=>Session::get('TokenCount'), 
                            'amount'=>Session::get('TokenAmount'), 
                            'created_at'=>date('Y-m-d'), 
                            'paypal_id'=>$payerID, 
                            'paypal_token'=>$tokenID,
                        ]);
                        
                        return redirect('/reports/buyTokens')->with('status', 'You have successfuly purchased '.Session::get('TokenCount').' credits.');


                      }
                       
            }  
       }    
        
    }



    public function buyTokensCancel(Request $request){

      Log::info('Cancelled Buying of Tokens:'.Session::get('TokenBuyerId').' '. Session::get('TokenAmount')); 

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

                    'VERSION' => 124.0, 

                    'TOKEN' => $token, 

                    );

      return  BuytokenController::executeCurl($request_params);   

    }

    public static function executeDoExpressCheckoutPayment($token, $payerID, $amount, $description)
    {
        $request_params = array

                    (

                    'USER' => Config::get('constants.options.PAYPAL_API_USERNAME'), 
                    'PWD' => Config::get('constants.options.PAYPAL_API_PASSWORD'), 
                    'SIGNATURE' => Config::get('constants.options.PAYPAL_API_SIGNATURE'), 
                    'METHOD' => 'DoExpressCheckoutPayment', 
                    'VERSION' => 124.0, 
                    'TOKEN' => $token, 
                    'PAYMENTACTION' => 'Authorization',
                    'PAYERID' => $payerID, 
                    'AMT' => $amount,  
                    'CURRENCYCODE' => 'USD', 
                    'L_BILLINGTYPE0' => 'RecurringPayments',  
                    'L_BILLINGAGREEMENTDESCRIPTION0' => $description, 
                    );

      return  BuytokenController::executeCurl($request_params);    
       
    }

    public static function executeCreateRecurringProfile($token, $payerID, $description, 
    $payStartDate, $amount, $billingPeriod, $email, $rs)
    {

        $request_params = array
        (

        'USER' => Config::get('constants.options.SANDBOX_PAYPAL_API_USERNAME'), 
        'PWD' => Config::get('constants.options.SANDBOX_PAYPAL_API_PASSWORD'), 
        'SIGNATURE' => Config::get('constants.options.SANDBOX_PAYPAL_API_SIGNATURE'), 
        'METHOD' => 'CreateRecurringPaymentsProfile', 
        'VERSION' => 124.0, 
        'TOKEN' => $token,
        'EMAIL' => $email,
        'PAYERID' => $payerID,
        'PROFILESTARTDATE'=> $payStartDate.'T00:00:00Z',
        'DESC'=>$description,
        'BILLINGPERIOD'=>$billingPeriod,
        'BILLINGFREQUENCY'=>1,
        'AMT'=>$amount,
        'CURRENCYCODE'=>'USD',
        'COUNTRYCODE' => 'SG',
        'MAXFAILEDPAYMENTS'=>3,
        'AUTOBILLAMT'=>'AddToNextBilling',
        'SUBSCRIBERNAME' => $rs['FIRSTNAME'].' '.$rs['LASTNAME'],
        'FIRSTNAME'=>$rs['FIRSTNAME'],
        'LASTNAME'=>$rs['LASTNAME'],
        'STREET'=>$rs['SHIPTOSTREET'],
        'CITY'=>$rs['SHIPTOCITY'],
        'COUNTRYCODE'=>$rs['SHIPTOCITY'],
        );

        return BuytokenController::executeCurl($request_params);
    }


    public static function executeCurl($request_params)
    {

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


   
}
