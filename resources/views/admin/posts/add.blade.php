@extends('admin.layouts.master')
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm mới bài viết</h1>
    </div>
    <div class="col-12 col-md-12">
        <form action="{{ route('admin.posts.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="form-group">
                        <label for="">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Nội dung</label>
                        <textarea name="content-post" class="form-control" id="content-post" rows="5"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="">Ảnh đại diện</label>
                        <input type="file" name="image" class="form-control" id="" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Thể loại</label>
                        @foreach($types as $type)
                        <div class="form-check">
                            <input class="form-check-input" name="type_id[{{$type->id}}]" type="checkbox" value="{{$type->id}}" id="type-post-{{$type->id}}">
                            <label class="form-check-label" for="type-post-{{$type->id}}">
                                {{ $type->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </form>


    </div>
    <script>
        ClassicEditor
            .create( document.querySelector( '#content-post' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
