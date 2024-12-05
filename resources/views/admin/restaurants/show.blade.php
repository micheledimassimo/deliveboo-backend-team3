@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

@vite('resources/js/menuitems-search.js')

    <div class="w-85 dashboard p-5">

        <h3 class="text-white">
            Dashboard
        </h3>

        <div class="card mb-2 restaurant-header-card text-white">
            <div class="row p-3">
                <div class="col-6 col-lg-auto">
                    <div class="img-container rounded mb-sm-3 mb-lg-0">
                        @php
                            $defaultImage = "https://via.placeholder.com/300x200";
                            $imagePath = null;
                            if (!empty($restaurant->img)) {
                                if (Str::startsWith($restaurant->img, ['http://', 'https://'])) {
                                    $imagePath = $restaurant->img;
                                } elseif (file_exists(storage_path('app/public/' . $restaurant->img))) {
                                    $imagePath = asset('storage/' . $restaurant->img);
                                }
                            }
                        @endphp
                        <img src="{{ $imagePath ?? $defaultImage }}" alt="{{ $restaurant->restaurant_name ?? 'Placeholder image' }}">
                    </div>
                </div>

                <div class="col-6 text-end d-lg-none">
                    <button class="rounded-pill btn-orange" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Modifica Info</button>
                </div>

                <div class="col-12 col-lg">
                    <h3 class="card-title">{{ $restaurant->restaurant_name }}</h3>
                    <p class="mb-2">
                        <strong>Indirizzo:</strong> {{ $restaurant->address }}
                    </p>
                    <p class="mb-2">
                        <strong>Telefono:</strong> {{ $restaurant->phone_number }}
                    </p>
                    <p class="m-0">
                        <strong>Tipologie:</strong>
                        @foreach($restaurant->typologies as $typology)
                            <span class="badge my-badge">
                                {{ $typology->typology_name }}
                            </span>
                        @endforeach
                    </p>
                </div>

                <div class="d-none d-lg-block text-end col-lg-auto">
                    <button class="rounded-pill btn-orange" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Modifica Info</button>
                </div>

                {{-- offcanvas edit Ristorante --}}
                @include('components.off-canvas-edit-restaurant')

            </div>
        </div>

        <div class="card menu-item-card text-white">
            <div class="card-header d-flex justify-content-between">
                <h3>
                    Menu
                </h3>

                <div class="listing-container d-flex">
                    <span class="search-sauce">
                        <input 
                            type="text" 
                            id="searchMenuItems" 
                            class="form-control w-75 bg-transparent"
                            data-bs-theme="dark" 
                            placeholder="Cerca un piatto..."
                            onkeyup="filterMenuItems()">
                    </span>
                    <span class="js-add-sauce">
                        <a
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasWithBothOptions"
                            aria-controls="offcanvasWithBothOptions">
                            <i class="icon icon-add"></i>
                        </a>
                    </span>
                </div>
            </div>

            {{-- offcanvas con form per aggiunta piatto --}}
            @include('components.offcanvas-add-menu-items', ['restaurantSlug' => $restaurant->slug])

            <div class="overflow-y-auto p-3" id="menuItemsContainer">
                @foreach ($restaurant->menuItems as $menuItem)
                    <div class="row align-items-center group-list-item py-2 menu-item" data-name="{{ strtolower($menuItem->item_name) }}">
                        <div class="responsive col-12 mt-2 mb-3 col-md-2 me-md-2 mb-md-0 col-lg-2 col-xxl-1">
                            <div class="img-container rounded">
                                @php
                                    $defaultImage = "https://via.placeholder.com/300x200";
                                    $imagePath = null;
                                    if (!empty($menuItem->image)) {
                                        if (Str::startsWith($menuItem->image, ['http://', 'https://'])) {
                                            $imagePath = $menuItem->image;
                                        } elseif (file_exists(storage_path('app/public/' . $menuItem->image))) {
                                            $imagePath = asset('storage/' . $menuItem->image);
                                        }
                                    }
                                @endphp
                                <img src="{{ $imagePath ?? $defaultImage }}" alt="{{ $menuItem->item_name ?? 'Placeholder image' }}">
                            </div>
                            
                        </div>

                        <div class="info-responsive col-12 mb-3 col-md-6 mb-md-0 col-lg-6 col-xxl-7">
                            <h5 class="px-3">{{ $menuItem->item_name }}</h5>
                            <div class="px-3">
                                <small>Descrizione: {{ $menuItem->description }}</small><br>
                                <strong>Prezzo: €{{ $menuItem->price }}</strong>
                            </div>
                        </div>

                        <div class="responsive col-12 col-md-3 col-lg-3 col-xxl-auto d-flex flex-wrap align-items-center justify-content-center">
                            <div class="d-flex align-items-center rounded-pill my-pill text-bg-secondary mb-2 me-sm-3 me-md-0 me-xxl-2 mb-xxl-0">
                                <span class="align-center">Disponibile</span>
                                <span class="d-inline-block rounded-circle {{ $menuItem->is_visible === 1 ? 'my-bright-green' : 'my-bright-red' }} p-2 ms-2"></span>
                            </div>

                            <button class="rounded-pill my-pill mb-2 ms-sm-3 ms-md-0 mb-xl-0 me-xl-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithEdit{{ $menuItem->id }}" aria-controls="offcanvasWithEdit">
                                Modifica
                            </button>

                            {{-- offcanvas con form per modifica piatto --}}
                            @include('components.offcanvas-edit-menu-items', ['menuItem' => $menuItem, 'restaurantSlug' => $restaurant->slug])

                            <button type="button" class="rounded-pill my-pill-red btn-danger rounded-pill mb-2 mb-md-0 ms-sm-3 ms-md-0 ms-xl-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $menuItem->id }}">
                                Elimina
                            </button>

                            {{-- Modal --}}
                            @include('components.modal-delete-menu-items', ['menuItem' => $menuItem, 'restaurantSlug' => $restaurant->slug])
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection
