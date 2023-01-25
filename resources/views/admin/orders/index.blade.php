@extends('admin.layout.app')
@section('orders', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الطلبات</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if(Request::has('status') && Request::query('status') == 'approved')
                <h6 class="m-0 font-weight-bold text-primary">المقبولين</h6>
            @elseif(Request::has('status') && Request::query('status') == 'pending')
                <h6 class="m-0 font-weight-bold text-primary">قيد المراجعة</h6>
            @elseif(Request::has('status') && Request::query('status') == 'rejected')
                <h6 class="m-0 font-weight-bold text-primary">المرفوضين</h6>
            @else
                <h6 class="m-0 font-weight-bold text-primary">كل الطلبات</h6>
            @endif
            <div class="mt-3">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-dark btn-custom mx-1">الكل</a>
                <a href="?status=approved" class="btn btn-success btn-custom mx-1">المقبولين</a>
                <a href="?status=pending" class="btn btn-primary btn-custom mx-1">قيد المراجعة</a>
                <a href="?status=rejected" class="btn btn-danger btn-custom mx-1">المرفوضين</a>
                <a href="{{ route('admin.orders.incomplete') }}" class="btn btn-info btn-custom mx-1">غير المكتملة</a>
            </div>
            <div class="mt-3">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-12 col-md-6 my-2">
                            <input
                                type="text"
                                class="form-control"
                                value="{{ request()->order_id  }}"
                                placeholder="رقم الطلب"
                                name="order_id">
                        </div>
                        <div class="col-12 col-md-6 my-2">
                            <button type="submit" class="btn btn-primary">بحث</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>رقم الطلب</th>
                        <th>مرسل الطلب</th>
                        <th>المشهور</th>
                        <th>نوع الطلب</th>
                        <th>قيمة الطلب</th>
                        <th>تاريخ الطلب</th>
                        <th>حالة الطلب</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>
                                @if($order->user)
                                <a href="{{ route('admin.users.show', $order->user->id) }}">
                                    {{ $order->user->name }}
                                </a>
                                @else
                                    غير مسجل
                                @endif
                            </td>
                            <td>
                                @if($order->freelancer)
                                    <a href="{{ route('admin.users.freelancers.show', $order->freelancer->id) }}">
                                        {{ $order->freelancer->name }}
                                    </a>
                                @else
                                    غير مسجل
                                @endif
                            </td>
                            <td>{{ $order->order_type == 'ad' ? 'إعلان' : 'إهداء' }}</td>
                            <td>{{ $order->mount }} MRU</td>
                            <td>{{ $order->created_at->format("Y-m-d") }}</td>
                            <td>
                                @if($order->status == 1)
                                    <span class="text-success">مقبول</span>
                                @elseif($order->status == 0)
                                    <span>قيد المراجعة</span>
                                @else
                                    <span class="text-danger">مرفوض</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                       class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="8">لايوجد طلبات.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($orders && $orders->count() > 1)
        {{ $orders->links() }}
    @endif

@endsection
