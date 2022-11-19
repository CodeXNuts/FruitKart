<?php

namespace App\View\Components\buyer;

use App\Models\Seller;
use Illuminate\View\Component;

class SellerListSec extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $sellers = Seller::withCount(['products'=>function($query){
            $query->where(['active'=>true]);
        }])->where('active',true)->get();

        return view('components.buyer.seller-list-sec',['sellers'=>$sellers]);
    }
}
