@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')


    <div class="vh-100 w-85 bg-black" id="dashboard">


        <div class="row mx-auto mt-4 px-5">

            <h3 class="text-white">
                Dashboard
            </h3>
            <div class="col">

                <div class="card mb-4 shadow-sm">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h2>Informazioni ristorante</h2>
                        <div class="my-3">
                            <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->id]) }}" class="btn btn-warning border rounded-pill align-middle text-white fw-bold">
                                Modifica
                            </a>
                        </div>
                    </div>
                    <div class="row g-0">
                        <!-- Immagine ristorante -->
                        <div class="col-md-4">
                            @if (!empty($restaurant->img) && file_exists(storage_path('app/public/' . $restaurant->img)))
                                <img
                                    src="{{ asset('storage/' . $restaurant->img) }}"
                                    alt="{{ $restaurant->restaurant_name }}"
                                    class="img-fluid h-100">
                            @else
                                <img
                                    src="https://via.placeholder.com/300x200"
                                    alt="Placeholder image"
                                    class="img-fluid h-100">
                            @endif
                        </div>

                        <div class="col-md-8">
                            <div class="card-body">
                                <!-- Nome ristorante -->
                                <p class="card-title">
                                    <strong>Nome attività:</strong> {{ $restaurant->restaurant_name }}
                                </p>

                                <!-- Indirizzo -->
                                <p class="mb-2">
                                    <strong>Indirizzo:</strong> {{ $restaurant->address }}
                                </p>

                                <!-- Telefono -->
                                <p class="mb-2">
                                    <strong>Telefono:</strong> {{ $restaurant->phone_number }}
                                </p>

                                <!-- Tipologie -->
                                <p>
                                    <strong>Tipologie:</strong>
                                    @foreach($restaurant->typologies as $typology)
                                        <span class="badge rounded-pill text-bg-success px-3 py-2">
                                            {{ $typology->typology_name }}
                                        </span>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="card text-white bg-dark">
                    <div class="card-header d-flex justify-content-between">
                        <h2>
                            Menu
                        </h2>
                        <div>
                            <button class="btn btn-warning border rounded-circle align-middle text-white fw-bold"
                                type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasWithBothOptions"
                                aria-controls="offcanvasWithBothOptions">
                                +
                            </button>
                        </div>

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

                                    {{-- form --}}
                                    <form action="{{ route('admin.menu_items.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <input type="hidden" name="restaurant_slug" value="{{ $restaurant->slug }}">
                                        <div class="mb-3">
                                            <label for="item_name" class="form-label">Nome <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('item_name') is-invalid @enderror" id="item_name" name="item_name" required minlength="3" maxlength="255" value="{{ old('item_name') }}" placeholder="Inserisci il nome...">

                                            @if($errors->has('item_name'))
                                                <div>

                                                    @foreach($errors->get('item_name') as $key => $error)
                                                        <span class="text-danger">
                                                            Il campo nome è obbligatorio, inserire almeno tre caratteri
                                                        </span>
                                                    @endforeach

                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Descrizione</label>
                                            <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required minlength="10" maxlength="1024" value="{{ old('description') }}" placeholder="Inserisci la descrizione del piatto...">

                                            @if($errors->has('description'))
                                                <div>

                                                    @foreach($errors->get('description') as $key => $error)
                                                        <span class="text-danger">
                                                            Il campo descrizione è obbligatorio, inserire almeno dieci caratteri
                                                        </span>
                                                    @endforeach

                                                </div>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" required value="{{ old('price') }}" placeholder="Inserisci il prezzo..." min="0.01" step="0.01">

                                            @if($errors->has('price'))
                                                <div>

                                                    @foreach($errors->get('price') as $key => $error)
                                                        <span class="text-danger">
                                                            Il campo prezzo non accetta valori negativi
                                                        </span>
                                                    @endforeach

                                                </div>
                                            @endif

                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Immagine</label>
                                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" minlength="3" maxlength="2048" placeholder="Carica un immagine per il tuo piatto...">
                                        </div>
                                        <div class="mb-3">

                                            <div class="form-check">

                                                <input class="form-check-input @error('is_visible') is-invalid @enderror" type="checkbox" value="1" id="is_visible" name="is_visible"
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
                    <div>

                        <div>
                            <ul class="group-list py-2">
                                @foreach ($restaurant->menuItems as $menuItem)
                                    <li class="row align-items-center group-list-item py-2">
                                        <div class="col-2">
                                            <div>
                                                @if (!empty($menuItem->image) && file_exists(storage_path('app/public/' . $menuItem->image)))
                                                <img class="img-width-200" src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->item_name }}">
                                            @else
                                                <img src="https://via.placeholder.com/100" alt="Placeholder image" class="img-thumbnail">
                                            @endif
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h4>
                                                {{ $menuItem->item_name }}
                                            </h4>
                                            <h6>
                                                Ingredienti: {{ $menuItem->description }}
                                            </h6>
                                            <h5>
                                                Prezzo: €{{ $menuItem->price }}
                                            </h5>
                                        </div>

                                        <div class="col-4">
                                            <div class="d-flex justify-content-center">


                                                @if ($menuItem->is_visible === 1)
                                                    <div class="d-flex align-items-center badge rounded-pill text-bg-secondary me-2">
                                                        <div>
                                                            <span class="align-center">Disponibile</span>
                                                        </div>
                                                        <div>
                                                            <span class="d-inline-block rounded-circle bg-success p-1"></span>
                                                        </div>

                                                    </div>

                                                    @else
                                                    <div class="d-flex align-items-center badge rounded-pill text-bg-secondary me-2">
                                                        <div>
                                                            <span class="align-center">Disponibile</span>
                                                        </div>
                                                        <div>
                                                            <span class="d-inline-block rounded-circle bg-danger p-1"></span>
                                                        </div>

                                                    </div>
                                                @endif

                                                {{-- modifica del piatto --}}
                                                <div class="me-2">

                                                    <button class=" rounded-pill btn btn-warning"
                                                        type="button" data-bs-toggle="offcanvas"
                                                        data-bs-target="#offcanvasWithEdit{{ $menuItem->id }}"
                                                        aria-controls="offcanvasWithEdit">
                                                        Modifica
                                                    </button>
                                                </div>

                                                {{-- offcanvas con form per modifica piatto --}}
                                                <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithEdit{{ $menuItem->id }}" aria-labelledby="offcanvasWithEditLabel">
                                                    {{-- bottone chiusura offcanvas --}}
                                                    <div class="offcanvas-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>
                                                    <div class="offcanvas-body">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <h5 class="card-title" id="offcanvasWithEditLabel">Modifica i dettagli del piatto</h5>




                                                                {{-- form --}}
                                                                <form action="{{ route('admin.menu_items.update', [$menuItem ->id]) }}" method="POST" enctype="multipart/form-data" >
                                                                    @csrf
                                                                    @method ('PUT')

                                                                    <input type="hidden" name="restaurant_slug" value="{{ $restaurant->slug }}">
                                                                    <div class="mb-3">
                                                                        <label for="item_name" class="form-label">Nome <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control @error('item_name') is-invalid @enderror"  id="item_name" name="item_name" required minlength="3" maxlength="255" value="{{ old('item_name', $menuItem->item_name) }}" placeholder="Inserisci il nome...">
                                                                        @if($errors->has('item_name'))
                                                                            <div>

                                                                                @foreach($errors->get('item_name') as $key => $error)
                                                                                    <span class="text-danger">
                                                                                        Il campo nome è obbligatorio, inserire almeno tre caratteri
                                                                                    </span>
                                                                                @endforeach

                                                                            </div>
                                                                        @endif


                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="description" class="form-label">Descrizione</label>
                                                                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" required minlength="10" maxlength="1024" value="{{ old('description', $menuItem->description) }}" placeholder="Inserisci la descrizione del piatto...">

                                                                        @if($errors->has('description'))
                                                                            <div>

                                                                                @foreach($errors->get('description') as $key => $error)
                                                                                    <span class="text-danger">
                                                                                        Il campo descrizione è obbligatorio, inserire almeno dieci caratteri
                                                                                    </span>
                                                                                @endforeach

                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" required value="{{ old('price', $menuItem->price) }}" placeholder="Inserisci il prezzo..." min="0.01" step="0.01" max="99.99">

                                                                        @if($errors->has('price'))
                                                                            <div>

                                                                                @foreach($errors->get('price') as $key => $error)
                                                                                    <span class="text-danger">
                                                                                        Il campo prezzo non accetta valori negativi
                                                                                    </span>
                                                                                @endforeach

                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="image" class="form-label">Immagine</label>
                                                                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" minlength="3" maxlength="2048" placeholder="Carica un immagine per il tuo piatto...">
                                                                        @if ($menuItem->image)
                                                                            <div class="mt-2 d-flex flex-column">
                                                                                <h5>Immagine attuale:</h5>
                                                                                <img class="h-150" src="{{ asset('storage/'.$menuItem->image) }}" alt="{{ $menuItem->itemname }}">

                                                                                <button type="button" class="btn btn-danger btn-sm mt-2" id="remove_image{{ $menuItem->id }}"
                                                                                        onclick="document.getElementById('removeimage_input{{ $menuItem->id }}').checked = true;">
                                                                                    <i class="fas fa-times"></i> <!-- Icona "X" -->
                                                                                </button>

                                                                                <input class="d-none" type="checkbox" id="removeimage_input{{ $menuItem->id }}" name="remove_image" value="1">
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="mb-3">

                                                                        <div class="form-check">

                                                                            <input class="form-check-input @error('is_visible') is-invalid @enderror" type="checkbox" value="1" id="is_visible" name="is_visible"
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


                                                {{-- elimina piatto --}}
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $menuItem->id }}">
                                                    Elimina
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade text-dark" id="deleteModal{{ $menuItem->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $menuItem->id }}" aria-hidden="true">
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
                                        </div>

                                    </li>
                                @endforeach
                            </ul>
                        </div>




                    </div>
                </div>
            </div>
        </div>

    </div>




@endsection
