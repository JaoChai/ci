<header>
	<div class="row">
    	<div class="span12">
        <h3>กระทู้ตอบล่าสุด</h3><hr>
        <ul class="forum_list">
<?php
foreach($list->result() as $r){
?>
        	<li><a href="<?php echo site_url('forum/'.$r->url.'/'.$r->id) ;?>"><?php echo $r->topic; ?></a>
            <span class="pull-right">
            [ <a href="<?php echo site_url('profile/users/'.$r->user_id) ;?>"><?php echo $r->name; ?></a> ]
            [ <a href="<?php echo site_url('forum/'.$r->url) ;?>"><?php echo $r->title; ?></a> ]
            </span></li>
<?php } ?>
        </ul>
        <p>&nbsp;</p>
        </div>
    </div>
</header>
<article>
<?php
foreach($q->result() as $r){
?>
    <div class="row">
       <div class="span12 well group_list">
             <a href="<?php echo site_url('forum/'.$r->url); ?>">
             <h3><?php echo $r->title; ?></h3>
             <p><?php echo $r->detail; ?></p>
              </a>          
       </div>
    </div>
<?php } ?>
</article>