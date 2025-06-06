<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="transporte"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Transporte"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <!-- Barra de búsqueda y filtros -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <!-- Buscador con lupa -->
                                <div class="flex-grow-1" style="max-width: 250px;">
                                    <div class="input-group" style="
                                        border: 1px solid #ced4da;
                                        border-radius: 10px;
                                        overflow: hidden;
                                        height: 37px;">
                                        <input 
                                            type="text" 
                                            class="form-control form-control-sm border-0 ps-2" 
                                            placeholder="Modelo o Tipo"
                                            style="box-shadow: none !important;
                                                    padding: 0 10px;
                                                    height: 100%;
                                                    line-height: normal;">
                                        <button 
                                            class="btn btn-outline-secondary border-0" 
                                            type="button"
                                            style="border-left: 1px solid #ced4da !important;
                                                border-radius: 0 !important;
                                                background: transparent;
                                                height: 100%;
                                                display: flex;
                                                align-items: center;">
                                            <i class="material-icons" style="font-size: 1.2rem;">search</i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Botón Filtro (con dropdown) -->
                                <div class="ms-2" style="height: 37px;">
                                    <div class="dropdown">
                                        <button class="btn btn-light bg-white d-flex align-items-center gap-2 justify-content-center dropdown-toggle px-3 py-2" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false" 
                                        style="border-radius: 8px; height: 100%; width: 100px;">
                                            <i class="material-icons">filter_alt</i>
                                            <span style="font-size: 0.8.5rem;">Filtro</span>
                                        </button>
                                        <ul class="dropdown-menu w-100" aria-labelledby="filterDropdown">
                                            <li><a class="dropdown-item" href="#">Más recientes</a></li>
                                            <li><a class="dropdown-item" href="#">Más antiguos</a></li>
                                            <li><a class="dropdown-item" href="#">Mayor costo</a></li>
                                            <li><a class="dropdown-item" href="#">Menor costo</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Sección alineada a la derecha -->
                                <div class="ms-auto d-flex gap-2">
                                  <!-- Botón que activa el modal sin cambiar de página -->
<button type="button" class="btn btn-light bg-white d-flex align-items-center justify-content-center gap-2"
    style="border-radius: 8px; font-size: 10px; height: 100%; width: 140px; padding: 0 8px;"
    data-bs-toggle="modal" data-bs-target="#productTypeModal">
    <i class="material-icons">airport_shuttle</i>
    <span style="font-size: 0.8.5rem;">Tipo de Transporte</span>
</button>

<!-- Modal principal -->
<div class="modal fade" id="productTypeModal" tabindex="-1" aria-labelledby="productTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productTypeModalLabel">Tipo de Transporte</h5>
                <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <span class="input-group-text">
                        <i class="material-icons">search</i>
                    </span>
                    <input type="text" class="form-control" placeholder="Buscar tipo de transporte...">
                </div>

                <div class="list-group">
                    <!-- Elementos de ejemplo -->
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-sm">Traila</h6>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalEditarTipo">
                            <i class="material-icons text-secondary">edit</i>
                        </button>
                    </div>
                    <hr>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 text-sm">Torton </h6>
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#modalEditarTipo">
                            <i class="material-icons text-secondary">edit</i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarTipo">
                    <i class="material-icons">add</i> Agregar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar Tipo -->
<div class="modal fade" id="modalAgregarTipo" tabindex="-1" aria-labelledby="modalAgregarTipoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#productTypeModal">
                    <i class="material-icons">arrow_back</i>
                </button>
                <h5 class="modal-title" id="modalAgregarTipoLabel">Agregar Tipo de transporte</h5>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" placeholder="Nombre del Tipo de transporte">
                <textarea class="form-control" rows="3" placeholder="Descripción"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-primary">Guardar</button>
                <button type="button" class="btn btn-dark bg-black" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar Tipo -->
