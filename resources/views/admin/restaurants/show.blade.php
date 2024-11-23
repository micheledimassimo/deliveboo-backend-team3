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
                    @if (!empty($restaurant->img) && file_exists(storage_path('app/public/' . $restaurant->img)))
                        <img src="{{ asset('storage/' . $restaurant->img) }}" alt="{{ $restaurant->item_name }}" style="max-width: 200px;">
                    @else
                        <img src="https://via.placeholder.com/100" alt="Placeholder image" class="img-thumbnail">
                    @endif
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

                <div class="card">
                    <div class="card-body">

                        @if ($errors->any())

                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                
                    @endif

                        <form action="{{ route('admin.menu_items.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <input type="hidden" name="restaurant_slug" value="{{ $restaurant->slug }}">
                            <div class="mb-3">
                                <label for="item_name" class="form-label">Nome <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="item_name" name="item_name" required minlength="3" maxlength="255" value="{{ old('item_name') }}" placeholder="Inserisci il nome...">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrizione</label>
                                <input type="text" class="form-control" id="description" name="description" required minlength="10" maxlength="1024" value="{{ old('description') }}" placeholder="Inserisci la descrizione del piatto...">
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="price" name="price" required value="{{ old('price') }}" placeholder="Inserisci il prezzo..." min="0.01" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Immagine</label>
                                <input type="file" class="form-control" id="image" name="image" minlength="3" maxlength="2048" placeholder="Carica un immagine per il tuo piatto...">
                            </div>
                            <div class="mb-3">
    
                                <div class="form-check">
    
                                    <input class="form-check-input" type="checkbox" value="1" id="is_visible" name="is_visible"
    
                                        @if (old('is_visible') !== null)
    
                                            checked
    
                                        @endif
                                    >
    
                                    <label for="is_visible" class="form-label">Disponibile</label>
    
    
                                </div>
                            </div>
    
                            <div>
                                <button type="submit" class="btn btn-success w-100">
                                    + Aggiungi
                                </button>
                            </div>
    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection