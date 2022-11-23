<?php

require_once "controlador/conexion.php";
$obj = new conectar();
$conexion = $obj->conexion();

// Listamos las direcciones con todos sus datos (lat, lng, dirección, etc.)
$result = mysqli_query($conexion, "SELECT * FROM informacionCiudades order by id desc limit 3");

// Seleccionamos los datos para crear los marcadores en el Mapa de Google serian direccion, lat y lng 
while ($row = mysqli_fetch_array($result)) {
    echo '["' . $row['nombreCiudad'] . ', ' . $row['pais'] . '", ' . $row['latitud'] . ', ' . $row['longitud'] . ', ' . $row['humedad'] . ', ' . $row['temperatura'] . '],';
}
?>