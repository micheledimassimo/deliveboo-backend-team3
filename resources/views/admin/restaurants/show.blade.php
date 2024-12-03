@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

    <div class="vh-100 w-85 dashboard">

        <div class="d-flex flex-column my-5 px-5">

            <div>

                <h3 class="text-white">
                    Dashboard
                </h3>
                <div>
                    {{-- Informazioni Ristorant --}}
                    <div class="card mb-4 restaurant-header-card text-white">
                        <div class="row pt-5 g-0 align-items-center">
                            <!-- Immagine ristorante -->
                            <div class="img-container col-12 col-md-4 col-lg-3">
                                @if (!empty($restaurant->img))
                                    @if (Str::startsWith($restaurant->img, ['http://', 'https://']))
                                        <img src="{{ $restaurant->img }}" alt="{{ $restaurant->restaurant_name }}">
                                    @elseif (file_exists(storage_path('app/public/' . $restaurant->img)))
                                        <img src="{{ asset('storage/' . $restaurant->img) }}" alt="{{ $restaurant->restaurant_name }}">
                                    @else
                                        <img src="https://via.placeholder.com/300x200" alt="Placeholder image">
                                    @endif
                                @else
                                    <img src="https://via.placeholder.com/300x200" alt="Placeholder image">
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
                                            <span class="badge my-badge">
                                                {{ $typology->typology_name }}
                                            </span>
                                        @endforeach
                                    </p>
                                </div>
                            </div>

                            {{-- OFFCANVAS RESTAURANT EDIT + BUTTON --}}
                            <div class="col-12 col-md-1 text-md-end">
                                <button class="rounded-pill btn-orange" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Modifica Info</button>
                            </div>
                            @include('components.off-canvas-edit-restaurant')
                        </div>
                    </div>
                </div>
            </div>



            <div class="card menu-item-card text-white">
                <div class="card-header d-flex justify-content-between">
                    <h2>
                        Menu
                    </h2>

                    <div class="listing-container">
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

                {{-- tabella visualizzazione piatti --}}

                <div class="overflow-y-auto px-4">
                    @foreach ($restaurant->menuItems as $menuItem)
                        <div class="row align-items-center group-list-item py-2">
                            <!-- Colonna per l'immagine -->
                            <div class="responsive col-12 col-md-2 col-lg-2 col-xl-2 col-xxl-1 mb-3 mb-md-0">
                                <div class="img-container">
                                    @if (!empty($menuItem->image))
                                    @if (Str::startsWith($menuItem->image, ['http://', 'https://']))
                                        <img src="{{ $menuItem->image }}" alt="{{ $menuItem->item_name }}">
                                    @elseif (file_exists(storage_path('app/public/' . $menuItem->image)))
                                        <img src="{{ asset('storage/' . $menuItem->image) }}" alt="{{ $menuItem->item_name}}">
                                    @else
                                        <img src="https://via.placeholder.com/300x200" alt="Placeholder image">
                                    @endif
                                @else
                                    <img src="https://via.placeholder.com/300x200" alt="Placeholder image">
                                @endif
                                </div>
                            </div>

                            <!-- Info menu-item -->
                            <div class="info-responsive col-12 col-md-6 col-lg-5 col-xl-5 col-xxl-7 mb-3 mb-md-0">
                                <h5 class="px-3">{{ $menuItem->item_name }}</h5>
                                <div class="px-3">
                                    <small>Descrizione: {{ $menuItem->description }}</small><br>
                                    <strong>Prezzo: €{{ $menuItem->price }}</strong>
                                </div>

                            </div>

                            <div class="responsive col-12 col-md-4 col-lg-5 col-xl-5 col-xxl-4 d-flex flex-wrap align-items-center ">
                                <!-- Disponibilità -->
                                <div class="d-flex align-items-center rounded-pill my-pill text-bg-secondary mb-2 me-3">
                                    <span class="align-center">Disponibile</span>
                                    <span class="d-inline-block rounded-circle {{ $menuItem->is_visible === 1 ? 'my-bright-green' : 'my-bright-red' }} p-2 ms-2"></span>
                                </div>

                                <!-- Modifica -->
                                <button class="rounded-pill my-pill mb-2 ms-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithEdit{{ $menuItem->id }}" aria-controls="offcanvasWithEdit">
                                    Modifica
                                </button>

                                <!-- offcanvas con form per modifica piatto -->
                                @include('components.offcanvas-edit-menu-items', ['menuItem' => $menuItem, 'restaurantSlug' => $restaurant->slug])

                                <!-- Bottone Elimina -->
                                <button type="button" class="rounded-pill my-pill-red btn-danger rounded-pill mb-2 ms-4" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $menuItem->id }}">
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
@endsection
