$(document).on('click', '.editProf', function () {
    $('.editProfDiv').removeClass('d-none');
    $('.profDiv').addClass('d-none');
});

$(document).on('click', '.editAvatar', function () {
    $('.sellerAvatar').trigger('click');
});

$(document).on('change', '.sellerAvatar', function () {
    var file = this.files.length;
    if (file > 0 && this.files[0] !== undefined && this.files[0] !== '') {
        $('.sellerAvatarPreview').attr('src', URL.createObjectURL(this.files[0]));
    }
})


$(document).on('click', '#addProduct', function () {

    $('#addProdModal').modal('show');
})

$(document).on('click', '.closeAddModal', function () {
    $('#addProdModal').modal('hide');
});
$(document).on('click', '.closeEditModal', function () {

    $('#editProdModal').modal('hide');
});



$(document).on('hidden.bs.modal', '#editProdModal', function () {
    $('#previewEditProdImg').attr('src', '');
    $('#editProductImage').val('');
    $('#editProductName').val('');
    $('#editProductPrice').val('');
    $('#editProdForm').attr('');
})



$(document).on("keypress", ".num", function (e) {
    var arr = [];
    var kk = e.which;

    for (i = 48; i < 58; i++) arr.push(i);

    arr.push(46); // to allow .
    if (!(arr.indexOf(kk) >= 0)) e.preventDefault();
});

$(document).on('change', '#addProductImage', function () {
    var file = this.files.length;
    if (file > 0 && this.files[0] !== undefined && this.files[0] !== '') {
        $('#previewAddProdImg').attr('src', URL.createObjectURL(this.files[0]));
    }
})
$(document).on('change', '#editProductImage', function () {
    var file = this.files.length;
    if (file > 0 && this.files[0] !== undefined && this.files[0] !== '') {
        $('#previewEditProdImg').attr('src', URL.createObjectURL(this.files[0]));
    }
})


$(document).on('click', '.editBtnDiv', function () {
    var target = $(this).attr('data-target');

    if (target !== undefined && target !== '') {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        $.ajax({
            type: "GET",
            url: target,
            data: {},
            dataType: "json",
            //contentType: false,
            //processData: false,
            beforeSend: function () {
                // $(".loader").fadeIn(100);
            },
            success: function (response) {
                if (
                    response.key !== "" &&
                    response.key !== undefined &&
                    response.key == "success" &&
                    response.data !== undefined &&
                    response.data !== ''

                ) {
                    $('#previewEditProdImg').attr('src', response.img ?? '');
                    $('#editProductName').val(response.data.name ?? '');
                    $('#editProductPrice').val((response.data.price !== undefined && response.data.price !== '') ? response.data.price.toFixed(2) : '');
                    $('#editProdForm').attr('action', response.upURI ?? '');
                    $('#editProdModal').modal('show');
                    Toast.fire({
                        icon: "success",
                        title:
                            response.msg ??
                            "Orange details has been fecthed successfully",
                    });


                } else {
                    Toast.fire({
                        icon: "error",
                        title:
                            response.msg ??
                            "Something went wrong try again",
                    });
                }
            },
            error: function (request, status, error) {
                responses = jQuery.parseJSON(request.responseText);

                if (responses.errors) {
                    var errorHtml = "<ul>";
                    $.each(responses.errors, function (key, value) {
                        errorHtml += "<li>" + value + "</li>";
                    });
                    errorHtml += "</ul>";

                    Toast.fire({
                        icon: "error",
                        title: errorHtml,
                    });
                }
            },
            complete: function () {
                // $(".loader").fadeOut(100);
            },
        });
    }
})