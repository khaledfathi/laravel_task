<?php

namespace App\Http\Controllers;

use App\constants\Constant;
use App\Http\Requests\messages\StoreMessageRequest;
use App\repositories\contracts\MessageRepositoryContract;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(public MessageRepositoryContract $MessageRepository) { }
    public function index()
    {
        $messages= $this->MessageRepository->all();
        return view('messages.index', [
            'messages'=>$messages ,
            'defaultUserImage'=>Constant::$DEFAULT_USER_IMAGE
        ]);
    }

    public function create()
    {
        return 'create';
    }

    public function store(StoreMessageRequest $request)
    {
        $this->MessageRepository->store($request->title , $request->message , $request->parent_id);
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
