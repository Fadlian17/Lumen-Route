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
        $comments = [
            [
                "id" => 1,
                "content" => "Mukbang Bareng Chelsea Islan",
                "status" => "Done",
                "create_time" => "2020-08-18",
                "author_id" => 1,
                "email" => "radit@mail.com",
                "url" => "samakamu.com",
                "post_id" => 1
            ],
            [
                "id" => 2,
                "content" => "Dinner Bareng Pevita",
                "status" => "On-Going",
                "create_time" => "2020-08-29",
                "author_id" => 2,
                "email" => "raditya@mail.com",
                "url" => "samakita.com",
                "post_id" => 2
            ],
            [
                "id" => 3,
                "content" => "Curhat Sama Indah",
                "status" => "Done",
                "create_time" => "2020-08-18",
                "author_id" => 1,
                "email" => "radit@mail.com",
                "url" => "samakita.com",
                "post_id" => 3
            ]
        ];

        return response()->json(["comment" => $comments]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "content" => 'required',
            "status" => 'required',
            "created_time" => 'required',
            "author_id" => 'required',
            "email" => 'required',
            "url" => 'required',
            "post_id" => 'required'
        ]);

        $contents = $request->input("content");
        $statuss = $request->input("status");
        $created_times = $request->input("created_time");
        $author_ids = $request->input("author_id");
        $urls = $request->input("url");
        $post_ids = $request->input("post_id");

        $comments = [
            [
                "id" => rand(1, 50),
                "content" => $contents,
                "status" => $statuss,
                "created_time" => $created_times,
                "author_id" => $author_ids,
                "url" => $urls,
                "post_id" => $post_ids
            ]
        ];
        return response()->json(["message" => "Success Add Comment", "comment" => $comments]);
    }

    public function show($id)
    {
        $comments = [
            [
                "id" => 1,
                "content" => "Mukbang Bareng Chelsea Islan",
                "status" => "Done",
                "create_time" => "2020-08-18",
                "author_id" => 1,
                "email" => "radit@mail.com",
                "url" => "samakamu.com",
                "post_id" => 1
            ],
        ];
        return response()->json(["message" => "Success View Comment", "comment" => $comments]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "content" => 'required',
            "status" => 'required',
            "created_time" => 'required',
            "author_id" => 'required',
            "email" => 'required',
            "url" => 'required',
            "post_id" => 'required'
        ]);

        $contents = $request->input("content");
        $statuss = $request->input("status");
        $created_times = $request->input("created_time");
        $author_ids = $request->input("author_id");
        $urls = $request->input("url");
        $post_ids = $request->input("post_id");

        $comments = [
            [
                "id" => $id,
                "content" => $contents,
                "status" => $statuss,
                "created_time" => $created_times,
                "author_id" => $author_ids,
                "url" => $urls,
                "post_id" => $post_ids
            ]
        ];
        return response()->json(["message" => "Success Update Comment", "comment" => $comments]);
    }

    public function destroy($id)
    {
        return response()->json([
            "message" => "Success Deleted Comment",
            "comment" => [
                "id" => $id
            ]
        ]);
    }
}
