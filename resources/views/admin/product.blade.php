@extends('admin.main')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Product</h1>
            </div>
            <div class="col-sm-6 d-flex flex-end align-center">
                <button data-toggle="modal" data-target="#add" type="button" class="btn bg-orange">+ Tạo Mới</button>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="/product" method="get" class="row">
                                <div class="col-lg-3">
                                    <label for="keyword">Tìm kiếm</label>
                                    <input 
                                        id="keyword" 
                                        name="keyword" 
                                        type="text" 
                                        class="form-control" 
                                        placeholder="Tìm kiếm..."
                                        value="{{$keyword}}"
                                    >
                                </div>
                                <div class="col-lg-3">
                                    <label for="type">Loại sản phẩm</label>
                                    <select name="category" id="type" class="form-control">
                                        <option value="">All</option>
                                        @foreach($productCategories as $item)
                                        <option 
                                            value="{{$item->id}}"
                                            @if($category == $item->id)
                                            selected
                                            @endif    
                                        >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="type">Sắp xếp</label>
                                    <select name="order_by" id="type" class="form-control">
                                        <option 
                                            value="created_at|desc"
                                            @if($orderBy == "created_at|desc")
                                            selected
                                            @endif
                                        >Mặc định</option>
                                        <option 
                                            value="url|asc"
                                            @if($orderBy == "url|asc")
                                            selected
                                            @endif
                                        >Link (A -> Z)</option>
                                        <option 
                                            value="url|desc"
                                            @if($orderBy == "url|desc")
                                            selected
                                            @endif
                                        >Link (Z -> A)</option>
                                        <option 
                                            value="status|desc"
                                            @if($orderBy == "status|desc")
                                            selected
                                            @endif
                                        >Trạng thái (ON -> OFF)</option>
                                        <option 
                                            value="status|asc"
                                            @if($orderBy == "status|asc")
                                            selected
                                            @endif
                                        >Trạng thái (OFF -> ON)</option>
                                        <option 
                                            value="created_at|desc"
                                            @if($orderBy == "created_at|desc")
                                            selected
                                            @endif
                                        >Ngày tạo (Mới nhất)</option>
                                        <option 
                                            value="created_at|asc"
                                            @if($orderBy == "created_at|asc")
                                            selected
                                            @endif
                                        >Ngày tạo (Cũ nhất)</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-sm bg-orange" style="margin-top: 35px">Thực hiện</button>
                                </div>
                            </form>                         
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table text-center">
                                <thead class="bg-orange">
                                    <tr>
                                        <th class="text-light">Hình ảnh</th>
                                        <th class="text-light">Name</th>
                                        <th class="text-light">Price</th>
                                        <th class="text-light">Trạng thái</th>
                                        <th class="text-light">Timestamps</th>
                                        <th class="text-light">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $item)
                                    <tr>
                                        <td class="v-mid">
                                            <img width="200" src="image/products/{{$item->image_1}}" alt="">
                                        </td>
                                        <td class="v-mid"><b>{{$item->name}}</b></td>
                                        <td class="v-mid">
                                            <div>{{$item->price_sale}} đ</div>
                                            <div><del>{{$item->price_root}}</del> đ</div>
                                        </td>
                                        <td class="v-mid">
                                            <input 
                                                type="checkbox" 
                                                name="my-checkbox" 
                                                data-bootstrap-switch 
                                                data-off-color="light" 
                                                data-on-color="orange"
                                                class="switch-status product-status"
                                                data-id="{{$item->id}}"
                                                @if($item->status == 1)
                                                checked
                                                @endif
                                            >
                                        </td>
                                        <td class="v-mid">
                                            <div>{{$item->created_at}}</div>
                                            <div>{{$item->updated_at}}</div>
                                        </td>
                                        <td class="v-mid">
                                            <button data-id="{{$item->id}}" data-toggle="modal" data-target="#edit" class="btn btn-warning btn-sm edit-product">Chỉnh sửa</button>
                                            <a href="/product-images?product_id={{$item->id}}" class="btn btn-sm btn-warning">{{$item->product_images_count}} ảnh</a>
                                            <button
                                                class="btn text-danger delete-product"
                                                data-id="{{$item->id}}"
                                            >Xóa</button
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginate">
                                {{$list->links('global.paginate', [
                                    'keyword' => $keyword ?? null,
                                    'order_by' => $orderBy ?? null
                                ])}}
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <div class="modal fade" id="add">
        <div class="modal-dialog" style="max-width: 1200px">
          <div class="modal-content">
            <div class="modal-header">
              Tạo sản phẩm
            </div>
            <form action="/product-category" enctype="multipart/form-data" id="form-product-upload" class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Tiêu đề</label>
                            <input type="text" class="form-control url" name="name">
                            <p class="text-danger name validate-msg"></p>
                        </div>
                        <div class="col-6">
                            <label for="">URL</label>
                            <input type="text" class="form-control url-genegrate" name="url">
                            <p class="text-danger url validate-msg"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Xuất sứ</label>
                    <input type="text" class="form-control" name="from">
                    <p class="text-danger from validate-msg"></p>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Ảnh đại diện 1</label>
                            <p class="text-danger image validate-msg"></p>
                            <div class="input-file-1">
                                <input id="image" type="file" name="image_1" class="input-image-1" accept="image/*">
                                <img class="preview-image-1" src="" alt="">
                                <div class="icon"><i class="fas fa-image"></i></div>
                            </div>
                            <p class="text-danger image_1 validate-msg"></p>
                        </div>
                        <div class="col-6">
                            <label for="">Ảnh đại diện 2</label>
                            <p class="text-danger image validate-msg"></p>
                            <div class="input-file-2">
                                <input id="image" type="file" name="image_2" class="input-image-2" accept="image/*">
                                <img class="preview-image-2" src="" alt="">
                                <div class="icon"><i class="fas fa-image"></i></div>
                            </div>
                            <p class="text-danger image_2 validate-msg"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Loại sản phẩm</label>
                            <select class="form-control" name="category_id" id="">
                                @foreach($productCategories as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-danger category_id validate-msg"></p>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Giá gốc</label>
                                    <input name="price_root" step="0.01" type="number" class="form-control">
                                    <p class="text-danger price_root validate-msg"></p>
                                </div>
                                <div class="col-6">
                                    <label for="">Giá còn</label>
                                    <input name="price_sale" step="0.01" type="number" class="form-control">
                                    <p class="text-danger price_sale validate-msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Size</label>
                            <select class="form-control" name="sizes[]" id="" multiple>
                                @foreach ($sizes as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-danger url validate-msg"></p>
                        </div>
                        <div class="col-6">
                            <label class="d-block" for="">Mã màu sắc</label>
                            <div class="row">
                                <div class="col-9">
                                    <input class="tag-input form-control w-100" type="text" data-role="tagsinput" />
                                    <p class="text-danger url validate-msg"></p>
                                </div>
                                <div class="col-3">
                                    <input style="height: 36px" class="product-color w-100" type="color">
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea class="form-control" name="short_desc" id="" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Mô tả dài</label>
                    <textarea class="form-control" name="ckeditor_1" id="" rows="3"></textarea>
                </div>
            </form>
            <div class="modal-footer">
              <div class="row w-100 align-center">
                  <div class="col-lg-10">
                    <div class="progress">
                        <div class="progress-bar bg-orange" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <button id="upload-product" type="button" class="btn bg-orange btn-block">Lưu</button>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <div class="modal fade" id="edit">
        <div class="modal-dialog" style="max-width: 1200px">
          <div class="modal-content">
            <div class="modal-header">
              Tạo sản phẩm
            </div>
            <form action="/product-category" enctype="multipart/form-data" id="form-product-update" class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <input type="hidden" name="id" id="id">
                        <div class="col-6">
                            <label for="">Tiêu đề</label>
                            <input type="text" class="form-control url" name="name" id="name">
                            <p class="text-danger name validate-msg"></p>
                        </div>
                        <div class="col-6">
                            <label for="">URL</label>
                            <input type="text" class="form-control url-genegrate" name="url" id="url">
                            <p class="text-danger url validate-msg"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Xuất sứ</label>
                    <input type="text" class="form-control" name="from" id="from">
                    <p class="text-danger from validate-msg"></p>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Ảnh đại diện 1</label>
                            <p class="text-danger image validate-msg"></p>
                            <div class="input-file-1">
                                <input id="image" type="file" name="image_1" class="input-image-1" accept="image/*">
                                <img class="preview-image-1" src="" alt="" id="preview-image-1">
                                <div class="icon"><i class="fas fa-image"></i></div>
                            </div>
                            <p class="text-danger image_1 validate-msg"></p>
                        </div>
                        <div class="col-6">
                            <label for="">Ảnh đại diện 2</label>
                            <p class="text-danger image validate-msg"></p>
                            <div class="input-file-2">
                                <input id="image" type="file" name="image_2" class="input-image-2" accept="image/*">
                                <img class="preview-image-2" src="" alt="" id="preview-image-2">
                                <div class="icon"><i class="fas fa-image"></i></div>
                            </div>
                            <p class="text-danger image_2 validate-msg"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Loại sản phẩm</label>
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach($productCategories as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-danger category_id validate-msg"></p>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <label for="">Giá gốc</label>
                                    <input name="price_root" step="0.01" type="number" class="form-control" id="price_root">
                                    <p class="text-danger price_root validate-msg"></p>
                                </div>
                                <div class="col-6">
                                    <label for="">Giá còn</label>
                                    <input name="price_sale" step="0.01" type="number" class="form-control" id="price_sale">
                                    <p class="text-danger price_sale validate-msg"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Size</label>
                            <select class="form-control" name="sizes[]" id="sizes" multiple>
                                @foreach ($sizes as $item)
                                    <option class="{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <p class="text-danger sizes validate-msg"></p>
                        </div>
                        <div class="col-6">
                            <label class="d-block" for="">Mã màu sắc</label>
                            <div class="row">
                                <div class="col-9">
                                    <input id="colors" class="tag-input form-control w-100" type="text" data-role="tagsinput" />
                                    <p class="text-danger url validate-msg"></p>
                                </div>
                                <div class="col-3">
                                    <input style="height: 36px" class="product-color w-100" type="color">
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <select class="form-control" name="status" id="status">
                        <option value="0">Ẩn</option>
                        <option value="1">Hiện</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea class="form-control" name="short_desc" id="short_desc" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Mô tả dài</label>
                    <textarea class="form-control" name="ckeditor_2" id="ckeditor_2" rows="3"></textarea>
                </div>
            </form>
            <div class="modal-footer">
              <div class="row w-100 align-center">
                  <div class="col-lg-10">
                    <div class="progress">
                        <div class="progress-bar bg-orange" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="col-lg-2">
                    <button id="update-product" type="button" class="btn bg-orange btn-block">Lưu</button>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
@endsection