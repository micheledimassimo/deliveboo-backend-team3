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

    <div class="container my-5">
        
        <div class="card mb-3">

            <div class="row">
                <div class="col-md-4">
                    <img src="https://i.pinimg.com/736x/e9/3b/26/e93b26ba393c37f7846ad1978324d621.jpg" class="img-fluid rounded-start" alt="...">
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title">
                            Inizia a vendere su
                            <i class="fa-solid fa-burger"></i>
                            Delive<span class="text-warning">Boo</span>
                        </h3>
                        <p class="card-text">
                            Benvenuto! <br>
                            Ti aiuteremo a configurare il tuo account.
                            Ci vorranno solo pochi minuti.
                        </p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name + cognome -->
                            <div class="row mb-3">
                                <div class="col">
                                    <div>
                                        <label for="first-name">
                                            Nome <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control"
                                            type="text"
                                            id="first-name"
                                            name="first-name"
                                            required
                                            minlength="1"
                                            maxlength="32"
                                            placeholder="Inserisci qui il tuo nome..">
                                </div>
                                <div class="col">
                                    <div>
                                        <label for="last-name">
                                            Cognome <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control"
                                            type="text"
                                            id="last-name"
                                            name="last-name"
                                            required
                                            minlength="1"
                                            maxlength="32"
                                            placeholder="Inserisci qui il tuo cognome..">
                                </div>
                            </div>
    
                            <!-- Partita IVA -->
                            <div class="row mb-3">
                                <div class="col">
                                    <div>
                                        <label for="p-iva">
                                            Numero Partita IVA <span class="text-danger">*</span> 
                                        </label>
                                    </div>
                                    <input class="form-control"
                                            type="text"
                                            id="p-iva"
                                            name="p-iva"
                                            required
                                            minlength="11"
                                            maxlength="11"
                                            placeholder="Inserisci qui la partita IVA..">
                                </div>
                            </div>
    
                            <!-- Email Address -->
                            <div class="row mb-3">
                                <div class="col">
                                    <div>
                                        <label for="email">
                                            Email <span class="text-danger">*</span> 
                                        </label>
                                    </div>
                                    <input class="form-control"
                                            type="email" id="email"
                                            name="email"
                                            required
                                            maxlength="255"
                                            placeholder="Inserisci qui la tua email..">
                                </div>
                            </div>
    
                            <!-- Password + conferma -->
                            <div class="row mb-3">
                                <div class="col">
                                    <div>
                                    <label for="password">
                                        Password <span class="text-danger">*</span> 
                                    </label>
                                    </div>
                                    <input class="form-control"
                                            type="password"
                                            id="password"
                                            name="password"
                                            required
                                            maxlength="64"
                                            placeholder="Inserisci password..">
                                </div>
        
                                <div class="col">
                                    <div>
                                        <label for="password_confirmation">
                                            Conferma Password <span class="text-danger">*</span> 
                                        </label>
                                    </div>
                                    <input class="form-control"
                                            type="password"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            required
                                            placeholder="Conferma password..">
                                </div>
                            </div>

                            <div class="mb-3">
                                <p>
                                    <span class="text-danger">*</span> Tutti i campi sono obbligatori
                                </p>

                                <button class="btn btn-success mb-3" type="submit">
                                    Register
                                </button>
    
                                <div>
                                    <a href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
