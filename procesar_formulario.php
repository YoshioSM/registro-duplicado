<?php
// <!-- Elaborado por Yoshio Soto Montes -->
// Conexión a la base de datos
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "test";

$conexion = mysqli_connect($host, $db_user, $db_pass, $db_name);

// Realizar la eliminación de registros antiguos
$sql_eliminar = "DELETE FROM registro WHERE fecha_registro < '$fecha_limite'";
if (mysqli_query($conexion, $sql_eliminar)) {
    echo "Registros antiguos eliminados correctamente.";
} else {
    echo "Error al intentar eliminar registros antiguos: " . mysqli_error($conexion);
}

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conexion, $_POST["nombre"]);
    $apellido_paterno = mysqli_real_escape_string($conexion, $_POST["apellido_paterno"]);
    $apellido_materno = mysqli_real_escape_string($conexion, $_POST["apellido_materno"]);
    $sucursal = $_POST["opciones1"];
    $agencia = $_POST["opciones2"];
    $clave = mysqli_real_escape_string($conexion, $_POST["clave"]);
    
    // Verificar si ya existe un registro con la misma clave (CURP)
    $verificacion = "SELECT COUNT(*) as count FROM registro WHERE clave = '$clave'";
    $result = mysqli_query($conexion, $verificacion);
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count > 0) {
        //Opcion por si esta duplicado
        header("Location: duplicado.html");
        die();
    } else {
        $sql = "INSERT INTO registro (nombre, apellido_paterno, apellido_materno, sucursal, agencia, clave, fecha_registro) 
                VALUES ('$nombre', '$apellido_paterno', '$apellido_materno', '$sucursal', '$agencia', '$clave', CURRENT_TIMESTAMP)";

        if (mysqli_query($conexion, $sql)) {
            header("Location: completado.html");
        die();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    }
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
