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
                        <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->item_name }}" style="max-width: 200px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
