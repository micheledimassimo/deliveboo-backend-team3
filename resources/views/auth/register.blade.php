@extends('layouts.guest')

@section('main-content')

    @if ($errors->any())

    <div class="alert alert-danger mb-4">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>

    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <label for="first-name">
                Name
            </label>
            <input type="text" id="first-name" name="first-name" required minlength="1" maxlength="32">
        </div>

        <div class="mt-4"> 
            <label for="last-name">
               Surname
            </label>
            <input type="text" id="last-name" name="last-name" required minlength="1" maxlength="32">
        </div>

        <!-- Partita IVA -->
        <div class="mt-4">
            <label for="p-iva">
               Numero Partita IVA
            </label>
            <input type="text" id="p-iva" name="p-iva" required minlength="11" maxlength="11">
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">
                Email
            </label>
            <input type="email" id="email" name="email" required maxlength="255">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">
                Password
            </label>
            <input type="password" id="password" name="password" required maxlength="64">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">
                Conferma Password
            </label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div>
            <a href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit">
                Register
            </button>
        </div>
    </form>
@endsection
