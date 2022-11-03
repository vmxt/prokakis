<?php

namespace App\Http\Controllers;

use App\AuditLog;
use App\BrandSlogan;
use App\BusinessOpportunitiesNews;
use App\CompanyBilling;
use App\CompanyProfile;
use App\Configurations;
use App\ConsultantProjects;
use App\Countries;
use App\Currency;
use App\FinancialAnalysis;
use App\Http\Controllers\Controller;
use App\KeyManagement;
use App\ThomsonReuters;
use App\UploadImages;
use App\User;
use Auth;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\ProkakisAccessToken;
use GuzzleHttp\Client;
class CompanyprofileController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		$this->middleware('auth');
	    $this->urlToken  = ProkakisAccessToken::getSCode();
	}

	public function uploadBannerFile(Request $request) {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				if ($request->hasfile('uploadBanner')) {

					$file = $request->file('uploadBanner');

					$name = $user_id . '_' . time() . '_' . $file->getClientOriginalName();

					$file->move(public_path() . '/banner/', $name);

					UploadImages::create([

						'company_id' => $company_id_result,

						'user_id' => $user_id,

						'file_category' => Config::get('constants.options.banner'),

						'file_source' => public_path() . '/banner/' . $name,

						'file_name' => $name,

						'orig_filename' => $file->getClientOriginalName(),

						'added_by' => $user_id,

						'status' => '1',

					]);

					AuditLog::ok(array($user_id, 'profile', 'upload banner', 'banner name:' . $name));

				}

				$brand = $request->input('uploadBannerBrand');

				$slogan = $request->input('uploadBannerSlogan');

				BrandSlogan::processUserAndCompanyIds($user_id, $company_id_result, $brand, $slogan);

			}

		} else {

			echo 'restricted';

		}

	}

	public function viewUser(Request $request) {

		if ($request->isMethod('post')) {

			$user_id = $request->input('userId');

			//echo $user_id; exit;

			
			$company_id_result = CompanyProfile::getCompanyId($user_id);

			return CompanyprofileController::view_summary($company_id_result);

			

		} else {

			return redirect('home');

		}

	}

	public function viewer(Request $request) {

		if (User::securePage(Auth::id()) == 1) {

			return redirect('home')->with('message', 'Page is restricted.');

			exit;

		}

		if (isset($request['companyId'])) {

			$company_id = $request['companyId'];

			//checks the authority of the consultants to view company profile

			if (ConsultantProjects::validateConsultantAccessByProject(Auth::id(), $company_id) != true) {

				return redirect('/consultants/ongoing-projects')->with('message', 'Page is restricted, you must be the assigned consultant.');

				exit;

			}

			$company_data = CompanyProfile::find($company_id);

			if ($company_data != null) {

				return CompanyprofileController::view_summary($company_id);

			}

		}

	}
	
	public function view_profile(Request $request) {
	    
		//echo $user_id; exit;

		$company_id_result = $request["key"];

		$company_data = CompanyProfile::find($company_id_result);
		$user_id = $company_data->user_id;

		// if($company_data == null){

		//  return redirect('home')->with('message', 'You are restricted to open profile section, please check with the administrator.');

		// } else {

		//from system configuration

		$num_of_employee = Configurations::getJsonValue('num_of_employee');

		$estimated_sales = Configurations::getJsonValue('estimated_sales');

		//$currency = Configurations::getJsonValue('currency');

		$ownership_status = Configurations::getJsonValue('ownership_status');

		$business_type = Configurations::getJsonValue('business_type');

		$business_industry = Configurations::getJsonValue('business_industry');

		$no_of_staff = Configurations::getJsonValue('no_of_staff');

		$financial_year = Configurations::getJsonValue('financial_year');

		$financial_month = Configurations::getJsonValue('financial_month');

		$countries = Configurations::getJsonValue('countries');

		$year_founded = Configurations::getJsonValue('year_founded');

		$years_establishment = Configurations::getJsonValue('years_establishment');

		$currency = Currency::all();

		$gross_profit_loss = Configurations::getJsonValue('gross_profit_loss');

		$net_profit_loss = Configurations::getJsonValue('net_profit_loss');

		$filling_rate = Configurations::getJsonValue('filling_rate');

		$asset_more_liability = Configurations::getJsonValue('asset_more_liability');

		$paid_up_capital = Configurations::getJsonValue('paid_up_capital');

		$countries = Countries::all();

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

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

		$viewer = base64_encode($brand_slogan[0]);
		$urlFB = url('/fbshare'. '/' . $company_id_result . '/'.$viewer);
		
		$urlPreview = url('company/'.$company_id_result);

		//$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();
		$keyPersons = KeyManagement::where('user_id', $user_id)->where('company_id', $company_id_result)->where('status', 1)->get();
	

		//$businessNewsOpportunity = BusinessOpportunitiesNews::where('user_id',$user_id)->where('company_id', $company_id_result)->first();

		$businessNewsOpportunity = BusinessOpportunitiesNews::orderBy('updated_at','desc')->limit(10)->get();

		return view('profile.profileview', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			'profileCertifications', 'completenessProfile', 'profileCoverPhoto',

			'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons',

			'user_id', 'businessNewsOpportunity', 'urlPreview', 'company_id_result', 'user_id'));

		//}

	}

	public function view(Request $request) {

		$user_id = Auth::id();

		//echo $user_id; exit;

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		$company_data = CompanyProfile::find($company_id_result);

		// if($company_data == null){

		//  return redirect('home')->with('message', 'You are restricted to open profile section, please check with the administrator.');

		// } else {

		//from system configuration

		$num_of_employee = Configurations::getJsonValue('num_of_employee');

		$estimated_sales = Configurations::getJsonValue('estimated_sales');

		//$currency = Configurations::getJsonValue('currency');

		$ownership_status = Configurations::getJsonValue('ownership_status');

		$business_type = Configurations::getJsonValue('business_type');

		$business_industry = Configurations::getJsonValue('business_industry');

		$no_of_staff = Configurations::getJsonValue('no_of_staff');

		$financial_year = Configurations::getJsonValue('financial_year');

		$financial_month = Configurations::getJsonValue('financial_month');

		$countries = Configurations::getJsonValue('countries');

		$year_founded = Configurations::getJsonValue('year_founded');

		$years_establishment = Configurations::getJsonValue('years_establishment');

		$currency = Currency::all();

		$gross_profit_loss = Configurations::getJsonValue('gross_profit_loss');

		$net_profit_loss = Configurations::getJsonValue('net_profit_loss');

		$filling_rate = Configurations::getJsonValue('filling_rate');

		$asset_more_liability = Configurations::getJsonValue('asset_more_liability');

		$paid_up_capital = Configurations::getJsonValue('paid_up_capital');

		$countries = Countries::all();

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

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

		$viewer = base64_encode($brand_slogan[0]);
		$urlFB = url('/fbshare'. '/' . $company_id_result . '/'.$viewer);
		
		$urlPreview = url('company/'.$company_id_result);

		//$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();
		$keyPersons = KeyManagement::where('user_id', $user_id)->where('company_id', $company_id_result)->where('status', 1)->get();
	

		//$businessNewsOpportunity = BusinessOpportunitiesNews::where('user_id',$user_id)->where('company_id', $company_id_result)->first();

		$businessNewsOpportunity = BusinessOpportunitiesNews::orderBy('updated_at','desc')->limit(10)->get();

		return view('profile.view', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			'profileCertifications', 'completenessProfile', 'profileCoverPhoto',

			'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons',

			'user_id', 'businessNewsOpportunity', 'urlPreview'));

		//}

	}


	public static function view_summary($company_id_result){

		$company_data = CompanyProfile::find($company_id_result);

		$user_id = $company_data->user_id;

		$num_of_employee = Configurations::getJsonValue('num_of_employee');

		$estimated_sales = Configurations::getJsonValue('estimated_sales');

		//$currency = Configurations::getJsonValue('currency');

		$ownership_status = Configurations::getJsonValue('ownership_status');

		$business_type = Configurations::getJsonValue('business_type');

		$business_industry = Configurations::getJsonValue('business_industry');

		$no_of_staff = Configurations::getJsonValue('no_of_staff');

		$financial_year = Configurations::getJsonValue('financial_year');

		$financial_month = Configurations::getJsonValue('financial_month');

		$countries = Configurations::getJsonValue('countries');

		$year_founded = Configurations::getJsonValue('year_founded');

		$years_establishment = Configurations::getJsonValue('years_establishment');

		$currency = Currency::all();

		$gross_profit_loss = Configurations::getJsonValue('gross_profit_loss');

		$net_profit_loss = Configurations::getJsonValue('net_profit_loss');

		$filling_rate = Configurations::getJsonValue('filling_rate');

		$asset_more_liability = Configurations::getJsonValue('asset_more_liability');

		$paid_up_capital = Configurations::getJsonValue('paid_up_capital');

		$countries = Countries::all();

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

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

		$viewer = base64_encode($brand_slogan[0]);
		$urlFB = url('/fbshare'. '/' . $company_id_result . '/'.$viewer);
		
		$urlPreview = url('company/'.$company_id_result);

	
		$keyPersons = KeyManagement::where('user_id', $user_id)->where('company_id', $company_id_result)->where('status', 1)->get();
	

		//$businessNewsOpportunity = BusinessOpportunitiesNews::where('user_id',$user_id)->where('company_id', $company_id_result)->first();

		$businessNewsOpportunity = BusinessOpportunitiesNews::orderBy('updated_at','desc')->limit(10)->get();

		return view('profile.view', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			'profileCertifications', 'completenessProfile', 'profileCoverPhoto',

			'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons',

			'user_id', 'businessNewsOpportunity', 'urlPreview'));

	}


	/**

	 * Show the application dashboard.

	 *

	 * @return \Illuminate\Http\Response

	 */
	 
	 public function processPDF(Request $request) {
	     if ($request->isMethod('post')) {
	        $user_id = Auth::id();

    		//echo $user_id; exit;
    		
    		$company_id_result = CompanyProfile::getCompanyId($user_id);

		$company_data = CompanyProfile::find($company_id_result);
    
    		$num_of_employee = Configurations::getJsonValue('num_of_employee');

		$estimated_sales = Configurations::getJsonValue('estimated_sales');

		//$currency = Configurations::getJsonValue('currency');

		$ownership_status = Configurations::getJsonValue('ownership_status');

		$business_type = Configurations::getJsonValue('business_type');

		$business_industry = Configurations::getJsonValue('business_industry');

		$no_of_staff = Configurations::getJsonValue('no_of_staff');

		$financial_year = Configurations::getJsonValue('financial_year');

		$financial_month = Configurations::getJsonValue('financial_month');

		// $countries = Configurations::getJsonValue('countries');

		$years_establishment = Configurations::getJsonValue('years_establishment');

		$currency = Currency::all();

		$gross_profit_loss = Configurations::getJsonValue('gross_profit_loss');

		$net_profit_loss = Configurations::getJsonValue('net_profit_loss');

		$filling_rate = Configurations::getJsonValue('filling_rate');

		$asset_more_liability = Configurations::getJsonValue('asset_more_liability');

		$paid_up_capital = Configurations::getJsonValue('paid_up_capital');

		$countries = Countries::all();

		$year_founded = Configurations::getJsonValue('year_founded');

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

		$profileAwards = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.awards'), 5);

		$profilePurchaseInvoice = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.purchase_invoices'), 5);

		$profileSalesInvoice = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.sales_invoices'), 5);

		$profileCertifications = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.certification'), 5);

		$completenessProfile = CompanyProfile::profileCompleteness(array($company_data, $profileAvatar, $profileAwards,

			$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

		$completenessMessages = CompanyProfile::profileStrengthMessages(array($company_data, $profileAvatar, $profileAwards,

			$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

		//$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();
		$keyPersons = KeyManagement::where('user_id', $user_id)->where('company_id', $company_id_result)->where('status', 1)->get();


		$param_months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');

		$param_years = array();

		$max_year = date('Y');

		for ($i = (int) $max_year; $i >= 1900; $i--) {$param_years[] = $i;}
    
    		if ($request->hasfile('attachment_file')) {
    
        		$file = $request->file('attachment_file');
    			$name = $user_id . '_custom_pdf.pdf';
    			$file->move(public_path() . '/custom_pdf_upload/', $name);
    			$filePathCsv =  asset('public/custom_pdf_upload/'.$name);
    						
    			$file = fopen($filePathCsv, "r") or die(" $filePathCsv file is not there! \n");
    			
    			if($file){
    			    
                    $client = new \GuzzleHttp\Client();
                    try {
                        $r = $client->request('POST', 'https://api.ocr.space/parse/image',[
                            'headers' => ['apiKey' => 'd1a152930888957'],
                            'multipart' => [
                                [
                                    'name' => 'file',
                                    'contents' => $file
                                ]
                            ]
                        ], ['file' => $file]);
                        
                        
                        $response =  json_decode($r->getBody(),true);
                        
                        //echo $response->ParsedResults;
                        //echo (is_array($response)) ? $response["ParsedResults"] : $response->ParsedResults;
                        
                        //if($response->ErrorMessage == "") {
                            
                            return view('profile.customupload', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',
        
                			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',
                
                			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',
                
                			'profileCertifications', 'completenessProfile', 'user_id', 'keyPersons', 'years_establishment',
                
                			'gross_profit_loss', 'net_profit_loss', 'filling_rate', 'asset_more_liability', 'paid_up_capital',
                
                			'param_months', 'param_years', 'completenessMessages', 'response')); 
                			//echo "yessss";
                        //}
        			
        			} catch(Exception $err) {
                        echo $err->getMessage();
                    }
    			}
    			
    	    }
	        
	     }
	     else{
	         echo "stop!";
	     }
	}

	public function edit() {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId(Auth::id());

		$company_data = CompanyProfile::find($company_id_result);

		// if($company_data == null){

		//   return redirect('home')->with('message', 'You are restricted to open other profile, please check with the administrator.');

		// } else {

		//from system configuration

		$num_of_employee = Configurations::getJsonValue('num_of_employee');

		$estimated_sales = Configurations::getJsonValue('estimated_sales');

		//$currency = Configurations::getJsonValue('currency');

		$ownership_status = Configurations::getJsonValue('ownership_status');

		$business_type = Configurations::getJsonValue('business_type');

		$business_industry = Configurations::getJsonValue('business_industry');

		$no_of_staff = Configurations::getJsonValue('no_of_staff');

		$financial_year = Configurations::getJsonValue('financial_year');

		$financial_month = Configurations::getJsonValue('financial_month');

		// $countries = Configurations::getJsonValue('countries');

		$years_establishment = Configurations::getJsonValue('years_establishment');

		$currency = Currency::all();

		$gross_profit_loss = Configurations::getJsonValue('gross_profit_loss');

		$net_profit_loss = Configurations::getJsonValue('net_profit_loss');

		$filling_rate = Configurations::getJsonValue('filling_rate');

		$asset_more_liability = Configurations::getJsonValue('asset_more_liability');

		$paid_up_capital = Configurations::getJsonValue('paid_up_capital');

		$countries = Countries::all();

		$year_founded = Configurations::getJsonValue('year_founded');

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

		$profileAwards = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.awards'), 5);

		$profilePurchaseInvoice = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.purchase_invoices'), 5);

		$profileSalesInvoice = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.sales_invoices'), 5);

		$profileCertifications = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.certification'), 5);

		$completenessProfile = CompanyProfile::profileCompleteness(array($company_data, $profileAvatar, $profileAwards,

			$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

		$completenessMessages = CompanyProfile::profileStrengthMessages(array($company_data, $profileAvatar, $profileAwards,

			$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

		//$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();
		$keyPersons = KeyManagement::where('user_id', $user_id)->where('company_id', $company_id_result)->where('status', 1)->get();


		$param_months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');

		$param_years = array();

		$max_year = date('Y');

		for ($i = (int) $max_year; $i >= 1900; $i--) {$param_years[] = $i;}

		return view('profile.edit', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			'profileCertifications', 'completenessProfile', 'user_id', 'keyPersons', 'years_establishment',

			'gross_profit_loss', 'net_profit_loss', 'filling_rate', 'asset_more_liability', 'paid_up_capital',

			'param_months', 'param_years', 'completenessMessages'));

		// }

	}

	//saving data
	
	public function getFinancialEntriesDataInputs(Request $request){
	    
	    $user_id = Auth::id();
	    $company_id_result = CompanyProfile::getCompanyId(Auth::id());
	    
	    $month_now = $request["months"];
	    $year_now = $request["year"];
	    
	    $month_in1 = "";
                                                $month_in2 = "";
                                                $month_in3 = "";
                                                $month_in4 = "";
                                                
                                                if($month_now == "1234"){
                                                    $month_in1 = "1";
                                                    $month_in2 = "2";
                                                    $month_in3 = "3";
                                                    $month_in4 = "4";
                                                }
                                                
                                                if($month_now == "5678"){
                                                    $month_in1 = "5";
                                                    $month_in2 = "6";
                                                    $month_in3 = "7";
                                                    $month_in4 = "8";
                                                }
                                                
                                                if($month_now == "9101112"){
                                                    $month_in1 = "9";
                                                    $month_in2 = "10";
                                                    $month_in3 = "11";
                                                    $month_in4 = "12";
                                                }
	    
	    
	    $entry1 = FinancialAnalysis::select(
	        "year_param", "month_param", "income", "purchase", "cost_goodsold_costsales", "gross_profit",
	        "directors_fee_renum", "totalrenum_exdirector_feerenum", "medical_expenses", "transport_traveling_expenses",
	        "entertainment_expenses", "debt_interest_finance_expenses", "net_profit", "net_profit_before_interest_tax_ebit",
	        "inventories_closing_stock", "trade_receivable", "trade_payable", "non_current_assets", "current_assets",
	        "current_liabilities", "non_current_liabilities", "share_capital", "retained_earning", "translation_reserves", "total_debt", "prepaid_expenses"
	        )->
	        where('entry', 1)->where('company_id',  $company_id_result)->where('user_id', $user_id)
                                                ->where("year_param", "=", $year_now)
                                                ->where("month_param", "=", $month_in1)
                                                ->first();
                                                

                                                $entry2 = FinancialAnalysis::select(
	        "year_param", "month_param", "income", "purchase", "cost_goodsold_costsales", "gross_profit",
	        "directors_fee_renum", "totalrenum_exdirector_feerenum", "medical_expenses", "transport_traveling_expenses",
	        "entertainment_expenses", "debt_interest_finance_expenses", "net_profit", "net_profit_before_interest_tax_ebit",
	        "inventories_closing_stock", "trade_receivable", "trade_payable", "non_current_assets", "current_assets",
	        "current_liabilities", "non_current_liabilities", "share_capital", "retained_earning", "translation_reserves", "total_debt", "prepaid_expenses"
	        )->
                                                    where('entry', 2)->where('company_id',  $company_id_result)->where('user_id', $user_id)
                                                ->where("year_param", "=", $year_now)
                                                ->where("month_param", "=", $month_in2)
                                                ->first();

                                                $entry3 = FinancialAnalysis::select(
	        "year_param", "month_param", "income", "purchase", "cost_goodsold_costsales", "gross_profit",
	        "directors_fee_renum", "totalrenum_exdirector_feerenum", "medical_expenses", "transport_traveling_expenses",
	        "entertainment_expenses", "debt_interest_finance_expenses", "net_profit", "net_profit_before_interest_tax_ebit",
	        "inventories_closing_stock", "trade_receivable", "trade_payable", "non_current_assets", "current_assets",
	        "current_liabilities", "non_current_liabilities", "share_capital", "retained_earning", "translation_reserves", "total_debt", "prepaid_expenses"
	        )->
                                                    where('entry', 3)->where('company_id',  $company_id_result)->where('user_id', $user_id)
                                                ->where("year_param", "=", $year_now)
                                                ->where("month_param", "=", $month_in3)
                                                ->first();

                                                $entry4 = FinancialAnalysis::select(
	        "year_param", "month_param", "income", "purchase", "cost_goodsold_costsales", "gross_profit",
	        "directors_fee_renum", "totalrenum_exdirector_feerenum", "medical_expenses", "transport_traveling_expenses",
	        "entertainment_expenses", "debt_interest_finance_expenses", "net_profit", "net_profit_before_interest_tax_ebit",
	        "inventories_closing_stock", "trade_receivable", "trade_payable", "non_current_assets", "current_assets",
	        "current_liabilities", "non_current_liabilities", "share_capital", "retained_earning", "translation_reserves", "total_debt", "prepaid_expenses"
	        )->
                                                    where('entry', 4)->where('company_id',  $company_id_result)->where('user_id', $user_id)
                                                ->where("year_param", "=", $year_now)
                                                ->where("month_param", "=", $month_in4)
                                                ->first();
                                                
        $entry1_data = [];
        $entry2_data = [];
        $entry3_data = [];
        $entry4_data = [];
        
        if($entry1){
            foreach ($entry1->toArray() as $col_column => $col_value){
                $entry1_data[$col_column] = $col_value;
            }
	    }
	    
	    if($entry2){
            foreach ($entry2->toArray() as $col_column => $col_value){
                $entry2_data[$col_column] = $col_value;
            }
	    }
	    
	    if($entry3){
            foreach ($entry3->toArray() as $col_column => $col_value){
                $entry3_data[$col_column] = $col_value;
            }
	    }
	    
	    if($entry4){
            foreach ($entry4->toArray() as $col_column => $col_value){
                $entry4_data[$col_column] = $col_value;
            }
	    }
        
        $entry1_final = json_encode($entry1_data);
        $entry2_final = json_encode($entry2_data);
        $entry3_final = json_encode($entry3_data);
        $entry4_final = json_encode($entry4_data);
        
        return $entry1_final . "<split>" . $entry2_final . "<split>" . $entry3_final . "<split>" . $entry4_final;
	}
	
	public function getFinancialEntriesData_viewProfile(Request $request){
	    
	    //DB::getSchemaBuilder()->getColumnListing($table);
	    $user_id = $request["user_id"];
	    $company_id_result = $request["company_id"];
	    
	    //$month_now = $request["months"];
	    //$year_now = $request["year"];
	    
	    
	    $data = "[";
	    
	    $get_col_names = FinancialAnalysis::select("income", "purchase", "cost_goodsold_costsales", "gross_profit",
	        "directors_fee_renum", "totalrenum_exdirector_feerenum", "medical_expenses", "transport_traveling_expenses",
	        "entertainment_expenses", "debt_interest_finance_expenses", "net_profit", "net_profit_before_interest_tax_ebit",
	        "inventories_closing_stock", "trade_receivable", "trade_payable", "non_current_assets", "current_assets",
	        "current_liabilities", "non_current_liabilities", "share_capital", "retained_earning", "translation_reserves", "total_debt", "prepaid_expenses")->where('company_id',  $company_id_result)->where('user_id', $user_id)->first();
	    
	    
	    
	        foreach ($get_col_names->toArray() as $col_column => $col_value){
	            ////////////////
        	    $entry = FinancialAnalysis::select($col_column)->where('company_id',  $company_id_result)->where('user_id', $user_id)
        	    /*->where("year_param", "=", $year_now)
        	    
        	    ->where(function ($query) use ( $month_now) {
    			    
    			    if($month_now == "1234"){
            	        $query->whereIn('month_param', [1, 2, 3, 4]);
            	    }
            	    
            	    if($month_now == "5678"){
            	        $query->whereIn('month_param', [5, 6, 7, 8]);
            	    }
            	    
            	    if($month_now == "9101112"){
            	        $query->whereIn('month_param', [9, 10, 11, 12]);
            	    }
    			})*/
    			->orderBy("entry","asc")
        	    ->get();
        	    
        	    if(!$entry->isEmpty()){
        	        
        	        $this_data = "";
        	        $this_val = 0;
        	    
            	    $this_data .= '{data:[';
            	    
            	    $count= 0;
            	    $col_name = "";
            	    foreach($entry as $entry_data){
            	        foreach ($entry_data->toArray() as $column => $value){
            	            $this_data .= '['.$count.', '.$value.'],';
            	            $col_name = $column;
            	            
            	            $this_val += $value;
            	        }
            	        
            	        $count++;
            	    }
            	    
            	    if($col_name == "income"){
            	        $col_name = "Income";
            	    }
            	    if($col_name == "purchase"){
            	        $col_name = "Purchase";
            	    }
            	    if($col_name == "cost_goodsold_costsales"){
            	        $col_name = "Cost of Goods Sold / Cost of Sales";
            	    }
            	    if($col_name == "gross_profit"){
            	        $col_name = "Gross Profit";
            	    }
            	    if($col_name == "directors_fee_renum"){
            	        $col_name = "Directors’ Fees & Remuneration";
            	    }
            	    if($col_name == "totalrenum_exdirector_feerenum"){
            	        $col_name = "Total Remuneration excluding Directors’ Fees and Remuneration";
            	    }
            	    if($col_name == "medical_expenses"){
            	        $col_name = "Medical Expenses";
            	    }
            	    if($col_name == "transport_traveling_expenses"){
            	        $col_name = "Transport/Travelling Expenses";
            	    }
            	    if($col_name == "entertainment_expenses"){
            	        $col_name = "Entertainment Expenses";
            	    }
            	    if($col_name == "debt_interest_finance_expenses"){
            	        $col_name = "Debt Interest/Finance Expense";
            	    }
            	    if($col_name == "net_profit"){
            	        $col_name = "Net Profit";
            	    }
            	    if($col_name == "net_profit_before_interest_tax_ebit"){
            	        $col_name = "Net Profit Before Interest and Tax (EBIT)";
            	    }
            	    if($col_name == "inventories_closing_stock"){
            	        $col_name = "Inventories (Closing Stock)";
            	    }
            	    if($col_name == "trade_receivable"){
            	        $col_name = "Trade Receivable";
            	    }
            	    if($col_name == "trade_payable"){
            	        $col_name = "Trade Payable";
            	    }
            	    if($col_name == "non_current_assets"){
            	        $col_name = "Non-Current Assets";
            	    }
            	    if($col_name == "current_assets"){
            	        $col_name = "Current Assets";
            	    }
            	    if($col_name == "current_liabilities"){
            	        $col_name = "Current Liabilities";
            	    }
            	    if($col_name == "non_current_liabilities"){
            	        $col_name = "Non-current Liabilities";
            	    }
            	    if($col_name == "share_capital"){
            	        $col_name = "Share Capital";
            	    }
            	    if($col_name == "retained_earning"){
            	        $col_name = "Retained Earning";
            	    }
            	    if($col_name == "translation_reserves"){
            	        $col_name = "Translation Reserves";
            	    }
            	    if($col_name == "total_debt"){
            	        $col_name = "Total Debt";
            	    }
            	    if($col_name == "prepaid_expenses"){
            	        $col_name = "Prepaid Expenses";
            	    }
            	    
            	    $this_data .= '],
            	    canvasRender: true,
            	    lines: {
                        show: true
                    },
                    showLabels: true,
                    points: {
                        show: true
                    },
                    label: "'.$col_name.'",
                    labelPlacement: "above",
                    labels: ["0.35%", "0.34%", "0.45%", "0.77%"]},';
                    
                    if($this_val > 0){
                        $data .= $this_data;
                    }
        	    }
                /////////////////
	        }
	    
        
        $data .= "]";
        
	    return $data;
	}
	
	public function getFinancialEntriesData(Request $request){
	    
	    //DB::getSchemaBuilder()->getColumnListing($table);
	    $user_id = Auth::id();
	    $company_id_result = CompanyProfile::getCompanyId(Auth::id());
	    
	    //$month_now = $request["months"];
	    //$year_now = $request["year"];
	    
	    
	    $data = "[";
	    
	    $get_col_names = FinancialAnalysis::select("income", "purchase", "cost_goodsold_costsales", "gross_profit",
	        "directors_fee_renum", "totalrenum_exdirector_feerenum", "medical_expenses", "transport_traveling_expenses",
	        "entertainment_expenses", "debt_interest_finance_expenses", "net_profit", "net_profit_before_interest_tax_ebit",
	        "inventories_closing_stock", "trade_receivable", "trade_payable", "non_current_assets", "current_assets",
	        "current_liabilities", "non_current_liabilities", "share_capital", "retained_earning", "translation_reserves", "total_debt", "prepaid_expenses")->where('company_id',  $company_id_result)->where('user_id', $user_id)->first();
	    
	    
	    
	        foreach ($get_col_names->toArray() as $col_column => $col_value){
	            ////////////////
        	    $entry = FinancialAnalysis::select($col_column)->where('company_id',  $company_id_result)->where('user_id', $user_id)
        	    /*->where("year_param", "=", $year_now)
        	    
        	    ->where(function ($query) use ( $month_now) {
    			    
    			    if($month_now == "1234"){
            	        $query->whereIn('month_param', [1, 2, 3, 4]);
            	    }
            	    
            	    if($month_now == "5678"){
            	        $query->whereIn('month_param', [5, 6, 7, 8]);
            	    }
            	    
            	    if($month_now == "9101112"){
            	        $query->whereIn('month_param', [9, 10, 11, 12]);
            	    }
    			})*/
    			->orderBy("entry","asc")
        	    ->get();
        	    
        	    if(!$entry->isEmpty()){
        	        
        	        $this_data = "";
        	        $this_val = 0;
        	    
            	    $this_data .= '{data:[';
            	    
            	    $count= 0;
            	    $col_name = "";
            	    foreach($entry as $entry_data){
            	        foreach ($entry_data->toArray() as $column => $value){
            	            $this_data .= '['.$count.', '.$value.'],';
            	            $col_name = $column;
            	            
            	            $this_val += $value;
            	        }
            	        
            	        $count++;
            	    }
            	    
            	    if($col_name == "income"){
            	        $col_name = "Income";
            	    }
            	    if($col_name == "purchase"){
            	        $col_name = "Purchase";
            	    }
            	    if($col_name == "cost_goodsold_costsales"){
            	        $col_name = "Cost of Goods Sold / Cost of Sales";
            	    }
            	    if($col_name == "gross_profit"){
            	        $col_name = "Gross Profit";
            	    }
            	    if($col_name == "directors_fee_renum"){
            	        $col_name = "Directors’ Fees & Remuneration";
            	    }
            	    if($col_name == "totalrenum_exdirector_feerenum"){
            	        $col_name = "Total Remuneration excluding Directors’ Fees and Remuneration";
            	    }
            	    if($col_name == "medical_expenses"){
            	        $col_name = "Medical Expenses";
            	    }
            	    if($col_name == "transport_traveling_expenses"){
            	        $col_name = "Transport/Travelling Expenses";
            	    }
            	    if($col_name == "entertainment_expenses"){
            	        $col_name = "Entertainment Expenses";
            	    }
            	    if($col_name == "debt_interest_finance_expenses"){
            	        $col_name = "Debt Interest/Finance Expense";
            	    }
            	    if($col_name == "net_profit"){
            	        $col_name = "Net Profit";
            	    }
            	    if($col_name == "net_profit_before_interest_tax_ebit"){
            	        $col_name = "Net Profit Before Interest and Tax (EBIT)";
            	    }
            	    if($col_name == "inventories_closing_stock"){
            	        $col_name = "Inventories (Closing Stock)";
            	    }
            	    if($col_name == "trade_receivable"){
            	        $col_name = "Trade Receivable";
            	    }
            	    if($col_name == "trade_payable"){
            	        $col_name = "Trade Payable";
            	    }
            	    if($col_name == "non_current_assets"){
            	        $col_name = "Non-Current Assets";
            	    }
            	    if($col_name == "current_assets"){
            	        $col_name = "Current Assets";
            	    }
            	    if($col_name == "current_liabilities"){
            	        $col_name = "Current Liabilities";
            	    }
            	    if($col_name == "non_current_liabilities"){
            	        $col_name = "Non-current Liabilities";
            	    }
            	    if($col_name == "share_capital"){
            	        $col_name = "Share Capital";
            	    }
            	    if($col_name == "retained_earning"){
            	        $col_name = "Retained Earning";
            	    }
            	    if($col_name == "translation_reserves"){
            	        $col_name = "Translation Reserves";
            	    }
            	    if($col_name == "total_debt"){
            	        $col_name = "Total Debt";
            	    }
            	    if($col_name == "prepaid_expenses"){
            	        $col_name = "Prepaid Expenses";
            	    }
            	    
            	    $this_data .= '],
            	    canvasRender: true,
            	    lines: {
                        show: true
                    },
                    showLabels: true,
                    points: {
                        show: true
                    },
                    label: "'.$col_name.'",
                    labelPlacement: "above",
                    labels: ["0.35%", "0.34%", "0.45%", "0.77%"]},';
                    
                    if($this_val > 0){
                        $data .= $this_data;
                    }
        	    }
                /////////////////
	        }
	    
        
        $data .= "]";
        
	    return $data;
	}

	public function store(Request $request) {

		$user_id = Auth::id();

		if ($request->isMethod('post')) {

			$company_id_result = CompanyProfile::getCompanyId($user_id);

			$cp = CompanyProfile::find($company_id_result);

			if ($cp == null) {

				return redirect('home')->with('message', 'You are restricted to open profile section, please check with the administrator.');

			} else {

				$cp->description = $request['description'];

				$cp->office_phone = $request['office_phone'];

				$cp->mobile_phone = $request['mobile_phone'];

				$cp->company_website = $request['company_website'];

				$cp->company_email = $request['company_email'];

				$cp->facebook = $request['facebook'];

				$cp->twitter = $request['twitter'];

				$cp->linkedin = $request['linkedin'];

				$cp->googleplus = $request['googleplus'];

				$cp->otherlink = $request['otherlink'];

				$cp->unique_entity_number = $request['company_unique_entity'];

				$cp->company_name = $request['company_name'];

				$cp->registered_company_name = $request['company_name'];

				$cp->year_founded = $request['company_year_founded'];

				$cp->registered_address = $request['company_address'];

				$cp->number_of_employees = $request['company_number_employeee'];

				$cp->estimatedsales_currency = $request['company_estmated_sales_currency'];

				$cp->estimatedsales_value = $request['company_estmated_sales_value'];

				$cp->primary_country = $request['company_primary_country'];

				$cp->ownership_status = $request['company_ownership_status'];

				$cp->business_type = $request['company_business_type'];

				$cp->industry = $request['company_industry'];

				$cp->financial_year = $request['company_financial_year'];

				$cp->financial_month = $request['company_financial_month'];

				$cp->years_establishment = $request['company_years_establishment'];

				$cp->annual_tax_return = $request['company_annual_tax_return'];

				$cp->gross_profit = $request['company_gross_profit'];

				$cp->net_profit = $request['company_net_profit'];

				$cp->currency = $request['company_financial_currency'];

				$cp->no_of_staff = $request['company_financial_numstaff'];

				$cp->gross_profit = $request['company_gross_profit'];

				$cp->net_profit = $request['company_net_profit'];

				$cp->corporate_tax = $request['company_corporate_tax'];

				$cp->asset_more_liability = $request['company_asset_more_liability'];

				$cp->paid_up_capital = $request['company_paid_up_capital'];

				$cp->financial_year_end = $request['financial_year_end'];

				$cp->solvent_value = $request['company_vent_value'];

				$cp->edited_by = $user_id;
				
				$cp->incorporation_date =  $request['incorporation_date'];	

		     	if ($cp->save()) {

					if ($request->hasfile('uploadCSV')) {

						$file = $request->file('uploadCSV');
						$name = $user_id . '_financialStatus_' . time() . '_IntellinzFinancialStatusTemplate.csv';
						$file->move(public_path() . '/uploads/', $name);
						$filePathCsv =  asset('public/uploads/'.$name);
						
						$file = fopen($filePathCsv, "r") or die(" $filePathCsv file is not there! \n");
                	   
                	   
                       while(! feof($file))
                        {
                			$d = fgetcsv($file);
                
                            if(trim($d[0]) == 'Year' && trim($d[1]) == 'Month' && trim($d[2]) == 'Income')
                            {
                                    $not_match = FinancialAnalysis::saveCreateCSV($filePathCsv, $company_id_result, $user_id);
                                    if($not_match != ""){
                                        //return redirect('/profile/edit')->with('message', 'Failed to save. CSV file uploaded contains MONTH WORD that is not same in the proper format!. ' . $not_match);  
                                    }
                            }
                            else{
                                return redirect('/profile/edit')->with('message', 'Failed to save. CSV file uploaded is not the same in the downloadable Financial CSV template!.');  
                                exit();
                            }
                            break;
                        }
		 
					} else {

						FinancialAnalysis::saveCreate($request, $company_id_result, $user_id);

					}

				}

				AuditLog::ok(array($user_id, 'profile', 'update', 'info update'));

				//return redirect('profile/edit');

				return redirect('profile/edit')->with('status', 'Profiles has been succesfully saved.');

			}

		} else {

			echo 'Mau ni ang get';exit;

		}

	}

	public function deleteUploadedFile(Request $request) {

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$up_id = $request['fileupload_id'];

				$rs = UploadImages::find($up_id);

				$rs->status = 0;

				$rs->save();

				return 1;

			}

		}

	}

	//deactivate profile

	public function deactivatePage(Request $request) {

		$user_id = Auth::id();

		$user_email = Auth::user()->email;

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

		$brand_slogan = CompanyProfile::getBrandSlogan($user_id, $company_id_result);

		$billing_id = CompanyBilling::getBillingId($user_id, $company_id_result);

		if ($billing_id != 0) {

			$bill = CompanyBilling::find($billing_id);

		}

		if ($bill->account_name == null) {

			$bill->account_name = $brand_slogan[0];

		}

		if ($bill->account_email == null) {

			$bill->account_email = $user_email;

		}

		return view('profile.deactivate', compact('profileAvatar', 'bill', 'brand_slogan'));

	}

	public function deactivate(Request $request) {

		if ($request->isMethod('post')) {

			$user_id = Auth::id();

			$usr = User::find($user_id);

			$usr->status = 0;

			$usr->save();

			return redirect('logout');

		}

	}

	public function uploadProfile(Request $request) {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				if ($request->hasfile('cropimage')) {

					$file = $request->file('cropimage');

					$name = $user_id . '_' . time() . '_' . $file->getClientOriginalName();

					$file->move(public_path() . '/images/', $name);

					UploadImages::create([

						'company_id' => $company_id_result,

						'user_id' => $user_id,

						'file_category' => Config::get('constants.options.profile'),

						'file_source' => public_path() . '/images/' . $name,

						'file_name' => $name,

						'orig_filename' => $file->getClientOriginalName(),

						'added_by' => $user_id,

						'status' => '1',

					]);

					AuditLog::ok(array($user_id, 'profile', 'upload profile pic', 'new info saved'));

				}

			}

		} else {

			echo 'restricted';

		}

	}

	public function uploadAwards(Request $request) {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$request->validate([

					'awardsFiles' => 'mimes:pdf,jpeg,jpg,png,gif',

				]);

				$yearEnd = date('Y-m-d', strtotime('+1 year'));

				if ($request->hasfile('awardsFiles')) {

					$file = $request->file('awardsFiles');

					$name = $user_id . '_awards_' . time() . '_' . $file->getClientOriginalName(); //.'.'.$file->getClientOriginalExtension();

					$file->move(public_path() . '/uploads/', $name);

					UploadImages::create([

						'company_id' => $company_id_result,

						'user_id' => $user_id,

						'file_category' => Config::get('constants.options.awards'),

						'file_source' => public_path() . '/uploads/' . $name,

						'file_name' => $name,

						'orig_filename' => $file->getClientOriginalName(),

						'added_by' => $user_id,

						'status' => '1',

						'expiry_date' => $yearEnd,

					]);

				}

			}

		} else {

			'restricted';

		}

	}

	public function uploadPurchaseInvoices(Request $request) {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$request->validate([

					'purchaseInvoiceFiles' => 'mimes:pdf,jpeg,jpg,png,gif',

				]);

				if ($request->hasfile('purchaseInvoiceFiles')) {

					$file = $request->file('purchaseInvoiceFiles');

					$name = $user_id . '_purchaseinvoice_' . time() . '_' . $file->getClientOriginalName();

					$file->move(public_path() . '/uploads/', $name);

					UploadImages::create([

						'company_id' => $company_id_result,

						'user_id' => $user_id,

						'file_category' => Config::get('constants.options.purchase_invoices'),

						'file_source' => public_path() . '/uploads/' . $name,

						'file_name' => $name,

						'orig_filename' => $file->getClientOriginalName(),

						'added_by' => $user_id,

						'status' => '1',

					]);

				}

			}

		} else {

			echo 'restricted';

		}

	}

	public function uploadSalesInvoices(Request $request) {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$request->validate([

					'salesInvoiceFiles' => 'mimes:pdf,jpeg,jpg,png,gif',

				]);

				if ($request->hasfile('salesInvoiceFiles')) {

					$file = $request->file('salesInvoiceFiles');

					$name = $user_id . '_salesinvoice_' . time() . '_' . $file->getClientOriginalName();

					$file->move(public_path() . '/uploads/', $name);

					UploadImages::create([

						'company_id' => $company_id_result,

						'user_id' => $user_id,

						'file_category' => Config::get('constants.options.sales_invoices'),

						'file_source' => public_path() . '/uploads/' . $name,

						'file_name' => $name,

						'orig_filename' => $file->getClientOriginalName(),

						'added_by' => $user_id,

						'status' => '1',

					]);

				}

			}

		} else {

			echo 'restricted';

		}

	}

	public function uploadCertifications(Request $request) {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$request->validate([

					'certificationFiles' => 'mimes:pdf,jpeg,jpg,png,gif',

				]);

				$yearEnd = date('Y-m-d', strtotime('+1 year'));

				if ($request->hasfile('certificationFiles')) {

					$file = $request->file('certificationFiles');

					$name = $user_id . '_certifications_' . time() . '_' . $file->getClientOriginalName();

					$file->move(public_path() . '/uploads/', $name);

					UploadImages::create([

						'company_id' => $company_id_result,

						'user_id' => $user_id,

						'file_category' => Config::get('constants.options.certification'),

						'file_source' => public_path() . '/uploads/' . $name,

						'file_name' => $name,

						'orig_filename' => $file->getClientOriginalName(),

						'added_by' => $user_id,

						'status' => '1',

						'expiry_date' => $yearEnd,

					]);

				}

			}

		} else {

			echo 'restricted';

		}

	}

	public function saveKeyManagementPersonnel(Request $request) {

		$user_id = Auth::id();
		$company_id_result = CompanyProfile::getCompanyId($user_id);

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$date_of_birth = $request->input("date_of_birth");

				// $date_dob = date_create($date_of_birth);

				// $dob = date_format($date_dob, "Y-m-d");

				$dob = $date_of_birth;
				
				$user_id = $request->input("user_id");

				$km_id = $request->input("km_id");

				if ($km_id == '0') {

					KeyManagement::create([

						'user_id' => $user_id,

						'company_id' => $company_id_result,

						'first_name' => $request->input("first_name"),

						'last_name' => $request->input("last_name"),

						'idn_passport' => $request->input("idn_passport"),

						'nationality' => $request->input("nationality"),

						'gender' => $request->input("gender"),

						'date_of_birth' => $dob,

						'shareholder' => $request->input("shareholder"),

						'is_directorship' => $request->input("is_directorship"),

						'position' => $request->input("position"),

						'created_at' => date('Y-m-d'),

						'status' => 1,

						'added_by' => $user_id,

					]);

				} else {

					$rec = KeyManagement::find($km_id);

					if ( $rec->count() > 0) {

						$rec->company_id = $company_id_result;

						$rec->first_name = $request->input("first_name");

						$rec->last_name = $request->input("last_name");

						$rec->idn_passport = $request->input("idn_passport");

						$rec->nationality = $request->input("nationality");

						$rec->gender = $request->input("gender");

						$rec->date_of_birth = $dob;

						$rec->shareholder = $request->input("shareholder");

						$rec->is_directorship = $request->input("is_directorship");

						$rec->position = $request->input("position");

						$rec->updated_by = $user_id;

						$rec->save();

					}

				}

			}

		} else {

			echo 'restricted';

		}

	}

	public function editKeyManagementPersonnel(Request $request) {

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$id = $request->input('km_id');

				$result = KeyManagement::find($id);

				return $result;

			}

		}

	}

	public function deleteKeyManagementPersonnel(Request $request) {

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$id = $request->input('km_id');

				$result = KeyManagement::find($id);

				$result->status = 0;

				$result->save();

			}

		}

	}

	public function updateFileExpiryDate(Request $request) {

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$id = $request->input('file_id');

				$dateValue = $request->input('date_value');

				$result = UploadImages::find($id);

				if ($result->count() > 0) {

					$result->expiry_date = $dateValue;

					$result->save();

				}

			}

		}

	}

public function searchThomsonReuters(Request $request) {

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$id = $request->input('tr_id');

        	       $rURL = 'https://reputation.app-prokakis.com/api/v1/thomson/search/'.$id.'?pauth='.$this->urlToken;
        	       $client = new Client();
        	       $rsToken = $client->get($rURL);
        	       $result = $rsToken->getBody()->getContents();  
               		$data = json_decode($result, true);

				if ($data != null) {
					return view('snippets.refinitivSearchResultById',compact('data'));
	
				} else {
					return 'no data';
				}

				

			}

		}

	}

}
