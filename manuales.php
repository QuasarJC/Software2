<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


require_once "conexion.php";


$sql = "SELECT marca, equipo, Tipo_manual, ruta_pdf FROM manuales";
$result = $conexion->query($sql);


$manuales_por_marca = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $marca = $row['marca'];
        $manuales_por_marca[$marca][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Manuales</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="style.css"/> 
</head>
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
<div class="content" style="margin-left:300px;">
    <h1>Lista de Manuales</h1>
    <?php if (!empty($manuales_por_marca)): ?>
        <div class="table-container" style="margin-bottom:100px; margin-right:100px;">
            <table>
                <thead>
                    <tr>
                        <th>Marca</th>
                        <th>Equipo</th>
                        <th>Tipo de Manual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($manuales_por_marca as $marca => $manuales): ?>
                        <?php foreach ($manuales as $manual): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($marca); ?></td>
                                <td><?php echo htmlspecialchars($manual['equipo']); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($manual['ruta_pdf']); ?>" target="_blank">
                                        <?php echo htmlspecialchars($manual['Tipo_manual']); ?>
                                    </a>
                                </td>   
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>No hay manuales disponibles.</p>
    <?php endif; ?>
</div>
<footer>
    <p>&copy; 2023 Lab Brands. Todos los derechos reservados.</p>
</footer>
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
document.querySelectorAll('h2').forEach(function(heading) {
        heading.addEventListener('click', function() {
            const table = heading.nextElementSibling; // Selecciona la tabla que sigue al encabezado
            table.style.display = (table.style.display === 'none' || table.style.display === '') ? 'table' : 'none';
        });
    });
</script>

</body>
</html>