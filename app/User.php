<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use App\AccountSwitch;

use Session;

class User extends Authenticatable {

	use Notifiable;

	/**

	 * The attributes that are mass assignable.

	 *

	 * @var array

	 */

	protected $fillable = [

		'firstname', 'lastname', 'phone', 'email', 'password', 'company_name', 'company_website', 'status', 'activation_code', 'password', 'remember_token', 'created_at',  'user_type', 'referral_id', 'm_id',

	];

	/**

	 * The attributes that should be hidden for arrays.

	 *

	 * @var array

	 */

	protected $hidden = [

		'id',

	];

	public static function securePage($id) {

		$usr = User::find($id);

		if (count((array) $usr) > 0) {

			return $usr->user_type;

		}

	}

	public static function getFullnameUser($id) {

		$usr = User::find($id);

		if (count((array) $usr) > 0) {

			return $usr->firstname. " ". $usr->lastname;

		}

	}

	public static function validateAccountNavigations($id) {

		$usr = User::find($id);

		if ( count((array) $usr) > 0) {

			if ($usr->user_type == '2' || $usr->user_type == '3') {

				if (Session::get('SwitchedAccount') != '') {

					return Session::get('SwitchedAccount');

				} else {

					return $usr->user_type;

				}

			} else {

				return $usr->user_type;

			}

		}

	}

	//return true only if the user is from EBOS

	public static function getEBossStaffTrue($id) {

		$usr = User::find($id);

		if (count((array) $usr) > 0) {

			if ($usr->user_type == 5 || $usr->user_type == 4) {

				return true;

			} else {

				return false;

			}

		} else {

			return false;

		}

	}

}
