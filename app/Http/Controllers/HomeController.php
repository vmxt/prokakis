<?php



namespace App\Http\Controllers;


use App\BusinessOpportunitiesNews;

use App\CompanyProfile;

use App\ConsultantProjects;

use App\Consultants;

use App\Countries;

use App\GeneratedReport;

use App\Http\Controllers\Controller;

use App\ProcessedReport;

use App\RequestApproval;

use App\RequestReport;

use App\UploadImages;

use App\ChatHistory;

use App\User;

use App\CompanyFollow;

use Auth;

use Config;

use Illuminate\Http\Request;

use Session;

use App\PromotionToken;

use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\DB;

use App\InOutUsers;

class HomeController extends Controller {

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

	public function dashboard() {

		$user_id = Auth::id();



		//$userType = User::securePage($user_id);

		$userType = User::validateAccountNavigations($user_id);

		InOutUsers::insert_updateDB(array('user_id'=>$user_id, 'status'=>1));



		//if($userType == 1){

		//echo "Company";

		//}



		if ($userType == 2) {

			return redirect('homeSubConsul');

		}

		if ($userType == 3) {

			return redirect('homeMasterConsul');

		}



		if ($userType == 4) {

			return redirect('homeStaff');

		}



		if ($userType == 5) {

			return redirect('homeAdmin');

		}

		if ($userType == 6) {

			return redirect('homeSales');

		}

		if ($userType == 7) {
			return redirect('homeAP');
		}



		$company_id_result = CompanyProfile::getCompanyId($user_id);



		$c = CompanyProfile::find($company_id_result);

		if (count((array) $c) > 0) {

			$c->last_login = date('Y-m-d');

			$c->save();

		}


		$company_data = CompanyProfile::find($company_id_result);

		//echo $company_id_result; exit;

		$resBuild = ChatHistory::getChatHistoryBuildOpportunityUnseenTotal($company_id_result);
		$resSell = ChatHistory::getChatHistorySellOpportunityUnseenTotal($company_id_result);
		$resBuy = ChatHistory::getChatHistoryBuyOpportunityUnseenTotal($company_id_result);
		$oppoInbox = (int) $resBuild + (int) $resSell + (int) $resBuy;
		
		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

		$profileAwards = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.awards'), 5);

		$profilePurchaseInvoice = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.purchase_invoices'), 5);

		$profileSalesInvoice = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.sales_invoices'), 5);

		$profileCertifications = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.certification'), 5);



		$profileCoverPhoto = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.banner'), 1);



		$completenessProfile = CompanyProfile::profileCompleteness(array($company_data, $profileAvatar, $profileAwards,

			$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));



		$res = RequestReport::where('company_id', $company_id_result)->where('is_approve', NULL)->get();

		$pendingRequestReport = $res->count();



		//$ra = RequestApproval::where('requester_company_id', $company_id_result)->where('is_accepted', 'yes')->get();

		$ra = ProcessedReport::where('requester_company_id', $company_id_result)->where('report_link', NULL)->get();

		$ongoingMonitoring = $ra->count();



		$aw = RequestReport::where('source_company_id', $company_id_result)->where('is_approve', NULL)->get();

		$awaitingresponsetogenreport = $aw->count();;



		$genrep = GeneratedReport::where('requester_company_id', $company_id_result)->get();

		$generatedreport = $genrep->count();



		$proc_rep = ProcessedReport::where('requester_company_id', $company_id_result)->where('report_link', 'COMPLETED')->get();

		$process_report = $proc_rep->count();

		//add the promtion button
		//$promo = CompanyProfile::checkOppotunityCreation($company_id_result);
		$c_promo = PromotionToken::where('company_id', $company_id_result)->where('remarks', 'UPGRADE-TO-PREMIUM')->count();




		return view('home.dashboard', compact('completenessProfile', 'pendingRequestReport', 'ongoingMonitoring', 'awaitingresponsetogenreport', 'generatedreport', 'process_report','c_promo','oppoInbox'));

	}

public function index() {

		$resultData = [];
		$oppArr = [];
		$OppData = [];
		$businessNewsArr = [];
		$businessNewsData = [];
		$user_id = Auth::id();
		$company_follow = CompanyFollow::GetAllFollowCompany($user_id);
		$company_id_result = CompanyProfile::getCompanyId($user_id);
		$followingCount = $company_follow->count();
		$followerCount = CompanyFollow::checkFollowerCompany($company_id_result);
		$profileCoverPhoto = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.banner'), 1);
		$topBusinessNewsOpportunity = BusinessOpportunitiesNews::orderBy('updated_at','desc')->limit(5)->get();

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

//fetch result
		foreach ($company_follow->get() as $value) {
			$company_id = $value->id;

		### company
			// $res = 	[
			// 		'state' => 'company',
			// 		'updated_at' => $value->updated_at,
			// 		'content'=> [
			// 					'company_id'=>$value->id,
			// 					'company_name'=>$value->company_name,
			// 					'company_website'=>$value->company_website,
			// 					'description'=>$value->description
			// 					]
			// 		];
			// array_push($resultData, $res);	
		### company

		### business news
			$businessNewsOpportunity = BusinessOpportunitiesNews::where('company_id', $company_id)->get();
			array_push($businessNewsArr, $businessNewsOpportunity);	
			
		### business news

		### opportunity
			$resBuild = OpportunityBuildingCapability::where('company_id', $company_id)->where('status', 1)->get();
			$resSell = OpportunitySellOffer::where('company_id', $company_id)->where('status', 1)->get()->merge($resBuild);
			$resBuy = OpportunityBuy::where('company_id', $company_id)->where('status', 1)->get()->merge($resSell);
			array_push($oppArr, $resBuy);	
		### opportunity
		}

//fetch result
##modify Business News elements
		if(isset($businessNewsArr[0])) {
			foreach ($businessNewsArr as $value) {
				foreach ($value as $val) {
					$res = 	[
					'state' => 'businessNews',
					'updated_at' => $val->updated_at,
					'content'=> [
								'id'=>$val->id,
								'business_title'=>$val->business_title,
								'content_business'=>$val->content_business,
								'company_id'=>$val->company_id,
								'feature_image'=>$val->feature_image
								]
					];
					array_push($businessNewsData, $res);	
				}
			}
		}

		usort($businessNewsData, function($a, $b) {
		    return $a['updated_at'] < $b['updated_at'];
		});
		$businessNewsData = $this->paginate($businessNewsData);

##modify Business News elements
##modify opportunity elements
		if(isset($oppArr[0])) {
			foreach ($oppArr as $value) {
				foreach($value as $val){
					$res = 	[
					'state' => 'opportunity',
					'updated_at' => $val->updated_at,
					'content'=> [
								'oppo_id'=>$val->id,
								'opp_title'=>$val->opp_title,
								'intro_describe_business'=>$val->intro_describe_business,
								'oppo_description'=>$val->oppo_description,
								'industry'=>$val->industry
								]
					];
					array_push($OppData, $res);	
				}
			}
		}
		usort($OppData, function($a, $b) {
		    return $a['updated_at'] < $b['updated_at'];
		});
		$oppResultdata = $this->paginate($OppData);
##modify opportunity elements

		return view('home.index', compact('oppResultdata','businessNewsData', 'topBusinessNewsOpportunity','followingCount','followerCount','profileCoverPhoto','profileAvatar'));

	}


