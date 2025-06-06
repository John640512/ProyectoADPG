<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="ubicacion_entrega"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Ubicaciones de Entrega"></x-navbars.navs.auth>
        <!-- End Navbar -->
          <div class="container-fluid py-0">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-black"><strong>Ubicacion Entrega</strong></h2>
                </div>
            </div>
        </div>

        <div class="container-fluid py-4">
            <!-- Barra de búsqueda y acciones -->
         <!-- Sección: Barra de búsqueda y filtros -->
        <div class="container-fluid py-2">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <!-- Buscador -->
                            <form method="GET" action="" class="flex-grow-1" style="max-width: 250px;">
                                <div class="input-group input-group-sm" style="border: 1px solid #ced4da; border-radius: 10px; overflow: hidden; height: 37px;">
                                    <input
                                        type="text"
                                        name="search"
                                        class="form-control border-0 ps-2"
                                        placeholder="Buscar Negocio..."
                                        value="{{ request('search') }}"
                                        style="box-shadow: none !important; padding: 0 10px; height: 100%; line-height: normal;"
                                    >
                                    <button class="btn btn-outline-secondary border-0" type="submit" style="border-left: 1px solid #ced4da; border-radius: 0; height: 100%; display: flex; align-items: center;">
                                        <i class="material-icons" style="font-size: 1.2rem;">search</i>
                                    </button>
                                </div>
                            </form>

                                
                                <!-- Filtros -->
                                <div class="ms-2" style="height: 37px;">
                                    <div class="dropdown">
                                        <button class="btn btn-light bg-white d-flex align-items-center gap-2 justify-content-center dropdown-toggle px-3 py-2" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 8px; height: 100%; width: 100px;">
                                            <i class="material-icons">filter_alt</i>
                                            <span style="font-size: 0.8.5rem;">Filtro</span>
                                        </button>
                                        <ul class="dropdown-menu w-100" aria-labelledby="filterDropdown">
                                            <li><a class="dropdown-item" href="{{ route('ubicacion_entrega', ['sort' => 'newest']) }}">Más recientes</a></li>
                                            <li><a class="dropdown-item" href="{{ route('ubicacion_entrega', ['sort' => 'oldest']) }}">Más antiguos</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Botón Agregar -->
                                <div class="ms-auto d-flex gap-2">
                                    <div style="height: 37px;">

                                        @if(hasPermission(1))
                                        <a href="{{ route('agregar-ubicacionentrega') }}" class="btn btn-dark bg-black d-flex align-items-center justify-content-center gap-2" style="border-radius: 8px; font-size: 12px; height: 100%; width: 115px; padding: 0 8px;">
                                            <i class="material-icons" style="font-size: 18px;">add</i>
                                            <span style="font-size: 0.8.5rem;">Agregar</span>
                                        </a>
                                        @else
                                        <a href="" onclick="return false;" class="btn btn-dark bg-black d-flex align-items-center justify-content-center gap-2" style="border-radius: 8px; font-size: 12px; height: 100%; width: 115px; padding: 0 8px;">
                                            <i class="material-icons" style="font-size: 18px;">add</i>
                                            <span style="font-size: 0.8.5rem;">Agregar</span>
                                        </a>
                                        @endif
                                        


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de ubicaciones -->
            <div class="row">
                <div class="col-12">
                    <div class="card border">
                        <div class="table-responsive p-4">
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Negocio</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Código Postal</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">N° Externo</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ubicaciones as $ubicacion)
                                    <tr>
                                        <td class="text-center text-xs">{{ $ubicacion->nombre_negocio }}</td>
                                        <td class="text-center text-xs">{{ $ubicacion->estado }}</td>
                                        <td class="text-center text-xs">{{ $ubicacion->cp }}</td>
                                        <td class="text-center text-xs">{{ $ubicacion->numero_externo }}</td>
                                        <td class="text-center text-xs">
                                            <a href="{{ route('verubicacionentrega', $ubicacion->id_ubicacion_entrega) }}" class="text-dark me-2" title="Ver">
                                                <i class="material-icons">visibility</i>
                                            </a>

                                            @if(hasPermission(3))
                                            <a href="{{ route('editarubicacionentrega', $ubicacion->id_ubicacion_entrega) }}" class="text-dark me-2" title="Editar">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            @else
                                            <a href="" onclick="return false;" class="text-dark me-2" title="Editar">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            @endif

                                            <form action="{{ route('eliminarubicacionentrega', $ubicacion->id_ubicacion_entrega) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')

                                                @if(hasPermission(4))
                                                <button type="submit" class="text-dark btn btn-link p-0" title="Eliminar" onclick="return confirm('¿Eliminar esta ubicación?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                @else
                                                <button type="" onclick="return false;" class="text-dark btn btn-link p-0" title="Eliminar" onclick="return confirm('¿Eliminar esta ubicación?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                                @endif

                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            No se encontraron ubicaciones registradas
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Paginación -->
                           <div class="card-footer d-flex justify-content-center">
                    {{ $ubicaciones->appends(['search' => request('search')])->links() }}
                    </div>
                        </div>
                    </div>
                </div>
                
            </div>
    </main>

    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script>
        // Confirmación antes de eliminar
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[action*="eliminarubicacionentrega"]');
            
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('¿Estás seguro de eliminar esta ubicación?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    @endpush
</x-layout>