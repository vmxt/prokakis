<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Config;
use App\AuditLog;
use App\Subscribers;

class IpnController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		//$this->middleware('auth');

    }

    public function getIpnDataGet()
    {
        die('Paypal listener... for post method only.');
    }
    

    public function getIpnDataPost()
    {
	
		// STEP 1: Read POST data
        // reading posted data from directly from $_POST causes serialization 
        // issues with array data in POST
        // reading raw POST data from input stream instead. 
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
        $keyval = explode ('=', $keyval);
        if (count($keyval) == 2)
            $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        // read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
        } 
       
        foreach ($myPost as $key => $value) {        
       
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
                    $value = urlencode(stripslashes($value)); 
            } else {
                    $value = urlencode($value);
            }
            $req .= "&$key=$value";
            
        }


        // STEP 2: Post IPN data back to paypal to validate

        $ch = curl_init(Config::get('constants.options.PAYPAL_IPN_BACKTOPAYPAL_SANBOX'));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

        // In wamp like environments that do not come bundled with root authority certificates,
        // please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
        // of the certificate as shown below.
        // curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        if( !($res = curl_exec($ch)) ) {
            // error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);


        // STEP 3: Inspect IPN validation result and act accordingly

        if (strcmp ($res, "VERIFIED") == 0) {
            // check whether the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your Primary PayPal email
            // check that payment_amount/payment_currency are correct
            // process payment

            // assign posted variables to local variables
            $item_name = $_POST['item_name'];
            $item_number = $_POST['item_number'];
            $payment_status = $_POST['payment_status'];
            $payment_amount = $_POST['mc_gross'];
            $payment_currency = $_POST['mc_currency'];
            $txn_id = $_POST['txn_id'];
            $txn_type = $_POST['txn_type'];
            $receiver_email = $_POST['receiver_email'];
            $payer_email = $_POST['payer_email'];

            // <---- HERE you can do your INSERT to the database
            DB::table('paypal_ipn')->insert(
                [
                'item_name'      => $item_name,
                'item_number'    => $item_number,
                'payment_status' => $payment_status,
                'mc_gross'       => $payment_amount,
                'mc_currency'    => $payment_currency,
                'txn_id'         => $txn_id,
                'receiver_email' => $receiver_email,
                'payer_email'    => $payer_email,
                'txn_type'       => $txn_type,
                'created_at'     => date('Y-m-d'),
                ]
            );


             /* In the context of subscription payments, the txn_type field may contain any of the following values:
            subscr_signup - a subscriber has signed up for the service
            subscr_payment - a subscriber has paid for the service
            subscr_failed - a subscriber tried to pay for the service but things didn't work out
            subscr_cancel / subscr_cancelled - a subscriber cancelled a subscription
            subscr_eot - a subscriber has reached the end of the subscription term
            subscr_modify - a subscriber profile has been modified */

            switch ($txn_type) {

                case 'subscr_modify':
                    $recur_profileId = $_POST['recurring_payment_id'];    
                    $cs = Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->count();
                     
                    if($cs > 0){
                       $rs =  Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->first();
                       $rs->status = 0;
                       $rs->save(); 
                      }  
    
                    AuditLog::ok(array(0, 'paypal', 'Subscription modify from Paypal IPN', 'Recurring ProfileId'. $recur_profileId)); 
    
                break;

                case 'subscr_failed':
                    $recur_profileId = $_POST['recurring_payment_id'];    
                    $cs = Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->count();
                     
                    if($cs > 0){
                       $rs =  Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->first();
                       $rs->status = 0;
                       $rs->save(); 
                      }  
    
                    AuditLog::ok(array(0, 'paypal', 'Subscription failed from Paypal IPN', 'Recurring ProfileId'. $recur_profileId)); 
    
                break;

                case 'subscr_cancel':
                $recur_profileId = $_POST['recurring_payment_id'];    
                $cs = Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->count();
                 
                if($cs > 0){
                   $rs =  Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->first();
                   $rs->status = 0;
                   $rs->save(); 
                  }  

                AuditLog::ok(array(0, 'paypal', 'Subscription cancelled from Paypal IPN', 'Recurring ProfileId'. $recur_profileId)); 

                break;


                case 'subscr_cancelled':
                    $recur_profileId = $_POST['recurring_payment_id'];    
                    $cs = Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->count();
                     
                    if($cs > 0){
                       $rs =  Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->first();
                       $rs->status = 0;
                       $rs->save(); 
                      }  
    
                    AuditLog::ok(array(0, 'paypal', 'Subscription cancelled from Paypal IPN', 'Recurring ProfileId'. $recur_profileId)); 
    
                    break;
     
                case 'subscr_eot':
                    $rs = null;
                    $recur_profileId = $_POST['recurring_payment_id'];    
                    $cs = Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->count();
                     
                    if($cs > 0){
                       $rs =  Subscribers::where('payer_email', $payer_email)->where('profileId', $recur_profileId)->where('status', 1)->first();
                       $rs->status = 0;
                       $rs->save(); 
                      }  
    
                    AuditLog::ok(array(0, 'paypal', 'Subscription Ended from Paypal IPN', 'Recurring ProfileId'. $recur_profileId)); 
    
                
                break;
            }
           

        } else if (strcmp ($res, "INVALID") == 0) {
            // log for manual investigation

            AuditLog::ok(array(0, 'ipn', 'INVALID', 'INVALID')); 

        }


        
    }
}