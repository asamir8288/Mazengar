<style type="text/css">
    .shopcategory{
        margin-bottom: 20px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){                
        if($('.product_id').val() != ''){            
            $.get(site_url() + 'product/get_menu_subs/' + $('.product_id').val(), function(data){
                if(data.length > 3){
                    $('.menu_subs').append(data);
                    $('.shopcategory').attr('name', 'sub_id');
                }else{
                    $('.shopcat').hide();
                }            
            });
        }else{            
            $('.shopcategory').attr('name', 'sub_id_unuse');
            $('.shopcategory').last().attr('name', 'sub_id');
        }
        
       
        $('.shopcategory').live("change",function(){            
            $($(this)).nextAll().remove();
            $.get(site_url() + 'product/get_menu_subs/' + $(this).val(), function(data){
                if(data){
                    $('.menu_subs').append(data);
                    $('.shopcategory').attr('name', 'sub_id_unuse');                    
                }                
                $('.shopcategory').last().attr('name', 'sub_id');
            });            
        });
    });
</script>

<?php echo form_open_multipart($submit_url, 'id="form-to-validate"'); ?>
<div id="inner-page-content">

    <div class="left-container">    
        <div id="submit-area">

        </div>


        <?php
        $menu_top_level = $menuTopLevel;
        if (isset($product_menu) && count($product_menu) == 1) {
            $menu_top_level = $product_menu[0]['id'];
        } else if (isset($product_menu)) {
            $menu_top_level = '';
        }
        ?>        
        <input type="hidden" name="product_id" class="product_id" value="<?php echo $menu_top_level; ?>" />

        <div class="field-group shopcat">
            <label class="form-label-short">Category</label>
            <div class="select-options-wrapper menu_subs">
                <?php
                if (isset($product_menu) && count($product_menu)) {
                    for ($i = 0; $i < count($product_menu) - 1; $i++) {
                        echo product_menu($product_menu[$i]['id'], $data['sub_id']);
                    }
                }
                ?>
            </div>
        </div>

        <div class="field-group" style="margin-top: 0px;">
            <label class="form-label-short">Product Name</label>
            <input type="text" name="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>">
        </div>  

        <div class="field-group">
            <label class="form-label-short">Product Price</label>
            <input type="text" name="price" value="<?php echo isset($data['price']) ? $data['price'] : ''; ?>">
        </div>				

        <div class="field-group">
            <label class="form-label-short">Currency</label>
            <div class="select-options-wrapper">
                <select name="currency_id" class="custom-select" required="required">
                    <option value="" selected="">Select</option>
                    <?php
                    foreach ($currencies as $curreny) {
                        if (isset($data['currency_id']) && $curreny['id'] == $data['currency_id']) {
                            ?>
                            <option selected="selected" value="<?php echo $curreny['id']; ?>"><?php echo $curreny['name']; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $curreny['id']; ?>"><?php echo $curreny['name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="field-group">
            <label class="form-label-short">Filter</label>
            <div class="select-options-wrapper">
                <select name="category_filter_id" class="custom-select" required="required">
                    <option value="" selected="">Select</option>
                    <?php
                    foreach ($filters as $filter) {
                        if (isset($data['category_filter_id']) && $filter['id'] == $data['category_filter_id']) {
                            ?>
                            <option selected="selected" value="<?php echo $filter['id']; ?>"><?php echo $filter['name']; ?></option>
                        <?php } else { ?>
                            <option value="<?php echo $filter['id']; ?>"><?php echo $filter['name']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="field-group">
            <label class="form-label-short">Discount</label>
            <input type="text" name="discount" value="<?php echo isset($data['discount']) ? $data['discount'] : ''; ?>" pattern="[0-9]{1,}" required="required" title="Must be 3 or more characters">
        </div>

        <div class="field-group">
            <label class="form-label-short">Product Description</label>
            <textarea name="description" required="required" ><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea>
        </div>

        <div class="field-group">
            <?php
            $checked = '';
            $chbox_value = 'no';
            if (isset($data['availability']) && $data['availability']) {
                $checked = ' custom-checkbox-checked';
                $chbox_value = 'yes';
            }
            ?>
            <div class="custom-checkbox<?php echo $checked; ?>" style="margin-left:177px"></div>            
            <label class="form-label-checkbox"  style="margin-left:14px">Availability</label>
            <input type="hidden" name="availability" class="hidden-availability" value="<?php echo $chbox_value; ?>" />
        </div>
    </div>

    <div class="right-container">
        <input type="hidden" name="main_img" class="main_img" value="<?php echo isset($data['main_img']) ? $data['main_img'] : '' ?>" />
        <img class="product-image" src="<?php echo static_url(); ?><?php echo isset($data['main_img']) && $data['main_img'] != '' ? 'uploads/' . $data['main_img'] : 'layout/images/offer-default-image.jpg' ?>" />
        <a class="upload-product-image-anchor" id="offer-img" href="#">Upload Product Cover Image</a>

    </div>

    <div class="dotted-serpartor"></div>

    <div class="left-container-add-product">

        <div id="myModal" class="reveal-modal">
            <h1 style="font-size: 14px;margin-bottom: 9px;font-weight: bold;">Choose Image to Upload:</h1>
            <div class="modal-innercontent">

            </div>
            <a class="close-reveal-modal">&#215;</a>
        </div>


        <?php
        if (isset($data) && count($data['ShopProductComponents'])) {
            echo "<ul class=\"draggable-list\">";
            foreach ($data['ShopProductComponents'] as $media) {
                switch ($media['type']) {
                    case 'text':
                        ?>
                        <li class="drag-list-item">
                            <div class="product-item-wrapper">				
                                <textarea class="products-textarea" name="text-order[<?php echo $media['product_order']; ?>]" ><?php echo $media['item']; ?></textarea>
                                <ul class="product-item-action-list">				
                                    <li class="product-item-icon add-product-caption-icon"><a>Add Caption</a></li>                                
                                    <li class="product-item-icon delete-product-icon"><a >Delete</a></li>
                                    <li title="Drag Me" class="product-item-icon move-product-icon"><a>Move</a></li>
                                </ul>
                                <div class="caption-area-wrapper"><input type="text" name="text_caption[]" placeholder="<?php echo $media['caption']; ?>" maxlength="70" style="display: inline-block;"></div>
                                
                            </div>
                        </li>

                        <?php
                        break;
                    case 'image':
                        ?>
                        <li class="drag-list-item">
                            <div class="product-item-wrapper">	
                                <div class="products-image-upload" style="">
                                    <div class="uploaded-img-wrapper">
                                        <input type="hidden" value="<?php echo $media['item']; ?>" name="img-order[<?php echo $media['product_order']; ?>]">
                                        <img src="<?php echo static_url(); ?>uploads/<?php echo $media['item']; ?>">
                                    </div>
                                </div>
                                <ul class="product-item-action-list">				
                                    <li class="product-item-icon add-product-caption-icon"><a>Add Caption</a></li>					
                                    <li class="product-item-icon delete-product-icon"><a>Delete</a></li>     
                                    <li title="Drag Me" class="product-item-icon move-product-icon"><a>Move</a></li>								
                                </ul>
                                <div class="caption-area-wrapper"><input type="text" name="image_caption[]" placeholder="<?php echo $media['caption']; ?>" maxlength="70" style="display: inline-block;"></div>

                            </div>                     
                        </li>						
                        <?php
                        break;
                    case 'vedio':
                        ?>
                        <li class="drag-list-item">
                            <div class="product-item-wrapper">				
                                <div class="products-video-upload" style="">
                                    <a class="large-btn-products gray-bg-products  upload-video-btn" style="display: none;">YOUTUBE LINK</a>
                                    <input type="hidden" name="video-order[<?php echo $media['product_order']; ?>]" value="<?php echo $media['item']; ?>">
                                    <object class="youtube-video-frame" width="470" height="345">
                                        <param name="movie" value="<?php echo $media['item']; ?>">
                                        <param name="allowFullScreen" value="true">
                                        <param name="allowscriptaccess" value="always">
                                        <embed src="<?php echo $media['item']; ?>" type="application/x-shockwave-flash" width="470" height="345" allowscriptaccess="always" allowfullscreen="true">
                                    </object>
                                </div>
                                <ul class="product-item-action-list">				
                                    <li class="product-item-icon add-product-caption-icon"><a >Add Caption</a></li>
                                    <li class="product-item-icon delete-product-icon"><a>Delete</a></li>	
                                    <li title="Drag Me" class="product-item-icon move-product-icon"><a>Move</a></li>								                                
                                </ul>
                                <div class="caption-area-wrapper"><input type="text" name="video_caption[]" placeholder="<?php echo $media['caption']; ?>" maxlength="70" style="display: inline-block;"></div>

                            </div>
                        </li>
                        <?php
                        break;
                }
            }
            echo "</ul>";
        } else {
            ?>

            <img src="<?php echo static_url(); ?>layout/images/no-items-yet.png" class="no-items-yet"/>						
            <ul class="draggable-list">			
            </ul>

        <?php } ?>
    </div>

    <div class="right-container-add-product">

        <div class="add-items-menu-wrapper">			
            <ul class="product-icons-list">									
                <li class="productmenu-icon add-text-icon" title="Add Text"></li>									
                <li class="productmenu-icon add-image-icon" title="Add Image"></li>									
                <li class="productmenu-icon add-video-icon" title="Add Video"></li>

            </ul>
        </div>

        <div class="save-product-wrapper">
            <?php echo form_submit('submit', ' ', 'class="save-button-round submit-btn"'); ?>
        </div>

    </div>

    <div class="save-products-button-wrapper">
        <input type="submit" class="cancel-text-btn" value="Cancel" />
        <?php echo form_submit('submit', 'SAVE', 'class="large-btn gray-bg-products submit-btn"'); ?>
    </div>
</div>
<?php echo form_close(); ?>