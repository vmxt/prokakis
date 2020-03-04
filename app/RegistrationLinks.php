<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistrationLinks extends Model {

	protected $table = 'registration_links';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'category', 'link', 'status', 'token', 'created_at', 'created_by', 'updated_at', 'updated_by',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	//stand alone
	public static function generateToken() {
		$random_chars = '';
		$characters = array(
			"A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M",
			"N", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
			"1", "2", "3", "4", "5", "6", "7", "8", "9");

		//make an "empty container" or array for our keys
		$keys = array();

		//first count of $keys is empty so "1", remaining count is 1-7 = total 8 times
		while (count((array) $keys) - 1 < 10) {
			//five only as mentioned and promised at the chat
			//"0" because we use this to FIND ARRAY KEYS which has a 0 value
			//"-1" because were only concerned of number of keys which is 32 not 33
			//count($characters) = 33
			$x = mt_rand(0, count((array) $characters) - 1);
			if (!in_array($x, $keys)) {
				$keys[] = $x;
			}
		}

		foreach ($keys as $key) {
			$random_chars .= $characters[$key];
		}

		return $random_chars;
	}
}
