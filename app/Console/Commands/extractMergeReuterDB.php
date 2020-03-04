<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class extractMergeReuterDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extracReuterDB:prokakis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To extract and merge database data from reuters to Prokakis main database';

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
        
        $this->forCSV();
     
        echo "Extract reuters Database and merge to Prokakis \n";
        
        echo "Done ..."."\n";
    }

    public function forCSV()
    {

        $file = fopen("reuters-db/premium-world-check-day-July10-fixed.csv","r") or die('file is not there!');
        $x = 1;
        while(! feof($file))
        {
         $data = fgetcsv($file);
        
            if($x > 1){
                
                if($data[0] != null || trim($data[0]) != '')
                {

                $ok = DB::table('reuters_databank2')
                ->updateOrInsert(
                        [
                            'UID' => $data[0]
                        ],                   
                        [
                        'LAST_NAME' => (isset($data[1]))? $data[1] : '',                   
                        'FIRST_NAME' => (isset($data[2]))? $data[2] : '',                   
                        'ALIASES' => (isset($data[3]))? $data[3] : '',                   
                        'LOW_QUALITY_ALIASES' => (isset($data[4]))? $data[4] : '',                   
                        'ALTERNATIVE_SPELLING' => (isset($data[5]))? $data[5] : '',                   
                        'CATEGORY' => (isset($data[6]))? $data[6] : '',                   
                        'TITLE' => (isset($data[7]))? $data[7] : '',                   
                        'SUB_CATEGORY' => (isset($data[8]))? $data[8] : '',                   
                        'POSITION' => (isset($data[9]))? $data[9] : '',                   
                        'AGE' => (isset($data[10]))? $data[10] : '',                    
                        'DOB' => (isset($data[11]))? $data[11] : '', 
                        'PLACE_OF_BIRTH' => (isset($data[12]))? $data[12] : '',                   
                        'DECEASED' => (isset($data[13]))? $data[13] : '',                     
                        'PASSPORTS' => (isset($data[14]))? $data[14] : '',
                        'SSN' => (isset($data[15]))? $data[15] : '',  
                        'LOCATIONS' => (isset($data[16]))? $data[16] : '',                  
                        'COUNTRIES' => (isset($data[17]))? $data[17] : '',
                        'CITIZENSHIP' => (isset($data[18]))? $data[18] : '',
                        'COMPANIES' => (isset($data[19]))? $data[19] : '',                 
                        'E_I' => (isset($data[20]))? $data[20] : '',                         
                        'LINKED_TO' => (isset($data[21]))? $data[21] : '',                   
                        'FURTHER_INFORMATION' => (isset($data[22]))? $data[22] : '',                    
                        'KEYWORDS' => (isset($data[23]))? $data[23] : '',                               
                        'EXTERNAL_SOURCES' => (isset($data[24]))? $data[24] : '', 
                        'UPDATE_CATEGORY' => (isset($data[25]))? $data[25]: '', 
                        'ENTERED' => (isset($data[26]))? $data[26] : '',                               
                        'UPDATED' => (isset($data[27]))? $data[27] : '',                               
                        'EDITOR' => (isset($data[28]))? $data[28] : '',                   
                        'AGE_DATE' => (isset($data[29]))? $data[29] : '',
                        'PEP_ROLES' => (isset($data[30]))? $data[30] : '',
                        'PEP_STATUS' => (isset($data[31]))? $data[31] : '',
                        'CREATED_AT' => date('Y-m-d')
                        ]
                ); 
                /*
                $ok = DB::table('reuters_databank2')->insert(
                        [
                        'UID' => $data[0],
                        'LAST_NAME' => (isset($data[1]))? $data[1] : '',                   
                        'FIRST_NAME' => (isset($data[2]))? $data[2] : '',                   
                        'ALIASES' => (isset($data[3]))? $data[3] : '',                   
                        'LOW_QUALITY_ALIASES' => (isset($data[4]))? $data[4] : '',                   
                        'ALTERNATIVE_SPELLING' => (isset($data[5]))? $data[5] : '',                   
                        'CATEGORY' => (isset($data[6]))? $data[6] : '',                   
                        'TITLE' => (isset($data[7]))? $data[7] : '',                   
                        'SUB_CATEGORY' => (isset($data[8]))? $data[8] : '',                   
                        'POSITION' => (isset($data[9]))? $data[9] : '',                   
                        'AGE' => (isset($data[10]))? $data[10] : '',                    
                        'DOB' => (isset($data[11]))? $data[11] : '', 
                        'PLACE_OF_BIRTH' => (isset($data[12]))? $data[12] : '',                   
                        'DECEASED' => (isset($data[13]))? $data[13] : '',                     
                        'PASSPORTS' => (isset($data[14]))? $data[14] : '',
                        'SSN' => (isset($data[15]))? $data[15] : '',  
                        'LOCATIONS' => (isset($data[16]))? $data[16] : '',                  
                        'COUNTRIES' => (isset($data[17]))? $data[17] : '',
                        'CITIZENSHIP' => (isset($data[18]))? $data[18] : '',
                        'COMPANIES' => (isset($data[19]))? $data[19] : '',                 
                        'E_I' => (isset($data[20]))? $data[20] : '',                         
                        'LINKED_TO' => (isset($data[21]))? $data[21] : '',                   
                        'FURTHER_INFORMATION' => (isset($data[22]))? $data[22] : '',                    
                        'KEYWORDS' => (isset($data[23]))? $data[23] : '',                               
                        'EXTERNAL_SOURCES' => (isset($data[24]))? $data[24] : '', 
                        'UPDATE_CATEGORY' => (isset($data[25]))? $data[25]: '', 
                        'ENTERED' => (isset($data[26]))? $data[26] : '',                               
                        'UPDATED' => (isset($data[27]))? $data[27] : '',                               
                        'EDITOR' => (isset($data[28]))? $data[28] : '',                   
                        'AGE_DATE' => (isset($data[29]))? $data[29] : '',
                        'PEP_ROLES' => (isset($data[30]))? $data[30] : '',
                        'PEP_STATUS' => (isset($data[31]))? $data[31] : '',
                        'CREATED_AT' => date('Y-m-d')
                        ]
                );
                */
                if($ok){
                    echo 'Done saving :'.$data[0]."\n"; 
                }
            }

        }


        $x++;

        }

        fclose($file);
    }
}
