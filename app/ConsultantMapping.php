<?php

namespace App;
use App\User;
use DB;
use Illuminate\Database\Eloquent\Model;

class ConsultantMapping extends Model {

	protected $table = 'consultant_mapping';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'consultant_main', 'consultant_sub1', 'consultant_sub2', 'country_id', 'status', 'remarks', 'created_at', 'updated_at', 'added_by', 'edited_by',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public static function getConsulNames() {

		$users = DB::table('consultant_mapping')
			->leftjoin('users as cm1', 'cm1.id', '=', 'consultant_mapping.consultant_main')
			->leftjoin('users as cm2', 'cm2.id', '=', 'consultant_mapping.consultant_sub1')
			->leftjoin('users as cm3', 'cm3.id', '=', 'consultant_mapping.consultant_sub2')
			->leftjoin('apps_countries', 'apps_countries.country_code', '=', 'consultant_mapping.country_id')
			->select('consultant_mapping.id as MappingId',
				'cm1.firstname as MainConsultant',
				'cm1.lastname as MainConsultantLastname',
				'cm2.firstname as Sub1Consultant',
				'cm2.lastname as Sub1ConsultantLastname',
				'cm3.firstname as Sub2Consultant',
				'cm3.lastname as Sub2ConsultantLastname',
				'apps_countries.country_name as country_name')
			->get();

		return $users;
	}

	public static function getSubConsultantsByMaster($master_id) {
		$users = DB::table('consultant_mapping')
			->leftjoin('users as cm1', 'cm1.id', '=', 'consultant_mapping.consultant_main')
			->leftjoin('users as cm2', 'cm2.id', '=', 'consultant_mapping.consultant_sub1')
			->leftjoin('users as cm3', 'cm3.id', '=', 'consultant_mapping.consultant_sub2')
			->leftjoin('apps_countries', 'apps_countries.country_code', '=', 'consultant_mapping.country_id')
			->select('consultant_mapping.id as MappingId',
				'cm1.id as MainConsultantID',
				'cm1.firstname as MainConsultant',
				'cm1.lastname as MainConsultantLastname',
				'cm2.id as Sub1ConsultantID',
				'cm2.firstname as Sub1Consultant',
				'cm2.lastname as Sub1ConsultantLastname',
				'cm3.id as Sub2ConsultantID',
				'cm3.firstname as Sub2Consultant',
				'cm3.lastname as Sub2ConsultantLastname',
				'apps_countries.country_name as country_name')
			->where('consultant_mapping.consultant_main', $master_id)
			->get();

		return $users;
	}

	public static function convertToConsultant($id) {
		if ($id != NULL) {
			$usr = User::find($id);
			if (count((array) $usr) > 0) {
				$usr->user_type = 2;
				$usr->save();
			}
		}
	}
}
