<x-layout bodyClass="g-sidenav-show bg-gray-200">
  <x-navbars.sidebar activePage="trabajador"/>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <x-navbars.navs.auth titlePage="Detalles del trabajador"/>
    <div class="container-fluid py-4">
      <div class="card mx-auto" style="max-width:600px">
        <div class="card-header d-flex justify-content-between">
          <h5>Dirección del trabajador</h5>
          <a href="{{ route('agregar-trabajador') }}" class="btn btn-outline-secondary btn-sm">
            <i class="material-icons">arrow_back</i> Anterior
          </a>
        </div>
        <div class="card-body">
        <form id="step2" method="POST" action="{{ route('guardar-trabajador') }}">
          @csrf
          {{-- Campos ocultos para los datos personales del paso 1 --}}
@foreach([
  'nombre',
  'apellido_paterno',
  'apellido_materno',
  'telefono',
  'correo_electronico',
  'rfc'
] as $campo)
  <input type="hidden" name="{{ $campo }}" value="{{ request($campo) }}">
@endforeach


          {{-- Campos de dirección --}}
          @foreach([
            'estado' => 'Estado',
            'ciudad' => 'Ciudad',
            'municipio' => 'Municipio',
            'calle' => 'Calle',
            'entre_calles' => 'Entre Calles',
            'colonia' => 'Colonia',
            'cp' => 'Código Postal',  
            'numero_externo' => 'Número Externo',
            'numero_interno' => 'Número Interno (opcional)',
          ] as $name => $label)
            <div class="mb-3">
              <label class="form-label">{{ $label }} @if($name != 'numero_interno')<span class="text-danger">*</span>@endif</label>
              <input type="text"
                     name="{{ $name }}"
                     class="form-control border border-dark"
                     @if($name != 'numero_interno') required @endif
                     @if($name == 'cp') maxlength="5" pattern="\d{5}" placeholder="Ej. 12345" @endif>
            </div>
          @endforeach

          <button type="submit" class="btn btn-success">Guardar</button>
        </form>
        </div>
      </div>
    </div>
  </main>
</x-layout>
