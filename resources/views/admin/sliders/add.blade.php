@extends('admin.layout.app')
@section('sliders', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">إضافة صورة متحركة جديدة</h1>
    </div>

    <a href="{{ route('admin.sliders') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للصور
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif
    @if(session()->get('errors'))
        <p class="alert alert-danger">{{ session()->get('errors') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                إضافة صورة متحركة جديدة
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.store.sliders') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>الصورة</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>العنوان</label>
                            <input type="text" class="form-control" name="header">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>الوصف</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>الرابط</label>
                            <input type="text" placeholder="/talent/mohamed" class="form-control" name="link">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>كلمة الزر</label>
                            <input type="text" class="form-control" name="btn_text">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                حفظ
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
