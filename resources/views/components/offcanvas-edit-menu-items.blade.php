<div>
    <div class="offcanvas offcanvas-end my-bg-lightdark" data-bs-scroll="true" tabindex="-1" id="offcanvasWithEdit{{ $menuItem->id }}" aria-labelledby="offcanvasWithEditLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <div class="card my-bg-lightdark text-white border-0">
                <div class="card-body">
                    <h5 class="card-title" id="offcanvasWithEditLabel">Modifica i dettagli del piatto</h5>
                    <form action="{{ route('admin.menu_items.update', [$menuItem ->id]) }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method ('PUT')

                        <input type="hidden" name="restaurant_slug" value="{{ $restaurant->slug }}">

                        <div class="mb-3">
                            <label for="item_name" class="form-label">Nome <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                class="form-control text-light my-bg-lightdark @error('item_name') is-invalid @enderror"
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
                                class="form-control text-light my-bg-lightdark @error('description') is-invalid @enderror"
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
                                class="form-control text-light my-bg-lightdark @error('price') is-invalid @enderror"
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
                            
                            <label for="img_input{{ $menuItem->id }}">Carica immagine:</label>
                            <input type="file" id="img_input{{ $menuItem->id }}" name="image" class="form-control">

                            <div class="mt-2">
                                <div class="d-flex justify-content-center" data-id="{{ $menuItem->id }}">
                                    @if ($menuItem->image)
                                        <div class="position-relative img-preview-wrapper" id="image_container{{ $menuItem->id }}">
                                            @if (filter_var($menuItem->image, FILTER_VALIDATE_URL))
                                                <img class="h-150 img-thumbnail" 
                                                        id="img_preview{{ $menuItem->id }}" 
                                                        src="{{ $menuItem->image }}" 
                                                        alt="{{ $menuItem->itemname }}">
                                            @else
                                                <img class="h-150 img-thumbnail" 
                                                        id="img_preview{{ $menuItem->id }}" 
                                                        src="{{ asset('storage/'.$menuItem->image) }}" 
                                                        alt="{{ $menuItem->itemname }}">
                                            @endif
                            
                                            <button type="button" 
                                                    class="remove-img-btn d-flex" 
                                                    id="remove_image{{ $menuItem->id }}">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                            <input class="d-none" 
                                                    type="checkbox" 
                                                    id="removeimage_input{{ $menuItem->id }}" 
                                                    name="remove_image" 
                                                    value="1">
                                        </div>
                                    @endif
                                </div>
                            </div>
                                    
                                
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input
                                    class="form-check-input text-light my-bg-lightdark @error('is_visible') is-invalid @enderror"
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

@push('scripts')
    @vite('resources/js/buttons/imgItems.js')
@endpush
