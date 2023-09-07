

<?php
$mode		= $this->uri->segment(3);

if ($mode == "ver" || $mode == "act_ver" || $mode == "set_ver") {
	$act			= "act_ver";
	$idp			= $datpil->id;
	$nip			= $datpil->nip; 
	$nama			= $datpil->nama; 
	$skpd			= $datpil->skpd; 
	$jurusan		= $datpil->jurusan;
	$jabatan2		= $datpil->jabatan2;
	$ttl			= $datpil->ttl; 
	$jenkel			= $datpil->jenkel; 
	$pangkat		= $datpil->pangkat; 
	$gol			= $datpil->gol; 
	$jabatan		= $datpil->jabatan; 
	$tkpendid		= $datpil->tkpendid; 
	$tkpendid2		= $datpil->tkpendid2;
	$jurusan2		= $datpil->jurusan2;
	$klas			= $datpil->klas;
	$klas2			= $datpil->klas2;
	$unit_kerja		= $datpil->unit_kerja;
	$unit_kerja2	= $datpil->unit_kerja2;
	$lok_uji		= $datpil->lok_uji;
	$no_surat		= $datpil->no_surat;
	$tgl_surat		= $datpil->tgl_surat;
	$file1			= $datpil->file1;
	$s_ver			= $datpil->s_ver;
if($s_ver=="TMS"){
	$tgl_uji		= "";
	$s_uji			= ""; 
	$s_sk			= ""; 
	$jam_uji		= "";
	$jam_uji2		= "";
	$lok_uji		= "";	
	$keterangan		= ""; 
}else{
	$tgl_uji		= $datpil->tgl_uji;
	$s_uji			= $datpil->s_uji; 
	$s_sk			= $datpil->s_sk; 
	$jam_uji		= $datpil->jam_uji;
	$jam_uji2		= $datpil->jam_uji2;	
	$lok_uji		= $datpil->lok_uji;
	$keterangan		= $datpil->keterangan; 
}
	
		
} else {
	
redirect('admin/mutasi_kelas');
}	
?>
<div class="navbar navbar-inverse"style="background-color:#3CB371;">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Verifikasi Usul</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

	
	
	
	
	<div class="row-fluid well" style="overflow: hidden">
		
	<div class="col-lg-6">
		<table  class="table-form">
		<tr><td width="150%">Nama Pegawai</td><td><b><input type="text" name="nama" required value="<?php echo $nama; ?>" id="nama" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">N I P</td><td><b><input type="text" name="skpd" id="skpd" required value="<?php echo $skpd; ?>" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Pangkat </td><td><b><input type="text" name="pangkat" required value="<?php echo $pangkat; ?>" id="pangkat" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Golongan </td><td><b><input type="text" name="gol" required value="<?php echo $gol; ?>" id="gol" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Pendidikan </td><td><b><input type="text" name="jurusan" required value="<?php echo $jurusan; ?>" id="jurusan" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Jabatan </td><td><b><input type="text" name="jabatan" required value="<?php echo $jabatan; ?>" id="jabatan" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Kelas Jabatan </td><td><b><input type="text" name="klas" required value="<?php echo $klas; ?>" id="klas" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Unit Kerja </td><td><b><input type="text" name="unit_kerja" required value="<?php echo $unit_kerja; ?>" id="unit_kerja" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Nomor Surat</td><td><b><input type="text" name="no_surat" required value="<?php echo $no_surat; ?>" style="width: 300px" readonly class="form-control"></td></tr>
		<tr><td width="150%">Tanggal Surat</td><td><b><input type="text" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" style="width: 100px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Pendidikan Yang Diusulkan</td><td><b><input type="text" name="nama" value="<?php echo $tkpendid2; ?>" id="nama" style="width: 100px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Jurusan</td><td><b><input type="text" name="jurusan2" required value="<?php echo $jurusan2; ?>" id="jurusan2" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Jabatan Yang Diusulkan</td><td><b><input type="text" name="jabatan2" required value="<?php echo $jabatan2; ?>" id="jabatan2" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Unit Kerja Yang Diusulkan</td><td><b><input type="text" name="unit_kerja2" required value="<?php echo $unit_kerja2; ?>" id="unit_kerja2" style="width: 300px" readonly class="form-control"></b></td></tr>
		<br>
		</table>
		<br>
		
	</div>	
		<table  class="table-form">
		<form action="<?=base_URL()?>admin/mutasi_kelas/set_ver" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
		<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
		<tr> <td colspan="3"><b>Hasil Verifikasi<?php echo $s_ver; ?></b></td> </tr>
		<tr><td width="50%" >Dokumen Persyaratan</td><td><b>
		<select name="s_ver" class="form-control" style="width: 100px" required><option value="<?php echo $s_ver; ?>"> - Status - </option>
			<?php
				$l_distribusi	= array('PROSES','BTL','MS','TMS');
				
				for ($i = 0; $i < sizeof($l_distribusi); $i++) {
					if ($l_distribusi[$i] == $s_ver) {
						echo "<option selected value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					} else {
						echo "<option value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					}				
				}
			
			?>	
		</select>
							
		<td><button type="submit" class="btn btn-success">Set Verifikasi</button></td>
		</form>
		</table>
		<table>
		<form action="<?=base_URL()?>admin/mutasi_kelas/act_ver" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<input type="hidden" name="idp" value="<?php echo $idp; ?>">
		<input type="hidden" name="s_ver" value="<?php echo $s_ver; ?>">
		
		<?php
		if($s_ver=="MS"){
			if($tkpendid2 !="SLTP" && $tkpendid2 !="SLTA" && $tkpendid2 !="SD"){
		?>
		<tr><td width="45%">Tanggal Ujian</td><td><b><input type="text" name="tgl_uji" required value="<?php echo $tgl_uji; ?>" id="tgl_uji" style="width: 100px" class="form-control"></b></td></tr>
		<tr><td width="45%">Jam Ujian</td><td><input type="text" name="jam_uji" required value="<?php echo $jam_uji; ?>" id="jam_uji" style="width: 100px" class="form-control"></td>
		<td width="10%" align="center">sd</td><td><b><input type="text" name="jam_uji2" required value="<?php echo $jam_uji2; ?>" id="jam_uji2" style="width: 100px" class="form-control"></b></td>
		</tr>
		<tr><td width="45%">Lokasi Ujian</td><td colspan="3"><b><textarea style="width:300px; height:50px" id="lok_uji" name="lok_uji"><?php echo $lok_uji; ?></textarea></b></td></tr>
		<tr><td width="45%" >Hasil Ujian</td><td><b>
		<select name="s_uji" class="form-control" style="width: 100px" required><option value="<?php echo $s_uji; ?>"> - Hasil - </option>
			<?php
				$l_distribusi	= array('BELUM','LULUS','GAGAL');
				
				for ($i = 0; $i < sizeof($l_distribusi); $i++) {
					if ($l_distribusi[$i] == $s_uji) {
						echo "<option selected value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					} else {
						echo "<option value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					}				
				}
			
			?>	
		</select>
		<?php
		}else{}
			
		?>	
			
		<tr><td width="45%" >Surat Rekomendasi</td><td><b>
		<select name="s_sk" class="form-control" style="width: 200px" required><option value="<?php echo $s_sk; ?>"> - Proses - </option>
			<?php
				$l_distribusi	= array('Belum Diproses','Dalam Proses','Selesai/Distribusi');
				
				for ($i = 0; $i < sizeof($l_distribusi); $i++) {
					if ($l_distribusi[$i] == $s_sk) {
						echo "<option selected value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					} else {
						echo "<option value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					}				
				}
			
			?>	
		</select>
		<?php
			
		}
		
		?>
				
		<tr><td width="45%">Keterangan</td><td colspan="3"><b><textarea style="width:300px; height:50px" id="keterangan" name="keterangan"><?php echo $keterangan; ?></textarea></b></td></tr>
		
	</table>
	<br>
	
	<tr><button type="submit" class="btn btn-primary">Simpan</button></tr>
		<button type="reset" class="btn btn-info">Reset</button>
		<a href="<?=base_URL()?>admin/mutasi_kelas" class="btn btn-success">Kembali</a>
	
	</div>
	
	</form>
	
	
