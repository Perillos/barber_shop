<?php

foreach ($alertas as $key => $alerta) {
    foreach ($mensajes as $mensaje) {

?>

        <div class="alerta <?php echo $key; ?>">
            <?php echo $mensaje; ?>
        </div>

<?php
    }
}
