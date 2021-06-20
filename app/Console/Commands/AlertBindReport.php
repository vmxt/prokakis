<?php

namespace App\Console\Commands;

use App\CompanyProfile;
use Illuminate\Console\Command;

use DB;
use App\Mailbox; 
use App\RequestReport;
use App\ThomsonReuters;
use App\TR_reportgeneration;
use App\BuyReport;
use App\ProcessedReport;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;

class AlertBindReport extends Command
{

    protected $signature = 'alertBindReport:prokakis';


     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To alert report subscriber via email notification regarding matched of records from refinitive data with the report provider';

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
        
        //code here
        //gather all 
      $as =  ProcessedReport::activeSubscriptionsCompanyName();
     
      if(sizeof($as) > 0){

        foreach($as as $b)
        { 
        $companyNames = $b['provider_company_name']; 
        $emailAdd = $b['requester_company_email'];  

            //check Panamas, Bahamas, Offshore, Paradise
            //$Panama = BuyReport::searchMatchInPanama($companyNames);
            $rURL = "https://reputation.app-prokakis.com/api/v1/panamagroup/".$companyNames."/panama/".$this->urlToken;
	       	$client = new Client();
	       	$rsToken = $client->get($rURL);
	       	$result = $rsToken->getBody()->getContents();  
       		$Panama = json_decode($result, true);
            if($Panama != 0){
              echo 'Panama';  
              AlertBindReport::sendNotification($emailAdd, 'Panama');   
            }
            echo "\n";
            $rURL = "https://reputation.app-prokakis.com/api/v1/panamagroup/".$companyNames."/paradise/".$this->urlToken;
            $client = new Client();
            $rsToken = $client->get($rURL);
            $result = $rsToken->getBody()->getContents();  
            $Paradise = json_decode($result, true);
            // $Paradise = BuyReport::searchMatchInParadise($companyNames);
            if($Paradise != 0){
              echo 'Paradise';  
              AlertBindReport::sendNotification($emailAdd, 'Paradise'); 
            }
            echo "\n";
            // $Offshore = BuyReport::searchMatchInOffShore($companyNames);
            $rURL = "https://reputation.app-prokakis.com/api/v1/panamagroup/".$companyNames."/paradise/".$this->urlToken;
            $client = new Client();
            $rsToken = $client->get($rURL);
            $result = $rsToken->getBody()->getContents();  
            $Offshore = json_decode($result, true);
            if($Offshore != 0){
              echo 'Offshore';  
              AlertBindReport::sendNotification($emailAdd, 'Offshore');    
            }
            echo "\n";
            $rURL = "https://reputation.app-prokakis.com/api/v1/panamagroup/".$companyNames."/bahamas/".$this->urlToken;
            $client = new Client();
            $rsToken = $client->get($rURL);
            $result = $rsToken->getBody()->getContents();  
            $Bahamas = json_decode($result, true);
            $Bahamas = BuyReport::searchMatchInBahamas($companyNames);
            if($Bahamas != 0){
              echo 'Bahamas';  
              AlertBindReport::sendNotification($emailAdd, 'Bahamas');   
            }  
            echo "\n";
                $searchParam .= "&company_name=".$companyNames;   

            $rURL = "https://reputation.app-prokakis.com/public/api/v1/thomson/company?pauth=".$this->urlToken.$searchParam;
            $client = new Client();
            $rsToken = $client->get($rURL);
            $result = $rsToken->getBody()->getContents();  
            $tr = json_decode($result, true);

            // $tr = ThomsonReuters::getMatched_Companies($companyNames);
            if($tr !== 0){
                echo 'Refinitive';
                TR_reportgeneration::create([
                    'uid' => trim($tr->UID), 
                    'request_id' => $b['request_report_id'], 
                    'company_req_id' => $b['requester_company_id'], 
                    'company_prov_id' => $b['provider_company_id'], 
                    'created_at' => date('Y-m-d'), 
                    'status'  => 1,
                    'added_by' => 1,
                ]);

              AlertBindReport::sendNotification($emailAdd, 'Refinitive');  
            }
            echo "\n";
             //MAS investors
             $MASinvestors = BuyReport::findMatchedMAS($companyNames);
             if($MASinvestors != 0){
                 echo 'MAS';
              AlertBindReport::sendNotification($emailAdd, 'MAS');      
             }
        }  

      }
    
      //echo "Sending of email notification finished.. \n";
      echo "Done ..."."\n";
    }


  
    public static function sendNotification($emailAdd, $sourceFile)
    {
        $message = "
        Hi Prokakis Member, <br /><br />


        We have found a possible match of a company from our ".$sourceFile." list as daily updates.  <br />
        This result has a link to your active report subscription. <br /><br />
        
        Please downlaod the report to check these results. <br />
        
        <br /><br />
        
        Thank you. <br />
        
        Prokakis Web Admin
        ";
        //send the email here  
        Mailbox::sendMail_v2($message, $emailAdd, "Possible match of a company link to you report subscription.", ""); 
    }

}

