<?php



namespace App\Console\Commands;



use Illuminate\Console\Command;



use DB;



class thomsonReutersWorldUpdate extends Command

{

    /**

     * The name and signature of the console command.

     *

     * @var string

     */

    protected $signature = 'extractThomsonReutersWorldUpdate:prokakis';



    /**

     * The console command description.

     *

     * @var string

     */

    protected $description = 'To extract and merge database data from thomson reuters to Prokakis main database';



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

        $fileTR_Name = '';



        if ($handle = opendir('reuters-db/')) 

        {



            while (false !== ($entry = readdir($handle))) {

        

                if ($entry != "." && $entry != "..") {

        

                    echo "$entry\n";

                   // $fileTR_Name = $entry;

                   $this->processFiles($entry);
		  unlink('reuters-db/'.$entry);	
		   

                }

            }

        

            closedir($handle);

        }



        echo "End ..."."\n";

    }

    

 



    public function processFiles($fileName)

    {

        $xml = simplexml_load_file("reuters-db/".$fileName) or die("Error: $fileName Cannot create object or XML file not there");   



        $data = array();



        foreach ($xml->children() as $d) 

        {

            //record attribute

            /*echo $d['category'] . '<br />'; //record

            echo $d['entered'] . '<br />'; //record

            echo $d['updatecategory'] . '<br />'; //record

            echo $d['sub-category'] . '<br />'; //record

            echo $d['uid'] . '<br />'; //record

            echo $d['editor'] . '<br />'; //record

            echo $d['updated'] . '<br />'; //record

            echo '<br /><br />'; */



            /*	for the ie attribute

                foreach ($d->person as $i) {

                echo $i['e-i'] . '<br />';

            */



            //to get the lastname

            /*

                foreach ($d->children() as $t) {

                echo $t->names->last_name . '<br />';

                }

            */



            // to get the Aliases

            $aliases_str = "";

            foreach ($d->children() as $t) {



                foreach ($t->children() as $p) {



                    if (isset($p->aliases->alias)) {

                        for ($x = 0; $x < sizeof($p->aliases->alias); $x++) {

                            if (isset($p->aliases->alias[$x]) && trim($p->aliases->alias[$x]) != '') {

                                //echo $p->aliases->alias[$x] . '<br />';

                                $aliases_str .=  $p->aliases->alias[$x]. ',';

                            }



                        }

                    }



                }

                //echo '<br />';

            }



            //echo $d->person->names->first_name . ' ' . $d->person->names->last_name . '<br />';

            //echo $d->details->further_information . '<br /><br />'; //further details

            //echo $d->details->passports->passport['country'] . '<br />'; //passport country

            //echo $d->details->place_of_birth . '<br />'; //place of birth



            //echo $d->person->names->low_quality_aliases->alias . '<br />';

            //echo $d->person->names->alternative_spelling . '<br />';

            //echo $d->person->title . '<br />';

            //echo $d->person->position . '<br />';



            //locations

            $locations_str = "";

            if (isset($d->details->locations->location)) {

                for ($x = 0; $x < sizeof($d->details->locations->location); $x++) {

                    if (isset($d->details->locations->location[$x]) && trim($d->details->locations->location[$x]) != '') {

                        //echo $d->details->locations->location[$x] . '<br />';

                        $locations_str .= $d->details->locations->location[$x] . ",";

                    }



                }

            }



            //echo $d->details->countries->country . '<br />'; //countries

            //echo $d->details->citizenships->citizenship . '<br /><br />'; //citizenship



            //keywords

            $keywords_str = "";

            if (isset($d->details->keywords->keyword)) {

                for ($x = 0; $x < sizeof($d->details->keywords->keyword); $x++) {

                    if (isset($d->details->keywords->keyword[$x]) && trim($d->details->keywords->keyword[$x]) != '') {

                        //echo $d->details->keywords->keyword[$x] . '<br />';

                        $keywords_str .= $d->details->keywords->keyword[$x] . ",";

                    }



                }

            }



            //external resources

            $external_sources_str = "";

            if (isset($d->details->external_sources->uri)) {

                for ($x = 0; $x < sizeof($d->details->external_sources->uri); $x++) {

                    if (isset($d->details->external_sources->uri[$x]) && trim($d->details->external_sources->uri[$x]) != '') {

                        //echo $d->details->external_sources->uri[$x] . '<br />';

                        $external_sources_str .= $d->details->external_sources->uri[$x] . ",";

                    }



                }

            }



            $companies_str = "";

            if (isset($d->details->companies->company)) {

                for ($x = 0; $x < sizeof($d->details->companies->company); $x++) {

                    if (isset($d->details->companies->company[$x]) && trim($d->details->companies->company[$x]) != '') {

                        //echo $d->details->companies->company[$x] . '<br />';

                        $companies_str .= $d->details->companies->company[$x] . ',';

                    }



                }

            }



            $linked_str = "";

            if (isset($d->details->linked_to->uid)) {

                for ($x = 0; $x < sizeof($d->details->linked_to->uid); $x++) {

                    if (isset($d->details->linked_to->uid[$x]) && trim($d->details->linked_to->uid[$x]) != '') {

                        //echo $d->details->linked_to->uid[$x] . '<br />';

                        $linked_str .= $d->details->linked_to->uid[$x] . ',';

                    }



                }

            }



            //echo $d->details->pep_role_details->pep_status . '<br />'; //countries

            //echo $d->person->agedata->age . '<br />'; //countries

            //echo $d->person->agedata->dob . '<br />'; //countries

            //echo $d->person->agedata->deceased . '<br />';

            //echo $d->person->agedata->as_of_date . '<br />';



            //echo $d->details->passports->passport['country'] . '<br />';

            //echo $d->person['ssn'] . '<br />';

            //echo $d->person['e-i'] . '<br />';



            //echo $d->details->pep_role_details->pep_status . '<br />';

            $pep_details_str = "";

            if (isset($d->details->pep_role_details->pep_role_detail->pep_role)) {

                for ($x = 0; $x < sizeof($d->details->pep_role_details->pep_role_detail->pep_role); $x++) {

                    if (isset($d->details->pep_role_details->pep_role_detail->pep_role[$x])) {



                        /*echo $d->details->pep_role_details->pep_role_detail->pep_role[$x] . ' - ' .

                            $d->details->pep_role_details->pep_role_detail->pep_position[$x] . ' - ' .

                            $d->details->pep_role_details->pep_role_detail->pep_role_status[$x] . ' - ' .

                            $d->details->pep_role_details->pep_role_detail->pep_role_bio[$x] .

                        */



                        $pep_details_str .= $d->details->pep_role_details->pep_role_detail->pep_role[$x] . ' - ' .

                        $d->details->pep_role_details->pep_role_detail->pep_position[$x] . ' - ' .

                        $d->details->pep_role_details->pep_role_detail->pep_role_status[$x] . ' - ' .

                        $d->details->pep_role_details->pep_role_detail->pep_role_bio[$x] . ", ";



                        //$linked_str = $linked_str . $d->details->linked_to->uid[$x] . ',';

                    }



                }

            }



            $data[] = array(

                $d['uid'],

                $d->person->names->last_name,

                $d->person->names->first_name,

                $aliases_str,

                $d->person->names->low_quality_aliases->alias,

                $d->person->names->alternative_spelling,

                $d['category'],

                $d->person->title,

                $d['sub-category'],

                $d->person->position,

                $d->person->agedata->age,

                $d->person->agedata->dob,

                $d->details->place_of_birth,

                $d->person->agedata->deceased,

                $d->details->passports->passport['country'],

                $d->person['ssn'],

                $locations_str,

                $d->details->countries->country,

                $d->details->citizenships->citizenship,

                $companies_str,

                $d->person['e-i'],

                $linked_str,

                $d->details->further_information,

                $keywords_str,

                $external_sources_str,

                $d['updatecategory'],

                $d['entered'],

                $d['updated'],

                $d['editor'],

                $d->person->agedata->as_of_date,

                $pep_details_str,

                $d->details->pep_role_details->pep_status,

            );







        }



        $this->dbProcess($data, "reuters_databank");



    }



    public function dbProcess($dataDB, $tableName)

    {



        foreach ($dataDB as $data) {

          $ok = DB::table($tableName)->updateOrInsert(

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



                if($ok){

                    echo "Done on: ". $data[0]."\n";

                }

        

        }



    }



  

} 