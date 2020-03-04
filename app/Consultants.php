<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Consultants extends Model {

	protected $table = 'consultant_profiles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'consultant_id', 'name', 'identity_passport_number', 'dob', 'bank_id',
		'bank_type', 'account_number', 'payment_method', 'email_address',
		'phone_number', 'phone_type', 'company_description',
		'company_services', 'consultant_type',
		'created_at', 'updated_at', 'added_by', 'updated_by',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public static function getProfileCompleteness($consul_id, $certificate) {
		$cp = Consultants::where('consultant_id', $consul_id)->first();
		if ($cp->count() > 0) {
			$n = 1;
			$runSum = 0;
			$runSum = (isset($cp->name) && strlen($cp->name) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->identity_passport_number) && strlen($cp->identity_passport_number) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->dob) && strlen($cp->dob) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->bank_id) && strlen($cp->bank_id) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->bank_type) && strlen($cp->bank_type) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->account_number) && strlen($cp->account_number) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->payment_method) && strlen($cp->payment_method) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->email_address) && strlen($cp->email_address) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->phone_number) && strlen($cp->phone_number) > 0) ? ($runSum + $n) : ($runSum + 0);
			$runSum = (isset($cp->phone_type) && strlen($cp->phone_type) > 0) ? ($runSum + $n) : ($runSum + 0);

			if (count((array)$certificate) - 1 > 0) {
				$runSum = $runSum + 1;
			}

			$result = $runSum * 9.09;
			$finalres = 0;

			if ($result == 99.99) {
				$finalres = 100;
			} else {
				$finalres = $result;
			}

			return $finalres;
		}
	}

	public static function profileStrengthMessages($consul_id) {
		$cp = Consultants::where('consultant_id', $consul_id)->first();
		if ($cp->count() > 0) {
			$runSum = array();
			$runSum[] = (isset($cp[0]->name) && strlen($cp[0]->name) > 0) ? null : "Add company description";
			$runSum[] = (isset($cp[0]->identity_passport_number) && strlen($cp[0]->identity_passport_number) > 0) ? null : "Add company unique entity number";
			$runSum[] = (isset($cp[0]->dob) && strlen($cp[0]->dob) > 0) ? null : "Add company registered number";
			$runSum[] = (isset($cp[0]->bank_id) && strlen($cp[0]->bank_id) > 0) ? null : "Add company year founded";
			$runSum[] = (isset($cp[0]->bank_type) && strlen($cp[0]->bank_type) > 0) ? null : "Add company registered address";
			$runSum[] = (isset($cp[0]->account_number) && strlen($cp[0]->account_number) > 0) ? null : "Add company number of employees";
			$runSum[] = (isset($cp[0]->payment_method) && strlen($cp[0]->payment_method) > 0) ? null : "Add estimated sales currency";
			$runSum[] = (isset($cp[0]->email_address) && strlen($cp[0]->email_address) > 0) ? null : "Add estimated sales amount value";
			$runSum[] = (isset($cp[0]->phone_number) && strlen($cp[0]->phone_number) > 0) ? null : "Add company primary country";
			$runSum[] = (isset($cp[0]->phone_type) && strlen($cp[0]->phone_type) > 0) ? null : "Add company ownership status";

			$emptyRemoved = array_filter($runSum);
			return $emptyRemoved;
		}
	}

}
