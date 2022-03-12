@extends('admin.layout.app')
@section('users', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $user->name }}</h1>
    </div>

    <a href="{{ route('admin.users.freelancers') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للمشاهير
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $user->name }} - تعديل الملف الشخصي
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.freelancers.update', $user->id) }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                </div>
                <div class="form-group">
                    <label>البلد</label>
                    <select class="form-control" name="country_id">
                        @foreach($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>التصنيف</label>
                    <select class="form-control" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>عدد المتابعين</label>
                    <input type="text" name="followers" class="form-control" value="{{ $user->followers }}">
                </div>
                <div class="form-group">
                    <label>سعر الإعلان ($)</label>
                    <input type="text" name="price_ad" class="form-control" value="{{ $user->price_ad }}">
                </div>
                <div class="form-group">
                    <label>سعر الإهداء ($)</label>
                    <input type="text" name="price_gift" class="form-control" value="{{ $user->price_gift }}">
                </div>
                <div class="form-group">
                    <label>حالة الحساب</label>
                    <span>
                        @if($user->status == 1)
                            <span class="text-success">مقبول</span>
                        @elseif($user->status == 0)
                            <span>قيد المراجعة</span>
                        @else
                            <span class="text-danger">مرفوض</span>
                        @endif
                    </span>
                    <select class="form-control" name="status">
                        <option value="1">قبول</option>
                        <option value="-1">رفض</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
