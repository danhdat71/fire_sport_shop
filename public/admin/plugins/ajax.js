// -------------------------- Slider area --------------------------

/**
 * Upload slider
 * **/
$('#upload-slider').click(function(){
    $(this).prop('disabled', true);
    var formData = new FormData($('#form-slider-upload')[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);
                $('.progress-bar').css({
                    'width' : percentComplete + "%"
                }).text(percentComplete + "%");
              }
            }, false);

            return xhr;
        },
        url: baseUrl + '/slider',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: 'post',
        success: function (res) {
            let data = res.message;
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                for(var property in data) {
                    let validateMsg = data[property];
                    console.log(validateMsg);
                    $('.validate-msg').text("");
                    $('#form-slider-upload .' + property).text(validateMsg);
                }
                $('#upload-slider').prop('disabled', false);
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Lưu thành công ! Đang chuẩn bị refresh...',
                    showConfirmButton: false,
                    timer: 1500
                });
                let timeOut = setTimeout(function(){
                    $('#add').modal('hide');
                    location.reload();
                },3000);
            }
        }
    });
});

/**
 * Delete slider
 * **/
$('.delete-slider').click(function(){
    var result = confirm("Xác nhận xóa?");
    if (result) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': _token
            },
            type: "delete",
            url: "/slider/" + $(this).attr('data-id'),
            success: function (res) {
                location.reload();
            }
        });
    }
});

/**
 * Get data slider
 * **/
$('.edit').click(function(){
    $.ajax({
        type: "get",
        url: "/slider/" + $(this).attr('data-id'),
        dataType: "json",
        success: function (res) {
            console.log(res);
            let sliderPath = baseUrl + '/image/sliders/' + res.big_image;
            console.log(sliderPath);
            $('#edit').find('.url').val(res.url);
            $('#edit').find('.preview-image').css({'opacity' : '1'}).attr('src', sliderPath);
            $('#edit #slider-id').val(res.id);
            $('#edit').find('.status').val(res.status);
        }
    });
});

/**
 * Update slider data
 * **/
$('#update-slider').click(function(){
    $(this).prop('disabled', true);
    let formData = new FormData($("#form-slider-update")[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);

                $('.progress-bar').css({
                    'width' : percentComplete + "%"
                }).text(percentComplete + "%");
              }
            }, false);

            return xhr;
        },
        method : "post",
        url: "/slider/update",
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            let data = res.message;
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                for(var property in data) {
                    let validateMsg = data[property];
                    $('.validate-msg').text("");
                    $('#form-slider-update .' + property).text(validateMsg);
                }
                $("#update-slider").prop('disabled', false);
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Lưu thành công ! Đang chuẩn bị refresh...',
                    showConfirmButton: false,
                    timer: 1500
                });
                let timeOut = setTimeout(function(){
                    $('#add').modal('hide');
                    location.reload();
                },3000);
            }
        }
    });
});

/**
 * Upload slider status
 * **/
$('.slider-status').on('switchChange.bootstrapSwitch', function (e) {
    let data = {
        id : $(this).attr('data-id'),
        status : ($(this).bootstrapSwitch('state')) ? 1 : 0
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "post",
        url: "/slider/status/update",
        data: {...data},
        dataType: "json",
        success: function (res) {
            console.log(res);
        }
    });
});



// -------------------------- Product category area --------------------------

/**
 * Upload product category
 * **/
$('#upload-product-category').click(function(){
    $(this).prop('disabled', true);
    var formData = new FormData($('#form-product-category-upload')[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);

                $('.progress-bar').css({
                    'width' : percentComplete + "%"
                }).text(percentComplete + "%");
              }
            }, false);

            return xhr;
        },
        url: baseUrl + '/product-category',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: 'post',
        success: function (res) {
            let data = res.message;
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                for(var property in data) {
                    let validateMsg = data[property];
                    $('.validate-msg').text("");
                    $('#form-product-category-upload .' + property).text(validateMsg);
                }
                $("#upload-product-category").prop('disabled', false);
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Lưu thành công ! Đang chuẩn bị refresh...',
                    showConfirmButton: false,
                    timer: 1500
                });
                let timeOut = setTimeout(function(){
                    $('#add').modal('hide');
                    location.reload();
                },3000);
            }
        }
    });
});

