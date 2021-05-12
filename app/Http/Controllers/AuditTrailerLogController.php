<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\AuditLog;

class AuditTrailerLogController extends Controller {

	public function __construct() {
		$this->middleware('auth');
	}

	public function index(Request $request){
		$user_id = Auth::id();	
		$model =  $request->input('model');
		$action =  $request->input('action');
		$details =  $request->input('details');
		AuditLog::ok(array($user_id, $model, $action, $details));
	}

	public function view(){
		$rs = User::whereIn('user_type', array(1, 2, 3, 4))->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->get();

      return view('admin.auditlogs', compact('rs')); 
	}
	
}#end class

