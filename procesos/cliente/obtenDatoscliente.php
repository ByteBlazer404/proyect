<?php 
	
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Clientes.php";

	$obj= new Clientes();

	echo json_encode($obj->obtenDatosCliente($_POST['idcliente']));
 ?>