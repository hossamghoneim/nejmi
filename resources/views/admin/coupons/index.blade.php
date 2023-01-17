@extends('admin.layout.app')
@section('coupons', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الكوبونات</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">كل الكوبونات</h6>
            <a href="{{ route('admin.coupons.add') }}" class="btn btn-primary btn-sm mt-3">إضافة</a>
            @if(request()->word)
                <div class="mt-3">
                    <a href="{{ route('admin.coupons.index') }}" class="btn btn-dark btn-custom mx-1">الكل</a>
                </div>
            @endif
            <div class="mt-3">
                <form action="{{ route('admin.coupons.index') }}" method="get">
                    <div class="form-group">
                        <input type="text" name="word" class="form-control w-50 float-right" placeholder="بحث...">
                        <input type="submit" class="btn btn-info mx-2" value="بحث">
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>الكوبون</th>
                        <th>نسبة الحسم</th>
                        <th>تاريخ إنتهاء الصلاحية</th>
                        <th>مرات الاستخدام</th>
                        <th>تاريخ الإضافة</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->coupon }}</td>
                            <td>{{ $coupon->discount }}%</td>
                            <td>{{ $coupon->expire_date ? $coupon->expire_date : 'غير محدد' }}</td>
                            <td>{{ $coupon->used_times }}</td>
                            <td>{{ $coupon->created_at->format("Y-m-d") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a onclick="del({{ $coupon->id }})"
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
                            <td colspan="8">لايوجد كوبونات.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($coupons && $coupons->count() > 0)
        {{ $coupons->links() }}
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
                    <form action="{{ route('admin.coupons.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="coupon_id" value="0" id="modal_order_id">
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
