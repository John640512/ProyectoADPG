<x-layout bodyClass="g-sidenav-show  bg-gray-200">

        <x-navbars.sidebar activePage="transporte"></x-navbars.sidebar>

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Transporte"></x-navbars.navs.auth>
            <!-- End Navbar -->
            @if(session('error'))
            <div class="alert alert-danger">
            {{ session('error') }}
            </div>
            @endif
            @if(session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div>
            @endif

            <!-- Contenido Principal -->
            <div class="container-fluid py-0">
                <div class="row">
                    <div class="col-12">
                        <!-- Header y barra de búsqueda -->
                        <h2 class="text-black"><strong>Transporte</strong></h2>
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="row align-items-center">
                                    <div class="col-md-12 col-12 d-flex align-items-center gap-3">
                                        <!-- Buscador -->
                            <form method="GET" action="{{ route('transportes.index') }}" class="flex-grow-1" style="max-width: 250px;">
                                <div class="input-group input-group-sm" style="border: 1px solid #ced4da; border-radius: 10px; overflow: hidden; height: 37px;">
                                    <input
                                        type="text"
                                        name="search"
                                        class="form-control border-0 ps-2"
                                        placeholder="Buscar Transporte..."
                                        value="{{ request('search') }}"
                                        style="box-shadow: none !important; padding: 0 10px; height: 100%; line-height: normal;"
                                    >
                                    <button class="btn btn-outline-secondary border-0" type="submit" style="border-left: 1px solid #ced4da; border-radius: 0; height: 100%; display: flex; align-items: center;">
                                        <i class="material-icons" style="font-size: 1.2rem;">search</i>
                                    </button>
                                </div>
                            </form>
                                        <!-- botones -->
                                        <div class="d-flex align-items-center gap-2" style="flex-grow: 1;">
                                            <button type="button" class="btn  btn-sm mb-0 text-lowercase" 
                                                style="text-transform: none !important" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#filterModal">
                                                <i class="material-icons text-sm me-1">filter_alt</i>Filtro
                                            </button>

                                            <button type="button" class="btn  btn-sm mb-0 text-lowercase" style="text-transform: none !important" data-bs-toggle="modal" data-bs-target="#transporteTypeModal">
                                                <i class="material-icons text-sm me-1">local_shipping</i>Tipo de Transporte
                                            </button>
                                            
                                            @if(hasPermission(8))
                                            <div class="col-md-3 col-12 text-end" style="margin-left: 220px;">
                                                <a href="/transportes/create" class="btn btn-sm bg-gradient-dark mb-0" style="text-transform: none !important;">
                                                    <i class="material-icons text-sm me-1">add</i>Agregar transporte
                                                </a>
                                            </div>
                                            @else
                                            <div class="col-md-3 col-12 text-end" style="margin-left: 220px;">
                                                <a href="" onclick="return false;" class="btn btn-sm bg-gradient-dark mb-0" style="text-transform: none !important;">
                                                    <i class="material-icons text-sm me-1">add</i>Agregar transporte
                                                </a>
                                            </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Tipo de Transporte -->
                        <div class="modal fade" id="transporteTypeModal" tabindex="-1" aria-labelledby="transporteTypeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal">Tipos de Transporte</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0);"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <div class="input-group input-group-outline px-4 mb-3" style="padding-top: 13px;">
                                            <span class="input-group-text" style="padding-left: 6px; padding-right: 445px; padding-top: 7px; padding-bottom: 7px">
                                                <i class="material-icons">search</i>
                                            </span>
                                            <input type="text" id="searchTransporteType" class="form-control" placeholder="Buscar tipo de transporte" style="padding-left: 2rem !important;">
                                        </div>
                                        
                                        <div class="list-group list-group-flush" id="transporteTypesList">
                                            <!-- Los tipos de producto se cargarán dinámicamente aquí -->
                                        </div>
                                    </div>
                                    @if(hasPermission(8))
                                    <div class="modal-footer justify-content-end">
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#addTipoTransporteModal" style="text-transform: none;">
                                            + Agregar
                                        </button>
                                    </div>
                                    @else
                                    <div class="modal-footer justify-content-end">
                                        <button type="button" disabled onclick="return false;" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="" style="text-transform: none;">
                                            + Agregar
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!--Modal agregar tipo de transporte -->
                        <div class="modal fade" id="addTipoTransporteModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal" id="modalTitle">Agregar Tipo de Transporte</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <form id="transporteTypeForm">
                                            <input type="hidden" id="transporteTypeId">
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <input type="text" class="form-control" id="transporteTypeName" placeholder="Nombre del tipo de transporte" required >
                                            </div>
                                            <p class="text-xs text-secondary mb-3 font-weight-bold">Completa el nombre del tipo de transporte</p>
                                            
                                            <div class="input-group input-group-outline mb-1">
                
                                                <textarea class="form-control" id="transporteTypeDescription" rows="3" placeholder="Descripción del tipo de transporte"></textarea>
                                            </div>
                                            <p class="text-xs text-secondary font-weight-bold">Completa la descripción del tipo de transporte</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-end gap-3 mb-4">
                                        <button type="button" class="btn bg-gradient-dark mb-0" id="saveTransporteTypeBtn">Guardar</button>
                                        <button type="button" class="btn btn-outline-secondary mb-0" onclick="closeModalAndShowParent('#addTipoTransporteModal', '#transporteTypeModal')" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal edita tipo de producto -->
                        <div class="modal fade" id="editTipoTransporteModal" tabindex="-1" aria-labelledby="editTipoTransporteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal">Editar Tipo de Transporte</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <form id="editTransporteTypeForm">
                                            <input type="hidden" id="editTransporteTypeId">
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <input type="text" class="form-control" id="editTransporteTypeName" placeholder="Nombre del tipo de transporte" required>
                                            </div>
                                            <p class="text-xs text-secondary mb-3 font-weight-bold">Completa el nombre del tipo de transporte</p>
                                            
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <textarea class="form-control" id="editTransporteTypeDescription" rows="3" placeholder="Descripción del tipo de transporte"></textarea>
                                            </div>
                                            <p class="text-xs text-secondary font-weight-bold">Completa la descripción del tipo de transporte</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-end gap-3 mb-4">
                                        <button type="button" class="btn bg-gradient-dark mb-0" id="updateTransporteTypeBtn">Guardar</button>
                                        <button type="button" class="btn btn-outline-secondary mb-0" onclick="closeModalAndShowParent('#editTipoTransporteModal', '#transporteTypeModal')">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <!-- Tabla -->
                <div class="row">
                    <div class="col-12">
                        <div class="card border">
                            <div class="table-responsive p-4">
                                <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de Salida</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo de Transporte</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trabajador</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ubicación entrega</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @isset($transportes)
                                @foreach ($transportes as $transporte)
                                    <tr>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $transporte->fecha_salida->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $transporte->tipoTransporte->nombre }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $transporte->trabajador?->nombre ?? 'Sin asignar' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $transporte->ubicacionesEntrega->isNotEmpty() ? $transporte->ubicacionesEntrega->pluck('nombre_negocio')->join(', ') : 'Sin asignar' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span 
                                            class="text-secondary text-xs font-weight-bold"
                                            @if($transporte->productos->count() > 1)
                                                data-bs-toggle="tooltip" 
                                                title="{{ $transporte->productos->pluck('nombre')->join(', ') }}"
                                            @endif
                                        >
                                            {{ $transporte->productos->first()->nombre ?? 'Sin asignar' }}
                                            @if($transporte->productos->count() > 1)
                                                +{{ $transporte->productos->count() - 1 }}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <!-- Boton Ver -->
                                        <a href="{{ route('transportes.show', $transporte->id_transporte) }}" class="btn btn-link text-dark px-1 mb-0">
                                            <i class="material-icons">visibility</i>
                                        </a>

                                        <!-- Boton Editar -->
                                        @if(hasPermission(3))
                                        <a href="{{ route('transportes.edit', $transporte->id_transporte) }}" class="btn btn-link text-dark px-1 mb-0">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        @else
                                        <a href="" onclick="return false;" class="btn btn-link text-dark px-1 mb-0">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        @endif

                                        <!-- Boton Eliminar -->
                                        <form action="{{ route('transportes.destroy', $transporte->id_transporte) }}" method="POST" style="display:inline">
                                            @csrf 
                                            @method('DELETE')

                                            @if(hasPermission(1))
                                            <button type="submit" class="btn btn-link text-dark px-1 mb-0" onclick="return confirm('¿Estás seguro de eliminar este transporte?')">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            @else
                                            <button type="submit" onclick="return false;" class="btn btn-link text-dark px-1 mb-0" onclick="return confirm('¿Estás seguro de eliminar este transporte?')">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            @endif

                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                            </table>
                            </div>
                        </div>
                        @isset($transportes)
                            {{ $transportes->links() }}
                            @endisset
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    </div>
    @push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
