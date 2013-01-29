<style type="text/css">
    .shopcategory{
        margin-bottom: 20px;
    }
</style>

<script type="text/javascript">
    $(document).ready(function(){
        if($('.shop_id').val() != ''){
            $.get(site_url() + 'product/get_menu_subs/' + $('.shop_id').val(), function(data){
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
            $($(this)).nextAll().remove()
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
        if (isset($offer_menu) && count($offer_menu) == 1) {
            $menu_top_level = $offer_menu[0]['id'];
        } else if (isset($offer_menu)) {
            $menu_top_level = '';
        }
        ?>  
        <input type="hidden" name="shop_id" class="shop_id" value="<?php echo $menu_top_level; ?>" />
        <div class="field-group shopcat">
            <label class="form-label-short">Category</label>
            <div class="select-options-wrapper menu_subs">
                <?php
                if (isset($offer_menu) && count($offer_menu)) {
                    for ($i = 0; $i < count($offer_menu) - 1; $i++) {
                        echo product_menu($offer_menu[$i]['id'], $data['sub_id']);
                    }
                }
                ?>
            </div>
        </div>        

        <div class="field-group" style="margin-top: 0px;">
            <label class="form-label-short">Offer Name</label>
            <input type="text" name="name" value="<?php echo isset($data['name']) ? $data['name'] : ''; ?>" />
        </div>        

        <div class="field-group">
            <label class="form-label-short">Before Discount</label>
            <input type="text" value="<?php echo isset($data['price_before_discount']) ? $data['price_before_discount'] : ''; ?>" name="price_before_discount" style="width:80px;" />
        </div>				

        <div class="field-group">
            <label class="form-label-short">After Discount</label>
            <input type="text" name="price_after_discount" value="<?php echo isset($data['price_after_discount']) ? $data['price_after_discount'] : ''; ?>" style="width:80px;" />
        </div>				       

        <div class="field-group">
            <label class="form-label-short">Start Date</label>
            <input type="text" name="start_date" value="<?php echo isset($data['start_date']) ? substr($data['start_date'], 0, 10) : ''; ?>" required="required" id="startdate" title="Must be 3 or more characters" />
        </div>
        <div class="field-group">
            <label class="form-label-short">End Date</label>
            <input type="text" name="end_date" value="<?php echo isset($data['end_date']) ? substr($data['end_date'], 0, 10) : ''; ?>" required="required" id="enddate" title="Must be 3 or more characters" />
        </div>

        <div class="field-group">
            <label class="form-label-short">Offer Description</label>
            <textarea name="description" required="required"><?php echo isset($data['description']) ? $data['description'] : ''; ?></textarea>
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
        <input type="hidden" name="main_pic" class="main_img" value="" />
        <img class="product-image" src="<?php echo static_url(); ?><?php echo isset($data['main_pic']) && $data['main_pic'] != '' ? 'uploads/' . $data['main_pic'] : 'layout/images/offer-image.jpg' ?>" />
        <a class="upload-product-image-anchor" id="offer-img" href="#">Upload Offer Cover Image</a>

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
        if (isset($data) && count($data['ShopOfferComponents'])) {
            echo "<ul class=\"draggable-list\">";
            foreach ($data['ShopOfferComponents'] as $media) {
                switch ($media['type']) {
                    case 'text':
                        ?>
                        <li class="drag-list-item">
                            <div class="product-item-wrapper">				
                                <textarea class="products-textarea" name="addional_desc[]" ><?php echo $media['item']; ?></textarea>
                                <ul class="product-item-action-list">				
                                    <li class="product-item-icon add-product-caption-icon"><a>Add Caption</a></li>                               
                                    <li class="product-item-icon delete-product-icon"><a >Delete</a></li>
                                    <li title="Drag Me" class="product-item-icon move-product-icon"><a>Move</a></li>
                                </ul>
                                <div class="caption-area-wrapper">
                                    <input type="text" placeholder="Caption" maxlength="70"/>
                                </div>

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
                                        <input type="hidden" value="<?php echo $media['item']; ?>" name="additional_imgs[]">
                                        <img src="<?php echo static_url(); ?>uploads/<?php echo $media['item']; ?>">
                                    </div>
                                </div>
                                <ul class="product-item-action-list">				
                                    <li class="product-item-icon add-product-caption-icon"><a>Add Caption</a></li>					
                                    <li class="product-item-icon delete-product-icon"><a>Delete</a></li>         
                                    <li title="Drag Me" class="product-item-icon move-product-icon"><a>Move</a></li>								
                                </ul>
                                <div class="caption-area-wrapper">
                                    <input type="text" placeholder="Caption" maxlength="70"/>
                                </div>

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
                                    <input type="hidden" name="additional_vedio[]" value="<?php echo $media['item']; ?>">
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
                                <div class="caption-area-wrapper">
                                    <input type="text" placeholder="Caption" maxlength="70"/>
                                </div>

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