@extends('admin.layout.layout')

@section('content')

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">





                    <strong>ویرایش صفحه</strong>
                </div>



                <div class="card-body">
                    <form action="{{ route('page.update') }}" id="page-update" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">انتخاب منو</label>
                            <div class="col-md-9">
                                <select name="menu_id" class="form-select">
                                    @foreach($menus as $menu)
                                        @include('menu.menu-option', ['menu' => $menu, 'level' => 0,'selected' => ''])
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="page_id" value="{{ $page->id }}">


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">عنوان کامل صفحه:</label>
                            <div class="col-md-9">
                                <input value="{{ $page->title }}" type="text" id="text-input" name="title" class="form-control" placeholder="عنوان کامل صفحه">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">عنوان صفحه در منو: </label>
                            <div class="col-md-9">
                                <input value="{{ $page->title_in_menu }}" type="text" id="text-input" name="title_in_menu" class="form-control" placeholder="عنوان صفحه در منو">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">خلاصه متن:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="text" id="" rows="3">{{ $page->text }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">متن کامل:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="full_text" id="" rows="6">{{ $page->full_text }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">توضیحات:</label>
                            <div class="col-md-9">
                                <input value="{{ $page->description }}" class="form-control" name="description" type="text" placeholder="توضیحات" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">کلمات کلیدی:</label>
                            <div class="col-md-9">
                                <input value="{{ $page->keywords }}" type="text" id="" name="keywords" class="form-control" placeholder="کلمات کلیدی">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">لینک منبع:</label>
                            <div class="col-md-9">
                                <input value="{{ $page->source }}" type="text" id="" name="source" class="form-control" placeholder="لینک منبع">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تاریخ:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input value="{{ $page->date }}" type="text" data-jdp name="date" class="form-control" id="">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="alert alert-warning text-center" role="alert">
                            <span class="help">جهت بارگذاری فایل تصویر جدید، در هرکدام از فیلد های زیر روی تصویر کلیک کنید.</span>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label " for="">آیکون:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">

                                    <input onchange="preview_main(this)" name="icon" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$page->icon) }}" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label " for="">تصویر بند انگشتی:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">
                                    <input onchange="preview_main(this)" name="thumbnail" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$page->thumbnail) }}" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تصویر هدر:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">
                                    <input onchange="preview_main(this)" name="header_image" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$page->header_image) }}" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">انتخاب گالری:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <select name="gallery_id" class="form-select">
                                        <option value="0">انتخاب کنید</option>
                                        @foreach($galleries as $gallery)
                                            <option value="{{ $gallery->id }}">{{ $gallery->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">وضعیت:</label>
                            <div class="col-md-9">
                                <div class="checkbox">
                                    <label for="">

                                        @php $selected = '' @endphp
                                        @if($page->status == 1)
                                            @php $selected = 'checked' @endphp
                                        @endif

                                        <input {{ $selected }} class="form-check-input" type="checkbox" id="" name="status" >
                                    </label>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="card-footer">
                    <button type="ارسال" id="submit-page-update" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> ارسال</button>
                    <button type="بازیابی" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> بازیابی</button>
                </div>
            </div>


        </div>

        <div class="col-md-4">



            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif



            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif




            @if($errors->any())

                @foreach($errors->all() as $er)
                    <div class="alert alert-danger" role="alert">
                        {{ $er }}
                    </div>
                @endforeach

            @endif
        </div>

        <!--/.col-->
    </div>


@endsection




