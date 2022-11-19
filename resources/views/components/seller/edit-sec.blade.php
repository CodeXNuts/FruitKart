<div class="modal fade" id="editProdModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Edit oranges</h4>
                <button type="button" class="close closeEditModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="editProdForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <img src="{{ asset('img/no-prod-img.png') }}"
                            alt="avatar" class="rounded-circle img-fluid form-control"
                            style="width: 65px;height: 65px;" id="previewEditProdImg">
                        <label>Image</label>
                        <input type="file" name="editProductImage" id="editProductImage" class="form-control">
                        @error('editProductImage')
                            <span style="color: red">{{ $message }}</span><br>
                        @enderror
                        <label>Name</label>
                        <input type="text" id="editProductName" name="editProductName" class="form-control" placeholder="Orange Name">
                        @error('editProductName')
                            <span style="color: red">{{ $message }}</span><br>
                        @enderror
                        <label>Price (RS/KG)</label>
                        <input type="text" id="editProductPrice" name="editProductPrice" class="form-control num" placeholder="price">
                        @error('editProductPrice')
                            <span style="color: red">{{ $message }}</span><br>
                        @enderror

                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" id="addProdBtn">Save</button>
                <button type="button" class="btn btn-danger closeEditModal" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

</div>
