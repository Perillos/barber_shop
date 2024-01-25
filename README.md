El projecto se inicia en public/index.php, donde se crea una instancia de la clase Router, la cual se encarga de manejar las rutas

```php
$router = new Router();
```

En public/index.php se crea una instancia de la clase Router, donde se especifican las rutas del proyecto

```php
$router->get('/', [LoginController::class, 'login']);
```
