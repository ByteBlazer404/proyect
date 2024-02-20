
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

    <div class="container container-fluid" style="padding-top: 5.5%;">
        <h1>Productos en venta</h1>
        <div class="row">
            <?php
            require_once "../clases/Articulos.php";

            $c = new conectar();
            $conexion = $c->conexion();
            $sql = "SELECT art.nombre, art.descripcion, art.cantidad, art.precio, img.ruta, cat.nombreCategoria, art.id_producto
                FROM articulos as art
                INNER JOIN imagenes as img ON art.id_imagen = img.id_imagen
                INNER JOIN categorias as cat ON art.id_categoria = cat.id_categoria";

            $result = mysqli_query($conexion, $sql);

            // Empieza el ciclo de repetición de productos
            $cantidad = 1;

            while ($ver = mysqli_fetch_row($result)) {
                if ($cantidad > 0) {
                    for ($i = 0; $i < $cantidad; $i++) {
            ?>
                        <!-- ... -->
                        <div class="col-md-3">
								<div class="panel panel-default">
									<div class="panel-body" style="text-align: center;">
										<form id="frmCarrito">
											<?php 
										$imgver=explode("/", $ver[4]); 
										$imgruta=$imgver[1]."/".$imgver[2]."/".$imgver[3];
										?>
										<img width="80" height="80" src="<?php echo $imgruta ?>">
										<p><?php echo $ver[0]; ?></p>
										<p><?php echo $ver[1]; ?></p>
										<span><?php echo "$".$ver[3] ?></span>
										</form>

									</div>
								</div>
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
    function agregaDatosArticulo(idarticulo){
			$.ajax({
				type:"POST",
				data:"idart="+ idarticulo,
				url:"../procesos/articulos/obtenDatosArticulos.php",
				success:function(r){
					
					dato=jQuery.parseJSON(r);
					$('#id_Articulo').val(dato['id_producto']);
					$('#categoriaSelectU').val(dato['id_categoria']);
					$('#nombreU').val(dato['nombre']);
					$('#descripcionU').val(dato['descripcion']);
					$('#cantidadU').val(dato['cantidad']);
					$('#precioU').val(dato['precio']);

				}
			});
		}

	$(document).ready(function(){
			$('#tablaArticulosLoad').load("articulos/tablaArticulos2.php");

			$('#btnAgregaArticulo').click(function(){

				vacios=validarFormVacio('frmArticulos');

				if(vacios > 0){
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

					success:function(r){

						if(r==1){
							$('#frmArticulos')[0].reset();
							$('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
							alertify.success("Articulo agregado con exito");
						}else{
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
