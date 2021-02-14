<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function __invoke(Request $request)
    {
        $this->validate($request,[
            'name' => ['required','max:255'],
            'email' => ['required','email', 'max:255', 'unique:users'],
            'password' => ['required','confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message'=>'user created !'
        ],200);
    }
}
