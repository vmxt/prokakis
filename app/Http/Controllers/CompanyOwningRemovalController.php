<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\CompanyOwningRemoval;
use App\AuditLog;
use App\CompanyProfile;
use App\Mailbox;
use App\OpportunityBuildingCapability;
use App\OpportunityBuy;
use App\OpportunitySellOffer;

class CompanyOwningRemovalController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function reqCompanyOwn(Request $request)
    {
        $reqId = $request['reqId'];
        $provId = $request['provId'];
       
        $reqProf = CompanyProfile::find($reqId);
        $provProf = CompanyProfile::find($provId);
        $provCompanyName = "";
        if($provProf != null){
            $provCompanyName = $provProf->company_name;
        }
        $reqType = "own";

        $usr = User::find($reqProf->user_id);
        $fullName = $usr->firstname.' '.$usr->lastname;
        $contactNumber =$usr->phone;
        $emailAdd = $usr->email;

        return view('ownrem.reqown', compact('provCompanyName', 'provId', 'reqType', 'fullName', 'contactNumber', 'emailAdd'));
    }

    public function reqCompanyRem(Request $request)
    {
        $reqId = $request['reqId'];
        $provId = $request['provId'];

        $reqProf = CompanyProfile::find($reqId);
        $provProf = CompanyProfile::find($provId);
        $provCompanyName = "";
        if($provProf != null){
            $provCompanyName = $provProf->company_name;
        }
        $reqType = "remove";

        $usr = User::find($reqProf->user_id);
        $fullName = $usr->firstname.' '.$usr->lastname;
        $contactNumber =$usr->phone;
        $emailAdd = $usr->email;

        return view('ownrem.reqrem', compact('provCompanyName', 'provId', 'reqType', 'fullName', 'contactNumber', 'emailAdd'));
    }

    public function getDocumentRequest(Request $request)
    {
            if ($request->isMethod('post')) {

              $this->validate($request, [
                   'fullName' => 'required|string|min:6|max:510',
                   'agreement' => 'required',
                   'businessProfile' => 'required',
                   'passportProfile' => 'required',
              ], [
               'fullName.required' => 'Please enter your full name',
               'agreement.required' => 'Please tick the check box declaration, it is required.',
               'businessProfile.required' => 'Business profile data is required.',
               'passportProfile.required' => 'Passport data is required.',
              ]);

                $subjectCompanyId = $request->input('subject_company_id');
                $reqType = $request->input('reqType');
                $reqFname = $request->input('fullName');
                $reqContact = $request->input('contactNumber');
                $reqEmail = $request->input('emailAdd');
                
                $passportProfileFile = "";
                $businessProfileFile = "";

                $user_id = Auth::id();
                $company_id_result = CompanyProfile::getCompanyId($user_id);

                if ($request->hasfile('passportProfile')) 
                {
                    $filePassPort = $request->file('passportProfile');
					$passportProfileFile =  'passportProfile_'.$user_id.'_'. $filePassPort->getClientOriginalName();
                    $filePassPort->move(public_path() . '/noregs_company/', $passportProfileFile);
                    AuditLog::ok(array($user_id, 'Company request Owning or Removal', 'upload file', 'passport profile:' . $passportProfileFile));
                }

                if ($request->hasfile('businessProfile')) 
                {
					$file = $request->file('businessProfile');
					$businessProfileFile = 'businessProfile_' .$user_id .'_'. $file->getClientOriginalName();
					$file->move(public_path() . '/noregs_company/', $businessProfileFile);
					AuditLog::ok(array($user_id, 'Company request Owning or Removal', 'upload file', 'business profile:' . $businessProfileFile));
                }

               $ok = CompanyOwningRemoval::create([
                    'requester_user_id'      => $user_id, 
                    'requester_company_id'   => $company_id_result,
                    'subject_company_id'     => $subjectCompanyId, 
                    'request_type'           => $reqType, 
                    'request_stage'          => 1, 
                    'status'                 => 1, 
                    'requester_name'         => $reqFname, 
                    'requester_contact'      => $reqContact, 
                    'requester_email'        => $reqEmail,    
                    'passportFile'           => 'public/noregs_company/' . $passportProfileFile, 
                    'businessFile'           => 'public/noregs_company/' . $businessProfileFile, 
                    'created_at'             => date('Y-m-d'),
                ]);

                if($ok){
                    return redirect('home')->with('status', 'Request successfully submittted');
                }
                
            }
    }

    public function getRemoveRequest(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'agreement' => 'required',
           ], [
            'agreement.required' => 'Please tick the check box declaration, it is required.',
           ]);

            $subjectCompanyId = $request->input('subject_company_id');
            $reqType = $request->input('reqType');
           
            $user_id = Auth::id();
            $company_id_result = CompanyProfile::getCompanyId($user_id);

           $ok = CompanyOwningRemoval::create([
                'requester_user_id'      => $user_id, 
                'requester_company_id'   => $company_id_result,
                'subject_company_id'     => $subjectCompanyId, 
                'request_type'           => $reqType, 
                'request_stage'          => 1, 
                'status'                 => 1, 
                'created_at'             => date('Y-m-d'),
            ]);

            if($ok){
                return redirect('home')->with('status', 'Request successfully submittted');
            }

        }
    }

    public function adminReqList()
    {
        //if(User::getEBossStaffTrue(Auth::id()) == true)
    //    {
           $rs = CompanyOwningRemoval::where('status', 1)->get();
           return view('ownrem.adminList', compact('rs'));
      //  }
    }

    public function adminApproveCompanyReq(Request $request)
    {
        if ($request->isMethod('post')) 
        {
           if(User::getEBossStaffTrue(Auth::id()) == true)
           {

           $reqId = $request->input('reqId');
           $rs = CompanyOwningRemoval::find($reqId);

                if($rs->request_type == 'own')
                {
                    $reqUserId = $rs->requester_user_id;
                    $companyIdToTake = $rs->subject_company_id;

                        $compToGet = CompanyProfile::find($companyIdToTake);
                        if($compToGet != null){
                            $compToGet->user_id = $reqUserId;
                            $okTransfer = $compToGet->save();
                            
                            $rs->request_stage = 2;
                            $rs->status = 0;
                            $rs->save();

                            if($okTransfer){
                            
                                $usr = User::find($reqUserId);
                                $urlvc = url('login');
                            
                                $subject = "Intellinze Request of Company Transfer";	
                                $content = "
                                Hi $usr->firstname,
                                <br /><br />
                    
                                You request to take ownership of a company has been approved,  <br />
                    
                                Company Name: $compToGet->company_name <br />
                                Description: $compToGet->description <br />
                            
                                <br />
                                To verify you may login to Intellinze and open 'Switch a Company' : $urlvc <br />
                                <br />

                                Thank you, <br />
                                Intellinze Admin
                                ";

                                //$usr->email
                                Mailbox::sendMail_v2($content, $usr->email, $subject, '');
                            }

                        }
                }

                if($rs->request_type == 'remove')
                {
                    $reqUserId = $rs->requester_user_id;
                    $companyIdToTake = $rs->subject_company_id;

                        $compToGet = CompanyProfile::find($companyIdToTake);
                        if($compToGet != null){
                         
                            $compToGet->status = 0;
                            $compToGet->save();

                            OpportunityBuildingCapability::where('company_id', $companyIdToTake)->update(['status' => 0]);
                            OpportunityBuy::where('company_id', $companyIdToTake)->update(['status' => 0]);
                            OpportunitySellOffer::where('company_id', $companyIdToTake)->update(['status' => 0]);

                            $rs->request_stage = 2;
                            $rs->status = 0;
                            $rs->save();
                        }

                }
           
           } else {
            return redirect('/home')->with('message', 'Sorry that was a restricted page.');
            exit;

           }

        }

    }

    public function adminRejectRequest(Request $request)
    {
        if ($request->isMethod('post')) 
        {
           if(User::getEBossStaffTrue(Auth::id()) == true)
           {
            $reqId = $request->input('reqId');
            $rs = CompanyOwningRemoval::find($reqId);
            if($rs != null){
                $rs->status = 0;
                $rs->save();
            }

           }
        }
    }
 
}