	//dashboard for sub consultant

	public function subConsultant() {

		$consul_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($consul_id);

		$profileCertifications = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.certification'), 5);

		$profileCompletenes = Consultants::getProfileCompleteness($consul_id, $profileCertifications);



		$rs_ongoing = ConsultantProjects::where('assigned_consultant_id', $consul_id)->where('project_status', 'ONGOING')->get();

		$countOngoing = 0;

		if (count((array) $rs_ongoing) > 0) {

			$countOngoing = count((array) $rs_ongoing);

		}



		$rs_done = ConsultantProjects::where('assigned_consultant_id', $consul_id)->where('project_status', 'DONE')->get();

		$countDone = 0;

		if (count((array) $rs_done) > 0) {

			$countDone = count((array) $rs_done);

		}



		return view('consultant.dashboard', compact('profileCompletenes', 'countOngoing', 'countDone'));

	}



	//dahsboard for master consultant

	public function masterConsultant() {

		$consul_id = Auth::id();

		$company_id_result = CompanyProfile::getCompanyId($consul_id);

		$profileCertifications = UploadImages::getFileNames($consul_id, $company_id_result, Config::get('constants.options.certification'), 5);

		$profileCompletenes = Consultants::getProfileCompleteness($consul_id, $profileCertifications);



		$rs_ongoing = ConsultantProjects::where('main_consultant_id', $consul_id)->where('project_status', 'ONGOING')->get();

		$countOngoing = 0;

		if (count((array) $rs_ongoing) > 0) {

			$countOngoing = count((array) $rs_ongoing);

		}



		$rs_done = ConsultantProjects::where('main_consultant_id', $consul_id)->where('project_status', 'DONE')->get();

		$countDone = 0;

		if (count((array) $rs_done) > 0) {

			$countDone = count((array) $rs_done);

		}



		$rs_pending = ConsultantProjects::where('main_consultant_id', $consul_id)->where('project_status', 'PENDING')->get();

		$countPending = 0;

		if (count((array) $rs_pending) > 0) {

			$countPending = count((array) $rs_pending);

		}



		$waitngApproval = 0;



		$rs_approval = ConsultantProjects::where('main_consultant_id', $consul_id)->get();

		$countApproval = 0;

		if (count((array) $rs_approval) > 0) {

			$countApproval = count((array) $rs_approval);

		}



		$rs = RequestApproval::where('main_consultant', $consul_id)->where('status', 1)->get();

		$arrRA = array();

		foreach ($rs as $d) {

			$arrRA[] = $d->id;

		}

		$RArec = 0;

		if (count((array) $arrRA) > 0) {

			$RArec = count((array) $arrRA);

		}

		$waitngApproval = ($RArec - $countApproval);

		if ($waitngApproval < 0) {

			$waitngApproval = 0;

		}



		return view('mconsultant.dashboard', compact('profileCompletenes', 'countOngoing', 'countDone', 'countPending', 'waitngApproval'));

	}



