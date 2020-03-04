<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Configurations;
use App\CompanyProfile;
use App\UploadImages;
use App\CompanyContacts;
use App\CompanyBilling;
use App\Users;
use App\AuditLog;

use Auth;
use Config;

class CompanyBillingController extends Controller
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
      $user_email = Auth::user()->email;
      $company_id_result = CompanyProfile::getCompanyId($user_id);
     
      $profileAvatar = UploadImages::getFileNames($user_id, $company_id_result, Config::get('constants.options.profile'), 1);
      $brand_slogan = CompanyProfile::getBrandSlogan($user_id, $company_id_result);
     
      $billing_id = CompanyBilling::getBillingId($user_id, $company_id_result);
      
      if($billing_id != 0){
          
        $bill = CompanyBilling::find($billing_id);
       
      }
      
      if($bill->account_name == null){
       $bill->account_name = $brand_slogan[0];   
      }
      if($bill->account_email == null){
       $bill->account_email = $user_email;   
      } 
      
      return view('profile.billing', compact('profileAvatar', 'bill', 'brand_slogan'));
    }
    
    public function store(Request $request)
    {
      $user_id = Auth::id(); 
      $company_id = CompanyProfile::getCompanyId($user_id);
              
      if($request->isMethod('post')) {     
            
         $ok = $this->validate($request,[
                'account_name' => 'required|string|max:255',
                'account_email' => 'required|string|email|max:255',
                'card_holder_name' => 'string|max:255',
                'card_number' => 'string|max:255',
                'security_code' => 'string|max:255',
                'card_expiry_date' => 'string|max:255',
            ]);
         
         if($ok){
             
            $billing_id = CompanyBilling::getBillingId($user_id, $company_id);
       
             if($billing_id != 0){
                 
                $company_data = CompanyBilling::find($billing_id );
                $company_data->account_name = $request->input('account_name');
                $company_data->account_email = $request->input('account_email');
                $company_data->card_holder_name = $request->input('card_holder_name');
                $company_data->card_number = $request->input('card_number');
                $company_data->security_code = $request->input('security_code');
                $company_data->card_expiry_date = $request->input('card_expiry_date');
                $company_data->edited_by = $user_id;
                $company_data->save();
                
                AuditLog::ok(array($user_id, 'billing', 'update', 'update info'));
                return redirect('profile/billing')->with('status', 'Company billing information has been succesfully saved.');
             }
           
         }
      }
    }
    
    public function update(Request $request)
    {
      $user_id = Auth::id(); 
      $company_id = CompanyProfile::getCompanyId($user_id);
      
        if($request->isMethod('post')) {  
         if($request->ajax()){
                
            $ok = $this->validate($request,[
                'account_name' => 'required|string|max:255',
                'account_email' => 'required|string|email|max:255',
            ]);
         
            if($ok){
                $billing_id = CompanyBilling::getBillingId($user_id, $company_id);
                    
                   if($billing_id != 0){
                       
                        $company_data = CompanyBilling::find($billing_id);
                        $company_data->account_name = $request->input('account_name');
                        $company_data->account_email = $request->input('account_email');
                        $company_data->edited_by = $user_id;
                        $company_data->save();

                         AuditLog::ok(array($user_id, 'billing', 'update', 'billing id:'.$billing_id));
                    }
                }
               
            }
        }
    
    }
    
}
