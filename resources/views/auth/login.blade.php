@extends('layouts.guest')

@section('page-title', 'Accedi')

@section('main-content')

    <div class="container d-flex justify-content-center mt-4">
        <div class="card shadow">
            <div class="card-img-top text-center d-flex flex-column justify-content-center">
                <h2 class="mb-3 mt-0">
                    Bentornato!
                </h2>
                <p class="mb-0">
                    Accedi al tuo account per visualizzare i tuoi dati.
                </p>
            </div>
            
            <div class="card-body p-5">
                @error('email')
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            <li>
                                Credenziali errate
                            </li>
                        </ul>
                    </div>
                @enderror

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center text-uppercase fw-bold fs-5 text-warning mb-4">
                       User Login
                    </div>

                    <div class="row mb-4 mt-3">
                        <div class="col input-group px-5">
                            <div class="input-group-text rounded-left border-right-0 border-warning bg-warning" id="basic-addon1">
                                <label for="email">
                                    <i class="fa-solid fa-user"></i>
                                </label>
                            </div>

                            <input class="form-control rounded-right border-left-0 
                            @error('email') @enderror
                            "
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Usermail">
                        </div>
                    </div>
        
                    <div class="row mb-4">
                        <div class="col input-group px-5">
                            <div class="input-group-text rounded-left border-right-0 border-warning bg-warning" id="basic-addon1">
                                <label for="password">
                                    <i class="fa-solid fa-lock"></i>
                                </label>
                            </div>
                            <input class="form-control rounded-right border-left-0 
                            @error('password') @enderror
                            "
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Password">
                        </div>
                    </div>
        
                    <div class="row justify-content-between ms-3 mb-4 p-1">
                        <div class="col ms-2">
                            <label for="remember_me">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>Rimani collegato</span>
                            </label>
                        </div>
                        <div class="col ms-5">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Password dimenticata?') }}
                                </a>
                            @endif
                        </div>
                    </div>
        
                    <div class="text-center">
                        <button class="btn btn-warning my-3 rounded-pill px-4" type="submit">
                            Log in
                        </button>               
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style scoped>
        h2{
            font-family: "Knewave", system-ui;
            font-size: 3rem;
        }
        .card{
            width: 50%;
            border-bottom-left-radius: 5%;
            border-bottom-right-radius: 5%;
        }

        .card-img-top{
            height: 200px;
            /* object-fit: cover; */
            background-position: center;
            background-image: url('/bg.jpg');   
        }


        @media (max-width:1050px){

            .card{

                width: 80%;
            }
        }

        @media (max-width:768px){

            .card{

                width: 100%;
            }
        }
    </style>

@endsection
