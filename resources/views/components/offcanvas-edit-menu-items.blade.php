<div>
    <div class="offcanvas offcanvas-end bg-black" data-bs-scroll="true" tabindex="-1" id="offcanvasWithEdit{{ $menuItem->id }}" aria-labelledby="offcanvasWithEditLabel">
        {{-- bottone chiusura offcanvas --}}
        <div class="offcanvas-header">
            <button type="button" class="btn-close bg-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <h5 class="card-title" id="offcanvasWithEditLabel">Modifica i dettagli del piatto</h5>

                    {{-- form --}}
                    <form action="{{ route('admin.menu_items.update', [$menuItem ->id]) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method ('PUT')

                        <input type="hidden" name="restaurant_slug" value="{{ $restaurant->slug }}">

                        <div class="mb-3">
                            <label for="item_name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('item_name') is-invalid @enderror"  
                                id="item_name" 
                                name="item_name" 
                                required 
                                minlength="3" 
                                maxlength="255" 
                                value="{{ old('item_name', $menuItem->item_name) }}" 
                                placeholder="Inserisci il nome...">
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
                            <input 
                                type="text" 
                                class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" 
                                required 
                                minlength="10" 
                                maxlength="1024" 
                                value="{{ old('description', $menuItem->description) }}" 
                                placeholder="Inserisci la descrizione del piatto...">
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
                            <input 
                                type="number" 
                                class="form-control @error('price') is-invalid @enderror" 
                                id="price" 
                                name="price" 
                                required 
                                value="{{ old('price', $menuItem->price) }}" 
                                placeholder="Inserisci il prezzo..." 
                                min="0.01" 
                                step="0.01" 
                                max="999.99">
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
                            <input 
                                type="file" 
                                class="form-control @error('image') is-invalid @enderror" 
                                id="image" 
                                name="image" 
                                minlength="3" 
                                maxlength="2048" 
                                placeholder="Carica un immagine per il tuo piatto...">

                            @if ($menuItem->image)
                                <div class="mt-2 d-flex flex-column">
                                    <h5>Immagine attuale:</h5>
                                    <img class="h-150" src="{{ asset('storage/'.$menuItem->image) }}" alt="{{ $menuItem->itemname }}">
                                    <button type="button" class="btn btn-danger btn-sm mt-2" id="remove_image{{ $menuItem->id }}"
                                            onclick="document.getElementById('removeimage_input{{ $menuItem->id }}').checked = true;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <input class="d-none" type="checkbox" id="removeimage_input{{ $menuItem->id }}" name="remove_image" value="1">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input 
                                    class="form-check-input @error('is_visible') is-invalid @enderror" 
                                    type="checkbox" 
                                    value="1" 
                                    id="is_visible" 
                                    name="is_visible" 
                                    @if (old('is_visible', $menuItem->is_visible) == 1) checked @endif>
                                <label for="is_visible" class="form-label">Disponibile</label>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-warning w-100">
                                Modifica
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>