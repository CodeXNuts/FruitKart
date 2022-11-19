<div class="modal fade" id="addProdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add new oranges</h4>
                <button type="button" class="close closeAddModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('seller.product.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <img src="{{ asset('img/no-prod-img.png') }}"
                            alt="avatar" class="rounded-circle img-fluid form-control"
                            style="width: 65px;height: 65px;" id="previewAddProdImg">
                        <label>Image</label>
                        <input type="file" name="addProductImage" id="addProductImage" class="form-control">
                        @error('addProductImage')
                            <span style="color: red">{{ $message }}</span><br>
                        @enderror
                        <label>Name</label>
                        <input type="text" name="addProductName" class="form-control" placeholder="Orange Name">
                        @error('addProductName')
                            <span style="color: red">{{ $message }}</span><br>
                        @enderror
                        <label>Price (RS/KG)</label>
                        <input type="text" name="addProductPrice" class="form-control num" placeholder="price">
                        @error('addProductPrice')
                            <span style="color: red">{{ $message }}</span><br>
                        @enderror

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="addProdBtn">Add to bucket</button>
                <button type="button" class="btn btn-danger closeAddModal" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
