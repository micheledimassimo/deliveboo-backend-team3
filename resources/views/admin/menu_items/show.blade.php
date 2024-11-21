@extends('layouts.app')

@section('page-title', $menuItem->item_name)

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        {{ $menuItem->item_name }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between mb-4">
        <div>
            <a href="{{ route('admin.menu_items.edit', [$menuItem->id]) }}" class="btn btn-warning">
                Modifica
            </a>
            <form action="{{ route('admin.menu_items.destroy', [$menuItem->id]) }}" method="post" class="d-inline-block"
                onsubmit="return confirm('Sei sicur* di voler eliminare questo piatto?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Elimina
                </button>
            </form>
        </div>

        <div>

            <a href="{{ route('admin.menu_items.index', [$menuItem->id]) }}" class="btn btn-primary me-2">

                Indietro

            </a>


        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li>
                            ID: {{ $menuItem->id }}
                        </li>
                        <li>
                            Slug: {{ $menuItem->slug }}
                        </li>
                        <li>
                            Prezzo: {{ $menuItem->price }} &euro;
                        </li>
                        <li>
                            Descrizione: {{ $menuItem->description }}
                        </li>
                        <li>

                            Disponibile: {{ $menuItem->is_visible ? 'SI' : 'NO'  }}
                        </li>

                    </ul>

                    <div>
                        <img src="https://www.moltofood.it/wp-content/uploads/2024/03/Bistecca.jpg" alt="" class="w-25">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
