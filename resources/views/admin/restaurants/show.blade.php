@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

    <div class="vh-100 w-85" id="dashboard">

        <div class="row mx-auto mt-4 px-5">

            <h3 class="text-white">
                Dashboard
            </h3>
            <div class="col">
                {{-- Informazioni Ristorant --}}
                <div class="card mb-4 restaurant-header-card text-white">
                    <div class="row g-0 d-flex align-items-center">
                        <!-- Immagine ristorante -->
                        <div class="img-container col-12 col-md-4 col-lg-3">
                            @if (!empty($restaurant->img) && file_exists(storage_path('app/public/' . $restaurant->img)))
                                <img
                                    src="{{ asset('storage/' . $restaurant->img) }}"
                                    alt="{{ $restaurant->restaurant_name }}">
                            @else
                                <img
                                    src="https://via.placeholder.com/300x200"
                                    alt="Placeholder image">
                            @endif
                        </div>
                
                        <div class="col-12 col-md-7 col-lg-8">
                            <div class="card-body">
                                <!-- Nome ristorante -->
                                <h1 class="card-title">{{ $restaurant->restaurant_name }}</h1>
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
                
                        <div class="col-12 col-md-1 text-md-end">
                            <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->id]) }}" class="btn rounded-pill">
                                Modifica
                            </a>
                        </div>
                    </div>
                </div>
            </div>

                <div class="card menu-item-card text-white">
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
                    @include('components.offcanvas-add-menu-items', ['restaurantSlug' => $restaurant->slug])

                    {{-- tabella visualizzazione piatti --}}

                    <div class="group-list">
                        @foreach ($restaurant->menuItems as $menuItem)
                            <div class="row align-items-center group-list-item py-2">
                                <div class="col-2">
                                    <div class="img-container">
                                        @if (!empty($menuItem->image) && file_exists(storage_path('app/public/' . $menuItem->image)))
                                        <img class="img-width-200" src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->item_name }}">
                                        @else
                                        <img src="https://via.placeholder.com/100" alt="Placeholder image" class="img-thumbnail">
                                        @endif
                                    </div>
                                </div>
                                {{-- Info menu-items --}}
                                <div class="col">
                                    <h5>{{ $menuItem->item_name }}</h5>
                                    <small>Ingredienti: {{ $menuItem->description }}</small><br>
                                    <strong>Prezzo: €{{ $menuItem->price }}</strong>
                                </div>

                                <div class="col-4 d-flex justify-content-end">
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

                                    {{-- BOTTONE MODIFICA PIATTO --}}
                                    <div class="me-2">
                                        <button class="rounded-pill btn btn-warning"
                                            type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasWithEdit{{ $menuItem->id }}"
                                            aria-controls="offcanvasWithEdit">
                                            Modifica
                                        </button>
                                    </div>

                                    {{-- offcanvas con form per modifica piatto --}}
                                    @include('components.offcanvas-edit-menu-items', ['menuItem' => $menuItem, 'restaurantSlug' => $restaurant->slug])
                                    
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $menuItem->id }}">
                                        Elimina
                                    </button>

                                    <!-- Modal -->
                                    @include('components.modal-delete-menu-items', ['menuItem' => $menuItem, 'restaurantSlug' => $restaurant->slug])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
