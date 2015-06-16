<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		
	}
	
	public function login()
	{
		$data['msg'] = '&nbsp;';
		if($this->input->post('email')){
			$this->db->where('active',1);
			$this->db->where('email',strtolower($this->input->post('email')));
			$q = $this->db->get('ci_member');
			if($q->num_rows() > 0){
				$this->load->library('encrypt');
				$r = $q->row();
				if($this->input->post('password') == $this->encrypt->decode($r->password)){
					if($this->input->post('longtime')){
						$time = 86500*100;
					}else{
						$time = -1;
					}
					
					$cookie = array(
						'name'   => 'name',
						'value'  => $r->name,
						'expire' => $time
					);
					$this->input->set_cookie($cookie);
					
					$cookie = array(
						'name'   => 'user_id',
						'value'  => $r->user_id,
						'expire' => $time
					);
					$this->input->set_cookie($cookie);
					
					$cookie = array(
						'name'   => 'image',
						'value'  => $r->image,
						'expire' => $time
					);
					$this->input->set_cookie($cookie);
					
					$this->db->where('user_id',$r->user_id);
					$this->db->set('up_date','now()',false);
					$this->db->update('ci_member');
					
					if($this->input->post('url')){
						redirect($this->input->post('url'), 'refresh');
					}else{
						redirect('', 'refresh');
					}
				}else{
					$data['msg'] = '<div class="alert alert-error"><strong>ไม่สามารถเข้าสู่ระบบได้</strong> รหัสผ่านของคุณไม่ถูกต้อง</div>';
				}
			}else{
				$data['msg'] = '<div class="alert alert-error"><strong>ไม่สามารถเข้าสู่ระบบได้</strong> ชื่อเข้าใช้ไม่ถูกต้อง</div>';
			}
		}
		
		$data['header'] = js_asset('jquery.js').js_asset('jquery_validate.js').'<title>ระบบสมาชิก - เข้าสู่ระบบ</title>';
		$data['content_view'] = 'welcome/login';
		$this->load->view('default',$data);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		delete_cookie('user_id');
		delete_cookie('name');
		delete_cookie('image');
		redirect('', 'refresh');
	}
	
	public function register()
	{
		if($this->input->post('email')){
			require_once('storage/captcha/securimage.php');
			$securimage = new Securimage();
			if ($securimage->check($this->input->post('captcha')) == false) {
				$data['content_text'] = '<header><h1>ผลการสมัครสมาชิก</h1><hr><p>การสมัครสมาชิกล้มเหลว<p></header>
				<p>รหัสยืนยันยันรูปภาพไม่ถูกต้อง</p><p><a href="javascript:history.go(-1)" class="btn"><< กลับ</a></p>';
			}else{
				$this->load->library('encrypt');
				$arr = array(
					'email'		=> strtolower($this->input->post('email')),
					'password'	=> $this->encrypt->encode($this->input->post('password1')),
					'name'		=> $this->input->post('name'),
					'active'	=> 1
				);
				$this->db->set('regis_date','now()',false);
				$this->db->insert('ci_member',$arr);
				$data['header'] = '<title>ผลการสมัครสมาชิก</title>';
				$data['content_text'] = '<header>
				<h1>ผลการสมัครสมาชิก</h1><hr><p>คุณได้ทำการสมัครสมาชิกเรียบร้อยแล้ว</p>
				</header>
				<p>คุณสามารถเข้าสู่ระบบได้ที่เมนู เข้าสู่ระบบ หรือ <a href="'.site_url('users/login').'">คลิกที่นี่</a></p>
				<p>ยินดีต้อนรับเข้าสู่สังคมผู้ใช้ Codeigniter ครับ</p>';				
			}
		}else{		
			$data['header'] = js_asset('jquery_validate.js').'<title>สมัครสมาชิกเข้าสู่สังคมผู้ใช้ CodeIgniter</title>';
			$data['content_view'] = 'welcome/register';
		}
		$this->load->view('default',$data);
	}
	
	public function check_email()
	{
		$q = $this->db->where('email',strtolower($this->input->post('email')))->get('ci_member');	
		if($q->num_rows > 0){
			echo 'false';
		}else{
			echo 'true';
		}
	}
	
	public function thanks()
	{
		if($this->input->cookie('user_id')){
			if($this->input->post('id')){
				$this->db->where('user_id_a',$this->input->cookie('user_id'));
				$this->db->where('user_id_b',$this->input->post('id'));
				$this->db->where('post_date',date('Y-m-d'));
				$q = $this->db->get('ci_board_thanks');
				if($q->num_rows == 0){
					$arr = array(
						'user_id_a'	=> $this->input->cookie('user_id'),
						'user_id_b'	=> $this->input->post('id'),
						'post_date'	=> date('Y-m-d'),
						'active'	=> 1
					);
					$this->db->insert('ci_board_thanks',$arr);
					
					$this->db->where('user_id',$this->input->post('id'));
					$this->db->set('thanks','(SELECT COUNT(id) FROM ci_board_thanks WHERE user_id_b='.$this->input->post('id').' and active=1)',false);
					$this->db->update('ci_member');
					
					echo 'ขอบคุณเรียบร้อยแล้ว';
				}else{
					echo "ไม่สามารถขอบคุณได้\r\nวันนี้คุณได้ขอบคุณสมาชิกท่านนี้ไปแล้ว";
				}
			}
		}
	}
	
}
?>