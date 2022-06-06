<?php

namespace App\Http\Controllers;

use App\User;
use App\CompanyProfile;
use App\ChatHistory;
use App\ChatHistoryHead;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use App\Mailbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class ChatHistoryController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function changeStatus(Request $request){
		$function = $request->input("function"); 
		$sender = $request->input("sender"); 
		$receiver = $request->input("receiver");
		$opp_type = $request->input("opp_type");
		$head_id = $request->input("head_id");
		$status = 1;
		$log['error'] = false;
		$chat = ChatHistory::getChatDetails($head_id, $status);
		if($chat){
			$log['error'] = true;
		}
		echo json_encode($log);
	}

	public function processHead(Request $request){
		$function = $request->input("function"); 
		$user_id = Auth::id();	
		$company_id = CompanyProfile::getCompanyId($user_id);
		$log = array();

		switch ($function) {

	    	case('getAllState'):
				$resBuild = ChatHistory::getChatHistoryBuildOpportunity($company_id);
				$resSell = ChatHistory::getChatHistorySellOpportunity($company_id)->merge($resBuild);
				$resBuy = ChatHistory::getChatHistoryBuyOpportunity($company_id)->merge($resSell);
				$chatHeads = $resBuy->count();
				$count = 0;
				foreach ($resBuy as $heads )
                {	
                	$count += ChatHistory::getStatusCount($heads->head_id);
                }
         		$log['overAllState'] = $chatHeads;
         		$log['overAllChatStatus'] = $count;
	    	break;

			case('updateChatHeads'):
				$resBuild = ChatHistory::getChatHistoryBuildOpportunity($company_id);
				$resSell = ChatHistory::getChatHistorySellOpportunity($company_id)->merge($resBuild);
				$resBuy = ChatHistory::getChatHistoryBuyOpportunity($company_id)->merge($resSell);
				$chatHeads = $resBuy->count();
				$count = 0;
				foreach ($resBuy as $heads )
                {	
                	$count += ChatHistory::getStatusCount($heads->head_id);
                }
	    	 	$state = $request->input("overAllState");
	    	 	$overAllChatStatus = $request->input("overAllChatStatus");

	    	 	if( (int)$state == (int)$chatHeads && $overAllChatStatus == $count ){
	    	 		$log['overAllState'] = $state;
	    	 		$log['overAllChatStatus'] = $overAllChatStatus;
	        		$log['text'] = false;
	    	 	}else{
	    	 		 $text= array();
	    	 		 $log['overAllState'] = $state + (int)$chatHeads - $state;
	    	 		 $log['overAllChatStatus'] = $overAllChatStatus + (int)$count - $overAllChatStatus;

		 			    foreach ($resBuy as $heads )
	                    {
	                        
	                        $action_code = "0";
                            if($company_id == $heads->sender ){
		                          $action_code = "1";
		                    }
		                    else{
		                        $action_code = "2";
		                    }
	                        
	                    	$date = date("F j, Y, g:i a", strtotime($heads->created_at));
                        
                        if($company_id == $heads->sender){
                            $avatar = \App\UploadImages::where('company_id', $heads->company_id)
                            	->where('file_category', 'PROFILE_AVATAR')
                                ->orderBy('id', 'desc')
                                ->first();
                            $companyName = CompanyProfile::find( $heads->company_id)->company_name;
                        }
                        else{
                            $avatar = \App\UploadImages::where('company_id', $heads->sender)
                            	->where('file_category', 'PROFILE_AVATAR')
                                ->orderBy('id', 'desc')
                                ->first();
                            $companyName = CompanyProfile::find($heads->sender)->company_name;
                        }
                        
                            $avat = '';
                            if (!isset($avatar->file_name)) 
                                $avatarUrl = asset('public/images/industry')."/guest.png";
                            else 
                                $avatarUrl = asset('public/images')."/".$avatar->file_name;

	   						
	                     	$text[] = [
	                     			'avatarUrl'=>$avatarUrl, 
	                     			'opp_title'=>$heads->opp_title ? $heads->opp_title : " ", 
	                     			'company_id'=>$heads->company_id, 
	                     			'sender'=>$heads->sender, 
	                     			'receiver'=>$heads->receiver, 
	                     			'opp_type'=>$heads->opp_type, 
	                     			'opp_type'=>$heads->opp_type, 
	                     			'company_name'=> $companyName ? $companyName : " ",
	                     			'date'=>$date,
                     			'status'=> ChatHistory::getStatusCount($heads->head_id),
                     			'action_code' => $action_code
	                     			];
	                    }
	        			$log['text'] = $text; 
				}
	        break;
		}
		echo json_encode($log);
	}
	
	public function process2(Request $request) {
		if ($request->isMethod('post')) {
			$company_opp = $request->input("companyOpp"); //opportunity owner
			$company_viewer = $request->input("companyViewer"); //viewer
			$oppurtunityId = $request->input("oppId"); 
			$oppurtunityType = $request->input("oppType"); 
			$function = $request->input("function"); 
			$chatAction = $request->input("chatAction"); //chat action 1=send 2=reply

			$user_id = Auth::id();	
			
			$user_company = CompanyProfile::getCompanyId($user_id);
			
			$rs = CompanyProfile::find($company_opp);
			$sender = CompanyProfile::find($company_viewer);
 			$log = array();

			switch($function) {
		    
		    	 case('getState'):
	    			$result = 0;
	    	 		if( $head = ChatHistoryHead::checkExistingData($company_viewer, $oppurtunityId, $oppurtunityType) ){
		    	 		$result = ChatHistory::where('head_id',$head->id)->count();
			    	}
		             $log['state'] = $result;
		        	 break;	
		    	
		    	 case('update'):
		    	 	$result = false;
		    	 	if( $head = ChatHistoryHead::checkExistingData($company_viewer, $oppurtunityId, $oppurtunityType) ){
		    	 		$result = ChatHistory::where('head_id',$head->id)->get();
			    	}
					if($oppurtunityType == 'build'){
		  	 			$opp = OpportunityBuildingCapability::find($oppurtunityId);
		  	 		}
		  			if($oppurtunityType == 'sell'){
		  	 			$opp = OpportunitySellOffer::find($oppurtunityId);
		  	 		}
		  	 		if($oppurtunityType == 'buy'){
		  	 			$opp = OpportunityBuy::find($oppurtunityId);
		  	 		}

		    	 	$state = $request->input("state");
		    	 	if( (int)$state == ($result == false? 0 : $result->count()) ){
		    	 		$log['state'] = $state;
		        		$log['text'] = false;
		    	 	}else{
		    	 		 $text= array();
		    	 		 $log['state'] = $state + (int)$result->count() - $state;
		 			    foreach ($result as $chat )
		                    {	
		                        
		                        if($user_company == $request->input("companyViewer") ){
		                            
		                            if($chat->action == 1){
		                                $chat->action = 2;
		                            }
		                            else{
		                                $chat->action = 1;
		                            }
		                        }
		                        else{
		                            
		                        }
		                
		                    	$msg = decrypt($chat->text);
		                     	$msg =  $line = str_replace("\n", "", $msg  );
						  	 	if($user_company != $request->input("companyViewer")){
					  	 		    $senderName = CompanyProfile::find($company_viewer)->company_name;
						  	 	}else{
					  	 		    $senderName = CompanyProfile::find($opp->company_id)->company_name;
						  	 	}
						  	 	$receiverName = $senderName;
	                     	$text[] = ['text'=>$msg, 'sender'=>$senderName, 'receiver'=>$receiverName, 'action'=>$chat->action  ];
		                    }
		        			$log['text'] = $text; 
					}
		             break;
		    	 
		    	case('onload'):
		    		$result = [];
			    	if( $head = ChatHistoryHead::checkExistingData($company_viewer, $oppurtunityId, $oppurtunityType) ){
		    	 		$result = ChatHistory::where('head_id',$head->id)->get();
			    	}
						  	 		if($oppurtunityType == 'build'){
		  	 			$opp = OpportunityBuildingCapability::find($oppurtunityId);
						  	 		}
						  			if($oppurtunityType == 'sell'){
		  	 			$opp = OpportunitySellOffer::find($oppurtunityId);
						  	 		}
						  	 		if($oppurtunityType == 'buy'){
		  	 			$opp = OpportunityBuy::find($oppurtunityId);
						  	 		}
		    	 	$text= array();
	 			    foreach ($result as $chat )
                    {	
                        if($user_company == $request->input("companyViewer") ){
		                            
		                            if($chat->action == 1){
		                                $chat->action = 2;
		                            }
		                            else{
		                                $chat->action = 1;
		                            }
		                }
		                        
                    	$msg = decrypt($chat->text);
                     	$msg = str_replace("\n", "", $msg  );
				  	 	if($user_company != $request->input("companyViewer")){
				  	 		$senderName = CompanyProfile::find($company_viewer)->company_name;
				  	 	}else{
				  	 		$senderName = CompanyProfile::find($opp->company_id)->company_name;
						  	 	}
						  	 	$receiverName = $senderName;
                     	$text[] = ['text'=> $msg, 'sender'=>$senderName, 'receiver'=>$receiverName, 'action'=>$chat->action ];
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
						if($res = ChatHistoryHead::checkExistingData($company_viewer, $oppurtunityId, $oppurtunityType)){
							$chatHeadId = $res->id;
						}else{
					 
							if($oppurtunityType == 'build'){
				  	 			$opp = OpportunityBuildingCapability::find($oppurtunityId);
				  	 		}
				  			if($oppurtunityType == 'sell'){
				  	 			$opp = OpportunitySellOffer::find($oppurtunityId);
				  	 		}
				  	 		if($oppurtunityType == 'buy'){
				  	 			$opp = OpportunityBuy::find($oppurtunityId);
				  	 		}
					
							$chatHeadId = ChatHistoryHead::create([
						'sender' => $company_viewer,
						'receiver' => $oppurtunityId,
											'opp_type' => $oppurtunityType
										])->id;

							Mailbox::create([
								'sender_id' => $company_viewer,
								'receiver_id' => $opp->company_id,
								'remarks' => CompanyProfile::find($company_viewer)->company_name. " sent you a message" ,
								'subject'=> 'Prokakis Chat Messages',
								'status' => 1,
								'is_type'=> 'chat'
							]);


						}

						if($chatHeadId){
							ChatHistory::create([
								'head_id' => $chatHeadId,
						'text' => encrypt($message),
						'action' => $chatAction
					]);
						}
				 }
		        	 break;
	    	
	    	}#end switch
			echo json_encode($log);
		}

	}

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
	    			$result = 0;
	    	 		if( $head = ChatHistoryHead::checkExistingData($company_viewer, $oppurtunityId, $oppurtunityType) ){
		    	 		$result = ChatHistory::where('head_id',$head->id)->count();
			    	}
		             $log['state'] = $result;
		        	 break;	
		    	
		    	 case('update'):
		    	 	$result = false;
		    	 	if( $head = ChatHistoryHead::checkExistingData($company_viewer, $oppurtunityId, $oppurtunityType) ){
		    	 		$result = ChatHistory::where('head_id',$head->id)->get();
			    	}
					if($oppurtunityType == 'build'){
		  	 			$opp = OpportunityBuildingCapability::find($oppurtunityId);
		  	 		}
		  			if($oppurtunityType == 'sell'){
		  	 			$opp = OpportunitySellOffer::find($oppurtunityId);
		  	 		}
		  	 		if($oppurtunityType == 'buy'){
		  	 			$opp = OpportunityBuy::find($oppurtunityId);
		  	 		}

		    	 	$state = $request->input("state");
		    	 	if( (int)$state == ($result == false? 0 : $result->count()) ){
		    	 		$log['state'] = $state;
		        		$log['text'] = false;
		    	 	}else{
		    	 		 $text= array();
		    	 		 $log['state'] = $state + (int)$result->count() - $state;
		 			    foreach ($result as $chat )
		                    {	
		                    	$msg = decrypt($chat->text);
		                     	$msg =  $line = str_replace("\n", "", $msg  );
						  	 	if($chat->action == 1){
					  	 		$senderName = CompanyProfile::find($company_viewer)->company_name;
						  	 	}else{
					  	 		$senderName = $opp->opp_title;
						  	 	}
						  	 	$receiverName = $senderName;
	                     	$text[] = ['text'=>$msg, 'sender'=>$senderName, 'receiver'=>$receiverName, 'action'=>$chat->action  ];
		                    }
		        			$log['text'] = $text; 
					}
		             break;
		    	 
		    	case('onload'):
		    		$result = [];
			    	if( $head = ChatHistoryHead::checkExistingData($company_viewer, $oppurtunityId, $oppurtunityType) ){
		    	 		$result = ChatHistory::where('head_id',$head->id)->get();
			    	}
						  	 		if($oppurtunityType == 'build'){
		  	 			$opp = OpportunityBuildingCapability::find($oppurtunityId);
						  	 		}
						  			if($oppurtunityType == 'sell'){
		  	 			$opp = OpportunitySellOffer::find($oppurtunityId);
						  	 		}
						  	 		if($oppurtunityType == 'buy'){
		  	 			$opp = OpportunityBuy::find($oppurtunityId);
						  	 		}
		    	 	$text= array();
	 			    foreach ($result as $chat )
                    {	
                    	$msg = decrypt($chat->text);
                     	$msg = str_replace("\n", "", $msg  );
				  	 	if($chat->action == 1){
				  	 		$senderName = CompanyProfile::find($company_viewer)->company_name;
				  	 	}else{
				  	 		$senderName = $opp->opp_title;
						  	 	}
						  	 	$receiverName = $senderName;
                     	$text[] = ['text'=> $msg, 'sender'=>$senderName, 'receiver'=>$receiverName, 'action'=>$chat->action ];
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
						if($res = ChatHistoryHead::checkExistingData($company_viewer, $oppurtunityId, $oppurtunityType)){
							$chatHeadId = $res->id;
						}else{
					 
							if($oppurtunityType == 'build'){
				  	 			$opp = OpportunityBuildingCapability::find($oppurtunityId);
				  	 		}
				  			if($oppurtunityType == 'sell'){
				  	 			$opp = OpportunitySellOffer::find($oppurtunityId);
				  	 		}
				  	 		if($oppurtunityType == 'buy'){
				  	 			$opp = OpportunityBuy::find($oppurtunityId);
				  	 		}
					
							$chatHeadId = ChatHistoryHead::create([
						'sender' => $company_viewer,
						'receiver' => $oppurtunityId,
											'opp_type' => $oppurtunityType
										])->id;

							Mailbox::create([
								'sender_id' => $company_viewer,
								'receiver_id' => $opp->company_id,
								'remarks' => CompanyProfile::find($company_viewer)->company_name. " sent you a message" ,
								'subject'=> 'Prokakis Chat Messages',
								'status' => 1,
								'is_type'=> 'chat'
							]);


						}

						if($chatHeadId){
							ChatHistory::create([
								'head_id' => $chatHeadId,
						'text' => encrypt($message),
						'action' => $chatAction
					]);
						}
				 }
		        	 break;
	    	
	    	}#end switch
			echo json_encode($log);
		}

	}

}#end class

