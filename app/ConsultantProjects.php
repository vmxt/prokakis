<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ConsultantProjects extends Model {

	protected $table = 'consultant_project';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'request_approval_id', 'request_id', 'company_source_id', 'company_requester_id', 'main_consultant_id', 'search_on', 'assigned_consultant_id', 'project_status',
		'progress', 'start_date', 'due_date', 'remarks',
		'created_at', 'updated_at', 'created_by', 'updated_by',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public static function validateConsultantAccessByProject($consulId, $companyId) {

		$company_provider = ConsultantProjects::where('assigned_consultant_id', $consulId)
			->where('company_source_id', $companyId)
			->where('project_status', 'ONGOING')
			->first();

		if ($company_provider != null) {
			return true;

		} else {

			$company_requester = ConsultantProjects::where('assigned_consultant_id', $consulId)
				->where('company_requester_id', $companyId)
				->where('project_status', 'ONGOING')
				->first();

			if ($company_requester != null) {
				return true;
			} else {
				return false;
			}
		}

	}

}
