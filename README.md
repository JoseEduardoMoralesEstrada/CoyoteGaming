## Actividad 3.3 — Seeding y Validación Básica

### Estructura de Seeders

Se modificaron y utilizaron los siguientes archivos:

- `AdminUserSeeder.php` — Modificado para crear 2 administradores y 4 clientes
- `CategorySeeder.php` — Crea 6 categorías de videojuegos
- `ProductSeeder.php` — Crea 8 productos con categoría asignada
- `DatabaseSeeder.php` — Llama a los tres seeders en orden

### Resumen de datos generados

- 2 Administradores
- 4 Clientes
- 6 Categorías: Acción, RPG, Deportes, Estrategia, Terror, Aventura
- 8 Productos con categoría y plataforma asignada

### Confirmación de pruebas manuales

- Los 8 productos del seeder se listan correctamente en el catálogo
- El login funciona correctamente para administradores y clientes
- El administrador puede acceder al panel de administración
- El cliente recibe error 403 al intentar acceder al panel de administración

### Rama utilizada

`feature/basic-seeding-validation`
