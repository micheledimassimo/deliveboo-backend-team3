
@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

    <div class="vh-100 w-85 dashboard" >

        <div class="my-5 px-5">

            <h3 class="text-white">
                Ordini
            </h3>
            <div class="d-flex justify-content-center">
                <!-- Controlli di navigazione -->
                <button class="btn my-btn-carousel me-3 rounded-circle" id="prevBtn" type="button" data-bs-target="#ordersCarousel" data-bs-slide="prev" disabled>
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button class="btn my-btn-carousel rounded-circle" id="nextBtn" type="button" data-bs-target="#ordersCarousel" data-bs-slide="next" >
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <div id="ordersCarousel" class="carousel slide">
                <!-- Contenitore del carosello -->
                <div class="carousel-inner">

                    @foreach ($orders->chunk(4) as $index => $orderChunk)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($orderChunk as $order)
                                    <div class="col-lg-3 col-md-6 col-sm-12 pt-4">
                                        <div class="card h-100 text-white my-bg-dark">
                                            <div class="card-body">
                                                <h5>Ordine N. {{ $orders->count() - (($loop->parent->iteration - 1) * 4 + $loop->iteration) + 1 }}</h5>
                                                <hr>
                                                <h5 class="fw-bold">Dati cliente</h5>
                                                <div>
                                                    <span class="fw-bold">Nome</span><br>
                                                    <span>{{ $order['customer_name'] ?? 'Non disponibile' }}</span>
                                                </div>
                                                <div>
                                                    <span class="fw-bold">Email</span><br>
                                                    <span>{{ $order['customer_email'] ?? 'Non disponibile' }}</span>
                                                </div>
                                                <div>
                                                    <span class="fw-bold">Indirizzo</span><br>
                                                    <span>{{ $order['customer_address'] ?? 'Non disponibile' }}</span>
                                                </div>
                                                <div>
                                                    <span class="fw-bold">Cellulare</span><br>
                                                    <span>{{ $order['customer_number'] ?? 'Non disponibile' }}</span>
                                                </div>
                                                <hr>
                                                <h5 class="fw-bold">Piatti ordinati</h5>
                                                <ul class="list-unstyled">
                                                    @foreach ($order['menu_items'] as $menuItem)
                                                        <li>
                                                            <strong>{{ $menuItem['item_name'] }}</strong>: {{ $menuItem['quantity'] ?? 1 }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <hr>
                                                <p><strong>Data <br></strong> {{ $order['created_at']->format('d/m/Y') }}</p>
                                                <p><strong>Totale: </strong>{{ number_format($order['total_price'], 2) }} €</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @vite('resources/js/carouselControls.js')
@endpush
