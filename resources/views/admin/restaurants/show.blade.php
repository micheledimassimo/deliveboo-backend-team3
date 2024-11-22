@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')
    <div class="row">
        <div class="col">
            <h2>
                Ristorante
            </h2>
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