@extends('admin.layout.app')
@section('freelancers', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">إضافة مشهور جديد</h1>
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
                إضافة مشهور جديد
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.users.freelancers.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label>اسم المستخدم</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" class="form-control" name="phone" required>
                </div>
                <div class="form-group">
                    <label>كلمة المرور</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-group">
                    <label>التصنيف</label>
                    <select name="category_id" class="form-control" required>
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label>البلد</label>
                    <select name="country_id" class="form-control" required>
                        @forelse($countries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label>عدد المتابعين</label>
                    <input type="text" class="form-control" name="followers">
                </div>
                <div class="form-group">
                    <label>سعر الإعلان (MRU)</label>
                    <input type="text" class="form-control" name="price_ad" required>
                </div>
                <div class="form-group">
                    <label>سعر الإهداء (MRU)</label>
                    <input type="text" class="form-control" name="price_gift" required>
                </div>
                <div class="form-group">
                    <label>العمولة (%)</label>
                    <input type="text" class="form-control" name="commission">
                </div>
                <div class="form-group">
                    <label>وصف عن المشهور</label>
                    <textarea name="about" class="form-control" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label>الصورة الشخصية</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group">
                    <input type="checkbox" name="activated" id="activated">
                    <label for="activated">موثق</label>
                </div>
                <div class="form-group">
                    <input type="submit" value="إضافة" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
