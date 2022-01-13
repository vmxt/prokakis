<?php

namespace App;

use App\User;
use Config;
use Illuminate\Database\Eloquent\Model;
use Session;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;

class CompanyProfile extends Model {

	protected $table = 'company_profiles';

	/**

	 * The attributes that are mass assignable.

	 *

	 * @var array

	 */

	protected $fillable = [

		'user_id',

		'company_name',

		'description',

		'unique_entity_number',

		'registered_company_name',

		'year_founded',

		'registered_address',

		'office_phone',

		'mobile_phone',

		'company_website',

		'company_email',

		'facebook',

		'twitter',

		'linkedin',

		'googleplus',

		'otherlink',

		'number_of_employees',

		'estimatedsales_currency',

		'estimatedsales_value',

		'primary_country',

		'ownership_status',

		'business_type',

		'industry',

		'financial_year',

		'financial_month',

		'years_establishment',

		'annual_tax_return',

		'gross_profit',

		'net_profit',

		'currency',

		'no_of_staff',

		'paid_up_capital',

		'corporate_tax',

		'asset_more_liability',

		'financial_year_end',

		'solvent_value',

		'added_by',

		'edited_by',

		'status',

		'last_login',

	];

	/**

	 * The attributes that should be hidden for arrays.

	 *

	 * @var array

	 */

	protected $hidden = [

		'id', 'created_at', 'updated_at',

	];

	// public function company_user()

	// {

	//     return $this->hasOne('App\User', 'id');

	// }

	public static function getDeactivateInfo($companyId) {


		if ( $rs = CompanyProfile::find($companyId) ) {

			$usr = User::find($rs->user_id);

			if ( $usr->count() > 0) {

				if ((int) $usr->status == 0) {

					return false;

				} else {

					return true;

				}

			}

		}

	}

	public static function getProfileImage($user_id) {

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);

