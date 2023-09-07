

<?php

	$idp			= $datpil->id;
	$nip			= $datpil->nip; 
	$nama			= $datpil->nama; 
	$jabatan		= $datpil->jabatan; 
	$skpd			= $datpil->skpd; 
	$jenpens		= $datpil->jenpens;
	$golpens		= $datpil->golpens;
	$gol			= $datpil->gol;	
	$pendid			= $datpil->pendid;
	$bkd			= $datpil->bkd;
	$bkn			= $datpil->bkn;
	$pertek			= $datpil->pertek;
	$s_sk			= $datpil->s_sk;
	$keterangan		= $datpil->keterangan;
	

?>
<div class="navbar navbar-inverse"style="background-color:#3CB371;">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Upload Berkas Pensiun</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

	<?php
	
	

	echo $this->session->flashdata("k");
	
	?>

	
	
	<div class="row-fluid well" style="overflow: hidden">
		
	<div class="col-lg-6">
		<table>
		<tr><td width="150%">Nama Pegawai</td><td><b><input type="text" name="nama" required value="<?php echo $nama; ?>" id="nama" style="width: 300px" readonly class="form-control"></b></td></tr>
		<tr><td width="150%">N I P</td><td><b><input type="text" name="nip" required value="<?php echo $nip; ?>" id="nip" style="width: 300px" readonly class="form-control">
		</table>
	</div>
	</div>
	
<div class="container">	
	<div class="row">
	<div class="col-md-6">	

