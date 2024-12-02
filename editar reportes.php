<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Incluir la conexión a la base de datos
include("conexion.php");

// Obtener el ID del reporte a editar
$id = intval($_GET['id']);

// Consultar el reporte específico
$sql = "SELECT * FROM reportes WHERE id = $id";
$result = $conexion->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar el formulario de edición
    $nuevo_fecha = $conexion->real_escape_string($_POST['fecha']);
    $nuevo_numero_reporte = $conexion->real_escape_string($_POST['numero_reporte']);
    $nuevo_cliente = $conexion->real_escape_string($_POST['cliente']);
    $nuevo_usuario = $conexion->real_escape_string($_POST['usuario']);
    $nuevo_equipo = $conexion->real_escape_string($_POST['equipo']);
    $nuevo_sn = $conexion->real_escape_string($_POST['sn']);
    $nuevos_accesorios = $conexion->real_escape_string($_POST['accesorios']);
    $nuevo_concepto_tecnico = $conexion->real_escape_string($_POST['concepto_tecnico']);
    $nuevo_servicio_realizado = $conexion->real_escape_string($_POST['servicio_realizado']);


    $sql_update = "UPDATE reportes SET 
    fecha = '$nuevo_fecha', 
    numero_reporte = '$nuevo_numero_reporte', 
    cliente = '$nuevo_cliente', 
    usuario = '$nuevo_usuario', 
    equipo = '$nuevo_equipo', 
    sn = '$nuevo_sn', 
    accesorios = '$nuevos_accesorios', 
    concepto_tecnico = '$nuevo_concepto_tecnico', 
    servicio_realizado = '$nuevo_servicio_realizado' 
        WHERE id = $id";

if ($conexion->query($sql_update) === TRUE) {
  $_SESSION['mensaje'] = "Reporte actualizado correctamente.";
  header("Location: ver reportes.php"); // Redirige a la página de reportes
  exit();
} else {
  $_SESSION['mensaje'] = "Error al actualizar el reporte: " . $conexion->error;
  header("Location: ver reportes.php"); // Redirige a la página de reportes
  exit();
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reporte</title>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="style.css"/> <!-- Asegúrate de incluir tu CSS -->
</head>
<body>
<div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-test-tube bx-tada' ></i>
      <span class="logo_name">Lab Brands</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="index.php">
          <i class='bx bx-home-alt-2'></i>
          <span class="link_name">Inicio</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Inicio</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Reportes</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Reportes</a></li>
          <li><a href="crear reportes.php">Nuevo Reporte</a></li>
          <li><a href="ver reportes.php">Ver Reportes</a></li>
        </ul>
      </li>
      <li>
        <a href="repuestos.php">
        <i class='bx bx-edit' ></i>
          <span class="link_name">Lista de Repuestos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Lista de Repuestos</a></li>
        </ul>
        <li>
        <a href="manuales.php">
        <i class='bx bx-book-open'></i>
          <span class="link_name">Manuales</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Manuales</a></li>
        </ul>
      </li>
      <li>
        <div class="iocn-link">
        </div>
      <li>
        <a href="#">
          <i class='bx bx-pie-chart-alt-2' ></i>
          <span class="link_name"></span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#"></a></li>
        </ul>
<
      <li>
    <div class="profile-details">
      <div class="profile-content">
        <img src="foto jose.jpg" alt="profileImg">
      </div>
      <div class="name-job">
        <div class="profile_name">Jose Carlos</div>
        <div class="job">Tecnico</div>
      </div>
      <a href="logout.php"> <!-- Enlace para cerrar sesión -->
      <i class='bx bx-log-out' ></i>
            </a>
    </div>
  </li>
</ul>
    </div>
    <div class="container"style="margin=-20px;">
        <h2>Editar Reporte</h2>
        <form method="POST" action="">
        <div class="date-container">
            <span class="date-label">Seleccionar fecha:</span>
            <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($row['fecha']); ?>" required>
        </div>
            <div class="form-group">
                <label for="numero_reporte"></label>
                <input type="text" id="numero_reporte" name="numero_reporte" placeholder="Número de Reporte" value="<?php echo htmlspecialchars($row['numero_reporte']); ?>" required>
            </div>
            <div class="form-group">
                <label for="cliente"></label>
                <input type="text" id="cliente" name="cliente" placeholder="Cliente" value="<?php echo htmlspecialchars($row['cliente']); ?>" required>
            </div>
            <div class="form-group">
                <label for="usuario"></label>
                <input type="text" id="usuario" name="usuario" placeholder="Usuario" value="<?php echo htmlspecialchars($row['usuario']); ?>" required>
            </div>
            <div class="form-group">
                <label for="equipo"></label>
                <input type="text" id="equipo" name="equipo" placeholder="Equipo" value="<?php echo htmlspecialchars($row['equipo']); ?>" required>
            </div>
            <div class="form-group">
                <label for="sn"></label>
                <input type="text" id="sn" name="sn" placeholder="Número de Serie" value="<?php echo htmlspecialchars($row['sn']); ?>" required>
            </div>
            <div class="form-group">
                <label for="accesorios"></label>
                <input type="text" id="accesorios" name="accesorios" placeholder="Accesorios" value="<?php echo htmlspecialchars($row['accesorios']); ?>">
            </div>
            <div class="form-group">
                <label for="concepto_tecnico"></label>
                <textarea id="concepto_tecnico" name="concepto_tecnico" placeholder="Concepto Técnico" required><?php echo htmlspecialchars($row['concepto_tecnico']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="servicio_realizado"></label>
                <textarea id="servicio_realizado" name="servicio_realizado" placeholder="Servicio Realizado" required><?php echo htmlspecialchars($row['servicio_realizado']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="repuestos_requeridos"></label>
                <textarea name="repuestos_requeridos" placeholder="Repuestos Requeridos" required><?php echo htmlspecialchars($row['repuestos_requeridos']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="repuestos_requeridos"></label>
                <textarea name="repuestos_utilizados" placeholder="Repuestos Utilizados" required><?php echo htmlspecialchars($row['repuestos_utilizados']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="repuestos_requeridos"></label>
                <input type="responsable" placeholder="Responsable" required><?php echo htmlspecialchars($row['responsable']); ?></textarea>
            </div>
            <button type="submit">Actualizar Reporte</button>
        </form>
         </di>
    <script>
       
        let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; // seleccionando el padre principal de la flecha
        arrowParent.classList.toggle("showMenu");
    });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");

    // Cierra cualquier submenú abierto cuando el sidebar se cierra
    if (sidebar.classList.contains("close")) {
        let navLinks = document.querySelectorAll(".nav-links li");
        navLinks.forEach(link => {
            link.classList.remove("showMenu");
        });
    }
});
flatpickr("#fecha", {
            locale: "es", // Establecer el idioma a español
            dateFormat: "Y-m-d", // Formato de fecha
        });
</script>
</body>
</html>