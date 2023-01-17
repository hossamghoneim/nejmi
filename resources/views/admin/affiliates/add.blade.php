@extends('admin.layout.app')
@section('affiliates', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">إضافة وسيط جديد</h1>
    </div>

    <a href="{{ route('admin.affiliates.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للوسطاء
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                إضافة وسيط جديد
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.affiliates.save') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>اسم الوسيط</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label>المشاهير</label>
                    <select name="freelancers[]" class="form-control" multiple="multiple">
                        @forelse($freelancers as $freelancer)
                            <option value="{{ $freelancer->id }}">{{ $freelancer->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label>عمولة الوسيط (%)</label>
                    <input type="text" class="form-control" name="commission">
                </div>
                <div class="form-group">
                    <input type="submit" value="إضافة" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
