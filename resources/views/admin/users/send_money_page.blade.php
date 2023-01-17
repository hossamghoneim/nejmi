@extends('admin.layout.app')
@section('send_money_page', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">محاسبة المشاهير</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">محاسبة المشاهير</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>المشهور</th>
                        <th>الأرباح المعلقة</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order["user"]->name }}</td>
                            <td>{{ $order["mount"] }} MRU</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a onclick="del({{ $order["mount"] }},{{ $order["user"]->id }})"
                                       data-toggle="modal"
                                       data-target="#sendModal"
                                       class="btn btn-success btn-sm">
                                        تسليم
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="8">لايوجد مستحقات للمشاهير.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

{{--    @if($orders && $orders->count() > 0)--}}
{{--        {{ $orders->links() }}--}}
{{--    @endif--}}

    <div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.users.send') }}" method="post">
                @csrf
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
                        <input type="hidden" name="mount" value="0" id="mount">
                        <input type="hidden" name="user_id" value="0" id="user_id">
                        <input type="submit" value="إرسال" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('script')
    <script>
        let del = function (mount, user_id) {
            document.getElementById('mount').value = mount
            document.getElementById('user_id').value = user_id
        }
    </script>
@endpush
