<?php

require_once "controlador/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

$tildes = $conexion->query("SET NAMES 'utf8'");
$sql = "SELECT id, nombreCiudad, pais, latitud, longitud, humedad, temperatura, viento, fechaRegistro FROM informacionCiudades WHERE 1";
$result = mysqli_query($conexion, $sql);

?>

<!doctype html>
<html lang="es" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Liborio Castañeda">
    <title>Prueba Practica - Liborio Castañeda</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/cover/">

    <!-- Favicons -->
    <link rel="shortcut icon"
        href="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/icons/favicon.ico" />
    <link rel="icon" href="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/icons/logo_16x16.png"
        sizes="16x16" type="image/png">
    <link rel="icon" href="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/icons/logo_32x32.png"
        sizes="32x32" type="image/png">
    <link rel="icon" href="https://openweathermap.org/themes/openweathermap/assets/vendor/owm/img/icons/logo_60x60.png"
        sizes="60x60" type="image/png">
    <meta name="theme-color" content="#712cf9">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .cover-container {
            max-width: 80% !important;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.2/examples/cover/cover.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link href="https://getbootstrap.com/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


</head>

<body class="d-flex h-100 text-center text-bg-white">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Historial - Prueba Tecnica</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0 text-dark" aria-current="page" href="index.php">Inicio</a>
                    <a class="nav-link fw-bold py-1 px-0 text-dark active" href="historial.php">Historial</a>
                </nav>
            </div>
        </header>

        <h1>Open Weathermap Historial</h1>

        <div class="mt-4">
            <table id="respHistorial" class="display bg-dark text-white">
                <thead>
                    <tr>
                        <th>Ciudad</th>
                        <th>País</th>
                        <th>Latitud</th>
                        <th>Longitud</th>
                        <th>Humedad</th>
                        <th>Temperatura</th>
                        <th>Viento</th>
                        <th>Fecha registro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td>
                            <?= $row['nombreCiudad'] ?>
                        </td>
                        <td>
                            <?= $row['pais'] ?>
                        </td>
                        <td>
                            <?= $row['latitud'] ?>
                        </td>
                        <td>
                            <?= $row['longitud'] ?>
                        </td>
                        <td>
                            <?= $row['humedad'] ?>
                        </td>
                        <td>
                            <?= $row['temperatura'] ?>
                        </td>
                        <td>
                            <?= $row['viento'] ?>
                        </td>
                        <td>
                            <?= $row['fechaRegistro'] ?>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <footer class="mt-auto text-dark-50">
            <p>Desarrollado por <a href="#" class="text-dark">Liborio Castañeda</a></p>
        </footer>
    </div>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>

</html>
<script type="text/javascript">
    var table = $('#respHistorial').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 de 0 de 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total Registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });
</script>