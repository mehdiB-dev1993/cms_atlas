@extends('admin.layout.layout')
{{--@dd($gallery)--}}
@section('content')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>ویرایش گالری</strong>
                </div>



                <div class="card-body">
                    <form action="{{ route('gallery.update') }}" id="gallery-update" method="post" enctype="multipart/form-data" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">نام :</label>
                            <div class="col-md-9">
                                <input value="{{ $gallery->name }}" type="text" id="text-input" name="name" class="form-control" placeholder="نام گالری">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">عنوان :</label>
                            <div class="col-md-9">
                                <input value="{{ $gallery->title }}" type="text" id="text-input" name="title" class="form-control" placeholder="عنوان گالری">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">توضیحات:</label>
                            <div class="col-md-9">
                                <input value="{{ $gallery->description }}" type="text" id="text-input" name="description" class="form-control" placeholder="توضیحات گالری">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">خلاصه متن:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="abstract" id="" rows="3">{{ $gallery->abstract }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">متن کامل:</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="text" id="" rows="6">
                                    {{ $gallery->text }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">کلمات کلیدی:</label>
                            <div class="col-md-9">
                                <input value="{{ $gallery->keywords }}" type="text" id="" name="keywords" class="form-control" placeholder="کلمات کلیدی">
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
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$gallery->icon) }}" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label " for="">تصویر بند انگشتی:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">
                                    <input onchange="preview_main(this)" name="thumbnail" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$gallery->thumbnail) }}" alt="">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="">تصویر هدر:</label>
                            <div class="col-md-9 d-flex justify-content-center align-items-center">
                                <div class="box-thumbnail-lg position-relative">
                                    <input onchange="preview_main(this)" name="header_image" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$gallery->header_image) }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">ترتیب نمایش:</label>
                            <div class="col-md-9">
                                <div class="input-group">

                                    <input class="form-control" type="number" min="0" value="{{ $gallery->order }}" name="order" >

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">وضعیت:</label>
                            <div class="col-md-9">
                                <div class="checkbox">

                                    @php $checked = '' @endphp
                                    @if($gallery->status == 1)
                                        @php $checked = 'checked' @endphp
                                    @endif
                                    <label for="">
                                        <input {{ $checked }} class="form-check-input" type="checkbox" id="" name="status" >
                                    </label>
                                </div>
                            </div>
                        </div>



                        <hr>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label">تصاویر گالری:</label>
                            <div class="col-md-9">

                                <div id="gallery-container">


                        @foreach($gallery->galleryItems as $gi)
                                        <div class="gallery-item">
                                            <div class="input-group mb-3">
                                                <div class="box-thumbnail-lg position-relative">
                                                    <input onchange="preview_main(this)" name="item[{{$gi->id}}][src][]" value="" type="file" class="form-control position-absolute h-100 w-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id="">
                                                    <img class="w-100 preview-image" src="{{ asset('storage/'.$gi->src) }}" alt="">
                                                </div>
                                            </div>

                                            <div class="input-group mb-3">
                                                <input name="item[{{$gi->id}}][alt][]" value="{{ $gi->alt }}" type="text" class="form-control" placeholder="متن جایگزین">
                                            </div>

                                            <div class="input-group mb-3">
                                                <input name="item[{{$gi->id}}][description][]" value="{{ $gi->description }}" type="text" class="form-control" placeholder="توضیحات">
                                            </div>

                                            <div class="input-group mb-3">
                                                <input name="item[{{$gi->id}}][link][]" value="{{ $gi->link }}" type="text" class="form-control" placeholder="لینک">
                                            </div>


                                            <div class="input-group mb-3">
                                                <input class="form-control" placeholder="ترتیب نمایش" type="number" min="0" value="{{ $gi->order }}" name="item[{{$gi->id}}][order][]" >
                                            </div>
                                            <button data-gid= "{{ $gallery->id }}" data-id="{{ $gi->id }}" type="button" class="btn btn-danger remove-item">حذف</button>

                                        </div>


                        @endforeach

                                </div>
                                <button type="button" class="btn btn-primary add">اضافه</button>
                            </div>

                        </div>

                        <hr>



                    </form>
                </div>
                <div class="card-footer">
                    <button type="ارسال" id="submit-gallery-update" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> ارسال</button>

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
                <input name="item_src[]" type="file" class="form-control">
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
                <input class="form-control" placeholder="ترتیب نمایش" type="number" min="0" value="0" name="item_order[]">
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


        $('body').on('click','.remove-item',function (e)
        {
            let $this = $(this)
            let $id = $this.attr('data-id')
            let $gid = $this.attr('data-gid')

            $.ajax(
                {
                    url : '{{route('gallery.delete',':id')}}'.replace(':id',$id),
                    data : { id : $id, gid: $gid}

                }
            ).done(function (response)
            {
                if(response.status === 200)
                {
                    alert('آیتم مورد نظر با موفقیت حذف گردید.')
                    $this.parents('.gallery-item').remove()
                    //event.target.closest('.gallery-item').remove();
                    //location.reload()
                }
                console.log(response.error)

            })
        }
        )

    </script>
@endsection
