<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class VideoChat extends Model {

	protected $table = 'video_chat';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'host_user_id', 'remote_user_id', 'vc_url', 'opp_id', 'opp_type', 'created_at', 'updated_at', 'status',
    ];

    /**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public static function getVcURL($oppId, $oppType, $companyViewer)
	{
		$rs =  VideoChat::where('opp_id', $oppId)
		->where('opp_type', $oppType)
		->where('host_user_id', $companyViewer)
		->where('status', 1)->first();
		
		if($rs != null){	
			return $rs->vc_url;
		} else {
			return null;
		}
	}
    
}
