@extends('admin.layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Danh sách bài viết</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-success">Thêm mới bài viết</a>
    </div>
    <div class="col-12 col-md-12">
        <div class="col-12 col-md-4">
            <input type="text" class="form-control" id="search-post">
        </div>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Tiêu đề</th>
                <th scope="col">Ảnh đại diện</th>
                <th scope="col">Thời gian</th>
            </tr>
            </thead>
            <tbody id="list-post">


            </tbody>
        </table>
        <div>
            <button type="button" id="delete-post" class="btn btn-danger">Delete</button></div>
    </div>
@endsection
