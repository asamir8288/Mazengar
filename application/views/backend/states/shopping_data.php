<table>
    <thead>
        <tr>
            <th style="width: 150px;border-left: none;">Name</th>
            <th style="width: 80px;">Mobile</th>
            <th style="width: 150px;">Email</th>
            <th style="width: 150px;">Product Name</th>
            <th style="width: 100px;">Date</th>
            <th style="width: 100px;">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($shopping_products as $shopping_product) {
            $class = 'light';
            if($i % 2 == 0){
                $class = 'dark';
            }
            ?>
        <tr class="<?php echo $class;?>">
            <td style="border-left: none;"><?php echo $shopping_product['MobileRegistrations']['name'];?></td>
            <td><?php echo $shopping_product['MobileRegistrations']['phone'];?></td>
            <td><?php echo $shopping_product['MobileRegistrations']['email'];?></td>
            <td><?php echo $shopping_product['ShopProducts']['name'];?></td>
            <td><?php echo $shopping_product['created_at'];?></td>
            <td>
                <?php if($shopping_product['delivered'] == 0) {?>
                <a href="<?php echo site_url('shop/deliver_order/' . $shopping_product['id']);?>" class="done-btn"></a>
                <a href="<?php echo site_url('shop/cancel_order/' . $shopping_product['id']);?>" class="cancel-btn"></a>
                <?php }else if($shopping_product['delivered'] == 1){
                    echo '<span style="color: #13ce00;">Done</span>';
                }else{
                    echo '<span style="color: #c00000;">Cancelled</span>';
                }?>
            </td>
        </tr>
        <?php $i++;} ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" class="table-footer"></td>
        </tr>
    </tfoot>
</table>
<div class="pagination">
    <?php echo $pagination;?>
</div>

