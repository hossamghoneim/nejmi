@extends('admin.layout.app')
@section('affiliates', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $affiliate->name }}</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <a href="{{ route('admin.affiliates.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للوسطاء
    </a>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                {{ $affiliate->name }}
            </h6>
            <div class="mt-3 mt-lg-0">
                <a href="javascript:void(0);"
                   data-toggle="modal"
                   data-target="#sendModal"
                   class="btn btn-success btn-sm"><i class="fa fa-dollar-sign"></i>
                    تسليم الأرباح
                </a>
{{--                <form action="{{ route('admin.affiliates.send') }}" method="post" class="d-none" id="affiliate_done_form">--}}
{{--                    @csrf--}}
{{--                    <input type="hidden" name="aff_id" value="{{ $affiliate->id }}">--}}
{{--                </form>--}}
                <a href="{{ route('admin.affiliates.edit', $affiliate->id) }}"
                   class="btn btn-primary btn-sm"><i class="fa fa-edit"></i>
                    تعديل
                </a>
                <a href="https://wa.me/{{ $affiliate->phone }}/?text={{ $whatsappMessage }}" class="btn btn-info btn-sm">
                    <i class="fab fa-whatsapp"></i>
                    إرسال إلى واتساب
                </a>
            </div>
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
                                        <a href="{{ route('admin.users.freelancers.show', $aff->target_id) }}">
                                            {{ \App\User::find($aff->target_id) ? \App\User::find($aff->target_id)->name : '' }}
                                        </a>
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
                                    <th>معاينة</th>
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
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm" href="{{ route('admin.orders.show',$order["main_order"]->id) }}">
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

    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.affiliates.send') }}" method="post">
                @csrf
                <input type="hidden" name="mount" value="{{ $total_sales - $done_orders_mount }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">تسليم أرباح الوسيط</h5>
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
                        <input type="hidden" name="affiliate_id" value="{{ $affiliate->id }}">
                        <input type="submit" value="إرسال" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
