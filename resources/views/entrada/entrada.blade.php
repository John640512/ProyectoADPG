<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADPG - Inventario</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/entrada.css') }}" rel="stylesheet">
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop id="bgVideo">
            <!-- Los videos se cargarán dinámicamente con JavaScript -->
        </video>
    </div>
    
    <div class="content">
        <h5 class="welcome">Bienvenido</h5>
        <h1 class="logo">ADPG</h1>
        <a href="{{ route('login') }}" class="ingresar-btn">Ingresar</a>
    </div>

    <script src="{{ asset('assets/js/entrada.js') }}"></script>
</body>
</html>