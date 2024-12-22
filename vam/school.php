<?php
session_start();  // Iniciar la sesión

// Incluir el archivo de configuración de la base de datos
include('db_login.php');  // Asegúrate de que la ruta sea correcta

// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_database", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    die("No estás logueado. Debes iniciar sesión para realizar esta solicitud.");
}

// Obtener el gvauser_id desde la sesión
$gvauser_id = $_SESSION['id'];  // El ID del usuario desde la sesión

// Procesar la solicitud de tutoría
if (isset($_POST['solicitar_tutoria'])) {
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $avion_tutoria = $_POST['avion_tutoria'];
    $comentarios = isset($_POST['comentarios']) ? $_POST['comentarios'] : null;

    // Consulta para insertar una nueva tutoría
    $sql = "INSERT INTO tutorias (fecha, hora, avion, estado, comentarios, gvauser_id) 
            VALUES (:fecha, :hora, :avion, 'pendiente', :comentarios, :gvauser_id)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':fecha' => $fecha,
            ':hora' => $hora,
            ':avion' => $avion_tutoria,
            ':comentarios' => $comentarios,
            ':gvauser_id' => $gvauser_id  // Usamos el ID del usuario desde la sesión
        ]);
        $mensaje_tutoria = "Tutoría solicitada con éxito.";
    } catch (PDOException $e) {
        $mensaje_tutoria = "Error al insertar tutoría: " . $e->getMessage();
    }
}

// Procesar la solicitud de examen
if (isset($_POST['solicitar_examen'])) {
    $avion_examen = $_POST['avion_tutoria'];
    $contenido = $_POST['contenido'];

    // Consulta para insertar un nuevo examen
    $sql = "INSERT INTO examenes (avion, estado, contenido, gvauser_id) 
            VALUES (:avion, 'pendiente', :contenido, :gvauser_id)";
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':avion' => $avion_examen,
            ':contenido' => $contenido,
            ':gvauser_id' => $gvauser_id  // Usamos el ID del usuario desde la sesión
        ]);
        $mensaje_examen = "Examen solicitado con éxito.";
    } catch (PDOException $e) {
        $mensaje_examen = "Error al insertar examen: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Tutoría o Examen</title>
    <link rel="stylesheet" href="style.css"> <!-- Si tienes un archivo de estilos -->
</head>
<body>
    <h1>Solicitar Tutoría o Examen</h1>

    <!-- Mensajes de éxito o error -->
    <?php if (isset($mensaje_tutoria)) { echo "<p>$mensaje_tutoria</p>"; } ?>
    <?php if (isset($mensaje_examen)) { echo "<p>$mensaje_examen</p>"; } ?>

    <!-- Formulario para solicitar tutoría -->
    <h2>Solicitar Tutoría</h2>
    <form action="" method="POST">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br>

        <label for="hora">Hora:</label>
        <input type="time" id="hora" name="hora" required><br>

        <label for="avion_tutoria">Selecciona el avión:</label>
        <select id="avion_tutoria" name="avion_tutoria" required>
            <option value="B738">B738</option>
            <option value="A320">A320</option>
            <option value="ATR72">ATR72</option>
            <option value="B737">B737</option>
            <option value="B38M">B38M</option>
        </select><br>

        <label for="comentarios">Comentarios:</label>
        <textarea id="comentarios" name="comentarios"></textarea><br>

        <button type="submit" name="solicitar_tutoria">Solicitar Tutoría</button>
    </form>

    <hr>

    <!-- Formulario para solicitar examen -->
    <h2>Solicitar Examen</h2>
    <form action="" method="POST">
        
        <label for="avion_tutoria">Selecciona el avión:</label>
        <select id="avion_tutoria" name="avion_tutoria" required>
            <option value="B738">B738</option>
            <option value="A320">A320</option>
            <option value="ATR72">ATR72</option>
            <option value="B737">B737</option>
            <option value="B38M">B38M</option>
        </select><br>

        <label for="contenido">Contenido:</label>
        <textarea id="contenido" name="contenido" required></textarea><br>

        <button type="submit" name="solicitar_examen">Solicitar Examen</button>
    </form>
</body>
</html>
