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

### Capturas de pantalla

**Tabla de productos en base de datos:**
<img width="975" height="650" alt="imagen" src="https://github.com/user-attachments/assets/7c1a893e-82dd-4825-bd73-4b80eef5d7ae" />


**Listado de productos en el navegador:**
<img width="975" height="623" alt="imagen" src="https://github.com/user-attachments/assets/1f89f376-9ba9-4ad7-a58e-d2a29f9b9575" />


**Historial de commits:**
<img width="975" height="541" alt="imagen" src="https://github.com/user-attachments/assets/769e1e5c-0e24-4694-bf81-d6bcc61bb5d1" />

