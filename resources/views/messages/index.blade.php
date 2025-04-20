<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messages</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/messages/index_style.css') }}">
</head>

<body>
    <header class="container-fluid header--bg">
        <nav class="row d-flex  justify-content-between align-items-center">
            <img class ="col-2 nav-icon-size" src="{{ asset('assets/images/site_logo.svg') }}" alt="">
            <img class ="col-2 d-md-none nav-icon-size" src="{{ asset('assets/images/menu_btn.svg') }}" alt="">
            <ul class="col-md-3 col-xl-2 d-none m-0 d-md-flex justify-content-around align-items-center ">
                <a href="" class=" btn p-2 bg-primary text-light  ">Register</a>
                <a href="" class=" btn p-2 bg-primary text-light  ">Login</a>
            </ul>
        </nav>
    </header>

    {{-- section1 --}}
    <section class="container-fluid d-flex justify-content-center align-items-center py-5">
        <a href="" class="btn bg-primary text-light">Leave You Message</a>
    </section> {{-- / section1 --}}

    @if ($messages)
       @foreach ($messages as $message)
        {{-- section2 - messages --}}
        <section class="container my-3 p-3 msg-bg rounded-3">
            {{-- row --}}
            <div class="row px-2">
                {{-- comment data area --}}
                <div class="col">
                    {{-- user name and pic  --}}
                    <div class="row align-items-center">
                        {{-- user pic --}}
                        <div class="col-2 col-md-1">
                            <div class="m-auto p-0 overflow-hidden rounded-circle bg-primary user-pic">
                                <img class="user-pic" src="{{asset('./assets/images/default_user_image.svg')}}" alt="">
                            </div>
                        </div> {{-- / user pic --}}
                        {{-- user name --}}
                        <div class="col"> User Name</div> {{-- / user name --}}
                    </div> {{-- / user name and pic  --}}

                    {{-- title and timestamp --}}
                    <div class="row p-2 border-bottom align-items-center">
                        {{-- titile --}}
                        <div class="col-8">{{$message->title}}</div> {{-- / titile --}}
                        {{-- timestamp --}}
                        <div class="col text-end ">{{$message->created_at}}</div> {{-- / timestamp --}}
                    </div> {{-- / title and timestamp --}}

                    {{-- message body --}}
                    <div class="row p-2 border-bottom">{{$message->body}}</div> {{-- / message body --}}

                    {{-- attachment files  --}}
                    <div class="row p-2 border-bottom">
                        No Files
                    </div> {{-- / attachment files  --}}

                    {{-- replay and comment buttons --}}
                    <div class="row mt-2 justify-content-between align-items-center">
                        <a href="" class=" col-3 btn border shadow-sm"> (23) comments </a >
                        <a href="" class=" col-3 btn btn-success shadow-sm "> Reply </a >
                    </div> {{-- / replay area --}}
                </div>
                {{-- / comment data area --}}
            </div> {{-- / row --}}
        </section> {{-- / section2 - messages --}}
       @endforeach
    @endif
</body>

</html>
