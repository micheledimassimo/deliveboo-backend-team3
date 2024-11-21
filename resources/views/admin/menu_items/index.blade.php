@extends('layouts.app')

@section('page-title', 'Tutte i piatti')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Tutti i piatti
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
                                <th scope="col" class="text-center">Azioni</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menuItems as $menuItem)
                                <tr>
                                    <th scope="row">
                                        {{ $menuItem->id }}
                                    </th>

                                    <td class="text-center">
                                        {{ $menuItem->item_name }}
                                    </td>

                                    <td class="text-center">
                                        {{ $menuItem->price }} &euro;
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.menu_items.show', [$menuItem->id]) }}" class="btn btn-primary btn-sm">
                                            Vedi
                                        </a>
                                        <a href="{{ route('admin.menu_items.edit', [$menuItem->id]) }}" class="btn btn-warning btn-sm">
                                            Modifica
                                        </a>
                                        <form action="{{ route('admin.menu_items.destroy', [$menuItem->id]) }}" method="post" class="d-inline-block"
                                            onsubmit="return confirm('Sei sicur* di voler eliminare questo tipo?')">
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
