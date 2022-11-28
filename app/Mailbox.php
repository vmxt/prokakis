<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
//use Mail;

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
				$message->from('support@intellinz.com', 'Intellinz Web Admin');

				if ($bcc != '') {
					$message->to($recipients)->$message->bcc($bcc)->subject($subject);
				} else {
					$message->to($recipients)->subject($subject);
				}
			}
		);

	}
	
	public static function sendMail_weeklyOpp($emailtext, $uemail, $uid,  $subject, $bcc) {
	    try{
    		Mail::send(array('html' => 'mailbox.weeklyTopOpportunity'), array('ret' => $emailtext, 'uid'=>$uid),
    			function ($message) use ($uemail, $subject, $bcc) {
    				$message->from(env('MAIL_FROM_ADDRESS'), 'Intellinz Web Admin');
    				if ($bcc != '') {
    					$message->to($uemail)->$message->bcc($bcc)->subject($subject);
    				} else {
    					$message->to($uemail)->subject($subject);
    				}
    			}
    		);
	    }catch(Exception  $e){
            echo "hello";
        }
	}

	public static function sendMail($emailtext, $recipients, $subject, $bcc) {
		Mail::send(array('html' => 'mailbox.template'), array('text' => $emailtext),
			function ($message) use ($recipients, $subject, $bcc) {
				
				$message->from('support@intellinz.com', 'Intellinz Web Admin');

				if ($bcc != '') {
					$message->to($recipients)->$message->bcc($bcc)->subject($subject);
				} else {
					$message->to($recipients)->subject($subject);
				}
			}
		);

	}

	public static function sendMail_EmailTemplate($emailtext, $recipients, $subject, $bcc) {
	    
	 $ok =	Mail::send(array('html' => 'mailbox.emailtemplate'), array('text' => $emailtext),
			function ($message) use ($recipients, $subject, $bcc) {
				 $message->from('support@intellinz.com', 'Intellinz Web Admin');

				if ($bcc != '') {
					$message->to($recipients)->$message->bcc($bcc)->subject($subject);
				} else {
					$message->to($recipients)->subject($subject);
				}
			}
		);
	return $ok;	

	}
	
	
	public static function sendMail_EmailTemplate22($emailtext, $recipients, $subject, $bcc) {
	    
	 $ok =	Mail::send(array('html' => 'mailbox.emailtemplate'), array('text' => $emailtext),
			function ($message) use ($recipients, $subject, $bcc) {
				 $message->from('support@intellinz.com', 'Intellinz Web Admin');

				if ($bcc != '') {
					$message->to($recipients)->$message->bcc($bcc)->subject($subject);
				} else {
					$message->to($recipients)->subject($subject);
				}
			}
		);
		
	$ret_message = "";
	
	$fail = Mail::failures();
    if(count($fail) > 0){
       $ret_message .= 'Could not send message to '.$fail[0];
    }

    if(empty($ok)){
        $ret_message .= "Email could not be sent.";
    }

	return $ret_message;	

	}

}
