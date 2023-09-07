

<?php


	$nip			= $datpil->nip; 
	$nama			= $datpil->nama; 
	$jabatan		= $datpil->jabatan; 
	$skpd			= $datpil->unit_kerja; 
	$gol			= $datpil->pangkat."/".$datpil->golru;	


?>




<div class="navbar navbar-inverse"style="background-color:#3CB371;">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Upload Arsip Kepegawaian Digital</span>
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
		<tr><td width="150%">JABATAN</td><td><b><input type="text" name="nip" required value="<?php echo $jabatan; ?>" id="nip" style="width: 300px" readonly class="form-control">
		<tr><td width="150%">UNIT KERJA</td><td><b><input type="text" name="nip" required value="<?php echo $skpd; ?>" id="nip" style="width: 300px" readonly class="form-control">
		</table>
		<br><br>
	</div>
	
	
	<div class="col-lg-10">	
			
	<table  class="table-form">
	<div class="row">
				<div class="col-md-6"><b> Format File : PDF </b></div>
	</div>
<?php
		
		$jpen		= $this->db->query("select * from a_arsip order by id")->result();
		
		
				foreach ($jpen as $e) {
				$kd_file	= $e->kode;
				$nama_file	= $e->jenis_dokumen;
				$id_doc		= $e->id;

		?>
				<form action="<?=base_URL()?>admin/kp/act_upload" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="row">
				<div class="col-md-3"><?php echo $nama_file; ?> </div><div class="col-md-3"><b><input type="file" name="<?php echo $kd_file; ?>" class="form-control"></b></div>
	<?php
        $jfiles		= $this->db->query("select * from t_arsip_digital where nip='$nip' and id_doc='$id_doc'")->row();
		$jfile=json_decode(json_encode($jfiles), True);
		if(isset($jfiles)){

			$idc = isset($jfile['id_doc'])?$jfile['id_doc']:'';	
			$n_file = isset($jfile['nama_file'])?$jfile['nama_file']:'';
		}
		
				echo "<div class='col-md-1'></div>";
				
	?>	
		

		<input type="hidden" name="nip" value="<?php echo $nip; ?>">
		<input type="hidden" name="id_doc" value="<?php echo $id_doc; ?>">

	
	<div class="col-md-1"><button type="submit" class="btn btn-info">Upload</button></div>
	
		<?php
		
	if($idc == $id_doc && $idc != ''){	
			echo	"<div class='col-md-2'><a href='".base_URL()."upload/".$kd_file."/".$n_file."' target='_blank' class='btn btn-primary active' role='button' aria-pressed='true'>Cek File</a></div>";
				//echo "<td>File :</td><td><i><a href='".base_URL()."upload/kp/".$nip."/".$n_file."' target='_blank'>".$n_file."</a></td>";
			}
else{echo	"<div class='col-md-2'>	Belum Upload File </div>";}	
	?>
		
			</div>
			</form>
			<?php
			}
			
			?>
		<tr><td colspan="2">

	<form action="<?=base_URL()?>admin/kp/download" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<input type="hidden" name="nip" value="<?php echo $nip; ?>">
	<input type="hidden" name="kd_file" value="<?php echo $kd_file; ?>">
	<button type="submit" class="btn btn-info">Download</button>
		</td></tr>
		
		</table>	
	</div>

	</div>
	
	
