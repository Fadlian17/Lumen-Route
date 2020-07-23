<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $posts = Post::with(array('author' => function ($query) {
            $query->select();
        }))->get();

        if (!$posts) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }
        return response()->json(['results' => $posts]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'status' => 'required',
            'author_id' => 'required'
        ]);


        $posts = new Post();
        $posts->title = $request->input('title');
        $posts->content = $request->input('content');
        $posts->tags = $request->input('tags');
        $posts->status = $request->input('status');
        $posts->author_id = $request->input('author_id');
        $posts->save();

        return response()->json(['message' => 'Success Add Post', 'post' => $posts]);
    }

    // public function show($id)
    // {
    //     $posts = [
    //         [
    //             'id' => 1,
    //             'title' => 'Vlog Bareng Presiden',
    //             'content' => 'dokumenter',
    //             'tags' => 'vlog,bincang',
    //             'status' => 'Active',
    //             'author_id' => 1
    //         ],
    //     ];
    //     return response()->json(['message' => 'Success View Post', 'post' => $posts]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
        ]);

        $posts = Post::find($id);
        if ($posts) {
            $posts->title = $request->input('title');
            $posts->content = $request->input('content');
            $posts->tags = $request->input('tags');
            $posts->status = $request->input('status');
            $posts->author_id = $request->input('author_id');
            $posts->save();
            return response()->json(['message' => 'Success Update Post', 'post' => $posts]);
        } else {
            return response()->json(['message' => 'data undifined']);
        }
    }

    public function destroy($id)
    {
        $posts = Post::find($id);
        if ($posts) {
            $posts->delete();
            return response()->json([
                'message' => 'Success Deleted',
                'post' => [
                    'post' => $posts
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'Delete Data Not Found'
            ]);
        }
    }
}
