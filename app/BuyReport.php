<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ConsultantProjects;
use App\CompanyProfile;
use App\Configurations;
use App\GeneratedReport;
use App\KeyManagement;
use App\ProcessedReport;
use App\RequestApproval;
use App\RequestReport;
use App\ReportGenerationTemplate;
use App\User;
use Auth;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PDF;
use App\ThomsonReuters;
use App\TR_reportgeneration;
use App\FA_Results;
use ZipArchive;

use App\ProkakisAccessToken;
use GuzzleHttp\Client;


class BuyReport extends Model

{

     

     protected $table = 'processed_report';



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'approval_id', 'requester_company_id', 'source_company_id', 'report_status', 'request_frequency_id',

        'num_tokens_credited', 'month_subscription_start', 'month_subscription_end', 'frequency_value', 'report_link',

        'created_at', 'updated_at'

    ];



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'id', 

    ];

  public static function findMatchedMAS($companyName)
    {
       $token = new ProkakisAccessToken();       
       $urlToken  = $token->registeredToken();
       $searchKey = $companyName;
       $rURL = 'https://reputation.app-prokakis.com/api/v1/mas-search/'.$searchKey.'/'.$urlToken;
       $client = new Client();
       $rsToken = $client->get($rURL);
       $result = $rsToken->getBody()->getContents();  
       $rs = json_decode($result, true);
       if(isset($rs['Likely_Match'])){
            if(sizeof($rs['Likely_Match']) > 0){
                return $rs['Likely_Match'];
            } else {
                return 0; 
            }
       }

    }
   
    public static function searchMatchInBahamas($companyName)
    {
        $urlToken  = ProkakisAccessToken::getSCode();
        $searchKey = $companyName;
        $groupsP = 'bahamas';
        $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup/'.$searchKey.'/'.$groupsP.'/'.$urlToken;
        $client = new Client();
        $rsToken = $client->get($rURL);
        $result = $rsToken->getBody()->getContents();  
        $rs = json_decode($result, true);
  
        if(isset($rs['Likely_Match'])){

           if(sizeof($rs['Likely_Match']) > 0){
                return $rs['Likely_Match'];
            } else {
                return 0; 
            }
        }

    }
    
    public static function searchMatchInOffShore($companyName)
    {
        $urlToken  = ProkakisAccessToken::getSCode();
        $searchKey = $companyName;
        $groupsP = 'offshore';
        $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup/'.$searchKey.'/'.$groupsP.'/'.$urlToken;
        $client = new Client();
        $rsToken = $client->get($rURL);
        $result = $rsToken->getBody()->getContents();  
        $rs = json_decode($result, true);
  
        if(isset($rs['Likely_Match'])){

           if(sizeof($rs['Likely_Match']) > 0){
                return $rs['Likely_Match'];
            } else {
                return 0; 
            }
        }
       
    }

    public static function searchMatchInPanama($companyName)
    {
        $urlToken  = ProkakisAccessToken::getSCode();
        $searchKey = $companyName;
        $groupsP = 'panama';
        $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup/'.$searchKey.'/'.$groupsP.'/'.$urlToken;
        $client = new Client();
        $rsToken = $client->get($rURL);
        $result = $rsToken->getBody()->getContents();  
        $rs = json_decode($result, true);
  
        if(isset($rs['Likely_Match'])){

           if(sizeof($rs['Likely_Match']) > 0){
                return $rs['Likely_Match'];
            } else {
                return 0; 
            }
        }
       
    }

    public static function searchMatchInParadise($companyName)
    {
        $urlToken  = ProkakisAccessToken::getSCode();
        $searchKey = $companyName;
        $groupsP = 'paradise';
        $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup/'.$searchKey.'/'.$groupsP.'/'.$urlToken;
        $client = new Client();
        $rsToken = $client->get($rURL);
        $result = $rsToken->getBody()->getContents();  
        $rs = json_decode($result, true);
  
        if(isset($rs['Likely_Match'])){

           if(sizeof($rs['Likely_Match']) > 0){
                return $rs['Likely_Match'];
            } else {
                return 0; 
            }
        }
       
    }

    public static function getADM($rs, $repId)
    {
        $today = strtotime(date("Y-m-d"));
        $company_data = CompanyProfile::find($rs->source_company_id);
        $ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
        $reportTemplates = [];

        $conApproved = ConsultantProjects::where('request_approval_id', $rs->approval_id)->where('project_status', 'DONE')->first();
        $dateConDone = $conApproved->updated_at;	

        $date=date_create($dateConDone);
        $dateDone = date_format($date,"F j, Y"); //, g:i a

        foreach ($ReportGenerationTemplate as $key => $value) {
            $reportTemplates[ $value['variable_name'] ]  = $value['content'];
        }
        //var_dump($reportTemplates); exit;

        $approval = RequestApproval::find($rs->approval_id)->first(); //approval records
        $twitter_token = date('YmdHis');
        $twitter_keyword = $company_data->company_name;
        
        //Social Media
         $sCode = ProkakisAccessToken::getSCode().'|'.$twitter_token;
					
        $response_twitter = BuyReport::curlER_ADM($twitter_keyword, 'Twitter', $sCode);
        $response_youtube = BuyReport::curlER_ADM($twitter_keyword, 'Youtube', $sCode);
        $response_theweb = BuyReport::curlER_ADM($twitter_keyword, 'TheWeb', $sCode);

        $fileName = $repId.'_ADM'.'.pdf';
        $path = public_path('report_downloads/'. $repId.'/'.$fileName);

        $pdf = PDF::loadView('buyreport.adm_PDF',compact('company_data','reportTemplates', 'dateDone', 'response_twitter', 
        'response_youtube', 'response_theweb'))->save($path);

       // return File::files($path);
      
    } 

    public static function getIA($rs, $repId)
    {
        $today = strtotime(date("Y-m-d"));
        $company_data = CompanyProfile::find($rs->source_company_id);
        $ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
        $reportTemplates = [];

        $conApproved = ConsultantProjects::where('request_approval_id', $rs->approval_id)->where('project_status', 'DONE')->first();
        $dateConDone = $conApproved->updated_at;	

        $date=date_create($dateConDone);
        $dateDone = date_format($date,"F j, Y"); //, g:i a

        foreach ($ReportGenerationTemplate as $key => $value) {
            $reportTemplates[ $value['variable_name'] ]  = $value['content'];
        }

        $approval = RequestApproval::find($rs->approval_id)->first(); //approval records
        //Filters Here
        
        //MAS investors
        $MASinvestors = BuyReport::findMatchedMAS($company_data->company_name);

        //check Panamas, Bahamas, Offshore, Paradise
        $Panama = BuyReport::searchMatchInPanama($company_data->company_name);
        $Paradise = BuyReport::searchMatchInParadise($company_data->company_name);
        $Offshore = BuyReport::searchMatchInOffShore($company_data->company_name);
        $Bahamas = BuyReport::searchMatchInBahamas($company_data->company_name);

        $fileName = $repId.'_IA'.'.pdf';
        $path = public_path('report_downloads/'. $repId.'/'.$fileName);

        $pdf = PDF::loadView('buyreport.ia_PDF',compact('company_data', 'reportTemplates', 'dateDone', 'MASinvestors',
        'Panama', 'Paradise','Offshore', 'Bahamas'))->save($path);
     
       // return File::files($path);

    }

    public static function getAML($rs, $repId)
    {
        $today = strtotime(date("Y-m-d"));
        $company_data = CompanyProfile::find($rs->source_company_id);

        $ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
        $reportTemplates = [];

        $conApproved = ConsultantProjects::where('request_approval_id', $rs->approval_id)->where('project_status', 'DONE')->first();
        $dateConDone = $conApproved->updated_at;	

        $date=date_create($dateConDone);
        $dateDone = date_format($date,"F j, Y"); //, g:i a

        foreach ($ReportGenerationTemplate as $key => $value) {
            $reportTemplates[ $value['variable_name'] ]  = $value['content'];
        }

        $approval = RequestApproval::find($rs->approval_id)->first(); //approval records

        //----Thomson Reuters data------//
        $count_tr = TR_reportgeneration::where('request_id', $approval->req_rep_id)->count(); //count the records
        $tr_peps = array();
        $tr_inserted_date = date("F j, Y", $today);

        $tr_peps_create_date = '';
        $tr_inserted_date = '';
        if($count_tr > 0)
        {
            $rs_tr = TR_reportgeneration::where('request_id', $approval->req_rep_id)->get();
            foreach($rs_tr as $d)
            {
                $tr_peps[] = ThomsonReuters::searchAllThree($d->uid);
                $tr_peps_create_date  = $d->created_at;
            }

            if($tr_peps_create_date != ''){
            $timestamp_tr = strtotime($tr_peps_create_date);
            $tr_inserted_date = date("F j, Y", $timestamp_tr);
            }
        }

        $fileName = $repId.'_AML'.'.pdf';
        $path = public_path('report_downloads/'. $repId.'/'.$fileName);

        $pdf = PDF::loadView('buyreport.aml_PDF', compact('company_data','reportTemplates','dateDone', 'tr_peps', 'tr_inserted_date'))->save($path);
        
       // return File::files($path);
    }

    public static function getCompanyOverview($proc, $user_id, $repId)
    {
        $today = strtotime(date("Y-m-d"));

        $approval = RequestApproval::find($proc->approval_id);

		$request_rec = RequestReport::find($approval->req_rep_id);

		$company_profile = CompanyProfile::find($request_rec->source_company_id);

		$user_id = $company_profile->user_id;

		$company_id_result = $request_rec->company_id; //source_company_id

		//validation for tokensn and approval process

		$request_frequency_id = $proc->request_frequency_id; //one-time, quarterly, bi-annually, annually

		//check if its approved

		$reqId = $request_rec->id;

		$req = $request_rec;

		if ( $req->count() > 0) {

			if ($req->is_approve == NULL || $req->is_approve == 'no') {

				return redirect('/reports/status')->with('message', 'Request required approval from Consultants.');

				exit;

			}

		} else {

			return redirect('/reports/status')->with('message', 'Request record does not exist.');

			exit;

		}

        GeneratedReport::reportSave($proc->requester_company_id, $proc->source_company_id, $approval->req_rep_id); //log the report generated

		$company_data = CompanyProfile::find($proc->source_company_id);
		$user_data = User::find($user_id); 
		
		$num_of_employee = Configurations::getJsonValue('num_of_employee');
		$estimated_sales = Configurations::getJsonValue('estimated_sales');
		$currency = Configurations::getJsonValue('currency');
		$ownership_status = Configurations::getJsonValue('ownership_status');
		$business_type = Configurations::getJsonValue('business_type');
		$business_industry = Configurations::getJsonValue('business_industry');
		$no_of_staff = Configurations::getJsonValue('no_of_staff');
		$financial_year = Configurations::getJsonValue('financial_year');
		$financial_month = Configurations::getJsonValue('financial_month');
		$countries = Configurations::getJsonValue('countries');
		$year_founded = Configurations::getJsonValue('year_founded');
		$profileAvatar = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.profile'), 1);

		//echo $profileAvatar; exit;

		$profileAwards = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.awards'), 5);
		$profilePurchaseInvoice = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.purchase_invoices'), 5);
		$profileSalesInvoice = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.sales_invoices'), 5);
		$profileCertifications = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.certification'), 5);
		$profileCoverPhoto = UploadImages::getFileNames($user_id, $proc->source_company_id, Config::get('constants.options.banner'), 1);
		$completenessProfile = CompanyProfile::profileCompleteness(array($company_data, $profileAvatar, $profileAwards,
		$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));
		$completenessMessages = CompanyProfile::profileStrengthMessages(array($company_data, $profileAvatar, $profileAwards,
		$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));
		$brand_slogan = CompanyProfile::getBrandSlogan($user_id, $proc->source_company_id);
		$urlFB = url('/company') . '/' . $brand_slogan[0] . '/' . time();

		//$keyPersons = KeyManagement::where('user_id', $user_id)->where('status', 1)->get();
		$keyPersons = KeyManagement::where('company_id', $proc->source_company_id)->where('user_id', $user_id)->where('status', 1)->get();
		$consultantFiles = ProcessedReport::getFileUploadsForReportGeneration($proc->approval_id);

		//--Financial Analysis---
		$fa_count = FA_Results::where('company_id', $proc->source_company_id)->count();
		//echo $fa_count . ' ' . $proc->source_company_id;
		//exit;
		$arrMonths = array(1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'May', 6=>'Jun', 7=>'Jul', 8=>'Aug', 9=>'Sep', 10=>'Oct', 11=>'11', 12=>'Dec');
		$MONTH_RATIO = [];
		$RT = [];
		$ACP = [];
		$IT = [];
		$DII = [];
		$PT = [];
		$APP = [];
		$NWP = [];
		$CR = [];
		$QR = [];
		$DTE = [];
		$DTA = [];
		$IC = [];
		$GPM = [];
		$OPM = [];
		$NPM = [];
		$ROI = [];
		$ROE = [];

		if($fa_count > 0){
			$rs = FA_Results::where('company_id', $proc->source_company_id)->get();
			foreach($rs as $t){
				$MONTH_RATIO[] = $arrMonths[$t->month_param] . '/' .$t->year_param;
			}	

			foreach($rs as $t){

				$RT[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->receivable_turnover;
				$ACP[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->average_collection_period;
				$IT[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->inventory_turnover;
				$DII[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->days_in_inventory;
				$PT[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->payable_turnover;
				$APP[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->average_payment_period;
				$NWP[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->net_working_capital;
				$CR[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->current_ratio;
				$QR[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->quick_ratio;
				$DTE[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->debt_to_equity;
				$DTA[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->debt_to_asset;
				$IC[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->interest_coverage;
				$GPM[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->gross_profit_margin;
				$OPM[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->operating_profit_margin;
				$NPM[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->net_profit_margin;
				$ROI[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->return_of_investment;
				$ROE[$arrMonths[$t->month_param] . '/'.$t->year_param] = $t->return_of_equity;

			}
	       }


		//----Thomson Reuters data------//
		$count_tr = TR_reportgeneration::where('request_id', $approval->req_rep_id)->count(); //count the records
		$tr_peps = array();
		$tr_inserted_date = date("F j, Y", $today);

		$tr_peps_create_date = '';
		$tr_inserted_date = '';
		if($count_tr > 0)
		{
			$rs_tr = TR_reportgeneration::where('request_id', $approval->req_rep_id)->get();
			foreach($rs_tr as $d)
			{
				$tr_peps[] = ThomsonReuters::searchAllThree($d->uid);
				$tr_peps_create_date  = $d->created_at;
			}

			if($tr_peps_create_date != ''){
			 $timestamp_tr = strtotime($tr_peps_create_date);
			 $tr_inserted_date = date("F j, Y", $timestamp_tr);
			}
		}

		$ReportGenerationTemplate = ReportGenerationTemplate::where('status', 1)->get();
		$reportTemplates = [];

		foreach ($ReportGenerationTemplate as $key => $value) {
			$reportTemplates[ $value['variable_name'] ]  = $value['content'];
		}

		$reportTrackNumber = "--";
		if(isset($_GET['aprvl']) ){
			$aproval_id=$_GET['aprvl'];
	        $rc = ProcessedReport::getReqRepId($aproval_id);
	        if($rc != false){
	           $reportTrackNumber = $rc->id."-".$rc->source_company_id."-".$rc->fk_opportunity_id."-".date("Y");
	        }
    	}
		$twitter_token = env('APP_ENV');
		$twitter_keyword = urlencode($company_data->company_name);

	
		$originalDate = $company_data->updated_at;
        $obtainDate = date("F, Y", strtotime($originalDate));	
        
        $fileName = $repId.'_CompanyOverView'.'.pdf';
        $path = public_path('report_downloads/'. $repId.'/'.$fileName);

		$pdf = PDF::loadView('buyreport.myPDF', compact('num_of_employee', 'estimated_sales', 'year_founded', 'currency', 'ownership_status',

			'business_type', 'business_industry', 'no_of_staff', 'financial_year', 'financial_month', 'countries',

			'company_data', 'profileAvatar', 'profileAwards', 'profilePurchaseInvoice', 'profileSalesInvoice',

			'profileCertifications', 'completenessProfile', 'profileCoverPhoto', 'completenessMessages', 'brand_slogan', 'urlFB', 'keyPersons', 'reportTemplates', 'reportTrackNumber', 
			
			'tr_peps', 'tr_inserted_date', 'MONTH_RATIO', 'RT', 'ACP', 'IT', 'DII', 'PT', 'APP', 'NWP', 'CR', 'QR', 'DTE', 'DTA', 'IC','GPM','OPM', 'NPM',

            'ROI', 'ROE', 'consultantFiles', 'obtainDate'))->save($path);
            
      //  return File::files($path);

    }


    public static function curlER($twitter_token, $twitter_keyword, $sm='Twitter')
	{
		$cSession = curl_init(); 
		$apiURL = 'https://reputation.app-prokakis.com/api/v1/mentions-tosearch?_token='.$twitter_token.'&selected_sm='.urlencode($sm).'&search_keyword_selections='.urlencode($twitter_keyword);
		//echo $apiURL .'<br />'; 
		curl_setopt($cSession,CURLOPT_URL, $apiURL);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		$response_twitter = json_decode($result);
		curl_close($cSession);
		return $response_twitter;
	}
    
    public static function curlER_ADM($searchKey, $socialMedia, $urlToken){
         
      //$urlToken  = ProkakisAccessToken::getSCode();
      $rURL = 'https://reputation.app-prokakis.com/api/v1/adverse-media/'.$searchKey.'/'.$socialMedia.'/'.$urlToken;
      $client = new Client();
      $rsToken = $client->get($rURL);
      $result = $rsToken->getBody()->getContents();  
      $rs = json_decode($result, true); 

      return $rs;
    }



}

