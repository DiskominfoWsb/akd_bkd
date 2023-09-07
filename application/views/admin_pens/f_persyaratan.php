<?php
$mode		= $this->uri->segment(3);
if ($mode == "edt" || $mode == "act_edt") {
	$act			= "act_edt";
	$idp			= $datpil->id;
	$syarat			= $datpil->nama_dok; 
	$sfile			= $datpil->sfile; 
	$sket			= $datpil->ket;
}else{
	$act			= "act_add";
	$idp			= "";
	$syarat			= ""; 
	$sfile			= ""; 
	$sket			= ""; 
}

?>
<div class="navbar navbar-inverse"style="background-color:#3CB371;">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Edit Persyaratan</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

	
	<div class="row-fluid well" style="overflow: hidden">
		
	<div class="col-lg-8">
	<form action="<?=base_URL()?>admin/persyaratan/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<input type="hidden" name="idp" value="<?php echo $idp; ?>">
		<table>
		<tr><td width="200%">Uraian Persyaratan</td><td><b><textarea style="width:500px; height:50px;" name="syarat"  id="syarat"><?php echo $syarat; ?></textarea></b></td></tr>
		</table>
		<table>
		<tr><td width="200%">Keterangan</td><td><b><textarea style="width:500px; height:50px;" name="sket" id="sket"><?php echo $sket; ?></textarea></b></td></tr>
		</table>
		<table>
		<br>
		<tr> <td width="200%"><b>Format File Persyaratan</b></td> </tr>
		<tr><td><b><input type="file" name="file_surat" class="form-control" style="width: 300px"></b></td></tr>	
			
		
		<tr><td>
		<br><button type="submit" class="btn btn-primary">Simpan</button>
		<a href="<?=base_URL()?>admin/persyaratan" class="btn btn-success">Kembali</a>
		</td></tr>
		</table>
		</form>
	</div>
<!--	</div>-->

	</div>
	
	
