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
				data-bs-target="#newCategory" style="margin-left: 10vw;">
				Añadir Nueva Categoría
			</button>
			<div class="container d-flex" style="width: 80vw;">
				<div id="tablaCategoriaLoad" class="w-100"></div>
			</div>
		</div>
		<!--add new category -->
		<div class="modal fade" id="newCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Categoría</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="frmCategorias">
							<div class="d-block">
								<label for="categoria" class="form-label">
									Nombre:
								</label>
								<input type="text" name="categoria" id="categoria" class="form-control">
							</div>
							<div class="modal-footer justify-content-center d-flex">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
								<button class="btn btn-primary" id="btnAgregarCategoria"
									data-bs-dismiss="modal">Agregar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--Edit category-->
		<div class="modal fade" id="actualizaCategoria" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Editar Categoría</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="frmCategoriaU">
							<input type="hidden" id="idcategoria" name="idcategoria" value="0">
							<label class="form-label" for="categoriaU">Categoria</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control">
							<div class="modal-footer justify-content-center d-flex">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
								<button class="btn btn-primary" id="btnActualizaCategoria" data-bs-dismiss="modal">Editar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="showCategory" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Categoria</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="frmCategoriaU">
							<label class="form-label" for="categoriaU">Categoria</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control" disabled value="categoria">
							<div class="modal-footer justify-content-center d-flex">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							</div>
						</form>
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
				
				falso = validarFormVacio('frmCategoriaU');

				if (falso > 0) {
					alertify.alert("Debes llenar todos los campos");
					return false;
				}

				datos = $('#frmCategoriaU').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "../procesos/categoria/actualizaCategoria.php",
					success: function (r) {
						if (r == 1) {
							$("#tablaCategoriaLoad").load("categorias/tablaCategorias.php");
							alertify.success("Actualizado con exito");
							console.log("" + '#categoriaU');
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