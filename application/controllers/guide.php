<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guide extends CI_Controller {

	public function index()
	{
		if($this->uri->segment(2)){
			
			$this->db->where('url',$this->uri->segment(2));
			$this->db->where('active',1);
			$q = $this->db->get('ci_guide');
			if($q->num_rows > 0){
				$this->load->helper('text');
				$r = $q->row();
				
				$this->db->where('id',$r->id);
				$this->db->set('counter','counter+1',false);
				$this->db->update('ci_guide');
				
				$data['header'] = '
				<title>'.$r->title.'</title>
				<meta name="description" content="'.get_description($r->detail).'" />
				<meta name="keywords" content="'.$r->keyword.'" />';
				$data['content_view'] = 'page/index';
				$data['content_data'] = array('title'=>$r->title,'detail'=>$r->detail);
				$this->load->view('default',$data);
			}
		}
	}
	
}
?>