//Buscar los productos 
        function searchTransporte(query) {
        if (query.length < 2) { // Solo busca si hay al menos 2 caracteres
            // Opcional: Restaurar la tabla completa si la búsqueda está vacía
            if (query.length === 0) {
                loadInitialTransporte();
            }
            return;
        }

        $.ajax({
            url: 'transportes.search',
            method: 'GET',
            data: {
                search: query
            },
            success: function(response) {
                updateTransporteTable(response);
            },
            error: function(xhr) {
                showNotification('danger', 'Error al buscar transporte');
            }
        });
    }

    function updateTransporteTable(transportes) {
    let tbody = $('table tbody');
    tbody.empty();

    if (transportes.length === 0) {
        tbody.append('<tr><td colspan="6" class="text-center">No se encontraron transportes</td></tr>');
        return;
    }

    transportes.forEach(function(transporte) {
        let fechaSalida = new Date(transporte.fecha_salida).toLocaleDateString('es-ES');
        let row = `
        <tr>
            <td class="text-center">${fechaSalida}</td>
            <td class="text-center">${transporte.tipoTransporte.nombre}</td>
            <td class="text-center">${transporte.trabajador ? transporte.trabajador.nombre : 'Sin asignar'}</td>
            <td class="text-center">${transporte.ubicacionesEntrega.length > 0 ? transporte.ubicacionesEntrega[0].nombre_negocio : 'Sin asignar'}</td>
            <td class="text-center">${transporte.productos.map(p => p.nombre).join(', ')}</td>
            <td class="align-middle">
                <a href="/productos/${transporte.id_transporte}" class="btn btn-link text-dark px-1 mb-0">
                    <i class="material-icons">visibility</i>
                </a>
                <a href="/productos/${transporte.id_transporte}/edit" class="btn btn-link text-dark px-1 mb-0">
                    <i class="material-icons">edit</i>
                </a>
                <form action="/productos/${transporte.id_transporte}" method="POST" style="display:inline">
                    @csrf 
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-dark px-1 mb-0" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                        <i class="material-icons">delete</i>
                    </button>
                </form>
            </td>
        </tr>`;
        tbody.append(row);
    });
}

