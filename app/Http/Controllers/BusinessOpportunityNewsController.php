<?php

namespace App\Http\Controllers;

use App\BusinessOpportunitiesNews;
use App\CompanyProfile;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class BusinessOpportunityNewsController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	public function index() {
		return view('businessnews.index');
	}

	public function store(Request $request) {

		if ($request->isMethod('post')) {
			// var_dump($_POST); exit;
			if ($request->input('btnSubmit') == "Save") {

				$user_id = Auth::id();
				$company_id = CompanyProfile::getCompanyId($user_id);

				$businessnewsArea = $request->input('businessnewsArea');
				$businessTitle = $request->input('businessTitle');

				$ok = BusinessOpportunitiesNews::where('user_id', $user_id)->where('company_id', $company_id)->first();

				if ($ok->count() > 0) {
					$o = BusinessOpportunitiesNews::find($ok->id);
					$o->content_business = $businessnewsArea;
					$o->business_title = $businessTitle;
					$o->save();

				} else {
					BusinessOpportunitiesNews::create([
						'user_id' => $user_id,
						'company_id' => $company_id,
						'content_business' => $businessnewsArea,
						'business_title' => $businessTitle,
						'created_at' => date('Y-m-d'),
					]);
				}

				return redirect('businessnews')->with('status', 'You have succesfully saved the content for Business News.');
			}

			if ($request->input('btnSubmit') == "Delete") {
				$user_id = Auth::id();
				$company_id = CompanyProfile::getCompanyId($user_id);
				$ok = BusinessOpportunitiesNews::where('user_id', $user_id)->where('company_id', $company_id)->first();
				if ($ok->count() > 0) {
					$ok->delete();
					return redirect('businessnews')->with('status', 'You have succesfully deleted the content for Business News.');
				}
			}

		}
	}
}
