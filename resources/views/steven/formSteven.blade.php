<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Steven</title>
</head>

<body>

    <h1>Ahorro programado</h1>
    <div style="height: 50px"></div>


    @php
        $montoOperacionCuadros = 0;
        $montoAhorroEmergencia = 0;
        $montoAhorroRopa = 0;
        $montoAhorroSiempre = 0;
        $montoAhorroAutoNuevo = 0;
        $montoAhorroCompraLote = 0;
        $montoAhorroBici = 0;
        $montoAhorroMantAuto = 0;
        $montoAhorroMarchamo = 0;
    @endphp

    @foreach ($ahorros as $item)
        @if ($item->tipoAhorro == 'opeCuadros')
            @php
                $montoOperacionCuadros += $item->monto;
            @endphp
        @elseif ($item->tipoAhorro == 'ahorroEmerg')
            @php
                $montoAhorroEmergencia = $item->monto;
            @endphp
        @elseif ($item->tipoAhorro == 'ropa')
            @php
                $montoAhorroRopa = $item->monto;
            @endphp
        @elseif ($item->tipoAhorro == 'ahorroSiempre')
            @php
                $montoAhorroSiempre = $item->monto;
            @endphp
        @elseif ($item->tipoAhorro == 'autoNuevo')
            @php
                $montoAhorroAutoNuevo = $item->monto;
            @endphp
        @elseif ($item->tipoAhorro == 'compraLote')
            @php
                $montoAhorroCompraLote = $item->monto;
            @endphp
        @elseif ($item->tipoAhorro == 'bici')
            @php
                $montoAhorroBici = $item->monto;
            @endphp
        @elseif ($item->tipoAhorro == 'mantAuto')
            @php
                $montoAhorroMantAuto = $item->monto;
            @endphp
        @elseif ($item->tipoAhorro == 'marchamos')
            @php
                $montoAhorroMarchamo = $item->monto;
            @endphp
        @endif
    @endforeach




    <!-- Section 1 -->
    <form id="aplicarAbonoOpeCuadros" action="{{ route('storeAplicarAbonoOpeCuadros') }}" method="GET">
        <div class="form-floating mb-3">
            <input type="hidden" value="opeCuadros" name="tipoAhorro">
            <input id="inputLimpiarAbonoCuadros" style="width: 40%" type="text" class="form-control"
                id="floatingInput" placeholder="name@example.com" name="opeCuadros">
            <label for="floatingInput">Operacion cuadros</label>
            <label id="montoOperacionCuadros" style="padding-left: 200px">₡{{ $montoOperacionCuadros }}</label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>

    <!-- Section 2 -->
    <form id="aplicarAbonoAhorroEmergencia" action="{{ route('storeAplicarAhorroEmergencia') }}" method="GET">

        <input type="hidden" value="ahorroEmerg" name="tipoAhorro">
        <div class="form-floating mb-3">
            <input id="inputLimpiarAbonoAhorroEmergencia" style="width: 40%" type="text" class="form-control"
                id="floatingInput" placeholder="name@example.com" name="ahorroEmerg">
            <label for="floatingInput">Ahorro emergencia</label>
            <label id="montoAhorroEmergencia" style="padding-left: 200px">₡{{ $montoAhorroEmergencia }} </label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>

    <!-- Section 3 -->
    <form id="aplicarAbonoAhorroRopa" action="{{ route('storeAplicarAhorroRopa') }}" method="GET">

        <input type="hidden" value="ropa" name="tipoAhorro">
        <div class="form-floating mb-3">
            <input id="inputLimpiarAbonoAhorroRopa" style="width: 40%" type="text" class="form-control"
                id="floatingInput" placeholder="name@example.com" name="ropa">
            <label for="floatingInput">Ropa</label>
            <label id="montoAhorroRopa" style="padding-left: 200px">₡{{ $montoAhorroRopa }} </label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>

    <!-- Section 4 -->
    <form id="aplicarAbonoAhorroSiempre" action="{{ route('storeAplicarAhorroSiempre') }}" method="GET">

        <input type="hidden" value="ahorroSiempre" name="tipoAhorro">
        <div class="form-floating mb-3">
            <input id="inputLimpiarAbonoAhorroSiempre" style="width: 40%" type="text" class="form-control"
                id="floatingInput" placeholder="name@example.com" name="ahorroSiempre">
            <label for="floatingInput">Ahorro siempre</label>
            <label id="montoAhorroSiempre" style="padding-left: 200px">₡{{ $montoAhorroSiempre }} </label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>

    <!-- Section 5 -->
    <form id="aplicarAbonoAhorroAutoNuevo" action="{{ route('storeAplicarAhorroAutoNuevo') }}" method="GET">

        <input type="hidden" value="autoNuevo" name="tipoAhorro">
        <div class="form-floating mb-3">
            <input id="inputLimpiarAbonoAutoNuevo" style="width: 40%" type="text" class="form-control" id="floatingInput"
                placeholder="name@example.com" name="autoNuevo">
            <label for="floatingInput">Auto nuevo</label>
            <label id="montoAhorroAutoNuevo" style="padding-left: 200px">₡{{ $montoAhorroAutoNuevo }} </label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>
    <!-- Section 6 -->
    <form id="aplicarAbonoAhorroCompraLote" action="{{ route('storeAplicarAhorroCompraLote') }}" method="GET">

        <input type="hidden" value="compraLote" name="tipoAhorro">
        <div class="form-floating mb-3">
            <input id="inputLimpiarAbonoCompraLote" style="width: 40%" type="text" class="form-control" id="floatingInput"
                placeholder="name@example.com" name="compraLote">
            <label for="floatingInput">Compra lote</label>
            <label id="montoAhorroCompraLote" style="padding-left: 200px">₡{{ $montoAhorroCompraLote }} </label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>
    <!-- Section 7 -->
    <form id="aplicarAbonoAhorroBici" action="{{ route('storeAplicarAhorroBici') }}" method="GET">

        <input type="hidden" value="bici" name="tipoAhorro">
        <div class="form-floating mb-3">
            <input id="inputLimpiarAbonoBici" style="width: 40%" type="text" class="form-control" id="floatingInput"
                placeholder="name@example.com" name="bici">
            <label for="floatingInput">Bicicleta</label>
            <label id="montoAhorroBici" style="padding-left: 200px">₡{{ $montoAhorroBici }} </label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>

    <!-- Section 8 -->
    <form id="aplicarAbonoAhorroMantAuto" action="{{ route('storeAplicarMantAuto') }}" method="GET">

        <input type="hidden" value="mantAuto" name="tipoAhorro">
        <div class="form-floating mb-3">
            <input id="inputLimpiarAbonoMantAuto" style="width: 40%" type="text" class="form-control" id="floatingInput"
                placeholder="name@example.com" name="mantAuto">
            <label for="floatingInput">Mantenimiento del auto</label>
            <label id="montoAhorroMantAuto" style="padding-left: 200px">₡{{ $montoAhorroMantAuto }} </label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>

    <!-- Section 9 -->
    <form id="aplicarAbonoAhorroMarchamo" action="{{ route('storeAplicarMarchamo') }}" method="GET">

        <input type="hidden" value="marchamos" name="tipoAhorro">
        <div class="form-floating mb-3">
            <input id="inputLimpiarAbonoMarchamo" style="width: 40%" type="text" class="form-control" id="floatingInput"
                placeholder="name@example.com" name="marchamo">
            <label for="floatingInput">Marchamo</label>
            <label id="montoAhorroMarchamo" style="padding-left: 200px">₡{{ $montoAhorroMarchamo }} </label>
        </div>
        <div>
            <input type="submit" value="Aplicar abono" class="btn btn-success">
        </div>
        <div style="height: 50px"></div>
    </form>
