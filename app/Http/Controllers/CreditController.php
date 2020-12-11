<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\SpentTokens;
use App\CompanyProfile;
use Illuminate\Http\Request;
use Auth;
use App\ChatHistory;

class CreditController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		//$this->middleware('auth');

    }
    

    public function getChatCredit(Request $request)
    {
        if ($request->isMethod('post')) { 

           $comProvider = $request->input('companyProvider');
           $comRequester = $request->input('companyRequester');
           $oppId = $request->input('oppId');
           $oppType = $request->input('oppType');
           
            $userId = Auth::id();
            $companyId = CompanyProfile::getCompanyId($userId);

            if($comRequester != $companyId){
              return 0;
            } else {

               $remarks = 'Inbox Me at Opportunity Page with OppId:'.$oppId.' and OppType:'.$oppType.' and Requester:'.$comRequester.' and Provider:'.$comProvider;
               $c = SpentTokens::where('remarks', $remarks)->count();

               if($c > 0){
                 return 1;
               } else {
               
                //$remarks, $companyId, $userId, $numTokens
                SpentTokens::spendTokenGeneral($remarks, $companyId, $userId, 3); //3 credit
                return 1;
               }


            }
        }    
        
    }


}