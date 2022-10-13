<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestReport;
use App\CompanyProfile;
use Auth;
use App\AuditLog;
use App\ProcessedReport;

class OngoingMonitoringController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $user_id = Auth::id(); 
        $company_id_result = CompanyProfile::getCompanyId($user_id);
        $listData = ProcessedReport::where('requester_company_id', $company_id_result)->where('report_link', NULL)->orderBy("created_at","desc")->get();
        return view('monitoring.list', compact('listData'));
    }

}
