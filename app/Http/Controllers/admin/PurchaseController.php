<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function create(Request $request)
    {
        return view('admin.purchase.form');
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

    public function store(Request $request)
    {
        $deposit = $request->except('_token');
        if (Purchase::create($deposit)){
            return redirect()->back()->with(['message'=>'New purchase created successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to create ']);

    }

    public function edit(Request $request){
        return view('admin.purchase.edit',['purchase'=>Purchase::find($request->id)]);
    }


    public function update(Request $request){
        $sale = Purchase::find($request->id);
        $deposit = $request->except('_token');

        if ($sale->update($deposit)){
            return redirect()->back()->with(['message'=>'Ledger updated successfully']);
        }

        return redirect()->back()->with(['message'=>'Unable to update ']);
    }


    public function deleteMultiple(Request $request){
        $delete = DB::table('purchases')->whereIn('id', $request->itemArray)->delete();
        return $delete?1:0;
    }


    public function delete(Request $request)
    {
        if (Purchase::destroy($request->id)){
            return redirect()->back()->with(['message'=>'Deposit deleted successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to delete ']);
    }
}
