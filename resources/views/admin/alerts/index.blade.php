@extends('admin.layout.app')
@section('alerts', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">التنبيهات</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">التنبيهات</h6>
            <div class="mt-3">
                <h6>ترتيب حسب:</h6>
                <a href="{{ route('admin.alerts.index') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-clock ml-1"></i>
                    الأحدث (تاريخ الإضافة)
                </a>
                <a href="?sort=date" class="btn btn-primary btn-sm">
                    <i class="fa fa-calendar-alt ml-1"></i>
                    الأقرب (تاريخ الحدث)
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>المستخدم</th>
                        <th>الحدث</th>
                        <th>تاريخ الحدث</th>
                        <th>المتبقي</th>
                        <th>تاريخ الإضافة</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($alerts as $alert)
                        <tr>
                            <td>
                                <a href="{{ route('admin.users.show', $alert->user->id) }}">{{ $alert->user->name }}</a>
                            </td>
                            <td>{{ $alert->event }}</td>
                            <td>{{ $alert->date }}</td>
                            <td>
                                @if($alert->rest >= 0)
                                    <div class="badge badge-primary p-2" style="font-size: 14px;">
                                        ({{ $alert->rest }}) يوم
                                    </div>
                                @else
                                    <div class="badge badge-danger p-2" style="font-size: 14px;">انتهى الحدث</div>
                                @endif
                            </td>
                            <td>{{ $alert->created_at->format("Y-m-d") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.alerts.send', $alert->id) }}"
                                       title="إرسال تنبيه"
                                       class="btn btn-primary btn-sm">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a onclick="del({{ $alert->id }})"
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
                            <td colspan="8">لايوجد تنبيهات.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($alerts && $alerts->count() > 0)
        {{ $alerts->links() }}
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
                    <form action="{{ route('admin.alerts.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="0" id="modal_order_id">
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
