<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->db->select('A.id,A.title as topic,A.post_date,B.url,B.title');
		$this->db->from('ci_board_topic A');
		$this->db->join('ci_board_group B','A.group_id=B.id');
		$this->db->group_by('A.id');
		$this->db->order_by('A.reply_date','DESC');
		$this->db->limit(10);
		$this->db->where('A.active',1);
		$this->db->where('B.id !=',10);
		$q = $this->db->get();
		
		$data['header'] = '
		<title>CodeIgniter.in.th - แหล่งชุมชนคนใช้ CodeIgniter PHP Framework</title>
		<meta name="description" content="แหล่งรวมความรู้ของคนทำเว็บเกี่ยวกับ codeigniter php Framework ที่ใช้งานง่าย" />
		<meta name="keywords" content="php,codeigniter,framework,สอนใช้งาน,วิธีการใช้งาน,เขียนเว็บด้วย" />';
		$data['content_view'] = 'welcome/index';
		$data['content_data'] = array('group'=>$this->db->select('url,title')->where('active',1)->get('ci_board_group'),'topic'=>$q);
		$this->load->view('default',$data);
	}
	
	public function jsmin()
	{
		$data['header'] = js_asset('jsminifier.js').'
		<title>ลดขนาดไฟล์ Javascript ด้วย JS Minifier</title>
		<meta name="description" content="JS Minifier ลดขนาดไฟล์ javascript สำหรับคนทำเว็บ" />
		<meta name="keywords" content="js minifier,ลดขนาดไฟล์,บีบอัดไฟล์,javascript" />
		<style>#outputtitle,#output,#statstitle,#stats{display:none;}</style>';
		$data['content_view'] = 'jsmin/index';
		$this->load->view('default',$data);
	}
	
}
?>