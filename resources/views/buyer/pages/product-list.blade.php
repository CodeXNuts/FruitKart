<x-seller.app-layout>
    <x-slot name="addOnCss">
        <link rel="stylesheet" href="{{ asset('buyer/css/seller-list.css') }}">
    </x-slot>
    <div class="container">
        <div class="main-body">

            <!-- Breadcrumb -->
            @include('layouts.buyer.nav-sec')
            <!-- /Breadcrumb -->

            <div class="container mt-5">
                <img src="{{ !empty($seller->avatar) && Storage::exists($seller->avatar) ? Storage::url($seller->avatar) : asset('img/avatar.png') }}" style="width:50px;" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                <h3 style="display: inline-block">{{ $data->name ?? '--' }}</h3>
                <a type="button" href="{{ route('buyer.home') }}" style="display: inline-block;margin-left: 5px" class="btn btn-primary btn-sm"
                    id="addProduct">back</a>

                <p>{{ $data->desc ?? '--' }}</p>
            
                <div class="row mt-2">
            
                    @if (!empty($data->products) && $data->products->count() > 0)
                        @foreach ($data->products as $product)
                            <div class="col-md-4 mt-2 mb-2">
                                <div class="card p-3">
                                    <div class="d-flex flex-row mb-3">
                                        <img src="{{ !empty($product->image_path) && Storage::exists($product->image_path) ? Storage::url($product->image_path) : asset('img/no-prod-img.png') }}"
                                            width="50" height="50" class="">
                                        <div class="d-flex flex-column ml-2"><span>{{ $product->name ?? '' }}</span><span
                                                class="text-black-50">Price:
                                                <b>{{ !empty($product->price) && is_numeric($product->price) ? number_format($product->price, 2) : 0.0 }}</b>
                                                rs/kg</span><span class="ratings"><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                    class="fa fa-star"></i></span></div>
                                    </div>
            
                                  
                                </div>
                            </div>
                        @endforeach
            
                    @else
                    <p>No oranges found</p>
                    @endif
                </div>
            
            </div>

        </div>
    </div>
    <x-slot name="addOnJs"></x-slot>
</x-seller.app-layout>
