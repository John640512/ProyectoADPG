<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="user-profile"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Perfil de usuario'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="col-12">
                <h2 class="text-black"><strong>Perfil</strong></h2>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-4">
                <div class="col-12 d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-black"><strong></strong></h2>
                    <!-- Botón para abrir el modal -->
                    <button type="button" style="text-transform: none !important" class="btn bg-gradient-dark" data-bs-toggle="modal" data-bs-target="#passwordModal">
                        Cambiar contraseña
                    </button>
                </div>
                <!-- Sección de perfil centrada -->
                <div class="d-flex flex-column align-items-center text-center mb-4">
                    <div class="text-center mb-4">
                            <div class="d-inline-block p-3 bg-light rounded-circle shadow-sm">
                                <i class="material-icons" style="font-size: 40px;">account_circle</i>
                            </div>
                    </div>
                    <h5 class="mb-1">{{ auth()->user()->nombre }}</h5>
                    <p class="mb-0 font-weight-normal text-sm">
                        {{ auth()->user()->rol->nombre ?? 'Sin rol asignado' }}
                    </p>
                </div>

                <!-- Formulario en pila -->
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ session('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif
                        
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible text-white">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form method='POST' action='{{ route('user-profile') }}'>
                            @csrf
                            <div class="d-flex flex-column align-items-center">
                                <!-- Campos en pila -->
                                <div class="w-100" style="max-width: 500px;">
                                    <!-- Nombre -->
                                    <div class="mb-3">
                                        <label class="form-label">Nombre(s)</label>
                                        <input type="text" name="nombre" class="form-control border border-2 p-2" 
                                            value='{{ old('nombre', auth()->user()->nombre) }}'>
                                    </div>

                                    <!-- Apellido Paterno -->
                                    <div class="mb-3">
                                        <label class="form-label">Apellido Paterno</label>
                                        <input type="text" name="apellido_paterno" class="form-control border border-2 p-2" 
                                            value='{{ old('apellido_paterno', auth()->user()->apellido_paterno) }}'>
                                    </div>

                                    <!-- Apellido Materno -->
                                    <div class="mb-3">
                                        <label class="form-label">Apellido Materno</label>
                                        <input type="text" name="apellido_materno" class="form-control border border-2 p-2" 
                                            value='{{ old('apellido_materno', auth()->user()->apellido_materno ?? '') }}'>
                                    </div>

                                    <!-- Teléfono -->
                                    <div class="mb-3">
                                        <label class="form-label">Teléfono</label>
                                        <input type="text" name="telefono" class="form-control border border-2 p-2" 
                                            value='{{ old('telefono', auth()->user()->telefono ?? '') }}'>
                                    </div>

                                    <!-- Correo electrónico -->
                                    <div class="mb-3">
                                        <label class="form-label">Correo electrónico</label>
                                        <input type="email" name="correo_electronico" class="form-control border border-2 p-2" 
                                            value='{{ old('correo_electronico', auth()->user()->correo_electronico) }}'>
                                    </div>

                                    <!-- Rol (solo lectura) -->
                                    <div class="mb-3">
                                        <label class="form-label">Rol</label>
                                        <input type="text" class="form-control border border-2 p-2" 
                                            value="{{ auth()->user()->rol->nombre ?? 'Sin rol asignado' }}" readonly>
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="text-center mt-4 d-flex gap-3">
                                    <button type="submit" class="btn bg-gradient-dark px-4" style="text-transform: none !important">Guardar cambios</button>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                                    class="btn btn-outline-secondary text-lowercase px-4" style="text-transform: none !important">
                                        Cerrar sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                                
                                <!-- Modal para cambiar contraseña -->
                                <div class="modal fade" id="passwordModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Cambiar contraseña</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form method="POST" action="{{ route('update-password') }}">
                                                @csrf
                                                <div class="modal-body">
                                                    <!-- Nueva Contraseña -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Nueva contraseña</label>
                                                        <div class="input-group">
                                                            <input type="password" name="password" id="modalPassword" class="form-control" style="border: 2px solid #ced4da; height: 42px; padding-left: 10px;" placeholder="••••••••" required>
                                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="modalPassword">
                                                                <i class="fas fa-eye-slash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- Confirmar Contraseña -->
                                                    <div class="mb-3">
                                                        <label class="form-label">Confirmar nueva contraseña</label>
                                                        <div class="input-group">
                                                            <input type="password" name="password_confirmation" id="modalPasswordConfirmation" class="form-control" style="border: 2px solid #ced4da; height: 42px; padding-left: 10px;" placeholder="••••••••" required>
                                                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="modalPasswordConfirmation">
                                                                <i class="fas fa-eye-slash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary text-lowercase" style="text-transform: none !important" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" style="text-transform: none !important" class="btn bg-gradient-dark">Guardar cambios</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
    @push('js')
<script>
    // Función para mostrar/ocultar contraseña
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');
            
            // Cambiar tipo de input
            input.type = input.type === 'password' ? 'text' : 'password';
            
            // Cambiar ícono
            icon.classList.toggle('fa-eye-slash');
            icon.classList.toggle('fa-eye');
        });
    });
</script>
@endpush
</x-layout>