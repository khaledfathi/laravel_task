@extends('layouts.main')
@section('title', 'Message')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/messages/show.css') }}">
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/show_message.js') }}"></script>
@endsection

@section('content')

    @if ($message)
        {{-- section2 - message --}}
        <section class="container my-3 p-3 msg-bg rounded-3">
            {{-- row --}}
            <div class="row px-2">
                {{-- comment data area --}}
                <div class="col">
                    {{-- user name and pic --}}
                    <div class="row align-items-center">
                        {{-- user pic --}}
                        <div class="col-2 col-md-1">
                            <div class="m-auto p-0 overflow-hidden rounded-circle bg-primary user-pic">
                                <img class="user-pic" src="{{ asset($storagePath.$message->user_image ) }}"
                                    alt="">
                            </div>
                        </div> {{-- / user pic --}}
                        {{-- user name --}}
                        <div class="col"> {{ $message->user_id ? $message->user_name : 'Anonymous' }}</div>
                        {{-- / user name --}}
                        @if ($currentUser && ($currentUser->id == $message->user_id) | $isAdmin)
                            {{-- delete and edit icons  --}}
                            <div class="position-relative col-2 col-md-1 text-end d-flex justify-content-end gap-4">
                                {{-- Delete --}}
                                <form action="{{ route('message.destroy', $message->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input id="is-parent-deleted" name="is_parent_deleted" type="hidden"  value="0">
                                    <button id="delete-button" type="submit" class="btn p-0"><i class="bi bi-trash3-fill"
                                            style="color: red;font-size:25px"></i></button>
                                </form>
                                {{-- / Delete --}}

                                @if (!$isAdmin || ($isAdmin && $currentUser->id == $message->user_id))
                                    {{-- Update --}}
                                    <form action="{{ route('message.edit', $message->id) }}" method="GET">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn p-0"><i class="bi bi-pencil-square"
                                                style="color: green; font-size:25px"></i></button>
                                    </form>
                                    {{-- / Update --}}
                                @endif
                            </div> {{-- delete and edit icons  --}}
                        @endif
                    </div> {{-- / user name and pic --}}

                    {{-- title and timestamp --}}
                    <div class="row p-2 border-bottom align-items-center">
                        {{-- titile --}}
                        <div class="col-8"><a class= "message-link"
                                href="{{ route('message.show', $message->id) }}">{{ $message->title }}</a></div>
                        {{-- / titile --}}
                        {{-- timestamp --}}
                        <div class="col text-end ">{{ $message->created_at->diffForHumans() }}</div>
                        {{-- / timestamp --}}
                    </div> {{-- / title and timestamp --}}

                    {{-- message body --}}
                    <div class="row p-2 border-bottom">{{ $message->body }}</div> {{-- / message body --}}

                    {{-- attachment files --}}
                    @if ($message->file)
                        <div class="row py-2 border-bottom">
                            <a href="{{ asset("$storagePath/$message->file") }}" class="col-2 p-0">
                                <i class="bi bi-paperclip" style="font-size: 20px;color:red"></i>
                                File Attached
                            </a>
                        </div> {{-- / attachment files --}}
                    @endif

                    {{--  reply input --}}
                    <form class="row" method="POST" action="{{ route('message.store') }}">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $message->id }}">
                        <input name="title" type="text" class="col-11  my-2" placeholder="Reply Title">
                        <textarea class="col-11" name="message" id="" rows="3" placeholder="Reply Message"></textarea>
                        <button class = "col-1 btn align-self-center" style="font-size:30px;color:blue;" type="submit">
                            <i class="bi bi-send-fill text-center"></i>
                        </button>
                    </form>
                    {{--  / reply input --}}
                </div>
                {{-- / comment data area --}}
            </div> {{-- / row --}}
        </section> {{-- / section2 - message --}}

        @if ($message->replies)
            @foreach ($message->replies as $reply)
                {{-- replies section --}}
                <section class="container" id ="replies-{{ $message->id }}">
                    {{-- row --}}
                    <div class="row my-1 justify-content-end">
                        {{-- comment reply data area --}}
                        <div class="col-11 py-2 rounded-2 msg-reply-bg">
                            {{-- user name and pic --}}
                            <div class="row align-items-center">
                                {{-- user pic --}}
                                <div class="col-2 col-md-1">
                                    <div class="m-auto p-0 overflow-hidden rounded-circle bg-primary user-pic">
                                        <img class="user-pic" src="{{ asset($storagePath.$reply->user_image ) }}"
                                            alt="">
                                    </div>
                                </div> {{-- / user pic --}}
                                {{-- user name --}}
                                <div class="col"> {{ $reply->user_id ? $reply->user_name : 'Anonymous' }}</div>
                                {{-- / user name --}}

                                @if ($currentUser && ($currentUser->id == $reply->user_id) | $isAdmin)
                                    {{-- delete and edit icons  --}}
                                    <div class="position-relative col-2 col-md-1 text-end d-flex justify-content-end gap-4">
                                        {{-- Delete --}}
                                        <form action="{{ route('message.destroy', $reply->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn p-0"><i class="bi bi-trash3-fill"
                                                    style="color: red;font-size:25px"></i></button>
                                        </form>
                                        {{-- / Delete --}}

                                        @if (!$isAdmin || ($isAdmin && $currentUser->id == $reply->user_id))
                                            {{-- Update --}}
                                            <form action="{{ route('message.edit', $reply->id) }}" method="GET">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn p-0"><i class="bi bi-pencil-square"
                                                        style="color: green; font-size:25px"></i></button>
                                            </form>
                                            {{-- / Update --}}
                                        @endif
                                    </div> {{-- delete and edit icons  --}}
                                @endif
                            </div> {{-- / user name and pic --}}

                            {{-- title and timestamp --}}
                            <div class="row p-2 border-bottom align-items-center">
                                {{-- titile --}}
                                <div class="col-8">{{ $reply->title }}</div> {{-- / titile --}}
                                {{-- timestamp --}}
                                <div class="col text-end ">{{ $reply->created_at->diffForHumans() }}</div>
                                {{-- / timestamp --}}
                            </div> {{-- / title and timestamp --}}

                            {{-- message body --}}
                            <div class="row p-2 border-bottom">{{ $reply->body }}</div> {{-- / message body --}}
                        </div> {{-- / comment reply data area --}}
                    </div> {{-- / row --}}
                </section>
            @endforeach {{--  $message->replies --}}
        @endif
    @endif
@endsection
