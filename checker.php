<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">CO Checker</h1>
</div>
<div class="row">
	    <div class="col-lg-12">
	    	<h4>Berikut Nomor CO yang belum masuk ke dalam Data Detail Shipping Schedule SMD</h4>
	    	<div class="col-lg-12">
	    		<?php 
	    		$q = mysqli_query($conn, "SELECT * FROM tb_plot");

	    		$no = 1;
	    		 ?>
	    		<table class="table">
	    			<tr>
	    				<th scope="col" width="70">No</th>
	    				<th scope="col" width="400">Nomor CO</th>
	    				<th scope="col">Address Title</th>
	    			</tr>
	    			<?php 
	    			while ($r = mysqli_fetch_assoc($q)) {
	    				$q2 = mysqli_query($conn, "SELECT * FROM tb_ship_plot WHERE nomor_co = '$r[co_number]'");
	    				?>
	    				<?php if (mysqli_num_rows($q2) < 1): ?>
		    					<tr>
			    				<td><?= $no; ?></td>
			    				<td><?= $r['co_number']; ?></td>
			    				<td><?= $r['address_title']; ?></td>
			    			</tr>
			    			<?php 
			    			$no++; ?>
	    				<?php endif ?>
	    				<?php
	    			}
	    			 ?>
	    			
	    		</table>
	    	</div>
		</div>
</div>