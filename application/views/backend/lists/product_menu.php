<?php if (count($subMenuItems)) { ?>
    <select class="custom-select shopcategory" required="required" name="shopcategory">
        <option value="" selected="">Select</option>
        <?php foreach ($subMenuItems as $subMenuItem) { ?>
            <option value="<?php echo $subMenuItem['id']; ?>"><?php echo $subMenuItem['name']; ?></option>
        <?php } ?>
    </select>
<?php } ?>