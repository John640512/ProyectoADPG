<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="proveedor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Proveedor"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <!-- Barra de búsqueda y filtros -->
               <h2 class="text-black"><strong>Proveedor</strong></h2>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body p-3">     
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <!-- Buscador con lupa -->
                                <form method="GET" action="" class="flex-grow-1" style="max-width: 250px;">
                                <div class="input-group input-group-sm" style="border: 1px solid #ced4da; border-radius: 10px; overflow: hidden; height: 37px;">
                                    <input
                                        type="text"
                                        name="search"
                                        class="form-control border-0 ps-2"
                                        placeholder="Buscar Proveedor..."
                                        value="{{ request('search') }}"
                                        style="box-shadow: none !important; padding: 0 10px; height: 100%; line-height: normal;" 
                                        >
                                    <button class="btn btn-outline-secondary border-0" type="submit" style="border-left: 1px solid #ced4da; border-radius: 0; height: 100%; display: flex; align-items: center;">
                                        <i class="material-icons" style="font-size: 1.2rem;">search</i>
                                    </button>
                                </div>
                            </form>
                                
                                
                                <!-- Botón Filtro -->
                                <div class="ms-2" style="height: 37px;">
                                    <div class="dropdown">
                                        <button class="btn btn-light bg-white d-flex align-items-center gap-2 justify-content-center dropdown-toggle px-3 py-2" 
                                            type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false" 
                                            style="border-radius: 8px; height: 100%; width: 100px;">
                                            <i class="material-icons">filter_alt</i>
                                            <span style="font-size: 0.8rem;">Filtro</span>
                                        </button>
                                        <ul class="dropdown-menu w-100" aria-labelledby="filterDropdown">
                                            <li><a class="dropdown-item" href="#">Más recientes</a></li>
                                            <li><a class="dropdown-item" href="#">Más antiguos</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Botón Agregar -->
                                <div class="ms-auto d-flex gap-2">
                                    <div style="height: 37px;">
                                        
                                        @if(hasPermission(1))
                                        <a href="{{ route('proveedor.agregar') }}" class="btn btn-dark bg-black d-flex align-items-center justify-content-center gap-2" 
                                            style="border-radius: 8px; font-size: 12px; height: 100%; width: 115px; padding: 0 8px;">
                                            <i class="material-icons" style="font-size: 18px;">add</i>
                                            <span style="font-size: 0.8rem;">Agregar</span>
                                        </a>
                                        @else
                                        <a href="" onclick="return false;" class="btn btn-dark bg-black d-flex align-items-center justify-content-center gap-2" 
                                            style="border-radius: 8px; font-size: 12px; height: 100%; width: 115px; padding: 0 8px;">
                                            <i class="material-icons" style="font-size: 18px;">add</i>
                                            <span style="font-size: 0.8rem;">Agregar</span>
                                        </a>
                                        @endif

                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Proveedores -->
            <div class="row">
                <div class="col-12">
                    <div class="card border">
                        <div class="table-responsive p-4">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Proveedor</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Teléfono</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">RFC</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Estado</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ciudad</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Municipio</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="proveedores-table-body">
                                    @foreach($proveedores as $proveedor)
                                    <tr class="proveedor-row">
                                     <td class="text-center text-xs">{{ $proveedor->nombre }}</td>
                                        <td class="text-center text-xs">{{ $proveedor->telefono }}</td>
                                        <td class="text-center text-xs">{{ $proveedor->rfc }}</td>
                                        <td class="text-center text-xs">{{ $proveedor->ubicacion_proveedor->estado }}</td>
                                        <td class="text-center text-xs">{{ $proveedor->ubicacion_proveedor->ciudad }}</td>
                                        <td class="text-center text-xs">{{ $proveedor->ubicacion_proveedor->municipio }}</td>
                                        <td class="text-center text-xs">

                                         <!-- Botón Ver -->
                            <a href="{{ route('proveedor.show', $proveedor->id_proveedor) }}" class="btn btn-link text-dark px-1 mb-0">
                                <i class="material-icons">visibility</i>
                            </a>

                            <!-- Botón Editar -->
                            @if(hasPermission(3))
                            <a href="{{ route('proveedor.edit', $proveedor) }}" class="btn btn-link text-dark px-1 mb-0">
                                <i class="material-icons">edit</i>
                            </a>
                            @else
                            <a href="" onclick="return false;" class="btn btn-link text-dark px-1 mb-0">
                                <i class="material-icons">edit</i>
                            </a>
                            @endif

                                <!-- Botón Eliminar -->
                                    <form action="{{ route('proveedor.destroy', $proveedor->id_proveedor) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        
                                        @if(hasPermission(4))
                                        <button type="submit" class="btn btn-link text-dark px-1 mb-0" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        @else
                                        <button type="" onclick="return false;" class="btn btn-link text-dark px-1 mb-0" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                            <i class="material-icons">delete</i>
                                        </button>
                                        @endif
                                        
                                    </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                            <!-- Paginación personalizada -->
                            <div class="card-footer d-flex justify-content-center">
                    {{ $proveedores->appends(['search' => request('search')])->links() }}
                    </div>

                     @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <x-footers.auth></x-footers.auth>
        </div>
    </main>
</x-layout>