<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $user = auth()->user();
        
        return view('profile', compact('user'));
    }

    public function showEditProfileForm()
    {
        $user = auth()->user();
        
        return view('components.profile.edit', compact('user'));
    }

    public function showTopup(){
        $user = auth()->user();
        
        return view('topup');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'username' => 'required|string|max:255|unique:users,username,' . auth()->id(),
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:20480', 
        ]);

        $user = auth()->user();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->username = $validated['username'];
        $user->phone = $validated['phone'];
        $user->address= $validated['address'];

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $user->profile_picture = $profilePicturePath;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function deleteProfile(Request $request)
    {
        $user = Auth::user();
        $seller = DB::table('sellers')->where('user_id' , $user->id);
        if($seller->exists()){
            $sid = $seller->first()->id;
            $products = DB::table('products')->where('seller_id' , $sid);
            $arrP = $products->get()->toArray();
            foreach ($arrP as $p){
                DB::table('histories')->where('product_id' , $p->id)->update(['product_id' => 1]);
                DB::table('products')->where('id' , $p->id)->delete();
            }
            $seller->delete();
        }

        DB::table('histories')->where('user_id' , $user->id)->update(['user_id' => 1]);
        $request->session()->invalidate();
        $user->delete();
        Log::info('Deleted');

        return redirect('/login')->with('success', 'Profile deleted successfully.');
    }

    public function processTopup(Request $request){
        $validated = $request->validate([
            'amount' => 'required|min:0'
        ]);

        if ($validated['amount'] >= 50000000) {
            return redirect()->back()->withErrors(['amount' => 'Top-up amount must be less than Rp.50,000,000.']);
        }

        $user = auth()->user();
        $user->balance = $user->balance+$validated['amount'];
        $user->save();
        return redirect('/dashboard');
    }
}
