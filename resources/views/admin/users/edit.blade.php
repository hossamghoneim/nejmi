@extends('admin.layout.app')
@section('freelancers', 'active')
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
    @if($user->activated == 1)
        <a href="javascript:void(0);"
           onclick="document.getElementById('toggleActivation').submit()"
           class="d-sm-inline-block btn btn-sm btn-danger shadow-sm mb-4">
            <i class="fas fa-user-check fa-sm text-white-50"></i>
            إلغاء توثيق الحساب
        </a>
    @else
        <a href="javascript:void(0);"
           onclick="document.getElementById('toggleActivation').submit()"
           class="d-sm-inline-block btn btn-sm btn-success shadow-sm mb-4">
            <i class="fas fa-user-check fa-sm text-white-50"></i>
            توثيق الحساب
        </a>
    @endif

    <form id="toggleActivation" action="{{ route('admin.users.freelancers.toggleActivation') }}" method="post" class="d-none">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
    </form>

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
            <form action="{{ route('admin.users.freelancers.update', $user->id) }}" method="post" enctype="multipart/form-data">
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
                    <label>التصنيف</label>
                    <select class="form-control" name="category_id">
                        <option value="{{ $user->category_id }}" selected>{{ $user->category->name }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>البلد</label>
                    <select name="country_id" class="form-control" required>
                        @forelse($countries as $country)
                            <option value="{{ $country->id }}" {{ $country->id == $user->country_id }}>{{ $country->name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label>عدد المتابعين</label>
                    <input type="text" name="followers" class="form-control" value="{{ $user->followers }}">
                </div>
                <div class="form-group">
                    <label>سعر الإعلان (MRU)</label>
                    <input type="text" name="price_ad" class="form-control" value="{{ $user->price_ad }}">
                </div>
                <div class="form-group">
                    <label>سعر الإهداء (MRU)</label>
                    <input type="text" name="price_gift" class="form-control" value="{{ $user->price_gift }}">
                </div>
                <div class="form-group">
                    <label>العمولة (%)</label>
                    <input type="text" name="commission" class="form-control" value="{{ $user->commission }}">
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
                        <option value="">اختر</option>
                        <option value="1">قبول</option>
                        <option value="-1">رفض</option>
                    </select>
                </div>
                <hr />
                <div class="form-group">
                    <h4 class="mb-3">فيديوهات المشهور</h4>
                    <h5>الفيديو الأساسي</h5>
                    <div class="row">
                        <div class="col-12 col-md-4 text-center">
                            @if($user->video)
                                <video src="{{ asset('video/' . $user->video) }}" class="w-100" controls>
                                    <source src="{{ asset('video/' . $user->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <a href="{{ route('admin.video.delete_main_video', $user->id) }}" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                            @else
                                <h6>لا يوجد فيديو أساسي.</h6>
                            @endif
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h5>الفيديوهات المرفوعة</h5>
                        </div>
                        @forelse($user->videos as $video)
                            <div class="col-12 col-md-4 text-center">
                                <video src="{{ asset('video/' . $video->video) }}" class="w-100" controls>
                                    <source src="{{ asset('video/' . $video->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <a href="{{ route('admin.video.delete', $video->id) }}" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
                            </div>
                        @empty
                            <div class="col-12 col-md-4 text-center">
                                <h6>لا يوجد فيديوهات مرفوعة.</h6>
                            </div>
                        @endforelse
                        <div class="col-12">
                            <hr />
                            <h5>رفع فيديو جديد</h5>
                            <div class="form-group">
                                <input type="file" name="video" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
