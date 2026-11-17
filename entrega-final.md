Documento de entrega final
Sistema de Registro de Estudiantes
1. Presentación
Se entrega el proyecto Sistema de Registro de Estudiantes, desarrollado como ejercicio académico para aplicar Laravel, PHP, MySQL, arquitectura MVC, validación de formularios y control de versiones con Git.
2. Objetivo
Desarrollar una aplicación web que permita administrar registros de estudiantes mediante operaciones de creación, consulta, actualización y eliminación.
3. Funcionalidades incluidas
- Registro de estudiantes.
- Listado general.
- Consulta individual.
- Búsqueda por nombre y correo.
- Filtro por programa académico.
- Ordenamiento de resultados.
- Edición de registros.
- Eliminación de registros.
- Validación de campos y prevención de duplicados.
4. Alcance y exclusiones
El proyecto contempla la administración de estudiantes. No incluye inicio de sesión ni cierre de sesión, ya que estas funcionalidades no hacen parte del alcance de esta entrega.
5. Base de datos
La aplicación utiliza MySQL y la base de datos estudiantes, con la tabla principal personal. La clave primaria utilizada por el modelo es ID.

La estructura de la base se entrega mediante las migraciones del proyecto y, si corresponde, mediante un respaldo SQL anonimizado. Las credenciales de conexión se configuran localmente en .env, archivo que no se publica en el repositorio.
6. Verificación
Las pruebas funcionales se documentan en registro-pruebas.md. Ese archivo debe contener los resultados observados durante la ejecución de los casos de prueba.
7. Tecnologías utilizadas
- PHP.
- Laravel.
- MySQL/MariaDB.
- Composer.
- Blade.
- HTML, CSS y JavaScript.
- Git y GitHub.
La versión exacta de Laravel y los requisitos de PHP se consultan en composer.json.
8. Contenido de la entrega
- Código fuente del proyecto.
- Modelo y controlador.
- Vistas Blade.
- Rutas.
- Migraciones y seeders disponibles.
- Archivo .env.example.
- README.md con instrucciones de instalación.
- registro-pruebas.md con el registro de pruebas.
- Este documento de entrega.
9. Repositorio
Enlace: PEGAR_AQUI_LA_URL_DEL_REPOSITORIO
10. Declaración final
El proyecto se presenta con el alcance descrito en este documento. Las pruebas y resultados se deben corresponder con lo registrado en el archivo registro-pruebas.md. No se incluyen credenciales ni datos personales reales en el repositorio.