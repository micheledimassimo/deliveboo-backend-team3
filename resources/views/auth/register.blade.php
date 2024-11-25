@extends('layouts.guest')

@section('main-content')

    @error('email')
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                <li>
                    Email già registrata
                </li>
            </ul>
        </div>
    @enderror

    @error('password')
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                <li>
                    Le password non coincidono
                </li>
            </ul>
        </div>
    @enderror
    

    

    <div class="container login-container my-3">
        
        <div class="card mb-1">

            <div class="row">
                <div class="col-md-4 rounded-start"> </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h2 class="card-title mb-3">
                            Inizia a vendere su
                            <i class="fa-solid fa-burger"></i>
                            Delive<span class="text-warning">Boo</span>
                        </h2>
                        <h5 class="card-text mb-0">
                            Benvenuto!
                        </h5>
                        <p>
                            Ti aiuteremo a configurare il tuo account.
                            Ci vorranno solo pochi minuti.
                        </p>

                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- Name + cognome -->
                            <div class="row mb-4">
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
                            <div class="row mb-4">
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
                            <!-- Nome Attività -->
                            <div class="col mb-4">
                                    <div>
                                        <label for="restaurant-name">
                                            Nome attività <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control"
                                            type="text"
                                            id="restaurant-name"
                                            name="restaurant-name"
                                            required
                                            minlength="1"
                                            maxlength="128"
                                            placeholder="Inserisci qui il nome della tua attività..">
                                </div>

                            <!-- img -->
                            <div class="col mb-4">
                                <div>
                                    <label for="img">
                                        Foto ristorante
                                    </label>
                                </div>
                                <input class="form-control"
                                        type="file"
                                        id="img"
                                        name="img"
                                        minlength="1"
                                        maxlength="2048"
                                        placeholder="Inserisci qui la foto del tuo ristorante..">
                            </div>

                            <!-- Indirizzo Attività -->
                            <div class="col mb-4">
                                    <div>
                                        <label for="address">
                                            Indirizzo attività <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control"
                                            type="text"
                                            id="address"
                                            name="address"
                                            required
                                            minlength="1"
                                            maxlength="128"
                                            placeholder="Inserisci qui l'indirizzo della tua attività..">
                            </div>
                            <!-- Numero di telefono attività -->
                            <div class="col mb-4">
                                    <div>
                                        <label for="phone-number">
                                            Numero di telefono attività <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control"
                                            type="text"
                                            id="phone-number"
                                            name="phone-number"
                                            required
                                            minlength="1"
                                            maxlength="64"
                                            placeholder="Inserisci qui il telefono della tua attività..">
                                </div>
                                <!-- Typologies Checkboxes -->
                                <div class="col mb-4">
                                    <div class="mb-4">
                                        Tipologia/e Attività
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Italiano">
                                                    Italiano
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Italiano"
                                                    name="Italiano"
                                                    value="Italiano"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Messicano">
                                                    Messicano
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Messicano"
                                                    name="Messicano"
                                                    value="Messicano"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Cinese">
                                                    Cinese
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Cinese"
                                                    name="Cinese"
                                                    value="Cinese"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Pizzeria">
                                                    Pizzeria
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Pizzeria"
                                                    name="Pizzeria"
                                                    value="Pizzeria"
                                                    >
                                        </div>
                                            
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Sushi">
                                                    Sushi
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Sushi"
                                                    name="Sushi"
                                                    value="Sushi"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Paninoteca">
                                                    Paninoteca
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Paninoteca"
                                                    name="Paninoteca"
                                                    value="Paninoteca"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Kebab">
                                                    Kebab
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Kebab"
                                                    name="Kebab"
                                                    value="Kebab"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Ramen">
                                                    Ramen
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Ramen"
                                                    name="Ramen"
                                                    value="Ramen"
                                                    >
                                        </div>
                                            
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Pub">
                                                    Pub
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Pub"
                                                    name="Pub"
                                                    value="Pub"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Gelateria">
                                                    Gelateria
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Gelateria"
                                                    name="Gelateria"
                                                    value="Gelateria"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Pasticceria">
                                                    Pasticceria
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Pasticceria"
                                                    name="Pasticceria"
                                                    value="Pasticceria"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Hamburgeria">
                                                    Hamburgeria
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Hamburgeria"
                                                    name="Hamburgeria"
                                                    value="Hamburgeria"
                                                    >
                                        </div>
                                            
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Pesce">
                                                    Pesce
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Pesce"
                                                    name="Pesce"
                                                    value="Pesce"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Pasta">
                                                    Pasta
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Pasta"
                                                    name="Pasta"
                                                    value="Pasta"
                                                    >
                                        </div>
                                        <div class="col">
                                        
                                            <div>
                                                <label for="Carne">
                                                    Carne
                                                </label>
                                            </div>
                                            <input
                                                    type="checkbox"
                                                    id="Carne"
                                                    name="Carne"
                                                    value="Carne"
                                                    >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Email Address -->
                            <div class="row mb-4">
                                <div class="col">
                                    <div>
                                        <label for="email">
                                            Email <span class="text-danger">*</span> 
                                        </label>
                                    </div>
                                    <input class="form-control 
                                    @error('email') is-invalid @enderror
                                    "
                                            type="email" id="email"
                                            name="email"
                                            required
                                            maxlength="255"
                                            placeholder="Inserisci qui la tua email..">
                                </div>
                            </div>
    
                            <!-- Password + conferma -->
                            <div class="row mb-4">
                                <div class="col">
                                    <div>
                                    <label for="password">
                                        Password <span class="text-danger">*</span> 
                                    </label>
                                    </div>
                                    <input class="form-control 
                                    @error('password') is-invalid @enderror
                                    "
                                            type="password"
                                            id="password"
                                            name="password"
                                            required
                                            minlength="8"
                                            maxlength="64"
                                            placeholder="Inserisci password..">
                                </div>
        
                                <div class="col">
                                    <div>
                                        <label for="password_confirmation">
                                            Conferma Password <span class="text-danger">*</span> 
                                        </label>
                                    </div>
                                    <input class="form-control
                                    @error('password') is-invalid @enderror
                                    "
                                            type="password"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            required
                                            minlength="8"
                                            maxlength="64"
                                            placeholder="Conferma password..">
                                </div>
                            </div>

                            {{-- submit --}}
                            <div class="mb-4">
                                <p>
                                    <span class="text-danger">*</span> Tutti i campi sono obbligatori
                                </p>

                                <button class="btn btn-success mb-3" type="submit">
                                    Registrati
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

    <style scoped>
        .col-md-4{
            background-image: url('https://i.pinimg.com/736x/e9/3b/26/e93b26ba393c37f7846ad1978324d621.jpg')
        }
    </style>

@endsection
