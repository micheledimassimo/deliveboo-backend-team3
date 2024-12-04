@extends('layouts.guest')

@section('main-content')


    <div class="container d-flex justify-content-center my-3">
        <div class="card shadow">
            <div class="card-img-top"></div>
            
            <div class="card-body">
                <div class="text-center">
                    <h2 class="card-title">
                        <i class="fa-solid fa-burger text-warning"></i> Delive<span class="text-warning">Boo</span>
                    </h2>
                    <h5 class="card-text mb-0">
                        Bentornato!
                    </h5>
                    <p>
                        Accedi al tuo account per visualizzare i tuoi dati.
                    </p>
                </div>

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
        
                    <!-- Email Address -->
                    <div class="row mb-4">
                        <div class="col">
                            <div>
                                <label for="email">
                                    Email
                                </label>
                            </div>

                            <input class="form-control
                            @error('email') @enderror
                            "
                                    type="email"
                                    id="email"
                                    name="email">
                        </div>
                    </div>
        
                    <!-- Password -->
                    <div class="row mb-4">
                        <div class="col">
                            <div>
                                <label for="password">
                                    Password
                                </label>
                            </div>
                            <input class="form-control 
                            @error('password') @enderror
                            "
                                    type="password"
                                    id="password"
                                    name="password">
                        </div>
                    </div>
        
                    <!-- Remember Me -->
                    <div class="row text-center mb-4">
                        <div class="col">
                            <label for="remember_me">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>Rimani collegato</span>
                            </label>
                        </div>
                    </div>
        
                    {{-- button + forgot pw --}}
                    <div class="mb-4 text-center">
                        <button class="btn btn-success mb-4" type="submit">
                            Log in
                        </button>

                        <div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">
                                    {{ __('Password dimenticata?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style scoped>
        .card{
            width: 50%;
        }
        .card-img-top{
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-position: center;
            background-image: url('https://i.pinimg.com/736x/e9/3b/26/e93b26ba393c37f7846ad1978324d621.jpg')
        }
    </style>

@endsection
