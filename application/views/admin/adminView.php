<div style="margin-top: 50px;">


    <?php
    foreach($maskFields as $keyField => $field) {
    ?>
        <br>
        <b><?= $field ?>: </b>
        <br>
        <?php echo ( isset($record->$keyField) ) ? $record->$keyField : '' ?>

        <br>
    <?php
    }
    ?>

</div>
