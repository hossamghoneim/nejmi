@extends('admin.layout.app')
@section('transactions', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">سجل الدفع</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">سجل الدفع</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>المشهور</th>
                        <th>رقم الطلب</th>
                        <th>قيمة الطلب</th>
                        <th>ملاحظات</th>
                        <th>تاريخ الإضافة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($transactions as $transaction)
                        <tr>
                            <td>
                                <a href="{{ route('admin.users.freelancers.show', $transaction->user->id) }}">{{ $transaction->user->name }}</a>
                            </td>
                            <td>{{ $transaction->order_id }}</td>
                            <td>{{ $transaction->mount }} MRU</td>
                            <td>{{ $transaction->notes ?? "-" }}</td>
                            <td>{{ $transaction->created_at->format("Y-m-d") }}</td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="8">لايوجد دفعات.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if($transactions && $transactions->count() > 0)
        {{ $transactions->links() }}
    @endif

@endsection
