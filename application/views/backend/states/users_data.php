<table>
    <thead>
        <tr>
            <th style="width: 150px;border-left: none;">Name</th>
            <th style="width: 80px;">Mobile</th>
            <th style="width: 150px;">Email</th>
            <th style="width: 150px;">Registration Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        foreach($registrations as $user) {
            $class = 'light';
            if($i % 2 == 0){
                $class = 'dark';
            }
            ?>
        <tr class="<?php echo $class;?>">
            <td style="border-left: none;"><?php echo $user['name'];?></td>
            <td><?php echo $user['phone'];?></td>
            <td><?php echo $user['email'];?></td>
            <td><?php echo $user['created_at'];?></td>
        </tr>
        <?php $i++;} ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="table-footer"></td>
        </tr>
    </tfoot>
</table>

<div class="pagination">
    <?php echo $pagination;?>
</div>