	public function ebosStaff() {

		return view('staff.dashboard');

	}

	public function ebosSales() {

		return view('sales.dashboard');

	}

	public function ebosAP() {
		return view('ap.dashboard');
	}


	//switching happens here consultant to company, and in vice versa

	public function switchAccount(Request $request) {

		if ($request->isMethod('post') && Auth::id()) {

			$user_id = Auth::id();

			$usr = User::find($user_id);

			$switchAccount = $request->input('switch_type');



			if ($usr->user_type == 2 || $usr->user_type == 3) {



				if ($switchAccount == 'to-company') {

					Session::put('SwitchedAccount', 1);

					return redirect('/home')->with('status', 'You have succesfully switched to your Company account. ');



				} else {

					Session::put('SwitchedAccount', '');

					return redirect('/home')->with('status', 'You have succesfully switched to your Consultant account. ');

				}



			}



		}



	}



	public function adminDashboard() {

		return view('admin.dashboard');

	}



	public function getCountries() {

		$rs = Countries::all();

		$arr = array();



		foreach ($rs as $d) {

			$arr[]['country'] = $d->country_name;

		}



		return json_encode($arr);



	}



	public function addCompany(Request $request) {

		if ($request->isMethod('post') && Auth::id()) {



			if ($request->input('company_name') == '') {

				return redirect('/home')->with('message', 'Company Name is reuired in creating a new profile. ');

				exit;



			} else {



				$data = array();

				$data['company_name'] = $request->input('company_name');

				$data['company_website'] = $request->input('company_website');

				CompanyProfile::createAnotherCompanyProfile(Auth::id(), $data);

				return redirect('/home')->with('status', 'You have succesfully created a new company profile. ');

				exit;

			}

		}



	}



	public function selectCompany(Request $request) {

		if ($request->isMethod('post') && Auth::id()) {



			$id = $request->input('selected_company_id');



			Session::put('SELECTED_COMPANY_ID', $id);



			$c = CompanyProfile::find($id);

			if (count((array) $c) > 0) {

				$c->last_login = date('Y-m-d');

				$c->save();

			}



			// Session::get('SELECTED_COMPANY_ID');

			return redirect('/home')->with('status', 'You have succesfully switched to another company profile. ');

			exit;

		}

	}



	public function referralsList(Request $request) {

		//generate referral link

		$userId = Auth::id();

		$url_result = CompanyProfile::generateReferralLinkEncoded($userId);



		$rs = User::where('referral_id', $userId)->get();
		$user_details = User::find($userId);
		$topReferral = User::select('referral_id', DB::raw('COUNT(referral_id) as count_refer'))
						->where('referral_id','!=',"null")
						->where('referral_status',"=",'2')
						->groupBy('referral_id')
					    ->orderByRaw('count_refer DESC')
					    ->limit(10)
					    ->get();

		return view('home.referrals', compact('url_result', 'rs', 'topReferral','user_details'));

		//get all referals

	}

	public function updateReferStatus(Request $request){
		if ($request->isMethod('post')) {
			$user_id = Auth::id();
			$referStatus = $request->input('referStatus');
			$result = User::find($user_id);
			if($result){
				$result->referral_status = $referStatus;
				$result->save();
			}
		}
	}



	public function getCompany() {

		$rs = CompanyProfile::all();

		$arr = array();

		foreach ($rs as $d) {

			$arr[] = \strtoupper($d->company_name);

		}

		return json_encode($arr);

	}

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }



}

