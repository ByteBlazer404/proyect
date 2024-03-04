 <?php  

	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT id_cliente,
				nombre,
				apellido,
				direccion,
				email,
				telefono,
				rfc 
			from clientes ";

	$result=mysqli_query($conexion,$sql);

 ?>


<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered rounded-3 overflow-hidden" style="text-align: center;">
		<caption><label>Clientes</label></caption>
		<tr class="table-dark text-center text-light">
			<td>Nombre</td>
			<td>Apellido</td>
			<td>Direccion</td>
			<td>Email</td>
			<td>Telefono</td>
			<td>RFC</td>
			<td colspan="2">Acciones</td>
		</tr>

		<?php while($ver=mysqli_fetch_row($result)): ?>

		<tr>
			<td><?php echo $ver[1]; ?></td>
			<td><?php echo $ver[2]; ?></td>
			<td><?php echo $ver[3]; ?></td>
			<td><?php echo $ver[4]; ?></td>
			<td><?php echo $ver[5]; ?></td>
			<td><?php echo $ver[6]; ?></td>
			<td>
				<button type="button" class="btn d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#updateClient">
					<img src="../img/edit-icon.svg" alt="edit client" title="editar cliente">
				</button>
			</td>
			<td>
				<span class="btn d-flex justify-content-center align-items-center" onclick="eliminaCliente('<?php echo $ver[0]; ?>')">
					<img src="../img/delete-icon.svg" alt="delete client" title="eliminar cliente">
				</span>
			</td>
		</tr>
	<?php endwhile; ?>
	</table>
</div>