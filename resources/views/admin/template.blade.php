@extends('admin.main')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Template HTML</h1>
            </div>
        </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @foreach ($list as $item)
                            <div class="form-group">
                                <label for="{{$item->name}}">{{$item->name}}</label>
                                <textarea data-id="{{$item->id}}" class="form-control template-content" id="{{$item->name}}" rows="20">{{$item->html}}</textarea>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

</div>
@endsection