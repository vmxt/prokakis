<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Configurations;
use App\CompanyProfile;
use App\UploadImages;
use App\CompanyContacts;
use Auth;
use Config;
use App\AuditLog;

class CompanyContactsController extends Controller
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
    
  
    public function index()
    {
      $user_id = Auth::id(); 
      $company_id_result = CompanyProfile::getCompanyId($user_id);
  
      $profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);
      $contact_id= CompanyContacts::getContactId($user_id, $company_id_result);
      $brand_slogan = CompanyProfile::getBrandSlogan($user_id, $company_id_result);
     
      $company_data = '';
      
      if($contact_id != 0){
        $company_data = CompanyContacts::find($contact_id);
      }
      
      return view('profile.contacts', compact('profileAvatar', 'company_data', 'brand_slogan'));
    }
    
    public function store(Request $request)
    {
      $user_id = Auth::id(); 
      $company_id = CompanyProfile::getCompanyId($user_id);
              
      if($request->isMethod('post')) {     
            
         $ok = $this->validate($request,[
                'company_email' => 'string|email|max:255',
                'company_phone' => 'string|max:50',
                'company_mobile' => 'string|max:50',
            ]);
         
         if($ok){
            $contact_id = CompanyContacts::getContactId($user_id, $company_id);
       
             if($contact_id != 0){
                 
                $company_data = CompanyContacts::find($contact_id);
                $company_data->email_address = $request->input('company_email');
                $company_data->mobile_number = $request->input('company_mobile');
                $company_data->office_number = $request->input('company_phone');
                $company_data->edited_by = $user_id;
                $company_data->save();

                AuditLog::ok(array($user_id, 'contacts', 'update', 'new info'));
                
                return redirect('profile/contacts')->with('status', 'Company contact information has been succesfully saved.');
             }
             else{
                $com_concat = CompanyContacts::create([
    			 	'user_id'=>$user_id,
    			 	'company_id'=>$company_id,
    			 	'email_address'=>$request->input('company_email'),
    			 	'mobile_number'=>$request->input('company_mobile'),
    			 	'office_number'=>$request->input('company_phone'),
    			 	'added_by' => $user_id
    			 ]);
    			 AuditLog::ok(array($user_id, 'contacts', 'add', 'new info'));
    			 return redirect('profile/contacts')->with('status', 'Company contact information has been succesfully saved.');
             }
         }
         else{
             return redirect('profile/contacts')->with('status', 'Failed to save.');
         }
      }
    }
    
    
}
