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
        $authors = Author::with(array('post' => function ($query) {
            $query->select();
        }))->get();
        if (!$authors) {
            return response()->json([
                'message' => 'Data Not Found'
            ]);
        }

        return response()->json(['message' => 'Success View', 'author' => $authors])
            ->header('author', 'fadlian');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'salt' => 'required',
            'email' => 'required',
            'profile' => 'required'
        ]);

        $authors = new Author();
        $authors->name = $request->input('name');
        $authors->password = $request->input('password');
        $authors->salt = $request->input('salt');
        $authors->email = $request->input('email');
        $authors->profile = $request->input('profile');
        $authors->save();

        return response()->json(['message' => 'Success Add Author', 'author' => $authors])
            ->header('author', 'fadlian');
    }

    // public function show($id)
    // {
    //     $authors = [
    //         [
    //             'id' => $id,
    //             'name' => 'Raditya Dika',
    //             'password' => 'Radit123',
    //             'salt' => 1,
    //             'email' => 'radit@mail.com',
    //             'profile' => 'penulis buku'
    //         ]
    //     ];
    //     return response()->json(['message' => 'Success View', 'author' => $authors]);
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'required',
            'salt' => 'required',
            'email' => 'required',
            'profile' => 'required'
        ]);

        $authors = Author::find($id);
        if ($authors) {
            $authors->names = $request->input('name');
            $authors->passwords = $request->input('password');
            $authors->salts = $request->input('salt');
            $authors->emails = $request->input('email');
            $authors->profiles = $request->input('profile');
            $authors->save();

            return response()->json(['message' => 'Success Update Author', 'author' => $authors]);
        }
    }

    public function destroy($id)
    {
        $authors = Author::find($id);
        if ($authors) {
            $authors->delete();

            return response()->json([
                'message' => 'Success Deleted',
                'author' => [
                    'author' => $authors
                ]
            ]);
        } else {
            return response()->json([
                'message' => 'not found to deleted'
            ]);
        }
    }
}
