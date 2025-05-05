<?php

namespace App\Http\Controllers;

use App\constants\Constant;
use App\Http\Requests\messages\StoreMessageRequest;
use App\repositories\contracts\MessageRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function __construct(private MessageRepositoryContract $MessageRepository) { }
    public function index()
    {
        $messages= $this->MessageRepository->all();
        return view('messages.index', [
            'messages'=>$messages ,
            'defaultUserImage'=>Constant::$DEFAULT_USER_IMAGE,
            'storagePath' => Constant::$FILES_UPLOADED_PATH,
        ]);
    }

    public function create()
    {
        return 'create';
    }

    public function store(StoreMessageRequest $request)
    {
        //is there file attached
        $file = $request->file('file');
        $storedFileName=null;
        if($file){
            $fileName = "image_.".$file->extension();
            $storedFileName = Storage::disk('public')->putFile("message_file_uploaded", $file);
        }
        //store in db
        $id =  $this->MessageRepository->store(
            title:$request->title ,
            message:$request->message ,
            file:$storedFileName ? basename($storedFileName):null,
            user_id:Auth::id(),
            parent_id:$request->parent_id
        );

        session()->flash('success', 'Message has been sent successfuly' );
        return back();
    }

    public function show(string $id)
    {
        return 'show';
    }

    public function edit(string $id)
    {
        return 'edit';
    }

    public function update(Request $request, string $id)
    {
        return 'update';
    }

    public function destroy(string $id)
    {
        return 'destroy';
    }
}
