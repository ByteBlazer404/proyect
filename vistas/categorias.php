<?php
session_start();
if (isset($_SESSION['usuario'])) {

	?>


	<!DOCTYPE html>
	<html>

	<head>
		<title>categorias</title>
		<?php require_once "menu.php"; ?>
	</head>

	<body>

		<div class="container-fluid d-block">
			<h1 class="fs-1 mt-5 mb-3" style="padding-left: 10vw;">Categorias</h1>
			<button type="button" class="btn btn-danger text-light mb-3" data-bs-toggle="modal"
				data-bs-target="#exampleModal" style="margin-left: 10vw;">
				Añadir Nueva Categoría
			</button>
			<div class="container d-flex" style="width: 80vw;">
				<div id="tablaCategoriaLoad" class="w-100"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4">
				<form id="frmCategorias">
					<label>Categorias</label>
					<input type="text" class="form-control input-sm" name="categoria" id="categoria">
					<p></p>
					<span class="btn btn-primary" id="btnAgregarCategoria">Agregar</span>
				</form>
			</div>
		</div>

		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Categoría</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="frmCategorias">
							<div class="form-control d-block">
								<label for="categoria" class="form-label">
									Nombre:
								</label>
								<input type="text" name="categoria" id="categoria" class="form-input">
							</div>
							<span class="btn btn-primary" id="btnAgregarCategoria" data-bs-dismiss="modal">Agregar</span>
						</form>
					</div>
					<div class="modal-footer justify-content-center d-flex">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
								aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza categoria</h4>
					</div>
					<div class="modal-body" data-target="modal">

						<form id="frmCategoriaU">
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<label>Categoria</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm">
						</form>

					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaCategoria" class="btn btn-warning"
							data-dismiss="modal">Guardar</button>
					</div>
				</div>
			</div>
		</div>

	</body>

	</html>

	<script type="text/javascript">
		$(document).ready(function () {

			$("#tablaCategoriaLoad").load("categorias/tablaCategorias.php");

			$('#btnAgregarCategoria').click(function () {

				vacios = validarFormVacio('frmCategorias');

				if (vacios > 0) {
					alertify.alert("Debes llenar todos los campos");
					return false;
				}

				datos = $('#frmCategorias').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "../procesos/categoria/agregaCategoria.php",
					success: function (r) {
						if (r == 1) {

							$('#frmCategorias')[0].reset();

							$("#tablaCategoriaLoad").load("categorias/tablaCategorias.php");
							alertify.success("Categoria agregada con exito :D");
						} else {
							alertify.error("No se pudo agregar categoria");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function () {
			$('#btnActualizaCategoria').click(function () {

				datos = $('#frmCategoriaU').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "../procesos/categoria/actualizaCategoria.php",
					success: function (r) {
						if (r == 1) {
							$("#tablaCategoriaLoad").load("categorias/tablaCategorias.php");
							alertify.success("Actualizado con exito");
						} else {
							alertify.error("Fallo al actualizar");
						}
					}
				});
			});
		});

	</script>

	<script type="text/javascript">
		function agregaDato(idCategoria, categoria) {
			$('#idcategoria').val(idCategoria);
			$('#categoriaU').val(categoria);
		}
		function eliminaCategoria(idCategoria) {
			alertify.confirm('¿Desea eliminar está categoria?',
				function () {
					$.ajax({
						type: "POST",
						data: "idcategoria=" + idCategoria,
						url: "../procesos/categoria/eliminaCategoria.php",
						success: function (r) {
							if (r == 1) {
								$("#tablaCategoriaLoad").load("categorias/tablaCategorias.php");
								alertify.success("Categoria eliminada con exito");
							} else {
								alertify.error("No se pudo eliminar la categoria");
							}
						}
					});
				},
				function () {
					alertify.error('Cancelado')
				});
		}

	</script>

<?php
} else {
	header("location:../index.php");
}
?>