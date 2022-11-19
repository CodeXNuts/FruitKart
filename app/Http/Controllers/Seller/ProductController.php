<?php

namespace App\Http\Controllers\Seller;

use App\Helper\Media;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use Media;
    public function __construct()
    {
        $this->middleware('auth:seller');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'addProductName' => ['required', 'string', 'max:255'],
            'addProductImage' => ['nullable', 'mimetypes:image/bmp,image/gif,image/png,image/jpeg,image/jpg,image/JPG,image/webp', 'max:5048'],
            'addProductPrice' => ['required', 'numeric']
        ]);
        
        $response = [
            'key' => 'fail',
            'message' => 'Cannot add orange to your bucket.'
        ];
        try {

            if ($request->hasFile('addProductImage') && ($request->file('addProductImage') instanceof UploadedFile)) {
                $fileData = $this->uploads($request->file('addProductImage'), 'seller/product/');
            }
           
            $addedProduct = Product::create([
                'name' => ($request->addProductName ?? ''),
                'image_path' => ($fileData['filePath'] ?? null),
                'price' => floatval($request->addProductPrice),
                'seller_id' => auth('seller')->id(),
                'active' => true
            ]);

            if (!empty($addedProduct->id)) {
                $response = [
                    'key' => 'success',
                    'message' => 'Orange has been added to your bucket'
                ];
            } else {
                $response = [
                    'key' => 'fail',
                    'message' => 'Cannot add orange to your bucket.'
                ];
            }
        } catch (Exception $e) {
           // dd($e->getMessage());
            $response = [
                'key' => 'fail',
                'message' => 'Cannot add orange to your bucket.'
            ];
        }

        return redirect()->route('seller.profile.view')->with($response['key'], $response['message']);
    }

    public function edit(Product $product)
    {
        $response = [
            'key' => 'fail',
            'msg' => 'Details cannot be fetched'
        ];

        if(!empty($product->id))
        {
            $response = [
                'key' => 'success',
                'msg' => 'Details fetched',
                'data' => $product,
                'img' => (!empty($product->image_path) && Storage::exists($product->image_path)) ? Storage::url($product->image_path) : asset('img/no-prod-img.png'),
                'upURI' => route('seller.product.update',['product'=>$product->id])
            ];
        }

        return $response;
    }


    public function update(Product $product, Request $request)
    {

        $this->validate($request, [
            'editProductName' => ['required', 'string', 'max:255'],
            'editProductImage' => ['nullable', 'mimetypes:image/bmp,image/gif,image/png,image/jpeg,image/jpg,image/JPG,image/webp', 'max:5048'],
            'editProductPrice' => ['required', 'numeric']
        ]);

        $response = [
            'key' => 'fail',
            'message' => 'Orange cannot be updated.'
        ];

        try {
            $product->name = $request->editProductName;
            $product->price = floatval($request->editProductPrice);

            if ($request->hasFile('editProductImage') && ($request->file('editProductImage') instanceof UploadedFile)) {
                $fileData = $this->uploads($request->file('editProductImage'), 'seller/product/');

                if ((!empty($product->image_path)) && Storage::exists($product->image_path)) {
                    Storage::delete($product->image_path);
                }
                $product->image_path = $fileData['filePath'] ?? null;
            }

            $isUpdated = $product->save();

            if ($isUpdated) {
                $response = [
                    'key' => 'success',
                    'message' => 'Orange has been updated successfully!!'
                ];
            } else {
                $response = [
                    'key' => 'fail',
                    'message' => 'Orange could not be updated'
                ];
            }

        } catch (Exception $e) {
            //throw $th;
            $response = [
                'key' => 'fail',
                'message' => 'Orange cannot be updated.'
            ];
        }

        return redirect()->route('seller.profile.view')->with($response['key'], $response['message']);
    }
}
