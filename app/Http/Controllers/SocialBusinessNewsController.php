<?php

namespace App\Http\Controllers;

use App\BrandSlogan;
use App\BusinessOpportunitiesNews;
use App\CompanyProfile;
use App\Http\Controllers\Controller;
use App\RegistrationLinks;
use App\UploadImages;
use App\WhoViewedMe;
use Auth;
use Config;
use Illuminate\Http\Request;
use App\PremiumOpportunityPurchased;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;

class SocialBusinessNewsController extends Controller 
{

    public function index() {

        
		$user_id = Auth::id();
		$company_id = CompanyProfile::getCompanyId($user_id); //viewer

		$brand = base64_decode($request['brand']);
		$opp_id = $request['oppId'];
		$token_id = $request['token'];

		$build = false;
		$buy = false;
		$sell = false;

		$rs_build = null;
		$rs_sell = null;
		$rs_buy = null;

		$rs_build_view = 0;
		$rs_sell_view = 0;
		$rs_buy_view = 0;

		$company_page_owner_id = null;

		$rs = BrandSlogan::where('company_id', $request['id'])->first(); //page owner

		if ($brand != 'viewer' . $request['id']) { //check if URL is correct
			echo "URL invalid.";
			sleep(10);
			return redirect('login');
			exit;

		} else {
			$company_page_owner_id = $request['id'];
		}

		$rs_build = OpportunityBuildingCapability::where('id', $opp_id)->where('company_id', $company_page_owner_id)->first();
		if($rs_build != null){
			$rs_build_view = $rs_build->view_type;	
		}
		$rs_sell = OpportunitySellOffer::where('id', $opp_id)->where('company_id', $company_page_owner_id)->first();
		if($rs_sell != null){
			$rs_sell_view = $rs_sell->view_type;
		}
		$rs_buy = OpportunityBuy::where('id', $opp_id)->where('company_id', $company_page_owner_id)->first();
		if($rs_buy != null){
			$rs_buy_view = $rs_buy->view_type;
		}

		if(	$rs_build_view == 1 || $rs_sell_view == 1 || $rs_buy_view == 1 ){
			//all found 1 in private, then need to check the premium purchased  
		
				if(PremiumOpportunityPurchased::checkIfPremium($company_id, $opp_id, 'build') == true)
				{
					$build = true;
				}

				if(PremiumOpportunityPurchased::checkIfPremium($company_id, $opp_id, 'sell') == true)
				{
					$sell = true;
				}

				if(PremiumOpportunityPurchased::checkIfPremium($company_id, $opp_id, 'buy') == false)
				{
					$buy = true;
				}


				if($build == true || $sell == true && $buy == true)
				{
				} else {

					echo "Access invalid, only for those who purchased in premium data.";
					sleep(10);
					return redirect('login');
					exit;

				}
		}


		if ($rs->count() > 0 && isset($rs->user_id) && isset($rs->company_id)) {

			$profileAvatar = UploadImages::getFileNames($rs->user_id, $rs->company_id, Config::get('constants.options.profile'), 1);

			$profileCoverPhoto = UploadImages::getFileNames($rs->user_id, $rs->company_id, Config::get('constants.options.banner'), 1);

			$brand_slogan = CompanyProfile::getBrandSlogan($rs->user_id, $rs->company_id);

			// Session::put('brandName', $brand_slogan[0]);

			$businessNewsOpportunity = BusinessOpportunitiesNews::where('company_id', $request['id'])->first();

			$companyProfile = CompanyProfile::find($rs->company_id);

			if ($request['id'] != $company_id && $company_id != null) {

				WhoViewedMe::create([

					'presenter_company_id' => $request['id'],

					'viewer_company_id' => $company_id,

					'is_request' => 'no',

					'created_at' => date('Y-m-d'),

					'status' => 1,

				]);

			}

			return view("businessnews.newscast", compact('profileAvatar', 'profileCoverPhoto', 'brand_slogan', 'businessNewsOpportunity', 'companyProfile'));

		} else {

			echo 'As of moment the company has not setup a public page.';

			return redirect('opportunity/explore')->with('message', 'As of moment the company has not setup a public page.');

		}

		return view('businessnews.newscast');

	}

}