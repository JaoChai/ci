<header>
	<h1><?php echo $r->title; ?></h1><hr>
    <p><?php echo $r->detail; ?></p>
</header>
<article>
<div class="row">
	<div class="span12">
    
    <?php $page['url1']=$r->url; $page['title1']=$r->title; $page['goto'] = 1; $this->load->view('tpl/breadcrumb',$page); ?>
    
    	<table class="table table-striped table-bordered table-condensed table-borad-list">
        <thead>
        	<tr>
            	<td width="15">&nbsp;</td>
            	<td>หัวข้อ</td>
                <td>ตอบ</td>
                <td>อ่าน</td>
                <td width="150">เวลาโพส</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach($list->result() as $r){ ?>
        	<tr>
            	<td><b class="icon-list-alt"></b></td>
            	<td><a href="<?php echo site_url('forum/'.$r->url.'/'.$r->id) ;?>"><?php echo $r->topic; ?></a></td>
                <td><?php echo $r->reply ; ?></td>
                <td><?php echo $r->counter ; ?></td>
                <td class="table_small"><?php echo $r->post_date ; ?><br />โดย <a href="<?php echo site_url('profile/users/'.$r->user_id) ;?>"><?php echo $r->name; ?></a></td>
            </tr>
        <?php } ?>
        </tbody>
        </table>
        
    <?php $page['goto'] = 2; $this->load->view('tpl/breadcrumb',$page); echo $pagination; ?>
    
    </div>
</div>
</article>