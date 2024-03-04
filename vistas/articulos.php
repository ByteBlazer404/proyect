<?php
session_start();
if (isset($_SESSION['usuario'])) {

	?>


	<!DOCTYPE html>
	<html>

	<head>
		<title>articulos</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php";
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "SELECT id_categoria,nombreCategoria
		from categorias";
		$result = mysqli_query($conexion, $sql);
		?>
	</head>
	<body>
		<div class="container-fluid">
			<div class="container d-block" style="width: 85%">
				<h1 class="text-left fs-1 mt-4 mb-3">Articulos</h1>
				<button type="button" class="btn btn-danger text-light text-center mb-3" data-bs-toggle="modal"
					data-bs-target="#newArticle">
					Añadir Articulo
				</button>
				<div id="tablaArticulosLoad"></div>
			</div>
		</div>
		<div class="modal fade" id="newArticle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Articulo</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="frmArticulos" enctype="multipart/form-data">
							<label>Categoria</label>
							<select class="form-control input-sm" id="categoriaSelect" name="categoriaSelect">
								<option value="A">Seleccionar categoria</option>
								<?php while ($ver = mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0] ?>">
										<?php echo $ver[1]; ?>
									</option>
								<?php endwhile; ?>
							</select>
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombre" name="nombre">
							<label>Descripcion</label>
							<input type="text" class="form-control input-sm" id="descripcion" name="descripcion">
							<label>Cantidad</label>
							<input type="number" class="form-control input-sm" id="cantidad" name="cantidad">
							<label>Precio</label>
							<input type="number" class="form-control input-sm" id="precio" name="precio">
							<label>Imagen</label>
							<input type="file" id="imagen" name="imagen" accept="image/*">
							<div class="modal-footer d-flex justify-content-center">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<span id="btnAgregaArticulo" class="btn btn-primary" data-bs-dismiss="modal">Agregar</span>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="updateArticle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Articulo</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<form id="frmArticulosU" enctype="multipart/form-data">
							<input type="text" id="id_Articulo" hidden="" name="idArticulo">
							<label>Categoria</label>
							<select class="form-control input-sm" id="categoriaSelectU" name="categoriaSelectU">
								<option value="A">Seleccionar categoria</option>

								<?php $sql = "SELECT id_categoria,nombreCategoria
								from categorias";
								$result = mysqli_query($conexion, $sql); ?>

								<?php
								while ($ver = mysqli_fetch_row($result)): ?>
									<option value="<?php echo $ver[0] ?>">
										<?php echo $ver[1]; ?>
									</option>
								<?php endwhile; ?>

							</select>
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Descripcion</label>
							<input type="text" class="form-control input-sm" id="descripcionU" name="descripcionU">
							<label>Cantidad</label>
							<input type="text" class="form-control input-sm" id="cantidadU" name="cantidadU">
							<label>Precio</label>
							<input type="text" class="form-control input-sm" id="precioU" name="precioU">
							<div class="modal-footer d-flex justify-content-center">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
								<button id="btnActualizaarticulo" type="button" class="btn btn-primary"
									data-dismiss="modal">Actualizar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>

	</html>

	<script type="text/javascript">

		function agregaDatosArticulo(idarticulo) {
			$.ajax({
				type: "POST",
				data: "idart=" + idarticulo,
				url: "../procesos/articulos/obtenDatosArticulos.php",
				success: function (r) {

					dato = jQuery.parseJSON(r);
					$('#id_Articulo').val(dato['id_producto']);
					$('#categoriaSelectU').val(dato['id_categoria']);
					$('#nombreU').val(dato['nombre']);
					$('#descripcionU').val(dato['descripcion']);
					$('#cantidadU').val(dato['cantidad']);
					$('#precioU').val(dato['precio']);

				}
			});
		}


		function eliminarArticulo(idArticulo) {
			alertify.confirm('¿Desea eliminar este articulo?',
				function () {
					$.ajax({
						type: "POST",
						data: "idarticulo=" + idArticulo,
						url: "../procesos/articulos/eliminarArticulo.php",
						success: function (r) {
							if (r == 1) {
								alertify.error("No se pudo eliminar este articulo");
							} else {
								$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
								alertify.success("Articulo eliminado con exito");
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
			$('#btnActualizaarticulo').click(function () {

				datos = $('#frmArticulosU').serialize();
				$.ajax({
					type: "POST",
					data: datos,
					url: "../procesos/articulos/actualizaArticulos.php",
					success: function (r) {
						if (r == 1) {
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
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
		$(document).ready(function () {
			$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");

			$('#btnAgregaArticulo').click(function () {

				vacios = validarFormVacio('frmArticulos');

				if (vacios > 0) {
					alertify.alert("Debes llenar todos los campos");
					return false;
				}

				var formData = new FormData(document.getElementById("frmArticulos"));

				$.ajax({
					url: "../procesos/articulos/insertaArticulos.php",
					type: "post",
					dataType: "html",
					data: formData,
					cache: false,
					contentType: false,
					processData: false,

					success: function (r) {

						if (r == 1) {
							alertify.error("Fallo al subir el archivo :(");

						} else {
							$('#frmArticulos')[0].reset();
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
							alertify.success("Articulo agregado con exito");
						}
					}
				});

			});
		});
	</script>



	<?php
} else {
	header("location:../index.php");
}
?>