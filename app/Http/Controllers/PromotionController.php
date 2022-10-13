<?php



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use App\CompanyProfile;

use App\PromotionToken;

use App\Buytoken;



use App\Countries;

use App\GeneratedReport;

use App\ProcessedReport;

use App\RequestApproval;

use App\RequestReport;

use App\UploadImages;

use App\User;

use Auth;

use Config;

use Illuminate\Http\Request;

use Session;

use App\SpentTokens;


class PromotionController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		$this->middleware('auth');

    }

    public function addToken(){

        $user_id = Auth::id();
        $company_id = CompanyProfile::getCompanyId($user_id);

        if(SpentTokens::validateTokenStocks($company_id) == false){ 
            return redirect('/reports/buyTokens')->with('message', 'You are not elligble for this upgrade. 
            Please buy credits and activate your account to premium.');
            
            exit;
        }

        if(SpentTokens::validateAccountActivation($company_id) == true){
            return redirect('/home')->with('message', 'You are already a premium account. ');
            exit;

        } else {

            $ok =   PromotionToken::create([
                'company_id'   => $company_id, 
                'token_amount' => 1, 
                'remarks'      => 'UPGRADE-TO-PREMIUM', 
                'created_at'   =>date('Y-m-d'), 
                 'status'      => 1,
            ]);


           if($ok){   

            SpentTokens::spendTokenGeneral("UPGRADE-TO-PREMIUM", $company_id, $user_id, 120); 

            return redirect('/home')->with('status', 'You have succesfully upgrade to premium account. ');
            exit;

           }

        }    
        

    }







}

