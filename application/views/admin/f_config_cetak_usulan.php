<div class="navbar navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<span class="navbar-brand" href="#">Cetak Usul Pensiun</span>
		</div>
	</div><!-- /.container -->
</div><!-- /.navbar -->

	
<form action="<?=base_URL()?>admin/cetak_usul_pensiun" target="blank" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
	
	<table class="table-form" width="100%">
	<tr><td width="20%">Dari Tanggal</td><td><b><input type="text" name="tgl_start" id="tgl_start" class="form-control" style="width: 150px" required></b></td></tr>		
	<tr><td width="20%">Sampai Tanggal</td><td><b><input type="text" name="tgl_end" id="tgl_end" class="form-control" style="width: 150px"  required></b></td></tr>
	<br>
	<tr><b><td width="10%" >Tipe File</td></b><td>
	<select name="tipe" class="form-control" style="width: 150px" required><option value=""> -- </option>
			<?php
				$l_distribusi	= array('PDF','Excell');
				
				for ($i = 0; $i < sizeof($l_distribusi); $i++) {
					echo "<option value='".$l_distribusi[$i]."'>".$l_distribusi[$i]."</option>";
					}				
							
			?>	
		</select>
		</td>
	
	<tr><td colspan="2">
	<br>
	<button type="submit" class="btn btn-primary btn-sm">Cetak</button>
	<!-- <button type="submit" class="btn btn-default btn-sm">Excel</button> -->
	<button type="reset" class="btn btn-info btn-sm">Reset</button>
	<a href="<?=base_URL()?>admin" class="btn btn-success btn-sm">Kembali</a>
	</td></tr>
	</table>
	</fieldset>
</form>

<script type="text/javascript">
$(function() {
	$( "#tgl_start" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd-mm-yy'
	});
	$( "#tgl_end" ).datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd-mm-yy'
	});
});
</script>