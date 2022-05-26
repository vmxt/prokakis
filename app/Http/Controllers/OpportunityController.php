<?php

namespace App\Http\Controllers;

use App\AuditLog;
use App\CompanyProfile;
use App\Configurations;
use App\ConsultantMapping;
use App\Countries;
use App\Http\Controllers\Controller;
use App\Mailbox;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use App\RequestReport;
use App\SpentTokens;
use App\OppIndustry;
use App\User;
use App\ChatHistory;
use Auth;
use App\PremiumOpportunityPurchased;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\UrlGenerator;

class OpportunityController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		$user_id = Auth::id();
		$company_id = CompanyProfile::getCompanyId($user_id);

		$build = OpportunityBuildingCapability::where('company_id', $company_id)->where('status', 1)->get();
		$sell = OpportunitySellOffer::where('company_id', $company_id)->where('status', 1)->get();
		$buy = OpportunityBuy::where('company_id', $company_id)->where('status', 1)->get();
		$industry = Configurations::getJsonValue('industry_type');
		$businessType = Configurations::getJsonValue('business_opportunity_type');
		return view("oppor.index", compact('build', 'sell', 'buy', 'industry', 'businessType', 'company_id'));

	}


    public function approvedOpportunity(Request $request) {

		if (isset($request['id'])) {

			$exploded = explode(":",$request['id']);

			$itemId = $exploded[0];
			$type_opp = $exploded[1];

			$user_id = Auth::id();

			$company_id = CompanyProfile::getCompanyId($user_id);

            if($type_opp == "build"){
                $rs = OpportunityBuildingCapability::find($itemId);
            }
            else if($type_opp == "sell"){
                $rs = OpportunitySellOffer::find($itemId);
            }
            else if($type_opp == "buy"){
                $rs = OpportunityBuy::find($itemId);
            }
			
			if (count((array)$rs) > 0) {

    			$rs->is_verify = 1;
    
    			$rs->save();
    
    			return redirect("/opportunity/approval/pending")->with('status', 'Opportunity has been successfully approved.');

			}

		}

	}

	public function details() {
		// if (User::securePage(Auth::id()) != 5) {
		// 	return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		// }
		$build = OpportunityBuildingCapability::getListBuildOpportunity();
		$sell = OpportunitySellOffer::getListSellOpportunity()->merge($build);
		$buy = OpportunityBuy::getListBuyOpportunity()->merge($sell);
		$result = $buy;
		return view('oppor.details', compact('result'));
	}

	public function requestReport(Request $request) {

		$company_id = CompanyProfile::getCompanyId(Auth::id());

		$company_rs = CompanyProfile::find($company_id);

		$oppType = $request['oppType'];

		if (!in_array($oppType, array('buy', 'build', 'sell', 'company'))) {

			return redirect('opportunity/explore')->with('message', 'Opportunity type is invalid.');

			exit;

		}

		if (in_array($oppType, array('buy', 'build', 'sell'))) {

			$oppId = $request['oppId'];

			$requestReport = new RequestReport;

			return view('oppor.request', compact('requestReport', 'oppType', 'oppId', 'company_id', 'company_rs'));

		} elseif ($oppType == 'company') {

			$oppId = $request['oppId'];

			$requestReport = new RequestReport;

			return view('oppor.companyrequest', compact('requestReport', 'oppType', 'oppId', 'company_id', 'company_rs'));

		}

	}

	public function storeRequestReport(Request $request) {

		$requestReport = new RequestReport;

		$validator = Validator::make($request->all(), $requestReport->rules);

		if ($validator->fails()) {

			$company_id = CompanyProfile::getCompanyId(Auth::id());

			$company_rs = CompanyProfile::find($company_id);

			$oppType = $request->opportunity_type;

			$oppId = $request->fk_opportunity_id;

			return view('oppor.request', compact('requestReport', 'oppType', 'oppId', 'company_id', 'company_rs'))->withErrors($validator);

		} else {

			//get company id as the requestor

			$requestor_companyId = $request->input('company_id');

			$requestor_profile = CompanyProfile::find($requestor_companyId);

			//validate if token is still availabale
			
			$left_behind_credit = SpentTokens::check_remaining_credit($requestor_companyId);

			if ($left_behind_credit == "out_credit") {

				return redirect('opportunity/explore')->with('message', 'Insufficient credit value, please re-fill. ');

				exit;

			}
			else if ($left_behind_credit == "not_premium") {

				return redirect('opportunity/explore')->with('message', 'This requires premium account to request a report. ');

				exit;

			}
			else if ($left_behind_credit == false) {

				return redirect('opportunity/explore')->with('message', 'Valication Error.');

				exit;

			}
			else {

				$getTotalTokensLeft = $left_behind_credit;
				if ($getTotalTokensLeft < 120) {
					return redirect('opportunity/explore')->with('message', 'Insufficient token value this process requires 120 credits, please re-fill.');
					exit;
				}

			}

			//$consumedTokens = SpentTokens::validateLeftBehindToken($requestor_companyId);

			$isok = $requestReport::create($request->all());

			if ($isok) {
				//succesful request created

				//get company id, of the request provider

				$companyID = RequestReport::getRequestProviderCompanyID($request->input('opportunity_type'), $request->input('fk_opportunity_id'));

				$chk = RequestReport::where('company_id', $requestor_companyId)->where('source_company_id', $companyID)->where('is_approve', NULL)->first();

				if (count((array) $chk) > 0) {

					$req = RequestReport::find($isok->id);

					if (count((array) $req) > 0) {

						$req->delete();

					}

					return redirect('opportunity/explore')->with('message', 'You already have a pending request with this company.');

					exit;

				} else {

					$req = RequestReport::find($isok->id);

					$req->source_company_id = $companyID;

					$req->save();

					AuditLog::ok(array(Auth::id(), 'opportunity', 'request report', 'requested from company id:' . $companyID));

				}

				//identify what country of the company and get the consultants

				$rs = CompanyProfile::find($companyID);

				$def_COUNTRY = (isset($rs->primary_country)) ? $rs->primary_country : null;

				if ($def_COUNTRY == null) {

					$req = RequestReport::find($isok->id);

					if (count((array) $req) > 0) {

						$req->delete();

					}

					return redirect('opportunity/explore')->with('message', 'Company as a request provider does not have a primary country.');

					exit;

				} else {

					$cons = ConsultantMapping::where('country_id', $def_COUNTRY)->first();

					if (count((array) $cons) > 0) {

						SpentTokens::spendTokenByrequest($isok->id, $requestor_companyId, $requestor_profile->user_id, 120); //deduct 120 token

						$usr = User::find($cons->consultant_main);

						$CompanyUserProfile = User::find($rs->user_id); //company profile

						///{reqID}/{companyID}/{sourceID}

						//http://localhost/prokakis//reports/approve/MQ==/Mg==/NQ==

						$req_ID = base64_encode($isok->id);

						$company_ID = base64_encode(CompanyProfile::getCompanyId(Auth::id()));

						$source_ID = base64_encode($companyID);

						$url_to_approve = url('/reports/approve/' . $req_ID . '/' . $company_ID . '/' . $source_ID);

						$message = "

                  Dear Consultant,

                  <br />

                  <br />

                  We would like to inform you that there is a report request, that requires your approval.

                  <br />

                  To approve please open the link: <a href='".$url_to_approve."'>$url_to_approve</a>

                  <br />

                  <br />

                  Best Regards, <br />

                  Intellinz Web Admin

                  ";

						//send the email here

						Mailbox::sendMail($message, $usr->email, "Report Request need your validation and approval.", "");

						$message2 = "

                  Dear $rs->company_name,

                  <br />

                  <br />

                  We would like to inform you that there is a report request submitted, and it requires your updated company details.

                  <br />

                  To update details, please login to intellinz: http://intellinz.com/

                  <br />

                  <br />

                  Best Regards, <br />

                  Intellinz Web Admin

                  ";

						//send the email here

						Mailbox::sendMail($message2, $CompanyUserProfile->email, "Report Request need your company details.", "");

						return redirect('opportunity/explore')->with('status', 'Request report has been succesfully saved.');

					} else {

						$req = RequestReport::find($isok->id);

						if (count((array) $req) > 0) {

							$req->delete();

						}

						return redirect('opportunity/explore')->with('message', 'There is no result of consultant mapping at provider\'s country.');

						exit;

					}

				}

			}

		}

	}

	public function storeSearchCompany(Request $request) {

		$requestReport = new RequestReport;

		$validator = Validator::make($request->all(), $requestReport->rules);

		if ($validator->fails()) {

			$company_id = $request->input('company_id');

			$oppType = $request->input('opportunity_type');

			$oppId = $request->input('fk_opportunity_id');

			return view('oppor.request', compact('requestReport', 'oppType', 'oppId', 'company_id'))->withErrors($validator);

		} else {

			//get company id as the requestor

			$requestor_companyId = $request->input('company_id');

			$requestor_profile = CompanyProfile::find($requestor_companyId);

			$source_company_id = $request->input('fk_opportunity_id');

			//validate if token is still availabale

			if (SpentTokens::validateLeftBehindToken($requestor_companyId) == false) {

				return redirect('/search-company')->with('message', 'Insufficient token value, please re-fill. 1');

				exit;

			} else {

				$getTotalTokensLeft = SpentTokens::validateLeftBehindToken($requestor_companyId);
				if ($getTotalTokensLeft < 10) {
					return redirect('/search-company')->with('message', 'Insufficient token value this process requires 10 token, please re-fill.');
					exit;
				}

			}

			$isok = $requestReport::create($request->all()); //create request here

			if ($isok) {
				//succesful request created

				//get company id, of the request provider

				//$companyID = RequestReport::getRequestProviderCompanyID($request->input('opportunity_type'), $request->input('fk_opportunity_id'));

				$chk = RequestReport::where('company_id', $requestor_companyId)->where('source_company_id', $source_company_id)->where('is_approve', NULL)->first();

				if (count((array) $chk) > 0) {

					$req = RequestReport::find($isok->id);

					if (count((array) $req) > 0) {

						$req->delete();

					}

					return redirect('/search-company')->with('message', 'You already have a pending request with this company.');

					exit;

				} else {

					$req = RequestReport::find($isok->id);

					$req->source_company_id = $source_company_id;

					$req->save();

					AuditLog::ok(array(Auth::id(), 'opportunity', 'request report', 'requested from company id:' . $source_company_id));

				}

				//identify what country of the company and get the consultants

				$rs = CompanyProfile::find($source_company_id);

				$def_COUNTRY = (isset($rs->primary_country)) ? $rs->primary_country : null;

				if ($def_COUNTRY == null) {

					$req = RequestReport::find($isok->id);

					if (count((array) $req) > 0) {

						$req->delete();

					}

					return redirect('/search-company')->with('message', 'Company as a request provider does not have a primary country.');

					exit;

				} else {

					$cons = ConsultantMapping::where('country_id', $def_COUNTRY)->first();

					if (count((array) $cons) > 0) {

						SpentTokens::spendTokenByrequest($isok->id, $requestor_companyId, $requestor_profile->user_id, 10); //deduct 10 token

						$usr = User::find($cons->consultant_main);

						$CompanyUserProfile = User::find($rs->user_id); //company profile

						///{reqID}/{companyID}/{sourceID}

						//http://localhost/prokakis//reports/approve/MQ==/Mg==/NQ==

						$req_ID = base64_encode($isok->id);

						$company_ID = base64_encode(CompanyProfile::getCompanyId(Auth::id()));

						$source_ID = base64_encode($source_company_id);

						$url_to_approve = url('/reports/approve/' . $req_ID . '/' . $company_ID . '/' . $source_ID);

						$message = "

                  Dear Consultant,

                  <br />

                  <br />

                  We would like to inform you that there is a report request, that requires your approval.

                  <br />

                  To approve please open the link: $url_to_approve

                  <br />

                  <br />

                  Best Regards, <br />

                  Intellinz Web Admin

                  ";

						//send the email here

						Mailbox::sendMail($message, $usr->email, "Report Request need your validation and approval.", "");

						$message2 = "

                  Dear $rs->company_name,

                  <br />

                  <br />

                  We would like to inform you that there is a report request submitted, and it requires your updated company details.

                  <br />

                  To update details, please login to intellinz: http://intellinz.com/

                  <br />

                  <br />

                  Best Regards, <br />

                  Intellinz Web Admin

                  ";

						//send the email here

						Mailbox::sendMail($message2, $CompanyUserProfile->email, "Report Request need your company details.", "");

						return redirect('opportunity/explore')->with('status', 'Request report has been succesfully saved.');

					} else {

						$req = RequestReport::find($isok->id);

						if (count((array) $req) > 0) {

							$req->delete();

						}

						return redirect('/search-company')->with('message', 'There is no result of consultant mapping at provider\'s country.');

						exit;

					}

				}

			}

		}

	}

	public function exploreMy(Request $request) {

		if (strlen($request['industry']) > 0 && strlen($request['business']) > 0) {

			$user_id = Auth::id();

			$company_id = CompanyProfile::getCompanyId($user_id);

			$selectedIndustry = $request['industry'];

			$selectedBusiness = $request['business'];

			//echo $selectedIndustry . '  '. $selectedBusiness; exit;

			$build = OpportunityBuildingCapability::where('company_id', '=', $company_id)

				->where('ideal_partner_base', 'like', '%' . $selectedIndustry . '%')

				->where('audience_target', '=', $selectedBusiness)

				->get();

			$sell = OpportunitySellOffer::where('company_id', '=', $company_id)

				->where('ideal_partner_base', 'like', '%' . $selectedIndustry . '%')

				->where('audience_target', '=', $selectedBusiness)

				->get();

			$buy = OpportunityBuy::where('company_id', '=', $company_id)

				->where('ideal_partner_base', 'like', '%' . $selectedIndustry . '%')

				->where('audience_target', 'like', '%' . $selectedBusiness . '%')

				->get();

			$industry = Configurations::getJsonValue('industry_type');

			$businessType = Configurations::getJsonValue('business_opportunity_type');

			return view("oppor.index", compact('build', 'sell', 'buy', 'industry', 'businessType'));

		}

	}

	public function chatbox(Request $request) {

		$user_id = Auth::id();
		$company_id = CompanyProfile::getCompanyId($user_id);

		$resBuild = ChatHistory::getChatHistoryBuildOpportunity($company_id);
		$resSell = ChatHistory::getChatHistorySellOpportunity($company_id)->merge($resBuild);
		$resBuy = ChatHistory::getChatHistoryBuyOpportunity($company_id)->merge($resSell);
		$chatHeads = $resBuy;
		return view("oppor.chatbox", compact('company_id', 'chatHeads') );
	}

	public function exploreCountry(Request $request) {
		if (urldecode(strlen($request['key'])) > 0) {

			$user_id = Auth::id();

			$company_id = CompanyProfile::getCompanyId($user_id);

			$selectedCountry = urldecode($request['key']);

			$result_filter = false;

			$build = OpportunityBuildingCapability::where('company_id', '!=', $company_id)

				->where('ideal_partner_base', 'like', '%' . $selectedCountry . '%')

				->get();

			$sell = OpportunitySellOffer::where('company_id', '!=', $company_id)

				->where('ideal_partner_base', 'like', '%' . $selectedCountry . '%')

				->get();

			$buy = OpportunityBuy::where('company_id', '!=', $company_id)

				->where('ideal_partner_base', 'like', '%' . $selectedCountry . '%')

				->get();

			return view("oppor.explore", compact('build', 'sell', 'buy', 'selectedCountry', 'result_filter'));

		}

	}
	
	public function exploreAll(Request $request){
	    if (strlen($request['key']) > 0) {

			$user_id = Auth::id();

			$company_id = CompanyProfile::getCompanyId($user_id);
			$country_list = Countries::all(); 

			$selectedKeyword = base64_decode($request['key']);

			$result_filter = false;
			
			$filter_target_audience = explode("<filter>", $selectedKeyword)[0];
			$filter_target_audience_val = "";
			if($filter_target_audience != "0"){
			    $filter_target_audience_val=$filter_target_audience;
			}
			
            $filter_category = explode("<filter>", $selectedKeyword)[1];
            $filter_category_val = "";
			if($filter_category != "0"){
			    $filter_category_val = $filter_category;
			}
			
            $filter_country = explode("<filter>", $selectedKeyword)[2];;
            $keyword = explode("<filter>", $selectedKeyword)[3];;
            
            $filter_ideal_partners = explode("<filter>", $selectedKeyword)[4];;
            
            $if_from_home = "";
            if(isset(explode("<filter>", $selectedKeyword)[5])){
                $if_from_home = "yes";
            }
            
            $country_explode = "";
            if($filter_country != "null"){
                $country_explode = explode(",",$filter_country);
            }
            
            $ideal_partners_explode = "";
            if($filter_ideal_partners != "null"){
                $ideal_partners_explode = explode(",",$filter_ideal_partners);
            }
            
            //build
            
            $build = "";
            if($filter_category_val == "" || $filter_category_val == "BUILD"){
                $build = OpportunityBuildingCapability::where('company_id', '!=', "0")
    			->where('audience_target', 'like', '%' . $filter_target_audience_val . '%')
    			->where('status', 1)->where('is_verify', 1)
    			
    			->where(function ($query) use ( $keyword) {
    			    $query->where('opp_title', 'like', '%' . $keyword . '%');
    			    $query->orWhere('relevant_describing_partner', 'like', '%' . $keyword . '%');
    			})
    			
    			->where(function ($query) use ( $filter_country,$country_explode) {
        			if($filter_country != "null"){	
            			for($x= 0; $x <= count($country_explode) - 1; $x++){
            			    if($x == 0){
            			        $query->where('ideal_partner_base', 'like', '%' . $country_explode[$x] . '%');
            			    }
            			    else{
            			        $query->orWhere('ideal_partner_base', 'like', '%' . $country_explode[$x] . '%');
            			    }
            			}
        			}
    			})
    			->where(function ($query) use ( $filter_ideal_partners, $ideal_partners_explode) {
        			if($filter_ideal_partners  != "null"){	
            			for($x= 0; $x <= count($ideal_partners_explode) - 1; $x++){
            			    if($x == 0){
            			        $query->where('ideal_partner_business', 'like', '%' . $ideal_partners_explode[$x] . '%');
            			    }
            			    else{
            			        $query->orWhere('ideal_partner_business', 'like', '%' . $ideal_partners_explode[$x] . '%');
            			    }
            			}
        			}
    			});
    			
    			$build = $build->orderBy('id','DESC')->get();
            }
            
            //sell
            $sell = "";
            
            if($filter_category_val == "" || $filter_category_val == "SELL"){
    			$sell = OpportunitySellOffer::where('company_id', '!=', "0")
    			->where('audience_target', 'like', '%' . $filter_target_audience_val . '%')
    			->where('status', 1)->where('is_verify', 1)
    			
    			->where(function ($query) use ( $keyword) {
    			    $query->where('opp_title', 'like', '%' . $keyword . '%');
    			    $query->orWhere('relevant_describing_partner', 'like', '%' . $keyword . '%');
    			})
    			
    			->where(function ($query) use ( $filter_country,$country_explode) {
        			if($filter_country != "null"){	
            			for($x= 0; $x <= count($country_explode) - 1; $x++){
            			    if($x == 0){
            			        $query->where('ideal_partner_base', 'like', '%' . $country_explode[$x] . '%');
            			    }
            			    else{
            			        $query->orWhere('ideal_partner_base', 'like', '%' . $country_explode[$x] . '%');
            			    }
            			}
        			}
    			})
    			->where(function ($query) use ( $filter_ideal_partners, $ideal_partners_explode) {
        			if($filter_ideal_partners  != "null"){	
            			for($x= 0; $x <= count($ideal_partners_explode) - 1; $x++){
            			    if($x == 0){
            			        $query->where('ideal_partner_business', 'like', '%' . $ideal_partners_explode[$x] . '%');
            			    }
            			    else{
            			        $query->orWhere('ideal_partner_business', 'like', '%' . $ideal_partners_explode[$x] . '%');
            			    }
            			}
        			}
    			});
    			
    			$sell = $sell->orderBy('id','DESC')->get();
            }
            
			//buy	
			$buy = "";
			
			if($filter_category_val == "" || $filter_category_val == "BUY"){
    			$buy = OpportunityBuy::where('company_id', '!=', "0")
    			->where('audience_target', 'like', '%' . $filter_target_audience_val . '%')
    			->where('status', 1)->where('is_verify', 1)
    			
    			->where(function ($query) use ( $keyword) {
    			    $query->where('opp_title', 'like', '%' . $keyword . '%');
    			    $query->orWhere('relevant_describing_partner', 'like', '%' . $keyword . '%');
    			})
    			
    			->where(function ($query) use ( $filter_country,$country_explode) {
        			if($filter_country != "null"){	
            			for($x= 0; $x <= count($country_explode) - 1; $x++){
            			    if($x == 0){
            			        $query->where('ideal_partner_base', 'like', '%' . $country_explode[$x] . '%');
            			    }
            			    else{
            			        $query->orWhere('ideal_partner_base', 'like', '%' . $country_explode[$x] . '%');
            			    }
            			}
        			}
    			})
    			->where(function ($query) use ( $filter_ideal_partners, $ideal_partners_explode) {
        			if($filter_ideal_partners  != "null"){	
            			for($x= 0; $x <= count($ideal_partners_explode) - 1; $x++){
            			    if($x == 0){
            			        $query->where('ideal_partner_business', 'like', '%' . $ideal_partners_explode[$x] . '%');
            			    }
            			    else{
            			        $query->orWhere('ideal_partner_business', 'like', '%' . $ideal_partners_explode[$x] . '%');
            			    }
            			}
        			}
    			});
    			
                $buy = $buy->orderBy('id','DESC')->get();
			}
			
			return view("oppor.explore", compact('country_list','build', 'sell', 'buy', 'selectedKeyword', 'result_filter', 'filter_target_audience', 'filter_category','filter_ideal_partners', 'filter_country', 'keyword', 'if_from_home'));
        }
	}

	public function exploreKey(Request $request) {

		if (strlen($request['key']) > 0) {

			$user_id = Auth::id();

			$company_id = CompanyProfile::getCompanyId($user_id);
			$country_list = Countries::all(); 

			$selectedKeyword = $request['key'];

			$result_filter = false;

			$build = OpportunityBuildingCapability::where('company_id', '!=', $company_id)

				->where('ideal_partner_business', 'like', '%' . $selectedKeyword . '%')
				
				->orWhere('opp_title', 'like', '%' . $selectedKeyword . '%')
				->orWhere('relevant_describing_partner', 'like', '%' . $selectedKeyword . '%')
				->orWhere('oppo_description', 'like', '%' . $selectedKeyword . '%')

				->where('status', 1)

				->get();

			$sell = OpportunitySellOffer::where('company_id', '!=', $company_id)

				->where('ideal_partner_business', 'like', '%' . $selectedKeyword . '%')
				
				->orWhere('opp_title', 'like', '%' . $selectedKeyword . '%')
				->orWhere('relevant_describing_partner', 'like', '%' . $selectedKeyword . '%')
				->orWhere('oppo_description', 'like', '%' . $selectedKeyword . '%')

				->where('status', 1)

				->get();

			$buy = OpportunityBuy::where('company_id', '!=', $company_id)

				->where('ideal_partner_business', 'like', '%' . $selectedKeyword . '%')
				
				->orWhere('opp_title', 'like', '%' . $selectedKeyword . '%')
				->orWhere('relevant_describing_partner', 'like', '%' . $selectedKeyword . '%')
				->orWhere('oppo_description', 'like', '%' . $selectedKeyword . '%')

				->where('status', 1)

				->get();

			return view("oppor.explore", compact('country_list','build', 'sell', 'buy', 'selectedKeyword', 'result_filter'));

		}

	}

	public function explore(Request $request) {

		$user_id = Auth::id();
		$company_id = CompanyProfile::getCompanyId($user_id);
		
		$country_list = Countries::all();

    // 		$build = OpportunityBuildingCapability::where('company_id', '!=', $company_id)
				// ->where('status', 1)
		  //  	->get();

				// $sell = OpportunitySellOffer::where('company_id', '!=', $company_id)
				// ->where('status', 1)
				// ->get();

				// $buy = OpportunityBuy::where('company_id', '!=', $company_id)
				// ->where('status', 1)
				// ->get();

   		$build = OpportunityBuildingCapability::where('status', 1)->where('is_verify', 1)->orderBy('id','DESC')->get();

				$sell = OpportunitySellOffer::where('status', 1)->where('is_verify', 1)->orderBy('id','DESC')->get();

			$buy = OpportunityBuy::where('status', 1)->where('is_verify', 1)->orderBy('id','DESC')->get();

		$requestReport = new RequestReport;
		$result_filter = false;
		$opp_type = $request->get('type');
		if ($request->has('type') and $ids = $request->get('ids') ) {
			switch ($request->get('type')) {
				case 'build':
					$result_filter = $build->find($ids);
					break;
				case 'sell':
					$result_filter = $sell->find($ids);
					break;
				case 'buy':
					$result_filter = $buy->find($ids);
					break;
			}
		}
		$if_from_home = "";
		return view("oppor.explore", compact('country_list', 'build', 'sell', 'buy', 'requestReport', 'result_filter','opp_type' ,'company_id', 'if_from_home'));
	}


	public function getHashtag(Request $request) {

		$user_id = Auth::id();
		$company_id = CompanyProfile::getCompanyId($user_id);

		$build = null;
		$sell = null;
		$buy = null;
		$result_filter = false;
		if(isset($request['hashTag'])){
		  $hashT=$request['hashTag'];

			$build = OpportunityBuildingCapability::where('company_id', '!=', $company_id)
				->where('relevant_describing_partner', 'like', '%'. $hashT . '%')
				->where('status', 1)
				->get();

			$sell = OpportunitySellOffer::where('company_id', '!=', $company_id)
				->where('relevant_describing_partner', 'like', '%' . $hashT . '%')
				->where('status', 1)
				->get();

			$buy = OpportunityBuy::where('company_id', '!=', $company_id)
				->where('relevant_describing_partner', 'like',  '%' . $hashT . '%')
				->where('status', 1)
				->get();


		$requestReport = new RequestReport;

		return view("oppor.explore", compact('build', 'sell', 'buy', 'requestReport', 'hashT','result_filter'));
		} else {
			return redirect("/opportunity/explore");
		}

	}


	public function select() {

		return view("oppor.select");

	}

	public function buildNew() {

		$country_list = Countries::all(); //Configurations::getJsonValue('countries');
		$industry_list = OppIndustry::where('type', '=', "choices")->get(); 
		$approx_large_list = Configurations::getJsonValue('approx_large');
		
		$if_has_custom = OppIndustry::where(function ($query) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', "0");
    	})->get(); 

		$data = [];

		return view("oppor.build", compact('country_list', 'approx_large_list', 'data', 'industry_list', 'if_has_custom'));

	}

	//editing build

	public function editBuild(Request $request) {

		if (isset($request['id'])) {

			$data = OpportunityBuildingCapability::find($request['id']);

			if ($data != NULL) {//( type = 'custom' and id = ".$data->industry." )

				$country_list = Countries::all(); //Configurations::getJsonValue('countries');
				$industry_list = OppIndustry::where('type', '=', "choices")
				
				->orWhere(function ($query) use ( $data) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', $data->industry); 
    			})->get(); 
    			
    			$if_has_custom = OppIndustry::where(function ($query) use ( $data) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', $data->industry);
    			})->get(); 

				$approx_large_list = Configurations::getJsonValue('approx_large');

				//$company_id = CompanyProfile::getCompanyId(Auth::id());

				return view("oppor.build", compact('country_list', 'approx_large_list', 'data', 'industry_list', 'if_has_custom'));

			}

		}

	}

	//for edit

	public function storeBuild(Request $request) {

		if ($request->isMethod('post')) {

			$idealPartnerBusiness = '';
			if( $request->input('checkboxes2') !== null){
			$idealPartnerBusiness = implode(",",$request->input('checkboxes2'));
			}

			$idealPartnerBase = '';
			if( $request->input('ideal_partner_base') !== null){
				$idealPartnerBase = implode(",",$request->input('ideal_partner_base'));
			}

			$businessGoal = '';
			if($request->input('businessGoal') !== null){
				$businessGoal = $request->input('businessGoal');
			}
			
			$audienceTarget = '';
			if($request->input('audienceTarget') !== null){
				$audienceTarget = $request->input('audienceTarget');
			}

			$timeFrame = '';
			if($request->input('timeFrame') !== null){
				$timeFrame = $request->input('timeFrame');
			}
			

			$user_id = Auth::id();
			$company_id = CompanyProfile::getCompanyId($user_id);
			
			if (User::getEBossStaffTrue($user_id) == false) {
			if(OpportunityController::validateAccLimits($company_id) == false){
				return redirect('/opportunity')->with('message', 'You have exceeded to the allowed number of submitted opportunities.');
				exit;
			}
			}

			$view_type = $request->input('viewtype_value');
			$industry = $request->input('opp_industry');
			
			
			if (User::getEBossStaffTrue($user_id) == false) {
				if( SpentTokens::validateLeftBehindToken($company_id) == false && $view_type == '0' ){
					$view_type == '1';	
				}
			}

			//$opp = OpportunityBuildingCapability::where('company_id', $company_id)->first();

			$opp = OpportunityBuildingCapability::find($request->input("id"));

			//echo $request->input('timeframe_goal'); exit;

			if ($opp != null) {
			    
			    if($industry == "0"){
			        
			        if ($request->hasfile('custom_image_upload')) {

    					$folderPath = public_path() . '/images/industry/';

                        $image_parts = explode(";base64,", $request->input("custom_image_value"));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        
                        $name = "custom_".$user_id . '_' . time();
                        
                        $file = $folderPath . $name . '.'.$image_type;
                
                        file_put_contents($file, $image_base64);
    
    					$insert_custom_industry = OppIndustry::create([
    
    						'text' => "Custom Industry " . $user_id . " " . time(),
    
    						'image' => $name.'.'.$image_type,
    
    						'type' => "custom",
    
    						'opp_type' => "build",
    
    					]);
    
    					//AuditLog::ok(array($user_id, 'custom industry image', 'upload custom industry image', 'image name:' . $name));
    					
    					$opp_industry_custom = OppIndustry::find($opp->industry);
    					if ($opp_industry_custom != null) {
        					$opp_industry_custom->active = 0;
        					$opp_industry_custom->updated_at = date("Y-m-d H:i:s");
        					$opp_industry_custom->save();
    					}
    					
    					$industry = $insert_custom_industry->id;
    
    				}
    				else{
    				    $industry = "0";
    				}
			    }

				$opp->opp_title = $request->input('opp_title');

				$opp->business_goal = $businessGoal; //$request->input('business_goal');

				$opp->audience_target = $audienceTarget; // $request->input('audience_target');

				$opp->intro_describe_business = $request->input('intro_describe_business');

				$opp->oppo_description = $request->input('oppo_description');

				$opp->why_partner_goal = $request->input('why_partner_goal');

				$opp->timeframe_goal = $timeFrame; //$request->input('timeframe_goal');

				$opp->currency = $request->input('currency');
				$opp->approx_large = $request->input('approx_large');
				$opp->est_revenue = $request->input('est_revenue');
				$opp->est_profit = $request->input('est_profit');
				$opp->inventory_value = $request->input('inventory_value');

				$opp->ideal_partner_base = $idealPartnerBase;

				$opp->industry = $industry;

				$opp->ideal_partner_business = $idealPartnerBusiness; //rtrim($request->input('ideal_partner_business'), ',');

				$opp->relevant_describing_partner = $request->input('relevant_describing_partner');

				$opp->edited_by = $user_id;

				$opp->view_type = $view_type;

				if ($opp->save()) {

					AuditLog::ok(array($user_id, 'opportunity', 'update build', 'edited an opportunity under build'));

					return redirect('opportunity/editBuild/' . $opp->id)->with('status', 'Building capability has been succesfully saved.');

				}

			} else {
			    
			    if($industry == "0"){
			        if ($request->hasfile('custom_image_upload')) {

    					$folderPath = public_path() . '/images/industry/';

                        $image_parts = explode(";base64,", $request->input("custom_image_value"));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        
                        $name = "custom_".$user_id . '_' . time();
                        
                        $file = $folderPath . $name . '.'.$image_type;
                
                        file_put_contents($file, $image_base64);
    
    					$insert_custom_industry = OppIndustry::create([
    
    						'text' => "Custom Industry " . $user_id . " " . time(),
    
    						'image' => $name.'.'.$image_type,
    
    						'type' => "custom",
    
    						'opp_type' => "build",
    
    					]);
    
    					//AuditLog::ok(array($user_id, 'custom industry image', 'upload custom industry image', 'image name:' . $name));
    					
    					$industry = $insert_custom_industry->id;
    
    				}
    				else{
    				    $industry = "0";
    				}
			    }

				$isOk = OpportunityBuildingCapability::create([

					'company_id' => $company_id,

					'opp_title' => $request->input('opp_title'),

					'business_goal' => $businessGoal, //$request->input('business_goal'),

					'audience_target' => $audienceTarget, //$request->input('audience_target'),

					'intro_describe_business' => $request->input('intro_describe_business'),

					'oppo_description' => $request->input('oppo_description'),

					'why_partner_goal' => $request->input('why_partner_goal'),

					'timeframe_goal' => $timeFrame, //$request->input('timeframe_goal'),

					'currency' => $request->input('currency'),

					'approx_large' => $request->input('approx_large'),

					'currency' => $request->input('currency'),

					'est_revenue' => $request->input('est_revenue'),

					'est_profit' => $request->input('est_profit'),

					'inventory_value' => $request->input('inventory_value'),

					'ideal_partner_base' => $idealPartnerBase,

					'ideal_partner_business' => $idealPartnerBusiness,   //rtrim($request->input('ideal_partner_business'), ','),

					'relevant_describing_partner' => $request->input('relevant_describing_partner'),

					'added_by' => $user_id,

					'status' => 1,

					'view_type' => $view_type,

					'industry' => $industry,

					'avatar_status' => $request->input('avatar_status'),

					'is_anywhere' => $request->input('is_anywhere'),


				]);

				if ($isOk) {

					AuditLog::ok(array($user_id, 'opportunity', 'Create', 'created new opportunity under Invest'));

					return redirect('/opportunity')->with('status', 'Building capability has been succesfully saved.');

				}

			}

		}

	}

	public function sellNew() {

		
		$country_list = Countries::all(); //Configurations::getJsonValue('countries');
		$industry_list = OppIndustry::where('type', '=', "choices")->get(); 
		$approx_large_list = Configurations::getJsonValue('approx_large');
		
		$if_has_custom = OppIndustry::where(function ($query) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', "0");
    	})->get(); 

		$data = [];

		return view("oppor.selloffer", compact('country_list', 'approx_large_list', 'data', 'industry_list', 'if_has_custom'));

	}

	public function editSellOffer(Request $request) {

		if (isset($request['id'])) {

			$data = OpportunitySellOffer::find($request['id']);

			if ($data != NULL) {
			    
			    $country_list = Countries::all(); //Configurations::getJsonValue('countries');
				$industry_list = OppIndustry::where('type', '=', "choices")
				
				->orWhere(function ($query) use ( $data) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', $data->industry); 
    			})->get(); 
    			
    			$if_has_custom = OppIndustry::where(function ($query) use ( $data) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', $data->industry);
    			})->get(); 

				$approx_large_list = Configurations::getJsonValue('approx_large');

				return view("oppor.selloffer", compact('country_list', 'approx_large_list', 'data', 'industry_list', 'if_has_custom'));

			}

		}

	}

	public function storeSellOffer(Request $request) {

		if($request->isMethod('post')) {

			$idealPartnerBusiness = '';
			if( $request->input('checkboxes2') !== null){
			$idealPartnerBusiness = implode(",",$request->input('checkboxes2'));
			}

			$idealPartnerBase = '';
			if( $request->input('ideal_partner_base') !== null){
				$idealPartnerBase = implode(",",$request->input('ideal_partner_base'));
			}

			$whatSellOffer = '';
			if($request->input('checkboxes1') !== null){
			$whatSellOffer = implode(",",$request->input('checkboxes1'));
			}

			$timeFrame = '';
			if($request->input('timeFrame') !== null){
				$timeFrame = $request->input('timeFrame');
			
			}	
			$audienceTarget = '';
			if($request->input('audienceTarget') !== null){
				$audienceTarget = $request->input('audienceTarget');
			
			}
			$opTitle = ( trim($request->input('opp_title')) != '')? $request->input('opp_title') : '';
	
			$view_type = $request->input('viewtype_value');
			$industry = $request->input('opp_industry');
			$user_id = Auth::id();
			$company_id = CompanyProfile::getCompanyId($user_id);

			if (User::getEBossStaffTrue($user_id) == false) {
				
				if(OpportunityController::validateAccLimits($company_id) == false){
					return redirect('/opportunity')->with('message', 'You have exceeded to the allowed number of submitted opportunities.');
					exit;
				}

				if( SpentTokens::validateLeftBehindToken($company_id) == false && $view_type == '0' ){
					$view_type == '1';	
				}
			}

			$opp = OpportunitySellOffer::find($request->input("id"));

			if ($opp != null) {

                if($industry == "0"){
			        
			        if ($request->hasfile('custom_image_upload')) {

    					$folderPath = public_path() . '/images/industry/';

                        $image_parts = explode(";base64,", $request->input("custom_image_value"));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        
                        $name = "custom_".$user_id . '_' . time();
                        
                        $file = $folderPath . $name . '.'.$image_type;
                
                        file_put_contents($file, $image_base64);
    
    					$insert_custom_industry = OppIndustry::create([
    
    						'text' => "Custom Industry " . $user_id . " " . time(),
    
    						'image' => $name.'.'.$image_type,
    
    						'type' => "custom",
    
    						'opp_type' => "selloffer",
    
    					]);
    
    					//AuditLog::ok(array($user_id, 'custom industry image', 'upload custom industry image', 'image name:' . $name));
    					
    					$opp_industry_custom = OppIndustry::find($opp->industry);
    					if ($opp_industry_custom != null) {
        					$opp_industry_custom->active = 0;
        					$opp_industry_custom->updated_at = date("Y-m-d H:i:s");
        					$opp_industry_custom->save();
    					}
    					
    					$industry = $insert_custom_industry->id;
    
    				}
    				else{
    				    $industry = "0";
    				}
			    }


				$opp->opp_title = $opTitle; //$request->input('opp_title');

				$opp->what_sell_offer = $whatSellOffer; //rtrim($request->input('what_sell_offer'), ',');

				$opp->audience_target = $audienceTarget; //$request->input('audience_target');

				$opp->intro_describe_business = $request->input('intro_describe_business');

				$opp->oppo_description = $request->input('oppo_description');

				$opp->why_partner_goal = $request->input('why_partner_goal');

				$opp->timeframe_goal = $timeFrame; //  $request->input('timeframe_goal');

				$opp->currency = $request->input('currency');
				$opp->approx_large = $request->input('approx_large');
				$opp->est_profit = $request->input('est_profit');
				$opp->est_revenue = $request->input('est_revenue');
				$opp->inventory_value = $request->input('inventory_value');

				$opp->ideal_partner_base = $idealPartnerBase;

				$opp->industry = $industry;

				$opp->ideal_partner_business = $idealPartnerBusiness; //rtrim($request->input('ideal_partner_business'), ',');

				$opp->relevant_describing_partner = $request->input('relevant_describing_partner');

				$opp->edited_by = $user_id;

				$opp->view_type = $view_type;

				if ($opp->save()) {
					AuditLog::ok(array($user_id, 'opportunity', 'update sell', 'edited an opportunity under sell'));
					return redirect('opportunity/editSellOffer/' . $opp->id)->with('status', 'Sell/Offer has been succesfully saved.');
				}

			} else {
				
				if($industry == "0"){
			        if ($request->hasfile('custom_image_upload')) {

    					$folderPath = public_path() . '/images/industry/';

                        $image_parts = explode(";base64,", $request->input("custom_image_value"));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        
                        $name = "custom_".$user_id . '_' . time();
                        
                        $file = $folderPath . $name . '.'.$image_type;
                
                        file_put_contents($file, $image_base64);
    
    					$insert_custom_industry = OppIndustry::create([
    
    						'text' => "Custom Industry " . $user_id . " " . time(),
    
    						'image' => $name.'.'.$image_type,
    
    						'type' => "custom",
    
    						'opp_type' => "selloffer",
    
    					]);
    
    					//AuditLog::ok(array($user_id, 'custom industry image', 'upload custom industry image', 'image name:' . $name));
    					
    					$industry = $insert_custom_industry->id;
    
    				}
    				else{
    				    $industry = "0";
    				}
			    }

				$isOk = OpportunitySellOffer::create([

					'company_id' => $company_id,

					'opp_title' => $opTitle,

					'what_sell_offer' => $whatSellOffer, //rtrim($request->input('what_sell_offer'), ','),

					'audience_target' => $audienceTarget, //$request->input('audience_target'),

					'intro_describe_business' => $request->input('intro_describe_business'),

					'oppo_description' => $request->input('oppo_description'),

					'why_partner_goal' => $request->input('why_partner_goal'),

					'timeframe_goal' => $timeFrame, // $request->input('timeframe_goal'),

					'currency' => $request->input('currency'),
					'approx_large' => $request->input('approx_large'),
					'est_profit' => $request->input('est_profit'),
					'est_revenue' => $request->input('est_revenue'),
					'inventory_value' => $request->input('inventory_value'),


					'ideal_partner_base' => $idealPartnerBase,

					'ideal_partner_business' => $idealPartnerBusiness, //rtrim($request->input('ideal_partner_business'), ','),

					'relevant_describing_partner' => $request->input('relevant_describing_partner'),

					'added_by' => $user_id,

					'status' => 1,

					'view_type' => $view_type,

					'industry' => $industry,

					'avatar_status' => $request->input('avatar_status'),

					'is_anywhere' => $request->input('is_anywhere'),

				]);

				if ($isOk) {

					AuditLog::ok(array($user_id, 'opportunity', 'store new sell', 'created a new opportunity under sell'));
					return redirect('/opportunity')->with('status', 'Sell/Offer has been succesfully saved.');

				}

			}

		}

	}

	public function buyNew() {

		$country_list = Countries::all(); //Configurations::getJsonValue('countries');
		$industry_list = OppIndustry::where('type', '=', "choices")->get(); 
		$approx_large_list = Configurations::getJsonValue('approx_large');
		
		$if_has_custom = OppIndustry::where(function ($query) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', "0");
    	})->get(); 

		$data = [];

		return view("oppor.buy", compact('country_list', 'approx_large_list', 'data','industry_list', 'if_has_custom'));

	}

	public function editBuy(Request $request) {

		if (isset($request['id'])) {

			$data = OpportunityBuy::find($request['id']);

			if ($data != NULL) {
			    
			    $country_list = Countries::all(); //Configurations::getJsonValue('countries');
				$industry_list = OppIndustry::where('type', '=', "choices")
				
				->orWhere(function ($query) use ( $data) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', $data->industry); 
    			})->get(); 
    			
    			$if_has_custom = OppIndustry::where(function ($query) use ( $data) {
    			    $query->where('type', '=', "custom");
    			    $query->where('id', '=', $data->industry);
    			})->get(); 
    			
    			$approx_large_list = Configurations::getJsonValue('approx_large');
			    

				return view("oppor.buy", compact('country_list', 'approx_large_list', 'data', 'industry_list', 'if_has_custom'));

			}

		}

	}

	public function storeBuy(Request $request) {

		if ($request->isMethod('post')) {

			$idealPartnerBusiness = '';
			if( $request->input('checkboxes2') !== null){
			$idealPartnerBusiness = implode(",",$request->input('checkboxes2'));
			}

			$idealPartnerBase = '';
			if( $request->input('ideal_partner_base') !== null){
				$idealPartnerBase = implode(",",$request->input('ideal_partner_base'));
			}

			$whatSellOffer = '';
			if($request->input('checkboxes1') !== null){
			$whatSellOffer = implode(",",$request->input('checkboxes1'));
			}

			$audienceTarget = '';
			if($request->input('audienceTarget') !== null){
				$audienceTarget = $request->input('audienceTarget');
			
			}

			$timeFrame = '';
			if($request->input('timeFrame') !== null){
				$timeFrame = $request->input('timeFrame');
			
			}	

			$view_type = $request->input('viewtype_value');
			$industry = $request->input('opp_industry');
			$user_id = Auth::id();
			$company_id = CompanyProfile::getCompanyId($user_id);

			if (User::getEBossStaffTrue($user_id) == false) {

				if( OpportunityController::validateAccLimits($company_id) == false){

					return redirect('/opportunity')->with('message', 'You have exceeded to the allowed number of submitted opportunities.');
					exit;
				}

				if( SpentTokens::validateLeftBehindToken($company_id) == false && $view_type == '0' ){
					$view_type == '1';	
				}

			}
			$opp = OpportunityBuy::find($request->input("id"));

			if ($opp != null) {
			    
			    if($industry == "0"){
			        
			        if ($request->hasfile('custom_image_upload')) {

    					$folderPath = public_path() . '/images/industry/';

                        $image_parts = explode(";base64,", $request->input("custom_image_value"));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        
                        $name = "custom_".$user_id . '_' . time();
                        
                        $file = $folderPath . $name . '.'.$image_type;
                
                        file_put_contents($file, $image_base64);
    
    					$insert_custom_industry = OppIndustry::create([
    
    						'text' => "Custom Industry " . $user_id . " " . time(),
    
    						'image' => $name.'.'.$image_type,
    
    						'type' => "custom",
    
    						'opp_type' => "buy",
    
    					]);
    
    					//AuditLog::ok(array($user_id, 'custom industry image', 'upload custom industry image', 'image name:' . $name));
    					
    					$opp_industry_custom = OppIndustry::find($opp->industry);
    					if ($opp_industry_custom != null) {
        					$opp_industry_custom->active = 0;
        					$opp_industry_custom->updated_at = date("Y-m-d H:i:s");
        					$opp_industry_custom->save();
    					}
    					
    					$industry = $insert_custom_industry->id;
    
    				}
    				else{
    				    $industry = "0";
    				}
			    }

				$opp->opp_title = $request->input('opp_title');

				$opp->what_sell_offer = $whatSellOffer; //rtrim($request->input('what_sell_offer'), ',');

				$opp->audience_target = $audienceTarget; //$request->input('audience_target');

				$opp->intro_describe_business = $request->input('intro_describe_business');

				$opp->oppo_description = $request->input('oppo_description');

				$opp->why_partner_goal = $request->input('why_partner_goal');

				$opp->timeframe_goal = $timeFrame; //$request->input('timeframe_goal');

				$opp->currency = $request->input('currency');
				$opp->approx_large = $request->input('approx_large');
				$opp->est_profit = $request->input('est_profit');
				$opp->est_revenue = $request->input('est_revenue');
				$opp->inventory_value = $request->input('inventory_value');

				$opp->ideal_partner_base = $idealPartnerBase;

				$opp->industry = $industry;

				$opp->ideal_partner_business = $idealPartnerBusiness; //rtrim($request->input('ideal_partner_business'), ',');

				$opp->relevant_describing_partner = $request->input('relevant_describing_partner');

				$opp->edited_by = $user_id;

				if ($opp->save()) {

					AuditLog::ok(array($user_id, 'opportunity', 'update buy', 'edited an opportunity under buy'));

					return redirect('opportunity/editBuy/' . $opp->id)->with('status', 'Buy opportunity has been succesfully saved.');

				}

			} else {
			    
			    if($industry == "0"){
			        if ($request->hasfile('custom_image_upload')) {

    					$folderPath = public_path() . '/images/industry/';

                        $image_parts = explode(";base64,", $request->input("custom_image_value"));
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        
                        $name = "custom_".$user_id . '_' . time();
                        
                        $file = $folderPath . $name . '.'.$image_type;
                
                        file_put_contents($file, $image_base64);
    
    					$insert_custom_industry = OppIndustry::create([
    
    						'text' => "Custom Industry " . $user_id . " " . time(),
    
    						'image' => $name.'.'.$image_type,
    
    						'type' => "custom",
    
    						'opp_type' => "buy",
    
    					]);
    
    					//AuditLog::ok(array($user_id, 'custom industry image', 'upload custom industry image', 'image name:' . $name));
    					
    					$industry = $insert_custom_industry->id;
    
    				}
    				else{
    				    $industry = "0";
    				}
			    }

				$isOk = OpportunityBuy::create([

					'company_id' => $company_id,

					'opp_title' => $request->input('opp_title'),

					'what_sell_offer' => $whatSellOffer, //rtrim($request->input('what_sell_offer'), ','),

					'audience_target' => $audienceTarget, //$request->input('audience_target'),

					'intro_describe_business' => $request->input('intro_describe_business'),

					'oppo_description' => $request->input('oppo_description'),

					'why_partner_goal' => $request->input('why_partner_goal'),

					'timeframe_goal' => $timeFrame, //$request->input('timeframe_goal'),

					'currency' => $request->input('currency'),
					'approx_large' => $request->input('approx_large'),
					'est_profit' => $request->input('est_profit'),
					'est_revenue' => $request->input('est_revenue'),
					'inventory_value' => $request->input('inventory_value'),

					'ideal_partner_base' => $idealPartnerBase,

					'ideal_partner_business' => $idealPartnerBusiness, //rtrim($request->input('ideal_partner_business'), ','),

					'relevant_describing_partner' => $request->input('relevant_describing_partner'),

					'added_by' => $user_id,

					'status' => 1,

					'view_type' => 1,

					'industry' => $industry,

					'avatar_status' => $request->input('avatar_status'),

					'is_anywhere' => $request->input('is_anywhere'),

				]);

				if ($isOk) {

					AuditLog::ok(array($user_id, 'opportunity', 'store new buy', 'created an opportunity under buy'));

					return redirect('/opportunity')->with('status', 'Buy opportunity has been succesfully saved.');

				}

			}

		}

	}

	public function deleteBuild(Request $request) {

		if (isset($request['id'])) {
		    
		    $exploded = explode(":",$request['id']);

			$itemId = $exploded[0];
			$whre_stat = $exploded[1];
			$redirect_url = "/opportunity/approval/pending";
			
			if($whre_stat == "approved"){
			    $redirect_url = "/opportunity/approval/approved";
			}

			$user_id = Auth::id();

			$company_id = CompanyProfile::getCompanyId($user_id);

			if (User::getMasterOrSubConsultant($user_id) == false) {

				$rs = OpportunityBuildingCapability::find($itemId);

				if (count((array)$rs) > 0) {

					if ($rs->company_id == $company_id) {

						$rs->status = 0;

						$rs->edited_by = $user_id;

						$rs->save();

                		AuditLog::ok(array($user_id, 'opportunity', 'delete', 'Delete Invest Opportunity | '.$itemId));

						return redirect($redirect_url)->with('status', 'Opportunity at building capability has been successfully removed.');

					} else {

						return redirect($redirect_url)->with('message', 'Opportunity at building capability only the owner or admin can remove.');

					}

				}

			} else {

				$rs = OpportunityBuildingCapability::find($itemId);

				if (count((array)$rs) > 0) {

					$rs->status = 0;

					$rs->edited_by = $user_id;

					$rs->save();

					return redirect($redirect_url)->with('status', 'Opportunity at building capability has been successfully removed.');

				}

			}

		}

	}

	public function deleteSell(Request $request) {

		if (isset($request['id'])) {

			$exploded = explode(":",$request['id']);

			$itemId = $exploded[0];
			$whre_stat = $exploded[1];
			$redirect_url = "/opportunity/approval/pending";
			
			if($whre_stat == "approved"){
			    $redirect_url = "/opportunity/approval/approved";
			}

			$user_id = Auth::id();

			$company_id = CompanyProfile::getCompanyId($user_id);

			if (User::getMasterOrSubConsultant($user_id) == false) {

				$rs = OpportunitySellOffer::find($itemId);

				if (count((array)$rs) > 0) {

					if ($rs->company_id == $company_id) {

						$rs->status = 0;

						$rs->edited_by = $user_id;

						$rs->save();

						AuditLog::ok(array($user_id, 'opportunity', 'delete', 'Delete Sell Opportunity | '.$itemId));

						return redirect($redirect_url)->with('status', 'Opportunity at sell/offer has been successfully removed.');

					} else {

						return redirect($redirect_url)->with('message', 'Opportunity at sell/offer only the owner or admin can remove.');

					}

				}

			} else {

				$rs = OpportunitySellOffer::find($itemId);

				if (count((array)$rs) > 0) {

					$rs->status = 0;

					$rs->edited_by = $user_id;

					$rs->save();

					return redirect($redirect_url)->with('status', 'Opportunity at sell/offer has been successfully removed.');

				}

			}

		}

	}

	public function deleteBuy(Request $request) {

		if (isset($request['id'])) {

			$exploded = explode(":",$request['id']);

			$itemId = $exploded[0];
			$whre_stat = $exploded[1];
			$redirect_url = "/opportunity/approval/pending";
			
			if($whre_stat == "approved"){
			    $redirect_url = "/opportunity/approval/approved";
			}

			$user_id = Auth::id();

			$company_id = CompanyProfile::getCompanyId($user_id);

			if (User::getMasterOrSubConsultant($user_id) == false) {

				$rs = OpportunityBuy::find($itemId);

				if (count((array)$rs) > 0) {

					if ($rs->company_id == $company_id) {

						$rs->status = 0;

						$rs->save();

						AuditLog::ok(array($user_id, 'opportunity', 'delete', 'Delete Buy Opportunity | '.$itemId));

						return redirect($redirect_url)->with('status', 'Opportunity at buy has been successfully removed.');

					} else {

						return redirect($redirect_url)->with('message', 'Opportunity at buy only the owner or admin can remove.');

					}

				}

			} else {

				$rs = OpportunityBuy::find($itemId);

				if (count((array)$rs) > 0) {

					$rs->status = 0;

					$rs->edited_by = $user_id;

					$rs->save();

					return redirect($redirect_url)->with('status', 'Opportunity at sell/offer has been successfully removed.');

				}

			}

		}

	}

	public function privacyOption(Request $request) {

		if ($request->isMethod('post')) {

			$opp_type = $request->input("oppor_type");

			$opp_id = $request->input("id");

			$opp_privacy = $request->input("privacy_type");

			$viewType = '';

			if ($opp_privacy == 'company_info') {

				$viewType = '2';

			} elseif ($opp_privacy == 'keep_private') {

				$viewType = '1';

			}

			if ($opp_type == 'build') {

				$build = OpportunityBuildingCapability::find($opp_id);

				if (count((array)$build) > 0) {

					$build->view_type = $viewType;

					$build->save();

				}

			} elseif ($opp_type == 'sell') {

				$sell = OpportunitySellOffer::find($opp_id);

				if (count((array)$sell) > 0) {

					$sell->view_type = $viewType;

					$sell->save();

				}

			} elseif ($opp_type == 'buy') {

				$buy = OpportunityBuy::find($opp_id);

				if (count((array)$buy) > 0) {

					$buy->view_type = $viewType;

					$buy->save();

				}

			}

			// return redirect('/opportunity/explore')->with('status', 'Privacy option of the opportunity has been successfully changed.');

		} //end of method post

	}

	public function premiumPurchase(Request $request) {

		if ($request->isMethod('post')) {

			$user_id = Auth::id();
			$company_id = CompanyProfile::getCompanyId($user_id);

			$companyID = $request->input("companyID"); //opportunity owner
			$opp_type = $request->input("ptype");
			$opp_id = $request->input("oppId");

			PremiumOpportunityPurchased::topUp($company_id, $opp_id, $opp_type);
			SpentTokens::spendTokenByPremium("Spent for premium data", $company_id, $user_id, 1); //1 token deduction
			
			$viewer = base64_encode('viewer' . $companyID);
			$token = base64_encode(date('YmdHis'));
			return url('/company/'.$viewer.'/'.$companyID.'/'.$opp_id.'/'.$token);
 
		}
	
	}

	public function alertFreeAccount(Request $request)
	{
		if ($request->isMethod('post')) {
			$company_opp = $request->input("companyOpp"); //opportunity owner
			$company_viewer = $request->input("companyViewer"); //viewer

			$user_id = Auth::id();
			$rs = CompanyProfile::find($company_opp);

			AuditLog::ok(array($user_id, 'opportunity', 'express interest to a company at explore page', 'company id:'. $company_viewer.' express interest to company id:' . $company_opp));

			$message = "

                  Dear  $rs->registered_company_name,

                  <br />
                  <br />

				  We would like to inform you that there was an expression of interest from a Intellinz premium account company, 
				  to one of your opportunity post.
				  				  
                  <br />
				  In order to interact with the premium account company we encourage you to buy or top up a token in your Intellinz account.
				  
				  <br />
				  To respond please login to : https://intellinz.com/
                  <br />

                  Best Regards, <br />

                  Intellinz Web Admin
                  ";

						//send the email here

				Mailbox::sendMail($message, $usr->email, ".", "");

		}

	}


