<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 gutters-sm">
    
    @if (!empty($sellers) && ($sellers->count()>0))
        @foreach ($sellers as $seller)
        <div class="col mb-3">
            <div class="card">
              <img src="https://via.placeholder.com/340x120/FFB6C1/000000" alt="Cover" class="card-img-top">
              <div class="card-body text-center">
                <img src="{{ !empty($seller->avatar) && Storage::exists($seller->avatar) ? Storage::url($seller->avatar) : Storage::url('seller/avatar/avatar.png') }}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                <h5 class="card-title">{{ $seller->name ?? '---' }}</h5>
                <p class="text-secondary mb-1" style="color: green !important">Orange Seller</p>
                <p class="text-secondary mb-1" >{{ isset($seller->products_count) ? $seller->products_count.' '.Str::plural('Orange', $seller->products_count) : '0 Orange' }}</p>
                <p class="text-muted font-size-sm">{{ $seller->desc ?? '---' }}</p>
              </div>
              <div class="card-footer">
                <a href="{{ route('buyer.viewOrangeChart',['seller'=>$seller->username]) }}" class="btn btn-light btn-sm bg-white has-icon btn-block" >View Rate Chart</a>
              </div>
            </div>
          </div>
        @endforeach
    @endif
    
  </div>