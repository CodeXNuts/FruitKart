<?php

namespace App\Http\Controllers\Buyer\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   

    public function index()
    {
        return view('buyer.auth.auth');
    }

    public function create(Request $request)
    {
        $this->validate($request,[
            'email'=>['required','email'],
            'password'=>['required']
        ]);

        // $request->merge(['active'=>true]);

        $credentials = $request->except(['_token']);
        
        if(auth('buyer')->attempt($credentials))
        {
            return redirect(RouteServiceProvider::BUYER);
        }

        return redirect()->back()->with('fail','Credentials not matced in our records!');
    }

    public function destroy()
    {

        auth('buyer')->logout();
        return redirect()->route('buyer.login');
    }
}
