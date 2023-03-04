<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("paginaPrincipalCss/paginaPrincipal.Css?1.0")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <title>Pagina principal Tablas</title>
</head>
<body>
    <nav>
        <ul>
          <li><a href="{{route("paginaPrincipal")}}">Inicio</a></li>
          <li><a href="{{route("formRegistrarUsuario2", ['valor' => $tipoPago])}}">Registrar usuario</a></li>
          <li class="search">
            <form action="{{route("tablaClientes")}}" method="GET">
              @csrf
              <input type="text" name="txtBuscar" value="{{$txtBuscar}}" placeholder="Buscar por nombre...">
              <input type="hidden" name="tipoPago" value="{{$tipoPago}}">
              <button style="color: black" type="submit"><i class="fa fa-search"></i></button>
            </form>
          </li>
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

      <h1>Tabla Clientes {{$tipoPago}}</h1>


      <div class="table-container">
        <div class="table-responsive">
          @foreach ($usuarios as $item)
          @if ($item->metodoPago == $tipoPago)
          <select class="my-select">
            <option disabled selected>{{$item->nombre}}</option>
            <option disabled>Teléfono: {{$item->telefono}}</option>
            <option disabled>Prestamo: {{$item->prestamo}}</option>
            <option disabled>Saldo inicial: {{$item->saldo}}</option>
            <option disabled>Saldo actual: {{$item->saldoRebajado}}</option>
            <option disabled>Metodo de pago: {{$item->metodoPago}}</option>
            <table>
          </select>
          <table>
            <tr>
                <td>
                  <form action="{{route("aplicarAbono")}}" method="GET">
                      @csrf
                      <input type="hidden" name="id" value="{{$item->id}}">
                      <button class="btnAbonar" type="submit">Aplicar abono</button>
                    </form>
                </td>
                <td>
                  <form action="{{route("actualizarUsuario")}}" method="GET">
                    @csrf
                    <button class="btnActualizar" type="submit">Editar</button>
                    <input type="hidden" value="{{$item->id}}" name="id">
                  </form>
              </td>
                <td>
                  <form id="eliminarUsuarioForm" action="{{route("eliminarUsuario")}}" method="POST">
                    @method("delete")
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="id">
                    <button class="btnEliminar" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')">Eliminar</button>
                  </form>
              </td>
                <td colspan="2">
                  <form action="{{route("prestamoDeudaForm")}}" method="GET">
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="id">
                    <button class="btnPrestamoDeuda" type="submit">Solicitar un prestamo con deuda</button>
                  </form>
              </td>
            </tr>
          </table>
          @endif
          @endforeach
      <div>
    </div>
    
</body>
</html>