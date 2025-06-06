<div class="list-group list-group-flush" id="ubicacionProductList">
    @foreach($ubicacionProductos as $ubicacion)
    <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div>
            <h6 class="mb-1">{{ $ubicacion->nombre }}</h6>
            @if($ubicacion->descripcion)
            <p class="mb-1 text-xs text-secondary">{{ $ubicacion->descripcion }}</p>
            @endif
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary edit-ubicacionP-type" 
                    data-id="{{ $ubicacion->id_ubicacion }}"
                    data-nombre="{{ $ubicacion->nombre }}"
                    data-descripcion="{{ $ubicacion->descripcion }}">
                    <i class="material-icons text-sm">edit</i>
            </button>
            <button class="btn btn-sm btn-outline-danger delete-ubicacionP-type" data-id="{{ $ubicacion->id_ubicacion }}">
                <i class="material-icons text-sm">delete</i>
            </button>
        </div>
    </div>
    @endforeach
</div>

@if($ubicacionProductos->lastPage() > 1)
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mt-3">
        {{-- Botón Anterior --}}
        <li class="page-item {{ $ubicacionProductos->currentPage() == 1 ? 'disabled' : '' }}">
            <a class="page-link" href="#" data-page="{{ $ubicacionProductos->currentPage() - 1 }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        {{-- Números de página --}}
        @for ($i = 1; $i <= $ubicacionProductos->lastPage(); $i++)
            <li class="page-item {{ $ubicacionProductos->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="#" data-page="{{ $i }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Botón Siguiente --}}
        <li class="page-item {{ $ubicacionProductos->currentPage() == $ubicacionProductos->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="#" data-page="{{ $ubicacionProductos->currentPage() + 1 }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
@endif