<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="negocio"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Datos del Negocio"></x-navbars.navs.auth>
        <!-- End Navbar -->

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
                                                Datos del Negocio
                                            </strong>
                                        </h5>
                                        <div class="d-flex gap-2">
                                            <button type="submit" form="negocioForm" class="btn btn-outline-secondary btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">save</i> Siguiente
                                            </button>
                                            <a href="{{ route('ubicacion_entrega') }}" class="btn btn-outline-danger btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">cancel</i> Cancelar
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('guardar.paso1') }}" id="negocioForm">
                                            @csrf
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="datos" role="tabpanel">
                                                    <div class="text-center mb-4">
                                                        <i class="material-icons fs-1 text-secondary">business</i>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Nombre del negocio <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="text" class="form-control" name="nombre" required 
                                                            style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Descripción del lugar <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <textarea class="form-control" name="descripcion_lugar" rows="3" required 
                                                            style="border: 2px solid #666; border-radius: 4px;"></textarea>
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
    </main>
</x-layout>