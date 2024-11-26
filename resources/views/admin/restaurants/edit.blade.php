@extends('layouts.app')

@section('page-title', 'Modifica Ristorante')

@section('main-content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Modifica i Dettagli del Ristorante</h3>
                        <form class="needs-validation" novalidate method="POST" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant->id]) }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf

                            <div class="mb-3">
                                <label for="restaurant_name" class="form-label">
                                    <span class="text-danger">*</span> Nome Attività
                                </label>
                                <input
                                    type="text"
                                    class="form-control @error('restaurant_name') is-invalid @enderror"
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

                            <div class="mb-3">
                                <label for="address" class="form-label">
                                    <span class="text-danger">*</span> Indirizzo
                                </label>
                                <input
                                    type="text"
                                    class="form-control @error('address') is-invalid @enderror"
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

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">
                                    <span class="text-danger">*</span> Numero di telefono
                                </label>
                                <input
                                    type="text"
                                    class="form-control @error('phone_number') is-invalid @enderror"
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

                            <div class="mb-3">
                                <label for="img" class="form-label">
                                    Immagine del Ristorante
                                </label>
                                <input
                                    class="form-control @error('img') is-invalid @enderror"
                                    type="file"
                                    id="img"
                                    name="img"
                                    accept="image/*"
                                    placeholder="Inserisci qui la foto del tuo ristorante..">
                                <div class="invalid-feedback">
                                    L'immagine deve essere un file valido e non superare i 2MB.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="typologies" class="form-label">
                                    Tipologie
                                </label>
                                <div class="row">
                                    @foreach($typologies as $typology)
                                        <div class="col-2">
                                            <div>
                                                <label for="typologies">
                                                    {{ $typology->typology_name }}
                                                </label>
                                            </div>
                                            <input
                                                type="checkbox"
                                                id="typology_{{ $typology->id }}"
                                                name="typologies[]"
                                                value="{{ $typology->id }}"
                                                @if($restaurant->typologies->contains($typology->id)) checked @endif>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            @if ($restaurant->img)
                                <div class="mb-3">
                                    <label class="form-label">Immagine attuale</label>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('storage/'.$restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}" class="img-fluid" style="height: 100px; width: auto;">
                                        <div class="ms-3">
                                            <input type="checkbox" class="btn-check" id="remove_img" name="remove_img" autocomplete="off">
                                            <label class="btn btn-light" for="remove_img">
                                                <i class="fa-solid fa-trash fa-lg"></i> Rimuovi Immagine
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                    
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fa-solid fa-pen-to-square"></i> Modifica
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
