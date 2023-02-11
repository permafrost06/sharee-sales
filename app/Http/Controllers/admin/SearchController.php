<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchQuestion(Request $request){
        $search = $request->query('search', 0);
        $question = DB::table('questions')->where('question','LIKE', '%'.$search.'%')->get();

        return response()->json(['question'=>$question]);
    }
}
