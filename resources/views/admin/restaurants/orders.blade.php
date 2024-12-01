
@extends('layouts.app')

@section('page-title', $restaurant->restaurant_name)

@section('main-content')

    <div class="vh-100 w-85 dashboard" >

        <div class="my-5 px-5">

            <h3 class="text-white">
                Ordini
            </h3>

            <div class="row">
                @foreach ($orders as $order)
                    <div class="col-4 pt-4">
                        <div class="card h-100 text-white my-bg-dark">
                            <div class="card-body">
                                <h5>Ordine N. {{ $order['order_id'] }}</h5>
                                <hr>
                                <h5 class="fw-bold">Dati cliente</h5>
                                <div>
                                    <span class="fs-6 fw-bold">Nome:</span class="fs-6 fw-bold">

                                    <span>{{ $order['customer_name'] ?? 'Non disponibile' }}</span>
                                </div>

                                <div>
                                    <span class="fs-6 fw-bold">Email:</span class="fs-6 fw-bold">

                                    <span> {{ $order['customer_email'] ?? 'Non disponibile' }}</span>
                                </div>

                                <div>
                                    <span class="fs-6 fw-bold">Indirizzo:</span class="fs-6 fw-bold">

                                    <span> {{ $order['customer_address'] ?? 'Non disponibile' }}</span>
                                </div>

                                <div>
                                    <span class="fs-6 fw-bold">Cellulare:</span class="fs-6 fw-bold">

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
                                <p><strong>Effettuato il :</strong> {{ $order['created_at']->format('d/m/Y') }} </p>
                                <p><strong>Totale: </strong>{{ number_format($order['total_price'], 2) }} €</p>
                                <hr>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>
        </div>




    </div>
@endsection
