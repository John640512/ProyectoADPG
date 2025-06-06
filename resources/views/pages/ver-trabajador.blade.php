<!-- resources/views/pages/ver-trabajador.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Trabajador</h1>

    <div class="card">
        <div class="card-body">
            <!-- Nombre completo -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" class="form-control" value="{{ $trabajador->nombre }}" readonly>
            </div>

            <div class="mb-3">
                <label for="apellido_paterno" class="form-label">Apellido Paterno:</label>
                <input type="text" id="apellido_paterno" class="form-control" value="{{ $trabajador->apellido_paterno }}" readonly>
            </div>

            <div class="mb-3">
                <label for="apellido_materno" class="form-label">Apellido Materno:</label>
                <input type="text" id="apellido_materno" class="form-control" value="{{ $trabajador->apellido_materno }}" readonly>
            </div>

            <!-- Información de contacto -->
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" id="telefono" class="form-control" value="{{ $trabajador->telefono }}" readonly>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" id="correo" class="form-control" value="{{ $trabajador->correo }}" readonly>
            </div>

            <!-- RFC -->
            <div class="mb-3">
                <label for="rfc" class="form-label">RFC:</label>
                <input type="text" id="rfc" class="form-control" value="{{ $trabajador->rfc }}" readonly>
            </div>

            <!-- Dirección -->
            <h4 class="mt-4">Dirección</h4>

            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <input type="text" id="estado" class="form-control" value="{{ $trabajador->estado }}" readonly>
            </div>

            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad:</label>
                <input type="text" id="ciudad" class="form-control" value="{{ $trabajador->ciudad }}" readonly>
            </div>

            <div class="mb-3">
                <label for="municipio" class="form-label">Municipio:</label>
                <input type="text" id="municipio" class="form-control" value="{{ $trabajador->municipio }}" readonly>
            </div>

            <div class="mb-3">
                <label for="calle" class="form-label">Calle:</label>
                <input type="text" id="calle" class="form-control" value="{{ $trabajador->calle }}" readonly>
            </div>

            <div class="mb-3">
                <label for="entre_calles" class="form-label">Entre Calles:</label>
                <input type="text" id="entre_calles" class="form-control" value="{{ $trabajador->entre_calles }}" readonly>
            </div>

            <div class="mb-3">
                <label for="colonia" class="form-label">Colonia:</label>
                <input type="text" id="colonia" class="form-control" value="{{ $trabajador->colonia }}" readonly>
            </div>

            <div class="mb-3">
                <label for="codigo_postal" class="form-label">Código Postal:</label>
                <input type="text" id="codigo_postal" class="form-control" value="{{ $trabajador->codigo_postal }}" readonly>
            </div>

            <div class="mb-3">
                <label for="numero_externo" class="form-label">Número Externo:</label>
                <input type="text" id="numero_externo" class="form-control" value="{{ $trabajador->numero_externo }}" readonly>
            </div>

            <div class="mb-3">
                <label for="numero_interno" class="form-label">Número Interno:</label>
                <input type="text" id="numero_interno" class="form-control" value="{{ $trabajador->numero_interno }}" readonly>
            </div>

            <!-- Botón para regresar -->
            <a href="{{ route('trabajador') }}" class="btn btn-secondary mt-3">Regresar</a>
        </div>
    </div>
</div>
@endsection
