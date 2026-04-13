@extends('layouts.admin')

@section('title', $pageTitle)

@section('body')
<div class="text-light d-flex align-items-center justify-content-center" style="background: var(--darkgray); height: 100vh;">
    <div class="card p-4 shadow" style="background: var(--black); width: 400px;">
        <div class="text-center" style="font-size: 40pt;">
            @include('shared_components.logo_static')
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

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

            <a class="custom-link" href="{{ route('admin.signin') }}">{{ $t['general']['create_account'] }}</a>
        </form>
    </div>
</div>
@endsection