<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class HistoryController extends Controller
{
    //GET history for User orders(User side)
    public function showPurchaseHistory(Request $request){
        $name = Auth::user()->name;
        $id = Auth::user()->id;
        $history = History::where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->with(['review'])
            ->get();

        foreach($history as $h){
            $h->item = DB::table('products')->where('id' , $h->product_id)->firstOrFail();
        }
        return view('history')->with('history', $history);
    }
}
