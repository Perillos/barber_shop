El projecto se inicia en public/index.php, donde se crea una instancia de la clase Router, la cual se encarga de manejar las rutas

```php
$router = new Router();
```

En public/index.php se crea una instancia de la clase Router, donde se especifican las rutas del proyecto

```php
$router->get('/', [LoginController::class, 'login']);
```

## Base de datos

### Tablas

#### Usuarios

| Campo      | Tipo        |
| ---------- | ----------- |
| id         | int(11)     |
| nombre     | varchar(60) |
| apellido   | varchar(60) |
| telefono   | varchar(60) |
| admin      | tinyint(1)  |
| confirmado | tinyint(1)  |
| token      | varchar(60) |

#### Servicios

| Campo  | Tipo         |
| ------ | ------------ |
| id     | int(11)      |
| nombre | varchar(60)  |
| precio | decimal(5,2) |

#### Citas

| Campo     | Tipo    |
| --------- | ------- |
| id        | int(11) |
| fecha     | time    |
| usuarioId | int(11) |

#### CitasServicios

| Campo      | Tipo    |
| ---------- | ------- |
| id         | int(11) |
| citald     | int(11) |
| serviciold | int(11) |
