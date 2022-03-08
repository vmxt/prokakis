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
use App\ThomsonAuditTrail;
use PDF;

use App\ProkakisAccessToken;
use GuzzleHttp\Client;
class ThomsonController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
		$this->urlToken  = ProkakisAccessToken::getSCode();
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
	     $rURL = 'https://reputation.app-prokakis.com/api/v1/thomson/cclist?pauth='.$this->urlToken;
	       $client = new Client();
	       $rsToken = $client->get($rURL);
	       $result = $rsToken->getBody()->getContents();  
       		$rs = json_decode($result, true);

	     $country_list = $rs['country'];
	     $citenzenship_list =  $rs['citenzenship_list'];
	     session([
	     	'country_list' =>  $rs['country'],
	     	'citenzenship_list' =>  $rs['citenzenship_list'],
	 		]);
   		 return view('staff.search', compact('rr','country_list','citenzenship_list'));
		}
	}

	public function history()
	{
		if(User::getEBossStaffTrue(Auth::id()) == true)
        {	
	     $trail = ThomsonAuditTrail::orderBy('created_at','DESC')->get();
   		 return view('staff.audittrail', compact('trail'));
		}
	}

	public function refinitiveHistory(Request $request){
		if(!isset($request['ids'])){
			abort(403, 'Unauthorized action.');
		}
		$ids = $request['ids'];
		$result = ThomsonAuditTrail::find($ids);
		$info = unserialize($result->info);
		$request->merge(['first_name'=> isset($info['first_name'])?$info['first_name']:null ]);
		$request->merge(['last_name'=> isset($info['last_name'])?$info['last_name']:null ]);
		$request->merge(['nationality'=> isset($info['nationality'])?$info['nationality']:null ]);
		$request->merge(['passport'=> isset($info['passport'])?$info['passport']:null ]);
		$request->merge(['country_location'=> isset($info['country_location'])?$info['country_location']:null ]);
		$request->merge(['company_name'=> isset($info['company_name'])?$info['company_name']:null ]);
		$request->merge(['gender'=> isset($info['gender'])?$info['gender']:null ]);
		$request->merge(['dob'=> isset($info['dob'])?$info['dob']:null ]);
		$request->merge(['alias'=> isset($info['alias'])?$info['alias']:null ]);
		return $this->RequestThomsonSearch($request);
	}

public function RequestThomsonSearch($request){
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
			$searchParam = "";
			if($fn != null){
			  $search = $search ."<p> FIRST NAME: <b>". $fn.'</b> </p>';		
			  $searchParam .= "&first_name=".$fn;
			}
			if($ln != null){
				$search = $search ."<p> LAST NAME: <b>". $ln.'</b> </p>';	
			  	$searchParam .= "&last_name=".$ln;
			}
			if($n != null){
				$search = $search ."<p> NATIONALITY: <b>". $n.'</b> </p>';	
				$searchParam .= "&nationality=".$n;	
			}
			if($p != null){
				$search = $search ."<p> PASSPORT: <b>". $p.'</b> </p>';		
				$searchParam .= "&passport=".$p;	
			}
			if($cl != null){
				$search = $search ."<p> COUNTRY: <b>". $cl.'</b> </p>';		
				$searchParam .= "&country_location=".$cl;	
			}
			if($cn != null){
				$search = $search ."<p> COMPANY NAME: <b>". $cn.'</b> </p>';	
				$searchParam .= "&company_name=".$cn;		
			}
			if($g != null){
				$search = $search ."<p> GENDER CODE: <b>". $g.'</b></p>';		
				$searchParam .= "&gender=".$g;
			}

			if($dob != null){
				$search = $search ."<p> DATE OF BIRTH: <b>". $dob.'</b></p>';		
				$searchParam .= "&dob=".$dob;
			}

			if($alias != null){
				$search = $search ."<p> ALIAS: <b>". $alias.'</b></p>';		
				$searchParam .= "&alias=".$alias;
			}
		

	     	// $rURL = 'https://er.app-prokakis.com/api/v1/thomson/?pauth='.$this->urlToken;
	     	$rURL = "https://reputation.app-prokakis.com/public/api/v1/thomson/individual?pauth=".$this->urlToken.$searchParam;
	       	$client = new Client();
	       	$rsToken = $client->get($rURL);
	       	$result = $rsToken->getBody()->getContents();  
       		$rs = json_decode($result, true);
			// $rs = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, $dob, $alias, 'reuters_databank');
			//$rs2 = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, 'reuters_databank2');
			//$rs3 = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, 'reuters_databank3');
			
			$sumRec = $rs['sumRec']; //+ count((array) $rs2) + count((array) $rs3);
			$rs = array_merge($rs['Likely_Match'], $rs['Confirm_Match']);
			 session([
	     	    'dataSearch' =>  $rs
	 		]);
	 		
			$rr = ProcessedReport::getTheActiveRequestReport();
			if (session()->has('country_list')) {
			   $country_list = session('country_list');
			}

			if (session()->has('citenzenship_list')) {
			   $citenzenship_list = session('citenzenship_list');
			}

			//return view('staff.search', compact('rs', 'rs2', 'rs3', 'sumRec', 'search', 'rr'));
			// dd($rs);
			return view('staff.search', compact('rs', 'country_list', 'citenzenship_list', 'sumRec', 'search', 'rr', 'input'));
			
}

