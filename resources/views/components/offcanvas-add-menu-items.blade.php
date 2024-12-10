<div>
    <div class="offcanvas offcanvas-end my-bg-lightdark" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="card my-bg-lightdark text-light border-0">
                <div class="card-body">
                    <h5 class="card-title" id="offcanvasWithBothOptionsLabel">Aggiungi i dettagli del nuovo piatto</h5>

                    <form action="{{ route('admin.menu_items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="restaurant_slug" value="{{ $restaurant->slug }}">
                        <div class="mb-3">
                            <label for="item_name" class="form-label ">Nome <span class="text-danger">*</span></label>
                            <input type="text" class="form-control text-light my-bg-lightdark @error('item_name') is-invalid @enderror" id="item_name" name="item_name" required minlength="3" maxlength="255" value="{{ old('item_name') }}" placeholder="Inserisci il nome...">

                            @if($errors->has('item_name'))
                                <div>

                                    @foreach($errors->get('item_name') as $key => $error)
                                        <span class="text-danger">
                                            Il campo nome è obbligatorio, inserire almeno tre caratteri
                                        </span>
                                    @endforeach

                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descrizione</label>
                            <input type="text" class="form-control text-light my-bg-lightdark @error('description') is-invalid @enderror" id="description" name="description" required minlength="10" maxlength="1024" value="{{ old('description') }}" placeholder="Inserisci la descrizione del piatto...">

                            @if($errors->has('description'))
                                <div>

                                    @foreach($errors->get('description') as $key => $error)
                                        <span class="text-danger">
                                            Il campo descrizione è obbligatorio, inserire almeno dieci caratteri
                                        </span>
                                    @endforeach

                                </div>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Prezzo <span class="text-danger">*</span></label>
                            <input type="number" class="form-control text-light my-bg-lightdark @error('price') is-invalid @enderror" id="price" name="price" required value="{{ old('price') }}" placeholder="Inserisci il prezzo..." min="0.01" step="0.01" max="999.99">

                            @if($errors->has('price'))
                                <div>

                                    @foreach($errors->get('price') as $key => $error)
                                        <span class="text-danger">
                                            Il campo prezzo non accetta valori negativi
                                        </span>
                                    @endforeach

                                </div>
                            @endif

                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Immagine</label>
                            <input type="file" class="form-control text-light my-bg-lightdark @error('image') is-invalid @enderror" id="image" name="image" minlength="3" maxlength="2048" placeholder="Carica un immagine per il tuo piatto...">
                        </div>
                        <div class="mb-3">

                            <div class="form-check">

                                <input class="form-check-input text-light my-bg-lightdark @error('is_visible') is-invalid @enderror" type="checkbox" value="1" id="is_visible" name="is_visible"
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
</div>
