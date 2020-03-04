<?php

namespace App;

use App\ProcessedReport;
use Illuminate\Database\Eloquent\Model;

class RequestApproval extends Model {

	protected $table = 'request_approval';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'req_rep_id', 'requester_company_id', 'company_id', 'is_accepted', 'main_consultant', 'a_consultant', 'b_consultant', 'remarks', 'created_at', 'updated_at', 'status',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public function approvalOne() {
		return $this->hasOne('ProcessedReport', 'approval_id');
	}

	public static function getProcessedRecord($requestId) {

		$apr = RequestApproval::where('req_rep_id', $requestId)->first();

		if ( $apr->count() > 0) {

			$p = ProcessedReport::where('approval_id', $apr->id)->first();

			if (count((array)$p) - 1 > 0) {
				return true;
			} else {
				return false;
			}

		} else {
			return false;
		}

	}

	public static function getRequestId($requestId) {
		$apr = RequestApproval::find($requestId);

		if ($apr->count() > 0) {
			return $apr->req_rep_id;
		}

	}

	public static function getRequestApprovalId($requestId) {
		$apr = RequestApproval::where('req_rep_id', $requestId)->first();

		if ( $apr->count() > 0) {
			return $apr->id;
		} else {
			return false;
		}

	}

}
