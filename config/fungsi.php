<?php

require_once "config/koneksi.php";

function cekCO(){
	global $conn;
	$q = mysqli_query($conn, "SELECT * FROM tb_plot");
	$checker = 0;
	while ($r = mysqli_fetch_assoc($q)) {
	    $q2 = mysqli_query($conn, "SELECT * FROM tb_ship_plot WHERE nomor_co = '$r[co_number]'");
	    if (mysqli_num_rows($q2) < 1) {
	    	$checker = 1;

	    }
	}
	return $checker;
}

function cekItem(){
	global $conn;
	$q = mysqli_query($conn, "SELECT item FROM tb_ship_plot");
	$cekitem = 0;
	$rayy = 0;
	$theItem = [];
	while ($r = mysqli_fetch_assoc($q)){
		$q2 = mysqli_query($conn, "SELECT * FROM tb_kategori_item WHERE nama_item = '$r[item]'");
		// var_dump(mysqli_fetch_assoc($q2));
		// echo "<br>";
		// echo mysqli_num_rows($q2) . "<br>";
		if (mysqli_num_rows($q2) < 1) {
			// echo count($theItem) . "<br>";
			if (count($theItem) == 0) {
				array_push($theItem, $r['item']);
			}else{
				while ($rayy < count($theItem)) {
					if ($theItem[$rayy] != $r['item']) {
						array_push($theItem, $r['item']);
					}
					$rayy++;
				}
			}
			
		}
	}
	return $theItem;
}