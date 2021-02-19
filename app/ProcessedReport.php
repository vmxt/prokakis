<?php



namespace App;



use App\RequestApproval;

use App\RequestReport;

use Illuminate\Database\Eloquent\Model;

use App\ConsultantProjects;

use App\UploadImages;



class ProcessedReport extends Model {



	protected $table = 'processed_report';



	/**

	 * The attributes that are mass assignable.

	 *

	 * @var array

	 */

	protected $fillable = [

		'approval_id', 'requester_company_id', 'source_company_id', 'report_status', 'request_frequency_id',

		'num_tokens_consumed', 'month_subscription_start', 'month_subscription_end', 'report_link',

		'created_at', 'updated_at',

	];



	/**

	 * The attributes that should be hidden for arrays.

	 *

	 * @var array

	 */

	protected $hidden = [

		'id',

	];



	public static function getProcessedReportByApprovalId($approvalId) {

		$apr = ProcessedReport::where('approval_id', $approvalId)->first();



		if ($apr != null) {

			return $apr;

		} else {

			return false;

		}



	}



	public static function getReqRepId($approvalId) {



		$rs = RequestApproval::find($approvalId);

		if ( $rs->count() > 0) {

			$rec = RequestReport::find($rs->req_rep_id);

			if ($rec->count() > 0) {

				return $rec;

			} else {

				return false;

			}

		} else {

			return false;

		}

	}



	public static function getFileUploadsForReportGeneration($approvalId){

		$fileName = []; 	 

		$rs =	ConsultantProjects::where('request_approval_id', $approvalId)->first();

		

		 if($rs != null)

		 {

		  $arr = explode(",", $rs->remarks);

		  foreach($arr as $d){

			  $a = explode(":", $d);

		  

						$b=[];

						if(isset($a[1])){

							$b = explode("]", $a[1]);

						}

  

				  if(!empty($b[0])){

				  $ui = UploadImages::where('id', $b[0])->where('file_category', 'CONSULTANT_PROJECT_REPORT')->first();

  

					  if($ui != null){

						  $fileName[] = $ui->file_name;

					  }

				   }

		  }

  

		 }

  

		 return $fileName;

	}

	public static function activeSubscriptions()
	{
		$today = date('Y-m-d');
		$obj = [];
		$result = ProcessedReport::all();
		$intToday = strtotime($today);

			foreach($result as $d){
			$intStart = strtotime($d->month_subscription_start);
			$intEnd = strtotime($d->month_subscription_end);
			
				if($intToday >= $intStart && $intToday <= $intEnd){

					$obj[] = $d;
				}
			}

		return $obj;
	}

	public static function activeSubscriptionsCompanyName()
	{
		$today = date('Y-m-d');
		$obj = [];
		$result = ProcessedReport::all();
		$intToday = strtotime($today);
		$requestID = 0;

			foreach($result as $d){
			$intStart = strtotime($d->month_subscription_start);
			$intEnd = strtotime($d->month_subscription_end);
			
				if($intToday >= $intStart && $intToday <= $intEnd){

					$cn = CompanyProfile::find($d->source_company_id);
					$rn = CompanyProfile::find($d->requester_company_id);

					$ra = RequestApproval::find($d->approval_id);
					if ( $ra->count() > 0) {
					  $requestID = $ra->req_rep_id;
					}
					
					$obj[] = array('provider_company_name'=>$cn->company_name, 
					'provider_company_id'=>$d->source_company_id, 
					'requester_company_id'=>$d->requester_company_id, 
					'requester_company_email'=>$rn->company_email,
					'process_report_id'=>$d->id,
					'request_report_id' => $requestID);
				}
			}

		return $obj;
	}


	public static function getTheActiveRequestReport(){

		$approvals = array();	

		$d = ProcessedReport::whereDate('month_subscription_start', '<=', date('Y-m-d'))

		->whereDate('month_subscription_end', '>=',  date('Y-m-d'))

		->get();

		foreach($d as $s){

		 $approvals[] = $s->approval_id;

		}	

 

		$cp = RequestApproval::whereIn('id', $approvals)->get();

 

			 $active_ids = [];

			 $rr = null;

 

			 if($cp != null){

				 foreach($cp as $c){

					 $active_ids[] = $c->req_rep_id;

				 }

			 }

	 

			 if(sizeof($active_ids) > 0){

			 $rr = RequestReport::whereIn('id', $active_ids)->get();

			 } 

			return $rr; 

	}

}

