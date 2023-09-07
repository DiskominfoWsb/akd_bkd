<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();
		//function excel_model() {
		$this->load->model('excel_model');//load the model
		$this->load->library('pagination');
	}
	

	public function index() {
		
		
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
			
			
		}
		$a['page']	= "d_amain";
		$this->load->view('admin/aaa', $a);
	}

	
	
	public function klas_surat() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM ref_klasifikasi")->num_rows();
		$per_page		= 15;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/klas_surat/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$kode					= addslashes($this->input->post('kode'));
		$nama					= addslashes($this->input->post('nama'));
		$uraian					= addslashes($this->input->post('uraian'));
	
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM ref_klasifikasi WHERE nama LIKE '%$cari%' OR uraian LIKE '%$cari%' ORDER BY id ASC")->result();
			$a['page']		= "l_klas_surat";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_klas_surat";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM ref_klasifikasi WHERE id = '$idu'")->row();	
			$a['page']		= "f_klas_surat";
		} else if ($mau_ke == "act_edt") {
			$this->db->query("UPDATE ref_klasifikasi SET kode = '$kode', nama = '$nama', uraian = '$uraian' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('admin/klas_surat');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM ref_klasifikasi LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_klas_surat";
		}
		
		$this->load->view('admin/aaa', $a);
	}
	
	public function data_pegawai() {
	if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		$skpd_admin= $this->session->userdata('admin_idskpd');
		if($this->session->userdata('admin_level') =='OPD'){
					$where			= "where kode_skpd='".$skpd_admin."'";
					$total_row		= $this->db->query("SELECT * FROM t_mutasi_kelas  $where")->num_rows();
				}else {
					$where			= "";
					$total_row		= $this->db->query("SELECT * FROM t_mutasi_kelas  $where")->num_rows();
				}
		$per_page		= 20;
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/mutasi_kelas/p");
		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		$cari					= addslashes($this->input->post('q'));	
		
		$a['data2']		= $this->db->query("SELECT * FROM t_pegawai $where order by nip ASC ")->result();
		$a['page']		= "l_data_pegawai";
		
		$this->load->view('admin/aaa', $a);		
	}
	
	public function persyaratan() {
	if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		
		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$syarat					= addslashes($this->input->post('syarat')); 
		$sfile					= addslashes($this->input->post('sfile')); 
		$sket					= addslashes($this->input->post('sket'));
		
		if(empty(addslashes($this->input->post('jenkp')))){
			$jenkp ="jft";
			}else{
			$jenkp	= addslashes($this->input->post('jenkp'));
		}
		$gols = addslashes($this->input->post('gol_kp'));
		if($gols==''){
			$klas ="semar";
			$a['datpil2']		= $this->db->query("SELECT * FROM a_golruang where idgolru='31'")->row();
			}else{
			$a['datpil2']		= $this->db->query("SELECT * FROM a_golruang where idgolru=$gols")->row();
			if($gols>42){
				$klas ="docu";	
				
			}else{
				$klas ="semar";
			}
		}
		//upload config
		$total_row		= $this->db->query("SELECT * FROM a_docu where klas='$klas' and $jenkp='1'")->num_rows();
		$per_page		= 20;
		$awal			= $this->uri->segment(4); 
		$awal			= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/persyaratan/p");

		$config['upload_path'] 		= './upload/persyaratan/kp';
		$config['allowed_types'] 	= 'pptx|jpg|png|pdf|doc|ppt|docx';
		$config['max_size']			= '10000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		$a['datpiltemp']	= $this->db->query("SELECT * FROM a_jenkp where jkp='$jenkp'")->row();
		
		if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM a_docu WHERE klas='$klas' and $jenkp='1' and id = '$idu'")->row();	
			$a['page']		= "f_persyaratan";
		
		
		} else if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
							
				$this->db->query("UPDATE a_docu SET nama_dok='$syarat',sfile='".$up_data['file_name']."',ket='$sket' where id='$idp'");
			} else {
				$this->db->query("UPDATE a_docu SET nama_dok='$syarat',ket='$sket'  where id='$idp'");
				
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diupdate ".$this->upload->display_errors()."</div>");			
			redirect('admin/persyaratan');
		} else {
			
			$a['data2']		= $this->db->query("SELECT * FROM a_docu  where klas='$klas' and $jenkp='1' order by urut ")->result();
			$a['page']		= "l_persyaratan";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	
	
	
	
public function kp() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		$skpd_admin= $this->session->userdata('admin_idskpd');
		/* pagination */
			if($this->session->userdata('admin_level') =='Admin_KP'){
					$where2			= "";
					$where			= "where status='1'";
			}else if($this->session->userdata('admin_level') =='Super Admin'){
					$where			= "";
					$where2			= "";
			}else {
					$where			= "where kode_skpd='".$skpd_admin."'";
					$where2			= " and kode_skpd ='$skpd_admin'";
			}
		$total_row		= $this->db->query("SELECT * FROM t_kp  $where")->num_rows();
		$per_page		= 20;
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/kp/p");
		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		$cari					= addslashes($this->input->post('q'));
		$idpens					= $this->input->post('idpens');
		//------------//
		$a['thn']=date('Y');
		$a['nextagenda']		= $this->db->query("SELECT * FROM t_kp ")->num_rows()+1;
		

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$kode_skpd				= addslashes($this->input->post('kode_skpd')); 
		$skpd					= addslashes($this->input->post('skpd')); 
		$nip					= addslashes($this->input->post('nip')); 
		$nama					= addslashes($this->input->post('nama')); 
		$ttl					= addslashes($this->input->post('ttl')); 
		$jenkel					= addslashes($this->input->post('jenkel')); 
		$idjenjab				= addslashes($this->input->post('idjenjab'));
		$pangkat				= addslashes($this->input->post('pangkat')); 
		$gol					= addslashes($this->input->post('gol')); 
		$golkp					= addslashes($this->input->post('golkp')); 
		$jenkp					= addslashes($this->input->post('jenkp')); 
		$jabatan				= addslashes($this->input->post('jabatan'));
		$tkpendid				= addslashes($this->input->post('tkpendid')); 
		$pendid					= addslashes($this->input->post('pendid')); 
		$jurusan				= addslashes($this->input->post('jurusan'));
		$unit_kerja				= addslashes($this->input->post('unit_kerja'));
		$no_surat				= addslashes($this->input->post('no_surat'));
		$tgl_surat				= addslashes($this->input->post('tgl_surat'));
		$bkd					= addslashes($this->input->post('bkd')); 
		$bkn					= addslashes($this->input->post('bkn')); 
		$pertek					= addslashes($this->input->post('pertek')); 
		$id_tkp					= addslashes($this->input->post('id_tkp')); 
		$pddkp					= addslashes($this->input->post('pddkp')); 
		$id_doc					= addslashes($this->input->post('id_doc')); 
		$s_sk					= addslashes($this->input->post('s_sk')); 
		$keterangan				= addslashes($this->input->post('keterangan')); 
		$klas					= addslashes($this->input->post('klas'));
		$kd_file				= addslashes($this->input->post('kd_file'));
		$pen					= addslashes($this->input->post('pen'));
		$path					= addslashes($this->input->post('path'));
		$status					= addslashes($this->input->post('status'));
		$tahun					= addslashes($this->input->post('tahun'));
		$cari					= addslashes($this->input->post('q'));
		$q						=	"SELECT a.nip, concat(if(a.gdp='','',concat(a.gdp,' ')),a.nama,if(a.gdb='','',concat(', ',a.gdb)))as nama,k.jenkel,
									concat(a.tmlhr, date_format(a.tglhr,'%d-%m-%Y')) as ttl, a.idgolrupkt,b.pangkat,b.golru,
									date_format(a.tmtpkt,'%d-%m-%Y') as tmtpkt, if(a.idjenjab in('20','30','40'), c.jab_utuh,
									if(a.idjenjab='2', j.jabfung,o.jabfungum))as jabatan, f.tkpendid as pendid, n.jenjurusan as jurusan, a.thijaz, c.path_short as unit_kerja,
									a.idskpd,left(a.idskpd,2) as kode_skpd,e.skpd as skpd, a.idjenjab,a.idgolrupkt,a.idesljbt,a.noskjbt,
									date_format(a.tgskjbt,'%d-%m-%Y') as tgskjbt, date_format(a.tmtjbt,'%d-%m-%Y') as tmtjbt, a.idtkpendid as tkpendid,
									date_format(a.tmtpens,'%d-%m-%Y') as tmtpens,o.klasjab from `tb_01`a	
									left join a_stspeg d on a.idstspeg=d.idstspeg 
									left join a_golruang b on a.idgolrupkt=b.idgolru 
									left join a_jenjab i on a.idjenjab=i.idjenjab 
									left join a_jabfung j on a.idjabfung=j.idjabfung 
									left join a_skpd c on a.idskpd=c.idskpd 
									left join a_jenkel k on a.idjenkel=k.idjenkel
									left join a_tkpendid f on a.idtkpendid=f.idtkpendid
									left join a_skpd e on left(a.idskpd,2)=e.idskpd 
									left join a_jenjurusan n on a.idjenjurusan=n.idjenjurusan 
									left join a_jabfungum o on a.idjabfungum=o.idjabfungum";
									
		$q2						=	"SELECT a.id,a.skpd,a.ttl,a.jenkel,a.golkp,a.jurusan,a.bkd,a.bkn,a.pertek,a.s_sk,a.status,a.keterangan,a.pendid,a.no_surat,a.tgl_surat,
									a.nip,a.nama,b.pangkat as pangkat,c.kp,a.pddkp,b.golru as golru,a.jabatan,a.unit_kerja,
									a.jurusan,a.jenkp, d.pangkat as pangkatkp, d.golru as golrukp FROM t_kp a
									left join a_golruang b on a.gol=b.idgolru
									left join a_golruang d on a.golkp=d.idgolru
									left join a_jenkp c on a.jenkp=c.id";
		$q3						=	"SELECT a.skpd,a.golkp,a.jenkp, b.nip,a.nama,b.nama_file,b.path,a.id FROM t_file b
									left join t_kp a on b.id_tkp=a.id";

		//upload config 
		$direktori	='./upload/kp/'.$nip;
			if(!file_exists($direktori)){
				mkdir($direktori);
			}
			
		$config['upload_path'] 		= $direktori;
		$config['allowed_types'] 	= 'pdf|jpg|jpeg|png';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';
		//$this->session->set_flashdata("k")
		$this->load->library('upload', $config);
		
		if($nip){
		$a['datpiltemp']	= $this->db->query("$q where nip='$nip'")->row();
		}
		
		if ($mau_ke == "download") {
//			$this->load->helper('download');

			
// nama zipfile yang akan dibuat 
 //proses membuat zip file 
				$zip = new ZipArchive;
				$zipname = $nip.".zip";
				if($zip->open($zipname, ZipArchive::CREATE)==TRUE){ 
				
				$jfile= $this->db->query("SELECT nama_file from t_file where nip='$nip'")->result();
				$zipfile=json_decode(json_encode($jfile), True);				
				foreach ($zipfile as $a) {
				$filez	= $a['nama_file'];
				$file_new	= $direktori.'/'.$filez;
				$zip->addFile($file_new,$filez);
			}
			$zip->close();	
				
if(file_exists($zipname)){
ob_get_clean();
header('Content-Type: application/zip');
header('Content-disposition: attachment; 
filename="'.$zipname.'"');
header('Content-Length: ' . filesize($zipname));
readfile($zipname);
unlink($zipname);

}
} 
		}
		if ($mau_ke == "del") {
			
			$this->db->query("DELETE FROM t_kp WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('admin/kp');
		} else if ($mau_ke == "kirim") {
			$this->db->query("UPDATE t_kp SET status='1',bkd='' WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Usulan sudah dikirim </div>");
			redirect('admin/kp');			
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_kp WHERE nama LIKE '%$cari%' or nip LIKE '%$cari%' or jabatan LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_kp";
		} else if ($mau_ke == "add") {
			

						$a['page']		= "f_kp";
			

		} else if ($mau_ke == "add2") {
			$a['datpiltemp']	= $this->db->query("$q where nip='$nip'")->row();
			
				if(empty($a['datpiltemp'])){
						$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Pegawai dengan NIP tersebut tidak ada di instansi Anda!!! </div>");
						$a['page']		= "f_kp";
				}else{
					$a['page']		= "f_kp2";
				}

		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("$q2 WHERE a.id = '$idu'")->row();	
			$a['page']		= "f_kp";
		} else if ($mau_ke == "ver") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_kp WHERE id = '$idu'")->row();	
			$a['page']		= "f_verifikasi";
		} else if ($mau_ke == "set_bkd") {
			$this->db->query("UPDATE t_kp SET bkd='$bkd' where id=$idp");
			if($bkd == "BTL"){
			$this->db->query("UPDATE t_kp SET status='0' where id=$idp");
			}
			$a['datpil']	= $this->db->query("SELECT * FROM t_kp WHERE id = '$idp'")->row();
			$a['page']		= "f_verifikasi";

		} else if ($mau_ke == "set_bkn") {
			$this->db->query("UPDATE t_kp SET bkn='$bkn' where id=$idp");
			$a['datpil']	= $this->db->query("SELECT * FROM t_kp WHERE id = '$idp'")->row();
			$a['page']		= "f_verifikasi";
			
		} else if ($mau_ke == "set_pertek") {
			$this->db->query("UPDATE t_kp SET pertek='$pertek' where id=$idp");
			$a['datpil']	= $this->db->query("SELECT * FROM t_kp WHERE id = '$idp'")->row();
			$a['page']		= "f_verifikasi";
			
		} else if ($mau_ke == "set_sk") {
			$this->db->query("UPDATE t_kp SET s_sk='$s_sk' where id=$idp");
			$a['datpil']	= $this->db->query("SELECT * FROM t_kp WHERE id = '$idp'")->row();
			$a['page']		= "f_verifikasi";
	
		} else if ($mau_ke == "set_ket") {
			$this->db->query("UPDATE t_kp SET keterangan='$keterangan' where id=$idp");
			redirect('admin/kp');
			
		} else if ($mau_ke == "dokumen") {
			
			$a['datpil']	= $this->db->query("SELECT * FROM t_kp WHERE id = '$idu'")->row();
			$a['page']		= "f_dokumen";
			
		} else if ($mau_ke == "act_add") {	
			
				$this->db->query("INSERT INTO t_kp VALUES (NULL, '$jenkp', '$kode_skpd', '$skpd', '$nip', '$nama', '$ttl', '$jenkel',  '$gol', '$golkp','$pddkp','$idjenjab','$jabatan','$tkpendid', '$pendid','$jurusan', '$unit_kerja','$no_surat','$tgl_surat','','', '','', '','')");
			
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil ditambahkan. ".$this->upload->display_errors()."</div>");
			redirect('admin/kp');
			} else if ($mau_ke == "act_ver") {
			
				$this->db->query("UPDATE t_kp SET  s_ver='$s_ver',s_sk='$s_sk',keterangan='$keterangan' WHERE id = '$idp'");
				
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diverifikasi ".$this->upload->display_errors()."</div>");			
			redirect('admin/kp');
			 
		}else if ($mau_ke == "act_upload") {
			
			
			$jpen	= $this->db->query("select * from a_docu where klas='$klas' and $pen='1'")->result();
				foreach ($jpen as $e) {
				$kd_file	= $e->kode;
			if($jenkp	!='3'){
				$pddkp	=	$pendid;
			}
			if($this->upload->do_upload($kd_file)){
				$up_data	 	= $this->upload->data();
				$file_ext		= $up_data['file_ext'];
				$file_path		= $up_data['file_path'];
				$file_asli		= $up_data['full_path'];
				$fx				= str_replace('NIP',$nip,$kd_file);
				$f2				= str_replace('TAHUN',$tahun,$fx);
				$f3				= str_replace('GOLRU',$gol,$f2);
				$f4				= str_replace('TKPENDID',$pddkp,$f3);
				$file1			= $f4.$file_ext;
				$new_file		= $file_path.$file1;
				rename($file_asli,$new_file);
				
			$jum	=	$this->db->query("SELECT * FROM t_file where nip='$nip' and id_doc='$id_doc' and id_tkp='$idp' ")->num_rows();
			if($jum > '0'){
				$this->db->query("update t_file set create_date=date('d/m/Y h:i:s'), tahun ='$tahun' where nip='$nip' and id_doc='$id_doc' and id_tkp='$idp'");
			}else{
				$this->db->query("insert into t_file (id_tkp,id_doc,nip,tahun,nama_file,path,create_date)values('$idp','$id_doc','$nip','$tahun','$file1','$new_file',date('d/m/Y h:i:s'))");
			}	
			}
				}
				$a['datpil']	= $this->db->query("SELECT * FROM t_kp WHERE id = '$idp'")->row();
			$a['page']		= "f_dokumen";			

		} else if ($mau_ke == "act_edt") {
						
				$this->db->query("UPDATE t_kp SET golkp = '$golkp',pddkp='$pddkp',jenkp = '$jenkp',no_surat = '$no_surat',tgl_surat = '$tgl_surat' WHERE id = '$idp'");
			
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil diupdate ".$this->upload->display_errors()."</div>");			
			redirect('admin/kp');
		} else {
			
			$a['data']		= $this->db->query("SELECT * FROM t_kp $where order by tgl_surat DESC LIMIT $awal, $akhir ")->result();
			$a['data2']		= $this->db->query("$q2 $where  order by tgl_surat DESC ")->result();
			$a['page']		= "l_kp";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	public function get_jenkp($jenkp){
			switch($jenkp){
		case "1" :
			return("bup");
			break;
		case "2" :
			return("jandud");
			break;
		case "3" :
			return("aps");
			break;
		case "4" :
			return("uzur");
			break;
		case "5" :
			return("pdh");
			break;
	}
	}
	public function pengguna() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		
		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
		$alamat					= addslashes($this->input->post('alamat'));
		$kepala					= addslashes($this->input->post('kepala'));
		$nip_kepala				= addslashes($this->input->post('nip_kepala'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '10000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('logo')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("UPDATE tr_instansi SET nama = '$nama', alamat = '$alamat', kepala = '$kepala', nip_kepala = '$nip_kepala', logo = '".$up_data['file_name']."' WHERE id = '$idp'");

			} else {
				$this->db->query("UPDATE tr_instansi SET nama = '$nama', alamat = '$alamat', kepala = '$kepala', nip_kepala = '$nip_kepala' WHERE id = '$idp'");
			}		

			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('admin/pengguna');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM tr_instansi WHERE id = '1' LIMIT 1")->row();
			$a['page']		= "f_pengguna";
		}
		
		$this->load->view('admin/aaa', $a);	
	}
	
	public function agenda_mutasi_kelas() {
		$a['page']	= "f_config_cetak_agenda";
		$this->load->view('admin/aaa', $a);
	}

	/*cetak excel*/
	public function agenda_mutasi_kelas2() {
		$a['page']	= "f_config_cetak_agenda_excel";
		$this->load->view('admin/aaa', $a);
	}
	
	public function cetak_agenda_excel() {
		$jenis_surat	= $this->input->post('tipe');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');
		
		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;		

		if ($jenis_surat == "agenda_mutasi_kelas2") {	
			$a['data']	= $this->db->query("SELECT * FROM t_mutasi_kelas")->result();
			$this->load->view('admin/agenda_mutasi_kelas2', $a);
		} else if ($jenis_surat == "agenda_surat_keluar2") {
			$a['data']	= $this->db->query("SELECT * FROM t_surat_keluar WHERE tgl_catat >= '$tgl_start' AND tgl_catat <= '$tgl_end' ORDER BY tahun, no_agenda ASC")->result();
			$this->load->view('admin/agenda_surat_keluar2', $a);
		} else if ($jenis_surat == "agenda_surat_keputusan2") {
			$a['data']	= $this->db->query("SELECT * FROM t_surat_keputusan WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY tgl_surat, nomor ASC")->result();
			$this->load->view('admin/agenda_surat_keputusan2', $a);
		} else if ($jenis_surat == "agenda_nodin_keluar2"){
			$a['data']	= $this->db->query("SELECT * FROM t_notadinas_keluar WHERE tgl_naik >= '$tgl_start' AND tgl_naik <= '$tgl_end' ORDER BY tgl_naik, no_notadinas ASC")->result();
			$this->load->view('admin/agenda_nodin_keluar2', $a);
		} else {
			$a['data']	= $this->db->query("SELECT * FROM t_notadinas_masuk WHERE tgl >= '$tgl_start' AND tgl <= '$tgl_end' ORDER BY tgl, no_agenda ASC")->result();
			$this->load->view('admin/agenda_nodin_masuk2', $a);
		}
	}
	
		public function cetak_pegawai() {
		$a['page']	= "f_config_cetak_data_pegawai";
		$this->load->view('admin/aaa', $a);
	}
	
	public function cetak_data_pegawai() {
		$kode_skpd		= $this->session->userdata('admin_idskpd');
		if($kode_skpd==''){
			$where	= "";
		}else{
			$where	= "where kode_skpd='".$kode_skpd."'";
		}
			$a['data']	= $this->db->query("SELECT * FROM t_pegawai $where")->result(); 
			$tipe			= $this->input->post('tipe');
			if($tipe	== 'Excell'){
				$this->load->view('admin/cetak_data_pegawai_excell', $a);
			}else{
				$this->load->view('admin/cetak_data_pegawai', $a);
			}
	}
	
	public function cetak_usul() {
		$a['page']	= "f_config_cetak_usulan";
		$this->load->view('admin/aaa', $a);
	}
	
	public function cetak_usul_kp() {
		$kode_skpd		= $this->session->userdata('admin_idskpd');
		if($kode_skpd==''){
			$where	= "";
		}else{
			$where	= "and kode_skpd='".$kode_skpd."'";
		}
		$q						=	"SELECT a.id,a.skpd,a.ttl,a.jenkel,a.golkp,a.jurusan,a.bkd,a.bkn,a.pertek,a.s_sk,a.status,a.keterangan,a.pendid,a.no_surat,a.tgl_surat,
									a.nip,a.nama,b.pangkat as pangkat,c.jenkp as kp,b.golru as golru,a.jabatan,a.unit_kerja,
									a.jurusan,a.jenkp, d.pangkat as pangkatpens, d.golru as golrupens FROM t_kp a
									left join a_golruang b on a.gol=b.idgolru
									left join a_golruang d on a.golkp=d.idgolru
									left join a_jenkp c on a.jenkp=c.idjenkp";
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');
		$tipe			= $this->input->post('tipe');
		
			$a['data']	= $this->db->query("$q WHERE a.tgl_surat >= '$tgl_start' AND a.tgl_surat <= '$tgl_end' $where ORDER BY id")->result();
			if($tipe	== 'PDF'){
			$this->load->view('admin/cetak_usul_kp', $a);
			}else{
				$this->load->view('admin/cetak_usul_kp_excell', $a);	
			}
	}
	
		
	public function toExcelAll() {
		$a['page']	= "f_config_cetak_toExcelAll";
		$this->load->view('admin/aaa', $a);
	}
	
	public function cetak_toExcelAll() {
		$jenis_surat	= $this->input->post('tipe3');
		$tgl_start		= $this->input->post('tgl_start');
		$tgl_end		= $this->input->post('tgl_end');
		
		$a['tgl_start']	= $tgl_start;
		$a['tgl_end']	= $tgl_end;

		if ($jenis_surat = "toExcelAll") {	
			$a['data']	= $this->db->query("SELECT * FROM t_mutasi_kelas WHERE tgl_diterima >= '$tgl_start' AND tgl_diterima <= '$tgl_end' ORDER BY id")->result(); 
			$this->load->view('admin/agenda_mutasi_kelas2', $a);
			$a['data']	= $this->db->query("SELECT * FROM t_surat_keluar WHERE tgl_catat >= '$tgl_start' AND tgl_catat <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_surat_keluar2', $a);
			$a['data']	= $this->db->query("SELECT * FROM t_surat_keputusan WHERE tgl_surat >= '$tgl_start' AND tgl_surat <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_surat_keputusan2', $a);
			$a['data']	= $this->db->query("SELECT * FROM t_notadinas_keluar WHERE tgl_naik >= '$tgl_start' AND tgl_naik <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_nodin_keluar2', $a);
			$a['data']	= $this->db->query("SELECT * FROM t_notadinas_masuk WHERE tgl >= '$tgl_start' AND tgl <= '$tgl_end' ORDER BY id")->result();
			$this->load->view('admin/agenda_nodin_masuk2', $a);
		} else {

		}
	}
	
	/*back up database*/
	public function backup() {
     $this->load->dbutil();
     $prefs = array(
         'tables'      => array('ref_klasifikasi', 'tr_instansi', 't_admin', 't_disposisi', 't_instansi', 't_notadinas_keluar', 't_notadinas_masuk', 't_pejabat', 't_surat_keluar', 't_surat_keputusan', 't_mutasi_kelas', 't_unit_pengolah'),  
         'ignore'      => array(),          
         'format'      => 'txt',           
         'filename'    => 'backup_db_emutasi.sql',    
         'add_drop'    => TRUE,              
         'add_insert'  => TRUE,              
         'newline'     => "\n"              
     );
     // Backup your entire database and assign it to a variable
     $backup =& $this->dbutil->backup($prefs);
 
     // Load the file helper and write the file to your server
     $this->load->helper('file');
     $file_name = 'diklat.sql';
     write_file('/'.$file_name, $backup);
 
     // Load the download helper and send the file to your desktop
     $this->load->helper('download');
     force_download($file_name, $backup);
	}
	
	public function manage_admin() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM t_admin")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."admin/manage_admin/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$username				= addslashes($this->input->post('username'));
		$password				= md5(addslashes($this->input->post('password')));
		$nama					= addslashes($this->input->post('nama'));
		$nip					= addslashes($this->input->post('nip'));
		$level					= addslashes($this->input->post('level'));
		$idskpd				= addslashes($this->input->post('idskpd'));
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM t_admin WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('admin/manage_admin');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM t_admin WHERE nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_manage_admin";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM t_admin WHERE id = '$idu'")->row();	
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "act_add") {	
			$this->db->query("INSERT INTO t_admin VALUES (NULL, '$username', '$password', '$nama', '$nip', '$level',$idskpd)");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data berhasil ditambahkan</div>");
			redirect('admin/manage_admin');
		} else if ($mau_ke == "act_edt") {
			if ($password = md5("-")) {
				$this->db->query("UPDATE t_admin SET username = '$username', nama = '$nama', nip = '$nip', level = '$level',idskpd='$idskpd' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE t_admin SET username = '$username', password = '$password', nama = '$nama', nip = '$nip', level = '$level',idskpd='$idskpd' WHERE id = '$idp'");
			}
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated </div>");			
			redirect('admin/manage_admin');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM t_admin LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_manage_admin";
		}
		
		$this->load->view('admin/aaa', $a);
	}

	public function get_klasifikasi() {
		$kode 				= $this->input->post('kode',TRUE);
		
		$data 				=  $this->db->query("SELECT id, kode, nama FROM ref_klasifikasi WHERE kode LIKE '%$kode%' ORDER BY id ASC")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->kode;
			$json_array['label']	= $d->kode." - ".$d->nama;
			$klasifikasi[] 			= $json_array;
		}
		
		echo json_encode($klasifikasi);
	}
	


	
	public function get_pegawai() {
		$nip 				= $this->input->post('nip',TRUE);
		$skpd 				= $this->input->post('user',TRUE);
		$data 				=  $this->db->query("SELECT pejabat FROM t_pegawai WHERE pejabat LIKE '%$kode%' GROUP BY id")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->pejabat;
			$json_array['label']	= $d->pejabat."<br>".$d->nip;
			$klasifikasi[] 			= $json_array;
			//$klasifikasi[] 	= $d->pejabat;
		}
		
		echo json_encode($klasifikasi);
	}
	
	public function get_skpd() {
		$kode 				=  $this->input->post('kode',TRUE);
		$data 				=  $this->db->query("SELECT path_short FROM a_skpd where path_short like '%$kode%'")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->path_short;
			$json_array['label']	= $d->path_short;
			$klasifikasi[] 			= $json_array;
			//$klasifikasi[] 	= $d->pejabat;
		}
		
		echo json_encode($klasifikasi);
	}
	
	
