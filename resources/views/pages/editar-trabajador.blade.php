<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="trabajador"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Editar trabajador"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="main-content mt-0">
                <section>
                    <div class="container d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                                <div class="card shadow-lg">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><strong>Editar Registro del trabajador</strong></h5>
                                        <div class="d-flex gap-2">
                                            <button type="submit" form="trabajadorForm" class="btn btn-outline-secondary btn-sm mb-0">
                                                <i class="material-icons">description</i> Guardar Cambios
                                            </button>
                                            <a href="{{ route('trabajadores.index') }}" class="btn btn-outline-danger btn-sm mb-0">
                                                <i class="material-icons">cancel</i> Cancelar
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        {{-- Mostrar errores de validación --}}
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <form action="{{ route('trabajadores.update', $trabajador->id) }}" id="trabajadorForm">
                                            @csrf
                                            @method('PUT')

                                            <!-- Datos personales -->
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>Nombre <span class="text-danger">*</span></strong></label>
                                                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $trabajador->nombre) }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>Apellido Paterno <span class="text-danger">*</span></strong></label>
                                                    <input type="text" class="form-control" name="apellido_paterno" value="{{ old('apellido_paterno', $trabajador->apellido_paterno) }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>Apellido Materno</strong></label>
                                                    <input type="text" class="form-control" name="apellido_materno" value="{{ old('apellido_materno', $trabajador->apellido_materno) }}">
                                                </div>
                                            </div>

                                            <!-- Contacto -->
                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>Teléfono</strong></label>
                                                    <input type="text" class="form-control" name="telefono" value="{{ old('telefono', $trabajador->telefono) }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>Correo Electrónico</strong></label>
                                                    <input type="email" class="form-control" name="correo_electronico" value="{{ old('correo_electronico', $trabajador->correo_electronico) }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>RFC</strong></label>
                                                    <input type="text" class="form-control" name="rfc" value="{{ old('rfc', $trabajador->rfc) }}">
                                                </div>
                                            </div>

                                            <!-- Dirección -->
                                            <div class="row mb-3">
                                                <div class="col-md-3">
                                                    <label class="form-label"><strong>Estado <span class="text-danger">*</span></strong></label>
                                                    <input type="text" class="form-control" name="estado" value="{{ old('estado', $trabajador->estado) }}" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label"><strong>Código Postal <span class="text-danger">*</span></strong></label>
                                                    <input type="text" class="form-control" name="cp" value="{{ old('cp', $trabajador->cp) }}" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>Calle <span class="text-danger">*</span></strong></label>
                                                    <input type="text" class="form-control" name="calle" value="{{ old('calle', $trabajador->calle) }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>Colonia <span class="text-danger">*</span></strong></label>
                                                    <input type="text" class="form-control" name="colonia" value="{{ old('colonia', $trabajador->colonia) }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label"><strong>Entre calles</strong></label>
                                                    <input type="text" class="form-control" name="entre_calles" value="{{ old('entre_calles', $trabajador->entre_calles) }}">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label"><strong>Número Externo <span class="text-danger">*</span></strong></label>
                                                    <input type="text" class="form-control" name="numero_externo" value="{{ old('numero_externo', $trabajador->numero_externo) }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label"><strong>Número Interno</strong></label>
                                                    <input type="text" class="form-control" name="numero_interno" value="{{ old('numero_interno', $trabajador->numero_interno) }}">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="material-icons me-2">save</i> Guardar Cambios
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layout>
