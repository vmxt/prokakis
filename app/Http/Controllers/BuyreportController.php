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

			$pdf = PDF::loadView('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

				'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

				'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

				'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons'));

			//--------------

			//return $pdf->download($company_data->company_name. '.pdf');

			//exit;

			//--------------

			if ($pdf) {

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

						return $pdf->download($company_data->company_name . '.pdf');

					}

				} else {

					return redirect('/reports/status')->with('message', 'There is no approval record for this request.');

					exit;

				}

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

					return BuyreportController::generateReportDownload($ra_processed);

				}

			}

		}

	}

	public static function generateReportDownload($proc) {

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

		$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();

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
		$cSession = curl_init(); 
		curl_setopt($cSession,CURLOPT_URL,'https://reputation.prokakis.com/api/v1/mentions-tosearch?_token='.$twitter_token.'&selected_sm=+Twitter++&search_keyword_selections='.$twitter_keyword);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		$response_twitter = json_decode($result);
		curl_close($cSession);

		 // return view('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			//       'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			//       'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			//       'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons', 'reportTemplates', 'response_twitter' , 'reportTrackNumber'));

			  

		$pdf = PDF::loadView('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons', 'reportTemplates', 'response_twitter','reportTrackNumber'));

		return $pdf->download($company_data->company_name . '.pdf');

		// return $pdf->download('.pdf');

	}

}