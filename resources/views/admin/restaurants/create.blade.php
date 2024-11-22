@extends('layouts.app')

@section('page-title', 'Restaurants')

@section('main-content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.restaurants.store') }}" method="POST">
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
                                required>
                          </div>
                          

                          <div>
                             <button type="submit" class="btn btn-primary">
                                Aggiungi ristorante
                             </button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection    