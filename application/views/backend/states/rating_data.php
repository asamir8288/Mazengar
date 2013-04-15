<table>
    <thead>
        <tr>
            <th style="width: 150px;border-left: none;">Name</th>
            <th style="width: 80px;">Mobile</th>
            <th style="width: 150px;">Email</th>
            <th style="width: 150px;">Product Name</th>
            <th style="width: 100px;">Rank</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($rating_products as $rating_product) {
            $class = 'light';
            if($i % 2 == 0){
                $class = 'dark';
            }
            ?>
        <tr class="<?php echo $class;?>">
            <td style="border-left: none;"><?php echo $rating_product['MobileRegistrations']['name'];?></td>
            <td><?php echo $rating_product['MobileRegistrations']['phone'];?></td>
            <td><?php echo $rating_product['MobileRegistrations']['email'];?></td>
            <td><?php echo $rating_product['ShopProducts']['name'];?></td>
            <td><?php echo $rating_product['rating'] . '/5';?></td>
        </tr>
        <?php $i++;} ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" class="table-footer"></td>
        </tr>
    </tfoot>
</table>
