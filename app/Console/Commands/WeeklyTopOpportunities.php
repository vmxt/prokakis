<?php

namespace App\Console\Commands;

use App\CompanyProfile;
use Illuminate\Console\Command;

use DB;
use App\Mailbox; 
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use App\OppIndustry;
use App\User;
use function GuzzleHttp\json_encode;
use Illuminate\Http\Request;

class WeeklyTopOpportunities extends Command
{

    protected $signature = 'WeeklyTopOpportunities:intellinz';


     /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To send Top 10 latest Opportunities to our members';

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
        
            $obc = OpportunityBuildingCapability::where('status', 1)
             ->where('intro_describe_business', '!=', null)
             ->where('ideal_partner_base', '!=', null)
             ->orderBy('id', 'desc')
             ->limit(10)
             ->get();
             
             $ob =  OpportunityBuy::where('status', 1)
             ->where('intro_describe_business', '!=', null)
             ->where('ideal_partner_base', '!=', null)
             ->orderBy('id', 'desc')
             ->limit(10)
             ->get();
             
             $oso = OpportunitySellOffer::where('status', 1)
             ->where('intro_describe_business', '!=', null)
             ->where('ideal_partner_base', '!=', null)
             ->orderBy('id', 'desc')
             ->limit(10)
             ->get();

            $resOpp = $obc->merge($ob)->merge($oso);

            // $r = rand(1, 3);
            //  $v = null; 
            //  $ret = array();
       
            //  if($r == 1){
            //    $v = $obc; 
            //  } elseif($r == 2){
            //    $v = $ob; 
            //  } elseif($r == 3){
            //    $v = $oso; 
            //  }
                    
            $result = array('result'=>'success');
            $oppCount = 1;
            foreach($resOpp as $d){
                if($oppCount <= 5){
                    $cc = [];
                    $c_country = "";       
                    if(strlen($d->ideal_partner_base) > 0){
                        $cc = explode(",",$d->ideal_partner_base);
                        if(isset($cc[0])){
                            $c_country = $c_country . $cc[0];   
                        }
                        if(isset($cc[1])){
                        $c_country = $c_country . ','.$cc[1];
                        }
                        if(isset($cc[2])){
                        $c_country = $c_country . ','.$cc[2];
                        }
                    }  

                    if($d->is_anywhere == 1){
                        $c_country = "Anywhere";
                    }
                    $keyword = explode(",", $d->relevant_describing_partner);
                    $hashKey ="";
                     if( $d->relevant_describing_partner ){
                         foreach ($keyword as $val ) {
                            if($val!="")
                             $hashKey .= '#'.str_replace(' ','_',$val)." ";
                         }
                     }
                    $ttitle = substr($d->opp_title, 0, 33).'..';   
                     $ind =  OppIndustry::find($d->industry);
                     $imgSrc = 'https://app-prokakis.com/public/images/industry/'.$ind->image;
                     $ret[] = array('business_description'=>$d->intro_describe_business, 
                     'country'=>$c_country, 
                     'keyword'=>$hashKey ,
                     'keyword_raw'=>$d->relevant_describing_partner ,
                     'industry_category'=>$ind->text, 
                     'industry_image'=>$imgSrc,
                     'est_revenue'=>$d->est_revenue,
                     'est_profit'=>$d->est_profit,
                     'inventory_value'=>$d->inventory_vaue,
                     'title'=> strtoupper($d->opp_title) );
                    
                     }
                  $oppCount++;
            }

            // $users = User::all()->pluck('email');
            // foreach($users as $emailAdd){
            //     Mailbox::sendMail_weeklyOpp( $ret, $users,  "Weekly Top Opportunity", ""); 
            // }
            
            Mailbox::sendMail_weeklyOpp( $ret, 'darylyrad.cabz@gmail.com',  "Weekly Top Opportunity", ""); 
            Mailbox::sendMail_weeklyOpp( $ret, 'knlgfx@gmail.com',  "Weekly Top Opportunity", "");
            // Mailbox::sendMail_weeklyOpp( $ret, 'elisha@ebos-sg.com',  "Weekly Top Opportunity", "");
            // Mailbox::sendMail_weeklyOpp( $ret, 'sales@ebos-sg.com',  "Weekly Top Opportunity", "");
            // Mailbox::sendMail_weeklyOpp( $ret, 'vicsaints3rd@gmail.com',  "Weekly Top Opportunity", "");
            // Mailbox::sendMail_weeklyOpp( $ret, 'vicsaints3rd@mailinator.com',  "Weekly Top Opportunity", "");
        //code here
        //gather all 
      // $as =  ProcessedReport::activeSubscriptionsCompanyName();
     
      // if(sizeof($as) > 0){

      // }
    
      //echo "Sending of email notification finished.. \n";
      echo "Done ..."."\n";
    }


  


}

