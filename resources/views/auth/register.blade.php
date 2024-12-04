@extends('layouts.guest')

@section('main-content')

    @error('phone_number')
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                <li>
                    Il numero di telefono contiene caratteri non permessi (sono ammessi + - ())
                </li>
            </ul>
        </div>
    @enderror

    @error('p_iva')
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                <li>
                    Sono ammessi solo numeri in partita IVA
                </li>
            </ul>
        </div>
    @enderror

    @error('typologies')
        <div class="alert alert-danger mb-4">
            Seleziona almeno una tipologia
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
    

    

    <div class="container login-container my-2">
        
        <div class="card">

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
                                        <label for="first_name">
                                            Nome <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control @error('first_name') is-invalid @enderror
                                    "
                                            type="text"
                                            id="first_name"
                                            name="first_name"
                                            
                                            minlength="3"
                                            maxlength="32"
                                            placeholder="Inserisci qui il tuo nome.."
                                            value="{{ old('first_name') }}"
                                            required>
                                            <div class="invalid-feedback">
                                                Il è obbligatorio e deve essere lungo massimo 32 caratteri.
                                            </div>
                                </div>
                                
                                <div class="col">
                                    <div>
                                        <label for="last_name">
                                            Cognome <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control @error('last_name') is-invalid @enderror
                                    "
                                            type="text"
                                            id="last_name"
                                            name="last_name"
                                            minlength="3"
                                            maxlength="32"
                                            placeholder="Inserisci qui il tuo cognome.."
                                            value="{{ old('last_name') }}"
                                            required
                                            >
                                            <div class="invalid-feedback">
                                                Il cognome è obbligatorio e deve essere lungo massimo 32 caratteri.
                                            </div>
                                </div>
                            </div>
    
                            
                            <div class="row mb-4">
                                <!-- Nome Attività -->
                                <div class="col-6">
                                    <div>
                                        <label for="restaurant_name">
                                            Nome attività <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control @error('restaurant_name') is-invalid @enderror
                                    "
                                            type="text"
                                            id="restaurant_name"
                                            name="restaurant_name"
                                            minlength="2"
                                            maxlength="128"
                                            placeholder="Inserisci qui il nome della tua attività.."
                                            value="{{ old('restaurant_name') }}"
                                            required>
                                            <div class="invalid-feedback">
                                                Il nome dell'attività è obbligatorio e deve essere lungo massimo 128 caratteri.
                                            </div>
                                </div>
                                <!-- Partita IVA -->
                                <div class="col-6">
                                    <div>
                                        <label for="p_iva">
                                            Numero Partita IVA <span class="text-danger">*</span> 
                                        </label>
                                    </div>
                                    <input class="form-control
                                    @error('p_iva') is-invalid @enderror
                                    "
                                            type="text"
                                            id="p_iva"
                                            name="p_iva"
                                            minlength="11"
                                            maxlength="11"
                                            placeholder="Inserisci qui la partita IVA.."
                                            value="{{ old('p_iva') }}"
                                            required>
                                            <div class="invalid-feedback">
                                                La partita iva è obbligatoria e deve essere lungo ESATTAMENTE 11 caratteri e DEVONO essere numeri.
                                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Indirizzo Attività -->
                                <div class="col-6 mb-4">
                                    <div>
                                        <label for="address">
                                            Indirizzo attività <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control @error('address') is-invalid @enderror
                                    "
                                            type="text"
                                            id="address"
                                            name="address"
                                            minlength="5"
                                            maxlength="128"
                                            placeholder="Inserisci qui l'indirizzo della tua attività.."
                                            value="{{ old('address') }}"
                                            required>
                                            <div class="invalid-feedback">
                                                L'indirizzo è obbligatorio e deve essere lungo almeno 3 caratteri.
                                            </div>
                                </div>
                                <!-- Numero di telefono attività -->
                                <div class="col-6 mb-4">
                                    <div>
                                        <label for="phone_number">
                                            Numero di telefono attività <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                    <input class="form-control
                                    @error('phone_number') is-invalid @enderror
                                    "
                                            type="text"
                                            id="phone_number"
                                            name="phone_number"
                                            minlength="5"
                                            maxlength="64"
                                            placeholder="Inserisci qui il telefono della tua attività.."
                                            value="{{ old('phone_number') }}"
                                            required>
                                            <div class="invalid-feedback">
                                                Il numero di telefono dell'attività è obbligatorio e deve essere lungo massimo 20 caratteri, e contenere solo numeri e simboli come + - ().
                                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Foto Ristorante -->
                                <div class="col-md-6 mb-4">
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

                                <!-- Tipologie Attività -->
                                <div class=" col-md-6 mb-3">
                                <label for="typologies" class="form-label p-0 m-0">
                                    Tipologie <span class="text-danger">*</span>
                                </label>
                                <div class="custom-dropdown-register">
                                    <button type="button" class="dropdown-button">
                                        <div class="row">
                                            <div class="col-11">
                                                <span class="dropdown-placeholder">
                                                    Seleziona massimo 4 tipologie
                                                </span>
                                                <span class="selected-values"></span>
                                            </div>
                                            <div class="col-1 px-1">
                                                <span>
                                                    <i class="fa-solid fa-chevron-down"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-list">
                                        <ul>
                                            @foreach($typologies as $index => $typology)
                                                <li data-checkbox-id="typology_{{ $typology->id }}">
                                                    <input type="checkbox" value="{{ $typology->id }}" id="typology_{{ $typology->id }}"
                                                           name="typologies[]" 
                                                           @if(old('typologies') && in_array($typology->id, old('typologies'))) checked @endif />
                                                    {{ $typology->typology_name }}
                                                </li>
                                                
                                            @endforeach
                                        </ul>
                                    </div>
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
                                    <input class="form-control 
                                    @error('email') is-invalid @enderror
                                    "
                                            type="email" id="email"
                                            name="email"
                                            maxlength="255"
                                            placeholder="Inserisci qui la tua email.."
                                            value="{{ old('email') }}"
                                            required>
                                            <div class="invalid-feedback">
                                                L'indirizzo email è obbligatorio e deve essere lungo massimo 255 caratteri, SENZA maiuscole.
                                            </div>
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
                            <div class="mb-2">
                                <p>
                                    <span class="text-danger">*</span> Tutti i campi sono obbligatori
                                </p>

                                <button class="btn btn-warning mb-3" type="submit">
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

        #typologies {
            font-size: 0.9rem;
        }
        .card {
            border-radius: 2%;
        }
    </style>