<div class="modal fade" id="modalEditarTipo" tabindex="-1" aria-labelledby="modalEditarTipoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#productTypeModal">
                    <i class="material-icons">arrow_back</i>
                </button>
                <h5 class="modal-title">Editar Tipo de transporte</h5>
                <button type="button" class="btn">
                    <i class="material-icons">delete</i>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" placeholder="Nombre">
                <textarea class="form-control" rows="3" placeholder="Descripción"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-gradient-primary">Guardar</button>
                <button type="button" class="btn btn-dark bg-black" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
                                    
                                    <!-- Botón Agregar Transporte -->
                                    @if(hasPermission(1))
                                    <div style="height: 37px;">
                                        <a href="{{ route('agregar-transporte') }}" class="btn btn-dark bg-black d-flex align-items-center justify-content-center gap-2" style="
                                            border-radius: 8px;
                                            font-size: 12px;
                                            height: 100%;
                                            width: 115px; 
                                            padding: 0 8px;">
                                            <i class="material-icons" style="font-size: 18px;">add</i>
                                            <span style="font-size: 0.8.5rem;">Agregar</span>
                                        </a>
                                    </div>
                                    @endif
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Transporte -->
            <div class="row">
                <div class="col-12">
                    <div class="card border">
                        <div class="table-responsive p-4">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de Salida</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tipo de Transporte</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trabajador</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ubicación Entrega</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Registro 1 -->
                                    <tr>
                                        <td class="text-xs">15/06/2024</td>
                                        <td class="text-xs">Traila</td>
                                        <td class="text-center text-xs">Juan Pérez</td>
                                        <td class="text-center text-xs">Mercado Central</td>
                                        <td class="text-center text-xs">Maiz, pan, trigo y pan</td>
                                        <td class="text-center text-xs">
                                            <a href="{{ route('ver-transporte') }}" class="text-dark me-3" title="Ver">
                                            <i class="material-icons">visibility</i>
                                           </a>
                                             <a href="{{ route('editar-transporte') }}" class="text-dark me-3" title="Editar">
                                            <i class="material-icons">edit</i>
                                            </a>
                                            <a href="#" class="text-dark" title="Eliminar">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Registro 2 -->
                                    <tr>
                                        <td class="text-xs">20/06/2024</td>
                                        <td class="text-xs">Torton</td>
                                        <td class="text-center text-xs">María López</td>
                                        <td class="text-center text-xs">Bodega Norte</td>
                                        <td class="text-center text-xs">Pan y Maiz</td>
                                        <td class="text-center text-xs">
                                           <a href="{{ route('ver-transporte') }}" class="text-dark me-3" title="Ver">
                                            <i class="material-icons">visibility</i>
                                           </a>
                                            <a href="#" class="text-dark me-3" title="Editar">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <a href="#" class="text-dark" title="Eliminar">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                               
                                 <!-- Registro 3 -->
                                    <tr>
                                        <td class="text-xs">15/06/2024</td>
                                        <td class="text-xs">Traila</td>
                                        <td class="text-center text-xs">Juan Pérez</td>
                                        <td class="text-center text-xs">Mercado Central</td>
                                        <td class="text-center text-xs">Maiz, pan, trigo y pan</td>
                                        <td class="text-center text-xs">
                                            <a href="{{ route('ver-transporte') }}" class="text-dark me-3" title="Ver">
                                            <i class="material-icons">visibility</i>
                                           </a>
                                             <a href="{{ route('editar-transporte') }}" class="text-dark me-3" title="Editar">
                                            <i class="material-icons">edit</i>
                                            </a>
                                            <a href="#" class="text-dark" title="Eliminar">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                     <!-- Registro 4 -->
                                    <tr>
                                        <td class="text-xs">15/06/2024</td>
                                        <td class="text-xs">Traila</td>
                                        <td class="text-center text-xs">Juan Pérez</td>
                                        <td class="text-center text-xs">Mercado Central</td>
                                        <td class="text-center text-xs">Maiz, pan, trigo y pan</td>
                                        <td class="text-center text-xs">
                                            <a href="{{ route('ver-transporte') }}" class="text-dark me-3" title="Ver">
                                            <i class="material-icons">visibility</i>
                                           </a>
                                             <a href="{{ route('editar-transporte') }}" class="text-dark me-3" title="Editar">
                                            <i class="material-icons">edit</i>
                                            </a>
                                            <a href="#" class="text-dark" title="Eliminar">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                     <!-- Registro 5 -->
                                    <tr>
                                        <td class="text-xs">15/06/2024</td>
                                        <td class="text-xs">Traila</td>
                                        <td class="text-center text-xs">Juan Pérez</td>
                                        <td class="text-center text-xs">Mercado Central</td>
                                        <td class="text-center text-xs">Maiz, pan, trigo y pan</td>
                                        <td class="text-center text-xs">
                                            <a href="{{ route('ver-transporte') }}" class="text-dark me-3" title="Ver">
                                            <i class="material-icons">visibility</i>
                                           </a>
                                             <a href="{{ route('editar-transporte') }}" class="text-dark me-3" title="Editar">
                                            <i class="material-icons">edit</i>
                                            </a>
                                            <a href="#" class="text-dark" title="Eliminar">
                                                <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                     <!-- Registro 6 -->
                                    <tr>
                                        <td class="text-xs">15/06/2024</td>
                                        <td class="text-xs">Traila</td>
                                        <td class="text-center text-xs">Juan Pérez</td>
                                        <td class="text-center text-xs">Mercado Central</td>
                                        <td class="text-center text-xs">Maiz, pan, trigo y pan</td>
                                        <td class="text-center text-xs">
                                            <a href="{{ route('ver-transporte') }}" class="text-dark me-3" title="Ver">
                                            <i class="material-icons">visibility</i>
                                           </a>
                                             <a href="{{ route('editar-transporte') }}" class="text-dark me-3" title="Editar">
                                            <i class="material-icons">edit</i>
                                            </a>
                                            <a href="#" class="text-dark" title="Eliminar">
                                                <i class="material-icons">delete</i>
                                            </td>
                                    </tr>
                                </tbody>
 <script>
    let currentPage = 1;
    const usersPerPage = 4;
    let allUsers = [];

    function initPagination() {
        const table = document.querySelector('.table tbody');
        allUsers = Array.from(table.querySelectorAll('tr')).filter(tr =>
            tr.style.display !== 'none'
        );
        showPage(1);
    }

    function showPage(page) {
        currentPage = page;
        const startIndex = (page - 1) * usersPerPage;
        const endIndex = startIndex + usersPerPage;

        allUsers.forEach(user => user.style.display = 'none');
        allUsers.slice(startIndex, endIndex).forEach(user => user.style.display = '');

        updatePaginationControls();
    }

    function updatePaginationControls() {
        const totalPages = Math.ceil(allUsers.length / usersPerPage);
        const paginationContainer = document.querySelector('.pagination');
        paginationContainer.innerHTML = '';

        // Botón anterior
        const prevItem = document.createElement('li');
        prevItem.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevItem.innerHTML = `
            <a class="page-link" href="#" onclick="changePage(${currentPage - 1})" aria-disabled="${currentPage === 1}">
                <i class="material-icons" style="font-size: 1rem;">chevron_left</i>
            </a>`;
        paginationContainer.appendChild(prevItem);

        // Números de página
        for (let i = 1; i <= totalPages; i++) {
            const pageItem = document.createElement('li');
            pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
            pageItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
            paginationContainer.appendChild(pageItem);
        }

        // Botón siguiente
        const nextItem = document.createElement('li');
        nextItem.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        nextItem.innerHTML = `
            <a class="page-link" href="#" onclick="changePage(${currentPage + 1})" aria-disabled="${currentPage === totalPages}">
                <i class="material-icons" style="font-size: 1rem;">chevron_right</i>
            </a>`;
        paginationContainer.appendChild(nextItem);
    }

    function changePage(page) {
        const totalPages = Math.ceil(allUsers.length / usersPerPage);
        if (page < 1 || page > totalPages) return;
        showPage(page);
        document.querySelector('.card').scrollIntoView({ behavior: 'smooth' });
    }

    document.addEventListener('DOMContentLoaded', initPagination);
</script>

                            </table>
                            <div class="card-footer d-flex justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm mb-0"></ul>
    </nav>
</div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>