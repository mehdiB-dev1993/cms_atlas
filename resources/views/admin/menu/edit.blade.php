@extends('admin.layout.layout')


@section('content')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>افزودن منو</strong>
                </div>


                <div class="card-body">
                    <form action="{{ route('menu.update') }}" id="menu-update" method="post"
                          enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <input type="hidden" value="{{$this_menu->id}}" name="menu_id">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">منوی والد:</label>
                            <div class="col-md-9">
                                <select name="parent_id" class="form-select">
                                    <option value="0">منوی اصلی</option>

                                    @php $selected = '' @endphp
                                    @foreach($menus as $menu)
                                        @if($menu->parent_id == $this_menu->id)
                                            @php $selected = 'selected' @endphp
                                        @endif
                                        @include('admin.menu.menu-option', ['menu' => $menu, 'level' => 0,'selected' => $selected])
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">عنوان:</label>
                            <div class="col-md-9">
                                <input value="{{$this_menu->title}}" type="text" id="text-input" name="title"
                                       class="form-control" placeholder="عنوان منو">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">توضیحات:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_menu->description }}" class="form-control" name="description"
                                       type="text" placeholder="توضیحات">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">خلاصه متن:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="abstract" id=""
                                          rows="3">{{ $this_menu->abstract }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">متن کامل:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="text" id="text"
                                          rows="6">{{ $this_menu->text }}</textarea>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">کلمات کلیدی:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_menu->keywords }}" class="form-control" name="keywords"
                                       type="text" placeholder="کلمات کلیدی">
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

                                    <input onchange="preview_main(this)" name="icon" type="file"
                                           class="form-control position-absolute h-100"
                                           style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$this_menu->icon) }}"
                                         alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label " for="">تصویر بند انگشتی:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">
                                    <input onchange="preview_main(this)" name="thumbnail" type="file"
                                           class="form-control position-absolute h-100"
                                           style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$this_menu->thumbnail) }}"
                                         alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تصویر هدر:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">
                                    <input onchange="preview_main(this)" name="header_image" type="file"
                                           class="form-control position-absolute h-100"
                                           style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image"
                                         src="{{ asset('storage/'.$this_menu->header_image) }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">ترتیب نمایش:</label>
                            <div class="col-md-9">
                                <div class="input-group">

                                    <input class="form-control" type="number" min="0" value="{{ $this_menu->order }}"
                                           name="order">

                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">وضعیت:</label>
                            <div class="col-md-9">
                                <div class="checkbox">
                                    @php $checked = '' @endphp
                                    @if($this_menu->status == 1)
                                        @php $checked = 'checked' @endphp
                                    @endif
                                    <input {{ $checked }} class="form-check-input" type="checkbox" id="" name="status">

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <button type="ارسال" id="submit-menu-update" class="btn btn-sm btn-primary"><i
                                class="fa fa-dot-circle-o"></i> ارسال
                    </button>
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


