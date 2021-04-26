<?php

namespace App\Http\Controllers;


use App\BusinessOpportunitiesNews;
use App\CompanyProfile;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\SpentTokens;
use Validator;
use File;
use App\AuditLog;

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



				if ($ok != null) {

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

	public function retNewsContent(Request $request){

		if($request->isMethod('get')) {
			$id = $request['id'];
			$bn = BusinessOpportunitiesNews::find($id);
			if($bn != null){
				return $bn->content_business;
			}
		}
	}

	public function retNewsDetails(Request $request){

		if($request->isMethod('get')) {
			$id = $request['id'];
			$bn = BusinessOpportunitiesNews::find($id);
			if($bn != null){
				return $bn;
			}
		}


	}

	public function delNews(Request $request){

		if ($request->isMethod('post')) {
			
			$user_id = Auth::id();
			$company_id = CompanyProfile::getCompanyId($user_id);
			$newsId = $request->input('newsId');
			$rs = BusinessOpportunitiesNews::where('id', $newsId)->where('company_id', $company_id)->where('user_id', $user_id)->first();

			if($rs != null){
				$rs->status = 0;
				$rs->save();
				AuditLog::ok(array($user_id, 'business opportunity', 'delete', 'Delete Business News'));
			}
	
		}

	}

	public function saveNews(Request $request){

		if ($request->isMethod('post')) {
			
			$user_id = Auth::id();

			$validation = Validator::make($request->all(), [
		      'newsFeatureImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
		    ]);


			$company_id = CompanyProfile::getCompanyId($user_id);
			
			$feature_image_name = "";
			if($validation->passes())
		    {
				$image = $request->file('newsFeatureImage');
      			$feature_image_name = $company_id.$user_id.rand() . '.' . $image->getClientOriginalExtension();
		    }

			$businessnewsArea = $request->input('newsContent');
			$businessTitle = $request->input('newsTitle');

			$token = SpentTokens::validateLeftBehindToken($company_id);
			
			$countNews = 0;

			if($token == false){ //free account
				$countNews = BusinessOpportunitiesNews::where('company_id', $company_id)->where('status', 1)->count();

				if($countNews < 10){
					BusinessOpportunitiesNews::create([

						'user_id' => $user_id,

						'company_id' => $company_id,

						'content_business' => $businessnewsArea,

						'business_title' => $businessTitle,

						'created_at' => date('Y-m-d'),

						'status' => '1',

						'feature_image' => $feature_image_name

					]);

					AuditLog::ok(array($user_id, 'business opportunity', 'create', 'Create Business News'));

				} else {

					return 'Exceed to the allowed number of news content as FREE account';
				}

			} else { //premium account

				BusinessOpportunitiesNews::create([

					'user_id' => $user_id,

					'company_id' => $company_id,

					'content_business' => $businessnewsArea,

					'business_title' => $businessTitle,

					'created_at' => date('Y-m-d'),

					'status' => '1',

					'feature_image' => $feature_image_name

				]);

			}	
			if($validation->passes())
		    {
				$image->move(public_path('company/feature_images'), $feature_image_name);
		    }
		}
	}

	public function updateNews(Request $request){

		if ($request->isMethod('post')) {
			
			$user_id = Auth::id();

		    $validation = Validator::make($request->all(), [
		      'newsFeatureImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
		    ]);

			// $imageName = time().'.'.$request->input('newsFeatureImage')->getClientOriginalExtension();
		    
			$company_id = CompanyProfile::getCompanyId($user_id);
			
			$businessnewsArea = $request->input('newsContent');
			$businessTitle = $request->input('newsTitle');
			$newsId = $request->input('newsId');


			$rs = BusinessOpportunitiesNews::where('id', $newsId)->where('company_id', $company_id)->where('user_id', $user_id)->first();
			$feature_image_name = $rs->feature_image;
			if($validation->passes())
		    {
				$image = $request->file('newsFeatureImage');
      			$feature_image_name = $company_id.$user_id.rand() . '.' . $image->getClientOriginalExtension();
		    }
			
			if($rs != null){
				$filename = public_path('company/feature_images/'). $rs->feature_image;
				$rs->business_title = $businessTitle;
				$rs->content_business = $businessnewsArea;
				$rs->feature_image = $feature_image_name;
				$rs->save();

				AuditLog::ok(array($user_id, 'business opportunity', 'update', 'update Business News'));

				if($validation->passes())
		    	{	
		    		if(File::exists($filename)) {
						File::delete($filename);
		    		}
		    		$image->move(public_path('company/feature_images'), $feature_image_name);
		    	}else{
		    		return response()->json([
				       'message'   => $validation->errors()->all(),
				       'uploaded_image' => '',
				       'class_name'  => 'alert-danger'
				      ]);
		    	}
			}
		}
	}


	public function list(Request $request){
	
		$user_id = Auth::id();
		
		$company_id = CompanyProfile::getCompanyId($user_id);
	
			$rs = BusinessOpportunitiesNews::where('company_id',$company_id)->where('status', '1')->get();

			return view('businessnews.list', compact('rs'));


	}

}

