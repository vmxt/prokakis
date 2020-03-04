<?php

namespace App\Http\Controllers;

use App\AuditLog;
use App\Mailbox;
use App\MailboxReply;
use App\User;
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

}
