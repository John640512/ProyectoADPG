<x-layout bodyClass="g-sidenav-show bg-gray-200">
  <x-navbars.sidebar activePage="trabajadores"></x-navbars.sidebar>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <x-navbars.navs.auth titlePage="Detalles del Trabajador"></x-navbars.navs.auth>

    <div class="container-fluid py-4">
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card shadow-lg border-radius-lg p-4 bg-white">

            <!-- Botón Volver -->
            <div class="d-flex justify-content-end mb-3">
              <a href="{{ route('trabajadores.index') }}" class="btn bg-gradient-secondary">
                <i class="material-icons me-2">arrow_back</i>Volver
              </a>
            </div>

            <!-- Icono central -->
            <div class="text-center mb-4">
              <div class="d-inline-flex align-items-center justify-content-center bg-white shadow rounded-circle border border-2 p-3" style="width: 80px; height: 80px;">
                <i class="fas fa-id-badge text-secondary me-2 fs-4"></i>
                <i class="fas fa-user text-secondary fs-4"></i>
              </div>
              <h4 class="mt-3">{{ $trabajador->nombre }} {{ $trabajador->apellido_paterno }} {{ $trabajador->apellido_materno }}</h4>
            </div>

            <div class="row">
              <!-- Datos Personales -->
              <div class="col-md-6">
                <div class="bg-light rounded-3 p-3 shadow-sm mb-4">
                  <h6 class="mb-3">Datos Personales</h6>

                  <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{ $trabajador->nombre }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" value="{{ $trabajador->apellido_paterno }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" value="{{ $trabajador->apellido_materno ?? 'N/A' }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Teléfono</label>
                    <input type="text" class="form-control" value="{{ $trabajador->telefono ?? 'N/A' }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" value="{{ $trabajador->correo_electronico ?? 'N/A' }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">RFC</label>
                    <input type="text" class="form-control" value="{{ $trabajador->rfc ?? 'N/A' }}" readonly>
                  </div>
                </div>
              </div>

              <!-- Dirección -->
              <div class="col-md-6">
                <div class="bg-light rounded-3 p-3 shadow-sm mb-4">
                  <h6 class="mb-3">Dirección</h6>

                  <div class="row">
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Estado</label>
                      <input type="text" class="form-control" value="{{ $trabajador->estado }}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Municipio</label>
                      <input type="text" class="form-control" value="{{ $trabajador->municipio }}" readonly>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Calle</label>
                    <input type="text" class="form-control" value="{{ $trabajador->calle }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Colonia</label>
                    <input type="text" class="form-control" value="{{ $trabajador->colonia }}" readonly>
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Entre calles</label>
                    <input type="text" class="form-control" value="{{ $trabajador->entre_calles ?? 'N/A' }}" readonly>
                  </div>

                  <div class="row">
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Código Postal</label>
                      <input type="text" class="form-control" value="{{ $trabajador->cp }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Número Externo</label>
                      <input type="text" class="form-control" value="{{ $trabajador->numero_externo }}" readonly>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label class="form-label">Número Interno</label>
                      <input type="text" class="form-control" value="{{ $trabajador->numero_interno ?? 'N/A' }}" readonly>
                    </div>
                  </div>

                </div> <!-- Dirección -->
              </div> <!-- col-md-6 -->
            </div> <!-- row -->
          </div> <!-- card -->
        </div> <!-- col-lg-10 -->
      </div> <!-- row -->
    </div> <!-- container-fluid -->
  </main>
</x-layout>
