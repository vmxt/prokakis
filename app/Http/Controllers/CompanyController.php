<?php

namespace App\Http\Controllers;

use App\BrandSlogan;
use App\BusinessOpportunitiesNews;
use App\CompanyProfile;
use App\Http\Controllers\Controller;
use App\RegistrationLinks;
use App\UploadImages;
use App\WhoViewedMe;
use Auth;
use Config;
use Illuminate\Http\Request;

class CompanyController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		//$this->middleware('auth');

	}

	public function index(Request $request) {

		$user_id = Auth::id();

		$company_id = CompanyProfile::getCompanyId($user_id);

		$brand = base64_decode($request['brand']);

		if ($brand != 'viewer' . $request['id']) {

			echo "URL invalid.";

			sleep(5);

			// return redirect('opportunity/explore')->with('message', 'As of moment the company has not setup a public page.');

			exit;

		}

		$rs = BrandSlogan::where('company_id', $request['id'])->first();

		if ($rs->count() > 0 && isset($rs->user_id) && isset($rs->company_id)) {

			$profileAvatar = UploadImages::getFileNames($rs->user_id, $rs->company_id, Config::get('constants.options.profile'), 1);

			$profileCoverPhoto = UploadImages::getFileNames($rs->user_id, $rs->company_id, Config::get('constants.options.banner'), 1);

			$brand_slogan = CompanyProfile::getBrandSlogan($rs->user_id, $rs->company_id);

			// Session::put('brandName', $brand_slogan[0]);

			$businessNewsOpportunity = BusinessOpportunitiesNews::where('company_id', $request['id'])->first();

			$companyProfile = CompanyProfile::find($rs->company_id);

			if ($request['id'] != $company_id && $company_id != null) {

				WhoViewedMe::create([

					'presenter_company_id' => $request['id'],

					'viewer_company_id' => $company_id,

					'is_request' => 'no',

					'created_at' => date('Y-m-d'),

					'status' => 1,

				]);

			}

			return view("company.social", compact('profileAvatar', 'profileCoverPhoto', 'brand_slogan', 'businessNewsOpportunity', 'companyProfile'));

		} else {

			echo 'As of moment the company has not setup a public page.';

			return redirect('opportunity/explore')->with('message', 'As of moment the company has not setup a public page.');

		}

	}

	public function showRegistrationForm(Request $request) {

		if (isset($request['usertype']) && isset($request['token'])) {

			$rec = RegistrationLinks::where('token', $request['token'])->where('category', $request['usertype'])->where('status', 1)->first();

			if ( $rec->count() > 0) {

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

			if ($rec->count() > 0) {

				return view('auth.registerReferrals', compact('userId_Decoded'));

			} else {

				header("HTTP/1.1 401 Unauthorized");

				exit;

			}

		}

	}

}
