<?php

namespace App;

use App;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use Illuminate\Support\Facades\DB;
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

    public static function getRecordsProcessedCount($company_id){
        $data = App\RequestReport::where("company_id","=",$company_id)
        ->get(['request_report.id','is_approve']);
        
        $main_count = 0;
        $test = "";
        if(isset($data)){
            if(count($data) > 0){
                
                foreach($data as $listData){
                    
                    $proc_record = App\RequestApproval::getProcessedRecord($listData->id); 
                    
                    $rec = App\ConsultantProjects::where('request_id', $listData->id)->where('project_status', 'DONE')->first();
                    if (count((array) $rec) > 0) {

                        if ($listData->is_approve == 'yes') {
                            $main_count++;
                        }
                
                    }
                   
                    if($proc_record == true){
                        $main_count--;
                    }
                }
                return $main_count;
            }
        }
        else{
            return $main_count;
        }
    }

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
	
	public static function getProjectName2($request_id) {

		$req = App\RequestReport::find($request_id);
		
		$result = null;

		if ( $req->count() > 0) {
		    
		    if($req->opportunity_type == "build"){
		        $result = OpportunityBuildingCapability::where("id", $req->fk_opportunity_id)->first();
		    }
		    
		    if($req->opportunity_type == "sell"){
		        $result = OpportunitySellOffer::where("id", $req->fk_opportunity_id)->first();
		    }
		    
		    if($req->opportunity_type == "buy"){
		        $result = OpportunityBuy::where("id", $req->fk_opportunity_id)->first();
		    }
		    
		    $opp_title = ($result["opp_title"] != "") ? $result["opp_title"] : strtoupper($req->opportunity_type) . " OPPORTUNITY";
            
			return $req->company_name . ' - (' . strtoupper($opp_title) . ")";

		}

	}

	public static function getProjectName($request_id) {

		$req = App\RequestReport::find($request_id);

		if ( $req->count() > 0) {

			return $req->company_name . '-' . $req->opportunity_type . '-' . $req->source_company_id . '-' . $req->company_id;

		}

	}

	public static function getRequestReportByUser(){

		return	DB::table("request_report as rr")
		    ->select('u.id as user_id', 'u.*', 'cp.id as company_id', DB::raw('COUNT(u.id) as total_count'))
		    ->join('company_profiles as cp', "cp.id", "=", "rr.company_id" )
		    ->join('users as u', "cp.user_id", "=", "u.id" )
		    ->groupBy("user_id")
		    ->orderBy('total_count','desc')
		    ->get();
	}

}
