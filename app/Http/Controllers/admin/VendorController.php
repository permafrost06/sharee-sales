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
        $vendors = DB::table('vendors')
            ->get();
        foreach($vendors as $k=>$vendor){

            $due =  DB::select("select (sum(goods_of_issues)-sum(paid_money)) as due from purchases where vendor_id=$vendor->id");
            $vendors[$k]->due=$due[0]->due;
        }
        //dd($vendors);


        return view('admin.vendors.index',['vendors'=>$vendors]);
    }
    public function form(string | int $id)
    {
        $vendor  = null;
        if (is_numeric($id)) {
            $vendor = Vendor::findOrfail($id);
        }

        return view('admin.vendors.form', compact('vendor'));
    }
   
    public function store(Request $request, int $id = 0)
    {
        $vendor = null;

        if ($id) {
            $vendor = Vendor::findOrFail($id);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'limit' => 'required|string',
            'type' => 'nullable|string'
        ]);

        if ($vendor) {
            $vendor->update($data);
            return $this->backToForm('Vendor updated successfully!');
        } else {
            Vendor::create($data);
            return $this->backToForm('Vendor added successfully!');
        }
    }

    public function delete(Request $request)
    {
        if (Vendor::destroy($request->id)){
            return redirect()->back()->with(['message'=>'Vendor deleted successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to delete ']);
    }
}
