@extends('layouts.main')
@section('scripts')
    <script src="{{asset('assets/js/messages.js')}}"></script>
@endsection

@section('content')
    {{-- section1 --}}
    <section class="container-fluid d-flex justify-content-center align-items-center py-5">
        {{-- leave message form --}}
        <form class="col col-md-7 col-sm-10 d-flex flex-column gap-2 justify-content-evenly align-items-start" method="POST" action="{{ route('message.store') }}" enctype="multipart/form-data">
            @csrf
            <h5 class="text-center align-self-center">Leave Your Message</h5>
            <input type="text" name="title" class="col-12" placeholder="Message Title">
            <textarea class="col-12" class="" name="message" id="" rows=4 style="resize:none;" placeholder="Your message"></textarea>
            {{-- attach file for new message --}}
            <div class="mb-3 col-12 d-flex align-items-center display">
                <input id="file" class="form-control me-2" type="file" id="formFile" name="file">
                <i id="clear-file" class="bi bi-x-circle" style="font-size: 25px; cursor: pointer;"></i>
            </div> {{-- / attach file for new message --}}
            <input type="submit"  value="Send" href="" class="btn btn-success col-5 col-md-3 align-self-end">
        </form> {{-- / leave message form --}}
    </section> {{-- / section1 --}}

    @if ($messages)
        {{-- top pagination --}}
        <div class="container">
            {{$messages->links()}}
        </div> {{-- / top pagination --}}

        @foreach ($messages as $message)
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
                                    <img class="user-pic" src="{{ asset($message->user_image) }}" alt="">
                                </div>
                            </div> {{-- / user pic --}}
                            {{-- user name --}}
                            <div class="col"> {{ $message->user_id ? $message->user_name : 'Anonymous' }}</div> {{-- / user name --}}
                        </div> {{-- / user name and pic --}}

                        {{-- title and timestamp --}}
                        <div class="row p-2 border-bottom align-items-center">
                            {{-- titile --}}
                            <div class="col-8">{{ $message->title }}</div> {{-- / titile --}}
                            {{-- timestamp --}}
                            <div class="col text-end ">{{ $message->created_at->diffForHumans() }}</div>
                            {{-- / timestamp --}}
                        </div> {{-- / title and timestamp --}}

                        {{-- message body --}}
                        <div class="row p-2 border-bottom">{{ $message->body }}</div> {{-- / message body --}}

                        {{-- attachment files --}}
                        @if ($message->file)
                            <div class="row p-2 border-bottom"> No Files </div> {{-- / attachment files --}}
                        @endif

                        {{-- replay and comment buttons --}}
                        <div class="row mt-2 justify-content-between align-items-center">
                            <div href="" class=" col-3 btn border shadow-sm" data-bs-toggle="collapse"
                                data-bs-target='#replies-{{ $message->id }}' aria-expanded="false"
                                aria-controls="replies-{{ $message->id }}">
                                ({{ $message->replies_count }})
                                comments
                            </div>
                            <a href="" class=" col-3 btn btn-success shadow-sm "> Reply </a>
                        </div> {{-- / replay area --}}
                    </div>
                    {{-- / comment data area --}}
                </div> {{-- / row --}}
            </section> {{-- / section2 - message --}}

            @if ($message->replies)
                @foreach ($message->replies as $reply)
                    {{-- replies section --}}
                    <section class="container collapse" id ="replies-{{ $message->id }}">
                        {{-- row --}}
                        <div class="row my-1 justify-content-end">
                            {{-- comment reply data area --}}
                            <div class="col-11 py-2 rounded-2 msg-reply-bg">
                                {{-- user name and pic --}}
                                <div class="row align-items-center">
                                    {{-- user pic --}}
                                    <div class="col-2 col-md-1">
                                        <div class="m-auto p-0 overflow-hidden rounded-circle bg-primary user-pic">
                                            <img class="user-pic" src="{{ asset($reply->user_image) }}" alt="">
                                        </div>
                                    </div> {{-- / user pic --}}
                                    {{-- user name --}}
                                    <div class="col"> {{ $reply->user_id ? $reply->user_name : 'Anonymous' }}</div> {{-- / user name --}}
                                </div> {{-- / user name and pic --}}

                                {{-- title and timestamp --}}
                                <div class="row p-2 border-bottom align-items-center">
                                    {{-- titile --}}
                                    <div class="col-8">{{ $reply->title }}</div> {{-- / titile --}}
                                    {{-- timestamp --}}
                                    <div class="col text-end ">{{ $reply->created_at }}</div> {{-- / timestamp --}}
                                </div> {{-- / title and timestamp --}}

                                {{-- message body --}}
                                <div class="row p-2 border-bottom">{{ $reply->body }}</div> {{-- / message body --}}

                                {{-- attachment files --}}
                                @if ($reply->file)
                                    <div class="row p-2 border-bottom"> No Files </div> {{-- / attachment files --}}
                                @endif
                            </div> {{-- / comment reply data area --}}
                        </div> {{-- / row --}}
                    </section>
                @endforeach {{--  $message->replies --}}
            @endif
        @endforeach {{-- $messages --}}

        {{-- bottom pagination --}}
        <div class="container">
            {{$messages->links()}}
        </div> {{-- / bottom pagination --}}
    @endif

@endsection
