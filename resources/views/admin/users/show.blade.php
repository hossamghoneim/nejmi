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

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $user->name }} -
                @if($user->status == 1)
                    <span class="text-success">مقبول</span>
                @elseif($user->status == 0)
                    <span class="text-black-50">قيد المراجعة</span>
                @else
                    <span class="text-danger">مرفوض</span>
                @endif
            </h6>
            <a href="{{ route('admin.users.freelancers.edit', $user->id) }}"
               class="btn btn-primary btn-sm mt-3 mt-lg-0"><i class="fa fa-edit"></i>
                تعديل
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 my-2">
                    <img src="{{ asset('images/users/' . $user->image) }}" style="width: 300px;max-width: 100%">
                </div>
                <div class="col-12 col-md-6">
                    <h6>
                        الاسم:
                        <strong>{{ $user->name }}</strong>
                    </h6>
                    <h6>
                        الهاتف:
                        <strong>{{ $user->phone }}</strong>
                    </h6>
                    <h6>
                        البلد:
                        <strong>{{ $user->country->name }}</strong>
                    </h6>
                    <h6>
                        التصنيفات:
                        <strong>{{ $user->category->name }}</strong>
                    </h6>
                    <h6>
                        عدد المتابعين:
                        <strong>{{ $user->followers }}</strong>
                    </h6>
                    <h6>
                        سعر الإعلان:
                        <strong>{{ $user->price_ad }}$</strong>
                    </h6>
                    <h6>
                        سعر الإهداء:
                        <strong>{{ $user->price_gift }}$</strong>
                    </h6>
                </div>
                <div class="col-12 my-3">
                    <h6>
                        <strong>وصف {{ $user->name }}
                            عن نفسه</strong>
                        <p class="mt-2">{{ $user->about }}</p>
                    </h6>
                </div>
            </div>
        </div>
    </div>

    @if($user->type == 0)
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">
                    التعاملات المالية - الطلبات
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>المشهور</th>
                                    <th>قيمة الطلب</th>
                                    <th>نوع الطلب</th>
                                    <th>حالة الطلب</th>
                                    <th>معاينة</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>المشهور</th>
                                    <th>قيمة الطلب</th>
                                    <th>نوع الطلب</th>
                                    <th>حالة الطلب</th>
                                    <th>معاينة</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @forelse($user->orders as $order)
                                    <tr>
                                        <td>{{ $order->freelancer }}</td>
                                        <td>{{ $order->mount }}</td>
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
                                            <a class="btn btn-info btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
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
    @elseif($user->type == 1)
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
                                            إجمالي المبيعات
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_sales }}$</div>
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
                                            استلمها
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $done_orders_mount }}$</div>
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
                                            معلقة
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $total_sales - $done_orders_mount }}$
                                        </div>
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
                    التعاملات المالية - الطلبات ({{ $orders->count() }})
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
                                    <th>قيمة الطلب</th>
                                    <th>نوع الطلب</th>
                                    <th>حالة الطلب</th>
                                    <th>معاينة</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>المشتري</th>
                                    <th>قيمة الطلب</th>
                                    <th>نوع الطلب</th>
                                    <th>حالة الطلب</th>
                                    <th>معاينة</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->freelancer->name }}</td>
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
    @endif

@endsection
