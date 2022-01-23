<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=test.xls");
 ?>
<table border="1" cellspacing="0">
	<tr>
		<td>No</td>
		<td>Shipping Date</td>
		<td>Adress Title</td>
	</tr>
	<tr>
		<td>1</td>
		<td rowspan="2" style="text-align: center;"><b>2-Sep-2020</b></td>
		<td>DC MATAHARI</td>
	</tr>
	<tr>
		<td>2</td>
		<td>DC TRANS</td>
	</tr>
	<tr>
		<td>1</td>
		<td rowspan="2" style="text-align: center;">2-Sep-2020</td>
		<td>DC MATAHARI</td>
	</tr>
	<tr>
		<td>2</td>
		<td>DC TRANS</td>
	</tr>
</table>