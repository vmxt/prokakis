<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\Configurations;
use App\GeneratedReport;
use App\Http\Controllers\Controller;
use App\KeyManagement;
use App\ProcessedReport;
use App\RequestApproval;
use App\RequestReport;
use App\UploadImages;
use App\ReportGenerationTemplate;
use App\User;
use Auth;
use Config;
use Illuminate\Http\Request;
use PDF;
use App\ThomsonReuters;
use App\TR_reportgeneration;
use App\FA_Results;
use App\BuyReport;
use App\ConsultantProjects;
use ZipArchive;
use Illuminate\Support\Facades\File;

class BuyreportController extends Controller {

	public function storeBuy(Request $request) {

		if ($request->isMethod('post')) {

			$user_id = null;

			$company_id_result = null;

			if ($request->input('company_id') != '') {

				$id = $request->input('company_id');

				$rs = CompanyProfile::find($id);

				if ( $rs->count() > 0) {

					$company_id_result = $id;

					$user_id = $rs->user_id;

				} else {

					return redirect('/reports/status')->with('message', 'Company record does not exist.');

					exit;

				}

			} else {

				$user_id = Auth::id();

				$company_id_result = CompanyProfile::getCompanyId($user_id);

			}

			//validation for tokensn and approval process

			$request_frequency_id = $request->input("request_frequency_id"); //one-time, quarterly, bi-annually, annually

			//check if its approved

			$reqId = $request->input('request_id');

			$req = RequestReport::find($reqId);

			if ($req->count() > 0) {

				if ($req->is_approve == NULL || $req->is_approve == 'no') {

					return redirect('/reports/status')->with('message', 'Request required approval from Consultants.');

					exit;

				}

			} else {

				return redirect('/reports/status')->with('message', 'Request record does not exist.');

				exit;

			}

			//check if there is a available token

			$consumedTokens = 1;

			if (Auth::id()) {

				$session_id = Auth::id();

				$user_company_id = CompanyProfile::getCompanyId($session_id);

				/* if( SpentTokens::validateLeftBehindToken($user_company_id) == false ){

					          return redirect('/reports/status')->with('message', 'Insufficient token value, please re-fill.');

					          exit;

					        } else {

					              SpentTokens::spendTokenByrequest($reqId, $user_company_id, $session_id, 1);

				*/

				$request_result = RequestReport::where('id', $reqId)->where('company_id', $user_company_id)->first();

				if ($request_result->count() == 0) {

					return redirect('/reports/status')->with('message', 'Request Id ' . $reqId . ' is not on your list. Please refrain from hacking the system.');

					exit;

				}

			}

			//--------------

			$company_data = CompanyProfile::find($company_id_result);

			//from system configuration

			$num_of_employee = Configurations::getJsonValue('num_of_employee');

			$estimated_sales = Configurations::getJsonValue('estimated_sales');

			$currency = Configurations::getJsonValue('currency');

			$ownership_status = Configurations::getJsonValue('ownership_status');

			$business_type = Configurations::getJsonValue('business_type');

			$business_industry = Configurations::getJsonValue('business_industry');

			$no_of_staff = Configurations::getJsonValue('no_of_staff');

			$financial_year = Configurations::getJsonValue('financial_year');

			$financial_month = Configurations::getJsonValue('financial_month');

			$countries = Configurations::getJsonValue('countries');

			$year_founded = Configurations::getJsonValue('year_founded');

			$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

			//echo $profileAvatar; exit;

			$profileAwards = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.awards'), 5);

			$profilePurchaseInvoice = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.purchase_invoices'), 5);

			$profileSalesInvoice = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.sales_invoices'), 5);

			$profileCertifications = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.certification'), 5);

			$profileCoverPhoto = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.banner'), 1);

			$completenessProfile = CompanyProfile::profileCompleteness(array($company_data, $profileAvatar, $profileAwards,

				$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

			$completenessMessages = CompanyProfile::profileStrengthMessages(array($company_data, $profileAvatar, $profileAwards,

				$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

			$brand_slogan = CompanyProfile::getBrandSlogan($user_id, $company_id_result);

			$urlFB = url('/company') . '/' . $brand_slogan[0] . '/' . time();

			//Session::put('brandName', $brand_slogan[0]);

			$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();


		$ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
		$reportTemplates = [];

		foreach ($ReportGenerationTemplate as $key => $value) {
			$reportTemplates[ $value['variable_name'] ]  = $value['content'];
		}

		$twitter_token = env('APP_ENV');
		$twitter_keyword = urlencode($company_data->company_name);
	
		$reportTrackNumber = "--";
		if(isset($_GET['aprvl']) ){
			$aproval_id=$_GET['aprvl'];
	        $rc = ProcessedReport::getReqRepId($aproval_id);
	        if($rc != false){
	           $reportTrackNumber = $rc->id."-".$rc->source_company_id."-".$rc->fk_opportunity_id."-".date("Y");
	        }
		}
		
		//MAS records
		$MASinvestors = BuyReport::findMatchedMAS($company_data->company_name);

		$cSession = curl_init(); 
		curl_setopt($cSession,CURLOPT_URL,'https://reputation.app-prokakis.com/api/v1/mentions-tosearch?_token='.$twitter_token.'&selected_sm=+Twitter++&search_keyword_selections='.$twitter_keyword);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		$response_twitter = json_decode($result);
		curl_close($cSession);

		$tr_peps = [];
		$tr_inserted_date = '';
		$MONTH_RATIO = [];
		$ACP = [];
		$IT = [];
		$DII = [];
		$PT = [];
		$APP = [];
		$NWP = [];
		$CR = [];
		$QR = [];
		$DTE = [];
		$DTA = [];
		$IC = [];
		$GPM = [];
		$OPM = [];
		$NPM = [];


			// $pdf = PDF::loadView('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			// 	'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			// 	'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			// 	'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons'));

	/*	$pdf = PDF::loadView('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons', 'reportTemplates', 'response_twitter','reportTrackNumber', 
			
			'tr_peps', 'tr_inserted_date', 'MONTH_RATIO', 'RT', 'ACP', 'IT', 'DII', 'PT', 'APP', 'NWP', 'CR', 'QR', 'DTE', 'DTA', 'IC','GPM','OPM', 'NPM',

			'ROI', 'ROE', 'consultantFiles', 'MASinvestors')); */

			//--------------

			//return $pdf->download($company_data->company_name. '.pdf');

			//exit;

			//--------------
			$pdf_report = true;
			if ($pdf_report) {

				$req_app = RequestApproval::where('req_rep_id', $req->id)->first();

				if ( $req_app->count() > 0) {

					$date_createdAt = date('Y-m-d H:i:s');

					$date_now = date('Y-m-d');

					$month_start = null;

					$month_end = null;

					switch ($request_frequency_id) {

					case 1:

						//one time

						$month_start = $date_now;

						//$month_end = $date_now;
						$date = date_create($month_start);
						date_add($date, date_interval_create_from_date_string("14 days"));
						$month_end = date_format($date, "Y-m-d");

						break;

					case 2:

						//quarterly 3 months

						$month_start = $date_now;

						$date = date_create($month_start);

						date_add($date, date_interval_create_from_date_string("3 months"));

						$month_end = date_format($date, "Y-m-d");

						break;

					case 3:

						//Bi-Annually 6 months

						$month_start = $date_now;

						$date = date_create($month_start);

						date_add($date, date_interval_create_from_date_string("6 months"));

						$month_end = date_format($date, "Y-m-d");

						break;

					case 4:

						//Annually 12 months

						$month_start = $date_now;

						$date = date_create($month_start);

						date_add($date, date_interval_create_from_date_string("12 months"));

						$month_end = date_format($date, "Y-m-d");

						break;

					}

					$ok = ProcessedReport::create([

						'approval_id' => $req_app->id,

						'requester_company_id' => $req_app->requester_company_id,

						'source_company_id' => $req_app->company_id,

						'report_status' => 'Approved-Generated',

						'request_frequency_id' => $request_frequency_id,

						'num_tokens_consumed' => $consumedTokens,

						'month_subscription_start' => $month_start,

						'month_subscription_end' => $month_end,

						'created_at' => $date_createdAt,

					]);

					GeneratedReport::reportSave($req_app->requester_company_id, $req_app->company_id, $req->id); //log the report generated

					if ($ok) {
						
						$ra_processed = ProcessedReport::getProcessedReportByApprovalId($req_app->id);

						return BuyreportController::generateReportDownload($ra_processed, true);

						//return $pdf->download($company_data->company_name . '.pdf');

					}

				} else {

					return redirect('/reports/status')->with('message', 'There is no approval record for this request.');

					exit;

				}

			    return redirect('/monitoring/list')->with('message', 'You have successfully subscribe to a report.');	

			}

			/*

				    return view('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

				    'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

				    'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

				    'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB'));

			*/

		}

	}

	public function setBuy(Request $request) {

		//setup the report here

		if ($request->isMethod('post')) {

			$companyId = $request->input('company_id');

			$requestId = $request->input('request_id');

			return view('buyreport.buy', compact('companyId', 'requestId'));

		}

	}

	public function downloadReport(Request $request) {

		if ($request->isMethod('get')) {

			$companyId = base64_decode($request['companyId']);

			$requestId = base64_decode($request['reqId']);

			//echo $requestId; exit;

			$ra_found = RequestApproval::getRequestApprovalId($requestId); //validate if its approved

			if ($ra_found != false) {
				//if approval id found

				$ra_processed = ProcessedReport::getProcessedReportByApprovalId($ra_found); //validate if report been generated

				if ($ra_processed == false) {

					return view('buyreport.buy', compact('companyId', 'requestId'));

				} else {

					//automatic download

					return BuyreportController::generateReportDownload($ra_processed, false);

				}

			}

		}

	}

	public static function generateReportDownload($proc, $ok) {

		//need to validate if the link download is expired or not

		if (isset($proc->report_link) && $proc->report_link != NULL) {

			return redirect('/monitoring/list')->with('message', 'Download link has expired.');

			exit;

		}

		$today = strtotime(date("Y-m-d"));

		if (isset($proc->month_subscription_start) && isset($proc->month_subscription_end)) {

			$dStart = strtotime($proc->month_subscription_start);

			$dEnd = strtotime($proc->month_subscription_end);

			if ($today < $dStart) {

				return redirect('/monitoring/list')->with('message', 'Download link subscription has not started.');

				exit;

			}

			if ($today > $dEnd) {

				return redirect('/monitoring/list')->with('message', 'Download link subscription has ended.');

				exit;

			}

		}

		$approval = RequestApproval::find($proc->approval_id);

		$request_rec = RequestReport::find($approval->req_rep_id);

		$company_profile = CompanyProfile::find($request_rec->source_company_id);

		$user_id = $company_profile->user_id;

		$company_id_result = $request_rec->company_id; //source_company_id

		//$company_info_source =  $request_rec->source_company_id;

		/* if( SpentTokens::validateLeftBehindToken($company_id_result) == false ){

			    return redirect('monitoring/list')->with('message', 'Insufficient token value, please top up.');

			    exit;

			  } else {

			    //$consumedTokens = SpentTokens::validateLeftBehindToken($user_company_id);

			    SpentTokens::spendTokenByrequest($approval->req_rep_id, $request_rec->company_id, $user_id, 1);

		*/

		//validation for tokensn and approval process

		$request_frequency_id = $proc->request_frequency_id; //one-time, quarterly, bi-annually, annually

		//check if its approved

		$reqId = $request_rec->id;

		$req = $request_rec;

		if ( $req->count() > 0) {

			if ($req->is_approve == NULL || $req->is_approve == 'no') {

				return redirect('/reports/status')->with('message', 'Request required approval from Consultants.');

				exit;

			}

		} else {

			return redirect('/reports/status')->with('message', 'Request record does not exist.');

			exit;

		}

		// echo 'up here'; exit;

		GeneratedReport::reportSave($proc->requester_company_id, $proc->source_company_id, $approval->req_rep_id); //log the report generated

		$company_data = CompanyProfile::find($proc->source_company_id);
		$user_data = User::find($user_id); 
		//echo $company_data->company_name; exit;

		//echo $company_id_result; exit;

		//from system configuration

		$num_of_employee = Configurations::getJsonValue('num_of_employee');

		$estimated_sales = Configurations::getJsonValue('estimated_sales');

		$currency = Configurations::getJsonValue('currency');

		$ownership_status = Configurations::getJsonValue('ownership_status');

		$business_type = Configurations::getJsonValue('business_type');

		$business_industry = Configurations::getJsonValue('business_industry');

		$no_of_staff = Configurations::getJsonValue('no_of_staff');

		$financial_year = Configurations::getJsonValue('financial_year');

		$financial_month = Configurations::getJsonValue('financial_month');

		$countries = Configurations::getJsonValue('countries');

		$year_founded = Configurations::getJsonValue('year_founded');

		$profileAvatar = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.profile'), 1);

		//echo $profileAvatar; exit;

		$profileAwards = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.awards'), 5);

		$profilePurchaseInvoice = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.purchase_invoices'), 5);

		$profileSalesInvoice = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.sales_invoices'), 5);

		$profileCertifications = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.certification'), 5);

		$profileCoverPhoto = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.banner'), 1);

		$completenessProfile = CompanyProfile::profileCompleteness(array($company_data, $profileAvatar, $profileAwards,

			$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

		$completenessMessages = CompanyProfile::profileStrengthMessages(array($company_data, $profileAvatar, $profileAwards,

			$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

		$brand_slogan = CompanyProfile::getBrandSlogan($user_id, $proc->source_company_id);

		$urlFB = url('/company') . '/' . $brand_slogan[0] . '/' . time();

		//$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();
		$keyPersons = KeyManagement::where('company_id', $proc->source_company_id)->where('user_id', $user_id)->where('status', 1)->get();

		$consultantFiles = ProcessedReport::getFileUploadsForReportGeneration($proc->approval_id);

		//--Financial Analysis---
		$fa_count = FA_Results::where('company_id', $proc->source_company_id)->count();
		//echo $fa_count . ' ' . $proc->source_company_id;
		//exit;
		$arrMonths = array(1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'May', 6=>'Jun', 7=>'Jul', 8=>'Aug', 9=>'Sep', 10=>'Oct', 11=>'11', 12=>'Dec');
		$MONTH_RATIO = [];
		$RT = [];
		$ACP = [];
		$IT = [];
		$DII = [];
		$PT = [];
		$APP = [];
		$NWP = [];
		$CR = [];
		$QR = [];
		$DTE = [];
		$DTA = [];
		$IC = [];
		$GPM = [];
		$OPM = [];
		$NPM = [];
		$ROI = [];
		$ROE = [];

		if($fa_count > 0){
			$rs = FA_Results::where('company_id', $proc->source_company_id)->get();
			foreach($rs as $t){
				$MONTH_RATIO[] = $arrMonths[$t->month_param] . '/' .$t->year_param;
			}	

			foreach($rs as $t){

				$RT[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->receivable_turnover;
				$ACP[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->average_collection_period;
				$IT[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->inventory_turnover;
				$DII[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->days_in_inventory;
				$PT[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->payable_turnover;
				$APP[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->average_payment_period;
				$NWP[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->net_working_capital;
				$CR[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->current_ratio;
				$QR[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->quick_ratio;
				$DTE[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->debt_to_equity;
				$DTA[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->debt_to_asset;
				$IC[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->interest_coverage;
				$GPM[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->gross_profit_margin;
				$OPM[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->operating_profit_margin;
				$NPM[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->net_profit_margin;
				$ROI[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->return_of_investment;
				$ROE[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->return_of_equity;

			}
	       }


		//----Thomson Reuters data------//
		$count_tr = TR_reportgeneration::where('request_id', $approval->req_rep_id)->count(); //count the records
		$tr_peps = array();
		$tr_inserted_date = date("F j, Y", $today);

		$tr_peps_create_date = '';
		$tr_inserted_date = '';
		if($count_tr > 0)
		{
			$rs_tr = TR_reportgeneration::where('request_id', $approval->req_rep_id)->get();
			foreach($rs_tr as $d)
			{
				$tr_peps[] = ThomsonReuters::searchAllThree($d->uid);
				$tr_peps_create_date  = $d->created_at;
			}

			if($tr_peps_create_date != ''){
			 $timestamp_tr = strtotime($tr_peps_create_date);
			 $tr_inserted_date = date("F j, Y", $timestamp_tr);
			}
		}

		$ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
		$reportTemplates = [];

		foreach ($ReportGenerationTemplate as $key => $value) {
			$reportTemplates[ $value['variable_name'] ]  = $value['content'];
		}

		$reportTrackNumber = "--";
		if(isset($_GET['aprvl']) ){
			$aproval_id=$_GET['aprvl'];
	        $rc = ProcessedReport::getReqRepId($aproval_id);
	        if($rc != false){
	           $reportTrackNumber = $rc->id."-".$rc->source_company_id."-".$rc->fk_opportunity_id."-".date("Y");
	        }
    	}
		$twitter_token = env('APP_ENV');
		$twitter_keyword = urlencode($company_data->company_name);

		//MAS investors
		$MASinvestors = BuyReport::findMatchedMAS($company_data->company_name);

		//check Panamas, Bahamas, Offshore, Paradise
$Panama = [];
$Paradise = [];
$Offshore = [];
$Bahamas = [];
		//$Panama = BuyReport::searchMatchInPanama($company_data->company_name);
		//$Paradise = BuyReport::searchMatchInParadise($company_data->company_name);
		//$Offshore = BuyReport::searchMatchInOffShore($company_data->company_name);
		//$Bahamas = BuyReport::searchMatchInBahamas($company_data->company_name);
		
		//Social Media
		$response_twitter = BuyreportController::curlER($twitter_token, $twitter_keyword, $sm='Twitter');
		$response_youtube = BuyreportController::curlER($twitter_token, $twitter_keyword, $sm='Youtube');
		$response_theweb = BuyreportController::curlER($twitter_token, $twitter_keyword, $sm='The Web');
		
		 // return view('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			//       'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			//       'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			//       'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons', 'reportTemplates', 'response_twitter' , 'reportTrackNumber'));

		$originalDate = $company_data->updated_at;
		$obtainDate = date("F, Y", strtotime($originalDate));	  

		$pdf = PDF::loadView('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons', 'reportTemplates', 'response_twitter','reportTrackNumber', 
			
			'tr_peps', 'tr_inserted_date', 'MONTH_RATIO', 'RT', 'ACP', 'IT', 'DII', 'PT', 'APP', 'NWP', 'CR', 'QR', 'DTE', 'DTA', 'IC','GPM','OPM', 'NPM',

			'ROI', 'ROE', 'consultantFiles', 'MASinvestors', 'obtainDate', 'Panama', 'Paradise', 'Offshore', 'Bahamas','response_youtube','response_theweb'));

		//$pdf->download($company_data->company_name . '.pdf');
		//sleep(5);

		if($ok == true){
		return redirect('/monitoring/list')->with('status', 'You have successfully subscribe to the report.');
		} else {
		return $pdf->download($company_data->company_name . '.pdf');	
		}	
	
		// return $pdf->download('.pdf');

	}

	public static function curlER($twitter_token, $twitter_keyword, $sm='Twitter')
	{
		$cSession = curl_init(); 
		$apiURL = 'https://reputation.app-prokakis.com/api/v1/mentions-tosearch?_token='.$twitter_token.'&selected_sm='.urlencode($sm).'&search_keyword_selections='.urlencode($twitter_keyword);
		//echo $apiURL .'<br />'; 
		curl_setopt($cSession,CURLOPT_URL, $apiURL);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		$response_twitter = json_decode($result);
		curl_close($cSession);
		return $response_twitter;
	}

	

	//aml refinitive data
	public function repAml(Request $request)
	{	
		if(isset($request['rpId'])){
		
			$user_id = Auth::id();
			
			$rpId = $request['rpId'];
			$res = explode('-', $rpId);
			$repId = base64_decode($res[0]);
			$rs = ProcessedReport::find($repId);

			$today = strtotime(date("Y-m-d"));

			if (isset($rs->month_subscription_start) && isset($rs->month_subscription_end)) {
				$dStart = strtotime($rs->month_subscription_start);
				$dEnd = strtotime($rs->month_subscription_end);
				if ($today < $dStart) {
					return redirect('/monitoring/list')->with('message', 'Download link subscription has not started.');
					exit;
				}
				if ($today > $dEnd) {

					return redirect('/monitoring/list')->with('message', 'Download link subscription has ended.');
					exit;
				}
			}

			if($rs != null){
			   
				$session_companyID = CompanyProfile::getCompanyId($user_id);

		    	//echo $session_companyID .' - ' . $rs->requester_company_id . ' - ' .$rs->source_company_id ;
				if($session_companyID != $rs->requester_company_id){
				 return redirect('/opportunity/explore')->with('message', 'Company ID as the requester does not matched to your current.');
				 exit;

				} else {
				//generate report here

				$company_data = CompanyProfile::find($rs->source_company_id);

				$ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
				$reportTemplates = [];

				$conApproved = ConsultantProjects::where('request_approval_id', $rs->approval_id)->where('project_status', 'DONE')->first();
				$dateConDone = $conApproved->updated_at;	

				$date=date_create($dateConDone);
				$dateDone = date_format($date,"F j, Y"); //, g:i a

				foreach ($ReportGenerationTemplate as $key => $value) {
					$reportTemplates[ $value['variable_name'] ]  = $value['content'];
				}

				$approval = RequestApproval::find($rs->approval_id)->first(); //approval records

				//----Thomson Reuters data------//
				$count_tr = TR_reportgeneration::where('request_id', $approval->req_rep_id)->count(); //count the records
				$tr_peps = array();
				$tr_inserted_date = date("F j, Y", $today);

				$tr_peps_create_date = '';
				$tr_inserted_date = '';
				if($count_tr > 0)
				{
					$rs_tr = TR_reportgeneration::where('request_id', $approval->req_rep_id)->get();
					foreach($rs_tr as $d)
					{
						$tr_peps[] = ThomsonReuters::searchAllThree($d->uid);
						$tr_peps_create_date  = $d->created_at;
					}

					if($tr_peps_create_date != ''){
					$timestamp_tr = strtotime($tr_peps_create_date);
					$tr_inserted_date = date("F j, Y", $timestamp_tr);
					}
				}

				$pdf = PDF::loadView('buyreport.aml_PDF', compact('company_data','reportTemplates','dateDone', 'tr_peps', 'tr_inserted_date'));
				return $pdf->download('AML_'.$company_data->company_name . '.pdf');

				}

			} 

		}
	}

	//investors alert
	public function repIa(Request $request)
	{
		if(isset($request['rpId'])){
		
			$user_id = Auth::id();
			
			$rpId = $request['rpId'];
			$res = explode('-', $rpId);
			$repId = base64_decode($res[0]);
			$rs = ProcessedReport::find($repId);

			$today = strtotime(date("Y-m-d"));

			if (isset($rs->month_subscription_start) && isset($rs->month_subscription_end)) {
				$dStart = strtotime($rs->month_subscription_start);
				$dEnd = strtotime($rs->month_subscription_end);
				if ($today < $dStart) {
					return redirect('/monitoring/list')->with('message', 'Download link subscription has not started.');
					exit;
				}
				if ($today > $dEnd) {

					return redirect('/monitoring/list')->with('message', 'Download link subscription has ended.');
					exit;
				}
			}

			if($rs != null){
			   
				$session_companyID = CompanyProfile::getCompanyId($user_id);

		    	//echo $session_companyID .' - ' . $rs->requester_company_id . ' - ' .$rs->source_company_id ;
				if($session_companyID != $rs->requester_company_id){
				 return redirect('/opportunity/explore')->with('message', 'Company ID as the requester does not matched to your current.');
				 exit;

				} else {
				//generate report here

				$company_data = CompanyProfile::find($rs->source_company_id);
				$ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
				$reportTemplates = [];

				$conApproved = ConsultantProjects::where('request_approval_id', $rs->approval_id)->where('project_status', 'DONE')->first();
				$dateConDone = $conApproved->updated_at;	

				$date=date_create($dateConDone);
				$dateDone = date_format($date,"F j, Y"); //, g:i a

				foreach ($ReportGenerationTemplate as $key => $value) {
					$reportTemplates[ $value['variable_name'] ]  = $value['content'];
				}

				$approval = RequestApproval::find($rs->approval_id)->first(); //approval records
				//Filters Here
				
				//MAS investors
				$MASinvestors = BuyReport::findMatchedMAS($company_data->company_name);

				//check Panamas, Bahamas, Offshore, Paradise
				$Panama = BuyReport::searchMatchInPanama($company_data->company_name);
				$Paradise = BuyReport::searchMatchInParadise($company_data->company_name);
				$Offshore = BuyReport::searchMatchInOffShore($company_data->company_name);
				$Bahamas = BuyReport::searchMatchInBahamas($company_data->company_name);

				$pdf = PDF::loadView('buyreport.ia_PDF',compact('company_data', 'reportTemplates', 'dateDone', 'MASinvestors', 'Panama', 'Paradise','Offshore', 'Bahamas'));
				//dd($pdf->output());
				return $pdf->download('IA_'.$company_data->company_name . '.pdf');

				}

			} 

		}

	}

	//adverse media
	public function repAm(Request $request)
	{
		if(isset($request['rpId'])){
		
			$user_id = Auth::id();
			
			$rpId = $request['rpId'];
			$res = explode('-', $rpId);
			$repId = base64_decode($res[0]);
			$rs = ProcessedReport::find($repId);

			$today = strtotime(date("Y-m-d"));

			if (isset($rs->month_subscription_start) && isset($rs->month_subscription_end)) {
				$dStart = strtotime($rs->month_subscription_start);
				$dEnd = strtotime($rs->month_subscription_end);
				if ($today < $dStart) {
					return redirect('/monitoring/list')->with('message', 'Download link subscription has not started.');
					exit;
				}
				if ($today > $dEnd) {

					return redirect('/monitoring/list')->with('message', 'Download link subscription has ended.');
					exit;
				}
			}

			if($rs != null){
			   
				$session_companyID = CompanyProfile::getCompanyId($user_id);

				if($session_companyID != $rs->requester_company_id){
				 return redirect('/opportunity/explore')->with('message', 'Company ID as the requester does not matched to your current.');
				 exit;

				} else {
				//generate report here

					$company_data = CompanyProfile::find($rs->source_company_id);
					$ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
					$reportTemplates = [];

					$conApproved = ConsultantProjects::where('request_approval_id', $rs->approval_id)->where('project_status', 'DONE')->first();
					$dateConDone = $conApproved->updated_at;	

					$date=date_create($dateConDone);
					$dateDone = date_format($date,"F j, Y"); //, g:i a

					foreach ($ReportGenerationTemplate as $key => $value) {
						$reportTemplates[ $value['variable_name'] ]  = $value['content'];
					}
					//var_dump($reportTemplates); exit;

					$approval = RequestApproval::find($rs->approval_id)->first(); //approval records
					$twitter_token = date('YmdHis');
					$twitter_keyword = $company_data->company_name;
					
					//Social Media
					$response_twitter = BuyReport::curlER($twitter_token, $twitter_keyword, $sm='Twitter');
					$response_youtube = BuyReport::curlER($twitter_token, $twitter_keyword, $sm='Youtube');
					$response_theweb = BuyReport::curlER($twitter_token, $twitter_keyword, $sm='The Web');

					$pdf = PDF::loadView('buyreport.adm_PDF',compact('company_data','reportTemplates', 'dateDone', 'response_twitter', 'response_youtube', 'response_theweb'));

					//dd($pdf->output());
					return $pdf->download('ADM_'.$company_data->company_name . '.pdf');

				}

			} 

		}

	}

	public function downloadAll(Request $request)
	{

		if(isset($request['rpId']))
		{

			$user_id = Auth::id();
			$rpId = $request['rpId'];
			$res = explode('-', $rpId);
			$repId = base64_decode($res[0]);
			$rs = ProcessedReport::find($repId);
			$today = strtotime(date("Y-m-d"));

				if (isset($rs->month_subscription_start) && isset($rs->month_subscription_end)) 
				{
					$dStart = strtotime($rs->month_subscription_start);
					$dEnd = strtotime($rs->month_subscription_end);
					if ($today < $dStart) {
						return redirect('/monitoring/list')->with('message', 'Download link subscription has not started.');
						exit;
					}
					if ($today > $dEnd) {
						return redirect('/monitoring/list')->with('message', 'Download link subscription has ended.');
						exit;
					}
				}

			    if($rs != null){
			   
				$session_companyID = CompanyProfile::getCompanyId($user_id);

					if($session_companyID != $rs->requester_company_id){
					return redirect('/opportunity/explore')->with('message', 'Company ID as the requester does not matched to your current.');
					exit;

					} else {

					   //mkdir(public_path('report_downloads/'.$repId));	
					   if (!file_exists(public_path('report_downloads/'.$repId))) {

						mkdir(public_path('report_downloads/'.$repId), 0777, true);
					
							//Things to do, generate report here
							//1st report ADM
							BuyReport::getADM($rs, $repId);

							//2nd report IA
							BuyReport::getIA($rs, $repId);	
							
							//3rd report AML
							BuyReport::getAML($rs, $repId);	
								
							//4th report OVERVIEW
							//BuyReport::getCompanyOverview($rs, $user_id, $repId);	

							//merge all into a 1 zip file
							$zip = new ZipArchive;
							//echo 'cant call zip'; exit;
							$fileName = $repId.'_download_all.zip';
								
							if ($zip->open(public_path('report_downloads/'.$fileName), ZipArchive::CREATE) === TRUE)
							{
								$files = File::files(public_path('report_downloads/'.$repId));
					
								foreach ($files as $key => $value) {
									$relativeNameInZipFile = basename($value);
									$zip->addFile($value, $relativeNameInZipFile);
								}
								
								$zip->close();
							}	
						
							return response()->download(public_path('report_downloads/'.$fileName));


						} else {

							if (file_exists(public_path('report_downloads/'.$repId.'_download_all.zip'))) {
							return response()->download(public_path('report_downloads/'.$repId.'_download_all.zip'));
							}
							
						}		

					}

		   		}

		}
	}

	

}