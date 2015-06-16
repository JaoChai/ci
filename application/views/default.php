<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico"/>
<script type="text/javascript">var base_url='<?php echo base_url(); ?>',site_url='<?php echo site_url(); ?>';var _gaq = _gaq || [];_gaq.push(['_setAccount', 'UA-29980451-1']);_gaq.push(['_trackPageview']);(function(){var ga=document.createElement('script');ga.type='text/javascript';ga.async=true;ga.src=('https:'==document.location.protocol?'https://ssl':'http://www')+'.google-analytics.com/ga.js';var s=document.getElementsByTagName('script')[0];s.parentNode.insertBefore(ga,s);})();</script>
<?php 
echo css_asset('default.css');
echo js_asset('jquery.js');
echo js_asset('dropdown.js');
if(isset($header)) echo $header;
?>
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="<?php echo base_url(); ?>" title="แหล่งชุมชนคนใช้ CodeIgniter PHP Framework"><?php echo image_asset('logo.png',NULL,array('width'=>290,'height'=>52)); ?></a>
      <div class="nav-collapse">
        <ul class="nav">
          <li<?php echo(!$this->uri->segment(1)?' class="active"':''); ?>><a href="<?php echo base_url(); ?>"><b class="icon-home icon-white"></b> หน้าแรก</a></li>
          <li<?php echo($this->uri->segment(1)=='downloads'?' class="active"':''); ?>><a href="<?php echo site_url('downloads'); ?>"><b class="icon-download icon-white"></b> ดาวน์โหลด</a></li>
          <li><a href="<?php echo base_url(); ?>user_guide" target="_blank"><b class="icon-fire icon-white"></b> คู่มือการใช้งาน</a></li>
          <?php if(!$this->input->cookie('user_id')){ ?>
          <li<?php echo($this->uri->segment(1)=='register'?' class="active"':''); ?>><a href="<?php echo site_url('register'); ?>"><b class="icon-pencil icon-white"></b> สมัครสมาชิก</a></li>
          <?php } ?>
          <li<?php echo($this->uri->segment(1)=='forum'?' class="active"':''); ?>><a href="<?php echo site_url('forum'); ?>"><b class="icon-comment icon-white"></b> เว็บบอร์ด</a></li>
        </ul>
        <div class="pull-right">
          <ul class="nav">
          <?php 
		  	if($this->input->cookie('user_id')){ 
				$path = 'storage/users/32/'.$this->input->cookie('image');
				if(!is_file($path)){
					$path = 'storage/users/32/default_users.png';
				}
		  ?>
            <li class="<?php echo($this->uri->segment(1)=='profile'?'active ':''); ?>dropdown">
              <a href="#" class="profile dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().$path; ?>" width="32" height="32" style="float:left;position:absolute;margin-left:-40px;margin-top:-7px;" /> 
			  <?php echo $this->input->cookie('name'); ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo site_url('profile'); ?>">ข้อมูลส่วนตัว</a></li>
                <li><a href="<?php echo site_url('profile/message'); ?>">กล่องข้อความ</a></li>
                <li><a href="#">กระทู้ของคุณ</a></li>
                <li class="divider"></li>
                <li><a href="<?php echo site_url('users/logout'); ?>"><b class="icon-off"></b> ออกจากระบบ</a></li>
              </ul>
            </li>
          <?php }else{ ?>
            <li<?php echo($this->uri->segment(2)=='login'?' class="active"':''); ?>><a href="<?php echo site_url('users/login'); ?>"><b class="icon-user icon-white"></b> เข้าสู่ระบบ</a></li>
          <?php } ?>
          </ul>
		</div>
      </div>
    </div>
  </div>
</div>
<div class="container">
	<div class="row">
    	<div class="span12" style="min-height:500px;">
<?php 
		if(isset($content_text)){echo $content_text;}
		if(isset($content_view) && !isset($content_data)){ $this->load->view($content_view); }
		if(isset($content_view) && isset($content_data)){
			foreach($content_data as $key => $value){ $data[$key] = $value; }
			$this->load->view($content_view,$data);
		} 
?>
		</div>
	</div>
</div>
<div class="well well-footer">
<div class="container">
    <div class="row">
      <div class="span12">
      	<nav>
	  	<?php echo image_asset('footer-logo.png',NULL,array('style'=>'position:absolute;margin-top:-23px;margin-left:-20px;','width'=>167,'height'=>81)); ?>
      	<div class="row offset2 nav-list">
          <div class="span3">
          <ul>
          	<li><b class="icon-home"></b> <a href="<?php echo base_url(); ?>" title="แหล่งชุมชนคนใช้ CodeIgniter PHP Framework">หน้าแรก</a></li>
            <li><b class="icon-download"></b> <a href="<?php echo site_url('downloads'); ?>">ดาวน์โหลด</a></li>
            <li><b class="icon-fire"></b> <a href="<?php echo base_url(); ?>user_guide" target="_blank">คู่มือการใช้งาน</a></li>
            <li><b class="icon-pencil"></b> <a href="<?php echo site_url('register'); ?>">สมัครสมาชิก</a></li>
            <li><b class="icon-comment"></b> <a href="<?php echo site_url('forum'); ?>">เว็บบอร์ด</a></li>
          </ul>
          </div>
          <div class="span3">
          <ul>
            <li><b class="icon-chevron-right"></b> <a href="<?php echo site_url('guide/sample_template'); ?>">ตัวอย่างการทำ template</a></li>
          </ul>
          </div>
          <div class="span3">
          <ul>
          	<li><b class="icon-chevron-right"></b> <a href="<?php echo site_url('jsmin'); ?>">ลดขนาดไฟล์ Javascript</a></li>
            <li><b class="icon-chevron-right"></b> <a href="<?php echo site_url('guide/up_speed_website'); ?>">เทคนิคทำให้เว็บโหลดเร็ว</a></li>
            <li><b class="icon-chevron-right"></b> <a href="<?php echo site_url('guide/install_fckeditor_on_codeigniter'); ?>">ติดตั้งและใช้งาน FCKeditor</a></li>
          </ul>
          </div>
        </div>
        </nav>
      </div>
    </div>
    <hr />
    <footer>
      <p>&copy; Codeigniter.in.th 2012 | หน้านี้ใช้เวลาในการสร้าง <strong>{elapsed_time}</strong> วินาที</p>
    </footer>
</div>
</div>
</body>
</html>
