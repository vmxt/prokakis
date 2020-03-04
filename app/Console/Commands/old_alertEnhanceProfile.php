<?php

namespace App\Console\Commands;

use App\CompanyProfile;
use Illuminate\Console\Command;

use App\Mailbox; 
use App\UploadImages;
use App\User;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use App\Unsubscribe;
use Config;

class oldAlertEnhanceProfile extends Command
{

    protected $signature = 'alertEnhanceProfile:prokakis';


     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To alert companies with profile completeness less than 50 percents';

     /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo "Start ..."."\n";
        
        $data = file_get_contents("http://ebos2.prokakis.com/public/emailtemplate/ProkakisEnhanceProfile.html");
        $allc = CompanyProfile::all();

        foreach($allc as $d)
        {
          if($this->getUnsubscribeList($d) == false){
            
            $res = $this->getStarRank($d);
          
            if($res < 51){ //send an email
          
              $rs_usr =  User::find($d->user_id);
              $email_address = $rs_usr->email;
              $company_name = (trim($d->registered_company_name) != '' || $d->registered_company_name != NULL)? $d->registered_company_name : $d->company_name;
              $data = str_replace("[First Name]", $rs_usr->firstname, $data);
              $data = str_replace("[Company Name]", $company_name, $data);

              $en_company_id = base64_encode($d->id);
              $en_user_id = base64_encode($d->user_id);
              $en_notify_type = base64_encode('enhancedprofile');
              $en_notify_date = base64_encode(date('Y-m-d'));
              $token = $en_company_id.'-ebos-'.$en_user_id.'-ebos-'. $en_notify_type.'-ebos-'.$en_notify_date;
              $url_token = url('/unsubscribeMe/'.$token); 
              $data = str_replace("[UNSUBSCRIBE LINK]", $url_token, $data);
              
              $this->alertNotify($data, $email_address, 'Enahance Company Profile, Prokakis');  

            } elseif($res > 50) {


               $rsBuild = OpportunityBuildingCapability::where('company_id', $d->id)->get();
               $rsBuy = OpportunityBuy::where('company_id', $d->id)->get();
               $rsSellOffer = OpportunitySellOffer::where('company_id', $d->id)->get();


                if( count($rsBuild) == 0 &&  count($rsBuy) == 0  && count($rsSellOffer) == 0 ){

                    $rs_usr =  User::find($d->user_id);
                    $email_address = $rs_usr->email;
                    $company_name = (trim($d->registered_company_name) != '' || $d->registered_company_name != NULL)? $d->registered_company_name : $d->company_name;
                        
                    $dataOpp = file_get_contents("http://ebos2.prokakis.com/public/emailtemplate/ProkakisAddOpportunity.html");   
                    $dataOpp = str_replace("[First Name]", $rs_usr->firstname, $dataOpp);
                    $dataOpp = str_replace("[Company Name]", $company_name, $dataOpp);

                    $en_company_id = base64_encode($d->id);
                    $en_user_id = base64_encode($d->user_id);
                    $en_notify_type = base64_encode('addopportunity');
                    $en_notify_date = base64_encode(date('Y-m-d'));
                    $token = $en_company_id.'-ebos-'.$en_user_id.'-ebos-'. $en_notify_type.'-ebos-'.$en_notify_date;
                    $url_token = url('/unsubscribeMe/'.$token); 
                    $dataOpp = str_replace("[UNSUBSCRIBE LINK]", $url_token, $dataOpp);
                    
                    $this->alertNotify($dataOpp, $email_address, 'Add Opportunity, Prokakis');  
                }
                    
            }
          }

        }

        echo "Done ..."."\n";
    }

    //true means the user unsubscribe
    function getUnsubscribeList($d){
        
       $res = Unsubscribe::where('company_id', $d->company_id)->where('user_id', $d->user_id)->get();
       if(count($res) > 0){
        return true;
       } else {
        return false; 
       }
         
    }

    function getStarRank($company)
    {
      
        $profileAvatar = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.profile'), 1);
        $profileAwards = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.awards'), 5);
        $profilePurchaseInvoice = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.purchase_invoices'), 5);
        $profileSalesInvoice = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.sales_invoices'), 5);
        $profileCertifications = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.certification'), 5);

        $ratingScore = CompanyProfile::profileCompleteness(array($company, $profileAvatar, $profileAwards,
            $profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));
         
        return $ratingScore;    
       
    }


    public function alertNotify($message, $email, $messageTitle)
    {
        echo $email . "\n";
        //send the email here  
       // Mailbox::sendMail_EmailTemplate($message, $email, $messageTitle, ""); 
    }

    public function getDaysDiff($fromDate, $curDate)
    {
        $daysLeft = 0;
        $daysLeft = abs(strtotime($curDate) - strtotime($fromDate));
        $days = $daysLeft/(60 * 60 * 24);
        return $days;

        //printf("Days difference between %s and %s = %d", $fromDate, $curDate, $days);
    }

}

