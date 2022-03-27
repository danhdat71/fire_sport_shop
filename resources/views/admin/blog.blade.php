@extends('admin.main')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Blog</h1>
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
                            <form action="/blog" method="get" class="row">
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
                                        <th class="text-light">Hình ảnh</th>
                                        <th class="text-light">URL</th>
                                        <th class="text-light">Trạng thái</th>
                                        <th class="text-light">Đặc biệt</th>
                                        <th class="text-light">Timestamps</th>
                                        <th class="text-light">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $blog)
                                    <tr>
                                        <td class="v-mid">
                                            <img width="200" src="image/blogs/{{$blog->thumb_image}}" alt="">
                                        </td>
                                        <td class="v-mid"><a target="_blank" class="btn" href="{{$blog->url}}">{{$blog->url}}</a></td>
                                        <td class="v-mid">
                                            <input 
                                                type="checkbox" 
                                                name="my-checkbox" 
                                                data-bootstrap-switch 
                                                data-off-color="light" 
                                                data-on-color="orange"
                                                class="switch-status blog-status"
                                                data-id="{{$blog->id}}"
                                                @if($blog->status == true)
                                                checked
                                                @endif
                                            >
                                        </td>
                                        <td class="v-mid">
                                            <input 
                                                type="checkbox" 
                                                name="my-checkbox" 
                                                data-bootstrap-switch 
                                                data-off-color="light" 
                                                data-on-color="orange"
                                                class="switch-status blog-special"
                                                data-id="{{$blog->id}}"
                                                @if($blog->special == true)
                                                checked
                                                @endif
                                            >
                                        </td>
                                        <td class="v-mid">
                                            <div>{{$blog->created_at}}</div>
                                            <div>{{$blog->updated_at}}</div>
                                        </td>
                                        <td class="v-mid">
                                            <button data-id="{{$blog->id}}" data-toggle="modal" data-target="#edit" class="btn btn-warning btn-sm edit-blog">Chỉnh sửa</button>
                                            <button
                                                class="btn text-danger delete-blog"
                                                data-id="{{$blog->id}}"
                                            >Xóa</button>
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
        <div class="modal-dialog" style="max-width: 1000px">
          <div class="modal-content">
            <div class="modal-header">
              Tạo bài viết
            </div>
            <form action="" enctype="multipart/form-data" id="form-blog-upload" class="modal-body">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control url" name="name">
                    <p class="text-danger name validate-msg"></p>
                </div>
                <div class="form-group">
                    <label for="">URL</label>
                    <input type="text" class="form-control url-genegrate" name="url">
                    <p class="text-danger url validate-msg"></p>
                </div>
                <div class="form-group">
                    <label for="">Chọn ảnh</label>
                    <p class="text-danger image validate-msg"></p>
                    <div class="input-file-1">
                        <input id="image" type="file" name="image" class="input-image" accept="image/*">
                        <img class="preview-image" src="" alt="">
                        <div class="icon"><i class="fas fa-image"></i></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea class="form-control" name="short_desc" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Mô tả dài</label>
                    <textarea class="form-control" name="ckeditor_1" rows="3"></textarea>
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
                    <button id="upload-blog" type="button" class="btn bg-orange btn-block">Lưu</button>
                  </div>
              </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    
    <div class="modal fade" id="edit">
        <div class="modal-dialog" style="max-width: 1000px">
          <div class="modal-content">
            <div class="modal-header">
              Update bài viết
            </div>
            <form action="" enctype="multipart/form-data" id="form-blog-update" class="modal-body">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control url" name="name" id="name">
                    <p class="text-danger name validate-msg"></p>
                </div>
                <div class="form-group">
                    <label for="">URL</label>
                    <input type="text" class="form-control url-genegrate" name="url" id="url">
                    <p class="text-danger url validate-msg"></p>
                </div>
                <div class="form-group">
                    <label for="">Chọn ảnh</label>
                    <p class="text-danger image validate-msg"></p>
                    <div class="input-file-1">
                        <input id="image" type="file" name="image" class="input-image" accept="image/*">
                        <img class="preview-image" src="" alt="" id="big_image">
                        <div class="icon"><i class="fas fa-image"></i></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Mô tả ngắn</label>
                    <textarea class="form-control" name="short_desc" rows="3" id="short_desc"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Mô tả dài</label>
                    <textarea class="form-control" name="ckeditor_2" rows="3"></textarea>
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
                    <button id="update-blog" type="button" class="btn bg-orange btn-block">Lưu</button>
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