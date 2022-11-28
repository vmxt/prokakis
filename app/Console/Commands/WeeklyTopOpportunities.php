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
            $dateTo = date('Y-m-d H:i:s');
            $dateFrom = date('Y-m-d H:i:s', strtotime('-7 days'));

            $obc = OpportunityBuildingCapability::where('status', 1)
             ->where('intro_describe_business', '!=', null)
             ->where('ideal_partner_base', '!=', null)
             ->whereBetween('updated_at', [$dateFrom, $dateTo])
             ->orderBy('id', 'desc')
             ->limit(2)
             ->get();
             
             $ob =  OpportunityBuy::where('status', 1)
             ->where('intro_describe_business', '!=', null)
             ->where('ideal_partner_base', '!=', null)
             ->whereBetween('updated_at', [$dateFrom, $dateTo])
             ->orderBy('id', 'desc')
             ->limit(2)
             ->get();
             
             $oso = OpportunitySellOffer::where('status', 1)
             ->where('intro_describe_business', '!=', null)
             ->where('ideal_partner_base', '!=', null)
             ->whereBetween('updated_at', [$dateFrom, $dateTo])
             ->orderBy('id', 'desc')
             ->limit(2)
             ->get();

            $resOpp = $obc->merge($ob)->merge($oso);
            $totalCount = count($resOpp);
            if($totalCount < 5){
                $diff = 5 - $totalCount;
                $obcR = OpportunityBuildingCapability::where('status', 1)
                 ->where('intro_describe_business', '!=', null)
                 ->where('ideal_partner_base', '!=', null)
                 ->inRandomOrder()
                 ->orderBy('id', 'desc')
                 ->limit(2)
                 ->get();
                 
                 $obR =  OpportunityBuy::where('status', 1)
                 ->where('intro_describe_business', '!=', null)
                 ->where('ideal_partner_base', '!=', null)
                 ->inRandomOrder()
                 ->orderBy('id', 'desc')
                 ->limit(2)
                 ->get();
                 
                 $osoR = OpportunitySellOffer::where('status', 1)
                 ->where('intro_describe_business', '!=', null)
                 ->where('ideal_partner_base', '!=', null)
                 ->inRandomOrder()
                 ->orderBy('id', 'desc')
                 ->limit(2)
                 ->get();
    
                $resOppRan = $obcR->merge($obR)->merge($osoR);
                $resOppRandom = $resOppRan->random($diff);
            }
            // $resOppRandom = $resOpp->random(5);
      
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
            $ret = [];
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
                     $imgFile = isset( $ind->image ) ?  $ind->image : "";
                     $imgSrc = 'https://app.intellinz.com/public/images/industry/'.$imgFile;
                   
                     $ret[] = array('business_description'=>isset(  $d->intro_describe_business ) ?  $d->intro_describe_business : "", 
                     'country'=>$c_country, 
                     'keyword'=>$hashKey ,
                     'keyword_raw'=> isset( $d->relevant_describing_partner ) ? $d->relevant_describing_partner : ""  ,
                     'industry_category'=> isset( $ind->text ) ? $ind->text : "", 
                     'industry_image'=>$imgSrc,
                     'est_revenue'=> isset(  $d->est_revenue ) ?  $d->est_revenue : ""  ,
                     'est_profit'=> isset(  $d->est_profit ) ?  $d->est_profit : "" ,
                     'inventory_value'=> isset(  $d->inventory_value ) ?  $d->inventory_value : "",
                     'approx_large'=> isset(  $d->approx_large ) ?  $d->approx_large : "",
                     'title'=> strtoupper(isset(  $d->opp_title ) ?  $d->opp_title : "") );
                    
                     }
                  $oppCount++;
            }

            foreach($resOppRandom as $d){
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
                     $imgFile = isset( $ind->image ) ?  $ind->image : "";
                     $imgSrc = 'https://app.intellinz.com/public/images/industry/'.$imgFile;
                   
                     $ret[] = array('business_description'=>isset(  $d->intro_describe_business ) ?  $d->intro_describe_business : "", 
                     'country'=>$c_country, 
                     'keyword'=>$hashKey ,
                     'keyword_raw'=> isset( $d->relevant_describing_partner ) ? $d->relevant_describing_partner : ""  ,
                     'industry_category'=> isset( $ind->text ) ? $ind->text : "", 
                     'industry_image'=>$imgSrc,
                     'est_revenue'=> isset(  $d->est_revenue ) ?  $d->est_revenue : ""  ,
                     'est_profit'=> isset(  $d->est_profit ) ?  $d->est_profit : "" ,
                     'inventory_value'=> isset(  $d->inventory_value ) ?  $d->inventory_value : "",
                     'approx_large'=> isset(  $d->approx_large ) ?  $d->approx_large : "",
                     'title'=> strtoupper(isset(  $d->opp_title ) ?  $d->opp_title : "") );
                    
                     }
                  $oppCount++;
            }
   
    //$img1 = 'https://app.intellinz.com/public/images/industry/others.png';
            // $users = User::where('status',1)->get()->pluck('email');

                    $users = User::doesnthave('mu_user')
                    ->where('status',1)
                    // ->where('email','daryl.ebos.ph@gmail.com')
                    ->get();
          
            foreach($users as $emailAdd){
   
            //   $u_email = $emailAdd->email;
            //   $u_id = $emailAdd->id;
               
                    //Mailbox::sendMail_weeklyOpp( $ret, 'justin12.lee@i2jventures.com',  "Weekly Top Opportunity", "");
                    // Mailbox::sendMail_weeklyOpp( $ret, $emailAdd,  "Weekly Top Opportunity", ""); 
                Mailbox::sendMail_weeklyOpp( $ret, $u_email, $u_id, "Weekly Top Opportunity", ""); 
            }
            
           // mail('darylyrad.cabz@gmail.com', "subject oppo", $resOpp);
             
            // Mailbox::sendMail_weeklyOpp( $u_email, $u_id, 'darylyrad.cabz@gmail.com',  "Weekly Top Opportunity", ""); 
           
            //Mailbox::sendMail_weeklyOpp( $ret, 'knlgfx@gmail.com',  "Weekly Top Opportunity", "");
            // Mailbox::sendMail_weeklyOpp( $ret, 'elisha@ebos-sg.com',  "Weekly Top Opportunity", "");
            // Mailbox::sendMail_weeklyOpp( $ret, 'sales@ebos-sg.com',  "Weekly Top Opportunity", "");
            // Mailbox::sendMail_weeklyOpp( $ret, 'vicsaints3rd@gmail.com',  "Weekly Top Opportunity", "");
            // Mailbox::sendMail_weeklyOpp( $ret, 'vicsaints3rd@mailinator.com',  "Weekly Top Opportunity", "");
        //code here
        //gather all 
      // $as =  ProcessedReport::activeSubscriptionsCompanyName();
     
      // if(sizeof($as) > 0){

      // }
    
      echo "Sending of email notification finished.. \n";
      echo "Done ..."."\n";
    }



}

