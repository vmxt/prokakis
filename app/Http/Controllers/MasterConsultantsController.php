<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\Configurations;
use App\ConsultantMapping;
use App\ConsultantProjects;
use App\Consultants;
use App\FA_Results;
use App\Http\Controllers\Controller;
use App\Mailbox;
use App\RequestApproval;
use App\RequestReport;
use App\UploadImages;
use App\User;
use Auth;
use Config;
use Illuminate\Http\Request;

class MasterConsultantsController extends Controller {

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

		return view('consultant.index', compact('objArr'));

	}

	public function viewProfile() {

		$consul_id = Auth::id();

		echo $consul_id;

		$company_id_result = CompanyProfile::getCompanyId($consul_id);

		// $company_data = CompanyProfile::find($company_id_result);

		$company_data = Consultants::where('consultant_id', $consul_id)->first();

		$bank_list = Configurations::getJsonValue('bank_list');

		$payment_method = Configurations::getJsonValue('payment_method');

		$profileAvatar = null;

		$profileAvatar = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.profileMC'), 1);

		$profileCertifications = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.certificationMC'), 5);

		$completenessProfile = Consultants::getProfileCompleteness($consul_id, $profileCertifications);

		return view('mconsultant.viewprofile', compact('profileAvatar', 'profileCertifications', 'completenessProfile', 'company_data',

			'bank_list', 'payment_method'));

	}

	public function editProfile(Request $request) {

		$consul_id = Auth::id();

		//echo $consul_id ;

		$company_id_result = CompanyProfile::getCompanyId($consul_id);

		$company_data = Consultants::where('consultant_id', $consul_id)->first();

		$bank_list = Configurations::getJsonValue('bank_list');

		$payment_method = Configurations::getJsonValue('payment_method');

		$profileAvatar = null;

		$profileAvatar = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.profileMC'), 1);

		$profileCertifications = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.certificationMC'), 5);

		$completenessProfile = Consultants::getProfileCompleteness($consul_id, $profileCertifications);

		return view('mconsultant.editprofile', compact('profileAvatar', 'profileCertifications', 'completenessProfile', 'company_data',

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

				$rs->consultant_type = 'master';

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

					'consultant_type' => 'master',

					'created_at' => date('Y-m-d'),

					'created_by' => $consul_id,

				]);

				return redirect('/consultants/viewprofile')->with('status', 'Profiles has been succesfully saved.');

			}

		}

	}

	public function saveProject(Request $request) {

		if ($request->isMethod('post')) {

			$consul_id = Auth::id();

			$request_approval_id = $request->input("request_approval_id");

			$request_id = $request->input("request_id");

			$form_id = $request->input("form_id");

			$due_date = $request->input("due_date" . $form_id);

			$assignedConsultants = $request->input("assignedConsultants");

			$req_report = RequestReport::find($request_id);

			if (count((array) $req_report) > 0) {

				$due_date_receive = date_create($due_date);

				$due_date_final = date_format($due_date_receive, "Y-m-d");

				$today = date('Y-m-d');

				$date_receive = date_create($today);

				$date_final = date_format($date_receive, "Y-m-d");

				$ok = ConsultantProjects::create([

					'request_approval_id' => $request_approval_id,

					'request_id' => $request_id,

					'company_source_id' => $req_report->source_company_id,

					'company_requester_id' => $req_report->company_id,

					'main_consultant_id' => $consul_id,

					'search_on' => $req_report->created_at,

					'assigned_consultant_id' => $assignedConsultants,

					'due_date' => $due_date_final,

					'project_status' => 'PENDING',

					'created_at' => $date_final,

					'created_by' => $consul_id,

				]);

				//email notification will be sent here to the assigned consultant

				if ($ok) {

					$usr = User::find($assignedConsultants);

					$login = url('/login');

					$message = "

                    Dear $usr->firstname,

                    <br />

                    <br />

                    We would like to inform you that there is a project assigned to you.

                    <br />

                    Please do login to your Prokakis account.

                    <br />

                    Proakis login link:" . $login . "

                    <br />

                    <br />

                    Best Regards, <br />

                    Prokakis Web Admin

                    ";

					//send the email here

					Mailbox::sendMail($message, $usr->email, "Prokakis Project Assignment.", "");

					return redirect('/mconsultants/projectOverview')->with('status', 'Project been succesfully assigned.');

				}

			} else {

				return redirect('/mconsultants/projectOverview')->with('message', 'No result for request record.');

				exit;

			}

		}

	}

	public function projectOverview(Request $request) {

		$consul_id = Auth::id();

		$usertype = User::securePage($consul_id);

		if ($usertype == 3 || $usertype == 5) {
			//3 is master Consultant

			$rs = RequestApproval::where('main_consultant', $consul_id)->where('status', 1)->get();

			$subsConsultants = ConsultantMapping::getSubConsultantsByMaster($consul_id);
				
			return view('mconsultant.overview', compact('rs', 'subsConsultants'));

		} else {

			return redirect('/home')->with('message', 'Page is restricted.');

			exit;

		}

	}

	public function projectPending(Request $request) {

		$consul_id = Auth::id();

		$rs = ConsultantProjects::where('main_consultant_id', $consul_id)->where('project_status', 'PENDING')->get();

		return view('mconsultant.pendingProject', compact('rs'));

	}

	public function projectOngoing(Request $request) {

		$consul_id = Auth::id();

		$rs = ConsultantProjects::where('main_consultant_id', $consul_id)->where('project_status', 'ONGOING')->get();

		return view('mconsultant.ongoingProject', compact('rs'));

	}

	public function projectCompleted(Request $request) {

		$consul_id = Auth::id();

		$rs = ConsultantProjects::where('main_consultant_id', $consul_id)->where('project_status', 'DONE')->get();

		return view('mconsultant.archivedProject', compact('rs'));

	}

	public function uploadProfileMC(Request $request) {

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

						'file_category' => Config::get('constants.options.profileMC'),

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

	public function uploadCertificationsMC(Request $request) {

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

						'file_category' => Config::get('constants.options.certificationMC'),

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

	public function updateDuedate(Request $request) {

		if ($request->isMethod('post')) {

			if ($request->ajax()) {

				$pId = $request->input('projectId');

				$newDueDate = $request->input('newDueDate');

				$rs = ConsultantProjects::find($pId);

				if (count((array) $rs) > 0) {

					$rs->due_date = $newDueDate;

					$ok = $rs->save();

					if ($ok) {

						$result = '<a href="#" data-popup-open="popup-1" onclick="updateDueDate(\'' . $newDueDate . '\',\'' . $pId . '\');">' . $newDueDate . '</a>';

						return $result;

					}

				}

			}

		}

	}

}
