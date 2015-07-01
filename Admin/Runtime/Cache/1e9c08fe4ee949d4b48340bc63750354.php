<?php if (!defined('THINK_PATH')) exit();?>
<textarea id="<?php echo ($id); ?>" type="text" name="<?php echo ($name); ?>" style="width:700px; height:300px"  ></textarea>

					
<script>new makeMUltiPicDialog("<?php echo ($id); ?>","<?php echo ($name); ?>","<?php echo ($uploadPicPath); ?>","3",{"dialogName":"产品背景图"})</script>