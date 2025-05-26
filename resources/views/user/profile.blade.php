@extends('layouts.main')
@section('title', 'Profile')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/users/profile_style.css') }}">
@endsection
@section('content')
    {{-- user profile --}}
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-8 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4  gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img class= "mt-5 rounded-circle bg-primary"
                                    src="{{ $storagePath.$user->image}}" alt="Avatar"
                                    class="img-fluid my-5" style="width: 80px; height:80px" />
                                <h5 class="my-3">{{ $user->name }}</h5>
                                <a href="{{ route('user.edit', $user->id) }}">
                                    <i class="bi bi-pencil-square bg-secondary p-2 rounded"
                                        style="font-size:25px;color:white"></i>
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{ $user->email }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Messages Counter</h6>
                                            <p class="text-muted">
                                                {{ $user->message_count ?? 0 }}
                                            </p>
                                        </div>
                                    </div>
                                    <h6>Messages Details</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col-6 mb-3">
                                            <h6>Message Posted </h6>
                                            <p class="text-muted">{{ ($user->message_count ?? 0)-($user->reply_message_count ?? 0) }}</p>
                                        </div>
                                        <div class="col-6 mb-3">
                                            <h6>Replies Posted</h6>
                                            <p class="text-muted">{{ $user->reply_message_count ?? 0 }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> {{-- / user profile --}}
@endsection
