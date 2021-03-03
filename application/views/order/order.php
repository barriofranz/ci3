
<div style="margin-top: 50px;">
    Name: <?= $customer->firstname ?> <?= $customer->lastname ?>
    <br>
    Address: <?= $customer->address ?>
    <br>

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

						<form action="<?= base_url('addProductToCart') ?>" method="GET" style="display:inline;">
							<button name="id_product" value="<?= $cartProduct['id_product'] ?>_checkout">+</button>

						</form>

						<form action="<?= base_url('minusProductToCart') ?>" method="GET" style="display:inline;">
							<button name="id_product" value="<?= $cartProduct['id_product'] ?>_checkout">-</button>
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
		<form action="<?= base_url('dashboard') ?>" method="GET" >
			<button >Back</button>
		</form>
	</div>
    <br>
	<div>
		<form action="<?= base_url('submitOrder') ?>" method="GET" >
			<button >Submit Order</button>
		</form>
	</div>

</div>
