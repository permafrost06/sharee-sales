<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;

class VendorController extends Controller
{
    public function index()
    {
        $goi=$rm=0;
        $vendors = DB::table('vendors')
            ->get();
        foreach($vendors as $k=>$vendor){

            $due =  DB::select("select (sum(goods_of_issues)-sum(paid_money)) as due from purchases where vendor_id=$vendor->id");
            $vendors[$k]->due=$due[0]->due;
        }
        //dd($vendors);


        return view('admin.vendors.index',['vendors'=>$vendors]);
    }
    public function create()
    {
        return view('admin.vendors.create');
    }
    public function edit(Request $request)
    {
        $vendor = Vendor::find($request->id);
        return view('admin.vendors.edit',['vendor'=>$vendor]);
    }
    public function store(Request $request)
    {
        $customer = $request->except('_token');
        if (Vendor::create($customer)){
            return redirect()->back()->with(['message'=>'Vendor created successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to create ']);

    }

    public function update(Request $request)
    {
        $customer = Vendor::find($request->id);
        $data = $request->except('_token');
        if ($customer->update($data)){
            return redirect()->back()->with(['message'=>'Vendor updated successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to update ']);

    }
    public function delete(Request $request)
    {
        if (Vendor::destroy($request->id)){
            return redirect()->back()->with(['message'=>'Vendor deleted successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to delete ']);
    }
}
