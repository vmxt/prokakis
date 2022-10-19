<?php

namespace App;

use App\CompanyProfile;
use app\User;
use Config;
use App\Buytoken;
use App\RequestReport;
use Illuminate\Support\Facades\DB;
use App\AdvisorLevels;
use Auth;
class Rewards 
{
    public $user_id;
    public $company_id;
    public $total_referrals;
    public $total_score;

    public $user_referral_ids = [], $user_credit_ids = [], $referral_pur_ids = [], $referral_rep_ids = [];
    public $user_referral_ids_x = [], $user_credit_ids_x = [], $referral_pur_ids_x = [], $referral_rep_ids_x = [];
    public $user_referral_ids_str = "", $user_credit_ids_str = "", $referral_pur_ids_str = "", $referral_rep_ids_str = "";

    public function __construct($uid)
    {
      $usr =  User::find($uid);
      if($usr != null){
          $this->user_id = $usr->id;
          //reset process  
          $ad =  AdvisorLevels::where('user_id', $this->user_id)->get();
          $user_credit_idss = '';
          $user_referral_idss = '';
          $referral_pur_idss = '';
          $referral_rep_idss = '';

          if($ad != NULL){
            foreach($ad as $t){
             $user_credit_idss = $user_credit_idss . $t->user_credit_ids.",";
             $user_referral_idss = $user_referral_idss . $t->user_referral_ids.",";
             $referral_pur_idss = $referral_pur_idss . $t->referral_pur_ids.",";
             $referral_rep_idss = $referral_rep_idss . $t->referral_rep_ids.",";
            }
          }
          //-------
          $this->user_credit_ids_x = explode(",", rtrim($user_credit_idss, ","));
          $this->user_referral_ids_x = explode(",", rtrim($user_referral_idss, ","));
          $this->referral_pur_ids_x  = explode(",", rtrim($referral_pur_idss,","));
          $this->referral_rep_ids_x = explode(",", rtrim($referral_rep_idss,","));

          //var_dump($this->referral_rep_ids_x);

      } else {
          die('invalid user id');
      }  
    }
    
    //companies of the main user
    public function setTotalCredits()
    {
      $sum = 0;
      $company_refs = CompanyProfile::where('user_id', $this->user_id)->get();
          if(!empty($company_refs)){
            foreach($company_refs as $c){
                      $ref = Buytoken::where('company_id', $c->id)->where('amount', '!=', 0)
                      ->select(DB::raw('SUM(num_tokens) as TotalCredit'))
                    #  ->whereNotIn('id', $this->user_credit_ids_x)
                      ->first();
                      $sum = ($sum + $ref->TotalCredit); 
            }
            // foreach($company_refs as $c){
            //     $bIds = Buytoken::where('company_id', $c->id)->where('amount', '!=', 0)
            //   #  ->whereNotIn('id', $this->user_credit_ids_x)
            //     ->get();
            //     if($bIds != null){
            //           foreach($bIds as $d){
            //             $this->user_credit_ids[] = $d->id; 
            //           } 
            //     }
            // }
          }
      return $sum;
    }
    

    //companies of the main user
    public function setTotalPoints()
    {
      $sum = 0;
      $company_refs = CompanyProfile::where('user_id', $this->user_id)->get();
          if(!empty($company_refs)){
            foreach($company_refs as $c){
                      $ref = AdvisorLevels::where('company_id', $c->id)->where('status', 1)
                      ->select(DB::raw('SUM(earned_points) as earned_points'))
                    #  ->whereNotIn('id', $this->user_credit_ids_x)
                      ->first();
                      $sum = ($sum + $ref->earned_points); 
            }
            // foreach($company_refs as $c){
            //     $bIds = Buytoken::where('company_id', $c->id)->where('amount', '!=', 0)
            //   #  ->whereNotIn('id', $this->user_credit_ids_x)
            //     ->get();
            //     if($bIds != null){
            //           foreach($bIds as $d){
            //             $this->user_credit_ids[] = $d->id; 
            //           } 
            //     }
            // }
          }
      return $sum;
    }
    //companies of the main user
    public function fetchTotalCreditsPoints()
    {
      $sum = 0;
      $company_refs = CompanyProfile::where('user_id', $this->user_id)->get();
          if(!empty($company_refs)){
            foreach($company_refs as $c){
                      $ref = Buytoken::where('company_id', $c->id)->where('amount', '!=', 0)
                      ->select(DB::raw('SUM(amount) as amount'))
                      ->first();
                      $sum = ($sum + $ref->amount); 
            }
          }
      return $sum;
    }

