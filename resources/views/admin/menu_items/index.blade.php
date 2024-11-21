@extends('layouts.app')

@section('page-title', 'Tutte i tipi')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutti i tipi
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('admin.menu_items.create') }}" class="btn btn-success w-100">
                + Aggiungi
            </a>
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
                                <th scope="col" class="text-center">Nome</th>
                                <th scope="col" class="text-center">Prezzo</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menuItems as $item)
                                <tr>
                                    <th scope="row">
                                        {{ $item->id }}
                                    </th>

                                    <td class="text-center">
                                        {{ $item->item_name }}
                                    </td>

                                    <td class="text-center">
                                        {{ $item->price }} &euro;
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
