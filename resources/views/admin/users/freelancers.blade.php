@extends('admin.layout.app')
@section('freelancers', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">المشاهير</h1>
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
                <h6 class="m-0 font-weight-bold text-primary">كل المشاهير</h6>
            @endif
            <div class="mt-3">
                <a href="{{ route('admin.users.freelancers') }}" class="btn btn-dark btn-custom mx-1">الكل</a>
                <a href="?status=approved" class="btn btn-success btn-custom mx-1">المقبولين</a>
                <a href="?status=pending" class="btn btn-primary btn-custom mx-1">قيد المراجعة</a>
                <a href="?status=rejected" class="btn btn-danger btn-custom mx-1">المرفوضين</a>
            </div>
            <div class="mt-3">
                <form action="{{ route('admin.users.freelancers') }}" method="get">
                    <div class="form-group">
                        <input type="text"
                               name="word"
                               class="form-control w-50 float-right"
                               placeholder="ابحث عن اسم أو رقم هاتف">
                        <input type="submit" class="btn btn-info mx-2" value="بحث">
                    </div>
                </form>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.users.freelancers.add') }}" class="btn btn-primary">إضافة مشهور</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>القسم</th>
                        <th>سعر الإعلان</th>
                        <th>تاريخ الإنضمام</th>
                        <th>الحالة</th>
                        <th>خيارات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                @if($user->image)
                                    <img src="{{ asset('images/users/' . $user->image) }}" width="60" height="60">
                                @else
                                    لا يوجد صورة
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->category->name }}</td>
                            <td>
                                الإعلان:
                                {{ $user->price_ad }} MRU
                                <br>
                                الإهداء:
                                {{ $user->price_gift }} MRU
                            </td>
                            <td>{{ $user->created_at->format("Y-m-d") }}</td>
                            <td>
                                @if($user->status == 1)
                                    <span class="text-success">مقبول</span>
                                @elseif($user->status == 0)
                                    <span>قيد المراجعة</span>
                                @else
                                    <span class="text-danger">مرفوض</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.freelancers.show', $user->id) }}"
                                       class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('admin.users.freelancers.edit', $user->id) }}"
                                       class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    @if(auth()->user()->role_id == 1)
                                        <a onclick="del({{ $user->id }})"
                                           data-toggle="modal"
                                           data-target="#deleteModal"
                                           class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash-alt"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="8">لايوجد مستخدمين.</td>
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
                    <strong>سيتم حذف:</strong>
                    <ul>
                        <li>بيانات المستخدم</li>
                        <li>الصورة الشخصية</li>
                        <li>الفيديوهات</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                    <form action="{{ route('admin.users.freelancers.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="0" id="modal_user_id">
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
            document.getElementById('modal_user_id').value = id
        }
    </script>
@endpush
