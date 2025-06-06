<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="proveedor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Agregar Proveedor"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <form method="POST" action="{{ route('proveedor.storePaso1') }}">
                @csrf
                <div class="card shadow-lg border border-secondary rounded-3">
                    {{-- Card Header --}}
                    <div class="card-header bg-light border-bottom border-secondary">
                        <h5 class="mb-0"><strong>Datos Básicos del Proveedor</strong></h5>
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><strong>Nombre/Empresa <span class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control border border-secondary rounded" name="nombre" maxlength="15" value="{{ session('proveedor.nombre', old('nombre')) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Teléfono <span class="text-danger">*</span></strong></label>
                            <input type="tel" class="form-control border border-secondary rounded" name="telefono" maxlength="15" pattern="^\+?[0-9]{7,15}$" title="Solo números. Puede comenzar con + y tener de 10 a 15 dígitos" value="{{ session('proveedor.telefono', old('telefono')) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Correo Electrónico <span class="text-danger">*</span></strong></label>
                            <input type="email" class="form-control border border-secondary rounded" name="correo_electronico" maxlength="64" title="Ingrese un correo válido (ej. ejemplo@dominio.com), máximo 64 caracteres" value="{{ session('proveedor.correo_electronico', old('correo_electronico')) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>RFC</strong></label>
                            <input type="text" class="form-control border border-secondary rounded" name="rfc" maxlength="13" pattern="[A-Za-z0-9]{1,13}" title="Solo letras y números, máximo 13 caracteres" value="{{ session('proveedor.rfc', old('rfc')) }}" required>
                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="card-footer border-top border-secondary">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('proveedor.index') }}" class="btn btn-danger">
                                <i class="material-icons">cancel</i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Siguiente <i class="material-icons">arrow_forward</i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</x-layout>
