@extends('admin.layout.app')
@section('pages', 'active')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">تعديل صفحة</h1>
    </div>

    <a href="{{ route('admin.pages.index') }}"
       class="d-sm-inline-block btn btn-sm btn-primary shadow-sm mb-4">
        <i class="fas fa-angle-right fa-sm text-white-50"></i>
        عودة للصفحات
    </a>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between ">
            <h6 class="m-0 font-weight-bold text-primary">
                تعديل صفحة
            </h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pages.update') }}" method="post">
                @csrf
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <input type="hidden" name="page_id" value="{{ $page->id }}">
                <div class="form-group">
                    <label>اسم الصفحة (العربي)</label>
                    <input type="text"
                           class="form-control"
                           name="name"
                           value="{{ $page->name }}"
                           required>
                </div>
                <div class="form-group">
                    <label>اسم الصفحة (الفرنسي)</label>
                    <input type="text"
                           class="form-control"
                           name="name_fr"
                           value="{{ $page->name_fr }}"
                           required>
                </div>
                <div class="form-group">
                    <label>محتوى الصفحة (العربي)</label>
                    <textarea
                        class="form-control"
                        name="body"
                        id="summernote"
                        cols="30"
                        rows="10"
                        required>{{ $page->body }}</textarea>
                </div>
                <div class="form-group">
                    <label>محتوى الصفحة (الفرنسي)</label>
                    <textarea
                        class="form-control"
                        name="body_fr"
                        id="summernote2"
                        cols="30"
                        rows="10"
                        required>{{ $page->body_fr }}</textarea>
                </div>
                <div class="form-group">
                    <label>الرابط (Slug)</label>
                    <input
                        type="text"
                        class="form-control"
                        name="slug"
                        value="{{ $page->slug }}"
                        disabled
                        required>
                </div>
                <div class="form-group">
                    <input type="submit" value="حفظ" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>

@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 350
            });
            $('#summernote2').summernote({
                height: 350
            });
        });
    </script>
@endpush
