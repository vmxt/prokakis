<?php

namespace App;

use App;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use Illuminate\Database\Eloquent\Model;

class RequestReport extends Model {

	protected $table = 'request_report';

	public $rules = [

		'company_UEN' => 'required|string|max:255',

		'fk_opportunity_id' => 'integer',

		'company_name' => 'required|string|max:255',

		'person_incharge' => 'required|string|max:255',

		'email_address' => 'required|string|email|max:255',

		'mobile_number' => 'required|string|max:255',

	];

	/**

	 * The attributes that are mass assignable.

	 *

	 * @var array

	 */

	protected $fillable = [

		'company_id', 'source_company_id', 'company_UEN', 'fk_opportunity_id', 'opportunity_type', 'company_name', 'person_incharge', 'email_address', 'mobile_number', 'created_at', 'updated_at', 'status', 'is_approve',

	];

	/**

	 * The attributes that should be hidden for arrays.

	 *

	 * @var array

	 */

	protected $hidden = [

		'id',

	];

	public static function getRequestProviderCompanyID($opp_type_entry, $fkID) {

		$result = null;

		if (in_array($opp_type_entry, array('build', 'sell', 'buy'))) {

			switch ($opp_type_entry) {

			case 'build':

				$result = OpportunityBuildingCapability::find($fkID);

				break;

			case 'sell':

				$result = OpportunitySellOffer::find($fkID);

				break;

			case 'buy':

				$result = OpportunityBuy::find($fkID);

				break;

			}

			if (count((array) $result)-1 > 0) {

				return $result->company_id;

			}

		}

	}

	public static function getProjectName($request_id) {

		$req = App\RequestReport::find($request_id);

		if ( $req->count() > 0) {

			return $req->company_name . '-' . $req->opportunity_type . '-' . $req->source_company_id . '-' . $req->company_id;

		}

	}

}
