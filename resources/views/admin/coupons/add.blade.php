@extends('admin.layout.app')
@section('coupons', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">إضافة كوبون جديد</h1>
    </div>

    <a href="{{ route('admin.coupons.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للكوبونات
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                إضافة كوبون جديد
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.coupons.save') }}" method="post">
                @csrf
                <div class="form-group">
                    <label>كود الكوبون</label>
                    <input type="text" class="form-control" name="coupon">
                </div>
                <div class="form-group">
                    <label>نسبة الحسم (%)</label>
                    <input type="number" class="form-control" name="discount">
                </div>
                <div class="form-group">
                    <label>تاريخ إنتهاء الصلاحية</label>
                    <input type="date" class="form-control" name="expire_date">
                </div>
                <div class="form-group">
                    <input type="submit" value="إضافة" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
