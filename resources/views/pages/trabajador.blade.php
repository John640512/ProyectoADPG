<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="trabajadores"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Lista de Trabajadores"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <!-- Encabezado con estilo moderno -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="mb-0"><strong>Trabajador</strong></h2>
                        
                        @if(hasPermission(1))
                        <a href="{{ route('trabajadores.create') }}" class="btn btn-sm bg-gradient-dark mb-0" style="text-transform: none !important;">
                            <i class="material-icons me-1">add</i> Nuevo trabajador
                        </a>
                        @else
                        <a href="" onclick="return false;" class="btn btn-sm bg-gradient-dark mb-0" style="text-transform: none !important;">
                            <i class="material-icons me-1">add</i> Nuevo trabajador
                        </a>
                        @endif

                    </div>

                    <!-- Tarjeta de tabla con diseño moderno -->
                    <div class="card">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center text-uppercase text-secondary text-xxs opacity-7">Nombre</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs opacity-7">Teléfono</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs opacity-7">RFC</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs opacity-7">Estado</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs opacity-7">Municipio</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs opacity-7">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($trabajadores as $trabajador)
                                        <tr>
                                            <td class="text-center text-xs">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-center text-xs text-secondary mb-0">{{ $trabajador->nombre }} {{ $trabajador->apellido_paterno }} {{ $trabajador->apellido_materno }}</h6>
                                                        <p class="text-center text-xs text-secondary mb-0">{{ $trabajador->correo_electronico }}</p>
                                                    </div>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-center text-xs font-weight-bold mb-0">{{ $trabajador->telefono }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-center text-xs font-weight-bold mb-0">{{ $trabajador->rfc }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-center text-xs font-weight-bold mb-0">{{ $trabajador->estado }}</p>
                                            </td>
                                            <td class="align-middle">
                                                <p class="text-center text-xs font-weight-bold mb-0">{{ $trabajador->municipio }}</p>
                                            </td>
                                            <td class="text-center text-xs font-weight-bold mb-0">
                                                <a href="{{ route('trabajadores.show', $trabajador) }}" 
                                                    class="btn btn-link text-dark px-1 mb-0" 
                                                    data-toggle="tooltip" 
                                                    title="Ver detalles">
                                                    <i class="material-icons">visibility</i>
                                                </a>

                                                @if(hasPermission(3))
                                                <a href="{{ route('trabajadores.edit', $trabajador) }}" 
                                                   class="btn btn-link text-dark px-1 mb-0" 
                                                   data-toggle="tooltip" 
                                                   title="Editar">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                @else
                                                <a href=""
                                                   onclick="return false;" 
                                                   class="btn btn-link text-dark px-1 mb-0" 
                                                   data-toggle="tooltip" 
                                                   title="Editar">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                @endif
                                                
                                                <form action="{{ route('trabajadores.destroy', $trabajador) }}" method="POST" style="display: inline;" 
                                                      onsubmit="return confirm('¿Estás seguro de eliminar este trabajador?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    
                                                    @if(hasPermission(4))
                                                    <button type="submit" 
                                                            class="btn btn-link text-dark px-1 mb-0" 
                                                            data-toggle="tooltip" 
                                                            title="Eliminar">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                    @else
                                                    <button type=""
                                                            onclick="return false;" 
                                                            class="btn btn-link text-dark px-1 mb-0" 
                                                            data-toggle="tooltip" 
                                                            title="Eliminar">
                                                        <i class="material-icons">delete</i>
                                                    </button>
                                                    @endif

                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4">
                                                No hay trabajadores registrados
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>