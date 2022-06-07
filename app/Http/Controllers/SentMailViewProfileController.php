<?php

namespace App\Http\Controllers;

use App\SentMailViewProfile;

use App\AuditLog;

use App\Mailbox;

use App\MailboxReply;

use App\MailTemplate;

use App\User;

use App\CompanyProfile;

use App\Countries;

use Auth;

use Illuminate\Http\Request;



class SentMailViewProfileController extends Controller {
    public function __construct() {

		$this->middleware('auth');

	}
	
	
	public function check_if_sent_mail(Request $request){
	    if ($request->isMethod('post')) {
	        
            $opp_id = $request->input('opp_id');
			$viewer_id = $request->input('viewer_id');
			
			$check = SentMailViewProfile::where('opp_id', $opp_id)->where("viewer_id", $viewer_id);
			if($check){
			    return "exsist";
			}
			else{
			    return "ok";
			}
	    }
	}
}
