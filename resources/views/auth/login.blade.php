@extends('layouts.guest')

@section('main-content')


    <div class="container d-flex justify-content-center mt-5">
        <div class="card shadow">
            <div class="card-img-top"></div>
            
            <div class="card-body p-5">
                <div class="text-center card-top">
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
                    <div class="text-center text-uppercase fw-medium text-warning mb-2">
                       User Login
                    </div>
                    <!-- Email Address -->
                    <div class="row mb-4 mt-3">
                        <div class="col input-group px-5">
                            <div class="input-group-text rounded-left border-0 border-warning bg-warning" id="basic-addon1">
                                <label for="email">
                                    <i class="fa-solid fa-user"></i>
                                </label>
                            </div>

                            <input class="form-control rounded-right border-0 bg-warning
                            @error('email') @enderror
                            "
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="Usermail">
                        </div>
                    </div>
        
                    <!-- Password -->
                    <div class="row mb-4">
                        <div class="col input-group px-5">
                            <div class="input-group-text rounded-left border-0 border-warning bg-warning" id="basic-addon1">
                                <label for="password">
                                    <i class="fa-solid fa-lock"></i>
                                </label>
                            </div>
                            <input class="form-control rounded-right border-0 bg-warning
                            @error('password') @enderror
                            "
                                    type="password"
                                    id="password"
                                    name="password"
                                    placeholder="Password">
                        </div>
                    </div>
        
                    <!-- Remember Me -->
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
        
                    {{-- button + forgot pw --}}
                    <div class="mb-4 text-center">
                        <button class="btn btn-warning mb-4" type="submit">
                            Log in
                        </button>

                       
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style scoped>
        .card{
            width: 50%;
            border: 1px solid #EAD839;
            border-radius: 5%;
            position: relative;
        }
        .card-top {
            position: absolute;
            top: 8%;
            left: 22%;
        }
        .card-img-top{
            width: 100%;
            height: 200px;
            object-fit: cover;
            background-position: center;
            background-image: url('https://static.vecteezy.com/system/resources/thumbnails/005/182/631/small_2x/orange-abstract-background-with-modern-style-wave-background-yellow-gradient-abstract-background-vector.jpg');
            
        }
    </style>

@endsection
