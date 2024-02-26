<?php require_once "dependencias.php" ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title></title>
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary" style="height: 4vw;" id="nav">
    <div class="container-fluid d-flex">
      <div class="continer" style="width: 10%; height: 100%;">
         <a href="inicio.php" class="navbar-brand">
            <img src="../img/logo-fondo.png" alt="logo" width="50px" height="auto">
         </a>
      </div>
      <div class="container d-flex justify-content-center align-items-center conllapse navbar-collapse" id="navbarNavDropdown" style="width: 80%; height: 100;">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="inicio.php" class="nav-link">Inicio</a></li>
          <li class="nav-item"><a href="usuarios.php" class="nav-link">Usuarios</a></li>
          <?php
          if($_SESSION['usuario']!=="admin"):
             ?>
            <li class="nav-item"><a href="compras.php" class="nav-link">Comprar</a></li>
            <?php
            endif;
             ?> 
             <?php
             if($_SESSION['usuario']=="admin"):
           ?>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
              <ul class="dropdown-menu">
                <li><a href="categorias.php" class="dropdown-item">Categorias</a></li>
                <li><a href="articulos.php" class="dropdown-item">Articulos</a></li>
                <li><a href="ventas.php" class="dropdown-item">Ventas</a></li>
                <li><a href="clientes.php" class="dropdown-item">Clientes</a></li>
              </ul>
            </li>
            <?php
            endif;
          ?>
        </ul>
      </div>
      <div class="container d-flex" style="width: 10%; justify-content: flex-start; align-items: center;">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle d-flex text-center" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-aling:center; justify-content: center; align-items: center;">
              <?php echo $_SESSION['usuario']; ?>
              <img src="../img/user-icon.svg" alt="usuario" width="45px" height="auto" class="p-1">
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
              <li><a href="#" class="dropdown-item">Perfil</a></li>
              <li><a href="../procesos/salir.php" class="dropdown-item">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</body>
</html>