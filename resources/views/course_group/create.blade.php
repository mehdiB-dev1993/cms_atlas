@extends('admin.layout.layout')

@section('content')

    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                    <strong>افزودن گروه بندی دوره</strong>
                </div>


                <div class="card-body">
                    <form action="{{ route('course_group.store') }}" id="course-group-store" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">انتخاب والد:</label>
                            <div class="col-md-9">
                                <select name="parent_id" class="form-select">
                                    <option value="0">گروه اصلی</option>
                                    @foreach($course_groups as $cg)
                                        @include('course_group.coursegroup-option', ['cg' => $cg, 'level' => 0,'selected' => ''])
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">عنوان:</label>
                            <div class="col-md-9">
                                <input value="" type="text" id="text-input" name="title" class="form-control" placeholder="عنوان کامل گروه بندی">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">توضیحات:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" id="" rows="3"></textarea>
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
                            <label class="col-md-3 form-control-label">وضعیت:</label>
                            <div class="col-md-9">
                                <div class="checkbox">
                                    <label for="">

                                        <input class="form-check-input" type="checkbox" id="" name="status" >
                                    </label>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
                <div class="card-footer">
                    <button type="ارسال" id="submit-course-group-store" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> ارسال</button>
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
