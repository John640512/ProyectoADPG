<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="stock"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Editar Stock"></x-navbars.navs.auth>
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
                                                Edición de Stock
                                            </strong>
                                        </h5>
                                        <div class="d-flex gap-2">
                                            <button type="submit" form="stockForm" class="btn btn-outline-secondary btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">description</i> Actualizar
                                            </button>
                                            <a href="{{ route('stock') }}" class="btn btn-outline-danger btn-sm mb-0">
                                                <i class="material-icons" style="font-size: 1rem; vertical-align: middle;">cancel</i> Cancelar
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form method="POST" action="{{ route('stock.update', $stock->id_stock) }}" id="stockForm">
                                            @csrf
                                            @method('PUT') 
                                                        <div class="tab-content" id="myTabContent">
                                                <div class="tab-pane fade show active" id="datos" role="tabpanel">
                                                    <div class="text-center mb-4">
                                                        <i class="material-icons fs-1 text-secondary">inventory</i>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Fecha/Hora de llegada <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="datetime-local" class="form-control" name="fecha_llegada" value="{{ old('fecha_llegada', $stock->fecha_llegada) }}" 
                                                        required style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Cantidad toneladas <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <input type="number" step="0.01" 
                                                         class="form-control" 
                                                         name="cantidad_toneladas" 
                                                         value="{{ old('cantidad_toneladas', $stock->cantidad_toneladas) }}" 
                                                         max="{{ $stock->cantidad_toneladas }}"
                                                         required 
                                                         style="border: 2px solid #666; border-radius: 4px;">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Método de Pago <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <select name="metodo_pago" class="form-select border border-1 p-2" required>
                                                        <option value="">Seleccionar método</option>
                                                        <option value="C" {{ old('metodo_pago', $stock->metodo_pago ?? '') == 'C' ? 'selected' : '' }}>Cheque</option>
                                                        <option value="F" {{ old('metodo_pago', $stock->metodo_pago ?? '') == 'F' ? 'selected' : '' }}>Factura</option>
                                                        <option value="T" {{ old('metodo_pago', $stock->metodo_pago ?? '') == 'T' ? 'selected' : '' }}>Transferencia</option>
                                                        </select>
                                                    </div>

                                                    <!-- Producto -->
                                                    <div class="mb-3">
                                                        <label class="form-label">
                                                            <strong>Producto <span class="text-danger">*</span></strong>
                                                        </label>
                                                        <select name="id_producto" class="form-select border border-1 p-2" required>
                                                            <option value="">Seleccionar producto</option>
                                                            @foreach($productos as $productoItem)
                                                                <option value="{{ $productoItem->id_producto }}" {{ $productoItem->id_producto == $stock->id_producto ? 'selected' : '' }}>
                                                                    {{ $productoItem->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
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
