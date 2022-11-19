<?php

namespace App\Http\Controllers\Buyer\Auth;

use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:buyer');
    }

    public function index()
    {
        return view('buyer.auth.auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['string', 'max:255'],
            'email' => ['required', 'email', 'unique:sellers,email', 'max:255'],
            'username' => ['required', 'unique:buyers,username', 'max:255'],
            'password' => ['required', 'max:255', 'confirmed']
        ]);

        $res = [
            'key' => 'fail',
            'msg' => 'Registration failed. Please try again'
        ];

        try {
            $verifyToken = Str::uuid();

            $isBuyerCreated = Buyer::create([
                'name' => $request->name ?? '',
                'email' => $request->email ?? '',
                'username' => $request->username ?? '',
                'password' => Hash::make($request->password),
                'active' => true
            ]);

            if (!empty($isBuyerCreated->id)) {

                // $request->merge(['active'=>true]);

                $credentials = $request->except(['_token', 'username', 'name','password_confirmation']);
                
                if (auth('buyer')->attempt($credentials)) {
                    return redirect(RouteServiceProvider::BUYER);
                }

                return redirect()->back()->with('fail', 'Credentials not matced in our records!');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }

        return back()->with($res['key'], $res['msg']);
    }
}
