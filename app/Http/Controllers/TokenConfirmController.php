<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\Http\Controllers\Controller;
use App\Mailbox;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use App\Unsubscribe;
use App\UploadImages;
use App\User;
use Config;
use Illuminate\Http\Request;
use App\FA_Results;
use Auth;
use App\PromotionToken;


class TokenConfirmController extends Controller {

   /**

	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct() {

		$this->middleware('auth');

    }
    
    public function index()
    {

        $user_id = Auth::id(); 
        $company_id_result = CompanyProfile::getCompanyId($user_id);
    
        $profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);
        //$contact_id= CompanyContacts::getContactId($user_id, $company_id_result);
        $brand_slogan = CompanyProfile::getBrandSlogan($user_id, $company_id_result);
       
        $company_data = '';
        
        //if($contact_id != 0){
        //   $company_data = CompanyContacts::find($contact_id);
        //}
        
        $c_promo = PromotionToken::where('company_id', $company_id_result)->where('remarks', 'UPGRADE-TO-PREMIUM')->count();
        
        return view('token.index', compact('profileAvatar', 'company_data', 'brand_slogan', 'c_promo'));

    }


}