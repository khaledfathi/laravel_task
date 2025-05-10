
@extends('layouts.main')
@section('title', 'Message')
@section('scripts')
    <script src="{{ asset('assets/js/show_message.js') }}"></script>
@endsection

@section('content')

    {{-- errors --}}
    @if ($errors && count($errors))
        <div  class="container my-2 border-bottom">
            <h5  class="text-center text-danger">Errors</h5>
            @foreach ($errors->all() as $error)
                <h6 class="text-danger text-center">{{ $error }}</h6>
            @endforeach
        </div>
    @elseif (session()->has('success'))
        <div  id="flash-message" class="container my-3 border-bottom">
            <h5 class="text-success text-center">{{ session('success')}}</h5>
        </div>
    @endif
    {{-- /errors --}}

    <p>Errors and Flash message = ok</p>
    <p>need to add message and it's replies</p>

@endsection

