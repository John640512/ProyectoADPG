<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="proveedor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Ubicación del Proveedor"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
    <form action="{{ route('proveedor.storeUbicacion') }}" method="POST">
        @csrf
        <div class="card shadow-lg border border-dark">
            <div class="card-header bg-light border-bottom border-dark">
                <h5 class="mb-0 text-dark"><strong>Ubicación del Proveedor</strong></h5>
            </div>
            <div class="card-body bg-white">
                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="form-label text-dark"><strong>Estado <span class="text-danger">*</span></strong></label>
                        <select class="form-control border border-secondary" name="estado" id="estado-select" required>
                            <option value="">Seleccione un estado</option>
                            @foreach ($estados as $estado)
                                <option value="{{ $estado->nombre }}">{{ $estado->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label text-dark"><strong>Ciudad <span class="text-danger">*</span></strong></label>
                        <input type="text" class="form-control border border-secondary" name="ciudad" maxlength="15" pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+" title="Solo se permiten letras y espacios" value="{{ old('ciudad') }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-dark"><strong>Municipio <span class="text-danger">*</span></strong></label>
                    <select class="form-control border border-secondary" name="municipio" id="municipio-select" required>
                        <option value="">Seleccione un municipio</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->municipio }}">{{ $municipio->municipio }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label text-dark"><strong>Calle <span class="text-danger">*</span></strong></label>
                    <input type="text" class="form-control border border-secondary" name="calle" maxlength="30" value="{{ old('calle') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label text-dark"><strong>Colonia <span class="text-danger">*</span></strong></label>
                    <input type="text" class="form-control border border-secondary" name="colonia" maxlength="30" value="{{ old('colonia') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-dark"><strong>Código Postal <span class="text-danger">*</span></strong></label>
                        <input type="text" class="form-control border border-secondary" name="cp" maxlength="7" pattern="^\d{1,7}$" title="Ingresa solo números, máximo 7 dígitos" value="{{ old('cp') }}" required>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label class="form-label text-dark"><strong>Número Externo <span class="text-danger">*</span></strong></label>
                        <input type="text" class="form-control border border-secondary" name="numero_externo" maxlength="10" pattern="^[A-Za-z0-9/-]{1,10}$" title="Letras y números, máximo 10 caracteres" value="{{ old('numero_externo') }}" required>
                    </div>
                    <div class="col-md-3 mb-4">
                        <label class="form-label text-dark"><strong>Número Interno</strong></label>
                        <input type="text" class="form-control border border-secondary" name="numero_interno" maxlength="10" pattern="^[A-Za-z0-9/-]{1,10}$" title="Letras y números, máximo 10 caracteres" value="{{ old('numero_interno') }}">
                    </div>
                </div>
            </div>
            <div class="card-footer bg-light border-top border-dark">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('proveedor.agregar') }}" class="btn btn-secondary">
                        <i class="material-icons">arrow_back</i> Anterior
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="material-icons">save</i> Guardar Proveedor
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

    </main>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const estadoSelect = document.getElementById('estado-select');
    const municipioSelect = document.getElementById('municipio-select');

    estadoSelect.addEventListener('change', function () {
        const estadoId = this.value;
        municipioSelect.innerHTML = '<option value="">Cargando...</option>';

        fetch(`/api/municipios/${estadoId}`)
            .then(response => response.json())
            .then(data => {
                municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                data.forEach(municipio => {
                    const option = document.createElement('option');
                    option.value = municipio.id;
                    option.textContent = municipio.nombre;
                    municipioSelect.appendChild(option);
                });
            });
    });
});
</script>
@endpush


</x-layout>