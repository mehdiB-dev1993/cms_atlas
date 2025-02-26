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
        <div class="col-lg-2"><a href="{{ route('page.create') }}" class="btn btn-success">افزودن</a></div>
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
                    <i class="fa fa-align-justify"></i>لیست صفحات
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>عنوان صفحه</th>
                            <th>عنوان صفحه در منو</th>
                            <th>منبع</th>
                            <th>آیکون</th>
                            <th>تصویر بند انگشتی</th>
                            <th>تصویر هدر</th>
                            <th>وضعیت</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(@isset($pages))
                        @foreach($pages as $page)
                            <tr>
                                <td class="align-middle text-center">{{ $page->title }}</td>
                                <td class="align-middle text-center">{{ $page->title_in_menu }}</td>
                                <td class="align-middle text-center">{{ $page->source }}</td>
                                <td class="box-img"><img src="{{ asset('storage/' . $page->icon) }}" alt="Icon"></td>
                                <td class="box-img"><img src="{{ asset('storage/' . $page->thumbnail) }}" alt="Icon"></td>
                                <td class="box-img"><img src="{{ asset('storage/' . $page->header_image) }}" alt="Icon"></td>
                                <td class="align-middle text-center"><span class="badge badge-success">Active</span></td>
                                <td class="align-middle text-center"><a href="{{ route('page.edit',['id' => $page->id]) }}"><i class="bi bi-pencil-square"></i></a></td>
                                <td class="align-middle text-center"><a href="{{ route('page.destroy',['id' => $page->id]) }}"><i class="bi bi-trash-fill"></i></a></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection
