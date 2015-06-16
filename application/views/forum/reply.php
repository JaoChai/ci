<a name="reply"></a>
<div class="row">
	<div class="span2 well">ตอบกระทู้</div>
    <div class="span9 well">
    <form method="post" action="<?php echo site_url('forum/reply'); ?>">
    <input type="hidden" name="topic_id" value="<?php echo $this->uri->segment(3); ?>" /><input type="hidden" name="url" value="<?php echo $this->uri->segment(2); ?>" />
    <script>$(function(){$.superbox();textarea = document.getElementById('reply_detail');});</script>
    <p><div class="btn-toolbar">
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
    </div></p>
    <textarea name="reply_detail" id="reply_detail" style="width:99%;height:200px;"></textarea>
    <?php echo $this->config->item('tags_allow'); ?>
    <div class="form-actions"> 
    <center><button type="submit" class="btn">ตอบกระทู้</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" onclick="reply_review();" class="btn">แสดงตัวอย่าง</button></center>
    </div>
    </form>
    </div>
</div>   
<div id="row_reply_review" class="row hide">
	<div class="span2 well">ตัวอย่าง</div><div id="reply_review" class="span9 well"></div>
</div>