<x-layout bodyClass="g-sidenav-show bg-gray-200">
  <x-navbars.sidebar activePage="ubicacion_entrega"></x-navbars.sidebar>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <x-navbars.navs.auth titlePage="Ver ubicación entrega"></x-navbars.navs.auth>

    <div class="container-fluid py-4">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow-lg border-radius-lg p-4 bg-white">
            
            <!-- Botón Volver -->
            <div class="d-flex justify-content-end mb-3">
              <a href="{{ route('ubicacion_entrega') }}" class="btn bg-gradient-secondary">
                <i class="material-icons me-2">arrow_back</i>Volver
              </a>
            </div>

            <!-- Icono con datos dinámicos -->
            <div class="text-center mb-4">
              <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle border border-2 p-3" style="width: 80px; height: 80px;">
                <i class="fas fa-map-marked-alt text-secondary fs-3"></i>
              </div>
              <h5 class="mt-2">{{ $ubicacion->nombre_negocio }}</h5>
            </div>

            <div class="row">
              <!-- Datos de ubicacion entrega -->
              <div class="col-md-6">
                <div class="bg-light rounded-3 p-3 shadow-sm mb-4">
                  <h6 class="mb-3">Datos del negocio</h6>

                  <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{ $ubicacion->nombre_negocio }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Descripción del lugar</label>
                    <textarea class="form-control" rows="3" readonly>{{ $ubicacion->descripcion_lugar }}</textarea>
                  </div>

                </div>
              </div>

              <!-- Dirección -->
              <div class="col-md-6">
                <div class="bg-light rounded-3 p-3 shadow-sm mb-4">
                  <h6 class="mb-3">Dirección del negocio</h6>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Estado</label>
                      <input type="text" class="form-control" value="{{ $ubicacion->estado }}" readonly>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Calle</label>
                      <input type="text" class="form-control" value="{{ $ubicacion->calle }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Colonia</label>
                      <input type="text" class="form-control" value="{{ $ubicacion->colonia }}" readonly>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Entre Calles</label>
                    <textarea class="form-control" rows="2" readonly>{{ $ubicacion->entre_calles }}</textarea>
                  </div>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Código postal</label>
                      <input type="text" class="form-control" value="{{ $ubicacion->cp }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Número Externo</label>
                      <input type="text" class="form-control" value="{{ $ubicacion->numero_externo }}" readonly>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Número Interno</label>
                    <input type="text" class="form-control" value="{{ $ubicacion->numero_interno ?? 'N/A' }}" readonly>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</x-layout>