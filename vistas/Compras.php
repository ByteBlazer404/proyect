<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Compras de articulos</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Comprar productos</h1>
		<div class="row">
			<div class="col-sm-12">
				<span class="btn btn-default" id="ventaProductosBtn">Comprar producto</span>
				<span class="btn btn-default" id="ventasHechasBtn">Ver compra</span>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div id="ventaProductos"></div>
				<div id="ventasHechas"></div>	
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){

		$('#ventaProductosBtn').click(function(){
			esconderSeccionVenta()
			$('#ventaProductos').load('ventas/ComprarProducto.php');
			$('#ventaProductos').show();
		});

		$('#ventasHechasBtn').click(function(){
			esconderSeccionVenta()
			$('#ventasHechas').load('ventas/reporteCompra.php');
			$('#ventasHechas').show();
		});
	});

	function esconderSeccionVenta(){
		$('#ventaProductos').hide();
		$('#ventasHechas').hide();
	}
</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>