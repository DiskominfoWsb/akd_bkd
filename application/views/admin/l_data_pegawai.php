<div class="clearfix">
<div class="row">
  <div class="col-lg-12">
	
	<div class="navbar navbar-inverse" style="background-color:#3CB371;">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Daftar Pegawai</a>
			</div>
		
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

<table id="example" class="table table-bordered table-hover">
	<thead>
	
		<tr>
			<th rowspan="2" width="3%" style="text-align:center">No. </th>
			<!-- <th width="3%">Tahun</th> -->
			<th rowspan="2"width="14%">Nama Pegawai</br>NIP</br>TTL </th>
			<th rowspan="2"width="12%">Pangkat<br>Golongan </th>
			<th rowspan="2"width="16%">Jabatan</th>
			<th rowspan="2"width="16%">Unit Kerja</th>
			<th colspan="2"width="12%">Pendidikan </th>
			<tr>
			<th>Jenjang</th>
			<th>Jurusan</th>
		</tr>
		</tr>
	
	</thead>
	
	<tbody>
		<?php 
		if (empty($data2)) {
			echo "<tr><td colspan='5'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data2 as $b) {
			
		?>
		<tr>
			<td><?php echo $no;?></td>
			<td><?php echo $b->nama."<br>". $b->nip."<br>". $b->ttl;?></td>
			<td><?php echo $b->pangkat."<br>". $b->golru;?></td>
			<td><?php echo $b->jabatan;?></td>
			<td><?php echo $b->unit_kerja;?></td>
			<td><?php echo $b->pendid;?></td>
			<td><?php echo $b->jurusan;?></td>
							
			<!--	<div class="btn-group">
					<a href="<?=base_URL()?>admin/disposisi_cetak/<?=$b->id?>" class="btn btn-info btn-sm" target="_blank" title="Cetak Disposisi"><i class="icon-print icon-white"> </i> </a>
				</div>
			-->	
		</tr>
		<?php 
			$no++;
			}
		}
		?>
	</tbody>
</table>

</div>
