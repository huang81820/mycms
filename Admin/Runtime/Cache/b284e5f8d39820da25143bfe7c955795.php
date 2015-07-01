<?php if (!defined('THINK_PATH')) exit();?>


<?php
 $str=''; $str.='<input class="button2" id="'.$id.'" type="button" name="'.$name.'" value="上传图片" />'; $namePrefix=$name; $attrsDiv=''; $attrsJs=''; $attrsDiv.='<div style="display:none;" class="DD_picsAtttr" >'; $attrsDiv.='<div class="DD_picsAtttr_top" ><p class="DD_picTit" style="padding:0">图片属性</p><a class="DD_picAttrClose"></a></div>'; $attrsDiv.='<div style="width:100%; "></div>'; $attrsDiv.='<div style="width:100%;padding:6px;  margin:5px; ">'; foreach($picAttrs as $key=>$val){ $AttrName=$namePrefix.'_'.$val['key'].'[]'; if($val['attr_type']==1){ if(($key+1)%2==0){ $attrsDiv.='&nbsp;&nbsp;&nbsp;&nbsp;'; } $attrsDiv.=$val['desc'].': <input type="text" name="'.$AttrName.'" />'; if(($key+1)%2==0){ $attrsDiv.='<br>'; } } if($val['attr_type']==3){ $attrsDiv.=$val['desc'].':<br> <textarea style="width:700px; height:250px;" name="'.$AttrName.'" ></textarea><br>'; $attrsJs.='new makeMUltiPicDialog("'.$name.'","'.$AttrName.'","'.$uploadPicPath.'",3,{"dialogName":"子属性"});'; } } $attrsDiv.='</div></div>'; ?>
<?php echo ($str); ?>
<script>
new makeMUltiPicDialog("<?php echo ($id); ?>","<?php echo ($name); ?>[]","<?php echo ($uploadPicPath); ?>",1,{"dialogName":"图片管理","attrsDiv":'<?php echo $attrsDiv; ?>','attrJs':'<?php echo $attrsJs; ?>'});
</script>