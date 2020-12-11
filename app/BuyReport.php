<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
      $numRows = 100000;
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

            //var_dump($d['unregulatedpersons_t'][0]); exit;

            $findMe = stripos($d['unregulatedpersons_t'][0], $companyName);

            if ($findMe !== false) {
                $data_ia[] = $ob; //found matched
            }

        } //end of for loop
        
        if(sizeof($data_ia) > 0){
            return $data_ia;
        } else {
            return 0; 
        }
    }

   
    
    public static function searchMatchInBahamas($companyName)
    {

        $data_ia = [];

        // $file = fopen("AML/Offshore/bahamas_leaks.nodes.entity.csv", "r") or die(" $entry file is not there! \n");
       
        // while(! feof($file))
        // {
        //         $data = fgetcsv($file);

        //         if(trim($data[1]) != 'name')
        //         { 

        //             $findMe = stripos($data[1], $companyName);

        //             if ($findMe !== false) {
        //                 $data_ia[] = $data; //found matched

        //                 //echo $data[1] . '<br />';
        //             }
        
        //         }
        //  }

         return  $data_ia;
       

    }
    
    public static function searchMatchInOffShore($companyName)
    {
        $data_ia = [];

        // $file = fopen("AML/Offshore/offshore_leaks.nodes.entity.csv", "r") or die(" $entry file is not there! \n");
       
        // while(! feof($file))
        // {
        //         $data = fgetcsv($file);

        //         if(trim($data[1]) != 'name')
        //         { 

        //             $findMe = stripos($data[1], $companyName);

        //             if ($findMe !== false) {
        //                 $data_ia[] = $data; //found matched

        //                 //echo $data[1] . '<br />';
        //             }
        

        //         }
        //  }

         return  $data_ia;
       
    }

    public static function searchMatchInPanama($companyName)
    {
        $data_ia = [];

        // $file = fopen("AML/Panama/panama_papers.nodes.entity.csv", "r") or die(" $entry file is not there! \n");
       
        // while(! feof($file))
        // {
        //         $data = fgetcsv($file);

        //         if(trim($data[1]) != 'name')
        //         { 

        //             $findMe = stripos($data[1], $companyName);

        //             if ($findMe !== false) {
        //                 $data_ia[] = $data; //found matched

        //                 //echo $data[1] . '<br />';
        //             }
        

        //         }
        //  }

         return  $data_ia;
       
    }

    public static function searchMatchInParadise($companyName)
    {

        $data_ia = [];

    //     $file = fopen("AML/Paradise/paradise_papers.nodes.entity.csv", "r") or die(" $entry file is not there! \n");
       
    //     while(! feof($file))
    //     {
    //             $data = fgetcsv($file);

    //             if(trim($data[1]) != 'name')
    //             { 

    //                 $findMe = stripos($data[1], $companyName);

    //                 if ($findMe !== false) {
    //                     $data_ia[] = $data; //found matched

    //                     //echo $data[1] . '<br />';
    //                 }
        

    //             }
    //      }

         return  $data_ia;
       
    }


}
