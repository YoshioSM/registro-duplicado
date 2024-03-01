<!DOCTYPE html>
<html>
<head>
    <title>Registros de la Base de Datos</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/5.2.0/js/tableexport.min.js"></script>

</head>
<body>
    <h1 class="text-3xl font-bold my-4">Registros de la Base de Datos</h1>
    
    <?php
    // Conexión a la base de datos (código que ya proporcionaste)
    $host = "localhost:3306";
	$db_user = "halzacom_formulario";
	$db_pass = "Halza.1234";
	$db_name = "halzacom_formulario";
    $conexion = mysqli_connect($host, $db_user, $db_pass, $db_name);

    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta para obtener los registros
    $query = "SELECT * FROM registro";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table-auto w-full'>";
        echo "<thead><tr><th class='px-4 py-2'>Nombre</th><th class='px-4 py-2'>Apellido Paterno</th><th class='px-4 py-2'>Apellido Materno</th><th class='px-4 py-2'>Sucursal</th><th class='px-4 py-2'>Agencia</th><th class='px-4 py-2'>Clave</th><th class='px-4 py-2'>Fecha de Registro</th></tr></thead>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='border px-4 py-2'>" . $row["nombre"] . "</td>";
            echo "<td class='border px-4 py-2'>" . $row["apellido_paterno"] . "</td>";
            echo "<td class='border px-4 py-2'>" . $row["apellido_materno"] . "</td>";
            echo "<td class='border px-4 py-2'>" . $row["sucursal"] . "</td>";
            echo "<td class='border px-4 py-2'>" . $row["agencia"] . "</td>";
            echo "<td class='border px-4 py-2'>" . $row["clave"] . "</td>";
            echo "<td class='border px-4 py-2'>" . $row["fecha_registro"] . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "No hay registros en la base de datos.";
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
    ?>
    
</body>
</html>