    //set counting the actuial referrals
    public function setTotalReferrals()
    {
      $refCount = User::where('referral_id', $this->user_id)
      #->whereNotIn('id', $this->user_referral_ids_x)
      ->count();
      $this->total_referrals = ($refCount > 0)? $refCount : 0;

      $refData = User::where('referral_id', $this->user_id)
      #->whereNotIn('id', $this->user_referral_ids_x)
      ->get();

      foreach($refData as $d){
        $this->user_referral_ids[] = $d->id; 
      }

    }
     
    //get counting the actuial referrals
    public function getTotalReferrals()
    {
     $this->setTotalReferrals(); 
     $total = ($this->total_referrals != null)? $this->total_referrals : 0;
     return ($total >= 1) ? 1 : 0;
    }
   
    public function getReferralsPoints()
    {
      return ($this->getTotalReferrals() * Config::get('constants.options.referral_point'));  //0.05
    }

    //total credit purchased of referrals combined
    public function setTotalPurchasedByCombinedReferrals()
    {
      $sumCredit = 0;
      $rs = User::where('referral_id', $this->user_id)->get();
      if(!empty($rs)){
          foreach($rs as $d){

              $company_refs = CompanyProfile::where('user_id', $d->id)->get();
              if(!empty($company_refs))
              {
                  foreach($company_refs as $c){
                      $ref = Buytoken::where('company_id', $c->id)->where('amount', '!=', 0)
                      ->select(DB::raw('SUM(amount) as TotalCredit'))
                      # ->whereNotIn('id', $this->referral_pur_ids_x)
                      ->first();
                      $sumCredit = ($sumCredit + $ref->TotalCredit); 
                  }

                  foreach($company_refs as $c){
                      $bIds = Buytoken::where('company_id', $c->id)->where('amount', '!=', 0)
                     # ->whereNotIn('id', $this->referral_pur_ids_x)
                      ->get();
                      if($bIds != null){
                            foreach($bIds as $d){
                              $this->referral_pur_ids[] = $d->id; 
                            } 
                      }
                  }

              }
          }
      }
      return  $sumCredit;
    }

    public function getTotalPointsByReferralsPurchased()
    {
      $totalPoints = $this->setTotalPurchasedByCombinedReferrals();
      return ($totalPoints * Config::get('constants.options.referral_purchased_point')); //0.1
    }

    //total reports of referrals combined
    public function setTotalReportsCombinedReferrals()
    {
      $sumReports = 0;
        $rs = User::where('referral_id', $this->user_id)->get();
        if(!empty($rs)){
            foreach($rs as $d){
  
                $company_refs = CompanyProfile::where('user_id', $d->id)->get();
                if(!empty($company_refs))
                {
                    foreach($company_refs as $c){
                        $countReports = RequestReport::where('company_id', $c->id)
                        #->whereNotIn('id', $this->referral_rep_ids_x)
                        ->count();
                        $sumReports = ($sumReports + $countReports); 
                    }

                    foreach($company_refs as $c){
                      $bIds = RequestReport::where('company_id', $c->id)
                      #->whereNotIn('id', $this->referral_rep_ids_x)
                      ->get();
                      if($bIds != null){
                            foreach($bIds as $d){
                              $this->referral_rep_ids[] = $d->id; 
                            } 
                      }
                    }
                }
            }
        }
        return  $sumReports;
    }
    
    public function getTotalReportsCombinedReferrals()
    {
      $totalPoints = $this->setTotalReportsCombinedReferrals();
      return ($totalPoints * Config::get('constants.options.referral_purchased_per_credit')); //0.1
    }

    public function getRemainingAdvisorPoints(){
      $usr =  User::find(Auth::id());
      if($usr != null){
          $ad =  AdvisorLevels::where('user_id', $usr->id)
          ->select(DB::raw('SUM(earned_points) as earned_points'))
          ->where('status','<>',2)
          ->first();
          return $ad->earned_points;
      }
    }

