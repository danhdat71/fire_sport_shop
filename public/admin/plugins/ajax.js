// -------------------------- Slider area --------------------------

/**
 * Upload slider
 * **/
$('#upload-slider').click(function(){
    $(this).prop('disabled', 'disabled');
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
            let data = res.data;
            console.log(data);
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                let validate = data.message;
                for(var property in validate) {
                    let validateMsg = validate[property];
                    $('.validate-msg').text("");
                    $('#form-slider-upload .' + property).text(validateMsg);
                }
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
            let data = res.data;
            console.log(data);
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                let validate = data.message;
                for(var property in validate) {
                    let validateMsg = validate[property];
                    $('.validate-msg').text("");
                    $('#form-slider-update .' + property).text(validateMsg);
                }
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
    $(this).prop('disabled', 'disabled');
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
            let data = res.data;
            console.log(data);
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                let validate = data.message;
                for(var property in validate) {
                    let validateMsg = validate[property];
                    $('.validate-msg').text("");
                    $('#form-product-category-upload .' + property).text(validateMsg);
                }
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
            let data = res.data;
            console.log(data);
            if(data !== undefined){
                $('.progress-bar').css({
                    'width' : "0"
                }).text("0%");
                let validate = data.message;
                for(var property in validate) {
                    let validateMsg = validate[property];
                    $('.validate-msg').text("");
                    $('#form-slider-update .' + property).text(validateMsg);
                }
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