<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
		$this->db->where('user_id',$this->input->cookie('user_id'));
		$q1 = $this->db->get('ci_member');
		$q2 = $q1;
		$r = $q1->row();
		$data['msg1'] = '&nbsp;';
		$data['msg2'] = '&nbsp;';
		if($this->input->post('profile')){
			$file_upload = false;
			$file_name = NULL;
			$this->load->helper('string');
			$config['file_name'] = random_string('alnum',10);
			$config['upload_path'] = 'storage/users/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '200';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$this->load->library('upload', $config);
			if($this->upload->do_upload()){
				$upload_data = $this->upload->data();
				
				$config['source_image'] = 'storage/users/'.$upload_data['file_name'];
				$config['new_image'] = 'storage/users/128/';
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 128;
				$config['height'] = 256;
				$this->load->library('image_lib',$config);
				$this->image_lib->resize();
				
				$config['source_image'] = 'storage/users/'.$upload_data['file_name'];
				$config['new_image'] = 'storage/users/32/';
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = 32;
				$config['height'] = 32;
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				if($r->image){
					unlink('storage/users/32/'.$r->image);
					unlink('storage/users/128/'.$r->image);
				}
				unlink('storage/users/'.$upload_data['file_name']);
				
				$cookie = array(
					'name'   => 'image',
					'value'  => $upload_data['file_name'],
					'expire' => 86500*100
				);
				$this->input->set_cookie($cookie);
				
				$file_name = $upload_data['file_name'];
				$file_upload = true;
			}else{
				$msg = $this->upload->display_errors();
				if($msg!=' '){
				$data['msg1'] = '<div class="alert alert-error"><strong>ไม่สามารถอัพโหลดได้</strong> '.$msg.'</div>';
				}
			}
			
			if($file_upload){
				$this->db->set('image',$file_name);
			}
			if($this->input->post('passwordold')){
				if($this->input->post('password1')){
					$this->load->library('encrypt');
					if($this->input->post('passwordold') == $this->encrypt->decode($r->password)){
						$this->db->set('password',$this->encrypt->encode($this->input->post('password1')));
					}else{
						$data['msg2'] = '<div class="alert alert-error"><strong>ไม่สามารถเปลี่ยนรหัสผ่านได้</strong> รหัสผ่านเดิมของคุณไม่ถูกต้อง</div>';
					}
				}else{
					$data['msg2'] = '<div class="alert alert-error"><strong>ไม่สามารถเปลี่ยนรหัสผ่านได้</strong> กรุณากรอก รหัสผ่านใหม่</div>';
				}
			}
			$this->db->set('up_date','now()',false);
			$this->db->where('user_id',$this->input->cookie('user_id'));
			$this->db->update('ci_member');
		}
		
		$data['header'] = js_asset('jquery_validate.js');
		$data['content_view'] = 'profile/user_profile';
		$data['content_data'] = array('r'=>$q2->row());
		$this->load->view('default',$data);
	}
	
	public function message()
	{
		//$data['header'] = js_asset('jquery_validate.js');
		$data['content_view'] = 'profile/user_message';
		//$data['content_data'] = array('r'=>$q2->row());
		$this->load->view('default',$data);
	}
	
	public function send_message()
	{
		$data['content_text'] = '';
		if($this->input->post('title')){
			
			
			$arr = array(
				'user_id'	=> $this->input->post('user_id'),
				'user_name'	=> $this->input->post('name'),
				'email'		=> ($this->input->post('email')?$this->input->post('email'):NULL),
				'title'		=> $this->input->post('title'),
				'detail'	=> $this->input->post('detail'),
				'user_read'	=> 0,
				'active'	=> 0
			);
			$this->db->set('post_date','now()',false);
			$this->db->insert('ci_message',$arr);
			
			$data['content_text'] = '<h1>ผลการส่งข้อความ</h1><hr><p>ส่งข้อความไปยังสมาชิก '.$this->input->post('user_name').' เรียบร้อยแล้ว</p>';
			
		}		
		$this->load->view('default',$data);
	}
	
	public function users()
	{
		if($this->uri->segment(3)){
			$this->db->where('user_id',$this->uri->segment(3));
			$this->db->where('active',1);
			$q = $this->db->get('ci_member');
			
			$data['content_view'] = 'profile/users';
			$data['content_data'] = array('r'=>$q->row(),'now_user'=>($this->input->cookie('name')?$this->input->cookie('name'):''));
			
			$this->load->view('default',$data);
		}
	}
	
}
?>