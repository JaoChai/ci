	<ul class="breadcrumb">
      <li>
        <a href="<?php echo site_url('forum'); ?>">เว็บบอร์ด</a> <span class="divider">/</span>
      </li>
      <?php if(isset($url1)){ ?>
      <li<?php echo (isset($url2)?'':' class="active"'); ?>>
        <a href="<?php echo site_url('forum/'.$url1); ?>"><?php echo $title1; ?></a> <?php echo (isset($url2)?'<span class="divider">/</span>':''); ?>
      </li>
      <?php } ?>
      <?php if(isset($url2)){ ?>
      <li class="active">
        <a href="<?php echo site_url('forum/'.$url1.'/'.$url2); ?>"><?php echo $title2; ?></a>
      </li>
      <?php } if($goto == 2){ ?>
      <li class="pull-right">
        <a href="#top"><b class="icon-arrow-up"></b> ขึ้นบน</a><a name="down"></a>
      </li>
	  <?php }else{ ?>
	  <li class="pull-right">
        <a href="#down"><b class="icon-arrow-down"></b> ลงล่าง</a>
      </li>
	  <?php } if(!isset($url2)){ ?>
      <li class="pull-right">
        <a href="<?php echo site_url('forum/topic/'.$url1); ?>"><b class="icon-plus"></b> ตั้งกระทู้ใหม่</a>
        <span class="divider">|</span>
      </li>
      <?php } ?>
    </ul>