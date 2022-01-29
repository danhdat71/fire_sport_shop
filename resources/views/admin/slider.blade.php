@extends('admin.main')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Slider</h1>
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
                            <h3 class="card-title">Danh sách các slider ứng dụng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table text-center">
                                <thead class="bg-orange">
                                    <tr>
                                        <th class="text-light">ID</th>
                                        <th class="text-light">Hình ảnh</th>
                                        <th class="text-light">URL</th>
                                        <th class="text-light">Trạng thái</th>
                                        <th class="text-light">Timestamps</th>
                                        <th class="text-light">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $slider)
                                    <tr>
                                        <td class="v-mid">{{$slider->id}}</td>
                                        <td class="v-mid">
                                            <img width="200" src="image/sliders/{{$slider->thumb_image}}" alt="">
                                        </td>
                                        <td class="v-mid"><a target="_blank" class="btn" href="{{$slider->url}}">{{$slider->url}}</a></td>
                                        <td class="v-mid">
                                            <input 
                                                type="checkbox" 
                                                name="my-checkbox" 
                                                data-bootstrap-switch 
                                                data-off-color="light" 
                                                data-on-color="orange"
                                                @if($slider->status == 1)
                                                checked
                                                @endif
                                            >
                                        </td>
                                        <td class="v-mid">
                                            <div>{{$slider->created_at}}</div>
                                            <div>{{$slider->updated_at}}</div>
                                        </td>
                                        <td class="v-mid">
                                            <button class="btn btn-warning btn-sm">Chỉnh sửa</button>
                                            <button
                                                class="btn text-danger delete-slider"
                                                data-id="{{$slider->id}}"
                                            >Xóa Slide</button
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginate">
                                {{$sliders->links('global.paginate')}}
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
              Tạo slider
            </div>
            <form enctype="multipart/form-data" id="form-slider-upload" class="modal-body">
                <div class="form-group">
                    <label for="">Đường dẫn</label>
                    <input type="text" class="form-control" name="url">
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
                    <select name="status" class="form-control">
                        <option value="1">Hiện sau khi lưu</option>
                        <option value="0">Ẩn sau khi lưu</option>
                    </select>
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
                    <button id="upload-slider" type="button" class="btn bg-orange btn-block">Lưu</button>
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