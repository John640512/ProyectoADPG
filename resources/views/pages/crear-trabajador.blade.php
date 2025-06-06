<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="trabajadores"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Crear Nuevo Trabajador"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <h2>Crear trabajador</h2>
                    <div class="card my-4">
                        <h1></h1>
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="container">
                                <form method="POST" action="{{ route('trabajadores.store') }}">
                                    @csrf
                                    
                                    <!-- Sección de Datos Personales -->
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="mb-3">Datos Personales</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-control-label">Nombre(s) <span class="text-danger">*</span></strong></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control border" name="nombre" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-control-label">Apellido Paterno <span class="text-danger">*</span></strong></label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control border" name="apellido_paterno" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-control-label">Apellido Materno</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control border" name="apellido_materno">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sección de Contacto -->
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="mb-3">Información de Contacto</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-control-label">Teléfono</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control border" name="telefono">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-control-label">Correo Electrónico</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="email" class="form-control border" name="correo_electronico">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-control-label">RFC</label>
                                            <div class="input-group input-group-outline mb-3">
                                                <input type="text" class="form-control border" name="rfc">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Sección de Dirección -->
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h5 class="mb-3">Domicilio</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <!-- Estado -->
                                                <div class="col-md-6">
                                                    <label class="form-control-label">Estado <span class="text-danger">*</span></strong></label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <select class="form-control border" name="estado" id="estado-select" required>
                                                            <option value="">Seleccione un estado</option>
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado->nombre }}" data-id="{{ $estado->id }}">{{ $estado->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Ciudad -->
                                                <div class="col-md-6">
                                                    <label class="form-control-label">Ciudad <span class="text-danger">*</span></strong></label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <input type="text" class="form-control border" name="ciudad" required>
                                                    </div>
                                                </div>
                                                <!-- Municipio -->
                                                <div class="col-md-6">
                                                    <label class="form-control-label">Municipio <span class="text-danger">*</span></strong></label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <select class="form-control border" name="municipio" id="municipio-select" required>
                                                            <option value="">Seleccione un municipio</option>
                                                            @foreach ($municipios as $municipio)
                                                                <option value="{{ $municipio->municipio }}">{{ $municipio->municipio }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Código Postal -->
                                                <div class="col-md-6">
                                                    <label class="form-control-label">Código Postal <span class="text-danger">*</span></strong></label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <input type="text" class="form-control border" name="cp" required>
                                                    </div>
                                                </div>
                                                <!-- Calle -->
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Calle <span class="text-danger">*</span></strong></label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <input type="text" class="form-control border" name="calle" required>
                                                    </div>
                                                </div>
                                                <!-- Colonia -->
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Colonia <span class="text-danger">*</span></strong></label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <input type="text" class="form-control border" name="colonia" required>
                                                    </div>
                                                </div>
                                                <!-- Entre calles -->
                                                <div class="col-md-4">
                                                    <label class="form-control-label">Entre calles</label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <input type="text" class="form-control border" name="entre_calles">
                                                    </div>
                                                </div>
                                                <!-- Número Externo -->
                                                <div class="col-md-6">
                                                    <label class="form-control-label">Número Externo <span class="text-danger">*</span></strong></label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <input type="text" class="form-control border" name="numero_externo" required>
                                                    </div>
                                                </div>
                                                <!-- Número Interno -->
                                                <div class="col-md-6">
                                                    <label class="form-control-label">Número Interno</label>
                                                    <div class="input-group input-group-outline mb-3">
                                                        <input type="text" class="form-control border" name="numero_interno">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="submit" class="btn bg-gradient-dark" style="text-transform: none !important;">Guardar trabajador</button>
                                            <a href="{{ route('trabajadores.index') }}" class="btn btn-outline-secondary" style="text-transform: none !important;">Cancelar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const estadoSelect = document.getElementById('estado-select');
        const municipioSelect = document.getElementById('municipio-select');

        estadoSelect.addEventListener('change', function () {
            const estadoId = this.options[this.selectedIndex].getAttribute('data-id');
            municipioSelect.innerHTML = '<option value="">Cargando...</option>';

            fetch(`/municipios-por-estado/${estadoId}`)
                .then(response => response.json())
                .then(data => {
                    municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.municipio;
                        option.textContent = municipio.municipio;
                        municipioSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    municipioSelect.innerHTML = '<option value="">Error al cargar municipios</option>';
                    console.error('Error:', error);
                });
        });
    });
    </script>
</x-layout>