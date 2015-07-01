<?php 
unset($_SESSION);
	define('APP_NAME','Admin');
	
	define('APP_PATH','./Admin/');
	
	
	//JS目录
	define('SCRIPT_PATH','./Public/scripts');
	
	//公共图片目录
	define('IMAGES_PATH','./Public/images');
	
	//上传目录
	define('UPLOAD_PATH','./Public/uploads');
	
	//Form类图片上传目录
	define('FORM_PIC_UPLOAD_PATH','Mythink/EDITOR_UPLOAD');
	//Form类文件上传目录
	define('FORM_FILE_UPLOAD_PATH','Mythink/EDITOR_FILE_UPLOAD');
	
	//全局表的的表名称
	define('CM_TABLE','cm_table');
	//全局表的字段表名称
	define('CM_TABLE_COLUMN','cm_table_column');
	//全局菜单表名称
	define('CM_LIST','cm_list');
	//全局菜单细节表名称
	define('CM_LIST_ITEM','cm_list_item');
	
	//全局分页尺寸
	define('PAGE_SIZE','12');
	
	define('DATA_BASE','12');
	//全局上传大小控制 3M
	define('UPLOAD_SIZE',3145728);
	
	define('APP_DEBUG','true');
	

	//CMS部分常量
	define('TPL_IMG','./Public/images/myimg/');
	
	define('TPL_JS','./Public/scripts/tpl_js/');
	
	//默认内容模块 和方法
	define('CON_PATH','__APP__/Content/show/id');
	//默认分类模块 和方法
	define('CAT_PATH','__APP__/Content/lists/cat_id');
	
	
	
	
	//内容模块名称
	define('CON_MOD_NAME','Content');
	
	require('./ThinkPHP/ThinkPHP.php');



?>

