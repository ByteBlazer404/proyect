 <?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$obj= new ventas();

	echo $obj->eliminaVenta($_POST['tablainf']);

 ?>