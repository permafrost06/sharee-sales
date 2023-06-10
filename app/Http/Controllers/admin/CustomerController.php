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
    public function form(string | int $id = '')
    {
        $customer = null;

        if (is_numeric($id)) {
            $customer = Customer::findOrFail($id);
        }

        return view('admin.customers.form', compact('customer'));
    }

    public function store(Request $request, int $id = 0)
    {

        $customer = null;

        if ($id) {
            $customer = Customer::findOrFail($id);
        }

        $data = $request->validate([
            'customers_id' => 'required|string',
            'name' => 'required|string|min:3',
            'address' => 'required|string|min:3',
            'limit' => 'required|numeric|min:0',
            'type' => 'required|string'
        ]);

        if ($customer) {
            $customer->update($data);
            return $this->backToForm('Customer updated successfully!');
        } else {
            Customer::create($data);
            return $this->backToForm('Customer added successfully!');
        }
    }

    public function delete(Request $request)
    {
        if (Customer::destroy($request->id)){
            return redirect()->back()->with(['message'=>'Customer deleted successfully']);
        }
        return redirect()->back()->with(['message'=>'Unable to delete ']);
    }
}
