<?php 
include("header.php"); 
include("koneksi.php"); 
?>
	<div class="container">
		<div class="content">
	


			<?php

			include("csv.php");
			$csv = new csv();
			if(isset($_POST["sub"])){
					$csv->import($_FILES['csv']['tmp_name']);

			}

			 ?>
			
			<?php
				if(isset($_GET['aksi']) == 'delete'){
					$id = $_GET['id'];
					$cek = mysqli_query($koneksi, "Select members.id,members.fullname,members.email,company.name,city.cityname from members join company on members.idcompany=company.idcompany join city on members.idcity=city.idcity WHERE id='$id'");
					if(mysqli_num_rows($cek) == 0){
						echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data tidak ditemukan.</div>'; 
					}else{ 
						$delete = mysqli_query($koneksi, "DELETE FROM members WHERE id='$id'"); 
						if($delete){ 
							echo '<div class="alert alert-primary alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data berhasil dihapus.</div>'; 
						}else{ 
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Data gagal dihapus.</div>';
						}
					}
				}
			?>

			<h2>Data Member</h2>
			<hr />
			<div class="row">
				<div class="col-md-6">
					<a href="city.php" class="btn btn-info">1. CRUD City</a>
					<a href="company.php" class="btn btn-info">2. CRUD Company</a>
					<a href="tambah.php" class="btn btn-success">Add Data</a>
				</div>
				<div class="col-md-6">
					<form action="" method="post" enctype="multipart/form-data" class="form-inline">
					<label>File Csv</label>	
				<div class="form-group">
					<input type="file" class="form-control" name="csv">
					<input type="submit" name="sub" value="import csv" class="btn btn-primary">
				</div>
					</form>
				</div>
				</div>
			</div>			
		<hr/>
			<!-- memulai tabel responsive -->
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No</th>
						<th>Fullname</th>
						<th>Email</th>
						<th>Company</th>
						<th>City</th>
						<th>Tools</th>
					</tr>

					<?php
						$sql = mysqli_query($koneksi, "Select members.id,members.fullname,members.email,company.name,city.cityname, city.country from members join company on members.idcompany=company.idcompany join city on members.idcity=city.idcity"); 
					
					if(mysqli_num_rows($sql) == 0){ 
						echo '<tr><td colspan="14">Data Tidak Ada.</td></tr>'; 
					}else{ 
						$no = 1; 
						while($row = mysqli_fetch_assoc($sql)){ 
							echo '
							<tr>
								<td>'.$no.'</td>
								<td><a href="detail.php?id='.$row['id'].'">'.$row['fullname'].'</a></td>
								<td>'.$row['email'].'</td>
								<td>'.$row['name'].'</td>
								<td>'.$row['cityname'].",".$row['country'].'</td>
								<td>
									
									<a href="edit.php?id='.$row['id'].'" title="Edit Data" data-toggle="tooltip" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
									<a href="index.php?aksi=delete&id='.$row['id'].'" title="Hapus Data" data-toggle="tooltip" onclick="return confirm(\'Anda yakin akan menghapus data '.$row['fullname'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
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
