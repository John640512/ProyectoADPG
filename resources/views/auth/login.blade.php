<x-layout bodyClass="bg-gray-100">

    <main class="main-content mt-0 d-flex align-items-center justify-content-center min-vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="card rounded-5 overflow-hidden shadow-sm border-0">
                        <div class="row g-0">
                            <!-- Sección de formulario (blanco) -->
                            <div class="col-md-6 bg-white p-5 position-relative">
                                <!-- Línea divisora estilizada -->
                                <div class="divider-line position-absolute end-0 top-50 translate-middle-y"></div>
                                
                                <div class="w-100">
                                    <h2 class="text-black mb-4">Inicia Sesión</h2>
                                    
                                    <form role="form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        
                                        @if (Session::has('status'))
                                        <div class="alert alert-success alert-dismissible mb-3" role="alert">
                                            <span class="text-sm">{{ Session::get('status') }}</span>
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Usuario</label>
                                            <input type="email" class="form-control" name="email" 
                                                   value="{{ old('email') }}">
                                        </div>
                                        @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        
                                        <div class="mb-3 text-end mt-4">
                                            <a href="{{ route('verify') }}" class="text-black text-decoration-none">
                                                ¿Olvidaste la Contraseña?
                                            </a>
                                        </div>
                                        
                                        <div class="d-grid gap-2 mt-4">
                                            <button type="submit" class="btn btn-dark rounded-5 py-2">
                                                Inicia Sesión
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Sección de bienvenida (fondo oscuro con texto blanco) -->
                            <div class="col-md-6 bg-dark text-white p-5 d-flex align-items-center">
                                <div class="w-100 text-center">
                                    <h1 class="mb-4" style="font-size: 2.5rem; color: white; letter-spacing: 3px;">Bienvenido!</h1>
                                    <div class="divider mx-auto mb-4 bg-white" style="width: 50px; height: 2px;"></div>
                                    <p class="mb-4" style="font-size: 1.1rem;">¿No tienes una cuenta?</p>
                                    <a href="{{ route('register') }}" 
                                       class="btn btn-outline-light rounded-5 px-4 py-2 border-white">
                                        Crear Cuenta
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @push('css')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa !important;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .bg-dark {
            background-color: #343a40 !important;
        }
        .divider-line {
            width: 1px;
            height: 80%;
            background: linear-gradient(to bottom, 
                          transparent 0%, 
                          rgba(0,0,0,0.1) 20%, 
                          rgba(0,0,0,0.3) 50%, 
                          rgba(0,0,0,0.1) 80%, 
                          transparent 100%);
        }
        .input-group.input-group-outline .form-control {
            border: 1px solid #dee2e6 !important;
            border-radius: 0.5rem !important;
            padding: 0.5rem 1rem !important;
        }
        .input-group.input-group-outline .form-control:focus,
        .input-group.input-group-outline.is-focused .form-control {
            border-color: #495057 !important;
            box-shadow: none !important;
        }
        .input-group.input-group-outline .form-label {
            position: absolute;
            top: -0.5rem;
            left: 0.75rem;
            font-size: 0.75rem;
            background: white;
            padding: 0 0.25rem;
            color: #495057;
            transition: all 0.2s ease;
        }
        .input-group.input-group-outline.is-filled .form-label,
        .input-group.input-group-outline .form-control:focus ~ .form-label {
            color: #495057;
        }
        .btn-dark {
            background-color: #343a40 !important;
            border-color: #343a40 !important;
        }
        .btn-outline-light {
            border-color: #f8f9fa !important;
            color: #f8f9fa !important;
        }
        .btn-outline-light:hover {
            background-color: rgba(248,249,250,0.1) !important;
        }
        .alert-success {
            background-color: rgba(25,135,84,0.1) !important;
            border-color: rgba(25,135,84,0.3) !important;
            color: #212529 !important;
        }
        .rounded-5 {
            border-radius: 0.5rem !important;
        }
    </style>
    @endpush

    @push('js')
    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
    <script>
        $(function() {
            // Comportamiento de los inputs con estilo outline
            var text_val = $(".input-group input").val();
            if (text_val === "") {
                $(".input-group").removeClass('is-filled');
            } else {
                $(".input-group").addClass('is-filled');
            }
            
            // Actualizar el estado al interactuar
            $('.input-group.input-group-outline .form-control').on('input focus', function() {
                $(this).parent().addClass('is-filled is-focused');
            }).on('blur', function() {
                $(this).parent().removeClass('is-focused');
                if($(this).val() === '') {
                    $(this).parent().removeClass('is-filled');
                }
            });
        });
    </script>
    @endpush
</x-layout>
