@extends('admin.layout.layout')


@section('content')

    <style>

        td {
            text-align: center;
            vertical-align: middle;

        }
        .box-img
        {
            width: 200px;
        }

        .box-img img
        {
            width: 100%;
        }
    </style>
    <div class="row">
        <div class="col-lg-2"><a href="{{ route('course.create') }}" class="btn btn-success">افزودن</a></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-2"></div>
    </div>

    <hr class="my-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i>لیست دوره ها
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <th>ردیف</th>
                        <th>عنوان</th>
                        <th>قیمت</th>
                        <th>مدت زمان</th>
                        <th>لینک</th>
                        <th>وضعیت</th>
                        <th>مشاهده</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                        </thead>
                        <tbody>
                        @php $counter = 1 @endphp
                        @foreach($courses as $course)
                            <tr data-id="{{ $course->id }}">
                                <td>{{ $counter }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->price }}</td>
                                <td>{{ $course->duration }}</td>
                                <td>{{ $course->link }}</td>
                                <td>
                                    @if($course->status == 1)
                                        <span class="badge badge-success">فعال</span>
                                    @else
                                        <span class="badge badge-warning">غیرفعال</span>
                                    @endif
                                </td>
                                <td><i class="bi bi-eye-fill <!--see-course--> cursor-pointer"></i></td>
                                <td><a href="{{route('course.edit',$course->id)}}"><i class="bi bi-pencil-square cursor-pointer"></i></a></td>
                                <td><i class="bi bi-trash-fill cursor-pointer"></i></td>

                            </tr>
                             @php $counter++ @endphp
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
    <button type="button" class="btn btn-primary" id="modal-course" data-bs-toggle="modal" data-bs-target="#exampleModal" style="visibility: hidden">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">مشاهده جزییات دوره</h1>
                    <button type="button" class="btn-close m-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="course" method="post" enctype="multipart/form-data" class="form-horizontal">

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

        function generate($elements,$childs) {
            let html = `<div class="<!--form-group--> row">`;

            $elements.forEach((value,index) => {
                html += `<div class="${value.class}">${value.content}</div>`;
            })


            html += `</div><hr class="hr-custom">`;

            return html;
        }


/*        document.body.addEventListener('click',function (e)
        {
            if(e.target.classList.contains('see-course'))
            {
                    let $parent = e.target.closest('tr')
                    let $id = $parent.getAttribute('data-id')
                    let $url = '{{ route('course.edit', ':id') }}'.replace(':id', $id);



                fetch($url)
                    .then(response => response.json())
                    .then(res => {

                        /!**!/
                        let modalCourse = document.querySelector('#modal-course');
                        if (modalCourse) {
                            modalCourse.click();
                        }


                        let courseElement = document.querySelector('#course');
                        if (courseElement) {
                            courseElement.innerHTML = '';
                        }
                        /!**!/

                        let $elements = [{
                            class : 'col-lg-6',
                            content : generate([{class: 'col-lg-3', content: 'عنوان:'},{class: 'col-lg-9',content: res.title}])
                        },{
                            class : 'col-lg-6',
                            content :  generate([{class: 'col-lg-3', content: 'مدرس:'},{class: 'col-lg-9',content: res.teacher}])
                        }];


                        let $title_teacher = generate($elements);

                        let tempDiv = document.createElement('div');
                        tempDiv.innerHTML = $title_teacher.trim();

                        courseElement.appendChild(tempDiv.firstChild);

                    })

                console.log($id)
            }

        }
        )*/




        $('body').on('click','.see-course',function (e) {

            let $this = $(this)
            let $id = $this.parents('tr').attr('data-id')
            let $url = '{{ route('course.show', ':id') }}'.replace(':id', $id);




            $.ajax(
                {
                    url: $url,

                }
            ).done(function (res) {
                console.log(res)

                $('#modal-course').trigger('click')
                $('body').find('#course').empty()



                let $title_teacher = [{
                    class : 'col-lg-6',
                    content : generate([{class: 'col-lg-3 d-flex flex-column justify-content-center', content: 'عنوان:'},{class: 'col-lg-9 text-primary',content: res.title}])
                },{
                    class : 'col-lg-6',
                    content :  generate([{class: 'col-lg-3 d-flex flex-column justify-content-center', content: 'مدرس:'},{class: 'col-lg-9 text-primary',content: res.teacher}])
                }];


                let $price_duration_date = [{
                    class : 'col-lg-4',
                    content : generate([{class: 'col-lg-3 d-flex flex-column justify-content-center', content: 'قیمت:'},{class: 'col-lg-9 text-primary',content: res.price}])
                },{
                    class : 'col-lg-4',
                    content :  generate([{class: 'col-lg-3 d-flex flex-column justify-content-center', content: 'مدت زمان:'},{class: 'col-lg-9 text-primary',content: res.duration}])
                },{
                    class : 'col-lg-4',
                    content :  generate([{class: 'col-lg-3 d-flex flex-column justify-content-center', content: 'تاریخ'},{class: 'col-lg-9 text-primary',content: res.date}])
                }];

                let $link = [{
                    class : 'col-lg-1 d-flex flex-column justify-content-center',
                    content : 'لینک:'
                },{
                    class: 'col-lg-11 text-primary',
                    content: res.link
                }];

                let $text = [{
                    class : 'col-lg-2 d-flex flex-column justify-content-center ',
                    content : 'خلاصه متن:'
                },{
                    class: 'col-lg-10 ',
                    content: res.text
                }];

                let $fulltext = [{
                    class : 'col-lg-2 d-flex flex-column justify-content-center',
                    content : 'متن کامل:'
                },{
                    class: 'col-lg-10',
                    content: res.full_text
                }];


                let $headerImg_src = '<?= asset("storage/' + res.header_image + '") ?>'


                let $header_image = [

                    {
                        class:'col-lg-2 d-flex flex-column justify-content-center font-10-pt',content: 'تصویر هدر:',
                    },
                    {
                        class:'col-lg-10 d-flex justify-content-center align-items-center',content:`<div class="box-thumbnail-lg"><img class="w-100" src="${$headerImg_src}" alt="headerImg"></div>`
                    }

                ]


                let $icon_src = '<?= asset("storage/' + res.icon + '") ?>'
                let $thumbnail_src = '<?= asset("storage/' + res.thumbnail + '") ?>'

                let $icon_thumb = [{
                    class : 'col-lg-6',
                    content : generate([{class:'col-lg-3 d-flex flex-column justify-content-center font-10-pt',content: 'آیکون:'},{class:'col-lg-9 d-flex justify-content-center align-items-center',content:`<div class="box-thumbnail"><img class="w-100" src="${$icon_src}" alt="icon"></div>`}])
                },{
                    class: 'col-lg-6',
                    content : generate([{class:'col-lg-3 d-flex flex-column justify-content-center font-10-pt',content: 'تصویر بند انگشتی:'},{class:'col-lg-9 d-flex justify-content-center align-items-center',content:`<div class="box-thumbnail"><img class="w-100" src="${$thumbnail_src}" alt="thumbnail"></div>`}])
                }];


                $('body').find('#course').append(generate($title_teacher))
                $('body').find('#course').append(generate($price_duration_date))
                $('body').find('#course').append(generate($link))
                $('body').find('#course').append(generate($text))
                $('body').find('#course').append(generate($fulltext))
                $('body').find('#course').append(generate($header_image))
                $('body').find('#course').append(generate($icon_thumb))
                $('body').find('.modal .modal-footer').addClass('d-none')

            })
        }
        )

        /**************************************************/

        /**************************************************/

    </script>


@endsection
