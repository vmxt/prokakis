<?php



namespace App\Http\Controllers;



use App\AuditLog;

use App\CompanyProfile;

use App\Mailbox;

use App\ProcessedReport;

use App\RequestApproval;

use App\RequestReport;

use App\SpentTokens;

use App\User;

use Auth;

use Illuminate\Http\Request;



class RequestReportController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		$this->middleware('auth');

	}



	public function reqApprovalPage(Request $request) {

		if ($request->isMethod('post')) {

			$id = $request->input("repRequestId");

			$ok = RequestReport::find($id);



			if (count((array) $ok) > 0) {



				$cp = CompanyProfile::find($ok->company_id); //requester company profile

				$cps = CompanyProfile::find($ok->source_company_id); //provider company profile



				//validate token
				/*
				if (SpentTokens::validateLeftBehindToken($ok->company_id) == false) {

					return redirect('opportunity/explore')->with('message', 'Insufficient token value, please re-fill.');

					exit;

				} else {

					$stockTokens = SpentTokens::validateLeftBehindToken($ok->company_id);

					if ($stockTokens < 9) {

						return redirect('opportunity/explore')->with('message', 'Please advice requester to re-fill token, in order to approve request token count must be 9 or higher.');

						exit;

					} else {



						SpentTokens::spendTokenByrequest($id, $ok->company_id, $cp->user_id, 9); //deduct 9 token to approve, once request acknowledge minus

					}

				} */



				$ok->is_approve = 'yes';



				$date = date('Y-m-d H:i:s');

				$date_ok = date_create($date);

				$date_final = date_format($date_ok, "Y-m-d H:i:s");



				RequestApproval::create([

					'req_rep_id' => $ok->id,

					'requester_company_id' => $ok->company_id, //requester

					'company_id' => $ok->source_company_id, //provider

					'is_accepted' => 'yes',

					'main_consultant' => Auth::id(),

					'remarks' => $ok->fk_ooportunity_id . '-' . $ok->opportunity_type . '-' . $ok->company_name,

					'created_at' => $date_final,

					'status' => 1,

				]);



				$ok->save();

				AuditLog::ok(array(Auth::id(), 'request report', 'approval page', ' you approved the request id ' . $ok->id));



				//send email notification with the link to download report

				///buyReport/download/{companyId}/{reqId}

				$url_to_download = url('/buyReport/download/' . base64_encode($ok->company_id) . '/' . base64_encode($ok->id));

				$message = "

                Dear $cp->company_name,

                <br />

                <br />

                We would like to inform you that your request report to $cps->company_name has been approved.

                <br />

                To download report may click the link: $url_to_download

                <br />

                <br />

                Best Regards, <br />

                Prokakis Web Admin

                ";

				//send the email here

				if (filter_var($cp->company_email, FILTER_VALIDATE_EMAIL)) {

					Mailbox::sendMail($message, $cp->company_email, "Report Request has been approved, you may now download the report.", "");

				} else {

					echo 'Company as the information provider, has no valid email-address.';

				}



				echo 'Done, you will redirected to dashboard in 5 seconds.';

				sleep(5);



				return redirect('home');

			}



		}



	}



	public function reqRejectPage(Request $request) {

		if ($request->isMethod('post')) {

			$id = $request->input("repRequestId");

			$ok = RequestReport::find($id);



			if (count((array) $ok) > 0) {

				$ok->is_approve = 'no';



				$date = date('Y-m-d H:i:s');

				$date_ok = date_create($date);

				$date_final = date_format($date_ok, "Y-m-d H:i:s");



				RequestApproval::create([

					'req_rep_id' => $ok->id,

					'requester_company_id' => $ok->company_id,

					'company_id' => $ok->company_id,

					'is_accepted' => 'no',

					'main_consultant' => Auth::id(),

					'remarks' => $ok->fk_ooportunity_id . '-' . $ok->opportunity_type . '-' . $ok->company_name,

					'created_at' => $date_final,

					'status' => 1,

				]);



				$ok->save();

				AuditLog::ok(array(Auth::id(), 'request report', 'rejected page', ' you rejected the request id ' . $ok->id));



				echo 'Done, you will redirected to dashboard in 5 seconds.';

				sleep(5);



				return redirect('home');

			}

		}

	}



	public function requestCompanyUpdate(Request $request) {

		if (isset($request['id'])) {



			$prId = $request['id'];

			$pr = ProcessedReport::find($prId);



			if (isset($pr->report_link) && $pr->report_link != NULL) {

				return redirect('/monitoring/list')->with('message', 'Download link has expired.');

				exit;

			}

			$today = strtotime(date("Y-m-d"));



			if (isset($pr->month_subscription_start) && isset($pr->month_subscription_end)) {

				$dStart = strtotime($pr->month_subscription_start);

				$dEnd = strtotime($pr->month_subscription_end);

				if ($today < $dStart) {

					return redirect('/monitoring/list')->with('message', 'Download link subscription has not started.');

					exit;

				}

				if ($today > $dEnd) {

					return redirect('/monitoring/list')->with('message', 'Download link subscription has ended.');

					exit;

				}

			}



			if (count((array) $pr) > 0) {



				$company_id_result = CompanyProfile::getCompanyId(Auth::id());



				if ($pr->requester_company_id != $company_id_result) {

					return redirect('/home')->with('message', 'That was a restricted page, you can process only if it is your own record.');

					exit;

				}



				if (isset($pr->requester_company_id) && SpentTokens::validateLeftBehindToken($pr->requester_company_id) == false) {

					return redirect('monitoring/list')->with('message', 'Insufficient token value, please top up.');

					exit;

				}



				$approvalId = $pr->approval_id;



				$reqApproval = RequestApproval::find($approvalId); //can obtain request id

				$cr = CompanyProfile::find($pr->requester_company_id);



				$cp = CompanyProfile::find($pr->source_company_id);

				$prov = User::find($cp->user_id);



				SpentTokens::spendTokenByrequest($reqApproval->req_rep_id, $pr->requester_company_id, $cr->user_id, 1); //deduct 1 token



				$message = "

        Dear $cp->company_name,

        <br />

        <br />

        We would like to inform you that there is a report request, and it requires your updated company details.

        <br />

        To provide more details and check request status, please login to prokakis: http://ebos-app.prokakis.com/

        <br />

        <br />

        Best Regards, <br />

        Prokakis Web Admin

        ";



				//send the email here

				Mailbox::sendMail($message, $prov->email, "Report Request need your company details.", "");

				return redirect('/monitoring/list')->with('status', 'You have successfully sent a request for update.');



			} else {

				return redirect('/home')->with('message', 'That was a restricted page, you can process only if it is your own record.');

				exit;

			}

		}



	}



	public function requestDiscontinue(Request $request) {



		if (isset($request['id'])) {



			$prId = $request['id'];

			$pr = ProcessedReport::find($prId);



			if (count((array) $pr) > 0) {



				$company_id_result = CompanyProfile::getCompanyId(Auth::id());



				if ($pr->requester_company_id != $company_id_result) {

					return redirect('/home')->with('message', 'That was a restricted page, you can process only if it is your own record.');

					exit;

				}



				$pr->report_link = 'DISCONTINUE';

				$pr->save();

				return redirect('monitoring/list')->with('status', 'You have successfully discontinue a report subscription.');



			} else {

				return redirect('/home')->with('message', 'That was a restricted page, you can process only if it is your own record.');

				exit;

			}



		}



	}



	public function requestCompleted(Request $request) {



		if (isset($request['id'])) {



			$prId = $request['id'];

			$pr = ProcessedReport::find($prId);



			if (count((array) $pr) > 0) {



				$company_id_result = CompanyProfile::getCompanyId(Auth::id());



				if ($pr->requester_company_id != $company_id_result) {

					return redirect('/home')->with('message', 'That was a restricted page, you can process only if it is your own record.');

					exit;

				}



				$pr->report_link = 'COMPLETED';

				$pr->save();

				return redirect('monitoring/list')->with('status', 'You have successfully completed a report subscription.');



			} else {

				return redirect('/home')->with('message', 'That was a restricted page, you can process only if it is your own record.');

				exit;

			}



		}



	}



	public function requestersSummaryList() {

		$user_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		$listData = RequestReport::where('source_company_id', $company_id_result)->get();

		return view('reports.requesters', compact('listData'));

	}

	public function apiRequestReportER(){
		$data = [];
		$rs = RequestReport::all();
		if($rs != null){
		  foreach($rs as $d){	
		  $cp =	CompanyProfile::find($d->source_company_id);
		  $data[] = array('Request Id'=>$d->id, 'Company Id' => $cp->id, 'Company Name'=>$cp->company_name, 'Industry'=> $cp->industry);
		  }

		}

		return response()->json($data, 200);
	}




}

