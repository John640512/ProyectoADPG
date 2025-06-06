<x-layout bodyClass="g-sidenav-show  bg-gray-200">
        <x-navbars.sidebar activePage="costo"></x-navbars.sidebar>
        <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
            <!-- Navbar -->
            <x-navbars.navs.auth titlePage="Historial del Costo"></x-navbars.navs.auth>
            <!-- End Navbar -->
            <div class="container-fluid py-0">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-black"><strong>Historial del Costo</strong></h2>
                </div>
            </div>
        </div>
    <!-- Barra de búsqueda y filtros -->
    <div class="container-fluid py-2">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <!-- Buscador con lupa -->
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
                        <!-- Botón Filtro (con dropdown) -->
                        <div class="ms-2" style="height: 37px;">
                            <div class="dropdown">
                                <button class="btn btn-light bg-white d-flex align-items-center gap-2 justify-content-center dropdown-toggle px-3 py-2" 
                                        type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false" 
                                        style="border-radius: 8px; height: 100%; width: 100px;">
                                    <i class="material-icons">filter_alt</i>
                                    <span style="font-size: 0.85rem;">Filtro</span>
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="filterDropdown">
                                    <li><a class="dropdown-item" href="#">Más recientes</a></li>
                                    <li><a class="dropdown-item" href="#">Más antiguos</a></li>
                                    <li><a class="dropdown-item" href="#">Mayor costo</a></li>
                                    <li><a class="dropdown-item" href="#">Menor costo</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Botones de acción -->
                        <div class="ms-auto d-flex">
                        
                        
                        @if(hasPermission(7))
                        <a href="{{ route('costo.generarPDF', ['search' => request('search')]) }}" class="btn btn-outline-secondary btn-sm mb-0 me-2" target="_blank">
                            <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">description</i> Generar PDF
                        </a>
                        @else
                        <a href="" disabled onclick="return false;" class="btn btn-outline-secondary btn-sm mb-0 me-2">
                            <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">description</i> Generar PDF
                        </a>
                        @endif
                        
                        @if(hasPermission(5))
                        <a href="{{ route('cambio') }}" class="btn btn-outline-secondary btn-sm mb-0">
                            <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">attach_money</i> Cambiar el Costo
                        </a>
                        @else
                        <a href="" disabled onclick="return false;" class="btn btn-outline-secondary btn-sm mb-0">
                            <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">attach_money</i> Cambiar el Costo
                        </a>
                        @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                               
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                        <tr>
                                            <th class="text-xs font-weight-bold mb-0 ps-4">Fecha/Hora de Registro</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Costo Anterior</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Costo Actual</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Razon de Cambio</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Producto</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($historialCostos as $historial)
                                        <tr>
                                        <td class="text-xs font-weight-bold mb-0 ps-4">{{ $historial->fecha_registro }}</td>
                                        <td class="text-xs text-center font-weight-bold mb-0">${{ number_format($historial->costo_anterior, 2) }}</td>
                                        <td class="text-xs text-center font-weight-bold mb-0">${{ number_format($historial->costo_actual, 2) }}</td>
                                        <td class="text-xs text-center font-weight-bold mb-0">{{ $historial->razon_cambio }}</td>
                                        <td class="text-xs text-center font-weight-bold mb-0">{{ $historial->nombre_producto ?? 'Producto eliminado' }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        </table>
                                        <div class="d-flex justify-content-center mt-4">
                                         {{ $historialCostos->appends(['search' => request('search')])->links() }}
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.auth></x-footers.auth>
            </div>
        </main>
</x-layout>