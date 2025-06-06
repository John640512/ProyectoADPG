<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="ubicacion_entrega"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Agregar Dirección"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="main-content mt-0">
                <section>
                    <div class="container d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                                <div class="card shadow-lg">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">
                                            <strong>
                                                Dirección del Negocio
                                            </strong>
                                        </h5>
                                        <div class="d-flex gap-2">
                                            <button type="submit" form="formAgregarDireccion" class="btn btn-outline-secondary btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">save</i> Guardar
                                            </button>
                                            <a href="{{ route('agregar-ubicacionentrega') }}" class="btn btn-outline-danger btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">cancel</i> Cancelar
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        @if(session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            </div>
                                        @endif

                                        <form method="POST" action="{{ route('guardar.paso2') }}" id="formAgregarDireccion">
                                            @csrf
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="datos" role="tabpanel">
                                                    <div class="text-center mb-4">
                                                        <i class="material-icons fs-1 text-secondary">location_on</i>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label text-dark"><strong>Estado <span class="text-danger">*</span></strong></label>
                                                        <select class="form-control" name="estado" id="estado-select" required 
                                                                style="border: 2px solid #666; border-radius: 4px;">
                                                            <option value="">Seleccione un estado</option>
                                                            @foreach ($estados as $estado)
                                                            <option value="{{ $estado->nombre }}">{{ $estado->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label class="form-label"><strong>Ciudad <span class="text-danger">*</span></strong></label>
                                                            <input type="text" class="form-control" name="ciudad" 
                                                                   value="{{ old('ciudad') }}" required 
                                                                   style="border: 2px solid #666; border-radius: 4px;">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Calle <span class="text-danger">*</span></strong></label>
                                                        <input type="text" class="form-control" name="calle" 
                                                               value="{{ old('calle') }}" required 
                                                               style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Colonia <span class="text-danger">*</span></strong></label>
                                                        <input type="text" class="form-control" name="colonia" 
                                                               value="{{ old('colonia') }}" required 
                                                               style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Entre calles <span class="text-danger">*</span></strong></label>
                                                        <input type="text" class="form-control" name="entre_calles" 
                                                               value="{{ old('entre_calles') }}" required 
                                                               style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label"><strong>Código Postal <span class="text-danger">*</span></strong></label>
                                                            <input type="text" class="form-control" name="codigo_postal" 
                                                                   value="{{ old('codigo_postal') }}" required 
                                                                   style="border: 2px solid #666; border-radius: 4px;">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label"><strong>Número Externo <span class="text-danger">*</span></strong></label>
                                                            <input type="text" class="form-control" name="numero_externo" 
                                                                   value="{{ old('numero_externo') }}" required 
                                                                   style="border: 2px solid #666; border-radius: 4px;">
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label class="form-label"><strong>Número Interno</strong></label>
                                                            <input type="text" class="form-control" name="numero_interno" 
                                                                   value="{{ old('numero_interno') }}" 
                                                                   style="border: 2px solid #666; border-radius: 4px;">
                                                        </div>
                                                    </div>
                                                </div>
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

        @push('js')
        <script>
            document.getElementById('formAgregarDireccion').addEventListener('submit', function(e) {
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Por favor complete todos los campos obligatorios');
                }
            });
        </script>
        @endpush
    </main>
</x-layout>