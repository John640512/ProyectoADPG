<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="trabajador"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Agregar trabajador"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="main-content mt-0">
                <section>
                    <div class="container d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-10 mx-auto">
                                <div class="card shadow-lg">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0"><strong>Registro del trabajador</strong></h5>
                                        <div class="d-flex gap-2">
                                            <button type="submit" form="trabajadorForm" class="btn btn-outline-secondary btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">description</i> Guardar
                                            </button>
                                            <a href="{{ route('trabajador') }}" class="btn btn-outline-danger btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">cancel</i> Cancelar
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('guardar-tra.trabajador') }}" id="trabajadorForm">
                                            @csrf
                                            <div class="tab-content" id="myTabContent">
                                                <!-- Tab 1: Datos del trabajador -->
                                                <div class="tab-pane fade show active" id="datos" role="tabpanel">
                                                    <div class="text-center mb-4">
                                                        <i class="material-icons fs-1 text-secondary">badge</i> 
                                                        <h6 class="mt-2"><strong>Datos Personales</strong></h6>
                                                    </div>

                                                   <div class="mb-3">
                                                  <label class="form-label">
                                                      <strong>Nombre<span style="color: red;">*</span></strong>
                                                      </label>
                                                <input type="text" class="form-control" name="nombre" required style="border: 2px solid #666; border-radius: 4px;">
                                                        </div>

                                                   <div class="mb-3">
                                                    <label class="form-label"><strong>Apellido Paterno<span style="color: red;">*</span></strong></label>
                                                    <input type="tel" class="form-control" name="telefono" required style="border: 2px solid #666; border-radius: 4px;">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Apellido materno<span style="color: red;">*</span></strong></label>
                                                    <input type="email" class="form-control" name="correo" required style="border: 2px solid #666; border-radius: 4px;">
                                                </div>

                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Teléfono</strong></label>
                                                        <input type="text" class="form-control" name="rfc" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label"><strong>Correo electrónico</strong></label>
                                                        <input type="text" class="form-control" name="rfc" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>
                                                </div>
                                            </div> <!-- tab-content -->
                                        </form>
                                    </div> <!-- card-body -->
                                </div> <!-- card -->
                            </div>
                        </div>

                        <div class="pagination d-flex justify-content-center gap-3">
                            <a href="#" class="active" style="background-color:darkgray; padding: 5px 10px;
                            border-radius: 5px; box-shadow:  0 4px 6px rgba(0, 0, 0, 0.1); display: inline-block;">1</a>
                            <a href="{{ route('detallestrabajador') }}" class="next" style="padding: 5px 10px; text-decoration: none;">2</a>
                            <a href="{{ route('detallestrabajador') }}" class="next" style="padding: 5px 10px; text-decoration: underline;">Siguiente</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layout>