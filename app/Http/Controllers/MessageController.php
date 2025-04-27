<?php

namespace App\Http\Controllers;

use App\repositories\contracts\MessageRepositoryContract;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(public MessageRepositoryContract $MessageRepository) { }
    public function index()
    {
        $messages= $this->MessageRepository->all();
        return view('messages.index', ['messages'=>$messages]);
    }

    public function create()
    {
        return 'create';
    }

    public function store(Request $request)
    {
        dd($request->all());
        return 'store';
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
