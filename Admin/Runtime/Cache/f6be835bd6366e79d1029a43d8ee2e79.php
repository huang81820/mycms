<?php if (!defined('THINK_PATH')) exit();?>

<?php foreach($options as $val){ ?>
	<input class="<?php echo ($id); ?>" name="<?php echo ($name); ?>[]" type="checkbox" value="<?php echo ($val['value']); ?>"  />&nbsp;<?php echo ($val['desc']); ?>&nbsp;
<?php } ?>