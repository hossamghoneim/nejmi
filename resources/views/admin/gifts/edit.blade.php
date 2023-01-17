@extends('admin.layout.app')
@section('gifts', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">تعديل إهداء</h1>
    </div>

    <a href="{{ route('admin.gifts.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للإهداء
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                تعديل كوبون
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.gifts.update') }}" method="post">
                @csrf
                <input type="hidden" name="gift_id" value="{{ $gift->id }}">
                <div class="form-group">
                    <label>اسم الإهداء (العربي)</label>
                    <input type="text" class="form-control" name="name" value="{{ $gift->name }}">
                </div>
                <div class="form-group">
                    <label>اسم الإهداء (الفرنسي)</label>
                    <input type="text" class="form-control" name="name_fr" value="{{ $gift->name_fr }}">
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