public function searchFound(Request $request){

		if ($request->isMethod('post')) {
			return $this->RequestThomsonSearch($request);
		}
	}

	public function searchFoundCompany(Request $request){

		if ($request->isMethod('post')) {

			$validatedData = $request->validate([
				'company_name' => 'required',
				'country_location' => 'required'
			]);	

			$cl = $request->input('country_location');
			$cn = $request->input('company_name');



			$search = '';
			$searchParam = "";
			if($cl != null){
				$search = $search ."<p> COUNTRY: <b>". $cl.'</b> </p>';	
				$searchParam .= "&country_location=".$cl;	
			}
			if($cn != null){
				$search = $search ."<p> COMPANY NAME: <b>". $cn.'</b> </p>';	
				$searchParam .= "&company_name=".$cn;	
			}


			$rURL = "https://reputation.app-prokakis.com/public/api/v1/thomson/company?pauth=".$this->urlToken.$searchParam;
	       	$client = new Client();
	       	$rsToken = $client->get($rURL);
	       	$result = $rsToken->getBody()->getContents();  
       		$rs = json_decode($result, true);

			$fn = null; $ln = null; $n = null; $p = null; $g = null; $dob = null; $alias = null;
		
			// $rs = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, $dob, $alias, 'reuters_databank');
			//$rs2 = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, 'reuters_databank2');
			//$rs3 = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g, 'reuters_databank3');
			
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
					
			ThomsonAuditTrail::create([
				'action' => "company_search",
				'requestor_id' => Auth::id(),
				'info'=>serialize($input)
			]);

			$sumRec = $rs['sumRec']; //+ count((array) $rs2) + count((array) $rs3);
			$rs = $rs['Likely_Match'];
			$rr = ProcessedReport::getTheActiveRequestReport();
			if (session()->has('country_list')) {
			   $country_list = session('country_list');
			}

			if (session()->has('citenzenship_list')) {
			   $citenzenship_list = session('citenzenship_list');
			}
			//return view('staff.search', compact('rs', 'rs2', 'rs3', 'sumRec', 'search', 'rr'));
// dd($rURL);
			return view('staff.search', compact('rs', 'country_list', 'citenzenship_list', 'sumRec', 'search', 'rr', 'input'));
			

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
			$rURL = 'https://reputation.app-prokakis.com/api/v1/thomson/search-ids/'.$ids.'?pauth='.$this->urlToken;
	       $client = new Client();
	       $rsToken = $client->get($rURL);
	       $result = $rsToken->getBody()->getContents();  
       		$rs = json_decode($result, true);
			$fileNameDownload = "Report". $rs['fileNameDownload'];
			$dataR = $rs['Likely_Match'];
			$pdf = PDF::loadView('staff.myPdfPrinting', compact('dataR','ids'));
			return $pdf->download($fileNameDownload . '.pdf');
			//return view('staff.myPdfPrinting', compact('dataR','ids'));

		}

	}

	public function pdfcasePrintDownload(Request $request){
		
		if(isset($request['ids'])){
			$ids = $request['ids'];
			$r_id = explode(",", $ids);

		//echo count($r_id); exit;

// 		   $rURL = 'https://reputation.app-prokakis.com/api/v1/thomson/search-ids/'.$ids.'?pauth='.$this->urlToken;
// 	       $client = new Client();
// 	       $rsToken = $client->get($rURL);
// 	       $result = $rsToken->getBody()->getContents();  
//       		$rs = json_decode($result, true);
 			$fileNameDownload = "Case Report".  " (".time().") ";
// 			$dataR = array_merge($rs['Likely_Match'], $rs['Confirm_Match']);
			$dataR = session('dataSearch');
			$pdf = PDF::loadView('staff.myPdfCasePrinting', compact('dataR','ids'));
			return $pdf->download($fileNameDownload . '.pdf');
			// return view('staff.myPdfCasePrinting', compact('dataR','ids'));

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
			$id = $request['id'];
            
			if ($rs->user_type != 4) {
				return redirect('/home')->with('message', 'Unauthorised opening of page.');
			}

        	       $rURL = 'https://reputation.app-prokakis.com/api/v1/thomson/search/'.$id.'?pauth='.$this->urlToken;
        	       $client = new Client();
        	       $rsToken = $client->get($rURL);
        	       $result = $rsToken->getBody()->getContents();  
               	    $data = json_decode($result, true);
               		
			if (count((array) $data) > 0) {

				$company_out = "";
				$rcp = explode(",", $data['COMPANIES']);
				if (count((array) $rcp) > 0) {
					foreach ($rcp as $cc) {
						if (!is_numeric($cc)) {
							$company_out = $company_out . $cc . ",";
						}
					}
				}

				$inserted_prokakis = '';
				if ($data['CREATED_AT'] != NULL) {
					$date1 = Carbon::createFromFormat('Y-m-d', $data['CREATED_AT']);
					// $date = date_create($data['CREATED_AT']);
					// $dateFinal = date_format($date, "Y-m-d");
					$dateFinal = Carbon::parse($date1)->format('Y-m-d');
					$inserted_prokakis = date("F j, Y", strtotime($dateFinal));
				}

				$updated_prokakis = '';
				if ($data['UPDATED'] != NULL) {
					$date2 = Carbon::createFromFormat('Y-m-d', $data['CREATED_AT']);

					// $date2 = date_create($data->UPDATED);
					// $dateFinal2 = date_format($date2, "Y-m-d");
					$dateFinal2 =  Carbon::parse($date2)->format('Y-m-d');
					$updated_prokakis = date("F j, Y", strtotime($dateFinal2));
				}

				return view('staff.printPreviewTR', compact('data', 'inserted_prokakis', 'company_out', 'updated_prokakis'));
			}

		}

	}



}