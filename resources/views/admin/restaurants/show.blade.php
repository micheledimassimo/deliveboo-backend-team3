@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <a href="{{ route('admin.restaurants.edit',['restaurant' => $restaurant->id]) }}" class="btn btn-primary">
                    Modifica
                </a>
            </div>
            <div class="card">
                <div class="card-body">

                    <h4>
                        Ristorante: {{ $restaurant->restaurant_name }}
                    </h4>

                    <ul>
                        <li>
                            Indirizzo: {{ $restaurant->address }}
                        </li>
                        <li>
                            Numero di telefono: {{ $restaurant->phone_number }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection