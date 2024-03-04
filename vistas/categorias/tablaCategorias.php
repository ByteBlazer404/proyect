 
 	<?php 
 		require_once "../../clases/Conexion.php";
 		$c= new conectar();
 		$conexion=$c->conexion();

 		$sql="SELECT id_categoria,nombreCategoria 
 				from categorias";
 		$result=mysqli_query($conexion,$sql);
 	 ?>


<table class="table table-hover table-condensed table-bordered rounded-3 overflow-hidden">
 	<thead class="table-dark text-light text-center">
	 <tr>
		<td style="width:80%">Categorias</td>
		<td colspan="3" style="width: 20%;">Acciones</td>
	</tr>
	</thead>
	<?php 
		while ($ver=mysqli_fetch_row($result)):
		
	 ?>

	<tr>
		<td class="text-star"><?php echo $ver[1] ?></td>
		<td>
			<button type="button" class="btn d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#actualizaCategoria">
				<img src="../img/edit-icon.svg" alt="edit category" title="editar categoria">
			</button>
		</td>
		<td>
			<span class="btn d-flex justify-content-center align-items-center" onclick="eliminaCategoria('<?php echo $ver[0] ?>')" >
				<img src="../img/delete-icon.svg" alt="delete category" title="eliminar categoria">
			</span>
		</td>
		<td>
			<button type="button" class="btn d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#showCategory">
				<img src="../img/show-icon.svg" alt="show" title="ver categoria">
			</button>
		</td>
	</tr>
<?php endwhile; ?>
</table> 