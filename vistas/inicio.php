<?php
session_start();

if (isset($_SESSION['usuario'])) {
	require_once "dependencias.php";
	?>

	<!DOCTYPE html>
	<html lang="es">

	<head>
		<title>Articulos</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; ?>
		<?php
		$c = new conectar();
		$conexion = $c->conexion();
		$sql = "SELECT id_categoria, nombreCategoria FROM categorias";
		$result = mysqli_query($conexion, $sql);
		?>
	</head>

	<body>
		<div class="container-fluid">
			<div id="carouselExampleIndicators" class="carousel slide">
				<div class="carousel-indicators carousel-indicators-dots">
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
						aria-current="true" aria-label="Slide 1" class="rounded-circle"></button>
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
						aria-label="Slide 2" class="rounded-circle"></button>
					<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
						aria-label="Slide 3" class="rounded-circle"></button>
				</div>
				<div class="carousel-inner p-2">
					<div class="carousel-item active w-100" style="height: 400px;">
						<img src="../img/pexels-frank-cone-2235130.jpg" class="d-block w-100 rounded-4" alt="..." width="90%" height="390px"
							style="object-fit: cover;">
					</div>
					<div class="carousel-item w-100" style="height: 400px;">
						<img src="../img/pexels-magda-ehlers-1337386.jpg" class="d-block w-100 rounded-4" alt="..." width="90%" height="390px"
							style="object-fit: cover;">
					</div>
					<div class="carousel-item w-100 " style="height: 400px;">
						<img src="../img/pexels-scott-webb-430205.jpg" class="d-block w-100 rounded-4" alt="..." width="90%" height="390px"
							style="object-fit: cover;">
					</div>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
					data-bs-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
					data-bs-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="visually-hidden">Next</span>
				</button>
			</div>
		</div>
		<div class="container-fluid d-block" style="padding-top: 2%;">
		<h3 class="text-left title fs-1 p-2">Productos</h3>
			<div class="container p-2 d-flex " style="flex-wrap: wrap;">
				<hr>
				<?php
				require_once "../clases/Articulos.php";

				$c = new conectar();
				$conexion = $c->conexion();
				$sql = "SELECT art.nombre, art.descripcion, art.cantidad, art.precio, img.ruta, cat.nombreCategoria, art.id_producto
					FROM articulos as art
					INNER JOIN imagenes as img ON art.id_imagen = img.id_imagen
					INNER JOIN categorias as cat ON art.id_categoria = cat.id_categoria";
				$result = mysqli_query($conexion, $sql);
				//array products unlimit
				$cantidad = 1;
				while ($ver = mysqli_fetch_row($result)) {
					if ($cantidad > 0) {
						for ($i = 0; $i < $cantidad; $i++) {
							?>
								<div class?="container m-2">
								<div class="card mb-3" style="width: 27vw ; height : 30vh; margin-left: 15px;">
									<form id="frmCarrito">
										<div class="row g-0">
											<div class="col-md-4 d-flex justify-content-center align-items-center">
												<?php
												$imgver = explode("/", $ver[4]);
												$imgruta = $imgver[1] . "/" . $imgver[2] . "/" . $imgver[3];
												?>
												<img src="<?php echo $imgruta ?>" class="img-fluid rounded-start" alt="..." style="object-fit: cover;" width="90%" height="90%">
											</div>
											<div class="col-md-8">
												<div class="card-body">
													<div class="container bg-dark w-100 h-25 d-flex justify-content-center align-items-center rounded">
														<p class="card-title fs-4 text-warning"><?php echo $ver[0];?></p>
													</div>
													<p class="card-text"><?php echo $ver[1]; ?></p>
													<p class="card-text text-primary fs-1"><?php echo "$" . $ver[3] ?></p>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div class=""></div>
								</div>
							<?php
						}
					} else {
						?>
						NO HAY PRODUCTOS EN VENTA
						<?php
					}
				}
				?>
			</div>
		</div>

		<!-- ... -->

		<script type="text/javascript" src="tus-scripts.js"></script>
	</body>

	</html>

	<script type="text/javascript">
		// ...
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

		$(document).ready(function () {
			$('#tablaArticulosLoad').load("articulos/tablaArticulos2.php");

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
							$('#frmArticulos')[0].reset();
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
							alertify.success("Articulo agregado con exito");
						} else {
							alertify.error("Fallo al subir el archivo :(");
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