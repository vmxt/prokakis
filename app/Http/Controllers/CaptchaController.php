<?php

namespace App\Http\Controllers;

use App\User;
use App\TourDetail;
use App\Mailbox;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class CaptchaController extends Controller {

	public function __construct() {
		// $this->middleware('auth');
	}

	public function captcha(Request $request){
		$head_id = $request->input("auth_id"); 
		$scope = $request->input("scope"); 
		$is_end = $request->input("is_end"); 
		$log['error'] = false;
		$res = TourDetail::updateTourDetail($head_id, $scope, $is_end);
		if($res){
			$log['error'] = true;
		}
		echo json_encode($log);
	}

	

}#end class

