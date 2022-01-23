<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Download Detail Shipping Schedule</h1>
</div>
<div class="row">
	<form action="action.php" method="GET">
		<div class="col-lg-12 form-group">
			<input type="hidden" name="page" value="detail">
			<input type="hidden" name="a" value="lihat">
			Pilih Data yang ingin di Download : <br>
			<select class="form-control" name="data" id="data">
				<option value="">Pilih Data</option>
				<option value="detail">Detail Shipping Schedule</option>
				<option value="FROZEN">Frozen</option>
				<option value="GROCCERIES">Grocceries</option>
			</select>
		</div>
	    <div class="col-lg-12">
	    	<input type="submit" class="btn btn-primary" value="Download!">
			    <!-- <a href="action.php?page=detail&a=lihat" class="btn btn-primary"><i class="fa fa-download"></i> Download!</a> -->
		</div>
	</form>
</div>