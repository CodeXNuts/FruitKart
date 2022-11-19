<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:buyer');
    }

    public function index()
    {
        return view('buyer.pages.home');
    }

    public function getOrangeBySeller(Seller $seller)
    {
        if(!empty($seller->id))
        {
           $data =  Seller::with(['products'=>function($query){
                $query->where(['active'=>true]);
            }])->where(['active'=>true])->find($seller->id);

            return view('buyer.pages.product-list',['data'=>$data]);

        }
    }
}
