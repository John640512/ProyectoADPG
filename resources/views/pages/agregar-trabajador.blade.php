<x-layout bodyClass="g-sidenav-show bg-gray-200">
  <x-navbars.sidebar activePage="trabajador"/>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <x-navbars.navs.auth titlePage="Agregar Trabajador"/>
    <div class="container-fluid py-4">
      <div class="card mx-auto" style="max-width:600px">
        <div class="card-header">
          <h5>Datos personales</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('trabajador.detalles') }}" class="border border-dark rounded p-3 shadow-sm">
            @csrf

            <!-- Campos de datos personales -->
            @foreach([
              'nombre' => 'Nombre',
              'apellido_paterno' => 'Apellido Paterno',
              'apellido_materno' => 'Apellido Materno',
              'telefono' => 'Teléfono',
              'correo_electronico' => 'Correo Electrónico',
              'rfc' => 'RFC'
            ] as $name => $label)
              <div class="mb-3">
                <label class="form-label">{{ $label }} <span class="text-danger">*</span></label>
                <input type="{{ $name == 'correo_electronico' ? 'email' : 'text' }}"
                       name="{{ $name }}"
                       class="form-control border border-dark"
                       @if($name != 'rfc') required @endif
                       value="{{ old($name) }}">
                <!-- Muestra los errores de validación si los hay -->
                @error($name)
                    <div class="text-danger">{{ $message }}</div>
                @enderror
              </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Siguiente</button>
          </form>
        </div>
      </div>
    </div>
  </main>
</x-layout>