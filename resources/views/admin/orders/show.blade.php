@extends('admin.layout.app')
@section('orders', 'active')
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
        <h1 class="h3 mb-0 text-gray-800">معاينة طلب</h1>
    </div>

    <a href="{{ route('admin.orders.index') }}"
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
                معاينة طلب
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h6 class="py-2">
                        مرسل الطلب:
                        <strong class="d-block pt-2">{{ $order->user->name }}</strong>
                    </h6>
                    <h6 class="py-2">
                        المشهور:
                        <strong class="d-block pt-2">{{ $order->freelancer->name }}</strong>
                    </h6>
                    <h6 class="py-2">
                        نوع الطلب:
                        <strong class="d-block pt-2">{{ $order->order_type == 'ad' ? 'إعلان' : 'إهداء' }}</strong>
                    </h6>
                    @if($order->order_type == 'gift')
                        <h6 class="py-2">
                            نوع الإهداء:
                            <strong class="d-block pt-2">{{ $order->gift_type }}</strong>
                        </h6>
                        <h6 class="py-2">
                            من:
                            <strong class="d-block pt-2">{{ $order->gift_from }}</strong>
                        </h6>
                        <h6 class="py-2">
                            إلى:
                            <strong class="d-block pt-2">{{ $order->gift_to }}</strong>
                        </h6>
                    @endif
                    <h6 class="py-2">
                        قيمة الطلب:
                        <strong class="d-block pt-2">{{ $order->mount }}$</strong>
                    </h6>
                    <h6 class="py-2">
                        رقم هاتف المشتري:
                        <strong class="d-block pt-2">{{ $order->phone }}</strong>
                    </h6>
                    <h6 class="py-2">صورة إثبات الدفع:</h6>
                    <a href="{{ asset('images/orders/' . $order->image) }}">
                        <img src="{{ asset('images/orders/' . $order->image) }}" class="payment-image">
                    </a>
                    <h6 class="py-2">
                        الرسالة:
                        <strong class="d-block pt-2">{{ $order->message }}</strong>
                    </h6>
                    <h6 class="py-2">
                        حالة الطلب:
                        @if($order->status == 1)
                            <strong class="text-success d-block pt-2">مقبول</strong>
                        @elseif($order->status == 0)
                            <strong class="text-black-50 d-block pt-2">قيد المراجعة</strong>
                        @else
                            <strong class="text-danger d-block pt-2">مرفوض</strong>
                        @endif
                    </h6>
                    <h6 class="py-2">
                        حالة المستحقات المالية للمهشور:
                        @if($order->done == 1)
                            <strong class="text-success d-block pt-2">تم تسليمها</strong>
                        @elseif($order->done == 0)
                            <strong class="text-black-50 d-block pt-2">لم يتم تسليمها</strong>
                        @endif
                    </h6>
                    <hr>
                    <form action="{{ route('admin.orders.change') }}" method="post">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        <div class="form-group">
                            <label>تغيير حالة الطلب</label>
                            <select name="status" class="form-control">
                                <option value="1">قبول</option>
                                <option value="-1">رفض</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>المستحقات المالية للمشهور</label>
                            <select name="done" class="form-control">
                                <option value="1">تم تسليمها</option>
                                <option value="0">لم يتم تسليمها</option>
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
