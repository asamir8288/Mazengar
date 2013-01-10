<style type="text/css">
    .gallery-image{
        margin-top:11px;
        margin-left: 25px;
        width: 222px;
        max-height: 230px;
        border: 1px solid #E9E9E9;
        -webkit-box-shadow: 0 0 3px 1px rgba(0, 0, 0, 0.05),0 1px 3px rgba(0, 0, 0, 0.11);
        -moz-box-shadow: 0 0 3px 1px rgba(0,0,0,0.05),0 1px 3px rgba(0,0,0,0.11);
        box-shadow: 0 0 3px 1px rgba(0, 0, 0, 0.05),0 1px 3px rgba(0, 0, 0, 0.11);
        border: 1px solid #EBEBEB;
        border: 3px solid rgba(255, 255, 255, 0.99);
    }

    .upload-gallery-image-anchor{        
        font-size: 13px;
        font-family: calibri,Arial, sans-serif;
        cursor: pointer;
        color: #007AFF;
        clear: both;
        position: relative;
        top: -84px;
        left: 6px;
    }
    .box .actions {
        right: 6px;
        position: relative;
        float: right;
        text-align: center;
        margin-top: 10px;
        top: -150px;
    }
</style>

<?php echo form_open($submit_url); ?>
<div>
    <input type="hidden" name="main_img" class="main_img" value="<?php echo isset($data['img']) ? $data['img'] : '' ?>" />
    <label class="form-label">Album Image: </label>
    <img class="gallery-image" src="<?php echo static_url() . 'layout/images/offer-image.jpg' ?>" />
    <a class="upload-gallery-image-anchor" id="gallery-img" href="#">Upload Album Image</a>
</div>
<div id="myModal" class="reveal-modal">
    <h1 style="font-size: 14px;margin-bottom: 9px;font-weight: bold;">Choose Image to Upload:</h1>
    <div class="modal-innercontent">

    </div>
    <a class="close-reveal-modal">&#215;</a>
</div>


<div class="field-group">
    <label class="form-label">Image Title: </label>
    <input type="text" name="title" value="">
</div>

<div class="action-buttons-wrapper">
    <?php echo form_submit('submit', 'Done', 'class="large-btn red-bg"'); ?>
</div>
<?php echo form_close(); ?>

<div style="clear: both;height: 50px;"></div>

<style>

    .draggable-list { width: 865px; list-style-type:none; margin:0px; }
    .draggable-list li.drag-list-item { float: left;width: 208px;min-height: 189px; }
    .draggable-list .box{width: 208px;min-height: 189px; cursor: move !important; }	
    .placeHolder .box{  border:dashed 1px gray !important; }


</style>

<?php echo form_open(site_url('gallery/arrange_images/' . $this->uri->segment(3))); ?>
<div>
    <?php
    if (count($albumImages)) {

        echo "<ul class=\"draggable-list\">";
        foreach ($albumImages as $img) {
            ?>
            <li class="drag-list-item">
                <div class="box">
                    <input type="hidden" name="rank[]" value="<?php echo $img['id']; ?>" />
                    <div class="title"><?php echo $img['title']; ?></div>
                    <div class="frame">
                        <?php if ($img['image'] != '') { ?>
                            <img src="<?php echo static_url(); ?>uploads/<?php echo $img['image']; ?>" />
                        <?php } else { ?>
                            <img src="<?php echo static_url(); ?>layout/images/img-sample.png" />
                        <?php } ?>
                        <div class="actions">
                            <a href="<?php echo site_url('gallery/delete_album_image/' . $img['id'] . '/' . $img['album_id']); ?>" class="delete-icon"></a>
                        </div>
                    </div>        
                </div>
            </li>
            <?php
        }
        echo "</ul>";
    }
    ?>
</div>
<div style="clear: both;"></div>
<?php
if (count($albumImages) > 1)
    echo form_submit('submit', 'Re-Arrange Album Images', 'class="large-btn gray-bg" style="margin-left: 0px;"');
?>
<?php echo form_close(); ?>