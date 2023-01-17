@extends('admin.layout.app')
@section('settings', 'active')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">الإعدادات</h1>
    </div>

    @if(session()->get('msg'))
        <p class="alert alert-success">{{ session()->get('msg') }}</p>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">الإعدادات</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="logo">الشعار</label>
                    <input type="file" id="logo" name="logo" class="form-control" value="{{ $settings->logo }}">
                </div>
                <div class="form-group">
                    <label for="description">وصف الموقع (العربي)</label>
                    <textarea class="form-control"
                              name="description"
                              id="description"
                              cols="30"
                              rows="10">{{ $settings->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="description_fr">وصف الموقع (الفرنسي)</label>
                    <textarea class="form-control"
                              name="description_fr"
                              id="description_fr"
                              cols="30"
                              rows="10">{{ $settings->description_fr }}</textarea>
                </div>
                <div class="form-group">
                    <label for="keywords">الكلمات المفتاحية (العربي)</label>
                    <input type="text" class="form-control"
                           name="keywords"
                           id="keywords"
                           value="{{ $settings->keywords }}">
                </div>
                <div class="form-group">
                    <label for="keywords_fr">الكلمات المفتاحية (الفرنسي)</label>
                    <input type="text" class="form-control"
                           name="keywords_fr"
                           id="keywords_fr"
                           value="{{ $settings->keywords_fr }}">
                </div>
                <div class="form-group">
                    <label for="commission">العمولة (%)</label>
                    <input
                        type="text"
                        class="form-control"
                        name="commission"
                        id="commission"
                        value="{{ $settings->commission }}">
                </div>
                <div class="form-group">
                    <label for="price_filter">فلتر الأسعار (افصل بين الأرقام بفاصلة ,)</label>
                    <input
                        type="text"
                        class="form-control"
                        name="price_filter"
                        id="price_filter"
                        placeholder="ex: 200,100,50"
                        value="{{ $settings->price_filter }}">
                </div>
                <div class="form-group">
                    <label for="logo">صورة التبرع</label>
                    <input type="file" id="donation_image" name="donation_image" class="form-control" value="{{ $settings->donation_image }}">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="حفظ">
                </div>
            </form>
        </div>
    </div>

@endsection