// Función para manejar correctamente el cierre de modales
function closeModalAndShowParent(modalToClose, parentModal) {
    $(modalToClose).modal('hide');
    $('.modal-backdrop').remove();
    $('body').removeClass('modal-open');
    $('body').css('padding-right', '');
    
    setTimeout(() => {
        if (parentModal) {
            $(parentModal).modal('show');
        }
    }, 300);
}

//modal tipo de transportes
$(document).ready(function() {

    // Cargar tipos de transporte al abrir el modal
    $('#transporteTypeModal').on('shown.bs.modal', function() {
        loadTiposTransporte();
    });

    // Búsqueda de tipos de transporte
    $('#searchTransporteType').on('input', function() {
        loadTiposTransporte();
    });
});

// Cargar más resultados
$(document).on('click', '.load-more', function() {
    let page = $(this).data('page');
    let search = $('#searchTransporteType').val();
    
    $.get('/tipo-transporte', { page: page, search: search }, function(data) {
        if(data.next_page_url) {
            $('#transporteTypesList .load-more').parent().remove();
            $('#transporteTypesList').append(data.html);
        } else {
            $('#transporteTypesList').append(data.html);
        }
    });
});

// Abrir modal para editar
$(document).on('click', '.edit-transporte-type', function() {
        if (!hasPermission(4)) { // Permiso para eliminar tipos
        handleUnauthorizedTypeAction();
        return false;
    }

        $('#transporteTypeModal').modal('hide');

        setTimeout(() => {
            $('#editTipoTransporteModal').modal('show');
            $('#editTransporteTypeId').val($(this).data('id'));
            $('#editTransporteTypeName').val($(this).data('nombre'));
            $('#editTransporteTypeDescription').val($(this).data('descripcion'));
        }, 300);
    });

