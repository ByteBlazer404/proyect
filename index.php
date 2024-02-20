<?php
    require "clases/Conexion.php";

    $obj = new conectar();
    $conexion = $obj->conexion();

    $sql = "SELECT * FROM usuarios WHERE email = 'admin'";
    $result = mysqli_query($conexion, $sql);
    $validar = (mysqli_num_rows($result) > 0) ? 1 : 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de nuevo usuario</title>
    <script src="librerias/jquery-3.2.1.min.js"></script>
    <script src="js/funciones.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-black d-flex align-items-center justify-content-center">
    <div id="particles-js" class="z-0 position-fixed w-100" style="height: 150vh;"></div>
    <div class="container container-sm bg-secondary bg-gradient bg-opacity-75 z-1 position-relative rounded p-2 d-flex" style="height: 40ch ; width: 40% ; margin-top: 15% ">
        <form id="frmLogin" autocomplete="off" class="form p-2" style="width: 60% ; height: 100%;">
            <h2 class="text-primary">Login de adiministrador</h2>
            <div class="mb-3">
                <label class="form-label fs-5">Usuario</label>
                <input type="text" class="form-control" name="usuario" id="usuario">
            </div>
            <div class="mb-3">
                <label class="form-label fs-5">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="mb-4 d-flex justify-content-center">
                <span class="btn btn-outline-primary btn-md m-1" id="entrarSistema">Entrar</span>
                <a href="registro.php" class="btn btn-outline-dark btn-md m-1">Registrar</a>
            </div>
        </form>
        <div class="container d-flex" style="width: 40% ; height: 100% ; justify-content: center ; align-items : center">
            <img src="img/logo-fondo.png" alt="logo" title="logo" class="img img-fluid" style="width: 90% ; height: auto; object-fit: cover;">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#entrarSistema').click(function () {
                vacios = validarFormVacio('frmLogin');

                if (vacios > 0) {
                    alert("Debes llenar todos los campos");
                    return false;
                }

                datos = $('#frmLogin').serialize();
                $.ajax({
                    type: "POST",
                    data: datos,
                    url: "procesos/regLogin/login.php",
                    success: function (r) {
                        if (r == 1) {
                            window.location = "vistas/inicio.php";
                        } else {
                            alert("No se pudo acceder");
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
