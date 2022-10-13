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
use App\Buytoken;
use Illuminate\Support\Facades\DB;
use App\Rewards;
use Session;


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

    public function getCreditPoints()
    {
        $user_id = Auth::id(); 
        $company_id_result = CompanyProfile::getCompanyId($user_id);
        $profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);
        $brand_slogan = CompanyProfile::getBrandSlogan($user_id, $company_id_result);
        $c_promo = PromotionToken::where('company_id', $company_id_result)->where('remarks', 'UPGRADE-TO-PREMIUM')->count();
        
        $rw = new Rewards($user_id);
        $totalCreditPurchased = $rw->setTotalCredits();
        $totalNumberOfReferrals = $rw->getTotalReferrals();
        $totalNumberOfReferralsReportsPoints = $rw->getTotalReportsCombinedReferrals(); //earned from referrals report
        $totalNumberOfReferralsPurchasedPoints = $rw->getTotalPointsByReferralsPurchased();
        $totalScore = $rw->getTotalPointsScore();
        $nextScoreLevel = $rw->getAdvisorNextLevel();
        $advisorTipsLvl1 = $rw->getAdvisorTips(50);
        $advisorTipsLvl2 = $rw->getAdvisorTips(200);
        $advisorTipsLvl3 = $rw->getAdvisorTips(500);
        $amountToRedemp = $rw->getAdvisorAmountToRedeem();
        $currentAdvisorLevel = $rw->getAdvisorLevel();
        $rw->removeDuplicatesIds();

        //echo $rw->user_credit_ids_str .'<br />';
        //echo $rw->user_referral_ids_str.'<br />';
        //echo $rw->referral_pur_ids_str.'<br />';
        //echo $rw->referral_rep_ids_str.'<br />';

        Session::put('amount_redeem', $amountToRedemp);
        Session::put('current_advisor_level', $currentAdvisorLevel);
        Session::put('total_score_points', $totalScore);

        Session::put('user_credit_ids', $rw->user_credit_ids_str);
        Session::put('user_referral_ids', $rw->user_referral_ids_str);
        Session::put('referral_pur_ids', $rw->referral_pur_ids_str);
        Session::put('referral_rep_ids', $rw->referral_rep_ids_str);

        
        return view('token.points', compact('profileAvatar', 'brand_slogan', 'c_promo', 
        'totalNumberOfReferralsPurchasedPoints', 'totalCreditPurchased', 'totalNumberOfReferrals', 
        'totalNumberOfReferralsReportsPoints', 'totalScore', 'company_id_result',
        'nextScoreLevel', 'advisorTipsLvl1', 'advisorTipsLvl2', 'advisorTipsLvl3', 'amountToRedemp' ,'currentAdvisorLevel'));

    }


}