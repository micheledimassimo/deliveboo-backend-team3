<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/svg+xml" href="/DELIVEBOO.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('page-title') | DeliveBoo</title>

        @vite('resources/js/app.js')

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"|
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        {{-- font --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Knewave&display=swap" rel="stylesheet">
    </head>

    <body class="my-bg-lightgray">

        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary my-1">
                <div class="container">

                    <a class="navbar-brand d-flex align-items-center" href="{{ env('FRONTEND_URL') }}">
                        <img class="logo me-2" src="/DELIVEBOO.png" alt="Deliveboo">
                        <span class="fs-5">
                            Delive<strong class="text-warning">Boo</strong>
                        </span>
                    </a>

                    

                    <div id="navbarText">
                        <ul class="d-flex p-0 mb-2 mb-lg-0">
                           
                                <li class="list-group-item me-3">
                                    <button class="btn btn-outline-dark border-dark-subtle rounded-pill px-4">
                                        <a class="nav-link p-0 text-warning" href="{{ route('login') }}">
                                            Accedi
                                        </a>
                                    </button>
                                </li>
                                <li class="list-group-item">
                                    <button class="btn btn-outline-dark border-dark-subtle rounded-pill px-4">
                                        <a class="nav-link p-0 text-warning" href="{{ route('register') }}">
                                            Registrati
                                        </a>
                                    </button>
                                </li>
                            
                        </ul>

                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-outline-danger">
                                    Log Out
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4">
            <div class="container">
                @yield('main-content')
            </div>
        </main>
    </body>
</html>