<?php
	$pen="";	
	switch($jenpens){
		case "1" :
			$pen="bup";
			break;
		case "2" :
			$pen="jandud";
			break;
		case "3" :
			$pen="aps";
			break;
		case "4" :
			$pen="uzur";
			break;
		case "5" :
			$pen="pdh";
			break;
	}

		if($golpens > '42'){
		$klas	="docu";
		}else{
		$klas	="semar";
		}
		
		
		
		$jpen		= $this->db->query("select * from a_docu where klas='$klas' and $pen='1'")->result();
		
		
				foreach ($jpen as $e) {
				$kd_file	= $e->kode;
				$nama_file	= $e->nama_dok;
				$id_doc		= $e->id;

		?>
		
		<table>
				<tr>
					<b><td width="200px"><?php echo $nama_file; ?></td></b>
		
		<?php		
		$jfiles		= $this->db->query("select * from t_file where nip='$nip' and id_doc='$id_doc'")->row();
		$jfile=json_decode(json_encode($jfiles), True);
		if(isset($jfiles)){

			$idc = isset($jfile['id_doc'])?$jfile['id_doc']:'';	
			$n_file = isset($jfile['nama_file'])?$jfile['nama_file']:'';
			$tahun = isset($jfile['tahun'])?$jfile['tahun']:'';
		}
		if($id_doc == '35' || $id_doc == '44' || $id_doc == '46' || $id_doc == '49' || $id_doc == '51' || $id_doc == '52' || $id_doc == '53'){
		?>
		
		<td><select name="tahun" class="form-control" style="width: 100px" required><option value="<?php echo $tahun;?>"> -Tahun- </option>
			<?php
				
				for ($i =1980;$i<=2050;$i++) {
					
					if ($tahun == $i) {
						echo "<option selected value='".$i."'>".$i."</option>";
					} else {
						echo "<option value='".$i."'>".$i."</option>";
					}				
				}
			
			?>			
			</select>
		</td>
		<?php
		}			
		
			if($idc == $id_doc && $idc != ''){	
				echo "	<td><a href='".base_URL()."upload/pensiun/".$nip."/".$n_file."' target='_blank' class='btn btn-success'>Lihat File</a></td>";
				}else{
						echo	"<td> Berkas Belum Ada!</td>";
				}
		?>
		</tr>
		</table>
		<?php
			}
		?>
	
	<tr><td colspan="2">
	<form action="<?=base_URL()?>admin/pensiun/download" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<input type="hidden" name="nip" value="<?php echo $nip; ?>">
	<button type="submit" class="btn btn-info">Download</button>
		<a href="<?=base_URL()?>admin/pensiun" class="btn btn-success">Kembali</a>
		</td></tr>
		</div>
	</form>	
		<div class="col-md-4 well well-sm">
		<h3><b>VERIFIKASI USULAN</b></h3>

		<form action="<?=base_URL()?>admin/pensiun/set_bkd" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
		<input type="hidden" name="idp" value="<?php echo $idp; ?>">
		<table>
		<tr><td width="80px"><b>BKD</b><br></td>
		<td><select name="bkd" class="form-control" style="width: 150px" required><option value="<?php echo $bkd; ?>"> - Status - </option>
			<?php
				$l_distribusi	= array('PROSES','BTL','MS','TMS');
				
				for ($i = 0; $i < sizeof($l_distribusi); $i++) {
					if ($l_distribusi[$i] == $bkd) {
						echo "<option selected value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					} else {
						echo "<option value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					}				
				}
			
			?>	
		</select>
		</td>				
		<td><button type="submit" class="btn btn-success">Set</button></td>
		
		</tr>
		</form>
<br>

<?php
	if($bkd =="MS"){
?>
<form action="<?=base_URL()?>admin/pensiun/set_bkn" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
		<input type="hidden" name="idp" value="<?php echo $idp; ?>">
		
		<tr><td width="50px"><b>BKN</b><br></td>
		
		<td><select name="bkn" class="form-control" style="width: 150px" required><option value="<?php echo $bkn; ?>"> - Status - </option>
			<?php
				$l_distribusi	= array('PROSES','MS','TMS');
				
				for ($i = 0; $i < sizeof($l_distribusi); $i++) {
					if ($l_distribusi[$i] == $bkn) {
						echo "<option selected value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					} else {
						echo "<option value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					}				
				}
			
			?>	
		</select>
		</td>				
		<td><button type="submit" class="btn btn-success">Set</button></td>
		</tr>
		
		</form>
<?php
	if($bkn =="MS"){
?>
<form action="<?=base_URL()?>admin/pensiun/set_pertek" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
		<input type="hidden" name="idp" value="<?php echo $idp; ?>">
		
		<tr><td width="50px"><b>PERTEK</b><br></td>
		
		<td><select name="pertek" class="form-control" style="width: 150px" required><option value="<?php echo $pertek; ?>"> - Status - </option>
			<?php
				$l_distribusi	= array('OK','PROSES');
				
				for ($i = 0; $i < sizeof($l_distribusi); $i++) {
					if ($l_distribusi[$i] == $pertek) {
						echo "<option selected value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					} else {
						echo "<option value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					}				
				}
			
			?>	
		</select>
		</td>				
		<td><button type="submit" class="btn btn-success">Set</button></td>
		</tr>
		</form>
		
<?php
	if($pertek =="OK"){
?>

<form action="<?=base_URL()?>admin/pensiun/set_sk" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	
		<input type="hidden" name="idp" value="<?php echo $idp; ?>">
		
		<tr><td width="50px"><b>SK</b><br></td>
		
		<td><select name="s_sk" class="form-control" style="width: 150px" required><option value="<?php echo $s_sk; ?>"> - Status - </option>
			<?php
				$l_distribusi	= array('PROSES','OK');
				
				for ($i = 0; $i < sizeof($l_distribusi); $i++) {
					if ($l_distribusi[$i] == $s_sk) {
						echo "<option selected value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					} else {
						echo "<option value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					}				
				}
			
			?>	
		</select>
		</td>				
		<td><button type="submit" class="btn btn-success" style  width="50px"> Set </button></td>
		</tr>
		</form>	
<?php
	}
	}
	}
?>
<form action="<?=base_URL()?>admin/pensiun/set_ket" method="post" accept-charset="utf-8" enctype="multipart/form-data">
		<input type="hidden" name="idp" value="<?php echo $idp; ?>">
		<tr><td width="45%">Keterangan</td><td colspan="3"><b><textarea style="width:300px; height:50px" id="keterangan" name="keterangan"><?php echo $keterangan; ?></textarea></b></td></tr>
		<tr><td colspan="3"><button type="submit" class="btn btn-success" style  width="50px"> Simpan </button></td></tr>
</form>
	</table>
	</div>
	</div>		
	

	
	
	
