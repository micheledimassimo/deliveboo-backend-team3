<div>
    <div class="modal fade text-white " id="deleteModal{{ $menuItem->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $menuItem->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content my-bg-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel{{ $menuItem->id }}">
                        Elimina il piatto
                    </h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body text-start">
                    Sei sicur* di voler eliminare il piatto: <strong>{{$menuItem->item_name}}</strong>?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Indietro</button>
                    <form action="{{ route('admin.menu_items.destroy', [$menuItem->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            Elimina
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
