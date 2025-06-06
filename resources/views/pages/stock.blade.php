<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="stock" />

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Stock" />

        <div class="container-fluid py-0">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-black"><strong>Stock</strong></h2>
                </div>
            </div>
        </div>

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
                                        placeholder="Buscar Stock..."
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
                                            <li><a class="dropdown-item" href="#">Más recientes</a></li>
                                            <li><a class="dropdown-item" href="#">Más antiguos</a></li>
                                            <li><a class="dropdown-item" href="#">Mayor costo</a></li>
                                            <li><a class="dropdown-item" href="#">Menor costo</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Botón registrar stock -->
                                <div class="ms-auto d-flex gap-2">
                                    <div class="d-flex align-items-center gap-3">

                                        @if(hasPermission(1))
                                        <a href="{{ route('registrarStock') }}" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Registrar stock</span>
                                        </a>
                                        @else
                                        <a href="" onclick="return false;" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                                            <i class="fas fa-plus-circle"></i>
                                            <span>Registrar stock</span>
                                        </a>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div> 
        </div> 
        
        <!-- Tabla de stock -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card my-0">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-xs font-weight-bold mb-0 ps-4">Fecha/Hora de Llegada</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Cantidad toneladas</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Método de Pago</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Producto</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Alerta Activada?</th>
                                            <th class="text-xs text-center font-weight-bold mb-0">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($stocks as $stock)
                                            <tr>
                                                <td class="text-xs font-weight-bold mb-0 ps-4">{{ $stock->fecha_llegada }}</td>
                                                <td class="text-xs text-center font-weight-bold mb-0">{{ $stock->cantidad_toneladas }}</td>
                                                <td class="text-xs text-center font-weight-bold mb-0">
                                                @php
                                                $metodos = ['C' => 'Cheque', 'F' => 'Factura', 'T' => 'Transferencia'];
                                                @endphp
                                                {{ $metodos[$stock->metodo_pago] ?? 'Desconocido' }}
                                                </td>
                                                <td class="text-xs text-center font-weight-bold mb-0">{{ $stock->nombre_producto }}</td> 
                                                <td class="text-center">
                                                    <span class="badge badge-sm bg-gradient-secondary">No</span>
                                                </td>
                                                <td class="text-center">


                                                      <!-- Botón Editar -->
                                                    @if(hasPermission(3))
                                                    <a href="{{ route('stock.edit', $stock->id_stock) }}"  class="btn btn-link text-dark px-1 mb-0">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    @else
                                                    <a href="" onclick="return false;" class="btn btn-link text-dark px-1 mb-0">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    @endif
                                                    
                                                    <!-- Botón Eliminar -->
                                                    <form action="{{ route('stock.destroy', $stock->id_stock) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    @if(hasPermission(4))
                                                    <button type="submit" class="btn btn-link text-dark px-1 mb-0"  onclick="return confirm('¿Estás seguro de eliminar este Stock?')">
                                                    <i class="material-icons">delete</i>
                                                    @else
                                                    <button type="" onclick="return false;" class="btn btn-link text-dark px-1 mb-0"  onclick="return confirm('¿Estás seguro de eliminar este Stock?')">
                                                        <i class="material-icons">delete</i>
                                                    @endif

                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                <!-- Paginación de Laravel -->
                                <div class="card-footer d-flex justify-content-center">
                                {{ $stocks->appends(['search' => request('search')])->links() }}
                                </div>

                            </div>
                        </div> 
                    </div>
                </div> 
            </div> 
        </div> 

        <x-footers.auth />
    </main>
</x-layout>