<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="view-product"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Detalles del Producto'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-0">Información del Producto</h4>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                    <i class="material-icons">arrow_back</i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="card-body p-3">
                                        <h5 class="mb-1">Datos Básicos</h5>
                                        <p class="mb-0 text-sm"><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                                        <p class="mb-0 text-sm"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                                        <p class="mb-0 text-sm"><strong>Fecha Registro:</strong> {{ $producto->fecha_registro->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="card-body p-3">
                                        <h5 class="mb-1">Información Adicional</h5>
                                        <p class="mb-0 text-sm"><strong>Tipo:</strong> {{ $producto->tipo_producto->nombre }}</p>
                                        <p class="mb-0 text-sm"><strong>Ubicación:</strong> {{ $producto->ubicacion->nombre }}</p>
                                        @if($producto->proveedor)
                                        <p class="mb-0 text-sm"><strong>Proveedor:</strong> {{ $producto->proveedor->nombre }}</p>
                                        @endif
                                        <p class="mb-0 text-sm"><strong>Costo por Tonelada:</strong> ${{ number_format($producto->costo_tonelada ?? 0, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-layout>