// Actualizar tipo de transporte
$('#updateTransporteTypeBtn').click(function() {
    let id = $('#editTransporteTypeId').val();
    
    $.ajax({
        url: '/tipo-transporte/' + id,
        method: 'PUT',
        data: {
            nombre: $('#editTransporteTypeName').val(),
            descripcion: $('#editTransporteTypeDescription').val(),
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            $('#editTipoTransporteModal').modal('hide');
            loadTiposTransporte();
            showNotification('success', 'Tipo de transporte actualizado');
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            if(errors) {
                for(let error in errors) {
                    showNotification('danger', errors[error][0]);
                }
            } else {
                showNotification('danger', xhr.responseJSON.message || 'Error al actualizar');
            }
        }
    });
});

// Resetear formulario al cerrar modal de edición
$('#editTipoTransporteModal').on('hidden.bs.modal', function() {
    $('#editTransporteTypeForm')[0].reset();
    $('.input-group-outline').removeClass('is-filled');
});

// Guardar tipo de transporte
$('#saveTransporteTypeBtn').click(function() {
    let id = $('#transporteTypeId').val();
    let url = id ? '/tipo-transporte/' + id : '/tipo-transporte';
    let method = id ? 'PUT' : 'POST';
    
    $.ajax({
        url: url,
        method: method,
        data: {
            nombre: $('#transporteTypeName').val(),
            descripcion: $('#transporteTypeDescription').val(),
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            closeModalAndShowParent('#addTipoTransporteModal', '#transporteTypeModal');
            loadTiposTransporte();
            resetForm();
            showNotification('success', id ? 'Tipo de transporte actualizado' : 'Tipo de transporte creado');
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            if(errors) {
                for(let error in errors) {
                    showNotification('danger', errors[error][0]);
                }
            } else {
                showNotification('danger', xhr.responseJSON.message || 'Error al guardar');
            }
        }
    });
});

// En tu JavaScript existente, modifica la parte de eliminar tipo de transporte
$(document).on('click', '.delete-transporte-type', function() {
    if (!hasPermission(4)) { // Permiso para eliminar tipos
        handleUnauthorizedTypeAction();
    }
    
    if (confirm('¿Estás seguro de eliminar este tipo de transporte?')) {
        $.ajax({
            url: '/tipo-transporte/' + $(this).data('id'),
            method: 'DELETE',
            data: { _token: '{{ csrf_token() }}' },
            success: function() {
                loadTiposTransporte();
                showNotification('success', 'Tipo de transporte eliminado');
            },
            error: function(xhr) {
                showNotification('danger', xhr.responseJSON.message || 'Error al eliminar');
            }
        });
    }
});

// Resetear formulario al cerrar
$('#addTipoTransporteModal').on('hidden.bs.modal', function() {
    resetForm();
    if($('#transporteTypeModal').length) {
        $('#transporteTypeModal').modal('show');
    }
});

function loadTiposTransporte() {
    let search = $('#searchTransporteType').val();
    $.get('/tipo-transporte', { search: search }, function(data) {
        $('#transporteTypesList').html(data.html);
    }).fail(function() {
        showNotification('danger', 'Error al cargar los tipos de transporte');
    });
}

function resetForm() {
    $('#transporteTypeForm')[0].reset();
    $('#transporteTypeId').val('');
    $('#modalTitle').text('Agregar Tipo de Transporte');
    $('.input-group-outline').removeClass('is-filled');
}

function showNotification(type, message) {
    const toast = `<div class="toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">${message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>`;
    
    $('body').append(toast);
    $('.toast').toast('show');
    setTimeout(() => $('.toast').remove(), 3000);
}

$(document).on('click', '.page-link', function(e) {
    e.preventDefault();
    let page = $(this).data('page');
    loadTransporteTypes(page);
});

function loadTransporteTypes(page) {
    $.ajax({
        url: '/tipo-transporte/',
        data: {page: page},
        success: function(data) {
            $('#transporteTypesList').html(data.html);
        }
    });
}

function handleUnauthorizedTypeAction() {
    // Cierra modales
    $('.modal').modal('hide');
    $('.modal-backdrop').remove();
    
    // Muestra notificación
    showNotification('warning', 'No tienes permiso para esta acción en tipos de transporte');
    
    // Recarga suave la página después de un breve retraso
    setTimeout(() => {
        window.location.href = "{{ route('transporte') }}";
    }, 500);
}

</script>
@endpush
</x-layout>
