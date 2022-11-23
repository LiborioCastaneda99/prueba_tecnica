<?php
require_once "controlador/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();
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

    <link href="https://getbootstrap.com/docs/5.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

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
</head>

<body class="d-flex h-100 text-center text-bg-dark">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
            <div>
                <h3 class="float-md-start mb-0">Prueba práctica</h3>
                <nav class="nav nav-masthead justify-content-center float-md-end">
                    <a class="nav-link fw-bold py-1 px-0 active" aria-current="page" href="index.php">Inicio</a>
                    <a class="nav-link fw-bold py-1 px-0" href="historial.php">Historial</a>
                </nav>
            </div>
        </header>

        <h1>Open Weathermap</h1>

        <div class="mt-4">
            <div class="row">

                <?php
                $apiKey = "04ce435a675c4bd8033bbf164fcf2ba1";
                $cityId = ["Miami,US", "Orlando,US", "New York,US"];

                for ($i = 0; $i < count($cityId); $i++) {

                    $googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityId[$i] . "&lang=es&units=metric&APPID=" . $apiKey;
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_VERBOSE, 0);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $data = json_decode($response);
                    // echo json_encode($data);
                    $currentTime = time();
                    mysqli_query($conexion, "INSERT INTO informacionCiudades (nombreCiudad, pais, latitud, longitud, humedad, temperatura, viento) 
                    VALUES ('$data->name','{$data->sys->country}','{$data->coord->lat}','{$data->coord->lon}','{$data->main->humidity}','{$data->main->temp}','{$data->wind->speed}')");

                    echo "
                    <div class='col-md-4 mx-auto mr-auto'>
                        <h2>
                            " . $data->name . " - " . $data->sys->country . "
                        </h2>
                        <div class='time'>
                            <div>
                                " . date('l g:i a', $currentTime) . "   
                            </div>
                            <div>
                                " . date('jS F, Y', $currentTime) . "
                            </div>
                            <div>
                            " . ucwords($data->weather[0]->description) . "
                            </div>
                        </div>
                        <div class='weather-forecast'>
                            <img src='http://openweathermap.org/img/w/" . $data->weather[0]->icon . ".png' class='weather-icon' /><br>
                            Temperatura actual:  " . $data->main->temp . "°C <br>
                                Temperatura min: " . $data->main->temp_max . "°C <br>
                                    Temperatura max:
                                    " . $data->main->temp_min . "°C
                        </div>
                        <div class='time'>
                            <div>Humedad:
                                " . $data->main->humidity . " %
                            </div>
                            <div>Viento:
                                " . $data->wind->speed . " km/h
                            </div>
                        </div>
                    </div>";
                }

                ?>
            </div>
        </div>

        <footer class="mt-auto text-white-50">
            <p>Desarrollado por <a href="#" class="text-white">Liborio Castañeda</a></p>
        </footer>
    </div>



</body>

</html>