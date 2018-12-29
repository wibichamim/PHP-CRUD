<?php 
include("header.php");
include("koneksi.php"); 
?>
	<div class="container">
		<div class="content">
			<h2>Data Company &raquo; Tambah Data</h2>
			<hr />

			
			<?php

				$msg = "";
				if(isset($_POST['add'])){ 
				
				$name = $_POST['name'];

						$insert = mysqli_query($koneksi, "INSERT INTO company( name) VALUES('$name')") or die(mysqli_error()); 
						if($insert){ 
							echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Member Berhasil disimpan <a href="company.php"><- Kembali</a></div>'; 
						}else{ 
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Member Gagal Di simpan! <a href="company.php"><- Kembali</a></div>'; 
						}
					
			}
			?>
			<!-- bagian ini merupakan bagian form untuk menginput data yang akan dimasukkan ke database -->
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label">Name</label>
					<div class="col-sm-4">
						<input type="text" name="name" class="form-control" placeholder="Name" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Simpan" data-toggle="tooltip" title="Simpan Data Company">
						<a href="company.php" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Batal">Batal</a>
					</div>
				</div>
			</form> <!-- /form -->
		</div> <!-- /.content -->
	</div> <!-- /.container -->
