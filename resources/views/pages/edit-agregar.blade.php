<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="proveedor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-navbars.navs.auth titlePage="Editar Proveedor"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card shadow-lg border border-secondary rounded-3">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center border-bottom border-secondary">
                            <h5 class="mb-0"><strong>Editar Proveedor: {{ $proveedor->nombre }}</strong></h5>
                            <div class="d-flex gap-2">
                                {{-- Espacio para botones adicionales si quieres --}}
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

                            <form method="POST" action="{{ route('proveedor.update.next', $proveedor) }}" id="proveedorForm">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label"><strong>Nombre <span class="text-danger">*</span></strong></label>
                                    <input type="text" 
                                           class="form-control border border-secondary rounded @error('nombre') is-invalid @enderror" 
                                           name="nombre" 
                                           value="{{ old('nombre', $proveedor->nombre) }}" 
                                           required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Teléfono <span class="text-danger">*</span></strong></label>
                                    <input type="tel" 
                                           class="form-control border border-secondary rounded @error('telefono') is-invalid @enderror" 
                                           name="telefono" 
                                           value="{{ old('telefono', $proveedor->telefono) }}" 
                                           required>
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"><strong>Correo Electrónico <span class="text-danger">*</span></strong></label>
                                    <input type="email" 
                                           class="form-control border border-secondary rounded @error('correo_electronico') is-invalid @enderror" 
                                           name="correo_electronico" 
                                           value="{{ old('correo_electronico', $proveedor->correo_electronico) }}" 
                                           required>
                                    @error('correo_electronico')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
