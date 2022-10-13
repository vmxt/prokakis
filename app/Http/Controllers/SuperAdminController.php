<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\RegistrationLinks;
use Auth;
use App\CompanyProfile;
use App\User;
use App\Buytoken;
use App\AuditLog;

class SuperAdminController extends Controller

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

    
     public function updateUserType(Request $request ){
         //if ($request->isMethod('post')) {
             if(null !== $request->input('userid') && null !== $request->input('type')){
                 $user = User::find($request->input('userid'));
                 $user->user_type = $request->input('type');
                 if($user->save()){
                    $log['error'] = false;
                    $log['type'] = $request->input('type');
                    AuditLog::ok(array(Auth::id(), 'user type', 'updated usertype ', 'updated the user type of:' . $request->input('userid') . " to:" . $request->input('type')));
                }
                else{
                    $log['error'] = true;
                    $log['type'] = "";
                }
                echo json_encode($log);
             }
             else{
                 $log['error'] = true;
                 $log['type'] = "";
                 echo json_encode($log);
             }
         //}
     }
  
   public function getTransferCompany(Request $request)
   {
      $companies = CompanyProfile::all();
      $usr = User::where('user_type', '1')->get();
      return view('admin.transferCompany', compact('companies', 'usr'));
   }

   public function addTokenSelectedCompany(Request $request)
   {  

    if($request->isMethod('post'))
    {
      $amountToken = $request->input('amountToken'); 
      $companiesList = $request->input('companiesList'); 
       //echo $amountToken . '  '.$companiesList;
       $cp = explode(",", $companiesList);
       if(sizeof($cp) > 0){
         $data = array();

          foreach($cp as $d)
          {
          // echo $d.'<br />';       
            
            $data['company_id']   = $d; 
            $data['num_tokens']   = $amountToken; 
            $data['amount']       = NULL;
            $data['paypal_id']    = 'ADDED-BY-SUPER-ADMIN'; 
            $data['paypal_token'] = 'ADDED-BY-SUPER-ADMIN';   

            Buytoken::AddToken($data); 
            $data = array();
          }
       }

    }

   }

   public function transferSelectedCompany(Request $request)
   {
    if($request->isMethod('post'))
    { 
      $usrId = $request->input('userId'); 
      $companies = $request->input('companies');
      //echo  $usrId. '  '.$companies;
      //exit;
      $company = explode(",", $companies);
      if(sizeof($company) > 0){

        foreach($company as $c){
          $rs = CompanyProfile::find($c);
           if($rs !=  null){
              $rs->user_id=$usrId;
              $rs->save();
           }
        }
      }

    }
   }
   
   public function selectedUserCompany(Request $request)
   {
    if($request->isMethod('post'))
    {
      $usrId = $request->input('userId'); 
      $cl = CompanyProfile::where('user_id', $usrId)->get();
      ?>
          
          <ul style="list-style-type: none;">

          <?php foreach($cl as $d){ ?>
                <li>

                <div class="md-checkbox">

<input type="checkbox" name="checkboxes1[]" value="<?php echo $d->id; ?>" id="checkbox_<?php echo $d->id; ?>" class="md-check" >
<label for="checkbox_<?php echo $d->id; ?>">
    <span class="inc"></span>
    <span class="check"></span>
    <span class="box"></span>
    <?php echo  substr($d->company_name, 0, 50); ?>
</label>
</div>
                
                <hr />
                </li>
              <?php } ?>

          </ul>
      <?php
    }
     
   }


   public function transferAjxCompany(Request $request)
   {
    if($request->isMethod('post'))
    {
      $usrId = $request->input('userId'); 
      $usr = User::find($usrId);
      $allUsr = User::where('user_type', '=', '1')->get();
      ?>
      <div class="alert bg-intellinz-light-green text-dark" style=" overflow: hidden; margin-left: 0px !important;">
      <p>
      User account <strong class="text-company"><?php echo $usr->firstname .', '.$usr->lastname; ?></strong> 
        is the end receiver of the company that would be selected for transfer.
      </p>
      </div>

      <table style="width:100%;" class="table table-striped table-bordered table-hover order-column" cellpadding="5" cellspacing="5"> 
      <tr>
        <th style="width:60%">Select a user account to load companies.</th>
      
        <th style="width:40%">Select company to transfer.</th>
        
      </tr>
      <tr>
          <td> 
            <select class="multi-select form-control" id="usersList" size="15"  onchange="usrCompany(this)"> 
              <?php foreach($allUsr as $d){ ?>
                <option value="<?php echo $d->id; ?>"><?php echo  substr($d->firstname.'-'.$d->lastname.'-'.$d->email, 0, 50); ?></option>
              <?php } ?>
            </select>
          </td>
       

          <td>
            <div id="usrCompanyList" style="width:200px;"></div>
         </td>
      </tr>  
      </table>
      <?php

    }

   } 

   public function addAjxCompany(Request $request)
   { 

    if($request->isMethod('post'))
    {
      $usrId = $request->input('userId'); 
      $cc = CompanyProfile::where('user_id', $usrId)->count();
      if($cc > 0)
      {
        $cl = CompanyProfile::where('user_id', $usrId)->get();
        $usr = User::find($usrId);
        ?>

      <div class="alert bg-intellinz-light-green text-dark" style=" overflow: hidden; margin-left: 0px !important;">
      <p>
      User account <strong class="text-company"><?php echo $usr->firstname .', '.$usr->lastname; ?></strong> 
        is the owner of the following companies.
      </p>
      </div>

          <table  class="table table-striped table-bordered table-hover order-column" cellpadding="5" cellspacing="5"> 
          <tr>
            <th style="width:60%">Company List</th>
            <th style="width:40%">Credit</th>
       
          </tr>
          <tr>
              <td> 
              <ul style="list-style-type: none;">
              <?php foreach($cl as $d){ ?>
                <li>
                <div class="md-checkbox">
                <input type="checkbox" name="checkboxes1[]" value="<?php echo $d->id; ?>" id="checkbox_<?php echo $d->id; ?>" class="md-check" >
                <label for="checkbox_<?php echo $d->id; ?>">
                    <span class="inc"></span>
                    <span class="check"></span>
                    <span class="box"></span>
                    <?php echo  substr($d->company_name, 0, 50); ?>
                </label>
                </div>
                <hr />
                </li>
              <?php } ?>
              </ul>
              </td>

              <td>
                <input type="text" class="form-control" placeholder="Credit Amount Here" name="companyAmount" id="companyAmount">
              </td>  
          </tr>  
          </table>
         <?php
        }
       
    }
   
   }

   public function viewAjxCompany(Request $request)
   {
      if($request->isMethod('post'))
      {
        $usrId = $request->input('userId'); 
        $cc = CompanyProfile::where('user_id', $usrId)->count();
        if($cc > 0)
        {
          $dc = CompanyProfile::where('user_id', $usrId)->get();
          $usr = User::find($usrId);
          ?>
           <div class="portlet-title">
            <?php echo '<span class="list-datetime bold uppercase font-green">'.$usr->firstname.'  '.$usr->lastname.'</span>,     '.$usr->email; ?>         
            </div>
                  <div class="portlet-body">
                        <div class="mt-element-list">
                            <div class="mt-list-head list-news bg-dark text-company">
                                <div class="list-head-title-container">
                                    <span class="badge badge-danger pull-right"><?php echo sizeof($dc); ?></span>
                                    <h4 class="list-title">Company List</h4>
                                </div>
                            </div>
                            <div class="mt-list-container list-news">

            <ul>
          <?php
          foreach($dc as $d)
          {
          ?>  
          
         
                                                <li class="mt-list-item">
                                                    <div class="list-icon-container">
                                                        <a href="javascript:;">
                                                            <i class="fa fa-angle-right"></i>
                                                        </a>
                                                    </div>
                                                    <div class="list-datetime bold uppercase font-green"><a href="javascript:;"><?php echo $d->company_name; ?></a></div>
                                                    <div class="list-item-content">
                                                       <!-- <h3 class="uppercase">
                                                            <?php //echo $d->company_name; ?></a>
                                                        </h3> -->
                                                        <p><?php echo $d->description; ?></p>
                                                    </div>
                                                </li>
          <?php 
            } 
           ?>
             </ul>

             </div>
            </div>
            </div>  
           <?php
          }
         
      }
 
    }



    public function getTokenCompany(Request $request)
    {
      return view('admin.transferCompany');
    }
    

    public function approvalPage()
    {

      //$rs = User::whereIn('user_type', array(1, 2, 3, 4))->get();

      $rs = User::whereIn('user_type', array(1, 2, 3, 4))->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->get();

      return view('admin.approvalaccounts', compact('rs')); 

    }

    public function storeApproval(Request $request)
    {

        if($request->isMethod('post'))

        {

          $user_status = $request->input('user_status');

          $user_id =  $request->input('user_id');

          $rs = User::find($user_id);  

           if($rs != null){

            $rs->status = $user_status;

            $ok = $rs->save();

                if($ok){

                   return redirect('/accounts-approval')->with('status', 'User been succesfully updated.');

                }

           } else {

                 return redirect('/accounts-approval')->with('message', 'There was an error in updating the user.'); 

           } 

        }

    }

    public function allCompanies(Request $request)
    {

     $rs =  DB::table('company_profiles')

            ->leftjoin('users', 'users.id', '=', 'company_profiles.user_id')

            ->select('*')

            ->where('users.status', '1')    

            ->get();



      return view('admin.companies', compact('rs'));

             

    }

    public function manageLinks()
    {

      $rs = RegistrationLinks::all();

      return view('admin.registrationlinks', compact('rs'));

    }

    public function addLinks(Request $request)
    {

      if($request->isMethod('post'))

      {

       $user_id = Auth::id();



       $userType = $request->input('user_type'); 

       $category = '';

       $link = '';

       $token = RegistrationLinks::generateToken();



        if($userType == '0')

        {

          return redirect('/manage-registration-links')->with('message', 'Please select a category.'); 

          exit; 

        } elseif($userType == '2')

        {

          $category = 'Sub-Con';

          $link = url('/register-personnel/'.$category.'/'.$token);



        } elseif($userType == '3')

        {

          $category = 'Mas-Con';

          $link = url('/register-personnel/'.$category.'/'.$token);



        } elseif($userType == '4')

        {

          $category = 'Eboss-Staff';

          $link = url('/register-personnel/'.$category.'/'.$token);

        } 



        $ok = RegistrationLinks::create([

          'category' => $category, 

          'link'     => $link, 

          'status'   => 1, 

          'token'    => $token, 

          'created_at' => date('Y-m-d'), 

          'created_by' => $user_id,

        ]);

        

        if($ok){

          return redirect('/manage-registration-links')->with('status', 'You have suucessfully added the link.'); 

        }



      }

     

    }

}

