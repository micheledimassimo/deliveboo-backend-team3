@vite('resources/js/edit-restaurant.js')

<div>
    <div>
        <div class="offcanvas restaurant-offcanvas offcanvas-top my-bg-lightdark" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
            <div class="offcanvas-header">
                
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body restaurant-offcanvas-body">
                <h3 class="offcanvas-title text-light mb-3" id="offcanvasTopLabel">Modifica dettagli ristorante</h3>
                <p class="text-white">
                    <span class="text-danger text">*</span> Tutti i campi sono obbligatori
                </p>
                <form method="POST" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->id]) }}" enctype="multipart/form-data">
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

                    <div class="row">
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
                            
                            
                        </div>

                       <div class="col-md-6 col-sm-12">
                            <div class="text-light p-0 mb-3">
                                <label for="typologies" class="form-label fs-3">
                                    <span class="text-danger t">*</span> Tipologie
                                </label>
                                <div class="custom-dropdown p-0 m-0">
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
                    </div>
                    <div class="row">
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
                            </div>
                        </div>
                        <div>
                            @if ($restaurant->img)
                            <div class="position-relative img-preview-wrapper">
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
                    <div class="text-center mt-5">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fa-solid fa-pen-to-square"></i> Modifica
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




