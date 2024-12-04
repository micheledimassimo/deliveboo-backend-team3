<div>
    <div>
        <div class="offcanvas restaurant-offcanvas offcanvas-top my-bg-lightdark" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-light" id="offcanvasTopLabel">Modifica dettagli ristorante</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form class="needs-validation" novalidate method="POST" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="restaurant_name" class="form-label fs-3 text-light">
                                    <span class="text-danger t">*</span> Nome Attività
                                </label>
                                <input
                                    type="text"
                                    class="form-control text-light my-bg-lightdark  @error('restaurant_name') is-invalid @enderror"
                                    id="restaurant_name" name="restaurant_name"
                                    minlength="3"
                                    maxlength="128"
                                    placeholder="Inserisci il nome della tua attività..."
                                    value="{{ old('restaurant_name', $restaurant->restaurant_name) }}"
                                    required>
                                <div class="invalid-feedback">
                                    Il nome della tua attività è obbligatorio e deve essere lungo almeno 3 caratteri.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="address" class="form-label text-light fs-3">
                                    <span class="text-danger">*</span> Indirizzo
                                </label>
                                <input
                                    type="text"
                                    class="form-control text-light my-bg-lightdark @error('address') is-invalid @enderror"
                                    id="address" name="address"
                                    minlength="3"
                                    maxlength="128"
                                    placeholder="Inserisci l'indirizzo della tua attività"
                                    value="{{ old('address', $restaurant->address) }}"
                                    required>
                                <div class="invalid-feedback">
                                    L'indirizzo è obbligatorio e deve essere lungo almeno 3 caratteri.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="phone_number" class="form-label text-light fs-3">
                                    <span class="text-danger">*</span> Numero di telefono
                                </label>
                                <input
                                    type="text"
                                    class="form-control my-bg-lightdark text-light @error('phone_number') is-invalid @enderror"
                                    id="phone_number" name="phone_number"
                                    minlength="6"
                                    maxlength="20"
                                    placeholder="Inserisci il numero di telefono..."
                                    value="{{ old('phone_number', $restaurant->phone_number) }}"
                                    required>
                                <div class="invalid-feedback">
                                    Il numero di telefono è obbligatorio (i caratteri ammessi sono: numeri + - () ).
                                </div>
                            </div>
                            <div class="col-md-6">
                                
                            </div>
                            <div class="text-light">
                                <label for="typologies" class="form-label fs-2">
                                    Tipologie
                                </label>
                                <div class="custom-dropdown">
                                    <button type="button" class="dropdown-button">
                                        <div class="row">
                                            <div class="col-11">
                                                <span class="dropdown-placeholder">
                                                    @php
                                                    $selectedTypologies = old('typologies', $restaurant->typologies->pluck('id')->toArray());
                                                    @endphp
                                                    @if (!empty($selectedTypologies))
                                                        {{ $typologies->whereIn('id', $selectedTypologies)->pluck('typology_name')->join(', ') }}
                                                    @else
                                                        Seleziona
                                                    @endif
                                                </span>
                                                <span class="selected-values"></span>
                                            </div>
                                            <div class="col-1">
                                                <span>
                                                    <i class="fa-solid fa-chevron-down"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                    <div class="dropdown-list">
                                        <ul>
                                            @foreach($typologies as $typology)
                                                <li data-checkbox-id="typology_{{ $typology->id }}">
                                                    <input type="checkbox" value="{{ $typology->id }}" 
                                                           name="typologies[]" 
                                                           @if($restaurant->typologies->contains($typology->id)) checked @endif />
                                                    {{ $typology->typology_name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="invalid-feedback">
                                    Seleziona almeno una tipologia.
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="mb-3">
                                <label for="img" class="form-label text-light fs-3">
                                    Immagine del Ristorante
                                </label>
                                <input
                                    class="form-control my-bg-lightdark text-light @error('img') is-invalid @enderror"
                                    type="file"
                                    id="img"
                                    name="img"
                                    accept="image/*"
                                    placeholder="Inserisci qui la foto del tuo ristorante..">
                                <div class="invalid-feedback">
                                    L'immagine deve essere un file valido e non superare i 2MB.
                                </div>
                                @if ($restaurant->img)
                                    <div class="mt-3 position-relative img-preview-wrapper">
                                        @if (filter_var($restaurant->img, FILTER_VALIDATE_URL))
                                        <img src="{{ $restaurant->img }}" alt="{{ $restaurant->restaurant_name }}" class="img-thumbnail">
                                        @else
                                        <img src="{{ asset('storage/'.$restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}" class="img-thumbnail">
                                        @endif
                                        
                                        <button type="button" class="remove-img-btn">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <input type="checkbox" id="remove_img" name="remove_img" class="d-none">
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="text-center my-5">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa-solid fa-pen-to-square"></i> Modifica
                            </button>
                        </div>
                    </div>
                    
                   
                </form>
            </div>
        </div>
    </div>
</div>

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
        if (!e.target.closest('.custom-dropdown')) dropdownList?.classList.remove('show');
    });
</script>


