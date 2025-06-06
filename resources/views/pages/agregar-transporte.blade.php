<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="add-transporte"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Agregar Transporte'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="col-12">
                <h2 class="text-black">
                    <strong>{{ isset($transporte) ? 'Editar' : 'Registrar' }} Transporte</strong>
                </h2>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-4">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-end gap-3 mb-4">
                            <button type="submit" form="transporteForm" class="btn bg-gradient-dark px-4 text-lowercase" style="text-transform: none !important">Guardar</button>
                            <a href="{{ route('transportes.index') }}" class="btn btn-outline-secondary px-4 text-lowercase" style="text-transform: none !important">Cancelar</a>
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

                        <!-- Icono de producto centrado -->
                        <div class="text-center mb-4">
                            <div class="d-inline-block p-3 bg-light rounded-circle shadow-sm">
                                <i class="material-icons" style="font-size: 40px; color: #4CAF50;">local_shipping</i>
                            </div>
                        </div>

                        <!-- Formulario con campos alineados -->
                        <form method='POST' action="@isset($transporte) {{ route('transportes.update', $transporte->id_transporte) }} @else {{ route('transportes.store') }} @endisset" id="transporteForm">
                            @csrf
                            @isset($transporte) @method('PUT') @endisset
                            
                            <div class="w-100" style="max-width: 500px; margin: 0 auto;">

                                <!-- Fecha de Salida -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Fecha de Salida </strong><span class="text-danger">*</span></label>
                                    <input type="date" name="fecha_salida" class="form-control border border-1 p-2" 
                                        value="{{ isset($transporte) ? $transporte->fecha_salida->format('Y-m-d\TH:i:s') : old('fecha_salida', now()->format('Y-m-d\TH:i:s')) }}" required>
                                </div>

                                <!-- tipo de transporte -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Tipo de Transporte </strong><span class="text-danger">*</span></label>
                                    <select name="id_tipo_transporte" class="form-select border border-1 p-2" required>
                                        <option value="">Seleccionar tipo de transporte</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{ $tipo->id_tipo_transporte }}" 
                                                @if((isset($transporte) && $transporte->id_tipo_transporte == $tipo->id_tipo_transporte) || old('id_tipo_transporte') == $tipo->id_tipo_transporte) selected @endif>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- modelo del transporte -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Modelo del transporte</strong><span class="text-danger">*</span></label>
                                    <input type="text" name="modelo" class="form-control border border-1 p-2" required value="{{ $transporte->modelo ?? old('modelo') }}">

                                </div>
                                
                                <!-- color -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Color del transporte</strong><span class="text-danger">*</span></label>
                                    <input type="text" name="color" class="form-control border border-1 p-2" rows="3" required value="{{ $transporte->color ?? old('color') }}">
                                </div>

                                <!-- toneladas -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Toneladas del producto</strong><span class="text-danger">*</span></label>
                                    <input type="number" name="cantidad_toneladas" class="form-control border border-1 p-2" rows="3" required value="{{$transporte->cantidad_toneladas ?? old('cantidad_toneladas') }}">
                                </div>

                                <!-- trabajador encargado -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Trabajador encargado</strong><span class="text-danger">*</span></label>
                                    <select name="id_trabajador" class="form-select border border-1 p-2">
                                        <option value="">Seleccionar al trabajador</option>
                                        @foreach($trabajadores as $trabajador)
                                            <option value="{{ $trabajador->id_trabajador}}" 
                                                @if((isset($transporte) && $transporte->id_trabajador == $trabajador->id_trabajador) || old('id_trabajador') == $trabajador->id_trabajador) selected @endif>
                                                {{ $trabajador->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- ubicacion de entrega (Múltiple) -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Ubicacion de entrega</strong><span class="text-danger">*</span></label>
                                    <select name="ubicaciones[]" class="form-select border border-1 p-2" multiple>
                                        @foreach($entregas as $entrega)
                                            <option value="{{ $entrega->id_ubicacion_entrega}}" 
                                                @if((isset($transporte) && $transporte->ubicacionesEntrega->contains($entrega->id_ubicacion_entrega)) || (is_array(old('ubicaciones')) && in_array($entrega->id_ubicacion_entrega, old('ubicaciones')))) selected @endif>
                                                {{ $entrega->nombre_negocio}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- producto (Múltiple) -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Producto</strong><span class="text-danger">*</span></label>
                                    <select name="productos[]" class="form-select border border-1 p-2" multiple required>
                                        @foreach($productos as $producto)
                                            <option value="{{ $producto->id_producto}}" 
                                                @if((isset($transporte) && $transporte->productos->contains($producto->id_producto)) || (is_array(old('productos')) && in_array($producto->id_producto, old('productos')))) selected @endif>
                                                {{ $producto->nombre}}
                                            </option>
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

    @push('js')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inicializar Select2 para los selects múltiples
            $('select[name="ubicaciones[]"], select[name="productos[]"]').select2({
                placeholder: "Seleccione las opciones",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    @endpush
</x-layout>