<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function index()
    {
        return view('seller.auth.auth');
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        $request->merge(['active'=>true]);

        $credentials = $request->except(['_token']);
        
        if(auth('seller')->attempt($credentials))
        {
            return redirect(RouteServiceProvider::SELLER);
        }

        return redirect()->back()->with('fail','Credentials not matced in our records!');
    }

    public function destroy()
    {

        auth('seller')->logout();
        return redirect()->route('seller.login');
    }
}
