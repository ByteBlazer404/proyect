  <?php 

	require_once "clases/Conexion.php";
	$obj = new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * from usuarios where email='admin'";
	$result=mysqli_query($conexion,$sql);
	$validar=0;

	if(mysqli_num_rows($result) > 0){
		header("location:index.php");
	}
 ?>

<!DOCTYPE html>
<html> 
<head>
	<title>Registro</title>
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body class="bg-black d-flex align-items-center justify-content-center overflow-hiden">
	<div id="particles-js" class="z-0 position-fixed w-100" style="height: 250%;"></div>
	<div class="container container-sm bg-secondary bg-gradient bg-opacity-75 z-1 position-relative rounded p-2 d-flex" style="height: 55ch ; width: 40% ; margin-top: 11% ">
			<form id="frmRegistro" class="form p-2 mx-auto" style="width: 90% ; height: 90%;">
				<h2 class="text-primary text-center">Registrar Nuevo Administrador</h2>
				<div class="mb-3">
					<label class="form-label">Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre">
				</div>
				<div class="mb-3">
					<label class="form-label">Apellido</label>
					<input type="text" class="form-control" name="apellido" id="apellido">
				</div>
				<div class="mb-3">
					<label class="form-label">Usuario</label>
					<input type="text" class="form-control" name="usuario" id="usuario">
				</div>
				<div class="mb-3">
					<label class="form-label">Password</label>
					<input type="text" class="form-control" name="password" id="password">
				</div>
				<div class="mb-4 d-flex justify-content-center">
					<span class="btn btn-outline-primary m-1" id="registro">Registrar</span>
					<a href="index.php" class="btn btn-outline-dark m-1">Regresar login</a>
				</div>
			</form>
	</div>

	</div>
	<!-- <div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">Registrar administrador</div>
					<div class="panel panel-body">
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div> -->
	<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
	<script src="js/app.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$('#registro').click(function(){

			vacios=validarFormVacio('frmRegistro');

			if(vacios > 0){
				alert("Debes llenar todos los campos");
				return false;
			}

			datos=$('#frmRegistro').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"procesos/regLogin/registrarUsuario.php",
				success:function(r){

					if(r==1){
						alert("Agregado con exito");
					}else{
						alert("Fallo al agregar");
					}
 
				}
			});
		});
	})
</script>