public static function validateAccLimits($company_id){

		$acc_limits = Configurations::getJsonValue('account_limits');
		$token = SpentTokens::validateLeftBehindToken($company_id);
		
		if($token == false){ 
			
			$countOpp = 0;
			$cBuy = 0;
			$cSell = 0;
			$cBuild = 0;

					$cBuild = OpportunityBuildingCapability::where('company_id', $company_id)->where('status', 1)->count();
					$cBuy = OpportunityBuy::where('company_id', $company_id)->where('status', 1)->count();
					$cSell = OpportunitySellOffer::where('company_id', $company_id)->where('status', 1)->count();
		
			$countOpp = ($cBuy + $cBuild + $cSell);
		
			//echo $countOpp .'  '.(int)$acc_limits['FREE']; exit;
			if( (int)$countOpp >= (int)$acc_limits['FREE'] ){ //exceeded
				return false;
			} else {
				return true;
			}

		} else{
			return true;
		}

	}

	public function updateOpportunityDetail(Request $request){
		if ($request->isMethod('post')) {
			$opporId = $request->input('opporId');
			$opporType = $request->input('opporType');
				$resultValue = $request->input('resultStatus');
			
			if($opporType == 'build')
				$result = OpportunityBuildingCapability::find($opporId);
			if($opporType == 'sell')
				$result = OpportunitySellOffer::find($opporId);
			if($opporType == 'buy')
				$result = OpportunityBuy::find($opporId);

			if($request->input('opporSection') == 'input-text-form')
			{
				$fieldName = $request->input('fieldName');
				$result->update(array($fieldName => $resultValue) );
			//	print_r($result);
			//	print_r($fieldName);
			}
			else{
			if($result){
					if($request->input('opporSection') == 'imageAvatar' )
						$result->avatar_status = $resultValue;
					if($request->input('opporSection') == 'viewType' )
						$result->view_type = $resultValue;
						if($request->input('opporSection') == 'partner_check' )
							$result->is_anywhere = $resultValue;

				$result->save();
			}

			}
		}
	}

