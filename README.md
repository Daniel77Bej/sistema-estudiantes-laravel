Sistema de Registro de Estudiantes
1. Descripción
Aplicación web académica para administrar la información de estudiantes. Permite registrar, consultar, buscar, filtrar, ordenar, actualizar y eliminar registros.

El proyecto está desarrollado con Laravel, PHP, MySQL, Blade, HTML, CSS y JavaScript, siguiendo la arquitectura Modelo-Vista-Controlador (MVC).
El alcance de esta entrega no incluye inicio de sesión ni cierre de sesión.

2. Funcionalidades
- Registrar estudiantes.
- Mostrar el listado de estudiantes.
- Consultar el detalle de un estudiante.
- Buscar por nombre o correo electrónico.
- Filtrar por programa académico.
- Ordenar los resultados.
- Editar la información de un estudiante.
- Eliminar registros.
- Validar los datos antes de guardar o actualizar.
- Evitar documentos/identificadores y correos duplicados, mediante las validaciones y restricciones configuradas en el proyecto.
3. Tecnologías
- PHP (versión compatible con la versión de Laravel instalada).
- Laravel.
- MySQL o MariaDB.
- Composer.
- XAMPP (o un servidor MySQL equivalente).
- Git y GitHub.
- Blade, HTML, CSS y JavaScript.
Consulta composer.json para conocer la versión exacta de Laravel y los requisitos de PHP de esta copia del proyecto.
4. Base de datos
- Base de datos: estudiantes.
- Tabla principal: personal.
- Clave primaria: ID.
La tabla personal contiene los campos utilizados por el sistema: ID, apellido, nombre, fecha_nacimiento, codigo_estudiantil, programa, semestre, correo, telefono y direccion.

La estructura debe poder prepararse mediante las migraciones del proyecto. Si se entrega un respaldo SQL adicional, debe estar actualizado, ser compatible con la estructura de las migraciones y utilizar datos ficticios o anonimizados.
5. Organización principal
app/
  Http/Controllers/PersonalController.php
  Models/Personal.php

database/
  migrations/
  seeders/
  backups/             (opcional: respaldo SQL anonimizado)

resources/
  views/personal/
    create.blade.php
    edit.blade.php
    index.blade.php
    show.blade.php

routes/
  web.php

README.md
registro-pruebas.md
entrega-final.md
6. Requisitos
- PHP compatible con la versión de Laravel del proyecto.
- Composer.
- MySQL o MariaDB.
- Git (opcional para ejecutar localmente, necesario para trabajar con el repositorio).
7. Instalación
7.1. Clonar el repositorio
git clone URL_DEL_REPOSITORIO
cd example-app
7.2. Instalar dependencias
composer install
7.3. Crear el archivo de entorno
En PowerShell:
Copy-Item .env.example .env
Configurar en .env los datos de conexión de la base de datos local:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=estudiantes
DB_USERNAME=root
DB_PASSWORD=
Ajustar usuario y contraseña según la instalación local de MySQL.
7.4. Crear la base de datos
Crear en MySQL una base de datos llamada estudiantes.
7.5. Preparar las tablas
Si el proyecto incluye las migraciones completas y actualizadas:
php artisan migrate
Si se entrega un respaldo SQL como alternativa, importarlo en la base estudiantes siguiendo las instrucciones del docente. No ejecutar simultáneamente una importación y migraciones que intenten crear las mismas tablas.
7.6. Generar la clave de Laravel y limpiar configuración
php artisan key:generate
php artisan config:clear
7.7. Iniciar el servidor
php artisan serve
Abrir http://127.0.0.1:8000 en el navegador.
8. Validaciones
El sistema valida los campos requeridos, los tipos y formatos de datos, los límites definidos para cada campo, el rango del semestre, el formato del correo y la unicidad de los identificadores y correos, según las reglas configuradas en el controlador y la base de datos.
9. Pruebas
Las pruebas funcionales realizadas y sus resultados deben quedar registrados en registro-pruebas.md. Se recomienda usar datos ficticios y comprobar tanto los casos válidos como los inválidos.
10. Repositorio y archivos que no deben publicarse
No subir al repositorio:
- .env ni archivos que contengan contraseñas, claves o credenciales.
- vendor/ ni node_modules/.
- Sesiones, cachés o logs generados.
- Datos personales reales de estudiantes.
Sí conservar:
- .env.example con valores de ejemplo.
- composer.json y composer.lock.
- Código fuente, vistas, rutas y migraciones.
- Documentación y pruebas.
- Un respaldo SQL únicamente si es necesario y está anonimizado.
11. Alcance académico
Este proyecto aplica operaciones CRUD, validación de formularios, acceso a MySQL, organización MVC y control de versiones. La autenticación de usuarios (inicio y cierre de sesión) no forma parte del alcance implementado de esta entrega.