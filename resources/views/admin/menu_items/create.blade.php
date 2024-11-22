@extends('layouts.app')

@section('page-title', 'Crea nuovo tipo progetto')

@section('main-content')
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Crea nuovo piatto
                    </h1>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-end mb-4">

        <a href="{{ route('admin.menu_items.index')}}" class="btn btn-primary me-2">

            Indietro

        </a>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>

    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.menu_items.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="item_name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="item_name" name="item_name" required minlength="3" maxlength="255" value="{{ old('item_name') }}" placeholder="Inserisci il nome...">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <input type="text" class="form-control" id="description" name="description" minlength="10" maxlength="2048" value="{{ old('description') }}" placeholder="Inserisci la descrizione del piatto...">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="Inserisci il prezzo...">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Immagine</label>
                            <input type="text" class="form-control" id="image" name="image" minlength="3" maxlength="1024" value="{{ old('image') }}" placeholder="Inserisci l'url dell'immagine...">
                        </div>
                        <div class="mb-3">

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" value="1" id="is_visible" name="is_visible"

                                    @if (old('is_visible') !== null)

                                        checked

                                    @endif
                                >

                                <label for="is_visible" class="form-label">Disponibile</label>


                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-success w-100">
                                + Aggiungi
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
