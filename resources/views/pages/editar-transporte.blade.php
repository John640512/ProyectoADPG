<x-layout bodyClass="g-sidenav-show bg-gray-200"> 
    <x-navbars.sidebar activePage="transporte"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Editar Transporte"></x-navbars.navs.auth>
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
                                                Editar Transporte
                                            </strong>
                                        </h5>
                                        <div class="d-flex gap-2">
                                            <button type="submit" form="transporteForm" class="btn btn-outline-secondary btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">description</i> Guardar Cambios
                                            </button>
                                            <a href="{{ route('transporte') }}" class="btn btn-outline-danger btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">cancel</i> Cancelar
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('guardar.transporte') }}" id="transporteForm">
                                            @csrf
                                            <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="datos" role="tabpanel">
                                                    <div class="text-center mb-4">
                                                        <i class="material-icons fs-1 text-secondary">local_shipping</i> 
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Fecha de salida <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="date" class="form-control" name="fecha_salida" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Tipo <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="text" class="form-control" name="tipo" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Color <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="text" class="form-control" name="color" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Cantidad toneladas <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="number" step="0.01" class="form-control" name="toneladas" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Modelo <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="text" class="form-control" name="modelo" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Trabajador <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="text" class="form-control" name="trabajador" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Ubicación Entrega <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="text" class="form-control" name="ubicacion_entrega" required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Productos <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <textarea class="form-control" name="productos" rows="3" required style="border: 2px solid #666; border-radius: 4px;"></textarea>
                                                    </div>

                                                </div>
                                            </div> <!-- tab-content -->
                                        </form>
                                    </div> <!-- card-body -->
                                </div> <!-- card -->
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-layout>