@extends('admin.main')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản lý đơn đặt hàng</h1>
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
                            <form action="/order" method="get" class="row">
                                <div class="col-lg-3">
                                    <label for="type">Trạng thái</label>
                                    <select name="status" class="form-control">
                                        <option
                                            value=""
                                        >Tất cả</option>
                                        <option
                                            @if($status == 1){{"selected"}}@endif 
                                            value="1"
                                        >Đã giao</option>
                                        <option
                                            @if($status == 0){{"selected"}}@endif 
                                            value="0"
                                        >Chưa giao</option>
                                        <option 
                                            @if($status == 2){{"selected"}}@endif 
                                            value="2"
                                        >Đã hủy</option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <label for="type">Sắp xếp</label>
                                    <select name="order_by" class="form-control">
                                        <option 
                                            value="created_at|desc"
                                            @if($orderBy == "created_at|desc")
                                            selected
                                            @endif
                                        >Mặc định</option>
                                        <option 
                                            value="created_at|desc"
                                            @if($orderBy == "created_at|desc")
                                            selected
                                            @endif
                                        >Mới nhất</option>
                                        <option 
                                            value="created_at|desc"
                                            @if($orderBy == "created_at|desc")
                                            selected
                                            @endif
                                        >Cũ nhất</option>
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
                                        <th class="text-light">CODE</th>
                                        <th class="text-light">Họ tên</th>
                                        <th class="text-light">Số điện thoại</th>
                                        <th class="text-light">Địa chỉ giao</th>
                                        <th class="text-light">Trạng thái</th>
                                        <th class="text-light">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($list as $item)
                                    <tr>
                                        <td>{{$item->code}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>
                                            <div>{{$item->address}}</div>
                                            <div>{{$item->town->name}} - {{$item->town->district->name}} - {{$item->town->district->province->name}}</div>
                                        </td>
                                        <td>
                                            <select
                                                data-id="{{$item->id}}"
                                                @if($item->status == 2)
                                                {{"disabled"}}
                                                @endif
                                                class="change-order-status form-control
                                                @if($item->status == 0){{"border-warning"}}
                                                @elseif($item->status == 1){{"border-success"}}
                                                @elseif($item->status == 2){{"border-danger"}}
                                                @endif
                                                "
                                            >
                                                <option
                                                    @if($item->status == 0)
                                                    {{"selected"}}
                                                    @endif
                                                    class="text-warning"
                                                    value="0"
                                                >Chưa giao</option>
                                                <option
                                                    @if($item->status == 1)
                                                    {{"selected"}}
                                                    @endif
                                                    class="text-success"
                                                    value="1"
                                                >Đã giao</option>
                                                <option
                                                    @if($item->status == 2)
                                                    {{"selected"}}
                                                    @endif
                                                    class="text-danger"
                                                    value="2"
                                                >Đã hủy</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button
                                                data-toggle="modal" data-target="#show"
                                                data-id={{$item->id}}
                                                class="btn btn-sm btn-info show-detail-order"
                                            >Xem</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="paginate">
                                {{$list->links('global.paginate', [
                                    'order_by' => $orderBy ?? null,
                                    'status' => $status ?? null,
                                    'keyword' => $keyword ?? null
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
    
    <div class="modal fade" id="show">
        <div class="modal-dialog" style="max-width: 1000px">
          <div class="modal-content">
            <div class="modal-header">
              Mời admin
            </div>
            <div enctype="multipart/form-data" id="form-invite-admin" class="modal-body">
                <table class="table">
                    <thead class="bg-info text-center">
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Size / Màu</th>
                        <th>Số lượng * Giá</th>
                        <th>Thành tiền</th>
                    </thead>
                    <tbody style="vertical-align: middle; text-align: center;" class="detail-order">
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="row w-100 align-center" style="justify-content: flex-end">
                    <div class="col-lg-6 text-right ml-auto">
                        <div>
                            <span>Phí vận chuyển: ~30.000đ</span>
                        </div>
                        <div>
                            <span>Tổng đơn hàng: </span>
                            <span id="total_bill" style="font-size: 25px;">100.000 <span>đ</span></span>
                        </div>
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