<x-layout bodyClass="g-sidenav-show bg-gray-200">
  <x-navbars.sidebar activePage="proveedor"></x-navbars.sidebar>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <x-navbars.navs.auth titlePage="Detalles del Proveedor"></x-navbars.navs.auth>

    <div class="container-fluid py-4">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow-lg border-radius-lg p-4 bg-white">

            <!-- Botón Volver -->
            <div class="d-flex justify-content-end mb-3">
              <a href="{{ route('proveedor.index') }}" class="btn bg-gradient-secondary">
                <i class="material-icons me-2">arrow_back</i>Volver
              </a>
            </div>

            <!-- Icono central -->
            <div class="text-center mb-4">
              <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle border border-2 p-3" style="width: 80px; height: 80px;">
                <i class="fas fa-building text-secondary me-2 fs-4"></i>
                <i class="fas fa-truck text-secondary fs-4"></i>
              </div>
              <h4 class="mt-3">{{ $proveedor->nombre }}</h4>
            </div>

            <div class="row">
              <!-- Datos del Proveedor -->
              <div class="col-md-6">
                <div class="bg-light rounded-3 p-3 shadow-sm mb-4">
                  <h6 class="mb-3">Datos del Proveedor</h6>

                  <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{ $proveedor->nombre }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" value="{{ $proveedor->telefono }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" value="{{ $proveedor->correo_electronico }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">RFC</label>
                    <input type="text" class="form-control" value="{{ $proveedor->rfc }}" readonly>
                  </div>
                </div>
              </div>

              <!-- Ubicación del Proveedor -->
              <div class="col-md-6">
                <div class="bg-light rounded-3 p-3 shadow-sm mb-4">
                  <h6 class="mb-3">Ubicación del Proveedor</h6>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Estado</label>
                      <input type="text" class="form-control" value="{{$proveedor->ubicacion_proveedor->estado }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Ciudad</label>
                      <input type="text" class="form-control" value="{{ $proveedor->ubicacion_proveedor->ciudad }}" readonly>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Municipio</label>
                    <input type="text" class="form-control" value="{{ $proveedor->ubicacion_proveedor->municipio }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Calle</label>
                    <input type="text" class="form-control" value="{{$proveedor->ubicacion_proveedor->calle }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Colonia</label>
                    <input type="text" class="form-control" value="{{$proveedor->ubicacion_proveedor->colonia }}" readonly>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Código Postal</label>
                      <input type="text" class="form-control" value="{{ $proveedor->ubicacion_proveedor->cp }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label class="form-label">Número Externo</label>
                      <input type="text" class="form-control" value="{{$proveedor->ubicacion_proveedor->numero_externo }}" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label class="form-label">Número Interno</label>
                      <input type="text" class="form-control" value="{{$proveedor->ubicacion_proveedor->numero_interno }}" readonly>
                    </div>
                  </div>

                </div> <!-- bg-light p-3 Ubicación -->
              </div> <!-- col-md-6 -->
            </div> <!-- row -->
          </div> <!-- card -->
        </div> <!-- col-lg-10 -->
      </div> <!-- row -->
    </div> <!-- container-fluid -->
  </main>
</x-layout>
