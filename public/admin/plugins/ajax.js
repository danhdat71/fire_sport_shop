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

// ------------------- Blog --------------------
/**
 * Upload blog
 * **/
 $('#upload-blog').click(function(){
    $(this).prop('disabled', true);
    $('#form-blog-upload p.validate-msg').text("");
    var formData = new FormData($('#form-blog-upload')[0]);
    formData.append('long_desc', CKEDITOR.instances['ckeditor_1'].getData());
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
        url: baseUrl + '/blog',
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
                    $('#form-blog-upload p.validate-msg.' + property).text(validateMsg);
                }
                $('#upload-blog').prop('disabled', false);
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
 * Get data blog
 * **/
 $('.edit-blog').click(function(){
    $.ajax({
        type: "get",
        url: "/blog/" + $(this).attr('data-id'),
        dataType: "json",
        success: function (res) {
            $('#id').val(res.id);
            $('#name').val(res.name);
            $('#url').val(res.url);
            $('#short_desc').val(res.short_desc);
            CKEDITOR.instances['ckeditor_2'].setData(res.long_desc);
            // Set image
            $('#preview-image-1').attr('src', "");
            let imageOne = baseUrl + '/image/blogs/' + res.big_image;
            $('#big_image').css({'opacity' : '1'}).attr('src', imageOne);
            
        }
    });
});

/**
 * Update blog
 * **/
 $('#update-blog').click(function(){
    //$(this).prop('disabled', true);
    $('#form-blog-upload p.validate-msg').text("");
    var formData = new FormData($('#form-blog-update')[0]);
    formData.append('long_desc', CKEDITOR.instances['ckeditor_2'].getData());
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
        url: baseUrl + '/blog/update',
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
                    $('#form-blog-update p.validate-msg.' + property).text(validateMsg);
                }
                $('#upload-blog').prop('disabled', false);
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
$('.blog-status').on('switchChange.bootstrapSwitch', function (e) {
    let data = {
        id : $(this).attr('data-id'),
        status : ($(this).bootstrapSwitch('state')) ? 1 : 0
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "post",
        url: "/blog/status/update",
        data: {...data},
        dataType: "json",
        success: function (res) {
            console.log(res);
        }
    });
});

/**
 * Upload special
 * **/
$('.blog-special').on('switchChange.bootstrapSwitch', function (e) {
    let data = {
        id : $(this).attr('data-id'),
        status : ($(this).bootstrapSwitch('state')) ? 1 : 0
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "post",
        url: "/blog/special/update",
        data: {...data},
        dataType: "json",
        success: function (res) {
            console.log(res);
        }
    });
});

/**
 * Delete
 * **/
 $('.delete-blog').click(function(){
    var result = confirm("Xác nhận xóa?");
    if (result) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': _token
            },
            type: "delete",
            url: "/blog/" + $(this).attr('data-id'),
            success: function (res) {
                location.reload();
            }
        });
    }
});

// ------------------- Template --------------------
/**
 * Update template
 * **/
$('.template-content').on('change', function(){
    let data = {
        id : $(this).attr('data-id'),
        html : $(this).val()
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "post",
        url: "/template/update",
        data: {...data},
        dataType: "json",
        success: function (res) {
            res ? alert("Update thành công !") : false;
        }
    });
});


// ------------------- User --------------------
$('#invite-admin').click(function(e){
    e.preventDefault();
    let _this = $(this);
    _this.prop('disabled', true);
    let data = {
        email : $('#form-invite-admin #email').val()
    }
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "post",
        url: "/invite-admin",
        data: {...data},
        dataType: "json",
        success: function (res) {
            if(res){
                $('#add').modal('toggle');
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Mời thành công !',
                    showConfirmButton: false,
                    timer: 1500
                });
                _this.prop('disabled', false);
                $('#form-invite-admin #email').val("");
            }else{
                alert("HTTP_INTERNAL_SERVER_ERROR !");
            }
        }
    });
});

// ------------------- Auth Module --------------------

// Sign up admin
$('#sign-up').click(function(e){
    let signUpBtn = $(this);
    e.preventDefault();
    $(this).prop('disabled', true);
    $('#form-sign-up p.validate').text("");
    var formData = new FormData($('#form-sign-up')[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('#_token').val()
        },
        url: '/submit-sign-in',
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: formData,
        type: 'post',
        success: function (res) {
            let data = res.message;
            if(data !== undefined){
                for(var property in data) {
                    let validateMsg = data[property];
                    $('#form-sign-up p.validate.' + property).text(validateMsg);
                }
                signUpBtn.prop('disabled', false);
            }else{
                signUpBtn.css({
                    'background-color':'green',
                }).text('Thành công !');
                location.href = '/slider';
            }
        }
    });
});

$('.change-order-status').change(function (e) { 
    e.preventDefault();
    let id = $(this).attr('data-id');
    let status = $(this).val();
    $(this)
        .removeClass('border-warning')
        .removeClass('border-danger')
        .removeClass('border-success');
    if(status == 0) $(this).addClass('border-warning');
    else if(status == 1) $(this).addClass('border-success');
    else if(status == 2) $(this).addClass('border-danger').attr('disabled', 'true');

    let data = {
        id: id,
        status: status
    }

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "post",
        url: "/order/status/update",
        data: {...data},
        dataType: "json",
        success: function (res) {
            console.log(res);
        }
    });
});

$('.show-detail-order').click(function(){
    let id = $(this).attr('data-id');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': _token
        },
        type: "get",
        url: `/order/${id}/detail`,
        dataType: "json",
        success: function (res) {
            let products = res.data.products;
            let detailOrder = ``;
            let totalBill = 0;
            products.forEach(function(element){
                totalBill+= element.pivot.price_sale * element.pivot.amount;
                detailOrder+=`<tr>`;
                detailOrder+=`<td style="vertical-align:middle;">${element.name}</td>`;
                detailOrder+=`<td style="vertical-align:middle;"><img style="width: 100px;" src="./image/products/${element.image_1}" /></td>`;
                detailOrder+=`<td style="vertical-align:middle;">
                    <div
                        style="display:flex;align-items:center;justify-content:center;"
                    >
                        <span style="padding-right: 10px;">${element.pivot.size}</span>
                        <div
                            style="
                                width: 15px;
                                height: 15px;
                                border-radius: 999px;
                                background-color: ${element.pivot.color_code};
                            "
                        ></div>
                    </div>
                </td>`;
                detailOrder+=`<td style="vertical-align:middle;">${element.pivot.amount} * ${element.pivot.price_sale.toLocaleString()}đ</td>`;
                detailOrder+=`<td style="vertical-align:middle;">${(element.pivot.amount * element.pivot.price_sale).toLocaleString()} đ</td>`;
                detailOrder+=`</tr>`;
            });
            $('.detail-order').html(detailOrder);
            $('#total_bill').text(totalBill.toLocaleString());
        }
    });
})