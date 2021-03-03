<div style="margin-top: 50px;">



    <?php
    if( isset($viewMode) && $viewMode == 1) {
    ?>

        <b>Name: </b>
        <br>
        <?php echo ( isset($product->name) ) ? $product->name : '' ?>

        <br>
        <br>
        <b>Description: </b>
        <br>
        <?php echo ( isset($product->desc) ) ? $product->desc : '' ?>

        <br>
        <br>
        <b>Price: </b>
        <br>
        <?php echo ( isset($product->price) ) ? $product->price : '' ?>

    <?php
    } else {
    ?>

    <form action="<?= base_url('saveProduct') ?>" method="post" >

        <b>Name: </b>
        <br>
        <input type="text" name="name" value="<?php echo ( isset($product->name) ) ? $product->name : '' ?>">

        <br>
        <b>Description: </b>
        <br>
        <input type="text" name="desc" value="<?php echo ( isset($product->desc) ) ? $product->desc : '' ?>">

        <br>
        <b>Price: </b>
        <br>
        <input type="number" name="price" value="<?php echo ( isset($product->price) ) ? $product->price : '' ?>">

        <br>
        <br>
        <button type="submit" name="saveProduct">Save</button>

        <input type="hidden" name="id_product" value="<?= $idProduct ?>">
    </form>

    <?php
    }
    ?>
</div>
