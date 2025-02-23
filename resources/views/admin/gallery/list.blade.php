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
                    <i class="fa fa-align-justify"></i> Combined All Table
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
                            <td>{{ $gallery->status }}</td>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-pencil-square"></i></a></td>
                            {{--<td>
                                <span class="badge badge-success">Active</span>
                            </td>--}}
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--<nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Prev</a>
                            </li>
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">4</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>--}}

                    {{ $data->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection
