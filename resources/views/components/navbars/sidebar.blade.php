@props(['activePage'])

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white  opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/logo-adpg.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">ADPG</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Apartados</h6>
            </li>
            
            {{-- Producto --}}
            @if(in_array(auth()->user()->id_rol, [1, 2, 3, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? 'active bg-gray-600' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">inventory_2</i>
                    </div>
                    <span class="nav-link-text ms-1">Producto</span>
                </a>
            </li>
            @endif

            {{-- Stock --}}
            @if(in_array(auth()->user()->id_rol, [1, 2, 3, 4, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'stock' ? ' active bg-gray-600' : '' }} "
                    href="{{ route('stock') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">warehouse</i>
                    </div>
                    <span class="nav-link-text ms-1">Stock</span>
                </a>
            </li>
            @endif

            {{-- Proveedor --}}
            @if(in_array(auth()->user()->id_rol, [1, 4, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'proveedor' ? ' active bg-gray-600' : '' }} "
                    href="{{ route('proveedor.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">business</i>
                    </div>
                    <span class="nav-link-text ms-1">Proveedor</span>
                </a>
            </li>
            @endif

            {{-- Transporte --}}
            @if(in_array(auth()->user()->id_rol, [1, 4, 5, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'transporte' ? ' active bg-gray-600' : '' }} "
                    href="{{ route('transportes.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_shipping</i>
                    </div>
                    <span class="nav-link-text ms-1">Transporte</span>
                </a>
            </li>
            @endif

            {{-- Historial de Costos --}}
            @if(in_array(auth()->user()->id_rol, [1, 2, 6, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'costo' ? ' active bg-gray-600' : '' }}  "
                    href="{{ route('costo') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">request_quote</i>
                    </div>
                    <span class="nav-link-text ms-1">Historial del Costo</span>
                </a>
            </li>
            @endif

            {{-- Inventario --}}
            @if(in_array(auth()->user()->id_rol, [1, 2, 6, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'inventario' ? ' active bg-gray-600' : '' }} "
                    href="{{ route('inventario') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">inventory</i>
                    </div>
                    <span class="nav-link-text ms-1">Inventario</span>
                </a>
            </li>
            @endif

            {{-- Productos Entregados --}}
            @if(in_array(auth()->user()->id_rol, [1, 2, 3, 5, 6, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'entregados' ? ' active bg-gray-600' : '' }} "
                    href="{{ route('entregados') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">assignment_turned_in</i>
                    </div>
                    <span class="nav-link-text ms-1">Productos entregados</span>
                </a>
            </li>
            @endif

            {{-- Trabajador --}}
            @if(in_array(auth()->user()->id_rol, [1, 7, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'trabajador' ? ' active bg-gray-600' : '' }}  "
                    href="{{ route('trabajadores.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">badge</i>
                    </div>
                    <span class="nav-link-text ms-1">Trabajador</span>
                </a>
            </li>
            @endif

            {{-- Ubicación Entrega --}}
            @if(in_array(auth()->user()->id_rol, [1, 5, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'ubicacion_entrega' ? ' active bg-gray-600' : '' }}  "
                    href="{{ route('ubicacion_entrega') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">location_on</i>
                    </div>
                    <span class="nav-link-text ms-1">Ubicación Entrega</span>
                </a>
            </li>
            @endif

            {{-- Sección de Cuenta --}}
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Cuenta</h6>
            </li>

            {{-- Perfil --}}
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? 'active bg-gray-600' : '' }} "
                    href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">account_circle</i>
                    </div>
                    <span class="nav-link-text ms-1">Perfil</span>
                </a>
            </li>

            {{-- Usuarios (Solo Admin, RH y Auditor) --}}
            @if(in_array(auth()->user()->id_rol, [1, 7, 8]))
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'usuarios.index' ? ' active bg-gray-600' : '' }} "
                    href="{{ route('usuarios.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10">person_add</i>
                    </div>
                    <span class="nav-link-text ms-1">Usuarios</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</aside>