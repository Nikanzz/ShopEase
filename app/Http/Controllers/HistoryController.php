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
            $h->item = $h->product_name;
        }
        return view('history')->with('history', $history);
    }

    //GET manage current orders in Seller side

    //TODO: GET history for Seller's orders(Seller side)
    public function showSellHistory(Request $request){}
}
