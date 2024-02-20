<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new ventas();

	$sql="SELECT id_venta,
				fechaCompra,
				id_cliente 
			from ventas group by id_venta";
	$result=mysqli_query($conexion,$sql); 
	?>

<h4>Reporte de Compra</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" id="tablainf" style="text-align: center;">
				<caption><label>Reporte:</label></caption>
				<tr>
					<td>Folio</td>
					<td>Fecha</td>
					<td>Total de compra</td>
					<td>Ticket</td>
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td><?php echo $ver[1] ?></td>
					<td>
						<?php 
							echo "$".$obj->obtenerTotal($ver[0]);
						 ?>
					</td>
					<td>
						<a href="../procesos/ventas/crearTicketCompraPdf.php?idventa=<?php echo $ver[0]; ?>" class="btn btn-danger btn-sm">
							Ticket <span class="glyphicon glyphicon-list-alt"></span>
						</a>
					</td>
				</tr>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>

<script type="text/javascript">
	function eliminaCliente(tablainf){
			alertify.confirm('¿Desea eliminar este cliente?', 
				function(){ 
					$.ajax({
						type:"POST",
						data:"tablainf=" + tablainf,
						url:"../procesos/ventas/eliminaVenta.php",
						success:function(r){
							if(r==1){
								$("#tablainf").load("ventas/ventasyReportes.php");
								alertify.success("Venta eliminada con exito");
							}else{
								alertify.error("No se pudo eliminar esta venta");
							}
						}
					});
				}, 
				function(){ 
					alertify.error('Cancelado')
				});
		}
</script>