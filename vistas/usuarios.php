<?php
session_start();
if (isset($_SESSION['usuario']) and $_SESSION['usuario'] == "admin") {

	?>


	<!DOCTYPE html>
	<html>

	<head>
		<title>usuarios</title>
		<?php require_once "menu.php"; ?>
	</head>

	<body>
		<div class="container-fluid">
			<div class="container" style="width: 80%">
				<h1 class="fs-1 text-start mt-4 mb-3">Usuarios</h1>
				<button type="button" class="btn btn-danger text-center text-light mb-3" data-bs-toggle="modal"
					data-bs-target="#newUser">
					Añadir Usuario
				</button>
				<div id="tablaUsuariosLoad"></div>
			</div>
		</div>
		<div class="modal fade" id="newUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Usuario</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="frmRegistro">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombre" id="nombre">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellido" id="apellido">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Contraseña</label>
							<input type="password" class="form-control input-sm" name="password" id="password">
							<div class="modal-footer d-flex justify-content-center">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<span class="btn btn-primary" id="registro" data-bs-dismiss="modal">Registrar</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="updateUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Editar Usuario</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="frmRegistro">
							<input type="hidden" id="idUsuario" name="idUsuario">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
							<div class="modal-footer d-flex justify-content-center">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<button id="btnActualizaUsuario" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="actualizaUsuarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza datos del usuario</h4>
					</div>
					<div class="modal-body">

						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
						</form>

					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario" type="button" class="btn btn-warning"
							data-dismiss="modal">Actualizar usuario</button>
					</div>
				</div>
			</div>
		</div>

	</body>

	</html>

	<script type="text/javascript">
		function agregaDatosUsuario(idusuario) {
			$.ajax({
				type: "POST",
				data: "idusuario=" + idusuario,
				url: "../procesos/usuarios/obtenDatosusuarios.php",
				success: function (r) {

					dato = jQuery.parseJSON(r);
					$('#idUsuario').val(dato['id_usuario']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#usuarioU').val(dato['email']);

				}
			});
		}

		function eliminaUsuario(idusuario) {
			alertify.confirm('¿Desea eliminar este usuario?',
				function () {
					$.ajax({
						type: "POST",
						data: "idusuario=" + idusuario,
						url: "../procesos/usuarios/eliminaUsuario.php",
						success: function (r) {
							if (r == 1) {
								$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
								alertify.success("Usuario eliminado con exito");
							} else {
								alertify.error("No se pudo eliminar el usuario");
							}
						}
					});
				},
				function () {
					alertify.error('Cancelado')
				});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function () {
			$('#btnActualizaUsuario').click(function () {

				datos = $('#frmRegistroU').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "../procesos/usuarios/actualizaUsuario.php",
					success: function (r) {
						if (r == 1) {
							$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
							alertify.success("Usuario actualizado con exito");
						} else {
							alertify.error("Fallo al actualizar usuario");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function () {

			$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");

			$('#registro').click(function () {

				vacios = validarFormVacio('frmRegistro');

				if (vacios > 0) {
					alertify.alert("Debes llenar todos los campos");
					return false;
				}

				datos = $('#frmRegistro').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "../procesos/regLogin/registrarUsuario.php",
					success: function (r) {
						if (r == 1) {
							$('#frmRegistro')[0].reset();
							$('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
							alertify.success("Agregado con exito");
						} else {
							alertify.error("Fallo al agregar");
						}
					}
				});
			});
		})
	</script>


<?php
} else {
	header("location:../index.php");
}
?>