<?php

namespace App\Http\Controllers;

use App\constants\Constant;
use App\Http\Requests\user\StoreUserRequest;
use App\repositories\contracts\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(private UserRepositoryContract $userRepository) { }
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        return view('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(route('root'));
    }

    public function auth(Request  $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect(route('root'));
        }
        return  back();
    }

    public function storeNewUser(StoreUserRequest $request){
        $user =$this->userRepository->store(
            name: $request->name,
            email:$request->email,
            password:$request->password,
            image: $request->image ?? Constant::$DEFAULT_USER_IMAGE,
        );
        Auth::login($user);

        // regenerate the session ID for security
        $request->session()->regenerate();

        return  redirect(route('root'));
    }
}
