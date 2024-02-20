<?php  
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>articulos</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; 
		$c = new conectar();
		$conexion=$c->conexion();
		$sql="SELECT id_categoria,nombreCategoria
		from categorias";
		$result=mysqli_query($conexion,$sql);
		?>
	</head>
	<body>

		<div class="container">
			<h1>Productos en el carrito</h1>
			<div class="row">
				hhhh
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		
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

	</script>

	<script type="text/javascript">
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

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnCarrito').click(function(){
				alertify.success("Producto agregado al carrito de compras");
			});
		}); 
	</script>



	<?php 
}else{
	header("location:../index.php");
}
?>