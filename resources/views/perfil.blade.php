<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>

    <div>
        <h1>Bienvenidos</h1>
    </div>

    <div>
        <h2>Ingresa tus datos personales</h2>
    </div>

    <div>
        <form action="post">

            <label for="name">Nombre</label>
            <input type="text" class="name" name="name" id="name">
            <br><br>

            <label for="lastName">Apellidos</label>
            <input type="text" class="lastName" name="lastName" id="lastName">
            <br><br>

            <label for="email">Correo Electronico</label>
            <input type="email" class="email" name="email" id="email" placeholder="example@gamil.com">
            <br><br>

            <label for="telefono">Numero de Telefono</label>
            <input type="tel" class="telefono" name="telefono" id="telefono">
            <br><br>
        </form>
        
        <button type="button" class="btn btn-primary">Guardar Datos </button>
        <br><br>
    </div>

    <a href="{{ route('inicio') }}">Ir a Inicio</a>
</body>
</html>