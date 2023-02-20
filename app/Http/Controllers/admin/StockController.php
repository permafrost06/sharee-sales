<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StockController extends Controller
{

    public function index()
    {
        $stocks = Stock::selectRaw("item_code, SUM(IF(type='in', quantity, -quantity)) AS total_quantity")->groupBy('item_code')->get();
        return view('admin.stocks.status', compact('stocks'));
    }

    public function logs(?string $item = null)
    {
        $query = Stock::query();
        if($item){
            $query->where('item_code', $item);
        }
        return view('admin.stocks.logs', [
            'logs' => $query->get()
        ]);
    }

    public function form(Request $req, ?string $stock = null)
    {
        $suggetions = Stock::selectRaw('item_code, brand, supplier_name, supplier_contact, carrier_name, carrier_contact, border')
            ->groupByRaw('item_code, brand, supplier_name, supplier_contact, carrier_name, carrier_contact, border')->get();
        if(is_numeric($stock)){
            $stock = Stock::findOrFail($stock);
        }else{
            $stock= null;
        }

        $uniques = [];
        
        foreach(explode(
            ', ',
            'item_code, brand, supplier_name, supplier_contact, carrier_name, carrier_contact, border'
        ) as $k){
            $uniques[$k] = [];
        }

        foreach ($suggetions as $stock) {
            foreach($stock->getAttributes() as $k=>$v){
                if(!isset($uniques[$k][$v])){
                    $uniques[$k][$v] = true;
                }
            }
        }

        

        return view('admin.stocks.form', [
            'stock' => $stock,
            'item_codes' => array_keys($uniques['item_code']),
            'brands' => array_keys($uniques['brand']),
            'supplier_names' => array_keys($uniques['supplier_name']),
            'supplier_contacts' => array_keys($uniques['supplier_contact']),
            'carrier_names' => array_keys($uniques['carrier_name']),
            'carrier_contacts' => array_keys($uniques['carrier_contact']),
            'borders' => array_keys($uniques['border']),
        ]);
    }

    public function store(Request $req, ?string $stock = null)
    {

        if($req->has('date_time')){
            $req->merge([
                'date_time' => str_replace('T', ' ', $req->get('date_time').':00')
            ]);
        }

        $data = $req->validate([
            'type' => 'required|in:in,out',
            'item_code' => 'required|string',
            'date_time' => 'required|date_format:Y-m-d H:i:s',
            'brand' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'supplier_name' => 'nullable|string',
            'supplier_contact' => 'nullable|string',
            'carrier_name' => 'nullable|string',
            'carrier_contact' => 'nullable|string',
            'border' => 'nullable|string',
            'remarks' => 'nullable|string',
            'attachment' => 'mimes:jpeg,png,pdf'
        ]);

        if(isset($data['attachment'])){
            $attachment = $data['attachment'];
            $dir = "uploads/attachment";
            $public = config('filesystems.disks.public.root');
            if(!file_exists("$public/$dir") && !Storage::disk('public')->makeDirectory($dir)){
                throw new \Exception("Unable to create directory: $public/$dir");
            }
            
            $name = 'attachment_'.time().".{$attachment->extension()}";
            error_log($name);
            $attachment->storePubliclyAs('public/'.$dir, $name);
            $data['attachment'] = "/storage/$dir/$name";
        }

        if(is_numeric($stock)){
            $stock = Stock::findOrFail($stock);
            if(isset($data['attachment']) && $stock->attachment){
                Storage::delete(substr($stock->attachment, 9));
            }
            $stock->update($data);
            return redirect()->back()->with('message', 'Stock updated successfully!');
        }else{
            Stock::create($data);
            return redirect()->back()->with('message', 'Stock added successfully!');
        }
    }

    public function destroy(Stock $stock)
    {
        if($stock->attachment){
            Storage::delete(substr($stock->attachment, 9));
        }
        $stock->delete();
        return redirect()->route('stocks.status')->with('message', 'Stock deleted successfully!');
    }
}
