<?php  
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>clientes</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmClientes">
						<input type="text" hidden="" id="idcliente" name="idcliente">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellido" name="apellido">
						<label>Dirección</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">
						<label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefono" name="telefono">
						<label>RFC</label>
						<input type="text" class="form-control input-sm" id="rfc" name="rfc">
						<p></p>
						<span class="btn btn-primary" id="btnAgregarClientes">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaClientesLoad"></div>
				</div>
			</div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="idclienteU" name="idclienteU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
							<label>Dirección</label>
							<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
							<label>RFC</label>
							<input type="text" class="form-control input-sm" id="rfcU" name="rfcU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarClientesU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
					</div>
				</div>
			</div>
		</div>


	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosCliente(idcliente){
			$.ajax({
				type:"POST",
				data:"idcliente=" +idcliente,
				url:"../procesos/cliente/obtenDatoscliente.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idclienteU').val(dato['id_cliente']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#direccionU').val(dato['direccion']);
					$('#emailU').val(dato['email']);
					$('#telefonoU').val(dato['telefono']);
					$('#rfcU').val(dato['rfc']);

				}
			});
		}

		function eliminaCliente(idcliente){
			alertify.confirm('¿Desea eliminar este cliente?', 
				function(){ 
					$.ajax({
						type:"POST",
						data:"idcliente=" + idcliente,
						url:"../procesos/cliente/eliminaCliente.php",
						success:function(r){
							if(r==1){
								$("#tablaClientesLoad").load("clientes/tablaClientes.php");
								alertify.success("Cliente eliminado con exito");
							}else{
								alertify.error("No se pudo eliminar al cliente");
							}
						}
					});
				}, 
				function(){ 
					alertify.error('Cancelado')
				});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$("#tablaClientesLoad").load("clientes/tablaClientes.php");

			$('#btnAgregarClientes').click(function(){

				vacios=validarFormVacio('frmClientes');

				/*if(vacios > 0){
					alertify.alert("Debes llenar todos los campos");
					return false;
				}*/

				datos=$('#frmClientes').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/cliente/agregaCliente.php",
					success:function(r){
						if(r==1){
							$('#frmClientes')[0].reset();
							$("#tablaClientesLoad").load("clientes/tablaClientes.php");
							alertify.success("Cliente agregado con exito :D");
						}else{
							alertify.error("No se pudo agregar al cliente");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarClientesU').click(function(){
				datos=$('#frmClientesU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/cliente/actualizaCliente.php",
					success:function(r){
						if(r==1){
							$('#frmClientes')[0].reset();
							$("#tablaClientesLoad").load("clientes/tablaClientes.php");
							alertify.success("Cliente actualizado con exito :D");
						}else{
							alertify.error("No se pudo actualizar al cliente");
						}
					}
				});
			});
		});
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>