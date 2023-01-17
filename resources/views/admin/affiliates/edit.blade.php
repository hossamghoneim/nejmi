@extends('admin.layout.app')
@section('affiliates', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">تعديل وسيط</h1>
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
                تعديل وسيط
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.affiliates.update') }}" method="post">
                @csrf
                <input type="hidden" name="aff_id" value="{{ $affiliate->id }}">
                <div class="form-group">
                    <label>اسم الوسيط</label>
                    <input type="text" class="form-control" name="name" value="{{ $affiliate->name }}" required>
                </div>
                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <input type="text" class="form-control" name="phone" value="{{ $affiliate->phone }}" required>
                </div>
                <div class="form-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" class="form-control" name="email" value="{{ $affiliate->email }}">
                </div>
                <div class="form-group">
                    <label>المشاهير</label>
                    <select name="freelancers[]" class="form-control" multiple="multiple">
                        @forelse($freelancers as $freelancer)
                            <option value="{{ $freelancer->id }}"
                                {{ in_array($freelancer->id, $my_freelancers) ? 'selected' : '' }}>
                                {{ $freelancer->name }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label>عمولة الوسيط (%)</label>
                    <input type="text" class="form-control" name="commission" value="{{ $affiliate->commission }}">
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
