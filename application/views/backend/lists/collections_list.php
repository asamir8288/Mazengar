<option value="">Select</option>
<?php foreach ($collections as $collection) { ?>
    <option value="<?php echo $collection['id']; ?>"><?php echo $collection['name']; ?></option>
<?php } ?>

