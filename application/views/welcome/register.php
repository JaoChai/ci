<header>
	<h1>สมัครสมาชิก</h1><hr>
    <p>ยินดีต้อนรับสมาชิกเข้าสู่สังคมผู้ใช้ Codeigniter เพื่อรับข่าวสารและแลกเปลี่ยนความรู้เกี่ยวกับวิธีการใช้งาน การแก้ปัญหาการใช้งาน</p>
</header>
<article>
<form name="register" id="register" method="post" class="form-horizontal">
	<fieldset>
          <legend>ฟอร์มกรอกสมัครสมาชิก</legend>
          <div class="control-group">
            <label class="control-label">อีเมลล์</label>
            <div class="controls"><input type="text" name="email" id="email" class="required email span4" />
            <p class="help-block">คำเตือน : หากสมัครสมาชิกด้วยอีเมลนี้แล้วจะไม่สามารถแก้ไขได้อีก</p></div>
          </div>
          <div class="control-group">
            <label class="control-label">ยืนยัน อีเมลล์</label>
            <div class="controls"><input type="text" name="email1" id="email1" class="email span4" /></div>
          </div>
          <div class="control-group">
            <label class="control-label">รหัสผ่าน</label>
            <div class="controls"><input type="password" name="password1" id="password1" class="required span4" minlength="6" /></div>
          </div>
          <div class="control-group">
            <label class="control-label">ยืนยัน รหัสผ่าน</label>
            <div class="controls"><input type="password" name="password2" id="password2" class="span4" /></div>
          </div>
          <div class="control-group">
            <label class="control-label">ชื่อที่แสดง</label>
            <div class="controls"><input type="text" name="name" id="name" class="required span4" minlength="4" />
            <p class="help-block">คำเตือน : หากสมัครสมาชิกด้วยชื่อนี้แล้วจะไม่สามารถแก้ไขได้อีก</p></div>
          </div>
          
          <div class="control-group">
            <label>&nbsp;</label>
            <img id="siimage" style="margin:0 20px" src="<?php echo base_url(); ?>storage/captcha/securimage_show.php?sid=<?php echo md5(uniqid()) ?>">
            <object type="application/x-shockwave-flash" data="<?php echo base_url(); ?>storage/captcha/securimage_play.swf?audio_file=<?php echo base_url(); ?>storage/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000" height="32" width="32">
            <param name="movie" value="./securimage_play.swf?audio_file=<?php echo base_url(); ?>storage/captcha/securimage_play.php&amp;bgColor1=#fff&amp;bgColor2=#fff&amp;iconColor=#777&amp;borderWidth=1&amp;borderColor=#000">
            </object>
            &nbsp;
            <a onclick="$('#siimage').attr('src','<?php echo base_url(); ?>storage/captcha/securimage_show.php?sid='+Math.random());this.blur();return false;" tabindex="-1" href="#" title="Refresh Image">
            <img src="<?php echo base_url(); ?>storage/captcha/images/refresh.png" onclick="this.blur()"></a>
        </div>
        <div class="control-group">
            <label class="control-label">พิมพ์ตัวอักษรที่เห็น</label>
            <div class="controls"><input type="text" name="captcha" maxlength="4" class="required span1" /></div>
          </div>
          
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
            <button type="reset" class="btn">ยกเลิก</button>
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
		equalTo:"ข้อมูลไม่ตรงกัน",
		accept:"ข้อมูลไม่ถูกต้อง",
		maxlength:jQuery.validator.format("ข้อมูลต้องมีความยาวไม่เกิน {0} ตัว"),
		minlength:jQuery.validator.format("ข้อมูลต้องไม่น้อยกว่า {0} ตัว"),
		rangelength:jQuery.validator.format("ข้อมูลต้องอยู่ในช่วง {0} ถึง {1}"),
		range:jQuery.validator.format("ข้อมูลต้องอยู่ในช่วง {0} ถึง {1}"),
		max:jQuery.validator.format("โปรดระบุค่าน้อยกว่าหรือเท่ากับ {0}"),
		min:jQuery.validator.format("โปรดระบุค่ามากกว่าหรือเท่ากับ {0}")
	});
	$('#email1').bind('paste',function(){return false;});
	$("#register").validate({
	  rules: {
		email:{
			remote: {
				url: site_url+"/users/check_email",
        		type: "post",
        		data: {
          			email:function(){ return $("#email").val();}
				}
			}
		},
		email1: {
		  equalTo: "#email"
		},
		password2: {
		  equalTo: "#password1"
		}
	  }
	});		   
});
</script>