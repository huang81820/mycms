<?php if (!defined('THINK_PATH')) exit();?>
	<?php foreach($options as $key=>$val){ $check=''; if($key==0){ $check=' checked="true"'; } ?>
		<?php echo ($val['desc']); ?>:&nbsp;&nbsp;<input <?php echo ($check); ?> id="<?php echo ($id); ?>" name="<?php echo ($name); ?>" type="radio" value="<?php echo ($val['value']); ?>" />&nbsp;&nbsp;&nbsp;&nbsp;
	<?php } ?>