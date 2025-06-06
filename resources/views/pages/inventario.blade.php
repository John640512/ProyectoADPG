<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="inventario"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbars.navs.auth titlePage="Inventario"></x-navbars.navs.auth>

        <div class="container-fluid py-0">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-black"><strong>Inventario</strong></h2>
                </div>
            </div>
        </div>

        <form id="form-inventario" action="{{ route('inventario.store') }}" method="POST" class="d-flex justify-content-between align-items-center px-4 gap-3">
    @csrf

    <div class="d-flex flex-column">
        <span class="text-secondary small mb-1">Fecha de corte</span>
        <input type="date"
               name="fecha_corte_semanalmente"  
               required
               class="form-control form-control-sm"
               style="width: 280px; border: 2px solid rgb(135, 142, 149); background-color: #f8f9fa;"
               value="{{ old('fecha_corte_semanalmente') }}">
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="d-flex align-items-center gap-3">

            @if(hasPermission(6))
            <div class="d-flex align-items-center">
                <label class="me-2 mb-0">En Proceso</label>
                <input type="radio" name="estado" value="P" required
                    {{ old('estado', 'P') == 'P' ? 'checked' : '' }}>
            </div>
            @else
            <div class="d-flex align-items-center">
                <label class="me-2 mb-0">En Proceso</label>
            </div>
            @endif
            
            @if(hasPermission(6))
            <div class="d-flex align-items-center">
                <label class="me-2 mb-0">Terminado</label>
                <input type="radio" name="estado" value="T" required
                    {{ old('estado') == 'T' ? 'checked' : '' }}>
            </div>
            @else
            <div class="d-flex align-items-center">
                <label class="me-2 mb-0">Terminado</label>
            </div>
            @endif
            


        </div>

        <div class="d-flex gap-2">

            @if(hasPermission(7))
            <button type="button" id="btn-generar-pdf" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                <i class="material-icons" style="font-size: 1rem;">picture_as_pdf</i>
                <span>Guardar y Generar PDF</span>
            </button>
            @else
            <button disabled onclick="return false;" class="btn btn-primary btn-sm d-flex align-items-center gap-1">
                <i class="material-icons" style="font-size: 1rem;">picture_as_pdf</i>
                <span>Guardar y Generar PDF</span>
            </button>
            @endif
        </div>
    </div>
</form>
<script>
    // ✅ Esto se encarga de controlar si el botón se desactiva o no, según el estado
    document.addEventListener('DOMContentLoaded', function () {
        const radioProceso = document.querySelector('input[name="estado"][value="P"]');
        const radioTerminado = document.querySelector('input[name="estado"][value="T"]');
        const botonPDF = document.getElementById('btn-generar-pdf');

        function actualizarEstadoBoton() {
            if (radioProceso.checked) {
                botonPDF.disabled = true;
                botonPDF.classList.add('disabled');
            } else {
                botonPDF.disabled = false;
                botonPDF.classList.remove('disabled');
            }
        }

        // Ejecutar al cargar
        actualizarEstadoBoton();

        // Escuchar cambios
        radioProceso.addEventListener('change', actualizarEstadoBoton);
        radioTerminado.addEventListener('change', actualizarEstadoBoton);
    });

    // ✅ Esto controla el envío del formulario como PDF
    document.getElementById('btn-generar-pdf').addEventListener('click', function () {
        const form = document.getElementById('form-inventario');
        const formData = new FormData(form);
        const pdfForm = document.createElement('form');
        pdfForm.method = 'POST';
        pdfForm.action = form.action;
        pdfForm.target = '_blank';
        pdfForm.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}">`;

        for (let [key, value] of formData.entries()) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            pdfForm.appendChild(input);
        }

        document.body.appendChild(pdfForm);
        pdfForm.submit();
        document.body.removeChild(pdfForm);

        // Espera antes de recargar
        setTimeout(() => {
            location.reload();
        }, 3000);
    });
</script>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producto</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cantidad de Toneladas</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nivel Actual Stock</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cantidad Mínima de Toneladas</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Costo por Tonelada</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($inventarios as $inventario)
                                            <tr>
                                                <td>
                                                    <h6 class="text-sm font-weight-bold mb-0 ps-4">{{ $inventario->producto->nombre ?? 'N/D' }}</h6>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0 ps-4">
                                                        {{ number_format($inventario->stock->cantidad_toneladas ?? 0, 2) }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @php
                                                        $nivelActual = $inventario->nivel_actual_stock ?? 0;
                                                        $badgeClass = $nivelActual > 70 ? 'bg-gradient-success' :
                                                                      ($nivelActual <= 30 ? 'bg-gradient-danger' : 'bg-gradient-warning');
                                                        $badgeText = $nivelActual > 70 ? 'Alto' :
                                                                     ($nivelActual <= 30 ? 'Bajo' : 'Medio');
                                                    @endphp
                                                    <span class="badge badge-sm {{ $badgeClass }}">{{ $badgeText }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ number_format($inventario->nivel_minimo_stock ?? 0, 2) }}
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                         @if ($inventario->producto->tipo_producto->costoPorTonelada)
                                                            ${{ number_format($inventario->producto->tipo_producto->costoPorTonelada->costo_tonelada, 2) }}
                                                        @else
                                                            No asignado
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-secondary">No hay productos en inventario.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>


                                <div class="d-flex justify-content-end px-4 mt-3">
                                    {{ $inventarios->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </main>
</x-layout>