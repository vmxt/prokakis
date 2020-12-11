<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\CompanyProfile;
use App\UploadImages;
use Auth;
use Config;
use App\User;

class UpdatePasswordController extends Controller
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

    public function setData()
    {
        $user_id = Auth::id();
        //echo $user_id;
        $user_email = Auth::user()->email;
        $company_id_result = CompanyProfile::getCompanyId($user_id);
       
        $profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);
        $brand_slogan = CompanyProfile::getBrandSlogan($user_id, $company_id_result);

        return view('password.index', compact('profileAvatar', 'brand_slogan', 'company_id_result'));
    }

    public function getData(Request $request)
    {
        
		if($request->isMethod('post')) {

           $this->validate($request, [
                 'current_passw' => 'required|string|min:6',
                'new_passw' => 'required|string|min:6|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'reenter_passw' => 'required|string|min:6|same:new_passw',
           ], [
            'current_passw.required' => 'Current password is required',
            'new_passw.required' => 'New password is required',
            'reenter_passw.required' => 'Re-entered new password is required',
            'current_passw.min' => 'Current password is atleast minimum of 6 characters',
            'new_passw.min' => 'New password is atleast minimum of 6 characters',
            'reenter_passw.min' => 'Re-entered new password atleast minimum of 6 characters',
            'reenter_passw.same' => 'The two new passwords does not matched',
            'new_passw.regex' => 'Password must contain atleast single upper/lower case characters (A-Z) and (a-z), and digits(0-9), and non alphanumeric(!, $, #, or %)',
            
           ]

            ); 

           $current_pass = $request->input('current_passw');
           $new_pass = $request->input('new_passw');
           $re_newpass = $request->input('reenter_passw');

           $user = Auth::user();
     
           $credentials = [
                'id' => $user->id,
                'password' => $current_pass
            ];
            
            if($new_pass != $re_newpass){
            return redirect('/psswrd-set')->with('message', 'Please re-enter again the new password. The two passwords does not matched.');
            exit;
            }    

            // Make sure current password is correct
            if (Auth::validate($credentials) && $new_pass == $re_newpass) { // Checks the User's credentials
                
               $u = User::find($user->id);
               $u->password = bcrypt($new_pass);
               $u->save();
           
               return redirect('/psswrd-set')->with('status', 'You have succesfully updated your password.');
                 

            } else {
               
                return redirect('/psswrd-set')->with('message', 'Current password does not matched.');
                exit;

            }
            


        }

    }
    

}
