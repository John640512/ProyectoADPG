<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="create-user"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Registrar Usuario'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="col-12">
                <h2 class="text-black"><strong>Registrar Nuevo Usuario</strong></h2>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-4">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-end gap-3 mb-4">
                            <button type="submit" form="userForm" class="btn bg-gradient-dark px-4 text-lowercase" style="text-transform: none !important">Registrar</button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary px-4 text-lowercase" style="text-transform: none !important">Cancelar</a>
                        </div>
                        @if ($errors->any())
                        <div class="row">
                            <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Icono de perfil centrado -->
                        <div class="text-center mb-4">
                            <div class="d-inline-block p-3 bg-light rounded-circle shadow-sm">
                                <i class="material-icons" style="font-size: 40px;">account_circle</i>
                            </div>
                        </div>

                        <!-- Formulario con campos alineados a la izquierda -->
                        <form method='POST' action='{{ route('usuarios.store') }}' id="userForm">
                            @csrf
                            <div class="w-100" style="max-width: 500px; margin: 0 auto;">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Nombre(s) </strong><span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control border border-2 p-2" 
                                           required value="{{ old('name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Apellido Paterno </strong><span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" class="form-control border border-2 p-2" 
                                           required value="{{ old('last_name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Apellido Materno </strong><span class="text-danger">*</span></label>
                                    <input type="text" name="mothers_last_name" class="form-control border border-2 p-2" 
                                           value="{{ old('mothers_last_name') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Teléfono</strong></label>
                                    <input type="tel" name="phone" class="form-control border border-2 p-2" 
                                           value="{{ old('phone') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Correo electrónico </strong><span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control border border-2 p-2" 
                                           required value="{{ old('email') }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Contraseña </strong><span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control border border-2 p-2" 
                                           required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><strong>Rol </strong><span class="text-danger">*</span></label>
                                    <select name="role" class="form-select border border-2 p-2" required>
                                        @foreach(\App\Models\Rol::all() as $rol)
                                            <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <x-footers.auth></x-footers.auth>
    </div>
</x-layout>