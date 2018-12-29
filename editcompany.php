<?php 
include("header.php"); 
include("koneksi.php"); 
?>
	<div class="container">
		<div class="content">

			
			<?php
				$idcompany = $_GET['idcompany'];
				$sql = mysqli_query($koneksi, "SELECT * FROM company WHERE idcompany='$idcompany'"); 
				if(mysqli_num_rows($sql) == 0){
					header("Location: company.php");
				}else{
					$row = mysqli_fetch_assoc($sql);
				}

				$msg = "";
				if(isset($_POST['save'])){ 
			
					$name	   = $_POST['name'];
					

					$update = mysqli_query($koneksi, "UPDATE company SET name='$name' WHERE idcompany='$idcompany'") or die(mysqli_error()); 
					if($update){ 
						header("Location: editcompany.php?idcompany=".$idcompany."&pesan=sukses"); 
					}else{ 
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data gagal disimpan, silahkan coba lagi.</div>'; 
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){ 
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil disimpan. <a href="company.php"><- Kembali</a></div>'; 
			}
		
			?>

			<h2>Edit Company &raquo; <?php echo $row['name']; ?></h2>
			<hr />
		
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label">Name</label>
					<div class="col-sm-4">
						<input type="text" name="name" value="<?php echo $row ['name']; ?>" class="form-control" placeholder="companyname">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Company">
						<a href="company.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>				
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
