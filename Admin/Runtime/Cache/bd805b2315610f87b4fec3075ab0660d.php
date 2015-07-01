<?php if (!defined('THINK_PATH')) exit(); if(is_array($pro_list)): foreach($pro_list as $key=>$vo): ?><li>
		<a href="<?php echo (CON_PATH); ?>/<?php echo ($vo[product_id]); ?>/cat_id/<?php echo ($vo[cat_id]); ?>">
			<img src='<?php echo ($vo["thumb"]); ?>' />
			<p class="pro_name"><?php echo ($vo["title"]); ?></p>
			<p class="pro_name2">规格：<?php echo ($vo["guige"]); ?></p>
		</a>
	</li><?php endforeach; endif; ?>