<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="view-transporte"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Detalles del Transporte'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="card card-body mx-3 mx-md-4 mt-4">
                <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-md-8 d-flex align-items-center">
                                <h4 class="mb-0">Información del Transporte</h4>
                            </div>
                            <div class="col-md-4 text-end">
                                <a href="{{ route('transportes.index') }}" class="btn btn-outline-secondary">
                                    <i class="material-icons">arrow_back</i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <!-- Icono de transporte centrado -->
                        <div class="text-center mb-4">
                            <div class="d-inline-block p-3 bg-light rounded-circle shadow-sm">
                                <i class="material-icons" style="font-size: 40px; color: #4CAF50;">local_shipping</i>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="card-body p-3">
                                        <h5 class="mb-1">Datos del Transporte</h5>
                                        <p class="mb-0 text-sm"><strong>Fecha de Salida:</strong> {{ $transporte->fecha_salida->format('d/m/Y H:i') }}</p>
                                        <p class="mb-0 text-sm"><strong>Tipo de Transporte:</strong> {{ $transporte->tipoTransporte->nombre }}</p>
                                        <p class="mb-0 text-sm"><strong>Modelo:</strong> {{ $transporte->modelo }}</p>
                                        <p class="mb-0 text-sm"><strong>Color:</strong> {{ $transporte->color }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="card-body p-3">
                                        <h5 class="mb-1">Información de la Carga</h5>
                                        <p class="mb-0 text-sm"><strong>Toneladas:</strong> {{ number_format($transporte->cantidad_toneladas, 2) }}</p>
                                        <p class="mb-0 text-sm"><strong>Trabajador Encargado:</strong> {{ optional($transporte->trabajador)->nombre ?? 'Sin asignar' }}</p>
                                        <p class="mb-0 text-sm"><strong>Ubicación de Entrega:</strong> {{ $transporte->ubicacionesEntrega->isNotEmpty() ? $transporte->ubicacionesEntrega->pluck('nombre_negocio')->join(', ') : 'Sin asignar' }}</p>
                                        <p class="mb-0 text-sm"><strong>Producto:</strong> {{ $transporte->productos->first()->nombre }}</p>
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