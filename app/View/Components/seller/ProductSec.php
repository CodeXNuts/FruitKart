<?php

namespace App\View\Components\seller;

use App\Models\Product;
use Illuminate\View\Component;

class ProductSec extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $products = Product::select(['id','name','image_path','price'])->where(['seller_id'=>auth('seller')->id(),'active'=>true])->orderBy('created_at','desc')->paginate(6);
        
        return view('components.seller.product-sec',['products'=>$products]);
    }
}