public function get_jabfungum() {
		$kode 				= $this->input->post('kode',TRUE);
		$data 				=  $this->db->query("SELECT jabfungum FROM a_jabfungum where jabfungum LIKE '%$kode%'")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->jabfungum;
			$json_array['label']	= $d->jabfungum;
			$klasifikasi[] 			= $json_array;
			//$klasifikasi[] 	= $d->pejabat;
		}
		
		echo json_encode($klasifikasi);
	}
	public function get_golkp() {
		$kode 				= $this->input->post('kode',TRUE);
		$data 				=  $this->db->query("SELECT * FROM a_golruang where golru LIKE '%$kode%'")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->golru;
			$json_array['label']	= $d->golru;
			$klasifikasi[] 			= $json_array;
			//$klasifikasi[] 	= $d->pejabat;
		}
		
		echo json_encode($klasifikasi);
	}
	public function get_tkpendid() {
		//$kode 				= $this->input->post('kode',TRUE);
		
		$data 				=  $this->db->query("SELECT tkpendid from a_tkpendid WHERE tkpendid LIKE '%$kode%' GROUP BY id")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->tkpendid;
			$json_array['label']	= $d->tkpendid;
			$klasifikasi[] 			= $json_array;
			//$klasifikasi[] 	= $d->unit_pengolah;
		}
		
		echo json_encode($klasifikasi);
	}
	
	
	public function get_jam() {
		$kode 				= $this->input->post('kode',TRUE);
		
		$data 				=  $this->db->query("SELECT jam FROM t_jam WHERE jam LIKE '%$kode%' GROUP BY id")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->jam;
			$json_array['label']	= $d->jam;
			$klasifikasi[] 			= $json_array;
			//$klasifikasi[] 	= $d->unit_pengolah;
		}
		
		echo json_encode($klasifikasi);
	}
	
	
	public function get_jurusan() {
		$kode 				= $this->input->post('kode',TRUE);
		
		$data 				=  $this->db->query("SELECT jenjurusan FROM a_jenjurusan WHERE jenjurusan LIKE '%$kode%'")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->jenjurusan;
			$json_array['label']	= $d->jenjurusan;
			$klasifikasi[] 			= $json_array;
			//$klasifikasi[] 	= $d->unit_pengolah;
		}
		
		echo json_encode($klasifikasi);
	}
	
		public function get_ver() {
		$kode 				= $this->input->post('kode',TRUE);
		
		$data 				=  $this->db->query("SELECT status FROM t_verifikasi WHERE unit_pengolah LIKE '%$kode%' GROUP BY id")->result();
		
		$klasifikasi 		=  array();
        foreach ($data as $d) {
			$json_array				= array();
            $json_array['value']	= $d->unit_pengolah;
			$json_array['label']	= $d->unit_pengolah;
			$klasifikasi[] 			= $json_array;
			//$klasifikasi[] 	= $d->unit_pengolah;
		}
		
		echo json_encode($klasifikasi);
	}
	
	public function disposisi_cetak() {
		$idu = $this->uri->segment(3);
		$a['datpil1']	= $this->db->query("SELECT * FROM t_mutasi_kelas WHERE id = '$idu'")->row();	
		$a['datpil2']	= $this->db->query("SELECT * FROM t_disposisi WHERE id = '$idu'")->result();	
		$this->load->view('admin/f_disposisi', $a);
	}

	public function passwod() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("admin/login");
		}
		
		$ke				= $this->uri->segment(3);
		$id_user		= $this->session->userdata('admin_id');
		
		//var post
		$p1				= md5($this->input->post('p1'));
		$p2				= md5($this->input->post('p2'));
		$p3				= md5($this->input->post('p3'));
		
		if ($ke == "simpan") {
			$cek_password_lama	= $this->db->query("SELECT password FROM t_admin WHERE id = $id_user")->row();
			//echo 
			
			if ($cek_password_lama->password != $p1) {
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Lama tidak sama'.$this->db->last_query().'-'.$cek_password_lama->p.'-'.$p1.'</div>');
				redirect('admin/passwod');
			} else if ($p2 != $p3) {
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Baru 1 dan 2 tidak cocok</div>');
				redirect('admin/passwod');
			} else {
				$this->db->query("UPDATE t_admin SET password = '$p3' WHERE id = '1'");
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-success">Password berhasil diperbaharui</div>');
				redirect('admin/passwod');
			}
		} else {
			$a['page']	= "f_passwod";
		}
		
		$this->load->view('admin/aaa', $a);
	}
	
	//login
	public function login() {
	//	$a['data']	= $this->db->query("SELECT * FROM t_mutasi_kelas order by tgl_surat DESC ")->result();
	
		$this->load->view('admin/login');
		
		
	}
	
	public function do_login() {
		$u 		= $this->security->xss_clean($this->input->post('u'));
		$ta 	= $this->security->xss_clean($this->input->post('ta'));
        $p 		= md5($this->security->xss_clean($this->input->post('p')));
         
		$q_cek	= $this->db->query("SELECT * FROM t_admin WHERE username = '".$u."' AND password = '".$p."'");
		$j_cek	= $q_cek->num_rows();
		$d_cek	= $q_cek->row();
		//echo $this->db->last_query();
		
        if($j_cek == 1) {
            $data = array(
                    'admin_id' => $d_cek->id,
                    'admin_user' => $d_cek->username,
                    'admin_nama' => $d_cek->nama,
                    'admin_ta' => $ta,
                    'admin_level' => $d_cek->level,
					'admin_idskpd' => $d_cek->idskpd,
					'admin_skpd' => $d_cek->skpd,
					'admin_valid' => true
                    );
            $this->session->set_userdata($data);
            redirect('admin');
        } else {	
			$this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
			redirect('admin/login');
		}
	}
	
	public function logout(){
        $this->session->sess_destroy();
		redirect('admin/login');
    }
}