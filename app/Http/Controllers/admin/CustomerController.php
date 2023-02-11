<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
       $customers = DB::table('customers')
            ->get();
        foreach($customers as $k=>$customer){

            $due =  DB::select("select (sum(goods_of_issues)-sum(received_money)) as due from sales where customer_id=$customer->id");
            $customers[$k]->due=$due[0]->due;
        }

        return view('admin.customers.index',['customers'=>$customers]);
    }
    public function create()
    {
        return view('admin.customers.create');
    }
    public function edit(Request $request)
    {
        $customer = Customer::find($request->id);
        return view('admin.customers.edit',['customer'=>$customer]);
    }
    public function store(Request $request)
    {
        $customer = $request->except('_token');
        if (Customer::create($customer)){
            return redirect()->back()->with(['message'=>'Customer created successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to create ']);

    }

    public function update(Request $request)
    {
        $customer = Customer::find($request->id);
        $data = $request->except('_token');
        if ($customer->update($data)){
            return redirect()->back()->with(['message'=>'Customer updated successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to update ']);

    }
    public function delete(Request $request)
    {
        if (Customer::destroy($request->id)){
            return redirect()->back()->with(['message'=>'Customer deleted successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to delete ']);
    }
}
