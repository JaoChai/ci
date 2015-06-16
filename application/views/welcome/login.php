<article>
<form name="login" id="login" method="post" class="form-horizontal" action="<?php echo site_url('users/login'); ?>">
	<fieldset>
          <legend>เข้าสู่ระบบ</legend>
          <div class="control-group">
            <label class="control-label">อีเมลล์</label>
            <div class="controls"><input type="text" name="email" id="email" class="required email span4" /></div>
          </div>
          <div class="control-group">
            <label class="control-label">รหัสผ่าน</label>
            <div class="controls"><input type="password" name="password" id="password" class="required span4" minlength="6" /></div>
          </div>
          <div class="control-group">
            <label class="control-label">&nbsp;</label>
            <div class="controls"><input type="checkbox" name="longtime" id="longtime"  /> คงสถานะการเข้าระบบ</div>
          </div>
          <div class="control-group">
            <label class="control-label">&nbsp;</label>
            <div class="controls"><?php echo $msg; ?></div>
          </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">เข้าสู่ระบบ</button>
            <button type="reset" class="btn">ยกเลิก</button>
        </div>
	</fieldset>
</form>
</article>
<script>
$(function(){
	jQuery.extend(jQuery.validator.messages,{
		required:"กรุณากรอกข้อมูล",
		email:"รูปแบบ อีเมลล์ของคุณไม่ถูกต้อง",
		maxlength:jQuery.validator.format("ข้อมูลต้องมีความยาวไม่เกิน {0} ตัว"),
		minlength:jQuery.validator.format("ข้อมูลต้องไม่น้อยกว่า {0} ตัว")
	});
	$("#login").validate();		   
});
</script>