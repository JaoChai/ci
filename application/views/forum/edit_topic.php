<header>
	<h1>แก้ไขกระทู้</h1><hr>
</header>
<article>
<form name="edit_topic" id="edit_topic" method="post" class="form-horizontal">
	<input type="hidden" name="id" value="<?php echo $r->id; ?>" />
	<fieldset>
        <div class="control-group">
            <label class="control-label">หมวดหมู่</label>
            <div class="controls"><?php echo selectbox($group,'group',$r->group_id); ?></div>
        </div>
        <div class="control-group">
        	<label class="control-label">หัวข้อ</label>
            <div class="controls"><input type="text" name="topic" id="topic" class="required span10" value="<?php echo $r->title; ?>" /></div>
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
            <textarea name="detail" id="detail" class="required span10" rows="20"><?php echo $r->detail; ?></textarea>
            <p class="help-block"><?php echo $this->config->item('tags_allow'); ?></p>
            </div>
        </div>
                  
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">แก้ไขกระทู้</button>
            <button type="button" class="btn" onClick="location.href='<?php echo site_url('forum/back/'.$r->id); ?>';">กลับ</button>
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
	$('#edit_topic').validate();	
});
</script>