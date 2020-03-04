<?php

namespace App\Http\Controllers;

use App\CompanyProfile;
use App\Http\Controllers\Controller;
use App\Mailbox;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;
use App\Unsubscribe;
use App\UploadImages;
use App\User;
use Config;
use Illuminate\Http\Request;

class TestController extends Controller {

	/**

	 * Create a new controller instance.

	 *

	 * @return void

	 */

	public function __construct() {

		//  $this->middleware('auth');

	}

	public function index(Request $request) {

		echo "Start ..." . "\n";

		$allc = CompanyProfile::all();

		foreach ($allc as $d) {
			if ($this->getUnsubscribeList($d) == false) {

				$res = $this->getStarRank($d);

				if ($res < 51) {
					//send an email

					$data = file_get_contents("http://app.prokakis.com/public/emailtemplate/ProkakisEnhanceProfile.html");

					$rs_usr = User::find($d->user_id);
					$email_address = $rs_usr->email;
					$company_name = (trim($d->registered_company_name) != '' || $d->registered_company_name != NULL) ? $d->registered_company_name : $d->company_name;
					$data = str_replace("[First Name]", $rs_usr->firstname, $data);
					$data = str_replace("[Company Name]", $company_name, $data);

					$en_company_id = base64_encode($d->id);
					$en_user_id = base64_encode($d->user_id);
					$en_notify_type = base64_encode('enhancedprofile');
					$en_notify_date = base64_encode(date('Y-m-d'));
					$token = $en_company_id . '-ebos-' . $en_user_id . '-ebos-' . $en_notify_type . '-ebos-' . $en_notify_date;
					$url_token = url('/unsubscribeMe/' . $token);
					$data = str_replace("[UNSUBSCRIBE LINK]", $url_token, $data);

					$this->alertNotify($data, $email_address, 'Enahance Company Profile, Prokakis');

				} elseif ($res > 50) {

					$rsBuild = OpportunityBuildingCapability::where('company_id', $d->id)->get();
					$rsBuy = OpportunityBuy::where('company_id', $d->id)->get();
					$rsSellOffer = OpportunitySellOffer::where('company_id', $d->id)->get();

					if (count((array) $rsBuild) == 0 && count((array) $rsBuy) == 0 && count((array) $rsSellOffer) == 0) {

						$rs_usr = User::find($d->user_id);
						$email_address = $rs_usr->email;
						$company_name = (trim($d->registered_company_name) != '' || $d->registered_company_name != NULL) ? $d->registered_company_name : $d->company_name;

						$dataOpp = file_get_contents("http://app.prokakis.com/public/emailtemplate/ProkakisAddOpportunity.html");
						$dataOpp = str_replace("[First Name]", $rs_usr->firstname, $dataOpp);
						$dataOpp = str_replace("[Company Name]", $company_name, $dataOpp);

						$en_company_id = base64_encode($d->id);
						$en_user_id = base64_encode($d->user_id);
						$en_notify_type = base64_encode('addopportunity');
						$en_notify_date = base64_encode(date('Y-m-d'));
						$token = $en_company_id . '-ebos-' . $en_user_id . '-ebos-' . $en_notify_type . '-ebos-' . $en_notify_date;
						$url_token = url('/unsubscribeMe/' . $token);
						$dataOpp = str_replace("[UNSUBSCRIBE LINK]", $url_token, $dataOpp);

						$this->alertNotify($dataOpp, $email_address, 'Add Opportunity, Prokakis');
					}

				}
			}

		}

		echo "Done ..." . "\n";

		/*
			        $data = file_get_contents("http://app.prokakis.com/public/emailtemplate/ProkakisEnhanceProfile.html");
			        $data = str_replace("[First Name]", "Test Victor", $data);
			        $data = str_replace("[Company Name]", "Test Company", $data);

			        $en_company_id = base64_encode(62);
			        $en_user_id = base64_encode(31);
			        $en_notify_type = base64_encode('enhancedprofile');
			        $en_notify_date = base64_encode(date('Y-m-d'));
			        $token = $en_company_id.'-ebos-'.$en_user_id.'-ebos-'. $en_notify_type.'-ebos-'.$en_notify_date;
			        echo $token .'<br />';
			        $url_token = url('/unsubscribeMe/'.$token);
			        echo $url_token .'<br />';
			        //exit;
			        $data = str_replace("[UNSUBSCRIBE LINK]", $url_token, $data);
			        $this->alertNotify($data, 'vicsaints3rd@gmail.com', 'Enahance Company Profile, Prokakis');
		*/

	}

	function getUnsubscribeList($d) {

		//$res = Unsubscribe::where('company_id', $d->company_id)->where('user_id', $d->user_id)->get();
		$res = Unsubscribe::where('company_id', $d->id)->where('user_id', $d->user_id)->count();

		if ($res > 0) {
			return true;
		} else {
			return false;
		}

	}

	function getStarRank($company) {

		$profileAvatar = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.profile'), 1);
		$profileAwards = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.awards'), 5);
		$profilePurchaseInvoice = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.purchase_invoices'), 5);
		$profileSalesInvoice = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.sales_invoices'), 5);
		$profileCertifications = UploadImages::getFileNames($company->user_id, $company->id, Config::get('constants.options.certification'), 5);

		$ratingScore = CompanyProfile::profileCompleteness(array($company, $profileAvatar, $profileAwards,
			$profilePurchaseInvoice, $profileSalesInvoice, $profileCertifications));

		return $ratingScore;

	}

	public function alertNotify($message, $email, $messageTitle) {
		echo $email . '<br />';
		//send the email here
		Mailbox::sendMail_EmailTemplate($message, $email, $messageTitle, "");

	}

}
