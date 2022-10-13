<?php

namespace App\Http\Controllers;



use App\AuditLog;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Routing\UrlGenerator;

use App\CompanyProfile;

use App\User;

use Auth;

class OpportunityChartController extends Controller {
    
    public function __construct() {

		$this->middleware('auth');

    }
    
    public function index(){
        return view("oppor.opportunitychart");
    }
    
    public function getFinancialEntriesDataBuy(Request $request){
	    
	    //DB::getSchemaBuilder()->getColumnListing($table);
	    $user_id = Auth::id();
	    $company_id_result = CompanyProfile::getCompanyId(Auth::id());
	    
	    //$month_now = $request["months"];
	    //$year_now = $request["year"];
	    
	    
	    $data = "[";
	    
	    $get_col_names = FinancialAnalysis::select("income", "purchase", "cost_goodsold_costsales", "gross_profit",
	        "directors_fee_renum", "totalrenum_exdirector_feerenum", "medical_expenses", "transport_traveling_expenses",
	        "entertainment_expenses", "debt_interest_finance_expenses", "net_profit", "net_profit_before_interest_tax_ebit",
	        "inventories_closing_stock", "trade_receivable", "trade_payable", "non_current_assets", "current_assets",
	        "current_liabilities", "non_current_liabilities", "share_capital", "retained_earning", "translation_reserves", "total_debt", "prepaid_expenses")->where('company_id',  $company_id_result)->where('user_id', $user_id)->first();
	    
	    
	    
	        foreach ($get_col_names->toArray() as $col_column => $col_value){
	            ////////////////
        	    $entry = FinancialAnalysis::select($col_column)->where('company_id',  $company_id_result)->where('user_id', $user_id)
        	    /*->where("year_param", "=", $year_now)
        	    
        	    ->where(function ($query) use ( $month_now) {
    			    
    			    if($month_now == "1234"){
            	        $query->whereIn('month_param', [1, 2, 3, 4]);
            	    }
            	    
            	    if($month_now == "5678"){
            	        $query->whereIn('month_param', [5, 6, 7, 8]);
            	    }
            	    
            	    if($month_now == "9101112"){
            	        $query->whereIn('month_param', [9, 10, 11, 12]);
            	    }
    			})*/
    			->orderBy("entry","asc")
        	    ->get();
        	    
        	    if(!$entry->isEmpty()){
        	        
        	        $this_data = "";
        	        $this_val = 0;
        	    
            	    $this_data .= '{data:[';
            	    
            	    $count= 0;
            	    $col_name = "";
            	    foreach($entry as $entry_data){
            	        foreach ($entry_data->toArray() as $column => $value){
            	            $this_data .= '['.$count.', '.$value.'],';
            	            $col_name = $column;
            	            
            	            $this_val += $value;
            	        }
            	        
            	        $count++;
            	    }
            	    
            	    if($col_name == "income"){
            	        $col_name = "Income";
            	    }
            	    if($col_name == "purchase"){
            	        $col_name = "Purchase";
            	    }
            	    if($col_name == "cost_goodsold_costsales"){
            	        $col_name = "Cost of Goods Sold / Cost of Sales";
            	    }
            	    if($col_name == "gross_profit"){
            	        $col_name = "Gross Profit";
            	    }
            	    if($col_name == "directors_fee_renum"){
            	        $col_name = "Directors’ Fees & Remuneration";
            	    }
            	    if($col_name == "totalrenum_exdirector_feerenum"){
            	        $col_name = "Total Remuneration excluding Directors’ Fees and Remuneration";
            	    }
            	    if($col_name == "medical_expenses"){
            	        $col_name = "Medical Expenses";
            	    }
            	    if($col_name == "transport_traveling_expenses"){
            	        $col_name = "Transport/Travelling Expenses";
            	    }
            	    if($col_name == "entertainment_expenses"){
            	        $col_name = "Entertainment Expenses";
            	    }
            	    if($col_name == "debt_interest_finance_expenses"){
            	        $col_name = "Debt Interest/Finance Expense";
            	    }
            	    if($col_name == "net_profit"){
            	        $col_name = "Net Profit";
            	    }
            	    if($col_name == "net_profit_before_interest_tax_ebit"){
            	        $col_name = "Net Profit Before Interest and Tax (EBIT)";
            	    }
            	    if($col_name == "inventories_closing_stock"){
            	        $col_name = "Inventories (Closing Stock)";
            	    }
            	    if($col_name == "trade_receivable"){
            	        $col_name = "Trade Receivable";
            	    }
            	    if($col_name == "trade_payable"){
            	        $col_name = "Trade Payable";
            	    }
            	    if($col_name == "non_current_assets"){
            	        $col_name = "Non-Current Assets";
            	    }
            	    if($col_name == "current_assets"){
            	        $col_name = "Current Assets";
            	    }
            	    if($col_name == "current_liabilities"){
            	        $col_name = "Current Liabilities";
            	    }
            	    if($col_name == "non_current_liabilities"){
            	        $col_name = "Non-current Liabilities";
            	    }
            	    if($col_name == "share_capital"){
            	        $col_name = "Share Capital";
            	    }
            	    if($col_name == "retained_earning"){
            	        $col_name = "Retained Earning";
            	    }
            	    if($col_name == "translation_reserves"){
            	        $col_name = "Translation Reserves";
            	    }
            	    if($col_name == "total_debt"){
            	        $col_name = "Total Debt";
            	    }
            	    if($col_name == "prepaid_expenses"){
            	        $col_name = "Prepaid Expenses";
            	    }
            	    
            	    $this_data .= '],
            	    canvasRender: true,
            	    lines: {
                        show: true
                    },
                    showLabels: true,
                    points: {
                        show: true
                    },
                    label: "'.$col_name.'",
                    labelPlacement: "above",
                    labels: ["0.35%", "0.34%", "0.45%", "0.77%"]},';
                    
                    if($this_val > 0){
                        $data .= $this_data;
                    }
        	    }
                /////////////////
	        }
	    
        
        $data .= "]";
        
	    return $data;
	}
    
}