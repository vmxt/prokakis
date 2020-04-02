<?php

namespace App;

use App\Buytoken;
use App\CompanyProfile;
use Illuminate\Database\Eloquent\Model;
use App\PromotionToken;

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

	// int token left
	// false 0 token left
	public static function validateLeftBehindToken($companyId) {
			
			$inTokens = Buytoken::where('company_id', $companyId)->sum('num_tokens');
			$outTokens = SpentTokens::where('company_id', $companyId)->sum('num_tokens');
			
				$result = (int)($inTokens - $outTokens);
				if ($result > 0) {

					if(SpentTokens::validateAccountActivation($companyId) == true){
						return $result;
					} else {
						return false;
					}	

				} else {
					return false;
				}
	}

	public static function validateTokenStocks($companyId) {
			
		$inTokens = Buytoken::where('company_id', $companyId)->sum('num_tokens');
		$outTokens = SpentTokens::where('company_id', $companyId)->sum('num_tokens');
		
			$result = (int)($inTokens - $outTokens);
			if ($result > 0) {
					return $result;
			} else {
				return false;
			}
}

	//true is activated and premium
	//false is not premium
	public static function validateAccountActivation($companyId){
		$c_promo = PromotionToken::where('company_id', $companyId)->where('remarks', 'UPGRADE-TO-PREMIUM')->count();
		if($c_promo > 0 ){
			return true;
		} else{
			return false;
		}
	}

	public static function spendTokenByrequest($requestId, $companyId, $userId, $numTokens) {
		$req = RequestReport::find($requestId);

		if ( $req != null) {
			SpentTokens::create([
				'company_id' => $companyId,
				'user_id' => $userId,
				'num_tokens' => $numTokens,
				'request_id' => $requestId,
				'created_at' => date('Y-m-d'),
			]);
		}

	}

	public static function spendTokenGeneral($remarks, $companyId, $userId, $numTokens) {
	
			SpentTokens::create([
				'company_id' => $companyId,
				'user_id' => $userId,
				'num_tokens' => $numTokens,
				'remarks'	 => $remarks,
				'created_at' => date('Y-m-d'),
			]);
	
	}
	


}
