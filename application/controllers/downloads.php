<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends CI_Controller {

	public function index()
	{
		$data['header'] = '
		<title>ดาวน์โหลด CodeIgniter PHP Framework</title>
		<meta name="Description" content="รวมเวอร์ชั่นของ CodeIgniter ให้สมาชิกได้เลือกโหลดกัน" />
		<meta name="Keywords" content="download,php,codeigniter,framework,ดาวน์โหลด" />';
		$data['content_data'] = array('q'=>$this->db->where('group',1)->order_by('id','DESC')->get('ci_downloads'));
		$data['content_view'] = 'welcome/downloads';
		$this->load->view('default',$data);
	}
	
	public function version()
	{
		
		$this->db->set('counter','counter+1',false);
		$this->db->set('up_date','now()',false);
		$this->db->where('name',$this->uri->segment(3));
		$this->db->update('ci_downloads');
		
		$filename1 = 'storage/codeigniter/'.$this->uri->segment(3);
	    $file_extension = strtolower(substr(strrchr($filename1,'.'),1));
		
           switch ($file_extension) {
               case 'pdf': $ctype='application/pdf'; break;
               case 'exe': $ctype='application/octet-stream'; break;
               case 'zip': $ctype='application/zip'; break;
               case 'doc': $ctype='application/msword'; break;
               case 'xls': $ctype='application/vnd.ms-excel'; break;
               case 'ppt': $ctype='application/vnd.ms-powerpoint'; break;
               case 'gif': $ctype='image/gif'; break;
               case 'png': $ctype='image/png'; break;
               case 'jpe': case 'jpeg':
               case 'jpg': $ctype='image/jpg'; break;
               default: $ctype='application/force-download';
           }
		 
         header('Content-Type: '.$ctype);
		 header('Content-Description: File Transfer');
		 header('Content-Disposition: attachment; filename='.basename($filename1));
		 header('Content-Transfer-Encoding: binary');
		 header('Content-Length: '.filesize($filename1));
		 readfile($filename1) or die('File not found.');
	}
	
	public function codes()
	{
		
		$this->db->set('counter','counter+1',false);
		$this->db->set('up_date','now()',false);
		$this->db->where('name',$this->uri->segment(3));
		$this->db->update('ci_downloads');
		
		$filename1 = 'storage/codes/'.$this->uri->segment(3);
	    $file_extension = strtolower(substr(strrchr($filename1,'.'),1));
		
           switch ($file_extension) {
               case 'pdf': $ctype='application/pdf'; break;
               case 'exe': $ctype='application/octet-stream'; break;
               case 'zip': $ctype='application/zip'; break;
               case 'doc': $ctype='application/msword'; break;
               case 'xls': $ctype='application/vnd.ms-excel'; break;
               case 'ppt': $ctype='application/vnd.ms-powerpoint'; break;
               case 'gif': $ctype='image/gif'; break;
               case 'png': $ctype='image/png'; break;
               case 'jpe': case 'jpeg':
               case 'jpg': $ctype='image/jpg'; break;
               default: $ctype='application/force-download';
           }
		 
         header('Content-Type: '.$ctype);
		 header('Content-Description: File Transfer');
		 header('Content-Disposition: attachment; filename='.basename($filename1));
		 header('Content-Transfer-Encoding: binary');
		 header('Content-Length: '.filesize($filename1));
		 readfile($filename1) or die('File not found.');
	}
	
}
?>