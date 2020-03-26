<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanyProfile;
use App\User;
use App\UploadImages;
use Auth;
use Config;
use App\Buytoken;
use App\CompanySpentTokens;
use PDF;

class CompanyPaymentController extends Controller
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
    
      $rs_buy = Buytoken::where('company_id', $company_id_result) //'company id'
               ->orderBy('id', 'asc')
               ->get();

      $rs_spent = CompanySpentTokens::where('user_id', $user_id) //'user_id'
              ->where('company_id', $company_id_result)
              ->orderBy('id', 'asc')
              ->get();
  
      return view('profile.payment', compact('profileAvatar', 'rs_buy', 'brand_slogan', 'rs_spent', 'company_id_result'));
    }

    public function printPreviewPurchased(Request $request)
    {
      if(isset($request['companyId'])){
         $company_id = $request['companyId'];

         $user_id = Auth::id();
         $company_id_result = CompanyProfile::getCompanyId($user_id);
         $companyD = CompanyProfile::find($company_id);
         $userD = User::find($user_id);
         if($company_id == $company_id_result){
          $rs_buy = Buytoken::where('company_id', $company_id) //'company id'
          ->orderBy('id', 'asc')
          ->get();
          return view('profile.printPreviewPurchased', compact('rs_buy', 'companyD', 'userD'));
         } else{
          return redirect('/profile/paymentHistory')->with('message', 'Unauthorised printing of company information.');  
         }
      }
    }

    public function printPreviewSpent(Request $request)
    {
      if(isset($request['companyId'])){
         $user_id = Auth::id();
         $company_id = $request['companyId'];

         $user_id = Auth::id();
         $company_id_result = CompanyProfile::getCompanyId($user_id);

         if($company_id == $company_id_result){
          $rs_spent = CompanySpentTokens::where('company_id', $company_id)
          ->orderBy('id', 'asc')
          ->get();
          return view('profile.printPreviewTokenSpent', compact('rs_spent'));
         } else{
          return redirect('/profile/paymentHistory')->with('message', 'Unauthorised printing of company information.');
         }
      }
    }


    public function generatePdf(Request $request){
        if(!isset($request['reportType'])){
          return "Please Specify Report Type";
        }

        $report_type = $request['reportType'];
        if(isset($request['companyId'])){
         $company_id = $request['companyId'];

         $user_id = Auth::id();
         $company_id_result = CompanyProfile::getCompanyId($user_id);
         $companyD = CompanyProfile::find($company_id);
         $userD = User::find($user_id);

         if($company_id == $company_id_result){

          $result = "";
          switch ( $request['reportType'] ) {
            case 'buyToken':
              $result = Buytoken::where('company_id', $company_id) //'company id'
                ->orderBy('id', 'asc')
                ->get();
              break;
            case 'spentToken':
              $result = CompanySpentTokens::where('company_id', $company_id)
                ->orderBy('id', 'asc')
                ->get();
              break;
          }

          $pdf = PDF::loadView('profile.'.$report_type."PDF", compact('result','companyD', 'userD'));
  
          return $pdf->download('purchase history.pdf');

         } else{
          return redirect('/profile/paymentHistory')->with('message', 'Unauthorised printing of company information.');  
         }

      }
    }
 
    
}
