@extends('admin.layout.app')
@section('users', 'active')
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
            <h6 class="m-0 font-weight-bold text-primary">كل المستخدمين</h6>
            @if(request()->word)
                <div class="mt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-dark btn-custom mx-1">الكل</a>
                </div>
            @endif
            <div class="mt-3">
                <form action="{{ route('admin.users.index') }}" method="get">
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
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>الهاتف</th>
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
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                       class="btn btn-success btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
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
