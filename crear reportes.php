<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

$mensaje = '';

if (isset($_POST['create_report'])) {
    if (!empty($_POST['numero_reporte']) && !empty($_POST['cliente']) && !empty($_POST['usuario']) && 
        !empty($_POST['sn']) && !empty($_POST['equipo']) && !empty($_POST['accesorios']) &&
        !empty($_POST['concepto_tecnico']) && !empty($_POST['servicio_realizado']) && 
        !empty($_POST['fecha'])) {
        
        $fecha = trim($_POST['fecha']); 
        $numero_reporte = trim($_POST['numero_reporte']);
        $cliente = trim($_POST['cliente']);
        $usuario = trim($_POST['usuario']);
        $sn = trim($_POST['sn']);
        $equipo = trim($_POST['equipo']);
        $accesorios = trim($_POST['accesorios']);
        $concepto_tecnico = trim($_POST['concepto_tecnico']);
        $servicio_realizado = trim($_POST['servicio_realizado']);

        $stmt = $conexion->prepare("INSERT INTO reportes (fecha, numero_reporte, cliente, usuario, sn, equipo, accesorios, concepto_tecnico, servicio_realizado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $fecha, $numero_reporte, $cliente, $usuario, $sn, $equipo, $accesorios, $concepto_tecnico, $servicio_realizado);

        if ($stmt->execute()) {
            $mensaje = "Reporte creado exitosamente.";
        } else {
            $mensaje = "Error al crear el reporte: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Reporte</title>
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
          <i class='bx bxs-chevron-down arrow' ></i>
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
          <li><a class="link_name" href="#">
          </a></li>
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
      <a href="logout.php">
      <i class='bx bx-log-out' ></i>
            </a>
    </div>
  </li>
</ul>
</div>
</head>
<body>
<div class="container"style="margin-right: 350px;"> 
    <h2>Crear Nuevo Reporte</h2>
    <?php if ($mensaje): ?>
        <div id="mensaje"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    <form action="crear reportes.php" method="POST">
        <div class="date-container">
            <span class="date-label">Seleccionar fecha:</span>
            <input type="date" id="fecha" name="fecha" placeholder="Seleccionar fecha" required>
        </div>
        <input type="text" name="numero_reporte" placeholder="Número de Reporte" required>
        <input type="text" name="cliente" placeholder="Cliente" required>
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="text" name="sn" placeholder="Número de Serie" required>
        <input type="text" name="equipo" placeholder="Equipo" required>
        <input type="text" name="accesorios" placeholder="Accesorios" required>
        <textarea name="concepto_tecnico" placeholder="Concepto Técnico" required></textarea>
        <textarea name="servicio_realizado" placeholder="Servicio Realizado" required></textarea>
        <textarea name="repuestos_requeridos" placeholder="Repuestos Requeridos" required></textarea>
        <textarea name="repuestos_utilizados" placeholder="Repuestos Utilizados" required></textarea>
        <input type="responsable" placeholder="Responsable" required>
        <button type="submit" name="create_report">Crear Reporte</button>
    </form>
</div>
<footer>
    <p>&copy; 2023 Lab Brands. Todos los derechos reservados.</p>
</footer>
<script>
  let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement; 
        arrowParent.classList.toggle("showMenu");
    });
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");

    if (sidebar.classList.contains("close")) {
        let navLinks = document.querySelectorAll(".nav-links li");
        navLinks.forEach(link => {
            link.classList.remove("showMenu");
        });
    }
});
flatpickr("#fecha", {
            locale: "es",
            dateFormat: "Y-m-d",
        })


</script>
</body>
</html>