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

                    @foreach ($restaurant->menuItems as $menuItem)
                        <div class="m-3">
                            <h5>
                                Nome piatto: {{ $menuItem->item_name }}
                            </h5>
                            <p>
                                Descrizione piatto: {{ $menuItem->description }}
                            </p>
                            <p>
                                Costo: ${{ $menuItem->price }}
                            </p>
                            @if ($menuItem->is_visible)
                                <p><em>Visible to customers</em></p>
                            @else
                                <p><em>Not visible to customers</em></p>   
                            @endif
                            @if ($menuItem->image)
                                <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->item_name }}" style="max-width: 200px;">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection