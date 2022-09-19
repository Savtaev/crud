<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request){
        $data = $request->validate([
            'login' => 'required|min:3|max:255',
            'email' => 'email|unique:users,email',
            'password' => 'required|min:6|max:255'
        ]);
        $user = new User();
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        if ($user) {
            //event(new Registered($user));
            return $user;
        }
    }
    public function index(Request $request)
    {

    }
}
