<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use DB;
use App\RegistrationLinks;
use Auth;

class SuperAdminController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function approvalPage()
    {
      $rs = User::whereIn('user_type', array(1, 2, 3, 4))->get();
        
      return view('admin.approvalaccounts', compact('rs')); 
    }

    public function storeApproval(Request $request)
    {
        if($request->isMethod('post'))
        {
          $user_status = $request->input('user_status');
          $user_id =  $request->input('user_id');
          $rs = User::find($user_id);  
           if(count($rs) > 0){
            $rs->status = $user_status;
            $ok = $rs->save();
                if($ok){
                   return redirect('/accounts-approval')->with('status', 'User been succesfully updated.');
                }
           } else {
                 return redirect('/accounts-approval')->with('message', 'There was an error in updating the user.'); 
           } 
        }
    }

    public function allCompanies(Request $request)
    {
     $rs =  DB::table('company_profiles')
            ->leftjoin('users', 'users.id', '=', 'company_profiles.user_id')
            ->select('*')
            ->where('users.status', '1')    
            ->get();

      return view('admin.companies', compact('rs'));
             
    }

    public function manageLinks()
    {
      $rs = RegistrationLinks::all();
      return view('admin.registrationlinks', compact('rs'));
    }


    public function addLinks(Request $request)
    {
      if($request->isMethod('post'))
      {
       $user_id = Auth::id();

       $userType = $request->input('user_type'); 
       $category = '';
       $link = '';
       $token = RegistrationLinks::generateToken();

        if($userType == '0')
        {
          return redirect('/manage-registration-links')->with('message', 'Please select a category.'); 
          exit; 
        } elseif($userType == '2')
        {
          $category = 'Sub-Con';
          $link = url('/register-personnel/'.$category.'/'.$token);

        } elseif($userType == '3')
        {
          $category = 'Mas-Con';
          $link = url('/register-personnel/'.$category.'/'.$token);

        } elseif($userType == '4')
        {
          $category = 'Eboss-Staff';
          $link = url('/register-personnel/'.$category.'/'.$token);
        } 

        $ok = RegistrationLinks::create([
          'category' => $category, 
          'link'     => $link, 
          'status'   => 1, 
          'token'    => $token, 
          'created_at' => date('Y-m-d'), 
          'created_by' => $user_id,
        ]);
        
        if($ok){
          return redirect('/manage-registration-links')->with('status', 'You have suucessfully added the link.'); 
        }

      }
     
    }
   
}
