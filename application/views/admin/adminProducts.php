<div style="margin-top: 50px;">


    <form action="<?= base_url('addProduct') ?>" method="get" >
        <button >Add product</button>
    </form>
    <br>
    <div class="product-list">
        <table border="1">
            <thead>
    			<th>ID</th>
    			<th>Name</th>
    			<th>Description</th>
    			<th>Price</th>
    			<th></th>
    		</thead>
            <tbody>

                <?php
            	foreach($products as $product){
            	?>
            		<tr>
                        <td><?= $product['id_product'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['desc'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td>
                            <form action="<?= base_url('viewProduct') ?>" method="get" style="display:inline;">
                                <button name="id_product" value="<?= $product['id_product'] ?>">View</button>
                            </form>

                            <form action="<?= base_url('editProduct') ?>" method="get" style="display:inline;">
                                <button name="id_product" value="<?= $product['id_product'] ?>">Edit</button>
                            </form>
                            <form action="<?= base_url('deleteProduct') ?>" method="get" style="display:inline;">
                                <button name="id_product" value="<?= $product['id_product'] ?>_adminProducts">Delete</button>
                            </form>
                        </td>
                    </tr>
            	<?php
            	}
            	?>

            </tbody>
        </table>

    </div>

</div>
