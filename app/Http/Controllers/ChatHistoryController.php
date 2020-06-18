<?php



namespace App\Http\Controllers;

use App\User;
use App\CompanyProfile;
use App\ChatHistory;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use Carbon\Carbon;

use Illuminate\Http\Request;
use Auth;

class ChatHistoryController extends Controller {

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

	

	public function process(Request $request) {
		if ($request->isMethod('post')) {
			$company_opp = $request->input("companyOpp"); //opportunity owner
			$company_viewer = $request->input("companyViewer"); //viewer
			$oppurtunityId = $request->input("oppId"); 
			$oppurtunityType = $request->input("oppType"); 
			$function = $request->input("function"); 
			$chatAction = $request->input("chatAction"); //chat action 1=send 2=reply

			$user_id = Auth::id();			
			$rs = CompanyProfile::find($company_opp);
			$sender = CompanyProfile::find($company_viewer);
 			$log = array();

			switch($function) {
		    
		    	 case('getState'):
		    	 	$result = ChatHistory::where('sender',$company_viewer)->where('receiver',$oppurtunityId)->count();

		             $log['state'] = $result;
		        	 break;	
		    	
		    	 case('update'):
		    	 	$result = ChatHistory::where('sender',$company_viewer)->where('receiver',$oppurtunityId);
		    	 	$state = $request->input("state");


		    	 	if( (int)$state == (int)$result->count() ){

		    	 		$log['state'] = $state;
		        		$log['text'] = false;
		    	 	}else{
		    	 		 $text= array();
		    	 		 $log['state'] = $state + (int)$result->count() - $state;
		    	 
			 			    foreach ($result->get() as $chat )
		                    {	
		                     	$msg =  $line = str_replace("\n", "", $chat->text);
						  	 	//$receiverName = CompanyProfile::find($chat->receiver)->first();

						  	 	if($chat->action == 1){
						  	 		$senderName = CompanyProfile::find($chat->sender);
						  	 	}else{
						  	 		if($oppurtunityType == 'build'){
						  	 			$opp = OpportunityBuildingCapability::find($chat->receiver);
						  	 		}
						  			if($oppurtunityType == 'sell'){
						  	 			$opp = OpportunitySellOffer::find($chat->receiver);
						  	 		}
						  	 		if($oppurtunityType == 'buy'){
						  	 			$opp = OpportunityBuy::find($chat->receiver);
						  	 		}
						  	 		$senderName = CompanyProfile::find($opp->company_id);
						  	 	}

						  	 	$receiverName = $senderName;

		                     	$text[] = ['text'=>$msg, 'sender'=>$senderName->company_name, 'receiver'=>$receiverName->company_name, 'action'=>$chat->action  ];
		

		                    }
		        			$log['text'] = $text; 
					}
		             break;
		    	 
		    	case('onload'):
		    	 	$result = ChatHistory::where('sender',$company_viewer)->where('receiver',$oppurtunityId);
		    	 	//$state = $request->input("state");

		    	 		 $text= array();
		    	 		 //$log['state'] = $state + (int)$result->count() - $state;
		    	 
			 			    foreach ($result->get() as $chat )
		                    {	
		                     	$msg =  $line = str_replace("\n", "", $chat->text);
						  	 	//$senderName = CompanyProfile::find($chat->sender);
						  	 	//$receiverName = CompanyProfile::find($chat->receiver)->first();

						  	 	if($chat->action == 1){
						  	 		$senderName = CompanyProfile::find($chat->sender);
						  	 	}else{
						  	 		if($oppurtunityType == 'build'){
						  	 			$opp = OpportunityBuildingCapability::find($chat->receiver);
						  	 		}
						  			if($oppurtunityType == 'sell'){
						  	 			$opp = OpportunitySellOffer::find($chat->receiver);
						  	 		}
						  	 		if($oppurtunityType == 'buy'){
						  	 			$opp = OpportunityBuy::find($chat->receiver);
						  	 		}
						  	 		$senderName = CompanyProfile::find($opp->company_id);
						  	 	}

						  	 	$receiverName = $senderName;

		                     	$text[] = ['text'=>$msg, 'sender'=>$senderName->company_name, 'receiver'=>$receiverName->company_name, 'action'=>$chat->action ];
		                    }
		        			$log['text'] = $text; 
		             break;

		    	 case('send'):
						$message = $request->input("message"); //viewer

					 $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
					  $message = htmlentities(strip_tags($message));
				 if(($message) != "\n"){
		        	
					if(preg_match($reg_exUrl, $message, $url)) {
		       			$message = preg_replace($reg_exUrl, '<a href="'.$url[0].'" target="_blank">'.$url[0].'</a>', $message);
					} 
					 
					
					ChatHistory::create([

						'sender' => $company_viewer,

						'receiver' => $oppurtunityId,

						'text' => $message,

						'opp_type' => $oppurtunityType,

						'action' => $chatAction

					]);
		        		
		        	
				 }
		        	 break;
	    	
	    	}#end switch
			echo json_encode($log);
		}

	}


}#end class

