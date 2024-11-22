@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Informazioni ristorante</h2>
                </div>
                <div class="card-body">
                    <p><strong>Nome:</strong> <span>{{ $restaurant->restaurant_name }}</span></p>
                    <p><strong>Indirizzo:</strong> <span>{{ $restaurant->address }}</p>
                    <p><strong>Telefono:</strong> <span>{{ $restaurant->phone_number }}</span></p>
                    <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->id]) }}" class="btn btn-primary">
                        Modifica Dettagli Ristorante
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2>
                        Gestione piatti
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                          <tr>
                            <th>Nome Piatto</th>
                            <th>Descrizione</th>
                            <th>Prezzo</th>
                            <th>Immagine</th>
                            <th>Visibile</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($restaurant->menuItems as $menuItem)
                          <tr>
                            <td>{{ $menuItem->item_name }}</td>
                            <td>{{ $menuItem->description }}</td>
                            <td>€{{ $menuItem->price }}</td>
                            <td>
                                @if (!empty($menuItem->image) && file_exists(storage_path('app/public/' . $menuItem->image)))
                                    <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->item_name }}" style="max-width: 200px;">
                                @else
                                    <img src="https://via.placeholder.com/100" alt="Placeholder image" class="img-thumbnail">
                                @endif
                            </td>
                            <td>
                                @if ($menuItem->is_visible)
                                    <span class="badge bg-success">Sì</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
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