@extends('layouts.main')
@section('title', 'Admin Dashboard')
@section('head')
    <link rel="stylesheet" href="{{ asset('asset/css/admin/index.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/admin.js') }}"></script>
@endsection

@section('content')

    <div class="container my-4 ">
        {{-- flash message --}}
        @if (session()->has('success'))
            <div id="flash-message" class="container my-3 border-bottom">
                <h5 class="text-success text-center">{{ session('success') }}</h5>
            </div>
        @endif
        {{-- /flash message --}}
        <h1 class="text-center border p-3 m-auto mw-100 rounded-4" style="background:lightblue;width:fit-content">User Table

        </h1>
    </div>
    <div class="container my-5">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Delete</th>
                </tr>
            </thead>
            @if (count($users))
                @foreach ($users as $user)
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset($storagePath.$user->image) }}" alt="" style="width: 45px; height: 45px"
                                        class="rounded-circle bg-primary" />
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">{{ $user->name }}</p>
                                        <p class="text-muted mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->is_admin ? 'Admin' : 'User' }}</td>
                            <td>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    @if (!$user->is_admin)
                                        <button type="submit" class="btn btn-link btn-sm btn-rounded">
                                            Delete
                                        </button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            @endif
        </table>
    </div>
@endsection
