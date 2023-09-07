<html>
<head>
<style type="text/css" media="print">
	table {border: solid 1px #000; border-collapse: collapse; width: 100%}
	tr { border: solid 1px #000; page-break-inside: avoid;}
	td { border: solid 1px #000; padding: 7px 5px; font-size: 10px}
	th {
		font-family:Arial;
		color:black;
		font-size: 11px;
		background-color:lightgrey;
	}
	thead {
		display:table-header-group;
	}
	tbody {
		display:table-row-group;
	}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
<style type="text/css" media="screen">
	table {border: solid 1px #000; border-collapse: collapse; width: 100%}
	tr { border: solid 1px #000}
	th {
		font-family:Arial;
		color:black;
		font-size: 11px;
		background-color: #999;
		padding: 8px 0;
	}
	td { border: solid 1px #000; padding: 7px 5px;font-size: 10px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
<title>Cetak Data Pegawai</title>
</head>

<body onload="window.print()">
	<center><b style="font-size: 20px">DATA PEGAWAI
	<?php
	$idskpd	= $this->session->userdata('admin_idskpd');
	$skpd	= $this->session->userdata('admin_skpd');
	if($idskpd!=''){
		echo	"<br>".strtoupper($skpd);
	}
		echo	"<br>KABUPATEN WONOSOBO";
		
?>	
	</b>
	</center><br>
	
	<table>
		<thead>
			<tr>
				<th width="3%">No</td>
				<th width="5%">N I P</td>
				<th width="18%">Nama</td>
				<th width="10%">TTL</td>
				<th width="7%">Pangkat</td>
				<th width="4%">Gol</td>
				<th width="10%">Jabatan</td>
				<th width="16%">Unit Kerja</td>
				<th width="8%">Pendidikan</td>
				<th width="4%">Tahun</td>
				<th width="10%">Alamat</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			if (!empty($data)) {
				$no = 0;
				foreach ($data as $d) {
					$no++;
			?>
			<tr>
				<td><?php echo $no; ?></td>
				<td><?php echo $d->nip;?></td>
				<td><?php echo $d->nama; ?></td>
				<td><?php echo $d->ttl; ?></td>
				<td><?php echo $d->pangkat; ?></td>
				<td><?php echo $d->gol; ?></td>
				<td><?php echo $d->jabatan; ?></td>
				<td><?php echo $d->unit_kerja; ?></td>
				<td><?php echo $d->tkpendid; ?></td>
				<td><?php echo $d->thijaz; ?></td>
				<td><?php echo $d->alm; ?></td>
				
			</tr>
			<?php 
				}
			} else {
				echo "<tr><td style='text-align: center' colspan='9'>Tidak ada data</td></tr>";
			}
			?>
		</tbody>
	</table>
	<!-- <a href='toExcelAll'><span style='color:green;'>Export All Data</span></a> -->
</body>
</html>

