<?php if (!defined('THINK_PATH')) exit();?>


	<select style="width:176px; height:27px;" id="<?php echo ($id); ?>" name="<?php echo ($name); ?>">
			<option value="0">---请选择<?php echo ($column_desc); ?>---</option>
		<?php foreach($result as $val){ ?>
			<option value="<?php echo ($val[$attrs_arr['value_key']]); ?>"><?php echo ($val[$attrs_arr['value_desc']]); ?></option>
		<?php } ?>
	</select>