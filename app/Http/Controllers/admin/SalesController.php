<?php

namespace App\Http\Controllers\admin;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sales;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller {

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

    
    public function form( string | int $id = '')
    {
        $sale = null;
        if (is_numeric($id)) {
            $sale = Sales::findOrFail($id);
        }
        return view('admin.sales.form', compact('sale'));
    }


    public function store(Request $request, int $id = 0)
    {
        $sale = null;
        if ($id) {
            $sale = Sales::findOrFail($id);
        }

        $data = $request->validate([
            'customer_id' => 'required|numeric|exists:customers,id',
            'date' => 'required|date_format:Y-m-d',
            'memo_number' => 'required|string',
            // 'quantity' => 'required|string',
            'goods_of_issues' => 'required|string',
            'lv' => 'required|numeric|min:0',
            'received_money' => 'required|numeric|min:0',
            'balance_due' => 'required|numeric|min:0',
            'comment' => 'nullable|string',
        ]);

        if ($sale) {
            $sale->update($data);
            return $this->backToForm('Sale updated successfully!');
        } else {
            Sales::create($data);
            return $this->backToForm('Sale added successfully!');
        }
    }

    public function deleteMultiple(Request $request) {
        $delete = DB::table('sales')->whereIn('id', $request->itemArray)->delete();
        return $delete ? 1 : 0;
    }
    public function delete(Request $request, int $id) {
        if (Sales::destroy($id)) {
            return redirect()->back()->with(['message' => 'Deposit deleted successfully']);
        }
        return redirect()->back()->with(['message' => 'Unable to delete ']);
    }
}
