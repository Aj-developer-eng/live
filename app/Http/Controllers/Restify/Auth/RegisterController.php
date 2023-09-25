<?php

namespace App\Http\Controllers\Restify\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => ['required', 'email', 'min:2', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        /**
         * @var User|string $user
         */
        $model = config('restify.auth.user_model');

        $user = $model::forceCreate([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        return rest($user)->indexMeta([
            'token' => $user->createToken('login')->plainTextToken,
        ]);
    }
}
