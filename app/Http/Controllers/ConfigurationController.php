<?php
namespace App\Http\Controllers;
use App\CompanyProfile;
use App\Configurations;
use App\ReportGenerationTemplate;
use App\ConsultantMapping;
use App\Countries;
use App\Http\Controllers\Controller;
use App\RequestReport;
use App\User;
use Auth;
use Illuminate\Http\Request;
class ConfigurationController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}
	public function index() {
		if (User::securePage(Auth::id()) != 5) {
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}
		$rs = Configurations::all();
		return view('sysconfig.index', compact('rs'));
	}
	public function reportGenTemplates() {
		if (User::securePage(Auth::id()) != 5) {
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}
		$rs = ReportGenerationTemplate::all();
		return view('sysconfig.reportGenerationManager', compact('rs'));
	}
	public function update(Request $request) {
		if ($request->isMethod('post')) {
			if ($request->ajax()) {
				$up_id = $request['config_id'];
				$up_desc = $request['config_desc'];
				$up_json = $request['config_json'];
				$rs = Configurations::find($up_id);
				$rs->description = trim($up_desc);
				$rs->json_value = trim($up_json);
				$rs->edited_by = Auth::id();
				$rs->save();
			}
		}
	}
	public function reportUpdate(Request $request) {
		if ($request->isMethod('post')) {
			if ($request->ajax()) {
				$up_id = $request['config_id'];
				$up_desc = $request['config_desc'];
				$content = $request['content'];
				$rs = ReportGenerationTemplate::find($up_id);
				$rs->content = trim($content);
				$rs->save();
			}
		}
	}
	public function assignConsultants() {
		if (User::securePage(Auth::id()) != 5) {
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}
		$masterCon = User::where('status', 1)->where('user_type', 3)->get(); //retrieve the consultants only
		$subCon = User::where('status', 1)->where('user_type', 2)->get(); //retrieve the consultants only
		$consMap = ConsultantMapping::getConsulNames();
		$countries = Countries::all();
		return view('sysconfig.assconsultants', compact('masterCon', 'subCon', 'consMap', 'countries'));
	}
	public function storeConsultants(Request $request) {
		if (User::securePage(Auth::id()) != 5) {
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}
		if ($request->isMethod('post')) {
			if ($request->input('consultantMain') == '0') {
				return redirect('/sysconfig/assignConsultants')->with('message', 'Please select a main consultant.');
				exit;
			}
			if ($request->input('country') == '0') {
				return redirect('/sysconfig/assignConsultants')->with('message', 'Please select a country');
				exit;
			}
			if ($request->input('mapping_id') == '0') {
				$foundCountry = ConsultantMapping::where('country_id', $request->input('country'))->get();
				if (count($foundCountry) > 0) {
					$cc = Countries::where('country_code', $request->input('country'))->first();
					return redirect('/sysconfig/assignConsultants')->with('message', 'There is already a group created for this country "' . $cc->country_name . '", please try other.');
					exit;
				}
				$ok = ConsultantMapping::create([
					'consultant_main' => ($request->input('consultantMain') == '0') ? null : $request->input('consultantMain'),
					'consultant_sub1' => ($request->input('consultantA') == '0') ? null : $request->input('consultantA'),
					'consultant_sub2' => ($request->input('consultantB') == '0') ? null : $request->input('consultantB'),
					'country_id' => ($request->input('country') == '0') ? null : $request->input('country'),
					'status' => '1',
					'created_at' => date('Y-m-d'),
					'added_by' => Auth::id(),
				]);
				return redirect('/sysconfig/assignConsultants')->with('status', 'Consultants group has been succesfully saved.');
			} else {
				$id = $request->input('mapping_id');
				$ok = ConsultantMapping::find($id);
				$ok->consultant_main = ($request->input('consultantMain') == '0') ? null : $request->input('consultantMain');
				$ok->consultant_sub1 = ($request->input('consultantA') == '0') ? null : $request->input('consultantA');
				$ok->consultant_sub2 = ($request->input('consultantB') == '0') ? null : $request->input('consultantB');
				$ok->country_id = ($request->input('country') == '0') ? null : $request->input('country');
				$ok->edited_by = Auth::id();
				$isok = $ok->save();
				return redirect('/sysconfig/assignConsultants')->with('status', 'Consultants group has been succesfully updated.');
			}
		}
	}
	public function editConsultants(Request $request) {
		if (User::securePage(Auth::id()) != 5) {
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}
		if ($request->isMethod('post')) {
			$id = $request->input('edit_consul');
			$dataC = ConsultantMapping::find($id);
			$masterCon = User::where('status', 1)->where('user_type', 3)->get(); //retrieve the consultants only
			$subCon = User::where('status', 1)->where('user_type', 2)->get(); //retrieve the consultants only
			$consMap = ConsultantMapping::getConsulNames();
			$countries = Countries::all();
			return view('sysconfig.assconsultants', compact('masterCon', 'subCon', 'consMap', 'dataC', 'countries'));
		}
	}
	public function delConsultants(Request $request) {
		if (User::securePage(Auth::id()) != 5) {
			return redirect('home')->with('message', 'You are restricted to open this "Settings" page, only for the administrator.');
		}
		if ($request->isMethod('post')) {
			$id = $request->input('del_consul');
			$data = ConsultantMapping::find($id);
			$ok = $data->delete();
			if ($ok) {
				return redirect('/sysconfig/assignConsultants')->with('status', 'Consultants group has been succesfully deleted.');
			}
		}
	}
	//request approval
	public function reqApprovalPage(Request $request) {
		$reqID = $request['reqID'];
		$companyID = $request['companyID'];
		$sourceID = $request['sourceID'];
		$reqID_decode = base64_decode($reqID);
		$companyID_decode = base64_decode($companyID);
		$sourceID_decode = base64_decode($sourceID);
		$result = RequestReport::where('id', $reqID_decode)->where('company_id', $companyID_decode)->where('is_approve', null)->first();
		if (count((array) $result) > 0) {
			$company_data2 = CompanyProfile::find($sourceID_decode);
			if (count((array) $company_data2) > 0) {
			    
			    $user_id = Auth::id();

			    $usr = User::find($user_id);
			    if($usr->user_type == "3"){
    				$company_data = CompanyProfile::find($companyID_decode);
    				return view("sysconfig.approval", compact('company_data2', 'company_data', 'result'));
			    }
			    else{
			        return redirect('/logout');
			    }
			} else {
				echo 'Invalid source ID.';
			}
		} else {
			echo 'This link is already been acknowledge.';
		}
	}
	public function searchCompany(Request $request) {
		if ($request->isMethod('get')) {
			$companySearch = '';
			$searchKey = $request->input("seach_entry_key");
			if (trim($searchKey) != '' && trim($searchKey) != 'show-all') {
					$companySearch = CompanyProfile::Where('company_name', 'like', '%' . $searchKey . '%')->paginate(6);
					//$companySearch = CompanyProfile::Where('company_name', 'like', '%' . $searchKey . '%')->get();
			} else if(trim($searchKey) == '') {
					$companySearch = CompanyProfile::paginate(6);
			}else if(trim($searchKey) == 'show-all') {
					$companySearch = CompanyProfile::paginate(6);
			}
			return view('oppor.companysearch', compact('companySearch'));
		}
	}
}
