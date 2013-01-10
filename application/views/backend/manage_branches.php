<a href="<?php echo site_url('product');?>" class="create_product_btn"></a>

<style>
	.draggable-list { width: 865px; list-style-type:none; margin:0px; }
	.draggable-list li.drag-list-item { float: left;width: 208px;min-height: 189px; }
	.draggable-list .box{width: 208px;min-height: 189px; cursor: move !important; }	
	.placeHolder .box{  border:dashed 1px gray !important; }		
</style>

<?php echo form_open();?>
<ul class="draggable-list">

<?php foreach ($branches as $branch) { ?>
<li class="drag-list-item">
    <div class="box">
        <input type="hidden" name="rank[]" value="<?php echo $branch['id'];?>" />
        <div class="title"><?php echo $branch['name']; ?></div>
        <div class="frame">
            <img src="<?php echo static_url(); ?>layout/images/img-sample.png" />
        </div>
        <div class="actions">
            <?php
                $status = '';
                if($branch['is_active']){
                    $status = 'active_publish-icon';
                }
            ?>
            <a href="<?php echo site_url('branch/edit/' . $branch['id']); ?>" class="edit-icon"></a><span class="separator">|</span><a id="<?php echo $branch['id']; ?>" class="publish-icon <?php echo $status;?>"></a><span class="separator">|</span><a id="<?php echo $branch['id']; ?>" class="delete-icon"></a>
        </div>
    </div>
    </li>
<?php } ?>

 </ul>

<div style="clear: both;height: 10px;"></div>
    <?php echo form_submit('submit', 'Re-Arrange Albums', 'class="large-btn gray-bg" style="margin-left: 0px;"');?>
<?php echo form_close();?>