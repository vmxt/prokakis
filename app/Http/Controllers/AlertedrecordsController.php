<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;

use App\InvestorAlert;

use App\Mas;

use App\ProkakisAccessToken;
use GuzzleHttp\Client;




//use Illuminate\Support\Facades\Http;



class AlertedrecordsController extends Controller

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

      $numRows = 5000;

      //$response = Http::get('https://www.mas.gov.sg/api/v1/ialsearch?json.nl=map&wt=json&fq=&q=*:*&sort=date_dt+desc&rows=541&start=0');

      $ch = curl_init();

      // Will return the response, if false it print the response

      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // Set the url

      curl_setopt($ch, CURLOPT_URL,'https://www.mas.gov.sg/api/v1/ialsearch?json.nl=map&wt=json&fq=&q=*:*&sort=date_dt+desc&rows='.$numRows.'&start=0');

      // Execute

      $result=curl_exec($ch);

      // Closing

      curl_close($ch);



      // Will dump a beauty json :3

      $res = (json_decode($result, true));

      $data_ia = array();



      foreach($res['response']['docs'] as $d)

      {

         $ob = new Mas();

         $ob->id = $d['id'];

         $ob->address_s = $d['address_s'];

         $ob->website_s = $d['website_s'];

         $ob->phonenumber_s = $d['phonenumber_s'];

         $ob->unregulatedpersons_t = $d['unregulatedpersons_t'];



        $data_ia[] = $ob;

      }

       //$data_ia = InvestorAlert::orderBy('unregulatedpersons_t', 'ASC')->get();

       //var_dump($data_ia);

       //exit;



        return view('alertedrecords.index', compact('data_ia'));

    }


    public function highRisk(Request $request)
    {
      $panamaData = [];
      $urlToken  = ProkakisAccessToken::getSCode();
      
      $type = $request["type"];
      
      $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup-all/'.$type.'/'.$urlToken;

      //echo $rURL;
      //exit;
       
      $client = new Client();
      $rsToken = $client->get($rURL);
      $result = $rsToken->getBody()->getContents();  
      $rs = json_decode($result, true);
    
      $count = 0;
      foreach($rs['RecordSet'] as $data)
      {
        $count++;
        if($data[0] != 'node_id'){
        //if($count <= 15 ){
         $panamaData[] = array('id'=>$data[0], 'Name'=>$data[1], 'Country'=>$data[5], 'IncorporationDate'=>$data[6], 'Jurisdiction'=>$data[3]);
        //}
        }

      }
 
      return view('alertedrecords.highrisk', compact('panamaData', 'rURL', 'type'));

    }

   public function panama()
    {
      $panamaData = [];
      $urlToken  = ProkakisAccessToken::getSCode();
      $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup-all/panama/'.$urlToken;

      //echo $rURL;
      //exit;
       
      $client = new Client();
      $rsToken = $client->get($rURL);
      $result = $rsToken->getBody()->getContents();  
      $rs = json_decode($result, true);
    
      foreach($rs['RecordSet'] as $data)
      {
   
        if($data[0] != 'node_id'){
         $panamaData[] = array('id'=>$data[0], 'Name'=>$data[1], 'Country'=>$data[5], 'IncorporationDate'=>$data[6], 'Jurisdiction'=>$data[3]);
        }

      }
 
      return view('alertedrecords.panama', compact('panamaData'));

    }
    
    public function bahamas()
    {

      $urlToken  = ProkakisAccessToken::getSCode();
      $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup-all/bahamas/'.$urlToken;
       
       $client = new Client();
       $rsToken = $client->get($rURL);
       $result = $rsToken->getBody()->getContents();  
       $rs = json_decode($result, true);
       $bahamasData = [];

      foreach($rs['RecordSet'] as $data)
      {
      
        if($data[0] != 'node_id'){
          $bahamasData[] = array('id'=>$data[0], 'Name'=>$data[1], 'IncorporationDate'=>$data[4], 'Jurisdiction'=>$data[2]);
        }
    
      }
     
      return view('alertedrecords.bahamas', compact('bahamasData'));

    }

    public function offshore()
    {
      $offshoreData = [];
  
      $urlToken  = ProkakisAccessToken::getSCode();
      $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup-all/offshore/'.$urlToken;
       
      $client = new Client();
      $rsToken = $client->get($rURL);
      $result = $rsToken->getBody()->getContents();  
      $rs = json_decode($result, true);
     
      foreach($rs['RecordSet'] as $data)
      { 
     
      
        if($data[0] != 'node_id'){
          $offshoreData[] = array('id'=>$data[0],'Name'=>$data[1], 'Country'=>$data[5], 'IncorporationDate'=>$data[6], 'Jurisdiction'=>$data[3]);
        }
      
      }
   
      return view('alertedrecords.offshore', compact('offshoreData'));
    }

    public function paradise()
    {
      $paradiseData = [];
  
      $urlToken  = ProkakisAccessToken::getSCode();
      $rURL = 'https://reputation.app-prokakis.com/api/v1/panamagroup-all/paradise/'.$urlToken;
       
      $client = new Client();
      $rsToken = $client->get($rURL);
      $result = $rsToken->getBody()->getContents();  
      $rs = json_decode($result, true);

      foreach($rs['RecordSet'] as $data)
      {
    
        if($data[0] != 'node_id'){
         $paradiseData[] = array('id'=>$data[0], 'Name'=>$data[1], 'Country'=>$data[5], 'IncorporationDate'=>$data[6], 'Jurisdiction'=>$data[3]);
        }
      
      
      }
      return view('alertedrecords.paradise', compact('paradiseData'));
    }




}

