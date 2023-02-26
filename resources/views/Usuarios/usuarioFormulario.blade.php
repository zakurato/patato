<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("usuariosCss/usuarioFormulario.Css?1.0")}}">
    <title>Formulario crear usuario</title>
</head>
<body>
    <nav>
        <ul>
          <li><a href="{{route("paginaPrincipal")}}">Inicio</a></li>
        </ul>
      </nav>
      <br>
      {{session("usuarioExiste")}}
      <br>
      <h1>Formulario de préstamos</h1>
      <form action="{{route("storeUsuario")}}" method="POST">
        @csrf


        <label for="cedula">Cédula:</label>
        <input type="text" name="cedula" value="{{old('cedula')}}" required>
        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" value="{{old('nombre')}}" required>
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" value="{{old("telefono")}}" required>
        <label for="direccion">Dirección:</label>
        <textarea id="direccion" name="direccion" rows="4" required>{{old("direccion")}}</textarea>
        <label for="prestamo">Préstamo:</label>
        <input type="number" name="prestamo" value="{{old("prestamo")}}" required>
        <label for="intereses">Digite el % en intereses ganados:</label>
        <input type="number" name="intereses" value="{{old("intereses")}}" required>
        <label for="periodo">Selecciona el metodo de pago:</label>
        <select name="metodoPago" required>
          <option value="{{old("metodoPago")}}">{{old("metodoPago")}}</option>
          <option value="Dia">Día</option>
          <option value="Semana">Semana</option>
          <option value="Quincena">Quincena</option>
          <option value="Mes">Mes</option>
        </select>
        <br><br>
        <input type="submit" value="Guardar">
      </form>
</body>
</html>