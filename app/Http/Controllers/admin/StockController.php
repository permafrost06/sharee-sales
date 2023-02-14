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

    public function logs(string $item)
    {
        return view('admin.stocks.logs', [
            'logs' => Stock::where('item_code', $item)->get()
        ]);
    }

    public function form(Request $req, ?string $stock = null)
    {
        if(is_numeric($stock)){
            $stock = Stock::findOrFail($stock);
        }else{
            $stock= null;
        }
        return view('admin.stocks.form', compact('stock'));
    }

    public function store(Request $req, ?string $stock = null)
    {
        $fileValidation = [
            'mimes:jpeg,png,pdf',
            function ($attribute, $value, $fail) {
                if ($value->getClientOriginalExtension() == 'pdf') {
                    return;
                }
                
                list($width, $height) = getimagesize($value->getRealPath());
                
                if ($width > 1500 || $height > 1500) {
                    $fail("The image dimensions must be less than 1500x1500.");
                }
            },
            
        ];
        if(!is_numeric($stock)){
            $fileValidation = ['required', ...$fileValidation];
        }

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
            'supplier_name' => 'required|string',
            'supplier_contact' => 'required|string',
            'carrier_name' => 'required|string',
            'carrier_contact' => 'required|string',
            'border' => 'required|string',
            'remarks' => $fileValidation
        ]);

        if(isset($data['remarks'])){
            $remarks = $data['remarks'];
            $dir = "uploads/remarks";
            $public = config('filesystems.disks.public.root');
            if(!file_exists("$public/$dir") && !Storage::disk('public')->makeDirectory($dir)){
                throw new \Exception("Unable to create directory: $public/$dir");
            }
            
            $name = 'remarks_'.time().".{$remarks->extension()}";
            error_log($name);
            $remarks->storePubliclyAs('public/'.$dir, $name);
            $data['remarks'] = "/storage/$dir/$name";
        }

        if(is_numeric($stock)){
            $stock = Stock::findOrFail($stock);
            if(isset($data['remarks'])){
                Storage::delete(substr($stock->remarks, 9));
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
        Storage::delete(substr($stock->remarks, 9));
        $stock->delete();
        return redirect()->route('stocks.status')->with('message', 'Stock deleted successfully!');
    }
}