</body>


<script>
    //script section 1
    $(document).ready(function() {
        $("#aplicarAbonoOpeCuadros").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor

            var tipoAhorro;
            var opeCuadros;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'opeCuadros') {
                    opeCuadros = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarAbonoOpeCuadros",
                data: {
                    tipoAhorro: tipoAhorro,
                    opeCuadros: opeCuadros,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoOperacionCuadrosLabel = document.getElementById(
                        "montoOperacionCuadros");
                    montoOperacionCuadrosLabel.innerText = response;

                    var inputLimpiarAbonoCuadros = document.getElementById(
                        "inputLimpiarAbonoCuadros");
                    inputLimpiarAbonoCuadros.value = "";
                }
            });
        });
    });
</script>
<script>
    //script section 2
    $(document).ready(function() {
        $("#aplicarAbonoAhorroEmergencia").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor


            console.log(formData);
            var tipoAhorro;
            var ahorroEmergencia;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'ahorroEmerg') {
                    ahorroEmergencia = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarAhorroEmergencia",
                data: {
                    tipoAhorro: tipoAhorro,
                    ahorroEmergencia: ahorroEmergencia,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoAhorroEmergencia = document.getElementById(
                        "montoAhorroEmergencia");
                    montoAhorroEmergencia.innerText = response;

                    var inputLimpiarAbonoAhorroEmergencia = document.getElementById(
                        "inputLimpiarAbonoAhorroEmergencia");
                    inputLimpiarAbonoAhorroEmergencia.value = "";
                }
            });
        });
    });
</script>
<script>
    //script section 3
    $(document).ready(function() {
        $("#aplicarAbonoAhorroRopa").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor


            console.log(formData);
            var tipoAhorro;
            var ahorroRopa;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'ropa') {
                    ahorroRopa = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarAhorroRopa",
                data: {
                    tipoAhorro: tipoAhorro,
                    ahorroRopa: ahorroRopa,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoAhorroRopa = document.getElementById("montoAhorroRopa");
                    montoAhorroRopa.innerText = response;

                    var inputLimpiarAbonoAhorroRopa = document.getElementById(
                        "inputLimpiarAbonoAhorroRopa");
                    inputLimpiarAbonoAhorroRopa.value = "";
                }
            });
        });
    });
