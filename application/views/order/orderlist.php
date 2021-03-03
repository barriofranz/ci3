
<div style="margin-top: 50px;">


    <?php
    foreach($orders as $order)
    {
    ?>
        <div style="margin-top: 50px;">
        <b>ID Order</b>: <?= $order['id_order'] ?>
        <br>
        <b>Date created</b>: <?= $order['created_at'] ?>
        <br>
        <b>Order Total</b>: <?= $order['total_paid'] ?>
        <br>
        <br>
        <b>Order Details</b>:
        <table class="" border="1">
            <thead>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total Price</th>
            </thead>
            <tbody>
                <?php
                foreach($orderDetails[$order['id_order']] as $orderDetail)
                {
                ?>
                    <tr>
                        <td><?= $orderDetail['product_name'] ?></td>
                        <td><?= $orderDetail['quantity'] ?></td>
                        <td><?= $orderDetail['unit_price'] ?></td>
                        <td><?= $orderDetail['total_price'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>

        </table>
        <br>
        </div>
    <?php
    }
    ?>


</div>
