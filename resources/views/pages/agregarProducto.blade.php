<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="add-product"></x-navbars.sidebar>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage='Agregar Producto'></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid px-2 px-md-4">
            <div class="col-12">
                <h2 class="text-black"><strong>@isset($producto) Editar @else Registrar @endisset Producto</strong></h2>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-4">
                <div class="card card-plain h-100">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-end gap-3 mb-4">
                            <button type="submit" form="productForm" class="btn bg-gradient-dark px-4 text-lowercase" style="text-transform: none !important">Guardar</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 text-lowercase" style="text-transform: none !important">Cancelar</a>
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
                                <i class="material-icons" style="font-size: 40px; color: #4CAF50;">inventory_2</i>
                            </div>
                        </div>

                        <!-- Formulario con campos alineados -->
                        <form method='POST' action="@isset($producto) {{ route('productos.update', $producto->id_producto) }} @else {{ route('productos.store') }} @endisset" id="productForm">
                            @csrf
                            @isset($producto) @method('PUT') @endisset
                            
                            <div class="w-100" style="max-width: 500px; margin: 0 auto;">
                                <!-- Nombre -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Nombre </strong><span class="text-danger">*</span></label>
                                    <input type="text" name="nombre" class="form-control border border-1 p-2" 
                                        value="{{ $producto->nombre ?? old('nombre') }}" required>
                                </div>
                                
                                <!-- Descripción -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Descripción </strong><span class="text-danger">*</span></label>
                                    <textarea name="descripcion" class="form-control border border-1 p-2" rows="3" required>{{ $producto->descripcion ?? old('descripcion') }}</textarea>
                                </div>
                                
                                <!-- Fecha de Registro -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Fecha de Registro </strong><span class="text-danger">*</span></label>
                                    <input type="date" name="fecha_registro" class="form-control border border-1 p-2" 
                                        value="{{ isset($producto) ? $producto->fecha_registro->format('Y-m-d\TH:i:s') : old('fecha_registro', now()->format('Y-m-d\TH:i:s')) }}" required>
                                </div>
                                
                                <!-- Tipo de Producto -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Tipo de Producto </strong><span class="text-danger">*</span></label>
                                    <select name="id_tipo_producto" class=  "form-select border border-1 p-2" required>
                                        <option value="">Seleccionar tipo de producto</option>
                                        @foreach($tipos as $tipo)
                                            <option value="{{ $tipo->id_tipo_producto }}" 
                                                @if((isset($producto) && $producto->id_tipo_producto == $tipo->id_tipo_producto) || old('id_tipo_producto') == $tipo->id_tipo_producto) selected @endif>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Proveedor -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Proveedor</strong></label>
                                    <select name="id_proveedor" class="form-select border border-1 p-2">
                                        <option value="">Seleccionar proveedor (opcional)</option>
                                        @foreach($proveedores ?? [] as $proveedor)
                                            <option value="{{ $proveedor->id_proveedor }}"
                                                @if((isset($producto) && $producto->id_proveedor == $proveedor->id_proveedor) || old('id_proveedor') == $proveedor->id_proveedor) selected @endif>
                                                {{ $proveedor->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <!-- Ubicación -->
                                <div class="mb-3">
                                    <label class="form-label"><strong>Ubicación </strong><span class="text-danger">*</span></label>
                                    <select name="id_ubicacion" class="form-select border border-1 p-2" required>
                                        <option value="">Seleccionar ubicación del producto</option>
                                        @foreach($ubicaciones as $ubicacion)
                                            <option value="{{ $ubicacion->id_ubicacion }}"
                                                @if((isset($producto) && $producto->id_ubicacion == $ubicacion->id_ubicacion) || old('id_ubicacion') == $ubicacion->id_ubicacion) selected @endif>
                                                {{ $ubicacion->nombre }}
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
</x-layout>