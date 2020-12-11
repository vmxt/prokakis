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
			 if($rs->remarks != null){
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
		 }
  
		 return $fileName;
	}

}
