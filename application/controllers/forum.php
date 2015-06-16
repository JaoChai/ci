<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller {

	var $per_page = 20;
	
	/*
	function __construct()
	{
		parent::__construct();
	}
	*/
	
	public function index()
	{
		$data['header'] = '
		<title>กระดานสนทนา - CodeIgniter.in.th</title>
		<meta name="description" content="พูดคุยกับสมาชิกชาวโปรแกรมเมอร์ ผู้ใช้ CodeIgniter ได้ที่นี่" />
		<meta name="keywords" content="โปรแกรมเมอร์,คุยกัน,สนทนา,เว็บบอร์ด,ถามปัญหา,codeigniter" />';
		
		$this->db->select('A.id,A.title as topic,A.post_date,B.url,B.title,C.user_id,C.name');
		$this->db->from('ci_board_topic A');
		$this->db->join('ci_board_group B','A.group_id=B.id');
		$this->db->join('ci_member C','A.user_id=C.user_id');
		$this->db->where('A.active',1);
		$this->db->where('B.id !=',10);
		$this->db->group_by('A.id');
		$this->db->order_by('A.reply_date','DESC');
		$this->db->limit(20);
		$q = $this->db->get();
		
		$data['content_view'] = 'forum/list';
		$data['content_data'] = array('list'=>$q,'q'=>$this->db->where('active',1)->order_by('seq','ASC')->get('ci_board_group'));
		$this->load->view('default',$data);
	}
	
	public function group()
	{
		$this->load->library('pagination');
		if($this->uri->segment(3)){
			$topic = $this->uri->segment(3);
			
			$this->db->select('A.id,A.title as topic,A.detail,A.post_date,A.up_date,B.url,B.title,C.user_id,C.name,C.thanks,C.exp,C.image,C.signature');
			$this->db->where('A.id',$topic);
			$this->db->where('A.active',1);
			$this->db->join('ci_board_group B','A.group_id=B.id');
			$this->db->join('ci_member C','A.user_id=C.user_id');
			$q = $this->db->get('ci_board_topic A');
			$qq = $q;
			if($qq->num_rows() > 0){
				$this->load->helper('text');
				$rr = $qq->row();
				if(!$this->input->cookie('user_id')){
					$ass = js_asset('jquery_validate.js');
				}else{
					$ass = '';
				}
				$data['header'] = $ass.css_asset('jquery.superbox.css').js_asset('jquery.superbox.js').js_asset('custom.js').'
				<title>'.$rr->topic.' - '.$rr->title.'</title>
				<meta name="description" content="'.get_description($rr->detail).'" />
				<meta name="keywords" content="'.get_keywords($rr->detail).'" />';

				if(!$this->input->cookie('forum_'.$topic)){
					$this->db->where('id',$topic);
					$this->db->set('counter','counter+1',false);
					$this->db->update('ci_board_topic');
					$this->input->set_cookie(array('name'=>'forum_'.$topic,'value'=>$topic,'expire'=>-1));
				}
				
				$this->db->where('topic_id',$topic);
				$this->db->from('ci_board_reply');
				$config['base_url'] = site_url('forum/'.$this->uri->segment(2).'/'.$topic.'/');
				$config['total_rows'] = $this->db->count_all_results();
				$config['per_page'] = $this->per_page;
				$this->pagination->initialize($config); 
				$pagination = $this->pagination->create_links();
				
				$this->db->select('A.id,A.detail,A.post_date,B.user_id,B.name,B.thanks,B.exp,B.image,B.signature');
				$this->db->where('A.topic_id',$topic);
				$this->db->where('A.active',1);
				$this->db->order_by('A.id','ASC');
				$this->db->limit($this->per_page,($this->uri->segment(4)?$this->uri->segment(4):0));
				$this->db->join('ci_member B','A.user_id=B.user_id');
				$data['content_view'] = 'forum/topic';
				$data['content_data'] = array('r'=>$q->row(),'reply'=>$this->db->get('ci_board_reply A'),'pagination'=>$pagination);
				$this->load->view('default',$data);
			}else{
				$data['content_view'] = 'forum/none';
				$this->load->view('default',$data);
			}
		}else{
			$this->db->where('url',$this->uri->segment(2));
			$this->db->where('active',1);
			$q = $this->db->get('ci_board_group');
			$qq = $q;
			$r = $qq->row();
			$data['header'] = '
			<title>คุยกันเรื่อง '.$r->title.' - CodeIgniter.in.th</title>
			<meta name="description" content="'.$r->detail.'" />
			<meta name="keywords" content="'.str_replace('_',',',$r->url).'" />';
			
			$this->db->where('group_id',$r->id);
			$this->db->from('ci_board_topic');
			$config['base_url'] = site_url('forum/'.$r->url.'/0/');
			$config['total_rows'] = $this->db->count_all_results();
			$config['per_page'] = $this->per_page;
			$config['suffix']	= '';
			$this->pagination->initialize($config); 
			$pagination = $this->pagination->create_links();
			
			$this->db->select('A.id,A.title as topic,A.post_date,A.reply,A.counter,B.url,C.user_id,C.name');
			$this->db->where('B.url',$this->uri->segment(2));
			$this->db->where('A.active',1);
			$this->db->order_by('A.seq','DESC');
			$this->db->order_by('A.reply_date','DESC');
			$this->db->limit($this->per_page,($this->uri->segment(4)?$this->uri->segment(4):0));
			$this->db->from('ci_board_topic A');
			$this->db->join('ci_board_group B','A.group_id=B.id');
			$this->db->join('ci_member C','A.user_id=C.user_id');
			$data['content_view'] = 'forum/group';
			$data['content_data'] = array('list'=>$this->db->get(),'r'=>$q->row(),'pagination'=>$pagination);
			$this->load->view('default',$data);
		}
	}
	
	public function topic()
	{
		if($this->input->cookie('user_id')){

			if($this->input->post('group')){
				require_once('storage/captcha/securimage.php');
				$securimage = new Securimage();
				if ($securimage->check($this->input->post('captcha')) == false){
					$data['content_text'] = '
			<header><h1>กระดานสนทนา</h1><hr><p>ผลการโพสกระทู้ล้มเหลว<p></header>
			<p>รหัสยืนยันยันรูปภาพไม่ถูกต้อง</p><p><a href="javascript:history.go(-1)" class="btn"><< กลับ</a></p>';
					$this->load->view('default',$data);
				}else{
					$this->db->where('user_id',$this->input->cookie('user_id'));
					$this->db->set('exp','exp+3',false);
					$this->db->update('ci_member');
					
					$arr = array(
						'seq'		=> 0,
						'user_id'	=> $this->input->cookie('user_id'),
						'group_id'	=> $this->input->post('group'),
						'title'		=> strip_tags($this->input->post('topic')),
						'detail'	=> tags_allow($this->input->post('detail')),
						'counter'	=> 0,
						'reply'		=> 0,
						'active'	=> 1
					);
					$this->db->set('post_date','now()',false);
					$this->db->set('reply_date','now()',false);
					$this->db->insert('ci_board_topic',$arr);
					redirect('forum/'.$this->input->post('group_url').'/'.$this->db->insert_id(),'refresh');
				}
			}else{
				$data['header'] = js_asset('jquery_validate.js').css_asset('jquery.superbox.css').js_asset('jquery.superbox.js').js_asset('custom.js');
				$this->db->select('id');
				$this->db->where('url',$this->uri->segment(3));
				$q = $this->db->get('ci_board_group');
				
				$data['content_view'] = 'forum/new_topic';
				$data['content_data'] = array('group'=>$this->db->select('id,title')->get('ci_board_group'),'group_id'=>$q->row());
				$this->load->view('default',$data);
			}
		}else{
			redirect('users/login','refresh');
		}
	}
	
	public function topic_edit()
	{
		if($this->input->cookie('user_id')){
			$this->db->where('id',$this->uri->segment(3));
			$this->db->where('user_id',$this->input->cookie('user_id'));
			$q = $this->db->get('ci_board_topic');
			if($q->num_rows > 0){
				if($this->input->post('group')){						
					$arr = array(
						'group_id'	=> $this->input->post('group'),
						'title'		=> strip_tags($this->input->post('topic')),
						'detail'	=> tags_allow($this->input->post('detail'))
					);
					$this->db->set('up_date','now()',false);
					$this->db->set('reply_date','now()',false);
					$this->db->where('id',$this->uri->segment(3));
					$this->db->update('ci_board_topic',$arr);
					redirect('forum/back/'.$this->uri->segment(3),'refresh');
				}
				
				$data['header'] = js_asset('jquery_validate.js').css_asset('jquery.superbox.css').js_asset('jquery.superbox.js').js_asset('custom.js');
				$data['content_view'] = 'forum/edit_topic';
				$data['content_data'] = array('group'=>$this->db->select('id,title')->get('ci_board_group'),'r'=>$q->row());
				$this->load->view('default',$data);
			}else{
				echo 'มั่วนิ่ม??';	
			}
		}
	}
	
	public function reply()
	{
		if($this->input->post('topic_id')){
			$topic_id = $this->input->post('topic_id');
			
				$arr = array(
					'user_id'	=> $this->input->cookie('user_id'),
					'topic_id'	=> $topic_id,
					'detail'	=> tags_allow($this->input->post('reply_detail')),
					'active'	=> 1
				);
				$this->db->set('post_date','now()',false);
				$this->db->insert('ci_board_reply',$arr);
				$last_id = $this->db->insert_id();
				
			$this->db->where('id',$topic_id);
			$this->db->set('reply',"(SELECT COUNT(id) FROM ci_board_reply WHERE topic_id='$topic_id')",false);
			$this->db->set('reply_date','now()',false);
			$this->db->update('ci_board_topic');
			
			if(!$this->input->cookie('reply_'.$topic_id)){
				$this->db->where('topic_id',$topic_id);
				$this->db->where('user_id',$this->input->cookie('user_id'));
				$this->db->where('post_date','(now()-INTERVAL 60 SECOND)',false);
				$q = $this->db->get('ci_board_reply');
				if($q->num_rows <= 2){
					$this->db->where('user_id',$this->input->cookie('user_id'));
					$this->db->set('exp','exp+1',false);
					$this->db->update('ci_member');
				}else{
					$this->input->set_cookie(array('name'=>'reply_'.$topic_id,'value'=>$topic_id,'expire'=>600));
				}
			}
			
			$this->db->where('topic_id',$topic_id);
			$this->db->from('ci_board_reply');
			$reply_count = $this->db->count_all_results();
			$page = ((ceil($reply_count / $this->per_page) * $this->per_page) - $this->per_page);
			
			redirect('forum/'.$this->input->post('url')."/$topic_id/$page".'#reply'.$last_id, 'refresh');
			
		}	
	}
	
	public function emo()
	{
		$this->load->helper('file');
		$ff = get_filenames('storage/emo/');
		echo '<html><head><style>html,body{margin:0 10px;padding:0;}img{margin:5px;cursor:pointer;}</style></head><body>';
		foreach($ff as $val){
			echo '<a onclick="parent.get_emo(\'storage/emo/'.$val.'\');"><img src="'.base_url().'storage/emo/'.$val.'" width="50" height="50" /></a>';
		}
		echo '</body></html>';
	}
	
	public function msg_delete()
	{
		if($this->input->cookie('user_id')){
			if($this->input->post('dby')){
				$this->db->where('by_type',$this->input->post('dby'));
				$this->db->where('user_id',$this->input->cookie('user_id'));
				$this->db->where('del_id',$this->input->post('id'));
				$q = $this->db->get('ci_board_message');
				if($q->num_rows == 0){
					$arr = array(
						'by_type'	=> $this->input->post('dby'),
						'user_id'	=> $this->input->cookie('user_id'),
						'del_id'	=> $this->input->post('id')
					);
					$this->db->set('post_date','now()',false);
					$this->db->insert('ci_board_message',$arr);
					echo 'ยื่นคำร้องเสร็จเรียบร้อยแล้ว';
				}else{
					echo "คุณเคยยื่นคำร้องนี้ไปแล้ว\r\nคุณสามารถยื่นคำร้องได้เพียงครั้งเดียว!";
				}
				
				$this->db->where('by_type',$this->input->post('dby'));
				$this->db->where('del_id',$this->input->post('id'));
				$q = $this->db->get('ci_board_message');
				if($q->num_rows >= 10){
					$this->db->where('id',$this->input->post('id'));
					$this->db->update('ci_board_'.$this->input->post('dby'),array('active'=>0));
				}
			}
		}else{
			echo 'คุณยังไม่ได้ Login เข้าสู่ระบบ';	
		}
	}
	
}
?>