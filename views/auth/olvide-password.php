<h1 class="nombre-pagina">Olvidé Password</h1>
<p class="descripcion-pagina">Reestablece tu Password escribiendo tu E-Mail</p>

<?php

include_once __DIR__ . "/../templates/alertas.php";

?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <label for="email">E-Mail</label>
        <input type="email" id="email" name="email" placeholder="Tu E-Mail" />
    </div>

    <input type="submit" class="boton" value="Reestablecer Password" />
</form>

<div class="acciones">
    <a href="/crear-cuenta">¿No tienes cuenta? Regístrate</a>
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
</div>