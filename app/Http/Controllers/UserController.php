<?php

namespace App\Http\Controllers;

use App\constants\Constant;
use App\repositories\contracts\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct( private  UserRepositoryContract $userRepository) { }
    public function index()
    {
        return "user index";
    }

    public function create()
    {

        return "user create";
    }

    public function store(Request $request)
    {
        return "user store";
    }

    public function show(string $id)
    {
        return $this->userRepository->show($id);
    }

    public function edit(string $id)
    {
        return "user edit";
    }

    public function update(Request $request, string $id)
    {
        return "user update";
    }

    public function destroy(string $id)
    {
        return "user destroy";
    }

    public function userProfile()
    {
        if(Auth::check()){
            $user = Auth::user();
            return view('user.profile', [
                'user' => $user,
                'defaultUserImage' => Constant::$DEFAULT_USER_IMAGE,

            ]);
        }
        return redirect(route('root'));
    }

    public function adminPanel()
    {
        //show user list here
        return view('admin.index', );
    }

}
