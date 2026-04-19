@extends('layouts.admin')

@section('title', $pageTitle)

@section('body')
<div>
    @if (session('success'))
        <div class="alert alert-success alert-sticky-msg1">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-sticky-msg1">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger alert-sticky-msg1">
            {{ $errors->first() }}
        </div>
    @endif 
    <div class="text-light d-flex align-items-center justify-content-center" style="background: var(--darkgray); height: 100vh;">
        <div class="card p-4 shadow" style="background: var(--black); width: 400px;">
            <div class="text-center" style="font-size: 40pt;">
                @include('shared_components.logo_static')
            </div>

            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label text-light">{{ $t['general']['email'] }}</label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-light">{{ $t['general']['password'] }}</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success w-100">{{ $t['general']['login'] }}</button>

                <a class="custom-link" href="{{ route('signup') }}">{{ $t['general']['create_account'] }}</a>

                <a class="return-home" href="{{ route('homepage') }}">
                    &larr; Return to Homepage
                </a>
            </form>
        </div>
    </div>
</div>
<style>
    .return-home {
        position: fixed;
        left: 24px;
        bottom: 24px;
        color: #9ad06a;
        text-decoration: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        z-index: 10;
    }

    .return-home:hover {
        color: #c6ff8a;
        text-shadow: 0 0 8px rgba(154, 208, 106, 0.45);
    }
</style>
@endsection