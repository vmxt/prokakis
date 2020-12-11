<?php





namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;



use App\Configurations;

use Auth;

use Config;

use Grids;

use HTML;

use App\RequestReport;

use App\CompanyProfile;

use App\Buytoken;

use App\Companytoken;

use Session;

use App\AuditLog;

use App\WhoViewedMe;





class ReportsController extends Controller

{

    

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

       $this->middleware('auth');

    }

    

    public function index()

    {

       $user_id = Auth::id(); 

        $company_id_result = CompanyProfile::getCompanyId($user_id);

        $listData = RequestReport::where('company_id', $company_id_result)->get();

        $viewedMe = WhoViewedMe::where('presenter_company_id', $company_id_result)->get();

        return view('reports.list',  compact('listData', 'viewedMe'));   

    //return view('reports.index');

   

    }

    

    public function list()

    {

        $user_id = Auth::id(); 

        $company_id_result = CompanyProfile::getCompanyId($user_id);

        //echo $company_id_result;

        

        $listData = RequestReport::where('company_id', $company_id_result)->get();

        $viewedMe = WhoViewedMe::where('presenter_company_id', $company_id_result)->get();



        return view('reports.list',  compact('listData', 'viewedMe'));

    }



    public function buyTokens()

    {

        return view('reports.buytokens');

    }



    public function topUpTokens(Request $request)

    {

        if($request->isMethod('post')) 

        {  



            $formatPay = array(1=>120, 2=>720, 3=>1200);



            $input = $request->input("top_up");



            AuditLog::ok(array(Auth::id(), 'reports', 'top up tokens', 'buying a new tokens of worth '.$input)); 



            switch ($input) {

                case 1:

                    Session::put('TokenAmount', $formatPay[1]);

                    Session::put('TokenBuyerId', Auth::id());

                    Session::put('TokenCount', 2);

                    Log::info('User Id:' . Auth::id() .' Buy Token Amount:'.$formatPay[1]);

                    $rs = ReportsController::executeSetExpressCheckout($formatPay[1]);

                        if($rs['ACK'] == 'Success') {

                            Session::put('PaypalToken', $rs['TOKEN']);

                            return redirect(Config::get('constants.options.PAYPAL_API_REDIRECT').$rs['TOKEN']);

                        }    

                    break;

               

                case 2:

                    Session::put('TokenAmount', $formatPay[2]);

                    Session::put('TokenBuyerId', Auth::id());

                    Session::put('TokenCount', 12);

                    Log::info('User Id:' . Auth::id() .' Buy Token Amount:'.$formatPay[2]);

                    $rs = ReportsController::executeSetExpressCheckout($formatPay[2]);



                        if($rs['ACK'] == 'Success') {

                          Session::put('PaypalToken', $rs['TOKEN']);

                          return redirect(Config::get('constants.options.PAYPAL_API_REDIRECT').$rs['TOKEN']);  

                        } 

                    break;

                

                case 3:

                    Session::put('TokenAmount', $formatPay[3]);

                    Session::put('TokenBuyerId', Auth::id());

                    Session::put('TokenCount', 20);

                    Log::info('User Id:' . Auth::id() .' Buy Token Amount:'.$formatPay[3]);

                    $rs =ReportsController::executeSetExpressCheckout($formatPay[3]);

                        if($rs['ACK'] == 'Success') {

                          Session::put('PaypalToken', $rs['TOKEN']);

                          return redirect(Config::get('constants.options.PAYPAL_API_REDIRECT').$rs['TOKEN']);  
                        } 

                    break;



                default:

                    return redirect('/reports/buyTokens')->with('message', 'Invalid Top Up value.');

                    break;    

            }    



        }

    }





    public static function executeSetExpressCheckout($amount)

    {



        $request_params = array



                    (



                    'USER' => Config::get('constants.options.PAYPAL_API_USERNAME'), 



                    'PWD' => Config::get('constants.options.PAYPAL_API_PASSWORD'), 



                    'SIGNATURE' => Config::get('constants.options.PAYPAL_API_SIGNATURE'), 



                    'METHOD' => 'SetExpressCheckout', 



                    'VERSION' => 93, 



                    'PAYMENTREQUEST_0_PAYMENTACTION' => 'SALE', 



                    'PAYMENTREQUEST_0_AMT' => $amount, 



                    'PAYMENTREQUEST_0_CURRENCYCODE' => 'USD', 



                    'RETURNURL' => Config::get('constants.options.PAYPAL_SUCCESS_URL'), 



                    'CANCELURL' => Config::get('constants.options.PAYPAL_CANCEL_URL'), 



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



   

    

}

