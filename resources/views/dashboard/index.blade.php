<x-layout bodyClass="g-sidenav-show  bg-gray-200">

        <x-navbars.sidebar activePage="dashboard"></x-navbars.sidebar>

        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Producto"></x-navbars.navs.auth>
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
                        <h2 class="text-black"><strong>Productos</strong></h2>
                        <div class="card mb-4">
                            <div class="card-body p-3">
                                <div class="row align-items-center">
                                    <div class="col-md-12 col-12 d-flex align-items-center gap-3">
                                        <!-- Buscador -->
                            <form method="GET" action="" class="flex-grow-1" style="max-width: 250px;">
                                <div class="input-group input-group-sm" style="border: 1px solid #ced4da; border-radius: 10px; overflow: hidden; height: 37px;">
                                    <input
                                        type="text"
                                        name="search"
                                        class="form-control border-0 ps-2"
                                        placeholder="Buscar Producto..."
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
                                            <button type="button" class="btn  btn-sm mb-0 text-lowercase" style="text-transform: none !important" data-bs-toggle="modal" data-bs-target="#productTypeModal">
                                                <i class="material-icons text-sm me-1">inventory_2</i>Tipo de Producto
                                            </button>
                                            <button type="button" class="btn  btn-sm mb-0 text-lowercase" 
                                                    style="text-transform: none !important" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#costoModal">
                                                <i class="material-icons text-sm me-1">attach_money</i>Costo
                                            </button>
                                            <button type="button" class="btn  btn-sm mb-0 text-lowercase" 
                                                    style="text-transform: none !important" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#ubicacionProductoModal">
                                                <i class="material-icons text-sm me-1">place</i>Ubicacion
                                            </button>

                                            <div class="col-md-3 col-12 text-end">
                                                
                                                @if(hasPermission(1))
                                                <a href="/productos/create" class="btn btn-sm bg-gradient-dark mb-0" style="text-transform: none !important;">
                                                    <i class="material-icons text-sm me-1">add</i>Agregar producto
                                                </a>
                                                @else
                                                <a href="" onclick="return false;" class="btn btn-sm bg-gradient-dark mb-0" style="text-transform: none !important;">
                                                    <i class="material-icons text-sm me-1">add</i>Agregar producto
                                                </a>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <!-- Modal Tipo de Producto -->
                        <div class="modal fade" id="productTypeModal" tabindex="-1" aria-labelledby="productTypeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal">Tipos de Producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0);"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <div class="input-group input-group-outline px-4 mb-3" style="padding-top: 13px;">
                                            <span class="input-group-text" style="padding-left: 6px; padding-right: 445px; padding-top: 7px; padding-bottom: 7px">
                                                <i class="material-icons">search</i>
                                            </span>
                                            <input type="text" id="searchProductType" class="form-control" placeholder="Buscar tipo de producto" style="padding-left: 2rem !important;">
                                        </div>
                                        
                                        <div class="list-group list-group-flush" id="productTypesList">
                                            <!-- Los tipos de producto se cargarán dinámicamente aquí -->
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-end">

                                        @if(hasPermission(1))
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#addTipoProductModal" style="text-transform: none;">
                                            + Agregar
                                        </button>
                                        @else
                                        <button type="button" disabled onclick="return false;" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" style="text-transform: none;">
                                            + Agregar
                                        </button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Modal agregar tipo de producto -->
                        <div class="modal fade" id="addTipoProductModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal" id="modalTitle">Agregar Tipo de Producto</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <form id="productTypeForm">
                                            <input type="hidden" id="productTypeId">
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <input type="text" class="form-control" id="productTypeName" placeholder="Nombre del tipo de producto" required >
                                            </div>
                                            <p class="text-xs text-secondary mb-3 font-weight-bold">Completa el nombre del tipo de producto</p>
                                            
                                            <div class="input-group input-group-outline mb-1">
                
                                                <textarea class="form-control" id="productTypeDescription" rows="3" placeholder="Descripción del tipo de producto"></textarea>
                                            </div>
                                            <p class="text-xs text-secondary font-weight-bold">Completa la descripción del tipo de producto</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-end gap-3 mb-4">
                                        <button type="button" class="btn bg-gradient-dark mb-0" id="saveProductTypeBtn">Guardar</button>
                                        <button type="button" class="btn btn-outline-secondary mb-0" onclick="closeModalAndShowParent('#addTipoProductModal', '#productTypeModal')" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal edita tipo de producto -->
                        <div class="modal fade" id="editTipoProductoModal" tabindex="-1" aria-labelledby="editTipoProductoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal">Editar Tipo de Producto</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <form id="editProductTypeForm">
                                            <input type="hidden" id="editProductTypeId">
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <input type="text" class="form-control" id="editProductTypeName" placeholder="Nombre del tipo de producto" required>
                                            </div>
                                            <p class="text-xs text-secondary mb-3 font-weight-bold">Completa el nombre del tipo de producto</p>
                                            
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <textarea class="form-control" id="editProductTypeDescription" rows="3" placeholder="Descripción del tipo de producto"></textarea>
                                            </div>
                                            <p class="text-xs text-secondary font-weight-bold">Completa la descripción del tipo de producto</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-end gap-3 mb-4">
                                        <button type="button" class="btn bg-gradient-dark mb-0" id="updateProductTypeBtn">Guardar</button>
                                        <button type="button" class="btn btn-outline-secondary mb-0" onclick="closeModalAndShowParent('#editTipoProductoModal', '#productTypeModal')">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- C O S T O -->

                        <!-- Modal Costo -->
                        <div class="modal fade" id="costoModal" tabindex="-1" aria-labelledby="costoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal">Asignar Costo por Tipo de Producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0);"></button>
                                    </div>
                                    <form id="formAsignarCosto">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Tipo de Producto</label>
                                                <select class="form-select border border-1 p-2"  id="tipoProductoSelect" required>
                                                    <option value="">Seleccionar tipo de producto</option>
                                                    @foreach($tiposProducto as $tipo)
                                                        <option value="{{ $tipo->id_tipo_producto }}">{{ $tipo->nombre }}</option>
                                                    @endforeach
                                                </select>
                                                <label class="form-label">Proveedor</label>
                                                <select class="form-select border border-1 p-2"  id="proveedorSelect" required>
                                                    <option value="">Seleccionar proveedor</option>
                                                    @foreach($proveedores as $proveedor)
                                                        <option value="{{ $proveedor->id_proveedor }}">{{ $proveedor->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <input type="number" step="0.01" class="form-control" id="costoTonelada" placeholder="Costo por Tonelada ($)" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>

                                            @if(hasPermission(1))
                                            <button type="submit" class="btn bg-gradient-dark">Guardar</button>
                                            @else
                                            <button disabled onclick="return false;" class="btn bg-gradient-dark">Guardar</button>
                                            @endif

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<!-- U B I C A C I O N -->
                        <!-- Modal Ubicacion del producto -->
                        <div class="modal fade" id="ubicacionProductoModal" tabindex="-1" aria-labelledby="ubicacionProductoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal">Ubicación del Producto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0);"></button>
                                    </div>
                                    <div class="modal-body p-0">
                                        <div class="input-group input-group-outline px-4 mb-3" style="padding-top: 13px;">
                                            <span class="input-group-text" style="padding-left: 6px; padding-right: 445px; padding-top: 7px; padding-bottom: 7px">
                                                <i class="material-icons">search</i>
                                            </span>
                                            <input type="text" id="searchUbicacionProductType" class="form-control" placeholder="Buscar ubicación del producto" style="padding-left: 2rem !important;">
                                        </div>

                                        <div class="list-group list-group-flush" id="ubicacionProductList">
                                            <!-- Lo ubicacion de cada producto se cargarán dinámicamente aquí -->
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-end">

                                        @if(hasPermission(1))
                                        <button type="button" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" data-bs-target="#addUbicacionProductModal" style="text-transform: none;">
                                            + Agregar
                                        </button>
                                        @else
                                        <button type="button" disabled onclick="return false;" class="btn bg-gradient-dark mb-0" data-bs-toggle="modal"  style="text-transform: none;">
                                            + Agregar
                                        </button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--Modal agregar ubicacion del producto-->
                        <div class="modal fade" id="addUbicacionProductModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal" id="modalTitle">Agregar Ubicación del Producto</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <form id="productUbicacionForm">
                                            <input type="hidden" id="productUbicacionId">
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <input type="text" class="form-control" id="productUbicacionName" placeholder="Nombre de la ubicación" required >
                                            </div>
                                            <p class="text-xs text-secondary mb-3 font-weight-bold">Completa el nombre de la ubicación</p>
                                            
                                            <div class="input-group input-group-outline mb-1">
                
                                                <textarea class="form-control" id="productUbicacionDescription" rows="3" placeholder="Descripción de la ubicación del producto"></textarea>
                                            </div>
                                            <p class="text-xs text-secondary font-weight-bold">Completa la descripción de la ubicación</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-end gap-3 mb-4">
                                        <button type="button" class="btn bg-gradient-dark mb-0" id="saveUbicacionProductBtn">Guardar</button>
                                        <button type="button" class="btn btn-outline-secondary mb-0" onclick="closeModalAndShowParent('#addUbicacionProductModal' , '#ubicacionProductoModal')" data-bs-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Editar ubicacion producto -->
                        <div class="modal fade" id="editUbicacionProductoModal" tabindex="-1" aria-labelledby="editUbicacionProductoModalLabel" aria-hidden="true" data-bs-backdrop="static">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal">Editar Ubicacion del Producto</h5>
                                        
                                    </div>
                                    <div class="modal-body">
                                        <form id="editProductUbicacionForm">
                                            <input type="hidden" id="editProductUbicacionId">
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <input type="text" class="form-control" id="editProductUbicacionName" placeholder="Nombre de la ubicación del producto" required>
                                            </div>
                                            <p class="text-xs text-secondary mb-3 font-weight-bold">Completa el nombre de la ubicación del producto</p>
                                            
                                            <div class="input-group input-group-outline mb-1">
                                                
                                                <textarea class="form-control" id="editProductUbicacionDescription" rows="3" placeholder="Descripción de la ubicación del producto"></textarea>
                                            </div>
                                            <p class="text-xs text-secondary font-weight-bold">Completa la descripción de la ubicación del producto</p>
                                        </form>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-end gap-3 mb-4">
                                        <button type="button" class="btn bg-gradient-dark mb-0" id="updateProductUbicacionBtn">Guardar</button>
                                        <button type="button" class="btn btn-outline-secondary mb-0" onclick="closeModalAndShowParent('#editUbicacionProductoModal', '#ubicacionProductoModal')">Cancelar</button>
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
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tipo</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ubicación</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Costo/Tonelada</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productos as $producto)
                                    <tr>
                                        <td class="text-center text-xs">
                                            {{ number_format($producto->stockActual(), 2) }} ton
                                        </td>
                                        <td class="text-center">
                                            @php
                                                $estado = $producto->estadoStockPorPorcentaje();
                                                
                                                // Mapear estados a íconos y tooltips
                                                $icono = '';
                                                $tooltip = '';
                                                
                                                if ($estado['estado'] == 'Bajo') {
                                                    $icono = 'warning';
                                                    $tooltip = 'Stock Bajo';
                                                } elseif ($estado['estado'] == 'Medio') {
                                                    $icono = 'info';
                                                    $tooltip = 'Stock Medio';
                                                } else {
                                                    $icono = 'check_circle';
                                                    $tooltip = 'Stock Alto';
                                                }
                                            @endphp

                                            <span class="badge badge-sm {{ $estado['clase'] }}" 
                                                data-bs-toggle="tooltip" 
                                                data-bs-placement="top" 
                                                title="{{ $tooltip }}">
                                                <i class="material-icons" style="font-size: 14px; vertical-align: middle;">
                                                    {{ $icono }}
                                                </i>
                                            </span>
                                        </td>
                                        <td class="text-center text-xs align-middle">
                                        <div class="d-flex flex-column align-items-center justify-content-center px-2 py-1">
                                        <h6 class="mb-0 text-sm">{{ $producto->nombre }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ Str::limit($producto->descripcion, 30) }}</p>
                                        </div>
                                        </td>
                                        <td class="text-center text-xs">{{ $producto->tipo_producto->nombre }}</td>
                                        <td class="text-center text-xs">{{ $producto->ubicacion->nombre }}</td>
                                        <td class="text-center text-xs">${{ number_format($producto->tipo_producto->costoPorTonelada->costo_tonelada ?? 0, 2) }}</td>
                                        <td class="align-middle">
                                            <!-- Botón Ver -->
                                            <a href="{{ route('productos.show', $producto->id_producto) }}" class="btn btn-link text-dark px-1 mb-0">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            
                                            <!-- Botón Editar -->
                                            @if(hasPermission(3))
                                            <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn btn-link text-dark px-1 mb-0">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            @else
                                            <a href="" onclick="return false;" class="btn btn-link text-dark px-1 mb-0">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            @endif
                                            
                                            <!-- Botón Eliminar -->
                                            <form action="{{ route('productos.destroy', $producto->id_producto) }}" method="POST" style="display:inline">
                                                @csrf 
                                                @method('DELETE')
                                                
                                                @if(hasPermission(3))
                                                <button type="submit" class="btn btn-link text-dark px-1 mb-0" onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                @else
                                                <button type="submit" class="btn btn-link text-dark px-1 mb-0" onclick="return false;">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                @endif

                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-4">
                            {{ $productos->appends(['search' => request('search')])->links() }}
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            @php
                $tienePermisoEditar = hasPermission(3);
                $puedeEliminarTipoProducto = hasPermission(4);
                $puedeEditarUbicacion = hasPermission(3);
                $puedeEliminarUbicacion = hasPermission(4);
            @endphp
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    </div>
    @push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        //Buscar los productos 
        function searchProducts(query) {
        if (query.length < 2) { // Solo busca si hay al menos 2 caracteres
            // Opcional: Restaurar la tabla completa si la búsqueda está vacía
            if (query.length === 0) {
                loadInitialProducts();
            }
            return;
        }

        $.ajax({
            url: 'productos.search',
            method: 'GET',
            data: {
                search: query
            },
            success: function(response) {
                updateProductTable(response);
            },
            error: function(xhr) {
                showNotification('danger', 'Error al buscar productos');
            }
        });
    }

    function updateProductTable(products) {
    let tbody = $('table tbody');
    tbody.empty();

    if (products.length === 0) {
        tbody.append('<tr><td colspan="5" class="text-center">No se encontraron productos</td></tr>');
        return;
    }

    products.forEach(function(product) {
        let row = `
        <tr>
            <td>
                <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">${product.nombre}</h6>
                        <p class="text-xs text-secondary mb-0">${product.descripcion.substring(0, 30)}${product.descripcion.length > 30 ? '...' : ''}</p>
                    </div>
                </div>
            </td>
            <td>${product.tipo_producto.nombre}</td>
            <td>${product.ubicacion.nombre}</td>
            <td>$${product.tipo_producto.costo_por_tonelada.costo_tonelada.toFixed(2)}</td>
            <td class="align-middle">
                <a href="/productos/${product.id_producto}" class="btn btn-link text-dark px-1 mb-0">
                    <i class="material-icons">visibility</i>
                </a>
                <a href="/productos/${product.id_producto}/edit" class="btn btn-link text-dark px-1 mb-0">
                    <i class="material-icons">edit</i>
                </a>
                <form action="/productos/${product.id_producto}" method="POST" style="display:inline">
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

    // Opcional: Función para restaurar la tabla original
    function loadInitialProducts() {
        $.get('/productos/list', function(response) {
            updateProductTable(response);
        });
    }

        // Función mejorada para manejar correctamente el cierre de modales
        function closeModalAndShowParent(modalToClose, parentModal = null) {
    const modal = bootstrap.Modal.getInstance(document.querySelector(modalToClose));
    
    // Ocultar la modal actual
    modal.hide();
    
    // Esperar a que la modal se haya ocultado completamente
    $(modalToClose).one('hidden.bs.modal', function() {
        // Limpiar backdrops duplicados
        const backdrops = document.querySelectorAll('.modal-backdrop');
        if (backdrops.length > 1) {
            backdrops[0].remove();
        }
        
        // Asegurarse de que el body tenga las clases correctas
        $('body').addClass('modal-open');
        
        if (parentModal) {
            // Mostrar la modal padre después de un breve retraso
            setTimeout(() => {
                const parent = new bootstrap.Modal(document.querySelector(parentModal));
                parent.show();
                
                // Forzar el foco en la modal padre
                $(parentModal).on('shown.bs.modal', function() {
                    $(this).find('.modal-content').focus();
                });
            }, 50);
        }
    });
}

        //modal tipo de productos
        $(document).ready(function() {
        
        // Cargar tipos de producto al abrir el modal
        $('#productTypeModal').on('shown.bs.modal', function() {
            loadTiposProducto();
        });

        // Búsqueda de tipos de producto
        $('#searchProductType').on('input', function() {
            loadTiposProducto();
        });

        // Cargar más resultados
        $(document).on('click', '.load-more', function() {
            let page = $(this).data('page');
            let search = $('#searchProductType').val();
            
            $.get('/tipo-producto', { page: page, search: search }, function(data) {
                if(data.next_page_url) {
                    $('#productTypesList .load-more').parent().remove();
                    $('#productTypesList').append(data.html);
                } else {
                    $('#productTypesList').append(data.html);
                }
            });
        });

    // Abrir modal para editar
    const puedeEditarTipoProducto = {{ $tienePermisoEditar ? 'true' : 'false' }};
    $(document).on('click', '.edit-tipoP-type', function() {
    if (puedeEditarTipoProducto) {
        // Obtener datos del elemento
        const tipoData = $(this).data();
        
        // 1. Cerrar primero la modal principal
        $('#productTypeModal').modal('hide');
        
        // 2. Esperar a que se cierre completamente
        $('#productTypeModal').one('hidden.bs.modal', function() {
            // 3. Llenar los campos del formulario de edición
            $('#editProductTypeId').val(tipoData.id);
            $('#editProductTypeName').val(tipoData.nombre);
            $('#editProductTypeDescription').val(tipoData.descripcion);
            
            // 4. Mostrar la modal de edición con un pequeño retraso
            setTimeout(() => {
                const editModal = new bootstrap.Modal(document.getElementById('editTipoProductoModal'));
                editModal.show();
                
                // 5. Forzar la creación del backdrop si es necesario
                if ($('.modal-backdrop').length === 0) {
                    $('body').append('<div class="modal-backdrop fade show"></div>');
                    $('body').addClass('modal-open');
                }
                
                // 6. Asegurar el z-index correcto
                $('.modal-backdrop').css('z-index', '1040');
                $('#editTipoProductoModal').css('z-index', '1050');
            }, 100);
        });
    } else {
        alert('Permiso denegado para editar el tipo de producto.');
    }
});

        // Actualizar tipo de producto
        $('#updateProductTypeBtn').click(function() {
        let id = $('#editProductTypeId').val();
        
        $.ajax({
            url: '/tipo-producto/' + id,
            method: 'PUT',
            data: {
                nombre: $('#editProductTypeName').val(),
                descripcion: $('#editProductTypeDescription').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Cerrar correctamente la modal de edición
                closeModalAndShowParent('#editTipoProductoModal', '#productTypeModal');
                loadTiposProducto();
                showNotification('success', 'Tipo de producto actualizado');
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
        $('#editTipoProductoModal').on('hidden.bs.modal', function() {
            $('#editProductTypeForm')[0].reset();
            $('.input-group-outline').removeClass('is-filled');
        });

        // Guardar tipo de producto
        // Guardar tipo de producto - Versión corregida
        $('#saveProductTypeBtn').click(function() {
            let id = $('#productTypeId').val();
            let url = id ? '/tipo-producto/' + id : '/tipo-producto';
            let method = id ? 'PUT' : 'POST';
            
            $.ajax({
                url: url,
                method: method,
                data: {
                    nombre: $('#productTypeName').val(),
                    descripcion: $('#productTypeDescription').val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // 1. Cerrar la modal de creación
                    $('#addTipoProductModal').modal('hide');
                    
                    // 2. Recargar la lista de tipos en la modal principal
                    loadTiposProducto();
                    
                    // 3. Actualizar el select en la modal de costo
                    updateTipoProductoSelect();
                    
                    // 4. Mostrar notificación
                    showNotification('success', id ? 'Tipo de producto actualizado' : 'Tipo de producto creado');
                    
                    // 5. Reabrir la modal principal después de un breve retraso
                    setTimeout(() => {
                        $('#productTypeModal').modal('show');
                    }, 300);
                    
                    // Resetear el formulario
                    resetForm();
                },
                error: function(xhr) {
                    // Manejo de errores...
                }
            });
        });

        // Eliminar tipo de producto
    const puedeEliminarTipoProducto = {{ $puedeEliminarTipoProducto ? 'true' : 'false' }};
    // Eliminar tipo de producto - Versión mejorada
$(document).on('click', '.delete-tipoP-type', function() {
    if (!puedeEliminarTipoProducto) {
        alert('Permiso denegado para eliminar tipo de producto.');
        return;
    }

    if (confirm('¿Estás seguro de eliminar este tipo de producto?')) {
        const tipoId = $(this).data('id');
        
        $.ajax({
            url: '/tipo-producto/' + tipoId,
            method: 'DELETE',
            data: { 
                _token: '{{ csrf_token() }}' 
            },
            success: function(response) {
                // 1. Recargar la lista de tipos en la modal principal
                loadTiposProducto();
                
                // 2. Actualizar el select en la modal de costo
                updateTipoProductoSelect();
                
                // 3. Mostrar notificación
                showNotification('success', 'Tipo de producto eliminado');
                
                // 4. Si el tipo eliminado estaba seleccionado en costo, resetear
                if ($('#tipoProductoSelect').val() == tipoId) {
                    $('#tipoProductoSelect').val('');
                }
            },
            error: function(xhr) {
                showNotification('danger', xhr.responseJSON.message || 'Error al eliminar');
            }
        });
    }
});

        // Resetear formulario al cerrar
        $('#addTipoProductModal').on('hidden.bs.modal', function() {
            resetForm();
            if($('#productTypeModal').length) {
                $('#productTypeModal').modal('show');
            }
        });

        function loadTiposProducto() {
    let search = $('#searchProductType').val();
    
    // Mostrar carga mientras se actualiza
    $('#productTypesList').html('<div class="text-center p-3"><i class="fa fa-spinner fa-spin"></i> Cargando...</div>');
    
    $.get('/tipo-producto', { search: search })
        .done(function(data) {
            $('#productTypesList').html(data.html);
            
            // Si hay una modal de tipos abierta, asegurarse que está visible
            if ($('#productTypeModal').hasClass('show')) {
                $('body').addClass('modal-open');
                $('#productTypeModal').css('display', 'block');
            }
        })
        .fail(function() {
            showNotification('danger', 'Error al cargar los tipos de producto');
            $('#productTypesList').html('<div class="text-danger p-3">Error al cargar los datos</div>');
        });
}

        function resetForm() {
            $('#productTypeForm')[0].reset();
            $('#productTypeId').val('');
            $('#modalTitle').text('Agregar Tipo de Producto');
            
            // Resetear las etiquetas flotantes
            $('.input-group-outline').removeClass('is-filled');
        }

        function showNotification(type, message) {
            // Reemplaza esto con tu sistema de notificaciones preferido
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
            loadProductTypes(page);
        });

        function loadProductTypes(page) {
            $.ajax({
                url: '/tipo-producto/',
                data: {page: page},
                success: function(data) {
                    $('#productTypesList').html(data.html); // Asegúrate de que tu controlador devuelva la vista adecuada
                }
            });
        }
    });


    // --------------------------- Modal Costo --------------------------------------

        $(document).ready(function() {
        // Configurar modal de costo
        $('#costoModal').on('shown.bs.modal', function() {
    // Actualizar el select cada vez que se abre la modal
    updateTipoProductoSelect();
    
    // Resetear otros campos
    $('#proveedorSelect').val('');
    $('#costoTonelada').val('');
});

        // Enviar formulario de costo
        $('#formAsignarCosto').submit(function(e) {
            e.preventDefault();
            
            let tipoId = $('#tipoProductoSelect').val();
            let costo = $('#costoTonelada').val();
            
            if (!tipoId) {
                showNotification('danger', 'Selecciona un tipo de producto');
                return;
            }

            $.ajax({
                url: '/productos/asignar-costo-por-tipo',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id_tipo_producto: tipoId,
                    costo_tonelada: costo
                },
                success: (response) => {
                    $('#costoModal').modal('hide');
                    showNotification('success', response.message);
                    
                    // Actualizar todas las filas que tengan este tipo de producto
                    $('td').filter(function() {
                        return $(this).text().trim() === response.tipo_producto;
                    }).closest('tr').find('td:eq(3)').text('$'+parseFloat(costo).toFixed(2));
                },
                error: (xhr) => {
                    showNotification('danger', xhr.responseJSON.message || 'Error al guardar');
                }
            });
        });
    });

    function showNotification(type, message) {
        const toast = `<div class="toast align-items-center text-white bg-${type} border-0 position-fixed bottom-0 end-0 m-3" role="alert">
            <div class="d-flex">
                <div class="toast-body">${message}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>`;
        $('body').append(toast);
        $('.toast').toast('show');
        setTimeout(() => $('.toast').remove(), 3000);
    }
    
    // --------------------------- Modal Ubicacion Producto -------------------------

    //modal ubicacion de productos
    $(document).ready(function() {

        let ubicacionModalState = {
        adding: false,
        mainModalVisible: false
        };
        
        // Cargar ubicacion de producto al abrir el modal
        $('#ubicacionProductoModal').on('shown.bs.modal', function() {
        ubicacionModalState.mainModalVisible = true;
        loadUbicacionProducto();
    });

    $('#ubicacionProductoModal').on('hidden.bs.modal', function() {
        ubicacionModalState.mainModalVisible = false;
        // Limpiar backdrops si no hay otras modales abiertas
        if ($('.modal.show').length === 0) {
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        }
    });

        // Búsqueda de ubicacion de producto
        $('#searchUbicacionProductType').on('input', function() {
            loadUbicacionProducto();
        });

        // Cargar más resultados
        $(document).on('click', '.load-more', function() {
            let page = $(this).data('page');
            let search = $('#searchUbicacionProductType').val();
            
            $.get('/ubicacion-producto', { page: page, search: search }, function(data) {
                if(data.next_page_url) {
                    $('#ubicacionProductList .load-more').parent().remove();
                    $('#ubicacionProductList').append(data.html);
                } else {
                    $('#ubicacionProductList').append(data.html);
                }
            });
        });

 
const puedeEditarUbicacion = @json($puedeEditarUbicacion);
// Abrir modal para editar ubicación - Versión corregida
$(document).on('click', '.edit-ubicacionP-type', function(e) {
    e.preventDefault();
    
    if (!puedeEditarUbicacion) {
        alert('Permiso denegado para editar la ubicación del producto.');
        return;
    }

    // Obtener datos del botón
    const ubicacionData = $(this).data();
    
    // 1. Cerrar primero la modal principal
    $('#ubicacionProductoModal').modal('hide');
    
    // 2. Cuando la modal principal se haya ocultado completamente
    $('#ubicacionProductoModal').one('hidden.bs.modal', function() {
        // 3. Llenar los campos de la modal de edición
        $('#editProductUbicacionId').val(ubicacionData.id);
        $('#editProductUbicacionName').val(ubicacionData.nombre);
        $('#editProductUbicacionDescription').val(ubicacionData.descripcion);
        
        // 4. Mostrar la modal de edición con un pequeño retraso
        setTimeout(() => {
            $('#editUbicacionProductoModal').modal('show');
            
            // 5. Forzar la creación del backdrop si es necesario
            if ($('.modal-backdrop').length === 0) {
                $('body').append('<div class="modal-backdrop fade show"></div>');
            }
        }, 100);
    });
});

            // Actualizar tipo de producto
            $('#updateProductUbicacionBtn').click(function() {
    let id = $('#editProductUbicacionId').val();
    
    $.ajax({
        url: '/ubicacion-producto/' + id,
        method: 'PUT',
        data: {
            nombre: $('#editProductUbicacionName').val(),
            descripcion: $('#editProductUbicacionDescription').val(),
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            // Cerrar correctamente la modal de edición
            $('#editUbicacionProductoModal').modal('hide');
            
            // Esperar a que se cierre completamente antes de abrir la principal
            $('#editUbicacionProductoModal').one('hidden.bs.modal', function() {
                // Recargar la lista
                loadUbicacionProducto();
                
                // Mostrar notificación
                showNotification('success', 'Ubicación del producto actualizada');
                
                // Reabrir la modal principal
                setTimeout(() => {
                    $('#ubicacionProductoModal').modal('show');
                }, 100);
            });
        },
        error: function(xhr) {
            // Manejo de errores...
        }
    });
});

        // Resetear formulario al cerrar modal de edición
        $('#editUbicacionProductoModal').on('hidden.bs.modal', function() {
            $('#editProductUbicacionForm')[0].reset();
            $('.input-group-outline').removeClass('is-filled');
        });

        // Guardar tipo de producto
        // Guardar ubicación del producto - Versión corregida
$('#saveUbicacionProductBtn').off('click').on('click', function() {
    const id = $('#productUbicacionId').val();
    const nombre = $('#productUbicacionName').val().trim();
    const descripcion = $('#productUbicacionDescription').val().trim();

    if (!nombre) {
        showNotification('danger', 'El nombre es requerido');
        return;
    }

    $.ajax({
        url: id ? `/ubicacion-producto/${id}` : '/ubicacion-producto',
        method: id ? 'PUT' : 'POST',
        data: {
            nombre: nombre,
            descripcion: descripcion,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            // 1. Cerrar modal de creación
            const addModal = bootstrap.Modal.getInstance(document.getElementById('addUbicacionProductModal'));
            addModal.hide();
            
            // 2. Resetear formulario
            $('#productUbicacionForm')[0].reset();
            $('#productUbicacionId').val('');
            
            // 3. Mostrar notificación
            showNotification('success', response.message || (id ? 'Ubicación actualizada' : 'Ubicación creada'));
            
            // 4. Esperar a que se cierre completamente la modal de creación
            $('#addUbicacionProductModal').one('hidden.bs.modal', function() {
                // 5. Eliminar cualquier backdrop residual
                $('.modal-backdrop').remove();
                
                // 6. Recargar lista de ubicaciones
                loadUbicacionProducto();
                
                // 7. Mostrar la modal principal después de un breve retraso
                setTimeout(() => {
                    const mainModal = new bootstrap.Modal(document.getElementById('ubicacionProductoModal'));
                    mainModal.show();
                    
                    // 8. Asegurar que el backdrop esté presente
                    if ($('.modal-backdrop').length === 0) {
                        $('body').append('<div class="modal-backdrop fade show"></div>');
                    }
                    
                    // 9. Restaurar clases del body
                    $('body').addClass('modal-open');
                }, 150);
            });
        },
        error: function(xhr) {
            // Manejo de errores...
        }
    });
});

        //Eliminar ubicación del producto
    const puedeEliminarUbicacion = {{ $puedeEliminarUbicacion ? 'true' : 'false' }};
    $(document).on('click', '.delete-ubicacionP-type', function () {
        if (!puedeEliminarUbicacion) {
            alert('Permiso denegado para eliminar ubicación.');
            window.location.href = "{{ route('dashboard') }}?error=permiso_denegado";
            return;
        }

        if (confirm('¿Estás seguro de eliminar esta ubicación del producto?')) {
            $.ajax({
                url: '/ubicacion-producto/' + $(this).data('id'),
                method: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: function () {
                    loadUbicacionProducto();
                    showNotification('success', 'Ubicación del producto eliminada');
                },
                error: function (xhr) {
                    showNotification('danger', 'Error al eliminar la ubicación del producto');
                }
            });
        }
    });

        // Resetear formulario al cerrar
        $('#addUbicacionProductModal').on('hidden.bs.modal', function() {
            resetForm();
            // Forzar el show del modal padre si existe
            if($('#ubicacionProductoModal').length) {
                $('#ubicacionProductoModal').modal('show');
            }
        });

        function loadUbicacionProducto() {
            let search = $('#searchUbicacionProductType').val();
            $.get('/ubicacion-producto', { search: search }, function(data) {
                $('#ubicacionProductList').html(data.html);
            }).fail(function() {
                showNotification('danger', 'Error al cargar la ubicación del producto');
            });
        }

        function resetForm() {
            $('#productUbicacionForm')[0].reset();
            $('#productUbicacionId').val('');
            $('#modalTitle').text('Agregar Ubicación del Producto');
            
            // Resetear las etiquetas flotantes
            $('.input-group-outline').removeClass('is-filled');
        }

        function showNotification(type, message) {
            // Reemplaza esto con tu sistema de notificaciones preferido
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
            loadUbicacionProducto(page);
        });

        function loadUbicacionTypes(page) {
            $.ajax({
                url: '/ubicacion-producto/',
                data: {page: page},
                success: function(data) {
                    $('#ubicacionProductList').html(data.html); // Asegúrate de que tu controlador devuelva la vista adecuada
                }
            });
        }
    });

    // Configurar eventos para manejar correctamente las transiciones
$(document).on('show.bs.modal', '.modal', function() {
    // Mantener solo un backdrop
    if ($('.modal-backdrop').length > 1) {
        $('.modal-backdrop').not(':last').remove();
    }
    
    // Asegurar que el body tenga la clase correcta
    $('body').addClass('modal-open');
});

$(document).on('hidden.bs.modal', '.modal', function() {
    // Si no hay más modales abiertas, limpiar el backdrop
    if ($('.modal.show').length === 0) {
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
    }
});

function updateTipoProductoSelect() {
    // Mostrar estado de carga
    $('#tipoProductoSelect').html('<option value="">Cargando tipos...</option>');
    
    $.ajax({
        url: '/tipo-producto/list',
        method: 'GET',
        success: function(data) {
            let select = $('#tipoProductoSelect');
            select.empty();
            select.append('<option value="">Seleccionar tipo de producto</option>');
            
            data.forEach(function(tipo) {
                select.append(`<option value="${tipo.id_tipo_producto}">${tipo.nombre}</option>`);
            });
            
            // Si solo hay una opción (el placeholder), deshabilitar el select
            if (data.length === 0) {
                select.append('<option value="" disabled>No hay tipos disponibles</option>');
            }
        },
        error: function() {
            $('#tipoProductoSelect').html('<option value="">Error al cargar tipos</option>');
            showNotification('danger', 'Error al cargar los tipos de producto');
        }
    });
}

function switchModals(currentModal, nextModal) {
    const current = bootstrap.Modal.getInstance(document.querySelector(currentModal));
    const next = new bootstrap.Modal(document.querySelector(nextModal));
    
    // Ocultar la modal actual
    current.hide();
    
    // Cuando se haya ocultado completamente
    $(currentModal).one('hidden.bs.modal', function() {
        // Mostrar la nueva modal
        next.show();
        
        // Asegurar que el backdrop esté presente
        if ($('.modal-backdrop').length === 0) {
            $('body').append('<div class="modal-backdrop fade show"></div>');
        }
        
        // Asegurar que el body tenga las clases correctas
        $('body').addClass('modal-open');
    });
}

    </script>
    @endpush
</x-layout>