<?php

namespace App\Http\Controllers;



use App\AuditLog;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Routing\UrlGenerator;

use App\CompanyProfile;

use App\User;

use Auth;

class CompanyChartController extends Controller {
    
    public function __construct() {

		$this->middleware('auth');

    }
    
    public function index(){
        return view("company.companychart");
    }
    
}