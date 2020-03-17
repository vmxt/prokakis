<?php

namespace App;

use App\Buytoken;
use App\CompanyProfile;
use Illuminate\Database\Eloquent\Model;

class SpentTokens extends Model {

	protected $table = 'company_spent_tokens';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'company_id', 'user_id', 'num_tokens', 'request_id', 'remarks', 'created_at', 'updated_at',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public static function validateLeftBehindToken($companyId) {
		//$company = CompanyProfile::find($companyId);
		//if ( $company->count() > 0 && $company->user_id != 0) {

			$inTokens = Buytoken::where('company_id', $companyId)->sum('num_tokens');
			$outTokens = SpentTokens::where('company_id', $companyId)->sum('num_tokens');
		

			$result = (int)($inTokens - $outTokens);
			if ($result > 0) {
				return $result;
			} else {
				return false;
			}
		//}

	}

	public static function spendTokenByrequest($requestId, $companyId, $userId, $numTokens) {
		$req = RequestReport::find($requestId);

		if ( $req->count() > 0) {
			SpentTokens::create([
				'company_id' => $companyId,
				'user_id' => $userId,
				'num_tokens' => $numTokens,
				'request_id' => $requestId,
				'created_at' => date('Y-m-d'),
			]);
		}

	}

	public static function spendTokenByPremium($remarks, $companyId, $userId, $numTokens) {
	
			SpentTokens::create([
				'company_id' => $companyId,
				'user_id' => $userId,
				'num_tokens' => $numTokens,
				'remarks'	 => $remarks,
				'token_startdate', 
				'token_enddate',
				'created_at' => date('Y-m-d'),
			]);
	
	}
	


}
