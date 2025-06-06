<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="entregados" />

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Productos Entregados" />

        {{-- Título --}}
        <div class="container-fluid py-0">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-black"><strong>Productos Entregados</strong></h2>
                </div>
            </div>
        </div>

<form action="{{ route('entregados.generarPDF') }}" method="POST" class="d-flex justify-content-between align-items-center px-4 gap-3">
    @csrf

    <div class="d-flex flex-column">
        <span class="text-secondary small mb-1">Fecha de entrega</span>
        <input type="date"
               name="fecha_entrega"
               required
               class="form-control form-control-sm"
               style="width: 280px; border: 2px solid rgb(135, 142, 149); background-color: #f8f9fa;">
    </div>

    @if(hasPermission(7))
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
            <i class="material-icons">picture_as_pdf</i> Generar PDF
        </button>
    </div>
    @else
    <div class="d-flex gap-2">
        <button type="" onclick="return false;" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
            <i class="material-icons">picture_as_pdf</i> Generar PDF
        </button>
    </div>
    @endif
    
</form>

        {{-- Tabla de productos entregados --}}
        <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Negocio</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cantidad (Ton)</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trabajador</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transporte</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fecha de entrega</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($entregados as $entrega)
                                        @php
                                            $transporte = $entrega->transporte;
                                            $productos = $transporte->productos;
                                            $ubicaciones = $transporte->ubicacionesEntrega;
                                            $trabajador = $transporte->trabajador;
                                            $tipoTransporte = $transporte->tipoTransporte;
                                        @endphp

                                        @foreach ($productos as $producto)
                                            <tr>
                                                <td>
                                                    <h6 class="text-center mb-0 text-sm">{{ $producto->nombre }}</h6>
                                                </td>
                                                <td>
                                                    <p class="text-center text-xs font-weight-bold mb-0">
                                                        {{ $ubicaciones->pluck('nombre_negocio')->join(', ') ?: '—' }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $transporte->cantidad_toneladas }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $trabajador->nombre ?? '—' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ $tipoTransporte->nombre ?? '—' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ \Carbon\Carbon::parse($entrega->fecha_entrega)->format('d/m/Y') }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                No hay productos entregados para esta fecha.
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

        <x-footers.auth />
    </main>
</x-layout>
