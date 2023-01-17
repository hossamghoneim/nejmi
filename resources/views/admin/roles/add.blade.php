@extends('admin.layout.app')
@section('roles', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">إضافة صلاحية جديدة</h1>
    </div>

    <a href="{{ route('admin.roles.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للصلاحيات
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                إضافة صلاحية جديدة
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.roles.save') }}" method="post">
                @csrf
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <div class="form-group">
                    <label>اسم الصلاحية</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group">
                    <div class="row mt-4">
                        @foreach(config('global.permissions') as $name => $value)
                            @if($name != 'affiliate')
                                <div class="form-group col-12 col-md-4">
                                    <label>
                                        <input type="checkbox" name="permissions[]" value="{{ $name }}">
                                        {{ $value }}
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="إضافة" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
