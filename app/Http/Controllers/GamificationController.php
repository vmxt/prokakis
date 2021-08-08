<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rewards;
use App\CompanyProfile;
use App\User;
use Session;
use App\AdvisorLevels;
use Auth;
use App\Mailbox;
use App\Buytoken;
use App\RequestReport;

class GamificationController extends Controller {

   /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct() {
		$this->middleware('auth');
    }
    
    public function listOfAdvisers(Request $request)
    {
		$adReq = AdvisorLevels::all();
		return view('advisor.list', compact('adReq'));
	}
	
	public function redeemRewards(Request $request)
	{ 
		if ($request->isMethod('post'))
		{
			if(Session::get('current_advisor_level'))
			{
				$user_id = Auth::id(); 
				$company_id_result = CompanyProfile::getCompanyId($user_id);
				$company = CompanyProfile::find($company_id_result);

				$al = Session::get('current_advisor_level');
				$ep = Session::get('total_score_points');
				$ra = Session::get('amount_redeem');

				$user_credit_ids = Session::get('user_credit_ids');
				$user_referral_ids = Session::get('user_referral_ids');
				$referral_pur_ids = Session::get('referral_pur_ids');
				$referral_rep_ids = Session::get('referral_rep_ids');

			   $countAd = AdvisorLevels::where('company_id', $company_id_result)->where('user_id', $user_id)->where('status', 1)->count();

				if($countAd == 0){
					AdvisorLevels::create([
						'company_id'     	=> $company_id_result, 
						'user_id'  		 	=> $user_id, 
						'advisor_level'  	=> $al, 
						'earned_points'  	=> $ep, 
						'earned_amount'	 	=> $ra, 
						'user_referral_ids' => trim($user_referral_ids), 
						'user_credit_ids'	=> trim($user_credit_ids), 
						'referral_pur_ids'  => trim($referral_pur_ids), 
						'referral_rep_ids'	=> trim($referral_rep_ids),
						'status'		 => 1, 
						'created_at'	 => date('Y-m-d'),
					]);
						
					//sending of email notification
					$usr = User::where('user_type', '5')->get();
				
					$subject = "Prokakis rewards redemption request";	
					foreach($usr as $d){
						$receiver = $d->email;

						$content = "
						Hi Admin,
						<br /><br />

						We have recieved a redemption request of Prokakis rewards, from <br />
						Company Name: $company->company_name <br />
						Earned Points: $ep <br />
						Advisor Level: $al <br />
						Amount: $ra <br /><br />
						
						Thank you, <br />
						Prokakis Mailer
						";
						Mailbox::sendMail_v2($content, $receiver, $subject, '');
					}

					return redirect('/rewards')->with('status', 'You have successfully submitted your redemption request. ');	
				} else {
					return redirect('/rewards')->with('message', 'You already have a pending redemption request.');
				}
				
			

			}
		
		}

	}

