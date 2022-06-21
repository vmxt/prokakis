<?php

namespace App;
use App\FA_Results;
use Illuminate\Database\Eloquent\Model;

class FinancialAnalysis extends Model {

	protected $table = 'financial_analysis';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'company_id',
		'entry',
		'year_param',
		'month_param',
		'income',
		'purchase',
		'cost_goodsold_costsales',
		'gross_profit',
		'directors_fee_renum',
		'totalrenum_exdirector_feerenum',
		'medical_expenses',
		'transport_traveling_expenses',
		'entertainment_expenses',
		'debt_interest_finance_expenses',
		'net_profit',
		'net_profit_before_interest_tax_ebit',
		'inventories_closing_stock',
		'trade_receivable',
		'trade_payable',
		'non_current_assets',
		'current_assets',
		'current_liabilities',
		'non_current_liabilities',
		'share_capital',
		'retained_earning',
		'translation_reserves',
		'total_debt',
		'prepaid_expenses',
		'created_at',
		'updated_at',
		'added_by',
		'updated_by',
		'status',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public static function saveCreate($data, $companyId, $userId) 
	{

		if ( isset($data["fa_year1"]) && isset($data["fa_month1"]) && $data["fa_month1"] != '0' && $data["fa_year1"] != '0') {
			$fa1 = FinancialAnalysis::where('entry', 1)->where('user_id', $userId)->where('company_id', $companyId)->first();

			if ($fa1 != null) {
				$fa1->year_param = $data["fa_year1"];
				$fa1->month_param = $data["fa_month1"];
				$fa1->income = $data["income1"];
				$fa1->purchase = $data["purchase1"];
				$fa1->cost_goodsold_costsales = $data["cost_good_sold1"];
				$fa1->gross_profit = $data["gross_profit1"];
				$fa1->directors_fee_renum = $data["directors_fee_renum1"];
				$fa1->totalrenum_exdirector_feerenum = $data["total_renum_exdirector1"];
				$fa1->medical_expenses = $data["medical_expense1"];
				$fa1->transport_traveling_expenses = $data["transport_travelling_expenses1"];
				$fa1->entertainment_expenses = $data["entertainment_expense1"];
				$fa1->debt_interest_finance_expenses = $data["debt_interest_finance_expenses1"];
				$fa1->net_profit = $data["net_profit1"];
				$fa1->net_profit_before_interest_tax_ebit = $data["net_profit_before_interest_tax1"];
				$fa1->inventories_closing_stock = $data["inventories_closing_stock1"];
				$fa1->trade_receivable = $data["trade_receivable1"];
				$fa1->trade_payable = $data["trade_payable1"];
				$fa1->non_current_assets = $data["non_current_assets1"];
				$fa1->current_assets = $data["current_assets1"];
				$fa1->current_liabilities = $data["current_liabilities1"];
				$fa1->non_current_liabilities = $data["non_current_liabilities1"];
				$fa1->share_capital = $data["share_capita1"];
				$fa1->retained_earning = $data["retained_earning1"];
				$fa1->translation_reserves = $data["translation_reserves1"];
				$fa1->total_debt = $data["total_debt1"];
				$fa1->prepaid_expenses = $data["prepaid_expenses1"];

				if ($fa1->save()) {
					$fa = new FA_Results();
					$ReceivableTurnover = $fa->ReceivableTurnover($data["income1"], $data["trade_receivable1"]);
					$AverageCollectionPeriod = $fa->AverageCollectionPeriod($ReceivableTurnover);
					$InventoryTurnover = $fa->InventoryTurnover($data["cost_good_sold1"], $data["inventories_closing_stock1"]);
					$DaysInInventory = $fa->DaysInInventory($InventoryTurnover);
					$PayableTurnover = $fa->PayableTurnover($data["purchase1"], $data["trade_payable1"]);
					$AveragePaymentPeriod = $fa->AveragePaymentPeriod($PayableTurnover);
					$NetWorkingCapital = $fa->NetWorkingCapital($data["current_assets1"], $data["current_liabilities1"]);
					$CurrentRatio = $fa->CurrentRatio($data["current_assets1"], $data["current_liabilities1"]);
					$QuickRatio = $fa->QuickRatio($data["current_assets1"], $data["current_liabilities1"], $data["inventories_closing_stock1"], $data["prepaid_expenses1"]);
					$DebtToEquity = $fa->DebtToEquity($data["total_debt1"], $data["share_capita1"]);
					$DebtToAsset = $fa->DebtToAsset($data["total_debt1"], $data["current_assets1"]);
					$InterestCoverageRatio = $fa->InterestCoverageRatio($data["net_profit_before_interest_tax1"], $data["debt_interest_finance_expenses1"]);
					$GrossProfitMargin = $fa->GrossProfitMargin($data["gross_profit1"], $data["income1"]);
					$OperatingProfitMargin = $fa->OperatingProfitMargin($data["net_profit_before_interest_tax1"], $data["income1"]);
					$NetProfitMargin = $fa->NetProfitMargin($data["net_profit1"], $data["income1"]);
					$ReturnOfInvestments = $fa->ReturnOfInvestments($data["current_assets1"], $data["income1"]);
					$ReturnOfEquity = $fa->ReturnOfEquity($data["share_capita1"], $data["income1"]);

					$far1 = FA_Results::where('user_id', $userId)->where('fk_fa_id', $fa1->id)->first();
					if ( $far1 != null ) {
						$far1->year_param = $data["fa_year1"];
						$far1->month_param = $data["fa_month1"];
						$far1->receivable_turnover = $ReceivableTurnover;
						$far1->average_collection_period = $AverageCollectionPeriod;
						$far1->inventory_turnover = $InventoryTurnover;
						$far1->days_in_inventory = $DaysInInventory;
						$far1->payable_turnover = $PayableTurnover;
						$far1->average_payment_period = $AveragePaymentPeriod;
						$far1->net_working_capital = $NetWorkingCapital;
						$far1->current_ratio = $CurrentRatio;
						$far1->quick_ratio = $QuickRatio;
						$far1->debt_to_equity = $DebtToEquity;
						$far1->debt_to_asset = $DebtToAsset;
						$far1->interest_coverage = $InterestCoverageRatio;
						$far1->gross_profit_margin = $GrossProfitMargin;
						$far1->operating_profit_margin = $OperatingProfitMargin;
						$far1->net_profit_margin = $NetProfitMargin;
						$far1->return_of_investment = $ReturnOfInvestments;
						$far1->return_of_equity = $ReturnOfEquity;
						$far1->save();
					}
				}

			} else {
				$ok = FinancialAnalysis::create([
					'user_id' => $userId,
					'company_id' => $companyId,
					'entry' => 1,
					'year_param' => $data["fa_year1"],
					'month_param' => $data["fa_month1"],
					'income' => $data["income1"],
					'purchase' => $data["purchase1"],
					'cost_goodsold_costsales' => $data["cost_good_sold1"],
					'gross_profit' => $data["gross_profit1"],
					'directors_fee_renum' => $data["directors_fee_renum1"],
					'totalrenum_exdirector_feerenum' => $data["total_renum_exdirector1"],
					'medical_expenses' => $data["medical_expense1"],
					'transport_traveling_expenses' => $data["transport_travelling_expenses1"],
					'entertainment_expenses' => $data["entertainment_expense1"],
					'debt_interest_finance_expenses' => $data["debt_interest_finance_expenses1"],
					'net_profit' => $data["net_profit1"],
					'net_profit_before_interest_tax_ebit' => $data["net_profit_before_interest_tax1"],
					'inventories_closing_stock' => $data["inventories_closing_stock1"],
					'trade_receivable' => $data["trade_receivable1"],
					'trade_payable' => $data["trade_payable1"],
					'non_current_assets' => $data["non_current_assets1"],
					'current_assets' => $data["current_assets1"],
					'current_liabilities' => $data["current_liabilities1"],
					'non_current_liabilities' => $data["non_current_liabilities1"],
					'share_capital' => $data["share_capita1"],
					'retained_earning' => $data["retained_earning1"],
					'translation_reserves' => $data["translation_reserves1"],
					'total_debt' => $data["total_debt1"],
					'prepaid_expenses' => $data["prepaid_expenses1"],
					'created_at' => date('Y-m-d'),
					'added_by' => $userId,
					'status' => 1,
				]);

				if ($ok) {
					$fa = new FA_Results();
					$ReceivableTurnover = $fa->ReceivableTurnover($data["income1"], $data["trade_receivable1"]);
					$AverageCollectionPeriod = $fa->AverageCollectionPeriod($ReceivableTurnover);
					$InventoryTurnover = $fa->InventoryTurnover($data["cost_good_sold1"], $data["inventories_closing_stock1"]);
					$DaysInInventory = $fa->DaysInInventory($InventoryTurnover);
					$PayableTurnover = $fa->PayableTurnover($data["purchase1"], $data["trade_payable1"]);
					$AveragePaymentPeriod = $fa->AveragePaymentPeriod($PayableTurnover);
					$NetWorkingCapital = $fa->NetWorkingCapital($data["current_assets1"], $data["current_liabilities1"]);
					$CurrentRatio = $fa->CurrentRatio($data["current_assets1"], $data["current_liabilities1"]);
					$QuickRatio = $fa->QuickRatio($data["current_assets1"], $data["current_liabilities1"], $data["inventories_closing_stock1"], $data["prepaid_expenses1"]);
					$DebtToEquity = $fa->DebtToEquity($data["total_debt1"], $data["share_capita1"]);
					$DebtToAsset = $fa->DebtToAsset($data["total_debt1"], $data["current_assets1"]);
					$InterestCoverageRatio = $fa->InterestCoverageRatio($data["net_profit_before_interest_tax1"], $data["debt_interest_finance_expenses1"]);
					$GrossProfitMargin = $fa->GrossProfitMargin($data["gross_profit1"], $data["income1"]);
					$OperatingProfitMargin = $fa->OperatingProfitMargin($data["net_profit_before_interest_tax1"], $data["income1"]);
					$NetProfitMargin = $fa->NetProfitMargin($data["net_profit1"], $data["income1"]);
					$ReturnOfInvestments = $fa->ReturnOfInvestments($data["current_assets1"], $data["income1"]);
					$ReturnOfEquity = $fa->ReturnOfEquity($data["share_capita1"], $data["income1"]);

					FA_Results::create([
						'fk_fa_id' => $ok->id,
						'user_id' => $userId,
						'company_id' => $companyId,
						'year_param' => $data["fa_year1"],
						'month_param' => $data["fa_month1"],
						'receivable_turnover' => $ReceivableTurnover,
						'average_collection_period' => $AverageCollectionPeriod,
						'inventory_turnover' => $InventoryTurnover,
						'days_in_inventory' => $DaysInInventory,
						'payable_turnover' => $PayableTurnover,
						'average_payment_period' => $AveragePaymentPeriod,
						'net_working_capital' => $NetWorkingCapital,
						'current_ratio' => $CurrentRatio,
						'quick_ratio' => $QuickRatio,
						'debt_to_equity' => $DebtToEquity,
						'debt_to_asset' => $DebtToAsset,
						'interest_coverage' => $InterestCoverageRatio,
						'gross_profit_margin' => $GrossProfitMargin,
						'operating_profit_margin' => $OperatingProfitMargin,
						'net_profit_margin' => $NetProfitMargin,
						'return_of_investment' => $ReturnOfInvestments,
						'return_of_equity' => $ReturnOfEquity,
						'status' => 1,
						'created_at' => date('Y-m-d'),
					]);
				} //end of inner if
			}

		}

		if (isset($data["fa_year2"]) && isset($data["fa_month2"]) && $data["fa_month2"] != "0" && $data["fa_year2"] != "0") {
			$fa2 = FinancialAnalysis::where('entry', 2)->where('user_id', $userId)->where('company_id', $companyId)->first();

			if ( $fa2 != null ) {

				$fa2->year_param = $data["fa_year2"];
				$fa2->month_param = $data["fa_month2"];
				$fa2->income = $data["income2"];
				$fa2->purchase = $data["purchase2"];
				$fa2->cost_goodsold_costsales = $data["cost_good_sold2"];
				$fa2->gross_profit = $data["gross_profit2"];
				$fa2->directors_fee_renum = $data["directors_fee_renum2"];
				$fa2->totalrenum_exdirector_feerenum = $data["total_renum_exdirector2"];
				$fa2->medical_expenses = $data["medical_expense2"];
				$fa2->transport_traveling_expenses = $data["transport_travelling_expenses2"];
				$fa2->entertainment_expenses = $data["entertainment_expense2"];
				$fa2->debt_interest_finance_expenses = $data["debt_interest_finance_expenses2"];
				$fa2->net_profit = $data["net_profit2"];
				$fa2->net_profit_before_interest_tax_ebit = $data["net_profit_before_interest_tax2"];
				$fa2->inventories_closing_stock = $data["inventories_closing_stock2"];
				$fa2->trade_receivable = $data["trade_receivable2"];
				$fa2->trade_payable = $data["trade_payable2"];
				$fa2->non_current_assets = $data["non_current_assets2"];
				$fa2->current_assets = $data["current_assets2"];
				$fa2->current_liabilities = $data["current_liabilities2"];
				$fa2->non_current_liabilities = $data["non_current_liabilities2"];
				$fa2->share_capital = $data["share_capita2"];
				$fa2->retained_earning = $data["retained_earning2"];
				$fa2->translation_reserves = $data["translation_reserves2"];
				$fa2->total_debt = $data["total_debt2"];
				$fa2->prepaid_expenses = $data["prepaid_expenses2"];

				if ($fa2->save()) {
					$fa = new FA_Results();
					$ReceivableTurnover = $fa->ReceivableTurnover($data["income2"], $data["trade_receivable2"]);
					$AverageCollectionPeriod = $fa->AverageCollectionPeriod($ReceivableTurnover);
					$InventoryTurnover = $fa->InventoryTurnover($data["cost_good_sold2"], $data["inventories_closing_stock2"]);
					$DaysInInventory = $fa->DaysInInventory($InventoryTurnover);
					$PayableTurnover = $fa->PayableTurnover($data["purchase2"], $data["trade_payable2"]);
					$AveragePaymentPeriod = $fa->AveragePaymentPeriod($PayableTurnover);
					$NetWorkingCapital = $fa->NetWorkingCapital($data["current_assets2"], $data["current_liabilities2"]);
					$CurrentRatio = $fa->CurrentRatio($data["current_assets2"], $data["current_liabilities2"]);
					$QuickRatio = $fa->QuickRatio($data["current_assets2"], $data["current_liabilities2"], $data["inventories_closing_stock2"], $data["prepaid_expenses2"]);
					$DebtToEquity = $fa->DebtToEquity($data["total_debt2"], $data["share_capita2"]);
					$DebtToAsset = $fa->DebtToAsset($data["total_debt2"], $data["current_assets2"]);
					$InterestCoverageRatio = $fa->InterestCoverageRatio($data["net_profit_before_interest_tax2"], $data["debt_interest_finance_expenses2"]);
					$GrossProfitMargin = $fa->GrossProfitMargin($data["gross_profit2"], $data["income2"]);
					$OperatingProfitMargin = $fa->OperatingProfitMargin($data["net_profit_before_interest_tax2"], $data["income2"]);
					$NetProfitMargin = $fa->NetProfitMargin($data["net_profit2"], $data["income2"]);
					$ReturnOfInvestments = $fa->ReturnOfInvestments($data["current_assets2"], $data["income2"]);
					$ReturnOfEquity = $fa->ReturnOfEquity($data["share_capita2"], $data["income2"]);

					$far2 = FA_Results::where('user_id', $userId)->where('fk_fa_id', $fa2->id)->first();
					if ($far2 != null) {
						$far2->year_param = $data["fa_year2"];
						$far2->month_param = $data["fa_month2"];
						$far2->receivable_turnover = $ReceivableTurnover;
						$far2->average_collection_period = $AverageCollectionPeriod;
						$far2->inventory_turnover = $InventoryTurnover;
						$far2->days_in_inventory = $DaysInInventory;
						$far2->payable_turnover = $PayableTurnover;
						$far2->average_payment_period = $AveragePaymentPeriod;
						$far2->net_working_capital = $NetWorkingCapital;
						$far2->current_ratio = $CurrentRatio;
						$far2->quick_ratio = $QuickRatio;
						$far2->debt_to_equity = $DebtToEquity;
						$far2->debt_to_asset = $DebtToAsset;
						$far2->interest_coverage = $InterestCoverageRatio;
						$far2->gross_profit_margin = $GrossProfitMargin;
						$far2->operating_profit_margin = $OperatingProfitMargin;
						$far2->net_profit_margin = $NetProfitMargin;
						$far2->return_of_investment = $ReturnOfInvestments;
						$far2->return_of_equity = $ReturnOfEquity;
						$far2->save();
					}
				}

			} else {

				$ok = FinancialAnalysis::create([
					'user_id' => $userId,
					'company_id' => $companyId,
					'entry' => 2,
					'year_param' => $data["fa_year2"],
					'month_param' => $data["fa_month2"],
					'income' => $data["income2"],
					'purchase' => $data["purchase2"],
					'cost_goodsold_costsales' => $data["cost_good_sold2"],
					'gross_profit' => $data["gross_profit2"],
					'directors_fee_renum' => $data["directors_fee_renum2"],
					'totalrenum_exdirector_feerenum' => $data["total_renum_exdirector2"],
					'medical_expenses' => $data["medical_expense2"],
					'transport_traveling_expenses' => $data["transport_travelling_expenses2"],
					'entertainment_expenses' => $data["entertainment_expense2"],
					'debt_interest_finance_expenses' => $data["debt_interest_finance_expenses2"],
					'net_profit' => $data["net_profit2"],
					'net_profit_before_interest_tax_ebit' => $data["net_profit_before_interest_tax2"],
					'inventories_closing_stock' => $data["inventories_closing_stock2"],
					'trade_receivable' => $data["trade_receivable2"],
					'trade_payable' => $data["trade_payable2"],
					'non_current_assets' => $data["non_current_assets2"],
					'current_assets' => $data["current_assets2"],
					'current_liabilities' => $data["current_liabilities2"],
					'non_current_liabilities' => $data["non_current_liabilities2"],
					'share_capital' => $data["share_capita2"],
					'retained_earning' => $data["retained_earning2"],
					'translation_reserves' => $data["translation_reserves2"],
					'total_debt' => $data["total_debt2"],
					'prepaid_expenses' => $data["prepaid_expenses2"],
					'created_at' => date('Y-m-d'),
					'added_by' => $userId,
					'status' => 1,
				]);

				if ($ok) {

					$fa = new FA_Results();
					$ReceivableTurnover = $fa->ReceivableTurnover($data["income2"], $data["trade_receivable2"]);
					$AverageCollectionPeriod = $fa->AverageCollectionPeriod($ReceivableTurnover);
					$InventoryTurnover = $fa->InventoryTurnover($data["cost_good_sold2"], $data["inventories_closing_stock2"]);
					$DaysInInventory = $fa->DaysInInventory($InventoryTurnover);
					$PayableTurnover = $fa->PayableTurnover($data["purchase2"], $data["trade_payable2"]);
					$AveragePaymentPeriod = $fa->AveragePaymentPeriod($PayableTurnover);
					$NetWorkingCapital = $fa->NetWorkingCapital($data["current_assets2"], $data["current_liabilities2"]);
					$CurrentRatio = $fa->CurrentRatio($data["current_assets2"], $data["current_liabilities2"]);
					$QuickRatio = $fa->QuickRatio($data["current_assets2"], $data["current_liabilities2"], $data["inventories_closing_stock2"], $data["prepaid_expenses2"]);
					$DebtToEquity = $fa->DebtToEquity($data["total_debt2"], $data["share_capita2"]);
					$DebtToAsset = $fa->DebtToAsset($data["total_debt2"], $data["current_assets2"]);
					$InterestCoverageRatio = $fa->InterestCoverageRatio($data["net_profit_before_interest_tax2"], $data["debt_interest_finance_expenses2"]);
					$GrossProfitMargin = $fa->GrossProfitMargin($data["gross_profit2"], $data["income2"]);
					$OperatingProfitMargin = $fa->OperatingProfitMargin($data["net_profit_before_interest_tax2"], $data["income2"]);
					$NetProfitMargin = $fa->NetProfitMargin($data["net_profit2"], $data["income2"]);
					$ReturnOfInvestments = $fa->ReturnOfInvestments($data["current_assets2"], $data["income2"]);
					$ReturnOfEquity = $fa->ReturnOfEquity($data["share_capita2"], $data["income2"]);

					FA_Results::create([
						'fk_fa_id' => $ok->id,
						'user_id' => $userId,
						'company_id' => $companyId,
						'year_param' => $data["fa_year2"],
						'month_param' => $data["fa_month2"],
						'receivable_turnover' => $ReceivableTurnover,
						'average_collection_period' => $AverageCollectionPeriod,
						'inventory_turnover' => $InventoryTurnover,
						'days_in_inventory' => $DaysInInventory,
						'payable_turnover' => $PayableTurnover,
						'average_payment_period' => $AveragePaymentPeriod,
						'net_working_capital' => $NetWorkingCapital,
						'current_ratio' => $CurrentRatio,
						'quick_ratio' => $QuickRatio,
						'debt_to_equity' => $DebtToEquity,
						'debt_to_asset' => $DebtToAsset,
						'interest_coverage' => $InterestCoverageRatio,
						'gross_profit_margin' => $GrossProfitMargin,
						'operating_profit_margin' => $OperatingProfitMargin,
						'net_profit_margin' => $NetProfitMargin,
						'return_of_investment' => $ReturnOfInvestments,
						'return_of_equity' => $ReturnOfEquity,
						'status' => 1,
						'created_at' => date('Y-m-d'),
					]);

				}
			}

		}

		if ( isset($data["fa_year3"]) && isset($data["fa_month3"]) && $data["fa_month3"] != "0" && $data["fa_year3"] != "0") {

			$fa3 = FinancialAnalysis::where('entry', 3)->where('user_id', $userId)->where('company_id', $companyId)->first();
			if ($fa3 != null ) {

				$fa3->year_param = $data["fa_year3"];
				$fa3->month_param = $data["fa_month3"];
				$fa3->income = $data["income3"];
				$fa3->purchase = $data["purchase3"];
				$fa3->cost_goodsold_costsales = $data["cost_good_sold3"];
				$fa3->gross_profit = $data["gross_profit3"];
				$fa3->directors_fee_renum = $data["directors_fee_renum3"];
				$fa3->totalrenum_exdirector_feerenum = $data["total_renum_exdirector3"];
				$fa3->medical_expenses = $data["medical_expense3"];
				$fa3->transport_traveling_expenses = $data["transport_travelling_expenses3"];
				$fa3->entertainment_expenses = $data["entertainment_expense3"];
				$fa3->debt_interest_finance_expenses = $data["debt_interest_finance_expenses3"];
				$fa3->net_profit = $data["net_profit3"];
				$fa3->net_profit_before_interest_tax_ebit = $data["net_profit_before_interest_tax3"];
				$fa3->inventories_closing_stock = $data["inventories_closing_stock3"];
				$fa3->trade_receivable = $data["trade_receivable3"];
				$fa3->trade_payable = $data["trade_payable3"];
				$fa3->non_current_assets = $data["non_current_assets3"];
				$fa3->current_assets = $data["current_assets3"];
				$fa3->current_liabilities = $data["current_liabilities3"];
				$fa3->non_current_liabilities = $data["non_current_liabilities3"];
				$fa3->share_capital = $data["share_capita3"];
				$fa3->retained_earning = $data["retained_earning3"];
				$fa3->translation_reserves = $data["translation_reserves3"];
				$fa3->total_debt = $data["total_debt3"];
				$fa3->prepaid_expenses = $data["prepaid_expenses3"];

				if ($fa3->save()) {
					$fa = new FA_Results();
					$ReceivableTurnover = $fa->ReceivableTurnover($data["income3"], $data["trade_receivable3"]);
					$AverageCollectionPeriod = $fa->AverageCollectionPeriod($ReceivableTurnover);
					$InventoryTurnover = $fa->InventoryTurnover($data["cost_good_sold3"], $data["inventories_closing_stock3"]);
					$DaysInInventory = $fa->DaysInInventory($InventoryTurnover);
					$PayableTurnover = $fa->PayableTurnover($data["purchase3"], $data["trade_payable3"]);
					$AveragePaymentPeriod = $fa->AveragePaymentPeriod($PayableTurnover);
					$NetWorkingCapital = $fa->NetWorkingCapital($data["current_assets3"], $data["current_liabilities3"]);
					$CurrentRatio = $fa->CurrentRatio($data["current_assets3"], $data["current_liabilities3"]);
					$QuickRatio = $fa->QuickRatio($data["current_assets3"], $data["current_liabilities3"], $data["inventories_closing_stock3"], $data["prepaid_expenses3"]);
					$DebtToEquity = $fa->DebtToEquity($data["total_debt3"], $data["share_capita3"]);
					$DebtToAsset = $fa->DebtToAsset($data["total_debt3"], $data["current_assets3"]);
					$InterestCoverageRatio = $fa->InterestCoverageRatio($data["net_profit_before_interest_tax3"], $data["debt_interest_finance_expenses3"]);
					$GrossProfitMargin = $fa->GrossProfitMargin($data["gross_profit3"], $data["income3"]);
					$OperatingProfitMargin = $fa->OperatingProfitMargin($data["net_profit_before_interest_tax3"], $data["income3"]);
					$NetProfitMargin = $fa->NetProfitMargin($data["net_profit3"], $data["income3"]);
					$ReturnOfInvestments = $fa->ReturnOfInvestments($data["current_assets3"], $data["income3"]);
					$ReturnOfEquity = $fa->ReturnOfEquity($data["share_capita3"], $data["income3"]);

					$far3 = FA_Results::where('user_id', $userId)->where('fk_fa_id', $fa3->id)->first();
					if ($far3 != null) {
						$far3->year_param = $data["fa_year3"];
						$far3->month_param = $data["fa_month3"];
						$far3->receivable_turnover = $ReceivableTurnover;
						$far3->average_collection_period = $AverageCollectionPeriod;
						$far3->inventory_turnover = $InventoryTurnover;
						$far3->days_in_inventory = $DaysInInventory;
						$far3->payable_turnover = $PayableTurnover;
						$far3->average_payment_period = $AveragePaymentPeriod;
						$far3->net_working_capital = $NetWorkingCapital;
						$far3->current_ratio = $CurrentRatio;
						$far3->quick_ratio = $QuickRatio;
						$far3->debt_to_equity = $DebtToEquity;
						$far3->debt_to_asset = $DebtToAsset;
						$far3->interest_coverage = $InterestCoverageRatio;
						$far3->gross_profit_margin = $GrossProfitMargin;
						$far3->operating_profit_margin = $OperatingProfitMargin;
						$far3->net_profit_margin = $NetProfitMargin;
						$far3->return_of_investment = $ReturnOfInvestments;
						$far3->return_of_equity = $ReturnOfEquity;
						$far3->save();
					}
				}

			} else {

				$ok = FinancialAnalysis::create([
					'user_id' => $userId,
					'company_id' => $companyId,
					'entry' => 3,
					'year_param' => $data["fa_year3"],
					'month_param' => $data["fa_month3"],
					'income' => $data["income3"],
					'purchase' => $data["purchase3"],
					'cost_goodsold_costsales' => $data["cost_good_sold3"],
					'gross_profit' => $data["gross_profit3"],
					'directors_fee_renum' => $data["directors_fee_renum3"],
					'totalrenum_exdirector_feerenum' => $data["total_renum_exdirector3"],
					'medical_expenses' => $data["medical_expense3"],
					'transport_traveling_expenses' => $data["transport_travelling_expenses3"],
					'entertainment_expenses' => $data["entertainment_expense3"],
					'debt_interest_finance_expenses' => $data["debt_interest_finance_expenses3"],
					'net_profit' => $data["net_profit3"],
					'net_profit_before_interest_tax_ebit' => $data["net_profit_before_interest_tax3"],
					'inventories_closing_stock' => $data["inventories_closing_stock3"],
					'trade_receivable' => $data["trade_receivable3"],
					'trade_payable' => $data["trade_payable3"],
					'non_current_assets' => $data["non_current_assets3"],
					'current_assets' => $data["current_assets3"],
					'current_liabilities' => $data["current_liabilities3"],
					'non_current_liabilities' => $data["non_current_liabilities3"],
					'share_capital' => $data["share_capita3"],
					'retained_earning' => $data["retained_earning3"],
					'translation_reserves' => $data["translation_reserves3"],
					'total_debt' => $data["total_debt3"],
					'prepaid_expenses' => $data["prepaid_expenses3"],
					'created_at' => date('Y-m-d'),
					'added_by' => $userId,
					'status' => 1,
				]);

				if ($ok) {
					$fa = new FA_Results();
					$ReceivableTurnover = $fa->ReceivableTurnover($data["income3"], $data["trade_receivable3"]);
					$AverageCollectionPeriod = $fa->AverageCollectionPeriod($ReceivableTurnover);
					$InventoryTurnover = $fa->InventoryTurnover($data["cost_good_sold3"], $data["inventories_closing_stock3"]);
					$DaysInInventory = $fa->DaysInInventory($InventoryTurnover);
					$PayableTurnover = $fa->PayableTurnover($data["purchase3"], $data["trade_payable3"]);
					$AveragePaymentPeriod = $fa->AveragePaymentPeriod($PayableTurnover);
					$NetWorkingCapital = $fa->NetWorkingCapital($data["current_assets3"], $data["current_liabilities3"]);
					$CurrentRatio = $fa->CurrentRatio($data["current_assets3"], $data["current_liabilities3"]);
					$QuickRatio = $fa->QuickRatio($data["current_assets3"], $data["current_liabilities3"], $data["inventories_closing_stock3"], $data["prepaid_expenses3"]);
					$DebtToEquity = $fa->DebtToEquity($data["total_debt3"], $data["share_capita3"]);
					$DebtToAsset = $fa->DebtToAsset($data["total_debt3"], $data["current_assets3"]);
					$InterestCoverageRatio = $fa->InterestCoverageRatio($data["net_profit_before_interest_tax3"], $data["debt_interest_finance_expenses3"]);
					$GrossProfitMargin = $fa->GrossProfitMargin($data["gross_profit3"], $data["income3"]);
					$OperatingProfitMargin = $fa->OperatingProfitMargin($data["net_profit_before_interest_tax3"], $data["income3"]);
					$NetProfitMargin = $fa->NetProfitMargin($data["net_profit3"], $data["income3"]);
					$ReturnOfInvestments = $fa->ReturnOfInvestments($data["current_assets3"], $data["income3"]);
					$ReturnOfEquity = $fa->ReturnOfEquity($data["share_capita3"], $data["income3"]);

					FA_Results::create([
						'fk_fa_id' => $ok->id,
						'user_id' => $userId,
						'company_id' => $companyId,
						'year_param' => $data["fa_year3"],
						'month_param' => $data["fa_month3"],
						'receivable_turnover' => $ReceivableTurnover,
						'average_collection_period' => $AverageCollectionPeriod,
						'inventory_turnover' => $InventoryTurnover,
						'days_in_inventory' => $DaysInInventory,
						'payable_turnover' => $PayableTurnover,
						'average_payment_period' => $AveragePaymentPeriod,
						'net_working_capital' => $NetWorkingCapital,
						'current_ratio' => $CurrentRatio,
						'quick_ratio' => $QuickRatio,
						'debt_to_equity' => $DebtToEquity,
						'debt_to_asset' => $DebtToAsset,
						'interest_coverage' => $InterestCoverageRatio,
						'gross_profit_margin' => $GrossProfitMargin,
						'operating_profit_margin' => $OperatingProfitMargin,
						'net_profit_margin' => $NetProfitMargin,
						'return_of_investment' => $ReturnOfInvestments,
						'return_of_equity' => $ReturnOfEquity,
						'status' => 1,
						'created_at' => date('Y-m-d'),
					]);

				}

			}

		}

		if ( isset($data["fa_year4"]) && isset($data["fa_month4"]) && $data["fa_month4"] != "0" && $data["fa_year4"] != "0") {

			$fa4 = FinancialAnalysis::where('entry', 4)->where('user_id', $userId)->where('company_id', $companyId)->first();

			if ($fa4 != null ) {
				$fa4->year_param = $data["fa_year4"];
				$fa4->month_param = $data["fa_month4"];
				$fa4->income = $data["income4"];
				$fa4->purchase = $data["purchase4"];
				$fa4->cost_goodsold_costsales = $data["cost_good_sold4"];
				$fa4->gross_profit = $data["gross_profit4"];
				$fa4->directors_fee_renum = $data["directors_fee_renum4"];
				$fa4->totalrenum_exdirector_feerenum = $data["total_renum_exdirector4"];
				$fa4->medical_expenses = $data["medical_expense4"];
				$fa4->transport_traveling_expenses = $data["transport_travelling_expenses4"];
				$fa4->entertainment_expenses = $data["entertainment_expense4"];
				$fa4->debt_interest_finance_expenses = $data["debt_interest_finance_expenses4"];
				$fa4->net_profit = $data["net_profit4"];
				$fa4->net_profit_before_interest_tax_ebit = $data["net_profit_before_interest_tax4"];
				$fa4->inventories_closing_stock = $data["inventories_closing_stock4"];
				$fa4->trade_receivable = $data["trade_receivable4"];
				$fa4->trade_payable = $data["trade_payable4"];
				$fa4->non_current_assets = $data["non_current_assets4"];
				$fa4->current_assets = $data["current_assets4"];
				$fa4->current_liabilities = $data["current_liabilities4"];
				$fa4->non_current_liabilities = $data["non_current_liabilities4"];
				$fa4->share_capital = $data["share_capita4"];
				$fa4->retained_earning = $data["retained_earning4"];
				$fa4->translation_reserves = $data["translation_reserves4"];
				$fa4->total_debt = $data["total_debt4"];
				$fa4->prepaid_expenses = $data["prepaid_expenses4"];

				if ($fa4->save()) {
					$fa = new FA_Results();
					$ReceivableTurnover = $fa->ReceivableTurnover($data["income4"], $data["trade_receivable4"]);
					$AverageCollectionPeriod = $fa->AverageCollectionPeriod($ReceivableTurnover);
					$InventoryTurnover = $fa->InventoryTurnover($data["cost_good_sold4"], $data["inventories_closing_stock4"]);
					$DaysInInventory = $fa->DaysInInventory($InventoryTurnover);
					$PayableTurnover = $fa->PayableTurnover($data["purchase4"], $data["trade_payable4"]);
					$AveragePaymentPeriod = $fa->AveragePaymentPeriod($PayableTurnover);
					$NetWorkingCapital = $fa->NetWorkingCapital($data["current_assets4"], $data["current_liabilities4"]);
					$CurrentRatio = $fa->CurrentRatio($data["current_assets4"], $data["current_liabilities4"]);
					$QuickRatio = $fa->QuickRatio($data["current_assets4"], $data["current_liabilities4"], $data["inventories_closing_stock4"], $data["prepaid_expenses4"]);
					$DebtToEquity = $fa->DebtToEquity($data["total_debt4"], $data["share_capita4"]);
					$DebtToAsset = $fa->DebtToAsset($data["total_debt4"], $data["current_assets4"]);
					$InterestCoverageRatio = $fa->InterestCoverageRatio($data["net_profit_before_interest_tax4"], $data["debt_interest_finance_expenses4"]);
					$GrossProfitMargin = $fa->GrossProfitMargin($data["gross_profit4"], $data["income4"]);
					$OperatingProfitMargin = $fa->OperatingProfitMargin($data["net_profit_before_interest_tax4"], $data["income4"]);
					$NetProfitMargin = $fa->NetProfitMargin($data["net_profit4"], $data["income4"]);
					$ReturnOfInvestments = $fa->ReturnOfInvestments($data["current_assets4"], $data["income4"]);
					$ReturnOfEquity = $fa->ReturnOfEquity($data["share_capita4"], $data["income4"]);

					$far4 = FA_Results::where('user_id', $userId)->where('fk_fa_id', $fa4->id)->first();
					if ($far4 != null ) {
						$far4->year_param = $data["fa_year4"];
						$far4->month_param = $data["fa_month4"];
						$far4->receivable_turnover = $ReceivableTurnover;
						$far4->average_collection_period = $AverageCollectionPeriod;
						$far4->inventory_turnover = $InventoryTurnover;
						$far4->days_in_inventory = $DaysInInventory;
						$far4->payable_turnover = $PayableTurnover;
						$far4->average_payment_period = $AveragePaymentPeriod;
						$far4->net_working_capital = $NetWorkingCapital;
						$far4->current_ratio = $CurrentRatio;
						$far4->quick_ratio = $QuickRatio;
						$far4->debt_to_equity = $DebtToEquity;
						$far4->debt_to_asset = $DebtToAsset;
						$far4->interest_coverage = $InterestCoverageRatio;
						$far4->gross_profit_margin = $GrossProfitMargin;
						$far4->operating_profit_margin = $OperatingProfitMargin;
						$far4->net_profit_margin = $NetProfitMargin;
						$far4->return_of_investment = $ReturnOfInvestments;
						$far4->return_of_equity = $ReturnOfEquity;
						$far4->save();
					}
				}

			} else {

				$ok = FinancialAnalysis::create([
					'user_id' => $userId,
					'company_id' => $companyId,
					'entry' => 4,
					'year_param' => $data["fa_year4"],
					'month_param' => $data["fa_month4"],
					'income' => $data["income4"],
					'purchase' => $data["purchase4"],
					'cost_goodsold_costsales' => $data["cost_good_sold4"],
					'gross_profit' => $data["gross_profit4"],
					'directors_fee_renum' => $data["directors_fee_renum4"],
					'totalrenum_exdirector_feerenum' => $data["total_renum_exdirector4"],
					'medical_expenses' => $data["medical_expense4"],
					'transport_traveling_expenses' => $data["transport_travelling_expenses4"],
					'entertainment_expenses' => $data["entertainment_expense4"],
					'debt_interest_finance_expenses' => $data["debt_interest_finance_expenses4"],
					'net_profit' => $data["net_profit4"],
					'net_profit_before_interest_tax_ebit' => $data["net_profit_before_interest_tax4"],
					'inventories_closing_stock' => $data["inventories_closing_stock4"],
					'trade_receivable' => $data["trade_receivable4"],
					'trade_payable' => $data["trade_payable4"],
					'non_current_assets' => $data["non_current_assets4"],
					'current_assets' => $data["current_assets4"],
					'current_liabilities' => $data["current_liabilities4"],
					'non_current_liabilities' => $data["non_current_liabilities4"],
					'share_capital' => $data["share_capita4"],
					'retained_earning' => $data["retained_earning4"],
					'translation_reserves' => $data["translation_reserves4"],
					'total_debt' => $data["total_debt4"],
					'prepaid_expenses' => $data["prepaid_expenses4"],
					'created_at' => date('Y-m-d'),
					'added_by' => $userId,
					'status' => 1,
				]);

				if ($ok) {
					$fa = new FA_Results();
					$ReceivableTurnover = $fa->ReceivableTurnover($data["income4"], $data["trade_receivable4"]);
					$AverageCollectionPeriod = $fa->AverageCollectionPeriod($ReceivableTurnover);
					$InventoryTurnover = $fa->InventoryTurnover($data["cost_good_sold4"], $data["inventories_closing_stock4"]);
					$DaysInInventory = $fa->DaysInInventory($InventoryTurnover);
					$PayableTurnover = $fa->PayableTurnover($data["purchase4"], $data["trade_payable4"]);
					$AveragePaymentPeriod = $fa->AveragePaymentPeriod($PayableTurnover);
					$NetWorkingCapital = $fa->NetWorkingCapital($data["current_assets4"], $data["current_liabilities4"]);
					$CurrentRatio = $fa->CurrentRatio($data["current_assets4"], $data["current_liabilities4"]);
					$QuickRatio = $fa->QuickRatio($data["current_assets4"], $data["current_liabilities4"], $data["inventories_closing_stock4"], $data["prepaid_expenses4"]);
					$DebtToEquity = $fa->DebtToEquity($data["total_debt4"], $data["share_capita4"]);
					$DebtToAsset = $fa->DebtToAsset($data["total_debt4"], $data["current_assets4"]);
					$InterestCoverageRatio = $fa->InterestCoverageRatio($data["net_profit_before_interest_tax4"], $data["debt_interest_finance_expenses4"]);
					$GrossProfitMargin = $fa->GrossProfitMargin($data["gross_profit4"], $data["income4"]);
					$OperatingProfitMargin = $fa->OperatingProfitMargin($data["net_profit_before_interest_tax4"], $data["income4"]);
					$NetProfitMargin = $fa->NetProfitMargin($data["net_profit4"], $data["income4"]);
					$ReturnOfInvestments = $fa->ReturnOfInvestments($data["current_assets4"], $data["income4"]);
					$ReturnOfEquity = $fa->ReturnOfEquity($data["share_capita4"], $data["income4"]);

					FA_Results::create([
						'fk_fa_id' => $ok->id,
						'user_id' => $userId,
						'company_id' => $companyId,
						'year_param' => $data["fa_year4"],
						'month_param' => $data["fa_month4"],
						'receivable_turnover' => $ReceivableTurnover,
						'average_collection_period' => $AverageCollectionPeriod,
						'inventory_turnover' => $InventoryTurnover,
						'days_in_inventory' => $DaysInInventory,
						'payable_turnover' => $PayableTurnover,
						'average_payment_period' => $AveragePaymentPeriod,
						'net_working_capital' => $NetWorkingCapital,
						'current_ratio' => $CurrentRatio,
						'quick_ratio' => $QuickRatio,
						'debt_to_equity' => $DebtToEquity,
						'debt_to_asset' => $DebtToAsset,
						'interest_coverage' => $InterestCoverageRatio,
						'gross_profit_margin' => $GrossProfitMargin,
						'operating_profit_margin' => $OperatingProfitMargin,
						'net_profit_margin' => $NetProfitMargin,
						'return_of_investment' => $ReturnOfInvestments,
						'return_of_equity' => $ReturnOfEquity,
						'status' => 1,
						'created_at' => date('Y-m-d'),
					]);
				}
			}

		}

	}


