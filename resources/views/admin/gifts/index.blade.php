@extends('admin.layout.app')
@section('gifts', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الإهداء</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">الإهداء</h6>
            <a href="{{ route('admin.gifts.add') }}" class="btn btn-primary btn-sm mt-3">إضافة</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>الإهداء</th>
                        <th>تاريخ الإضافة</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($gifts as $gift)
                        <tr>
                            <td>{{ $gift->name }}</td>
                            <td>{{ $gift->created_at->format("Y-m-d") }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.gifts.edit', $gift->id) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a onclick="del({{ $gift->id }})"
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
                            <td colspan="8">لايوجد إهداء.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($gifts && $gifts->count() > 0)
        {{ $gifts->links() }}
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
                    <form action="{{ route('admin.gifts.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="gift_id" value="0" id="modal_order_id">
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
