<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StockItemController extends Controller
{
    public function items_api(Request $req)
    {
        $query = Stock::with('item')->selectRaw("
            item_code,
            SUM(IF(type='in', quantity, -quantity)) AS total_quantity,
            SUM(IF(type='in', quantity, 0)) AS total_in,
            SUM(IF(type='out', quantity, 0)) AS total_out,
            (
                SUM(IF(type='out', quantity * unit_cost + adjustment, 0))
                -
                SUM(IF(type='in', quantity * unit_cost + adjustment, 0))
            ) AS profit
        ")->groupBy('item_code');
        

        $draw = (int)$req->query('draw', 1);
        $length = (int)$req->query('length', 10);
        $start = (int)$req->query('start', 0);

        if($key = $req->query('search')['value']){
            $query->where('item_code', 'LIKE', "%$key%");
            $filtered = DB::selectOne('SELECT COUNT(*) AS res FROM (
                SELECT item_code FROM `stocks` WHERE item_code LIKE ? GROUP BY item_code
            ) AS tbl', ["%$key%"])?->res;
        }else{
            $filtered = $query->count();
        }

        $cols = $req->query('columns');

        foreach($req->query('order') as $sort){
            $query->orderBy($cols[$sort['column']]['name'], $sort['dir']);
        }
        $data = $query->limit($length)->offset($start)->get();

        return [
            'draw' => $draw,
            'data' => $data,
            'start' => $start,
            'recordsTotal' => Stock::groupBy('item_code')->count(),
            'recordsFiltered' => $filtered
        ];
    }


    public function index()
    {
        return view('admin.stocks.status');
    }

    public function store(Request $req)
    {

        $data = $req->validate([
            'item_code' => 'required|string',
            'remarks' => 'nullable|string',
            'attachment' => 'mimes:jpeg,png,pdf'
        ]);

        $item = StockItem::where('item_code', $data['item_code'])->first();

        if(isset($data['attachment'])){
            $attachment = $data['attachment'];
            $dir = "uploads/attachment";
            $public = config('filesystems.disks.public.root');
            if(!file_exists("$public/$dir") && !Storage::disk('public')->makeDirectory($dir)){
                throw new \Exception("Unable to create directory: $public/$dir");
            }
            
            $name = 'attachment_'.time().".{$attachment->extension()}";
            $attachment->storePubliclyAs('public/'.$dir, $name);
            $data['attachment'] = "/storage/$dir/$name";
        }

        if(!is_null($item)){
            if(isset($data['attachment']) && $item->attachment){
                Storage::delete(substr($item->attachment, 9));
            }
            $item->update($data);
            return redirect()->back()->with('message', 'Info updated successfully!');
        }else{
            StockItem::create($data);
            return redirect()->back()->with('message', 'Info added successfully!');
        }
    }

}
