<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once "conexion.php";

$sql = "SELECT * FROM reportes";
$result = $conexion->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reportes</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css"/> 
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
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Reportes</a></li>
          <li><a href="crear reportes.php">Nuevo Reporte</a></li>
          <li><a href="ver reportes.php">Ver Reportes</a></li>
        </ul>
      </li>
      <li>
        <a href="index.php">
        <i class='bx bx-edit' ></i>
          <span class="link_name">Lista de Repuestos</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="repuestos.php">Lista de Repuestos</a></li>
        </ul>
        <li>
        <a href="index.php">
          <i class='bx bx-book-open'></i>
          <span class="link_name">Manuales</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="Manuales">Manuales</a></li>
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
      <a href="logout.php">
      <i class='bx bx-log-out' ></i>
            </a>
    </div>
  </li>
</ul>
        </div>
        <div class="content" style="margin-left:300px;">
    <h1 style="margin-left: 450;">Lista de Reportes</h1>
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div id="mensaje"><?php echo $_SESSION['mensaje']; ?></div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-container" style="margin-bottom:100px; margin-right:100px">
            <table>
                    <thead>
                        <tr>
                            <th>Número de Reporte</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Equipo</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                             <tr>
                                <td><?php echo htmlspecialchars($row['numero_reporte']); ?></td>
                                <td><?php echo htmlspecialchars($row['cliente']); ?></td>
                                <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                                <td><?php echo htmlspecialchars($row['equipo']); ?></td>
                                <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                                <td>
                                    <a href="editar reportes.php?id=<?php echo $row['id']; ?>" class="edit-btn"><i class="fas fa-edit"></i> Editar</a>
                                    <a href="eliminar_reportes.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('¿Estás seguro de que deseas eliminar este reporte?');"><i class="fas fa-trash"></i> Eliminar</a>
                                    <a href="generar_pdf_individual.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Generar PDF</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                </div>
            <?php else: ?>
                <p>No hay reportes disponibles.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
<footer>
    <p>&copy; 2023 Lab Brands. Todos los derechos reservados.</p>
</footer>
<script
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
</script>
</html>
<style>