<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use App\ThomsonReuters2;
use App\ThomsonReuters3;

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
	public static function getMatched_FullParams($fname, $lname, $companies, $nationality, $passport, $countryLocation, $gender, $tbname) {
		$rs = array();
		//

		$SQL = "SELECT * FROM $tbname WHERE UID IS NOT NULL";

		if ($fname != null) {
			$SQL = $SQL . " AND FIRST_NAME = :fname";
			$rs[':fname'] = $fname;
		}
		if ($lname != null) {
			$SQL = $SQL . " AND LAST_NAME = :lname";
			$rs[':lname'] = $lname;
		}
	
		if ($nationality != null) {
			$SQL = $SQL . " AND CITIZENSHIP = :nationality";
			$rs[':nationality'] = $nationality;
		}
		if ($passport != null) {
			$SQL = $SQL . " AND PASSPORTS = :passport";
			$rs[':passport'] = $passport;
		}
	
		if ($gender != null) {
			$SQL = $SQL . " AND E_I = :gender";
			$rs[':gender'] = $gender;
		}

		if ($countryLocation != null) {
			$SQL = $SQL . " AND COUNTRIES = :countryLocation ";
			$rs[':countryLocation'] = $countryLocation;
		}
		if ($companies != null) {
			$SQL = $SQL . " AND COMPANIES LIKE '% ".$companies." %' ";
			//$rs[':companies'] = $companies;
		}

		//print_r($rs);
		//echo '<br />'.$SQL;
		//exit;

		$results = DB::select(DB::raw($SQL), $rs);

		return $results;
	}

	public static function searchAllThree($id){
		$data = null;
	
		
		$data = ThomsonReuters::where('UID', $id)->first();
		if($data == null){
			$data = ThomsonReuters2::where('UID', $id)->first();
			if($data == null){
				$data = ThomsonReuters3::where('UID', $id)->first();
			}
		} 
		return $data;
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
