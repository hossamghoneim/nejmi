@extends('admin.layout.app')
@section('activations', 'active')
@section('style')
    <style>
        .payment-image {
            margin: 20px 0;
            width: 400px;
            height: 400px;
            cursor: zoom-in;
        }

        @media (max-width: 576px) {
            .payment-image {
                width: 100%;
                height: auto;
            }
        }
    </style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">معاينة طلب توثيق</h1>
    </div>

    <a href="{{ route('admin.activations.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للطلبات
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                معاينة طلب توثيق
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h6 class="py-2">
                        مرسل الطلب:
                        <strong class="d-block pt-2">
                            {{ $activation->user->name }}
                        </strong>
                    </h6>
                    <h6 class="py-2">
                        نوع التوثيق:
                        <strong class="d-block pt-2">
                            {{ $activation->image_type }}
                        </strong>
                    </h6>
                    <h6 class="py-2">صورة الوثيقة:</h6>
                    <a href="{{ asset('images/activations/' . $activation->image) }}">
                        <img src="{{ asset('images/activations/' . $activation->image) }}" class="payment-image">
                    </a>
                    <h6 class="py-2">
                        حالة التوثيق:
                        @if($activation->status == 1)
                            <strong class="text-success d-block pt-2">مقبول</strong>
                        @elseif($activation->status == 2)
                            <strong class="text-black-50 d-block pt-2">قيد المراجعة</strong>
                        @else
                            <strong class="text-danger d-block pt-2">مرفوض</strong>
                        @endif
                    </h6>
                    <hr>
                    <form action="{{ route('admin.activations.change_status') }}" method="post">
                        @csrf
                        <input type="hidden" name="act_id" value="{{ $activation->id }}">
                        <div class="form-group">
                            <label>تغيير حالة الطلب</label>
                            <select name="status" class="form-control">
                                <option value="">اختر</option>
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
        </div>
    </div>

@endsection
