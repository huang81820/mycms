<?php if (!defined('THINK_PATH')) exit();?><tr>
<td><?php echo ($column_desc); ?></td>
<td><input readOnly <?php echo ($style); ?>  id="<?php echo ($id); ?>" type="text" name="<?php echo ($name); ?>" value="<?php echo date("Y-m-d",$value) ?>" onclick="WdatePicker()"  /></td>
<td style="color:<?php echo ($messageColor); ?>" ><?php echo ($column_help); ?><span style="color:red; display:none;"><?php echo ($column_error_message); ?></span></td>
</tr>