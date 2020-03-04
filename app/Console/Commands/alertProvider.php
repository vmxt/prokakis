<?php

namespace App\Console\Commands;

use App\CompanyProfile;
use Illuminate\Console\Command;

use DB;

use App\Mailbox; 

use App\RequestReport;

class alertProvider extends Command
{

    protected $signature = 'alertProvider:prokakis';


     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To alert provider via email notification regarding a report request';

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
        $all_request = RequestReport::all(); // ->distinct('source_company_id');

        if(count($all_request) > 0)
        {
            $arr = arraY();

            foreach($all_request as $d){
            
            $date = date_create($d->created_at);
            $cdate = date_format($date,"Y-m-d");

            //echo $d->source_company_id."  ". $cdate."  ".$d->id."  ". $d->company_name."\n";
            //$arr[] = array($d->id, $d->source_company_id, $cdate, $d->company_name);    
            //var_dump($arr); 
                
            $rec = CompanyProfile::find($d->source_company_id);
            if(count($rec) > 0)
            {

                echo $cdate . "  ". $rec->last_login . "\n\n";
                $diff = $this->getDaysDiff($cdate, $rec->last_login);
                echo  $diff . "\n";

                if( $diff > 2 )
                {
                    //create a record
                    //or checks an exisitng record
                    $result = DB::table('request_alert_notification')
                            //->select('request_id')
                    ->where('request_id', '=', $d->id)
                    ->where('company_id', '=', $d->source_company_id)
                    ->where('is_going', '=', 1)
                    ->first();

                            if(count($result) > 0)
                            {

                                $newDay = ($result->num_days + 1);

                                if($newDay < 31)
                                {
                                    
                                    if($result->is_going == 1)
                                    { 
                                    //send notifi here
                                    $this->sendNotification($d->source_company_id);

                                        DB::table('request_alert_notification')
                                        ->where('request_id', '=', $d->id)
                                        ->where('company_id', '=', $d->source_company_id)
                                        ->update(
                                            ['num_days' => $newDay]
                                        );  
                                    }

                                } else {
                                    
                                    DB::table('request_alert_notification')
                                    ->where('request_id', '=', $d->id)
                                    ->where('company_id', '=', $d->source_company_id)
                                    ->update(
                                        ['is_going' => 0]
                                    );  

                                }

                            } else {

                                DB::table('request_alert_notification')->insert(
                                    [
                                    'request_id' => $d->id, 
                                    'company_id' => $d->source_company_id,
                                    'start_date_alerted' => date('y-m-d'),
                                    'is_going' => 1,
                                    'num_days' => 1,
                                    ]
                                );
                                //send notifi here
                                $this->sendNotification($d->source_company_id);
                            }

                    
                } else {

                    if($diff == 1 || $diff == 2)
                    {

                        DB::table('request_alert_notification')
                        ->where('request_id', '=', $d->id)
                        ->where('company_id', '=', $d->source_company_id)
                        ->update(
                            ['is_going' => 0]
                        );  

                    }

                }


            }    
            
            
            }
        }
     

        echo "Sending of email notification finished.. \n";
        echo "Done ..."."\n";
    }

    public function sendNotification($id)
    {
       $rs = CompanyProfile::find($id); 

        if(count($rs) > 0)
        {
           //$this->alertNotify($rs);
        }     
    }

    public function alertNotify($rs)
    {
        $message = "
        Dear $rs->company_name,
        <br />
        <br />
        We would like to inform you that there is a report request submitted, and it requires your updated company details.
        <br />
        To update details, please login to prokakis: http://ebos-app.prokakis.com/
        <br />
        <br />
        Best Regards, <br />
        Prokakis Web Admin
        ";
        //send the email here  
        Mailbox::sendMail($message, $rs->company_email, "Report Request need your company details.", ""); 
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

