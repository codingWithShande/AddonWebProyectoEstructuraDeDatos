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
                
                // Consulta para obtener los datos de la tabla registros_hotel
                $sql = "SELECT * FROM registros_hotel";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // Mostrar los datos en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['idPrimaria']."</td>";
                        echo "<td>".$row['nombre']."</td>";
                        echo "<td>".$row['apellidos']."</td>";
                        echo "<td>".$row['dni']."</td>";
                        echo "<td>".$row['ingreso']."</td>";
                        echo "<td>".$row['salida']."</td>";
                        echo "<td>".$row['pago']."</td>";
                        echo "<td>".$row['descripcion']."</td>";
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
</body>
</html>

