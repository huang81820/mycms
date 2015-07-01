<?php if (!defined('THINK_PATH')) exit();?>
<style>
.CHECKED_BOX{ width:600px;;}
.CHECKED_BOX li{ width:200px; height:26px;  float:left}
</style>

<ul class="CHECKED_BOX">
<?php foreach($result as $key=>$val){ $check=in_array($val[$attrs_arr['value_key']],$valueArr)?'	checked':''; ?>
	<li>
		<input <?php echo ($check); ?> name="<?php echo ($name); ?>[]" class="<?php echo ($id); ?>" type="checkbox" value="<?php echo ($val[$attrs_arr['value_key']]); ?>"><?php echo ($val[$attrs_arr['value_desc']]); ?>&nbsp;
	</li>
	
	
	<?php } ?>
</ul>