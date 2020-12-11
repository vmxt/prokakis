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



}

