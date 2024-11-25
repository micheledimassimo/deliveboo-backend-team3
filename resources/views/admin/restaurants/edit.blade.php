@extends('layouts.app')

@section('page-title', 'Restaurants')

@section('main-content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.restaurants.update', ['restaurant' => $restaurant ->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label
                                for="restaurant_name"
                                class="form-label">
                                <span class="text-danger">*</span>
                                Nome Attività
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="restaurant_name" name="restaurant_name"
                                minlength="3"
                                maxlength="128"
                                placeholder="Inserisci il nome della tua attività..."
                                value="{{ old('restaurant_name', $restaurant->restaurant_name) }}"
                                required>
                          </div>

                          <div class="mb-3">
                            <label
                                for="address"
                                class="form-label">
                                <span class="text-danger">*</span>
                                Indirizzo
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="address" name="address"
                                minlength="3"
                                maxlength="128"
                                placeholder="Inserisci l'indirizzo della tua attività"
                                value="{{ old('address', $restaurant->address) }}"
                                required>
                          </div>

                          <div class="mb-3">
                            <label
                                for="phone_number"
                                class="form-label">
                                <span class="text-danger">*</span>
                                Numero di telefono
                            </label>
                            <input
                                type="text"
                                class="form-control"
                                id="phone_number" name="phone_number"
                                minlength="3"
                                maxlength="128"
                                placeholder="Inserisci il numero di telefono..."
                                value="{{ old('phone_number', $restaurant->phone_number) }}"
                                required>
                          </div>

                          <div class="mb-3">
                            <label
                                for="img"
                                class="form-label">
                                <span class="text-danger">*</span>
                                Immagine ristorante
                            </label>
                            <input class="form-control"
                                    type="file"
                                    id="img"
                                    name="img"
                                    minlength="1"
                                    maxlength="2048"
                                    placeholder="Inserisci qui la foto del tuo ristorante..">

                                    @if ($restaurant->img)
                                        <div class="mt-2">
                                            <h5>
                                                Immagine attuale:
                                            </h5>
                                            <img src="{{ asset('storage/'.$restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}" style="height: 150px;">

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="remove_img" name="remove_img">
                                                <label class="form-check-label" for="remove_img">
                                                    Rimuovi immagine attuale
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
