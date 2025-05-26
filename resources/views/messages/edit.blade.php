@extends('layouts.main')
@section('title', 'Edit Message')
@section('head')
    <link rel="stylesheet" href="{{ asset('asset/css/layouts/main.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/edit_message.js') }}"></script>
@endsection

@section('content')
    <section class="container d-flex flex-column gap-3 justify-content-center align-items-center">

        {{-- errors --}}
        @if (count($errors))
            <div class="container my-2 border-bottom">
                <h5 class="text-center text-danger">Errors</h5>
                @foreach ($errors->all() as $error)
                    <h6 class="text-danger text-center">{{ $error }}</h6>
                @endforeach
            </div>
        @elseif (session()->has('success'))
            <div id="flash-message" class="container my-3 border-bottom">
                <h5 class="text-success text-center">{{ session('success') }}</h5>
            </div>
        @endif
        {{-- update message form --}}
        <form class="col col-md-7 col-sm-10 d-flex flex-column gap-2 justify-content-evenly align-items-start" method="POST"
            action="{{ route('message.update', $message->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="parent_id" value="{{ $message->parent_id }}">
            <h5 class="text-center align-self-center mt-3">Update Your Message</h5>

            <input type="text" name="title" class="col-12" placeholder="Message Title" value="{{ $message->title }}">
            <textarea class="col-12" class="" name="message" id="" rows=4 style="resize:none;"
                placeholder="Your message">{{ $message->body }}</textarea>

            {{-- attachment files --}}
            @if ($message->file)
                <div id="file-attached-box" class="col-4 py-2 border-bottom ">
                    <a href="{{ asset("$storagePath/$message->file") }}" class="col-2 p-0">
                        <i class="bi bi-paperclip" style="font-size: 20px;color:red"></i>
                        File Attached
                    </a>
                    <i id="delete-file-btn" class="bi bi-x-circle mx-4" style="font-size: 25px; cursor: pointer;"></i>
                    <input id="delete-file-value" type="hidden" name="delete_file">
                </div> {{-- / attachment files --}}
            @endif

            {{-- attach file for new message --}}
            @if (!$message->parent_id)
                <div class="mb-3 col-12 d-flex align-items-center display">
                    <input id="file" class="form-control me-2" type="file" id="formFile" name="file">
                    <i id="clear-file" class="bi bi-x-circle" style="font-size: 25px; cursor: pointer;"></i>
                </div> {{-- / attach file for new message --}}
            @endif
            <input type="submit" value="Update" href="" class="btn btn-success col-5 col-md-3 align-self-center">
            <a href="{{ $message->parent_id ? route('message.show', $message->parent_id) : route('message.show', $message->id) }}"
                class="btn btn-secondary col-5 col-md-3 align-self-center">Center</a>
        </form> {{-- / leave message form --}}
    </section>
@endsection
