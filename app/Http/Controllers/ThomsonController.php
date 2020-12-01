<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\ThomsonReuters;
use App\User;
use Auth;
use DB;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;
use App\RequestReport;
use App\ConsultantProjects;
use App\TR_reportgeneration;
use App\ProcessedReport;
use App\RequestApproval;
use PDF;


class ThomsonController extends Controller {
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
	public function search()
	{
		if(User::getEBossStaffTrue(Auth::id()) == true)
        {	
	     $rr = ThomsonReuters::getTheActiveRequestReport();
	     $country_list = DB::table('reuters_databank')->select('COUNTRIES')->distinct('COUNTRIES')->get();
	     $citenzenship_list = DB::table('reuters_databank')->select('CITIZENSHIP')->distinct('CITIZENSHIP')->get();
   		 return view('staff.search', compact('rr','country_list','citenzenship_list'));
		}
	}

	public function searchFound(Request $request){

		if ($request->isMethod('post')) {

			// $validatedData = $request->validate([
			// 	'gender' => 'required',
			// 	'country_location' => 'required',
			// 	'dob' => 'date|date_format:Y-m-d|nullable',
			// 	],[
			// 	'dob.date' => 'Date of birth is not a valid date.',
			// 	'dob.date_format' => 'Date of birth should be in this format yyyy-mm-dd',
			// 	]);	


			$fn = $request->input('first_name');
			$ln = $request->input('last_name');
			$n = $request->input('nationality');
			$p = $request->input('passport');
			// $in = $request->input('identity_number');
			$cl = $request->input('country_location');
			$cn = $request->input('company_name');
			$g = $request->input('gender');
			
			$dob = $request->input('dob');
			$alias = $request->input('alias');

			$input = [
				'first_name' => $fn,
				'last_name' => $ln,
				'nationality' => $n,
				'passport' => $p,
				'country_location' => $cl,
				'company_name' => $cn,
				'gender' => $g,
				'dob' => $dob,
				'alias' => $alias
					];

			$search = '';
			if($fn != null){
			  $search = $search ."<p> FIRST NAME: <b>". $fn.'</b> </p>';		
			}
			if($ln != null){
				$search = $search ."<p> LAST NAME: <b>". $ln.'</b> </p>';		
			}
			if($n != null){
				$search = $search ."<p> NATIONALITY: <b>". $n.'</b> </p>';		
			}
			if($p != null){
				$search = $search ."<p> PASSPORT: <b>". $p.'</b> </p>';		
			}
			if($cl != null){
				$search = $search ."<p> COUNTRY: <b>". $cl.'</b> </p>';		
			}
			if($cn != null){
				$search = $search ."<p> COMPANY NAME: <b>". $cn.'</b> </p>';		
			}
			if($g != null){
				$search = $search ."<p> GENDER CODE: <b>". $g.'</b></p>';		
			}

			if($dob != null){
				$search = $search ."<p> DATE OF BIRTH: <b>". $dob.'</b></p>';		
			}

			if($alias != null){
				$search = $search ."<p> ALIAS: <b>". $alias.'</b></p>';		
			}
		
		
			$rs = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, $dob, $alias, 'reuters_databank');
			//$rs2 = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, 'reuters_databank2');
			//$rs3 = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, 'reuters_databank3');
			
			$sumRec = $rs->count(); //+ count((array) $rs2) + count((array) $rs3);
			$rs = $rs->get();
			$rr = ThomsonReuters::getTheActiveRequestReport();
	     	$country_list = DB::table('reuters_databank')->select('COUNTRIES')->distinct('COUNTRIES')->get();
			$citenzenship_list = DB::table('reuters_databank')->select('CITIZENSHIP')->distinct('CITIZENSHIP')->get();
			//return view('staff.search', compact('rs', 'rs2', 'rs3', 'sumRec', 'search', 'rr'));

			return view('staff.search', compact('rs', 'country_list', 'citenzenship_list', 'sumRec', 'search', 'rr', 'input'));
			

		}
	}

	public function searchFoundCompany(Request $request){

		if ($request->isMethod('post')) {

			$validatedData = $request->validate([
				'company_name' => 'required',
				'country_location' => 'required',
			]);	

			$cl = $request->input('country_location');
			$cn = $request->input('company_name');

			$search = '';
		
			if($cl != null){
				$search = $search ."<p> COUNTRY: <b>". $cl.'</b> </p>';		
			}
			if($cn != null){
				$search = $search ."<p> COMPANY NAME: <b>". $cn.'</b> </p>';		
			}
			
			$fn = null; $ln = null; $n = null; $p = null; $g = null; $dob = null; $alias = null;
		
			$rs = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, $dob, $alias, 'reuters_databank');
			//$rs2 = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, 'reuters_databank2');
			//$rs3 = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, 'reuters_databank3');
			
			$sumRec = $rs->count(); //+ count((array) $rs2) + count((array) $rs3);
			$rs = $rs->get();
			$rr = ThomsonReuters::getTheActiveRequestReport();
	     	$country_list = DB::table('reuters_databank')->select('COUNTRIES')->distinct('COUNTRIES')->get();
			$citenzenship_list = DB::table('reuters_databank')->select('CITIZENSHIP')->distinct('CITIZENSHIP')->get();
			//return view('staff.search', compact('rs', 'rs2', 'rs3', 'sumRec', 'search', 'rr'));

			return view('staff.search', compact('rs', 'country_list', 'citenzenship_list', 'sumRec', 'search', 'rr'));
			

		}
	}


	public function trProcess(Request $request){

		if ($request->isMethod('post')) {
		$user_id = Auth::id();	
		$reqId = $request->input('reqId');
		$UID = $request->input('uId');
		$UIDs = explode(",",$UID);

		$rr = RequestReport::find($reqId);	
			if($rr != null){	
				foreach($UIDs as $v){
					TR_reportgeneration::saveTR($v, $rr, $user_id);
				}
			}	

		}
	}

	public function trDelete(Request $request){

		if ($request->isMethod('post')) {
			$user_id = Auth::id();	
			$trId = $request->input('trId');
			
		    $tr = TR_reportgeneration::find($trId);
			if($tr != null){
				if($tr->added_by == $user_id){
					$tr->delete();
					return '1';
				} else {
					return '0';
				}
			}
		}
	}

	public function pdfPrintDownload(Request $request){
		
		if(isset($request['ids'])){
			$ids = $request['ids'];
			$r_id = explode(",", $ids);

		//echo count($r_id); exit;

			$fileNameDownload = implode("-",$r_id);

			$dataR = array();
			foreach($r_id as $t){
				$rs = ThomsonReuters::searchAllThree($t);
				//echo $t . '<br />';

				if($rs != null){
					$dataR[] = $rs;
					//echo $rs->FIRST_NAME . ' <br />';
				}
			}


			$pdf = PDF::loadView('staff.myPdfPrinting', compact('dataR'));
			return $pdf->download($fileNameDownload . '.pdf');
			//return view('staff.myPdfPrinting', compact('dataR'));

		}

	}

	public function getNationality(Request $request){
		$rs = DB::table('reuters_databank')->select('CITIZENSHIP')->distinct('CITIZENSHIP')->get();

		$arr = array();

		foreach ($rs as $data) {
			// $string = preg_replace( '/[^[:cntrl:]]/', '',$data->CITIZENSHIP);
			// $string = preg_replace( '/[^[:print:]\r\n]/', '',$string);
			$string = filter_var($data->CITIZENSHIP, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
			// $json = html_entity_decode($string);
			$arr[] = (object) ['CITIZENSHIP' => $string];
		}
		header('Content-Type: application/json');
		echo json_encode($arr);
	}

	public function getCountryLocation(){
		$rs = DB::table('reuters_databank')->select('COUNTRIES')->distinct('COUNTRIES')->get();
		$locations = array();
		$result = array();
		$answer = array();

		foreach ($rs as $d) {

			$arr = $d->COUNTRIES;

			// echo $arr.'<br />';

			$ar = explode(",", $arr);

			if (count((array) $ar) > 0) {

				foreach ($ar as $b) {

					$c = trim($b);

					if ($c != '-') {

						$locations[] = $c;

					}

				}

			}

		}

		$result = array_unique($locations);

		foreach ($result as $r) {

			$string = filter_var($r, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

			$string = str_replace("~", "-", $string);

			$answer[] = (object) ['LOCATIONS' => $string];

		}

		return json_encode($answer);

	}

	public function printPreview(Request $request){
		if (isset($request['id'])) {
			$user_id = Auth::id();
			$rs = User::find($user_id);
			$data = ThomsonReuters::find($request['id']);

			if ($rs->user_type != 4) {
				return redirect('/home')->with('message', 'Unauthorised opening of page.');
			}

			if (count((array) $data) > 0) {

				$company_out = "";
				$rcp = explode(",", $data->COMPANIES);
				if (count((array) $rcp) > 0) {
					foreach ($rcp as $cc) {
						if (!is_numeric($cc)) {
							$company_out = $company_out . $cc . ",";
						}
					}
				}

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

				return view('staff.printPreviewTR', compact('data', 'inserted_prokakis', 'company_out', 'updated_prokakis'));
			}

		}

	}



}
