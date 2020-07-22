<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
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
        $comments = Comment::with(array('author' => function ($query) {
            $query->select();
        }))->with(array('post' => function ($query) {
            $query->select();
        }))->get();
        if (!$comments) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }
        return response()->json(['comment' => $comments]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'content' => 'required',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
            'email' => 'required',
            'url' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);

        $comments = new Comment();
        $comments->content = $request->input('content');
        $comments->status = $request->input('status');
        $comments->author_id = $request->input('author_id');
        $comments->email = $request->input('email');
        $comments->url = $request->input('url');
        $comments->post_id = $request->input('post_id');
        $comments->save();
        return response()->json(['message' => 'Success Add Comment', 'comment' => $comments]);
    }

    // public function show($id)
    // {
    //     $comments = [
    //         [
    //             'id' => 1,
    //             'content' => 'Mukbang Bareng Chelsea Islan',
    //             'status' => 'Done',
    //             'create_time' => '2020-08-18',
    //             'author_id' => 1,
    //             'email' => 'radit@mail.com',
    //             'url' => 'samakamu.com',
    //             'post_id' => 1
    //         ],
    //     ];
    //     return response()->json(['message' => 'Success View Comment', 'comment' => $comments]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'content' => 'required',
            'status' => 'required',
            'author_id' => 'required|exists:authors,id',
            'email' => 'required',
            'url' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);


        $comments = Comment::find($id);
        if ($comments) {
            $comments = new Comment();
            $comments->content = $request->input('content');
            $comments->status = $request->input('status');
            $comments->author_id = $request->input('author_id');
            $comments->url = $request->input('url');
            $comments->post_id = $request->input('post_id');
            $comments->save();
        }

        return response()->json(['message' => 'Success Update Comment', 'comment' => $comments]);
    }

    public function destroy($id)
    {
        $comments = Comment::find($id);
        if ($comments) {
            $comments->delete();

            return response()->json([
                'message' => 'Success Deleted Comment',
                'comment' => [
                    'id' => $id
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'data undifined to delete'
            ]);
        }
    }
}
