@extends('admin.layout.layout')
{{--@dd($data)--}}
@section('content')

    <div class="row mb-5">
        <div class="col-lg-2"><a href="{{ route('gallery.create') }}" class="btn btn-success">افزودن</a></div>
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
                    <i class="fa fa-align-justify"></i> لیست گالری
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>عنوان گالری</th>
                            <th>توضیحات</th>
                            <th>تصویر بند انگشتی</th>
                            <th>وضعیت</th>
                            <th>حذف</th>
                            <th>ویرایش</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $gallery)
                        <tr>
                            <td>{{ $gallery->title }}</td>
                            <td>{{ $gallery->description }}</td>
                            <td class="box-thumbnail"><img class="w-100" src="{{ asset('storage/'. $gallery->thumbnail )}}" alt=""></td>
                            <td>
                                @if($gallery->status == 1)
                                    <span class="badge badge-success">فعال</span>
                                @else
                                    <span class="badge badge-warning">غیر فعال</span>
                                @endif
                            </td>
                            <td><i class="bi bi-trash cursor-pointer "></i></td>
                            <td><i onclick="GalleryEdit('{{ route('gallery.edit',$gallery->id) }}')" class="bi bi-pencil-square"></i></td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                    {{ $data->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
        <!--/.col-->
    </div>



@endsection

@section('custom-js')

     <button type="button" class="btn btn-primary" id="modal-gallery" data-bs-toggle="modal" data-bs-target="#exampleModal" style="visibility: hidden">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">ویرایش گالری</h1>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="gallery-edit" method="post" enctype="multipart/form-data" class="form-horizontal">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لغو</button>
                    <button type="button" id="edit-btn-gallery" class="btn btn-primary">ذخیره</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        /**************************************************/
        function GalleryEdit($url)
        {
            $.ajax(
                {
                    url : $url,

                }
            ).done(function (res)
                {
                    console.log(res)
                    $('#modal-gallery').trigger('click')
                    $('body').find('#gallery-edit').empty()

                    let $title = '<div class="form-group row"><label class="col-md-3 form-control-label" for="">عنوان:</label> <div class="col-md-9"><input value="'+res.title+'" type="text" id="text-input" name="title" class="form-control" placeholder="عنوان گالری"></div></div>'
                    $('body').find('#gallery-edit').append($title)

                    let $description = '<div class="form-group row"> <label class="col-md-3 form-control-label" for="">توضیحات:</label> <div class="col-md-9"> <input value="'+res.description+'" type="text" id="text-input" name="description" class="form-control" placeholder="توضیحات"> </div> </div>'
                    $('body').find('#gallery-edit').append($description)

                    let $thumbnail_src = '<?= asset("storage/' + res.thumbnail + '") ?>';
                    let $thumbnail = '<div class="form-group row"><label class="col-md-3 form-control-label " for="">تصویر بند انگشتی:</label><div class="col-md-9 d-flex justify-content-center align-items-center"><div class="box-thumbnail-lg position-relative"> <input onchange="preview_main(this)" name="thumbnail" type="file" class="form-control position-absolute h-100" style="left: 0;top: 0;cursor: pointer;opacity: 0" id=""> <img class="w-100 preview-image" src="'+ $thumbnail_src +'" alt=""></div> </div></div>'
                    $('body').find('#gallery-edit').append($thumbnail)

                    $('body').find('#gallery-edit').append('<hr><input type="hidden" name="gallery_id" value="'+res.id+'">')
                    $('body').find('#gallery-edit').append('<input type="hidden" name="_token" value="{{ csrf_token() }}" />')
                    //-------------
                    let $items = res.gallery_items;


                    let $tag_items = '<table class="table table-hover"><thead><th>آیتم</th><th>متن جایگذین</th><th>لینک</th><th>حذف</th></thead><tbody>'
                    $items.forEach(function (value,index)
                        {
                            let $item_src = '<?= asset("storage/' + value.src + '") ?>';

                            $tag_items += '<tr data-number="'+index+'">'
                            $tag_items += '<td class="box-thumbnail position-relative"><input type="hidden" name="item_'+index+'[id]" value="'+ value.id +'"><img class="preview-img" src="'+$item_src+'" alt="Image preview" style="max-width: 100%;"><input name="item_'+index+'[src]" onchange="preview(this)" class="w-100 position-absolute h-100 " style="left: 0;top: 0;opacity: 0" type="file" ></td>'
                            $tag_items += '<td><input class="form-control" name="item_'+index+'[alt]" type="text" value="'+ value.alt +'"></td>'
                            $tag_items += '<td><input class="form-control" name="item_'+index+'[link]" type="text" value=" '+ value.link +' "></td>'
                            $tag_items += '<td><i onclick="drop(this)" class="bi bi-trash cursor-pointer "></i></td>'
                            $tag_items += '</tr>'

                        }
                    )
                    $tag_items += '</tbody></table>'
                    $('body').find('#gallery-edit').append($tag_items)


                    console.log($items)
                    $('body').find('#gallery-edit').append('<hr><i onclick="plus(this)" class="bi bi-plus-square-fill plus"></i>')


                }
            )
        }
        /**************************************************/
        function plus(tag) {



              const $tmp =  '<tr>' +
                '<td class="box-thumbnail position-relative" style="cursor: pointer"><span class="help">کلیک کن</span><img class="preview-img" src="" alt="Image preview" style="max-width: 100%; display: none;"><input onchange="preview(this)" class="w-100 position-absolute h-100 " style="left: 0;top: 0;opacity: 0" type="file" name="items_src[]"></td>' +
                '<td><input class="form-control" type="text" name="item_alt[]"></td>' +
                '<td><input class="form-control" type="text" name="item_link[]""></td>' +
                '<td><i onclick="drop(this)" class="bi bi-trash cursor-pointer"></i></td>' +
                '</tr>'

            $('body').find('#gallery-edit table tbody').append($tmp)

        }
        /**************************************************/
        function drop(tag)
        {
            $(tag).parents('tr').remove()
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
        function preview(tag)
        {
            var file = tag.files[0];

            var reader = new FileReader();


            if (file && file.type.startsWith('image')) {
                reader.onload = function(e) {
                    var previewImage = $(tag).parents('tr').find('.preview-img');

                    previewImage.attr('src', e.target.result);
                    previewImage.show();
                };
                }
                reader.readAsDataURL(file);
            $(tag).parents('tr').find('.help').remove()
            console.log(file)
        }
        /**************************************************/
        $('body').on('click','#edit-btn-gallery',function (e)
            {
                $('#gallery-edit').submit()
            }
        )
        /**************************************************/
        $('body').on('submit','#gallery-edit',function (e)
        {
                e.preventDefault()
               const $form = document.getElementById('gallery-edit');
               const $data = new FormData($form)

                $.ajax({
                    url : '<?= route('gallery.update') ?>',
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
