@extends('layouts.admin')

@section('title', $pageTitle)

@section('body')
<div class="text-light d-flex align-items-center justify-content-center" style="background: var(--darkgray); height: 100vh;">
    <div class="card p-4 shadow" style="background: var(--black); width: 700px;">
        <div class="text-center" style="font-size: 40pt;">
            @include('shared_components.logo_static')
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="signInForm" class="mt-4 mb-0" action="{{ route('admin.signin.auth') }}" method="POST">
            @csrf

            <div class="mb-3">
                <h2 class="text-light text-center" style="color: var(--admin-label-color-1) !important;">Create a new account</h2>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-light">Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-light">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-light">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label text-light">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <div>
                <button type="submit" class="btn btn-success w-100">Sign In</button>
            </div>

            <div class="mt-3">
                <a class="custom-link" href="{{ route('admin.login') }}">Already have an account?</a>
            </div>
        </form>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form#signInForm');

        const formInputFields = form.querySelectorAll('input');
        formInputFields.forEach(input => {
            input.setAttribute('autocomplete', 'off');
        });
    });

    
</script>