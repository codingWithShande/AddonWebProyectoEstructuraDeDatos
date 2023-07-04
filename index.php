<!DOCTYPE html>
<html>
<head>
    <title>Registros de Hotel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        th {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registros de Hotel</h1>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>DNI</th>
                <th>Ingreso</th>
                <th>Salida</th>
                <th>Pago</th>
                <th>Descripción</th>
                <th>Habitación</th>
            </tr>
            <?php
                // Configuración de la conexión a la base de datos
                $servername = "194.156.91.77";
                $username = "hotel";
                $password = "admin@hotel";
                $database = "registros_hotel";
                
                // Crear conexión
                $conn = new mysqli($servername, $username, $password, $database);
                
                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }
                
                // Función para actualizar el contador de visitas
                function actualizarContadorVisitas($conexion) {
                    $sqlConsulta = "SELECT count FROM contador_visitas WHERE id = 1";
                    $resultadoConsulta = $conexion->query($sqlConsulta);
                
                    if ($resultadoConsulta->num_rows > 0) {
                        $fila = $resultadoConsulta->fetch_assoc();
                        $nuevoRecuento = $fila['count'] + 1;
                        $sqlActualizar = "UPDATE contador_visitas SET count = $nuevoRecuento WHERE id = 1";
                        $conexion->query($sqlActualizar);
                    } else {
                        $sqlInsertar = "INSERT INTO contador_visitas (id, count) VALUES (1, 1)";
                        $conexion->query($sqlInsertar);
                    }
                }
                
                // Actualizar el contador de visitas
                actualizarContadorVisitas($conn);
                
                // Consulta para obtener los datos de la tabla registros_hotel
                $sql = "SELECT * FROM registros_hotel";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // Mostrar los datos en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['nombre']."</td>";
                        echo "<td>".$row['apellidos']."</td>";
                        echo "<td>".$row['dni']."</td>";
                        echo "<td>".$row['ingreso']."</td>";
                        echo "<td>".$row['salida']."</td>";
                        echo "<td>".$row['pago']."</td>";
                        echo "<td>".$row['descripcion']."</td>";
                        echo "<td>".$row['habitacion']."</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No se encontraron registros</td></tr>";
                }
                
                // Cerrar la conexión
                $conn->close();
            ?>
        </table>
    </div>
    <div style="text-align: center; margin-top: 20px;">
    <strong>VISITAS: </strong>
    <?php
        // Crear una nueva conexión para obtener y actualizar el recuento de visitas
        $connContador = new mysqli('194.156.91.77', 'hotel', 'admin@hotel', 'contador_visitas');
        
        // Verificar la conexión
        if ($connContador->connect_error) {
            die("Conexión fallida: " . $connContador->connect_error);
        }
        
        // Consulta el recuento de visitas y lo actualiza
        $sqlConsulta = "SELECT count FROM contador_visitas WHERE id = 1";
        $resultadoConsulta = $connContador->query($sqlConsulta);
        
        if ($resultadoConsulta->num_rows > 0) {
            // Si hay un registro, obtén el recuento de visitas actual
            $fila = $resultadoConsulta->fetch_assoc();
            $recuento = $fila['count'];
            $recuento++; // Incrementa el recuento de visitas en 1
        
            // Actualiza el recuento de visitas en la base de datos
            $sqlActualizacion = "UPDATE contador_visitas SET count = $recuento WHERE id = 1";
            $connContador->query($sqlActualizacion);
        
            // Muestra el recuento de visitas actualizado
            echo $recuento;
        } else {
            // Si no hay registros, muestra 0 visitas y crea un nuevo registro en la base de datos
            $recuento = 1;
            $sqlInsercion = "INSERT INTO contador_visitas (id, count) VALUES (1, $recuento)";
            $connContador->query($sqlInsercion);
        
            echo $recuento;
        }
        
        // Cerrar la conexión
        $connContador->close();
    ?>
</div>


</div>
    <!-- Copyright y fecha de creación -->
    <footer style="text-align: center; margin-top: 20px;">
        &copy; 2023 PhoenixOS. Todos los derechos reservados. | Creado el 3 de julio de 2023
    </footer>
</body>
</html>
