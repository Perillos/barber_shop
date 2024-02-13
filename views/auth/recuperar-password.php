<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php

include_once __DIR__ . "/../templates/alertas.php";

?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Tu nuevo password" />
    </div>
    <input type="submit" class="boton" value="Guardar Nuevo Password" />
    <div class="acciones">
        <a href="/">¿Ya tienes cuenta? Iniciar sesión.</a>
    </div>
</form>