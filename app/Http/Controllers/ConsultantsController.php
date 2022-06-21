<?php



namespace App\Http\Controllers;



use App\AuditLog;

use App\CompanyProfile;

use App\Configurations;

use App\ConsultantBilling;

use App\ConsultantMapping;

use App\ConsultantProjects;

use App\Consultants;

use App\FA_Results;

use App\FinancialAnalysis;

use App\Http\Controllers\Controller;

use App\RequestReport;

use App\UploadImages;

use App\User;

use Auth;

use Config;

use Illuminate\Http\Request;



class ConsultantsController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		$this->middleware('auth');

	}



	/**

	 * Show the application dashboard.

	 *

	 * @return \Illuminate\Http\Response

	 */

	public function index() {

		if (User::securePage(Auth::id()) == 1) {

			return redirect('home')->with('message', 'You are restricted to open "Consultant" page.');

			exit;

		}



		$user_id = Auth::id();

		$company = CompanyProfile::where('user_id', $user_id)->first();

		$c_country = $company->primary_country;

		$m = null;

		$s1 = null;

		$s2 = null;

		$ids = array();



		$main = ConsultantMapping::where('consultant_main', $user_id)->get();

		if (count((array) $main) > 0) {

			foreach ($main as $dta) {

				$ids[] = $dta->country_id;

			}

		}



		$companyList = CompanyProfile::whereIn('primary_country', $ids)->distinct('id')->get();

		$objArr = array();

		foreach ($companyList as $c) {



			if (FA_Results::getFA_entriesByUserAndCompany($c->user_id, $c->id) == true) {

				$objArr[] = CompanyProfile::find($c->id);

			}



		}



		/* $sub1 = ConsultantMapping::where('consultant_sub1', $user_id)->get();

			        if(count($sub1) > 0){

			          $s1 = $sub1->country_id;

			        }

			        $sub2 = ConsultantMapping::where('consultant_sub2', $user_id)->get();

			        if(count($sub2) > 0){

			          $s2 = $sub2->country_id;

		*/



		return view('consultant.index', compact('objArr'));

	}



	public function downloadFAreport(Request $request) {

		if (User::securePage(Auth::id()) == 1) {

			return redirect('home')->with('message', 'You are restricted to open "Consultant" page.');

			exit;

		}



		if ($request->isMethod('post')) {

			$userId = $request->input('user_id');

			$companyId = $request->input('company_id');

			$prof = CompanyProfile::find($companyId);

			if (count((array) $prof) > 0) {

				header('Content-Type: text/csv');

				header('Content-Disposition: attachment; filename="' . $prof->company_name . '.csv"');



				$fa = FinancialAnalysis::where('user_id', $userId)->where('company_id', $companyId)->get();

				$far = FA_Results::where('user_id', $userId)->where('company_id', $companyId)->get();

				$data = array();

				$header = "Month/Year ,";

				$param_months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');



				foreach ($fa as $d) {

					$header = $header . $param_months[$d->month_param] . ' / ' . $d->year_param . ',';

				}

				$data[] = $header;

				//header done



				$rows = "Income, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->income . ", ";

				}

				$data[] = $rows;



				$rows = "Purchase, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->purchase . ", ";

				}

				$data[] = $rows;



				$rows = "Cost of Goods Sold / Cost of Sales, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->cost_goodsold_costsales . ", ";

				}

				$data[] = $rows;



				$rows = "Gross Profit, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->gross_profit . ", ";

				}

				$data[] = $rows;



				$rows = "Directors’ Fees & Remuneration, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->directors_fee_renum . ", ";

				}

				$data[] = $rows;



				$rows = "Total Remuneration excluding Directors’ Fees and Remuneration, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->totalrenum_exdirector_feerenum . ", ";

				}

				$data[] = $rows;



				$rows = "Medical Expenses, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->medical_expenses . ", ";

				}

				$data[] = $rows;



				$rows = "Transport/Travelling Expenses, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->transport_traveling_expenses . ", ";

				}

				$data[] = $rows;



				$rows = "Entertainment Expenses, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->entertainment_expenses . ", ";

				}

				$data[] = $rows;



				$rows = "Debt Interest/Finance Expense , ";

				foreach ($fa as $d) {

					$rows = $rows . $d->debt_interest_finance_expenses . ", ";

				}

				$data[] = $rows;



				$rows = "Net Profit , ";

				foreach ($fa as $d) {

					$rows = $rows . $d->net_profit . ", ";

				}

				$data[] = $rows;



				$rows = "Net Profit Before Interest and Tax (EBIT), ";

				foreach ($fa as $d) {

					$rows = $rows . $d->net_profit_before_interest_tax_ebit . ", ";

				}

				$data[] = $rows;



				$rows = "Inventories (Closing Stock), ";

				foreach ($fa as $d) {

					$rows = $rows . $d->inventories_closing_stock . ", ";

				}

				$data[] = $rows;



				$rows = "Trade Receivable, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->trade_receivable . ", ";

				}

				$data[] = $rows;



				$rows = "Trade Payable, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->trade_payable . ", ";

				}

				$data[] = $rows;



				$rows = "Non-Current Assets, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->non_current_assets . ", ";

				}

				$data[] = $rows;



				$rows = "Current Assets, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->current_assets . ", ";

				}

				$data[] = $rows;



				$rows = "Current Liabilities, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->current_liabilities . ", ";

				}

				$data[] = $rows;



				$rows = "Non-current Liabilities, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->non_current_liabilities . ", ";

				}

				$data[] = $rows;



				$rows = "Share Capital, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->share_capital . ", ";

				}

				$data[] = $rows;



				$rows = "Retained Earning, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->retained_earning . ", ";

				}

				$data[] = $rows;



				$rows = "Translation Reserves, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->translation_reserves . ", ";

				}

				$data[] = $rows;



				$rows = "Total Debt, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->total_debt . ", ";

				}

				$data[] = $rows;



				$rows = "Prepaid Expenses, ";

				foreach ($fa as $d) {

					$rows = $rows . $d->prepaid_expenses . ", ";

				}

				$data[] = $rows;

				$data[] = " ,";



				$rows = "Receivable Turnover, ";

				foreach ($far as $d) {

					$rows = $rows . $d->receivable_turnover . ", ";

				}

				$data[] = $rows;



				$rows = "Average Collection Period, ";

				foreach ($far as $d) {

					$rows = $rows . $d->average_collection_period . ", ";

				}

				$data[] = $rows;



				$rows = "Inventory Turnover, ";

				foreach ($far as $d) {

					$rows = $rows . $d->inventory_turnover . ", ";

				}

				$data[] = $rows;



				$rows = "Days in Inventory, ";

				foreach ($far as $d) {

					$rows = $rows . $d->days_in_inventory . ", ";

				}

				$data[] = $rows;



				$rows = "Payable Turnover, ";

				foreach ($far as $d) {

					$rows = $rows . $d->payable_turnover . ", ";

				}

				$data[] = $rows;



				$rows = "Average Payment Period, ";

				foreach ($far as $d) {

					$rows = $rows . $d->average_payment_period . ", ";

				}

				$data[] = $rows;



				$rows = "Networking Capital, ";

				foreach ($far as $d) {

					$rows = $rows . $d->networking_capital . ", ";

				}

				$data[] = $rows;



				$rows = "Current Ratio, ";

				foreach ($far as $d) {

					$rows = $rows . $d->current_ratio . ", ";

				}

				$data[] = $rows;



				$rows = "Current Ratio, ";

				foreach ($far as $d) {

					$rows = $rows . $d->current_ratio . ", ";

				}

				$data[] = $rows;



				$rows = "Quick Ratio, ";

				foreach ($far as $d) {

					$rows = $rows . $d->quick_ratio . ", ";

				}

				$data[] = $rows;



				$rows = "Debt to Asset, ";

				foreach ($far as $d) {

					$rows = $rows . $d->debt_to_asset . ", ";

				}

				$data[] = $rows;



				$rows = "Interest Coverage, ";

				foreach ($far as $d) {

					$rows = $rows . $d->interest_coverage . ", ";

				}

				$data[] = $rows;



				$rows = "Gross Profit Margin, ";

				foreach ($far as $d) {

					$rows = $rows . $d->gross_profit_margin . ", ";

				}

				$data[] = $rows;



				$rows = "Operating Profit Margin, ";

				foreach ($far as $d) {

					$rows = $rows . $d->operating_profit_margin . ", ";

				}

				$data[] = $rows;



				$rows = "Net Profit Margin, ";

				foreach ($far as $d) {

					$rows = $rows . $d->net_profit_margin . ", ";

				}

				$data[] = $rows;



				$rows = "Return of Investment, ";

				foreach ($far as $d) {

					$rows = $rows . $d->return_of_investment . ", ";

				}

				$data[] = $rows;



				$rows = "Return of Equity, ";

				foreach ($far as $d) {

					$rows = $rows . $d->return_of_equity . ", ";

				}

				$data[] = $rows;



				$fp = fopen('php://output', 'wb');

				foreach ($data as $line) {

					$val = explode(",", $line);

					fputcsv($fp, $val);

				}

				fclose($fp);

			}



		}



	}



	public function viewProfile() {

		$consul_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($consul_id);

		$company_data = Consultants::where('consultant_id', $consul_id)->first();



		$bank_list = Configurations::getJsonValue('bank_list');

		$payment_method = Configurations::getJsonValue('payment_method');



		$profileAvatar = null;



		$profileAvatar = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.profileSC'), 1);

		$profileCertifications = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.certificationSC'), 5);

		$completenessProfile = Consultants::getProfileCompleteness($consul_id, $profileCertifications);



		return view('consultant.viewprofile', compact('profileAvatar', 'profileCertifications', 'completenessProfile', 'company_data',

			'bank_list', 'payment_method'));



	}



	public function editProfile(Request $request) {

		$consul_id = Auth::id();

		//echo $consul_id;

		$company_id_result = CompanyProfile::getCompanyId($consul_id);

		// $company_data = CompanyProfile::find($company_id_result);

		$company_data = Consultants::where('consultant_id', $consul_id)->first();



		$bank_list = Configurations::getJsonValue('bank_list');

		$payment_method = Configurations::getJsonValue('payment_method');



		$profileAvatar = null;



		$profileAvatar = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.profileSC'), 1);

		$profileCertifications = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.certificationSC'), 5);

		$completenessProfile = Consultants::getProfileCompleteness($consul_id, $profileCertifications);



		return view('consultant.editprofile', compact('profileAvatar', 'profileCertifications', 'completenessProfile', 'company_data',

			'bank_list', 'payment_method'));

	}



	public function storeProfile(Request $request) {

		if ($request->isMethod('post')) {



			$consultant_id = $request->input('consultantID');



			$rs = Consultants::where('consultant_id', $consultant_id)->first();



			if (count((array) $rs) > 0) {

				//update



				$rs->name = $request->input('name');

				$rs->identity_passport_number = $request->input('identity_passport_number');

				$rs->dob = $request->input('dob');

				$rs->bank_id = $request->input('bank_id');

				$rs->bank_type = $request->input('bank_type');

				$rs->account_number = $request->input('account_number');

				$rs->payment_method = $request->input('payment_method');

				$rs->email_address = $request->input('email_address');

				$rs->phone_number = $request->input('phone_number');

				$rs->phone_type = $request->input('phone_type');

				$rs->consultant_type = 'sub';

				$rs->updated_by = $consultant_id;

				$rs->save();



				return redirect('/consultants/viewprofile')->with('status', 'Profiles has been succesfully updated.');



			} else {

				//update old ones



				$consul_id = Auth::id();

				Consultants::create([

					'consultant_id' => $consul_id,

					'name' => $request->input('name'),

					'identity_passport_number' => $request->input('identity_passport_number'),

					'dob' => $request->input('dob'),

					'bank_id' => $request->input('bank_id'),

					'bank_type' => $request->input('bank_type'),

					'account_number' => $request->input('account_number'),

					'payment_method' => $request->input('payment_method'),

					'email_address' => $request->input('email_address'),

					'phone_number' => $request->input('phone_number'),

					'phone_type' => $request->input('phone_type'),

					'consultant_type' => 'sub',

					'created_at' => date('Y-m-d'),

					'created_by' => $consul_id,



				]);



				return redirect('/consultants/viewprofile')->with('status', 'Profiles has been succesfully saved.');



			}



		}



	}



	public function updateProject(Request $request) {

		if ($request->isMethod('post')) {

			$consul_id = Auth::id();

			$projecID = $request->input('project_id');

			$new_project_status = $request->input('new_project_status');

			$pr = ConsultantProjects::find($projecID);

			if (count((array) $pr) > 0) {

				$today = date('Y-m-d');

				$date_receive = date_create($today);

				$date_final = date_format($date_receive, "Y-m-d");

				$pr->start_date = $date_final;

				$pr->project_status = $new_project_status;

				$pr->updated_by = $consul_id;

				$ok = $pr->save();

				if ($ok) {

					return redirect('/consultants/ongoing-projects')->with('status', 'Project been succesfully moved to ONGOING status.');

				}

			}



		}

	}



	public function updateOngoingProject(Request $request) {

		if ($request->isMethod('post')) {

			$consul_id = Auth::id();

			$projecID = $request->input('project_id');



			$progressValue = $request->input('project_progress' . $projecID);

			

			$fileCategory = Config::get('constants.options.consultant_project');



			if($request->input('confirmRP'.$projecID) == 'yes')

			{

				$fileCategory = $fileCategory.'_'.'REPORT';

			}



			//$company_id_result = CompanyProfile::getCompanyId($consul_id);

			$up_file = null;



			if ($request->hasfile('reportUpload' . $projecID)) {

				$file = $request->file('reportUpload' . $projecID);

				$name = $consul_id . '_' . time() . '_' . $file->getClientOriginalName();

				$file->move(public_path() . '/consultantproject/', $name);



				$up_file = UploadImages::create([

					'company_id' => NULL,

					'user_id' => $consul_id,

					'file_category' => $fileCategory,

					'file_source' => public_path() . '/consultantproject/' . $name,

					'file_name' => $name,

					'orig_filename' => $file->getClientOriginalName(),

					'added_by' => $consul_id,

					'status' => '1',

				]);



				AuditLog::ok(array($consul_id, 'project', 'upload project file', 'file name:' . $name));

			}



			$pr = ConsultantProjects::find($projecID);

			if (count((array) $pr) > 0) {

				$pr->progress = $progressValue;

				if ($progressValue == 100) {

					$pr->project_status = 'DONE';

				}

				if ($up_file != null) {



					$today = date('Y-m-d');

					$date_receive = date_create($today);

					$date_final = date_format($date_receive, "Y-m-d");

					$resultFile = $pr->remarks . ',[' . $date_final . ':' . $up_file->id . ']';

					$pr->remarks = ltrim($resultFile, ",");

				}



				$pr->updated_by = $consul_id;

				$ok = $pr->save();

				if ($ok) {

					return redirect('/consultants/ongoing-projects')->with('status', 'Project been succesfully updated.');

				}

			}



		}

	}



	public function pendingProjects(Request $request) {

		$consul_id = Auth::id();



		$rs = ConsultantProjects::where('assigned_consultant_id', $consul_id)->where('project_status', 'PENDING')->get();



		return view('consultant.pendingProject', compact('rs'));

	}



	public function ongoingProjects(Request $request) {



		$consul_id = Auth::id();



		$rs = ConsultantProjects::where('assigned_consultant_id', $consul_id)->where('project_status', 'ONGOING')->get();



		return view('consultant.ongoingProject', compact('rs'));

	}



	public function archivedProjects(Request $request) {



		$consul_id = Auth::id();



		$rs = ConsultantProjects::where('assigned_consultant_id', $consul_id)->where('project_status', 'DONE')->get();



		return view('consultant.archivedProject', compact('rs'));

	}



	public function getRequesterInformation(Request $request) {



		if ($request->isMethod('post')) {

			if ($request->ajax()) {



				$requestId = $request->input('request_id');

				$company_id_result = $request->input('requester_id');

				//$company_id_result = CompanyProfile::getCompanyId($user_id);



				$viewMore = url("/profile/viewer/" . $company_id_result);



				$req = RequestReport::find($requestId);

				if (count((array) $req) > 0) {

					$out = "";



					$out = $out . '<table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%; padding-top: 10px;">';



					$out = $out . '<tr>

                    <th colspan="2"> Person Information who made the request.   </th>

                    </tr>';



					$out = $out . '<tr>

                      <td> Opportunity Type   </td>

                      <td> ' . $req->opportunity_type . ' </td>

                      </tr>';



					$out = $out . '<tr>

                      <td> Company UEN   </td>

                      <td> ' . $req->company_UEN . ' </td>

                      </tr>';



					$out = $out . '<tr>

                      <td> Company Name  </td>

                      <td> ' . $req->company_name . ' </td>

                      </tr>';



					$out = $out . '<tr>

                      <td> Person Incharge  </td>

                      <td> ' . $req->person_incharge . ' </td>

                      </tr>';



					$out = $out . '<tr>

                      <td> Email address  </td>

                      <td> ' . $req->email_address . ' </td>

                      </tr>';



					$out = $out . '<tr>

                      <td> Mobile Number  </td>

                      <td> ' . $req->mobile_number . ' </td>

                      </tr>';



					$out = $out . '<tr>

                      <td> Requested At  </td>

                      <td> ' . $req->created_at . ' </td>

                      </tr>';



					$out = $out . '</table>

                    <div>

                        <center>

                            <a target="_blank" href="' . $viewMore . '"> >> View company profile of the requester << </a>

                        </center>

                    </div>

                    ';



					return $out;

				}

			}

		}



	}



	public function uploadProfileSC(Request $request) {

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

						'file_category' => Config::get('constants.options.profileSC'),

						'file_source' => public_path() . '/images/' . $name,

						'file_name' => $name,

						'orig_filename' => $file->getClientOriginalName(),

						'added_by' => $user_id,

						'status' => '1',

					]);



					AuditLog::ok(array($user_id, 'profile', 'upload consultant profile pic', 'new info saved'));

				}

			}

		} else {

			echo 'restricted';

		}

	}



	public function uploadCertificationsSC(Request $request) {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($user_id);



		if ($request->isMethod('post')) {

			if ($request->ajax()) {



				$request->validate([

					'certificationFiles' => 'mimes:pdf,jpeg,jpg,png,gif',

				]);



				if ($request->hasfile('certificationFiles')) {



					$file = $request->file('certificationFiles');

					$name = $user_id . '_certifications_' . time() . '_' . $file->getClientOriginalName();

					$file->move(public_path() . '/uploads/', $name);



					UploadImages::create([

						'company_id' => $company_id_result,

						'user_id' => $user_id,

						'file_category' => Config::get('constants.options.certificationSC'),

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



	public function commission() {

		$user_id = Auth::id();

		$rs = ConsultantProjects::where('assigned_consultant_id', $user_id)->where('project_status', 'DONE')->get();

		$con_com = Configurations::getJsonValue('consultant_project_commission');



		return view('consultant.commission', compact('rs', 'con_com'));

	}



	public function billing() {



		$user_id = Auth::id();



		$bill = ConsultantBilling::where('user_id', $user_id)->first();



		return view('consultant.billing', compact('bill'));

	}



	public function billingStore(Request $request) {

		$user_id = Auth::id();



		if ($request->isMethod('post')) {



			$ok = $this->validate($request, [

				'account_name' => 'required|string|max:255',

				'account_email' => 'required|string|email|max:255',

				'card_holder_name' => 'string|max:255',

				'card_number' => 'string|max:255',

				'security_code' => 'string|max:255',

				'card_expiry_date' => 'string|max:255',

			]);



			if ($ok) {



				$billing_id = $request->input('billingId');



				if ($billing_id != '0') {



					$company_data = ConsultantBilling::find($billing_id);

					$company_data->account_name = $request->input('account_name');

					$company_data->account_email = $request->input('account_email');

					$company_data->card_holder_name = $request->input('card_holder_name');

					$company_data->card_number = $request->input('card_number');

					$company_data->security_code = $request->input('security_code');

					$company_data->card_expiry_date = $request->input('card_expiry_date');

					$company_data->updated_by = $user_id;

					$company_data->save();



					AuditLog::ok(array($user_id, 'consultant billing', 'update', 'update info'));

					return redirect('consultants/billing')->with('status', 'Billing information has been succesfully saved.');



				} else {



					ConsultantBilling::create([

						'user_id' => $user_id,

						'account_name' => $request->input('account_name'),

						'account_email' => $request->input('account_email'),

						'card_holder_name' => $request->input('card_holder_name'),

						'card_number' => $request->input('card_number'),

						'security_code' => $request->input('security_code'),

						'card_expiry_date' => $request->input('card_expiry_date'),

						'created_at' => date('Y-m-d'),

						'created_by' => $user_id,

					]);



					AuditLog::ok(array($user_id, 'consultant billing', 'created', 'created info'));

					return redirect('consultants/billing')->with('status', 'Billing information has been succesfully created.');



				}



			}

		}

	}



	public function billingUpdate(Request $request) {

		$user_id = Auth::id();

		$company_id = CompanyProfile::getCompanyId($user_id);



		if ($request->isMethod('post')) {

			if ($request->ajax()) {



				$ok = $this->validate($request, [

					'account_name' => 'required|string|max:255',

					'account_email' => 'required|string|email|max:255',

				]);



				if ($ok) {

					$billing_id = CompanyBilling::getBillingId($user_id, $company_id);



					if ($billing_id != 0) {



						$company_data = CompanyBilling::find($billing_id);

						$company_data->account_name = $request->input('account_name');

						$company_data->account_email = $request->input('account_email');

						$company_data->edited_by = $user_id;

						$company_data->save();



						AuditLog::ok(array($user_id, 'billing', 'update', 'billing id:' . $billing_id));

					}

				}



			}

		}



	}



}