#for approval pending opprtunities
	public function approval(Request $request, $status = 'pending') {
		$user_id = Auth::id();
		// if (User::securePage($user_id) != 5) {
		// 	return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		// }

		if(isset($request['status']) and $request['status'] == 'approved'){
			$isverify = 1;
		}else{
			$isverify = 0;
		}

		$build = OpportunityBuildingCapability::where('is_verify', $isverify)->where('status', 1)->get();
		$sell = OpportunitySellOffer::where('is_verify', $isverify)->where('status', 1)->get();
		$buy = OpportunityBuy::where('is_verify', $isverify)->where('status', 1)->get();
		$industry = Configurations::getJsonValue('industry_type');
		$businessType = Configurations::getJsonValue('business_opportunity_type');
		return view("oppor.approval", compact('build', 'sell', 'buy', 'industry', 'businessType', 'status'));

	}

	public function approved(Request $request) {
		$user_id = Auth::id();
		// if (User::securePage($user_id) != 5) {
		// 	return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		// }
		if ($request->isMethod('post')) {
			$opporId = $request->input('opporId');
			$opporType = $request->input('opporType');

			if($opporType == 'build')
				$result = OpportunityBuildingCapability::find($opporId);
			if($opporType == 'sell')
				$result = OpportunitySellOffer::find($opporId);
			if($opporType == 'buy')
				$result = OpportunityBuy::find($opporId);

			if($request->input('is_verify') == 1){
				$result->is_verify = 1;
			}else{
				$result->is_verify = 0;
			}

				$result->save();

		}
		// if (isset($request['id']) || isset($request['type']) ) {
		// 	$oppor_id = $request['id'];
		// 	$oppor_type = $request['type'];
		// }else{
		// 	return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		// }

		// $build = OpportunityBuildingCapability::where('is_verify', 1)->where('status', 1)->get();
		// $sell = OpportunitySellOffer::where('is_verify', 1)->where('status', 1)->get();
		// $buy = OpportunityBuy::where('is_verify', 1)->where('status', 1)->get();
		// $industry = Configurations::getJsonValue('industry_type');
		// $businessType = Configurations::getJsonValue('business_opportunity_type');
		// return view("oppor.approval", compact('build', 'sell', 'buy', 'industry', 'businessType'));

	}


	public function editApprovalBuild(Request $request) {
		$user_id = Auth::id();
		// if (User::securePage($user_id) != 5) {
		// 	return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		// }
		if (isset($request['id'])) {

			$data = OpportunityBuildingCapability::find($request['id']);

			if ($data != NULL) {

				$country_list = Countries::all(); //Configurations::getJsonValue('countries');
				$industry_list = OppIndustry::where('type', '=', "choices")->get(); 

				$approx_large_list = Configurations::getJsonValue('approx_large');

				//$company_id = CompanyProfile::getCompanyId(Auth::id());

				return view("oppor.approvalbuild", compact('country_list', 'approx_large_list', 'data', 'industry_list'));

			}

		}else{
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}

	}

	public function editApprovalSellOffer(Request $request) {
		$user_id = Auth::id();
		// if (User::securePage($user_id) != 5) {
		// 	return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		// }
		if (isset($request['id'])) {

			$data = OpportunitySellOffer::find($request['id']);

			if ($data != NULL) {

				$country_list = Countries::all(); //Configurations::getJsonValue('countries');
				$industry_list = OppIndustry::where('type', '=', "choices")->get(); 

				$approx_large_list = Configurations::getJsonValue('approx_large');

				//$company_id = CompanyProfile::getCompanyId(Auth::id());

				return view("oppor.approvalselloffer", compact('country_list', 'approx_large_list', 'data', 'industry_list'));

			}

		}else{
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}

	}

	public function editApprovalBuy(Request $request) {
		$user_id = Auth::id();
		// if (User::securePage($user_id) != 5) {
		// 	return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		// }
		if (isset($request['id'])) {

			$data = OpportunityBuy::find($request['id']);

			if ($data != NULL) {

				$country_list = Countries::all(); //Configurations::getJsonValue('countries');
				$industry_list = OppIndustry::where('type', '=', "choices")->get(); 

				$approx_large_list = Configurations::getJsonValue('approx_large');

				//$company_id = CompanyProfile::getCompanyId(Auth::id());

				return view("oppor.approvalbuy", compact('country_list', 'approx_large_list', 'data', 'industry_list'));

			}

		}else{
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}

	}


}#end class