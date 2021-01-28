<?php



namespace App\Http\Controllers;



use App\BrandSlogan;

use App\BusinessOpportunitiesNews;

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

use App\CompanyProfile;

use App\RequestReport;



class ReferralController extends Controller {



	/**



	 * Create a new controller instance.



	 *



	 * @return void



	 */



	public function __construct() {



		//$this->middleware('auth');



	}



	public function showRegistrationForm(Request $request) {



		if (isset($request['usertype']) && isset($request['token'])) {



			$rec = RegistrationLinks::where('token', $request['token'])->where('category', $request['usertype'])->where('status', 1)->first();



			if ( $rec != null) {



				if ($rec->category == 'Eboss-Staff') {



					return view('auth.registerStaff');



				} elseif ($rec->category == 'Mas-Con') {



					return view('auth.registerMasCon');



				} elseif ($rec->category == 'Sub-Con') {



					return view('auth.registerSubCon');



				}



			} else {



				header("HTTP/1.1 401 Unauthorized");



				exit;



			}



		}



	}



	public function showRefRegistrationForm(Request $request) {



		if (isset($request['userId'])) {



			$userId_Decoded = base64_decode($request['userId']);



			//echo $userId_Decoded;



			$rec = \App\User::find($userId_Decoded);



			if ($rec != null) {



				return view('auth.registerReferrals', compact('userId_Decoded'));



			} else {



				header("HTTP/1.1 401 Unauthorized");



				exit;



			}



		}



	}

	public function apiRequestReportER(){
		$data = [];
		$rs = RequestReport::all();
		if($rs != null){
		  foreach($rs as $d){	
		  $cp =	CompanyProfile::find($d->source_company_id);
		  $data[] = array('RequestId'=>$d->id, 'CompanyId' => $cp->id, 'CompanyName'=>$cp->company_name, 'Industry'=> $cp->industry);
		  }

		}

		return response()->json($data, 200);
	}




}

