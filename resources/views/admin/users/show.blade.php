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

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

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
            <div class="mt-3 mt-lg-0">
                <a href="{{ route('admin.users.freelancers.edit', $user->id) }}"
                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                    تعديل
                </a>
                <a href="javascript:void(0);"
                   data-toggle="modal"
                   data-target="#sendModal"
                   class="btn btn-success btn-sm"><i class="fa fa-dollar-sign"></i>
                    تسليم الأرباح
                </a>
            </div>
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
                        <strong>{{ $user->price_ad }} MRU</strong>
                    </h6>
                    <h6>
                        سعر الإهداء:
                        <strong>{{ $user->price_gift }} MRU</strong>
                    </h6>
                    <h6>
                        العمولة:
                        <strong>{{ $user->commission }}%</strong>
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

    @if($user->type == 1)
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">
                    التعاملات المالية - المستحقات
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-primary text-uppercase mb-1">
                                            إجمالي المبيعات
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_sales }} MRU</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-success text-uppercase mb-1">
                                            استلمها
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $done_orders_mount }} MRU</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-success text-uppercase mb-1">
                                            معلقة
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $total_sales - $done_orders_mount }} MRU
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-success text-uppercase mb-1">
                                            ربح الموقع
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ $profit }} MRU
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
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
                <h6 class="m-0 font-weight-bold text-primary">
                    التعاملات المالية - الدفعات ({{ $user->transactions->count() }})
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
                                @forelse($user->transactions as $transaction)
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
    @endif

    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.users.send') }}" method="post">
                @csrf
                <input type="hidden" name="mount" value="{{ $total_sales - $done_orders_mount }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تسليم أرباح المشهور</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea name="notes" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="submit" value="إرسال" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
