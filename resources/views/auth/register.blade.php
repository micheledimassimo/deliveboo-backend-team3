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
            <div>
                <label for="first-name">
                    Nome
                </label>
            </div>
            <input type="text" id="first-name" name="first-name" required minlength="1" maxlength="32" placeholder="Inserisci qui il tuo nome..">
        </div>

        <div class="mt-4"> 
            <div>
                <label for="last-name">
                Cognome
                </label>
            </div>
            <input type="text" id="last-name" name="last-name" required minlength="1" maxlength="32" placeholder="Inserisci qui il tuo cognome..">
        </div>

        <!-- Partita IVA -->
        <div class="mt-4">
            <div>
                <label for="p-iva">
                Numero Partita IVA
                </label>
            </div>
            <input type="text" id="p-iva" name="p-iva" required minlength="11" maxlength="11" placeholder="Inserisci qui la partita IVA..">
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <div>
                <label for="email">
                    Email
                </label>
            </div>
            <input type="email" id="email" name="email" required maxlength="255" placeholder="Inserisci qui la tua email..">
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div>
            <label for="password">
                Password
            </label>
            </div>
            <input type="password" id="password" name="password" required maxlength="64" placeholder="Inserisci password..">
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div>
                <label for="password_confirmation">
                    Conferma Password
                </label>
            </div>
            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Conferma password..">
        </div>

        <div class="mt-4">
            <a href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button class="mx-2" type="submit">
                Register
            </button>

            <p>
                Tutti i campi sono obbligatori
            </p>
        </div>
    </form>
@endsection
