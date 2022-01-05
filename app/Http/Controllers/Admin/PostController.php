<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

class PostController extends Controller
{
    function index() {
        return view('admin.posts.list');
    }

    function create(){
        $types = Type::all();
        return view('admin.posts.add', compact('types'));
    }

    function store(StorePostRequest $request) {
        DB::beginTransaction();
        try {
            $post = new Post();
            $post->title = $request->title;
            $post->content = $request->input('content-post');

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('image/posts','public');
                $post->image = $path;
            }

            $post->user_id = Auth::id();
            $post->save();
            $post->types()->sync($request->type_id);
            \session()->flash('success','Thêm mới bài thành công!');
            DB::commit();
        }catch (\Exception $exception) {
            DB::rollBack();
            \session()->flash('error','Thêm mới bài viết lỗi!');
        }
        return redirect()->route('admin.posts.index');
    }

    function getList() {
        $userLogin = Auth::user();
        $posts = $userLogin->posts()->with('types')->get();
        $data = [
            'status' => 'success',
            'data' => $posts
        ];

        return response()->json($data);
    }

    function delete(Request $request) {
        $ids = $request->idPost;
//        $post = Post::destroy($ids);
        foreach ($ids as $id) {
            $post = Post::find($id);
            $post->types()->detach();
            $post->delete();
        }
        $data = [
            'status' => 'success',
            'message' => 'Xoa bai viet thanh cong'
        ];
        return response()->json($data);
    }

    function search(Request $request) {
        $keyword = $request->keyword;
        $posts = Post::where('title', 'LIKE', '%' . $keyword . '%')->with('types')->get();
        $data = [
            'status' => 'success',
            'data' => $posts
        ];
        return response()->json($data);
    }
}
