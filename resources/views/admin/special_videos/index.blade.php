@extends('admin.layout.app')
@section('special_videos', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">فيديوهات مختارة</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">فيديوهات مختارة</h6>
            <button type="button"
                    data-toggle="modal"
                    data-target="#addModal"
                    class="btn btn-primary btn-sm mt-3">إضافة</button>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($videos as $video)
                    <div class="col-12 col-md-4 mt-3">
                        <video src="{{ asset('special-videos/' . $video->video) }}" class="w-100" height="auto" controls>
                            <source src="{{ asset('special-videos/' . $video->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="text-center">
                            <h5 class="my-2">{{ $video->video_type == 1 ? 'فيديوهات مختارة' : 'ردة فعل' }}</h5>
                            <button type="button"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                    class="btn btn-danger btn-sm"
                                    onclick="del({{ $video->id }})">
                                <i class="fa fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-12 col-md-4">
                        <p>لا يوجد فيديوهات.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @if($videos && $videos->count() > 0)
        {{ $videos->links() }}
    @endif

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.special_videos.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة فيديو جديد</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" name="video" id="video" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>نوع الفيديو</label>
                            <select name="video_type" class="form-control">
                                <option value="1">فيديوهات مختارة</option>
                                <option value="2">ردة فعل</option>
                            </select>
                        </div>
                        <div class="alert alert-warning" style="display: none" id="sizeMsg">الحد الأقصى المسموح به هو 2 ميغا بايت.</div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
                        <button class="btn btn-success" type="submit" id="addBtn">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                    <form action="{{ route('admin.special_videos.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="video_id" value="0" id="modal_video_id">
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
            document.getElementById('modal_video_id').value = id
        }

        $('#video').on('change', function () {
            $('#sizeMsg').hide();
            $('#addBtn').show();
            if($(this)[0].files[0].size > 2762430) {
                $('#sizeMsg').show();
                $('#addBtn').hide();
            }
        })

    </script>
@endpush