		return $profileAvatar;

	}

	public static function getProfileImageSC($user_id) {

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profileSC'), 1);

		return $profileAvatar;

	}

	public static function getProfileImageMC($user_id) {

		$company_id_result = CompanyProfile::getCompanyId($user_id);

		$profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profileMC'), 1);

		return $profileAvatar;

	}

	public static function getProfileFirstname($user_id) {

		$res = User::find($user_id);

		if ( $res->count() > 0 ) {

			return $res->firstname;

		}

	}

	public static function getBrandSlogan($userId, $companyId) {

		$c = BrandSlogan::where('user_id', $userId)

			->where('company_id', $companyId)

			->orderBy('id', 'desc')

			->take(1)

			->get();

		if (isset($c[0]->brand) && isset($c[0]->slogan)) {

			return array($c[0]->brand, $c[0]->slogan);

		} else {

			return array('Brand Name', 'Company Slogan');

		}

	}

	public static function getCompanyName($uid) {

		$rs = CompanyProfile::find($uid);

		if ( $rs->count() > 0) {

			return $rs->registered_company_name;

		}

	}

	public static function getCompanyId($uid) {

		if (Session::get('SELECTED_COMPANY_ID') != NULL || Session::get('SELECTED_COMPANY_ID') != '') {

			return Session::get('SELECTED_COMPANY_ID');

		} else {

			$result = CompanyProfile::where('user_id', $uid)
				->where('status',1)
				->orderBy('id', 'desc')

				->take(1)

				->get();

			if ($result != null && isset($result[0]->id)) {

				if ($result[0]->status == '1') {

					return $result[0]->id;

				}

			}

		}

	}

	public static function profileCompleteness($cp) {

		//16.7 each out of 6

		//4.5 each of of 22

		$n = 1;

		$runSum = 0;

		$runSum = (isset($cp[0]->description) && strlen($cp[0]->description) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->unique_entity_number) && strlen($cp[0]->unique_entity_number) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->registered_company_name) && strlen($cp[0]->registered_company_name) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->year_founded) && strlen($cp[0]->year_founded) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->registered_address) && strlen($cp[0]->registered_address) > 0) ? ($runSum + $n) : ($runSum + 0);

		// $runSum = (isset($cp[0]->no_of_staff) && strlen($cp[0]->number_of_employees) > 0)? ($runSum + $n) : ($runSum + 0);

		// $runSum = (isset($cp[0]->estimatedsales_currency) && strlen($cp[0]->estimatedsales_currency) > 0)? ($runSum + $n) : ($runSum + 0);

		// $runSum = (isset($cp[0]->estimatedsales_value) && strlen($cp[0]->estimatedsales_value) > 0)? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->primary_country) && strlen($cp[0]->primary_country) > 0) ? ($runSum + $n) : ($runSum + 0);

		// $runSum = (isset($cp[0]->ownership_status) && strlen($cp[0]->ownership_status) > 0)? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->business_type) && strlen($cp[0]->business_type) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->industry) && strlen($cp[0]->industry) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->financial_year_end) && strlen($cp[0]->financial_year_end) > 0) ? ($runSum + $n) : ($runSum + 0);

		// $runSum = (isset($cp[0]->financial_month) && strlen($cp[0]->financial_month) > 0)? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->years_establishment) && strlen($cp[0]->years_establishment) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->annual_tax_return) && strlen($cp[0]->annual_tax_return) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->gross_profit) && strlen($cp[0]->gross_profit) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->net_profit) && strlen($cp[0]->net_profit) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->currency) && strlen($cp[0]->currency) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->no_of_staff) && strlen($cp[0]->no_of_staff) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->paid_up_capital) && strlen($cp[0]->paid_up_capital) > 0) ? ($runSum + $n) : ($runSum + 0);

		$runSum = (isset($cp[0]->solvent_value) && strlen($cp[0]->solvent_value) > 0) ? ($runSum + $n) : ($runSum + 0);

		$rs = ($runSum / 18) * 100;

		$rsProfile = round($rs);

		$avatar = (strlen($cp[1]) > 0) ? 100 : 0;

		$awards = (count((array) $cp[2]) > 0) ? 100 : 0;

		$pinvoice = (count((array) $cp[3]) > 0) ? 100 : 0;

		$sinvoice = (count((array) $cp[4]) > 0) ? 100 : 0;

		$cert = (count((array) $cp[5]) > 0) ? 100 : 0;

		$rsUploads = ($avatar + $awards + $pinvoice + $sinvoice + $cert + $rsProfile);

		$finalResult = ($rsUploads / 600) * 100;

		$vic = ($finalResult >= 99) ? 100 : $finalResult;

		return round($vic);

	}

	public static function profileStrengthMessages($cp) {

		$runSum = array();

		$runSum[] = (isset($cp[0]->description) && strlen($cp[0]->description) > 0) ? null : "Add company description";

		$runSum[] = (isset($cp[0]->unique_entity_number) && strlen($cp[0]->unique_entity_number) > 0) ? null : "Add company unique entity number";

		$runSum[] = (isset($cp[0]->registered_company_name) && strlen($cp[0]->registered_company_name) > 0) ? null : "Add company company name";

		$runSum[] = (isset($cp[0]->year_founded) && strlen($cp[0]->year_founded) > 0) ? null : "Add company year founded";

		$runSum[] = (isset($cp[0]->registered_address) && strlen($cp[0]->registered_address) > 0) ? null : "Add company registered address";

		// $runSum[] = (isset($cp[0]->no_of_staff) && strlen($cp[0]->no_of_staff) > 0)? null : "Add company number of staff";

		// $runSum[] = (isset($cp[0]->estimatedsales_currency) && strlen($cp[0]->estimatedsales_currency) > 0)? null : "Add estimated sales currency";

		// $runSum[] = (isset($cp[0]->estimatedsales_value) && strlen($cp[0]->estimatedsales_value) > 0)? null : "Add estimated sales amount value";

		$runSum[] = (isset($cp[0]->primary_country) && strlen($cp[0]->primary_country) > 0) ? null : "Add company primary country";

		// $runSum[] = (isset($cp[0]->ownership_status) && strlen($cp[0]->ownership_status) > 0)? null : "Add company ownership status";

		$runSum[] = (isset($cp[0]->business_type) && strlen($cp[0]->business_type) > 0) ? null : "Add company business type";

		$runSum[] = (isset($cp[0]->industry) && strlen($cp[0]->industry) > 0) ? null : "Add company industry";

		$runSum[] = (isset($cp[0]->financial_year_end) && strlen($cp[0]->financial_year_end) > 0) ? null : "Add financial year";

		//$runSum[] = (isset($cp[0]->financial_month) && strlen($cp[0]->financial_month) > 0)? null : "Add financial month";

		$runSum[] = (isset($cp[0]->years_establishment) && strlen($cp[0]->years_establishment) > 0) ? null : "Add company year of establishment";

		$runSum[] = (isset($cp[0]->annual_tax_return) && strlen($cp[0]->annual_tax_return) > 0) ? null : "Add company annual tax return";

		$runSum[] = (isset($cp[0]->gross_profit) && strlen($cp[0]->gross_profit) > 0) ? null : "Add company gross profit";

		$runSum[] = (isset($cp[0]->net_profit) && strlen($cp[0]->net_profit) > 0) ? null : "Add company net profit";

		$runSum[] = (isset($cp[0]->currency) && strlen($cp[0]->currency) > 0) ? null : "Add company currency";

		$runSum[] = (isset($cp[0]->no_of_staff) && strlen($cp[0]->no_of_staff) > 0) ? null : "Add company number of staff";

		$runSum[] = (isset($cp[0]->paid_up_capital) && strlen($cp[0]->paid_up_capital) > 0) ? null : "Add company paid up capital";

		$runSum[] = (isset($cp[0]->solvent_value) && strlen($cp[0]->solvent_value) > 0) ? null : "Add company solvent or insolvent value";

		$runSum[] = (strlen($cp[1]) > 0) ? null : "Add company profile image";

		$runSum[] = (count((array) $cp[2]) > 0) ? null : "Add company awards";

		$runSum[] = (count((array) $cp[3]) > 0) ? null : "Add company purchase invoice";

		$runSum[] = (count((array) $cp[4]) > 0) ? null : "Add company sales invoice";

		$runSum[] = (count((array) $cp[5]) > 0) ? null : "Add company certificates";

		$emptyRemoved = array_filter($runSum);

		return $emptyRemoved;

	}

	public static function createAnotherCompanyProfile($user_id, $data) {

		$rs = CompanyProfile::where('user_id', $user_id)->get();

		if (count((array) $rs) - 1 < 3) {

			$company_result = CompanyProfile::create([

				'user_id' => $user_id,

				'company_name' => (isset($data['company_name'])) ? $data['company_name'] : NULL,

				'registered_company_name' => (isset($data['company_name'])) ? $data['company_name'] : NULL,

				'company_website' => (isset($data['company_website'])) ? $data['company_website'] : NULL,

				'added_by' => $user_id,

				'status' => '1',

			]);

			BrandSlogan::create([

				'user_id' => $user_id,

				'company_id' => $company_result->id,

			]);

			CompanyBilling::create([

				'user_id' => $user_id,

				'company_id' => $company_result->id,

				'added_by' => $user_id,

			]);

			CompanyContacts::create([

				'user_id' => $user_id,

				'company_id' => $company_result->id,

				'added_by' => $user_id,

			]);

			CompanySocialAccounts::create([

				'user_id' => $user_id,

				'company_id' => $company_result->id,

				'added_by' => $user_id,

			]);

			return $company_result->id;

		} else {

			return redirect('/home')->with('message', 'You exceeded to the allowed number of company profiles.');

			exit;

		}

	}

	public static function userIdEncoded($id) {

		$userId_encoded = \base64_encode($id);

		return $userId_encoded;

	}

	public static function generateReferralLinkEncoded($id) {

		$userId_encoded = \base64_encode($id);

		$rv = url('/register-ref/' . $userId_encoded);

		return $rv;

	}

	public static function generateReferralLinkDecoded($id) {

		$userId_encoded = \base64_decode($id);

		$rv = url('/register-ref/' . $userId_encoded);

		return $rv;

	}
	
	public static function checkOppotunityCreation($companyId){
		$reply = false;

		$build = OpportunityBuildingCapability::where('company_id', $companyId)->count();

		if($build > 0){
			$reply = true;

		} else {

			$buy = OpportunityBuy::where('company_id', $companyId)->count();
			
			if($buy > 0){
				$reply = true;
			
			} else {
			
				$sell = OpportunitySellOffer::where('company_id', $companyId)->count();
				if($sell > 0){
					$reply = true;
				}
			}
		}
		
	return $reply;	

	}

}
