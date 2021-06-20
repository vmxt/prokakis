<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

use App\User;
use App\CompanyProfile;
use App\SAaccess;
use Session;
use App\InOutUsers;

class SubaccountsController extends Controller {

    
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

    public function __construct()
    {
 	 //   $this->middleware('auth');
    }
    
    public function index()
    {
      $userId = Auth::id();
      $addOn = $userId.'/'.time();
      $userId_Decoded = base64_encode($addOn);
      $url_result = url('/register-sa/'. $userId_Decoded);

      $usrs = User::where('m_id', $userId)->get();
      $company = CompanyProfile::where('user_id', $userId)->get();


      return view('subaccounts.index', compact('url_result', 'usrs', 'company'));
    }

    public function setRegistration(Request $request)
    {
      if(Auth::id()){
      //    echo 'Still Login'; 
        InOutUsers::insert_updateDB(array('user_id'=>Auth::id(), 'status'=>0));
        Auth::logout();
      }
      
      $userId_Decoded = base64_decode($request['userId']);
      $rs = explode("/", $userId_Decoded);
      $userIdDecode = base64_encode($rs[0]);
      return view('auth.registerSubaccounts', compact('userIdDecode'));
    }

    public function ajxRegistration(Request $request)
    {
      if($request->isMethod('post')) {
        $ssId = Auth::id();
        if($ssId){
            $mood = $request->input('mood');
            $user_id = $request->input('user_id');
            $company_id = $request->input('company_id');
            $sa_config_id = $request->input('sa_config_id');
            
            if($mood == 'add'){

             $ok = SAaccess::create([
                'user_id' => $user_id, 
                'company_id' =>  $company_id, 
                'sa_config_id' =>  $sa_config_id, 
                'created_by'  => $ssId, 
                'created_at'  => date('Y-m-d'),
              ]);
          

            } else {
              SAaccess::where('user_id', $user_id)->where('company_id', $company_id)->where('sa_config_id', $sa_config_id)->delete();

            }
          }   
      }

    }

    public function manageSelectedCompany(Request $request)
    {
      if(isset($request['company_id']))
      {
       $id = $request['company_id'];
       Session::put('SELECTED_COMPANY_ID', $id);
       $user_id = Auth::id();
       $company = CompanyProfile::find($id); 
       $rs = SAaccess::where('company_id', $id)->where('user_id', $user_id)->select('sa_config_id')->distinct()->get();

       return view('sa.itemaccess', compact('rs', 'company')); 
      }

    }

    public function ajxDeactivate(Request $request)
    {
      if ($request->isMethod('post')) {

        $user_id = $request->input("sa_user_id");
        $usr = User::find($user_id);

          if($usr != null && $usr->m_id > 0){  

              if($usr->status == 1){
              $usr->status = 0;
              } else {
              $usr->status = 1;
              }

              if($usr->save()){
                return 1;
              }
              
          } else {
            return 0;
          }
        
      }
    }

}