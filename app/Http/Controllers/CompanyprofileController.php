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

class CompanyprofileController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		$this->middleware('auth');

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

			$company_data = CompanyProfile::find($company_id_result);

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

			//$viewer = base64_encode('viewer' . $company_id_result);
			//$urlFB = url('/company') . '/' . $viewer . '/' . $company_id_result;

			$viewer = base64_encode($brand_slogan[0]);
			$urlFB = url('/fbshare'. '/' . $company_id_result . '/'.$viewer);
			$urlPreview = url('company/'.$company_id_result);

			$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();

			$businessNewsOpportunity = BusinessOpportunitiesNews::where('user_id', $user_id)->where('company_id', $company_id_result)->first();

			return view('profile.view', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

				'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

				'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

				'profileCertifications', 'completenessProfile', 'profileCoverPhoto',

				'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons',

				'user_id', 'businessNewsOpportunity', 'urlPreview'));

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

			if (ConsultantProjects::validateConsultantAccessByProject(Auth::id(), $company_id) == true && User::securePage(Auth::id()) != 5) {

				return redirect('/consultants/ongoing-projects')->with('message', 'Page is restricted, you must be the assigned consultant.');

				exit;

			}

			$company_data = CompanyProfile::find($company_id);

			if ($company_data->count() > 0) {

				$user_id = $company_data->user_id;

				$company_id_result = $company_data->id;

				//$company_id_result = CompanyProfile::getCompanyId($user_id);

				//$company_data = CompanyProfile::find($company_id_result);

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

				//$viewer = base64_encode('viewer' . $company_id_result);
				//$urlFB = url('/company') . '/' . $viewer . '/' . $company_id_result;

				$viewer = base64_encode($brand_slogan[0]);
				$urlFB = url('/fbshare'. '/' . $company_id_result . '/'.$viewer);
				$urlPreview = url('company/'.$company_id_result);

				$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();

				$businessNewsOpportunity = BusinessOpportunitiesNews::where('user_id', $user_id)->where('company_id', $company_id_result)->first();

				/* $viewer_company_id = CompanyProfile::getCompanyId(Auth::id());

					            WhoViewedMe::create([

					              'presenter_company_id' => $company_id_result,

					              'viewer_company_id'   => $viewer_company_id,

					              'is_request'          => 'no',

					              'created_at'          => date('Y-m-d'),

					              'status'              => '1',

				*/

				return view('profile.view', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

					'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

					'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

					'profileCertifications', 'completenessProfile', 'profileCoverPhoto',

					'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons',

					'user_id', 'businessNewsOpportunity', 'urlPreview'));

			}

		}

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

		$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();

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

	/**

	 * Show the application dashboard.

	 *

	 * @return \Illuminate\Http\Response

	 */

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

		$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();

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

				if ($cp->save()) {

					FinancialAnalysis::saveCreate($request, $company_id_result, $user_id);

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

				$data = ThomsonReuters::searchAllThree($id);

				if ($data != null) {

					$out = "";

					$company_out = (isset($data->COMPANIES))? $data->COMPANIES : '';

					/*if (count((array)$rcp) > 0) {
						foreach ($rcp as $cc) {
							if (!is_numeric($cc)) {
								$company_out = $company_out . $cc . ",";
							}
						}
					} */

					$inserted_prokakis = '';

					if ($data->CREATED_AT != NULL) {

						$date = date_create($data->CREATED_AT);

						$dateFinal = date_format($date, "Y-m-d");

						$inserted_prokakis = date("F j, Y", strtotime($dateFinal));

					}

					$updated_prokakis = '';

					if ($data->UPDATED != NULL) {

						$date2 = date_create($data->UPDATED);

						$dateFinal2 = date_format($date2, "Y-m-d");

						$updated_prokakis = date("F j, Y", strtotime($dateFinal2));

					}

					$printUrl = url("/thomson-print/" . $data->ID);

					$out = $out . '<br /><a href="' . $printUrl . '" target="_blank" class="btn btn-primary">Print Preview</a>

              <table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%; padding-top: 10px;">';

					$out = $out . '<tr>

                      <td> INSERTED TO PROKAKIS  </td>

                      <td> ' . $inserted_prokakis . ' </td>

                      </tr>';

					$out = $out . '<tr>

                      <td> UPDATED   </td>

                      <td> ' . $updated_prokakis . ' </td>

                      </tr>';

					$out = $out . '<tr>

                      <td> First Name   </td>

                      <td> ' . $data->FIRST_NAME . ' </td>

                      </tr>';

					$out = $out . '<tr>

                     <td> Last Name   </td>

                     <td> ' . $data->LAST_NAME . ' </td>

					 </tr>';
					
					 $out = $out . '<tr>

                     <td> Countries  </td>

                     <td> ' . $data->COUNTRIES . ' </td>

					 </tr>';
				

					$out = $out . '<tr>

                     <td> Companies   </td>

                     <td> ' . $company_out . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Aliases   </td>

					 <td> ' . $data->ALIASES . ' </td>
					 
					 </tr>';

					 $out = $out . '<tr>

                     <td> Low quality aliases   </td>

					 <td> ' . $data->LOW_QUALITY_ALIASES . ' </td>
					 
					 </tr>';
					 


					$out = $out . '<tr>

                     <td> Category  </td>

                     <td> ' . $data->CATEGORY . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Title   </td>

                     <td> ' . $data->TITLE . ' </td>

					 </tr>';

					 $out = $out . '<tr>

                     <td> Alternative Spelling   </td>

                     <td> ' . $data->ALTERNATIVE_SPELLING . ' </td>

					 </tr>';
					 
					 


					$out = $out . '<tr>

                     <td> Gender   </td>

                     <td> ' . $data->E_I . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Position  </td>

                     <td> ' . $data->POSITION . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> DOB   </td>

                     <td> ' . $data->DOB . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Locations   </td>

                     <td> ' . $data->LOCATIONS . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Passport   </td>

                     <td> ' . $data->PASSPORTS . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Citizenship   </td>

                     <td> ' . $data->CITIZENSHIP . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Place of birth   </td>

                     <td> ' . $data->PLACE_OF_BIRTH . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Companies   </td>

                     <td> ' . $data->COMPANIES . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Country Location   </td>

                     <td> ' . $data->LOCATIONS . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Key Words   </td>

                     <td> ' . $data->KEYWORDS . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> Further Information   </td>

                     <td> ' . $data->FURTHER_INFORMATION . ' </td>

                     </tr>';

					$out = $out . '<tr>

                     <td> External sources   </td>

                     <td> ' . $data->EXTERNAL_SOURCES . ' </td>

                     </tr>';

					$out = $out . '</table>';

					return $out;	
				} else {
					return 'no data';
				}

				

			}

		}

	}

}
