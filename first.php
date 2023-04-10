<!DOCTYPE html>
<html>
<head>
	<title>Perhitungan Gaji Karyawan</title>
</head>
<body>
	<h2>Form Perhitungan Gaji Karyawan</h2>
	<form action="" method="post">
		<label>Golongan:</label>
		<select name="golongan">
			<option value="1">Golongan 1</option>
			<option value="2">Golongan 2</option>
			<option value="3">Golongan 3</option>
		</select><br><br>
		<label>Status Keluarga:</label>
		<input type="radio" name="status" value="belum" checked>Belum Menikah
		<input type="radio" name="status" value="sudah">Sudah Menikah<br><br>
		<label>Jumlah Anak:</label>
		<input type="number" name="jumlah_anak" min="0" max="3"><br><br>
		<input type="submit" name="hitung" value="Hitung">
	</form>
	<br>

	<?php
	if(isset($_POST['hitung'])){
		$golongan = $_POST['golongan'];
		$status = $_POST['status'];
		$jumlah_anak = $_POST['jumlah_anak'];

		$gaji_pokok = 0;
		$pajak = 0;
		$tunjangan_keluarga = 0;
		$tunjangan_anak = 0;
		$tunjangan_profesi = 0;
		$total_tunjangan = 0;
		$gaji_kotor = 0;
		$gaji_bersih = 0;

		if($golongan == 1){
			$gaji_pokok = 1000000;
			$pajak = 0;
		} elseif($golongan == 2){
			$gaji_pokok = 2000000;
			$pajak = 0.025;
		} elseif($golongan == 3){
			$gaji_pokok = 3000000;
			$pajak = 0.05;
		}

		if($status == 'sudah'){
			$tunjangan_keluarga = 200000;
			if($jumlah_anak > 0 && $jumlah_anak <= 3){
				$tunjangan_anak = $jumlah_anak * 100000;
			} elseif($jumlah_anak > 3){
				$tunjangan_anak = 300000;
			}
		}

		$tahun_kerja = 2; // misalnya karyawan sudah bekerja selama 2 tahun
		$tunjangan_profesi = floor($tahun_kerja/2) * 500000;

		$total_tunjangan = $tunjangan_keluarga + $tunjangan_anak + $tunjangan_profesi;

		$gaji_kotor = $gaji_pokok + $total_tunjangan;

		$pajak = $pajak * $gaji_kotor;

		$gaji_bersih = $gaji_kotor
	?>

	<h2>Hasil Perhitungan Gaji Karyawan</h2>
	<table border="1">
		<tr>
			<td>Gaji Pokok</td>
			<td>Rp. <?php echo number_format($gaji_pokok, 0, ',', '.'); ?></td>
		</tr>
		<tr>
			<td>Tunjangan Keluarga</td>
			<td>Rp. <?php echo number_format($tunjangan_keluarga, 0, ',', '.'); ?></td>
		</tr>
		<tr>
			<td>Tunjangan Anak</td>
			<td>Rp. <?php echo number_format($tunjangan_anak, 0, ',', '.'); ?></td>
		</tr>
		<tr>
			<td>Tunjangan Profesi</td>
			<td>Rp. <?php echo number_format($tunjangan_profesi, 0, ',', '.'); ?></td>
		</tr>
		<tr>
			<td>Total Tunjangan</td>
			<td>Rp. <?php echo number_format($total_tunjangan, 0, ',', '.'); ?></td>
		</tr>
		<tr>
			<td>Gaji Kotor</td>
			<td>Rp. <?php echo number_format($gaji_kotor, 0, ',', '.'); ?></td>
		</tr>
		<tr>
			<td>Pajak</td>
			<td>Rp. <?php echo number_format($pajak, 0, ',', '.'); ?></td>
		</tr>
		<tr>
			<td>Gaji Bersih</td>
			<td>Rp. <?php echo number_format($gaji_bersih, 0, ',', '.'); ?></td>
		</tr>
	</table>

<?php } ?>
