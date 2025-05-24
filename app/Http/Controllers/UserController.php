<?php

namespace App\Http\Controllers;

use App\constants\Constant;
use App\Http\Requests\user\UpdateUserRequest;
use App\repositories\contracts\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(private  UserRepositoryContract $userRepository) {}

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
            ]);
        }
    }

    public function update(UpdateUserRequest $request , string $id)
    {
        $file = $request->file('image');
        $storedFileName=null;
        if($file){
            $fileName = "image_.".$file->extension();
            $storedFileName = Storage::disk('public')->putFile("message_file_uploaded", $file);
        }
        $updated = $this->userRepository->update(
            id: $id,
            name : $request->name,
            email : $request->email,
            password:$request->password ? Hash::make($request->password) : null ,
            image:$storedFileName ? basename($storedFileName) : null
        );
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
            return view('user.profile', [
                'user' => $user,
                'storagePath' => Constant::$FILES_UPLOADED_PATH,
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
            'storagePath'=> Constant::$FILES_UPLOADED_PATH,
        ]);
    }
}
