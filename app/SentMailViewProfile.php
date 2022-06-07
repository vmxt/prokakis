<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
//use Mail;

class SentMailViewProfile extends Model {

	protected $table = 'sent_mail_view_profile';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'opp_id', 'viewer_id', 'created_at', 'updated_at'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];
	
}