	public static function saveCreateCSV($filePathCsv, $companyId, $userId) 
	{

	   $file = fopen($filePathCsv, "r") or die(" $filePathCsv file is not there! \n");
	   $data = array();
	   
	   $months = array("Jan.", "Feb.", "Mar.", "Apr.", "May", "Jun.", "Jul.", "Aug.", "Sep.", "Oct.", "Nov.", "Dec.");
	   
	   $i = 0;
	   
	   $not_match_month = "";
	   
       while(! feof($file))
        {
			$d = fgetcsv($file);

                if(trim($d[0]) != 'Year')
                {
				 	if(isset($d)){
				 	
				 	if(array_search($d[1], $months) == 0){
				 	    $data = array();
				 	    $not_match_month = "not";
				 	    //return redirect('/profile/edit')->with('message', 'Failed to save. CSV file uploaded contains MONTH WORD that is not same in the proper format!.');  
				 	    //break;
				 	    //exit();
				 	}
				 	else{
				 	  $data["fa_month".$i] = array_search($d[1], $months) + 1;  
				 	}
				 	
					$data["fa_year".$i] = $d[0];
					$data["income".$i] = $d[2];
					$data["purchase".$i] = $d[3];
					$data["cost_good_sold".$i] = $d[4];
					$data["gross_profit".$i] = $d[5];
					$data["directors_fee_renum".$i] = $d[6];
					$data["total_renum_exdirector".$i] = $d[7];
					$data["medical_expense".$i] = $d[8];
					$data["transport_travelling_expenses".$i] = $d[9];
					$data["entertainment_expense".$i] = $d[10];
					$data["debt_interest_finance_expenses".$i] = $d[11];
					$data["net_profit".$i] = $d[12];
					$data["net_profit_before_interest_tax".$i] = $d[13];
					$data["inventories_closing_stock".$i] = $d[14];
					$data["trade_receivable".$i] = $d[15];
					$data["trade_payable".$i] = $d[16];
					$data["non_current_assets".$i] = $d[17];
					$data["current_assets".$i] = $d[18];
					$data["current_liabilities".$i] = $d[19];
					$data["non_current_liabilities".$i] = $d[20];
					$data["share_capita".$i] = $d[21];
					$data["retained_earning".$i] = $d[22];
					$data["translation_reserves".$i] = $d[23];
					$data["total_debt".$i] = $d[24];
					$data["prepaid_expenses".$i] = $d[25];
					 }

				}
				if($i >= 5 ){
				break;
				}
				$i++;
		}

		if(sizeof($data) > 0){
			//reuse a method here
			//var_dump($data);
			//exit;
			FinancialAnalysis::saveCreate($data, $companyId, $userId);
		}
        return $not_match_month;
	}






}
