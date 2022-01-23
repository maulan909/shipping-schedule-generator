<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Upload Plot</h1>
</div>
<div class="row">
    <div class="col-lg-12">
		<form method="POST" action="action.php?page=plot&a=upload" enctype="multipart/form-data">
		    <input type="file" name="fileplot">
		    <input type="submit" name="submit" class="btn btn-primary" value="Upload!">
		</form>
	</div>
	<div class="col-lg-12">
		<a class="btn btn-danger" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-trash fa-sm fa-fw mr-2"></i>
            Hapus Data
        </a>
    </div>
    <div class="col-lg-12">
    	<?php 
    	$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT driver FROM tb_plot"));
    	error_reporting(0);
    	if ($row['driver'] != "") {
    		echo "Status Data : Terisi";
    	}else{
    		echo "Status Data : Kosong";
    	}
    	 ?>
    </div>
</div>