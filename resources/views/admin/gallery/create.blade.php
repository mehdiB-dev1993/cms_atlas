@extends('admin.layout.layout')

@section('content')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>افزودن گالری جدید</strong>
                </div>



                <div class="card-body">
                    <form action="{{ route('gallery.store') }}" id="gallery-store" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">نام :</label>
                            <div class="col-md-9">
                                <input type="text" id="text-input" name="name" class="form-control" placeholder="نام گالری">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">عنوان :</label>
                            <div class="col-md-9">
                                <input type="text" id="text-input" name="title" class="form-control" placeholder="عنوان گالری">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">توضیحات:</label>
                            <div class="col-md-9">
                                <input type="text" id="text-input" name="description" class="form-control" placeholder="توضیحات گالری">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">خلاصه متن:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="abstract" id="" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">متن کامل:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="text" id="" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">کلمات کلیدی:</label>
                            <div class="col-md-9">
                                <input value="" type="text" id="" name="keywords" class="form-control" placeholder="کلمات کلیدی">
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
                            <label class="col-md-3 form-control-label">تصاویر گالری:</label>
                            <div class="col-md-9">

                                <div id="gallery-container">
                                    <div class="gallery-item">

                                        <div class="input-group mb-3">
                                            <input name="item[]" type="file" class="form-control">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="item_alt[]" type="text" class="form-control" placeholder="متن جایگزین">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="item_description[]" type="text" class="form-control" placeholder="توضیحات">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input name="item_link[]" type="text" class="form-control" placeholder="لینک">
                                        </div>
                                        <div class="input-group mb-3">
                                            <input class="form-control" placeholder="ترتیب نمایش" type="number" min="0" value="0" name="item_order[]" >
                                        </div>

                                    </div>

                                </div>
                                <button type="button" class="btn btn-primary add">اضافه</button>

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
                                        <input class="form-check-input" type="checkbox" id="" name="status" >
                                    </label>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="card-footer">
                    <button type="ارسال" id="submit-gallery-store" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> ارسال</button>
                    <button type="بازیابی" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> بازیابی</button>
                </div>
            </div>


        </div>

        <div class="col-md-3">



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
        document.addEventListener('DOMContentLoaded', function () {
            let container = document.getElementById('gallery-container');

            // رویداد اضافه کردن آیتم جدید
            document.querySelector('.add').addEventListener('click', function () {
                let newItem = document.createElement('div');
                newItem.classList.add('gallery-item');
                newItem.innerHTML = `
  <div class="input-group mb-3">
            <input name="item[]" type="file" class="form-control">
        </div>
        <div class="input-group mb-3">
            <input name="item_alt[]" type="text" class="form-control" placeholder="متن جایگزین">
        </div>
        <div class="input-group mb-3">
            <input name="item_description[]" type="text" class="form-control" placeholder="توضیحات">
        </div>
        <div class="input-group mb-3">
            <input name="item_link[]" type="text" class="form-control" placeholder="لینک">
        </div>
           <div class="input-group mb-3">
            <input class="form-control" placeholder="ترتیب نمایش" type="number" min="0" value="0" name="item_order[]" >
          </div>
            <button type="button" class="btn btn-danger remove">حذف</button>
        `;

                container.appendChild(newItem);
            });

            // استفاده از Event Delegation برای حذف آیتم‌ها
            container.addEventListener('click', function (event) {
                if (event.target.classList.contains('remove')) {

                    event.target.closest('.gallery-item').remove();
                }
            });
        });
    </script>
@endsection
