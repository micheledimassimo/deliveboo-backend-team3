<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title') | {{ config('app.name', 'Deliveboo') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')

        {{-- fontawesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"|
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>

        <main>
            <div class="d-flex vh-100">
                <div class="d-flex flex-column vh-100 flex-shrink-0 fixed-top p-3 text-white side-bar">

                    <h2 class="my-4 text-center">
                        <i class="fa-solid fa-burger"></i> DeliveBoo</span>
                    </h2>

                    <ul class="nav nav-pills flex-column mb-auto mx-auto">

                        <li class='fs-4 fw-bold'>
                            <a href="{{ route('admin.restaurants.show',[$restaurant->slug]) }}" class="nav-link text-white btn btn-outline-dark rounded-pill fit-content">
                                <i class="fa-solid fa-utensils"></i>
                                <span>
                                    Dashboard
                                </span>
                            </a>
                          </li>

                      <li class='fs-4 fw-bold'>
                        <a href="{{ route('admin.restaurants.orders', ['slug' => $restaurant->slug]) }}" class="nav-link text-white btn btn-outline-dark rounded-pill fit-content">
                            <i class="fa-solid fa-file-lines"></i>
                            <span>
                                Ordini
                            </span>
                        </a>
                      </li>
                      <li class='fs-4 fw-bold'>
                        <a href="{{ route('admin.restaurants.statistics', ['slug' => $restaurant->slug]) }}" class="nav-link text-white btn btn-outline-dark rounded-pill fit-content">
                            <i class="fa-solid fa-chart-column"></i>
                            <span>
                                Statistiche
                            </span>
                        </a>
                      </li>
                      <li class='fs-4 fw-bold'>
                        <a href="{{ env('FRONTEND_URL') }}" class="nav-link text-white btn btn-outline-dark rounded-pill" style="width:fit-content">

                            <i class="fa-solid fa-house"></i>

                            <span>
                                Homepage
                            </span>
                        </a>
                      </li>

                    </ul>

                    <div class="d-flex justify-content-end">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="btn btn-outline-danger">
                                <span class="fw-bold">
                                    Log Out
                                </span>

                            </button>
                        </form>
                    </div>
                </div>
                @yield('main-content')
            </div>
        </main>
    </body>
</html>
