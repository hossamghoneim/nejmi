@extends('admin.layout.app')
@section('sliders', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الصور المتحركة</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">كل الصور</h6>
            <a href="{{ route('admin.create.sliders') }}" class="btn btn-primary btn-sm mt-3">إضافة</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>الصورة</th>
                        <th> الرابط </th>
                        <th>العنوان</th>
                        <th>الوصف</th>
                        <th>كلمة الزر</th>
                        <th> حذف </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sliders as $slider)
                        <tr>
                            <td>
                                <img src="{{ url('/images/sliders/') }}/{{ $slider->image }}" width="50">
                            </td>
                            <td>
                                {{ $slider->link }}
                            </td>
                            <td>
                                {{ $slider->header }}
                            </td>
                            <td>
                                {{ $slider->description  }}
                            </td>
                            <td>
                                {{ $slider->btn_text }}
                            </td>
                            <td>
                                <a href="{{ route('admin.destroy.sliders',$slider->id) }}" class="btn btn-danger btn-sm"> <i class="fa fa-trash-alt" ></i> </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="8">لايوجد تصنيفات.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
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
