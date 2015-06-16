<header>
	<h1>ตั้งกระทู้ใหม่</h1><hr>
</header>
<article>
<form name="new_topic" id="new_topic" method="post" class="form-horizontal">
	<input type="hidden" name="group_url" value="<?php echo $this->uri->segment(3); ?>" />
	<fieldset>
        <div class="control-group">
            <label class="control-label">หมวดหมู่</label>
            <div class="controls"><?php echo selectbox($group,'group',$group_id->id); ?></div>
        </div>
        <div class="control-group">
        	<label class="control-label">หัวข้อ</label>
            <div class="controls"><input type="text" name="topic" id="topic" class="required span10" /></div>
        </div>
        <div class="control-group">
        	<label class="control-label">&nbsp;</label>
            <div class="controls">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a class="btn" onClick="doAddTags('<b>','</b>');">ตัวหนา</a>
                    <a class="btn" onClick="doAddTags('<i>','</i>');">ตัวเอียง</a>
                    <a class="btn" onClick="doAddTags('<u>','</u>');">ขีดเส้นใต้</a>
                </div>
                <div class="btn-group">
                    <a class="btn" onClick="doAddTags('&','lt;');">&lt;</a>
                    <a class="btn" onClick="doAddTags('&','gt;');">&gt;</a>
                </div>
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">สีตัวอีกษร&nbsp;&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li style="background-color:#FF0000;"><a href="javascript:doAddTags('<font color=\'#FF0000\'>','</font>');">#FF0000 Red</a></li>
                        <li style="background-color:#FF9900;"><a href="javascript:doAddTags('<font color=\'#FF9900\'>','</font>');">#FF9900 Orange</a></li>
                        <li style="background-color:#009933;"><a href="javascript:doAddTags('<font color=\'#009933\'>','</font>');">#009933 Green</a></li>
                        <li style="background-color:#0066CC;"><a href="javascript:doAddTags('<font color=\'#0066CC\'>','</font>');">#0066CC Blue</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <a class="btn" onClick="doImage();">แทรกรูปภาพ</a>
                    <a class="btn" onClick="doAddTags('<blockquote>','</blockquote>');">แท็กอ้างอิง</a>
                    <a class="btn" id="superbox" href="<?php echo site_url('forum/emo'); ?>" rel="superbox[iframe][700x500]">ไอคอนแสดงอารมณ์</a>
                </div>
            </div>
        </div>
        <div class="control-group">
        	<label class="control-label">ข้อความ</label>
            <div class="controls">
            <textarea name="detail" id="detail" class="required span10" rows="20"></textarea>
            <p class="help-block"><?php echo $this->config->item('tags_allow'); ?></p>
            </div>
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
            <button type="submit" class="btn btn-primary">ตั้งกระทู้</button>
            <button type="button" class="btn" onClick="location.href='<?php echo site_url('forum/'.$this->uri->segment(3)); ?>';">กลับ</button>
        </div>
	</fieldset>
</form>
</article>
<script>
$(function(){
	jQuery.extend(jQuery.validator.messages,{
		required:"กรุณากรอกข้อมูล",
		maxlength:jQuery.validator.format("ข้อมูลต้องมีความยาวไม่เกิน {0} ตัว"),
		minlength:jQuery.validator.format("ข้อมูลต้องไม่น้อยกว่า {0} ตัว")
	});
	$.superbox();
	textarea = document.getElementById('detail');
	$('#new_topic').validate();	
});
</script>