</script>
<script>
    //script section 4
    $(document).ready(function() {
        $("#aplicarAbonoAhorroSiempre").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor


            console.log(formData);
            var tipoAhorro;
            var ahorroSiempre;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'ahorroSiempre') {
                    ahorroSiempre = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarAhorroSiempre",
                data: {
                    tipoAhorro: tipoAhorro,
                    ahorroSiempre: ahorroSiempre,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoAhorroSiempre = document.getElementById("montoAhorroSiempre");
                    montoAhorroSiempre.innerText = response;

                    var inputLimpiarAbonoAhorroSiempre = document.getElementById(
                        "inputLimpiarAbonoAhorroSiempre");
                        inputLimpiarAbonoAhorroSiempre.value = "";
                }
            });
        });
    });
</script>
<script>
    //script section 5
    $(document).ready(function() {
        $("#aplicarAbonoAhorroAutoNuevo").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor


            console.log(formData);
            var tipoAhorro;
            var ahorroAutoNuevo;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'autoNuevo') {
                    ahorroAutoNuevo = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarAhorroAutoNuevo",
                data: {
                    tipoAhorro: tipoAhorro,
                    ahorroAutoNuevo: ahorroAutoNuevo,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoAhorroAutoNuevo = document.getElementById("montoAhorroAutoNuevo");
                    montoAhorroAutoNuevo.innerText = response;

                    var inputLimpiarAbonoAutoNuevo = document.getElementById(
                        "inputLimpiarAbonoAutoNuevo");
                        inputLimpiarAbonoAutoNuevo.value = "";
                }
            });
        });
    });
</script>
<script>
    //script section 6
    $(document).ready(function() {
        $("#aplicarAbonoAhorroCompraLote").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor


            console.log(formData);
            var tipoAhorro;
            var ahorroCompraLote;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'compraLote') {
                    ahorroCompraLote = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarAhorroCompraLote",
                data: {
                    tipoAhorro: tipoAhorro,
                    ahorroCompraLote: ahorroCompraLote,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoAhorroCompraLote = document.getElementById("montoAhorroCompraLote");
                    montoAhorroCompraLote.innerText = response;

                    var inputLimpiarAbonoCompraLote = document.getElementById(
                        "inputLimpiarAbonoCompraLote");
                        inputLimpiarAbonoCompraLote.value = "";
                }
            });
        });
    });
</script>
<script>
    //script section 7
    $(document).ready(function() {
        $("#aplicarAbonoAhorroBici").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor


            console.log(formData);
            var tipoAhorro;
            var ahorroBici;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'bici') {
                    ahorroBici = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarAhorroBici",
                data: {
                    tipoAhorro: tipoAhorro,
                    ahorroBici: ahorroBici,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoAhorroBici = document.getElementById("montoAhorroBici");
                    montoAhorroBici.innerText = response;

                    var inputLimpiarAbonoBici = document.getElementById(
                        "inputLimpiarAbonoBici");
                        inputLimpiarAbonoBici.value = "";
                }
            });
        });
    });
</script>
<script>
    //script section 8
    $(document).ready(function() {
        $("#aplicarAbonoAhorroMantAuto").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor


            console.log(formData);
            var tipoAhorro;
            var ahorroMantAuto;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'mantAuto') {
                    ahorroMantAuto = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarMantAuto",
                data: {
                    tipoAhorro: tipoAhorro,
                    ahorroMantAuto: ahorroMantAuto,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoAhorroMantAuto = document.getElementById("montoAhorroMantAuto");
                    montoAhorroMantAuto.innerText = response;

                    var inputLimpiarAbonoMantAuto = document.getElementById(
                        "inputLimpiarAbonoMantAuto");
                        inputLimpiarAbonoMantAuto.value = "";
                }
            });
        });
    });
</script>


<script>
    //script section 9
    $(document).ready(function() {
        $("#aplicarAbonoAhorroMarchamo").submit(function(event) {
            event.preventDefault(); // Evita la acción de envío por defecto del formulario

            var formData = $(this).serialize();
            var formDataArray = formData.split(
            '&'); // Dividir la cadena en un array de pares clave=valor


            console.log(formData);
            var tipoAhorro;
            var ahorroMarchamo;

            // Recorrer el array y buscar los valores que deseas
            for (var i = 0; i < formDataArray.length; i++) {
                var pair = formDataArray[i].split('=');
                if (pair[0] === 'tipoAhorro') {
                    tipoAhorro = pair[1];
                } else if (pair[0] === 'marchamo') {
                    ahorroMarchamo = pair[1];
                }
            }
            // Realiza la solicitud AJAX
            $.ajax({
                type: "GET",
                url: "http://54.175.133.168/storeAplicarMarchamo",
                data: {
                    tipoAhorro: tipoAhorro,
                    ahorroMarchamo: ahorroMarchamo,
                },
                //los parametros enviados
                dataType: 'json',
                success: function(response) {
                    var montoAhorroMarchamo = document.getElementById("montoAhorroMarchamo");
                    montoAhorroMarchamo.innerText = response;

                    var inputLimpiarAbonoMarchamo = document.getElementById(
                        "inputLimpiarAbonoMarchamo");
                        inputLimpiarAbonoMarchamo.value = "";
                }
            });
        });
    });
</script>

</html>
