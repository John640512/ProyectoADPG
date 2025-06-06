<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <!-- Sidebar -->
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Usuarios"></x-navbars.navs.auth>
        
        <!-- Contenido principal -->
        <div class="container-fluid py-0">
            <div class="row">
                <div class="col-12">
                    
                    <!-- Header y barra de búsqueda -->
                    <h2 class="text-black"><strong>Usuarios</strong></h2>
                    <div class="card mb-4">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-md-8 col-12 d-flex align-items-center gap-3">
                                    <div style="min-width: 250px; flex-grow: 1;">
                                        <div class="input-group input-group-outline">
                                            <span class="input-group-text" style="padding-left: 12px; padding-right: 345px;">
                                                <i class="material-icons" style="font-size: 20px;">search</i>
                                            </span>
                                            <input type="text" id="searchInput" class="form-control ps-3" placeholder="Nombre o Rol" style="padding-left: 2rem !important;"></div>
                                        </div>                
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-secondary btn-sm mb-0 text-lowercase" 
                                                style="text-transform: none !important" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#filterModal">
                                                <i class="material-icons text-sm me-1">filter_alt</i>Filtro
                                            </button>
                                            
                                            @if(hasPermission(10))
                                            <button type="button" class="btn btn-outline-secondary btn-sm mb-0 text-lowercase" style="text-transform: none !important" data-bs-toggle="modal" data-bs-target="#rolesModal">
                                                <i class="material-icons text-sm me-1">groups</i>Roles
                                            </button>
                                            @else
                                            <button type="" onclick="return false;" class="btn btn-outline-secondary btn-sm mb-0 text-lowercase" style="text-transform: none !important" data-bs-toggle="modal">
                                                <i class="material-icons text-sm me-1">groups</i>Roles
                                            </button>
                                            @endif

                                            @if(hasPermission(10))
                                            <button type="button" class="btn btn-outline-secondary btn-sm mb-0 text-lowercase" 
                                                    style="text-transform: none !important" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#permissionsModal">
                                                <i class="material-icons text-sm me-1">admin_panel_settings</i>Permisos
                                            </button>
                                            @else
                                            <button type="" onclick="return false;" class="btn btn-outline-secondary btn-sm mb-0 text-lowercase" 
                                                    style="text-transform: none !important" 
                                                    data-bs-toggle="modal">
                                                <i class="material-icons text-sm me-1">admin_panel_settings</i>Permisos
                                            </button>
                                            @endif
                                             
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 text-md-end mt-md-0 mt-2">

                                        @if(hasPermission(10))
                                        <a href="{{ route('usuarios.create') }}" class="btn btn-sm bg-gradient-dark mb-0" style="text-transform: none !important;">
                                            <i class="material-icons text-sm me-1">person_add</i>Nuevo usuario
                                        </a>
                                        @else
                                        <a href="" onclick="return false;" class="btn btn-sm bg-gradient-dark mb-0" style="text-transform: none !important;">
                                            <i class="material-icons text-sm me-1">person_add</i>Nuevo usuario
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de Filtros -->
                        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-normal">Filtrar usuarios</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0);"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <h6 class="font-weight-normal mb-3">Ordenar por:</h6>
                                            <div class="btn-group w-100" role="group">
                                                <button type="button" class="btn btn-outline-dark" onclick="sortUsers('asc')">
                                                    <i class="material-icons me-1">sort_by_alpha</i> A-Z
                                                </button>
                                                <button type="button" class="btn btn-outline-dark" onclick="sortUsers('desc')">
                                                    <i class="material-icons me-1">sort_by_alpha</i> Z-A
                                                </button>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <h6 class="font-weight-normal mb-3">Filtrar por rol:</h6>
                                            <div class="list-group scrollable-roles" id="roleFilterList" style="max-height: 250px; overflow-y: auto;">
                                                <!-- Opción "Todos" (se mantiene) -->
                                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                                                onclick="filterByRole('all')">
                                                    Todos los usuarios
                                                    <i class="material-icons">group</i>
                                                </a>
                                                <!-- Roles se cargarán dinámicamente aquí -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-gradient-dark btn-sm text-lowercase" style="text-transform: none !important" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Modal de Roles -->
                    <div class="modal fade" id="rolesModal" tabindex="-1" aria-labelledby="rolesModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-normal">Roles</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0);"></button>
                                </div>
                                <div class="modal-body p-3">
                                    <ul class="list-group list-group-flush scrollable-roles" 
                                        id="roleList" 
                                        style="max-height: 300px; overflow-y: auto;">
                                    </ul>
                                </div>
                                <div class="modal-footer justify-content-between p-3">
                                    <button type="button" class="btn bg-gradient-dark btn-sm text-lowercase" style="text-transform: none !important" onclick="openAddRoleModal()">
                                        <i class="material-icons text-sm me-1">add</i> Nuevo rol
                                    </button>
                                    <button type="button" class="btn bg-gradient-dark btn-sm text-lowercase" style="text-transform: none !important" data-bs-dismiss="modal">
                                        <i class="material-icons text-sm">check</i> Listo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Agregar Rol (Modificado) -->
                    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-normal">Nuevo rol</h5>
                                    <button type="button" class="btn-close text-dark" onclick="closeAddRoleModal()" style="filter: brightness(0);"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addRoleForm">
                                        @csrf
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Nombre del rol</label>
                                            <input type="text" name="nombre" class="form-control" required maxlength="200">
                                        </div>
                                        <div class="input-group input-group-outline mb-3">
                                            <label class="form-label">Descripción del rol (opcional)</label>
                                            <textarea name="descripcion" class="form-control" maxlength="500"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary text-lowercase" style="text-transform: none !important" onclick="closeAddRoleModal()">Cancelar</button>
                                    <button type="button" class="btn bg-gradient-dark" style="text-transform: none !important" onclick="saveNewRole()">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Modal para Editar Rol (Modificado) -->
                    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-normal">Editar rol</h5>
                                    <button type="button" class="btn-close text-dark" onclick="closeEditRoleModal()" style="filter: brightness(0);"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editRoleForm">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="editRoleId">
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Nombre del rol</label>
                                            <input type="text" class="form-control" id="editRoleName" name="nombre" required maxlength="200">
                                        </div>
                                        <div class="input-group input-group-outline mb-3 is-filled">
                                            <label class="form-label">Descripción del rol (opcional)</label>
                                            <textarea class="form-control" id="editRoleDescription" name="descripcion" maxlength="500"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer justify-content-end">
                                    <button type="button" class="btn btn-outline-secondary text-lowercase" style="text-transform: none !important" onclick="closeEditRoleModal()">Cancelar</button>
                                    <button type="button" class="btn bg-gradient-dark" style="text-transform: none !important" onclick="saveRoleChanges()">Guardar cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Eliminar Rol-->
                    <div class="modal fade" id="deleteRoleConfirmModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Estás seguro de eliminar este rol? Esta acción no se puede deshacer.</p>
                                    <p class="text-danger"><small>Si el rol está asignado a usuarios, no podrá eliminarse.</small></p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary text-lowercase" style="text-transform: none !important" onclick="closeDeleteRoleConfirmModal()">Cancelar</button>
                                    <button type="button" class="btn btn-danger" style="text-transform: none !important" onclick="deleteRole()">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Modal de permisos -->
                    <div class="modal fade" id="permissionsModal" tabindex="-1" aria-labelledby="permissionsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-normal">Permisos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0);"></button>
                                </div>
                                <div class="modal-body p-4">
                                    <!-- Selector de Rol -->
                                    <div class="mb-3">
                                        <label class="form-label mb-1"><strong>Rol</strong> <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" id="selectRol" onchange="loadPermissions()">
                                            <option value="" selected disabled>Seleccione un rol</option>
                                            @foreach(\App\Models\Rol::all() as $rol)
                                                <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- Lista de Permisos (solo visible cuando se selecciona un rol) -->
                                    <div id="permissionsList" class="mt-3 d-none">
                                        <h6 class="text-sm font-weight-bold mb-2">Permisos asignados:</h6>
                                        <ul class="list-group list-group-flush scrollable-permissions" 
                                            id="assignedPermissions" 
                                            style="max-height: 250px; overflow-y: auto;">
                                            <!-- Dinámico -->
                                        </ul>
                                        <div class="mt-3 border-top pt-3">
                                            <h6 class="text-sm font-weight-bold mb-2">Asignar nuevo permiso:</h6>
                                            <div class="d-flex gap-2">
                                                <select class="form-select form-select-sm" id="availablePermissions">
                                                    <option value="">Seleccione permiso...</option>
                                                    <!-- Dinámico -->
                                                </select>
                                                <button class="btn btn-sm bg-gradient-dark mb-0" onclick="assignPermission()">
                                                    <i class="material-icons text-sm">add</i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between p-3">
                                    <button type="button" class="btn bg-gradient-dark btn-sm text-lowercase" style="text-transform: none !important" onclick="resetPermissionsModal()">
                                        <i class="material-icons text-sm me-1">refresh</i> Limpiar
                                    </button>
                                    <button type="button" class="btn bg-gradient-dark btn-sm text-lowercase" style="text-transform: none !important" data-bs-dismiss="modal">
                                        <i class="material-icons text-sm">check</i> Listo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Editar Permiso -->
                    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel" aria-hidden="true" data-bs-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-normal">Editar Permiso</h5>
                                    <button type="button" class="btn-close" onclick="closeEditPermissionModal()" style="filter: brightness(0);"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editPermissionForm">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="editPermissionId" name="id">
                                        <div class="input-group input-group-outline mb-4 is-filled">
                                            <label class="form-label">Nombre del permiso</label>
                                            <input type="text" id="editPermissionName" name="nombre" class="form-control" required maxlength="200">
                                        </div>
                                        <div class="input-group input-group-outline mb-4 is-filled">
                                            <label class="form-label">Descripción del permiso</label>
                                            <textarea id="editPermissionDescription" name="descripcion" class="form-control" rows="3" maxlength="500"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary text-lowercase" style="text-transform: none !important" onclick="closeEditPermissionModal()">Cancelar</button>
                                    <button type="button" style="text-transform: none !important" class="btn bg-gradient-dark" onclick="updatePermission()">Guardar cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Remover Permiso de Rol -->
                    <div class="modal fade" id="removePermissionModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-warning text-dark">
                                    <h5 class="modal-title">Remover permiso del rol</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Remover el permiso <strong><span id="permissionNameToRemove"></span></strong> de este rol?</p>
                                    <p class="text-warning"><small>El permiso seguirá existiendo en el sistema pero dejará de estar asignado a este rol.</small></p>
                                    <input type="hidden" id="roleIdToRemoveFrom">
                                    <input type="hidden" id="permissionIdToRemove">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary text-lowercase" style="text-transform: none !important" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-warning" style="text-transform: none !important" onclick="confirmRemovePermission()">
                                        <i class="material-icons">remove_circle</i> Remover
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Editar SOLO el Rol -->
                    <div class="modal fade" id="editRolModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Cambiar rol del usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="edit-rol-user-id">
                                    <div class="mb-3">
                                        <label class="form-label">Seleccionar nuevo rol:</label>
                                        <select class="form-select" id="edit-rol-select"></select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary text-lowercase" style="text-transform: none !important" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn bg-gradient-dark" style="text-transform: none !important" onclick="updateUserRol()">Guardar cambios</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para Ver Usuario -->
                    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detalles del Usuario</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nombre(s)</label>
                                            <p id="view-name" class="form-control-static"></p>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Apellidos</label>
                                            <p id="view-lastname" class="form-control-static"></p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Correo</label>
                                        <p id="view-email" class="form-control-static"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Rol</label>
                                        <p id="view-role" class="form-control-static"></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-lowercase" style="text-transform: none !important" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de confirmación de eliminación-->
                    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Confirmar eliminación</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Eliminar al usuario: <strong><span id="userToDeleteName"></span></strong>?</p>
                                    <p class="text-danger small">¡Esta acción no se puede deshacer!</p>
                                    <input type="hidden" id="userToDeleteId">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary text-lowercase" style="text-transform: none !important" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger" style="text-transform: none !important" onclick="deleteUser()">
                                        <i class="material-icons">delete_forever</i> Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de usuarios compacta -->
                    <div class="card">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" style="font-size: 0.8rem;">
                                    <thead>
                                        <tr>
                                            <th class="text-center py-2">Nombre(s)</th>
                                            <th class="text-center py-2">Apellido paterno</th>
                                            <th class="text-center py-2">Apellido materno</th>
                                            <th class="text-center py-2">Correo electrónico</th>
                                            <th class="text-center py-2">Rol</th>
                                            <th class="text-center py-2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($usuarios as $usuario)
                                        <tr>
                                            <td class="text-center py-2 sensitive-data">{{ $usuario->nombre }}</td>
                                            <td class="text-center py-2 sensitive-data">{{ $usuario->apellido_paterno }}</td>
                                            <td class="text-center py-2 sensitive-data">{{ $usuario->apellido_materno ?? '' }}</td>
                                            <td class="text-center py-2 sensitive-data">{{ $usuario->correo_electronico }}</td>
                                            <td class="text-center py-2 sensitive-data">{{ $usuario->rol->nombre }}</td>
                                            <td class="text-center py-2">

                                        <!-- Botón Editar Rol (nueva función) -->
                                        @if(hasPermission(9))
                                        <button class="btn btn-link text-dark px-1 mb-0" onclick="editUserRole('{{ $usuario->id_usuario }}')" title="Cambiar rol">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        @else
                                        <button class="btn btn-link text-dark px-1 mb-0" onclick="return false;" title="Cambiar rol">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        @endif
                                        

                                        @if(hasPermission(11))
                                        <button class="btn btn-link text-dark px-1 mb-0" 
                                                onclick="showDeleteModal('{{ $usuario->id_usuario }}', '{{ $usuario->nombre }} {{ $usuario->apellido_paterno }}')"
                                                title="Eliminar usuario">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        @else
                                        <button class="btn btn-link text-dark px-1 mb-0" 
                                                onclick="return false;"
                                                title="Eliminar usuario">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        @endif
                                        
                                            </td>
                                        </tr>
                                            @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No hay usuarios registrados</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-4">
                                    {{ $usuarios->appends(['search' => request('search')])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <x-footers.auth></x-footers.auth>
    </main>

    <!-- Scripts optimizados -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Control de modales
        function openAddRoleModal() {
            const rolesModal = bootstrap.Modal.getInstance(document.getElementById('rolesModal'));
            const addRoleModal = new bootstrap.Modal(document.getElementById('addRoleModal'));
            rolesModal.hide();
            addRoleModal.show();
        }

        function closeAddRoleModal() {
    const addRoleModal = bootstrap.Modal.getInstance(document.getElementById('addRoleModal'));
    addRoleModal.hide();
    
    // Muestra la modal de roles después de cerrar
    setTimeout(() => {
        const rolesModal = new bootstrap.Modal(document.getElementById('rolesModal'));
        rolesModal.show();
    }, 500);
}

        // Función para abrir modal de edición de roles (versión mínima)
        function openEditRoleModal(id, nombre, descripcion) {
    document.getElementById('editRoleId').value = id;
    document.getElementById('editRoleName').value = nombre;
    document.getElementById('editRoleDescription').value = descripcion || ''; // Manejar si la descripción es null
    const rolesModal = bootstrap.Modal.getInstance(document.getElementById('rolesModal'));
    const editRoleModal = new bootstrap.Modal(document.getElementById('editRoleModal'));
    rolesModal.hide();
    editRoleModal.show();
}

function closeEditRoleModal() {
    const editRoleModal = bootstrap.Modal.getInstance(document.getElementById('editRoleModal'));
    editRoleModal.hide();
    const rolesModal = new bootstrap.Modal(document.getElementById('rolesModal'));
    rolesModal.show();
}

function saveRoleChanges() {
    const id = document.getElementById('editRoleId').value;
    const formData = new FormData(document.getElementById('editRoleForm'));

    fetch(`/usuarios/roles/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-HTTP-Method-Override': 'PUT'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la respuesta');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('success', 'Rol actualizado correctamente');
            closeEditRoleModal();
            loadRoles();
        } else {
            showToast('error', data.message || 'Error al actualizar rol');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error en la conexión');
    });
}

        // Efectos para inputs
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.input-group-outline input, .input-group-outline textarea').forEach(el => {
                el.addEventListener('focus', function() {
                    this.parentElement.classList.add('is-focused');
                });
                el.addEventListener('blur', function() {
                    this.parentElement.classList.remove('is-focused');
                    if(this.value) this.parentElement.classList.add('is-filled');
                    else this.parentElement.classList.remove('is-filled');
                });
            });
        });

        // Funciones para Permisos
function openAddPermissionModal() {
    const permissionsModal = bootstrap.Modal.getInstance(document.getElementById('permissionsModal'));
    const addPermissionModal = new bootstrap.Modal(document.getElementById('addPermissionModal'));
    permissionsModal.hide();
    addPermissionModal.show();
}

function closeAddPermissionModal() {
    const addPermissionModal = bootstrap.Modal.getInstance(document.getElementById('addPermissionModal'));
    const permissionsModal = new bootstrap.Modal(document.getElementById('permissionsModal'));
    addPermissionModal.hide();
    permissionsModal.show();
}

function loadPermissions() {
    const rolId = document.getElementById('selectRol').value;
    const permissionsList = document.getElementById('permissionsList');
    const availableSelect = document.getElementById('availablePermissions');

    if (!rolId) {
        permissionsList.classList.add('d-none');
        availableSelect.disabled = true;
        return;
    }

    // Usando la ruta corregida
    fetch(`/usuarios/permisos/rol/${rolId}`)
        .then(response => response.json())
        .then(data => {
            const assignedList = document.getElementById('assignedPermissions');
            
            // Llenar permisos asignados
            assignedList.innerHTML = data.asignados.map(permiso => `
                <li class="list-group-item py-2 d-flex justify-content-between align-items-center">
        <div>
            <span class="font-weight-bold">${permiso.nombre}</span>
            <p class="text-xs text-muted mb-0">${permiso.descripcion || 'Sin descripción'}</p>
        </div>
        <div>
            <button class="btn btn-link text-dark p-0 me-2" 
                    onclick="openEditPermissionModal(${permiso.id_permiso})"
                    title="Editar permiso">
                <i class="material-icons text-dark">edit</i> <!-- Cambiado a text-dark -->
            </button>
            <button class="btn btn-link text-dark p-0 me-2" 
        onclick="removePermission(${rolId}, ${permiso.id_permiso}, '${permiso.nombre.replace(/'/g, "\\'")}')"
        title="Remover permiso de este rol">
    <i class="material-icons">remove_circle</i>
</button>   
        </div>
    </li>
            `).join('');

            // Llenar select de permisos disponibles
            availableSelect.innerHTML = `
                <option value="">Seleccione un permiso...</option>
                ${data.disponibles.map(permiso => `
                    <option value="${permiso.id_permiso}">
                        ${permiso.nombre}
                    </option>
                `).join('')}
            `;

            // Mostrar la sección
            permissionsList.classList.remove('d-none');
            availableSelect.disabled = false;
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Error al cargar permisos');
        });
}

function assignPermission() {
    const rolId = document.getElementById('selectRol').value;
    const permisoId = document.getElementById('availablePermissions').value;

    if (!permisoId) {
        showToast('error', 'Seleccione un permiso para asignar');
        return;
    }

    // Usando la ruta corregida
    fetch("{{ route('usuarios.permisos.assign') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ 
            id_rol: rolId, 
            id_permiso: permisoId 
        })
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la asignación');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('success', 'Permiso asignado correctamente');
            loadPermissions(); // Recargar la lista
        } else {
            showToast('error', data.message || 'Error al asignar permiso');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error en la conexión');
    });
}

// Función auxiliar para notificaciones (opcional)
function showNotification(type, message) {
    const notif = document.createElement('div');
    notif.className = `alert alert-${type} alert-dismissible fade show`;
    notif.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    document.body.appendChild(notif);
    setTimeout(() => notif.remove(), 3000);
}

function clearSelection() {
    document.getElementById("selectRol").value = "";
    document.getElementById("permissionsList").classList.add("d-none");
}

    // Función para buscar usuarios
function searchUsers() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('.table tbody tr');
    
    rows.forEach(row => {
        const name = row.cells[0].textContent.toLowerCase();
        const lastName1 = row.cells[1].textContent.toLowerCase();
        const lastName2 = row.cells[2].textContent.toLowerCase();
        const role = row.cells[4].textContent.toLowerCase();
        
        const fullName = `${name} ${lastName1} ${lastName2}`;
        
        if (fullName.includes(searchTerm) || role.includes(searchTerm)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    // Actualizar paginación después de buscar
    if (typeof initPagination === 'function') {
        initPagination();
    }
}

// Agregar event listener al input de búsqueda
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', searchUsers);
});

function sortUsers(order) {
    const tbody = document.querySelector('.table tbody');
    const rows = Array.from(tbody.querySelectorAll('tr:not([style*="display: none"])'));
    
    rows.sort((a, b) => {
        const nameA = `${a.cells[0].textContent} ${a.cells[1].textContent}`.toLowerCase();
        const nameB = `${b.cells[0].textContent} ${b.cells[1].textContent}`.toLowerCase();
        return order === 'asc' ? nameA.localeCompare(nameB) : nameB.localeCompare(nameA);
    });
    
    rows.forEach(row => tbody.appendChild(row));
    closeFilterModal();
}

function filterByRole(role) {
    const rows = document.querySelectorAll('.table tbody tr');
    let hasMatches = false;
    
    rows.forEach(row => {
        const rowRole = row.cells[4].textContent;
        const shouldShow = role === 'all' || rowRole === role;
        row.style.display = shouldShow ? '' : 'none';
        if (shouldShow) hasMatches = true;
    });
    
    // Mostrar mensaje si no hay coincidencias
    const noResultsMsg = document.getElementById('noResultsMessage');
    if (noResultsMsg) {
        noResultsMsg.style.display = hasMatches ? 'none' : 'block';
    }
    
    closeFilterModal();
}

document.getElementById('filterModal')?.addEventListener('hidden.bs.modal', function() {
    document.body.classList.remove('modal-open');
    document.body.style.overflow = 'auto';
    document.body.style.paddingRight = '';
});

// Función para editar usuario (compatible con paginación)
function showEditModal(button) {
    const row = button.closest('tr');
    const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
    
    // Obtenemos datos actuales
    const currentData = {
        name: row.cells[0].textContent.trim(),
        lastName1: row.cells[1].textContent.trim(),
        lastName2: row.cells[2].textContent.trim(),
        email: row.cells[3].textContent.trim(),
        role: row.cells[4].textContent.trim()
    };

    // Llenamos el formulario de edición
    document.getElementById('edit-name').value = currentData.name;
    document.getElementById('edit-lastname1').value = currentData.lastName1;
    document.getElementById('edit-lastname2').value = currentData.lastName2;
    document.getElementById('edit-email').value = currentData.email;
    document.getElementById('edit-role').value = currentData.role;
    
    // Guardamos referencia única a la fila
    const rowId = Array.from(row.parentNode.children).indexOf(row);
    document.getElementById('editUserModal').dataset.rowId = rowId;
    
    modal.show();
}

// Función para actualizar usuario
function updateUser() {
    const rowId = document.getElementById('editUserModal').dataset.rowId;
    const allRows = document.querySelectorAll('.table tbody tr');
    const row = allRows[rowId];
    
    if (row) {
        // Actualizamos los datos en la fila
        row.cells[0].textContent = document.getElementById('edit-name').value;
        row.cells[1].textContent = document.getElementById('edit-lastname1').value;
        row.cells[2].textContent = document.getElementById('edit-lastname2').value;
        row.cells[3].textContent = document.getElementById('edit-email').value;
        row.cells[4].textContent = document.getElementById('edit-role').value;
        
        // Cerramos el modal
        bootstrap.Modal.getInstance(document.getElementById('editUserModal')).hide();
        
        // Actualizamos la paginación si es necesario
        if (typeof initPagination === 'function') {
            initPagination();
        }
    }
}

// Función para confirmar eliminación
function confirmDelete(button) {
    const row = button.closest('tr');
    const rowId = Array.from(row.parentNode.children).indexOf(row);
    const modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    
    document.getElementById('deleteConfirmModal').dataset.rowId = rowId;
    modal.show();
}

// Inicializamos los eventos después de cargar la tabla
function initTableEvents() {
    // No necesitamos esto si usamos onclick en los botones
    console.log("Eventos de tabla inicializados");
}

// Ejemplo de función para actualizar
function updateUser(id_usuario) {
    const data = {
        nombre: document.getElementById('edit-nombre').value,
        apellido_paterno: document.getElementById('edit-apellido_paterno').value,
        id_rol: document.getElementById('edit-rol').value
    };

    fetch(`/usuarios/${id_usuario}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(loadUsers); // Recargar lista
}

// Cargar roles desde el backend
// Función para cargar roles desde la BD
function loadRoles() {
    fetch('/usuarios/roles')
        .then(response => response.json())
        .then(data => {
            const roleList = document.getElementById('roleList');
            roleList.innerHTML = '';
            
            data.forEach(role => {
                const listItem = document.createElement('li');
                listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
                
                listItem.innerHTML = `
                    <div>
                        <strong>${role.nombre}</strong>
                        ${role.descripcion ? `<p class="mb-0 text-muted">${role.descripcion}</p>` : ''}
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-link text-dark px-1 mb-0 btn-toggle" 
                                onclick="openEditRoleModal(${role.id_rol}, '${role.nombre}', '${role.descripcion || ''}')">
                            <i class="material-icons text-sm">edit</i>
                        </button>
                        <button class="btn btn-link text-dark px-1 mb-0 btn-toggle" 
                                onclick="confirmDeleteRole(${role.id_rol})">
                            <i class="material-icons text-sm">delete</i>
                        </button>
                    </div>
                `;
                
                roleList.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Error al cargar roles');
        });
}

// Asegúrate de llamar a loadRoles() cuando se abra la modal de roles
const rolesModalElement = document.getElementById('rolesModal');
rolesModalElement.addEventListener('show.bs.modal', loadRoles);

// Llamar al cargar la página
document.addEventListener('DOMContentLoaded', loadRoles);

// Guardar nuevo rol
function saveNewRole() {
    const form = document.getElementById('addRoleForm');
    const formData = new FormData(form);

    fetch("{{ route('usuarios.roles.store') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('success', 'Rol creado exitosamente');
            
            // Cierra la modal de creación
            const addRoleModal = bootstrap.Modal.getInstance(document.getElementById('addRoleModal'));
            addRoleModal.hide();
            
            // Muestra la modal de lista de roles después de 500ms (tiempo de animación)
            setTimeout(() => {
                const rolesModal = new bootstrap.Modal(document.getElementById('rolesModal'));
                rolesModal.show();
                loadRoles(); // Recarga la lista actualizada
            }, 500);
            
            form.reset(); // Limpia el formulario
        } else {
            showToast('error', data.message || 'Error al crear rol');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error en la conexión');
    });
}

function removePermission(rolId, permisoId) {
    if (!confirm('¿Estás seguro de eliminar este permiso?')) return;

    // Construye la URL manualmente para evitar problemas con los parámetros
    const url = `/usuarios/permisos/remover/${rolId}/${permisoId}`;
    
    fetch(url, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Error al eliminar');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('success', 'Permiso eliminado correctamente');
            loadPermissions(); // Recargar lista
        } else {
            showToast('error', data.message || 'Error al eliminar permiso');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error en la conexión');
    });
}

function createPermission() {
    const form = document.getElementById('createPermissionForm');
    const formData = new FormData(form);

    // FORMA 1: Usando route() - Asegúrate que el nombre coincida
    fetch("/usuarios/permisos", {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('success', data.message);
            // Cierra el modal y resetea el formulario
            bootstrap.Modal.getInstance(document.getElementById('createPermissionModal')).hide();
            form.reset();
            // Opcional: Recargar lista de permisos disponibles
            loadAvailablePermissions();
        } else {
            showToast('error', data.message);
        }
    })
    .catch(error => {
        showToast('error', 'Error en la conexión');
        console.error('Error:', error);
    });

    // FORMA ALTERNATIVA: Si persisten problemas, usa URL directa
    // fetch("/usuarios/permisos", { ... })
}

// Función para mostrar notificaciones toast
function showToast(type, message) {
    // Busca un contenedor existente o créalo
    let container = document.getElementById('toastContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toastContainer';
        container.style.position = 'fixed';
        container.style.top = '20px';
        container.style.right = '20px';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
    }
    
    const toast = document.createElement('div');
    toast.className = `alert alert-${type} alert-dismissible fade show`;
    toast.role = 'alert';
    toast.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    container.appendChild(toast);
    
    // Eliminar después de 5 segundos
    setTimeout(() => {
        toast.remove();
    }, 5000);
}

// Asegúrate que este código esté en tu JavaScript
function openPermissionsModal() {
    // Primero limpia selecciones anteriores
    document.getElementById('selectRol').value = '';
    document.getElementById('permissionsList').classList.add('d-none');
    
    // Abre la modal
    const modal = new bootstrap.Modal(document.getElementById('permissionsModal'));
    modal.show();
}

function resetPermissionsModal() {
    // 1. Restablece el selector de roles
    document.getElementById('selectRol').value = '';
    
    // 2. Oculta la sección de permisos
    document.getElementById('permissionsList').classList.add('d-none');
    
    // 3. Limpia las listas
    document.getElementById('assignedPermissions').innerHTML = '';
    
    // 4. Restablece el selector de permisos disponibles
    const availableSelect = document.getElementById('availablePermissions');
    availableSelect.innerHTML = '<option value="">Seleccione permiso...</option>';
    availableSelect.disabled = true;
    
    // 5. Opcional: Mostrar feedback visual
    showToast('info', 'Selección limpiada');
}

// Mostrar formulario de creación
function showCreatePermissionForm() {
    document.getElementById('createPermissionForm').classList.remove('d-none');
    document.getElementById('newPermissionName').focus();
}

// Ocultar formulario de creación
function hideCreatePermissionForm() {
    document.getElementById('createPermissionForm').classList.add('d-none');
    document.getElementById('newPermissionName').value = '';
    document.getElementById('newPermissionDesc').value = '';
}

// Función para abrir modal de edición con datos del permiso
function openEditPermissionModal(permisoId) {
    // Obtener instancias de los modales
    const permissionsModal = bootstrap.Modal.getInstance(document.getElementById('permissionsModal'));
    const editModal = new bootstrap.Modal(document.getElementById('editPermissionModal'));
    
    // 1. Ocultar la modal de permisos sin destruirla
    permissionsModal.hide();
    
    // 2. Esperar a que termine la animación de ocultación (300ms)
    setTimeout(() => {
        // 3. Cargar los datos del permiso
        fetch(`/usuarios/permisos/${permisoId}/editar`)
            .then(response => response.json())
            .then(permiso => {
                document.getElementById('editPermissionId').value = permiso.id_permiso;
                document.getElementById('editPermissionName').value = permiso.nombre;
                document.getElementById('editPermissionDescription').value = permiso.descripcion || '';
                
                // 4. Mostrar la modal de edición
                editModal.show();
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('error', 'Error al cargar el permiso');
                // Si falla, volver a mostrar modal de permisos
                permissionsModal.show();
            });
    }, 300);
}

// Función para cerrar modal de edición
function closeEditPermissionModal() {
    const editModal = bootstrap.Modal.getInstance(document.getElementById('editPermissionModal'));
    const permissionsModal = bootstrap.Modal.getInstance(document.getElementById('permissionsModal'));
    
    // 1. Ocultar la modal de edición
    editModal.hide();
    
    // 2. Esperar a que termine la animación (300ms)
    setTimeout(() => {
        // 3. Mostrar la modal de permisos nuevamente
        permissionsModal.show();
    }, 300);
}

// Función para actualizar permiso
function updatePermission() {
    const permisoId = document.getElementById('editPermissionId').value;
    const formData = new FormData(document.getElementById('editPermissionForm'));
    
    // Usa la ruta nombrada para actualizar
    const url = "{{ route('usuarios.permisos.update', ['permiso' => ':id']) }}".replace(':id', permisoId);
    
    fetch(url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'X-HTTP-Method-Override': 'PUT'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la respuesta');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('success', 'Permiso actualizado correctamente');
            closeEditPermissionModal();
            
            // Recargar permisos si hay un rol seleccionado
            const rolId = document.getElementById('selectRol').value;
            if (rolId) loadPermissions();
        } else {
            showToast('error', data.message || 'Error al actualizar permiso');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error en la conexión con el servidor');
    });
}

