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
        $posts = [
            [
                "id" => 1,
                "title" => "Vlog Bareng Presiden",
                "content" => "dokumenter",
                "tags" => "vlog,bincang",
                "status" => "Active",
                "author_id" => 1
            ],
            [
                "id" => 2,
                "title" => "Programming Dan Desain Bareng Refactory",
                "content" => "belajar",
                "tags" => "IT",
                "status" => "Active",
                "author_id" => 2
            ],
            [
                "id" => 3,
                "title" => "Bootcamp Bareng Refactory",
                "content" => "belajar",
                "tags" => "IT",
                "status" => "Active",
                "author_id" => 2
            ]
        ];

        return response()->json(["results" => $posts]);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "id" => 'required',
            "title" => 'required',
            "content" => 'required',
            "tags" => 'required',
            "status" => 'required',
            "author_id" => 'required'
        ]);

        $titles = $request->input("title");
        $content = $request->input("content");
        $tags = $request->input("tag");
        $statuss = $request->input("status");
        $authors_id = $request->input("author_id");

        $posts = [
            [
                "id" => rand(1, 100),
                "title" => $titles,
                "content" => $content,
                "tags" => $tags,
                "status" => $statuss,
                "author_id" => $authors_id
            ]
        ];
        return response()->json(["message" => "Success Add Post", "post" => $posts]);
    }

    public function show($id)
    {
        $posts = [
            [
                "id" => 1,
                "title" => "Vlog Bareng Presiden",
                "content" => "dokumenter",
                "tags" => "vlog,bincang",
                "status" => "Active",
                "author_id" => 1
            ],
        ];
        return response()->json(["message" => "Success View Post", "post" => $posts]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "id" => 'required',
            "title" => 'required',
            "content" => 'required',
            "tags" => 'required',
            "status" => 'required',
            "author_id" => 'required'
        ]);

        $titles = $request->input("title");
        $content = $request->input("content");
        $tags = $request->input("tag");
        $statuss = $request->input("status");
        $authors_id = $request->input("author_id");

        $posts = [
            [
                "id" => $id,
                "title" => $titles,
                "content" => $content,
                "tags" => $tags,
                "status" => $statuss,
                "author_id" => $authors_id
            ]
        ];
        return response()->json(["message" => "Success Update Post", "post" => $posts]);
    }

    public function destroy($id)
    {
        return response()->json([
            "message" => "Success Deleted",
            "post" => [
                "id" => $id
            ]
        ]);
    }
}
