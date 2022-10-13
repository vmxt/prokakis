<?php
namespace App\Http\Controllers;

use App\AuditLog;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Routing\UrlGenerator;

use App\CompanyProfile;

use App\User;
use PDF;
use App\XeroCompanyInfo;
use App\XeroConnection;
use App\XeroTokenInfo;
use App\XeroScopes;
use App\XeroFeaturesAccess;
use Response;
use Auth;
use App\Mailbox;
use App\XeroAgreement;
use App\XeroBalanceSheet;
use App\XeroProfitLoss;
use App\XeroTrialBalance;
use App\XeroTenantId;

use Symfony\Component\Intl\Currencies;

class XeroController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }
    
    public function bd_nice_number($n) {
        
        $n = (0+str_replace(",","",$n));
       
        if(!is_numeric($n)) return false;
       
        if($n>1000000000000) return round(($n/1000000000000),1).'T';
        else if($n>1000000000) return round(($n/1000000000),1).' B';
        else if($n>1000000) return round(($n/1000000),1).'M';
        else if($n>1000) return round(($n/1000),1).'K';
       
        return number_format($n);
    }

    public function tryDisconnectXero()
    {
        $user_id = Auth::id();
        $company_id = CompanyProfile::getCompanyId($user_id);

        $user_profile = User::find($user_id);

        $message = "
				  To confirm your desire to disconnect your Intellinz Account to XERO, please click the link below:
				  
				  <a href='" . env("APP_URL") . "company/disconnectXero/" . base64_encode($user_id) . "'>" . env("APP_URL") . "company/disconnectXero/" . base64_encode($user_id) . "'</a>

                  Best Regards, <br />

                  Intellinz Web Admin
                  ";

        Mailbox::sendMail($message, $user_profile->email, "Confirmation to disconnect your Intellinz Account to XERO.", "");
        return redirect('profile/edit')
            ->with('status', 'To confirm the disconnection, please click the link we sent to your email. Thank you!.');
    }

    public function disconnectXero(Request $request)
    {
        if (isset($request["id"]))
        {
            $user_id = base64_decode($request["id"]);
            $company_id = CompanyProfile::getCompanyId($user_id);

            $con_dc = XeroConnection::where('company_id', "=", $company_id)->update(array(
                'status' => 0
            ));
            if ($con_dc)
            {
                return redirect('profile/edit')->with('message', 'Successfully disconnected to XERO.');
            }
        }
    }

    public function changeOrganisation(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if ($request->input('id') != "")
            {

                $tenant_info = XeroTenantId::where("id", "=", $request->input('id'))
                    ->first();
                XeroTenantId::where('token_id', "=", $tenant_info->token_id)
                    ->update(array(
                    'status' => 0
                ));

                $tenant_info->status = 1;
                if ($tenant_info->save())
                {
                    $log['error'] = false;
                }
                else
                {
                    $log['error'] = true;
                }
                echo json_encode($log);
            }
        }
    }

    public function saveConnection(Request $request)
    {

        $user_id = Auth::id();
        $company_id = CompanyProfile::getCompanyId($user_id);

        if ($request->isMethod('post'))
        {

            if ($request->input('client_id_txt') != "" && $request->input('secret_id_txt') != "")
            {

                $provider = new \League\OAuth2\Client\Provider\GenericProvider(['clientId' => $request->input('client_id_txt') , 'clientSecret' => $request->input('secret_id_txt') , 'redirectUri' => env("APP_URL") . 'company/goXeroAnalytics', 'urlAuthorize' => 'https://login.xero.com/identity/connect/authorize', 'urlAccessToken' => 'https://identity.xero.com/connect/token', 'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation']);

                // Scope defines the data your app has permission to access.
                // Learn more about scopes at https://developer.xero.com/documentation/oauth2/scopes
                $email_scope = isset($_POST['email']) ? join(" ", $_POST['email']) : "";
                $accountingtransactions_scope = isset($_POST['accountingtransactionschoice']) ? join(" ", $_POST['accountingtransactionschoice']) : "";
                $accountingreportsread_scope = isset($_POST['accountingreportsread']) ? join(" ", $_POST['accountingreportsread']) : "";
                $accountingcontacts_scope = isset($_POST['accountingcontactschoice']) ? join(" ", $_POST['accountingcontactschoice']) : "";

                $scopes = $email_scope . " " . $accountingtransactions_scope . " " . $accountingreportsread_scope . " " . $accountingcontacts_scope;

                $accountingtransactions_access = isset($_POST['accountingtransactionaccess']) ? join(",", $_POST['accountingtransactionaccess']) : "";
                $accountingreportsread_access = isset($_POST['accountingreportsreadaccess']) ? join(",", $_POST['accountingreportsreadaccess']) : "";
                $accountingcontacts_access = isset($_POST['accountingcontactsaccess']) ? join(",", $_POST['accountingcontactsaccess']) : "";

                $options = ['scope' => ['openid profile offline_access accounting.settings ' . $scopes]];

                // This returns the authorizeUrl with necessary parameters applied (e.g. state).
                $authorizationUrl = $provider->getAuthorizationUrl($options);

                // Save the state generated for you and store it to the session.
                // For security, on callback we compare the saved state with the one returned to ensure they match.
                if ($provider->getState())
                {
                    session_start();
                    $_SESSION['oauth2state'] = $provider->getState();

                    /*$oldxero = XeroConnection::where('company_id', "=", $company_id)->first();
                      $oldxero->status = "0";
                      $oldxero->save();*/

                    XeroConnection::where('company_id', "=", $company_id)->update(array(
                        'status' => 0,
                        'if_process' => 1
                    ));

                    $ok = XeroConnection::create(['company_id' => $company_id, 'client_id' => $request->input('client_id_txt') , 'secret_id' => $request->input('secret_id_txt') , 'status' => "0", 'agreement_id' => isset($_POST['xeroiagree']) ? join("", $_POST['xeroiagree']) : "0"]);

                    if ($ok)
                    {
                        $scope_id = XeroScopes::create(['connection_id' => $ok->id, 'scope' => 'openid profile offline_access ' . $scopes])->id;

                        XeroFeaturesAccess::create(['scope_id' => $scope_id, 'access' => $accountingtransactions_access . "," . $accountingreportsread_access . "," . $accountingcontacts_access]);

                        return redirect($authorizationUrl);
                    }
                }
            }
        }
        else
        {
            echo "please stop!";
        }
    }

    public static function checkIfConnected()
    {
        $user_id = Auth::id();
        $company_id = CompanyProfile::getCompanyId($user_id);

        $xero = XeroConnection::where('company_id', "=", $company_id)->where('status', "=", "1")
            ->where('if_process', "=", "1")
            ->first();

        if (count((array)$xero) > 0)
        {
            return $xero;
        }
        else
        {
            return null;
        }
    }

    public function index()
    {
        return view("company.companychart");
    }

    public function downloadAsPDF(Request $request)
    {
        if (isset($request["type"]) && isset($request["id"]))
        {

            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $id = $request["id"];

                try
                {
                    if ($request["type"] == "invoice")
                    {
                        $result = $apiInstance->getInvoiceAsPdf($xeroTenantId, $id);
                    }

                    if ($request["type"] == "quotes")
                    {
                        $result = $apiInstance->getQuoteAsPdf($xeroTenantId, $id);
                    }

                    if ($request["type"] == "po")
                    {
                        $result = $apiInstance->getPurchaseOrderAsPdf($xeroTenantId, $id);
                    }

                    $content = $result->fread($result->getSize());
                    $filename = $request["type"] . "-" . $result->getFileName() . time() . ".pdf";

                    file_put_contents(public_path('report_downloads/' . $filename) , $content);

                    $headers = ['Access-Control-Allow-Origin' => '*', 'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, PATCH, DELETE', 'Access-Control-Allow-Headers' => 'Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Authorization , Access-Control-Request-Headers', 'Content-Type' => 'application/pdf', 'Content-Disposition' => 'inline'];
                    $response = response()->download(public_path('report_downloads/' . $filename) , $filename . ".pdf", $headers)->deleteFileAfterSend(true);
                    return $response;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getAsPdf: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getInvoices(Request $request)
    {
        if (isset($request["status"]) && isset($request["type"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $ifModifiedSince = "";
                $where = 'Status=="' . $request["status"] . '" && Type=="'.$request["type"].'"';
                $order = "";
                $iDs = "";
                $invoiceNumbers = "";
                $contactIDs = "";
                $statuses = "";
                $page = 1;
                $includeArchived = true;
                $createdByMyApp = false;
                $unitdp = 4;
                $summaryOnly = true;

                $table_data = "";

                try
                {
                    $result = $apiInstance->getInvoices($xeroTenantId, $ifModifiedSince, $where, $order, $iDs, $invoiceNumbers, $contactIDs, $statuses, $page, $includeArchived, $createdByMyApp, $unitdp, $summaryOnly);

                    $arr = json_decode($result, true);

                    foreach ($arr as $value)
                    {
                        if (count($value) > 0)
                        {
                            foreach ($value as $main_value)
                            {
                                $table_data .= '<tr>';
                                
                                $in_no = $main_value["InvoiceNumber"];
                                if(!isset($main_value["InvoiceNumber"]) || $main_value["InvoiceNumber"] == ""){
                                    $in_no = "No Invoice Number";
                                }
                                
                                $table_data .= '<td><a class="invoices_a" name="' . $main_value["InvoiceID"] . '">' . $in_no . '</a></td>';
                                $table_data .= '<td>' . (isset($main_value["Reference"]) ? $main_value["Reference"] : "") . '</td>';
                                $table_data .= '<td>' . (isset($main_value["Contact"]["Name"]) ? $main_value["Contact"]["Name"] : "") . '</td>';

                                $table_data .= '<td>';
                                if (isset($main_value['Date']))
                                {
                                    $date = str_replace('/Date(', '', $main_value['Date']);
                                    $parts = explode('+', $date);
                                    $table_data .= date("M-d-Y", $parts[0] / 1000);
                                }
                                $table_data .= '</td>';
                                $table_data .= '<td>';
                                if (isset($main_value['DueDate']))
                                {
                                    $date = str_replace('/Date(', '', $main_value['DueDate']);
                                    $parts = explode('+', $date);
                                    $table_data .= date("M-d-Y", $parts[0] / 1000);
                                }
                                $table_data .= '</td>';

                                $table_data .= '<td class="amount_css">' . number_format($main_value["Total"], 2) . '</td>';
                                $table_data .= '</tr>';
                            }
                        }

                    }

                    return $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getQuotes(Request $request)
    {
        if (isset($request["status"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $ifModifiedSince = "";
                $dateFrom = "";
                $dateTo = "";
                $expiryDateFrom = "";
                $expiryDateTo = "";
                $contactID = "";
                $status = $request["status"];
                $page = 1;
                $order = "";
                $quoteNumber = "";

                $table_data = "";

                try
                {
                    $result = $apiInstance->getQuotes($xeroTenantId, $ifModifiedSince, $dateFrom, $dateTo, $expiryDateFrom, $expiryDateTo, $contactID, $status, $page, $order, $quoteNumber);

                    $arr = json_decode($result, true);

                    foreach ($arr as $value)
                    {
                        if (count($value) > 0)
                        {
                            foreach ($value as $main_value)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td><a class="quotes_a" name="' . $main_value["QuoteID"] . '">' . $main_value["QuoteNumber"] . '</a></td>';
                                $table_data .= '<td>' . $main_value["Reference"] . '</td>';
                                $table_data .= '<td>' . $main_value["Contact"]["Name"] . '</td>';

                                $table_data .= '<td>';
                                if (isset($main_value['Date']))
                                {
                                    $date = str_replace('/Date(', '', $main_value['Date']);
                                    $parts = explode(')', $date);
                                    $table_data .= date("M-d-Y", $parts[0] / 1000);
                                }
                                $table_data .= '</td>';
                                $table_data .= '<td>';
                                if (isset($main_value['ExpiryDate']))
                                {
                                    $date = str_replace('/Date(', '', $main_value['ExpiryDate']);
                                    $parts = explode(')', $date);
                                    $table_data .= date("M-d-Y", $parts[0] / 1000);
                                }
                                $table_data .= '</td>';

                                $table_data .= '<td class="amount_css">' . number_format($main_value["Total"], 2) . '</td>';
                                $table_data .= '</tr>';
                            }
                        }

                    }

                    return $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getQuotes: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getPurchaseOrders(Request $request)
    {
        if (isset($request["status"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $ifModifiedSince = "";
                $status = $request["status"];
                $dateFrom = "";
                $dateTo = "";
                $order = "";
                $page = 1;

                $table_data = "";

                try
                {
                    $result = $apiInstance->getPurchaseOrders($xeroTenantId, $ifModifiedSince, $status, $dateFrom, $dateTo, $order, $page);

                    $arr = json_decode($result, true);

                    foreach ($arr as $value)
                    {
                        if (count($value) > 0)
                        {
                            foreach ($value as $main_value)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td><a class="po_a" name="' . $main_value["PurchaseOrderID"] . '">' . $main_value["PurchaseOrderNumber"] . '</a></td>';
                                $table_data .= '<td>' . $main_value["Reference"] . '</td>';
                                $table_data .= '<td>' . $main_value["Contact"]["Name"] . '</td>';

                                $table_data .= '<td>';
                                if (isset($main_value['Date']))
                                {
                                    $date = str_replace('/Date(', '', $main_value['Date']);
                                    $parts = explode('+', $date);
                                    $table_data .= date("M-d-Y", $parts[0] / 1000);
                                }
                                $table_data .= '</td>';
                                $table_data .= '<td>';
                                if (isset($main_value['DeliveryDate']))
                                {
                                    $date = str_replace('/Date(', '', $main_value['DeliveryDate']);
                                    $parts = explode('+', $date);
                                    $table_data .= date("M-d-Y", $parts[0] / 1000);
                                }
                                $table_data .= '</td>';

                                $table_data .= '<td class="amount_css">' . number_format($main_value["Total"], 2) . '</td>';
                                $table_data .= '</tr>';
                            }
                        }

                    }

                    return $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getPurchaseOrders: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getManualJournal(Request $request)
    {
        if (isset($request["status"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $where = 'Status=="' . $request["status"] . '"';

                $ifModifiedSince = "";
                $order = "Date DESC";
                $page = 1;

                $table_data = "";

                try
                {
                    $result = $apiInstance->getManualJournals($xeroTenantId, $ifModifiedSince, $where, $order, $page);

                    $arr = json_decode($result, true);

                    foreach ($arr as $value)
                    {
                        if (count($value) > 0)
                        {
                            foreach ($value as $main_value)
                            {

                                $table_data .= '<tr>';
                                $table_data .= '<td><a class="narration_a" name="' . $main_value["ManualJournalID"] . '">' . $main_value["Narration"] . '</a></td>';
                                $table_data .= '<td>';

                                if (isset($main_value['Date']))
                                {
                                    $date = str_replace('/Date(', '', $main_value['Date']);
                                    $parts = explode('+', $date);
                                    $table_data .= date("M-d-Y", $parts[0] / 1000);
                                }
                                $table_data .= '</td>';

                                $debit = 0;
                                $credit = 0;
                                foreach ($main_value['JournalLines'] as $journal_lines)
                                {

                                    if ($journal_lines["LineAmount"] > 0)
                                    {
                                        $debit += $journal_lines["LineAmount"];
                                    }
                                    else
                                    {
                                        $credit += $journal_lines["LineAmount"];
                                    }
                                }

                                $table_data .= '<td class="amount_css">' . number_format($debit, 2) . '</td>';
                                $table_data .= '<td class="amount_css">' . number_format($credit , 2) . '</td>';
                                $table_data .= '</tr>';
                            }
                        }

                    }

                    return $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getManualJournals: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getItems(Request $request)
    {
        //if(isset($request["status"])){
        if (XeroController::checkIfExpires() == "ok")
        {

            $xero_info = XeroController::checkIfConnected();
            $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                ->where("status", "=", "1")
                ->first();

            $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
            $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
            $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                ->where("status", "=", "1")
                ->first();
            $xeroTenantId = (string)$tenant_info->tenant_id;

            $ifModifiedSince = "";
            $where = "";
            $order = "";
            $unitdp = 4;

            $table_data = "";

            try
            {
                $result = $apiInstance->getItems($xeroTenantId, $ifModifiedSince, $where, $order, $unitdp);

                $arr = json_decode($result, true);

                foreach ($arr as $value)
                {
                    if (count($value) > 0)
                    {
                        foreach ($value as $main_value)
                        {

                            $table_data .= '<tr>';
                            $table_data .= '<td><a class="narration_a" name="' . $main_value["ItemID"] . '">' . $main_value["Code"] . '</a></td>';
                            $table_data .= '<td>' . $main_value["Name"] . '</td>';

                            $table_data .= '<td class="amount_css">';
                            if (isset($main_value["PurchaseDetails"]["UnitPrice"]))
                            {
                                $table_data .= number_format($main_value["PurchaseDetails"]["UnitPrice"]);
                            }
                            $table_data .= '</td>';

                            $table_data .= '<td class="amount_css">';
                            if (isset($main_value["SalesDetails"]["UnitPrice"]))
                            {
                                $table_data .= number_format($main_value["SalesDetails"]["UnitPrice"]);
                            }
                            $table_data .= '</td>';

                            $table_data .= '<td class="amount_css"></td>';
                            $table_data .= '</tr>';
                        }
                    }

                }

                return $table_data;

            }
            catch(Exception $e)
            {
                echo 'Exception when calling AccountingApi->getItems: ', $e->getMessage() , PHP_EOL;
            }
        }
        //}
        
    }

    public function loadTrialBalance(Request $request)
    {
        if (isset($request["date"]) && isset($request["if_payment"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $date = $request["date"];
                $paymentsOnly = $request["if_payment"];

                $table_data = "";

                try
                {
                    if (isset($request["id"]) && $request["id"] != "not")
                    {
                        $qresult = XeroTrialBalance::where("id", "=", base64_decode($request["id"]))->first();
                        $result = $qresult["json_content"];
                        $title = $qresult["title"];
                        $description = $qresult["description"];
                        $bsid = $qresult["id"];
                    }
                    else
                    {
                        $result = $apiInstance->getReportTrialBalance($xeroTenantId, $date, $paymentsOnly);
                        $title = "";
                        $description = "";
                        $bsid = "";
                    }

                    $arr = json_decode($result, true);

                    foreach ($arr as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                if ($main_value["RowType"] == "Header")
                                {
                                    $table_data .= '<tr>';
                                    $cc = 0;
                                    foreach ($main_value["Cells"] as $cells)
                                    {
                                        $align_right = "";
                                        if ($cc > 0)
                                        {
                                            $align_right = "amount_css";
                                        }
                                        $cc++;
                                        $table_data .= '<td class="' . $align_right . '">' . $cells["Value"] . '</td>';
                                    }
                                    $table_data .= '</tr>';
                                }

                                if ($main_value["RowType"] == "Section")
                                {
                                    $table_data .= '<tr>';
                                    $table_data .= '<td colspan="5"><b>' . (isset($main_value["Title"]) ? $main_value["Title"] : "") . '</b></td>';
                                    $table_data .= '</tr>';

                                    foreach ($main_value["Rows"] as $main_row)
                                    {
                                        if ($main_row["RowType"] == "Row")
                                        {
                                            $table_data .= '<tr>';
                                            $cc = 0;
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                $align_right = "";
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    $align_right = "amount_css";
                                                    if ($main_cells["Value"] != "")
                                                    {
                                                        $value = number_format($main_cells["Value"], 2);
                                                    }
                                                }
                                                $cc++;
                                                $table_data .= '<td style="padding-left:20px" class="' . $align_right . '">' . $value . '</td>';
                                            }
                                            $table_data .= '</tr>';
                                        }

                                        if ($main_row["RowType"] == "SummaryRow")
                                        {
                                            $table_data .= '<tr>';
                                            $cc = 0;
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                $align_right = "";
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    $align_right = "amount_css";
                                                    if ($main_cells["Value"] != "")
                                                    {
                                                        $value = number_format($main_cells["Value"], 2);
                                                    }
                                                }
                                                $cc++;
                                                $table_data .= '<td class="' . $align_right . '"><b>' . $value . '</b></td>';
                                            }
                                            $table_data .= '</tr>';
                                        }
                                    }
                                }
                            }

                        }

                    }

                    return $table_data . "<split>" . $title . "<split>" . $description . "<split>" . $bsid;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getReportTrialBalance: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function loadProfitAndLoss(Request $request)
    {
        if (isset($request["fromdate"]) && isset($request["todate"]) && isset($request["period"]) && isset($request["timeframe"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $fromDate = $request["fromdate"];
                $toDate = $request["todate"];
                
                $periods = "";
                $timeframe = "";
                
                if($request["period"] > 0){
                    $periods = $request["period"];
                    $timeframe = $request["timeframe"];
                }
                
                $trackingCategoryID = "";
                $trackingCategoryID2 = "";
                $trackingOptionID = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = false;

                $table_data = "";

                try
                {
                    if (isset($request["id"]) && $request["id"] != "not")
                    {
                        $qresult = XeroProfitLoss::where("id", "=", base64_decode($request["id"]))->first();
                        $result = $qresult["json_content"];
                        $title = $qresult["title"];
                        $description = $qresult["description"];
                        $bsid = $qresult["id"];
                    }
                    else
                    {
                        $title = "";
                        $description = "";
                        $bsid = "";
                        $result = $apiInstance->getReportProfitAndLoss($xeroTenantId, $fromDate, $toDate, $periods, $timeframe, $trackingCategoryID, $trackingCategoryID2, $trackingOptionID, $trackingOptionID2, $standardLayout, $paymentsOnly);
                    }

                    $arr = json_decode($result, true);

                    foreach ($arr as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                if ($main_value["RowType"] == "Header")
                                {
                                    $table_data .= '<tr>';
                                    $cc = 0;
                                    foreach ($main_value["Cells"] as $cells)
                                    {
                                        $align_right = "";
                                        if ($cc > 0)
                                        {
                                            $align_right = "amount_css";
                                        }
                                        $cc++;
                                        $table_data .= '<td class="' . $align_right . '">' . $cells["Value"] . '</td>';
                                        
                                        if($periods == "" && $cc >= 2){
                                            break;
                                        }
                                    }
                                    $table_data .= '</tr>';
                                }

                                if ($main_value["RowType"] == "Section")
                                {
                                    $table_data .= '<tr>';
                                    $table_data .= '<td colspan="5"><b>' . (isset($main_value["Title"]) ? $main_value["Title"] : "") . '</b></td>';
                                    $table_data .= '</tr>';

                                    foreach ($main_value["Rows"] as $main_row)
                                    {
                                        if ($main_row["RowType"] == "Row")
                                        {
                                            $table_data .= '<tr>';
                                            $cc = 0;
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                $align_right = "";
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    $align_right = "amount_css";
                                                    if ($main_cells["Value"] != "")
                                                    {
                                                        $value = number_format($main_cells["Value"], 2);
                                                    }
                                                }
                                                $cc++;
                                                $table_data .= '<td style="padding-left:20px" class="' . $align_right . '">' . $value . '</td>';
                                                
                                                if($periods == "" && $cc >= 2){
                                                    break;
                                                }
                                            }
                                            $table_data .= '</tr>';
                                        }

                                        if ($main_row["RowType"] == "SummaryRow")
                                        {
                                            $table_data .= '<tr>';
                                            $cc = 0;
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                $align_right = "";
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    $align_right = "amount_css";
                                                    if ($main_cells["Value"] != "")
                                                    {
                                                        $value = number_format($main_cells["Value"], 2);
                                                    }
                                                }
                                                $cc++;
                                                $table_data .= '<td class="' . $align_right . '"><b>' . $value . '</b></td>';
                                                
                                                if($periods == "" && $cc >= 2){
                                                    break;
                                                }
                                            }
                                            $table_data .= '</tr>';
                                        }
                                    }
                                }
                            }

                        }

                    }

                    return $table_data . "<split>" . $title . "<split>" . $description . "<split>" . $bsid;;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getReportTrialBalance: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function loopArray($array, $desire_index)
    {
        foreach ($array as $name => $value)
        {
            if ($name == $desire_index)
            {
                return $value;
                break;
            }
        }
    }

    public function loadBalanceSheet(Request $request)
    {
        if (isset($request["date"]) && isset($request["period"]) && isset($request["ptype"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $date = $request["date"];
                $periods = "";
                $timeframe = "";
                if($request["period"] > 0){
                    $timeframe = $request["ptype"];
                    $periods = $request["period"];
                }
                
                $trackingOptionID1 = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = false;

                $table_data = "";

                $title = "";
                $description = "";
                $bsid = "";

                try
                {
                    if (isset($request["id"]) && $request["id"] != "not")
                    {
                        $qresult = XeroBalanceSheet::where("id", "=", base64_decode($request["id"]))->first();
                        $result = $qresult["json_content"];
                        $title = $qresult["title"];
                        $description = $qresult["description"];
                        $bsid = $qresult["id"];
                    }
                    else
                    {
                        $title = "";
                        $description = "";
                        $bsid = "";
                        $result = $apiInstance->getReportBalanceSheet($xeroTenantId, $date, $periods, $timeframe, $trackingOptionID1, $trackingOptionID2, $standardLayout, $paymentsOnly);
                    }
                    $arr = json_decode($result, true);

                    foreach ($arr as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                if ($main_value["RowType"] == "Header")
                                {
                                    $table_data .= '<tr>';
                                    $cc = 0;
                                    foreach ($main_value["Cells"] as $cells)
                                    {
                                        $align_right = "";
                                        if ($cc > 0)
                                        {
                                            $align_right = "amount_css";
                                        }
                                        $cc++;
                                        $table_data .= '<td class="' . $align_right . '">' . $cells["Value"] . '</td>';
                                        
                                        if($periods == "" && $cc >= 2){
                                            break;
                                        }
                                    }
                                    $table_data .= '</tr>';
                                }

                                if ($main_value["RowType"] == "Section")
                                {
                                    $table_data .= '<tr>';
                                    $table_data .= '<td colspan="5"><b>' . (isset($main_value["Title"]) ? $main_value["Title"] : "") . '</b></td>';
                                    $table_data .= '</tr>';

                                    foreach ($main_value["Rows"] as $main_row)
                                    {
                                        if ($main_row["RowType"] == "Row")
                                        {
                                            $table_data .= '<tr>';
                                            $cc = 0;
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                $align_right = "";
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    $align_right = "amount_css";
                                                    if ($main_cells["Value"] != "")
                                                    {
                                                        $value = number_format($main_cells["Value"] , 2);
                                                    }
                                                }
                                                else
                                                {
                                                    $acc_id = "";
                                                    if (isset($main_cells["Attributes"]))
                                                    {
                                                        foreach ($main_cells["Attributes"] as $value)
                                                        {
                                                            $acc_id = $value["Value"];
                                                        }
                                                    }
                                                    $value = '<a name="' . $acc_id . '" class="account_det_a">' . $main_cells["Value"] . "</a>";
                                                }
                                                $cc++;
                                                $table_data .= '<td style="padding-left:20px" class="' . $align_right . '">' . $value . '</td>';
                                                
                                                if($periods == "" && $cc >= 2){
                                                    break;
                                                }
                                            }
                                            $table_data .= '</tr>';
                                        }

                                        if ($main_row["RowType"] == "SummaryRow")
                                        {
                                            $table_data .= '<tr>';
                                            $cc = 0;
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                $align_right = "";
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    $align_right = "amount_css";
                                                    if ($main_cells["Value"] != "")
                                                    {
                                                        $value = number_format($main_cells["Value"] , 2);
                                                    }
                                                }
                                                $cc++;
                                                $table_data .= '<td class="' . $align_right . '"><b>' . $value . '</b></td>';
                                                
                                                if($periods == "" && $cc >= 2){
                                                    break;
                                                }
                                            }
                                            $table_data .= '</tr>';
                                        }
                                    }
                                }
                            }

                        }

                    }

                    return $table_data . "<split>" . $title . "<split>" . $description . "<split>" . $bsid;

                }
                catch(Exception $e)
                {
                    echo "fdsfadsfsd bleee";
                }
            }
        }
    }

    public function getContactList(Request $request)
    {
        if (isset($request["status"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                //get invoices due > 0
                
                $ifModifiedSince = "";
                $where = 'AmountDue > 0 && Status=="AUTHORISED"';
                $order = "";
                $iDs = "";
                $invoiceNumbers = "";
                $contactIDs = "";
                $statuses = "";
                $page = "";
                $includeArchived = true;
                $createdByMyApp = false;
                $unitdp = 4;
                $summaryOnly = false;
                
                $payables_array = array();
                $receivables_array = array();
                
                try {
                  $result = $apiInstance->getInvoices($xeroTenantId, $ifModifiedSince, $where, $order, $iDs, $invoiceNumbers, $contactIDs, $statuses, $page, $includeArchived, $createdByMyApp, $unitdp, $summaryOnly);
                  $arr = json_decode($result, true);
                  foreach ($arr as $value)
                  {
                      if (count($value) > 0)
                        {
                            foreach ($value as $main_value)
                            {
                                if($main_value["Type"] == "ACCREC"){
                                    if(!isset($receivables_array[$main_value["Contact"]["ContactID"]])){
                                        $receivables_array[$main_value["Contact"]["ContactID"]] = 1;
                                    }
                                    
                                    $receivables_array[$main_value["Contact"]["ContactID"]] += $main_value["AmountDue"];
                                }
                                
                                if($main_value["Type"] == "ACCPAY"){
                                    if(!isset($payables_array[$main_value["Contact"]["ContactID"]])){
                                        $payables_array[$main_value["Contact"]["ContactID"]] = 0;
                                    }
                                    
                                    $payables_array[$main_value["Contact"]["ContactID"]] += $main_value["AmountDue"];
                                }
                            }
                        }
                  }
                  
                } catch (Exception $e) {
                  echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage(), PHP_EOL;
                }
                
                //contact list
                $ifModifiedSince = "";
                $where = '';

                if ($request["status"] == "customers")
                {
                    $where .= 'IsCustomer=true';
                }

                if ($request["status"] == "suppliers")
                {
                    $where .= 'IsSupplier=true';
                }

                $order = "";
                $iDs = "";
                $page = 1;
                $includeArchived = false;
                $summaryOnly = false;
                $searchTerm = "";

                $table_data = "";

                try
                {
                    $result = $apiInstance->getContacts($xeroTenantId, $ifModifiedSince, $where, $order, $iDs, $page, $includeArchived, $summaryOnly, $searchTerm);

                    $arr = json_decode($result, true);
                    
                    foreach ($arr as $value)
                    {
                        if (count($value) > 0)
                        {
                            foreach ($value as $main_value)
                            {
                                $name = $main_value["Name"];
                                if($name == ""){
                                    $name = "No Name";
                                }
                                
                                $payables = 0;
                                $receivables = 0;
                                if(isset($payables_array[$main_value["ContactID"]])){
                                    $payables = $payables_array[$main_value["ContactID"]];
                                }
                                
                                if(isset($receivables_array [$main_value["ContactID"]])){
                                    $receivables = $receivables_array [$main_value["ContactID"]];
                                }
                                
                                $table_data .= '<tr>';
                                $table_data .= '<td><a class="contact_a" name="' . $main_value["ContactID"] . '">' . $main_value["Name"] . '</a></td>';
                                /*$table_data .= '<td>' . (isset($main_value["EmailAddress"]) ? $main_value["EmailAddress"] : "") . '</td>';
                                $table_data .= '<td>' . (isset($main_value["FirstName"]) ? $main_value["FirstName"] : "") . '</td>';
                                $table_data .= '<td>' . (isset($main_value["LastName"]) ? $main_value["LastName"] : "") . '</td>';*/
                                if($receivables > 0){
                                    $table_data .= '<td class="fit"><b style="color:green;margin-left:10px">'.number_format($receivables, 2).'</b>&nbsp;&nbsp;<a target="_blank" href="'.env("APP_URL").'company/loadAgedData/'.$main_value["ContactID"].'/receivable/'.$name.'" class="btn btn-sm btn-primary">View Aged Receivables</a></td>';
                                }
                                else{
                                    $table_data .= '<td class="fit"></td>';
                                }
                                
                                if($payables > 0){
                                    $table_data .= '<td class="fit"><b style="color:red;margin-left:10px">'.number_format($payables, 2).'</b>&nbsp;&nbsp;<a target="_blank" href="'.env("APP_URL").'company/loadAgedData/'.$main_value["ContactID"].'/payables/'.$name.'" class="btn btn-sm btn-danger">View Aged Payables</a></td>';
                                }
                                else{
                                    $table_data .= '<td class="fit"></td>';
                                }
                                
                                $table_data .= '</tr>';
                            }
                        }

                    }

                    return $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getContacts: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public static function checkIfExpires()
    {
        $xero_info = XeroController::checkIfConnected();
        if ($xero_info != null)
        {
            $token_info = \App\XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                ->where("status", "=", "1")
                ->first();
            if ($token_info != null)
            {
                if (time() > $token_info->expires)
                {
                    try
                    {
                        $provider = new \League\OAuth2\Client\Provider\GenericProvider(['clientId' => $xero_info->client_id, 'clientSecret' => $xero_info->secret_id, 'redirectUri' => env("APP_URL") . 'company/goXeroAnalytics', 'urlAuthorize' => 'https://login.xero.com/identity/connect/authorize', 'urlAccessToken' => 'https://identity.xero.com/connect/token', 'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation']);

                        $newAccessToken = $provider->getAccessToken('refresh_token', ['refresh_token' => $token_info->refresh_token]);

                        $token_info->token = $newAccessToken->getToken();
                        $token_info->expires = $newAccessToken->getExpires();
                        $token_info->refresh_token = $newAccessToken->getRefreshToken();
                        $token_info->id_token = $newAccessToken->getValues() ["id_token"];
                        $token_info->save();
                    }
                    catch(Exception $e)
                    {
                        echo 'Exception when calling AccountingApi->organisation: ', $e->getMessage() , PHP_EOL;
                    }
                }
                return "ok";
            }
            else
            {
                return "not";
            }
        }
        else
        {
            return "not";
        }
    }

    public static function getXeroTaxRates($tax_type)
    {
        if (XeroController::checkIfExpires() == "ok")
        {
            $xero_info = XeroController::checkIfConnected();
            $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                ->where("status", "=", "1")
                ->first();

            $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
            $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

            $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                ->where("status", "=", "1")
                ->first();
            $xeroTenantId = (string)$tenant_info->tenant_id;

            $where = 'TaxType="' . $tax_type . '"';
            $order = "";
            $taxType = "";

            try
            {
                $result = $apiInstance->getTaxRates($xeroTenantId, $where, $order, $taxType);
                return $arr = json_decode($result, true);
                /*foreach ($arr["TaxRates"] as $value) {
                return $value["Name"];
                }*/
            }
            catch(Exception $e)
            {
                echo 'Exception when calling AccountingApi->getTaxRates: ', $e->getMessage() , PHP_EOL;
            }
        }
    }

    public static function getXeroCurrencies()
    {
        if (XeroController::checkIfExpires() == "ok")
        {
            $xero_info = XeroController::checkIfConnected();
            $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                ->where("status", "=", "1")
                ->first();

            $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
            $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

            $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                ->where("status", "=", "1")
                ->first();
            $xeroTenantId = (string)$tenant_info->tenant_id;

            $where = "";
            $order = "";

            try
            {
                $result = $apiInstance->getCurrencies($xeroTenantId, $where, $order);
                $arr = json_decode($result, true);
                foreach ($arr["Currencies"] as $value)
                {
                    return $value["Code"];
                }

            }
            catch(Exception $e)
            {
                echo 'Exception when calling AccountingApi->getCurrencies: ', $e->getMessage() , PHP_EOL;
            }
        }
    }

    public static function getBankAccountDetails($AccountID)
    {
        if (XeroController::checkIfExpires() == "ok")
        {
            $xero_info = XeroController::checkIfConnected();
            $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                ->where("status", "=", "1")
                ->first();

            $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
            $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

            $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                ->where("status", "=", "1")
                ->first();
            $xeroTenantId = (string)$tenant_info->tenant_id;
            $acc = $apiInstance->getAccount($xeroTenantId, $AccountID);
            $acc_arr = json_decode($acc, true);
            return $acc_arr;
        }
    }

    public function getManualJournalDetails(Request $request)
    {
        if (isset($request["id"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                $manualJournalID = $request["id"];

                $table_data = "";
                $total_tax_amount = 0;

                try
                {
                    $result = $apiInstance->getManualJournal($xeroTenantId, $manualJournalID);

                    $arr = json_decode($result, true);

                    $debit_total = 0;
                    $credit_total = 0;

                    $sub_debit = 0;
                    $sub_credit = 0;

                    $debit_tax = 0;
                    $credit_tax = 0;

                    foreach ($arr as $value)
                    {
                        foreach ($value as $main_value)
                        {
                            foreach ($main_value["JournalLines"] as $sub_value)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td>' . $sub_value["Description"] . '</td>';
                                $table_data .= '<td>';

                                $acc = $apiInstance->getAccount($xeroTenantId, $sub_value["AccountID"]);
                                $acc_arr = json_decode($acc, true);
                                foreach ($acc_arr["Accounts"] as $acc_value)
                                {
                                    $table_data .= $sub_value["AccountCode"] . " - " . $acc_value["Name"];
                                }

                                $table_data .= '</td>';

                                $table_data .= '<td class="text-center">';

                                foreach (XeroController::getXeroTaxRates($sub_value["TaxType"]) ["TaxRates"] as $taxvalue)
                                {
                                    $table_data .= $taxvalue["Name"] . " ( " . number_format($taxvalue["EffectiveRate"], 0) . "% )";
                                }

                                $table_data .= '</td>';

                                $table_data .= '<td class="amount_css td_hide">' . $sub_value["TaxAmount"]. '</td>';
                                $total_tax_amount += $sub_value["TaxAmount"];

                                if ($sub_value["LineAmount"] > 0)
                                {
                                    $table_data .= '<td class="amount_css">' . number_format($sub_value["LineAmount"], 2) . '</td>';
                                    $table_data .= '<td class="amount_css"></td>';

                                    $debit_total += ($sub_value["LineAmount"] + $sub_value["TaxAmount"]);
                                    $sub_debit += $sub_value["LineAmount"];
                                    $debit_tax += $sub_value["TaxAmount"];
                                }
                                else
                                {
                                    $table_data .= '<td class="amount_css"></td>';
                                    $table_data .= '<td class="amount_css">' . number_format($sub_value["LineAmount"] , 2) . '</td>';

                                    $credit_total += ($sub_value["LineAmount"] + $sub_value["TaxAmount"]);
                                    $sub_credit += $sub_value["LineAmount"];
                                    $credit_tax += $sub_value["TaxAmount"];
                                }

                                $table_data .= '</tr>';
                            }
                        }
                    }

                    $colspan = "colspan='2'";
                    $color_total = "green";
                    if ($debit_total != $credit_total)
                    {
                        $color_total = "red";
                    }

                    if ($total_tax_amount > 0)
                    {
                        $colspan = "colspan='3'";
                    }

                    $table_data .= '<tr>';
                    $table_data .= '<td ' . $colspan . ' ></td>';
                    $table_data .= '<td class="amount_css"><b class="text-dark">Sub Total:</b> </td>';
                    $table_data .= '<td class="amount_css"><b >' . number_format($sub_debit, 2) . '</b></td>';
                    $table_data .= '<td class="amount_css"><b>' . number_format($sub_credit , 2) . '</b></td>';
                    $table_data .= '</tr>';

                    if ($total_tax_amount > 0)
                    {
                        $table_data .= '<tr>';
                        $table_data .= '<td ' . $colspan . ' ></td>';
                        $table_data .= '<td class="amount_css"><b class="text-dark">Total Tax:</b> </td>';
                        $table_data .= '<td class="amount_css"><b >' . number_format($debit_tax, 2) . '</b></td>';
                        $table_data .= '<td class="amount_css"><b>' . number_format($credit_tax , 2) . '</b></td>';
                        $table_data .= '</tr>';
                    }

                    $table_data .= '<tr style="border-bottom:2px double black !important; border-bottom-style:double !important;border-top:2px solid black !important ">';
                    $table_data .= '<td ' . $colspan . ' ></td>';
                    $table_data .= '<td class="amount_css"><b class="text-dark">Total:</b> </td>';
                    $table_data .= '<td class="amount_css"><b style="color:' . $color_total . '">' . number_format($debit_total, 2) . '</b></td>';
                    $table_data .= '<td class="amount_css"><b style="color:' . $color_total . '">' . number_format($credit_total , 2) . '</b></td>';
                    $table_data .= '</tr>';

                    return $total_tax_amount . "<split>" . $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getManualJournal: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getInvoicesDetails(Request $request)
    {
        if (isset($request["id"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                $invoiceID = $request["id"];
                $unitdp = 4;

                $table_data = "";
                $total_tax_amount = 0;

                try
                {
                    $result = $apiInstance->getInvoice($xeroTenantId, $invoiceID, $unitdp);

                    $arr = json_decode($result, true);

                    $debit_total = 0;
                    $credit_total = 0;

                    $sub_debit = 0;
                    $sub_credit = 0;

                    $debit_tax = 0;
                    $credit_tax = 0;

                    $invoice_details_modal_to = "";
                    $invoice_details_modal_date = "";
                    $invoice_details_modal_duedate = "";
                    $invoice_details_modal_no = "";
                    $invoice_details_modal_reference = "";

                    foreach ($arr as $value)
                    {
                        foreach ($value as $main_value)
                        {
                            foreach ($main_value["LineItems"] as $sub_value)
                            {
                                $table_data .= '<tr>';
                                
                                $itemcodedesc = "";
                                if(isset($sub_value["Item"]["Code"])){
                                    $itemcodedesc .= $sub_value["Item"]["Code"] . ": ";
                                }
                                
                                if(isset($sub_value["Item"]["Name"])){
                                    $itemcodedesc .= $sub_value["Item"]["Name"];
                                }
                                
                                $table_data .= '<td>' .  $itemcodedesc . '</td>';
                                $table_data .= '<td>' . $sub_value["Description"] . '</td>';
                                $table_data .= '<td>' . number_format($sub_value["Quantity"], 0) . '</td>';
                                $table_data .= '<td class="amount_css" >' . number_format($sub_value["UnitAmount"], 2) . '</td>';
                                $table_data .= '<td>' . $sub_value["AccountCode"] . '</td>';

                                $table_data .= '<td class="text-center">';

                                foreach (XeroController::getXeroTaxRates($sub_value["TaxType"]) ["TaxRates"] as $taxvalue)
                                {
                                    $table_data .= $taxvalue["Name"] . " ( " . number_format($taxvalue["EffectiveRate"], 0) . "% )";
                                }

                                $table_data .= '</td>';
                                $table_data .= '<td class="amount_css" >' . number_format($sub_value["UnitAmount"], 2) . '</td>';
                                $table_data .= '<td>';

                                $table_data .= '</tr>';
                            }

                            $table_data .= '<tr>';
                            $table_data .= '<td colspan="5" ></td>';
                            $table_data .= '<td class="amount_css"><b class="text-dark">Sub Total:</b> </td>';
                            $table_data .= '<td class="amount_css"><b >' . number_format($main_value["SubTotal"], 2) . '</b></td>';
                            $table_data .= '</tr>';

                            if ($main_value["TotalTax"] > 0)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td colspan="5" ></td>';
                                $table_data .= '<td class="amount_css"><b class="text-dark">Total Tax:</b> </td>';
                                $table_data .= '<td class="amount_css"><b >' . number_format($main_value["TotalTax"], 2) . '</b></td>';
                                $table_data .= '</tr>';
                            }

                            $table_data .= '<tr style="border-bottom:2px double black !important; border-bottom-style:double !important;border-top:2px solid black !important ">';
                            $table_data .= '<td colspan="5" ></td>';
                            $table_data .= '<td class="amount_css"><b class="text-dark">Total:</b> </td>';
                            $table_data .= '<td class="amount_css"><b style="color:green">' . number_format($main_value["Total"], 2) . '</b></td>';
                            $table_data .= '</tr>';

                            $invoice_details_modal_to = $main_value["Contact"]["Name"];
                            if (isset($main_value['Date']))
                            {
                                $date = str_replace('/Date(', '', $main_value['Date']);
                                $parts = explode('+', $date);
                                $invoice_details_modal_date = date("M-d-Y", $parts[0] / 1000);
                            }

                            if (isset($main_value['DueDate']))
                            {
                                $date = str_replace('/Date(', '', $main_value['DueDate']);
                                $parts = explode('+', $date);
                                $invoice_details_modal_duedate = date("M-d-Y", $parts[0] / 1000);
                            }

                            $invoice_details_modal_no = $main_value["InvoiceNumber"];
                            $invoice_details_modal_reference = $main_value["Reference"];
                        }
                    }

                    return $invoice_details_modal_to . "<split>" . $invoice_details_modal_date . "<split>" . $invoice_details_modal_duedate . "<split>" . $invoice_details_modal_no . "<split>" . $invoice_details_modal_reference . "<split>" . $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getManualJournal: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getQuotesDetails(Request $request)
    {
        if (isset($request["id"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                $quoteID = $request["id"];

                $table_data = "";
                $total_tax_amount = 0;

                try
                {
                    $result = $apiInstance->getQuote($xeroTenantId, $quoteID);

                    $arr = json_decode($result, true);

                    $debit_total = 0;
                    $credit_total = 0;

                    $sub_debit = 0;
                    $sub_credit = 0;

                    $debit_tax = 0;
                    $credit_tax = 0;

                    $quotes_details_modal_contact = "";
                    $quotes_details_modal_date = "";
                    $quotes_details_modal_expiry = "";
                    $quotes_details_modal_no = "";
                    $quotes_details_modal_reference = "";
                    $quotes_details_modal_title = "";
                    $quotes_details_modal_summary = "";

                    foreach ($arr as $value)
                    {
                        foreach ($value as $main_value)
                        {
                            foreach ($main_value["LineItems"] as $sub_value)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td>' . $sub_value["ItemCode"] . ": " . $sub_value["Description"] . '</td>';
                                $table_data .= '<td>' . $sub_value["Description"] . '</td>';
                                $table_data .= '<td>' . number_format($sub_value["Quantity"], 0) . '</td>';
                                $table_data .= '<td class="amount_css" >' . number_format($sub_value["UnitAmount"], 2) . '</td>';
                                $table_data .= '<td>' . $sub_value["AccountCode"] . '</td>';

                                $table_data .= '<td class="text-center">';

                                foreach (XeroController::getXeroTaxRates($sub_value["TaxType"]) ["TaxRates"] as $taxvalue)
                                {
                                    $table_data .= $taxvalue["Name"] . " ( " . number_format($taxvalue["EffectiveRate"], 0) . "% )";
                                }

                                $table_data .= '</td>';
                                $table_data .= '<td class="amount_css" >' . number_format($sub_value["UnitAmount"], 2) . '</td>';
                                $table_data .= '<td>';

                                $table_data .= '</tr>';
                            }

                            $table_data .= '<tr>';
                            $table_data .= '<td colspan="5" ></td>';
                            $table_data .= '<td class="amount_css"><b class="text-dark">Sub Total:</b> </td>';
                            $table_data .= '<td class="amount_css"><b >' . number_format($main_value["SubTotal"], 2) . '</b></td>';
                            $table_data .= '</tr>';

                            if ($main_value["TotalTax"] > 0)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td colspan="5" ></td>';
                                $table_data .= '<td class="amount_css"><b class="text-dark">Total Tax:</b> </td>';
                                $table_data .= '<td class="amount_css"><b >' . number_format($main_value["TotalTax"], 2) . '</b></td>';
                                $table_data .= '</tr>';
                            }

                            $table_data .= '<tr style="border-bottom:2px double black !important; border-bottom-style:double !important;border-top:2px solid black !important ">';
                            $table_data .= '<td colspan="5" ><p><b>Terms: </b>' . $main_value["Terms"] . '</p></td>';
                            $table_data .= '<td class="amount_css"><b class="text-dark">Total:</b> </td>';
                            $table_data .= '<td class="amount_css"><b style="color:green">' . number_format($main_value["Total"], 2) . '</b></td>';
                            $table_data .= '</tr>';

                            $quotes_details_modal_contact = $main_value["Contact"]["Name"];
                            if (isset($main_value['Date']))
                            {
                                $date = str_replace('/Date(', '', $main_value['Date']);
                                $parts = explode(')', $date);
                                $quotes_details_modal_date = date("M-d-Y", $parts[0] / 1000);
                            }

                            if (isset($main_value['ExpiryDate']))
                            {
                                $date = str_replace('/Date(', '', $main_value['ExpiryDate']);
                                $parts = explode(')', $date);
                                $quotes_details_modal_expiry = date("M-d-Y", $parts[0] / 1000);
                            }

                            $quotes_details_modal_no = $main_value["QuoteNumber"];
                            $quotes_details_modal_reference = $main_value["Reference"];

                            $quotes_details_modal_title = (isset($main_value["Title"]) ? $main_value["Title"] : "");
                            $quotes_details_modal_summary = isset($main_value["Summary"]) ? $main_value["Summary"] : "";
                        }
                    }

                    return $quotes_details_modal_contact . "<split>" . $quotes_details_modal_date . "<split>" . $quotes_details_modal_expiry . "<split>" . $quotes_details_modal_no . "<split>" . $quotes_details_modal_reference . "<split>" . $quotes_details_modal_title . "<split>" . $quotes_details_modal_summary . "<split>" . $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getQuote: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getPurchaseOrderDetails(Request $request)
    {
        if (isset($request["id"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                $purchaseOrderID = $request["id"];

                $table_data = "";
                $total_tax_amount = 0;

                try
                {
                    $result = $apiInstance->getPurchaseOrder($xeroTenantId, $purchaseOrderID);

                    $arr = json_decode($result, true);

                    $debit_total = 0;
                    $credit_total = 0;

                    $sub_debit = 0;
                    $sub_credit = 0;

                    $debit_tax = 0;
                    $credit_tax = 0;

                    $quotes_details_modal_contact = "";
                    $quotes_details_modal_date = "";
                    $quotes_details_modal_deldate = "";
                    $quotes_details_modal_no = "";
                    $quotes_details_modal_reference = "";

                    $full_address = "";
                    $attention = "";
                    $tel = "";
                    $instruction = "";

                    foreach ($arr as $value)
                    {
                        foreach ($value as $main_value)
                        {
                            foreach ($main_value["LineItems"] as $sub_value)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td>' . $sub_value["ItemCode"] . ": " . $sub_value["Description"] . '</td>';
                                $table_data .= '<td>' . $sub_value["Description"] . '</td>';
                                $table_data .= '<td>' . number_format($sub_value["Quantity"], 0) . '</td>';
                                $table_data .= '<td class="amount_css" >' . number_format($sub_value["UnitAmount"], 2) . '</td>';
                                $table_data .= '<td>' . $sub_value["AccountCode"] . '</td>';

                                $table_data .= '<td class="text-center">';

                                foreach (XeroController::getXeroTaxRates($sub_value["TaxType"]) ["TaxRates"] as $taxvalue)
                                {
                                    $table_data .= $taxvalue["Name"] . " ( " . number_format($taxvalue["EffectiveRate"], 0) . "% )";
                                }

                                $table_data .= '</td>';
                                $table_data .= '<td class="amount_css" >' . number_format($sub_value["UnitAmount"], 2) . '</td>';
                                $table_data .= '<td>';

                                $table_data .= '</tr>';
                            }

                            $table_data .= '<tr>';
                            $table_data .= '<td colspan="5" ></td>';
                            $table_data .= '<td class="amount_css"><b class="text-dark">Sub Total:</b> </td>';
                            $table_data .= '<td class="amount_css"><b >' . number_format($main_value["SubTotal"], 2) . '</b></td>';
                            $table_data .= '</tr>';

                            if ($main_value["TotalTax"] > 0)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td colspan="5" ></td>';
                                $table_data .= '<td class="amount_css"><b class="text-dark">Total Tax:</b> </td>';
                                $table_data .= '<td class="amount_css"><b >' . number_format($main_value["TotalTax"], 2) . '</b></td>';
                                $table_data .= '</tr>';
                            }

                            $table_data .= '<tr style="border-bottom:2px double black !important; border-bottom-style:double !important;border-top:2px solid black !important ">';
                            $table_data .= '<td colspan="5" ></td>';
                            $table_data .= '<td class="amount_css"><b class="text-dark">Total:</b> </td>';
                            $table_data .= '<td class="amount_css"><b style="color:green">' . number_format($main_value["Total"], 2) . '</b></td>';
                            $table_data .= '</tr>';

                            $table_data .= '<tr>';
                            $table_data .= '<td colspan="3" rowspan="2"><b>Delivery Address:</b> ' . $main_value["DeliveryAddress"] . '</td>';
                            $table_data .= '<td ><b>Attention:</b> ' . $main_value["AttentionTo"] . '</td>';
                            $table_data .= '<td colspan="3" rowspan="2"><b>Delivery Instructions:</b> ' . $main_value["DeliveryInstructions"] . '</td>';
                            $table_data .= '</tr>';

                            $table_data .= '<tr>';
                            //$table_data .= '<td colspan="3" rowspan="2"><b>Delivery Address:</b> '.$main_value["DeliveryAddress"].'</td>';
                            $table_data .= '<td ><b>Telephone:</b> ' . $main_value["Telephone"] . '</td>';
                            //$table_data .= '<td colspan="3" rowspan="2"><b>Delivery Instructions:</b> '.$main_value["DeliveryInstructions"].'</td>';
                            $table_data .= '</tr>';

                            $quotes_details_modal_contact = $main_value["Contact"]["Name"];
                            if (isset($main_value['Date']))
                            {
                                $date = str_replace('/Date(', '', $main_value['Date']);
                                $parts = explode('+', $date);
                                $quotes_details_modal_date = date("M-d-Y", $parts[0] / 1000);
                            }

                            if (isset($main_value['DeliveryDate']))
                            {
                                $date = str_replace('/Date(', '', $main_value['DeliveryDate']);
                                $parts = explode('+', $date);
                                $quotes_details_modal_deldate = date("M-d-Y", $parts[0] / 1000);
                            }

                            $quotes_details_modal_no = $main_value["PurchaseOrderNumber"];
                            $quotes_details_modal_reference = $main_value["Reference"];

                        }
                    }

                    return $quotes_details_modal_contact . "<split>" . $quotes_details_modal_date . "<split>" . $quotes_details_modal_deldate . "<split>" . $quotes_details_modal_no . "<split>" . $quotes_details_modal_reference . "<split>" . $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getQuote: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function getItemDetails(Request $request)
    {
        if (isset($request["id"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                $purchaseOrderID = $request["id"];

                $table_data = "";
                $total_tax_amount = 0;

                try
                {
                    $result = $apiInstance->getPurchaseOrder($xeroTenantId, $purchaseOrderID);

                    $arr = json_decode($result, true);

                    $debit_total = 0;
                    $credit_total = 0;

                    $sub_debit = 0;
                    $sub_credit = 0;

                    $debit_tax = 0;
                    $credit_tax = 0;

                    $quotes_details_modal_contact = "";
                    $quotes_details_modal_date = "";
                    $quotes_details_modal_deldate = "";
                    $quotes_details_modal_no = "";
                    $quotes_details_modal_reference = "";

                    $full_address = "";
                    $attention = "";
                    $tel = "";
                    $instruction = "";

                    foreach ($arr as $value)
                    {
                        foreach ($value as $main_value)
                        {
                            foreach ($main_value["LineItems"] as $sub_value)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td>' . $sub_value["ItemCode"] . ": " . $sub_value["Description"] . '</td>';
                                $table_data .= '<td>' . $sub_value["Description"] . '</td>';
                                $table_data .= '<td>' . number_format($sub_value["Quantity"], 0) . '</td>';
                                $table_data .= '<td class="amount_css" >' . number_format($sub_value["UnitAmount"], 2) . '</td>';
                                $table_data .= '<td>' . $sub_value["AccountCode"] . '</td>';

                                $table_data .= '<td class="text-center">';

                                foreach (XeroController::getXeroTaxRates($sub_value["TaxType"]) ["TaxRates"] as $taxvalue)
                                {
                                    $table_data .= $taxvalue["Name"] . " ( " . number_format($taxvalue["EffectiveRate"], 0) . "% )";
                                }

                                $table_data .= '</td>';
                                $table_data .= '<td class="amount_css" >' . number_format($sub_value["UnitAmount"], 2) . '</td>';
                                $table_data .= '<td>';

                                $table_data .= '</tr>';
                            }

                            $table_data .= '<tr>';
                            $table_data .= '<td colspan="5" ></td>';
                            $table_data .= '<td class="amount_css"><b class="text-dark">Sub Total:</b> </td>';
                            $table_data .= '<td class="amount_css"><b >' . number_format($main_value["SubTotal"], 2) . '</b></td>';
                            $table_data .= '</tr>';

                            if ($main_value["TotalTax"] > 0)
                            {
                                $table_data .= '<tr>';
                                $table_data .= '<td colspan="5" ></td>';
                                $table_data .= '<td class="amount_css"><b class="text-dark">Total Tax:</b> </td>';
                                $table_data .= '<td class="amount_css"><b >' . number_format($main_value["TotalTax"], 2) . '</b></td>';
                                $table_data .= '</tr>';
                            }

                            $table_data .= '<tr style="border-bottom:2px double black !important; border-bottom-style:double !important;border-top:2px solid black !important ">';
                            $table_data .= '<td colspan="5" ></td>';
                            $table_data .= '<td class="amount_css"><b class="text-dark">Total:</b> </td>';
                            $table_data .= '<td class="amount_css"><b style="color:green">' . number_format($main_value["Total"], 2) . '</b></td>';
                            $table_data .= '</tr>';

                            $table_data .= '<tr>';
                            $table_data .= '<td colspan="3" rowspan="2"><b>Delivery Address:</b> ' . $main_value["DeliveryAddress"] . '</td>';
                            $table_data .= '<td ><b>Attention:</b> ' . $main_value["AttentionTo"] . '</td>';
                            $table_data .= '<td colspan="3" rowspan="2"><b>Delivery Instructions:</b> ' . $main_value["DeliveryInstructions"] . '</td>';
                            $table_data .= '</tr>';

                            $table_data .= '<tr>';
                            //$table_data .= '<td colspan="3" rowspan="2"><b>Delivery Address:</b> '.$main_value["DeliveryAddress"].'</td>';
                            $table_data .= '<td ><b>Telephone:</b> ' . $main_value["Telephone"] . '</td>';
                            //$table_data .= '<td colspan="3" rowspan="2"><b>Delivery Instructions:</b> '.$main_value["DeliveryInstructions"].'</td>';
                            $table_data .= '</tr>';

                            $quotes_details_modal_contact = $main_value["Contact"]["Name"];
                            if (isset($main_value['Date']))
                            {
                                $date = str_replace('/Date(', '', $main_value['Date']);
                                $parts = explode('+', $date);
                                $quotes_details_modal_date = date("M-d-Y", $parts[0] / 1000);
                            }

                            if (isset($main_value['DeliveryDate']))
                            {
                                $date = str_replace('/Date(', '', $main_value['DeliveryDate']);
                                $parts = explode('+', $date);
                                $quotes_details_modal_deldate = date("M-d-Y", $parts[0] / 1000);
                            }

                            $quotes_details_modal_no = $main_value["PurchaseOrderNumber"];
                            $quotes_details_modal_reference = $main_value["Reference"];

                        }
                    }

                    return $quotes_details_modal_contact . "<split>" . $quotes_details_modal_date . "<split>" . $quotes_details_modal_deldate . "<split>" . $quotes_details_modal_no . "<split>" . $quotes_details_modal_reference . "<split>" . $table_data;

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getQuote: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }

    public function loadAgreements()
    {
        $result = XeroAgreement::orderBy("status", "desc")->get();
        return view('xero.xerosettings', compact('result'));
    }

    public function insertAgreement(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $agreement = $request["agreement_txt"];

            if (isset($request["id_txt"]) && $request["id_txt"] != "")
            {
                $xeroagreement = XeroAgreement::where("id", "=", $request["id_txt"])->first();
                $xeroagreement->agreement = $agreement;
                if ($xeroagreement->save())
                {
                    return redirect('xero/loadAgreements')
                        ->with('status', 'Successfully edited.');
                }
                else
                {
                    return redirect('xero/loadAgreements')
                        ->with('message', 'Failed to edit.');
                }
            }
            else
            {
                $ok = XeroAgreement::create(['agreement' => $agreement, 'created_by' => Auth::id() ]);

                if ($ok)
                {
                    return redirect('xero/loadAgreements')->with('status', 'Successfully added.');
                }
                else
                {
                    return redirect('xero/loadAgreements')
                        ->with('message', 'Failed to add.');
                }
            }
        }
    }

    public static function makeAgreementActive(Request $request)
    {
        if (isset($request["id"]))
        {
            XeroAgreement::where("status", "=", "1")->update(array(
                'status' => 0
            ));

            $xeroagreement = XeroAgreement::where("id", "=", $request["id"])->first();
            $xeroagreement->status = 1;
            if ($xeroagreement->save())
            {
                return redirect('xero/loadAgreements')
                    ->with('status', 'Success.');
            }
            else
            {
                return redirect('xero/loadAgreements')
                    ->with('message', 'Failed.');
            }
        }
    }

    public function saveBalanceSheet(Request $request)
    {
        if (null !== $request->input("id") && $request->input("id") != "")
        {
            $title = $request->input("title");
            $description = $request->input("description");
            $editor_content = $request->input("editor_content");

            $result = XeroBalanceSheet::where("id", "=", $request->input("id"))
                ->first();
            $result->title = $title;
            $result->description = $description;
            $result->editor_content = $editor_content;
            $result->updated_at = date('Y-m-d H:i:s');

            if ($result->save())
            {
                $log['error'] = false;
            }
            else
            {
                $log['error'] = true;
            }
            echo json_encode($log);
        }
        else
        {
            if (null !== $request->input("date") && null !== $request->input("period") && null !== $request->input("ptype") && null !== $request->input("title"))
            {
                if (XeroController::checkIfExpires() == "ok")
                {

                    $xero_info = XeroController::checkIfConnected();
                    $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                        ->where("status", "=", "1")
                        ->first();

                    $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                    $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                    $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                        ->where("status", "=", "1")
                        ->first();
                    $xeroTenantId = (string)$tenant_info->tenant_id;

                    $apiResponseOrg = $apiInstance->getOrganisations($xeroTenantId);
                    $org_name = $apiResponseOrg->getOrganisations() [0]
                        ->getName();
                    $org_id = $apiResponseOrg->getOrganisations() [0]
                        ->getOrganisationID();

                    $date = $request->input("date");
                    
                    $periods = "";
                    $timeframe = "";
                    
                    if($request->input("period") > 0){
                        $periods = $request->input("period");
                        $timeframe = $request->input("ptype");
                    }
                    
                    $trackingOptionID1 = "";
                    $trackingOptionID2 = "";
                    $standardLayout = true;
                    $paymentsOnly = false;

                    $title = $request->input("title");
                    $description = $request->input("description");
                    $editor_content = $request->input("editor_content");

                    $table_data = "";

                    try
                    {
                        $user_id = Auth::id();
                        $company_id_result = CompanyProfile::getCompanyId($user_id);

                        $result = $apiInstance->getReportBalanceSheet($xeroTenantId, $date, $periods, $timeframe, $trackingOptionID1, $trackingOptionID2, $standardLayout, $paymentsOnly);

                        $ok = XeroBalanceSheet::create(['company_id' => $company_id_result, 'json_content' => $result, 'org_name' => $org_name, 'org_id' => $org_id, 'title' => $title, 'description' => $description, 'financial_end_date' => $date, 'period' => $periods, 'timeframe' => $timeframe, 'editor_content' => $editor_content]);

                        if ($ok)
                        {
                            $log['error'] = false;
                        }
                        else
                        {
                            $log['error'] = true;
                        }
                        echo json_encode($log);

                    }
                    catch(Exception $e)
                    {
                        echo 'Exception when calling AccountingApi->getBalanceSheet: ', $e->getMessage() , PHP_EOL;
                    }
                }
            }
        }
    }

    public function getOrganisationDetails()
    {
        if (XeroController::checkIfExpires() == "ok")
        {
            try
            {
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                return $apiInstance->getOrganisations($xeroTenantId);
                //$org_name = $apiResponseOrg->getOrganisations()[0]->getName();
                //$org_id = $apiResponseOrg->getOrganisations()[0]->getOrganisationID();
                
            }
            catch(Exception $e)
            {
                echo 'Exception when calling AccountingApi->organisation: ', $e->getMessage() , PHP_EOL;
            }
        }
    }

    public function loadListBalanceSheet()
    {
        $user_id = Auth::id();
        $company_id_result = CompanyProfile::getCompanyId($user_id);

        $org_id = XeroController::getOrganisationDetails()->getOrganisations() [0]
            ->getOrganisationID();

        $result = XeroBalanceSheet::where("company_id", "=", $company_id_result)->where("org_id", "=", $org_id)->orderBy("created_at", "desc")
            ->get();
        $data = "";
        if (count((array)$result) > 0)
        {
            foreach ($result as $b)
            {
                $data .= '<tr>';
                $data .= '<td>' . $b->title . '</td>';
                $data .= '<td>' . $b->description . '</td>';
                $data .= '<td>' . $b->financial_end_date . '</td>';
                $data .= '<td>' . $b->period . '</td>';
                $data .= '<td>' . $b->timeframe . '</td>';
                $data .= '<td><button name="' . $b->id . '" class="btn btn-primary btn-sm balance_sheet_view_btn"><i class="fa fa-eye"></i> VIEW</button></td>';
                $data .= '</tr>';
            }
        }
        else
        {
            $data .= '<tr>';
            $data .= '<td colspan="6">No data available..</td>';
            $data .= '</tr>';
        }
        return $data;
    }

    public function loadListTrialBalance()
    {
        $user_id = Auth::id();
        $company_id_result = CompanyProfile::getCompanyId($user_id);

        $org_id = XeroController::getOrganisationDetails()->getOrganisations() [0]
            ->getOrganisationID();

        $result = XeroTrialBalance::where("company_id", "=", $company_id_result)->where("org_id", "=", $org_id)->orderBy("created_at", "desc")
            ->get();
        $data = "";
        if (count((array)$result) > 0)
        {
            foreach ($result as $b)
            {
                $data .= '<tr>';
                $data .= '<td>' . $b->title . '</td>';
                $data .= '<td>' . $b->description . '</td>';
                $data .= '<td>' . $b->tb_date . '</td>';
                $data .= '<td>' . $b->payment_only . '</td>';
                $data .= '<td><button name="' . $b->id . '" class="btn btn-primary btn-sm trial_balance_view_btn"><i class="fa fa-eye"></i> VIEW</button></td>';
                $data .= '</tr>';
            }
        }
        else
        {
            $data .= '<tr>';
            $data .= '<td colspan="6">No data available..</td>';
            $data .= '</tr>';
        }
        return $data;
    }

    public function loadListProfitLoss()
    {
        $user_id = Auth::id();
        $company_id_result = CompanyProfile::getCompanyId($user_id);

        $org_id = XeroController::getOrganisationDetails()->getOrganisations() [0]
            ->getOrganisationID();

        $result = XeroProfitLoss::where("company_id", "=", $company_id_result)->where("org_id", "=", $org_id)->orderBy("created_at", "desc")
            ->get();
        $data = "";
        if (count((array)$result) > 0)
        {
            foreach ($result as $b)
            {
                $data .= '<tr>';
                $data .= '<td>' . $b->title . '</td>';
                $data .= '<td>' . $b->description . '</td>';
                $data .= '<td>' . $b->from_date . '</td>';
                $data .= '<td>' . $b->to_date . '</td>';
                $data .= '<td>' . $b->period . '</td>';
                $data .= '<td>' . $b->timeframe . '</td>';
                $data .= '<td><button name="' . $b->id . '" class="btn btn-primary btn-sm profit_loss_view_btn"><i class="fa fa-eye"></i> VIEW</button></td>';
                $data .= '</tr>';
            }
        }
        else
        {
            $data .= '<tr>';
            $data .= '<td colspan="6">No data available..</td>';
            $data .= '</tr>';
        }
        return $data;
    }

    public function saveProfitLoss(Request $request)
    {
        if (null !== $request->input("id") && $request->input("id") != "")
        {
            $title = $request->input("title");
            $description = $request->input("description");
            $editor_content = $request->input("editor_content");

            $result = XeroProfitLoss::where("id", "=", $request->input("id"))
                ->first();
            $result->title = $title;
            $result->description = $description;
            $result->editor_content = $editor_content;
            $result->updated_at = date('Y-m-d H:i:s');

            if ($result->save())
            {
                $log['error'] = false;
            }
            else
            {
                $log['error'] = true;
            }
            echo json_encode($log);
        }
        else
        {
            if (null !== $request->input("from") && null !== $request->input("to") && null !== $request->input("period") && null !== $request->input("timeframe") && null !== $request->input("title"))
            {
                if (XeroController::checkIfExpires() == "ok")
                {

                    $xero_info = XeroController::checkIfConnected();
                    $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                        ->where("status", "=", "1")
                        ->first();

                    $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                    $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                    $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                        ->where("status", "=", "1")
                        ->first();
                    $xeroTenantId = (string)$tenant_info->tenant_id;

                    $apiResponseOrg = $apiInstance->getOrganisations($xeroTenantId);
                    $org_name = $apiResponseOrg->getOrganisations() [0]
                        ->getName();
                    $org_id = $apiResponseOrg->getOrganisations() [0]
                        ->getOrganisationID();

                    $fromDate = $request->input("from");
                    $toDate = $request->input("to");
                    
                    $periods = "";
                    $timeframe = "";
                    if($request->input("period") > 0){
                        $periods = $request->input("period");
                        $timeframe = $request->input("timeframe");
                    }

                    $trackingCategoryID = "";
                    $trackingCategoryID2 = "";
                    $trackingOptionID = "";
                    $trackingOptionID2 = "";
                    $standardLayout = true;
                    $paymentsOnly = false;

                    $title = $request->input("title");
                    $description = $request->input("description");
                    $editor_content = $request->input("editor_content");

                    $table_data = "";

                    try
                    {
                        $user_id = Auth::id();
                        $company_id_result = CompanyProfile::getCompanyId($user_id);

                        $result = $apiInstance->getReportProfitAndLoss($xeroTenantId, $fromDate, $toDate, $periods, $timeframe, $trackingCategoryID, $trackingCategoryID2, $trackingOptionID, $trackingOptionID2, $standardLayout, $paymentsOnly);

                        $ok = XeroProfitLoss::create(['company_id' => $company_id_result, 'json_content' => $result, 'org_name' => $org_name, 'org_id' => $org_id, 'title' => $title, 'description' => $description, 'from_date' => $fromDate, 'to_date' => $toDate, 'period' => $periods, 'timeframe' => $timeframe, 'editor_content' => $editor_content]);

                        if ($ok)
                        {
                            $log['error'] = false;
                        }
                        else
                        {
                            $log['error'] = true;
                        }
                        echo json_encode($log);

                    }
                    catch(Exception $e)
                    {
                        echo 'Exception when calling AccountingApi->getBalanceSheet: ', $e->getMessage() , PHP_EOL;
                    }
                }
            }
        }
    }

    public function saveTrialBalance(Request $request)
    {
        if (null !== $request->input("id") && $request->input("id") != "")
        {
            $title = $request->input("title");
            $description = $request->input("description");

            $result = XeroTrialBalance::where("id", "=", $request->input("id"))
                ->first();
            $result->title = $title;
            $result->description = $description;

            if ($result->save())
            {
                $log['error'] = false;
            }
            else
            {
                $log['error'] = true;
            }
            echo json_encode($log);
        }
        else
        {
            if (null !== $request->input("date") && null !== $request->input("payment") && null !== $request->input("title"))
            {
                if (XeroController::checkIfExpires() == "ok")
                {

                    $xero_info = XeroController::checkIfConnected();
                    $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                        ->where("status", "=", "1")
                        ->first();

                    $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                    $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                    $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                        ->where("status", "=", "1")
                        ->first();
                    $xeroTenantId = (string)$tenant_info->tenant_id;

                    $apiResponseOrg = $apiInstance->getOrganisations($xeroTenantId);
                    $org_name = $apiResponseOrg->getOrganisations() [0]
                        ->getName();
                    $org_id = $apiResponseOrg->getOrganisations() [0]
                        ->getOrganisationID();

                    $date = $request->input("date");
                    $paymentsOnly = $request->input("payment");

                    $title = $request->input("title");
                    $description = $request->input("description");

                    $table_data = "";

                    try
                    {
                        $user_id = Auth::id();
                        $company_id_result = CompanyProfile::getCompanyId($user_id);

                        $result = $apiInstance->getReportTrialBalance($xeroTenantId, $date, $paymentsOnly);

                        $ok = XeroTrialBalance::create(['company_id' => $company_id_result, 'json_content' => $result, 'org_name' => $org_name, 'org_id' => $org_id, 'title' => $title, 'description' => $description, 'tb_date' => $date, 'payment_only' => $paymentsOnly, ]);

                        if ($ok)
                        {
                            $log['error'] = false;
                        }
                        else
                        {
                            $log['error'] = true;
                        }
                        echo json_encode($log);

                    }
                    catch(Exception $e)
                    {
                        echo 'Exception when calling AccountingApi->getBalanceSheet: ', $e->getMessage() , PHP_EOL;
                    }
                }
            }
        }
    }

    public function getAccountDetailsTable(Request $request)
    {
        if (isset($request["AccountID"]))
        {
            try
            {
                if (XeroController::checkIfExpires() == "ok")
                {

                    $xero_info = XeroController::checkIfConnected();
                    $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                        ->where("status", "=", "1")
                        ->first();

                    $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                    $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                    $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                        ->where("status", "=", "1")
                        ->first();
                    $xeroTenantId = (string)$tenant_info->tenant_id;

                    $acc = $apiInstance->getAccount($xeroTenantId, $request["AccountID"]);

                    $acc_arr = json_decode($acc, true);

                    $table_data = "";
                    $count = 0;

                    $keys = array(
                        "Type",
                        "Class",
                        "Name",
                        "AccountID"
                    );

                    foreach ($acc_arr["Accounts"] as $value)
                    {
                        if ($count == 0)
                        {
                            $table_data .= '<tr>';
                            foreach ($keys as $array_key)
                            {
                                $table_data .= '<td>' . $array_key . '</td>';
                            }
                            $table_data .= '</tr>';
                        }

                        $table_data .= '<tr>';
                        foreach ($keys as $array_key)
                        {
                            $val = isset($value[$array_key]) ? $value[$array_key] : "";
                            $table_data .= '<td>' . $val . '</td>';
                        }
                        $table_data .= '</tr>';

                        $count++;
                    }

                    return $table_data;
                }

            }
            catch(Exception $e)
            {
                echo 'Exception when calling AccountingApi->getAccount: ', $e->getMessage() , PHP_EOL;
            }
        }
    }

    public function goXeroAnalytics()
    {
        $user_id = Auth::id();
        $company_id_result = CompanyProfile::getCompanyId($user_id);

        return view('profile.xeroanalytics', compact('company_id_result'));
    }

    public function loadStatementBalance(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if ($request->input('xx') != "" && $request->input('interval') != "" && $request->input('from_date') != "" && $request->input('to_date') != "")
            {
                if (XeroController::checkIfExpires() == "ok")
                {

                    $xero_info = XeroController::checkIfConnected();
                    $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                        ->where("status", "=", "1")
                        ->first();

                    $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                    $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                    $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                        ->where("status", "=", "1")
                        ->first();
                    $xeroTenantId = (string)$tenant_info->tenant_id;

                    $bank_acc_id = $request->input('xx');
                    $cashin = "";
                    $cashout = "";

                    $user_to_date = $request->input('to_date');

                    $interval = $request->input('interval');
                    $from_date = $request->input('from_date');
                    $to_date = date("Y-m-d");

                    $from_date_split = explode("-", $from_date);
                    $to_date_split = explode("-", $to_date);

                    $user_to_date_split = explode("-", $user_to_date);

                    if ($interval == "day")
                    {
                        $from_date2 = date($from_date_split[0] . "-" . $from_date_split[1] . "-" . $from_date_split[2]);
                        $to_date2 = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . $to_date_split[2]);

                        $to_date3 = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . $to_date_split[2] . " h:i:sa");

                        $from_date = $from_date_split[0] . "," . $from_date_split[1] . "," . $from_date_split[2];
                        $to_date = $to_date_split[0] . "," . $to_date_split[1] . "," . $to_date_split[2];

                        $validation_from_date = date($from_date_split[0] . "-" . $from_date_split[1] . "-" . $from_date_split[2] . " h:i:sa");
                        $validation_to_date = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . $to_date_split[2] . " h:i:sa");
                        $user_validation_to_date = date($user_to_date_split[0] . "-" . $user_to_date_split[1] . "-" . $user_to_date_split[2] . " h:i:sa");
                    }

                    if ($interval == "month")
                    {
                        $from_date2 = date($from_date_split[0] . "-" . $from_date_split[1] . "-01");

                        $todate_forlastday = date($to_date_split[0] . "-" . $to_date_split[1] . "-01");
                        $user_todate_forlastday = date($user_to_date_split[0] . "-" . $user_to_date_split[1] . "-01");

                        $to_date2 = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . date("t", strtotime($todate_forlastday)));

                        $to_date3 = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . date("t", strtotime($todate_forlastday)) . " h:i:sa");

                        $from_date = 'DateTime(' . $from_date_split[0] . "," . $from_date_split[1] . ',01)';
                        $to_date = 'DateTime(' . $to_date_split[0] . "," . $to_date_split[1] . "," . date("t", strtotime($todate_forlastday)) . ')';

                        $validation_from_date = date($from_date_split[0] . "-" . $from_date_split[1] . "-01 h:i:sa");
                        $validation_to_date = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . date("t", strtotime($todate_forlastday)) . " h:i:sa");
                        $user_validation_to_date = date($user_to_date_split[0] . "-" . $user_to_date_split[1] . "-" . date("t", strtotime($user_todate_forlastday)) . " h:i:sa");
                    }

                    if ($interval == "year")
                    {
                        $from_date2 = date($from_date_split[0] . "-01-01");

                        $todate_forlastday = date($to_date_split[0] . "-12-01");
                        $user_todate_forlastday = date($user_to_date_split[0] . "-12-01");

                        $to_date2 = date($to_date_split[0] . "-12-" . date("t", strtotime($todate_forlastday)));

                        $to_date3 = date($to_date_split[0] . "-12-" . date("t", strtotime($todate_forlastday)) . " h:i:sa");

                        $from_date = 'DateTime(' . $from_date_split[0] . ',01,01)';
                        $to_date = 'DateTime(' . $to_date_split[0] . ",12," . date("t", strtotime($todate_forlastday)) . ')';

                        $validation_from_date = date($from_date_split[0] . "-01-01 h:i:sa");
                        $validation_to_date = date($to_date_split[0] . "-12-" . date("t", strtotime($todate_forlastday)));
                        $user_validation_to_date = date($user_to_date_split[0] . "-12-" . date("t", strtotime($user_todate_forlastday)) . " h:i:sa");
                    }

                    $mainphpTimestamp = strtotime($to_date3);
                    $mainjavaScriptTimestamp = $mainphpTimestamp * 1000;

                    $mybalance = 0;

                    try
                    {
                        $result = $apiInstance->getReportBankSummary($xeroTenantId, $to_date2, $to_date2);
    
                        $arr = json_decode($result, true);
                        
                        $closing_count = 0;
                        foreach ($arr["Reports"] as $values)
                        {
                            if (count($values["Rows"]) > 0)
                            {
                                foreach ($values["Rows"] as $main_value)
                                {

                                    if ($main_value["RowType"] == "Header")
                                    {
                                        foreach ($main_value["Cells"] as $cells) {
                                            $closing_count++;
                                        }
                                    }

                                    if ($main_value["RowType"] == "Section")
                                    {
                                        foreach ($main_value["Rows"] as $main_row)
                                        {

                                            if ($main_row["RowType"] == "Row")
                                            {
                                                $thisbankid = "";
                                                $count = 1;
                                                $acc_no = "";

                                                foreach ($main_row["Cells"] as $cells)
                                                {

                                                    if ($count == 1)
                                                    {

                                                        foreach ($cells["Attributes"] as $attributes)
                                                        {
                                                            $thisbankid = $attributes["Value"];
                                                        }
                                                    }

                                                    if ($count == $closing_count)
                                                    {
                                                        if ($thisbankid == $bank_acc_id)
                                                        {
                                                            $mybalance = $cells["Value"];
                                                        }
                                                    }

                                                    $count++;
                                                }
                                            }
                                        }
                                    }

                                }
                            }
                        }
                    }
                    catch(Exception $e)
                    {
                        echo 'Exception when calling AccountingApi->getReportBankSummary: ', $e->getMessage() , PHP_EOL;
                    }

                    $ifModifiedSince = "";
                    $where = 'BankAccount.AccountID==GUID("' . $bank_acc_id . '") && Date >= DateTime(' . $from_date . ') && Date <= DateTime(' . $to_date . ')';
                    //$where = 'BankAccount.AccountID==GUID("'.$bank_acc_id.'") && Date >= DateTime('.$from_date_split[0].', '.$from_date_split[1].', '.$from_date_split[2].') && Date <= DateTime('.$to_date_split[0].', '.$to_date_split[1].', '.$to_date_split[2].')';
                    $order = "Date DESC";
                    $page = "";
                    $unitdp = "";
                    $
                    {
                        "btresult" . $bank_acc_id
                    } = $apiInstance->getBankTransactions($xeroTenantId, $ifModifiedSince, $where, $order, $page, $unitdp);
                    $btresult_arr = json_decode($
                    {
                        "btresult" . $bank_acc_id
                    }
                    , true);

                    $count = 0;
                    $prev_value = "0";
                    $prev_type = "0";
                    $prev_date = "";

                    $to_date_final = "";
                    $from_date_final = "";
                    $stop_count = 0;

                    $recieved_value = 0;
                    $spent_value = 0;

                    $dataPoints = array();

                    if (count($btresult_arr["BankTransactions"]) > 0)
                    {

                        foreach ($btresult_arr["BankTransactions"] as $btvalues)
                        {
                            //if ($btvalues["IsReconciled"] == true)
                            //{
                                $date = str_replace('/Date(', '', $btvalues['Date']);
                                $parts = explode('+', $date);

                                $phpDate = date("Y-m-d h:i:sa", $parts[0] / 1000);
                                $start_date = date("Y-m-d h:i:sa", $parts[0] / 1000);

                                $phpTimestamp = strtotime($phpDate);
                                $javaScriptTimestamp = $phpTimestamp * 1000;

                                if ($count > 0)
                                {
                                    if ($btvalues["IsReconciled"] == true && $btvalues["Status"] == "AUTHORISED"){
                                        if ($prev_type == "minus")
                                        {
                                            $mybalance -= $prev_value;
                                            $spent_value += $prev_value;
                                        }
                                        else
                                        {
                                            $mybalance += $prev_value;
                                            $recieved_value += $prev_value;
                                        }
                                    }

                                    if ($prev_date == $javaScriptTimestamp)
                                    {
                                        continue;
                                    }
                                }

                                $prev_value = $btvalues["Total"];
                                if ($btvalues['Type'] == "RECEIVE" || $btvalues['Type'] == "RECEIVE-TRANSFER")
                                {
                                    $prev_type = "minus";
                                }
                                else
                                {
                                    $prev_type = "plus";
                                }

                                do
                                {
                                    $timestamp = strtotime($validation_to_date);
                                    $jsTimestamp = $timestamp * 1000;

                                    if ($interval == "day" && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                    {
                                        array_push($dataPoints, array(
                                            $jsTimestamp,
                                            $mybalance
                                        ));
                                    }

                                    if ($interval == "month")
                                    {
                                        if (strtotime($validation_to_date) == strtotime(date("Y-m-t h:i:sa", $timestamp)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                        {
                                            array_push($dataPoints, array(
                                                $jsTimestamp,
                                                $mybalance
                                            ));
                                        }
                                    }

                                    if ($interval == "year")
                                    {
                                        if (strtotime($validation_to_date) == strtotime(date("Y-12-t h:i:sa", $timestamp)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                        {
                                            array_push($dataPoints, array(
                                                $jsTimestamp,
                                                $mybalance
                                            ));
                                        }
                                    }

                                    $timestamp = strtotime($validation_to_date);
                                    $next_timestamp = strtotime("-1 day", $timestamp);
                                    $validation_to_date = date("Y-m-d", $next_timestamp);

                                }
                                while ((strtotime(date("Y-m-d", $parts[0] / 1000)) < strtotime($validation_to_date)) );

                                if ($prev_date != $javaScriptTimestamp)
                                {
                                    if ($interval == "day" && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                    {

                                        array_push($dataPoints, array(
                                            $javaScriptTimestamp,
                                            $mybalance
                                        ));
                                    }

                                    if ($interval == "month")
                                    {

                                        if (strtotime($validation_to_date) == strtotime(date("Y-m-t", $parts[0] / 1000)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                        {
                                            array_push($dataPoints, array(
                                                $javaScriptTimestamp,
                                                $mybalance
                                            ));
                                        }
                                    }

                                    if ($interval == "year")
                                    {
                                        if (strtotime($validation_to_date) == strtotime(date("Y-12-t", $parts[0] / 1000)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                        {
                                            array_push($dataPoints, array(
                                                $javaScriptTimestamp,
                                                $mybalance
                                            ));
                                        }
                                    }

                                }
                                $prev_date = $javaScriptTimestamp;
                            //}

                            $count++;
                            $stop_count--;
                        }
                    }
                    else
                    {
                        do
                        {
                            $timestamp = strtotime($validation_to_date);
                            $jsTimestamp = $timestamp * 1000;

                            if ($interval == "day" && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                            {
                                array_push($dataPoints, array(
                                    $jsTimestamp,
                                    $mybalance
                                ));
                            }

                            if ($interval == "month")
                            {
                                if (strtotime($validation_to_date) == strtotime(date("Y-m-t h:i:sa", $timestamp)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                {
                                    array_push($dataPoints, array(
                                        $jsTimestamp,
                                        $mybalance
                                    ));
                                }
                            }

                            if ($interval == "year")
                            {
                                if (strtotime($validation_to_date) == strtotime(date("Y-m-t h:i:sa", $timestamp)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                {
                                    array_push($dataPoints, array(
                                        $jsTimestamp,
                                        $mybalance
                                    ));
                                }
                            }

                            $timestamp = strtotime($validation_to_date);
                            $next_timestamp = strtotime("-1 day", $timestamp);
                            $validation_to_date = date("Y-m-d", $next_timestamp);

                        }
                        while (strtotime($validation_from_date) <= strtotime($validation_to_date));
                    }

                    echo json_encode($dataPoints);
                    //echo json_encode($log);
                    
                }
                else
                {
                    $log["data"] = "not connected xero";
                    echo json_encode($log);
                }
            }
            else
            {
                $log["data"] = "empty";
                echo json_encode($log);
            }
        }
        else
        {
            $log["data"] = "get";
            echo json_encode($log);
        }
    }

    public function loadCashInOut(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if ($request->input('interval') != "" && $request->input('from_date') != "" && $request->input('to_date') != "")
            {
                if (XeroController::checkIfExpires() == "ok")
                {

                    $xero_info = XeroController::checkIfConnected();
                    $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                        ->where("status", "=", "1")
                        ->first();

                    $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                    $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                    $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                        ->where("status", "=", "1")
                        ->first();
                    $xeroTenantId = (string)$tenant_info->tenant_id;

                    $ifModifiedSince = "";
                    $where = 'BankAccountType="BANK"';
                    $order = "";

                    $main_array_cashin = array();
                    $main_array_cashout = array();

                    try
                    {
                        $baccountresult = $apiInstance->getAccounts($xeroTenantId, $ifModifiedSince, $where, $order);

                        $baccountresult_arr = json_decode($baccountresult, true);

                        $bank_account_count = 0;
                        if (count($baccountresult_arr["Accounts"]) > 0)
                        {
                            foreach ($baccountresult_arr["Accounts"] as $bankaccount_values)
                            {
                                $bank_account_count++;
                                $cashin = "";
                                $cashout = "";

                                $bank_acc_id = $bankaccount_values["AccountID"];
                                $cashin = "";
                                $cashout = "";

                                $user_to_date = $request->input('to_date');

                                $interval = $request->input('interval');
                                $from_date = $request->input('from_date');
                                $to_date = date("Y-m-d");

                                $from_date_split = explode("-", $from_date);
                                $to_date_split = explode("-", $to_date);

                                $user_to_date_split = explode("-", $user_to_date);

                                if ($interval == "day")
                                {
                                    $from_date2 = date($from_date_split[0] . "-" . $from_date_split[1] . "-" . $from_date_split[2]);
                                    $to_date2 = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . $to_date_split[2]);

                                    $to_date3 = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . $to_date_split[2] . " h:i:sa");

                                    $from_date = $from_date_split[0] . "," . $from_date_split[1] . "," . $from_date_split[2];
                                    $to_date = $to_date_split[0] . "," . $to_date_split[1] . "," . $to_date_split[2];

                                    $validation_from_date = date($from_date_split[0] . "-" . $from_date_split[1] . "-" . $from_date_split[2] . " h:i:sa");
                                    $validation_to_date = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . $to_date_split[2] . " h:i:sa");
                                    $user_validation_to_date = date($user_to_date_split[0] . "-" . $user_to_date_split[1] . "-" . $user_to_date_split[2] . " h:i:sa");
                                }

                                if ($interval == "month")
                                {
                                    $from_date2 = date($from_date_split[0] . "-" . $from_date_split[1] . "-01");

                                    $todate_forlastday = date($to_date_split[0] . "-" . $to_date_split[1] . "-01");
                                    $user_todate_forlastday = date($user_to_date_split[0] . "-" . $user_to_date_split[1] . "-01");

                                    $to_date2 = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . date("t", strtotime($todate_forlastday)));

                                    $to_date3 = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . date("t", strtotime($todate_forlastday)) . " h:i:sa");

                                    $from_date = 'DateTime(' . $from_date_split[0] . "," . $from_date_split[1] . ',01)';
                                    $to_date = 'DateTime(' . $to_date_split[0] . "," . $to_date_split[1] . "," . date("t", strtotime($todate_forlastday)) . ')';

                                    $validation_from_date = date($from_date_split[0] . "-" . $from_date_split[1] . "-01 h:i:sa");
                                    $validation_to_date = date($to_date_split[0] . "-" . $to_date_split[1] . "-" . date("t", strtotime($todate_forlastday)) . " h:i:sa");
                                    $user_validation_to_date = date($user_to_date_split[0] . "-" . $user_to_date_split[1] . "-" . date("t", strtotime($user_todate_forlastday)) . " h:i:sa");
                                }

                                if ($interval == "year")
                                {
                                    $from_date2 = date($from_date_split[0] . "-01-01");

                                    $todate_forlastday = date($to_date_split[0] . "-12-01");
                                    $user_todate_forlastday = date($user_to_date_split[0] . "-12-01");

                                    $to_date2 = date($to_date_split[0] . "-12-" . date("t", strtotime($todate_forlastday)));

                                    $to_date3 = date($to_date_split[0] . "-12-" . date("t", strtotime($todate_forlastday)) . " h:i:sa");

                                    $from_date = 'DateTime(' . $from_date_split[0] . ',01,01)';
                                    $to_date = 'DateTime(' . $to_date_split[0] . ",12," . date("t", strtotime($todate_forlastday)) . ')';

                                    $validation_from_date = date($from_date_split[0] . "-01-01 h:i:sa");
                                    $validation_to_date = date($to_date_split[0] . "-12-" . date("t", strtotime($todate_forlastday)));
                                    $user_validation_to_date = date($user_to_date_split[0] . "-12-" . date("t", strtotime($user_todate_forlastday)) . " h:i:sa");
                                }

                                $mainphpTimestamp = strtotime($to_date3);
                                $mainjavaScriptTimestamp = $mainphpTimestamp * 1000;

                                $ifModifiedSince = "";
                                $where = 'BankAccount.AccountID==GUID("' . $bank_acc_id . '") && Date >= DateTime(' . $from_date . ') && Date <= DateTime(' . $to_date . ')';
                                //$where = 'BankAccount.AccountID==GUID("'.$bank_acc_id.'") && Date >= DateTime('.$from_date_split[0].', '.$from_date_split[1].', '.$from_date_split[2].') && Date <= DateTime('.$to_date_split[0].', '.$to_date_split[1].', '.$to_date_split[2].')';
                                $order = "Date DESC";
                                $page = "";
                                $unitdp = "";
                                $
                                {
                                    "btresult" . $bank_acc_id
                                } = $apiInstance->getBankTransactions($xeroTenantId, $ifModifiedSince, $where, $order, $page, $unitdp);
                                $btresult_arr = json_decode($
                                {
                                    "btresult" . $bank_acc_id
                                }
                                , true);

                                $count = 0;
                                $prev_value = "0";
                                $prev_type = "0";
                                $prev_date = "";

                                $to_date_final = "";
                                $from_date_final = "";
                                $stop_count = 0;

                                $recieved_value = 0;
                                $spent_value = 0;

                                $dataPoints = array();

                                if (count($btresult_arr["BankTransactions"]) > 0)
                                {

                                    foreach ($btresult_arr["BankTransactions"] as $btvalues)
                                    {
                                        if ($btvalues["IsReconciled"] == true && $btvalues["Status"] == "AUTHORISED")
                                        {
                                            $date = str_replace('/Date(', '', $btvalues['Date']);
                                            $parts = explode('+', $date);

                                            $phpDate = date("Y-m-d h:i:sa", $parts[0] / 1000);
                                            $start_date = date("Y-m-d h:i:sa", $parts[0] / 1000);

                                            $phpTimestamp = strtotime($phpDate);
                                            $javaScriptTimestamp = $phpTimestamp * 1000;

                                            $prev_value = $btvalues["Total"];
                                            //if ($btvalues['Type'] == "RECEIVE" || $btvalues['Type'] == "RECEIVE-TRANSFER")
                                            if ($btvalues['Type'] == "RECEIVE")
                                            {
                                                $prev_type = "plus";
                                            }

                                            if ($btvalues['Type'] == "SPEND")
                                            {
                                                $prev_type = "minus";
                                            }

                                            //if ($count > 0)
                                            //{
                                            if ($prev_type == "minus")
                                            {
                                                $spent_value += $prev_value;
                                            }
                                            else
                                            {
                                                $recieved_value += $prev_value;
                                            }

                                            /*if ($prev_date == $javaScriptTimestamp)
                                                {
                                                    continue;
                                                }*/
                                            //}
                                            

                                            do
                                            {
                                                $timestamp = strtotime($validation_to_date);
                                                $jsTimestamp = $timestamp * 1000;

                                                if ($interval == "day" && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                                {
                                                    if (isset($main_array_cashin[date('M-Y', $timestamp) ]))
                                                    {
                                                        $main_array_cashin[date('M-Y', $timestamp) ] += $recieved_value;
                                                    }
                                                    else
                                                    {
                                                        $main_array_cashin[date('M-Y', $timestamp) ] = 0;
                                                    }

                                                    if (isset($main_array_cashout[date('M-Y', $timestamp) ]))
                                                    {
                                                        $main_array_cashout[date('M-Y', $timestamp) ] += $spent_value;
                                                    }
                                                    else
                                                    {
                                                        $main_array_cashout[date('M-Y', $timestamp) ] = 0;
                                                    }

                                                    $recieved_value = 0;
                                                    $spent_value = 0;
                                                }

                                                if ($interval == "month")
                                                {
                                                    if (strtotime($validation_to_date) == strtotime(date("Y-m-t h:i:sa", $timestamp)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                                    {
                                                        if (isset($main_array_cashin[date('M-Y', $timestamp) ]))
                                                        {
                                                            $main_array_cashin[date('M-Y', $timestamp) ] += $recieved_value;
                                                        }
                                                        else
                                                        {
                                                            $main_array_cashin[date('M-Y', $timestamp) ] = 0;
                                                        }

                                                        if (isset($main_array_cashout[date('M-Y', $timestamp) ]))
                                                        {
                                                            $main_array_cashout[date('M-Y', $timestamp) ] += $spent_value;
                                                        }
                                                        else
                                                        {
                                                            $main_array_cashout[date('M-Y', $timestamp) ] = 0;
                                                        }

                                                        if ($prev_date != $javaScriptTimestamp && date("Y-m-d", ((int)$prev_date)) == date("Y-m-t", ((int)$prev_date)))
                                                        {
                                                            $recieved_value = 0;
                                                            $spent_value = 0;
                                                        }
                                                    }
                                                }

                                                if ($interval == "year")
                                                {
                                                    if (strtotime($validation_to_date) == strtotime(date("Y-12-t h:i:sa", $timestamp)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                                    {
                                                        if (isset($main_array_cashin[date('M-Y', $timestamp) ]))
                                                        {
                                                            $main_array_cashin[date('M-Y', $timestamp) ] += $recieved_value;
                                                        }
                                                        else
                                                        {
                                                            $main_array_cashin[date('M-Y', $timestamp) ] = 0;
                                                        }

                                                        if (isset($main_array_cashout[date('M-Y', $timestamp) ]))
                                                        {
                                                            $main_array_cashout[date('M-Y', $timestamp) ] += $spent_value;
                                                        }
                                                        else
                                                        {
                                                            $main_array_cashout[date('M-Y', $timestamp) ] = 0;
                                                        }

                                                        if ($prev_date != $javaScriptTimestamp && date("Y-m-d", ((int)$prev_date)) == date("Y-m-t", ((int)$prev_date)))
                                                        {
                                                            $recieved_value = 0;
                                                            $spent_value = 0;
                                                        }
                                                    }
                                                }

                                                $timestamp = strtotime($validation_to_date);
                                                $next_timestamp = strtotime("-1 day", $timestamp);
                                                $validation_to_date = date("Y-m-d", $next_timestamp);

                                            }
                                            while ((strtotime(date("Y-m-d", $parts[0] / 1000)) < strtotime($validation_to_date)) || ($prev_date >= (strtotime($validation_from_date) * 1000) && strtotime($validation_from_date) >= strtotime($validation_to_date)));

                                            if ($prev_date != $javaScriptTimestamp)
                                            {
                                                if ($interval == "day" && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                                {

                                                    if (isset($main_array_cashin[date('M-Y', $phpTimestamp) ]))
                                                    {
                                                        $main_array_cashin[date('M-Y', $phpTimestamp) ] += $recieved_value;
                                                    }
                                                    else
                                                    {
                                                        $main_array_cashin[date('M-Y', $phpTimestamp) ] = 0;
                                                    }

                                                    if (isset($main_array_cashout[date('M-Y', $phpTimestamp) ]))
                                                    {
                                                        $main_array_cashout[date('M-Y', $phpTimestamp) ] += $spent_value;
                                                    }
                                                    else
                                                    {
                                                        $main_array_cashout[date('M-Y', $phpTimestamp) ] = 0;
                                                    }

                                                    $recieved_value = 0;
                                                    $spent_value = 0;
                                                }

                                                if ($interval == "month")
                                                {

                                                    if (strtotime($validation_to_date) == strtotime(date("Y-m-t", $parts[0] / 1000)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                                    {
                                                        if (isset($main_array_cashin[date('M-Y', $phpTimestamp) ]))
                                                        {
                                                            $main_array_cashin[date('M-Y', $phpTimestamp) ] += $recieved_value;
                                                        }
                                                        else
                                                        {
                                                            $main_array_cashin[date('M-Y', $phpTimestamp) ] = 0;
                                                        }

                                                        if (isset($main_array_cashout[date('M-Y', $phpTimestamp) ]))
                                                        {
                                                            $main_array_cashout[date('M-Y', $phpTimestamp) ] += $spent_value;
                                                        }
                                                        else
                                                        {
                                                            $main_array_cashout[date('M-Y', $phpTimestamp) ] = 0;
                                                        }

                                                        if ($prev_date != $javaScriptTimestamp && date("Y-m-d", ((int)$prev_date)) == date("Y-m-t", ((int)$prev_date)))
                                                        {
                                                            $recieved_value = 0;
                                                            $spent_value = 0;
                                                        }
                                                    }
                                                }

                                                if ($interval == "year")
                                                {
                                                    if (strtotime($validation_to_date) == strtotime(date("Y-12-t", $parts[0] / 1000)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                                    {
                                                        if (isset($main_array_cashin[date('M-Y', $phpTimestamp) ]))
                                                        {
                                                            $main_array_cashin[date('M-Y', $phpTimestamp) ] += $recieved_value;
                                                        }
                                                        else
                                                        {
                                                            $main_array_cashin[date('M-Y', $phpTimestamp) ] = 0;
                                                        }

                                                        if (isset($main_array_cashout[date('M-Y', $phpTimestamp) ]))
                                                        {
                                                            $main_array_cashout[date('M-Y', $phpTimestamp) ] += $spent_value;
                                                        }
                                                        else
                                                        {
                                                            $main_array_cashout[date('M-Y', $phpTimestamp) ] = 0;
                                                        }

                                                        if ($prev_date != $javaScriptTimestamp && date("Y-m-d", ((int)$prev_date)) == date("Y-m-t", ((int)$prev_date)))
                                                        {
                                                            $recieved_value = 0;
                                                            $spent_value = 0;
                                                        }
                                                    }
                                                }

                                            }
                                            $prev_date = $javaScriptTimestamp;
                                        }

                                        $count++;
                                        $stop_count--;
                                    }
                                }
                                else
                                {
                                    do
                                    {
                                        $timestamp = strtotime($validation_to_date);
                                        $jsTimestamp = $timestamp * 1000;

                                        if ($interval == "day" && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                        {
                                            if (isset($main_array_cashin[date('M-Y', $timestamp) ]))
                                            {
                                                $main_array_cashin[date('M-Y', $timestamp) ] += 0;
                                            }
                                            else
                                            {
                                                $main_array_cashin[date('M-Y', $timestamp) ] = 0;
                                            }

                                            if (isset($main_array_cashout[date('M-Y', $timestamp) ]))
                                            {
                                                $main_array_cashout[date('M-Y', $timestamp) ] += 0;
                                            }
                                            else
                                            {
                                                $main_array_cashout[date('M-Y', $timestamp) ] = 0;
                                            }
                                        }

                                        if ($interval == "month")
                                        {
                                            if (strtotime($validation_to_date) == strtotime(date("Y-m-t h:i:sa", $timestamp)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                            {
                                                if (isset($main_array_cashin[date('M-Y', $timestamp) ]))
                                                {
                                                    $main_array_cashin[date('M-Y', $timestamp) ] += 0;
                                                }
                                                else
                                                {
                                                    $main_array_cashin[date('M-Y', $timestamp) ] = 0;
                                                }

                                                if (isset($main_array_cashout[date('M-Y', $timestamp) ]))
                                                {
                                                    $main_array_cashout[date('M-Y', $timestamp) ] += 0;
                                                }
                                                else
                                                {
                                                    $main_array_cashout[date('M-Y', $timestamp) ] = 0;
                                                }
                                            }
                                        }

                                        if ($interval == "year")
                                        {
                                            if (strtotime($validation_to_date) == strtotime(date("Y-m-t h:i:sa", $timestamp)) && strtotime($validation_to_date) <= strtotime($user_validation_to_date))
                                            {
                                                if (isset($main_array_cashin[date('M-Y', $timestamp) ]))
                                                {
                                                    $main_array_cashin[date('M-Y', $timestamp) ] += 0;
                                                }
                                                else
                                                {
                                                    $main_array_cashin[date('M-Y', $timestamp) ] = 0;
                                                }

                                                if (isset($main_array_cashout[date('M-Y', $timestamp) ]))
                                                {
                                                    $main_array_cashout[date('M-Y', $timestamp) ] += 0;
                                                }
                                                else
                                                {
                                                    $main_array_cashout[date('M-Y', $timestamp) ] = 0;
                                                }
                                            }
                                        }

                                        $timestamp = strtotime($validation_to_date);
                                        $next_timestamp = strtotime("-1 day", $timestamp);
                                        $validation_to_date = date("Y-m-d", $next_timestamp);

                                    }
                                    while (strtotime($validation_from_date) <= strtotime($validation_to_date));
                                }

                                //echo json_encode($dataPoints);
                                //echo json_encode($log);
                                

                                
                            }

                            //result diria
                            /*$main_array_cashin = array();
                            $main_array_cashout = array();
                            
                            $test1 = "";
                            $test2 = "";
                            
                            for($x = 1; $x <= $bank_account_count; $x++){
                                foreach( ${"main_array_cashin" . $x } as $key => $value ){
                                    
                                    if(isset($main_array_cashin[$key])){
                                        $main_array_cashin[$key] += $value;
                                    }
                                    else{
                                        $main_array_cashin[$key] = 0;
                                    }
                                }
                                
                                foreach( ${"main_array_cashout" . $x } as $key => $value ){
                                    
                                    if(isset($main_array_cashout[$key])){
                                        $main_array_cashout[$key] += $value;
                                    }
                                    else{
                                        $main_array_cashout[$key] = 0;
                                    }
                                }
                            }*/

                            $log["cashin"] = json_encode($main_array_cashin);
                            $log["cashout"] = json_encode($main_array_cashout);

                            echo json_encode($log);
                        }

                    }
                    catch(Exception $e)
                    {
                        echo 'Exception when calling AccountingApi->getAccounts: ', $e->getMessage() , PHP_EOL;
                    }
                }
                else
                {
                    $log["data"] = "not connected xero";
                    echo json_encode($log);
                }
            }
            else
            {
                $log["data"] = "empty";
                echo json_encode($log);
            }
        }
        else
        {
            $log["data"] = "get";
            echo json_encode($log);
        }
    }

    public function loadIndividualBankTransactions(Request $request)
    {
        if (isset($request["id"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $ifModifiedSince = "";
                $where = 'BankAccountType="BANK"';
                $order = "";

                $bank_acc_arrays = array();
                $my_bank_name = "";
                $list_bank = "";
                $acc_no = "";

                try
                {
                    $baccountresult = $apiInstance->getAccounts($xeroTenantId, $ifModifiedSince, $where, $order);

                    $baccountresult_arr = json_decode($baccountresult, true);

                    $bank_account_count = 0;
                    if (count($baccountresult_arr["Accounts"]) > 0)
                    {
                        foreach ($baccountresult_arr["Accounts"] as $bankaccount_values)
                        {
                            array_push($bank_acc_arrays, $bankaccount_values["AccountID"]);

                            if ($bankaccount_values["AccountID"] == $request["id"])
                            {
                                $my_bank_name = $bankaccount_values["Name"];
                                $acc_no = $bankaccount_values["BankAccountNumber"];
                            }
                            else
                            {
                                $list_bank .= '<li><a class="menu_a" href="' . url('/xero/BankTransactions/' . $bankaccount_values["AccountID"]) . '"><b>' . $bankaccount_values["Name"] . '</b>   ' . $bankaccount_values["BankAccountNumber"] . '</a></li>';
                            }
                        }
                    }
                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getAccounts: ', $e->getMessage() , PHP_EOL;
                }

                $statement_balance = 0;
                $fromDate2 = date("Y-m-d");
                $toDate2 = date("Y-m-d");
                
                $thisbankid = "";
                try
                {
                    $result = $apiInstance->getReportBankSummary($xeroTenantId, $fromDate2, $toDate2);

                    $arr = json_decode($result, true);
                    foreach ($arr["Reports"] as $values)
                    {
                        if (count($values["Rows"]) > 0)
                        {

                            foreach ($values["Rows"] as $main_value)
                            {

                                if ($main_value["RowType"] == "Section")
                                {
                                    foreach ($main_value["Rows"] as $main_row)
                                    {
                                        $main_count = 1;
                                        
                                        if ($main_row["RowType"] == "Row")
                                        {
                                            foreach ($main_row["Cells"] as $cells)
                                            {
                                                if ($main_count == 1)
                                                {

                                                    foreach ($cells["Attributes"] as $attributes)
                                                    {
                                                        $thisbankid = $attributes["Value"];
                                                    }
                                                }
                                                if ($main_count == 5 && $thisbankid == $request["id"])
                                                {
                                                    $statement_balance = number_format($cells["Value"], 2);
                                                }
                                                $main_count++;
                                            }
                                        }
                                    }
                                }

                            }
                        }
                    }
                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getAccounts: ', $e->getMessage() , PHP_EOL;
                }

                $data = "";
                $data_count = 0;
                $if_no_page = 0;
                $page_count = 1;

                do
                {
                    try
                    {
                        $ifModifiedSince = "";
                        $where = 'BankAccount.AccountID==GUID("' . $request["id"] . '")';

                        $order = "Date DESC";
                        $page = $page_count;
                        $unitdp = "";
                        $result = $apiInstance->getBankTransactions($xeroTenantId, $ifModifiedSince, $where, $order, $page, $unitdp);

                        $btresult_arr = json_decode($result, true);

                        if (count($btresult_arr["BankTransactions"]) > 0)
                        {
                            $page_count++;

                            foreach ($btresult_arr["BankTransactions"] as $btvalues)
                            {
                                if ($btvalues["Status"] == "AUTHORISED")
                                {
                                    $data_count++;

                                    $data .= '<tr>';
                                    $date = str_replace('/Date(', '', $btvalues['Date']);
                                    $parts = explode('+', $date);
                                    $date = date("d M, Y", $parts[0] / 1000);

                                    $data .= '<td>' . $data_count . '</td>';
                                    $data .= '<td class="fit">' . $date . '</td>';
                                    $bankTransactionID = $btvalues['BankTransactionID'];
                                    $unitdp = 4;

                                    $desc = "";
                                    $desc2 = "";

                                    $line_acc_id = "";

                                    foreach ($btvalues['LineItems'] as $lineval)
                                    {
                                        $desc2 = $lineval["Description"];
                                        $line_acc_id = $lineval["AccountID"];
                                    }

                                    $desc = isset($btvalues['Contact']["Name"]) ? $btvalues['Contact']["Name"] : $desc2;
                                    $data .= '<td><a>' . $desc . '<a></td>';
                                    $ref = "";
                                    if (isset($btvalues['Reference']))
                                    {
                                        $ref = $btvalues['Reference'];
                                    }
                                    $data .= '<td>' . $ref . '</td>';
                                    $pent = "";
                                    if ($btvalues['Type'] == "SPEND" || $btvalues['Type'] == "SPEND-TRANSFER")
                                    {
                                        $pent = number_format($btvalues['Total'], 2);
                                    }
                                    $data .= '<td class="text-align-right"><b>' . $pent . '</b></td>';

                                    $recieved = "";
                                    if ($btvalues['Type'] == "RECEIVE" || $btvalues['Type'] == "RECEIVE-TRANSFER")
                                    {
                                        $recieved = number_format($btvalues['Total'], 2);
                                    }
                                    $data .= '<td class="text-align-right"><b>' . $recieved . '</b></td>';

                                    /*if (in_array($line_acc_id, $bank_acc_arrays)){
                                        $data .= '<td >USER</td>';
                                    }
                                    else{
                                        $data .= '<td >BANK FEED</td>';
                                    }*/

                                    if ($btvalues["IsReconciled"] == true)
                                    {
                                        $data .= '<td class="fit"><h5><b style="color:green"><i class="fa fa-check"></i> Reconciled</b></h5></td>';
                                    }
                                    else
                                    {
                                        $data .= '<td></td>';
                                    }
                                    $data .= '</tr>';
                                }
                            }

                        }
                        else
                        {
                            $if_no_page = 1;
                            $page_count = 1;
                        }
                    }
                    catch(Exception $e)
                    {
                        echo 'Exception when calling AccountingApi->getBankTransactions: ', $e->getMessage() , PHP_EOL;
                    }
                }
                while ($if_no_page == 0);

                //start search for payments
                $if_no_page = 0;
                $page_count = 1;
                $data2 = "";
                $data_count = 0;
                do{
                    try{
                        $ifModifiedSince = "";
                        $where = 'Account.AccountID==GUID("'.$request["id"].'")';
                                                                            
                        $order = "Date DESC";
                        $page = $page_count;
                        $unitdp = "";
                        $result = $apiInstance->getPayments($xeroTenantId, $ifModifiedSince, $where, $order, $page);
                        
                        $btresult_arr = json_decode($result,true);
                                            
                        if(count($btresult_arr["Payments"]) > 0){
                            $page_count++;
                            
                            foreach($btresult_arr["Payments"] as $btvalues){
                                if($btvalues["Status"] == "AUTHORISED"){
                                    $data_count++;
                                    
                                    $data2 .= '<tr>';
                                    $date = str_replace('/Date(', '', $btvalues['Date']);
                                    $parts = explode('+', $date);
                                    $date = date("M-d, Y", $parts[0] / 1000);
                                    
                                    $data2 .= '<td>'.$data_count.'</td>';
                                    $data2 .= '<td class="fit">'.$date.'</td>';
                                    $bankTransactionID = $btvalues['PaymentID'];
                                    $unitdp = 4;
                                    
                                    $desc = "";
                                    
                                    $line_acc_id = "";
                                    
                                    
                                    $desc = isset($btvalues["Invoice"]['Contact']["Name"]) ? $btvalues["Invoice"]['Contact']["Name"] : "";
                                    $data2 .= '<td><a>'.$desc.'<a></td>';
                                    
                                    $ref = "";
                                    if(isset($btvalues['Reference'])){
                                        $ref = $btvalues['Reference'];
                                    }
                                    $data2 .= '<td>'.$ref.'</td>';
                                    
                                    $payment_types = array(
                                        "ACCRECPAYMENT" => "Accounts Receivable Payment",
                                        "ACCPAYPAYMENT" => "Accounts Payable Payment",
                                        "ARCREDITPAYMENT" => "Accounts Receivable Credit Payment (Refund)",
                                        "APCREDITPAYMENT" => "Accounts Payable Credit Payment (Refund)",
                                        "AROVERPAYMENTPAYMENT" => "Accounts Receivable Overpayment Payment (Refund)",
                                        "ARPREPAYMENTPAYMENT" => "Accounts Receivable Prepayment Payment (Refund)",
                                        "APPREPAYMENTPAYMENT" => "Accounts Payable Prepayment Payment (Refund)",
                                        "APOVERPAYMENTPAYMENT" => "Accounts Payable Overpayment Payment (Refund)"
                                    );
                                    
                                    $data2 .= '<td class="text-align-right">'.$payment_types[$btvalues['PaymentType']].'</td>';
                                    $data2 .= '<td class="text-align-right"><b>'.number_format($btvalues['BankAmount'], 2).'</b></td>';
                                    
                                    if($btvalues["IsReconciled"] == true){
                                        $data2 .= '<td class="fit"><h5><b style="color:green"><i class="fa fa-check"></i> Reconciled</b></h5></td>';
                                    }
                                    else{
                                        $data2 .= '<td></td>';
                                    }
                                    $data2 .= '</tr>';
                                }
                            }
                           
                        }
                        else{
                            $if_no_page = 1;
                            $page_count = 1;
                        }
                    }
                     catch (Exception $e) {
                      echo 'Exception when calling AccountingApi->getBankTransactions: ', $e->getMessage(), PHP_EOL;
                    }
                }
                while($if_no_page == 0);

                return view('xero.xeroaccounttransactions', compact('data', 'my_bank_name', 'list_bank', 'statement_balance', 'acc_no', 'data2'));
            }
        }
    }
    
    
    public function viewTransaction(Request $request)
    {
        if (isset($request["id"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);

                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                
            }
        }
    }
    
    
    public function loadProfitAndLossGraph(Request $request)
    {
        //isset($request["fromdate"]) && 
        if (isset($request["selecttype"]) && isset($request["todate"]) && isset($request["period"]) && isset($request["timeframe"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                //$fromDate = $request["fromdate"];
                $toDate = date($request["todate"] . "-t");
                $fromDate = date($request["todate"] . "-01");
                
                
                $periods = $request["period"];
                $timeframe = $request["timeframe"];
                
                $selecttype = $request["selecttype"];
                
                $trackingCategoryID = "";
                $trackingCategoryID2 = "";
                $trackingOptionID = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = false;

                $table_data = "";

                try
                {
                    $result = $apiInstance->getReportProfitAndLoss($xeroTenantId, $fromDate, $toDate, $periods, $timeframe, $trackingCategoryID, $trackingCategoryID2, $trackingOptionID, $trackingOptionID2, $standardLayout, $paymentsOnly);

                    $arr = json_decode($result, true);
                    
                    $eval_data = "";
                    $header_array = array();
                    $value_array = array();
                    
                    foreach ($arr as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                if ($main_value["RowType"] == "Header")
                                {
                                    $cc = 0;
                                    foreach ($main_value["Cells"] as $cells)
                                    {
                                        if ($cc > 0)
                                        {
                                            array_push($header_array, $cells["Value"]);
                                        }
                                        $cc++;
                                    }
                                }
                                
                                
                                if ($main_value["RowType"] == "Section")
                                {
                                    if(isset($main_value["Title"])){
                                        
                                        $cell_array = array();
                                        $row_title = "";
                                        
                                        foreach ($main_value["Rows"] as $main_row)
                                        {
                                            $row_title = $main_value["Title"];
                                            
                                            if($selecttype == "SR"){
                                                if($row_title == "Income"){
                                                    
                                                    $cell_array = array();
                                                    
                                                    if ($main_row["RowType"] == "Row")
                                                    {
                                                        $cc = 0;
                                                        $array_count = 0;
                                                        
                                                        $income_title  = "";
                                                        foreach ($main_row["Cells"] as $main_cells)
                                                        {
                                                            $value = $main_cells["Value"];
                                                            if ($cc > 0)
                                                            {
                                                                if ($main_cells["Value"] != "")
                                                                {
                                                                    $value = $main_cells["Value"];
                                                                }
                                                                else{
                                                                    $value = 0;
                                                                }
                                                                
                                                                array_push($cell_array, array($header_array[$array_count], $value));
                                                                $array_count++;
                                                            }
                                                            else{
                                                                $income_title = $main_cells["Value"];
                                                            }
                                                            $cc++;
                                                        }
                                                        
                                                        array_push($value_array, array($income_title  => $cell_array ));
                                                    }
                                                }
                                            }
                                            
                                            if($selecttype == "GPNP"){
                                                if ($main_row["RowType"] == "Row")
                                                {
                                                    $cc = 0;
                                                    $array_count = 0;
                                                    foreach ($main_row["Cells"] as $main_cells)
                                                    {
                                                        $value = $main_cells["Value"];
                                                        if ($cc > 0)
                                                        {
                                                            if ($main_cells["Value"] != "")
                                                            {
                                                                $value = $main_cells["Value"];
                                                            }
                                                            else{
                                                                $value = 0;
                                                            }
                                                            if($row_title == "Gross Profit" || $row_title == "Net Profit"){
                                                                array_push($cell_array, array($header_array[$array_count], $value));
                                                            }
                                                            $array_count++;
                                                        }
                                                        else{
                                                            $row_title = $value;
                                                        }
                                                        $cc++;
                                                    }
                                                }
                                            }
                                            
                                            if($selecttype == "TICS" || $selecttype == "TIOE"){
                                                if ($main_row["RowType"] == "SummaryRow")
                                                {
                                                    $cc = 0;
                                                    $array_count = 0;
                                                    foreach ($main_row["Cells"] as $main_cells)
                                                    {
                                                        $value = $main_cells["Value"];
                                                        if ($cc > 0)
                                                        {
                                                            if ($main_cells["Value"] != "")
                                                            {
                                                                $value = $main_cells["Value"];
                                                            }
                                                            else{
                                                                $value = 0;
                                                            }
                                                            if($selecttype == "TICS"){
                                                                if($row_title == "Total Income" || $row_title == "Total Cost of Sales"){
                                                                    array_push($cell_array, array($header_array[$array_count], $value));
                                                                }
                                                            }
                                                            
                                                            if($selecttype == "TIOE"){
                                                                if($row_title == "Total Income" || $row_title == "Total Operating Expenses"){
                                                                    array_push($cell_array, array($header_array[$array_count], $value));
                                                                }
                                                            }
                                                            $array_count++;
                                                        }
                                                        else{
                                                            $row_title = $value;
                                                        }
                                                        $cc++;
                                                    }
                                                }
                                            }
                                        }
                                        
                                        if($selecttype == "TICS" || $selecttype == "TIOE" || $selecttype == "GPNP" ){
                                            array_push($value_array, array($row_title  => $cell_array ));
                                        }
                                    }
                                }
                            }

                        }

                    }

                    echo json_encode($value_array);

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getReportTrialBalance: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }
    
    public static function cleanString($string) {
       $string = str_replace(' ', '', $string); // Replaces all spaces with hyphens.
    
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    
    public function loadExecutiveSummary(Request $request)
    {
        if (isset($request["fromdate"]) && isset($request["selecttype"]) && isset($request["todate"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $fromDate = date($request["fromdate"] . "-t h:i:sa");
                $fromDate2 = date($request["fromdate"] . "-01");
                
                $toDate = $request["todate"];
                
                $selecttype = $request["selecttype"];
                $percent = $request["percent"];
                
                $selecttype = explode(",", $selecttype);
                
                $now = date($toDate."-t h:i:sa");
                $value_array = array();
                
                $date = date($toDate."-t");
                
                for($xx = 0; $xx <= count($selecttype) - 1; $xx++){
                    $cleaned_var = XeroController::cleanString($selecttype[$xx]);
                    
                    ${$cleaned_var."_array"} = array();
                }
                
                $Debtors_array = array();
                $Income_array = array();
                
                $Averagedebtordays_array = array();
                
                do{
                    try {
                      $result = $apiInstance->getReportExecutiveSummary($xeroTenantId, $date);
                      
                      $arr = json_decode($result, true);
                        
                        $eval_data = "";
                        $header_array = array();
                        
                        foreach ($arr as $value)
                        {
                            if (count($value[0]["Rows"]) > 0)
                            {
                                //var_dump( $value[0]["Rows"]) . "<br>";
                                //echo '<pre>'; print_r($value[0]["Rows"]); echo '</pre>';
                                foreach ($value[0]["Rows"] as $main_value)
                                {
                                    if ($main_value["RowType"] == "Header")
                                    {
                                        $cc = 0;
                                        foreach ($main_value["Cells"] as $cells)
                                        {
                                            if ($cc > 0 && $cc != count($main_value["Cells"]) - 1)
                                            {
                                                array_push($header_array, $cells["Value"]);
                                            }
                                            $cc++;
                                        }
                                    }
                                    
                                    
                                    if ($main_value["RowType"] == "Section")
                                    {
                                        foreach ($main_value["Rows"] as $main_row)
                                        {
                                            if ($main_row["RowType"] == "Row"){
                                                $row_title = "";
                                                
                                                $cc = 0;
                                                $array_count = 0;
                                                
                                                $cell_array = array();
                                                foreach ($main_row["Cells"] as $main_cells){
                                                    $value = $main_cells["Value"];
                                                    if ($cc > 0){
                                                        if($cc != count($main_row["Cells"]) - 1){
                                                            if ($main_cells["Value"] != ""){
                                                                $value = $main_cells["Value"];
                                                            }
                                                            else{
                                                                $value = 0;
                                                            }
                                                            
                                                            $value = str_replace('%', '', $value);
                                                            if (in_array($row_title, $selecttype) || ($row_title == "Debtors" || $row_title == "Income")){
                                                                
                                                                $cleaned_var = XeroController::cleanString($row_title);
                                                                
                                                                $item_date = date("Y-m-01", strtotime($header_array[$array_count]));
                                                                
                                                                if(strtotime($fromDate2) <= strtotime($item_date)){
                                                                    
                                                                    if($row_title == "Average debtors days"){
                                                                        $income_value = 0;
                                                                        foreach($Income_array as $incomearr){
                                                                            if($incomearr[0] == $header_array[$array_count]){
                                                                                $income_value =  $incomearr[1];
                                                                            }
                                                                        }
                                                                        
                                                                        if($percent > 0){
                                                                            $income_value = $income_value - ($income_value * ($percent/100));
                                                                        }
                                                                        
                                                                        $debtors_value = 0;
                                                                        foreach($Debtors_array as $debtorsarr){
                                                                            if($debtorsarr[0] == $header_array[$array_count]){
                                                                                $debtors_value =  $debtorsarr[1];
                                                                            }
                                                                        }
                                                                        
                                                                        if($income_value <= 0 || $debtors_value <= 0){
                                                                            $value = 0;
                                                                        }
                                                                        else{
                                                                            $no_days = date("t", strtotime($header_array[$array_count]));
                                                                            $value = ($debtors_value / $income_value) * $no_days;   
                                                                        }
                                                                        
                                                                    }
                                                                    
                                                                    array_push(${$cleaned_var."_array"}, array($header_array[$array_count], number_format($value, 2, '.', '')));
                                                                }
                                                                
                                                            }
                                                            $array_count++;
                                                        }
                                                    }
                                                    else{
                                                        $row_title = $value;
                                                    }
                                                    $cc++;
                                                }
                                                if (in_array($row_title, $selecttype)){
                                                    
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    
                    } catch (Exception $e) {
                      echo 'Exception when calling AccountingApi->getReportExecutiveSummary: ', $e->getMessage(), PHP_EOL;
                    }
                    
                    $phpTimestamp = strtotime($now);
                    $future_timestamp = strtotime("-2 month", $phpTimestamp);           
                    $to = date("Y-m-t", $future_timestamp);
                    $now = date("Y-m-t h:i:sa", $future_timestamp);
                    
                    $date = $to;
                }
                while(strtotime($now) >= strtotime($fromDate));
                
                for($xx = 0; $xx <= count($selecttype) - 1; $xx++){
                    $cleaned_var = XeroController::cleanString($selecttype[$xx]);
                    array_push($value_array,array($selecttype[$xx] => ${$cleaned_var."_array"}));
                }
                
                echo json_encode($value_array);
            }
        }
    }
    
    
    public function loadStatementBalanceFromBalanceSheet(Request $request)
    {
        if (null !== $request->input("xx") && null !== $request->input("from_date") && null !== $request->input("interval") && null !== $request->input("to_date"))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                $interval_type = $request->input("interval");
                
                $periods = 0;
                $period_no = 1;
                
                if($interval_type == "MONTH" || $interval_type == "QUARTER"){
                    $fromDate = date_create(date($request->input("from_date") . "-t"));
                    $toDate = date_create(date($request->input("to_date") . "-t"));
                     
                    $interval = date_diff($fromDate, $toDate);
                    //$interval->format('%R%y years %m months');
                    
                    $years_month = $interval->format('%R%y') * 12;
                    $periods = $years_month + $interval->format('%m');
                    
                    while($periods > 11){
                        $periods = $periods - 11;
                        $period_no++;
                    }
                    
                    $date = date($request->input("to_date") . "-t");
                }
                else{
                    $fromDate = date_create(date($request->input("from_date") . "-12-t"));
                    $toDate = date_create(date($request->input("to_date") . "-12-t"));
                    
                    $interval = date_diff($fromDate, $toDate);
                    //$interval->format('%R%y years %m months');
                    
                    $periods = $interval->format('%R%y');
                    
                    while($periods > 11){
                        $periods = $periods - 11;
                        $period_no++;
                    }
                    
                    $date = date($request->input("to_date") . "-12-t");
                }
                
                
                $value_array = array();
                $statement_balance_array = array();
                
                //xero param
                
                while($period_no > 0){
                    
                    
                    $final_period = 0;
                    if($period_no > 1 ){
                        $final_period = 11;
                    }
                    else{
                        $final_period = $periods;
                    }
                    
                    
                    
                    $timeframe = $interval_type;
                    $trackingOptionID1 = "";
                    $trackingOptionID2 = "";
                    $standardLayout = true;
                    $paymentsOnly = false;
    
                    $header_array = array();
                    
                    $if_have_bank = 0;
    
                    try
                    {
                        $result = $apiInstance->getReportBalanceSheet($xeroTenantId, $date, $final_period, $timeframe, $trackingOptionID1, $trackingOptionID2, $standardLayout, $paymentsOnly);
                        $arr = json_decode($result, true);
                        
                        
                        foreach ($arr as $value)
                        {
                            if (count($value[0]["Rows"]) > 0)
                            {
                                foreach ($value[0]["Rows"] as $main_value)
                                {
                                    if ($main_value["RowType"] == "Header")
                                    {
                                        $cc = 0;
                                        foreach ($main_value["Cells"] as $cells)
                                        {
                                            if ($cc > 0)
                                            {
                                                array_push($header_array, $cells["Value"]);
                                            }
                                            
                                            if($cc == count($main_value["Cells"]) - 1){
                                                if($interval_type == "MONTH"){
                                                    $date = date("Y-m-t",strtotime("-1 month",strtotime($cells["Value"])));
                                                }
                                                else{
                                                    $date = date("Y-12-t",strtotime("-1 year",strtotime($cells["Value"])));
                                                }
                                            }
                                            $cc++;
                                        }
                                    }
    
                                    if ($main_value["RowType"] == "Section")
                                    {
                                        if( (isset($main_value["Title"]) ? $main_value["Title"] : "") == "Bank" ){
                                            $if_have_bank++;
                                            
                                            foreach ($main_value["Rows"] as $main_row)
                                            {
                                                if ($main_row["RowType"] == "Row")
                                                {
                                                    $cc = 0;
                                                    $acc_id = "";
                                                    $array_count = 0;
                                                    
                                                    foreach ($main_row["Cells"] as $main_cells)
                                                    {
                                                        $value = $main_cells["Value"];
                                                        if ($cc > 0)
                                                        {
                                                            if ($main_cells["Value"] != "")
                                                            {
                                                                $value = $main_cells["Value"];
                                                            }
                                                            else{
                                                                $value = 0;
                                                            }
                                                            
                                                            if($acc_id == $request->input("xx")){
                                                                $label = explode(" ",$header_array[$array_count]);
                                                                array_push($statement_balance_array, array($label[1] . " " . $label[2], $value));
                                                                $array_count++;
                                                            }
                                                        }
                                                        else
                                                        {
                                                            
                                                            if (isset($main_cells["Attributes"]))
                                                            {
                                                                foreach ($main_cells["Attributes"] as $value)
                                                                {
                                                                    $acc_id = $value["Value"];
                                                                }
                                                            }
                                                        }
                                                        $cc++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                
                                if($if_have_bank == 0){
                                    for($x = 0; $x <= count($header_array) - 1; $x++){
                                        $label = explode(" ",$header_array[$x]);
                                        array_push($statement_balance_array, array($label[1] . " " . $label[2], 0));
                                    }
                                }
                            }
    
                        }
                    }
                    catch(Exception $e)
                    {
                        echo 'Exception when calling AccountingApi->getReportBalanceSheet: ', $e->getMessage(), PHP_EOL;
                    }
                    
                    $period_no--;
                }
                
                echo json_encode($statement_balance_array);
            }
        }
    }
    
    public function loadBalanceSheetGraph(Request $request)
    {
        if (isset($request["date"]) && isset($request["period"]) && isset($request["timeframe"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $date = date($request["date"] . "-t");
                
                $periods = $request["period"];
                $timeframe = $request["timeframe"];
                
                $trackingOptionID1 = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = false;

                try
                {
                    $result = $apiInstance->getReportBalanceSheet($xeroTenantId, $date, $periods, $timeframe, $trackingOptionID1, $trackingOptionID2, $standardLayout, $paymentsOnly);

                    $arr = json_decode($result, true);
                    
                    $eval_data = "";
                    $header_array = array();
                    $value_array = array();
                    
                    $lia_array = array();
                    $eq_array = array();
                    $ass_array = array();
                    
                    foreach ($arr as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                if ($main_value["RowType"] == "Header")
                                {
                                    $cc = 0;
                                    foreach ($main_value["Cells"] as $cells)
                                    {
                                        if ($cc > 0)
                                        {
                                            array_push($header_array, $cells["Value"]);
                                        }
                                        $cc++;
                                    }
                                }
                                
                                
                                if ($main_value["RowType"] == "Section")
                                {
                                    $row_title = "";
                                    
                                        foreach ($main_value["Rows"] as $main_row)
                                        {
                                            $row_title = $main_value["Title"];
                                            
                                            if ($main_row["RowType"] == "SummaryRow"){
                                                $cell_array = array();
                                                    
                                                $cc = 0;
                                                $array_count = 0;
                                                        
                                                $income_title  = "";
                                                foreach ($main_row["Cells"] as $main_cells)
                                                {
                                                    $value = $main_cells["Value"];
                                                    if ($cc > 0)
                                                    {
                                                        if ($main_cells["Value"] != "")
                                                        {
                                                            $value = $main_cells["Value"];
                                                        }
                                                        else{
                                                            $value = 0;
                                                        }
                                                        
                                                        $header_split = explode(" ", $header_array[$array_count]);
                                                        array_push($cell_array, array($header_split[1] . " " . $header_split[2],$value));
                                                        $array_count++;
                                                    }
                                                    else{
                                                        $income_title = $main_cells["Value"];
                                                    }
                                                    $cc++;
                                                }
                                                
                                                if($income_title == "Total Assets" || $income_title == "Total Liabilities" || $income_title == "Total Equity"){   
                                                    array_push($value_array, array($income_title  => $cell_array ));
                                                    
                                                    if($income_title == "Total Assets"){
                                                        //array_push($ass_array, $cell_array);
                                                        $ass_array = $cell_array;
                                                    }
                                                    
                                                    if($income_title == "Total Liabilities"){
                                                        //array_push($lia_array ,$cell_array);
                                                        $lia_array =$cell_array;
                                                    }
                                                    
                                                    if($income_title == "Total Equity"){
                                                        //array_push($eq_array, $cell_array);
                                                        $eq_array= $cell_array;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            

                        }

                    }
                    
                    $diff_array = array();
                    
                    $count = 0;
                    foreach($header_array as $header_val){
                        $sum = $lia_array[$count][1] + $eq_array[$count][1];
                        
                        $total = bcsub($sum,$ass_array[$count][1]);
                        
                        //array_push($diff_array, ($sum - $ass_array[$count][1] ) );
                        array_push($diff_array, array($header_val, $total));
                        //array_push($diff_array, $ass_array[$count][1]);
                        $count++;
                    }
                    //print_r($diff_array);
                    
                    //array_push($value_array, array( "Difference" => $diff_array));
                    echo json_encode(array_reverse($value_array));

                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->getReportTrialBalance: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }
    
    public function getBankStatementsPlus(Request $request){
        if (isset($request["fromdate"]) && isset($request["todate"]) && isset($request["id"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new XeroAPI\XeroPHP\Api\FinanceApi(
                    new GuzzleHttp\Client(),
                    $config
                );
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                $bankAccountID = $request["id"];
                $fromDate = $request["fromdate"];
                $toDate = $request["todate"];
                $summaryOnly = true;
                
                try {
                  $result = $apiInstance->getBankStatementAccounting($xeroTenantId, $bankAccountID, $fromDate, $toDate, $summaryOnly);
                  $arr = json_decode($result, true);
                  
                  print_r($arr);
                  
                } catch (Exception $e) {
                  echo 'Exception when calling FinanceApi->getBankStatementAccounting: ', $e->getMessage(), PHP_EOL;
                }
            }
        }
    }
    
    
    public function loadAgedData(Request $request)
    {
        if (isset($request["id"]) && isset($request["type"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                $contactId = $request["id"];
                $date = "";
                $fromDate = "";
                $toDate = "";

                try
                {
                    if($request["type"] == "payables"){
                        $result = $apiInstance->getReportAgedPayablesByContact($xeroTenantId, $contactId, $date, $fromDate, $toDate);
                    }
                    else{
                        $result = $apiInstance->getReportAgedReceivablesByContact($xeroTenantId, $contactId, $date, $fromDate, $toDate);
                    }
                    
                    $arr = json_decode($result, true);
                    
                    $table_data = '';
                    foreach ($arr as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                
                                if ($main_value["RowType"] == "Section")
                                {
                                        foreach ($main_value["Rows"] as $main_row)
                                        {
                                            if ($main_row["RowType"] == "Row"){
                                                $table_data .= '<tr>';
                                                
                                                $count = 0;
                                                foreach ($main_row["Cells"] as $main_cells)
                                                {
                                                    $count++;
                                                    $value = $main_cells["Value"];
                                                    
                                                    $table_data .= '<td';
                                                    
                                                    if($count == 1 || $count == 3){
                                                        $value = date("M-d, Y", strtotime($value));
                                                    }
                                                    
                                                    if($count == 4){
                                                        $value = "<b style='color:red'>" . $value . "</b>";
                                                    }
                                                    
                                                    if($count == 5 || $count == 6 || $count == 7 || $count == 8){
                                                        $value = "<b>" . number_format($value, 2) . "</b>";
                                                        $table_data .= ' class="text-align-right" ';
                                                    }
                                                    
                                                    $table_data .= '>'.$value.'</td>';
                                                }
                                                $table_data .= '</tr>';
                                            }
                                            
                                            if ($main_row["RowType"] == "SummaryRow"){
                                                
                                                $table_data .= '<tr>';
                                                
                                                $count = 0;
                                                foreach ($main_row["Cells"] as $main_cells)
                                                {
                                                    $count++;
                                                    $value = $main_cells["Value"];
                                                    
                                                    $table_data .= '<td  style="border-top:3px double black !important" ';
                                                    
                                                    if($count == 1){
                                                        $value = "<b>" . $value . "</b>";
                                                    }
                                                    
                                                    if($count == 5 || $count == 6 || $count == 7 || $count == 8){
                                                        $value = "<b style='color:green'>" . number_format($value, 2) . "</b>";
                                                        $table_data .= ' class="text-align-right" ';
                                                    }
                                                    
                                                    $table_data .= '>'.$value.'</td>';
                                                }
                                                $table_data .= '</tr>';
                                            }
                                        }
                                    }
                                }
                            

                        }

                    }
                    
                    $type = $request["type"];
                    $contact_name = $request["name"];
                    
                    return view('xero.viewaged', compact('table_data', 'type', 'contact_name'));
                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->AgedData: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }
    
    
    public function getInvoicesGraph(Request $request)
    {
        if (isset($request["from_date"]) && isset($request["to_date"]) && isset($request["timeframe"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                $timeframe = $request["timeframe"];
                
                $from_explode = explode("-", $request["from_date"]);
                $to_explode = explode("-", $request["to_date"]);
                
                $from_date = "";
                $to_date = "";
                
                if($timeframe == "MONTH"){
                    $fromDate = 'DateTime('.$from_explode[0].','.$from_explode[1].',01)';
                    
                    $lastday = date("t", strtotime(date($request["to_date"] . "-t")));
                    $toDate = 'DateTime('.$to_explode[0].','.$to_explode[1].','.$lastday.')';
                    
                    $from_date = strtotime(date($from_explode[0]."-".$from_explode[1]."-01"));
                    $to_date = strtotime(date($to_explode[0]."-".$to_explode[1]."-".$lastday));
                }
                else{
                    $fromDate = 'DateTime('.$from_explode[0].',01,01)';
                    
                    $lastday = date("t", strtotime(date($request["to_date"] . "-12-t")));
                    $toDate = 'DateTime('.$to_explode[0].',12,'.$lastday.')';
                    
                    //$from_date = strtotime(date($from_explode[0]."-01-01"));
                    //$to_date = strtotime(date($to_explode[0]."-12-".$lastday));
                    
                    $from_date = $from_explode[0];
                    $to_date = $to_explode[0];
                }
                
                $ifModifiedSince = "";
                $where = 'Date >= ' . $fromDate . ' && Date <= '.$toDate;
                $order = "Date DESC";
                $iDs = "";
                $invoiceNumbers = "";
                $contactIDs = "";
                $statuses = "";
                $page = "";
                $includeArchived = true;
                $createdByMyApp = false;
                $unitdp = 4;
                $summaryOnly = false;
                
                $draft_array = array();
                $authorise_array = array();
                $paid_array = array();
                
                try {
                  $result = $apiInstance->getInvoices($xeroTenantId, $ifModifiedSince, $where, $order, $iDs, $invoiceNumbers, $contactIDs, $statuses, $page, $includeArchived, $createdByMyApp, $unitdp, $summaryOnly);
                  $arr = json_decode($result, true);
                  
                  foreach ($arr as $value)
                  {
                      if (count($value) > 0)
                        {
                            $prev_date = $to_date;
                            $authorise_amount = 0;
                            $draft_amount = 0;
                            $paid_amount = 0;
                            
                            $row_count = 0;
                            foreach ($value as $main_value)
                            {
                                $thisdate = str_replace('/Date(', '', $main_value['Date']);
                                $parts = explode('+', $thisdate);
                                
                                if($timeframe == "MONTH"){
                                    $thisdate = strtotime(date("Y-m-d", $parts[0] / 1000));
                                }
                                else{
                                    $thisdate = date("Y", $parts[0] / 1000);
                                }
                                
                                if($timeframe == "MONTH"){
                                    $prev_date_last_date = strtotime(date("Y-m-01",$prev_date));
                                }
                                else{
                                    $prev_date_last_date = $prev_date;
                                }
                                
                                
                                if($prev_date != $thisdate && $thisdate < $prev_date_last_date  ){
                                    if($timeframe == "MONTH"){
                                        $date_index = date("M-Y",$prev_date);
                                    }
                                    else{
                                        $date_index = $prev_date;
                                    }
                                    
                                    array_push($authorise_array, array($date_index, $authorise_amount));
                                    array_push($draft_array, array($date_index, $draft_amount));
                                    array_push($paid_array, array($date_index, $paid_amount));
                                    
                                    $authorise_amount = 0;
                                    $draft_amount = 0;
                                    $paid_amount = 0;
                                }
                                
                                if($main_value["Status"] == "AUTHORISED"){
                                    $authorise_amount += $main_value["Total"];
                                }
                                    
                                if($main_value["Status"] == "DRAFT"){
                                    $draft_amount += $main_value["Total"];
                                }
                                    
                                if($main_value["Status"] == "PAID"){
                                    $paid_amount += $main_value["Total"];
                                }
                                
                                $prev_date = $thisdate;
                                $row_count++;
                                
                                if($row_count >= count($value)){
                                    
                                    $date_now = strtotime("-1 month", strtotime(date("Y-m-01",$prev_date)));
                                    $date_year = ($prev_date);
                                    
                                    while( ($timeframe == "MONTH" && ($date_now >= $from_date)) || ($timeframe == "YEAR" && ($date_year >= $from_date)) ){
                                        if($timeframe == "MONTH"){
                                            $date_index = date("M-Y",$date_now);
                                            
                                            array_push($authorise_array, array($date_index, 0));
                                            array_push($draft_array, array($date_index, 0));
                                            array_push($paid_array, array($date_index, 0));
                                            
                                            $date_now = strtotime("-1 month", strtotime(date("Y-m-01",$date_now)));
                                        }
                                        else{
                                            array_push($authorise_array, array($date_year, 0));
                                            array_push($draft_array, array($date_year, 0));
                                            array_push($paid_array, array($date_year, 0));
                                            
                                            $date_year--;
                                        }
                                    }
                                    
                                }
                            }
                            
                            
                        }
                  }
                  
                  $value_array = array(array("DRAFT" => $draft_array), array("AUTHORISE" => $authorise_array), array("PAID" => $paid_array));
                  echo json_encode($value_array);
                  
                } catch (Exception $e) {
                  echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage(), PHP_EOL;
                }
            }
        }
    }
    
    public function loadProfitLossDashboard(Request $request){
        if (isset($request["from_date"]) && isset($request["to_date"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                $fromDate = $request["from_date"];
                $toDate = $request["to_date"];
                $periods = "";
                $timeframe = "";
                $trackingCategoryID = "";
                $trackingCategoryID2 = "";
                $trackingOptionID = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = $request["from_date"];
                
                $dashboard_data = "";
                
                $gross_profit = 0;
                $net_profit = 0;
                
                try {
                  $result = $apiInstance->getReportProfitAndLoss($xeroTenantId, $fromDate, $toDate, $periods, $timeframe, $trackingCategoryID, $trackingCategoryID2, $trackingOptionID, $trackingOptionID2, $standardLayout, $paymentsOnly);
                  
                  $arr = json_decode($result, true);

                    foreach ($arr as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                if ($main_value["RowType"] == "Section")
                                {
                                    $values_array = array();
                                    
                                    foreach ($main_value["Rows"] as $main_row)
                                    {
                                        if ($main_row["RowType"] == "Row")
                                        {
                                            $cc = 0;
                                            $key = "";
                                            $keyvalue = "";
                                            
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                if($cc == 0){
                                                    $key = $main_cells["Value"];
                                                }
                                                else{
                                                    $keyvalue = $main_cells["Value"];
                                                }
                                                $cc++;
                                            }
                                            
                                            $values_array[$key] = number_format($keyvalue, 2);
                                            
                                            if($key == "Net Profit"){
                                                $net_profit = $keyvalue;
                                            }
                                            
                                            if($key == "Gross Profit"){
                                                $gross_profit = $keyvalue;
                                            }
                                        }
                                        
                                        if ($main_row["RowType"] == "SummaryRow")
                                        {
                                            
                                            $dashboard_data .= '<div class="col-md-12">';
                                            $dashboard_data .= '<div class="card mb-2">';
                                            $dashboard_data .= '<div class="card-body">';
                                            
                                            $cc = 0;
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                if($cc == 0){
                                                    
                                                
                                                    $dashboard_data .= '<div class="card-header bank_header">';
                                                    $dashboard_data .= '<h4>'.$main_cells["Value"].'</h4>';
                                                    $dashboard_data .= '</div>';
                                                }
                                                else{
                                                    $symbol = Currencies::getSymbol(XeroController::getXeroCurrencies());
                                                    //$dashboard_data .= '<div class="card-body">'; number_format($main_cells["Value"], 2)
                                                    $dashboard_data .= "<h2><a data-toggle='tooltip' data-placement='top' title='".number_format($main_cells["Value"], 2)."' class='dashboard_details_a' name='".json_encode($values_array, JSON_HEX_APOS)."'><b class='cur_symbol'>".$symbol."</b> ".XeroController::bd_nice_number($main_cells["Value"]).'</a></h2>';
                                                    //$dashboard_data .= '</div>';
                                                }
                                                $cc++;
                                            }
                                            
                                            $dashboard_data .= '</div>';
                                            $dashboard_data .= '</div>';
                                            $dashboard_data .= '</div>';
                                            
                                            $values_array = array();
                                        }
                                    }
                                }
                                
                                if ($main_value["RowType"] == "SummaryRow")
                                {
                                    
                                }
                            }
                        }
                    }
                    
                    echo $dashboard_data . "<split>" . $gross_profit . "<split>" . $net_profit;
                    
                } catch (Exception $e) {
                  echo 'Exception when calling AccountingApi->getReportProfitAndLoss: ', $e->getMessage(), PHP_EOL;
                }
            }
        }
    }
    
    public function getManualJournalGraph(Request $request)
    {
        
        if (isset($request["from_date"]) && isset($request["to_date"]) && isset($request["timeframe"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                $timeframe = $request["timeframe"];
                
                $from_explode = explode("-", $request["from_date"]);
                $to_explode = explode("-", $request["to_date"]);
                
                $from_date = "";
                $to_date = "";
                
                if($timeframe == "MONTH"){
                    $fromDate = 'DateTime('.$from_explode[0].','.$from_explode[1].',01)';
                    
                    $lastday = date("t", strtotime(date($request["to_date"] . "-t")));
                    $toDate = 'DateTime('.$to_explode[0].','.$to_explode[1].','.$lastday.')';
                    
                    $from_date = strtotime(date($from_explode[0]."-".$from_explode[1]."-01"));
                    $to_date = strtotime(date($to_explode[0]."-".$to_explode[1]."-".$lastday));
                }
                else{
                    $fromDate = 'DateTime('.$from_explode[0].',01,01)';
                    
                    $lastday = date("t", strtotime(date($request["to_date"] . "-12-t")));
                    $toDate = 'DateTime('.$to_explode[0].',12,'.$lastday.')';
                    
                    //$from_date = strtotime(date($from_explode[0]."-01-01"));
                    //$to_date = strtotime(date($to_explode[0]."-12-".$lastday));
                    
                    $from_date = $from_explode[0];
                    $to_date = $to_explode[0];
                }
                
                $ifModifiedSince = "";
                $where = 'Date >= ' . $fromDate . ' && Date <= '.$toDate;
                $order = "Date DESC";
                $page = "";
                
                $draft_array = array();
                $posted_array = array();
                $voided_array = array();
                try {
                  $result = $apiInstance->getManualJournals($xeroTenantId, $ifModifiedSince, $where, $order, $page);
                  $arr = json_decode($result, true);
                  
                  
                  foreach ($arr as $value)
                  {
                      if (count($value) > 0)
                        {
                            $prev_date = $to_date;
                            
                            $posted_amount = 0;
                            $draft_amount = 0;
                            $voided_amount = 0;
                            
                            $row_count = 0;
                            foreach ($value as $main_value)
                            {
                                $thisdate = str_replace('/Date(', '', $main_value['Date']);
                                $parts = explode('+', $thisdate);
                                
                                if($timeframe == "MONTH"){
                                    $thisdate = strtotime(date("Y-m-d", $parts[0] / 1000));
                                }
                                else{
                                    $thisdate = date("Y", $parts[0] / 1000);
                                }
                                
                                if($timeframe == "MONTH"){
                                    $prev_date_last_date = strtotime(date("Y-m-01",$prev_date));
                                }
                                else{
                                    $prev_date_last_date = $prev_date;
                                }
                                
                                
                                if($prev_date != $thisdate && $thisdate < $prev_date_last_date  ){
                                    if($timeframe == "MONTH"){
                                        $date_index = date("M-Y",$prev_date);
                                    }
                                    else{
                                        $date_index = $prev_date;
                                    }
                                    
                                    array_push($posted_array, array($date_index, $posted_amount));
                                    array_push($draft_array, array($date_index, $draft_amount));
                                    array_push($voided_array, array($date_index, $voided_amount));
                                    
                                    $posted_amount = 0;
                                    $draft_amount = 0;
                                    $voided_amount = 0;
                                }
                                
                                if($main_value["Status"] == "POSTED"){
                                    $posted_amount += 1;
                                }
                                    
                                if($main_value["Status"] == "DRAFT"){
                                    $draft_amount += 1;
                                }
                                    
                                if($main_value["Status"] == "VOIDED"){
                                    $voided_amount += 1;
                                }
                                
                                $prev_date = $thisdate;
                                $row_count++;
                                
                                if($row_count >= count($value)){
                                    
                                    $date_now = strtotime("-1 month", strtotime(date("Y-m-01",$prev_date)));
                                    $date_year = ($prev_date);
                                    
                                    while( ($timeframe == "MONTH" && ($date_now >= $from_date)) || ($timeframe == "YEAR" && ($date_year >= $from_date)) ){
                                        if($timeframe == "MONTH"){
                                            $date_index = date("M-Y",$date_now);
                                            
                                            array_push($posted_array, array($date_index, 0));
                                            array_push($draft_array, array($date_index, 0));
                                            array_push($voided_array, array($date_index, 0));
                                            
                                            $date_now = strtotime("-1 month", strtotime(date("Y-m-01",$date_now)));
                                        }
                                        else{
                                            array_push($posted_array, array($date_year, 0));
                                            array_push($draft_array, array($date_year, 0));
                                            array_push($voided_array, array($date_year, 0));
                                            
                                            $date_year--;
                                        }
                                    }
                                    
                                }
                            }
                            
                            
                        }
                  }
                  
                  $value_array = array(array("DRAFT" => $draft_array), array("POSTED" => $posted_array), array("VOIDED" => $voided_array));
                  echo json_encode($value_array);
                  
                } catch (Exception $e) {
                  echo 'Exception when calling AccountingApi->getManualJournal: ', $e->getMessage(), PHP_EOL;
                }
            }
        }
    }
    
    public function businessPerformance(Request $request){
        if (isset($request["date"]) && isset($request["period"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                $date = $request["date"];
                $periods = $request["period"];
                $timeframe = "MONTH";
                $trackingOptionID1 = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = false;
                
                try {
                  $result = $apiInstance->getReportBalanceSheet($xeroTenantId, $date, $periods, $timeframe, $trackingOptionID1, $trackingOptionID2, $standardLayout, $paymentsOnly);
                  
                  $data = json_decode($result, true);
                  
                  return view('xero.businessperformance', compact('data'));
                  
                } catch (Exception $e) {
                  echo 'Exception when calling AccountingApi->getReportBalanceSheet: ', $e->getMessage(), PHP_EOL;
                }
            }
        }
    }
    
    public function loadFinancialEntries(Request $request){
        if (isset($request["date"]) && isset($request["timeframe"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {
                $income_array = array();
                $purchase_array = array();
                $costsale_array = array();
                $grossprofit_array = array();
                $directorfee_array = array();
                $totalremu_array = array();
                $medicalexpense_array = array();
                $travel_array = array();
                $entertainment_array = array();
                $debtinterest_array = array();
                $netprofit_array = array();
                $netprofitbefore_array = array();
                $inventories_array = array();
                $receivables_array = array();
                $payables_array = array();
                $noncurrentasset_array = array();
                $currentasset_array = array();
                $noncurrentliabilities_array = array();
                $currentliabilities_array = array();
                $sharecapital_array = array();
                $retained_array = array();
                $translation_array = array();
                $debt_array = array();
                $prepaid_array = array();
                
                $header_array = array();
                
                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;
                
                $first_day = strtotime($request["date"] . "-01");
                
                
                //balance sheet
                $date = date("Y-m-t", $first_day);
                $periods = 3;
                $timeframe = $request["timeframe"];
                $trackingOptionID1 = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = false;
                
                try {
                  $result = $apiInstance->getReportBalanceSheet($xeroTenantId, $date, $periods, $timeframe, $trackingOptionID1, $trackingOptionID2, $standardLayout, $paymentsOnly);
                  
                  $data = json_decode($result, true);
                  
                  foreach ($data as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                if ($main_value["RowType"] == "Header")
                                {
                                    $cc = 0;
                                    foreach ($main_value["Cells"] as $cells)
                                    {
                                        if ($cc > 0)
                                        {
                                            array_push($header_array, $cells["Value"]);
                                        }
                                        $cc++;
                                    }
                                }
                                
                                if ($main_value["RowType"] == "Section")
                                {
                                    $row_title = "";
                                                    
                                    foreach ($main_value["Rows"] as $main_row)
                                    {
                                        $row_title = $main_value["Title"];
                                        
                                        if ($main_row["RowType"] == "SummaryRow"){
                                            $cell_array = array();
                                                                    
                                            $cc = 0;
                                            $array_count = 0;
                                                                        
                                            $income_title  = "";
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    if ($main_cells["Value"] != "")
                                                    {
                                                        $value = $main_cells["Value"];
                                                    }
                                                    else{
                                                        $value = 0;
                                                    }
                                                    
                                                    $header_split = explode(" ", $header_array[$array_count]);
                                                    
                                                    if($income_title == "Total Current Assets"){
                                                        array_push($currentasset_array, $value);
                                                    }
                                                    
                                                    if($income_title == "Total Non-Current Assets"){
                                                        array_push($noncurrentasset_array, $value);
                                                    }
                                                    
                                                    if($income_title == "Total Current Liabilities"){
                                                        array_push($currentliabilities_array, $value);
                                                    }
                                                    
                                                    if($income_title == "Total Non-Current Liabilities"){
                                                        array_push($noncurrentliabilities_array, $value);
                                                    }
                                                    
                                                    $array_count++;
                                                }
                                                else{
                                                    $income_title = $main_cells["Value"];
                                                }
                                                $cc++;
                                            }
                                        }
                                        
                                        if ($main_row["RowType"] == "Row"){
                                            $cc = 0;
                                            $title = "";
                                            
                                            $array_count = 0;
                                            
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {   
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    if($title == "Accounts Receivable"){
                                                        $header_split = explode(" ", $header_array[$array_count]);
                                                        array_push($receivables_array, $value);
                                                    }
                                                    
                                                    if($title == "Accounts Payable"){
                                                        $header_split = explode(" ", $header_array[$array_count]);
                                                        array_push($payables_array, $value);
                                                    }
                                                    
                                                    if($title == "Share Capital"){
                                                        $header_split = explode(" ", $header_array[$array_count]);
                                                        array_push($sharecapital_array, $value);
                                                    }
                                                    
                                                    if($title == "Retained Earnings"){
                                                        $header_split = explode(" ", $header_array[$array_count]);
                                                        array_push($retained_array, $value);
                                                    }
                                                    
                                                    $array_count++;
                                                }
                                                else{
                                                    $title = $value;
                                                }
                                                    
                                                $cc++;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                                     
                  
                } catch (Exception $e) {
                  echo 'Exception when calling AccountingApi->getReportBalanceSheet: ', $e->getMessage(), PHP_EOL;
                }
                
                //profit and loss
                
                $fromDate = date("Y", $first_day) . "-01-01";
                $toDate = date("Y-m-t", $first_day);
                $periods = 3;
                $timeframe = $request["timeframe"];
                $trackingCategoryID = "";
                $trackingCategoryID2 = "";
                $trackingOptionID = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = false;
                
                try {
                  $result = $apiInstance->getReportProfitAndLoss($xeroTenantId, $fromDate, $toDate, $periods, $timeframe, $trackingCategoryID, $trackingCategoryID2, $trackingOptionID, $trackingOptionID2, $standardLayout, $paymentsOnly);
                  
                  $data = json_decode($result, true);
                  
                  foreach ($data as $value)
                    {
                        if (count($value[0]["Rows"]) > 0)
                        {
                            foreach ($value[0]["Rows"] as $main_value)
                            {
                                if ($main_value["RowType"] == "Header")
                                {
                                    $cc = 0;
                                    foreach ($main_value["Cells"] as $cells)
                                    {
                                        if ($cc > 0)
                                        {
                                            array_push($header_array, $cells["Value"]);
                                        }
                                        $cc++;
                                    }
                                }
                                
                                if ($main_value["RowType"] == "Section")
                                {
                                    $row_title = "";
                                                    
                                    foreach ($main_value["Rows"] as $main_row)
                                    {
                                        $row_title = $main_value["Title"];
                                        
                                        if ($main_row["RowType"] == "SummaryRow"){
                                            $cell_array = array();
                                                                    
                                            $cc = 0;
                                            $array_count = 0;
                                                                        
                                            $income_title  = "";
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    if ($main_cells["Value"] != "")
                                                    {
                                                        $value = $main_cells["Value"];
                                                    }
                                                    else{
                                                        $value = 0;
                                                    }
                                                    
                                                    $header_split = explode(" ", $header_array[$array_count]);
                                                    
                                                    if($income_title == "Total Trading Income" || $income_title == "Total Income" || $income_title == "Income"){
                                                        array_push($income_array, $value);
                                                    }
                                                    
                                                    if($income_title == "Total Cost of Sales" || $income_title == "Total Cost of Goods Sold"){
                                                        array_push($costsale_array, $value);
                                                    }
                                                    
                                                    
                                                    
                                                    $array_count++;
                                                }
                                                else{
                                                    $income_title = $main_cells["Value"];
                                                }
                                                $cc++;
                                            }
                                        }
                                        
                                        if ($main_row["RowType"] == "Row"){
                                            $cc = 0;
                                            $title = "";
                                            
                                            $array_count = 0;
                                            
                                            foreach ($main_row["Cells"] as $main_cells)
                                            {   
                                                $value = $main_cells["Value"];
                                                if ($cc > 0)
                                                {
                                                    if($title == "Purchases" || $title == "Purchase"){
                                                        $header_split = explode(" ", $header_array[$array_count]);
                                                        array_push($purchase_array, $value);
                                                    }
                                                    
                                                    if($title == "Gross Profit"){
                                                        array_push($grossprofit_array, $value);
                                                    }
                                                    
                                                    if($title == "Directors' Remuneration"){
                                                        array_push($directorfee_array, $value);
                                                    }
                                                    
                                                    if($title == "Total Remuneration excluding"){
                                                        array_push($totalremu_array, $value);
                                                    }
                                                    
                                                    if($title == "Medical Expense"){
                                                        array_push($medicalexpense_array, $value);
                                                    }
                                                    
                                                    if($title == "Transportation"){
                                                        array_push($travel_array, $value);
                                                    }
                                                    
                                                    if($title == "Meal & Entertainment"){
                                                        array_push($entertainment_array, $value);
                                                    }
                                                    
                                                    if($title == "Debt Interest/Finance Expense"){
                                                        array_push($debtinterest_array, $value);
                                                    }
                                                    
                                                    if($title == "Net Profit"){
                                                        array_push($netprofit_array, $value);
                                                    }
                                                    
                                                    if($title == "Net Profit before"){
                                                        array_push($netprofitbefore_array, $value);
                                                    }
                                                    
                                                    if($title == "Inventories"){
                                                        array_push($inventories_array, $value);
                                                    }
                                                    
                                                    $array_count++;
                                                }
                                                else{
                                                    $title = $value;
                                                }
                                                    
                                                $cc++;
                                            }
                                        }
                                    }
                                }
                                
                            }
                        }
                    }
                } catch (Exception $e) {
                  echo 'Exception when calling AccountingApi->getReportProfitAndLoss: ', $e->getMessage(), PHP_EOL;
                }
                
                $final_array = array(  
                    array("Header Titles" => $header_array), 
                    array("Purchase" => $income_array), 
                    array("Income" => $purchase_array), 
                    array("Cost of Goods Sold" => $costsale_array ),
                    array("Gross Profit" => $grossprofit_array ), 
                    array("Directors Remuneration" => $directorfee_array ),
                    array("Total Remuneration excluding" => $totalremu_array ),
                    array("Medical Expenses" => $medicalexpense_array ),
                    array("Travelling Expenses" => $travel_array ),
                    array("Entertainment Expenses" => $entertainment_array  ),
                    array("Debt Interest/Finance Expense" => $debtinterest_array ),
                    array("Net Profit" => $netprofit_array),
                    array("Net Profit before" => $netprofitbefore_array),
                    array("Inventories" => $inventories_array),
                    
                    array("Trade Receivable" => $receivables_array),
                    array("Trade Payable" => $payables_array),
                    array("Current Assets" => $currentasset_array ),
                    array("Non-Current Assets" => $noncurrentasset_array ), 
                    array("Current Liabilities" => $currentliabilities_array ),
                    array("Non-Current Liabilities" => $noncurrentliabilities_array ),
                    array("Share Capital" => $sharecapital_array ),
                    array("Retained Earning" => $retained_array ),
                    
                    //n/a
                    array("Translation Reserves" => $translation_array ),
                    array("Total Debt" => $debt_array ),
                    array("Prepaid Expenses" => $prepaid_array ),
                );
                echo json_encode($final_array);
            }
        }
    }
    
    
    public function loadBalanceSheetEditor(Request $request)
    {
        if (isset($request["date"]) && isset($request["period"]) && isset($request["ptype"]))
        {
            if(isset($request["id"]) && $request["id"] != "na" && $request["id"] != ""){
                $id = base64_decode($request["id"]);
                
                $qresult = XeroBalanceSheet::where("id", "=", $id)->first();
                
                $arr = $qresult["editor_content"];
                $title = $qresult["title"];
                $description = $qresult["description"];
                $bsid = $qresult["id"];
                
                $periods = "";
                $date = "";
                $period = "";
                $timeframe = "";
                
                return view("xero.balancesheet", compact('arr', 'periods', 'date', 'period', 'timeframe', 'id', 'title', 'description'));
            }
            else
            {
                if (XeroController::checkIfExpires() == "ok")
                {
    
                    $xero_info = XeroController::checkIfConnected();
                    $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                        ->where("status", "=", "1")
                        ->first();
    
                    $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                    $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                    $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                        ->where("status", "=", "1")
                        ->first();
                    $xeroTenantId = (string)$tenant_info->tenant_id;
    
                    $date = $request["date"];
                    $periods = "";
                    $timeframe = "";
                    if($request["period"] > 0){
                        $timeframe = $request["ptype"];
                        $periods = $request["period"];
                    }
                    
                    $trackingOptionID1 = "";
                    $trackingOptionID2 = "";
                    $standardLayout = true;
                    $paymentsOnly = false;
    
                    $table_data = "";
    
                    $title = "";
                    $description = "";
                    $bsid = "";
    
                    try
                    {
                        $result = $apiInstance->getReportBalanceSheet($xeroTenantId, $date, $periods, $timeframe, $trackingOptionID1, $trackingOptionID2, $standardLayout, $paymentsOnly);
                            
                        $date = $request["date"];  
                        $period = $request["period"];
                        $timeframe = $request["ptype"];
                        
                        $arr = json_decode($result, true);
                        
                        $id = "";
                        $title = "";
                        $description = "";
                
                        return view("xero.balancesheet", compact('arr', 'periods', 'date', 'period', 'timeframe', 'id', 'title', 'description'));
                    }
                    catch(Exception $e)
                    {
                        echo "Error";
                    }
                }
            }
        }
    }
    
    
    public function loadProfitLossEditor(Request $request)
    {
        if (isset($request["fromdate"]) && isset($request["todate"]) && isset($request["period"]) && isset($request["timeframe"]))
        {
            if (XeroController::checkIfExpires() == "ok")
            {

                $xero_info = XeroController::checkIfConnected();
                $token_info = XeroTokenInfo::where("connection_id", "=", $xero_info->id)
                    ->where("status", "=", "1")
                    ->first();

                $config = \XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$token_info->token);
                $apiInstance = new \XeroAPI\XeroPHP\Api\AccountingApi(new \GuzzleHttp\Client() , $config);
                $tenant_info = XeroTenantId::where("token_id", "=", $token_info->id)
                    ->where("status", "=", "1")
                    ->first();
                $xeroTenantId = (string)$tenant_info->tenant_id;

                $fromDate = $request["fromdate"];
                $toDate = $request["todate"];
                
                $periods = "";
                $timeframe = "";
                if($request["period"] > 0){
                    $periods = $request["period"];
                    $timeframe = $request["timeframe"];
                }
                
                $trackingCategoryID = "";
                $trackingCategoryID2 = "";
                $trackingOptionID = "";
                $trackingOptionID2 = "";
                $standardLayout = true;
                $paymentsOnly = false;

                $table_data = "";
                
                try
                {
                    if (isset($request["id"]) && $request["id"] != "na" && $request["id"] != "")
                    {
                        $id = base64_decode($request["id"]);
                        
                        $qresult = XeroProfitLoss::where("id", "=", $id)->first();
                        $arr = $qresult["editor_content"];
                        $title = $qresult["title"];
                        $description = $qresult["description"];
                        $bsid = $qresult["id"];
                        
                        $fromDate = "";
                        $toDate = "";
                        $periods = "";
                        $timeframe = "";
                        
                        return view("xero.profitandloss", compact('toDate', 'fromDate', 'arr', 'periods', 'timeframe', 'id', 'title', 'description'));
                    }
                    else
                    {
                        $title = "";
                        $description = "";
                        $bsid = "";
                        $result = $apiInstance->getReportProfitAndLoss($xeroTenantId, $fromDate, $toDate, $periods, $timeframe, $trackingCategoryID, $trackingCategoryID2, $trackingOptionID, $trackingOptionID2, $standardLayout, $paymentsOnly);
                    
                        $arr = json_decode($result, true);
                    
                        $id = "";
                        
                        $periods = $request["period"];
                        $timeframe = $request["timeframe"];
                        
                        return view("xero.profitandloss", compact('toDate', 'fromDate', 'arr', 'periods', 'timeframe', 'id', 'title', 'description'));
                    }
                }
                catch(Exception $e)
                {
                    echo 'Exception when calling AccountingApi->loadProfitLossEditor: ', $e->getMessage() , PHP_EOL;
                }
            }
        }
    }
    
}

