@extends('admin.layout.layout')


@section('content')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>افزودن دوره</strong>
                </div>



                <div class="card-body">
                    <form action="{{ route('course.store') }}" id="course-store" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf



                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">انتخاب گروهبندی:</label>
                            <div class="col-md-9">
                                <select name="cg_id" class="form-select">
                                    @foreach($course_groups as $cg)
                                        @include('course_group.coursegroup-option', ['cg' => $cg, 'level' => 0,'selected' => ''])
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">عنوان کامل دوره:</label>
                            <div class="col-md-9">
                                <input value="{{ old('title') }}" type="text" id="text-input" name="title" class="form-control" placeholder="عنوان کامل دوره">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">خلاصه متن:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="text" id="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">متن کامل:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="full_text" id="" rows="6"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">توضیحات:</label>
                            <div class="col-md-9">
                                <input value="" class="form-control" name="description" type="text" placeholder="توضیحات" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">کلمات کلیدی:</label>
                            <div class="col-md-9">
                                <input value="" type="text" id="" name="keywords" class="form-control" placeholder="کلمات کلیدی">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">لینک منبع:</label>
                            <div class="col-md-9">
                                <input value="" type="text" id="" name="source" class="form-control" placeholder="لینک منبع">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تاریخ:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input value="" type="text" data-jdp name="date" class="form-control" id="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">آیکون:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input type="file" name="icon" class="form-control" id="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تصویر بند انگشتی:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input name="thumbnail" type="file" class="form-control" id="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تصویر هدر:</label>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <input name="header_image" type="file" class="form-control" id="">
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
                            <label class="col-md-3 form-control-label" for="">قیمت:</label>
                            <div class="col-md-9">
                                <input value="" type="text" id="text-input" name="price" class="form-control" placeholder="قیمت (تومان)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">مدت زمان:</label>
                            <div class="col-md-9">
                                <input value="" type="text" id="text-input" name="duration" class="form-control" placeholder="مدت زمان">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">مدرس:</label>
                            <div class="col-md-9">
                                <input value="" type="text" id="text-input" name="teacher" class="form-control" placeholder="مدرس">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">لینک:</label>
                            <div class="col-md-9">
                                <input value="" type="text" id="text-input" name="link" class="form-control" placeholder="www.example.com">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">ترتیب نمایش:</label>
                            <div class="col-md-9">
                                <div class="input-group">

                                    <input class="form-control" type="number" min="0" value="0" name="order" >

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">وضعیت:</label>
                            <div class="col-md-9">
                                <div class="checkbox">
                                    <label for="">
                                        <input class="form-check-input" value="" type="checkbox" id="" name="status" >
                                    </label>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="card-footer">
                    <button type="ارسال" id="submit-course-store" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> ارسال</button>

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
