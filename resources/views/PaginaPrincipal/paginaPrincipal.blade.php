<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("paginaPrincipalCss/paginaPrincipal.Css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <title>Pagina principal</title>
</head>
<body>
    <nav>
        <ul>
          <li><a href="{{route("paginaPrincipal")}}">Inicio</a></li>
          <li><a href="{{route("formRegistrarUsuario")}}">Registrar usuario</a></li>
          <form action="{{route("deslogueo")}}" method="POST">
            @csrf
            <li><a href="#" onclick="this.closest('form').submit()">Cerrar Sesión</a></li>
          </form>
        </ul>
      </nav>
      <br>
      {{session("guardadoCorrectamente")}}
      {{session("eliminadoCorrectamente")}}
      {{session("actualizadoCorrectamente")}}

      <br><br>
      <label for="total">Clientes</label>
      <input id="total-input" type="text" value="{{$clientes}}" readonly>
      <br><br>
      <label for="total">Total a cobrar a clientes</label>
      <input id="total-input" type="text" value="₡{{$sumaAcobrar}}" readonly>

      <br><br>


      <div class="container">
        <a href="{{route("tablaClientes", ['valor' => "Diario"])}}">
          <button class="btnActualizar">
            <h3>Clientes de pago Diario</h3>
          </button>
        </a>

        <br><br>
      
        <a href="{{route("tablaClientes", ['valor' => "Semanal"])}}">
          <button class="btnActualizar">
            <h3>Clientes de pago Semanal</h3>
          </button>
        </a>
        <br><br>

        <a href="{{route("tablaClientes", ['valor' => "Quincenal"])}}">
          <button class="btnActualizar">
            <h3>Clientes de pago Quincenal</h3>
          </button>
        </a>
        <br><br>

        <a href="{{route("tablaClientes", ['valor' => "Mensual"])}}">
          <button class="btnActualizar">
            <h3>Clientes de pago Mensual</h3>
          </button>
        </a>
      </div>

</body>
</html>