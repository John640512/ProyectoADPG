<x-layout bodyClass="g-sidenav-show bg-gray-200"> 
    <x-navbars.sidebar activePage="proveedor"></x-navbars.sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Editar Ubicación del Proveedor"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card shadow-lg">

                        <!-- Encabezado: Título a la izquierda, botones a la derecha -->
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><strong>Editar Ubicación: {{ $proveedor->nombre }}</strong></h5>
                            
                            <!-- Botones en la parte superior derecha -->
                            <div class="d-flex gap-2">
                                <a href="{{ route('proveedor.edit', $proveedor) }}" class="btn btn-secondary">
                                    <i class="material-icons">arrow_back</i> Anterior
                                </a>
                                <button type="submit" form="ubicacionForm" class="btn btn-primary">
                                    <i class="material-icons">save</i> Guardar y Volver
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(!$proveedor->ubicacion_proveedor)
                                <div class="alert alert-info">
                                    <p>No se encontró información de ubicación. Por favor complete los datos:</p>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('proveedor.ubicacion.update', $proveedor) }}" id="ubicacionForm">
                                @csrf
                                @method('PUT')

                                 <div class="row">
    <!-- Primera fila: Estado y Ciudad -->
<div class="col-md-6 mb-3">
    <label class="form-label text-dark"><strong>Estado <span class="text-danger">*</span></strong></label>
    <select class="form-control border border-secondary @error('estado') is-invalid @enderror" name="estado" id="estado-select" required>
        <option value="">Seleccione un estado</option>
        @foreach ($estados as $estado)
            <option value="{{ $estado->nombre }}" 
                {{ old('estado', optional($proveedor->ubicacion_proveedor)->estado) == $estado->nombre ? 'selected' : '' }}>
                {{ $estado->nombre }}
            </option>
        @endforeach
    </select>
    @error('estado')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

    <div class="col-md-6 mb-3">
        <label class="form-label"><strong>Ciudad <span class="text-danger">*</span></strong></label>
        <input type="text" class="form-control border border-secondary @error('ciudad') is-invalid @enderror" name="ciudad" maxlength="15" pattern="[A-Za-záéíóúÁÉÍÓÚñÑüÜ\s]+" title="Solo se permiten letras y espacios"
               value="{{ old('ciudad', optional($proveedor->ubicacion_proveedor)->ciudad) }}" required>
        @error('ciudad')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <!-- Segunda fila: Municipio y Código Postal -->
    <div class="col-md-6 mb-3">
        <label class="form-label"><strong>Municipio <span class="text-danger">*</span></strong></label>
        <select class="form-control border border-secondary @error('municipio') is-invalid @enderror" name="municipio" id="municipio-select" required>
            <option value="">Seleccione un municipio</option>
            @isset($municipios)
                @foreach($municipios as $municipio)
                    <option value="{{ $municipio->municipio }}"
                        {{ old('municipio', optional($proveedor->ubicacion_proveedor)->municipio) == $municipio->municipio ? 'selected' : '' }}>
                        {{ $municipio->municipio }}
                    </option>
                @endforeach
            @else
                <option value="" disabled>No hay municipios disponibles</option>
            @endisset
        </select>
        @error('municipio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label"><strong>Código Postal <span class="text-danger">*</span></strong></label>
        <input type="text" class="form-control border border-secondary @error('cp') is-invalid @enderror" name="cp" maxlength="7" pattern="^\d{1,7}$" title="Ingresa solo números, máximo 7 dígitos"
               value="{{ old('cp', optional($proveedor->ubicacion_proveedor)->cp) }}" required>
        @error('cp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Tercera fila: Calle (ancho completo) -->
<div class="mb-3">
    <label class="form-label"><strong>Calle <span class="text-danger">*</span></strong></label>
    <input type="text" class="form-control border border-secondary @error('calle') is-invalid @enderror" name="calle" maxlength="30"
           value="{{ old('calle', optional($proveedor->ubicacion_proveedor)->calle) }}" required>
    @error('calle')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Cuarta fila: Colonia -->
<div class="mb-3">
    <label class="form-label"><strong>Colonia <span class="text-danger">*</span></strong></label>
    <input type="text" class="form-control border border-secondary @error('colonia') is-invalid @enderror" name="colonia" maxlength="30"
           value="{{ old('colonia', optional($proveedor->ubicacion_proveedor)->colonia) }}" required>
    @error('colonia')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Quinta fila: Números -->
<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label"><strong>Número Externo <span class="text-danger">*</span></strong></label>
        <input type="text" class="form-control border border-secondary @error('numero_externo') is-invalid @enderror" name="numero_externo" maxlength="10" pattern="^[A-Za-z0-9/-]{1,10}$" title="Letras y números, máximo 10 caracteres"
               value="{{ old('numero_externo', optional($proveedor->ubicacion_proveedor)->numero_externo) }}" required>
        @error('numero_externo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label"><strong>Número Interno</strong></label>
        <input type="text" class="form-control border border-secondary @error('numero_interno') is-invalid @enderror" name="numero_interno" maxlength="10" pattern="^[A-Za-z0-9/-]{1,10}$" title="Letras y números, máximo 10 caracteres"
               value="{{ old('numero_interno', optional($proveedor->ubicacion_proveedor)->numero_interno) }}">
        @error('numero_interno')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
                            </form>

                        </div> 
                    </div> 
                </div> 
            </div> 
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