<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Upload Kategori</h1>
</div>
<div class="row">
    <div class="col-lg-12">
		<form method="POST" action="action.php?page=kategori&a=upload" enctype="multipart/form-data">
		    <input type="file" name="filekategori" class="form">
		    <input type="submit" name="submit" class="btn btn-primary" value="Upload!">
		</form>
	</div>
	<br>
	<br>
	<?php if (count(cekItem()) > 0): ?>
		<div class="col-lg-12">
			<h4>Berikut Data Item Kategori yang belum terdaftar di sistem</h4>
		<form class="form-group" action="action.php?page=kategori&a=add" method="POST">
		<?php 
		$raya = 0;
		while ($raya < count(cekItem())) {
			?>
			<div class="col-lg-6">
				<?= cekItem()[$raya]; ?><input type="hidden" name="nama_item[]" value="<?= cekItem()[$raya]; ?>">
				<select name="item_kategori[]" id="" class="form-control">
					<option value="BUAH">Buah</option>
					<option value="FROZEN">Frozen</option>
					<option value="GROCCERIES">Grocceries</option>
					<option value="REMPAH">Rempah</option>
					<option value="SAYUR">Sayur</option>
				</select>
				<br>
			</div>
			<?php
			$raya++;
		}

		 ?>
		 	<button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Simpan</button>
		</form>
	</div>
	<?php endif ?>
	
	
</div>