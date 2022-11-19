<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Events\Seller\Registered;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:seller');
    }

    public function index()
    {
        return view('seller.auth.auth');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['string', 'max:255'],
            'email' => ['required', 'email', 'unique:sellers,email', 'max:255'],
            'username' => ['required', 'unique:sellers,username', 'max:255'],
            'password' => ['required', 'max:255', 'confirmed']
        ]);

        $res = [
            'key' => 'fail',
            'msg' => 'Registration failed. Please try again'
        ];

        try {
            $verifyToken = Str::uuid();

            $isSellerCreated = Seller::create([
                'name' => $request->name ?? '',
                'email' => $request->email ?? '',
                'username' => $request->username ?? '',
                'password' => Hash::make($request->password),
                'verify_token' => Hash::make($verifyToken),
                'active' => false
            ]);

            if (!empty($isSellerCreated->id)) {
                $payload = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'token' => base64_encode($request->email . '|' . $verifyToken)
                ];

                event(new Registered($payload));

                $res = [
                    'key' => 'success',
                    'msg' => '<p>You have been registered successfully. An verification email has been sent to <b>' . $request->email . '</b></p> <address>(**Do not forget to check spam/promotion)</address>',
                ];
            }
        } catch (Exception $e) {
            // dd($e->getMessage());
        }


        return redirect()->route('seller.register')->with($res['key'], $res['msg']);
    }

    public function verifyEmail(Request $request)
    {
        $this->validate($request, ['token' => ['required']]);

        try {
            if (!empty($request->token) && (!empty(base64_decode($request->token)))) {
                $req = base64_decode($request->token);
    
                if (!empty($req)) {
                    $req = explode('|', $req);
                    $email = $req[0] ?? '';
                    $token = $req[1] ?? '';
    
                    if (!empty($email) && !empty($token)) {
    
                        $thisSeller = Seller::select(['id','verify_token','active'])->where(['email' => $email])->first();
    
                        if (!empty($thisSeller->verify_token) && Hash::check($token, $thisSeller->verify_token)) {
                            $thisSeller->active = true;
                            $isSellerUpdated = $thisSeller->save();
                            
                            if(!empty($isSellerUpdated))
                            {
                                return redirect()->route('seller.login')->with('success', 'You email has been verified. You can Log in now');
                            }
                            else
                            {
                                return redirect()->route('seller.login')->with('fail', 'You email could not be verified');
                            }
                           
                        } else {
                            throw new ModelNotFoundException();
                        }
                    } else {
                        throw new ModelNotFoundException();
                    }
                } else {
                    throw new ModelNotFoundException();
                }
            }
        } catch (Exception $e) {
            throw new ModelNotFoundException();
        }
    }
}
