@extends('admin.main')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản lý tài khoản</h1>
            </div>
            <div class="col-sm-6 d-flex flex-end align-center">
                <button data-toggle="modal" data-target="#add" type="button" class="btn bg-orange">+ Mời admin</button>
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
                            <form action="/product-category" method="get" class="row">
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
                                    <label for="type">Loại</label>
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
                                        <th class="text-light">ID</th>
                                        <th class="text-light">Hình ảnh</th>
                                        <th class="text-light">Họ tên</th>
                                        <th class="text-light">Trạng thái</th>
                                        <th class="text-light">Timestamps</th>
                                        <th class="text-light">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach($list as $productCategory)
                                    <tr>
                                        <td class="v-mid">{{$productCategory->id}}</td>
                                        <td class="v-mid">
                                            <img width="200" src="image/productCategories/{{$productCategory->thumb_image}}" alt="">
                                        </td>
                                        <td class="v-mid"><a target="_blank" class="btn" href="{{$productCategory->url}}">{{$productCategory->url}}</a></td>
                                        <td class="v-mid">
                                            <input 
                                                type="checkbox" 
                                                name="my-checkbox" 
                                                data-bootstrap-switch 
                                                data-off-color="light" 
                                                data-on-color="orange"
                                                class="switch-status product-category-status"
                                                data-id="{{$productCategory->id}}"
                                                @if($productCategory->status == 1)
                                                checked
                                                @endif
                                            >
                                        </td>
                                        <td class="v-mid">
                                            <div>{{$productCategory->created_at}}</div>
                                            <div>{{$productCategory->updated_at}}</div>
                                        </td>
                                        <td class="v-mid">
                                            <button data-id="{{$productCategory->id}}" data-toggle="modal" data-target="#edit" class="btn btn-warning btn-sm edit-product-category">Chỉnh sửa</button>
                                            <a href="/product?category={{$productCategory->id}}" class="btn btn-sm btn-warning">
                                                {{$productCategory->products_count}} SP
                                            </a>
                                            <button
                                                class="btn text-danger delete-product-category"
                                                data-id="{{$productCategory->id}}"
                                            >Xóa</button>
                                        </td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                            {{-- <div class="paginate">
                                {{$list->links('global.paginate', [
                                    'keyword' => $keyword ?? null,
                                    'order_by' => $orderBy ?? null
                                ])}}
                            </div> --}}
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
        <div class="modal-dialog" style="max-width: 1000px">
          <div class="modal-content">
            <div class="modal-header">
              Mời admin
            </div>
            <form enctype="multipart/form-data" id="form-invite-admin" class="modal-body">
                <div class="form-group">
                    <label for="email">Email mời</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="alert alert-info">!!! Sau khi mời admin, hệ thống sẽ gửi email link đến admin, sau khi đồng ý tham gia thông tin của admin sẽ được hiển thị ở bảng bên dưới ! Thời hạn xác nhận là 1 ngày !</div>
            </form>
            <div class="modal-footer">
                <div class="row w-100 align-center" style="justify-content: flex-end">
                    {{-- <div class="col-lg-10">
                        <div class="progress">
                            <div class="progress-bar bg-orange" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div> --}}
                    <div class="col-lg-2">
                        <button id="invite-admin" type="button" class="btn bg-orange btn-block">Gửi lời mời</button>
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