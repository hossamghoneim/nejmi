@extends('admin.layout.app')
@section('supervisors', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">تعديل مشرف</h1>
    </div>

    <a href="{{ route('admin.supervisors.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للمشرفين
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                تعديل مشرف
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.supervisors.update') }}" method="post">
                @csrf
                <input type="hidden" name="admin_id" value="{{ $admin->id }}">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" class="form-control" name="name" value="{{ $admin->name }}" required>
                </div>
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="text" class="form-control" name="email" value="{{ $admin->email }}" required>
                </div>
                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" class="form-control" name="password">
                </div>
                @if($admin->role->id != 2)
                <div class="form-group">
                    <label>الصلاحية</label>
                    <select name="role_id" class="form-control" required>
                        <option value="">---</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $admin->role->id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
