<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

Use Exception;
class fetchThomsonReutersData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $signature = 'fetchThomsonReutersData:prokakis';

    /**
     * The console command description.
     *
     * @var string
     */
     protected $description = 'To Download Thomson Reuters Data';

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
        
        $username = 'sgbssg0001';
        $password = 'Francine120306*';
        //$newFilename= 'ReutersData.xml';
        echo "Start ..."."\n";
         $fileUrl = "https://www.world-check.com/premium-dynamic-download/?lag=DAY&format=XML&anykeyword=1&subcategory=PEP%20NG&subcategory=PEP%20NG-A&subcategory=PEP%20NG-R&subcategory=PEP%20IO&subcategory=PEP%20IO-A&subcategory=PEP%20IO-R&subcategory=PEP%20L&subcategory=PEP%20L-A&subcategory=PEP%20L-R&subcategory=PEP%20N&subcategory=PEP%20N-A&subcategory=PEP%20N-R&subcategory=PEP%20RO&subcategory=PEP%20RO-A&subcategory=PEP%20RO-R&subcategory=PEP%20SN&subcategory=PEP%20SN-A&subcategory=PEP%20SN-R&subcategory=SIE&subcategory=SOE&subcategory=&category=BANK&category=CORPORATE&category=COUNTRY&category=CRIME%20-%20FINANCIAL&category=CRIME%20-%20NARCOTICS&category=CRIME%20-%20ORGANIZED&category=CRIME%20-%20OTHER&category=CRIME%20-%20TERROR&category=CRIME%20-%20WAR&category=DIPLOMAT&category=EMBARGO&category=EMBARGO%20VESSEL&category=INDIVIDUAL&category=LEGAL&category=MILITARY&category=NONCONVICTION%20TERROR&category=ORGANISATION&category=POLITICAL%20INDIVIDUAL&category=POLITICAL%20PARTY&category=PORT&category=RELIGION&category=TERRORISM&category=TRADE%20UNION&category=VESSEL"; 

        $saveTo = 'public/TS/reutersData.xml';
        $fp = fopen($saveTo, 'w+');
        if($fp === false){
            throw new Exception('Could not open: ' . $saveTo);
        }
        chmod('public/TS/reutersData.xml', 0777);
        
        $ch = curl_init($fileUrl);
        curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password); 
        curl_setopt($ch, CURLOPT_FILE, $fp);
        //curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_exec($ch);
        if(curl_errno($ch)){
            throw new Exception(curl_error($ch));
        }
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        fclose($fp);
        if($statusCode == 200){
            echo 'Downloaded!';
        } else{
            echo "Status Code: " . $statusCode;
        }


    }
}