/**
 * Get data product category
 * **/
 $('.edit-product-category').click(function(){
    $.ajax({
        type: "get",
        url: "/product-category/" + $(this).attr('data-id'),
        dataType: "json",
        success: function (res) {
            console.log(res);
            let productCategoryLinkImage = baseUrl + '/image/productCategories/' + res.big_image;
            console.log(productCategoryLinkImage);
            $('#edit').find('.name').val(res.name);
            $('#edit').find('.url-genegrate').val(res.url);
            $('#edit').find('.preview-image').css({'opacity' : '1'}).attr('src', productCategoryLinkImage);
            $('#edit #product-category-id').val(res.id);
            $('#edit').find('.status').val(res.status);
        }
    });
});

/**
 * Update product category
 * **/
 $('#update-product-category').click(function(){
    let formData = new FormData($("#form-product-category-update")[0]);
    $('#update-product-category').prop('disabled', true);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);

                $('.progress-bar').css({
                    'width' : percentComplete + "%"
                }).text(percentComplete + "%");
              }
            }, false);

            return xhr;
        },
        method : "post",
        url: "/product-category/update",
        data: formData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        success: function (res) {
            let data = res.message;
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                for(var property in data) {
                    let validateMsg = data[property];
                    $('.validate-msg').text("");
                    $('#form-slider-update .' + property).text(validateMsg);
                }
                $('#update-product-category').prop('disabled', false);
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Lưu thành công ! Đang chuẩn bị refresh...',
                    showConfirmButton: false,
                    timer: 1500
                });
                let timeOut = setTimeout(function(){
                    $('#add').modal('hide');
                    location.reload();
                },3000);
            }
        }
    });
});

/**
 * Upload status
 * **/
 $('.product-category-status').on('switchChange.bootstrapSwitch', function (e) {
    let data = {
        id : $(this).attr('data-id'),
        status : ($(this).bootstrapSwitch('state')) ? 1 : 0
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "post",
        url: "/product-category/status/update",
        data: {...data},
        dataType: "json",
        success: function (res) {
            console.log(res);
        }
    });
});

/**
 * Delete product category
 * **/
 $('.delete-product-category').click(function(){
    var result = confirm("Xác nhận xóa?");
    if (result) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': _token
            },
            type: "delete",
            url: "/product-category/" + $(this).attr('data-id'),
            success: function (res) {
                location.reload();
            }
        });
    }
});



// -------------------------- Product area --------------------------
/**
 * Upload product
 * **/
$('#upload-product').click(function(){
    $(this).prop('disabled', true);
    $('#form-product-upload p.validate-msg').text("");
    var formData = new FormData($('#form-product-upload')[0]);
    formData.append('long_desc', CKEDITOR.instances['ckeditor_1'].getData());
    formData.append('colors', $(".tag-input").tagsinput('items'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);

                $('.progress-bar').css({
                    'width' : percentComplete + "%"
                }).text(percentComplete + "%");
              }
            }, false);

            return xhr;
        },
        url: baseUrl + '/product',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: 'post',
        success: function (res) {
            let data = res.message;
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                for(var property in data) {
                    let validateMsg = data[property];
                    $('#form-product-upload p.validate-msg.' + property).text(validateMsg);
                }
                $('#upload-product').prop('disabled', false);
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Lưu thành công ! Đang chuẩn bị refresh...',
                    showConfirmButton: false,
                    timer: 1500
                });
                let timeOut = setTimeout(function(){
                    $('#add').modal('hide');
                    location.reload();
                },3000);
            }
        }
    });
});

/**
 * Get data product
 * **/
 $('.edit-product').click(function(){
    $.ajax({
        type: "get",
        url: "/product/" + $(this).attr('data-id'),
        dataType: "json",
        success: function (res) {
            console.log(res);
            // Set status
            $('#status').val(res.status);
            // Set id
            $('#id').val(res.id);
            // Set name
            $('#name').val(res.name);
            // Url
            $('#url').val(res.url);
            // From
            $('#from').val(res.from);
            // price_root
            $('#price_root').val(res.price_root);
            //price_sale
            $('#price_sale').val(res.price_sale);
            //short_desc
            $('#short_desc').val(res.short_desc);
            //category_id
            $('#category_id').val(res.category_id);
            //ckeditor_1
            CKEDITOR.instances['ckeditor_2'].setData(res.long_desc);
            // Set image
            $('#preview-image-1').attr('src', "");
            $('#preview-image-2').attr('src', "");
            let imageOne = baseUrl + '/image/products/' + res.image_1;
            $('#preview-image-1').css({'opacity' : '1'}).attr('src', imageOne);
            if(res.image_2 != null){
                let imageTwo = baseUrl + '/image/products/' + res.image_2;
                $('#preview-image-2').css({'opacity' : '1'}).attr('src', imageTwo)
            }
            if(res.image_2 == null){
                $('#preview-image-2').css({'opacity' : '0'})
            }
            // Set sizes view
            $('#sizes option').prop('selected', false);
            res.sizes.forEach(element => {
                $('#sizes option.' + element.pivot.size_id).prop('selected', true);
                console.log(element.pivot.size_id);
            });
            // Set color view
            $('#colors').tagsinput('removeAll');
            res.colors.forEach(element => {
                $('#colors').tagsinput('add', element.color_code);
            });
        }
    });
});

