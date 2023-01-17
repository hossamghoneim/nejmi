@extends('admin.layout.app')
@section('users', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $user->name }}</h1>
    </div>

    <a href="{{ route('admin.users.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للمستخدمين
    </a>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $user->name }}
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6 my-2">
                    @if($user->image)
                    <img src="{{ asset('images/users/' . $user->image) }}" style="width: 300px;max-width: 100%">
                    @else
                        <h6>لا يوجد صورة</h6>
                    @endif
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
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">
                    التعاملات المالية - الطلبات
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
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
                                <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.users.freelancers.show', $order->freelancer->id) }}">
                                                {{ $order->freelancer->name }}
                                            </a>
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

@endsection
