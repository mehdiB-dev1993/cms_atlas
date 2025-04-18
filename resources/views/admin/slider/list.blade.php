
@extends('admin.layout.layout')
{{--@dd($data)--}}
@section('content')

    <div class="row mb-5">
        <div class="col-lg-2"><a href="{{ route('slider.create') }}" class="btn btn-success">افزودن</a></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> لیست بنر ها
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>عنوان اسلایدر</th>
                            <th>بنر</th>
                            <th>لینک</th>
                            <th>وضعیت</th>
                            <th>حذف</th>
                            <th>ویرایش</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($sliders as $slider)
                            <tr>
                                <td>{{ $slider->title }}</td>
                                <td class="box-thumbnail"><img class="w-100" src="{{ asset('storage/'.$slider->banner) }}" alt=""></td>
                                <td>{{ $slider->link }}</td>
                                <td>
                                    @if($slider->status == 1)
                                        <span class="badge badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-warning">غیر فعال</span>
                                    @endif
                                </td>
                                <td><i class="bi bi-trash cursor-pointer "></i></td>
                                <td><i onclick="sliderEdit('{{ route('slider.edit',$slider->id) }}')" class="bi bi-pencil-square"></i></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>




                </div>
            </div>
        </div>
        <!--/.col-->
    </div>



@endsection

@section('custom-js')
    <button type="button" class="btn btn-primary" id="modal-slider" data-bs-toggle="modal" data-bs-target="#exampleModal" style="visibility: hidden">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش اسلایدر</h1>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('slider.update') }}" id="slider-edit" method="post" enctype="multipart/form-data" class="form-horizontal">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                    <button type="button" id="edit-btn-slider" class="btn btn-primary">ذخیره</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        function sliderEdit($url) {

         $.ajax(
                {
                    url: $url,

                }
            ).done(function (res) {
                console.log(res)

             $('#modal-slider').trigger('click')
             $('body').find('#slider-edit').empty()

             let $title = '<div class="form-group row"><label class="col-md-3 form-control-label" for="">عنوان:</label> <div class="col-md-9"><input value="'+res.title+'" type="text" id="text-input" name="title" class="form-control" placeholder="عنوان گالری"></div></div>'
             $('body').find('#slider-edit').append($title)


             let $link = '<div class="form-group row"><label class="col-md-3 form-control-label" for="">لینک:</label> <div class="col-md-9"><input value="'+res.link+'" type="text" id="text-input" name="link" class="form-control" placeholder="عنوان گالری"></div></div>'
             $('body').find('#slider-edit').append($link)

             let $thumbnail_src = '<?= asset("storage/' + res.banner + '") ?>';
             let $thumbnail = '<div class="form-group row"><label class="col-md-3 form-control-label " for="">تصویر بنر:</label><div class="col-md-9 d-flex justify-content-center align-items-center"><div class="box-thumbnail-lg position-relative"> <input onchange="preview_main(this)" name="banner" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id=""> <img class="w-100 preview-image" src="'+ $thumbnail_src +'" alt=""></div> </div></div>'
             $('body').find('#slider-edit').append($thumbnail)

             var $checked;
             (res.status === 1)? $checked = 'checked' : ''

             let $status = '<div class="form-group row"><label class="col-md-3 form-control-label">وضعیت:</label> <div class="col-md-9"> <div class="checkbox"> <label for=""> <input '+ $checked +' class="form-check-input" type="checkbox" id="" name="status" > </label> </div> </div> </div>'
             $('body').find('#slider-edit').append($status)

             $('body').find('#slider-edit').append('<input type="hidden" name="slider_id" value="'+res.id+'">')
             $('body').find('#slider-edit').append('<input type="hidden" name="_token" value="{{ csrf_token() }}" />')

         })
        }

        /**************************************************/
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
        /**************************************************/
        $('body').on('click','#edit-btn-slider',function (e)
            {
                $('#slider-edit').submit()
            }
        )
        /**************************************************/
        $('body').on('submit','#slider-edit',function (e)
            {
                e.preventDefault()
                const $form = document.getElementById('slider-edit');
                const $data = new FormData($form)

                $.ajax({
                    url : '<?= route('slider.update') ?>',
                    data : $data,
                    method : 'post',
                    dataType: 'json',
                    headers: {
                        'Accept': 'application/json'
                    },
                    processData: false,
                    contentType: false,
                }).done(function (response){
                    if(response.success)
                    {
                        alert('عملیات با موفقیت انجام شد.')
                        location.reload()

                    }
                    else
                    {
                        alert('خطا')
                    }
                    console.log(response)
                })


            }
        )
        /**************************************************/
    </script>


@endsection

