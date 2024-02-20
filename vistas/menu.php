 
<?php require_once "dependencias.php" ?>

<!DOCTYPE html>
<html>
<head>
  <title></title>

</head>
<body>
<div  class="position-fixed" style="display: flex; justify-content: center; align-items: center; width: 100%; padding-top: 0.5%;padding-bottom: 6%;" id="nav">
    <nav class="navbar navbar-expand-lg rounded bg-secondary bg-gradient bg-opacity-75">
      <div class="container-fluid">
        <a class="navbar-brand" href="#" style="color: aliceblue;">StoneTech</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav" >
            <li class="nav-item">
              <a class="nav-link active color-light" aria-current="page" href="inicio.php">Inicio</a>
            </li>
            <?php
            if($_SESSION['usuario']!=="admin"):
               ?>
              <li class="nav-item">
                <a class="nav-link active color-light" aria-current="page" href="Compras.php">Comprar</a>
              </li>
            <?php
              endif;
               ?>  
            <?php
              if($_SESSION['usuario']=="admin"):
            ?>
              <li class="nav-item">
                <a class="nav-link color-light" href="usuarios.php">Usuarios</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle color-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Productos
                </a>
                <ul class="dropdown-menu bg-secondary bg-gradient">
                  <li><a class="dropdown-item color-light" href="categorias.php">Categorias</a></li>
                  <li><a class="dropdown-item color-light" href="articulos.php">Articulos</a></li>
                  <li><a class="dropdown-item color-light" href="ventas.php">Venta</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link color-light " href="clientes.php">Clientes</a>
              </li>
            <?php
              endif;
            ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle color-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php echo $_SESSION['usuario']; ?>
              </a>
              <ul class="dropdown-menu bg-secondary bg-gradient">
                <li><a class="dropdown-item color-light" href="#">Perfil</a></li>
                <li><a class="dropdown-item color-light" href="../procesos/salir.php">Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</body>
</html>
