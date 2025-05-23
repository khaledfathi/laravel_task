<?php

namespace App\Http\Controllers;

use App\constants\Constant;
use App\Http\Requests\user\UpdateUserRequest;
use App\repositories\contracts\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(private  UserRepositoryContract $userRepository) {}
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
        if (Auth::check() && Auth::user()->id == $id) {
            return view('user.edit', [
                'user' => Auth::user(),
                'storagePath' => Constant::$FILES_UPLOADED_PATH,
                'defaultImage' => Constant::$DEFAULT_USER_IMAGE,
            ]);
        }
    }

    public function update(UpdateUserRequest $request , string $id)
    {
        //custom request for updating user
        //update user by using user repository
        return back()->with('success', 'User has been updated');
    }

    public function destroy(string $id)
    {
        if(Auth::check() && Auth::user()->is_admin){
            if($id != 1){
                $this->userRepository->destroy($id);
                return back()->with('success' , 'User has been deleted successfuly') ;
            }
        }
        return back();
    }

    public function userProfile()
    {
        if (Auth::check()) {
            $user = $this->userRepository->showProfile(Auth::id());
            // dd($user);
            return view('user.profile', [
                'user' => $user,
                'defaultUserImage' => Constant::$DEFAULT_USER_IMAGE,

            ]);
        }
        return redirect(route('root'));
    }

    public function adminPanel()
    {
        $users = $this->userRepository->index();
        //show user list here
        return view('admin.index', [
            'users' => $users,
            'defaultUserImage'=> Constant::$DEFAULT_USER_IMAGE,
        ]);
    }
}
