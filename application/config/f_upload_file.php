

<?php
$mode		= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt" || $mode == "act_set") {
	$act			= "act_edt";
	$idp			= $datpil->id;
	$nip			= $datpil->nip; 
	$nama			= $datpil->nama; 
	$skpd			= $datpil->skpd; 
	$jurusan		= $datpil->jurusan;
	$ttl			= $datpil->ttl; 
	$jenkel			= $datpil->jenkel; 
	$pangkat		= $datpil->pangkat; 
	$gol			= $datpil->gol; 
	$golpens		= $datpil->golpens; 
	$jabatan		= $datpil->jabatan; 
	$tkpendid		= $datpil->tkpendid; 
	$unit_kerja		= $datpil->unit_kerja;
	$no_surat		= $datpil->no_surat;
	$tgl_surat		= $datpil->tgl_surat;
	$jendok			= $datpil->jendok;


	
		
} else {
	$act			="act_add";
	$idp			= "";
	$nip			= ""; 
	$nama			= ""; 
	$skpd			= ""; 
	$jurusan		= "";
	$ttl			= ""; 
	$jenkel			= ""; 
	$pangkat		= ""; 
	$gol			= ""; 
	$jabatan		= ""; 
	$tkpendid		= ""; 
	$unit_kerja		= "";
	$kode_skpd		= ""; 
	$no_surat		="";
	$tgl_surat		="";
	$jendok			="a_semar"; 
	$file1			="";
	$gol2			="";
	$s_ver			=""; 
	$golpens		=""; 
	$jenpens		=""; 
	$s_sk			=""; 
	$keterangan		="";
	$status			="";
	
	
}
$where="";	
?>
<div class="navbar navbar-inverse"style="background-color:#3CB371;">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Usul Pensiun</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

	<?php
	
	

	echo $this->session->flashdata("k");
	
	?>
	<form action="<?=base_URL()?>admin/pensiun/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
	
	
	<div class="row-fluid well" style="overflow: hidden">
		
	<div class="col-lg-6">
		<table>
		<input type="hidden" name="nip" value="<?php echo $nip; ?>">
		<tr><td width="150%">Nama Pegawai</td><td><b><input type="text" name="nama" required value="<?php echo $nama; ?>" id="nama" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">N I P</td><td><b><input type="text" name="nip" required value="<?php echo $nip; ?>" id="nip" style="width: 300px" readonly class="form-control">
		<tr><td width="150%">Pangkat </td><td><b><input type="text" name="pangkat" required value="<?php echo $pangkat; ?>" id="pangkat" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Golongan </td><td><b><input type="text" name="gol" required value="<?php echo $gol; ?>" id="gol" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Pendidikan </td><td><b><input type="text" name="jurusan" required value="<?php echo $jurusan; ?>" id="jurusan" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Jabatan </td><td><b><input type="text" name="jabatan" required value="<?php echo $jabatan; ?>" id="jabatan" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">Unit Kerja </td><td><b><input type="text" name="unit_kerja" required value="<?php echo $unit_kerja; ?>" id="unit_kerja" style="width: 300px" readonly class="form-control"></b></td></tr>
		
		</table>
	</div>
	
<!--	<div class="col-lg-6">	-->
		<table  class="table-form">
		<tr><td width="30%">Nomor Surat</td><td><b><input type="text" name="no_surat" required value="<?php echo $no_surat; ?>" style="width: 300px" readonly class="form-control"></td></tr>
		<tr><td width="30%">Tanggal Surat</td><td><b><input type="text" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" style="width: 150px" readonly class="form-control"></b></td></tr>
		<tr><td width="30%">Jenis Pensiun</td><td><b><input type="text" name="jenpens" required value="<?php echo $jenpens; ?>" id="jenpens" style="width: 150px" readonly class="form-control"></b></td></tr>
		<tr><td width="30%">Golongan Pensiun</td><td><b><input type="text" name="golpens" required value="<?php echo $golpens; ?>" id="golpens" style="width: 150px" readonly class="form-control"></b></td></tr>
		
		
				
		<?php
		switch ($jenpens){
			case "1":
				$where ="bup";
				break;
			case "2":
				$where ="jandud";
				break;
			case "3":
				$where ="aps";
				break;
			case "4":
				$where ="uzur";
				break;
			case "5":
				$where ="pdh";
				break;
			default:
				$where ="bup";
				break;
		}
		
		if($golpens > '42'){
			$jendok="a_docu";
			$urut=="urut";
		}else{
			$jendok="a_semar";
			$urut=="id";
		}
		
		$datapens	= $this->db->query("SELECT * FROM $jendok WHERE $where='1' order by $urut")->result();
		if($jenpens!=""){
		?>
		<tr> <td><b>File Persyaratan</b></td> </tr>
		<?php
		foreach ($datapens as $c) {
		
		echo "<tr><td width='40%'>".$c->nama_dok."</td><td><b><input type='file' name='".$c->kode."' class='form-control' style='width: 200px'></b></td></tr>";
		}
		?>
		<tr><td colspan="2">
		<br><button type="submit" class="btn btn-primary">Simpan</button>
		<button type="reset" class="btn btn-info">Reset</button>
		<a href="<?=base_URL()?>admin/pensiun" class="btn btn-success">Kembali</a>
		</td></tr>
		<?php
		}
		?>
		</table>	
<!--	</div>-->

	</div>
	
	</form>
