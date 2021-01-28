<?php

namespace App\Http\Controllers;

use App\AuditLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;
use App\VideoChat;
use App\InOutUsers;
use App\CompanyProfile;
use App\User;
use App\Mailbox;
use Auth;
use App\CompanySearchVideoChat;


class VideoChatController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {
		$this->middleware('auth');
    }
    
    public function loadVideoPage(Request $request)
    {
	  $isOnline = null;
	  $user_id = Auth::id();
	  $urURL = $request->url();
	  $eVC = "";
	
	   $vc = VideoChat::where('vc_url', 'like', '%' . $urURL . '%')->first();
	   if($vc != null){
		   if($vc->status == 0){
			return redirect('/home')->with('message', 'This video chat channel has expired.');
			exit;
		   }
		$rVC = explode("#",$vc->vc_url);
		$eVC = $rVC[1]; 
	   } 	
	   
	  
		if($request['companyOpp']){
			//echo $request['companyViewer'];
			$c = CompanyProfile::find($request['companyOpp']);
		    $rs = InOutUsers::where('user_id', $c->user_id)->first();
			if($rs != null){
				$isOnline = $rs->status;
			}
		}

	    return view("videochat.videopage", compact('isOnline', 'eVC'));
	}
	
	public function getVideoChatDetails(Request $request)
	{
		if ($request->isMethod('post')) 
		{
		   $urlvc = $request->input('vc_url');	
		   $rs = explode("/", $urlvc);
		   
		   $rVC = explode("#",$urlvc);
	 	   $channel = $rVC[1]; 

		   $oppId = (isset($rs[5]))? $rs[5] : '';
		   $oppType = (isset($rs[6]))? $rs[6] : '';
		   $companyId = (isset($rs[7]))? $rs[7] : '';
		   $viewer = (isset($rs[8]))? $rs[8] : '';
		   $viewerC = explode("#", $viewer);

		  $rs =  VideoChat::where('opp_id', $oppId)->where('opp_type', $oppType)->where('status', 1)->first();
		  if($rs == null){	
			
			
			$vc = VideoChat::where('vc_url', 'like', '%' . $channel . '%')->first();
				if($vc == null){

				VideoChat::create([
					'host_user_id'	 => $viewerC[0], 
					'remote_user_id' =>	$companyId, 
					'vc_url'		 => $urlvc, 
					'opp_id'		 => $oppId, 
					'opp_type'		 => $oppType, 
					'created_at'	 => date('Y-m-d'), 
					'status'		 => 1,
				]);

				}	

		  } else {
	
			$rs->host_user_id 	 = $viewerC[0]; 
			$rs->remote_user_id  = $companyId; 
			$rs->vc_url		 	 = $urlvc; 
			$rs->opp_id		 	 = $oppId; 
			$rs->opp_type		 = $oppType; 
			$rs->save();

		  }	

		  $c = CompanyProfile::find($companyId);
		  $usr = User::find($c->user_id);
		  $req = CompanyProfile::find($viewerC[0]);
		  
		  $subject = "Prokakis Video Chat Invitation";	
		  $content = "
		  Hi $usr->firstname,
		  <br /><br />

		  You have video chat invitation from Prokakis,  <br />

		  Company Name: $req->company_name <br />
		  Country Code: $req->primary_country <br />
		  Industry: $req->industry <br />
		  <br />
		  To open the video chat open link : $urlvc <br />
		  
		  Thank you, <br />
		  Prokakis
		  ";
		  //$usr->email
		  Mailbox::sendMail_v2($content, 'it@ebos-sg.com', $subject, '');
		   
		}
	}

	public function getVideoChatCompanyDetails(Request $request)
	{
		if ($request->isMethod('post')) 
		{
		   $user_id = Auth::id(); 
		   $urlvc = $request->input('vc_url');	
		   $rs = explode("/", $urlvc);
		   
		   //http://localhost/prokakis/vc-companysearch/10106#7b1b73

		   $Comp_Channel = (isset($rs[5]))? $rs[5] : '';
		   $cc = explode("#", $Comp_Channel);
		   $companyId = $cc[0];	
		
		  $rs =  CompanySearchVideoChat::where('channel', $urlvc)->first();
		  if($rs == null){	
			
			CompanySearchVideoChat::create([
					'requester_id'	 => $user_id, 
					'provider_id' =>	$companyId, 
					'channel'		 => $urlvc, 
					'status'		 => 1, 
					'created_at'	 => date('Y-m-d'), 
				]);

			
		  } else {
	
			$rs->requester_id  = $user_id; 
			$rs->provider_id  = $companyId; 
			$rs->channel	   = $urlvc; 
			$rs->save();

		  }	

		  $c = CompanyProfile::find($companyId);
		  $usr = User::find($c->user_id);

		  $company_id_result = CompanyProfile::getCompanyId($user_id);
  		  //$cp = CompanyProfile::find($company_id_result);

		  $req = CompanyProfile::find($company_id_result); //requester
		  
		  $subject = "Prokakis Video Chat Invitation";	

		  $content = "
		  Hi $usr->firstname,
		  <br /><br />

		  You have video chat invitation from Prokakis,  <br />

		  Company Name: $req->company_name <br />
		  Country Code: $req->primary_country <br />
		  Industry: $req->industry <br />
		  <br />
		  To open the video chat open link : $urlvc <br />
		  
		  Thank you, <br />
		  Prokakis
		  ";


		  
		  $ok = Mailbox::create([

			'sender_id' => $user_id,

			'receiver_id' => $c->user_id,

			'receiver_email' =>  $usr->email,

			'subject' => $subject,

			'message' => $content,

			'created_at' => date('Y-m-d'),

			'status' => 1,

		]);



		if ($ok) {

			//$usr->email
			//Mailbox::sendMail_v2($content, $receiver, $subject, '');
			AuditLog::ok(array(Auth::id(), 'video chat request', 'sent', 'receiver:' . $usr->firstname.' '.$usr->lastname));

		}

		   
		}
	}



	public function endVideo(Request $request)
	{
		if ($request->isMethod('get')) 
		{
			if($request['channel'])
			{
				$urURL = $request['channel'];
				$vc = VideoChat::where('vc_url', 'like', '%' . $urURL . '%')->first();
				if($vc != null)
				{
					$vc->status = 0;
					$vc->save();
					return redirect('/home')->with('status', 'You have succesfully end the session of a video chat channel.');

				}
			} else {
				return redirect('/home')->with('status', 'You have succesfully end the session of a video chat channel.');	
			}
		}

	} 

	public function companySearchVideoChat(Request $request)
	{
		$isOnline = null;
		$user_id = Auth::id();
		$urURL = $request->url();
		$eVC = "";
	
		$vc = CompanySearchVideoChat::where('channel', 'like', '%' . $urURL . '%')->first();
		if($vc != null){
			if($vc->status == 0){
			 return redirect('/home')->with('message', 'This video chat channel has expired.');
			 exit;
			}

		 $rVC = explode("#",$vc->channel);
		 $eVC = $rVC[1]; 
		} 
	
		return view("videochat.videocompany", compact('eVC'));
	}

	public function endVideoCompanySearch(Request $request)
	{
		if ($request->isMethod('get')) 
		{
			if($request['channel'])
			{
				$urURL = $request['channel'];
				$vc = CompanySearchVideoChat::where('channel', 'like', '%' . $urURL . '%')->first();
				if($vc != null)
				{
					$vc->status = 0;
					$vc->save();
					return redirect('/home')->with('status', 'You have succesfully end the session of a video chat channel.');

				}
			} else {
				return redirect('/home')->with('status', 'You have succesfully end the session of a video chat channel.');	
			}
		}


	}
}