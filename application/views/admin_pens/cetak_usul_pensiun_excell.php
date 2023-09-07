<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Usul Mutasi Pensiun.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>

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
<title>Cetak Usul Mutasi Kelas Jabatan</title>
</head>

<body onload="window.print()">
	<center><b style="font-size: 20px">DAFTAR USUL PENSIUN PEGAWAI
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
			<th align="center" rowspan="2" width="2%">No. </th>
			<th rowspan="2"  width="4%">Nomor Surat<br>Tgl. Surat</th>
			<th rowspan="2"  width="6%">Nama Pegawai / NIP</th>
			<th rowspan="2"  width="6%">Pangkat / Golongan </th>
			<th rowspan="2"  width="12%">Jabatan<br>Unit Kerja</th>
			<th rowspan="2"  width="6%">Jenis Pensiun<br>Pangkat/Golongan </th>
			<th colspan="4" width="6%">Status Usulan</th>
			<th  rowspan="2" width="6%">Keterangan</th>

		</tr>
		<tr>
			<th width="6%">BKD</th>
			<th width="6%">BKN</th>		
			<th width="6%">PERTEK</th>
			<th width="6%">SK</th>
		</tr>
		</thead>
		<tbody>
			<?php 
		if (empty($data)) {
			?>
			<tr><td></td><td></td><td></td><td style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
			<?php
		} else {
			$no 	= ($this->uri->segment(4) + 1);
			foreach ($data as $b) {
			$bkd	= $b->bkd;
			$status	= $b->status;
		?>
		<tr>
			<td valign="center"><?php echo $no;?></td>
			<td><?php echo $b->no_surat."<br>". $b->tgl_surat;?></td>
			<td><?php echo $b->nama."<br>NIP. ". $b->nip;?></td>
			<td><?php echo $b->pangkat."-".$b->golru;?></td>
			<td><?php echo $b->jabatan."<br>". $b->unit_kerja;?></td>
			<td><?php echo $b->pensiun."<br>". $b->pangkatpens."-".$b->golrupens;?></td>
			<td><b><?php echo $b->bkd;?></b></td>
			<td><b><?php echo $b->bkn;?></b></td>
			<td><b><?php echo $b->pertek;?></b></td>
			<td><?php echo "<b>".$b->s_sk."</b><br>";
						
					?>
			</td>
			<td><?php echo $b->keterangan;?></td>
				
			</tr>
			<?php 
			$no++;
				}
			} 
			?>
		</tbody>
	</table>
	<!-- <a href='toExcelAll'><span style='color:green;'>Export All Data</span></a> -->
</body>
</html>

