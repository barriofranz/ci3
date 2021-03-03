<div style="margin-top: 50px;">



        <br>
        <b>ID Order: </b>
        <br>
        <?php echo $record['id_order'] ?>
        <br>

        <br>
        <b>Customer: </b>
        <br>
        <?php echo $record['customerName'] ?>
        <br>

        <br>
        <b>Order Date: </b>
        <br>
        <?php echo $record['created_at'] ?>
        <br>

        <br>
        <b>Order Total: </b>
        <br>
        <?php echo $record['total_paid'] ?>
        <br>


        <br>
        <table border="1">
            <thead>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
            </thead>
            <tbody>
                <?php
                foreach($orderDetails as $key => $orderDetail){
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

</div>
