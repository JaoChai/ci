<header><h1><?php echo $r->topic; ?></h1><hr /></header>
<div class="row">
	<div class="span12">
    <div class="row">
    	<div class="span2 well">
        	<aside><a href="<?php echo site_url('profile/users/'.$r->user_id) ;?>"><?php echo $r->name; ?></a><br />พลังน้ำใจ : <?php echo $r->thanks; ?><br /> ระดับ : <?php echo exp_to_lv($r->exp); ?><br /><br /><?php if($this->input->cookie('user_id') && $this->input->cookie('user_id')!=$r->user_id){ ?>[ <a href="#" onclick="thanks(<?php echo $r->user_id; ?>);">ขอบคุณ</a> ]<br /><br /><?php } echo image_users($r->image); ?></aside>
        </div>
        <div class="span9 well">
            <article>
            <h3><?php echo $r->topic; ?></h3><hr />
            <div id="refer_topic<?php echo $r->id; ?>"><?php echo nl2br($r->detail); ?></div>
            </article>
            <hr />
            โพสเมื่อ : <?php echo $r->post_date.' | '.rel_time($r->post_date); if($this->input->cookie('user_id')){ ?> | <a href="#" onclick="msg_delete('topic',<?php echo $r->id; ?>);">แจ้งลบ</a> | <a href="#reply" onclick="refer('topic<?php echo $r->id; ?>');">อ้างถึง</a><?php if($this->input->cookie('user_id') == $r->user_id){ echo ' | <a href="'.site_url('forum/topic_edit/'.$r->id).'">แก้ไข</a>'; } if($r->up_date){ echo '<br>แก้ไขเมื่อ : '.$r->up_date.' | '.rel_time($r->up_date); } ?><a name="reader"></a><?php } if($r->signature){ echo '<hr />'.$r->signature; } ?>
        </div>
    </div>
<?php 
	echo $pagination;
	$page['url1']=$r->url;
	$page['title1']=$r->title;
	
	$page['url2']=$r->id;
	$page['title2']=$r->topic;
	$page['goto'] = 1;
	$this->load->view('tpl/breadcrumb',$page);
	
	if($reply->num_rows() > 0){
	foreach($reply->result() as $key => $r2){
?>
	<a name="reply<?php echo $r2->id; ?>"></a><?php if($key!=0) echo '<br />'; ?>
    	<div class="row">
    	<div class="span2 well">
        	<aside><a href="<?php echo site_url('profile/users/'.$r2->user_id) ;?>"><?php echo $r2->name; ?></a><br />พลังน้ำใจ : <?php echo $r2->thanks; ?><br /> ระดับ : <?php echo exp_to_lv($r2->exp); ?><br /><br /><?php if($this->input->cookie('user_id') && $this->input->cookie('user_id')!=$r2->user_id){ ?> [ <a href="#" onclick="thanks(<?php echo $r2->user_id; ?>)">ขอบคุณ</a> ]<br /><br /><?php } echo image_users($r2->image); ?></aside>
        </div>
        <div class="span9 well">
        	<article>
            <div id="refer_reply<?php echo $r2->id; ?>"><?php echo nl2br($r2->detail); ?></div>
            </article>
            <hr />
            ลำดับ : <?php echo ($key+1+($this->uri->segment(4)?$this->uri->segment(4):0)); ?> | ตอบเมื่อ : <?php echo $r2->post_date.' | '.rel_time($r2->post_date); if($this->input->cookie('user_id')){ ?> | <a href="#" onclick="msg_delete('reply',<?php echo $r2->id; ?>);">แจ้งลบ</a> | <a href="#reply" onclick="refer('reply<?php echo $r2->id; ?>');">อ้างถึง</a><?php } if($r2->signature){ echo '<hr />'.$r2->signature; } ?>
        </div>
    </div>
    <?php 
	}
	$page['goto'] = 2;
	$this->load->view('tpl/breadcrumb',$page);
	echo $pagination;
	}else{
	?>
		<div class="row"><div class="span12"><p><center>== ยังไม่มีสมาชิกตอบกระทู้นี้ ==</center></p><hr /></div></div>
	<?php 
	}
	if($this->input->cookie('user_id')){
		$this->load->view('forum/reply',array('topic_id'=>$r->id)); 
	}else{ 
		$data['msg']='<input type="hidden" name="url" value="'.current_url().'">';
		$this->load->view('welcome/login',$data); 
	}
	?>
    </div>
</div>