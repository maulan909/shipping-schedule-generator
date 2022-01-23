<?php 

require_once "config/koneksi.php";
require_once "config/fungsi.php";
include "excel_reader2.php";

if (isset($_GET)) {
	$page = $_GET['page'];
	$action = $_GET['a'];
	$jenis = $_GET['data'];
	if ($page != "" AND $action != "") {
		if ($page == "kategori") {
			if ($action == "upload") {
				$target = basename($_FILES['filekategori']['name']) ;
				move_uploaded_file($_FILES['filekategori']['tmp_name'], $target);
				// beri permisi agar file xls dapat di baca
				chmod($_FILES['filekategori']['name'],0777);
				 
				// mengambil isi file xls
				$data = new Spreadsheet_Excel_Reader($_FILES['filekategori']['name'],false);
				// menghitung jumlah baris data yang ada
				$jumlah_baris = $data->rowcount($sheet_index=0);
				// jumlah default data yang berhasil di import
				// var_dump($jumlah_baris);
				//jumlah default data yg berhasil di import
				$berhasil = 0;
				for ($i=2; $i <= $jumlah_baris; $i++) { 
					$nama_item = explode("'", $data->val($i,1));
					$nama_item = implode("`", $nama_item);
					$kategori = explode("'", $data->val($i,2));
					$kategori = implode("`", $kategori);

					

					//cek data
					$q = mysqli_query($conn, "SELECT * FROM `tb_kategori_item` WHERE nama_item = '$nama_item' AND kategori_item = '$kategori'");
					$d = mysqli_fetch_assoc($q);
					if ($d == null) {
						mysqli_query($conn, "INSERT INTO tb_kategori_item VALUES('', '$nama_item', '$kategori')");
						$berhasil++;
					}

				}
				echo "<script>
				window.alert('Upload Berhasil');
				window.location.href='index.php?page=kategori'</script>";

			}else if ($action == "add") {
				$no = 0;
				foreach ($_POST['item_kategori'] as $item_kategori) {
					$nama_item = $_POST['nama_item'][$no];

					mysqli_query($conn, "INSERT INTO tb_kategori_item VALUES('', '$nama_item', '$item_kategori')");
					$no++;
				}
				echo "<script>
				window.alert('Upload Berhasil');
				window.location.href='index.php?page=kategori'</script>";
			}else{
				header('Location:index.php?page=kategori');
			}
		}else if ($page == "plot") {
			if ($action == "upload") {
				$target = basename($_FILES['fileplot']['name']) ;
				move_uploaded_file($_FILES['fileplot']['tmp_name'], $target);
				// beri permisi agar file xls dapat di baca
				chmod($_FILES['fileplot']['name'],0777);
				 
				// mengambil isi file xls
				$data = new Spreadsheet_Excel_Reader($_FILES['fileplot']['name'],false);
				// menghitung jumlah baris data yang ada
				$jumlah_baris = $data->rowcount($sheet_index=0);
				// jumlah default data yang berhasil di import
				// var_dump($jumlah_baris);
				//jumlah default data yg berhasil di import
				$berhasil = 0;
				$kode_deliveree = 1;
				for ($i=2; $i <= $jumlah_baris; $i++) { 
					$shipdate = $data->val($i,1);
					$driver = $data->val($i,2);
					$plat = $data->val($i,3);
					$mobil = $data->val($i,4);
					$urutan_load = $data->val($i,5);
					$po_no = $data->val($i,6);
					$add_title = $data->val($i,7);
					
					if ($driver == "DELIVEREE" || $driver == "deliveree") {
						$driver = $driver . $kode_deliveree;
					}
					if ($shipdate == "" && $driver == "" && $plat == "" && $mobil == "" && $urutan_load == "" && $po_no == "" && $add_title == "") {
						$kode_deliveree++;
					}else{

						if ($shipdate == "") {
							$r = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `shipping_date`, `plat_no`, `tipe_mobil`, `driver`, `urutan_load` from tb_plot ORDER BY `id_rute` DESC LIMIT 1"));
							// var_dump($r['shipping_date']);

							$shipdate = $r['shipping_date'];
							if ($driver == "") {
								$driver   = $r['driver'];
							}
							if($mobil == ""){
								$mobil    = $r['tipe_mobil'];
							}
							if ($urutan_load == "") {
								$urutan_load = $r['urutan_load'];
							}
							$plat     = $r['plat_no'];
							
						}
						$add_title = explode("'", $add_title);
						$add_title = implode("`", $add_title);
						$driver = explode("'", $driver);
						$driver = implode("`", $driver);
						$plat = explode("'", $plat);
						$plat = implode("`", $plat);
						$urutan_load = explode("'", $urutan_load);
						$urutan_load = implode("`", $urutan_load);
						// var_dump($da);
						// die;
						mysqli_query($conn, "INSERT INTO tb_plot VALUES('', '$shipdate', '$driver', '$plat', '$mobil', '$urutan_load', '$po_no', '$add_title')");
						$berhasil++;
					}
					

				}
				echo "<script>
				window.alert('Upload Berhasil');
				window.location.href='index.php?page=plot'</script>";
			}else if ($action == "delete") {
				mysqli_query($conn, "DELETE FROM tb_plot");
				echo "<script>
				window.alert('Hapus Data Berhasil');
				window.location.href='index.php?page=plot'</script>";
			}
		}else if ($page == "ship_plot") {
			if ($action == "upload") {
				$target = basename($_FILES['file_ship_plot']['name']) ;
				move_uploaded_file($_FILES['file_ship_plot']['tmp_name'], $target);
				// beri permisi agar file xls dapat di baca
				chmod($_FILES['file_ship_plot']['name'],0777);
				 
				// mengambil isi file xls
				$data = new Spreadsheet_Excel_Reader($_FILES['file_ship_plot']['name'],false);
				// menghitung jumlah baris data yang ada
				$jumlah_baris = $data->rowcount($sheet_index=0);
				// jumlah default data yang berhasil di import
				// var_dump($jumlah_baris);
				//jumlah default data yg berhasil di import
				$berhasil = 0;
				for ($i=2; $i <= $jumlah_baris; $i++) { 
					$order_id = $data->val($i,5);
					$po_no = $data->val($i,6);
					$client_name = $data->val($i,7);
					$add_title = $data->val($i,13);
					$item = $data->val($i,18);
					$unit = $data->val($i,22);
					$total = $data->val($i,23);
					$note = $data->val($i,24);
					
					$order_id = explode("'", $order_id);
					$order_id = implode("`", $order_id);
					$client_name = explode("'", $client_name);
					$client_name = implode("`", $client_name);
					$add_title = explode("'", $add_title);
					$add_title = implode("`", $add_title);
					$item = explode("'", $item);
					$item = implode("`", $item);
					$note = explode("'", $note);
					$note = implode("`", $note);

					$rcek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tb_plot WHERE co_number = '$po_no'"));
						if ($rcek > 0) {
							mysqli_query($conn, "INSERT INTO tb_ship_plot VALUES('', '$order_id', '$po_no', '$client_name', '$add_title', '$item', '$unit', $total, '$note')");
						$berhasil++;
						}

				}
				echo "<script>
				window.alert('Upload Berhasil');
				window.location.href='index.php?page=ship-plot'</script>";
			}else if ($action == "delete") {
				mysqli_query($conn, "DELETE FROM tb_ship_plot");
				echo "<script>
				window.alert('Hapus Data Berhasil');
				window.location.href='index.php?page=ship-plot'</script>";
			}
		}else if ($page == "detail") {
			if ($action == "lihat") {
				if ($jenis == "detail") {
					echo "<title>Detail Shipping Schedule</title>";
					header("Content-type: application/vnd-ms-excel");
					header("Content-Disposition: attachment; filename=Detail Shipping Schedule.xls");

					$q = mysqli_query($conn, "SELECT * FROM tb_plot");
					?>
					<table border="1" cellspacing="0">
						<tr>
							<th>Shipping Date</th>
							<th>Driver</th>
							<th>Plat No</th>
							<th>Tipe Mobil</th>
							<th>Urutan Loading</th>
							<th>Notes</th>
							<th>PO No</th>
							<th>Address Title</th>
							<th>Item</th>
							<th>Unit</th>
							<th>Qty</th>
							<th>Qty Kirim</th>
							<th>Qty Tolak</th>
							<th>Kategori</th>
						</tr>
					<?php
					while ($r = mysqli_fetch_assoc($q)) {
						$q2 = mysqli_query($conn, "SELECT * FROM tb_ship_plot WHERE nomor_co = '$r[co_number]'");
						$cek = mysqli_num_rows($q2);
						// var_dump($cek);
						//ambil data notes
						$querynotes = mysqli_query($conn, "SELECT * FROM tb_ship_plot WHERE nomor_co = '$r[co_number]'");
						$rownotes = mysqli_fetch_assoc($querynotes);
						// var_dump(mysqli_num_rows($querynotes));
						//bikin merge cell
						//cek dlu driver & nomor CO yang sama

						?>
						<tr>
							<td rowspan="<?= $cek; ?>"><?= $r['shipping_date']; ?></td>
							<td rowspan="<?= $cek; ?>"><?= $r['driver']; ?></td>
							<td rowspan="<?= $cek; ?>"><?= $r['plat_no']; ?></td>
							<td rowspan="<?= $cek; ?>"><?= $r['tipe_mobil']; ?></td>
							<td rowspan="<?= $cek; ?>" align="center"><?= $r['urutan_load']; ?></td>
							<td rowspan="<?= $cek; ?>"><?= $rownotes['note']; ?></td>
							<?php
							while ($r2 = mysqli_fetch_assoc($q2)) {
								$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_kategori_item WHERE nama_item = '$r2[item]'"));
								if ($category == null) {
									$kategori = "";
								}else{
									$kategori = $category['kategori_item'];
								}
								?>
								<td align="center"><?= $r2['nomor_co']; ?></td>
								<td><?= $r['address_title']; ?></td>
								<td><?= $r2['item']; ?></td>
								<td align="center"><?= $r2['unit']; ?></td>
								<td align="center"><?= $r2['total']; ?></td>
								<td></td>
								<td></td>
								<td><?= $kategori ?></td>
							</tr>
								<?php
							}
							?>
							
							<!-- <td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td> -->
						</tr>
						<?php
					}
					?>
					</table>
				<?php

				}else if ($jenis != "detail") {
					// if ($jenis != "FROZEN") {
					// 	header('Location:http://localhost/plotgen');
					// }else if ($jenis != "GROCCERIES") {
					// 	header('Location:http://localhost/plotgen');
					// }
					echo "<title>Detail Shipping Schedule</title>";
					header("Content-type: application/vnd-ms-excel");
					header("Content-Disposition: attachment; filename=Detail ". ucfirst(strtolower($jenis)) ." Shipping Schedule.xls");

					$q = mysqli_query($conn, "SELECT * FROM tb_plot");
					?>
					<table border="1" cellspacing="0">
						<tr>
							<th>Notes</th>
							<th>PO No</th>
							<th>Address Title</th>
							<th>Item</th>
							<th>Unit</th>
							<th>Qty</th>
							<th>Ceklis</th>
						</tr>
					<?php
					while ($r = mysqli_fetch_assoc($q)) {

						$q2 = mysqli_query($conn, "SELECT * FROM tb_ship_plot, tb_kategori_item WHERE tb_kategori_item.kategori_item = '$jenis' AND tb_ship_plot.item = tb_kategori_item.nama_item AND tb_ship_plot.nomor_co = '$r[co_number]' ");
						$cek = mysqli_num_rows($q2);
						// var_dump($cek);
						//ambil data notes
						$querynotes = mysqli_query($conn, "SELECT * FROM tb_ship_plot WHERE nomor_co = '$r[co_number]'");
						$rownotes = mysqli_fetch_assoc($querynotes);
						// var_dump(mysqli_num_rows($querynotes));
						//bikin merge cell
						//cek dlu driver & nomor CO yang sama
						?>
						<?php if ($cek > 0): ?>
							<tr>
								<!-- <td><?= $cek; ?></td> -->
								<td rowspan="<?= $cek; ?>"><?= $rownotes['note']; ?></td>
								<?php
								while ($r2 = mysqli_fetch_assoc($q2)) {
									$category = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tb_kategori_item WHERE nama_item = '$r2[item]'"));
									if ($category != null) {
										if ($category['kategori_item'] == "FROZEN") {
											?>
												<td align="center"><?= $r2['nomor_co']; ?></td>
												<td><?= $r['address_title']; ?></td>
												<td><?= $r2['item']; ?></td>
												<td align="center"><?= $r2['unit']; ?></td>
												<td align="center"><?= $r2['total']; ?></td>
												<td></td>
											</tr>
											<?php
										}else if ($category['kategori_item'] == "GROCCERIES") {
											?>
												<td align="center"><?= $r2['nomor_co']; ?></td>
												<td><?= $r['address_title']; ?></td>
												<td><?= $r2['item']; ?></td>
												<td align="center"><?= $r2['unit']; ?></td>
												<td align="center"><?= $r2['total']; ?></td>
												<td></td>
											</tr>
											<?php
										}
									}
									?>

									
									<?php
								}
								?>
								
								<!-- <td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td> -->
							</tr>
						<?php endif ?>
						<?php
					}
					?>
					</table>
				<?php
				}
				
				
			}
		}else{
			header('Location:index.php');
		}
	}else{
		header('Location:index.php');
	}
}else{
	header('Location:index.php');
}
