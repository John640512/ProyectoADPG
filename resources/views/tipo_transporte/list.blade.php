<div class="list-group list-group-flush" id="transporteTypesList">
    @foreach($tiposTransporte as $tipo)
    <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
        <div>
            <h6 class="mb-1">{{ $tipo->nombre }}</h6>
            @if($tipo->descripcion)
            <p class="mb-1 text-xs text-secondary">{{ $tipo->descripcion }}</p>
            @endif
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-sm btn-outline-secondary edit-transporte-type" 
                    data-id="{{ $tipo->id_tipo_transporte }}"
                    data-nombre="{{ $tipo->nombre }}"
                    data-descripcion="{{ $tipo->descripcion }}">
                    <i class="material-icons text-sm">edit</i>
            </button>
            <button class="btn btn-sm btn-outline-danger delete-transporte-type" data-id="{{ $tipo->id_tipo_transporte }}">
                <i class="material-icons text-sm">delete</i>
            </button>
        </div>
    </div>
    @endforeach
</div>

@if($tiposTransporte->lastPage() > 1)
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mt-3">
        {{-- Botón Anterior --}}
        <li class="page-item {{ $tiposTransporte->currentPage() == 1 ? 'disabled' : '' }}">
            <a class="page-link" href="#" data-page="{{ $tiposTransporte->currentPage() - 1 }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        {{-- Números de página --}}
        @for ($i = 1; $i <= $tiposTransporte->lastPage(); $i++)
            <li class="page-item {{ $tiposTransporte->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="#" data-page="{{ $i }}">{{ $i }}</a>
            </li>
        @endfor

        {{-- Botón Siguiente --}}
        <li class="page-item {{ $tiposTransporte->currentPage() == $tiposTransporte->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="#" data-page="{{ $tiposTransporte->currentPage() + 1 }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
@endif