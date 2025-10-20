<?php
// ===================================================================
// Archivo: procesar_pedido.php
// ===================================================================

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar que el formulario fue enviado con el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar los datos del formulario
    $productos = $_POST['productos'];
    $nombre    = $_POST['nombre'];
    $dia       = $_POST['dia'];
    $colonia   = $_POST['colonia'];
    $total     = $_POST['total'];

    // Validar que los campos obligatorios no estén vacíos-----------------No sera necesario por el uso de required
    if (empty($productos) || empty($nombre) || empty($dia) || empty($colonia) || empty($total)) {
        echo "<div class='alert alert-danger' style='text-align:center; margin-top:50px;'>
                ⚠ Por favor completa todos los campos obligatorios.                                  
                <a href='agregar_pedido.php' class='btn btn-warning mt-3'>Volver al formulario</a>
              </div>";
        exit;
    }

    // Preparar la consulta SQL para insertar los datos de forma segura
    $sql = $conn->prepare("INSERT INTO pedidos (productos, nombre, dia, colonia, total) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sssss", $productos, $nombre, $dia, $colonia, $total);

    // Ejecutar la consulta
    if ($sql->execute()) {
        echo "<div style='text-align:center; margin-top:50px;'>
                <h2>✅ Pedido registrado correctamente</h2>
                <a href='agregar_pedido.php' class='btn btn-primary mt-3'>Volver al formulario</a>
              </div>";
    } else {
        echo "<div style='text-align:center; margin-top:50px;'>
                <h2>❌ Error al guardar los datos: " . $sql->error . "</h2>
                <a href='agregar_pedido.php' class='btn btn-danger mt-3'>Intentar de nuevo</a>
              </div>";
    }

    // Cerrar recursos
    $sql->close();
    $conn->close();
} else {
    echo "<div style='text-align:center; margin-top:50px;'>
            <h2>⚠ Acceso no permitido.</h2>
          </div>";
}
?>

