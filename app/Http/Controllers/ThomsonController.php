<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\ThomsonReuters;
use App\User;
use Auth;
use DB;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;

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
	public function search() {
		return view('staff.search');
	}

	public function searchFound(Request $request) {
		if ($request->isMethod('post')) {

			$fn = $request->input('first_name');
			$ln = $request->input('last_name');
			$n = $request->input('nationality');
			$p = $request->input('passport');
			// $in = $request->input('identity_number');
			$cl = $request->input('country_location');
			$cn = $request->input('company_name');
			$g = $request->input('gender');

			$rs = ThomsonReuters::getMatched_FullParams($fn, $ln, $cn, $n, $p, $cl, $g);

			if ($rs != null) {
				return view('staff.search', compact('rs'));
			} else {

				return view('staff.search', compact('rs'));
			}
		}
	}

	public function getNationality(Request $request) {
		$rs = DB::table('reuters_databank')->select('CITIZENSHIP')->distinct('CITIZENSHIP')->get();

		$arr = array();

		foreach ($rs as $data) {
			// $string = preg_replace( '/[^[:cntrl:]]/', '',$data->CITIZENSHIP);
			// $string = preg_replace( '/[^[:print:]\r\n]/', '',$string);
			$string = filter_var($data->CITIZENSHIP, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
			// $json = html_entity_decode($string);
			$arr[] = (object) ['CITIZENSHIP' => $string];
		}

		return json_encode($arr);
	}

	public function getCountryLocation() {
		$rs = DB::table('reuters_databank')->select('LOCATIONS')->distinct('LOCATIONS')->get();
		$locations = array();
		$result = array();
		$answer = array();

		foreach ($rs as $d) {

			$arr = $d->LOCATIONS;

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

	public function printPreview(Request $request) {
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
