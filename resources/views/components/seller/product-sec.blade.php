<div class="container mt-5">

    <h3 style="display: inline-block">My Bucket</h3>
    <button type="button" style="display: inline-block;margin-left: 5px" class="btn btn-primary btn-sm"
        id="addProduct">Add</button>

    <div class="row mt-2">

        @if (!empty($products) && $products->count() > 0)
            @foreach ($products as $product)
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

                        <div class="d-flex justify-content-between install mt-3 editBtnDiv" style="cursor: pointer"
                            data-target="{{ route('seller.product.edit', ['product' => $product->id]) }}"><span
                                class="text-primary">Edit&nbsp;<i class="fa fa-angle-right"></i></span></div>
                    </div>
                </div>
            @endforeach

            {{ $products->links() }}

        @else
        <p>No oranges found</p>
        @endif
    </div>

</div>

