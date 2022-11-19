<x-seller.app-layout>
    <x-slot name="addOnCss"></x-slot>
    <form style="display: none" action="{{ route('seller.logout') }}" method="POST" id="logoutForm">
        @csrf
    </form>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    style="{{ request()->routeIs('seller.profile.view') ? 'text-decoration:none;color:#6c757d!important' : '' }}"
                                    href="{{ route('seller.profile.view') }}">Profile</a></li>
                               
                            <li class="breadcrumb-item" onclick="document.getElementById('logoutForm').submit();"><a href="javascript:void(0)">Log out</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center profDiv">
                            <img src="{{ !empty(auth('seller')->user()->avatar) && Storage::exists(auth('seller')->user()->avatar) ? Storage::url(auth('seller')->user()->avatar) : asset('img/avatar.png') }}"
                                alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3">{{ auth('seller')->user()->name ?? '---' }}</h5>
                            <p class="text-muted mb-1" style="color: rgb(63, 177, 63) !important">Seller</p>
                            <p class="text-muted mb-4">{{ auth('seller')->user()->desc ?? 'No description added' }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-primary editProf">Edit</button>
                                {{-- <button type="button" class="btn btn-outline-primary ms-1">Message</button> --}}
                            </div>
                        </div>
                        <div class="card-body text-center d-none editProfDiv">
                            <form action="{{ route('seller.profile.update', ['seller' => auth('seller')->id()]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="avatar" class="sellerAvatar" style="display: none">
                                <div style="display: inline-block;cursor: pointer;" class="editAvatar">

                                    <img src="{{ !empty(auth('seller')->user()->avatar) && Storage::exists(auth('seller')->user()->avatar) ? Storage::url(auth('seller')->user()->avatar) : asset('img/avatar.png') }}"
                                        alt="avatar" class="rounded-circle img-fluid sellerAvatarPreview"
                                        style="width: 150px;">

                                    <img src="{{ asset('img/edit-avatar.png') }}"
                                        alt="avatar" class="rounded-circle img-fluid " style="width: 12px;">
                                </div>
                                @error('avatar')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                <input type="text" name="name" value="{{ auth('seller')->user()->name ?? '---' }}"
                                    class="my-3 form-control">
                                @error('name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                                <textarea name="desc" class="form-control" cols="30" rows="3" placeholder="Add some description">{{ auth('seller')->user()->desc ?? '' }}</textarea>
                                <div class="d-flex justify-content-center mb-2 mt-2">
                                    <button type="submit" class="btn btn-primary ">Save</button>
                                    {{-- <button type="button" class="btn btn-outline-primary ms-1">Message</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ auth('seller')->user()->name ?? '---' }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{ auth('seller')->user()->email ?? '---' }}</p>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <x-seller.product-sec/>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <x-seller.add-sec/>
    <x-seller.edit-sec/>
    <x-slot name="addOnJs">
        <script src="{{ asset('seller/js/profile.js') }}"></script>
        @if ($errors->has('name') || $errors->has('avatar') || $errors->has('desc'))
            <script>
                $('.editProf').trigger('click')
            </script>
        @endif
        @if ($errors->has('addProductImage') || $errors->has('addProductName') || $errors->has('addProductPrice'))
            <script>
                $(function () {
                  $('#addProduct').trigger('click')
                });
            </script>
        @endif
    </x-slot>
</x-seller.app-layout>
