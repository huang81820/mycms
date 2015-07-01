<?php if (!defined('THINK_PATH')) exit();?><input <?php echo ($style); ?> type="hidden" name="<?php echo ($name); ?>" value="<?php echo ($value); ?>" /><input class="button2" style="height:26px;" id="cm_<?php echo ($id); ?>" type="button"  value="图片上传" />&nbsp;&nbsp;
<input style="height:26px;" id="<?php echo ($name); ?>_toBig" class="toBig button3" type="button" value="点击查看图片" src="<?php echo ($value); ?>" />

<script>new makeMUltiPicDialog("<?php echo ($id); ?>","<?php echo ($name); ?>","<?php echo ($uploadPicPath); ?>","2",{"dialogName":"产品背景图"})</script>