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
                        <img src="{{ asset('storage/' . $restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}" style="max-width: 200px;">
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
                <div class="card-header d-flex justify-content-between">
                    <h2>
                        Gestione piatti
                    </h2>

                    <button class="btn btn-primary"
                            type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasWithBothOptions"
                            aria-controls="offcanvasWithBothOptions">
                            Aggiungi un piatto
                    </button>
                </div>

                {{-- offcanvas con form per aggiunta piatto --}}
                <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                    {{-- bottone chiusura offcanvas --}}
                    <div class="offcanvas-header">
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" id="offcanvasWithBothOptionsLabel">Aggiungi i dettagli del nuovo piatto</h5>

                                {{-- errori --}}
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

                                {{-- form --}}
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

                {{-- tabella visualizzazione piatti --}}
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Nome Piatto</th>
                                <th>Descrizione</th>
                                <th>Prezzo</th>
                                <th>Immagine</th>
                                <th>Visibile</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurant->menuItems as $menuItem)
                                <tr>
                                    <td class="align-middle">{{ $menuItem->item_name }}</td>
                                    <td class="align-middle">{{ $menuItem->description }}</td>
                                    <td class="align-middle">€{{ $menuItem->price }}</td>
                                    <td class="align-middle text-center">
                                        @if (!empty($menuItem->image) && file_exists(storage_path('app/public/' . $menuItem->image)))
                                            <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->item_name }}" style="max-width: 200px;">
                                        @else
                                            <img src="https://via.placeholder.com/100" alt="Placeholder image" class="img-thumbnail">
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if ($menuItem->is_visible)
                                            <span class="badge bg-success">Sì</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>

                                    {{-- modifica ed elimina --}}
                                    <td class="align-middle text-center">

                                        <div class="d-flex justify-content-center">

                                            {{-- modifica del piatto --}}
                                            <div class="me-2">

                                                <button class="btn btn-warning"
                                                    type="button" data-bs-toggle="offcanvas"
                                                    data-bs-target="#offcanvasWithEdit"
                                                    aria-controls="offcanvasWithEdit">
                                                    Modifica
                                                </button>

                                                {{-- offcanvas con form per aggiunta piatto --}}
                                                <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithEdit" aria-labelledby="offcanvasWithEditLabel">
                                                    {{-- bottone chiusura offcanvas --}}
                                                    <div class="offcanvas-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <div class="offcanvas-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title" id="offcanvasWithEditLabel">Modifica i dettagli del piatto</h5>

                                                                {{-- errori --}}
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

                                                                {{-- form --}}
                                                                <form action="{{ route('admin.menu_items.update', [$menuItem ->id]) }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method ('PUT')

                                                                    <input type="hidden" name="restaurant_slug" value="{{ $restaurant->slug }}">
                                                                    <div class="mb-3">
                                                                        <label for="item_name" class="form-label">Nome <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="item_name" name="item_name" required minlength="3" maxlength="255" value="{{ old('item_name', $menuItem->item_name) }}" placeholder="Inserisci il nome...">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="description" class="form-label">Descrizione</label>
                                                                        <input type="text" class="form-control" id="description" name="description" required minlength="10" maxlength="1024" value="{{ old('description', $menuItem->description) }}" placeholder="Inserisci la descrizione del piatto...">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" id="price" name="price" required value="{{ old('price', $menuItem->price) }}" placeholder="Inserisci il prezzo..." min="0.01" step="0.01">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="image" class="form-label">Immagine</label>
                                                                        <input type="file" class="form-control" id="image" name="image" minlength="3" maxlength="2048" placeholder="Carica un immagine per il tuo piatto...">
                                                                        @if ($menuItem->image)
                                                                            <div class="mt-2 d-flex flex-column">
                                                                                <h5>
                                                                                    Immagine attuale:
                                                                                </h5>
                                                                                <img src="{{ asset('storage/'.$menuItem->image) }}" alt="{{ $menuItem->item_name }}" style="height: 150px;">

                                                                                <input type="checkbox" class="btn-check" id="remove_image" name="remove_image" maxlength="1024" autocomplete="off">
                                                                                <label class="btn btn-light mt-2" for="remove_image">
                                                                                    <i class="fa-solid fa-trash fa-lg object-fit-contain"></i>
                                                                                </label>

                                                                            </div>
                                                                        @endif
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
                                                                        <button type="submit" class="btn btn-warning w-100">
                                                                            Modifica
                                                                        </button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- elimina piatto --}}
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $menuItem->id }}">
                                                Elimina
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="deleteModal{{ $menuItem->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $menuItem->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel{{ $menuItem->id }}">
                                                                Elimina il piatto
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body text-start">
                                                            Sei sicur* di voler eliminare il piatto: <strong>{{$menuItem->item_name}}</strong>?
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Indietro</button>
                                                            <form action="{{ route('admin.menu_items.destroy', [$menuItem->id]) }}" method="POST">

                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">

                                                                    Elimina

                                                                </button>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

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
