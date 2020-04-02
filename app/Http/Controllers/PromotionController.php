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

        if( SpentTokens::validateLeftBehindToken($company_id) != false ){ 

            return redirect('/home')->with('message', 'You are not elligble for this promotion. ');
            exit;

        }

        
        /*
        $promo = CompanyProfile::checkOppotunityCreation($company_id);
        if($promo == false){
            return redirect('/home')->with('message', 'You are not elligble for this promotion. ');
            exit;
        }*/



        $c_promo = PromotionToken::where('company_id', $company_id)->where('remarks', 'ONE-TOKEN')->count();
        if($c_promo > 0){
            return redirect('/home')->with('message', 'You alredy taken up this promotion. ');
            exit;
        }



        if($c_promo == 0)

        {



         $ok =   PromotionToken::create([

                'company_id'   => $company_id, 

                'token_amount' => 1, 

                'remarks'      => 'ONE-TOKEN', 

                'created_at'   =>date('Y-m-d'), 

                 'status'      => 1,

            ]);

         

           if($ok){   

                Buytoken::create([

                    'company_id'   => $company_id,  

                    'num_tokens'   => 1, 

                    'created_at'   => date('Y-m-d'), 

                    'status'       => 1, 

                    'paypal_id'    => 'FREE', 

                    'paypal_token' => 'ONE-TOKEN',

                ]);

            }



            return redirect('/home')->with('status', 'You have succesfully avail the upgrade to premium promotion. ');

            exit;

        }

        

    }







}

