<?php

namespace App\Http\Controllers\admin;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sales;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller {

    public function create()
    {
        return view('admin.sales.deposit_form');
    }

    public function index(Request $request) {
        $lv = $goodsOfIssue = $receivedMoney = $dueBalance = 0;
        $customerDeposits = DB::table('sales')
            ->select('sales.*', 'customers.id as customers_id', 'customers.name', 'customers.limit')
            ->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
            ->where('customer_id', $request->id)
            ->get();
        //dd($customerDeposits);
        if (isset($customerDeposits)) {
            foreach ($customerDeposits as $customerDeposit) {

                $lv += $customerDeposit->lv;
                $goodsOfIssue += $customerDeposit->goods_of_issues;
                $receivedMoney += $customerDeposit->received_money;
                $dueBalance += $customerDeposit->balance_due;
            }
        }
        $totalDue = ($goodsOfIssue - $receivedMoney);
        return view('admin.sales.index', [
            'customerDeposits' => $customerDeposits,
            'lv' => $lv,
            'goodsOfIssues' => $goodsOfIssue,
            'receivedMoney' => $receivedMoney,
            'dueBalance' => $dueBalance,
            'totalDue' => $totalDue
        ]);
    }

    public function generatePDF(Request $request) {
        $lv = $goodsOfIssue = $receivedMoney = $dueBalance = 0;
        $customerDeposits = DB::table('sales')
            ->leftJoin('customers', 'sales.customer_id', '=', 'customers.id')
            ->where('customer_id', $request->id)
            ->get();
        //dd($customerDeposits);
        if (isset($customerDeposits)) {
            foreach ($customerDeposits as $customerDeposit) {

                $lv += $customerDeposit->lv;
                $goodsOfIssue += $customerDeposit->goods_of_issues;
                $receivedMoney += $customerDeposit->received_money;
                $dueBalance += $customerDeposit->balance_due;
            }
        }
        $totalDue = ($goodsOfIssue - $receivedMoney);
        $pdf = Pdf::loadView('admin.sales.pdf', [
            'customerDeposits' => $customerDeposits,
            'lv' => $lv,
            'goodsOfIssues' => $goodsOfIssue,
            'receivedMoney' => $receivedMoney,
            'dueBalance' => $dueBalance,
            'totalDue' => $totalDue
        ]);

        $date = (new DateTime)->format('d-m-Y');
        $pdf_name = "sales ledger {$customerDeposits[0]->name} $date";

        return $pdf->download($pdf_name);
    }

    public function store(Request $request) {
        $deposit = $request->except('_token');
        if (Sales::create($deposit)) {
            return redirect()->back()->with(['message' => 'New deposit created successfully']);
        }
        return redirect()->back()->with(['message' => 'Unable to create ']);
    }

    public function edit(Request $request) {
        return view('admin.sales.edit', ['sale' => Sales::find($request->id)]);
    }

    public function update(Request $request) {
        $sale = Sales::find($request->id);
        $deposit = $request->except('_token');

        if ($sale->update($deposit)) {
            return redirect()->back()->with(['message' => 'Ledger updated successfully']);
        }

        return redirect()->back()->with(['message' => 'Unable to update ']);
    }

    public function deleteMultiple(Request $request) {
        $delete = DB::table('sales')->whereIn('id', $request->itemArray)->delete();
        return $delete ? 1 : 0;
    }
    public function delete(Request $request) {
        if (Sales::destroy($request->id)) {
            return redirect()->back()->with(['message' => 'Deposit deleted successfully']);
        }
        return redirect()->back()->with(['message' => 'Unable to delete ']);
    }
}
