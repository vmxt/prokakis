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
		    	
		    	case('getAllState'):
		    			$user_id = Auth::id();
						$company_id = CompanyProfile::getCompanyId($user_id);
						$resBuild = ChatHistory::getChatHistoryBuildOpportunity($company_id);
						$resSell = ChatHistory::getChatHistorySellOpportunity($company_id)->merge($resBuild);
						$resBuy = ChatHistory::getChatHistoryBuyOpportunity($company_id)->merge($resSell);
						$chatHeads = $resBuy->count();
	             		$log['overAllState'] = $chatHeads;
		    	break;

				case('updateChatHeads'):
		    	 	
	    	 		$user_id = Auth::id();
					$company_id = CompanyProfile::getCompanyId($user_id);
					$resBuild = ChatHistory::getChatHistoryBuildOpportunity($company_id);
					$resSell = ChatHistory::getChatHistorySellOpportunity($company_id)->merge($resBuild);
					$resBuy = ChatHistory::getChatHistoryBuyOpportunity($company_id)->merge($resSell);
					$chatHeads = $resBuy->count();

		    	 	$state = $request->input("overAllState");

		    	 	if( (int)$state == (int)$chatHeads ){
		    	 		$log['overAllState'] = $state;
		        		$log['text'] = false;
		    	 	}else{
		    	 		 $text= array();
		    	 		 $log['overAllState'] = $state + (int)$chatHeads - $state;

			 			    foreach ($resBuy as $heads )
		                    {	
		                    	$date = date("F j, Y, g:i a", strtotime($heads->created_at));
                                $avatar = \App\UploadImages::where('company_id', $heads->sender)->where('file_category', 'PROFILE_AVATAR')
                                    ->orderBy('id', 'desc')
                                    ->first();
                                $avat = '';
                                if (!isset($avatar->file_name)) 
                                    $avatarUrl = asset('public/images/industry')."/guest.png";
                                else 
                                    $avatarUrl = asset('public/images')."/".$avatar->file_name;
		   
		                     	$text[] = [
		                     			'avatarUrl'=>$avatarUrl, 
		                     			'opp_title'=>$heads->opp_title, 
		                     			'company_id'=>$heads->company_id, 
		                     			'sender'=>$heads->sender, 
		                     			'receiver'=>$heads->receiver, 
		                     			'opp_type'=>$heads->opp_type, 
		                     			'opp_type'=>$heads->opp_type, 
		                     			'company_name'=> CompanyProfile::getCompanyName($heads->sender),
		                     			'date'=>$date
		                     			];
		
		                    }
		        			$log['text'] = $text; 
					}
		             break;

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
		                    	$msg = decrypt($chat->text);
		                     	$msg =  $line = str_replace("\n", "", $msg  );
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
		                    	$msg = decrypt($chat->text);
		                     	$msg =  $line = str_replace("\n", "", $msg  );
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

		                     	$text[] = ['text'=> $msg, 'sender'=>$senderName->company_name, 'receiver'=>$receiverName->company_name, 'action'=>$chat->action ];
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

						'text' => encrypt($message),

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

