@extends('layouts.app')

@section('page-title', 'Tutti i ristoranti')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutti i ristoranti
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id Piatto</th>
                                <th scope="col" class="text-center">Ristorante</th>
                                <th scope="col" class="text-center">Indirizzo</th>
                                <th scope="col" class="text-center">Numero di telefono</th>
                                <th scope="col" class="text-center">Azioni</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurants as $restaurant)
                                <tr>
                                    <th scope="row">
                                        {{ $restaurant->id }}
                                    </th>

                                    <td class="text-center">
                                        {{ $restaurant->restaurant_name }}
                                    </td>

                                    <td class="text-center">
                                        {{ $restaurant->address }}
                                    </td>

                                    <td class="text-center">
                                        {{ $restaurant->phone_number }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.restaurants.show', [$restaurant->id]) }}" class="btn btn-primary btn-sm">
                                            Vedi
                                        </a>
                                        <a href="{{ route('admin.restaurants.edit', [$restaurant->id]) }}" class="btn btn-warning btn-sm">
                                            Modifica
                                        </a>
                                        <form action="{{ route('admin.restaurants.destroy', [$restaurant->id]) }}" method="post" class="d-inline-block"
                                            onsubmit="return confirm('Sei sicur* di voler eliminare il ristorante?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Elimina
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
