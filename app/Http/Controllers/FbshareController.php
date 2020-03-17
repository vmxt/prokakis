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

class FbshareController extends Controller {



    public function shareOnFB(Request $request){

        
        $brand = base64_decode($request['brand']);
        $id = base64_decode($request['id']);
        
		$rs = BrandSlogan::where('company_id', $request['id'])->first(); //page owner

		//$urlFB = Request::fullUrl();	
        
        if ($rs->count() > 0 && isset($rs->user_id) && isset($rs->company_id)) {

			$profileAvatar = UploadImages::getFileNames($rs->user_id, $rs->company_id, Config::get('constants.options.profile'), 1);

			$profileCoverPhoto = UploadImages::getFileNames($rs->user_id, $rs->company_id, Config::get('constants.options.banner'), 1);

			$brand_slogan = CompanyProfile::getBrandSlogan($rs->user_id, $rs->company_id);

			// Session::put('brandName', $brand_slogan[0]);

			$businessNewsOpportunity = BusinessOpportunitiesNews::where('company_id', $request['id'])->first();

			$companyProfile = CompanyProfile::find($rs->company_id);


			return view("fbshare.index", compact('profileAvatar', 'profileCoverPhoto', 
			'brand_slogan', 'businessNewsOpportunity', 'companyProfile', 
			'description', 'companyTitle'));

		}  else {

			echo 'As of moment the company has not setup a public page.';

			return redirect('opportunity/explore')->with('message', 'As of moment the company has not setup a public page.');

		}

    }

}