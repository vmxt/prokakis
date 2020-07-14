<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;
use Mail;

class Mailbox extends Model {

	protected $table = 'mail_box';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'sender_id', 'receiver_id', 'receiver_email', 'subject', 'message', 'is_open', 'created_at', 'updated_at', 'status', 'remarks','is_type'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public static function getNumberEmailWithNoti($receiverId) {
		$rs = Mailbox::where('receiver_id', $receiverId)->where('is_open', NULL)->get();
		if ( $rs->count() > 0) {
			return $rs->count();
		} else {
			return '';
		}
	}

	public static function getEmailUnderNoti($receiverId) {
		return Mailbox::where('receiver_id', $receiverId)->where('is_open', NULL)->get();
	}

	public static function sendMail_v2($emailtext, $recipients, $subject, $bcc) {
		Mail::send(array('html' => 'mailbox.template'), array('text' => $emailtext),
			function ($message) use ($recipients, $subject, $bcc) {
				//$message->from('support@prokakis.com', 'Prokakis Web Admin');
				$message->from('prokakis@ebos-sg.com', 'Prokakis Web Admin');
				//prokakis@ebos-sg.com

				if ($bcc != '') {
					$message->to($recipients)->$message->bcc($bcc)->subject($subject);
				} else {
					$message->to($recipients)->subject($subject);
				}
			}
		);

	}

	public static function sendMail($emailtext, $recipients, $subject, $bcc) {
		Mail::send(array('html' => 'mailbox.template'), array('text' => $emailtext),
			function ($message) use ($recipients, $subject, $bcc) {
				// $message->from('support@prokakis.com', 'Prokakis Web Admin');
				$message->from('prokakis@ebos-sg.com', 'Prokakis Web Admin');

				if ($bcc != '') {
					$message->to($recipients)->$message->bcc($bcc)->subject($subject);
				} else {
					$message->to($recipients)->subject($subject);
				}
			}
		);

	}

	public static function sendMail_EmailTemplate($emailtext, $recipients, $subject, $bcc) {
		Mail::send(array('html' => 'mailbox.emailtemplate'), array('text' => $emailtext),
			function ($message) use ($recipients, $subject, $bcc) {
				// $message->from('support@prokakis.com', 'Prokakis Web Admin');
				$message->from('prokakis@ebos-sg.com', 'Prokakis Web Admin');

				if ($bcc != '') {
					$message->to($recipients)->$message->bcc($bcc)->subject($subject);
				} else {
					$message->to($recipients)->subject($subject);
				}
			}
		);

	}

}
