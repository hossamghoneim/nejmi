@extends('admin.layout.app')
@section('reports', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">التقارير</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif


    <!-- Content Row -->
    <div class="row">

        <div class="col-12 my-4">
            <h5 class="h5 mb-0 text-gray-800">المبيعات الإجمالية</h5>
            <div class="mt-3">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary btn-sm mx-1">الكل</a>
                <a href="?time=1" class="btn btn-outline-secondary btn-sm mx-1">اليوم</a>
                <a href="?time=7" class="btn btn-outline-secondary btn-sm mx-1">آخر أسبوع</a>
                <a href="?time=14" class="btn btn-outline-secondary btn-sm mx-1">آخر 14 يوم</a>
                <a href="?time=30" class="btn btn-outline-secondary btn-sm mx-1">آخر شهر</a>
                <a href="?time=90" class="btn btn-outline-secondary btn-sm mx-1">آخر 3 أشهر</a>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="javascript:void(0)" style="text-decoration: none">
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
            <a href="javascript:void(0)" style="text-decoration: none">
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
            <a href="javascript:void(0)" style="text-decoration: none">
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
            <a href="javascript:void(0)" style="text-decoration: none">
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


    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                الطلبات
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
                                        <a href="{{ route('admin.users.freelancers.show', $order->freelancer->id) }}">{{ $order->freelancer->name }}</a>
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

@endsection
