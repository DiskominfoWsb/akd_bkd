<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	
	<div class="navbar navbar-inverse" style="background-color:#3CB371;">
		<div class="container">
			<div class="navbar-header">
	<?php
	$jkp	= $datpiltemp->jenkp;
	$golkp	= $datpil2->golru;
	?>
				<a class="navbar-brand" href="#">DAFTAR PERSYARATAN KP <?php echo strtoupper($jkp)." GOLONGAN ".$golkp;?></a>
			</div>
			
			<?php  
				if ($this->session->userdata('admin_idskpd')=='') {
		?>
			<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-right: -20px">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo base_URL(); ?>admin/persyaratan/add" class="btn-info"><i class="icon-plus-sign icon-white"> </i> Tambah Persyaratan</a></li>
			</ul>
			
		</div><!-- /.nav-collapse -->
		
		<?php 
			} 
		?>
		
		
		</div><!-- /.container -->
	</div><!-- /.navbar -->

  </div>
</div>


	
<!--	
<div class="alert alert-dismissable alert-success">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Well done!</strong> You successfully read <a href="http://bootswatch.com/amelia/#" class="alert-link">this important alert message</a>.
</div>
	
<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">x</button>
  <strong>Oh snap!</strong> <a href="http://bootswatch.com/amelia/#" class="alert-link">Change a few things up</a> and try submitting again.
</div>	
-->
<?php
$jkp	= $datpiltemp->jkp;
?>
<form action="<?=base_URL()?>admin/persyaratan" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<div class="row">
	<div class="col-md-2">
					<div class="form-group">
						<label>Jenis KP</label>
						<select class="form-control" name="jenkp">
							<option>- Pilih -</option>
					<?php
				$jpen	= $this->db->query("SELECT * FROM a_jenkp")->result();
				
				foreach ($jpen as $e) {
				if ($e->jkp == $jkp) {
						echo "<option selected value='".$e->jkp."'>".$e->jenkp."</option>";
				}else{
						echo "<option value='".$e->jkp."'>".$e->jenkp."</option>";
					}				
				}
			
			?>		
						</select>
					</div>
				</div> 
		<div class="col-md-2">
					<div class="form-group">
						<label>Golongan</label>
						<select class="form-control" name="gol_kp">
							<option>- Gol -</option>
					<?php
				$jpen	= $this->db->query("SELECT * FROM a_golruang where idgolru >6")->result();
				$idkp	= $datpil2->idgolru;
				foreach ($jpen as $e) {
				if ($e->idgolru == $idkp) {
						echo "<option selected value='".$e->idgolru."'>".$e->golru."</option>";
				}else{
						echo "<option value='".$e->idgolru."'>".$e->golru."</option>";
					}				
				}
			
			?>		
						</select>
					</div>
				</div>
				<div class="form-group">
						<label></label>				
				<td><button type="submit" class="btn btn-warning" style  width="50px"> Pilih </button></td>	
				</div>
</div>
</form>



<table id="example" class="table table-bordered table-hover">
	<thead>
	
		<tr>
			<th width="4%">No. </th>
			<th width="30%">Uraian Persyaratan </th>
			<th width="12%">File</th>
			<th width="30%">Keterangan</th>
		<?php  
				if ($this->session->userdata('admin_idskpd')=='') {
		?>
			<th width="10%">Aksi</th>
		<?php 
			} 
		?>
		</tr>
	
	</thead>
	
	<tbody>
		<?php 
		if (empty($data2)) {
			?>
			<tr><td></td><td style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td><td></td>
			<?php
			if ($this->session->userdata('admin_idskpd')=='') {
			?>
			<td></td>
			<?php
			}
			?>
			
			</tr>
		<?php
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data2 as $b) {
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $b->nama_dok;?></td>
		
			<?php  
				if($b->sfile !=''){
					echo "<td><i><a href='".base_URL()."upload/persyaratan/".$b->sfile."' target='_blank'>".$b->sfile."</a></i></td>";
				
				}else{
					echo "<td></td>";
					}
			?>
			<td><?php echo $b->ket;?></td>
			<?php
			if ($this->session->userdata('admin_idskpd')=='') {
			?>
				<td class="ctr">
				<div class="btn-group">
					<a href="<?=base_URL()?>admin/persyaratan/edt/<?=$b->id?>" class="btn btn-warning btn-sm" title="Edit Data"><i class="icon-edit icon-white"> </i>    Edt  </a>
				</td>
				<?php 
				} 
				?>
		</tr>
		<?php 
			$no++;
			}
		}
		?>
	</tbody>
</table>

</div>