	public function redeemDetails(Request $request)
	{
		if ($request->isMethod('post'))
		{
		  $reqId = $request->input('reqId');
		  $ad = AdvisorLevels::find($reqId);
		  
		  $uci = trim($ad->user_credit_ids);   //credits
		  $uri = trim($ad->user_referral_ids); //referrals
		  $rpi = trim($ad->referral_pur_ids);  //referrals purchase
		  $rri = trim($ad->referral_rep_ids);  //referrals reports
		 
		  if(strlen($uci) > 0){
			$cd = explode(",", $uci);  
			$credit = Buytoken::whereIn('id', $cd)->get();
			if($credit != null){
			
					?>
					<b>Credit Records</b>
					<table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%; padding-top: 5px;">
					<tbody>
						<tr>
							<th>
								Purchase Id
							</th>
							<th>
								Company Name
							</th>
							
							<th>
							Date Purchase
							</th>

							<th>
							Number of Credits
							</th>
							
							<th>
							Amount
							</th>
						</tr>

						<?php 
						$numCredit = 0;
						foreach($credit as $d){ ?>
						<tr>
							<td>
							<?php echo $d->id; ?>
							</td>
							<td>
							<?php $c = CompanyProfile::find($d->company_id);
							 echo $c->company_name;	
							?>
							</td>
							

							<td>
							<?php echo $d->created_at; ?>
							</td>
							<td>
							<?php echo $d->num_tokens; 
							$numCredit = ($numCredit + $d->num_tokens);  
							?>
							</td>
							<td>
							<?php echo $d->amount; ?>
							</td>
						</tr>
						<?php } ?>

						<tr>
						<td colspan="5">
						<?php
							echo 'Credit Total:<b>'. $numCredit.'</b><br />';
							echo 'Points:<b>'.($numCredit * 0.1).'</b>';
						?>
						</td>
						</tr>

					</tbody> 	
					</table>
				
					<?php
					
				
			}
		  }

		  if(strlen($uri) > 0){
			$ri = explode(",", $uri);  
			$usr = User::whereIn('id', $ri)->get();
			if($usr != null){
				?>
		
					<b>Referrals Records</b>
			
					<table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%;">
					<tbody>
						<tr>
							<th>FirstName</th>
							<th>LastName</th>
							<th>Email</th>
							<th>Registered At</th>
							
						</tr>
						<?php 
					$i=0;
						foreach($usr as $d){
							$i++;						
						?>
							<tr>
							<td><?php echo $d->firstname; ?></td>
							<td><?php echo $d->lastname; ?></td>
							<td><?php echo $d->email; ?></td>
							<td><?php echo $d->created_at; ?></td>
						</tr>		
						
						<?php 
						}	
						?>

						<tr>
						<td colspan="3">
						<?php
							echo 'Referrals Total:<b>'.$i.'</b><br />';
							echo 'Points:<b>'.($i * 0.05).'</b>'; 
							?>

						</td>
						</tr>
					</tbody>
					</table>	
				<?php
				
			}
		  }

		  if(strlen($rpi) > 0){
			$cd = explode(",", $rpi);  
			$credit = Buytoken::whereIn('id', $cd)->get();
			if($credit != null){
			
					?>
		
					<b>Referrals Credit Purchases Records</b>
					<table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%;">
					<tbody>
						<tr>
							<th>
								Purchase Id
							</th>

							<th>
								Company  Name
							</th>
							
							<th>
							Date Purchase
							</th>

							<th>
							Number of Credits
							</th>
							
							<th>
							Amount
							</th>
						</tr>

						<?php 
						$numCredit = 0;
						foreach($credit as $d){ ?>
						<tr>
							<td>
							<?php echo $d->id; ?>
							</td>

							<td>
							<?php $c = CompanyProfile::find($d->company_id);
							 echo $c->company_name;	
							?>
							</td>

							<td>
							<?php echo $d->created_at; ?>
							</td>
							<td>
							<?php echo $d->num_tokens; 
							$numCredit = ($numCredit + $d->num_tokens);  
							?>
							</td>
							<td>
							<?php echo $d->amount; ?>
							</td>
						</tr>
						<?php } ?>

						<tr>
						<td colspan="4">
						<?php
							echo 'Referrals Credit Total:<b>'. $numCredit.'</b><br />';
							echo 'Points:<b>'.($numCredit * 0.1).'</b>';
						?>
						</td>
						</tr>


					</tbody> 	
					</table>
				
					<?php
				
				  }
			}

			if(strlen($rri) > 0){
			$cd = explode(",", $rri);  
			$rep = RequestReport::whereIn('id', $cd)->get();
				if($rep != null)
				{
					?>

					<b>Referrals Request Report Records</b>
					<table class="table table-bordered table-striped table-condensed flip-content" style="width: 100%;">
					<tbody>
						<tr>
							<th>
								Report Id
							</th>
							<th>
							    Date Created
							</th>

							<th>
								Company Requerter
							</th>
							
							<th>
								Company Provider
							</th>
						</tr>

						<?php 
						$numReport = 0;
						foreach($rep as $d)
						{ 
							$numReport++;
							?>
						<tr>
							<td>
							<?php echo $d->id; ?>
							</td>
							<td>
							<?php echo $d->created_at; ?>
							</td>
							<td>
							<?php 
							$reqC = CompanyProfile::find($d->company_id);
							echo $reqC->company_name; 
							?>
							</td>
							<td>
							<?php 
						    $reqP = CompanyProfile::find($d->source_company_id);	
							echo $reqP->company_name; 
							?>
							</td>
						</tr>
						<?php } ?>

						<tr>
						<td colspan="4">
						<?php
							echo 'Referrals Report Total:<b>'. $numReport.'</b><br />';
							echo 'Points:<b>'.($numReport * 0.1).'</b>';
						?>
						</td>
						</tr>

					</tbody> 	
					</table>

					- 50 Points = Advisor Level Worth USD$100 <br />
                                                    - 150 Points = Gold Advisor Worth USD$375 <br />
                                                    - 500 Points = Platinum Advisor Worth USD$1750 <br />
                                                    - ONLY ADVISORS LEVEL CAN REDEEM POINTS <br />
				
					<?php
			
				}
			}
			
		}	
	}

	public function redeemGetApproved(Request $request)
	{
		if ($request->isMethod('post'))
		{
			$user_id = Auth::id(); 
			if(User::securePage($user_id) != 1){
				
				$reqId = $request->input('reqId');
				$ad = AdvisorLevels::find($reqId);
				$ad->approver1 = $user_id;
				$ad->status = 0;
				$ad->save();
				return redirect('/advisor')->with('status', 'You have successfully approved a redemption request.');

			} else {
				return redirect('/home')->with('status', 'The page is restricted, only for Prokakis administrator.');
			}	
		}

	}

    
}
