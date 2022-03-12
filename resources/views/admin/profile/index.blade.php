@extends('admin.layout.app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">ملفي الشخصي</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">بياناتي</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>الاسم الكامل</label>
                    <input type="text" class="form-control" name="name" value="{{ $admin->name }}">
                </div>
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" class="form-control" name="email" value="{{ $admin->email }}">
                </div>
                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" class="form-control" name="password" placeholder="اكتب كلمة مرور قوية">
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
