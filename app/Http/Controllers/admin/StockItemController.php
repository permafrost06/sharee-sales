<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StockItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StockItemController extends Controller
{
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
