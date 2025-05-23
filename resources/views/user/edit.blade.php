@extends('layouts.main')
@section('title', 'Edit User')
@section('scripts')
    <script src="{{asset('assets/js/user_edit.js')}}"></script>
@endsection
@section('content')

    <form action="{{route('user.update',$user->id)}}" method="POST">
        @csrf
        @method('PUT')
        <input name="id" type="hidden" value="{{$user->id}}">

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
        {{-- /errors --}}

        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile Picture</div>
                        <div class="card-body text-center">
                            <!-- Profile picture image-->
                            <img name="image" class="img-account-profile rounded-circle mb-2 bg-primary" style="width:111px"
                                src="{{asset($user->image ?? $defaultUserImage)}}" alt="" >
                            <!-- Profile picture help block-->
                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                            <!-- Profile picture upload button-->
                            <button class="btn btn-primary" type="button">Upload new image</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header">Account Details</div>
                        <div class="card-body">
                            <!-- Form Group (username)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputUsername">Username</label>
                                <input name="name" class="form-control" id="inputUsername" type="text"
                                    placeholder="Enter your username" value="{{$user->name}}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                <input name="email" class="form-control" id="inputEmailAddress" type="email"
                                    placeholder="Enter your email address" value="{{$user->email}}">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPassword">New Password</label>
                                <input name="password" class="form-control" id="inputPassword" type="password"
                                    placeholder="Enter new password">
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                <input name="password_confirmation" class="form-control" id="inputConfirmPassword" type="password"
                                    placeholder="Confirm new password">
                            </div>
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <a href="{{route('user.profile')}}" class="btn btn-secondary ms-3" type="button">Cancle changes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
