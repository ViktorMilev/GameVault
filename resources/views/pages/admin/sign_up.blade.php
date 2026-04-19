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
        <div class="card p-4 shadow" style="background: var(--black); width: 700px;">
            <div class="text-center" style="font-size: 40pt;">
                @include('shared_components.logo_static')
            </div>

            @if($errors->any())
                <div class="alert alert-danger alert-sticky-msg1">
                    {{ $errors->first() }}
                </div>
            @endif

            <form id="signInForm" class="mt-4 mb-0" action="{{ route('admin.signup.auth') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <h2 class="text-light text-center" style="color: var(--admin-label-color-1) !important;">{{ $t['general']['create_account'] }}</h2>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label text-light">{{ $t['general']['username'] }}</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-light">{{ $t['general']['email'] }}</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-light">{{ $t['general']['password'] }}</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-light">{{ $t['general']['confirm_password'] }}</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>

                <div>
                    <button type="submit" class="btn btn-success w-100">{{ $t['general']['sign_up'] }}</button>
                </div>

                <div class="mt-3">
                    <a class="custom-link" href="{{ route('admin.login') }}">{{ $t['general']['login_prompt'] }}</a>
                </div>
            </form>
        </div>
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