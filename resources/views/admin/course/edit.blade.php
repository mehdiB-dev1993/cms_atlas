@extends('admin.layout.layout')

{{--@dd($this_course)--}}
@section('content')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>ویرایش دوره</strong>
                </div>



                <div class="card-body">
                    <form action="{{ route('course.update') }}" id="course-update" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf

                        <input type="hidden" name="course_id" value="{{ $this_course->id }}">

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">انتخاب گروهبندی:</label>
                            <div class="col-md-9">
                                <select name="cg_id" class="form-select">
                                    @foreach($course_groups as $cg)
                                        @php $selected = ''  @endphp
                                    @if($cg->id == $this_course->id)
                                        @php $selected = 'selected' @endphp
                                    @endif

                                        @include('admin.course_group.coursegroup-option', ['cg' => $cg, 'level' => 0,'selected' => $selected])
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">نام:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->name }}" type="text" id="text-input" name="name" class="form-control" placeholder="نام کامل دوره">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">عنوان:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->title }}" type="text" id="text-input" name="title" class="form-control" placeholder="عنوان کامل دوره">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">خلاصه متن:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="abstract" id="" rows="3">{{ $this_course->abstract }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">متن کامل:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="text" id="" rows="6">{{ $this_course->text }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">توضیحات:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->description }}" class="form-control" name="description" type="text" placeholder="توضیحات" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">کلمات کلیدی:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->keywords }}" type="text" id="" name="keywords" class="form-control" placeholder="کلمات کلیدی">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">لینک منبع:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->source_link }}" type="text" id="" name="source_link" class="form-control" placeholder="لینک منبع">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تاریخ:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input value="{{ $this_course->published_at }}" type="text" data-jdp name="published_at" class="form-control" id="">
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning text-center" role="alert">
                            <span class="help">جهت بارگذاری فایل تصویر جدید، در هرکدام از فیلد های زیر روی تصویر کلیک کنید.</span>
                        </div>
                        <hr>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label " for="">آیکون:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">

                                    <input onchange="preview_main(this)" name="icon" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$this_course->icon) }}" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label " for="">تصویر بند انگشتی:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">
                                    <input onchange="preview_main(this)" name="thumbnail" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$this_course->thumbnail) }}" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تصویر هدر:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">
                                    <input onchange="preview_main(this)" name="header_image" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$this_course->header_image) }}" alt="">
                                </div>
                            </div>
                        </div>
{{--                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">فایل ضمیمه:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input name="attached_file" type="file" class="form-control" id="">
                                </div>
                            </div>
                        </div>
                        --}}


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">انتخاب گالری:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <select name="gallery_id" class="form-select">
                                        <option value="0">انتخاب کنید</option>
                                        @foreach($galleries as $gallery)

                                            @php $selected = ''  @endphp
                                            @if($gallery->id == $this_course->gallery_id)
                                                @php $selected = 'selected' @endphp
                                            @endif

                                            <option {{ $selected }} value="{{ $gallery->id }}">{{ $gallery->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">قیمت:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->price }}" type="text" id="text-input" name="price" class="form-control" placeholder="قیمت (تومان)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تخفیف:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->discount }}" type="text" id="text-input" name="discount" class="form-control" placeholder="تخفیف (تومان)">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تاریخ شروع:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input value="{{ $this_course->start_date }}" type="text" data-jdp name="start_date" class="form-control" id="" placeholder="تاریخ شروع دوره">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">مدت زمان:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->duration }}" type="text" id="text-input" name="duration" class="form-control" placeholder="مدت زمان">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">مدرس:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->teacher }}" type="text" id="text-input" name="teacher" class="form-control" placeholder="مدرس">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">لینک:</label>
                            <div class="col-md-9">
                                <input value="{{ $this_course->link }}" type="text" id="text-input" name="link" class="form-control" placeholder="www.example.com">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">ترتیب نمایش:</label>
                            <div class="col-md-9">
                                <div class="input-group">

                                    <input class="form-control"  type="number" min="0" value="{{ $this_course->order }}" name="order" >

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">وضعیت:</label>
                            <div class="col-md-9">
                                <div class="checkbox">
                                    <label for="">
                                        @php $checked = '' @endphp
                                        @if( $this_course->status == 1 )
                                            @php $checked = 'checked' @endphp
                                        @endif

                                        <input {{ $checked }} class="form-check-input" type="checkbox" id="" name="status" >
                                    </label>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="card-footer">
                    <button type="ارسال" id="submit-course-update" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> ارسال</button>
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


@section('custom-js')
    <script>
        function preview_main(tag)
        {
            var file = tag.files[0];

            var reader = new FileReader();


            if (file && file.type.startsWith('image')) {
                reader.onload = function(e) {
                    var previewImage = $(tag).parents('.box-thumbnail-lg').find('.preview-image');

                    previewImage.attr('src', e.target.result);
                    previewImage.show();
                };
            }
            reader.readAsDataURL(file);
            $(tag).parents('tr').find('.help').remove()
            console.log(file)
        }
    </script>
@endsection
