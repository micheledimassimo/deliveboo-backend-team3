@extends('layouts.guest')

@section('main-content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <label for="first-name">
                Name
            </label>
            <input type="text" id="first-name" name="first-name">
        </div>

        <div class="mt-4"> 
            <label for="last-name">
               Surname
            </label>
            <input type="text" id="last-name" name="last-name">
        </div>

        <!-- Partita IVA -->
        <div class="mt-4">
            <label for="p-iva">
               Numero Partita IVA
            </label>
            <input type="text" id="p-iva" name="p-iva">
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">
                Email
            </label>
            <input type="email" id="email" name="email">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">
                Password
            </label>
            <input type="password" id="password" name="password">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">
                Conferma Password
            </label>
            <input type="password" id="password_confirmation" name="password_confirmation">
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
