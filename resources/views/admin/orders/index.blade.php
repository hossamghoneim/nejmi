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
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>مرسل الطلب</th>
                        <th>المشهور</th>
                        <th>نوع الطلب</th>
                        <th>قيمة الطلب</th>
                        <th>حالة الطلب</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>مرسل الطلب</th>
                        <th>المشهور</th>
                        <th>نوع الطلب</th>
                        <th>قيمة الطلب</th>
                        <th>حالة الطلب</th>
                        <th>خيارات</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <a href="#">
                                    {{ $order->user->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.users.freelancers.show', $order->freelancer->id) }}">
                                    {{ $order->freelancer->name }}
                                </a>
                            </td>
                            <td>{{ $order->order_type == 'ad' ? 'إعلان' : 'إهداء' }}</td>
                            <td>{{ $order->mount }}$</td>
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
                                    <a onclick="del({{ $order->id }})"
                                       data-toggle="modal"
                                       data-target="#deleteModal"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash-alt"></i>
                                    </a>
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

    @if($orders && $orders->count() > 0)
        {{ $orders->links() }}
    @endif


    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">هل أنت متأكد؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>في حال التأكيد لا يمكنك التراجع.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <form action="{{ route('admin.orders.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="order_id" value="0" id="modal_order_id">
                        <input type="submit" value="حذف" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        let del = function (id) {
            document.getElementById('modal_order_id').value = id
        }
    </script>
@endpush
