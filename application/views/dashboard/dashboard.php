<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">

<br>
<div class="product-list">
	<?php
	foreach($allProducts as $product){
	?>
		<article>
			Product Name: <?php echo $product['name']; ?>
			<br>
			Product Price: <?php echo $product['price']; ?>
			<br>
			<form action="<?= base_url('addProductToCart') ?>" method="get">
				<button name="id_product" value="<?= $product['id_product'] ?>_dashboard">Add to Cart</button>
			</form>
		</article>
		<br/>
	<?php
	}
	?>
</div>

<br/>

<div class="product-list">
	<h3>Cart</h3>
	<table class="" border="1">
		<thead>
			<th>Product</th>
			<th>Qty</th>
			<th>Price</th>
			<th>Total Price</th>
			<th></th>
		</thead>
		<tbody>
			<?php
			foreach($cartProducts as $cartProduct)
			{
			?>
				<tr>
					<td><?= $cartProduct['name'] ?></td>
					<td><?= $cartProduct['quantity'] ?></td>
					<td><?= $cartProduct['price'] ?></td>
					<td><?= $cartProduct['product_total'] ?></td>
					<td>

						<form action="<?= base_url('addProductToCart') ?>" method="get" style="display:inline;">
							<button name="id_product" value="<?= $cartProduct['id_product'] ?>_dashboard">+</button>
						</form>

						<form action="<?= base_url('minusProductToCart') ?>" method="get" style="display:inline;">
							<button name="id_product" value="<?= $cartProduct['id_product'] ?>_dashboard">-</button>
						</form>

					</td>
				</tr>
			<?php
			}
			?>
		</tbody>

	</table>

	<br>
	<div>
		Cart Total: <?= $cartTotal ?>
	</div>

	<br>
	<div>
		<form action="<?= base_url('checkout') ?>" method="get" >
			<button >Checkout</button>
		</form>
	</div>
</div>

<script>

</script>

</div><!-- .container -->
