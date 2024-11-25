@extends('layouts.app')

@section('page-title', 'Restaurants')

@section('main-content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
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
                                    L'indirizzo è obbligatorio e deve essere lungo almeno 3 caratteri.
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
                                maxlength="15"
                                placeholder="Inserisci il numero di telefono..."
                                value="{{ old('phone_number', $restaurant->phone_number) }}"
                                required>
                            <div class="invalid-feedback">
                                Il numero di telefono è obbligatorio.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="img" class="form-label">
                                Immagine ristorante
                            </label>
                            <input
                                class="form-control @error('img') is-invalid @enderror"
                                type="file"
                                id="img"
                                name="img"
                                minlength="1"
                                maxlength="2048"
                                placeholder="Inserisci qui la foto del tuo ristorante..">
                            <div class="invalid-feedback">
                                L'immagine deve essere un file valido e non superare i 2MB.
                            </div>

                            @if ($restaurant->img)
                                <div class="mt-2">
                                    <h5>Immagine attuale:</h5>
                                    <div class="d-flex flex-column w-25">
                                        <img src="{{ asset('storage/'.$restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}" style="height: 150px;">
                                        <input type="checkbox" class="btn-check" id="remove_img" name="remove_img" autocomplete="off">
                                        <label class="btn btn-light mt-2" for="remove_img">
                                            <i class="fa-solid fa-trash fa-lg object-fit-contain"></i>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary">
                                Modifica
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection