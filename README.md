# Proyecto de Autenticación y CRUD con PHP y MySQL

Este proyecto es un sistema básico de autenticación y gestión de usuarios usando **PHP** y **MySQL** sin frameworks ni librerías externas. Implementa operaciones CRUD (Crear, Leer, Actualizar, Eliminar) para gestionar los usuarios, además de un proceso de autenticación con sesiones.

## Estructura del Proyecto

La estructura del proyecto es la siguiente:

/project /assets /css /js /classes Database.php User.php /public index.php login.php dashboard.php logout.php register.php

yaml
Copiar

### **Tecnologías Usadas**
- PHP 7+
- MySQL
- Bootstrap (para diseño)

---

## Instalación

### 1. Clonar el repositorio

Primero, clona este repositorio en tu máquina local:

git clone https://github.com/xxxx
cd proyecto-auth-php-mysql
2. Configurar la base de datos
Crea una base de datos llamada users_db y ejecuta el siguiente script SQL en tu servidor MySQL para crear la tabla de usuarios:
sql
CREATE DATABASE users_db;

USE users_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertar un usuario de prueba
INSERT INTO users (username, password) VALUES ('admin', MD5('admin123'));
Asegúrate de que tu servidor MySQL esté corriendo y que PHP pueda conectarse a la base de datos. Si tu base de datos no está en localhost o tiene un nombre de usuario y contraseña diferentes, actualiza los parámetros de conexión en la clase Database.php.
3. Configuración del Servidor
Asegúrate de tener un servidor web con PHP instalado, como XAMPP o MAMP.
Coloca el proyecto en la carpeta pública de tu servidor (por ejemplo, en htdocs de XAMPP).
Abre el navegador y accede a http://localhost/proyecto-auth-php-mysql/public/.
Uso
1. Página de CRUD (index.php)
Los usuarios pueden hacer CRUD en la aplicación a través de la página index.php. Los usuarios deben proporcionar un nombre de usuario y una contraseña. La contraseña se almacenará de manera segura utilizando bcrypt.


Descripción de Archivos y Funciones
/classes/Database.php
Esta clase se encarga de establecer la conexión a la base de datos utilizando PDO.

Método:

getConnection(): Devuelve la conexión PDO.
/classes/User.php
Esta clase contiene toda la lógica de manejo de usuarios. Permite crear usuarios, autenticar a los usuarios e interactuar con la base de datos.

Métodos:

create(): Registra un nuevo usuario en la base de datos.
update(): Actualiza a un usuario verificando el nombre de usuario.
readAll(): Devuelve todos los usuarios (aunque no se usa directamente en este proyecto, se puede extender para mostrar todos los usuarios).
