<header>
	<h1>ข้อมูลสมาชิก</h1><hr />
</header>
<article>
<form method="post" action="<?php echo site_url('profile/send_message'); ?>" class="form-horizontal">
	<input type="hidden" name="user_id" value="<?php echo $r->user_id; ?>" />
    <input type="hidden" name="user_name" value="<?php echo $r->name; ?>" />
	<legend><?php echo $r->name; ?></legend>
<div class="row">
    	<div class="span8">
    <div class="control-group">
            <label class="control-label">ชื่อสมาชิก</label>
            <div class="controls"><?php echo $r->name; ?></div>
    </div>
    <div class="control-group">
            <label class="control-label">พลังน้ำใจ</label>
            <div class="controls"><?php echo $r->thanks; ?></div>
    </div>
    <div class="control-group">
            <label class="control-label">ระดับ </label>
            <div class="controls"><?php echo exp_to_lv($r->exp); ?></div>
    </div>
    <div class="control-group">
            <label class="control-label">สมัครสมาชิกเมื่อ</label>
            <div class="controls"><?php echo $r->regis_date; ?>
            <p class="help-block"><?php echo rel_time($r->regis_date); ?></p>
            </div>
    </div>
    <div class="control-group">
            <label class="control-label">เข้าใช้งานล่าสุด</label>
            <div class="controls"><?php echo $r->up_date; ?>
            <p class="help-block"><?php echo rel_time($r->up_date); ?></p>
            </div>
    </div>
    <div class="control-group">
            <label class="control-label">ลายเซ็นต์</label>
            <div class="controls"><?php echo nl2br($r->signature); ?></div>
    </div>
    	</div>
        <div class="span4"><?php echo image_users($r->image); ?></div>
</div>
    
    <legend>ส่งข้อความถึง <?php echo $r->name; ?></legend>
    <div class="control-group">
    	<label class="control-label">ชื่อของคุณ</label>
    	<div class="controls"><input type="text" name="name" id="name" value="<?php echo $now_user; ?>" class="required span4" /></div>
    </div>
    <?php if(!$now_user){ ?>
    <div class="control-group">
    	<label class="control-label">อีเมลติดต่อกลับ</label>
    	<div class="controls"><input type="text" name="email" id="email" class="required email span4" /></div>
    </div>
    <?php } ?>
    <div class="control-group">
    	<label class="control-label">หัวข้อ</label>
    	<div class="controls"><input type="text" name="title" id="title" class="required span8" /></div>
    </div>
    
    <div class="control-group">
    	<label class="control-label">รายละเอียด</label>
    	<div class="controls"><textarea name="detail" id="detail" class="span8" rows="8"></textarea></div>
    </div>
    
    <div class="form-actions">
    	<button type="submit" class="btn btn-primary">ส่งข้อความ</button>
        <button type="reset" class="btn">ยกเลิก</button>
    </div>
</form>
</article>