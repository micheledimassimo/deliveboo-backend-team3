@extends('layouts.guest')

@section('main-content')

    @error('phone-number')
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                <li>
                    Il numero di telefono contiene caratteri non permessi (sono ammessi + - ())
                </li>
            </ul>
        </div>
    @enderror

    @error('p-iva')
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                <li>
                    Sono ammessi solo numeri in partita IVA
                </li>
            </ul>
        </div>
    @enderror

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
                                            <div class="invalid-feedback">
                                                Il è obbligatorio e deve essere lungo massimo 32 caratteri.
                                            </div>
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
                                            <div class="invalid-feedback">
                                                Il cognome è obbligatorio e deve essere lungo massimo 32 caratteri.
                                            </div>
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
                                    <input class="form-control
                                    @error('p-iva') is-invalid @enderror
                                    "
                                            type="text"
                                            id="p-iva"
                                            name="p-iva"
                                            required
                                            minlength="11"
                                            maxlength="11"
                                            placeholder="Inserisci qui la partita IVA..">
                                            <div class="invalid-feedback">
                                                La partita iva è obbligatoria e deve essere lungo ESATTAMENTE 11 caratteri e DEVONO essere numeri.
                                            </div>
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
                                            <div class="invalid-feedback">
                                                Il nome dell'attività è obbligatorio e deve essere lungo massimo 128 caratteri.
                                            </div>
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
                                            <div class="invalid-feedback">
                                                L'indirizzo è obbligatorio e deve essere lungo almeno 3 caratteri.
                                            </div>
                            </div>
                            <!-- Numero di telefono attività -->
                            <div class="col mb-4">
                                    <div>
                                        <label for="phone-number">
                                            Numero di telefono attività <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control
                                    @error('phone-number') is-invalid @enderror
                                    "
                                            type="text"
                                            id="phone-number"
                                            name="phone-number"
                                            required
                                            minlength="1"
                                            maxlength="64"
                                            placeholder="Inserisci qui il telefono della tua attività..">
                                            <div class="invalid-feedback">
                                                Il numero di telefono dell'attività è obbligatorio e deve essere lungo massimo 20 caratteri, e contenere solo numeri e simboli come + - ().
                                            </div>
                                </div>
                                <!-- Typologies Checkboxes -->
                                <div class="mb-3">
                                    <label for="typologies" class="form-label">
                                        Tipologie Attività
                                    </label>
                                    <div class="row">
                                        @foreach($typologies as $index => $typology)
                                            <div class="col-md-2 mb-3">
                                                <div>
                                                    <label for="typology_{{ $typology->id }}">
                                                        {{ $typology->typology_name }}
                                                    </label>
                                                </div>
                                                <input
                                                    type="checkbox"
                                                    id="typology_{{ $typology->id }}"
                                                    name="typologies[]"
                                                    value="{{ $typology->id }}"
                                                    @if(old('typologies') && in_array($typology->id, old('typologies'))) checked @endif>
                                            </div>
                                        @endforeach
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
                                            <div class="invalid-feedback">
                                                L'indirizzo email è obbligatorio e deve essere lungo massimo 255 caratteri, SENZA maiuscole.
                                            </div>
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
                                            <div class="invalid-feedback">
                                                La password è obbligatoria e deve essere lungo almeno 8 caratteri e  massimo 64, caratteri speciali compresi.
                                            </div>
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
                                            <div class="invalid-feedback">
                                                La password è obbligatoria e deve essere lungo almeno 8 caratteri e  massimo 64, caratteri speciali compresi.
                                            </div>
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
                                        {{ __('Già registrato?') }}
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
