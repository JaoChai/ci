<div class="thumbnail">
	<?php echo image_asset('codeigniter_header.jpg',NULL,array('width'=>940,'height'=>300)); ?>
</div>
<header>
	<h2>ดาวน์โหลด CodeIgniter</h2>
    <p>คุณสามารถดูรายการอัพเดตได้ที่ <a href="http://codeigniter.in.th/user_guide/changelog.html" title="changelog">http://codeigniter.in.th/user_guide/changelog.html</a></p>
</header>
<hr>
<div class="row">
	<div class="span7">
<article>
	<p>
	<ul>
<?php 
foreach($q->result() as $key => $r){
	if($key == 0){
?>
		<li style="list-style:none;">
		<?php echo image_asset('dowload_arrow.png',NULL,array('width'=>48,'height'=>48,'style'=>'float:left;')); ?> 
        <a href="<?php echo site_url('downloads/version/'.$r->name); ?>"><big><?php echo $r->title; ?></big></a>
        <p>ปัจจุบันเวอร์ชั่นล่าสุดคือ <?php echo $r->title; ?></p>
        </li>
<?php }else{ ?>
		<li><a href="<?php echo site_url('downloads/version/'.$r->name); ?>"><?php echo $r->title; ?></a></li>
<?php }} ?>
	</ul>
    </p>
</article>
	</div>
    <div class="span5">
<script type="text/javascript"><!--
google_ad_client = "ca-pub-1245621023353458";
/* download */
google_ad_slot = "1711222954";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<script type="text/javascript"><!--
google_ad_client = "ca-pub-1245621023353458";
/* download media */
google_ad_slot = "5792023704";
google_ad_width = 336;
google_ad_height = 280;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
    </div>
</div>