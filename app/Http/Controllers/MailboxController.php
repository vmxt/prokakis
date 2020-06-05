<?php



namespace App\Http\Controllers;



use App\AuditLog;

use App\Mailbox;

use App\MailboxReply;

use App\MailTemplate;

use App\User;

use App\CompanyProfile;

use Auth;

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

		$consMap = Mailbox::where('sender_id', '=', $usr)->orWhere('receiver_id', '=', $usr)->get();



		return view('mailbox.compose', compact('consMap'));

	}



	public function sentMail() {

		$usr = Auth::id();

		$consMap = Mailbox::where('sender_id', '=', $usr)->get();

		return view('mailbox.sent', compact('consMap'));

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

					'created_at' => date('Y-m-d'),

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



	public function createCompose(Request $request) {

		return view('mailbox.create');

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

           Please check your Prokakis mailbox,. <br />

           There is a reply from your email in subject of '$m->subject'

           <br />

           <br />

           Thank you;

           ";

			Mailbox::sendMail_v2($content, $email_noti, 'Prokakis mailbox notification of reply', '');



			MailboxReply::create([

				'mailbox_id' => $mailID,

				'message' => $message,

				'replyer_id' => $user_id,

				'created_at' => date('Y-m-d'),

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

		$message ="Hi, <br /> I use <b>ProKakis</b> to buy/ sell companies, advertise products & services and connect to other business owners 
		globally. Wanna get <b>ProKakis</b>, Online Marketplace with KYB Due Diligence for yourself? Your registration fee is $0! Join me now: <a href='".$url_result."'>$url_result</a> or may copy-paste this url <i>$url_result</i> to your browser.
		<br />
		<br />
		Thank you, <br />
		Prokakis Web Admin
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
			$company_opp = $request->input("companyOpp"); //opportunity owner
			$company_viewer = $request->input("companyViewer"); //viewer
			$templateType = $request->input("templateType"); //viewer

			$user_id = Auth::id();			
			$rs = CompanyProfile::find($company_opp);

			AuditLog::ok(array($user_id, 'opportunity', 'express interest to a company at explore page', 'company id:'. $company_viewer.' express interest to company id:' . $company_opp));

            $template = MailTemplate::find($templateType);

			$message = "

                  Dear  $rs->registered_company_name,

                  <br />
  					$template->content
  					<br>
                  ";
            $message .= "Requestor profile: ".url('company/'.$company_viewer);
            echo "success";
			//send the email here
			//Mailbox::sendMail($message, $rs->company_email, $template->subject, "");
		}
	}

}

