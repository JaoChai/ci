<header>
</header>
<article>
<form name="register" id="register" method="post" enctype="multipart/form-data" class="form-horizontal">
	<input type="hidden" name="profile" value="1">
	<fieldset>
    	  <legend>ข้อมูลส่วนตัว</legend>
          <div class="row">
              <div class="span10">
                  <div class="control-group">
                    <label class="control-label">อีเมลล์</label>
                    <div class="controls"><input type="text" readonly value="<?php echo $r->email; ?>" class="span4" /></div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">ชื่อที่แสดง</label>
                    <div class="controls"><input type="text" readonly value="<?php echo $r->name; ?>" class="span4" /></div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">รูปภาพโปรไฟล์</label>
                    <div class="controls"><input type="file" name="userfile" id="userfile" /></div>
                  </div>
                  <div class="control-group">
            		<label class="control-label">&nbsp;</label>
            		<div class="controls"><?php echo $msg1; ?></div>
          		  </div>
              </div>
              <div class="span2">
                  <?php echo image_users($r->image); ?>
              </div>
          </div>
          <legend>แก้ไขรหัสผ่าน</legend>
          <div class="control-group">
            <label class="control-label">รหัสผ่านเดิม</label>
            <div class="controls"><input type="password" name="passwordold" id="passwordold" class="span4" minlength="6" /></div>
          </div>
          <div class="control-group">
            <label class="control-label">รหัสผ่านใหม่</label>
            <div class="controls"><input type="password" name="password1" id="password1" class="span4" minlength="6" /></div>
          </div>
          <div class="control-group">
            <label class="control-label">ยืนยัน รหัสผ่าน</label>
            <div class="controls"><input type="password" name="password2" id="password2" class="span4" /></div>
          </div>
          
          <div class="control-group">
            <label class="control-label">&nbsp;</label>
            <div class="controls"><?php echo $msg2; ?></div>
          </div>
                  
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
	</fieldset>
</form>
</article>
<script>
$(function(){
	jQuery.extend(jQuery.validator.messages,{
		required:"กรุณากรอกข้อมูล",
		requiredId:"ข้อมูลรหัสต้องไม่มีสัญลักษณ์",
		remote:"ข้อมูลนี้ถูกใช้ไปแล้ว",
		email:"รูปแบบ อีเมลล์ของคุณไม่ถูกต้อง",
		url:"รูปแบบ ลิ้งของคุณไม่ถูกต้อง",
		date:"รูปแบบวันที่ของคุณไม่ถูกต้อง",
		dateISO:"รูปแบบวันที่ของคุณไม่ถูกต้อง",
		number:"กรุณากรอกเฉพาะตัวเลขเท่านั้น",
		digits:"กรุณากรอกเฉพาะตัวเลขเท่านั้น",
		creditcard:"รูปแบบบัตรเครดิตไม่ถูกต้อง",
		equalTo:"รหัสผ่านไม่ตรงกัน",
		accept:"ข้อมูลไม่ถูกต้อง",
		maxlength:jQuery.validator.format("ข้อมูลต้องมีความยาวไม่เกิน {0} ตัว"),
		minlength:jQuery.validator.format("ข้อมูลต้องไม่น้อยกว่า {0} ตัว"),
		rangelength:jQuery.validator.format("ข้อมูลต้องอยู่ในช่วง {0} ถึง {1}"),
		range:jQuery.validator.format("ข้อมูลต้องอยู่ในช่วง {0} ถึง {1}"),
		max:jQuery.validator.format("โปรดระบุค่าน้อยกว่าหรือเท่ากับ {0}"),
		min:jQuery.validator.format("โปรดระบุค่ามากกว่าหรือเท่ากับ {0}")
	});
	$("#register").validate({
	  rules: {
		password2: {
		  equalTo: "#password1"
	  }}
	});		   
});
</script>