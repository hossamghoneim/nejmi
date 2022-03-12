@extends('admin.layout.app')
@section('home', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الرئيسية</h1>
{{--        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i--}}
{{--                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
    </div>

    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-primary text-uppercase mb-1">
                                المشاهير</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $freelancers_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-success text-uppercase mb-1">
                                مستخدمين</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="font-weight-bold text-success text-uppercase mb-1">
                                طلبات معلقة</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bars fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                أحدث الطلبات
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>المشتري</th>
                                <th>المشهور</th>
                                <th>قيمة الطلب</th>
                                <th>نوع الطلب</th>
                                <th>حالة الطلب</th>
                                <th>معاينة</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>المشتري</th>
                                <th>المشهور</th>
                                <th>قيمة الطلب</th>
                                <th>نوع الطلب</th>
                                <th>حالة الطلب</th>
                                <th>معاينة</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.freelancers.show', $order->freelancer->id) }}">{{ $order->freelancer->name }}</a>
                                    </td>
                                    <td>{{ $order->mount }}$</td>
                                    <td>{{ $order->order_type == 'ad' ? 'إعلان' : 'إهداء' }}</td>
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
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.orders.show',$order->id) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
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
        </div>
    </div>

@endsection
