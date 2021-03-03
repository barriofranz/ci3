<div style="margin-top: 50px;">


    <div class="product-list">
        <table border="1">
            <thead>
                <?php
            	foreach($maskFields as $keyField => $field){
            	?>
    			<th><?= $field ?></th>
                <?php
            	}
            	?>
    			<th></th>
    		</thead>
            <tbody>

                <?php
            	foreach($records as $recKey => $record){
            	?>
            		<tr>
                        <?php
                    	foreach($maskFields as $keyField => $field){
                    	?>
            			<td><?= $record[$keyField] ?></td>
                        <?php
                    	}
                    	?>

                        <td>
                            <form action="<?= base_url( $controller.'/viewRecord') ?>" method="get" style="display:inline;">
                                <button name="id" value="<?= $record[$primaryKey] ?>">View</button>
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
