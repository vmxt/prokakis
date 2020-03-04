<?php

namespace App;

use App\FinancialAnalysis;
use DB;
use Illuminate\Database\Eloquent\Model;

class FA_Results extends Model {

	protected $table = 'financial_analysis_results';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'fk_fa_id',
		'user_id',
		'company_id',
		'month_param',
		'year_param',
		'receivable_turnover',
		'average_collection_period',
		'inventory_turnover',
		'days_in_inventory',
		'payable_turnover',
		'average_payment_period',
		'net_working_capital',
		'current_ratio',
		'quick_ratio',
		'debt_to_equity',
		'debt_to_asset',
		'interest_coverage',
		'gross_profit_margin',
		'operating_profit_margin',
		'net_profit_margin',
		'return_of_investment',
		'return_of_equity',
		'status',
		'created_at',
		'updated_at',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];

	public static function getFA_entriesByUserAndCompany($userId, $companyId) {
		$fa = FinancialAnalysis::where('user_id', $userId)->where('company_id', $companyId)->get();
		if ( $fa->count() > 0 ) {
			return true;
		} else {
			return false;
		}

	}

	public static function getEntries($userId) {
		$fa = FinancialAnalysis::where('user_id', $userId)->get();
		return $fa;
	}

	public static function getTotalByMonthYears($entry, $userId, $month, $year) {
		$totalByYears = DB::select('SELECT
        ROUND(SUM(far.receivable_turnover)+
        SUM(far.average_collection_period)+
        SUM(far.inventory_turnover)+
        SUM(far.days_in_inventory)+
        SUM(far.payable_turnover)+
        SUM(far.average_payment_period)+
        SUM(far.net_working_capital)+
        SUM(far.current_ratio)+
        SUM(far.quick_ratio)+
        SUM(far.debt_to_equity)+
        SUM(far.debt_to_asset)+
        SUM(far.interest_coverage)+
        SUM(far.gross_profit_margin)+
        SUM(far.operating_profit_margin)+
        SUM(far.net_profit_margin)+
        SUM(far.return_of_investment)+
        SUM(far.return_of_equity), 0) AS totalByYears
        FROM `financial_analysis_results` AS far
        INNER JOIN `financial_analysis` AS fa ON fa.id = far.fk_fa_id
        WHERE fa.entry=' . $entry . ' AND fa.user_id=' . $userId . ' AND fa.month_param=' . $month . ' AND fa.year_param=' . $year);

		if (isset($totalByYears[0])) {
			$ans = $totalByYears[0];
			return $ans->totalByYears;
		} else {
			return 0;
		}

		return $totalByYears;
	}

	public static function getTotalByMax($userId) {
		$totalBYMax = DB::select('SELECT
        ROUND(MAX(far.receivable_turnover)+
        MAX(far.average_collection_period)+
        MAX(far.inventory_turnover)+
        MAX(far.days_in_inventory)+
        MAX(far.payable_turnover)+
        MAX(far.average_payment_period)+
        MAX(far.net_working_capital)+
        MAX(far.current_ratio)+
        MAX(far.quick_ratio)+
        MAX(far.debt_to_equity)+
        MAX(far.debt_to_asset)+
        MAX(far.interest_coverage)+
        MAX(far.gross_profit_margin)+
        MAX(far.operating_profit_margin)+
        MAX(far.net_profit_margin)+
        MAX(far.return_of_investment)+
        MAX(far.return_of_equity), 0) AS totalByMax
        FROM `financial_analysis_results` AS far
        INNER JOIN `financial_analysis` AS fa ON fa.id = far.fk_fa_id
        WHERE fa.user_id=' . $userId);

		if (isset($totalBYMax[0])) {
			$ans = $totalBYMax[0];
			return $ans->totalByMax;
		} else {
			return 0;
		}

	}

	public function ReceivableTurnover($income, $trade_receivables) {
		$income = ($income == null) ? 0 : $income;
		$trade_receivables = ($trade_receivables == null) ? 0 : $trade_receivables;
		$result = 0;

		if ($income == 0 || $trade_receivables == 0) {
			return $result;
		} else {
			$result = $income / $trade_receivables;
			return number_format($result, 1, '.', '');
		}
	}

	public function AverageCollectionPeriod($receivable_turnover) {
		$receivable_turnover = ($receivable_turnover == null) ? 0 : $receivable_turnover;
		$result = 0;

		if ($receivable_turnover == 0) {
			return $receivable_turnover;
		} else {
			$result = 365 / $receivable_turnover;
			return number_format($result, 1, '.', '');
		}
	}

	public function InventoryTurnover($cost_of_good_sold, $inventory_cost) {
		$cost_of_good_sold = ($cost_of_good_sold == null) ? 0 : $cost_of_good_sold;
		$inventory_cost = ($inventory_cost == null) ? 0 : $inventory_cost;
		$result = 0;

		if ($cost_of_good_sold == 0 || $inventory_cost == 0) {
			return $result;
		} else {
			$result = $cost_of_good_sold / $inventory_cost;
			return number_format($result, 1, '.', '');
		}

	}

	public function DaysInInventory($inventory_turnover) {
		$inventory_turnover = ($inventory_turnover == null) ? 0 : $inventory_turnover;
		$result = 0;

		if ($inventory_turnover > 0) {
			$result = 365 / $inventory_turnover;
			return number_format($result, 1, '.', '');
		} else {
			return $result;
		}
	}

	public function PayableTurnover($purchases, $trade_payable) {
		$purchases = ($purchases == null) ? 0 : $purchases;
		$trade_payable = ($trade_payable == null) ? 0 : $trade_payable;
		$result = 0;

		if ($purchases == 0 || $trade_payable == 0) {
			return $result;
		} else {
			$result = $purchases / $trade_payable;
			return number_format($result, 1, '.', '');
		}
	}

	public function AveragePaymentPeriod($payable_turnover) {
		$payable_turnover = ($payable_turnover == null) ? 0 : $payable_turnover;
		$result = 0;

		if ($payable_turnover > 0) {
			$result = 365 / $payable_turnover;
			return number_format($result, 1, '.', '');
		} else {
			return $result;
		}

	}

	public function NetWorkingCapital($current_assest, $current_liabilities) {
		$current_assest = ($current_assest == null) ? 0 : $current_assest;
		$current_liabilities = ($current_liabilities == null) ? 0 : $current_liabilities;

		$result = $current_assest - $current_liabilities;
		return number_format($result, 1, '.', '');
	}

	public function CurrentRatio($current_assest, $current_liabilities) {
		$current_assest = ($current_assest == null) ? 0 : $current_assest;
		$current_liabilities = ($current_liabilities == null) ? 0 : $current_liabilities;
		$result = 0;
		if ($current_assest == 0 || $current_liabilities == 0) {
			return $result;
		} else {
			$result = $current_assest / $current_liabilities;
			return number_format($result, 1, '.', '');
		}
	}

	public function QuickRatio($current_assest, $current_liabilities, $inventory, $prepaid_expense) {
		$current_assest = ($current_assest == null) ? 0 : $current_assest;
		$inventory = ($inventory == null) ? 0 : $inventory;
		$prepaid_expense = ($prepaid_expense == null) ? 0 : $prepaid_expense;
		$current_liabilities = ($current_liabilities == null) ? 0 : $current_liabilities;
		$result = 0;
		$sumAns = ($current_assest - $inventory - $prepaid_expense);

		if ($sumAns == 0 || $current_liabilities == 0) {
			return $result;
		} else {
			$result = $sumAns / $current_liabilities;
			return number_format($result, 1, '.', '');
		}
	}

	public function DebtToEquity($total_debt, $share_capita) {
		$total_debt = ($total_debt == null) ? 0 : $total_debt;
		$share_capita = ($share_capita == null) ? 0 : $share_capita;
		$result = 0;

		if ($total_debt == 0 || $share_capita == 0) {
			return $result;
		} else {
			$result = $total_debt / $share_capita;
			return number_format($result, 1, '.', '');
		}

	}

	public function DebtToAsset($total_debt, $total_assets) {
		$total_debt = ($total_debt == null) ? 0 : $total_debt;
		$total_assets = ($total_assets == null) ? 0 : $total_assets;
		$result = 0;

		if ($total_debt == 0 || $total_assets == 0) {
			return $result;
		} else {
			$result = $total_debt / $total_assets;
			return number_format($result, 1, '.', '');
		}

	}

	public function InterestCoverageRatio($ebit, $debt_interest) {
		$ebit = ($ebit == null) ? 0 : $ebit;
		$debt_interest = ($debt_interest == null) ? 0 : $debt_interest;
		$result = 0;

		if ($ebit == 0 || $debt_interest == 0) {
			return $result;
		} else {
			$result = $ebit / $debt_interest;
			return number_format($result, 1, '.', '');
		}
	}

	public function GrossProfitMargin($gross_profit, $income) {
		$gross_profit = ($gross_profit == null) ? 0 : $gross_profit;
		$income = ($income == null) ? 0 : $income;
		$result = 0;

		if ($gross_profit == 0 || $income == 0) {
			return $result;
		} else {
			$result = ($gross_profit / $income) * 100;
			return number_format($result, 1, '.', '');
		}
	}

	public function OperatingProfitMargin($ebit, $income) {
		$ebit = ($ebit == null) ? 0 : $ebit;
		$income = ($income == null) ? 0 : $income;
		$result = 0;

		if ($ebit == 0 || $income == 0) {
			return $result;
		} else {
			$result = ($ebit / $income) * 100;
			return number_format($result, 1, '.', '');
		}

	}

	public function NetProfitMargin($net_profit, $income) {
		$net_profit = ($net_profit == null) ? 0 : $net_profit;
		$income = ($income == null) ? 0 : $income;
		$result = 0;

		if ($net_profit == 0 || $income == 0) {
			return $result;
		} else {
			$result = ($net_profit / $income) * 100;
			return number_format($result, 1, '.', '');
		}
	}

	public function ReturnOfInvestments($total_assets, $income) {
		$income = ($income == null) ? 0 : $income;
		$total_assets = ($total_assets == null) ? 0 : $total_assets;
		$result = 0;

		if ($income == 0 || $total_assets == 0) {
			return $result;
		} else {
			$result = ($income / $total_assets) * 100;
			return number_format($result, 1, '.', '');
		}

	}

	public function ReturnOfEquity($share_capital, $income) {
		$income = ($income == null) ? 0 : $income;
		$share_capital = ($share_capital == null) ? 0 : $share_capital;
		$result = 0;

		if ($income == 0 || $share_capital == 0) {
			return $result;
		} else {
			$result = ($income / $share_capital) * 100;
			return number_format($result, 1, '.', '');
		}
	}

}