    public function getTotalCredits()
    {
      $totalPoints = $this->fetchTotalCreditsPoints();
      $points = 0;
      // if($totalPoints < 3){
      //   $points = $totalPoints * 0.12;
      // }elseif($totalPoints < 6 && $totalPoints >= 3){
      //   $points = $totalPoints * 0.12;
      // }elseif($totalPoints < 120 && $totalPoints >= 6){
      //   $points = $totalPoints * 0.72;
      // }elseif($totalPoints >= 120 ){
      //   $points = $totalPoints * 14.4;
      // }
      // return $points;
      return ($totalPoints * Config::get('constants.options.credit_point')); //0.12
      // return 50;
    }

    public function getTotalPointsScore()
    {

      $indCreditsPoints = $this->getTotalCredits();
      //echo 'Credits from Rewards: '. $indCreditsPoints; exit;
      $indReferralsPoints = $this->getReferralsPoints();
      //echo 'Reffereals from Rewards: '.  $indReferralsPoints; exit;
      $indReferralsPurchasedPoints = $this->getTotalPointsByReferralsPurchased();
      //echo 'Reffereals Purchased from Rewards: '.  $indReferralsPurchasedPoints; exit;
      $indReportsReferralsPurchasedPoints = $this->getTotalReportsCombinedReferrals();

      $this->total_score = ($indCreditsPoints + $indReferralsPoints + $indReferralsPurchasedPoints + $indReportsReferralsPurchasedPoints);
      return $this->total_score - $this->getRemainingAdvisorPoints();
    }

    //get the advisor level
  public function getAdvisorLevel()
  {
      $n = $this->getTotalPointsScore();
      $str = 0;
      //echo $n; exit;
       if( $n >= 50 && $n < 200 ){
          $str = 1; //"silver";
       } elseif($n >= 200 && $n < 500) { 
         $str = 2; //"gold";
       } elseif($n >= 500){
          $str = 3; //"platinum";
       } else{
          $str = 0;
       }

      return $str;
  }

  public function getAdvisorNextLevel($score=0, $max=0)
  {
    if($score == 0){
      $n = $this->getTotalPointsScore();
    }else{
      $n = $score;
    }
    //echo  $n; exit;
    $str = 0;
     if($n >= 50 && $n < 200 ){
        $str = (200 - $n);
      } elseif($n >= 200 && $n < 500) {
        $str = (500 - $n);
      } elseif($n >= 500){
        $str = "Reached Max";
      } else{
        $str = (50 - $n);
      }

if($max!=0){
  $str = 500 - $this->getTotalPointsScore();
}

    return $str;
  }


  //get the advisor level
  public function getAdvisorTips($n)
  {
      // $n = $this->getTotalPointsScore();
      $str = "";
        if($n >= 50 && $n < 150 ){
          $str = "Or wait for the gold advisor level to be able to redeem USD $300."; 
        } elseif($n >= 150 && $n < 500 ){
         $str = "Or wait for the platinum advisor level to be able to redeem USD $1500"; 
        } elseif($n >= 500){
          $str = "You have reached to maximum level.";
        }else{
          $r =  (50 - $n);
          $str = "You need to have $r more points to get to the first level Advisor and be able to redeem USD $100."; 
        }
      return $str;
  }

   //get the advisor level
   public function getAdvisorAmountToRedeem()
   {
       $n = $this->getTotalPointsScore();
       $str = 0;
       if($n >= 50 && $n < 200 ){
           $str = 50.00; 
       }elseif($n >= 200 && $n < 500 ){
          //code here
          $str = 300.00; 
       } elseif($n >= 500){
           $str = 1500.00;
       }
       return $str;
   }
   
   public function removeDuplicatesIds()
   {
    $credit_ids = array_unique($this->user_credit_ids);
    $this->user_credit_ids_str = implode(",", $credit_ids);
    //echo $result_credit_ids .'<br />';

    $referral_ids = array_unique($this->user_referral_ids);
    $this->user_referral_ids_str = implode(",", $referral_ids);
    //echo $result_referral_ids.'<br />';

    $pur_referral_ids = array_unique($this->referral_pur_ids);
    $this->referral_pur_ids_str = implode(",", $pur_referral_ids);
    //echo $result_pur_referral_ids.'<br />';

    $rep_referral_ids = array_unique($this->referral_rep_ids);
    $this->referral_rep_id_str = implode(",", $rep_referral_ids);
    //echo $result_rep_referral_ids;
   }


}