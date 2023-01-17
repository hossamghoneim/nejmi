@extends('admin.layout.app')
@section('home', 'active')
@section('content')

<?php

    ?>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الرئيسية</h1>
{{--        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i--}}
{{--                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
    </div>

    @can('reports')
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('admin.users.freelancers') }}" style="text-decoration: none">
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
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('admin.users.index') }}" style="text-decoration: none">
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
            </a>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <a href="{{ route('admin.orders.index','status=pending') }}" style="text-decoration: none">
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
            </a>
        </div>

    </div>
    @endcan

    @can('reports')
    <!-- Content Row -->
    <div class="row">

        <div class="col-12 my-4">
            <h4 class="h3 mb-0 text-gray-800">المبيعات</h4>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('admin.reports.index') }}" style="text-decoration: none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    عدد المبيعات
                                </div>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sales_count }} مبيعة</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('admin.reports.index') }}" style="text-decoration: none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    إجمالي المبيعات
                                </div>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sales }} MRU</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('admin.reports.index') }}" style="text-decoration: none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    الربح
                                    <br>
                                    مع ربح الوسيط
                                </div>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $profit }} MRU</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('admin.reports.index') }}" style="text-decoration: none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary text-uppercase mb-1">
                                    ربح الموقع
                                    <br>
                                    الصافي
                                </div>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $final_profit }} MRU</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
    @endcan

    @can('orders')
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
                            <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>
                                        @if($order->user)
                                            <a href="{{ route('admin.users.show', $order->user->id) }}">{{ $order->user->name }}</a>
                                        @else
                                            غير مسجل
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->freelancer)
                                            <a href="{{ route('admin.users.freelancers.show', $order->freelancer->id) }}">{{ $order->freelancer->name }}</a>
                                        @else
                                            غير مسجل
                                        @endif
                                    </td>
                                    <td>{{ $order->mount }} MRU</td>
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
    @endcan

    @can('affiliate')
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    {{ $affiliate->name }}
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h6>
                            الاسم:
                            <strong>{{ $affiliate->name }}</strong>
                        </h6>
                        <h6>
                            الهاتف:
                            <strong>{{ $affiliate->phone }}</strong>
                        </h6>
                        @if($affiliate->email)
                            <h6>
                                البريد الإلكتروني:
                                <strong>{{ $affiliate->email }}</strong>
                            </h6>
                        @endif
                        @if($affiliate->freelancers->count() > 0)
                            <h6>
                                المشاهير:
                                <ul>
                                    @foreach($affiliate->freelancers as $aff)
                                        <li class="my-2">
                                            {{ \App\User::find($aff->target_id) ? \App\User::find($aff->target_id)->name : '' }}
                                        </li>
                                    @endforeach
                                </ul>
                            </h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">
                    التعاملات المالية - المستحقات
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            إجمالي الأرباح
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_sales }} MRU</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            مستلمة
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $done_orders_mount }} MRU</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            معلقة
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_sales - $done_orders_mount }} MRU</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">
                    التعاملات المالية - الطلبات ({{ $affiliate->orders->count() }})
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
                                    <th>عمولة الوسيط</th>
                                    <th>مستحقات الوسيط</th>
                                    <th>حالة الطلب</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($affiliate_orders as $order)
                                    <tr>
                                        <td>
                                            @if($order["main_order"]->user)
                                                <a href="{{ route('admin.users.show', $order["main_order"]->user->id) }}">{{ $order["main_order"]->user->name }}</a>
                                            @else
                                                غير مسجل
                                            @endif
                                        </td>
                                        <td>
                                            @if($order["main_order"]->freelancer)
                                                <a href="{{ route('admin.users.show', $order["main_order"]->freelancer->id) }}">{{ $order["main_order"]->freelancer->name }}</a>
                                            @else
                                                غير مسجل
                                            @endif
                                        </td>
                                        <td>{{ $order["comm"] . '%' }}</td>
                                        <td>{{ ($order["main_order"]->mount * $order["main_order"]->commission / 100) * ($order["comm"] / 100) }} MRU</td>
                                        <td>
                                            @if($order["main_order"]->status == 1)
                                                <span class="text-success">مقبول</span>
                                            @elseif($order["main_order"]->status == 0)
                                                <span>قيد المراجعة</span>
                                            @else
                                                <span class="text-danger">مرفوض</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="8">لايوجد تعاملات.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">
                    التعاملات المالية - الدفعات ({{ $affiliate->transactions->count() }})
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>قيمة الدفعة</th>
                                    <th>ملاحظات</th>
                                    <th>تاريخ الإضافة</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($affiliate->transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->mount }} MRU</td>
                                        <td>{{ $transaction->notes ?? "-" }}</td>
                                        <td>{{ $transaction->created_at->format("Y-m-d") }}</td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td colspan="4">لايوجد دفعات.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endcan

@endsection
