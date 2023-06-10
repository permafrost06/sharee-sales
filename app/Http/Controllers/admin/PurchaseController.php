<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function form(Request $request, string | int $id = '')
    {
        $purchase = null;

        if (is_numeric($id)) {
            $purchase = Purchase::findOrFail($id);
        }

        return view('admin.purchase.form', compact('purchase'));
    }
    public function index(Request $request)
    {
        $ball=$goodsOfIssue=$paidMoney=$dueBalance=$totalQuantity=0;
        $purchases = DB::table('purchases')
            ->select('purchases.*','vendors.id as vendors_id','vendors.name','vendors.limit')
            ->leftJoin('vendors','purchases.vendor_id','=','vendors.id')
            ->where('vendor_id',$request->id)
            ->get();
        //dd($purchases);
        if (isset($purchases)) {
            foreach ($purchases as $purchase) {
                $ball+=(int)$purchase->ball;
                $totalQuantity+=(int)$purchase->quantity;
                $goodsOfIssue += (int)$purchase->goods_of_issues;
                $paidMoney += (int)$purchase->paid_money;
                $dueBalance += (int)$purchase->balance_due;
            }
        }
        $totalDue = ($goodsOfIssue-$paidMoney);
        return view('admin.purchase.index',[
            'purchases'=>$purchases,
            'ball'=>$ball,
            'totalQuantity'=>$totalQuantity,
            'goodsOfIssues'=>$goodsOfIssue,
            'paidMoney'=>$paidMoney,
            'dueBalance'=>$dueBalance,
            'totalDue'=>$totalDue
        ]);
    }

    public function generatePDF(Request $request)
    {
        $ball=$goodsOfIssue=$paidMoney=$dueBalance=0;
        $purchases = DB::table('purchases')
            ->select('purchases.*','vendors.id as vendors_id','vendors.name','vendors.limit')
            ->leftJoin('vendors','purchases.vendor_id','=','vendors.id')
            ->where('vendor_id',$request->id)
            ->get();
        // dd($purchases);
        if (isset($purchases)) {
            foreach ($purchases as $purchase) {
                $ball+=(int)$purchase->ball;
                $goodsOfIssue += (int)$purchase->goods_of_issues;
                $paidMoney += (int)$purchase->paid_money;
                $dueBalance += (int)$purchase->balance_due;
            }
        }
        $totalDue = ($goodsOfIssue-$paidMoney);
        $pdf = Pdf::loadView('admin.purchase.pdf', [
            'purchases'=>$purchases,
            'ball'=>$ball,
            'goodsOfIssues'=>$goodsOfIssue,
            'paidMoney'=>$paidMoney,
            'dueBalance'=>$dueBalance,
            'totalDue'=>$totalDue
        ]);

        return $pdf->download('purchase.pdf');
    }

    public function store(Request $request, int $id = 0)
    {
        $purchase = null;
        if ($id) {
            $purchase = Purchase::findOrFail($id);
        }

        $data = $request->validate([
            'vendor_id' => 'required|numeric|exists:vendors,id',
            'date' => 'required|date_format:Y-m-d',
            'memo_number' => 'nullable|string',
            'quantity' => 'required|string',
            'mark' => 'required|string',
            'ball' => 'required|string',
            'goods_of_issues' => 'required|string',
            'paid_money' => 'required|numeric|min:0',
            'balance_due' => 'nullable|numeric|min:0',
            'comment' => 'nullable|string',
        ]);

        if ($purchase) {
            $purchase->update($data);
            return $this->backToForm('Purchase updated successfully!');
        } else {
            Purchase::create($data);
            return $this->backToForm('Purchase added successfully!');
        }
    }

    public function deleteMultiple(Request $request){
        $delete = DB::table('purchases')->whereIn('id', $request->itemArray)->delete();
        return $delete?1:0;
    }


    public function delete(int $id)
    {
        if (Purchase::destroy($id)){
            return redirect()->back()->with(['message'=>'Deposit deleted successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to delete ']);
    }
}
