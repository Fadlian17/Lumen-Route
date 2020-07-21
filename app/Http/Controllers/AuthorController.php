<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\MockObject\Builder\Identity;

class AuthorController extends Controller
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
        $authors = [
            [
                "id" => 1,
                "username" => "Raditya Dika",
                "password" => "Radit123",
                "salt" => 1,
                "email" => "radit@mail.com",
                "profile" => "penulis buku"
            ],
            [
                "id" => 2,
                "username" => "Anwar Fuadi",
                "password" => "Anwar123",
                "salt" => 1,
                "email" => "anwar@mail.com",
                "profile" => "penulis buku"
            ],
            [
                "id" => 3,
                "username" => "Joko Anwar",
                "password" => "joko123",
                "salt" => 2,
                "email" => "joko@mail.com",
                "profile" => "Produser Film"
            ]

        ];

        return response()->json(["message" => "Success View", "author" => $authors])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "username" => 'required',
            "password" => 'required',
            "salt" => 'required',
            "email" => 'required',
            "profile" => 'required'
        ]);

        $usernames = $request->input("username");
        $passwords = $request->input("password");
        $salts = $request->input("salt");
        $emails = $request->input("email");
        $profiles = $request->input("profile");

        $authors = [
            [
                "id" => rand(1, 50),
                "username" => $usernames,
                "password" => $passwords,
                "salt" => $salts,
                "email" => $emails,
                "profile" => $profiles
            ]
        ];
        return response()->json(["message" => "Success Add Author", "author" => $authors]);
    }

    public function show($id)
    {
        $authors = [
            [
                "id" => $id,
                "username" => "Raditya Dika",
                "password" => "Radit123",
                "salt" => 1,
                "email" => "radit@mail.com",
                "profile" => "penulis buku"
            ]
        ];
        return response()->json(["message" => "Success View", "author" => $authors]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "username" => 'required',
            "password" => 'required',
            "salt" => 'required',
            "email" => 'required',
            "profile" => 'required'
        ]);

        $usernames = $request->input("username");
        $passwords = $request->input("password");
        $salts = $request->input("salt");
        $emails = $request->input("email");
        $profiles = $request->input("profile");

        $authors = [
            [
                "id" => $id,
                "username" => $usernames,
                "password" => $passwords,
                "salt" => $salts,
                "email" => $emails,
                "profile" => $profiles
            ]
        ];
        return response()->json(["message" => "Success Update Author", "author" => $authors]);
    }

    public function destroy($id)
    {
        return response()->json([
            "message" => "Success Deleted",
            "author" => [
                "id" => $id
            ]
        ]);
    }
}
