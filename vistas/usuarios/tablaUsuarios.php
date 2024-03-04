<?php  

	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT id_usuario,
					nombre,
					apellido,
					email
			from usuarios";
	$result=mysqli_query($conexion,$sql);


?>

<table class="table table-hover table-condensed table-bordered rounded-3 overflow-hidden" style="text-align: center;">
	<caption><label>Usuarios</label></caption>
	<tr class="table-dark text-light text-center">
		<td>Id</td>
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Usuario</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $ver[0] ?></td>
		<td><?php echo $ver[1] ?></td>
		<td><?php echo $ver[2] ?></td>
		<td><?php echo $ver[3] ?></td>
		<td>
			<button type="button" class="btn d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#updateUser">
				<img src="../img/edit-icon.svg" alt="edit client" title="editar cliente">
			</button>
		</td>
		<td>
			<span class="btn d-flex justify-content-center align-items-center" onclick="eliminaUsuario('<?php echo $ver[0]; ?>')">
				<img src="../img/delete-icon.svg" alt="delete client" title="eliminar cliente">
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>