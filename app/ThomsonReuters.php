<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\ThomsonReuters2;
use App\ThomsonReuters3;
use App\RequestReport;
use App\ConsultantProjects;
use App\TR_reportgeneration;
use App\ProcessedReport;
use App\RequestApproval;

class ThomsonReuters extends Model {

	protected $table = 'reuters_databank';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'UID',
		'LAST_NAME',
		'FIRST_NAME',
		'ALIASES',
		'LOW_QUALITY_ALIASES',
		'ALTERNATIVE_SPELLING',
		'CATEGORY',
		'TITLE',
		'SUB_CATEGORY',
		'POSITION',
		'AGE',
		'DOB',
		'DOBS',
		'PLACE_OF_BIRTH',
		'DECEASED',
		'PASSPORTS',
		'PASSPORT_COUNTRY',
		'SSN',
		'IDENTIFICATION_NUMBERS',
		'LOCATIONS',
		'COUNTRIES',
		'CITIZENSHIP',
		'COMPANIES',
		'E_I',
		'LINKED_TO',
		'FURTHER_INFORMATION',
		'KEYWORDS',
		'EXTERNAL_SOURCES',
		'ENTERED',
		'UPDATED',
		'EDITOR',
		'AGE_DATE',
		'UPDATECATEGORY',
		'CREATED_AT',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'ID',
	];

	//FIRST_NAME, LAST_NAME, COMPANIES, FURTHER_INFORMATION, EXTERNAL_SOURCES
	/*
	      $fn = $request->input('first_name');
	              $ln = $request->input('last_name');
	              $n = $request->input('nationality');
	              $p = $request->input('passport');
	              $in = $request->input('identity_number');
	              $cl = $request->input('country_location');
	              $cn = $request->input('company_name');
*/
	public static function getMatched_FullParams($fname, $lname, $companies, $nationality, $passport, $countryLocation, $gender, $dob, $alias, $tbname) {
		$rs = array();

		$result = DB::table($tbname)
		->whereNotNull('UID');

		if ($fname != null) {
			$res = ucfirst($fname).'%';
			$result->whereRaw("LOWER(FIRST_NAME) LIKE '$res'");
		}

		if ($lname != null) {
			$res = '%'.strtoupper($lname).'%';
			$result->whereRaw("UPPER(LAST_NAME) LIKE '$res'");
		}

		if ($nationality != null) {
			$res = '%'.strtolower($nationality).'%';
			$result->whereRaw("LOWER(CITIZENSHIP) LIKE '$res'");
		}

		if ($passport != null) {
			$res = '%'.strtoupper($passport).'%';
			$result->whereRaw("UPPER(PASSPORTS) LIKE '$res'");
		}

		if ($gender != null) {
			$result->where('E_I','=',$gender);
		}

		if ($countryLocation != null) {
			$res = '%'.strtoupper($countryLocation).'%';
			$result->whereRaw("UPPER(COUNTRIES) LIKE '$res'");
		}

		if ($dob != null) {
			$result->where('DOB','=',$dob);
		}

		if ($alias != null) {
			$res = '%'.strtolower($alias).'%';
			$result->whereRaw("LOWER(ALIASES) LIKE '$res'");
		}

		if ($companies != null) {
			$res = '%'.strtolower($companies).'%';
			$result->whereRaw("LOWER(COMPANIES) LIKE '$res'");
		}
		// echo "<pre>";
		// print_r($companies);
		// print_r($countryLocation);
		// echo "</pre>";
		// $result = $result;
		return $result;
	}

	public static function searchAllThree($id){
		
		$c1 = ThomsonReuters::where('UID', $id)->count();
	
		if($c1 > 0){
			$r1 =	ThomsonReuters::where('UID', $id)->first();
			return $r1;

		} else {

			$c2 = ThomsonReuters2::where('UID', $id)->count();
			if($c2 > 0){
				$r2 =	ThomsonReuters2::where('UID', $id)->first();
				return $r2;

			} else {

				$c3 =	ThomsonReuters3::where('UID', $id)->count();
				if($c3 > 0){
					$r3 =	ThomsonReuters3::where('UID', $id)->first();
					return $r3;
				} else {
					return false;
				}
				
			}
			
		}
		
	}

	public static function getTheActiveRequestReport(){
		$approvals = array();	
		$d = ProcessedReport::whereDate('month_subscription_start', '<=', date('Y-m-d'))
		->whereDate('month_subscription_end', '>=',  date('Y-m-d'))
		->get();
		foreach($d as $s){
		 $approvals[] = $s->approval_id;
		}	
 
		$cp = RequestApproval::whereIn('id', $approvals)->get();
 
			 $active_ids = [];
			 $rr = null;
 
			 if($cp != null){
				 foreach($cp as $c){
					 $active_ids[] = $c->req_rep_id;
				 }
			 }
	 
			 if(sizeof($active_ids) > 0){
			 $rr = RequestReport::whereIn('id', $active_ids)->get();
			 } 
			return $rr; 
	}

	public static function array_2d_to_1d($input_array) {
		$output_array = array();

		for ($i = 0; $i < count((array) $input_array); $i++) {
			for ($j = 0; $j < count((array) $input_array[$i]); $j++) {
				$output_array[] = $input_array[$i][$j];
			}
		}

		return $output_array;
	}

	public static function getMatched_Full($fname, $lname, $companies) {
		$rs = null;

		if ($fname != null && $lname != null && $companies != null) {
			$rs = ThomsonReuters::where("FIRST_NAME", "=", $fname)->where("LAST_NAME", "=", $lname)
				->Where("COMPANIES", "LIKE", '%' . $companies . '%')
				->Where("FURTHER_INFORMATION", "LIKE", '%' . $companies . '%')
				->get();
		}

		if ($fname == null && $lname == null && $companies != null) {
			$rs = ThomsonReuters::Where("COMPANIES", "LIKE", '%' . $companies . '%')
				->Where("FURTHER_INFORMATION", "LIKE", '%' . $companies . '%')
				->get();
		}

		if ($fname != null && $lname != null && $companies == null) {
			$rs = ThomsonReuters::where("FIRST_NAME", "=", $fname)->where("LAST_NAME", "=", $lname)
				->get();
		}

		if ($fname != null && $lname == null && $companies == null) {
			$rs = ThomsonReuters::where("FIRST_NAME", "=", $fname)
				->get();
		}

		if ($fname == null && $lname != null && $companies == null) {
			$rs = ThomsonReuters::where("LAST_NAME", "=", $lname)
				->get();
		}

		if (count((array) $rs) > 0) {
			return $rs;
		} else {
			return null;
		}

	}

	public static function getMatched_FirstLastName($fname, $lname) {
		$rs = ThomsonReuters::where("FIRST_NAME", "=", $fname)->where("LAST_NAME", "=", $lname)->get();
		if (count((array) $rs) > 0) {
			return $rs;
		} else {
			return null;
		}

	}

	public static function getMatched_Companies($data) {
		$rs = ThomsonReuters::where("COMPANIES", "LIKE", '%' . $data . '%')->get();
		if (count((array) $rs) > 0) {
			return $rs;
		} else {
			return null;
		}

	}

	public static function getMatched_FurtherInformation($data) {
		$rs = ThomsonReuters::where("FURTHER_INFORMATION", "LIKE", '%' . $data . '%')->get();
		if (count((array) $rs) > 0) {
			return $rs;
		} else {
			return 0;
		}

	}

	public static function getMatched_ExternalSources($data) {
		$rs = ThomsonReuters::where("EXTERNAL_SOURCES", "LIKE", '%' . $data . '%')->get();

		if (count((array) $rs) > 0) {
			return $rs;
		} else {
			return 0;
		}

	}

}
