<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
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
        return "user show";
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
}
