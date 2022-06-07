<?php



namespace App\Http\Controllers;



use App\AuditLog;

use App\Mailbox;

use App\MailboxReply;

use App\MailTemplate;

use App\User;

use App\CompanyProfile;

use App\Countries;

use Auth;

use App\SentMailViewProfile;

use Illuminate\Http\Request;



class MailboxController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		$this->middleware('auth');

	}



	/**

	 * Show the application dashboard.

	 *

	 * @return \Illuminate\Http\Response

	 */

	public function list() {



	}



	public function compose() {

		$usr = Auth::id();
		$company_id = CompanyProfile::getCompanyId($usr);

		$res = Mailbox::where('receiver_id', '=', $usr)->orderBy('created_at', 'DESC')->get();
		$res2 = Mailbox::where('receiver_id',$company_id)->where('is_type','chat')->orderBy('created_at', 'DESC')->get();
		$consMap = $res->merge($res2)->sortByDesc('created_at');;

		return view('mailbox.compose', compact('consMap'));

	}



	public function sentMail() {

		$usr = Auth::id();

		$consMap = Mailbox::where('sender_id', '=', $usr)->orderBy('created_at', 'DESC')->get();

		return view('mailbox.sent', compact('consMap'));

	}

    public function storeCompose2(Request $request) {



		if ($request->isMethod('post')) {



			$receiver = $request->input('receiver_mail');

			$subject = $request->input('subject_mail');

			$content = $request->input('composeArea');

            $user_id = CompanyProfile::where('id', $receiver)->first();//find($receiver)->user_id;
            
			$usr = User::where('id', $user_id->user_id)->first();

            

			if (count((array) $usr) > 0) {

				$recieverID = (int) $usr->id;

                $receiver =  $usr->email;

				$ok = Mailbox::create([

					'sender_id' => Auth::id(),

					'receiver_id' => $recieverID,

					'receiver_email' => $receiver,

					'subject' => $subject,

					'message' => $content,

					'created_at' => date('Y-m-d H:i:s'),

					'status' => 1,

				]);



				if ($ok) {



					Mailbox::sendMail_v2($content, $receiver, $subject, '');



					AuditLog::ok(array(Auth::id(), 'mailbox', 'sent', 'receiver:' . $receiver));



					return 'Message successfuly sent.';

				}



			} else {

				return 'Email address entered not registered to any company.';

			}

		}



	}

	public function storeCompose(Request $request) {



		if ($request->isMethod('post')) {



			$receiver = $request->input('receiver_mail');

			$subject = $request->input('subject_mail');

			$content = $request->input('composeArea');

			$usr = User::where('email', $receiver)->first();



			if (count((array) $usr) > 0) {

				$recieverID = (int) $usr->id;



				$ok = Mailbox::create([

					'sender_id' => Auth::id(),

					'receiver_id' => $recieverID,

					'receiver_email' => $receiver,

					'subject' => $subject,

					'message' => $content,

					'created_at' => date('Y-m-d H:i:s'),

					'status' => 1,

				]);



				if ($ok) {



					Mailbox::sendMail_v2($content, $receiver, $subject, '');



					AuditLog::ok(array(Auth::id(), 'mailbox', 'sent', 'receiver:' . $receiver));



					return redirect('mailbox/compose')->with('status', 'Message successfuly sent.');

				}



			} else {

				return redirect('mailbox/createCompose')->with('message', 'Email address entered not registered to any company.');

			}



		}



	}

	//all admin email address only
	public function storeEnterpriseCompose(Request $request) {

		if ($request->isMethod('post')) {
			$subject = $request->input('subject_mail');
			$content = $request->input('composeArea');
			$usr = User::where('user_type', '5')->get();

			foreach($usr as $d){
				$receiver = $d->email;

				Mailbox::create([
					'sender_id' => Auth::id(),
					'receiver_id' => $d->id,
					'receiver_email' => $receiver,
					'subject' => $subject,
					'message' => $content,
					'created_at' => date('Y-m-d H:i:s'),
					'status' => 1,
				]);

				
				Mailbox::sendMail_v2($content, $receiver, $subject, '');

				AuditLog::ok(array(Auth::id(), 'mailbox', 'sent for Enterprise buying option application', 'receiver:' . $receiver));

			}
			return redirect('mailbox/compose')->with('status', 'Message successfuly sent.');

		}

	}



	public function createCompose(Request $request) {

		return view('mailbox.create');

	}

	public function composeBuyingOption(Request $request) {

		$user_id = Auth::id();
		$company_id = CompanyProfile::getCompanyId($user_id);
		$rss = CompanyProfile::find($company_id);
		
		if($rss->primary_country != NULL){
			$cc = Countries::where('country_code', trim($rss->primary_country))->first();
		}else {
			$cc = false;
		}
	
		$p_country = (is_object($cc))? $cc->country_name : '';
		$industry = $rss->industry;

		$msg = "Hi Intellinz Administrator, <br /><br />

		I would like to avail of the Enterprise option at a buying credit page. <br /><br />

		The following are my details <br />
		Country: $p_country  <br />
		Industry: $industry <br />
		Company Name: $rss->company_name <br />

		<br /><br />
		Thank you
		
		";

		return view('mailbox.createBuyingOption', compact('msg'));

	}


	//method post

	public function storeReply(Request $request) {



		if ($request->isMethod('post')) {



			$mailID = $request->input('mail_id');

			$user_id = Auth::id();

			$message = $request->input('composeArea');

			$email_noti = '';

			$res = null;



			$m = Mailbox::find($mailID);



			$m->is_open = NULL;

			$m->save();



			if ($m->sender_id == $user_id) {

				$res = User::find($m->receiver_id);

				$email_noti = $res->email;

			} else {

				$res = User::find($m->sender_id);

				$email_noti = $res->email;

			}



			$content = "

           Dear $res->firstname,

           <br />

           Please check your Intellinz mailbox,. <br />

           There is a reply from your email in subject of '$m->subject'

           <br />

           <br />

           Thank you;

           ";

			Mailbox::sendMail_v2($content, $email_noti, 'Intellinz mailbox notification of reply', '');



			MailboxReply::create([

				'mailbox_id' => $mailID,

				'message' => $message,

				'replyer_id' => $user_id,

				'created_at' => date('Y-m-d H:i:s'),

			]);



			AuditLog::ok(array($user_id, 'mailbox', 'reply', 'mailbox_id:' . $mailID));



			return redirect('mailbox/setReply/' . $mailID)->with('status', 'Your reply has been successfully sent.');



		}



	}



	//method get

	public function setReply(Request $request) {



		if (isset($request['id'])) {

			$user_id = Auth::id();



			$mailId = $request['id'];

			$res = Mailbox::where('status', 1)->where('id', $mailId)->first();



			if (count((array) $res) > 0) {

				$sender_id = $res->sender_id;

				$receiver_id = $res->receiver_id;



				$res->is_open = 1;

				$res->save();



				if (($receiver_id != $user_id) && ($sender_id != $user_id)) {

					//$usr =  User::find($user_id);



					//if($usr->email != $res->receiver_email){

					return redirect('mailbox/compose')->with('message', 'Restricted page.');

					exit;

					// }

				}


				$replies = MailboxReply::where('mailbox_id', $mailId)->get();

				return view('mailbox.reply', compact('replies', 'res', 'sender_id', 'receiver_id', 'user_id', 'mailId'));



			} else {

				return redirect('mailbox/compose')->with('message', 'You went to email restricted page.');

			}



		}



	}

	
	public function createReferal(Request $request){

		$userId = Auth::id();
		$url_result = \App\CompanyProfile::generateReferralLinkEncoded($userId);

		$message ="Hi, <br /> I use <b>Intellinz</b> to buy/ sell companies, advertise products & services and connect to other business owners 
		globally. Wanna get <b>Intellinz</b>, Online Marketplace with KYC Due Diligence for yourself? Your registration fee is $0! Join me now: <a href='".$url_result."'>$url_result</a> or may copy-paste this url <i>$url_result</i> to your browser.
		<br />
		<br />
		Thank you, <br />
		Intellinz Web Admin
		";

		return view('mailbox.createReferal', compact('message'));
	}

	public function sendReferal(Request $request){

		
		if ($request->isMethod('post')) {

			$receiver = $request->input('receiver_mail');
			$subject = $request->input('subject_mail');
			$content = $request->input('composeArea');

			Mailbox::sendMail_v2($content, $receiver, $subject, '');
			AuditLog::ok(array(Auth::id(), 'mailbox-referal', 'sent', 'receiver:' . $receiver));
			return redirect('mailbox/createReferal')->with('status', 'Message successfuly sent.');
		

		}

	}

	public function notification(Request $request){

		if ($request->isMethod('post')) {
			if($request->input('template') == 'searchCompanyNotificaiton' ){
				return $this->searchCompanyNotificaiton($request);
			}else{
			    $company_opp = $request->input("companyOpp"); //opportunity owner
        			$company_viewer = $request->input("companyViewer"); //viewer
        			$templateType = $request->input("templateType"); //viewer
        			
			    $opp_id = $request->input('opp_id');
    			
    			$check = SentMailViewProfile::where('opp_id', $opp_id)->where("viewer_id", $company_viewer);
    			if($check->count() <= 0){
    			    SentMailViewProfile::create([
    			        'opp_id' =>  $opp_id,
    			        'viewer_id' => $company_viewer,
    			    ]);
        
        			$user_id = Auth::id();			
        			$rs = CompanyProfile::find($company_opp);
        
        			$rss = CompanyProfile::find($company_viewer); //requester
        
        			$cc = ($rss->primary_country != null)? Countries::where('country_code', $rss->primary_code)->first() : '';
        			$p_country = (is_object($cc))? $cc->country_name : '';
        			$industry = $rss->industry;
        			$mailSubject = "";
        			
        			if($p_country != '' || $p_country != null){
        				$mailSubject = "A partner from ".$p_country." is looking for you in Intellinz";
        			} else {
        				$mailSubject = "A partner is looking for you in Intellinz";
        			}
        
        			AuditLog::ok(array($user_id, 'opportunity', 'express interest to a company at explore page', 'company id:'. $company_viewer.' express interest to company id:' . $company_opp));
        
        			
        			 $appurl = env('APP_URL');
        			 
                        $message =  file_get_contents($appurl . "public/emailtemplate/view_profile.html");
                        $message = str_replace("[_firstname_]", $rs->registered_company_name, $message); 
                        $message = str_replace("[appurl]", $appurl, $message);
                        $message = str_replace("[_unsubscribelink_]", $appurl . "unsubscribe/" . $user_id, $message);
        			
        			//send the email here
        			if($rs->company_email != ""){
        			    Mailbox::sendMail($message, $rs->company_email, $mailSubject, "");  //$template->subject
        			}
        			return "ok";
			}
			else{
			    return "not";
			}
		}
	}
	}

	public function searchCompanyNotificaiton($request){
				$user_id = Auth::id();
				$sender_company_id = CompanyProfile::getCompanyId($user_id);
				$rs = CompanyProfile::find($sender_company_id);
				$recipient_email = $request->input("recipient_email")?$request->input("recipient_email"):"it@ebos-sg.com"; //opportunity owner
				$company_user_id = $request->input("company_user_id"); //opportunity owner
				$recipient_id = $request->input("recipient_id"); //opportunity owner
				$recipientName = CompanyProfile::getCompanyName($recipient_id);

	     

	     

				$sender_email =  $rs->company_email; //opportunity owner

				$e_subject = $request->input("e_subject"); //subject
				$e_message = $request->input("e_message"); //message

				$mailSubject = $e_subject;

				AuditLog::ok(array($user_id, 'Company Search', 'send an email to a company at company search page', 'sender email:'. $user_id.' express interest to company id:' . $recipient_id."/ email: $recipient_email"));

	            $template = MailTemplate::find(3); #searchCompanyNotificaiton


				$message = "
                  <h1>Dear  $rs->registered_company_name, </h1>
  					$template->content
				  ";
				 

				$cc = ($rs->primary_country != null)? Countries::where('country_code', $rs->primary_country)->first() : '';
				$p_country = (is_object($cc))? $cc->country_name : '';
				$industry = $rs->industry;
					  
	            //$message .= "Requestor profile: ".url('company/'.$company_viewer);
				
				if($company_user_id == '25'){
					$message =  str_replace("[action]", " Register ", $message);
					$message =  str_replace("[actionButton]", '<a class="button" href="https://app-prokakis.com/login">REGISTER</a>', $message);
				}else{
					$message =  str_replace("[action]", " Login " , $message);
					$message =  str_replace("[actionButton]", '<a class="button" href="https://app-prokakis.com/register">LOGIN</a>', $message);
}

				$message =  str_replace("[Industry]", $industry, $message);		  
				$message =  str_replace("[msgTitle]", $mailSubject, $message);		  
				$message =  str_replace("[Country]", $p_country, $message);		  
				$message =  str_replace("[Requester_profile]", url('company/'.base64_encode('viewer' . $rs->id)."/".$rs->id) , $message);		  

				$recipient_email = 'darylyrad.cabz@gmail.com';
				//send the email here
				Mailbox::sendMail($message, $recipient_email, $mailSubject, "");  //$template->subject
}



}#end class

