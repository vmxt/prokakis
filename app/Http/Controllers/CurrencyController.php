<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Config;
use Illuminate\Http\Request;

use App\CurrencyAccounts;
use App\CurrencyMonetary;


class CurrencyController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		$this->middleware('auth');

	}

	public function updateAccount(Request $request){
	
		$currency_id = $request['currency_id'];
		$user_id = $request['user_id'];
		$acc = CurrencyAccounts::where('user_id',$user_id)->first(); 
		if($acc){
			$acc->currency_id = $currency_id;
			$acc->save();
		}else{
			 CurrencyAccounts::create([
			 	'user_id'=>$user_id, 'currency_id'=>$currency_id
			 ]);
		}
	}


}