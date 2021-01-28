<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Log;

use App\InvestorAlert;

use App\Mas;



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


    public function panama()
    {
      ini_set('memory_limit', '512M');
      $panamaData = [];
      $x=0;
      $file = fopen("AML/Panama/panama_papers.nodes.entity.csv", "r") or die(" Panama file is not there! \n");
      while(! feof($file))
      {
        $x++;
        $data = fgetcsv($file);
        if($data[0] != 'node_id'){
    
        $panamaData[] = array('id'=>$data[0], 'Name'=>$data[1], 'Country'=>$data[5], 'IncorporationDate'=>$data[6], 'Jurisdiction'=>$data[3]);
        }

        if($x == 50000){
          break;
        }
      }
      fclose($file);
      return view('alertedrecords.panama', compact('panamaData'));

    }
    
    public function bahamas()
    {
      ini_set('memory_limit', '512M');
      $bahamasData = [];
      $x = 0;
      $file1 = fopen("AML/Bahamas/bahamas_leaks.nodes.entity.csv", "r") or die(" Bahamas file is not there! \n");
      while(! feof($file1))
      {
        $x++;
        $data = fgetcsv($file1);
        if($data[0] != 'node_id'){
        
          $bahamasData[] = array('id'=>$data[0], 'Name'=>$data[1], 'IncorporationDate'=>$data[4], 'Jurisdiction'=>$data[2]);

        }
        if($x == 50000){
          break;
        }
        
      }
      fclose($file1);
      return view('alertedrecords.bahamas', compact('bahamasData'));

    }

    public function offshore()
    {
      ini_set('memory_limit', '512M');
      $offshoreData = [];
      $x=0;
      $file3 = fopen("AML/Offshore/offshore_leaks.nodes.entity.csv", "r") or die(" Offshore file is not there! \n");
      while(! feof($file3))
      { 
        $x++;
        $data = fgetcsv($file3);
        if($data[0] != 'node_id'){
        $offshoreData[] = array('id'=>$data[0],'Name'=>$data[1], 'Country'=>$data[5], 'IncorporationDate'=>$data[6], 'Jurisdiction'=>$data[3]);
        }
        if($x == 50000){
          break;
        }
      }
      fclose($file3);
      return view('alertedrecords.offshore', compact('offshoreData'));
    }

    public function paradise()
    {
      ini_set('memory_limit', '512M');
      $paradiseData = [];
      $x=0;
      $file2 = fopen("AML/Paradise/paradise_papers.nodes.entity.csv", "r") or die(" Paradise file is not there! \n");
      while(! feof($file2))
      {
        $x++;
        $data = fgetcsv($file2);
        if($data[0] != 'node_id'){
        $paradiseData[] = array('id'=>$data[0], 'Name'=>$data[1], 'Country'=>$data[5], 'IncorporationDate'=>$data[6], 'Jurisdiction'=>$data[3]);
        }
        if($x == 50000){
          break;
        }
      
      }
      fclose($file2);
      return view('alertedrecords.paradise', compact('paradiseData'));
    }




}