/**
 * Update product
 * **/
$('#update-product').click(function(){
    $(this).prop('disabled', true);
    $('#form-product-update p.validate-msg').text("");
    var formData = new FormData($('#form-product-update')[0]);
    formData.append('long_desc', CKEDITOR.instances['ckeditor_2'].getData());
    formData.append('colors', $(".tag-input").tagsinput('items'));
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);

                $('.progress-bar').css({
                    'width' : percentComplete + "%"
                }).text(percentComplete + "%");
              }
            }, false);

            return xhr;
        },
        url: baseUrl + '/product/update',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: 'post',
        success: function (res) {
            let data = res.message;
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                for(var property in data) {
                    let validateMsg = data[property];
                    $('#form-product-upload p.validate-msg.' + property).text(validateMsg);
                }
                $('#upload-product').prop('disabled', false);
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Lưu thành công ! Đang chuẩn bị refresh...',
                    showConfirmButton: false,
                    timer: 1500
                });
                let timeOut = setTimeout(function(){
                    $('#add').modal('hide');
                    location.reload();
                },3000);
            }
        }
    });
});

/**
 * Upload status
 * **/
 $('.product-status').on('switchChange.bootstrapSwitch', function (e) {
    let data = {
        id : $(this).attr('data-id'),
        status : ($(this).bootstrapSwitch('state')) ? 1 : 0
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "post",
        url: "/product/status/update",
        data: {...data},
        dataType: "json",
        success: function (res) {
            console.log(res);
        }
    });
});

/**
 * Delete product
 * **/
 $('.delete-product').click(function(){
    var result = confirm("Xác nhận xóa?");
    if (result) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': _token
            },
            type: "delete",
            url: "/product/" + $(this).attr('data-id'),
            success: function (res) {
                location.reload();
            }
        });
    }
});

// ------------------- Product Image --------------------
/**
 * Upload product image
 * **/
$('#upload-product-image').click(function(e){
    e.preventDefault();
    $(this).prop('disabled', true);
    var formData = new FormData($('#form-upload-product-image')[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(evt) {
              if (evt.lengthComputable) {
                var percentComplete = evt.loaded / evt.total;
                percentComplete = parseInt(percentComplete * 100);
                $('.percen-upload-product-image').text(percentComplete + "%");
              }
            }, false);

            return xhr;
        },
        url: baseUrl + '/product-images',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: 'post',
        success: function (res) {
            let validate = res.message;
            let validateMsg = `<p class="text-danger p-0 m-0">`;
            if(validate !== undefined){
                for(var property in validate) {
                    validateMsg += validate[property] + "</br>";
                }
                validateMsg += "</p>";
                Swal.fire({
                    position: 'top',
                    icon: 'fail',
                    html: validateMsg,
                    timer: 999999,
                    width: 800,
                    showConfirmButton: true,
                });
            }else{
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Lưu thành công ! Đang chuẩn bị refresh...',
                    showConfirmButton: false,
                    timer: 1500
                });
                let timeOut = setTimeout(function(){
                    $('#add').modal('hide');
                    location.reload();
                },3000);
            }
        }
    });
});

/**
 * Delete product image
 * **/

/**
 * Delete product category
 * **/
 $('.delete-product-image').click(function(){
    let result = true;
    let _this = $(this);
    if (result) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': _token
            },
            type: "delete",
            url: "/product-images/" + $(this).attr('data-id'),
            success: function (res) {
                _this.closest('.item').remove();
            }
        });
    }
});