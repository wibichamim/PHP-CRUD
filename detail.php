<?php 
include("header.php"); 
include("koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			
			<?php
				$id = $_GET['id'];
				
				$sql = mysqli_query($koneksi, "Select members.id,members.fullname,members.email,members.foto, company.name,city.cityname, city.country from members join company on members.idcompany=company.idcompany join city on members.idcity=city.idcity WHERE id='$id'"); 
				if(mysqli_num_rows($sql) == 0){
					header("Location: index.php");
				}else{
					$row = mysqli_fetch_assoc($sql);
				}
				
				if(isset($_GET['aksi']) == 'delete'){ 
					$delete = mysqli_query($koneksi, "DELETE FROM members WHERE id='$id'"); 
					if($delete){ 
						echo '<div class="alert alert-danger alert-dismissable">><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil dihapus.</div>'; 
					}else{ 
						echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal dihapus.</div>'; 
					}
				}
			?>

			<h2>Data Member &raquo; <?php echo $row['fullname']; ?></h2>
			<hr />

			<!-- Tabel Responsive -->
			<table class="table table-striped table-condensed">
				<tr>
					<td id="cell_1" width="150" height="180">
						<?php
						echo "<img src='img/".$row['foto']."' width='150' height='180' >"

						?>
					</td>
				</tr>
				<tr>
					<th>Email</th>
					<td><?php echo $row['email']; ?></td>
				</tr>
				<tr>
					<th>Company</th>
					<td><?php echo $row['name']; ?></td>
				</tr>
				<tr>
					<th>City</th>
					<td><?php echo $row['cityname']; ?></td>
				</tr>
				<tr>
					<th>Country</th>
					<td><?php echo $row['country']; ?></td>
				</tr>
			</table>
			
			<a href="index.php" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali</a>
			<a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit Data</a>
			<a href="detail.php?aksi=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin akan mengahapus data <?php echo $row['fullname']; ?>')"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Hapus Data</a>
		</div> <!-- /.content -->
	</div> <!-- /.container -->