<script>
    // Typologies dropdown functionality
    const dropdownButton = document.querySelector('.dropdown-button');
    const dropdownList = document.querySelector('.dropdown-list');
    const selectedSpan = document.querySelector('.selected-values');
    const placeholderSpan = document.querySelector('.dropdown-placeholder');
    const checkboxes = document.querySelectorAll('.dropdown-list input[type="checkbox"]');
    const listItems = document.querySelectorAll('.dropdown-list li');

    dropdownButton?.addEventListener('click', e => {
        e.preventDefault();
        dropdownList.classList.toggle('show');
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', handleCheckboxChange);
    });

    listItems.forEach(li => {
        li.addEventListener('click', function (event) {
            // Evita di attivare la checkbox se l'utente ha cliccato direttamente su di essa
            if (event.target.tagName === 'INPUT') return;

            // Trova la checkbox associata
            const checkboxId = this.getAttribute('data-checkbox-id');
            const checkbox = document.getElementById(checkboxId);

            if (checkbox) {
                // Cambia lo stato della checkbox
                checkbox.checked = !checkbox.checked;
                // Triggera l'evento 'change' per aggiornare lo stato se necessario
                checkbox.dispatchEvent(new Event('change'));
            }
        });
    });

    function handleCheckboxChange() {
        const selectedCheckboxes = [...checkboxes].filter(cb => cb.checked);
        
        // Disabilita checkbox e <li> non selezionati se sono selezionate 4 opzioni
        if (selectedCheckboxes.length >= 4) {
            checkboxes.forEach(cb => {
                if (!cb.checked) {
                    cb.disabled = true; // Disable unchecked checkboxes
                    findParentLi(cb).classList.add('disabled'); // Disable corresponding <li>
                }
            });
        } else {
            // Riabilita tutti i checkbox e <li> se meno di 4 sono selezionati
            checkboxes.forEach(cb => {
                cb.disabled = false;
                findParentLi(cb).classList.remove('disabled');
            });
        }

        updateSelectedValues();
    }

    function updateSelectedValues() {
        const selectedValues = [...checkboxes]
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.parentElement.textContent.trim());
        selectedSpan.textContent = selectedValues.join(', ');
        placeholderSpan.style.display = selectedValues.length ? 'none' : 'inline';
    }

    function findParentLi(checkbox) {
        return checkbox.closest('li');
    }

    document.addEventListener('click', e => {
        if (!e.target.closest('.custom-dropdown-register')) dropdownList?.classList.remove('show');
    });
</script>


@endsection
