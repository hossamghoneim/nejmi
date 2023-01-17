@extends('admin.layout.app')
@section('featured_users', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">إضافة مشهور مميز جديد</h1>
    </div>

    <a href="{{ route('admin.featured_users.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للمشاهير المميزين
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                إضافة مشهور مميز جديد
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.featured_users.save') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>المشهور</label>
                    <select name="user_id" class="form-control" required>
                        <option value="">اختر</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="إضافة" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
