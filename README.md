Entiendo que esto "Recuperar desde el controlador de cursos todos los instructores dados de alta en la plataforma y devolverlos en la respuesta, teniendo en cuenta que puede haber millones de registros, debería ser lo más óptimo posible." iba enfocado a un eager load, pero como es sacar todos los instructores sin relaciones no le veía el sentido, así que he metido el eager load en el promedio de ratings y esto lo he optimizado habilitando el login en dos tablas distintas, users e instructors, así se pueden sacar todos los instructores de una sin tener que filtrar nada.

# Postman Collection for API Testing

Este proyecto incluye un archivo llamado `isid.postman_collection.json`, que contiene una colección de Postman para testear los endpoints de la API. Puedes importar esta colección en Postman para facilitar las pruebas de los diferentes endpoints disponibles.

## ¿Cómo usar la colección?
1. Abre Postman.
2. Haz clic en "Import".
3. Selecciona el archivo `isid.postman_collection.json`.
4. Una vez importado, verás una lista de los endpoints organizados por categorías.

## Endpoints disponibles

### Auth
- **`POST /api/register`**: Registro de un usuario.
- **`POST /api/login`**: Inicio de sesión de un usuario (devuelve un token de usuario).
- **`POST /api/instructor/register`**: Registro de un instructor.
- **`POST /api/instructor/login`**: Inicio de sesión de un instructor (devuelve un token de instructor).
- **`GET /api/instructor/profile`**: Perfil del instructor (requiere token de instructor).
- **`GET /api/profile`**: Perfil del usuario (requiere token de usuario).

### Courses
- **`GET /api/courses`**: Listar todos los cursos.
- **`GET /api/courses/{course}`**: Mostrar un curso específico.
- **`POST /api/courses`**: Crear un nuevo curso (requiere token de instructor).
- **`PUT /api/courses/{course}`**: Actualizar un curso existente (requiere token de instructor).
- **`DELETE /api/courses/{course}`**: Eliminar un curso (requiere token de instructor).
- **`GET /api/instructor/courses`**: Listar todos los cursos de un instructor (requiere token de instructor).

### Lessons
- **`GET /api/courses/{course}/lessons`**: Listar todas las lecciones de un curso específico.
- **`GET /api/lessons/{lesson}`**: Mostrar una lección específica.
- **`POST /api/courses/{course}/lessons`**: Crear una nueva lección para un curso específico (requiere token de instructor).
- **`PUT /api/lessons/{lesson}`**: Actualizar una lección existente (requiere token de instructor).
- **`DELETE /api/lessons/{lesson}`**: Eliminar una lección (requiere token de instructor).

### Comments
- **`GET /api/courses/{course}/comments`**: Listar comentarios de un curso.
- **`POST /api/courses/{course}/comments`**: Agregar un comentario a un curso (requiere token de usuario).
- **`PUT /api/comments/{comment}`**: Actualizar un comentario (requiere token de usuario).
- **`DELETE /api/comments/{comment}`**: Eliminar un comentario (requiere token de usuario).

### Ratings
- **`GET /api/courses/ratings/average`**: Listar el promedio de calificaciones de todos los cursos.
- **`GET /api/courses/{course}/ratings`**: Listar todas las calificaciones de un curso específico.
- **`POST /api/courses/{course}/ratings`**: Crear una calificación para un curso (requiere token de usuario).
- **`PUT /api/ratings/{rating}`**: Actualizar una calificación (requiere token de usuario).
- **`DELETE /api/ratings/{rating}`**: Eliminar una calificación (requiere token de usuario).

### Instructors
- **`GET /api/instructors`**: Listar todos los instructores.

## Notas importantes
- Los endpoints que requieren autenticación necesitan un token válido. Asegúrate de usar el token correcto según el tipo de usuario:
  - **Token de usuario**: Para rutas protegidas por el middleware `UserMiddleware`.
  - **Token de instructor**: Para rutas protegidas por el middleware `InstructorMiddleware`.
- Puedes obtener el token al iniciar sesión con los endpoints de login correspondientes.

¡Feliz testing!