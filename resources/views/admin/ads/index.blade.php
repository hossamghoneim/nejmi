@extends('admin.layout.app')
@section('settings', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الإعلانات</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">الإعلانات</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.ads.save') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="header_code">الهيدر</label>
                    <textarea class="form-control"
                              name="header_code"
                              id="header_code"
                              cols="30"
                              rows="10">{{ $ads->header_code }}</textarea>
                </div>
                <div class="form-group">
                    <label for="slide_code">السلايد</label>
                    <textarea class="form-control"
                              name="slide_code"
                              id="slide_code"
                              cols="30"
                              rows="10">{{ $ads->slide_code }}</textarea>
                </div>
                <div class="form-group">
                    <label for="center_code">وسط الموقع</label>
                    <textarea class="form-control"
                              name="center_code"
                              id="center_code"
                              cols="30"
                              rows="10">{{ $ads->center_code }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="حفظ">
                </div>
            </form>
        </div>
    </div>

@endsection