// Variable global para almacenar el ID del rol a eliminar
let roleToDeleteId = null;

// Función para abrir el modal de confirmación
function confirmDeleteRole(id) {
    roleToDeleteId = id;
    new bootstrap.Modal(document.getElementById('deleteRoleConfirmModal')).show();
}

// Función para eliminar el rol
function deleteRole() {
    if (!roleToDeleteId) return;

    console.log("Iniciando eliminación del rol ID:", roleToDeleteId); // Debug 1

    fetch(`/usuarios/roles/${roleToDeleteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log("Respuesta recibida, status:", response.status); // Debug 2
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        console.log("Datos de respuesta:", data); // Debug 3
        if (data.success) {
            showToast('success', data.message);
            bootstrap.Modal.getInstance(document.getElementById('deleteRoleConfirmModal')).hide();
            loadRoles();
        } else {
            showToast('error', data.message || 'Error al eliminar rol');
        }
    })
    .catch(error => {
        console.error("Error completo:", error); // Debug 4
        const errorMsg = error.message || 'Error al conectar con el servidor';
        showToast('error', errorMsg);
    })
    .finally(() => {
        roleToDeleteId = null;
    });
}

// Función para cancelar la eliminación
function closeDeleteRoleConfirmModal() {
    roleToDeleteId = null;
    bootstrap.Modal.getInstance(document.getElementById('deleteRoleConfirmModal')).hide();
}

// Variable global para el ID del permiso a eliminar
let permissionToDeleteId = null;

// Abrir modal de confirmación para eliminar permiso
function confirmDeletePermission(id) {
    permissionToDeleteId = id;
    new bootstrap.Modal(document.getElementById('deletePermissionModal')).show();
}

// Eliminar permiso definitivamente
function deletePermission() {
    if (!permissionToDeleteId) return;

    fetch(`/usuarios/permisos/${permissionToDeleteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la respuesta');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('success', data.message);
            // Cerrar modales
            bootstrap.Modal.getInstance(document.getElementById('deletePermissionModal')).hide();
            // Recargar listas si es necesario
            const rolId = document.getElementById('selectRol').value;
            if (rolId) loadPermissions();
        } else {
            showToast('error', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error al conectar con el servidor');
    })
    .finally(() => {
        permissionToDeleteId = null;
    });
}

// Variables globales
let systemPermissionToDelete = { id: null, name: '' };

// Abrir modal para eliminar permiso del sistema
function openDeleteSystemPermissionModal(permisoId, permisoNombre) {
    systemPermissionToDelete = { id: permisoId, name: permisoNombre };
    document.getElementById('permissionNameToDelete').textContent = permisoNombre;
    document.getElementById('systemPermissionToDeleteId').value = permisoId;
    new bootstrap.Modal(document.getElementById('deleteSystemPermissionModal')).show();
}

// Eliminar permiso del sistema
function deleteSystemPermission() {
    const permisoId = systemPermissionToDelete.id;
    
    fetch(`/usuarios/permisos/${permisoId}/system-delete`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('success', `Permiso "${systemPermissionToDelete.name}" eliminado del sistema`);
            // Cerrar modal
            bootstrap.Modal.getInstance(document.getElementById('deleteSystemPermissionModal')).hide();
            // Recargar listas si es necesario
            if (document.getElementById('selectRol').value) loadPermissions();
        } else {
            showToast('error', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error al conectar con el servidor');
    });
}

// Variables para remover permiso
let permissionToRemove = {
    roleId: null,
    permissionId: null,
    permissionName: ''
};

// Función para abrir la modal de remover permiso
function openRemovePermissionModal(rolId, permisoId, permisoNombre) {
    permissionToRemove = {
        roleId: rolId,
        permissionId: permisoId,
        permissionName: permisoNombre
    };
    
    document.getElementById('permissionNameToRemove').textContent = permisoNombre;
    document.getElementById('roleIdToRemoveFrom').value = rolId;
    document.getElementById('permissionIdToRemove').value = permisoId;
    
    new bootstrap.Modal(document.getElementById('removePermissionModal')).show();
}

// Función para confirmar la remoción
function confirmRemovePermission() {
    const { roleId, permissionId } = permissionToRemove;
    
    fetch(`/usuarios/permisos/remover/${roleId}/${permissionId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la respuesta');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('success', 'Permiso removido del rol correctamente');
            bootstrap.Modal.getInstance(document.getElementById('removePermissionModal')).hide();
            loadPermissions();
        } else {
            showToast('error', data.message || 'Error al remover permiso');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error al conectar con el servidor');
    });
}

// Reemplaza la función removePermission original por esta:
function removePermission(rolId, permisoId, permisoNombre) {
    openRemovePermissionModal(rolId, permisoId, permisoNombre);
}

// Función para cargar roles en el filtro
function loadRolesForFilter() {
    fetch('/usuarios/roles')
        .then(response => response.json())
        .then(roles => {
            const roleFilterList = document.getElementById('roleFilterList');
            
            // Limpiar solo los roles (conserva "Todos los usuarios")
            const items = roleFilterList.querySelectorAll('a:not(:first-child)');
            items.forEach(item => item.remove());
            
            // Agregar roles actualizados
            roles.forEach(role => {
                const roleItem = document.createElement('a');
                roleItem.className = 'list-group-item list-group-item-action d-flex justify-content-between align-items-center';
                roleItem.href = '#';
                roleItem.innerHTML = `
                    ${role.nombre}
                `;
                roleItem.onclick = () => filterByRole(role.nombre);
                roleFilterList.appendChild(roleItem);
            });
        })
        .catch(error => console.error('Error:', error));
}

// Llama a esta función cuando se abra la modal
document.getElementById('filterModal').addEventListener('show.bs.modal', loadRolesForFilter);

document.addEventListener('DOMContentLoaded', function() {
    // Configuración para todas las áreas con scroll
    const scrollContainers = [
        document.querySelector('#roleFilterList'), // Modal de filtros
        document.querySelector('#roleList'),       // Modal de roles
        document.querySelector('#assignedPermissions') // Modal de permisos
    ];

    scrollContainers.forEach(container => {
        if (container) {
            // Configuración común para wheel y touch
            const handleScroll = (e) => {
                const isAtTop = container.scrollTop === 0;
                const isAtBottom = container.scrollHeight - container.scrollTop === container.clientHeight;
                const isScrollingUp = e.deltaY ? e.deltaY < 0 : e.touches[0].clientY > 0;

                if ((isAtTop && isScrollingUp) || (isAtBottom && !isScrollingUp)) {
                    e.preventDefault();
                }
            };

            // Evento para scroll con rueda
            container.addEventListener('wheel', handleScroll, { passive: false });
            
            // Evento para dispositivos táctiles
            container.addEventListener('touchmove', handleScroll, { passive: false });
        }
    });
});

// Función para abrir modal de edición de rol
function editUserRole(userId) {
    fetch(`/usuarios/${userId}/edit-rol`)
        .then(response => response.json())
        .then(data => {
            const modal = new bootstrap.Modal(document.getElementById('editRolModal'));
            
            // Llenar datos
            document.getElementById('edit-rol-user-id').value = userId;
            const select = document.getElementById('edit-rol-select');
            select.innerHTML = data.roles.map(rol => 
                `<option value="${rol.id_rol}" ${rol.id_rol == data.usuario.id_rol ? 'selected' : ''}>
                    ${rol.nombre}
                </option>`
            ).join('');
            
            modal.show();
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'No se pudieron cargar los datos');
        });
}

// Función para guardar el nuevo rol
function updateUserRol() {
    const userId = document.getElementById('edit-rol-user-id').value;
    const newRolId = document.getElementById('edit-rol-select').value;

    fetch(`/usuarios/${userId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'X-HTTP-Method-Override': 'PUT'
        },
        body: JSON.stringify({ id_rol: newRolId }) // Solo enviamos el campo a actualizar
    })
    .then(response => {
        if (response.ok) {
            showToast('success', 'Rol actualizado correctamente');
            setTimeout(() => window.location.reload(), 1000); // Recargar para ver cambios
        } else {
            throw new Error('Error en la respuesta');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error al actualizar el rol');
    });
}

// Muestra el modal de confirmación
function showDeleteModal(userId, userName) {
    document.getElementById('userToDeleteId').value = userId;
    document.getElementById('userToDeleteName').textContent = userName;
    new bootstrap.Modal(document.getElementById('deleteUserModal')).show();
}

// Elimina el usuario via AJAX
function deleteUser() {
    const userId = document.getElementById('userToDeleteId').value;
    
    fetch(`/usuarios/${userId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Error en la respuesta');
        return response.json();
    })
    .then(data => {
        if (data.success) {
            showToast('success', 'Usuario eliminado correctamente');
            // Cierra el modal y recarga la página
            bootstrap.Modal.getInstance(document.getElementById('deleteUserModal')).hide();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showToast('error', data.message || 'Error al eliminar usuario');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Error al conectar con el servidor');
    });
}

    </script>
</x-layout>