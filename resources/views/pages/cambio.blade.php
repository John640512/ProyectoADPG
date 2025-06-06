<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="cambio"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Cambio del Costo"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <main class="main-content mt-0">
                <section>
                    <div class="container d-flex flex-column justify-content-center">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="card shadow-lg">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <div class="position-absolute start-50 translate-middle">
                                            <i class="material-icons fs-3 text-secondary">paid</i>
                                        </div>
                                        <div class="d-flex ms-auto">
                                            <a href="{{ route('costo') }}" class="btn btn-outline-danger btn-sm me-2">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">cancel</i> Cancelar
                                            </a>
                                            <button form="form-costo" type="submit" class="btn btn-outline-secondary btn-sm">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">description</i> Guardar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form id="form-costo" method="POST" action="{{ route('costo') }}">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label"><strong>Fecha <span style="color: red;">*</span></strong></label>
                                                <input type="date" class="form-control" name="fecha" required style="border: 2px solid #666; border-radius: 4px;">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label"><strong>Costo anterior <span style="color: red;">*</span></strong></label>
                                                    <input type="number" class="form-control" name="costo_anterior" required style="border: 2px solid #666; border-radius: 4px;">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label"><strong>Costo actual <span style="color: red;">*</span></strong></label>
                                                    <input type="number" class="form-control" name="costo_actual" required style="border: 2px solid #666; border-radius: 4px;">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><strong>Razón del cambio <span style="color: red;">*</span></strong></label>
                                                <textarea class="form-control" name="razon_cambio" rows="3" required style="border: 2px solid #666; border-radius: 4px;"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label"><strong>Producto <span style="color: red;">*</span></strong></label>
                                                <select class="form-control" name="producto" required style="border: 2px solid #666; border-radius: 4px;">
                                                    <option value="">Seleccione un producto</option>
                                                    @foreach($productos as $producto)
                                                    <option 
                                                    value="{{ $producto->id_producto }}" 
                                                    data-costo="{{ $producto->tipo_producto->costoPorTonelada->costo_tonelada ?? 0 }}">
                                                    {{ $producto->nombre }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </form>
                                    </div> 
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                </section>
            </main>
        </div>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const selectProducto = document.querySelector('select[name="producto"]');
        const inputCostoAnterior = document.querySelector('input[name="costo_anterior"]');

        selectProducto.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const costoAnterior = selectedOption.getAttribute('data-costo') || 0;
            inputCostoAnterior.value = parseFloat(costoAnterior).toFixed(2);
        });
    });
</script>

</x-layout>
