<?php 
include("header.php");
include("koneksi.php");
?>
	<div class="container">
		<div class="content">
			<h2>Data City</h2>
			<hr />
			<a href="city.php" class="btn btn-info">1. CRUD City</a>
			<a href="company.php" class="btn btn-info">2. CRUD Company</a>
			<a href="tambahcity.php" class="btn btn-success">Add Data</a>
			<hr />



			
			<?php
			if(isset($_GET['aksi']) == 'delete'){ 
				$idcity = $_GET['idcity']; 
				$cek = mysqli_query($koneksi, "Select * from city WHERE idcity='$idcity'"); 
				if(mysqli_num_rows($cek) == 0){ 
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; 
				}else{ 
					$delete = mysqli_query($koneksi, "DELETE FROM city WHERE idcity='$idcity'"); 
					if($delete){ 
						echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; 
					}else{ 
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>'; 
					}
				}
			}
			?>

		
			<!-- memulai tabel responsive -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>CityName</th>
						<th>Country</th>
						<th>Tools</th>
					</tr>
					<?php
						$sql = mysqli_query($koneksi, "Select * from city"); 
					
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>';
					}else{ 
						$no = 1; 
						while($row = mysqli_fetch_assoc($sql)){ 
							echo '
							<tr>
								<td>'.$no.'</td>
								<td>'.$row['cityname'].'</td>
								<td>'.$row['country'].'</td>
								<td>
									
									<a href="editcity.php?idcity='.$row['idcity'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="city.php?aksi=delete&idcity='.$row['idcity'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['cityname'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
								</td>
							</tr>
							';
							$no++; 
						}
					}
					?>
				</table>
			</div> <!-- /.table-responsive -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
