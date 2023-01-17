@extends('admin.layout.app')
@section('featured_users', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">مشاهير مميزون</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">مشاهير مميزون</h6>
            <a href="{{ route('admin.featured_users.add') }}" class="btn btn-primary btn-sm mt-3">إضافة</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>المشهور</th>
                        <th>تاريخ الإضافة</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->user->name }}</td>
                            <td>{{ $user->created_at->format("Y-m-d") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a onclick="del({{ $user->id }})"
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
                            <td colspan="8">لايوجد مشاهير مميزين.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($users && $users->count() > 0)
        {{ $users->links() }}
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
                    <form action="{{ route('admin.featured_users.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="0" id="modal_order_id">
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
