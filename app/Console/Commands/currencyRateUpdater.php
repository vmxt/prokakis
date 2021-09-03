<?php

namespace App\Console\Commands;

use App\CompanyProfile;
use Illuminate\Console\Command;

use DB;
use App\CurrencyMonetary; 


class currencyRateUpdater extends Command
{

    protected $signature = 'currencyRateUpdater:prokakis';


     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To update on a daily basis the rate of mmonitary currency';

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
        
    try {
        $rURL = "https://eservices.mas.gov.sg/api/action/datastore/search.json?resource_id=95932927-c8bc-4e7a-b484-68a66a24edfe&limit=1&sort=end_of_day%20desc";

        $cSession = curl_init(); 
        curl_setopt($cSession,CURLOPT_URL,$rURL);
        curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($cSession,CURLOPT_HEADER, false); 
        $result=curl_exec($cSession);
        $response = json_decode($result);
        curl_close($cSession);
        $records = $response->result->records;
        foreach($records as $data ){
            $dataArr = (array)$data;
            $dataArrKey = array_keys($dataArr);
            // $dataArrKey2 = key($dataArr[]);
            foreach($dataArrKey as $res){

                if(isset($dataArr[$res]) and ( $res != 'preliminary' && $res != 'timestamp' ) ){
                    // echo $res."\n";
                    $currency = CurrencyMonetary::where('c_name',trim($res))->first();
                    if($currency){
                        $currency->end_of_day = $dataArr['end_of_day'] ;
                        $currency->c_rate = $dataArr[$res];
                        $currency->save();
                    }
                }
                // echo $res."==".$dataArr[$res]."\n";
            }
            // print_r($dataArr);
        }
    } catch (\GuzzleHttp\Exception\RequestException $ex) {
         print_r($ex->getResponse()->getBody()->getContents()); 
         // you can even json_decode the response like json_decode($ex->getResponse()->getBody()->getContents(), true)    
    }

        // try {
        //     $rURL = "https://eservices.mas.gov.sg/api/action/datastore/search.json?resource_id=95932927-c8bc-4e7a-b484-68a66a24edfe&limit=3&sort=end_of_day%20desc";
        //     $client = new Client();
        //     $response = $client->get($rURL);
        //     return json_decode($response->getBody()->getContents(), true);
        // } catch (Exception $e) {
        //     return $e->getMessage();
        // }

            // $rURL = "https://eservices.mas.gov.sg/api/action/datastore/search.json?resource_id=95932927-c8bc-4e7a-b484-68a66a24edfe&limit=3&sort=end_of_day%20desc";
            // $client = new Client();
            // $rsToken = $client->get($rURL);
            // $result = $rsToken->getBody()->getContents();  
            // $output = json_decode($result, true);


            // print_r($output);

      //   //gather all 
      // $as =  ProcessedReport::activeSubscriptionsCompanyName();
     
      // if(sizeof($as) > 0){

      //   foreach($as as $b)
      //   { 
      //   $companyNames = $b['provider_company_name']; 
      //   $emailAdd = $b['requester_company_email'];  

      //       //check Panamas, Bahamas, Offshore, Paradise
      //       //$Panama = BuyReport::searchMatchInPanama($companyNames);
      //       $rURL = "https://reputation.app-prokakis.com/api/v1/panamagroup/".$companyNames."/panama/".$this->urlToken;
	     //   	$client = new Client();
	     //   	$rsToken = $client->get($rURL);
	     //   	$result = $rsToken->getBody()->getContents();  
      //  		$Panama = json_decode($result, true);
      //       if($Panama != 0){
      //         echo 'Panama';  
      //         AlertBindReport::sendNotification($emailAdd, 'Panama');   
      //       }
      //       echo "\n";
      //       $rURL = "https://reputation.app-prokakis.com/api/v1/panamagroup/".$companyNames."/paradise/".$this->urlToken;
      //       $client = new Client();
      //       $rsToken = $client->get($rURL);
      //       $result = $rsToken->getBody()->getContents();  
      //       $Paradise = json_decode($result, true);
      //       // $Paradise = BuyReport::searchMatchInParadise($companyNames);
      //       if($Paradise != 0){
      //         echo 'Paradise';  
      //         AlertBindReport::sendNotification($emailAdd, 'Paradise'); 
      //       }
      //       echo "\n";
      //       // $Offshore = BuyReport::searchMatchInOffShore($companyNames);
      //       $rURL = "https://reputation.app-prokakis.com/api/v1/panamagroup/".$companyNames."/paradise/".$this->urlToken;
      //       $client = new Client();
      //       $rsToken = $client->get($rURL);
      //       $result = $rsToken->getBody()->getContents();  
      //       $Offshore = json_decode($result, true);
      //       if($Offshore != 0){
      //         echo 'Offshore';  
      //         AlertBindReport::sendNotification($emailAdd, 'Offshore');    
      //       }
      //       echo "\n";
      //       $rURL = "https://reputation.app-prokakis.com/api/v1/panamagroup/".$companyNames."/bahamas/".$this->urlToken;
      //       $client = new Client();
      //       $rsToken = $client->get($rURL);
      //       $result = $rsToken->getBody()->getContents();  
      //       $Bahamas = json_decode($result, true);
      //       $Bahamas = BuyReport::searchMatchInBahamas($companyNames);
      //       if($Bahamas != 0){
      //         echo 'Bahamas';  
      //         AlertBindReport::sendNotification($emailAdd, 'Bahamas');   
      //       }  
      //       echo "\n";
      //           $searchParam .= "&company_name=".$companyNames;   

      //       $rURL = "https://reputation.app-prokakis.com/public/api/v1/thomson/company?pauth=".$this->urlToken.$searchParam;
      //       $client = new Client();
      //       $rsToken = $client->get($rURL);
      //       $result = $rsToken->getBody()->getContents();  
      //       $tr = json_decode($result, true);

      //       // $tr = ThomsonReuters::getMatched_Companies($companyNames);
      //       if($tr !== 0){
      //           echo 'Refinitive';
      //           TR_reportgeneration::create([
      //               'uid' => trim($tr->UID), 
      //               'request_id' => $b['request_report_id'], 
      //               'company_req_id' => $b['requester_company_id'], 
      //               'company_prov_id' => $b['provider_company_id'], 
      //               'created_at' => date('Y-m-d'), 
      //               'status'  => 1,
      //               'added_by' => 1,
      //           ]);

      //         AlertBindReport::sendNotification($emailAdd, 'Refinitive');  
      //       }
      //       echo "\n";
      //        //MAS investors
      //        $MASinvestors = BuyReport::findMatchedMAS($companyNames);
      //        if($MASinvestors != 0){
      //            echo 'MAS';
      //         AlertBindReport::sendNotification($emailAdd, 'MAS');      
      //        }
      //   }  

      
    
      //echo "Sending of email notification finished.. \n";
      echo "Done ..."."\n";
    }


}

