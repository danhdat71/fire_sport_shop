@extends('admin.main')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Product Images</h1>
            </div>
            <div class="col-sm-12">
                <form id="form-upload-product-image" action="" class="row pt-3 pb-2" style="align-items: center">
                    <input type="hidden" name="product_id" value="{{$productID}}">
                    <div class="col-5">
                        <div class="input-image">
                            <input accept="image/*" type="file" multiple name="images[]">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="d-flex" style="align-items: center">
                            <button id="upload-product-image" class="btn btn-info w-50">
                                Upload <i class="fas fa-arrow-up"></i>
                            </button>
                            <p class="w-50 pl-3 m-0 p-0 percen-upload-product-image"></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 pb-4">
                    <div class="wrap-product-image">
                        @foreach ($list as $item)
                        <div class="item">
                            <img data-toggle="modal" data-target="#show" data-big-image="image/productImages/{{$item->big_image}}" src="image/productImages/{{$item->thumb_image}}" alt="image-item">
                            <div data-id="{{$item->id}}" class="delete-product-image">Gỡ</div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="show">
        <div class="modal-dialog" style="max-width: 500px">
          <div class="modal-content">
            <img id="preview-big-image" src="http://localhost:8000/image/products/lpgysymHhAwcZBNL6nOO_big_be1f379e1382fcdca593.jpg" alt="">
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
        <script>
            window.addEventListener('DOMContentLoaded', function(){
                $('.wrap-product-image .item img').on('click', function(){
                    let src = $(this).attr('data-big-image');
                    $('#preview-big-image').attr('src', $(this).attr('data-big-image'));
                });
            });
            
        </script>
    </div>
</div>
@endsection