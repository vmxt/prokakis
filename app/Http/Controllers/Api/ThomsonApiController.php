<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\ProkakisAccessToken;
// use GuzzleHttp\Client;
class ThomsonApiController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	var $prokakisToken = "";
	public function __construct() {
		//$this->middleware('auth');
		$prokakisToken =  new ProkakisAccessToken();
		$this->prokakisToken = $prokakisToken->registeredToken();
	}

	public function refinitive(){

		$cSession = curl_init(); 
		curl_setopt($cSession,CURLOPT_URL,'http://localhost/reputation/api/v1/thomson?pauth='.$this->prokakisToken);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		$response_twitter = json_decode($result);
		curl_close($cSession);

		return $response_twitter;

	}


}
