
@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

    <div class="vh-100 w-85 my-bg-black text-white">

        <div class="row p-5">
            @foreach ($orders as $order)
                <div class="col-4">
                    <div class="card h-100 text-white my-bg-dark">
                        <div class="card-body">
                            <h5>Ordine ID: {{ $order['order_id'] }}</h5>
                            <hr>
                            <h5>Dati cliente</h5>


                            <h6>Email:</h6>

                            <p> {{ $order['customer_email'] ?? 'Non disponibile' }}</p>

                            <h6>Nome:</h6>

                            <p>{{ $order['customer_name'] ?? 'Non disponibile' }}</p>

                            <h6>Indirizzo:</h6>

                            <p> {{ $order['customer_address'] ?? 'Non disponibile' }}</p>

                            <h6>Cellulare:</h6>

                            <p>{{ $order['customer_number'] ?? 'Non disponibile' }}</p>
                            <hr>
                            <h5 class="fw-bold">Piatti ordinati:</h5>

                            <ul class="list-unstyled">
                                @foreach ($order['menu_items'] as $menuItem)
                                    <li>
                                        <strong>{{ $menuItem['item_name'] }}</strong>: {{ $menuItem['quantity'] ?? 1 }}
                                    </li>
                                @endforeach
                            </ul>
                            <p>Totale: <strong>{{ number_format($order['total_price'], 2) }} €</strong></p>
                            <hr>
                        </div>


                    </div>
                </div>
            @endforeach
        </div>


    </div>
@endsection
