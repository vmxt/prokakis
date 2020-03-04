<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Configurations;
use App\CompanyProfile;
use App\UploadImages;
use App\CompanyContacts;
use App\CompanyBilling;
use App\CompanyPayment;
use App\CompanySocialAccounts;
use App\Users;
use App\AuditLog;

use Auth;
use Config;

class CompanySocialAccountsController extends Controller
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
      $brand_slogan = CompanyProfile::getBrandSlogan($user_id, $company_id_result);
     
      $regions_countries = Configurations::getJsonValue('regions_countries');
      $language_spoken = Configurations::getJsonValue('language_spoken ');
      
        
      $rs = $c = CompanySocialAccounts::where('user_id', $user_id)->where('company_id', $company_id_result)->first();
      
      return view('profile.social', compact('profileAvatar', 'rs', 'brand_slogan', 'regions_countries','language_spoken'));
    }
    
    public function store(Request $request)
    {
      $user_id = Auth::id();
      $company_id_result = CompanyProfile::getCompanyId($user_id);
        
        if ($request->isMethod('post')) {  
            
            $cs = CompanySocialAccounts::where('user_id', $user_id)->where('company_id', $company_id_result)->first();
              
            if(isset($cs->id)){
             
                $cr = $request->input('countries_regions');
                
                if(is_array($cr)){
                $new_cr = implode(',', $cr);
                $cs->countries_regions = $new_cr;
                } else {
                $cs->countries_regions = $cr;
                }
                
                $ls = $request->input('language_spoken');
                if(is_array($ls)){
                $new_ls = implode(',', $ls);
                $cs->language_spoken =  $new_ls;
                } else {
                $cs->language_spoken =  $ls;
                }
                
                $cs->company_homepage = $request->input('company_homepage');
                $cs->profile_link = $request->input('profile_link');
                $cs->linkedin = $request->input('linkedin');
                $cs->facebook = $request->input('facebook');
                $cs->twitter = $request->input('twitter');
                $cs->google = $request->input('google');
                $cs->otherlink = $request->input('otherlink');
                $cs->save();

                AuditLog::ok(array($user_id, 'social accounts', 'update', 'new info saved')); 
                return redirect('profile/socialAccounts/')->with('status', 'Company social accounts information has been succesfully saved.');
             
            }
            
        }  
        
    }
 
    
}
